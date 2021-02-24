<?php
session_start();
 require_once('../connection.php');

 

 	     $id   = $_POST['id'];

   
    $sql = "UPDATE register SET status=? WHERE id=?";

    $stmt = $con->prepare($sql);
    $status = '1';
    $stmt->bind_param('si', $status, $id);
    $success = $stmt->execute();

$stmt->close();
      

      
?>

