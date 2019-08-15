<?php
//Star the Session
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
        <title>Record your Injury</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" shrink-to-fit=no>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <style type="text/css">
           form {
            display: inline-block;
          }
          body {
            text-align: center;
          }
             .record {
          padding: 14px 20px;
          background-color: lightgreen;

        }
          .home {
            padding: 14px 20px;
          background-color: oldlace;
          } html {
            overflow: hidden;
          }    .home{
            position: absolute;
          bottom: 10px;
          left: 10px;
          } #logout{
            position: absolute;
            bottom: 10px;
            right: 10px;
            padding: 14px 20px;
            background-color: lightcoral;
          }
          body {
  background: #f8f8fd;
  color: #514B64;
          }
        </style>
    </head>

    <body>
       <div class="navbar">
          <img src='images/ouch.png' alt="Test" height="120" width="200"/>
          <?php
          echo ("<h3>" . 'Username: ' . $seshUser . "</h3>");
          ?>
      </div>



      <h1>Record your injury</h1>

      <!--Record Injury Form-->
      <form action="recordInjury.php" method="post">

        <label for='type'>Injury Type:</label><br>
        <input type='text' name='type' id='type' placeholder='Injury Type'><br><br>
        <label for='cause'>Cause of Injury:</label><br>
        <input type='text' name='cause' id='cause' placeholder='Cause of Injury'><br><br>
        <label for='severity'>Severity of Injury: </label><br>
        <input type='text' name='severity' id='cause' placeholder='Severity of Injury'><br><br>
        <label for='symptoms'>Symptoms:</label><br>
        <input type='text' name='symptoms' id='symptoms' placeholder='Symptoms'><br><br>
        <input name='action' type='submit' value='Record' class='record'><br><br>



      </form>
      <a href="logout.php"><button id='logout'>Logout</button></a><br><br>
      <a href='mainInter.php'><button class='home'>Home</button></a><br>



      <?php


      function recordInjury() {
      global $DBInjuryTable;
        $error = 0;

        $type = $_POST['type'];
        $cause = $_POST['cause'];
        $severity = $_POST['severity'];
        $symptoms = $_POST['symptoms'];

        $seshUser = $_SESSION["username"];

        if (empty($type) || empty($cause)) {
                    echo "You did not fill out the required fields.<br>";
                    $error = 1;
                }

      if ($error == 0) {
      query("INSERT INTO $DBInjuryTable (txtUsername, txtInjuryType, txtInjuryCause, txtInjurySymptoms, txtInjurySeverity)
      VALUES ('$seshUser', '$type', '$cause', '$severity', '$symptoms')");


      header("Location: viewInjury.php");
      }
    }

    if (isset($_POST['action'])) {
      $action = $_POST['action'];

        switch ($action) {
          case 'Record':
            recordInjury();
            break;
  }
      }
?>





        <script>

        </script>
    </body>
</html>
