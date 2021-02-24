<?php
 session_start();
 require_once('connection.php');
 require_once('phpmailer/PHPMailerAutoload.php');

 $errorat = ['usernameErr','emailErr','genderErr','dateBErr','passwordErr'];
 foreach ($errorat as $errorM) {
 	$_SESSION[$errorM]="";
 }

  $username = $email = $gender = $dateB = $pwd = '';
 
  if(isset($_POST['submit']))
  {   	
     $username = $_POST['username'];
     $_SESSION["username"]=$username;

     $email  = $_POST['email'];
     $_SESSION["email"]=$email;
 
     $gender =$_POST['gender'];
     $_SESSION["gender"]=$gender;

     $dateB =$_POST['dateB'];

     $_SESSION["dateB"]=$dateB;

     $pwd   = $_POST['password'];
     $password = MD5 ($pwd);


     if (empty($_POST["username"])) {
	 $_SESSION["usernameErr"] = "Username është i nevojshëm";
	 }elseif
	 	(!preg_match("/^[a-zA-Z ]*$/",$username)) {
	      $_SESSION["usernameErr"] = "Username pranohet vetem me fjal"; 
	 } 
	 if (empty($_POST["email"])) {
	 $_SESSION["emailErr"] = "Email është i nevojshëm";
	 }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     $_SESSION["emailErr"] = "Formati i pavlefshëm i emailit";
     }
     if(empty($_POST['dateB'])){
     	$_SESSION["dateBErr"] = "Date është i nevojshëm";
     }
     if(empty($_POST['password'])){
      $_SESSION["passwordErr"] = "Password është i nevojshëm";
     }
     $dob = new DateTime($dateB);
	 $now = new DateTime();
	 $difference = $now->diff($dob);
	 var_dump($difference);
	 $age = $difference->y;
	 $max_age = 20;
	 $min_age = 1;

	 if($age >= $max_age){
	 $_SESSION["dateBErr"] = "Nuk lejohet mosha mbi ".$max_age." vjet"; 
	 }

    $result = mysqli_query($con,"SELECT email FROM register WHERE email ='$email' LIMIT 1");
   $count=mysqli_num_rows($result); 
  if($count == 1){
     $_SESSION["emailErr"] = "Email already taken!";
   }
  
if($_SESSION["usernameErr"] == "" && $_SESSION["emailErr"] == "" && $_SESSION["genderErr"] == "" && $_SESSION["emailErr"] == "" && $_SESSION["passwordErr"] == "")
  {
     $activationcode=md5($email.time());
    
  	 $sql = "INSERT INTO register (username,email,activationcode,gender,date_b,password,role,status)
       VALUES ('$username','$email','$activationcode','$gender','date_b','$password','student','0')";
	   $result = mysqli_query($con, $sql);
     if($result){
$to=$email;
// $msg= "Thanks for new Registration.";   
$subject=" Email Verification";
$message = "Click this link to activate your account. <a href='http://localhost/school/veryficy.php?vkey=$activationcode'>Click here</a>";
        
 mail($to,$subject,$message);   
      header("Location: index.php");
      session_destroy();
           exit;
     }else{
      header("Location: index.php");
     }
   
  }else{
     header("Location: index.php");
  }
	
  	 	
     }


 

?>