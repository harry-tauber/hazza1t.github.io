<?php
session_start();
?>

<!DOCTYPE html>

<?php
  //$_SESSION["username"] =
?>
<html lang="en">
    <head>
      <title>Ouch!</title>

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1" shrink-to-fit=no>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

      <style type="text/css" >

        </style>
    </head>

    <body>
      <h1>Create account</h1>

      <form action="check.php" method='post'>
        First Name:<input type='text' name='first'><br><br>
        Family Name<input type='text' name='last'><br><br>
        Username:<input type='text' name='username'><br><br>
        Email (optional):<input type='text' name='email'><br><br>
        Date of Birth (optional):<input type='date' name='dob'><br><br>
        Password:<input type='password' name='password'><br><br>
        Confirm Password:<input type='password' name='confirm'><br><br><br>
        <input name='action' type='submit' value='Sign Up'>
      </form>


        <script>
        </script>


    </body>
</html>
