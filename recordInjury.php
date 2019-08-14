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
    echo ('Username: ' . $seshUser)
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Record your Injury</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" shrink-to-fit=no>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <style type="text/css">

        </style>
    </head>

    <body>
      <h1>Record your injury</h1>

      <!--Record Injury Form-->
      <form action="recordInjury.php" method="post">
        Injury Type: <input type='text' name='type'><br><br>
        Cause of Injury: <input type='text' name='cause'><br><br>
        Severity of Injury: <input type='text' name='severity'><br><br>
        Symptoms: <input type='text' name='symptoms'><br><br>
        <input name='action' type='submit' value='Record'>
      </form>
        <a href="logout.php"><button>Logout</button></a><br><br>
        <a href='mainInter.php'><button>Home</button></a><br>


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
