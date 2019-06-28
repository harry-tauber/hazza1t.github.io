<!DOCTYPE html>

<?php
// Setup variables.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "injuryDB";
$table = "students";

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
    <title>Festival of Thinking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <link rel="icon" href="assets/img/cropped-nhs-site-icon-32x32.png" sizes="32x32" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
      /*
      h1, h2 {
        text-align: center;
      }
      */
      .card-header {
        background-color: rgb(4, 54, 115);
        color: white;
      }
      .card-body {
        background-color: rgb(79, 42, 131);
        color: white;
      }
      html, body {
        background-color: rgb(214, 193, 82);
        color: rgb(4, 54, 115);
        height: 100%;
      }
      a {
        color: inherit;
        text-decoration: inherit;
      }
      #main {
        background-color: white;
        min-height: 100%;
      }
    </style>
  </head>

  <body>
    <div id="main" class="container">
      <div class="card">
        <div class="card-header" style="text-align:center">
          <h2>
            NHS Computing
            <small class="text"> Festival of Thinking</small>
          </h2>
        </div>
        <div class="card-body">
          <h5 class="card-subtitle">2019 Semester 1</h5>
          <p class="card-text">
            Welcome to our showcase of NHS Computing projects.
            Please choose a class and student's name to view their final project.
          </p>
        </div>
      </div>

      <button type="button" class="btn btn-primary" onclick="random()">View random student!</button>

      <?php
      $classes = query("SELECT DISTINCT class FROM $table");
      foreach ($classes as $classObj) {
        $classID = $classObj['class'];
        $class = "10$classID";

        // Open the class div.
        echo '
          <a href="#' . $classID . '" data-toggle="collapse">
            <h6 class="mt-4">' . $class . '</h6>
          </a>
          <div class="collapse" id="' . $classID . '">
            <div class="list-group">';

        // Loop through each student.
        $students = query("SELECT * FROM $table WHERE class='$classID'");
        foreach ($students as $student) {
          // Display student link.
          echo '
              <a href="student.php?class=' . $class . '&code=' . $student['code'] .'" class="list-group-item list-group-item-action">
                ' . $student['firstName'] . ' ' . $student['lastName'] . '
              </a>';
        }

        // Close off the div.
        echo '
            </div>
          </div>';
      }
      ?>
    </div>

    <!-- Bootstrap. -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>
      var students = <?php echo json_encode(query("SELECT * FROM $table")); ?>;

      function random() {
        var student = students[Math.floor(Math.random() * students.length)];
        var url = 'student.php?class=10{class}&code={code}'
          .replace('{class}', student.class).replace('{code}', student.code);
        window.open(url, '_blank');
      }
    </script>
  </body>
</html>

<?php
// Close the SQL connection.
$conn->close();
?>
