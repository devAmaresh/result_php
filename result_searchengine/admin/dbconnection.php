<?php
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="ischool";
$db_port="3307";

$conn=mysqli_connect($db_host,$db_user,$db_pass,$db_name,$db_port);
if(!$conn){
    echo "Connection not successfull";
}
// else{
//     echo "Connection successfull";
// }
?>
