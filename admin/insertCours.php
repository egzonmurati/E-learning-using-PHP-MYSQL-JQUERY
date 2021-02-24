<?php
session_start();
 require_once('../connection.php');

    list($titleCours1, $price1, $startCours1, $finishCours1,$image_name, $description1, $content1) = array_values($_POST);

    $sql = "INSERT INTO `cours` (title, description, startDate, finishDate,image, price, content) VALUES (?, ?, ?,?, ?, ?, ?)";
    // $today = date('y-m-d H:s:i', time());
    // $startdate = date('Y-m-d'); // current date
    // $enddate = date('Y-m-d', strtotime(' + 3 week')); // date 3 week
    $stmt = $con->prepare($sql);

    $values = [$titleCours1, $description1, $startCours1, $finishCours1,$image_name, $price1, $content1];
    $stmt->bind_param('sssssis', ...$values);
    $success = $stmt->execute();

    if ($success) {
        $result = mysqli_query($con,"SELECT email FROM register");
        while($row = mysqli_fetch_array($result))
           {
             $addresses[] = $row['email'];
            }
             $to = implode(", ", $addresses);
             $subject=" Email Subscribe";
             $msg = "Thank for you"; 
             $message = "New course have registered!";    
             mail($to,$subject,$msg,$message); 
        echo "New cours created successfully";

    }


?>