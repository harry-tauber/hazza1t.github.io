

<!DOCTYPE html>
<?php
session_start();
?>
<?php




// Setup variables.
$DBservername = "localhost";
$DBusername = "root";
$DBpassword = "";
$DBname = "injuryDB";
$DBtable = "UserRecord";

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

  $first = $_POST['first'];
  $last = $_POST['last'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $dob = $_POST['dob'];
  $password = $_POST['password'];
  $confirm = $_POST['confirm'];


  if (strlen($password) < 8) {
    die ('Password does not meet criteria. Needs to contain 8 letters including atleast one number, one lowercase letter and one uppercase letter');
  } if( !preg_match("#[0-9]+#", $password ) ) {
    die ("Password must include at least one number!");
    } if( !preg_match("#[a-z]+#", $password ) ) {
    die ('Password must include at least one lowercase letter!');
    } if( !preg_match("#[A-Z]+#", $password ) ) {
    die ('Password must include at least one CAPS!');
    } if ($password != $confirm) {
      die ('Passwords did not match!');
    }


  $usernames = query("SELECT * FROM $DBtable WHERE txtUsername='$username'");
  if ($usernames) {
    die ('Username already exists');
  }


  if ($dob < 1900-01-01) {
   die ('Please enter a valid age');
  }

  if( !preg_match("#['@']+#", $email ) ) {
    die ('Invalid Email!');
    }



  //Send user information to database
    query("INSERT INTO $DBtable (txtGivenName, txtFamilyName, txtUsername, txtEmail, dateDOB, txtPassword, txtConfirm)
    VALUES ('$first', '$last', '$username', '$email', '$dob', '$password', '$confirm')");


header("Location: mainInter.php");

}

if ($action == 'Login') {

  $user = $_POST['user'];
  $pass = $_POST['pass'];

 $userData = query("SELECT * FROM $DBtable WHERE txtUsername='$user'");
  if (!$userData) {
    die ('Username does not exist. Please create account');
  }
  elseif($userData[0]["txtPassword"] == $pass){
      echo "Congrats, you're in!";
}
  else {
    die ('Wrong password!');
  }

  //Store some session data
$_SESSION["username"] = $user;
$_SESSION["password"] = $pass;
}
header("Location: mainInter.php");

?>


<html>
    <head>
        <title>Ouch</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" shrink-to-fit=no>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <style type="text/css">

        </style>
    </head>

    <body>

      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </body>
</html>

