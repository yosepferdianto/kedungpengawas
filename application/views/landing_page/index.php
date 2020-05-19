<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title><?php echo $title; ?></title>

    <!-- CALL TAG <LINK> ASSEST-PLUGINS -->
    <?php echo $_head; ?>
    
    <!-- CALL <SCRIPT> ASSEST-PLUGINS -->
    <?php echo $_body; ?>

  </head>

  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-green layout-top-nav fixed">
    <div class="wrapper">
      <?php echo $_header; ?>
      <?php echo $_content; ?>
      <?php echo $_footer; ?>
    </div>
  <!-- ./wrapper -->

  </body>
</html>
