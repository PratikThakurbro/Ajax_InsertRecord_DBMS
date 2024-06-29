<?php

$studentId = $_POST["keyid"];

// Database connection
$conn = mysqli_connect("localhost", "root", "", "crud") or die("Connection failed: " . mysqli_connect_error());

// Insert query
$sql = " DELETE FROM student WHERE sid = {$studentId}";
 if(mysqli_query($conn, $sql)){
    echo 1;
 }
 else { echo 0 ;
 }
// Close connection
mysqli_close($conn);
?>