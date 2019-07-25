<!DOCTYPE html>

<?php
//Start the session
session_start();

/*Store some session data
$_SESSION[""] = "";
$_SESSION[""] = "";*/

// Setup variables.
$DBservername = "localhost";
$DBusername = "root";
$DBpassword = "";
$DBname = "injuryDB";
$DBtable = "UserRecord";

$first = $_POST['first'];
$last = $_POST['last'];
$username = $_POST['username'];
$email = $_POST['email'];
$dob = $_POST['dob'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$action = $_POST['action'];

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
if ($action == 'Sign Up') {
  if (strlen($password) < 8) {
    die ('Password does not meet criteria. Needs to contain 8 letters including atleast one number, one lowercase letter and one uppercase letter');
  } if( !preg_match("#[0-9]+#", $password ) ) {
    die ("Password must include at least one number!");
    } if( !preg_match("#[a-z]+#", $password ) ) {
    die ('Password must include at least one letter!');
    } if( !preg_match("#[A-Z]+#", $password ) ) {
    die ('Password must include at least one CAPS!');
    } if ($password != $confirm) {
      die ('Passwords did not match!');
    }


  $usernames = query("SELECT * FROM $DBtable WHERE txtUsername='$username'");
  if ($usernames == 1) {
    die ('Username already exists');
  }

  /*if ($dob < ) {
   ;
  }

  if ($email )*/


  //Send user information to database
    $insertSQL = <<<EOT

    INSERT INTO $DBtable (txtGivenName, txtFamilyName, txtUsername, txtEmail, dateDOB, txtPassword, txtConfirm)
    VALUES (
    $first,
    $last,
    $username,
    $email,
    $dob,
    $password,
    $confirm
    );
    EOT;

  echo $insertSQL;
}
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


