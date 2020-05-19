<link rel="icon" href="<?= base_url(); ?>assets/img/logo_kab_bekasi.png">

<!-- Bootstrap 3.4.1 Component -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/dist/plugins/bootstrap/dist/css/bootstrap.min.css" type="text/css">
<!-- Font Awesome Component-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/dist/plugins/fontawesome/css/all.min.css" type="text/css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">

<!-- Ionicons Component-->
<link rel="stylesheet" href="<?= base_url(); ?>assets/dist/plugins/Ionicons/css/ionicons.min.css" type="text/css">

<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte/bower_components/select2/dist/css/select2.min.css">

<!-- Theme style -->
<link href="<?= base_url(); ?>assets/adminlte/dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />

<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
<link href="<?= base_url(); ?>assets/adminlte/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

<!-- DataTables Component style-->
<!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte/bower_components/datatables/css/jquery.dataTables.min.css"> -->

<!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/plugins/datatables/css/dataTables.foundation.css"> -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/dist/plugins/datatables/css/dataTables.bootstrap.min.css">

<!-- DataTables 1.10.18 -->
<!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/datatables/css/dataTables.bootstrap.min.css"> -->

<!-- jvectormap Component-->
<link rel="stylesheet" href="<?= base_url(); ?>assets/dist/plugins/jvectormap/jquery-jvectormap.css" type="text/css">

<!-- iCheck Plugin -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte/plugins/iCheck/all.css" type="text/css">

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<!-- DatePicker Component-->
<link rel="stylesheet" href="<?= base_url(); ?>assets/dist/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css" type="text/css">

<!-- CSS TAMBAHAN -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/mydist.css" type="text/css">

<style>
		.book {
			width: 100%;
			height: 100%;
			margin: 0;
			padding: 0;
			/* background-color: #FAFAFA; */
			font: 12pt "TimesNewRoman";
			overflow-x: auto;
		}

		* {
			box-sizing: border-box;
			-moz-box-sizing: border-box;
		}

		.page {
			width: 210mm;
			min-height: 297mm;
			padding: 5mm 20mm 0mm 20mm;
			margin: 10mm auto;
			border: 1px #D3D3D3 solid;
			border-radius: 5px;
			background: white;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
		}

		.subpage {
			padding: 1cm;
			border: 5px red solid;
			height: 257mm;
			outline: 2cm #FFEAEA solid;
		}

		@page {
			size: A4;
			margin: 0;
		}

		@media print {

			html,
			body {
				width: 210mm;
				height: 297mm;
			}

			.page {
				margin: 0;
				border: initial;
				border-radius: initial;
				width: initial;
				min-height: initial;
				box-shadow: initial;
				background: initial;
				page-break-after: always;
			}
		}

		.line {
			border: 0;
			border-top: 3px double #000;
			border-bottom: 1px solid #000;
			padding: 0;
			margin: 0;
			margin-bottom: 5px;
		}

		tr td {
			padding: 0 !important;
			margin: 0 !important;
		}

		/* body {
			font-family: "Times New Roman", Times, serif;
			} */

</style>