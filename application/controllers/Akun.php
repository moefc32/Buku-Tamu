<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('presensi_model');
	}

	public function index() {
		redirect(site_url());
	}

	public function masuk() {
		if (!$this->session->userdata('logged_in')) {
			$nama			= strtolower($this->input->post('nama', TRUE));
			$sandi			= $this->input->post('sandi', TRUE);
			$temp_account	= $this->presensi_model->cek_user($nama, $sandi);

			$this->form_validation->set_rules('nama', 'nama', 'required|alpha_numeric');
			$this->form_validation->set_rules('sandi', 'sandi', 'required');

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('form_masuk');
			} else {
				if (!empty($temp_account)) {
					$array_items = array(
						'id'		=> $temp_account['id'],
						'logged_in' => TRUE
					);

					$this->session->set_userdata($array_items);
					$notif = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close fa-fw"></i></button>Anda berhasil masuk, selamat datang!</div>';
					$this->session->set_flashdata('notification', $notif);
					redirect(site_url());
				} else {
					$this->session->set_flashdata('notification', 'Peringatan : Nama atau kata sandi salah.');
					redirect(site_url('masuk'));
				}
			}
		} else {
			redirect(site_url());
		}
	}

	public function pengaturan() {
		redirect(site_url('sunting_acara'));
	}

	public function sunting_gambar() {
		if (!$this->session->userdata('logged_in')) redirect(site_url('masuk'));

		$config['upload_path']			= 'res/image';
		$config['allowed_types']		= 'png';
		$config['max_size']				= 2048;
		$config['max_width']			= 512;
		$config['max_height']			= 512;
		$config['file_name']			= 'favicon';
		$config['file_ext_tolower']		= TRUE;
		$config['overwrite']			= TRUE;

		$this->load->library('upload', $config);
		if ($this->security->xss_clean('userfile', TRUE) == FALSE) {
			$this->session->set_flashdata('notification', 'Peringatan : Gambar mengandung script berbahaya.');
			redirect(site_url('sunting_acara'));
		} else {
			if (!$this->upload->do_upload('userfile')) {
				$this->session->set_flashdata('notification', 'Peringatan : Gambar tidak sesuai ketentuan.');
				redirect(site_url('sunting_acara'));
			} else {
				$notif = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close fa-fw"></i></button>Gambar acara berhasil diubah.</div>';
				
				$this->session->set_flashdata('notification', $notif);
				redirect(site_url('sunting_acara'));
			}
		}
	}

	public function sunting_acara() {
		if (!$this->session->userdata('logged_in')) redirect(site_url('masuk'));

		$data['buku']	= $this->presensi_model->cari_acara();
		$data['konten']	= 'sunting_acara';
		$this->load->view('form_pengaturan', $data);
	}

	public function sunting_akun() {
		if (!$this->session->userdata('logged_in')) redirect(site_url('masuk'));

		$id				= $this->session->userdata('id');
		$data['akun']	= $this->presensi_model->cari_user($id);
		$data['konten']	= 'sunting_akun';
		$this->load->view('form_pengaturan', $data);
	}

	public function sunting_database() {
		if (!$this->session->userdata('logged_in')) redirect(site_url('masuk'));

		$id				= $this->session->userdata('id');
		$data['akun']	= $this->presensi_model->cari_user($id);
		$data['buku']	= $this->presensi_model->cari_acara();
		$data['konten']	= 'sunting_database';
		$this->load->view('form_pengaturan', $data);
	}

	public function tulis_acara() {
		$acara			= $this->input->post('acara', TRUE);
		$lokasi			= $this->input->post('lokasi', TRUE);
		$tempat			= $this->input->post('tempat', TRUE);
		$jadwal			= $this->input->post('jadwal', TRUE);
		$penyelenggara	= $this->input->post('penyelenggara', TRUE);
		$penanggung		= $this->input->post('penanggung', TRUE);

		$this->form_validation->set_rules('acara', 'acara', 'required');
		$this->form_validation->set_rules('lokasi', 'lokasi', 'required');
		$this->form_validation->set_rules('tempat', 'tempat', 'required');
		$this->form_validation->set_rules('jadwal', 'jadwal', 'required');
		$this->form_validation->set_rules('penyelenggara', 'penyelenggara', 'required');
		$this->form_validation->set_rules('penanggung', 'penanggung', 'required');

		if ($this->form_validation->run() == TRUE) {
			$udata['acara']			= $this->encryption->encrypt($acara);
			$udata['lokasi']		= $this->encryption->encrypt($lokasi);
			$udata['tempat']		= $this->encryption->encrypt($tempat);
			$udata['jadwal']		= $this->encryption->encrypt($jadwal);
			$udata['penyelenggara']	= $this->encryption->encrypt($penyelenggara);
			$udata['penanggung']	= $this->encryption->encrypt($penanggung);
			
			$this->presensi_model->tulis_acara($udata, '1');
			$notif = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close fa-fw"></i></button>Informasi acara berhasil diubah.</div>';
			$this->session->set_flashdata('notification', $notif);
			redirect(site_url('sunting_acara'));
		} else {
			$this->session->set_flashdata('notification', 'Peringatan : Informasi acara tidak boleh kosong.');
			redirect(site_url('sunting_acara'));
		}
	}

	public function tulis_sandi() {
		if (!$this->session->userdata('logged_in')) redirect(site_url('masuk'));

		$id			= $this->session->userdata('id');
		$sandi		= $this->input->post('sandi', TRUE);
		$xnama		= $this->input->post('xnama', TRUE);
		$xsandi		= $this->input->post('xsandi', TRUE);
		$account	= $this->presensi_model->cek_user_ganti($id, $sandi);

		$this->form_validation->set_rules('sandi', 'sandi', 'required');
		$this->form_validation->set_rules('xnama', 'xnama', 'required|alpha_numeric');
		$this->form_validation->set_rules('xsandi', 'xsandi', 'required');

		if ($this->form_validation->run() == TRUE) {
			if ($account == TRUE) {
				$udata['nama']	= $this->encryption->encrypt(strtolower($xnama));
				$udata['sandi']	= $this->bcrypt->hash_password($xsandi);
				
				$this->presensi_model->tulis_sandi($udata, $id);
				$notif = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close fa-fw"></i></button>Informasi akun berhasil diubah.</div>';
				$this->session->set_flashdata('notification', $notif);
				redirect(site_url('sunting_akun'));
			} else {
				$this->session->set_flashdata('notification', 'Peringatan : Kata sandi salah, atau data yang diisikan tidak sesuai ketentuan.');
				redirect(site_url('sunting_akun'));
			}
		} else {
			$this->session->set_flashdata('notification', 'Peringatan : Kata sandi salah, atau data yang diisikan tidak sesuai ketentuan.');
			redirect(site_url('sunting_akun'));
		}
	}

	public function keluar() {
		$this->session->sess_destroy();
		redirect(site_url());
	}
}
