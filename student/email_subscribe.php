

<?php
   require_once('../connection.php');

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $look = mysqli_query($con,"SELECT * FROM subscribe WHERE email='$email'");
        $rows=mysqli_num_rows($look); 
        if($rows > 0){
            
             echo "<center><div  class='alert alert-danger' role='alert'>You are Subscribe!!</div></center>";
        }else{
            $insertdata = " INSERT INTO subscribe (email) VALUES( '".$email."') ";
        mysqli_query($con, $insertdata);
        if($insertdata){
           
             $to=$email;
             $subject=" Email Subscribe";
             $msg = "Thank for you"; 
             $message = "You are Subscribe successfully!";    
             mail($to,$subject,$msg,$message); 
               echo "<center><div  class='alert alert-success' role='alert'>Subscribe successfully</div></center>";
        }
        }
        
    }
?>