<?php
require_once('../connection.php');
$delete_id = $_POST['id'];
print_r($delete_id);

$sql = "DELETE FROM cours WHERE id = ?";

$stmt = $con->prepare($sql);
$stmt->bind_param('s', $delete_id);

$stmt->execute();


?>