<?php
require_once('../connection.php');

 	        $edit_id = $_POST["edit_id"];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $startDate = $_POST['startDate'];
            $finishDate = $_POST['finishDate'];
            $price = $_POST['price'];
            $content = $_POST['content'];
           var_dump($edit_id );
      
       $query = "UPDATE cours SET title = '".$title."' , description = '".$description."' , startDate = '".$startDate."' , finishDate = '".$finishDate."' , price = '".$price."' , content = '".$content."' WHERE id = '".$edit_id."' ";  
      $result = mysqli_query($con, $query);  
     
      
 
  
?>