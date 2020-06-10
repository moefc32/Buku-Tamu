<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Masuk | Buku Tamu</title>
	<meta name="theme-color" content="#009688">
	<link rel="shortcut icon" href="<?php echo base_url('res/image'); ?>/favicon.png">
	<link rel="icon" sizes="512x512" href="<?php echo base_url('res/image'); ?>/favicon.png">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('res/css'); ?>/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('res/css'); ?>/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('res/css'); ?>/style.css">
</head>
<body class="hidden-print">
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php echo site_url(); ?>">
					<img alt="Logo" src="<?php echo base_url('res/image'); ?>/favicon.png">
					<span>Buku Tamu</span>
				</a>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="page-header">
			<h1>Masuk</h1>
		</div>
		<div class="row">
			<form method="post" action="<?php echo site_url('masuk'); ?>" class="form-horizontal col-sm-8">
				<div style="color: red;">
					<?php echo validation_errors();
					echo '<p>' . $this->session->flashdata('notification') . '</p>' ?>
				</div>
				<p>Silakan isikan nama akun dan kata sandi Anda untuk masuk :</p>
				<div class="form-group">
					<div class="col-sm-12">
						<div class="input-group" title="Nama akun">
							<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
							<input type="text" required="true" maxlength="30" class="form-control" name="nama" placeholder="Nama akun">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<div class="input-group" title="Kata sandi">
							<span class="input-group-addon"><i class="fa fa-eye-slash fa-fw"></i></span>
							<input type="password" required="true" class="form-control" name="sandi" placeholder="Kata sandi">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<button type="submit" name="masuk" class="btn btn-primary" title="Masuk">
							<i class="fa fa-sign-in fa-fw"></i> Masuk
						</button>
						<a href="<?php echo site_url(); ?>" class="btn btn-success" title="Kembali ke halaman utama">
							<i class="fa fa-reply fa-fw"></i> Kembali
						</a>
					</div>
				</div>
			</form>
			<div class="col-sm-4 text-center hidden-xs" style="background: url(<?php echo base_url('res/image'); ?>/masuk.png) center center no-repeat; height: 158px; margin-bottom: 15px;"></div>
		</div><hr>
		<span class="copyright">
			<strong>Mochappucinno Studio</strong> &copy; 2018
		</span>
	</div>
	<script src="<?php echo base_url('res/js'); ?>/jquery.min.js"></script>
	<script src="<?php echo base_url('res/js'); ?>/bootstrap.min.js"></script>
</body>
</html>
