<?php
require_once('../connection.php');
if(isset($_GET['status']))
{
$status1=$_GET['status'];
$online = '1';

$update=mysqli_query($con,"update register set online='$online' where id='$status1' ");
if($update)
{
header ("location: dashboard.php"); 
}
else
{
echo mysql_error();
}
}
?>
