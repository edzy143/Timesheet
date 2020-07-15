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


<nav class="navbar fixed-top navbar-inverse bg-primary navbar-toggleable-sm navbar-static-top">
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

    
      $weekm2= mysqli_query($conn, "SELECT DISTINCT WEEK(Dates)+1 FROM times WHERE MONTH(Dates) = MONTH(CURRENT_DATE()) AND YEAR(Dates) = YEAR(CURRENT_DATE()) AND UserName= 'eduard' AND WEEK(Dates) = WEEK(CURDATE());");
      $monthm2= mysqli_query($conn, "SELECT DISTINCT MONTH(Dates) FROM times WHERE MONTH(Dates) = MONTH(CURRENT_DATE()) AND YEAR(Dates) = YEAR(CURRENT_DATE()) AND UserName= 'eduard' AND MONTH(Dates) = MONTH(CURDATE());");
      $hourstotm2= mysqli_query($conn, "SELECT SUM(HoursTotal)FROM times WHERE MONTH(Dates) = MONTH(CURRENT_DATE()) AND YEAR(Dates) = YEAR(CURRENT_DATE()) AND UserName='$username';");
      $satm2= mysqli_query($conn, "SELECT SUM(HoursTotal)FROM times WHERE MONTH(Dates) = MONTH(CURRENT_DATE()) AND YEAR(Dates) = YEAR(CURRENT_DATE()) AND UserName='$username' AND WEEKDAY(Dates)= 5 AND WEEK(Dates) = WEEK(CURDATE());" );
      $sunm2= mysqli_query($conn, "SELECT SUM(HoursTotal)FROM times WHERE MONTH(Dates) = MONTH(CURRENT_DATE()) AND YEAR(Dates) = YEAR(CURRENT_DATE()) AND UserName='$username' AND WEEKDAY(Dates)= 6 AND WEEK(Dates) = WEEK(CURDATE());" );

      $row0 = mysqli_fetch_array($monthm2);
      $row1 = mysqli_fetch_array($weekm2);
      $row4 = mysqli_fetch_array($hourstotm2);
      $row5 = mysqli_fetch_array($satm2);
      $row6 = mysqli_fetch_array($sunm2);
      if (mysqli_num_rows($weekm2) > 0) {
      ?>

          <tr>
            <th scope="row"><?php echo $row0[0]?></th>
            <td><?php echo $row1[0]?></td>
            <td></td>
            <td></td>
            <td><?php echo $row4[0]?></td>
            <td><?php echo $row5[0]?></td>
            <td><?php echo $row6[0]?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

         




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