
<?php
   require_once('../connection.php');

    if (isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['fulltext'])) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $fulltext = $_POST['fulltext'];
        echo  $fulltext;
         echo  $email;
          echo  $fullname;
             $to=$email;
             $subject=$fullname;
             $message = $fulltext;    
             mail($to,$subject,$message); 
        
        
       }
?>