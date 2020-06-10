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
		<form method="post" action="<?php echo ROOTPATH . 'pasang/proses'; ?>" class="form-horizontal">
			<p><strong>Selamat datang!</strong><br>
			Sebelum melanjutkan, silakan masukkan informasi akun database :</p>
			<div class="form-group">
				<div class="col-sm-6">
					<div class="input-group" title="Nama akun">
						<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
						<input type="text" required="TRUE" class="form-control" name="username" placeholder="Nama akun">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="input-group" title="Kata kunci">
						<span class="input-group-addon"><i class="fa fa-eye-slash fa-fw"></i></span>
						<input type="password" class="form-control" name="password" placeholder="Kata kunci">
					</div>
				</div>
			</div>
			<p>Silakan masukkan informasi database baru :</p>
			<div class="form-group">
				<div class="col-sm-3">
					<div class="input-group" title="Nama database">
						<span class="input-group-addon"><i class="fa fa-database fa-fw"></i></span>
						<input type="text" required="TRUE" class="form-control" name="database" placeholder="Nama database" value="buku_tamu">
					</div>
				</div>
				<div class="col-sm-3">
					<div class="input-group" title="Nama host">
						<span class="input-group-addon"><i class="fa fa-home fa-fw"></i></span>
						<input type="text" required="TRUE" class="form-control" name="hostname" placeholder="Nama host" value="localhost">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="input-group" title="Alamat aplikasi">
						<span class="input-group-addon"><i class="fa fa-globe fa-fw"></i></span>
						<input type="text" required="TRUE" class="form-control" name="baseurl" placeholder="Alamat aplikasi" value="<?php echo ROOTPATH; ?>">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<div class="input-group">
						<button type="submit" name="install" class="btn btn-success" title="Mulai pemasangan">
							<i class="fa fa-sign-in fa-fw"></i> Mulai Pemasangan
						</button>
					</div>
				</div>
			</div>
		</form><hr>
		<span class="copyright">
			<strong>Mochappucinno Studio</strong> &copy; 2018
		</span>
	</div>
</body>
</html>
