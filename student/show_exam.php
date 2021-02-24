<?php
session_start();
$username=$_SESSION['admin']['username'];

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
      if($stmt->num_rows == 0){
      $message =  '<center><div  class="alert alert-danger" role="alert">We not have this exam!</div></center>';
      $button ='<center><button type="submit" name="yes" id="info" style="display: none" class="btn btn-info">Finish Exam</button></center>';
      }

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
         $button ='<center><button type="submit" name="yes" id="info"  class="btn btn-info">Finish Exam</button></center>';
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
    echo "right  ".$right.";<br>";
    echo "No answer  ".$no_answer.";<br>";
     echo "Wrong  ".$wrong.";<br>";
   echo "<br>";

echo $percentage;
  
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- bootstrap link css -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <!-- CSS Files -->
  <link rel="stylesheet" href="css/showCour.css">
 <!-- datatables css link -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.18/af-2.3.2/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.css"/>
 
  </head>
  <body>
  
    <div class="wrapper">
      <input  type="button" value="Dil" class="btn btn-success btn-sm"  onclick="location.href='../logout.php?id=<?php echo $id=$_SESSION['admin']['id'];?>'" />
      <section id="main">
       
        <article>
    
           
           <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
    <div class="row">
            <div class="col-7">
              <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
     
  <div class="form-row">
   
    <div class="form-group col-md-6">
     
      <select class="custom-select form-control-lg" id="inputGroupSelect02" name="cours">
        <option selected>Choose a Cours</option>
      <?php
$sql=mysqli_query($con,"SELECT id,title FROM cours");
while( $rows = mysqli_fetch_assoc($sql) ) {
?>
<option  value="<?php echo $rows["title"]; ?>"><?php echo $rows["title"]; ?></option>
<?php } ?>
      </select>
    </div>
    <div class="form-group col-md-6">
      <button type="submit" name="submit" id="show" class="btn btn-primary">Create Exam</button>
    </div>
  </div>
   

 <div><?php if (isset($message)) { echo $message; } ?> </div>
</form>

  </div>
</div> 
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
  
  </div>
</div>  
        </article>  


         <footer id="footer">
        <p><em>Aenean faucibus enim id posuere ornare.</em></p>
      </footer>      
     </section>
     
    </div>
    <!-- jquery link -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
  <!-- datatables -->
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.18/af-2.3.2/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.js"></script>
<!-- Bootstrap  -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



 <script type="text/javascript">
    $(function(){
    $('.nav a').filter(function(){return this.href==location.href}).parent().addClass('active').siblings().removeClass('active')
    $('.nav a').click(function(){
      $(this).parent().addClass('active').siblings().removeClass('active')  
    })
  })
 </script>

 </body>
</html>