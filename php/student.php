<!DOCTYPE html>

<?php
// Get variables sent by GET.
if (!isset($_GET['class']) || !isset($_GET['code'])) {
  die('Invalid class and/or code.');
}
$class = $_GET['class'];
$classID = substr($class, 2);
$code = $_GET['code'];
$studentDir = "$class/$code";

// Setup variables.
$servername = "localhost";
$username = "showcase";
$password = "showcase";
$dbname = "showcase";
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

$student = query("SELECT * FROM $table WHERE class='$classID' AND code='$code'")[0];
$studentName = $student['firstName'] . ' ' . $student['lastName'];
?>

<html>
  <head>
    <title>Festival of Thinking - Student</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <link rel="icon" href="assets/img/cropped-nhs-site-icon-32x32.png" sizes="32x32" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
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
      h3 {
        text-align: center;
      }
      #main {
        background-color: white;
        min-height: 100%;
      }
      .carousel-control-prev-icon {
       background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23222' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E") !important;
      }
      .carousel-control-next-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23222' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E") !important;
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
            <?php
            echo "$class: $studentName";
            ?>
          </p>
        </div>
      </div>

      <h3>Final Project</h3>
      <p style="text-align: center">
        <?php
        $trinket = $student['trinket'];
        if ($trinket) {
          echo '
            <a href="python.php?trinket=' . $trinket . '">
              View the final project (CAT 3) here
            </a>';
        } else if (file_exists("$studentDir/index.html")) {
          echo '
            <a href="' . $studentDir . '/">
              View the final project (CAT 3) here
            </a>';
        } else {
          echo 'Sorry, no submission was found.';
        }
        ?>
      </p>

      <?php
      $appFile = glob("$studentDir/*.apk");
      if ($appFile) {
        echo '
          <h3>App Inventor</h3>
          <p style="text-align: center">
            <a href="' . $appFile[0] . '" download>
              Download .apk (For Android phones only)
            </a>
          </p>';
      }
      ?>

      <?php
      $imgs = glob("$studentDir/*.{jpg,jpeg,png}", GLOB_BRACE);

      if ($imgs) {
        // Start the carousel.
        echo '
          <h3>Design Booklet Highlights</h3>
          <div class="row justify-content-center">
          <div class="col-md-10">
          <div id="carousel" class="carousel slide border" data-ride="carousel">
            <ol class="carousel-indicators">';

        // Build indicators.
        $firstImg = ' class="active"';
        foreach ($imgs as $i=>$img) {
          echo '
              <li data-target="#carousel" data-slide-to="' . $i . '"' . $firstImg . '></li>';
          $firstImg = '';
        }

        // Continue the carousel.
        echo '
            </ol>
            <div class="carousel-inner">';

        // Build individual images.
        $firstImg = ' active';
        foreach ($imgs as $i=>$img) {
          echo '
              <div class="carousel-item' . $firstImg . '">
                <img class="d-block w-100" src="' . $img . '" alt="Slide ' . $i . '">
              </div>';
          $firstImg = '';
        }

        // Finish the carousel.
        echo '
            </div>
            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
          </div></div>';
      }
      ?>
    </div>

    <!-- Bootstrap. -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>
    </script>
  </body>
</html>

<?php
// Close the SQL connection.
$conn->close();
?>
