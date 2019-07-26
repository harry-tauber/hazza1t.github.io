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
