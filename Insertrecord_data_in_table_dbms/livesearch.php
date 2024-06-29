<?php
$search_value = $_POST["search_value"];

$conn1 = mysqli_connect("localhost","root","","crud") or die("connection failed");

$sql = "SELECT * FROM  student WHERE sname LIKE '%{$search_value}%' OR sclass LIKE '%{$search_value}%'";

$result = mysqli_query($conn1, $sql) or die("sql query faild");
$output = "";
if(mysqli_num_rows($result)> 0){

    // while($row = mysqli_fetch_assoc($result)){ // ye jo loop hai resul name ke variable chale ga 
        $output ="<table border ='1' width='100%' cellspacing='0' cellpadding='10px'
        <tr id='table-color'>
        <th width='100px'>Id</th>
        <th >Student Nmae</th>
        <th > Address</th>
        <th >Subject-Cord</th>
        <th >Phone No</th>
        <th width='100px'>Edit</th>
        <th width='100px'>Delete</th>
        </tr>";
    
        while($row = mysqli_fetch_assoc($result)){ // ye jo loop hai resul name ke variable chale ga 
            $output .= "<tr>
            <td>{$row['sid']}</td>
            <td>{$row['sname']}</td>
            <td>{$row['saddress']}</td> 
            <td>{$row['sclass']}</td>
            <td>{$row['sphone']}</td>
            <td aling='center'><button class='edit-butn' 
            data-edit='{$row["sid"]}'>Edit</button></td>
            
            <td><button class='delete-butn' 
            data-id='{$row["sid"]}'>Delete</button></td>
            </tr>";
        }
            $output .= "</table>";
            mysqli_close($conn1);
    
            echo $output; // ye data return ho jai ga return wali file me
    }else{
        echo "<h2>Sorry Not Found</h2>";
    }
  


?>

