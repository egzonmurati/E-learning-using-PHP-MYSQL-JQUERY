<?php
session_start();
require_once('../connection.php');
$message = '';
if (isset($_POST['submit']))
{
$name_task = $_POST['name_task'];
$content = $_POST['content_task'];
$date_task =$_POST['date_tasks'];

$cours = $_POST['options'];

 // name of the uploaded file
$filename = $_FILES['myfile']['name'];

   $destination = 'uploads/' . $filename;
   $extension = pathinfo($filename, PATHINFO_EXTENSION);
   $file = $_FILES['myfile']['tmp_name'];
   $size = $_FILES['myfile']['size'];

   if (!in_array($extension, ['zip', 'pdf', 'docx','png'])) {
       echo "You file extension must be .zip, .png, .pdf or .docx";
   } elseif ($_FILES['myfile']['size'] > 1000000) { 
       echo "File too large!";
   } else {
  
       if (move_uploaded_file($file, $destination)) {
$sql = "INSERT INTO task (name_task,content,date_task,name_cours,pdf_file) VALUES('$name_task','$content','$date_task','$cours','$filename')";
          
           if (mysqli_query($con, $sql)) {
              
                  $message =  '<center><div  class="alert alert-success" role="alert">File uploaded successfully!</div></center>';
           }
       } else {
          $message =  '<center><div  class="alert alert-danger" role="alert">Failed to upload file!</div></center>';
         
       }
   }
}


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Course Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
    
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
     <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-th-large"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        
          <div class="dropdown-divider"></div>
          <a href="logoutadmin.php" class="dropdown-item">
      <i class="fas fa-sign-out-alt"></i>
           Log Out
           
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
         
        </div>
      </li>
    
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-light">Course Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    
    

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
      
          <li class="nav-item">
            <a href="index.php" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
               
              </p>
            </a>
          </li>
       
        
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Course
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add-cours.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Course</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="show-cours.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Show Course</p>
                </a>
              </li>
              
            </ul>
          </li>
        <li class="nav-item">
            <a href="students.php" class="nav-link">
      
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
               Students
               
              </p>
            </a>
          </li>
      <li class="nav-item">
            <a href="notifications.php" class="nav-link">
      
              <i class="nav-icon fas fa-bell"></i>
              <p>
               Notifications
               
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Exam</p>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="creat-exam.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Creat Exam</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="show-exam.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Show Exam</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="show-result.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Show Result</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">EXAMPLES</li>
          <li class="nav-item">
            <a href="calendars.php" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Calendar
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>
         
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Task
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="creat-task.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Creat Task</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="show-task.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Show Task</p>
                </a>
              </li>
           
         
            </ul>
          </li>
          <li class="nav-item">
              <a href="contact.php" class="nav-link">
                <i class="nav-icon fas fa-address-card"></i>
                <p>
                Contact us
                </p>
              </a>
            </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
        
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Add-Task</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
 
    <!-- /.content -->
  <section class="col-md-10" style="margin: 0 auto;">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                	<i class="fas fa-folder-plus mr-1"></i>
                 
                  Add Task
                </h3>
           
              
              </div><!-- /.card-header -->
              <div class="card-body">
              <div><?php if (isset($message)) { echo $message; } ?> </div>
              <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Name of Task</label>
      <input type="text"  name="name_task" class="form-control" id="inputEmail4">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Content of Task</label>
      <input type="text" name="content_task" class="form-control" id="inputPassword4" >
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputCity">Date of Task</label>
      <input type="date" name="date_tasks" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">List of Course</label>
      <select class="custom-select form-control-lg" id="inputGroupSelect02" name="options">
        <option selected>Choose...</option>
      <?php
$sql=mysqli_query($con,"SELECT id,title FROM cours");
while( $rows = mysqli_fetch_assoc($sql) ) {
?>
<option  value="<?php echo $rows["title"]; ?>"><?php echo $rows["title"]; ?></option>
<?php } ?>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="inputZip">Zip File</label>
      <input type="file" name="myfile" class="form-control" id="inputZip">
    </div>
  </div>
 
  <button type="submit"  name="submit" class="btn btn-primary  btn-lg btn-block">Create Task</button>
</form>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

           

          
            <!-- /.card -->
          </section>
          
              </div>

  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
 <script type="text/javascript">
    $(function(){
    $('.nav a').filter(function(){return this.href==location.href}).parent().addClass('active').siblings().removeClass('active')
    $('.nav a').click(function(){
      $(this).parent().addClass('active').siblings().removeClass('active')  
    })
  });
 </script>
 <script type="text/javascript">

$(document).ready(function(){
  $('.alertSukses').hide();
$("#submit").click(function(){

var titleCours = $("#titleCours").val();
var price = $("#price").val();
var startCours = $("#startCours").val();
var finishCours = $("#finishCours").val();
var image_name = $('#image_name').val();  
var description =  $("#description").val();
var content =  $("#content").val();
var dataString = 'titleCours1='+ titleCours + '&price1='+ price + '&startCours1='+ startCours + '&finishCours1='+ finishCours + '&image_name='+ image_name + '&description1='+ description + '&content1='+ content;

console.log(dataString);

if(titleCours==''||price==''||startCours==''||finishCours==''||image_name==''||description==''||content=='')
{
alert("Please Fill All Fields");
}
else
{
// AJAX Code To Submit Form.
$.ajax({
type: "POST",
url: "insertCours.php",
data: dataString,
cache: false,
success: function(result){
 $('.alertSukses').show();
     setTimeout(function(){// wait for 5 secs(2)
           location.reload(); // then reload the page.(3)
      }, 2000);
}
});
}
return false;
});
});
 </script>
</body>
</html>
