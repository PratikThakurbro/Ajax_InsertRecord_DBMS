<?php
$studentId = $_POST["key_id"];
$s_name = $_POST["s_name"];
$s_add = $_POST["s_address"];
$s_class = $_POST["s_class"];
$s_no = $_POST["s_no"];

// Database connection
$conn = mysqli_connect("localhost", "root", "", "crud") or die("Connection failed: " . mysqli_connect_error());

// Insert query
$sql = " UPDATE student SET sname= '{$s_name}', saddress = '{$s_add}', sclass = '{$s_class}', sphone = '{$s_no}'  WHERE sid = {$studentId}";

 if(mysqli_query($conn, $sql)){
    echo 1;
 }  
 else {
     echo 0 ;
 }
// Close connection
mysqli_close($conn);
?>