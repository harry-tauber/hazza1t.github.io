<?php
  session_start();
  require_once 'common.php';



  $seshUser = $_SESSION["username"];
  // Get some session data.
  echo $seshUser;
  // Update some session data.
  /*$_SESSION[“data”] = query(“SELECT * FROM $table2;”);
  // Remove some session data.
  if (isset($_SESSION["password"])) {
  unset($_SESSION["password"]);
  }*/

?>

<!DOCTYPE html>

<?php

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
query("INSERT INTO $DBInjuryTable (txtUsername, txtInjuryType, txtInjuryCause, txtInjurySymptoms, txtInjurySeverity, dateTime)
VALUES ('$seshUser', '$type', '$cause', '$severity', '$symptoms', CURDATE())");


header("Location: viewInjury.php");
}

?>

<html>
    <head>
        <title>Ouch!</title>

        <style type="text/css">

        </style>
    </head>

    <body>
        <script>

        </script>
    </body>
</html>
