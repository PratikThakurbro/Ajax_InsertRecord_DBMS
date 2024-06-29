<?php
$s_id =$_POST['updateid'];



$conn1 = mysqli_connect("localhost","root","","crud") or die("connection failed");

$sql = "SELECT * FROM  student WHERE sid = {$s_id}";

$result = mysqli_query($conn1, $sql) ;
$output = "";
if(mysqli_num_rows($result)> 0){

    while($row = mysqli_fetch_assoc($result)){ // ye jo loop hai resul name ke variable chale ga 
    $output =" <tr>
                <td>Name</td>
                <td> 
                <input type= 'text' id='edit-name' value='{$row["sname"]}'>
                <input type= 'text' id='edit-sid' hidden value='{$row["sid"]}'>
                </td>
                     
            </tr>
            <tr>
                <td>Address</td>
                <td> <input type= 'text ' id='edit-ad' value='{$row["saddress"]}''></td>
            </tr>
            <tr>
                <td>S Cord</td>
                <td> <input type= 'text ' id='edit-class' value='{$row["sclass"]}''></td>
            </tr>
            <tr>
                <td>NO</td>
                <td> <input type='text' id='edit-no' value='{$row["sphone"]}''></td>
            </tr>
           <tr>
            <td>
                <input type= 'submit' id='edit-submit' class='save' value='Save'>
            </td>
           </tr>";

    }
        mysqli_close($conn1);

        echo $output; // ye data return ho jai ga return wali file me  ya pe $('#modal-form table').html(data);

}
else{

echo"<h2>no  record found.</h2>";
}

?>
