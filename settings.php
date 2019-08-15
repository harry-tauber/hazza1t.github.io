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
          form {
            display: inline-block;
          }
          body {
            text-align: center;
          } html {
            overflow: hidden;
          } body {
  background: #f8f8fd;
  color: #514B64;
          } #home {
            padding: 14px 20px;
          background-color: oldlace;
          position: absolute;
          bottom: 10px;
          left: 10px;
          } input[type=password], input[type=email] {
          padding: 15px;
          margin: 5px 0 22px 0;
          display: inline-block;
          border: none;
          background: #f1f1f1;
        } input[type=email]:focus, input[type=password]:focus {
          background-color: #ddd;
          outline: none;
        }

        hr {
          border: 1px solid #f1f1f1;
          margin-bottom: 25px;
        }

          button:hover {
          opacity:1;
          }
        </style>
    </head>

    <body>
      <div class="navbar">
          <img src='images/ouch.png' alt="Test" height="140" width="200" />
          <?php
          echo ("<h3>" . 'Username: ' . $seshUser . "</h3>");
          ?>
      </div>
      <div>
      <h1 class="page-header">Settings</h1>


        <!--<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Change Password</button><br>
        <div id="demo" class="collapse">-->

          <!--Change password form-->
          <h5>Change Password</h5>
          <form action='settings.php' method="post">

            <label for='current'>Current Password:</label>
            <br><input type='password' name='current' id='current' placeholder="Current Password"><br>
            <label for='newPass'>New Password:</label>
            <input type='password' name='newPass' id='newPass' placeholder="New Password">
            <label for='confirm'>Confirm New Password:</label>
            <input type='password' name='confirmPass' id='confirm' placeholder="Confirm New Password"><br>
            <input name='action' type='submit' value='Change Password'><br><br>

          </form>


         <!--Change email form-->
      <h5>Change Email</h5>
          <form action='settings.php' method="post">
            <input type='email' name='email' placeholder="Change Email"><br>
            <input name='action' type='submit' value='Change Email'>
          </form>
        </div>

      <a href='mainInter.php'><button id='home'>Home</button></a><br>




      <?php

      function changePass() {

        global $DBUserTable;
        global $seshUser;

          $currentPass = $_POST['current'];
          $newPass = $_POST['newPass'];
          $confirmPass = $_POST['confirmPass'];
          $userData = query("SELECT * FROM $DBUserTable WHERE txtUsername='$seshUser'");
          $hashedPass = $userData[0]["hash"];
          $verify = password_verify($currentPass, $hashedPass);
          //$DBpassword = query("SELECT * FROM $DBUserTable WHERE txtUsername='$seshUser' AND hash='$currentPass'");
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
              } if (!$verify) {
              echo ('- Incorrect current password!<br>');
              $error = 1;
            }
        }

          if ($error == 0) {
            $hashed_password = password_hash($newPass, PASSWORD_DEFAULT);
            update("UPDATE $DBUserTable SET hash='$hashed_password' WHERE txtUsername='$seshUser'");
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
                  echo ("You have changed your email to $email");
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
