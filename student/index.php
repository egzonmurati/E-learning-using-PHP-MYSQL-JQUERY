<?php
session_start();
 require_once('../connection.php');

if(empty($_SESSION['admin'])){
    header('location: ../index.php');
}
if($_SESSION['admin']['role']=='admin'){
    header('location: ../admin/home.php');
}
$id_user=$_SESSION['admin']['id'];
$username=$_SESSION['admin']['username'];
if (isset($_POST['exit'])){
   $id= $_POST['id'];
   $status = 1;
     $query = "UPDATE noftication SET status = '".$status."' , id_user = '".$id_user."' WHERE id = '".$id."' ";  
      $result = mysqli_query($con, $query); 
}

if(isset($_POST['submit_form'])){
  $ida= $_POST['a'];
  echo $ida;
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Home User</title>
   <!--  bootstrap link....csss -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <!--  fontawesome link -->
   <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" type="text/css" href="css/cards.css">
     <link rel="stylesheet" href="fullcalendar/fullcalendar.min.css" />
<script src="fullcalendar/lib/jquery.min.js"></script>
<script src="fullcalendar/lib/moment.min.js"></script>
<script src="fullcalendar/fullcalendar.min.js"></script>
<link rel="stylesheet" type="text/css"  href="css/contactt.css">
   <style type="text/css">
.white-bg{
    background:#ffffff !important;
}
.badge-wrapper {
     position: relative;
 }

 .badge {
     position: absolute;
     top: 0px;
     right: 2px;
     text-align: center;
     display: inline-block;
     border-radius: 50%;
 
 }
  .card-container{
  position: relative;
  width: 18rem;
  perspective: 200rem;
  height: 300px;
}

.card-container:hover .card-front{
  transform: rotateY(180deg);
}

.card-container:hover .card-back{
  transform: rotateY(0deg);
}

.card-back{
  transform: rotateY(180deg);
}

.card{
  position: absolute;
  height: 100%;
  width: 100%;
  transition: all 0.9s;
  backface-visibility: hidden;
}

.card-back .card-body{
  position: relative;
}

.card-body a{
  position: absolute;
  top:50%;
  left: 50%;
  margin: -15% 0 0 -23%;
}
.card-price {
  font-size: 17px;
  margin: 0;
  margin-bottom: 3px;
}

 .card-price .period {
  font-size: 12px;
}
.half-rule { 
    margin: 0 auto;
    text-align: center;
    width: 15%;
    height: 2px;
 }
.carousel-inner{
  width:100%;
  max-height: 400px !important;
}

   </style>
  </head>
  <body>
    <div class="container">
      <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <div class="col">
      <h5 class="my-0 mr-md-auto font-weight-normal"><?php echo $username; ?></h5>

       </div>
      <div class="col">
      <nav class="my-2 my-md-0 mr-md-3">

       <ul class="nav nav-tabs">
         <button type="button" class="btn white-bg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
     <i class="fa fa-bell fa-lg badge-wrapper" style="color: #5bc0de">
     <span class="badge badge-danger"><small>
       <?php 
            $stmt = $con->prepare("SELECT COUNT(content) FROM noftication WHERE status=0");
            $stmt->execute();
            $stmt->bind_result($content);
            $stmt->fetch();
            $stmt->close();
                    ?>
           <?php echo $content;?>
     </small></span></i>
  </button>
  <div class="dropdown-menu">
    <div class="dropdown-item" href="#">
        <?php 
        $stmt = $con->prepare("SELECT * FROM noftication ORDER BY id DESC LIMIT 5");
             $stmt->execute();
             $variable = $stmt->get_result();

 foreach ($variable as $value) : 
          if($value['status'] == '0'){
         
    $get_time = strtotime($value['createDate']);
    $time = time();
    $diff =  $time - $get_time;

    switch(1)
    {
        case ($diff < 60);
        $count = $diff;
        if ($count==0)
            $count = "moments";
        elseif ($count==1)
            $suffix = "second";
        else
            $suffix = "seconds";
        break;

        case ($diff > 60 && $diff < 3600);
        $count = floor($diff/60);
        if ($count==1)
            $suffix = "minute";
        else
            $suffix = "minutes";
        break;

        case ($diff > 3600 && $diff < 86400);
        $count = floor($diff/3600);
        if ($count==1)
            $suffix = "hour";
        else
            $suffix = "hours";
        break;

        case ($diff > 86400 && $diff < 2629743);
        $count = floor($diff/86400);
        if ($count==1)
            $suffix = "day";
        else
            $suffix = "days";
        break;

        case ($diff > 2629743 && $diff < 31556926);
        $count = floor($diff/2629743);
        if ($count==1)
            $suffix = "month";
        else
            $suffix = "months";
        break;

        case ($diff > 31556926);
        $count = floor($diff/31556926);
        if ($count==1)
            $suffix = "year";
        else
            $suffix = "years";
        break;

        }
          ?>

      <div class="alert alert-info alert-dismissible fade show" role="alert">
       
     <strong class="mr-auto"><?= $value['content'] ?></strong><br/>
    <small class="text-muted"><?php echo $count . " " . $suffix."ago"; ?></small>
       <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="hidden" name="id"  value="<?php echo $value['id'];?>">
         <button type="submit" name="exit"  class="close">
         <span aria-hidden="true">&times;</span>
         </button>
      </form>

  

</div>
<?php }?>

 <?php endforeach; ?>
    </div>  
  </div>
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Cours</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" id="action-tab" data-toggle="tab" href="#action" role="tab" aria-controls="action" aria-selected="false">My Cours</a>
      <a class="dropdown-item"  href="exam.php">Exam</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item"  href="calendar.php">Event</a>
    </div>
  </li>
  <li class="nav-item">
   <a class="nav-link"  href="#" data-toggle="modal" data-target="#exampleModalCenter">Contact</a>
  </li>
  <li class="nav-item">
         <input  type="button" value="Log Out" class="nav-link btn btn-outline-primary btn-sm"  onclick="location.href='../logout.php?id=<?php echo $id=$_SESSION['admin']['id'];?>'" >
 
  </li>
 <!--  noftication.... -->
 
</ul>
 </nav>
  </div>
    
    </div>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">  
 <!--  Gallery  -->
 <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="img/1.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img/2.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img/3.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

  <div class="jumbotron jumbotron-fluid" style="background:transparent !important">
  <div class="container" style="height: 18px;">
    <p class="lead text-center">List of courses you can take.</p>
    <hr class="half-rule bg-primary"/>
    <br>
    <div class="row justify-content-md-center">
    <div class="col-md-auto">
     <span class="alertSukses text-center"></span> <!-- Alerti per kurset -->
    </div>
  </div>

    
  </div>
</div>
 <div class="row">
          <!--  Ketu jan paraqit te gjitha kurset qe i kemi -->
   <?php 
  $today = date("Y-m-d");
  $yearEnd = date('Y-m-d', strtotime('12/31'));
  $stmt = $con->prepare("SELECT * FROM cours ORDER BY startDate ASC");
             $stmt->execute();
             $rows = $stmt->get_result();
    foreach ( $rows as $row) : ?>
    <div class="col-sm-4">
      <div class="card-container mx-auto mt-5">
    <div class="card card-front" style="max-width: 18rem;">
    <div class="card-header text-center text-white bg-info mb-3"><?= $row['title'] ?></div>
  <div class="card-body">
     <h6 class="card-price text-center text-danger"><?= $row['price'] ?>.00€<span class="period">/month</span></h6>
    <p class="card-text"><?= $row['description'] ?></p>
  </div>
  <div class="card-footer text-center">
   <small class="text-muted">Start: <?= $row['startDate'] ?></small>   
    </div>
</div>    
      <div class="card card-back">
        <div class="card-body">
         <p class="card-text"><?= $row['content'] ?></p>

     <!-- forma per regjistrimin e kurseve -->
<button type="button" class="btn btn-outline-info registerCours" value="<?php echo $id_user; ?>" id="<?php echo  $row['id']; ?>">Register</button>
          
        </div>
        <div class="card-footer text-center">
 <small class="text-muted">Finish: <?= $row['finishDate'] ?></small>   
    </div>
      </div>
    </div>
 </div>

 <?php endforeach; ?>
 </div>
    <section class="bg-info text-center p-5 mt-4">
    <div class="container p-3">
      <h3>SUBSCRIBE NOW</h3>
       <div class="row justify-content-md-center">
        <div class="col-6">
          <!-- forma per subscribe -->
      <form method="POST" id="form_subscribe" onsubmit="return subscribe();">
    <div class="input-group mb-3">
  <input type="email" class="form-control" placeholder="Enter Your Email"            id="email_subscribe" name="email_subscribe">
  <div class="input-group-append">
    <button type="submit" class="btn btn-outline-primary" name="submit_form" style="color:white;">Subscribe</button>
   
  </div>
</div>
      </form>
       <span class="alertSuccess1 text-center"></span>
      </div> </div>
    </div>
  </section>
  
  </div>
  <div class="tab-pane fade" id="cours" role="tabpanel" aria-labelledby="cours-tab">
    <div class="row">
  <div class="col-4">
      <?php 
    $stmt = $con->prepare("SELECT * FROM cours ORDER BY price DESC");
             $stmt->execute();
             $rows = $stmt->get_result();
    foreach ( $rows as $row) : ?>
    <?php endforeach; ?>   
  </div>
  <div class="col-8">col-4</div>
</div>
  </div>
  
    
      <!-- This is for Contact///// -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Contact Now</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <form method="POST" id="email_send" onsubmit="return email_send();">
            <div class="row">
              <div class="col-sm-12">
                <div class="inputBox d-flex justify-content-center">
                  <input type="text" name="fullname" id="fullname" class="input" placeholder="Full Name">
                </div>
              </div>

              <div class="col-sm-12">
                <div class="inputBox d-flex justify-content-center" >
                  <input type="email" name="fullemail" id="fullemail" class="input" placeholder="Email">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="inputBox d-flex justify-content-center" >
                  <textarea class="input" name="fulltext" id="fulltext"  placeholder="Message"></textarea>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <input type="submit" name="" class="button btn btn-primary d-flex justify-content-center" value="Send Message" >
              </div>
            </div>
        </form>
        
      </div>
    
    </div>
  </div>
</div>
        <!--  my-Cours............... -->
   <div class="tab-pane fade" id="action" role="tabpanel" aria-labelledby="action-tab">
       
         <div class="row">
          <div class="col-3">
       <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <span class="fa fa-hand-o-right"></span>Where do you get your news?</h4>
                </div>
                <div class="panel-body">
                  <form method="post">
              <div class="form-group">   
      <select id="inputState" class="form-control" name="options">
        <option selected>Choose...</option>
      <?php
$sql=mysqli_query($con,"SELECT id,title FROM cours");
while( $rows = mysqli_fetch_assoc($sql) ) {
?>
<option  value="<?php echo $rows["title"]; ?>"><?php echo $rows["title"]; ?></option>
<?php } ?>
      </select>
    </div>          
 </div>
  <div class="panel-footer text-center">
<button type="button" id="vote" class="btn btn-primary btn-block btn-sm">Vote</button>
    </div>
      </form>  
            </div>
            <br>
  <div class="col-md-auto">
     <span class="alertvote text-center"></span> 
    </div>
    <?php 
    $sql = "select count(*) as poll_name from tbl_poll";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
$progress = $row['poll_name'];
?>
      <strong>All Vote</strong><span class="pull-right"></span>
  <div class="progress">
  <div class="progress-bar" role="progressbar" style="width: <?php echo $progress; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $progress; ?></div>
</div>
    </div>



          <div class="col-9">
  <div class="jumbotron jumbotron-fluid" style="background:transparent !important; margin-top: -55px; margin-bottom: -20px;">
  <div class="container">
    <p class="lead text-center">List of courses you take.</p>
    <hr class="half-rule bg-primary"/>
  </div>
</div>
   <?php 
  $stmt = $con->prepare("SELECT cours_register.id_cours,cours.title,cours.description,cours.content,cours.startDate,cours.finishDate, register.username FROM cours_register
    INNER JOIN cours ON cours_register.id_cours = cours.id
    INNER JOIN register ON cours_register.id_user = register.id WHERE cours_register.id_user = '$id_user'");
    $stmt->execute();
    $cours = $stmt->get_result();
    ?>
 <?php foreach ($cours as $row) : ?>
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse"  href="#collapseTwo<?= $row['id_cours'] ?>">
          <i class="fa fa-folder-open fa-lg"> <?= $row['title'] ?></i> 
      </a>
      <br>
    </div>
    <div id="collapseTwo<?= $row['id_cours'] ?>" class="accordion-body collapse"> 
      <div class="accordion-inner" style="padding-left: 6px;">
        <div style="border-left: 2px solid #0275d8; padding-left: 6px;">
      <h5>Description: <span class="label font-weight-normal"><?= $row['description'] ?></span></h5>
      <h5>Content: <span class="label font-weight-normal"><?= $row['content'] ?></span></h5>
      </div>
      <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Start</label>
      <input type="date" class="form-control" value="<?= $row['startDate'] ?>" disabled>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Finish</label>
      <input type="date" class="form-control" value="<?= $row['finishDate'] ?>" disabled>
    </div>
  </div>

        <!--ACCORDION INSIDE ACCORDION ITEM TWO-->
         <?php 
       $cours =$row['title'];
     
          $query = "SELECT * FROM task WHERE name_cours='$cours'";  
 $res = mysqli_query($con, $query); 
  while($row = mysqli_fetch_array($res))  
                {  
     ?>
      <div class="accordion-heading" style="padding-left: 15px;">
        <a class="accordion-toggle" data-toggle="collapse"  href="#collapseOneA<?php echo $row['id_task'];?>">
         <i class="fa fa-folder-open"><?php echo $row['name_task'];?></i> 
        </a>
        <br>
      </div>
      <div id="collapseOneA<?php echo $row['id_task'];?>" class="accordion-body collapse">
        <div class="accordion-inner" style="padding-left: 25px; border-left: 2px solid #0275d8;">
          <br>
          <table class="table table-bordered">
  <thead>
    <tr>
      <th class="text-center">Content</th>
      <th class="text-center">Date</th>
      <th class="text-center">File</th>
       <th class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="text-center"><?php echo $row['content'];?></td>
      <td class="text-center"><?php echo $row['date_task'];?></td>
      <td class="text-center"><?php echo $row['pdf_file'];?></td>
      <td class="text-center"><a class="btn btn-outline-primary btn-sm" href="downloads.php?file_id=<?php echo $row['id_task'] ?>">Download <i class="fa fa-download"></i></a></td>
    </tr>
    
  </tbody>
</table>
       
        </div>
      </div>
      <?php  
                }  
                ?> 
      </div>    
      </div>
    </div>
    <hr>
 <?php endforeach; ?>
          </div>
         </div>
   </div>
</div>
</div>

<!-- jquery link. -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- bootstrap link js.......... -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.4/popper.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  
        <script type="text/javascript">
$('.alertSukses').fadeOut();
$('.alertSuccess1').fadeOut();
$('.alertvote').fadeOut();
    // regjistrimi i votave
$(document).on("click", '#vote', function(){  
   var vote = $('#inputState').val();
    $.ajax({  
           url: 'voting.php',  
          type:"post",  
           data: {
              vote: vote
                 },
          success:function(data){  
           $('.alertvote').fadeIn().html(data).fadeOut(3500);
           }  
        });
 });
             // ketu e regjistrojm kursin
$(document).on("click", '.registerCours', function(){  
      var course_id = $(this).attr('id');
      var user_id = $(this).val();
      
         $.ajax({  
           url: 'register_cours.php',  
          type:"post",  
           data: {
              user_id: user_id,
              course_id: course_id
                 },
          success:function(data){  
           $('.alertSukses').fadeIn().html(data).fadeOut(3500);
           }  
        });
      });             
           
            // ketu e ban subscribe
             function subscribe()
            {
                var email = $('#email_subscribe').val();
                $.ajax({
                    type: 'post',
                    url: 'email_subscribe.php',
                    data: {
                        email: email 
                    },
                    success: function (data) {
                         $('#form_subscribe')[0].reset();
              $('.alertSuccess1').fadeIn().html(data).fadeOut(3500);
                    }
                });

                return false;
            }
             function email_send()
            { 
                var fullname = $('#fullname').val();
                var email = $('#fullemail').val();
                var fulltext = $('#fulltext').val();
                $.ajax({
                    type: 'post',
                    url: 'send_email_by_user.php',
                    data: {
                        fullname: fullname,
                        email: email,
                        fulltext: fulltext 
                    },

                    success: function (data) {
                         $('#email_send')[0].reset();

              $('#exampleModalCenter').hide();
                    }
                });

                return false;
            }


       </script>
                  <script>
$(document).ready(function () {
    var calendar = $('#calendars').fullCalendar({
    themeSystem: 'bootstrap4',
        editable: true,
        
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
        events: "fetch-event.php",
        displayEventTime: false,
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            } 
        },
        selectable: false,
        selectHelper: true,
        select: function (start, end, allDay) {
            var title = prompt('Event Title:');

            if (title) {
                var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

                $.ajax({
                    url: 'add-event.php',
                    data: 'title=' + title + '&start=' + start + '&end=' + end,
                    type: "POST",
                    success: function (data) {
                        displayMessage("Added Successfully");
                    }
                });
                calendar.fullCalendar('renderEvent',
                        {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                true
                        );
            }
            calendar.fullCalendar('unselect');
        },
        
        editable: true,
        eventDrop: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                  
                },
    });
});


</script>

  </body>
</html>

