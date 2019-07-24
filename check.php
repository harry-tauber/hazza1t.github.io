<!DOCTYPE html>

<?php
// Setup variables.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "injuryDB";
$table = "User Record";

echo $_POST['first'];
// Create connection.
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection.
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

function query($sql) {
  // Query SQL.
  global $conn;
  $result = $conn->query($sql);

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

// $students = query("SELECT * FROM $table");
?>


<html>
    <head>
        <title>YOUR TITLE GOES HERE</title>

        <style type="text/css">

        </style>
    </head>

    <body>
        <script>

        </script>
    </body>
</html>


