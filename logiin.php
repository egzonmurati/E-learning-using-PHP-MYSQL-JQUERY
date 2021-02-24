<?php
session_start();
 require_once('connection.php');
$_SESSION["gabim"] = "";

if(isset($_POST['submit'])){
   

$myusername1=mysqli_real_escape_string($con,$_POST['username']);  //mysqli_real_escape_string(connection, escapestring) connection  Required. Specifies the MySQL connection to use and escapestring  Required. The string to be escaped. Characters encoded are NUL (ASCII 0), \n, \r, \, ', ", and Control-Z. nuk pranon null qasi ...
$mypassword1=mysqli_real_escape_string($con,$_POST['pass']); 
$mypassword=MD5($mypassword1);

$sql="SELECT * FROM register WHERE username='$myusername1' and password='$mypassword'";
$result=mysqli_query($con,$sql);  //Ekzekutimi i SQL kërkesave.
$row=mysqli_fetch_array($result);
 
 $statusi = $row['status'];
 $activationstatus = $row['activationstatus'];


 // mysqli_fetch_array () merr një rresht rezultati si një grup shoqërues , një grup numerik ose të dy. mysqli_fetch_array(result,resulttype)
// $_SESSION['id']=$row['id']; //id e vendosim ne Session Id njejt edhe rolin e qati qe ban login e vendosim ne session 
// $_SESSION['role']=$row['role'];
$count=mysqli_num_rows($result);    //Përdorimi: mysqli_num_rows($dbcon); Tregon sa rekorde të tabelës janë lexuar me ekzekutimin e një urdhëri SELECT.
// nese e bajm print_r($count); rezultati na del 1 sepse vetem nje vetem 1 rekord u lexue qaj qka ka desht me bo login...
if($count > 0)
 
{
  
    $_SESSION['admin']=array(
        'id'=>$row['id'],
        'username'=>$row['username'],
        'password'=>$row['password'],
        'role'=>$row['role']
    );


    $type=$_SESSION['admin']['role'];
    $id=$_SESSION['admin']['id'];

    if ($row['role']=="admin" && $statusi == '0' && $activationstatus == '1')
       { 
          
          header ("location: admin/index.php"); 
      }
      elseif($row['role']=="student" && $statusi == '0' && $activationstatus == '1')
     { 
       $query=mysqli_query($con,"UPDATE register SET status='0',online='1' WHERE username='$myusername1'");
      header ("location: student/index.php"); 
                          
       }
       else{
         session_destroy();
          $_SESSION["gabim"] = "Username ose passwordi gabim...!";
     header ("location: index.php"); 
      $_SESSION["gabim"] = "Username ose passwordi gabim...!";
       }
      
      
}else{
   if(!ISSET($_SESSION['attempt'])){
                $_SESSION['attempt'] = 0;
            }
 
            $_SESSION['attempt'] += 1;
 
            if($_SESSION['attempt'] === 3){
     $query=mysqli_query($con,"UPDATE register SET status='1' WHERE username='$myusername1'");
            echo "<center><label class='text-danger'>Block user</label></center>";
            }

        
           header ("location: index.php"); 
    }
     if (empty($_POST["submit"])) {
        $_SESSION["gabim"] = "Username ose passwordi gabim...!";
    }
 

}



?>