<?php defined('BASEPATH') OR exit('No direct script access allowed');

class pasang_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$key	= bin2hex($this->encryption->create_key(16));
		$root	= str_replace('pasang/', '', ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http") . '://' . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']));
		
		define("ENCRYPTION_KEY", "hex2bin('" . $key . "')");
		define('ROOTPATH', $root);
		
		$this->load->helper('file');
		$this->encryption->initialize(
			array(
				'key' => hex2bin($key)
			)
		);
	}

	function atur_config($baseurl) {
		$template_path	= dirname(__FILE__) . '/../third_party/setup/config_default.php';
		$output_path	= dirname(__FILE__) . '/../config/config.php';
		$database_file	= file_get_contents($template_path);

		$new = str_replace("%BASEURL%", $baseurl, $database_file);
		$new = str_replace("%ENCKEY%", ENCRYPTION_KEY, $new);

		$handle = fopen($output_path, 'w+');
		@chmod($output_path, 0644);

		if (is_writable($output_path)) {
			if (fwrite($handle, $new)) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	function atur_database($username, $password, $database, $hostname) {
		$template_path	= dirname(__FILE__) . '/../third_party/setup/database_default.php';
		$output_path	= dirname(__FILE__) . '/../config/database.php';
		$database_file	= file_get_contents($template_path);

		$new = str_replace("%USERNAME%", $username, $database_file);
		$new = str_replace("%PASSWORD%", $password, $new);
		$new = str_replace("%DATABASE%", $database, $new);
		$new = str_replace("%HOSTNAME%", $hostname, $new);

		$handle = fopen($output_path,'w+');
		@chmod($output_path, 0644);

		if (is_writable($output_path)) {
			if (fwrite($handle, $new)) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	function atur_kunci($baseurl) {
		$template_path	= dirname(__FILE__) . '/../third_party/setup/kunci.php';
		$output_path	= dirname(__FILE__) . '/../../kunci.php';
		$new			= file_get_contents($template_path);

		$handle = fopen($output_path, 'w+');
		@chmod($output_path, 0644);

		if (is_writable($output_path)) {
			if (!write_file($output_path, $new)) {
				return FALSE;
			}
			else {
				return TRUE;
			}
		} else {
			return FALSE;
		}
	}

	function pasang_db($username, $password, $database, $hostname) {
		$mysqli = new mysqli($hostname, $username, $password, '');

		if (mysqli_connect_errno()) return FALSE;

		$mysqli->query("CREATE DATABASE IF NOT EXISTS " . $database);
		$mysqli->close();

		return TRUE;
	}

	function pasang_db_buku() {
		$this->load->database();
		$this->load->dbforge();
		$this->dbforge->drop_table('buku', TRUE);
		
		$fields = array(
			'id' => array(
				'type'				=> 'integer',
				'constraint'		=> '11',
				'null'				=> FALSE,
				'auto_increment'	=> TRUE
			),
			'acara' => array(
				'type'				=> 'varchar',
				'constraint'		=> '500',
				'null'				=> FALSE
			),
			'lokasi' => array(
				'type'				=> 'varchar',
				'constraint'		=> '500',
				'null'				=> FALSE
			),
			'tempat' => array(
				'type'				=> 'varchar',
				'constraint'		=> '500',
				'null'				=> FALSE
			),
			'jadwal' => array(
				'type'				=> 'varchar',
				'constraint'		=> '500',
				'null'				=> FALSE
			),
			'penyelenggara' => array(
				'type'				=> 'varchar',
				'constraint'		=> '500',
				'null'				=> FALSE
			),
			'penanggung' => array(
				'type'				=> 'varchar',
				'constraint'		=> '500',
				'null'				=> FALSE
			)
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('buku');

		$sql1	= "'" . $this->encryption->encrypt('Acara Kita') . "'";
		$sql2	= "'" . $this->encryption->encrypt('UP7') . "'";
		$sql3	= "'" . $this->encryption->encrypt('Alun-Alun Kota Bandung') . "'";
		$sql4	= "'" . $this->encryption->encrypt('Senin, 01 Januari 2018 - 08:00') . "'";
		$sql5	= "'" . $this->encryption->encrypt('Mochappucinno Studio') . "'";
		$sql6	= "'" . $this->encryption->encrypt('Faizal Chan.') . "'";

		$this->db->query("INSERT INTO `buku` (`id`, `acara`, `lokasi`, `tempat`, `jadwal`, `penyelenggara`, `penanggung`) VALUES (1, " . $sql1 . ", " . $sql2 . ", " . $sql3 . ", " . $sql4 . ", " . $sql5 . ", " . $sql6 . ");");
	}

	function pasang_db_presensi() {
		$this->load->database();
		$this->load->dbforge();
		$this->dbforge->drop_table('presensi', TRUE);
		
		$fields = array(
			'id' => array(
				'type'				=> 'integer',
				'constraint'		=> '11',
				'null'				=> FALSE,
				'auto_increment'	=> TRUE
			),
			'waktu' => array(
				'type'				=> 'varchar',
				'constraint'		=> '500',
				'null'				=> FALSE
			),
			'nama' => array(
				'type'				=> 'varchar',
				'constraint'		=> '500',
				'null'				=> FALSE
			),
			'nim' => array(
				'type'				=> 'varchar',
				'constraint'		=> '500',
				'null'				=> FALSE
			),
			'fakultas' => array(
				'type'				=> 'varchar',
				'constraint'		=> '500',
				'null'				=> FALSE
			),
			'surel' => array(
				'type'				=> 'varchar',
				'constraint'		=> '500',
				'null'				=> FALSE
			)
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('presensi');
	}

	function pasang_db_staf() {
		$this->load->database();
		$this->load->dbforge();
		$this->dbforge->drop_table('staf', TRUE);
		
		$fields = array(
			'id' => array(
				'type'				=> 'integer',
				'constraint'		=> '11',
				'null'				=> FALSE,
				'auto_increment'	=> TRUE
			),
			'nama' => array(
				'type'				=> 'varchar',
				'constraint'		=> '500',
				'null'				=> FALSE
			),
			'sandi' => array(
				'type'				=> 'text',
				'null'				=> FALSE
			)
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('staf');

		$sql1	= "'" . $this->encryption->encrypt(strtolower('admin')) . "'";
		$sql2	= "'" . $this->bcrypt->hash_password('pass') . "'";

		$this->db->query("INSERT INTO `staf` (`id`, `nama`, `sandi`) VALUES (1, " . $sql1 . ", " . $sql2 . ");");
	}
}
