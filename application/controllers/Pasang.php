<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pasang extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('pasang_model');
	}

	public function index() {
		if (read_file(site_url() . 'kunci.php') === FALSE) {
			$this->load->view('pasang');
		} else {
			$this->load->view('pasang_gagal');
		}
	}

	public function sukses() {
		$this->load->view('pasang_sukses');
	}

	public function proses() {
		$this->session->sess_destroy();
		$username	= $this->input->post('username', 'TRUE');
		$password	= $this->input->post('password', 'TRUE');
		$database	= $this->input->post('database', 'TRUE');
		$hostname	= $this->input->post('hostname', 'TRUE');
		$baseurl	= $this->input->post('baseurl', 'TRUE');

		$this->pasang_model->atur_config($baseurl);
		$this->pasang_model->atur_database($username, $password, $database, $hostname);
		$this->pasang_model->atur_kunci($baseurl);

		$this->config->set_item('baseurl', $baseurl);

		$this->pasang_model->pasang_db($username, $password, $database, $hostname);
		$this->pasang_model->pasang_db_buku();
		$this->pasang_model->pasang_db_presensi();
		$this->pasang_model->pasang_db_staf();

		$this->session->set_flashdata('auth', TRUE);
		redirect(ROOTPATH . 'pasang/sukses');
	}
}
