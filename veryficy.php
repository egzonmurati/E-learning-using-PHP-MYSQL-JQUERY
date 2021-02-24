<?php 
require_once('connection.php');
 if(isset($_GET['vkey'])){
 	$vkey = $_GET['vkey'];

 	$result = mysqli_query($con,"SELECT activationstatus,activationcode FROM register WHERE activationstatus = 0 AND activationcode ='$vkey' LIMIT 1");
 	 $count=mysqli_num_rows($result); 
 	if($count == 1){
 		$update = mysqli_query($con,"UPDATE register SET activationstatus = 1  WHERE activationcode='$vkey' LIMIT 1");
 		if($update ){
 		 echo '<center><div  class="alert alert-success" role="alert">You account has been verified.You my now login!</div></center>';
 		   echo "<center><a  href='http://localhost/school/index.php' class='btn btn-info'>Finish Exam</a></center>";
 			
 		}else{
 			echo mysqli_error();
 		}

 	}else{
 		echo "This account invalid or already verified";
 	}
 }else{
 	die("Something went wrong");
 }


?>