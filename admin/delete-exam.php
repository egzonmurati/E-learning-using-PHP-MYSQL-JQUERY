<?php
require_once('../connection.php');
$delete_id = $_POST['id'];
print_r($delete_id);

$sql = "DELETE FROM question_quiz WHERE id = ?";

$stmt = $con->prepare($sql);
$stmt->bind_param('s', $delete_id);

$stmt->execute();


?>