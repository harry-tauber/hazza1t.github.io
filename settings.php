<?php
session_start();
require 'common.php';
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
          <form action='settings.php' method="post">
            Current Password:<br><input type='password' name='current'><br><br>
            New Password:<br><input type='password' name='newPass'><br><br>
            Confirm New Password:<br><input type='password' name='confirmPass'><br><br>
            <input name='action' type='submit' value='Change Password'>
          </form>
        <!--</div>-->

      <?php

      function doChange() {

        global $DBUserTable;
        global $seshUser;

          $current = $_POST['current'];
          $newPass = $_POST['newPass'];
          $confirmPass = $_POST['confirmPass'];
          $DBpassword = query("SELECT * FROM $DBUserTable WHERE txtPassword='$current'");
          $error = 0;

          if ($newPass != $confirmPass) {
            echo ('New passwords did not match!');
            $error = 1;
          } if (strlen($newPass) < 8) {
            echo ('Password needs to contain atleast 8 characters');
            $error = 1;
          } if( !preg_match("#[0-9]+#", $newPass ) ) {
            echo ("Password must include at least one number!");
            $error = 1;
            } if( !preg_match("#[a-z]+#", $newPass ) ) {
            echo ('Password must include at least one lowercase letter!');
            $error = 1;
            } if( !preg_match("#[A-Z]+#", $newPass ) ) {
            echo ('Password must include at least one CAPS!');
            $error = 1;
            } if (!$DBpassword) {
            echo ('Incorrect current password!');
            $error = 1;
          }

          if ($error == 0) {
            update("UPDATE $DBUserTable SET txtPassword='$newPass' WHERE txtUsername='$seshUser'");
            echo ('Congrats, you have changed your password');
          } else die();
     }

      $action = $_POST['action'];

      switch ($action) {
        case 'Change Password':
        doChange();
        break;
        }


      ?>


        <script>

        </script>
    </body>
</html>
