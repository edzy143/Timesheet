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
    <title>Timesheets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        body{ font: 14px sans-serif;}
        .week-header{
          padding-top: 40px;
          float: left;
        }
        .timestamp{
          padding-top: 80px;
          padding-right: 20px;
          padding-bottom: 20px;
          text-align: right;
          
        }
        #myList{
          position: fixed;
          left: 110px;
        }
        .main-details{
          padding-left: 7px;
        }
    </style>
</head>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Timesheets</a>
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
  <div class="week-header">
        <h1>Week <b>
        <?php 
        echo " " . date("W"); ?>
        </b>
        </h1>
  </div>

  <div class="timestamp">
        <?php 
        $timestamp = time();
        echo(date("F d, Y h:i:s", $timestamp));
        ?>
  </div>

  <div class="main-details">

  <form>
       <fieldset>
          <p>
             <label>Year/Month</label>
             <select id = "myList">
               <option value = "1">07/20</option>
               <option value = "2">08/20</option>
               <option value = "3">09/20</option>
               <option value = "4">10/20</option>
             </select>
          </p>
          <p>
             <label>Week</label>
             <select id = "myList">
               <option value = "1">07/20</option>
               <option value = "2">08/20</option>
               <option value = "3">09/20</option>
               <option value = "4">10/20</option>
             </select>
          </p>
       </fieldset>
    </form>
  </div>


    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Project</th>
      <th scope="col">Details</th>
      <th scope="col">Start Time</th>
      <th scope="col">End Time</th>
      <th scope="col">Hours</th>
      <th scope="col">Km</th>
      <th scope="col">Charge</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <form action="insert.php" method="post">
    <tr>
      <th scope="row"><input type="date" name="date_entry" id="dateEntry"></th>
      <td><p>
             <select >
               <option value = "1">31080.1</option>
               <option value = "2">31080.2</option>
               <option value = "3">31080.3</option>
               <option value = "4">31080.4</option>
             </select>
          </p></td>
      <td><input type="text" name="details" id="details"></td>
      <td><input type="time" name="start_time" id="startTime"></td>
      <td><input type="time" name="end_time" id="endTime"></td>
      <td></td>
      <td></td>
      <td><label><input type="checkbox" value="true"></label></td>
    <td><input type="submit" value="Submit"></td>
    </tr>
    </form>
    
  </tbody>
</table>
    

</body>
</html>