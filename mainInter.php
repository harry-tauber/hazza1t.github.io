<?php
//Start session
session_start();
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


        <style type="text/css">

           #logout {
               position: absolute;
               right: 0;
             }
            #username {
               position: absolute;
               top: 50;
               right: 0;
             }
           .navbar-logo {
              right: 0;
              left: 0;
          } #username {
              color: aqua;
          }.btn-circle {
            width: 45px;
            height: 45px;
            line-height: 45px;
            text-align: center;
            padding: 0;
            border-radius: 50%;
          }
          .btn-circle i {
            position: relative;
            top: -1px;
          } .btn-circle-lg {
            width: 100px;
            height: 100px;
            line-height: 20px;
            font-size: 1.1rem;
            position: fixed;
            bottom: 10px;
            left: 10px;
          }
            .btn-circle-xl {
            width: 120px;
            height: 120px;
            line-height: 20px;
            font-size: 1.1rem;
          } body {
            background: #f8f8fd;
            color: #514B64;
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

      <div  class="container container-fluid">
        <a href=logout.php><button id="logout" type="button" class="btn btn-primary">Logout</button></a>
      </div>

      <br><br>
      <!--Anchor buttons-->
      <div class='text-center'>
        <a href="recordInjury.php"><button class="btn btn-success btn-circle btn-circle-xl m-1">Add Injury</button></a><br><br>
        <a href="viewInjury.php"><button class="btn btn-warning btn-circle btn-circle-xl m-1">Injury Record</button></a><br><br>
        <a href="settings.php"><button id="settings" class="btn btn-secondary btn-circle btn-circle-lg m-1">Settings</button></a><br>
      </div>
        <script>

        </script>
    </body>
</html>
