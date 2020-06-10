<?php defined('BASEPATH') OR exit('No direct script access allowed');
extract($akun);
extract($buku); ?>

<div class="row">
	<nav class="col-sm-12">
		<ul class="nav nav-tabs">
			<li role="presentation" title="Acara">
				<a href="<?php echo site_url('sunting_acara'); ?>"><i class="fa fa-bookmark fa-fw"></i> Acara</a>
			</li>
			<li role="presentation" title="Akun">
				<a href="<?php echo site_url('sunting_akun'); ?>"><i class="fa fa-user fa-fw"></i> Akun</a>
			</li>
			<li role="presentation" class="active">
				<a><i class="fa fa-file fa-fw"></i> Database</a>
			</li>
		</ul>
	</nav>
</div>
<div class="page-header">
	<h1>Pengaturan Database</h1>
</div>
<div class="row">
	<form method="post" action="<?php echo site_url('reset_presensi'); ?>" class="form-horizontal col-sm-8">
		<div style="color: red;">
			<?php echo validation_errors();
			echo '<p>' . $this->session->flashdata('notification') . '</p>' ?>
		</div>
		<p>Bagian ini akan menghapus seluruh presensi <strong><?php echo $this->security->xss_clean($this->encryption->decrypt($acara)); ?></strong>.<br>Sebelum melanjutkan, silakan masukkan kata sandi dari akun Anda :</p>
		<div class="form-group" title="Kata sandi">
			<div class="col-sm-12">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-eye-slash fa-fw"></i></span>
					<input type="password" required="true" class="form-control" name="sandi" placeholder="Kata sandi">
					<input type="hidden" name="nama" value="<?php echo strtolower($this->security->xss_clean($this->encryption->decrypt($nama))); ?>">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<p style="color: red;">Tindakan ini tidak dapat dibatalkan, seluruh data presensi akan terhapus!</p>
				<label style="cursor: pointer;">
					<input type="checkbox" required="true" name="validasi">
					Saya yakin dengan tindakan ini
				</label>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<button type="submit" name="submit" class="btn btn-danger" title="Setel ulang presensi" onClick="return confirm('Database akan disetel ulang, semua data yang sudah terekam akan dihapus. Tindakan ini tidak dapat dibatalkan, Anda yakin?')" >
					<i class="fa fa-eraser fa-fw"></i> Hapus Presensi
				</button>
				<a href="<?php echo site_url(); ?>" class="btn btn-success" title="Kembali ke halaman sebelumnya">
					<i class="fa fa-reply fa-fw"></i> Kembali
				</a>
			</div>
		</div>
	</form>
	<div class="col-sm-4 text-center hidden-xs" style="background: url(<?php echo base_url('res/image'); ?>/database.png) center center no-repeat; height: 212px; margin-bottom: 15px;"></div>
</div><hr>
