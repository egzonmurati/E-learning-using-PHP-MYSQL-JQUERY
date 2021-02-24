<!DOCTYPE>
<html>
 <head>
   <link rel="stylesheet" href="css/loginRegister.css">
   <title>School Dashboard</title>
  
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
        .error {color: #FF0000;}
        

    </style>
 </head>
<body>
<?php
session_start();
require_once('connection.php');
 if(isset($_SESSION["admin"]) ? $_SESSION["admin"]['role']=='admin':''){
        header('location: admin/home.php');
    }
    if(isset($_SESSION["admin"]) ? $_SESSION["admin"]['role']=='student':''){
        header('location: student/dashboard.php');
    }

?>
<div class="cointainer">


 
    <div class="welcome__content">
     <header>
     	   <h5>If you have account</h5> 
		<div class="btn1" id="welcome-btn">Login</div>
     </header>
		 <img src="img/Logo.png">
    <!--  Krijimi i formes per Regjistrimin  -->
       <form action="register.php" method="POST">
      <input placeholder="User Name" type="text" name="username" value="<?php echo isset($_SESSION["username"]) ? $_SESSION["username"]:''; ?>">  <!-- Kjo eshte per session nese shkruhet username me na rujt. edhe me rregullon isset session per kur bahet reload page mu kan ne rregull -->
      <span class="error"><?php  echo  isset($_SESSION["usernameErr"]) ? $_SESSION["usernameErr"]:''; ?></span>
       <br><br>
     <input type="text" name="email" placeholder="Email Addres" value="<?php echo isset($_SESSION["email"]) ? $_SESSION["email"]:''; ?>"><br>
      <span class="error"><?php  echo  isset($_SESSION["emailErr"]) ? $_SESSION["emailErr"]:''; ?></span>
       <br><br>
     <label class="radio-inline"><input type="radio" name="gender" value="Male">Male</label>
     <label class="radio-inline"><input type="radio" name="gender" value="Female">Female</label>
    <input type="date" name="dateB" class="form-control"  value="<?php echo isset($_SESSION["dateB"]) ? $_SESSION["dateB"]:''; ?>"><br>
      <span class="error"><?php  echo  isset($_SESSION["dateBErr"]) ? $_SESSION["dateBErr"]:''; ?></span>
       <br><br>
    <input type="password" id="lname" name="password" placeholder="Password"><br>
    <span class="error"><?php  echo  isset($_SESSION["passwordErr"]) ? $_SESSION["passwordErr"]:''; ?></span>
       <br><br>
    <input type="submit" name="submit" value="Register">
  </form>
 

</div>
  
     <div class="form__content">
    <header>
      <h5>Don't have an account.</h5> 
    <div class="btn1" id="form-btn">Register</div> 
    </header>
       
         <span  class="error"> <?php  echo isset($_SESSION["gabim"]) ? $_SESSION["gabim"]:''; ?></span>
    
     <img src="img/Logo.png">
    
          <form action="logiin.php" method="POST">
            <span class="error"><?php  echo  isset($_SESSION["usernameErr"]) ? $_SESSION["usernameErr"]:''; ?></span>
            <input type="text"  name="username" placeholder="Email Addres"><br>
      
            <input type="password"  name="pass" placeholder="Password"><br>
            
            <input type="submit" name="submit" value="Sign In">


          </form>
        <span class="text-danger"><?php if (isset($error_message)) { echo $error_message; } ?></span>
       </div>

</div>
 
 <script src="js/welcome.js"></script>

</body>


</html>
</html>

<?php
$vargu=array("username","email","gender","dateB","password","usernameErr","emailErr","genderErr","dateBErr","passwordErr");
foreach($vargu as $element)
    $_SESSION[$element]="";

    ?>
    <?php 

    $_SESSION["gabim"] = "";
    ?>
