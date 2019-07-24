<!DOCTYPE html>

<?php
// Setup variables.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "injuryDB";
$table = "UserRecord";

$first = $_POST['first'];
$last = $_POST['last'];
$username = $_POST['username'];
$email = $_POST['email'];
$dob = $_POST['dob'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$action = $_POST['action'];
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
if ($action == 'Sign Up') {
  if (strlen($password) < 8) {
    die ('Password does not meet criteria. Needs to contain 8 letters including one number, one lowercase letter and atleast one uppercase letter');
  } elseif ($password cont) {
    ;
  } else () {
    ;
  }

  $usernames = query("SELECT * FROM $table WHERE username='$username'");
  if ($usernames) {
    die ('Username already exists');
  }


  //Send user information to database
    $insert = INSERT INTO $table ('txtFamilyName', 'txtGivenName', 'txt')
?>


<html>
    <head>
        <title>Ouch</title>

        <style type="text/css">

        </style>
    </head>

    <body>
        <script>

        </script>
    </body>
</html>


