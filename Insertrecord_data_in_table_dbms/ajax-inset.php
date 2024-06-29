
<?php
$s_name = $_POST["sname"];
$s_add = $_POST["add"];
$s_cord = $_POST["cord"];
$s_no = $_POST["no"];

// Database connection
$conn = mysqli_connect("localhost", "root", "", "crud") or die("Connection failed: " . mysqli_connect_error());

// Insert query
$sql = "INSERT INTO student (sname, saddress, sclass, sphone) VALUES ('$s_name', '$s_add', '$s_cord', '$s_no')";

// Execute query
if (mysqli_query($conn, $sql)){
    echo 1; // Insert successful
} else{
    echo 0; // Insert failed
}

// Close connection
mysqli_close($conn);
?>
