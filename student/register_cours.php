
<?php
   require_once('../connection.php');

    if (isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];
        $course_id = $_POST['course_id'];
        $look = mysqli_query($con,"SELECT * FROM cours_register WHERE id_user='$user_id'");
        $rows=mysqli_num_rows($look); 
        if($rows > 2){
            
             echo "<center><div  class='alert alert-danger' role='alert'>Now you register a course!!</div></center>";
        }else{
            $insertdata = " INSERT INTO cours_register (id_cours,id_user) VALUES( '".$course_id."','".$user_id."' ) ";
        mysqli_query($con, $insertdata);
        if($insertdata){
             echo "<center><div  class='alert alert-success' role='alert'>Course register successfully</div></center>";
        }
        }
        
    }
?>