<?php
session_start();
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
<?php

  $DBservername = "localhost";
  $DBusername = "root";
  $DBpassword = "";
  $DBname = "injuryDB";
  $DBtable = "InjuryRecord";

  // Create connection.
    $conn = new mysqli($DBservername, $DBusername, $DBpassword, $DBname);

    // Check connection.
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

?>
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

      $userData = query("SELECT * FROM $DBtable WHERE txtUsername='$seshUser'");

      $table = '<tr><th>Type</th><th>Cause</th><th>Symptoms</th><th>Severity</th>';
      echo $table;



        /*echo
          "<table>
            <tr>
              <th>Type</th>
              <th>Cause</th>
              <th>Symptoms</th>
              <th>Severity</th>
            <tr>
            <tr>
              <td>$userData<td>
            <tr>
           </table>";*/

      // Build a table to display the results.
               /* var out = '<tr><th>Type</th><th>Duration</th><th>Date</th><th>Time</th><th>Name</th><th>Priority</th>';
                result.forEach(function(row) {
                    out += '<tr><td>' + row['tskType'] + '</td><td>' + row['tskDuration'] + '</td><td>' + row['tskDate'] + '</td><td>' + row['tskTime'] + '</td><td>' + row['tskName'] + '</td><td>' + row['tskPriority']  + '</td></tr>';
                });

                // Update the table on the page.
                document.getElementById("table").innerHTML = out;
            }

            // Query the database when the window first loads.
            window.onload = query;*/




      ?>

      <a href="logout.php"><button>Logout</button></a>
        <script>

        </script>
    </body>
</html>
