<!DOCTYPE html>

<?php
if (!isset($_GET['trinket'])) {
  die('Invalid trinket ID.');
}
?>

<html>
  <head>
    <title>Festival of Thinking - Python</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="icon" href="assets/img/cropped-nhs-site-icon-32x32.png" sizes="32x32" />

    <style type="text/css">
    </style>
  </head>

  <body>
    <!--
    <script src="vendor/skulpt.min.js" type="text/javascript"></script>
    <script src="vendor/skulpt-stdlib.js" type="text/javascript"></script>
    -->

    <!-- Note: Each project will have to be loaded individually onto Trinket.io... -->
    <iframe src="https://trinket.io/embed/python/<?php echo $_GET['trinket'] ?>?toggleCode=true&runOption=run&start=result"
            width="100%" height="600" frameborder="0" marginwidth="0" marginheight="0" allowfullscreen>
    </iframe>

    <script>
    </script>
  </body>
</html>
