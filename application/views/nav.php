<?php defined('BASEPATH') OR exit('No direct script access allowed');
$logged_in = $this->session->userdata('logged_in'); ?>

<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" title="Navigasi">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo site_url(); ?>">
				<img alt="Logo" src="<?php echo base_url('res/image'); ?>/favicon.png">
				<span>Buku Tamu</span>
			</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li>
					<?php if (!$logged_in) {
						echo '<li><a href="' . site_url('masuk') . '" Title="Masuk"><i class="fa fa-sign-in fa-fw"></i> Masuk</a></li>';
					} else {
						echo '<li><a href="' . site_url('cetak') . '" Title="Cetak presensi"><i class="fa fa-print fa-fw"></i> Cetak Presensi</a></li>';
						echo '<li><a href="' . site_url('excel') . '" Title="Simpan ke Excel"><i class="fa fa-file-excel-o fa-fw"></i> Simpan ke Excel</a></li>';
						echo '<li><a href="' . site_url('pengaturan') . '" Title="Pengaturan"><i class="fa fa-gear fa-fw"></i> Pengaturan</a></li>';
						echo '<li><a href="' . site_url('keluar') . '" Title="Keluar"><i class="fa fa-sign-out fa-fw"></i> Keluar</a></li>';
					} ?>
				</li>
			</ul>
		</div>
	</div>
</nav>
