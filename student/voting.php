<?php
 session_start();
 require_once('../connection.php');

if(empty($_SESSION['admin'])){
    header('location: ../index.php');
}
if($_SESSION['admin']['role']=='admin'){
    header('location: ../admin/home.php');
}
$id=$_SESSION['admin']['id'];

    if (isset($_POST['vote'])) {
        $vote = $_POST['vote'];
        $sql = "SELECT `id_user` FROM `tbl_poll` WHERE `id_user`='".$id."'";
$result = $con->query($sql);
if($result->num_rows >= 1) {

     echo  '<center><div  class="alert alert-danger" role="alert">Your had already voted!!</div></center>';
} else {
   $sql = "INSERT INTO `tbl_poll` (poll_name,id_user) VALUES (?,?)";
    $stmt = $con->prepare($sql);
  
    $stmt->bind_param('si', $vote,$id);
    if (!empty($errors) || !$stmt->execute()) {
        var_dump($errors, $stmt->error_list); die();
    } else {
      echo '<center><div  class="alert alert-success" role="alert">Your have voted successfully</div></center>';
    }
}
        
    }
?>