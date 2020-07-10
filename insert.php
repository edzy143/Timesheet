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
$details = mysqli_real_escape_string($link, $_REQUEST['details']);
$start_time = mysqli_real_escape_string($link, $_REQUEST['start_time']);
$end_time = mysqli_real_escape_string($link, $_REQUEST['end_time']);
 
// attempt insert query execution
$sql = "INSERT INTO Times (Dates, Details, StartTime, EndTime) VALUES ('$date_entry', '$details', '$start_time', '$end_time')";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}


 
// close connection
mysqli_close($link);
?>