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

      <!--Sign Up form-->
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


      /**
       *
       * @returns
       */
      function doSignUp() {

        global $DBUserTable;

        //Set variables
        $first = $_POST['first'];
        $last = $_POST['last'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm = $_POST['confirm'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];

        $error = 0;

        if (empty($first) || empty($last) || empty($username) || empty($password) || empty($confirm)) {
              echo "You did not fill out the required fields.<br>";
              $error = 1;
          }

        //Password paramters
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

          //Username cant contain @
          } if( preg_match("#[@]+#", $username ) ) {
          echo ("- Username can't contain '@'<br>");
          $error = 1;
          }

        if ($error == 0) {
        $usernames = query("SELECT * FROM $DBUserTable WHERE txtUsername='$username'");
        if ($usernames) {
          echo ('- Username already exists<br>');
          $error = 1;
        }
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


        //Send user information to database
          if ($error == 0) {

            $algo = PASSWORD_BCRYPT;

          /*  $options = array(
              'salt' => mcrypt_create_iv(10, MCRYPT_DEV_URANDOM),
              'cost' => 10,
            );*/
            password_hash( $password, $algo, [ $options ] );

            $password_hash = password_hash($password_string, PASSWORD_BCRYPT, $options);

            $password_string = $password;

            $password_hash = password_hash($password_string, PASSWORD_BCRYPT);

            query("INSERT INTO $DBUserTable (txtGivenName, txtFamilyName, txtUsername, txtEmail, dateDOB, txtPassword, hash)
          VALUES ('$first', '$last', '$username', '$email', '$dob', '$password', '$password_hash')");
          }
          else die();
      }


      /*function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }*/




      function showMainPage() {
        header("Location: mainInter.php");
      }

       if (isset($_POST['action'])) {
     $action = $_POST['action'];

     //Switch
     switch ($action) {
        case 'Sign Up':
            doSignUp();
            showMainPage();
            //generateRandomString();
            break;
      }
       }
            ?>


        <script>

        </script>


    </body>
</html>
