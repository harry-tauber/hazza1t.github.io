<?php
session_start();
require 'common.php';
?>

<!DOCTYPE html>


<html lang="en">
    <head>
      <title>Ouch!</title>

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1" shrink-to-fit=no>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

      <style type="text/css" >
        #pword {
          font-size: 12px;
        }

      </style>
    </head>

    <body>
      <h1>Create account</h1>

      <form action="signUp.php" method='post'>
        First Name:<input type='text' name='first'><br><br>
        Family Name<input type='text' name='last'><br><br>
        Username:<input type='text' name='username'><br><br>
        Email (Optional):<input type='text' name='email'><br><br>
        Date of Birth (Optional):<input type='date' name='dob'><br><br>
        Password:<input type='password' name='password'><br><br>
        Confirm Password:<input type='password' name='confirm'><br>
        <p id='pword'>Password needs to contain 8 letters AND atleast:<br>-One number<br>-One lowercase letter<br>-One uppercase letter</p><br>
        <input name='action' type='submit' value='Sign Up'><br><br>
      </form>


      <?php

      function doSignUp() {

        global $DBUserTable;

        $first = $_POST['first'];
        $last = $_POST['last'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $password = $_POST['password'];
        $confirm = $_POST['confirm'];
        $error = 0;


        if (strlen($password) < 8) {
          echo ("- Password needs to contain atleast 8 characters<br>");
          $error = 1;
        } if( !preg_match("#[0-9]+#", $password ) ) {
          echo ("- Password must include at least one number!<br>");
          $error = 1;
          } if( !preg_match("#[a-z]+#", $password ) ) {
          echo ('- Password must include at least one lowercase letter!<br>');
          $error = 1;
          } if( !preg_match("#[A-Z]+#", $password ) ) {
          echo ('- Password must include at least one CAPS!<br>');
          $error = 1;
          } if ($password != $confirm) {
            echo ('- Passwords did not match<br>');
          $error = 1;
          } if( preg_match("#[@]+#", $username ) ) {
          echo ("- Username can't contain '@'<br>");
          $error = 1;
          }


        $usernames = query("SELECT * FROM $DBUserTable WHERE txtUsername='$username'");
        if ($usernames) {
          echo ('- Username already exists<br>');
          $error = 1;
        }
        $emails = query("SELECT * FROM $DBUserTable WHERE txtEmail='$email'");
        if ($emails) {
          echo ('- Email already exists<br>');
          $error = 1;
        }


        if ($dob < 1900-01-01) {
         echo ('- Please enter a valid age<br>');
          $error = 1;
        }

        if( !preg_match("#['@']+#", $email ) ) {
          echo ('- Invalid Email!<br>');
          $error = 1;
          }


        //Send user information to database
          if ($error == 0) {
            query("INSERT INTO $DBUserTable (txtGivenName, txtFamilyName, txtUsername, txtEmail, dateDOB, txtPassword)
          VALUES ('$first', '$last', '$username', '$email', '$dob', '$password')");
          }
          else die();
      }

      function showMainPage() {
        header("Location: mainInter.php");
      }

     $action = $_POST['action'];

     switch ($action) {
        case 'Sign Up':
            doSignUp();
            showMainPage();
            break;
      }
            ?>


        <script>

        </script>


    </body>
</html>
