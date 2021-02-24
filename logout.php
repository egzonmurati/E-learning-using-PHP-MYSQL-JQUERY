
<?php
session_start();
require_once('connection.php');

$id=$_GET['id'];


   
    $update = mysqli_query($con,"UPDATE register SET online=0 WHERE  id=$id");

   if($update)
{


header("location: index.php");

session_destroy();
}
else
{
echo mysql_error();
}



?>