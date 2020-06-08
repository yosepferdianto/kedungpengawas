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
<link href="<?= base_url(); ?>assets/adminlte/dist/css/skins/_all-skins.css" rel="stylesheet" type="text/css" />

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

<!-- bootstrap wysihtml5 - text editor -->
<!-- <link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> -->

<style>
  .jumbotron_custom{
    background-image: url("<?= base_url(); ?>assets/img/unnamed.jpg");
    /* min-height: 300px; */
    background-repeat: no-repeat;
    background-position: center;
    -webkit-background-size: cover;
    background-size: cover;
    background-color: #222222;
  }
  .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }
    .example-modal .modal {
      background: transparent !important;
    }

    .card-image {
      width: 100%;
      height: 150px;
      position: relative;
      overflow: hidden;
    }

    .card-image > img {
      width: 100%;
      max-width: inherit;
      position: absolute;
      top: 50%;
      left: 50%;
      -webkit-transform: translate(-50%, -50%) scale(1.5);
      -moz-transform: translate(-50%, -50%) scale(1.5);
      -o-transform: translate(-50%, -50%) scale(1.5);
      transform: translate(-50%, -50%) scale(1.5);
    }

    .card-image-detail {
      width: 100%;
      height: 300px;
      position: relative;
      overflow: hidden;
    }

    .card-image-detail > img {
      width: 100%;
      max-width: inherit;
      position: absolute;
      top: 50%;
      left: 50%;
      -webkit-transform: translate(-50%, -50%) scale(1.5);
      -moz-transform: translate(-50%, -50%) scale(1.5);
      -o-transform: translate(-50%, -50%) scale(1.5);
      transform: translate(-50%, -50%) scale(1.5);
    }

    .card-image-table {
      width: 100%;
      height: 100px;
      position: relative;
      overflow: hidden;
    }

    .card-image-table > img {
      width: 100%;
      max-width: inherit;
      position: absolute;
      top: 50%;
      left: 50%;
      -webkit-transform: translate(-50%, -50%) scale(1.5);
      -moz-transform: translate(-50%, -50%) scale(1.5);
      -o-transform: translate(-50%, -50%) scale(1.5);
      transform: translate(-50%, -50%) scale(1.5);
    }

    .card-image-add {
      width: 100%;
      height: 48px;
      position: relative;
      overflow: hidden;
      border: 2px dashed #ddd;
      padding: 5px;
    }

    .card-image-add_ {
      width: 100%;
      height: 100%;
      position: relative;
      overflow: hidden;
      border: 2px dashed #ddd;
      padding: 5px;
    }

    .card-image-de {
      width: 100%;
      height: 220px;
      position: relative;
      overflow: hidden;
    }
    .card-image-de > img {
      width: 100%;
      max-width: inherit;
      position: absolute;
      top: 50%;
      left: 50%;
      -webkit-transform: translate(-50%, -50%) scale(1.5);
      -moz-transform: translate(-50%, -50%) scale(1.5);
      -o-transform: translate(-50%, -50%) scale(1.5);
      transform: translate(-50%, -50%) scale(1.5);
    }

    .card-textarea {
      border: 1px solid #ddd;
    }

    .card-box {
      width: 100%;
      height: 100%;
      position: relative;
      overflow: hidden;
      border: 1px solid #ddd;
      padding: 10px 10px 3px 10px;
    }

    hr.style1 {
			border-top: 1px solid #ddd;
      margin: 8px 0px;
		}

    hr.style1-ms-0 {
			border-top: 1px solid #ddd;
      margin: 0px 0px;
		}

    hr.style1-dashed {
			border-top: 1px dashed #ddd;
      margin: 8px 0px;
		}

    .file {
      visibility: hidden;
      position: absolute;
    }

</style>
