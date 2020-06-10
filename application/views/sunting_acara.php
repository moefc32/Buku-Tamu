<?php defined('BASEPATH') OR exit('No direct script access allowed');
extract($buku); ?>

<div class="row">
	<nav class="col-sm-12">
		<ul class="nav nav-tabs">
			<li role="presentation" class="active">
				<a><i class="fa fa-bookmark fa-fw"></i> Acara</a>
			</li>
			<li role="presentation" title="Akun">
				<a href="<?php echo site_url('sunting_akun'); ?>"><i class="fa fa-user fa-fw"></i> Akun</a>
			</li>
			<li role="presentation" title="Database">
				<a href="<?php echo site_url('sunting_database'); ?>"><i class="fa fa-file fa-fw"></i> Database</a>
			</li>
		</ul>
	</nav>
</div>
<div class="page-header">
	<h1>Pengaturan Acara</h1>
</div>
<div class="row">
	<div class="col-sm-4 col-sm-push-8">
		<div class="thumbnail">
			<div class="row">
				<div class="col-xs-5 col-sm-12 text-center">
					<img src="<?php echo base_url('res/image'); ?>/favicon.png" alt="Logo" style="height: 90px; margin: 10px auto;">
				</div>
				<div class="col-xs-7 col-sm-12">
					<div class="caption">
						<?php echo form_open_multipart('sunting_gambar'); ?>
							<div class="form-group">
								<div class="input-group">
									<input type="file" required="true" name="userfile" size="20" style="width: 100%">
								</div>
							</div>
							<button type="submit" onClick="return confirm('Sebelum mengunggah gambar, pastikan berat maksimal gambar adalah 2MB, gambar berekstensi .PNG, serta memiliki tinggi dan lebar maksimal 512px.')" class="btn btn-warning" title="Ganti gambar"><i class="fa fa-edit fa-fw"></i>  Ganti Gambar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<form method="post" action="<?php echo site_url('tulis_acara'); ?>" class="form-horizontal col-sm-8 col-sm-pull-4">
		<div style="color: red;">
			<?php echo '<p>' . $this->session->flashdata('notification') . '</p>'; ?>
		</div>
		<p>Silakan masukkan informasi acara yang akan dilaksanakan di sini :</p>
		<div class="form-group">
			<div class="col-sm-6">
				<div class="input-group" title="Nama acara">
					<span class="input-group-addon"><i class="fa fa-bookmark fa-fw"></i></span>
					<input type="text" required="true" maxlength="50" class="form-control" name="acara" placeholder="Nama acara" value="<?php echo $this->security->xss_clean($this->encryption->decrypt($acara)); ?>">
				</div>
			</div>
			<div class="col-sm-6">
				<div class="input-group" title="Tempat acara">
					<span class="input-group-addon"><i class="fa fa-home fa-fw"></i></span>
					<input type="text" required="true" maxlength="30" class="form-control" name="tempat" placeholder="Tempat acara" value="<?php echo $this->security->xss_clean($this->encryption->decrypt($tempat)); ?>">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-6">
				<div class="input-group input-append date form_datetime" title="Jadwal acara">
					<span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
					<input type="text" required="true" readonly="true" class="form-control" name="jadwal" placeholder="Jadwal acara" value="<?php echo $this->security->xss_clean($this->encryption->decrypt($jadwal)); ?>" style="background-color: #fff; cursor: pointer;">
				</div>
			</div>
			<div class="col-sm-6">
				<div class="input-group" title="Zona waktu">
					<span class="input-group-addon"><i class="fa fa-globe fa-fw"></i></span>
					<?php
					$templokasi = $this->security->xss_clean($this->encryption->decrypt($lokasi));
					echo timezone_menu($templokasi, 'form-control', 'lokasi');
					?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-6">
				<div class="input-group" title="Penyelenggara">
					<span class="input-group-addon"><i class="fa fa-users fa-fw"></i></span>
					<input type="text" required="true" maxlength="30" class="form-control" name="penyelenggara" placeholder="Penyelenggara" value="<?php echo $this->security->xss_clean($this->encryption->decrypt($penyelenggara)); ?>">
				</div>
			</div>
			<div class="col-sm-6">
				<div class="input-group" title="Ketua pelaksana">
					<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
					<input type="text" required="true" maxlength="30" class="form-control" name="penanggung" placeholder="Ketua pelaksana" value="<?php echo $this->security->xss_clean($this->encryption->decrypt($penanggung)); ?>">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<button type="submit" name="submit" class="btn btn-primary" title="Sunting informasi acara">
					<i class="fa fa-edit fa-fw"></i> Sunting Buku Tamu
				</button>
				<a href="<?php echo site_url(); ?>" class="btn btn-success" title="Kembali ke halaman utama">
					<i class="fa fa-reply fa-fw"></i> Kembali
				</a>
			</div>
		</div>
	</form>
</div><hr>
