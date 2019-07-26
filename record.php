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

$insertSQL = query("INSERT INTO $DBtable ('txtInjuryType', 'txtInjuryCause', 'txtInjurySymptoms', 'txtInjurySeverity')           VALUES ('$type', '$cause', '$severity', '$symptoms')");

echo $insertSQL;

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
