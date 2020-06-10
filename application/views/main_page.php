<?php defined('BASEPATH') OR exit('No direct script access allowed');
$logged_in = $this->session->userdata('logged_in');
extract($buku); ?>

<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Buku Tamu <?php echo $this->security->xss_clean($this->encryption->decrypt($acara)); ?></title>
	<meta name="theme-color" content="#009688">
	<link rel="shortcut icon" href="<?php echo base_url('res/image'); ?>/favicon.png">
	<link rel="icon" sizes="512x512" href="<?php echo base_url('res/image'); ?>/favicon.png">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('res/css'); ?>/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('res/css'); ?>/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('res/css'); ?>/style.css">
</head>
<body class="hidden-print">
	<?php include 'nav.php';?>
	<div class="container">
		<div class="page-header hidden">
			<h1>Buku Tamu <?php echo $this->security->xss_clean($this->encryption->decrypt($acara)); ?></h1>
		</div>
		<div class="row">
			<aside class="col-md-4 col-md-push-8">
				<?php echo $this->session->flashdata('notification') ?>
				<form method="post" action="<?php echo site_url('tulis'); ?>" class="form-horizontal">
					<div class="form-group">
						<div class="col-sm-12">
							<div class="input-group" title="Nama lengkap">
								<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
								<input type="text" required="true" maxlength="30" class="form-control" name="nama" placeholder="Nama lengkap">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<div class="input-group" title="Nomor induk mahasiswa">
								<span class="input-group-addon"><i class="fa fa-file fa-fw"></i></span>
								<input type="number" required="true" maxlength="12" class="form-control" name="nim" placeholder="Nomor induk mahasiswa">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<div class="input-group" title="Asal fakultas">
								<span class="input-group-addon"><i class="fa fa-home fa-fw"></i></span>
								<input type="text" required="true" maxlength="30" class="form-control" name="fakultas" placeholder="Asal fakultas">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<div class="input-group" title="Alamat surel">
								<span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
								<input type="email" required="true" maxlength="40" class="form-control" name="surel" placeholder="Alamat surel">
							</div>
						</div>
					</div>
					<div class="form-group" style="vertical-align: bottom;">
						<div class="col-xs-4 col-md-12">
							<input type="hidden" name="identifier" value="<?php echo $this->session->userdata('identifier'); ?>">
							<button type="submit" class="btn btn-primary col-md-12" title="Tulis data">
								<i class="fa fa-pencil fa-fw"></i> Tulis
							</button>
						</div>
						<p class="page-info col-xs-8 col-md-12 visible-xs visible-sm">
							Halaman ini diproses dalam <strong>{elapsed_time}</strong> detik.<br>
						</p>
						<p class="page-info col-xs-8 col-md-12 hidden-xs hidden-sm" style="margin: 15px 0 0;">
							Halaman ini diproses dalam <strong>{elapsed_time}</strong> detik.<br>
							<strong>Mochappucinno Studio</strong> &copy; 2018
						</p>
					</div>
				</form>
			</aside>
			<section class="col-md-8 col-md-pull-4">
				<div class="row">
					<div class="col-sm-12 table-responsive">
						<table class="table table-striped table-hover">
							<tr>
								<th>Waktu</th>
								<th>Nama</th>
								<th>NIM</th>
								<th>Fakultas</th>
								<?php if ($logged_in) { ?>
									<th>Surel</th>
									<th>Aksi</th>
								<?php } ?>
							</tr>
							<?php $i = 0; foreach ($presensi as $u_key) { ?>
								<tr>
									<td><?php echo unix_to_human(gmt_to_local($this->security->xss_clean($this->encryption->decrypt($u_key->waktu)), $this->security->xss_clean($this->encryption->decrypt($lokasi))), TRUE, 'eu'); ?></td>
									<td><?php echo $this->security->xss_clean($this->encryption->decrypt($u_key->nama)); ?></td>
									<td><?php echo $this->security->xss_clean($this->encryption->decrypt($u_key->nim)); ?></td>
									<td><?php echo $this->security->xss_clean($this->encryption->decrypt($u_key->fakultas)); ?></td>
									<?php if ($logged_in) { ?>
										<td><?php echo $this->security->xss_clean($this->encryption->decrypt($u_key->surel)); ?></td>
										<td width="72px">
											<a href="<?php echo site_url('sunting'); ?>/<?php echo $u_key->id; ?>" class="btn btn-warning btn-xs" title="Sunting data">
												<i class="fa fa-edit fa-fw"></i>
											</a>
											<a href="<?php echo site_url('hapus'); ?>/<?php echo $u_key->id; ?>" onClick="return confirm('Data ini akan dihapus dari sistem. Anda yakin?')" class="btn btn-danger btn-xs" title="Hapus data">
												<i class="fa fa-trash fa-fw"></i>
											</a>
										</td>
									<?php } ?>
								</tr>
								<?php $i++;
							}?>
						</table>
						<?php
						if ($i == 0) {
							echo '<p class="text-center">Belum ada data presensi.</p>';
						} ?>
					</div>
					<div class="col-sm-12">
						<?php echo $this->pagination->create_links(); ?>
					</div>
				</div><hr class="copyright hidden-md hidden-lg">
				<span class="copyright hidden-md hidden-lg">
					<strong>Mochappucinno Studio</strong> &copy; 2018
				</span>
			</section>
		</div>
	</div>
	<script src="<?php echo base_url('res/js'); ?>/jquery.min.js"></script>
	<script src="<?php echo base_url('res/js'); ?>/bootstrap.min.js"></script>
</body>
</html>
