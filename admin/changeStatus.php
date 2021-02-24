<?php
require_once('../connection.php');
 if(isset($_POST["id"]) && isset($_POST["check"]))   { 
    $id = $_POST['id'];
    $check = $_POST['check'];

   
    $update = mysqli_query($con,"UPDATE register SET status=$check WHERE  id=$id");

   if($update)
{
header("Location:studentShow.php");
}
else
{
echo mysql_error();
}


   

}
?>