<?php defined('BASEPATH') OR exit('No direct script access allowed');
extract($buku); ?>

<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cetak | Buku Tamu</title>
	<meta name="theme-color" content="#009688">
	<link rel="shortcut icon" href="<?php echo base_url('res/image'); ?>/favicon.png">
	<link rel="icon" sizes="512x512" href="<?php echo base_url('res/image'); ?>/favicon.png">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('res/css'); ?>/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('res/css'); ?>/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('res/css'); ?>/style.css">
</head>
<body>
	<?php include 'nav.php';?>
	<section class="container">
		<div class="page-header">
			<h1><?php echo $this->security->xss_clean($this->encryption->decrypt($acara)); ?></h1>
		</div>
		<div class="row info-cetak">
			<div class="print-logo visible-print-block">
				<div class="col-sm-12">
					<img src="<?php echo base_url('res/image'); ?>/favicon.png" alt="Logo">
				</div>
			</div>
			<div class="print-50">
				<div class="col-sm-12"><strong>Tempat</strong></div>
				<div class="col-sm-12"><p><?php echo $this->security->xss_clean($this->encryption->decrypt($tempat)); ?></p></div>
				<div class="col-sm-12"><strong>Waktu kegiatan</strong></div>
				<div class="col-sm-12"><p><?php echo $this->security->xss_clean($this->encryption->decrypt($jadwal)); ?></p></div>
			</div>
			<div class="print-50">
				<div class="col-sm-12"><strong>Penyelenggara</strong></div>
				<div class="col-sm-12"><p><?php echo $this->security->xss_clean($this->encryption->decrypt($penyelenggara)); ?></p></div>
				<div class="col-sm-12"><strong>Ketua pelaksana</strong></div>
				<div class="col-sm-12"><p><?php echo $this->security->xss_clean($this->encryption->decrypt($penanggung)); ?></p></div>
			</div>
			<div class="print-date">
				<div class="col-sm-12 visible-print-block">
					<small><?php echo "Halaman ini dicetak pada " . date("d/m/Y") . " pukul " . date("H:i"); ?></small>
				</div>
			</div>
		</div>
		<div class="row visible-print-block">
			<div class="col-sm-12 table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th>No.</th>
						<th>Waktu</th>
						<th>Nama</th>
						<th>NIM</th>
						<th>Fakultas</th>
						<th>Surel</th>
					</tr>
					<?php $i=1; foreach ($presensi as $u_key){ ?>
						<tr>
							<td><?php echo $i; $i++; ?></td>
							<td><?php echo unix_to_human(gmt_to_local($this->security->xss_clean($this->encryption->decrypt($u_key->waktu)), $this->security->xss_clean($this->encryption->decrypt($lokasi))), TRUE, 'eu'); ?></td>
							<td><?php echo $this->security->xss_clean($this->encryption->decrypt($u_key->nama)); ?></td>
							<td><?php echo $this->security->xss_clean($this->encryption->decrypt($u_key->nim)); ?></td>
							<td><?php echo $this->security->xss_clean($this->encryption->decrypt($u_key->fakultas)); ?></td>
							<td><?php echo $this->security->xss_clean($this->encryption->decrypt($u_key->surel)); ?></td>
						</tr>
					<?php }?>
				</table>
				<?php
				if ($i==1) {
					echo '<p class="text-center">Belum ada data presensi.</p>';
				} ?>
			</div>
		</div>
		<div class="form-horizontal hidden-print">
			<div class="form-group">
				<div class="col-sm-12">
					<a href="<?php echo site_url('cetak'); ?>" class="btn btn-primary" title="Muat ulang halaman ini">
						<i class="fa fa-history fa-fw"></i> Muat Ulang
					</a>
					<a href="<?php echo site_url(); ?>" class="btn btn-success" title="Kembali ke halaman sebelumnya">
						<i class="fa fa-reply fa-fw"></i> Kembali
					</a>
				</div>
			</div>
		</div><hr class="hidden-print">
		<span class="copyright">
			<strong>Mochappucinno Studio</strong> &copy; 2018
		</span>
	</section>
	<script src="<?php echo base_url('res/js'); ?>/jquery.min.js"></script>
	<script src="<?php echo base_url('res/js'); ?>/bootstrap.min.js"></script>
	<script>
		$(document).ready(function() {
			window.print();
		});
	</script>
</body>
</html>
