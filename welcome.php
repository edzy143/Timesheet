<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}
$conn = mysqli_connect("localhost", "root", "", "demo");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Welcome</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style type="text/css">
    body {
      font: 14px sans-serif;
    }

    .welcome-text {
      padding-top: 10px;
      float: left;
    }

    .timestamp {
      padding-top: 40px;
      padding-right: 20px;
      padding-bottom: 20px;
      text-align: right;

    }
  </style>
</head>


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed  visible-xs-block visible-sm-block visible-md-block" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul id="menu-menu-1" class="nav navbar-nav hidden-md hidden-sm">
      <li><a title="Home" href="welcome.php">Home</a></li>
      <li><a title="Timesheets" href="timesheets.php">Timesheets</a></li>
      <li><a title="Extras" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Extras<span class="caret"></span></a>
        <ul role="menu" class=" dropdown-menu">
          <li><a title="My Projects" href="#">My Projects</a></li>
          <li><a title="Vehicle Booking" href="#">Vehicle Booking</a></li>
          <li><a title="Department Summary" href="#">Department Summary</a></li>

        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="reset-password.php"><span class="glyphicon glyphicon-user"></span> Reset your Password</a></li>
      <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
    </ul>
  </div>
  </div>
</nav>


<body>
  <div class="welcome-text">
    <h1>Welcome, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h1>
  </div>

  <div class="timestamp">
    <?php
    $timestamp = time();
    echo (date("F d, Y h:i:s", $timestamp));
    ?>
  </div>

  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">Month</th>
        <th scope="col">Week</th>
        <th scope="col">Completed</th>
        <th scope="col">Km</th>
        <th scope="col">Hours</th>
        <th scope="col">Saturday</th>
        <th scope="col">Sunday</th>
        <th scope="col">Public Holiday</th>
        <th scope="col">Normal Leave</th>
        <th scope="col">Normal Hours</th>
        <th scope="col">Lunch</th>
      </tr>
    </thead>
    <tbody>

      <?php



      $username = $_SESSION['username'];

    

      $result = mysqli_query($conn, "SELECT * FROM Times WHERE MONTH(Dates) = MONTH(CURRENT_DATE())
      AND YEAR(Dates) = YEAR(CURRENT_DATE()) AND UserName='$username' ORDER BY Dates DESC ");
      $hoursTotal = mysqli_query($conn, "SELECT COUNT(HoursTotal)
      FROM times
      WHERE MONTH(Dates) = MONTH(CURRENT_DATE())
            AND YEAR(Dates) = YEAR(CURRENT_DATE());");
      

      if (mysqli_num_rows($result) > 0) {
      ?>

        <?php

        

        $i = 0;
        while ($row = mysqli_fetch_array($hoursTotal)) {
        ?>
          <tr>
            <th scope="row"><?php echo $hoursTotal ?></th>
            <td></td>
            <td></td>
          </tr>
        <?php
          $i++;
        }
        ?>

    </tbody>
  </table>
<?php
      } else {
        echo "No entries for this week";
      }
?>

</tbody>
</table>


</body>

</html>