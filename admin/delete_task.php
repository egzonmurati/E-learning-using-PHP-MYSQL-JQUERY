<?php
require_once('../connection.php');
$delete_id = $_POST['id'];
var_dump($delete_id);
    
$sql = "DELETE FROM task WHERE id_task = ?";

$stmt = $con->prepare($sql);
$stmt->bind_param('s', $delete_id);

$stmt->execute();


?>