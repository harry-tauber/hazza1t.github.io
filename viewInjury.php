<?php
//Start the session
session_start();
require 'common.php';
//Check if session username exists, if not, sned to login page
if (!isset($_SESSION["username"])) {
  header ("Location: login.php");
}

// Get some session data.
    $seshUser = $_SESSION["username"];
    echo ('Username: ' . $seshUser);
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Ouch</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" shrink-to-fit=no>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <style type="text/css">
          table {
            border: 1px solid black;
          }
        </style>
    </head>

    <body>

      <?php


      //Create table of injuries
      $rows = query("SELECT * FROM $DBInjuryTable WHERE txtUsername='$seshUser'");

      $table = '<table class="table">';
      $table .= '<tr><th>Type</th><th>Cause</th><th>Symptoms</th><th>Severity</th></tr>';
      foreach ($rows as &$row) {

        $table .= '<tr>' .
                     '<td>' . $row['txtInjuryType'] . '</td>' .
                     '<td>' . $row['txtInjuryCause'] . '</td>' .
                     '<td>' . $row['txtInjurySymptoms'] . '</td>' .
                     '<td>' . $row['txtInjurySeverity'] . '</td>' .
                 '</tr>';
      }
      $table .=  '</table>';

      echo $table;

     /* echo '<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Injuries</button>
        <div id="demo" class="collapse">
          $table
        </div>'*/


      ?>


      <a href="logout.php"><button>Logout</button></a>
        <script>

        </script>
    </body>
</html>
