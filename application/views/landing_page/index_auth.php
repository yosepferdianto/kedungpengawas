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

     <!-- STYLE TAMBAHAN -->
    <style>
      /* .help-block {
        margin-top: 40px;
      }
      p.return-home {
        margin: 20px 0;
      } */
    </style>

  </head>

  <body class="hold-transition">
    <div class="wrapper">
      <?php echo $_content; ?>
    </div>
  <!-- ./wrapper -->

  </body>
</html>
