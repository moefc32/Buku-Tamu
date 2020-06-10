<?php defined('BASEPATH') OR exit('No direct script access allowed');

class presensi_model extends CI_Model {
	function __construct() {
		parent::__construct();
		if (read_file(site_url() . 'kunci.php') === FALSE) {
			redirect(site_url('pasang'));
		}

		$this->load->database();
		$this->load->dbforge();

		if (!$this->db->table_exists('buku')) {
			redirect(site_url('pasang'));
		} elseif (!$this->db->table_exists('presensi')) {
			redirect(site_url('pasang'));
		} elseif (!$this->db->table_exists('staf')) {
			redirect(site_url('pasang'));
		}
	}

	function ambil_data() {
		$this->db->select('*');
		$this->db->from('presensi');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	function ambil_data_cetak() {
		$this->db->select('*');
		$this->db->from('presensi');
		$this->db->order_by('id', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	function insert_db($data) {
		return $this->db->insert('presensi', $data);
	}

	function get_by_id($id) {
		$query = $this->db->get_where('presensi', array('id' => $id));
		return $query->row_array();
	}

	function cari_acara() {
		$query = $this->db->get_where('buku', array('id' => 1));
		return $query->row_array();
	}

	function tulis_acara($data, $id) {
		$this->db->where('buku.id', $id);
		return $this->db->update('buku', $data);
	}

	function tulis_sandi($data, $id) {
		$this->db->where('staf.id', $id);
		return $this->db->update('staf', $data);
	}

	function update_info($data, $id) {
		$this->db->where('presensi.id', $id);
		return $this->db->update('presensi', $data);
	}

	function hapus_presensi($id) {
		$this->db->where('presensi.id', $id);
		return $this->db->delete('presensi');
	}

	function select_all_paging($limit=array()) {
		$this->db->select('*');
		$this->db->from('presensi');
		$this->db->order_by('id', 'desc');
		if ($limit != NULL)
			$this->db->limit($limit['perpage'], $limit['offset']);
		return $this->db->get();
	}

	function cari_user($id) {
		$query = $this->db->get_where('staf', array('id' => $id));
		return $query->row_array();
	}

	function cek_user($nama, $sandi) {
		$result = $this->db->get('staf')->row_array();
		$this->db->where(strtolower($this->encryption->decrypt($result['nama'])), $nama);
		if ($this->bcrypt->check_password($sandi, $result['sandi'])) {
			return $result;
		} else {
			return FALSE;
		}
	}

	function cek_user_ganti($id, $sandi) {
		$result = $this->db->get('staf')->row_array();
		if ($id == $result['id']) {
			if ($this->bcrypt->check_password($sandi, $result['sandi'])) {
				return $result;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	function reset_db() {
		$this->dbforge->drop_table('presensi', TRUE);
		$attributes = array('engine' => 'innodb');
		
		$fields = array(
			'id' => array(
				'type'				=> 'integer',
				'constraint'		=> '11',
				'null'				=> FALSE,
				'auto_increment'	=> TRUE
			), 

			'waktu' => array(
				'type'				=>'varchar',
				'constraint'		=> '300',
				'null'				=> FALSE
			), 
			'nama' => array(
				'type'				=>'varchar',
				'constraint'		=> '300',
				'null'				=> FALSE
			), 
			'nim' => array(
				'type'				=>'varchar',
				'constraint'		=> '300',
				'null'				=> FALSE
			), 
			'fakultas' => array(
				'type'				=>'varchar',
				'constraint'		=> '300',
				'null'				=> FALSE
			), 
			'surel' => array(
				'type'				=>'varchar',
				'constraint'		=> '300',
				'null'				=> FALSE
			)
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('presensi');
	}

	public function ambil_xls() {
		$this->db->select('*');
		$this->db->from('presensi');
		$query = $this->db->get();
		return $query->result();
	}
}
