<?php
session_start();
if (!isset($_SESSION["username"])) {
  header ("Location: login.php");
}


// Get some session data.
$seshUser = $_SESSION["username"];
echo $seshUser;
// Update some session data.
//$_SESSION[“data”] = query(“SELECT * FROM $table2;”);
// Remove some session data.
if (isset($_SESSION["password"])) {
unset($_SESSION["password"]);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Ouch!</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" shrink-to-fit=no>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <style type="text/css">

        </style>
    </head>

    <body>

      <br>
      <div>
        <a href="recordInjury.php"><button class="btn btn-primary btn-lg btn-block">Add Injury</button></a><br>
        <a href="viewInjury.php"><button class="btn btn-primary btn-lg btn-block">Injury Record</button></a><br>
      </div>
      <a href="logout.php"><button>Logout</button></a>
        <script>

        </script>
    </body>
</html>
