<?php
session_start();
$username=$_SESSION['admin']['username'];
$id_user =$_SESSION['admin']['id'];
 require_once('../connection.php');
  $message = '';
  $button = '';
 if (isset($_POST['submit']))
{
   $_SESSION["cours"] = $_POST['cours'];
   $cours =  $_SESSION["cours"];
     $stmt = $con->prepare("SELECT * FROM question_quiz WHERE cours='$cours'");
     $stmt->execute();
      $stmt->store_result();
      if($stmt->num_rows > 0){
     $result = mysqli_query($con,"SELECT * FROM answer_quiz WHERE name_user='$username' AND name_cours='$cours'");
    $count=mysqli_num_rows($result); 
    if($count > 0){
        $message =  '<center><div  class="alert alert-success" role="alert">You finish a Exam!</div></center>';
   } 
    else{
      $stmt = $con->prepare("SELECT * FROM question_quiz WHERE cours='$cours' ORDER BY cours");
             $stmt->execute();
             $variable = $stmt->get_result();
             $_SESSION["time_start"]=date("Y-m-d h:i:s");   
         $button ='<center><button type="submit" name="yes" id="info"  class="btn btn-outline-primary">Finish Exam</button></center>';
    }

       }else{
      $message =  '<center><div  class="alert alert-danger" role="alert">We not have this exam!</div></center>';
      $button ='<center><button type="submit" name="yes" id="info" style="display: none" class="btn btn-outline-primary">Finish Exam</button></center>';
      }
    
   
   


}
if(isset($_POST['yes']))
{
  
  $answer =implode('', $_POST);
  $right=0;
  $wrong=0;
  $no_answer=0;
  $name_cours = $_SESSION["cours"];
  $sql = mysqli_query($con,"SELECT * FROM question_quiz WHERE cours='$name_cours' ORDER BY cours");
  while($row = mysqli_fetch_array($sql))
   {
 
           
            if($row["ans"] == $_POST[$row['id']])
            {
             $right++;
            }
            elseif ($_POST[$row['id']]=="no_attemp") {
              $no_answer++;
            }
           
            else
            {
              $wrong++;
            }     
   }
    $finisht_time=date("Y-m-d h:i:s");
    $time_start=$_SESSION["time_start"];
  
    $diff=(strtotime($finisht_time)-strtotime($time_start));
    $diffe = gmdate('H:i:s', $diff);
   
    $name_cours = $_SESSION["cours"];
    $total = $right + $no_answer + $wrong;
    $percentage = ($right*100)/$total;
$sql = "INSERT INTO answer_quiz(name_user,name_cours,rightAnswer,noAnswer,wrongAnswer,percentage_correct,time_start, finisht_time,total_time) 
VALUES('$username', '$name_cours', '$right','$no_answer', '$wrong','$percentage','$time_start','$finisht_time','$diffe')";
           
           if (mysqli_query($con, $sql)) {
               
                  $message =  '<center><div  class="alert alert-success" role="alert">Question uploaded successfully!</div></center>';

                   $button ='<center><button type="submit" name="yes" id="info" style="display: none" class="btn btn-info">Finish Exam</button></center>';
           }
        else {
           $message =  '<center><div  class="alert alert-danger" role="alert">Failed to upload Question!</div></center>';
               $button ='<center><button type="submit" name="yes" id="info" style="display: none" class="btn btn-info">Finish Exam</button></center>';

          
       }
//     echo "right  ".$right.";<br>";
//     echo "No answer  ".$no_answer.";<br>";
//      echo "Wrong  ".$wrong.";<br>";
//    echo "<br>";

// echo $percentage;
  
}

?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Exam</title>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  </head>

  <body>

    <div class="container">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1">
            <a class="text-muted" href="index.php">Back</a>
          </div>
       
          <div class="col-4 d-flex justify-content-end align-items-center">
          
            <a class="btn btn-outline-danger btn-sm" onclick="location.href='../logout.php?id=<?php echo $id=$_SESSION['admin']['id'];?>'">Log out</a>
          </div>
        </div>
      </header>

   

      <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
        <div class="col-md-12 px-0">
          <h1 class="display-4 font-italic">The Test</h1>
          <p>The test contains 10 questions and there is no time limit.</p>
          <p>You will get 10 point for each correct answer. At the end of the Quiz, your total score will be displayed. Maximum score is 100 points.</p>
          <small>Good luck!</small>
          
        </div>
      </div>

     
    </div>

    <main role="main" class="container">
      <div class="row">
        <div class="col-md-8 blog-main">
          <div class="pb-3 mb-4 font-italic border-bottom">
               <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
     
  <div class="form-row">
   
    <div class="form-group col-md-6">
     
      <select class="custom-select form-control-lg" id="inputGroupSelect02" name="cours">
        <option selected>Choose a Cours</option>
      <?php
   
$sql=mysqli_query($con,"SELECT cours_register.id_cours,cours.title,cours.description,cours.content,cours.startDate,cours.finishDate, register.username FROM cours_register
    INNER JOIN cours ON cours_register.id_cours = cours.id
    INNER JOIN register ON cours_register.id_user = register.id WHERE cours_register.id_user = '$id_user'");
while( $rows = mysqli_fetch_assoc($sql) ) {
  echo $rows['title'];
?>
<option  value="<?php echo $rows["title"]; ?>"><?php echo $rows["title"]; ?></option>
<?php } ?>
      </select>
    </div>
    <div class="form-group col-md-6">
      <button type="submit" name="submit" id="show" class="btn btn-outline-primary">Show Exam</button>
    </div>
  </div>
   

 <div><?php if (isset($message)) { echo $message; } ?> </div>
</form>
          </div>

          <div class="blog-post">
               <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
     <?php
       if( isset($variable)): 
        ?>
    <!--  Per me na funksionue foreach na duhet kjo nalt sepse na qet Warning: Invalid argument supplied for foreach() php -->
  <?php 

   $i =1;
  foreach ($variable as $value) : ?>
 <table  class="table table-border" style="width:100%">  
        <thead>
            <tr class="danger">
                <th> <?php echo $i; ?>.<?= $value['question'] ?></th> 
            </tr>
        </thead>
        <tbody>
           <?php if(isset($value['ans1'])){ ?>
            <tr>
                <td>&nbsp;1&nbsp;&nbsp;<input type="radio" value="1" name="<?= $value['id'] ?>">&nbsp;&nbsp;<?= $value['ans1'] ?></td>
            </tr>
          <?php } ?>
           <?php if(isset($value['ans2'])){ ?>
            <tr>
                <td>&nbsp;2&nbsp;&nbsp;<input type="radio" value="2"  name="<?= $value['id'] ?>">&nbsp;&nbsp;<?= $value['ans2'] ?></td>
              </tr>
                 <?php } ?>
               <?php if(isset($value['ans3'])){ ?>
              <tr>
                <td>&nbsp;3&nbsp;&nbsp;<input type="radio" value="3"  name="<?= $value['id'] ?>">&nbsp;&nbsp;<?= $value['ans3'] ?></td>
              </tr>
                 <?php } ?>
               <?php if(isset($value['ans4'])){ ?>
              <tr>
                <td>&nbsp;4&nbsp;&nbsp;<input type="radio" value="4"  name="<?= $value['id'] ?>">&nbsp;&nbsp;<?= $value['ans4'] ?></td>
            </tr>
               <?php } ?>
                <tr>
                <td><input type="radio" checked="checked" style="display: none" value="no_attemp"  name="<?= $value['id'] ?>"></td>
                
            </tr>

             <?php
              $i++;
              endforeach; ?>
        </tbody>

    </table>
        <div><?php if (isset($button)) { echo $button; } ?> </div> 
         <?php 
    endif;
  ?>  
  </form>
          </div><!-- /.blog-post -->


         

        </div><!-- /.blog-main -->

        <aside class="col-md-4 blog-sidebar bg-light">
          <div class="p-3 mb-3  rounded">
            <h4 class="font-italic">Result for Exam</h4>
            <?php 
            $stmt = $con->prepare("SELECT * FROM answer_quiz Where name_user='$username'");
    $stmt->execute();
    $cours = $stmt->get_result();
            ?>
            <?php foreach ($cours as $row) : ?>
          <?php 
      $dt_txt = $row['time_start'];
    $date = new DateTime($dt_txt);
   $current_date = $date->format('Y-m-d');
    $timer = $row['total_time'];
    $timers = new DateTime($timer);
   $total_timer = $timers->format('i:s');
 
 
          ?>
           <table class="table table-bordered">
  <thead>
    <tr>
      <th class="text-center">Cours</th>
      <th  class="text-center">Date</th> 
      <th class="text-center">Timer</th>
      <th class="text-center">Percentage</th>
     
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="text-center"><?php echo $row['name_cours'];?></td>
       <td class="text-center"><?php echo $current_date;?></td>
      <td class="text-center"><?php echo $total_timer;?></td>
      <td class="text-center"><?php if($row['percentage_correct'] <= 30){ ?>
          <p class="text-danger font-weight-bold"><?php echo $row['percentage_correct']; ?>%</p>
   <?php 
         }elseif ($row['percentage_correct'] >= 70) { ?>
          <p class="text-success font-weight-bold"><?php echo $row['percentage_correct']; ?>%</p>
      <?php 
         }else{ ?>
     <p class="text-secondary font-weight-bold"><?php echo $row['percentage_correct']; ?>%</p>
     <?php 
         }
        ?></td>
     
    </tr>
    
  </tbody>
</table>
      
    <hr>
 <?php endforeach; ?>
          </div>

        

        </aside><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </main><!-- /.container -->

   

   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </body>
</html>