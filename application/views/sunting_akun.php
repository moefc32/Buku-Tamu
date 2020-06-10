<?php defined('BASEPATH') OR exit('No direct script access allowed');
extract($akun); ?>

<div class="row">
	<nav class="col-sm-12">
		<ul class="nav nav-tabs">
			<li role="presentation" title="Acara">
				<a href="<?php echo site_url('sunting_acara'); ?>"><i class="fa fa-bookmark fa-fw"></i> Acara</a>
			</li>
			<li role="presentation" class="active">
				<a><i class="fa fa-user fa-fw"></i> Akun</a>
			</li>
			<li role="presentation" title="Database">
				<a href="<?php echo site_url('sunting_database'); ?>"><i class="fa fa-file fa-fw"></i> Database</a>
			</li>
		</ul>
	</nav>
</div>
<div class="page-header">
	<h1>Pengaturan Akun</h1>
</div>
<div class="row">
	<form method="post" action="<?php echo site_url('tulis_sandi'); ?>" class="form-horizontal col-sm-8">
		<div style="color: red;">
			<?php echo validation_errors();
			echo '<p>' . $this->session->flashdata('notification') . '</p>' ?>
		</div>
		<p>Sebelum melanjutkan, silakan masukkan informasi akun :</p>
		<div class="form-group">
			<div class="col-sm-6">
				<div class="input-group" title="Nama akun lama">
					<?php $nama_awal = strtolower($this->security->xss_clean($this->encryption->decrypt($nama))); ?>
					<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
					<input type="text" disabled="true" class="form-control" placeholder="Nama akun lama" value="<?php echo $nama_awal; ?>">
				</div>
			</div>
			<div class="col-sm-6">
				<div class="input-group" title="Kata sandi lama">
					<span class="input-group-addon"><i class="fa fa-eye-slash fa-fw"></i></span>
					<input type="password" required="true" class="form-control" name="sandi" placeholder="Kata sandi lama">
				</div>
			</div>
		</div>
		<p>Silakan masukkan informasi akun yang baru (nama akun hanya boleh berupa huruf dan angka) :</p>
		<div class="form-group">
			<div class="col-sm-6">
				<div class="input-group" title="Nama akun baru">
					<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
					<input type="text" required="true" maxlength="30" class="form-control" name="xnama" placeholder="Nama akun baru">
				</div>
			</div>
			<div class="col-sm-6">
				<div class="input-group" title="Kata sandi baru">
					<span class="input-group-addon"><i class="fa fa-eye-slash fa-fw"></i></span>
					<input type="password" required="true" class="form-control" name="xsandi" placeholder="Kata sandi baru">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<button type="submit" name="submit" class="btn btn-primary" title="Sunting informasi akun">
					<i class="fa fa-edit fa-fw"></i> Ganti Detail Akun
				</button>
				<a href="<?php echo site_url(); ?>" class="btn btn-success" title="Kembali ke halaman utama">
					<i class="fa fa-reply fa-fw"></i> Kembali
				</a>
			</div>
		</div>
	</form>
	<div class="col-sm-4 text-center hidden-xs" style="background: url(<?php echo base_url('res/image'); ?>/akun.png) center center no-repeat; height: 212px; margin-bottom: 15px;"></div>
</div><hr>
