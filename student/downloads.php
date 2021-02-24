<?php 

require_once('../connection.php');
if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];
     echo $id;
    // fetch file to download from database
    $sql = "SELECT * FROM task WHERE id_task=$id";
    $result = mysqli_query($con, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = '../admin/uploads/' . $file['pdf_file'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $file['pdf_file']));
        readfile('../admin/uploads/' . $file['pdf_file']);

        // Now update downloads count
      
        exit;
    }

}

