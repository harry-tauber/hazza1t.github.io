

<!DOCTYPE html>
<?php
// Start the session
session_start();
require 'common.php';
?>
<html>
    <head>
        <title>Login to Ouch!</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" shrink-to-fit=no>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <style type="text/css">

        </style>
    </head>
  <h1 class="page-header">Login</h1>

  <!--Login Form-->
  <form action='login.php' method="post">
    Username or Email:<br><input type='text' name='user'><br><br>
    Password:<br><input type='password' name='pass'><br><br>
    <input name='action' type='submit' value='Login'>
  </form>

    <body>

      <?php

      /**
       *
       * @returns
       */
      function doLogin() {

        global $DBUserTable;

        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $error = 0;

        if (empty($user) || empty($pass)) {
              echo "You did not fill out the required fields.<br>";
              $error = 1;
          }

        //Check if username or email exists
        $userData = query("SELECT * FROM $DBUserTable WHERE txtUsername='$user' OR txtEmail='$user'");
            if (!$userData) {
              echo ('Username or Email does not exist. Please create account');
              $error = 1;
            }

        /*$hash = $userData[0]["hash"];
        password_verify( $pass, $hash );
        echo $hash;*/

        $password_string = $pass;
        $password_hash = $userData[0]["hash"];


        if (password_verify($password_string, $password_hash)) {
          // Correct password
        } else {
          $error = 1;
          echo ('Wrong password!');
        }




       /*if ($error == 0) {
        if($userData[0]["txtPassword"] == $pass) {
      }
        else {

          $error = 1;
        }
        }*/

        //Store some session data
      if ($error == 0) {
        $_SESSION["username"] = $userData[0]["txtUsername"];
      } else die();
      }



        function showMainPage() {
         header("Location: mainInter.php");
      }

      if (isset($_POST['action'])) {

      $action = $_POST['action'];

      //Switch
      switch ($action) {
        case 'Login':
            doLogin();
            showMainPage();
            break;
      }
      }
      ?>

        <script>

        </script>
    </body>
</html>
