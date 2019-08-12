<?php
//Start the sessin
session_start();
require 'common.php';
//Check if session username exists, if not, sned to login page
if (!isset($_SESSION["username"])) {
  header ("Location: login.php");
}

// Get some session data.
$seshUser = $_SESSION["username"];
echo ('Username: ' . $seshUser);
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

          <!--Change password form-->
          <h3>Change Password</h3>
          <form action='settings.php' method="post">

            Current Password:<br><input type='password' name='current'><br><br>
            New Password:<br><input type='password' name='newPass'><br><br>
            Confirm New Password:<br><input type='password' name='confirmPass'><br><br>
            <input name='action' type='submit' value='Change Password'><br><br><br><br>

          </form>
        <!--</div>-->

         <!--Change email form-->
          <form action='settings.php' method="post">
            Change Email:<br><input type='text' name='email'><br><br>
            <input name='action' type='submit' value='Change Email'>
          </form>
        <!--</div>-->



      <?php

      function changePass() {

        global $DBUserTable;
        global $seshUser;

          $currentPass = $_POST['current'];
          $newPass = $_POST['newPass'];
          $confirmPass = $_POST['confirmPass'];
          $DBpassword = query("SELECT * FROM $DBUserTable WHERE txtUsername='$seshUser' AND txtPassword='$currentPass'");
          $error = 0;

          if (empty($currentPass) || empty($newPass) || empty($confirmPass)) {
              echo "You did not fill out the required fields.<br>";
              $error = 1;
          }

        if ($error == 0) {
          if ($newPass != $confirmPass) {
              echo ('- New passwords did not match!<br>');
              $error = 1;
            } if (strlen($newPass) < 8) {
              echo ('- Password needs to contain atleast 8 characters<br>');
              $error = 1;
            } if( !preg_match("#[0-9]+#", $newPass ) ) {
              echo ("- Password must include at least one number!<br>");
              $error = 1;
              } if( !preg_match("#[a-z]+#", $newPass ) ) {
              echo ('- Password must include at least one lowercase letter!<br>');
              $error = 1;
              } if( !preg_match("#[A-Z]+#", $newPass ) ) {
              echo ('- Password must include at least one CAPS!<br>');
              $error = 1;
              } if (!$DBpassword) {
              echo ('- Incorrect current password!<br>');
              $error = 1;
            }
        }

          if ($error == 0) {
            update("UPDATE $DBUserTable SET txtPassword='$newPass' WHERE txtUsername='$seshUser'");
            echo ('Congratulations, you have changed your password');
          } else die();
     }


      function changeEmail() {
           global $DBUserTable;
           global $seshUser;

              $email = $_POST['email'];
              $DBemail = query("SELECT * FROM $DBUserTable WHERE txtUsername='$seshUser' AND txtEmail='$email'");
              $error = 0;

              if (empty($email)) {
                  echo "You did not fill out the required fields.<br>";
                  $error = 1;
              }

              //Email already exists check
              if ($error == 0) {
              $emails = query("SELECT * FROM $DBUserTable WHERE txtEmail='$email'");
              if ($emails) {
                echo ('- Email already exists<br>');
                $error = 1;
              }
              }

              //Check if valid email
              if ($error == 0) {
                if( !preg_match("#['@']+#", $email ) ) {
                echo ('- Invalid Email!<br>');
                $error = 1;
                }
              }

              if ($error == 0) {
                update("UPDATE $DBUserTable SET txtEmail='$email' WHERE txtUsername='$seshUser'");
                  echo ("You have change your email to $email");
                } else die();
              }


       if (isset($_POST['action'])) {
      $action = $_POST['action'];

      switch ($action) {
        case 'Change Password':
        changePass();
        break;
        case 'Change Email':
        changeEmail();
        break;
        }
       }

      ?>


        <script>

        </script>
    </body>
</html>
