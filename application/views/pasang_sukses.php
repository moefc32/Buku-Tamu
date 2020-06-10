<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pemasangan | Buku Tamu</title>
	<meta name="theme-color" content="#009688">
	<link rel="shortcut icon" href="<?php echo ROOTPATH; ?>res/image/favicon.png">
	<link rel="icon" sizes="512x512" href="<?php echo ROOTPATH; ?>res/image/favicon.png">
	<link rel="stylesheet" type="text/css" href="<?php echo ROOTPATH; ?>res/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo ROOTPATH; ?>res/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo ROOTPATH; ?>res/css/style.css">
</head>
<body class="hidden-print">
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand">
					<img alt="Logo" src="<?php echo ROOTPATH; ?>res/image/favicon.png">
					<span>Buku Tamu</span>
				</a>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="page-header">
			<h1>Pemasangan Buku Tamu</h1>
		</div>
		<div class="form-horizontal">
			<div class="form-group">
				<div class="col-sm-12">
					<p><strong>Pemasangan sukses!</strong></p>
					<p>Silakan gunakan nama akun <code>admin</code> dan kata kunci <code>pass</code> untuk masuk.<br>
					Untuk alasan keamanan, segera ganti nama akun dan kata sandi Anda.</p>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<a href="<?php echo site_url('masuk'); ?>" class="btn btn-primary" title="Masuk">
						<i class="fa fa-sign-in fa-fw"></i> Masuk
					</a>
					<a href="<?php echo site_url(); ?>" class="btn btn-success" title="Ke halaman utama">
						<i class="fa fa-reply fa-fw"></i> Ke Halaman Utama
					</a>
				</div>
			</div>
		</div><hr>
		<span class="copyright">
			<strong>Mochappucinno Studio</strong> &copy; 2018
		</span>
	</div>
</body>
</html>
