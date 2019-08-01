<?php

// Setup variables.
$DBservername = "localhost";
$DBusername = "root";
$DBpassword = "";
$DBname = "injuryDB";
$DBUserTable = "UserRecord";
$DBInjuryTable = "InjuryRecord";

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

function update($sql) {
    // Query SQL.
    global $conn;
    $result = $conn->query($sql);
    $array = [];

    if (!$result) {
      die("Query failed: " . $conn->error);
    }

  }
?>
