

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
          input[type=text], input[type=password] {
          padding: 15px;
          margin: 5px 0 22px 0;
          display: inline-block;
          border: none;
          background: #f1f1f1;
        } input[type=text]:focus, input[type=password]:focus {
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
        .signup {
          padding: 14px 20px;
          background-color: lightcoral;
          position: fixed;
          bottom: 10px;
          left: 10px;


        }
          .login {
            padding: 14px 20px;
          background-color: lightgreen;
}
          form {
            display: inline-block;
          }
          body {
            text-align: center;
          } #ouch {
            top: 5px;
            left: 5px;
}

     </style>
    </head>

    <body>
          <img id='ouch' src='images/ouch.png' alt="Test" height="100" width="140"/>

      <h1 class="page-header">Login</h1>

        <!--Login Form-->

        <form action='login.php' method="post">

            <label for='user'>Username or email:</label>
            <br><input type='text' name='user' id='user' placeholder='Username or email'><br>
            <label for='pass'>Password:</label>
            <br><input type='password' name='pass' id='pass' placeholder="Password"><br>

           <input class='login' name='action' type='submit' value='Login'><br><br><br>
        </form><br>

        <a href='signUp.php'><button class='signup'>OR Create an account</button></a>

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

          if ($error == 0) {

            $hashedPass = $userData[0]["hash"];
            $verify = password_verify($pass, $hashedPass);

            if ($verify != $pass) {
            $error = 1;
            echo ('Wrong password!');
          }
            }
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
