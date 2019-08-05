<?php
session_start();
if (!isset($_SESSION["username"])) {
  header ("Location: login.php");
}

// Get some session data.
$seshUser = $_SESSION["username"];
echo $seshUser;
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Ouch!</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" shrink-to-fit=no>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <style type="text/css">

        </style>
    </head>

    <body>
      <h1 class="page-header">Settings</h1><br>


        <!--<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Change Password</button><br>
        <div id="demo" class="collapse">-->
          <form action='check.php' method="post">
            Current Password:<br><input type='password' name='current'><br><br>
            New Password:<br><input type='password' name='newPass'><br><br>
            Confirm New Password:<br><input type='password' name='confirmPass'><br><br>
            <input name='action' type='submit' value='Change Password'>
          </form>
        <!--</div>-->

      <?php

      ?>


        <script>

        </script>
    </body>
</html>
