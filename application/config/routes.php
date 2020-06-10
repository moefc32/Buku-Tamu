<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']	= 'Proses';
$route['404_override']			= '';
$route['translate_uri_dashes']	= FALSE;

$route['masuk']					= 'akun/masuk';
$route['keluar']				= 'akun/keluar';
$route['pengaturan']			= 'akun/pengaturan';
$route['sunting_acara']			= 'akun/sunting_acara';
$route['sunting_akun']			= 'akun/sunting_akun';
$route['sunting_database']		= 'akun/sunting_database';
$route['sunting_gambar']		= 'akun/sunting_gambar';
$route['tulis_acara']			= 'akun/tulis_acara';
$route['tulis_sandi']			= 'akun/tulis_sandi';
$route['cetak']					= 'proses/cetak';
$route['excel']					= 'proses/excel';
$route['hapus/(:any)']			= 'proses/hapus/$1';
$route['reset_presensi']		= 'proses/reset_presensi';
$route['sunting/(:any)']		= 'proses/sunting/$1';
$route['tulis']					= 'proses/tulis';
$route['tulis_sunting']			= 'proses/tulis_sunting';
