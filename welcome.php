<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
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
        body{ font: 14px sans-serif;}
        .welcome-text{
          padding-top: 40px;
          float: left;
        }

        .timestamp{
          padding-top: 80px;
          padding-right: 20px;
          padding-bottom: 20px;
          text-align: right;
          
        }
    </style>
</head>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="welcome.php">Timesheets</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="welcome.php">Home</a></li>
      <li><a href="timesheets.php">Timesheets</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Extras
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Department Summary</a></li>
          <li><a href="#">My Projects</a></li>
          <li><a href="#">Overtime</a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="reset-password.php"><span class="glyphicon glyphicon-user"></span> Reset your Password</a></li>
      <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
    </ul>
  </div>
</nav>


<body>
<div class="welcome-text">
        <h1>Welcome, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h1>
    </div>

    <div class="timestamp">
        <?php 
        $timestamp = time();
        echo(date("F d, Y h:i:s", $timestamp));
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
    <tr>
      <th scope="row">May-20</th>
      <td>Mon 4 May - Sun 10 May</td>
      <td><label><input type="checkbox" value="true"></label></td>
      <td>0</td>
      <td>48</td>
      <td>8</td>
      <td>0</td>
      <td>4</td>
      <td>3</td>
      <td>160</td>
      <td>6</td>
    </tr>
    <tr>
      <th scope="row">May-20</th>
      <td>Mon 4 May - Sun 10 May</td>
      <td><label><input type="checkbox" value="true"></label></td>
      <td>0</td>
      <td>48</td>
      <td>8</td>
      <td>0</td>
      <td>4</td>
      <td>3</td>
      <td>160</td>
      <td>6</td>
    </tr>
    <tr>
      <th scope="row">May-20</th>
      <td>Mon 4 May - Sun 10 May</td>
      <td><label><input type="checkbox" value="true"></label></td>
      <td>0</td>
      <td>48</td>
      <td>8</td>
      <td>0</td>
      <td>4</td>
      <td>3</td>
      <td>160</td>
      <td>6</td>
    </tr>
    <tr>
      <th scope="row">May-20</th>
      <td>Mon 4 May - Sun 10 May</td>
      <td><label><input type="checkbox" value="true"></label></td>
      <td>0</td>
      <td>48</td>
      <td>8</td>
      <td>0</td>
      <td>4</td>
      <td>3</td>
      <td>160</td>
      <td>6</td>
    </tr>
  </tbody>
</table>
    

</body>
</html>