<?php defined('BASEPATH') OR exit('No direct script access allowed');
if (is_null(extract($presensi))) {
	redirect(site_url());
}

extract($buku);
extract($presensi); ?>

<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sunting Data | Buku Tamu</title>
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
			<h1>Sunting Data</h1>
		</div>
		<div class="row">
			<form method="post" action="<?php echo site_url('tulis_sunting'); ?>" class="form-horizontal col-sm-8">
				<p>Silakan sunting data presensi dari <strong><?php echo $this->encryption->decrypt($nama); ?></strong> :</p>
				<div class="form-group">
					<div class="col-sm-12">
						<div class="input-group" title="Waktu presensi">
							<span class="input-group-addon"><i class="fa fa-bookmark fa-fw"></i></span>
							<input type="text" disabled="true" class="form-control" value="<?php echo unix_to_human(gmt_to_local($this->security->xss_clean($this->encryption->decrypt($waktu)), $this->security->xss_clean($this->encryption->decrypt($lokasi))), TRUE, 'eu'); ?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<div class="input-group" title="Nama lengkap">
							<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
							<input type="text" required="true" maxlength="30" class="form-control" name="nama" placeholder="Nama lengkap" value="<?php echo $this->security->xss_clean($this->encryption->decrypt($nama)); ?>">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="input-group" title="Nomor induk mahasiswa">
							<span class="input-group-addon"><i class="fa fa-file fa-fw"></i></span>
							<input type="number" required="true" maxlength="12" class="form-control" name="nim" placeholder="Nomor induk mahasiswa" value="<?php echo $this->security->xss_clean($this->encryption->decrypt($nim)); ?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<div class="input-group" title="Asal fakultas">
							<span class="input-group-addon"><i class="fa fa-home fa-fw"></i></span>
							<input type="text" required="true" maxlength="30" class="form-control" name="fakultas" placeholder="Asal fakultas" value="<?php echo $this->security->xss_clean($this->encryption->decrypt($fakultas)); ?>">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="input-group" title="Alamat surel">
							<span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
							<input type="email" required="true" maxlength="40" class="form-control" name="surel" placeholder="Alamat surel" value="<?php echo $this->security->xss_clean($this->encryption->decrypt($surel)); ?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<button type="submit" name="submit" class="btn btn-primary" title="Sunting data">
							<i class="fa fa-edit fa-fw"></i> Sunting
						</button>
						<a href="<?php echo site_url('hapus'); ?>/<?php echo $id; ?>" onClick="return confirm('Data ini akan dihapus dari sistem. Anda yakin?')" class="btn btn-danger" title="Hapus data">
							<i class="fa fa-trash fa-fw"></i> Hapus data
						</a>
						<a href="<?php echo site_url(); ?>" class="btn btn-success" title="Kembali ke halaman utama">
							<i class="fa fa-reply fa-fw"></i> Kembali
						</a>
					</div>
				</div>
			</form>
			<div class="col-sm-4 text-center hidden-xs" style="background: url(<?php echo base_url('res/image'); ?>/sunting.png) center center no-repeat; height: 212px; margin-bottom: 20px;"></div>
		</div><hr>
		<span class="copyright">
			<strong>Mochappucinno Studio</strong> &copy; 2018
		</span>
	</div>
	<script src="<?php echo base_url('res/js'); ?>/jquery.min.js"></script>
	<script src="<?php echo base_url('res/js'); ?>/bootstrap.min.js"></script>
</body>
</html>
