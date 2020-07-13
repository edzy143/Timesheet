<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "demo");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$date_entry = mysqli_real_escape_string($link, $_REQUEST['date_entry']);
$project = mysqli_real_escape_string($link, $_REQUEST['projects']);
$details = mysqli_real_escape_string($link, $_REQUEST['details']);
$start_time = mysqli_real_escape_string($link, $_REQUEST['start_time']);
$end_time = mysqli_real_escape_string($link, $_REQUEST['end_time']);
$km = mysqli_real_escape_string($link, $_REQUEST['km']);


$time1 = strtotime($start_time);
$time2 = strtotime($end_time);
$hours_total = abs($time2 - $time1) / 3600;



 
// attempt insert query execution
$sql = "INSERT INTO Times (Dates, Project, Details, StartTime, EndTime, HoursTotal) VALUES ('$date_entry', '$project', '$details', '$start_time', '$end_time', '$hours_total')";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}


 
// close connection
mysqli_close($link);
?>