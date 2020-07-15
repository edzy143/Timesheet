<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$conn = mysqli_connect("localhost", "root", "", "demo");
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
          padding-top: 10px;
          float: left;
        }
        .timestamp{
          padding-top: 40px;
          padding-right: 20px;
          padding-bottom: 20px;
          text-align: right;
          
        }
        #myList{
          position: fixed;
          left: 110px;
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
             <select name="projects" id="projects">
             <?php 
$sql = mysqli_query($conn, "SELECT ProjectNumber FROM Projects");
while ($row = $sql->fetch_assoc()){
  $projno = $row['ProjectNumber'];
echo "<option value=\"$projno\">" . $row['ProjectNumber'] . "</option>";
}
?>
             </select>
          </p></td>
      <td><input type="text" name="details" id="details"></td>
      <td><input type="time" name="start_time" id="startTime"></td>
      <td><input type="time" name="end_time" id="endTime"></td>
      <td></td>
      <td><input type="float" name="km" id="km"></td>
      <td><label><input type="checkbox" value="true"></label></td>
    <td><input type="submit" value="Submit"></td>
    </tr>
    </form>
    <?php

    

$username = $_SESSION['username']; 
$result = mysqli_query($conn,"SELECT * FROM Times WHERE UserName='$username' ORDER BY Dates DESC ");

if (mysqli_num_rows($result) > 0) {
?>

<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
?>
    <tr>
      <th scope="row"><?php echo $row["Dates"]; ?></th>
      <td><?php echo $row["Project"]; ?></td>
      <td><?php echo $row["Details"]; ?></td>
      <td><?php echo $row["StartTime"]; ?></td>
      <td><?php echo $row["EndTime"]; ?></td>
      <td><?php echo $row["HoursTotal"]; ?></td>
      <td><?php echo $row["KM"]; ?></td>
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
}
else{
    echo "No entries for this week";
}
?>


</body>
</html>