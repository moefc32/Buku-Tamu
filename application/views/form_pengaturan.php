<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pengaturan | Buku Tamu</title>
	<meta name="theme-color" content="#009688">
	<link rel="shortcut icon" href="<?php echo base_url('res/image'); ?>/favicon.png">
	<link rel="icon" sizes="512x512" href="<?php echo base_url('res/image'); ?>/favicon.png">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('res/css'); ?>/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('res/css'); ?>/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('res/css'); ?>/datetimepicker.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('res/css'); ?>/style.css">
</head>
<body class="hidden-print">
	<?php include 'nav.php';?>
	<div class="container">
		<?php $this->load->view($konten)?>
		<span class="copyright">
			<strong>Mochappucinno Studio</strong> &copy; 2018
		</span>
	</div>
	<script src="<?php echo base_url('res/js'); ?>/jquery.min.js"></script>
	<script src="<?php echo base_url('res/js'); ?>/bootstrap.min.js"></script>
	<script src="<?php echo base_url('res/js'); ?>/datetimepicker.min.js"></script>
	<script>
		;(function($){
			$.fn.datetimepicker.dates['id'] = {
				days: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"],
				daysShort: ["Mng", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Mng"],
				daysMin: ["M", "S", "S", "R", "K", "J", "S", "M"],
				months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
				monthsShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
				today: "Hari Ini",
				suffix: [],
				meridiem: [],
				weekStart: 1,
				format: "dd/mm/yyyy hh:ii:ss"
			};
		}(jQuery));
		$(".form_datetime").datetimepicker({
			language:  'id',
			format: "DD, dd MM yyyy - hh:ii"
		});
	</script>
</body>
</html>
