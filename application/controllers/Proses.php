<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Proses extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('presensi_model');
	}

	public function index($offset = 0) {
		if ($this->tes_koneksi_db() === FALSE) {
			redirect(site_url('pasang'));
		}

		$this->load->library('pagination');
		$perpage	= 10;
		$config		= array(
			'base_url'			=> site_url('proses/index'),
			'total_rows'		=> count($this->presensi_model->ambil_data()),
			'per_page'			=> $perpage,
			'full_tag_open'		=> '<nav class="text-center"><ul class="pagination pagination-sm">',
			'full_tag_close'	=> '</ul></nav>',
			'first_link'		=> '<i class="fa fa-angle-double-left fa-fw"></i>',
			'first_tag_open'	=> '<li>',
			'first_tag_close'	=> '</li>',
			'last_link'			=> '<i class="fa fa-angle-double-right fa-fw"></i>',
			'last_tag_open'		=> '<li>',
			'last_tag_close'	=> '</li>',
			'next_link'			=> '<i class="fa fa-angle-right fa-fw"></i>',
			'next_tag_open'		=> '<li>',
			'next_tag_close'	=> '</li>',
			'prev_link'			=> '<i class="fa fa-angle-left fa-fw"></i>',
			'prev_tag_open'		=> '<li>',
			'prev_tag_close'	=> '</li>',
			'cur_tag_open'		=> '<li class="active"><a href="">',
			'cur_tag_close'		=> '</a></li>',
			'num_tag_open'		=> '<li class="page">',
			'num_tag_close'		=> '</li>'
		);
		
		$this->pagination->initialize($config);
		$limit['perpage']	= $perpage;
		$limit['offset']	= $offset;
		$data['buku']		= $this->presensi_model->cari_acara('1');
		$data['presensi']	= $this->presensi_model->select_all_paging($limit)->result();

		$identifier = array('identifier' => bin2hex($this->encryption->create_key(8)));
		$this->session->set_userdata($identifier);
		$this->load->view('main_page', $data);
	}

	public function tes_koneksi_db() {
		if (!$this->db->table_exists('buku')) {
			return FALSE;
		} elseif (!$this->db->table_exists('presensi')) {
			return FALSE;
		} elseif (!$this->db->table_exists('staf')) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function tulis() {
		$nama		= $this->input->post('nama', TRUE);
		$nim		= $this->input->post('nim', TRUE);
		$fakultas	= $this->input->post('fakultas', TRUE);
		$surel		= $this->input->post('surel', TRUE);

		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('nim', 'nim', 'required');
		$this->form_validation->set_rules('fakultas', 'fakultas', 'required');
		$this->form_validation->set_rules('surel', 'surel', 'required|valid_email');

		if ($this->form_validation->run() == TRUE) {
			$udata['waktu']		= $this->encryption->encrypt(local_to_gmt(time()));
			$udata['nama']		= $this->encryption->encrypt($nama);
			$udata['nim']		= $this->encryption->encrypt($nim);
			$udata['fakultas']	= $this->encryption->encrypt($fakultas);
			$udata['surel']		= $this->encryption->encrypt($surel);

			if ($this->input->post('identifier') == $this->session->userdata('identifier')) {
				$identifier = array('identifier' => bin2hex($this->encryption->create_key(8)));
				$this->session->set_userdata($identifier);
				$this->presensi_model->insert_db($udata);
				redirect(site_url());
			} else {
				redirect(site_url());
			}
		} else {
			$this->session->set_flashdata('notification', 'Peringatan : Data tidak boleh kosong.');
			redirect(site_url());
		}
	}

	public function sunting() {
		if (!$this->session->userdata('logged_in')) redirect(site_url('masuk'));

		$id					= $this->uri->segment(2);
		$data['buku']		= $this->presensi_model->cari_acara('1');
		$data['presensi']	= $this->presensi_model->get_by_id($id);
		$this->load->view('form_sunting', $data);
	}

	public function tulis_sunting() {
		$nama		= $this->input->post('nama', TRUE);
		$nim		= $this->input->post('nim', TRUE);
		$fakultas	= $this->input->post('fakultas', TRUE);
		$surel		= $this->input->post('surel', TRUE);

		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('nim', 'nim', 'required');
		$this->form_validation->set_rules('fakultas', 'fakultas', 'required');
		$this->form_validation->set_rules('surel', 'surel', 'required|valid_email');

		if ($this->form_validation->run() == TRUE) {
			$udata['nama']		= $this->encryption->encrypt($nama);
			$udata['nim']		= $this->encryption->encrypt($nim);
			$udata['fakultas']	= $this->encryption->encrypt($fakultas);
			$udata['surel']		= $this->encryption->encrypt($surel);

			$this->presensi_model->update_info($udata, $this->input->post('id', TRUE));
			$notif = '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close fa-fw"></i></button>Data berhasil diperbarui.</div>';
			$this->session->set_flashdata('notification', $notif);
			redirect(site_url());
		} else {
			$notif = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close fa-fw"></i></button>Data gagal diperbarui.</div>';
			$this->session->set_flashdata('notification', $notif);
			redirect(site_url());
		}
	}

	public function hapus($id) {
		if (!$this->session->userdata('logged_in')) redirect(site_url('masuk'));

		$this->presensi_model->hapus_presensi($id);
		$notif = '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close fa-fw"></i></button>Data berhasil dihapus.</div>';
		$this->session->set_flashdata('notification', $notif);
		redirect(site_url());
	}

	public function cetak() {
		if (!$this->session->userdata('logged_in')) redirect(site_url('masuk'));

		$data['buku']		= $this->presensi_model->cari_acara('1');
		$data['presensi']	= $this->presensi_model->ambil_data_cetak();
		$this->load->view('cetak', $data);
	}

	public function reset_presensi() {
		if (!$this->session->userdata('logged_in')) redirect(site_url('masuk'));

		$nama			= strtolower($this->input->post('nama', 'TRUE'));
		$sandi			= $this->input->post('sandi', 'TRUE');
		$temp_account	= $this->presensi_model->cek_user($nama, $sandi);
		$num_account	= count($temp_account);

		$this->form_validation->set_rules('sandi', 'sandi', 'required');
		$this->form_validation->set_rules('validasi', 'validasi', 'required');

		if ($this->form_validation->run() == TRUE) {
			if ($num_account > 0) {
				$this->presensi_model->reset_db();
				$notif = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close fa-fw"></i></button>Daftar presensi berhasil disetel ulang.</div>';
				$this->session->set_flashdata('notification', $notif);
				redirect(site_url());
			} else {
				$this->session->set_flashdata('notification', 'Peringatan : Kata sandi salah.');
				redirect(site_url('sunting_database'));
			}
		}
	}

	public function excel() {
		if (!$this->session->userdata('logged_in')) redirect(site_url('masuk'));

		$data['judul']	= 'Buku Tamu';
		$data['buku']	= $this->presensi_model->cari_acara('1');
		$data['daftar']	= $this->presensi_model->ambil_xls();
		$this->load->view('excel', $data);
	}
}
