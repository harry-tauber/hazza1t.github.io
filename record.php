<?php
  session_start();
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

  $DBservername = "localhost";
  $DBusername = "root";
  $DBpassword = "";
  $DBname = "injuryDB";
  $DBtable = "InjuryRecord";

  $type = $_POST['type'];
  $cause = $_POST['cause'];
  $severity = $_POST['severity'];
  $symptoms = $_POST['symptoms'];

  // Create connection.
  $conn = new mysqli($DBservername, $DBusername, $DBpassword, $DBname);

  // Check connection.
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  function query($sql) {
  // Query SQL.
  global $conn;
  $result = $conn->query($sql);
  $array = [];

  if (!$result) {
    die("Query failed: " . $conn->error);
  }

  // Parse the results.
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $array[] = $row;
    }
  }

  // Return the array.
  return $array;
  }
$seshUser = $_SESSION["username"];

query("INSERT INTO $DBtable (txtUsername, txtInjuryType, txtInjuryCause, txtInjurySymptoms, txtInjurySeverity)
VALUES ('$seshUser', '$type', '$cause', '$severity', '$symptoms')");



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
