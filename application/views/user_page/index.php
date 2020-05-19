<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="referrer" content="no-referrer">

	<title><?php echo $title; ?></title>

	<!-- Call Tag <link> ASSEST-PLUGINS -->
  <?php echo $_head; ?>
  
  	<!-- CALL <SCRIPT> ASSEST-PLUGINS -->
	<?php echo $_body; ?>

	<style>
		body {
			padding-right: 0 !important;
		}

		.modal {
			overflow-y: auto;
		}

	</style>

</head>

<body class="hold-transition skin-gradient-green sidebar-mini fixed">
	<!-- Site wrapper -->
	<div class="wrapper">
		<!-- Call Header -->
		<?php echo $_header; ?>
		<!-- Call Menu -->
		<?php echo $_navigasi; ?>
		<!-- Call Content -->
		<?php echo $_content; ?>
		<!-- Call Footer -->
		<?php echo $_footer; ?>
	</div>
	<!-- ./ Site wrapper -->

</body>

</html>
