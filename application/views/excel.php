<?php defined('BASEPATH') OR exit('No direct script access allowed');
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=$judul.xls");
header("Pragma: no-cache"); 
header("Expires: 0");
extract($buku); ?>

<table border="1" width="100%">
	<tr>
		<th>No.</th>
		<th>Waktu</th>
		<th>Nama</th>
		<th>NIM</th>
		<th>Fakultas</th>
		<th>Surel</th>
	</tr>
	<?php $i=1; foreach($daftar as $daftar) { ?>
		<tr>
			<td><?php echo $i; $i++; ?></td>
			<td><?php echo unix_to_human(gmt_to_local($this->security->xss_clean($this->encryption->decrypt($daftar->waktu)), $this->security->xss_clean($this->encryption->decrypt($lokasi))), TRUE, 'eu'); ?></td>
			<td><?php echo $this->security->xss_clean($this->encryption->decrypt($daftar->nama)); ?></td>
			<td><?php echo $this->security->xss_clean($this->encryption->decrypt($daftar->nim)); ?></td>
			<td><?php echo $this->security->xss_clean($this->encryption->decrypt($daftar->fakultas)); ?></td>
			<td><?php echo $this->security->xss_clean($this->encryption->decrypt($daftar->surel)); ?></td>
		</tr>
	<?php }?>
</table>
