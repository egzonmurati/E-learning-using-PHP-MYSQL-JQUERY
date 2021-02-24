<?php
session_start();
require_once('../connection.php');
 $message = '';

 if (isset($_POST['submit']))
{
   $_SESSION["cours"] = $_POST['cours'];
   $cours =  $_SESSION["cours"];
     $stmt = $con->prepare("SELECT * FROM question_quiz WHERE cours='$cours'");
     $stmt->execute(); 
     $stmt->store_result();
     if($stmt->num_rows > 0){
      $stmt = $con->prepare("SELECT * FROM question_quiz WHERE cours='$cours'");
     $stmt->execute();
     $variable = $stmt->get_result();
     }else{
      $message =  '
      <center>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
      We not have this exam!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>    
      </center> 
       ';
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
  <!-- datatables css link -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.18/af-2.3.2/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.css" />
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

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
              <a href="students.php" class="nav-link ">

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
                  <a href="creat-exam.php" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Creat Exam</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="show-exam.php" class="nav-link active">
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
                  <span class="badge badge-info right">  <?php
                  $stmt = $con->prepare("SELECT COUNT(title) FROM tbl_events");
                  $stmt->execute();
                  $stmt->bind_result($title);
                  $stmt->fetch();

                  $stmt->close();
                  echo $title;
                  ?></span>
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
                  <a href="creat-task.php" class="nav-link">
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
                <li class="breadcrumb-item active">Show-Exam</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

      <!-- Main content -->
      <section class="col-md-10" style="margin: 0 auto;">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">


              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-folder-open"></i>
                   Show all exam!
                  </h3>

                </div><!-- /.card-header -->


                <div class="card-body">
                <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
     
     <div class="form-row">
      
       <div class="form-group col-md-6">
        
         <select class="custom-select form-control-lg" id="inputGroupSelect02" name="cours">
           <option selected>Choose a Cours</option>
         <?php
      
   $sql=mysqli_query($con,"SELECT * from cours");
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
      
   
   
   </form>
   <?php if (isset($message)) { echo $message; } ?>
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
                <th class="bg-info text-white"> <?php echo $i; ?>.<?= $value['question'] ?>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn  btn-sm delete_data float-right"  id="<?php echo $value["id"]; ?>"><i class="fas fa-trash-alt text-danger fa-lg"></i></button></th> 
            </tr>
        </thead>
        <tbody>
           <?php if(isset($value['ans1'])){ ?>
            <tr>
                <td <?php if(1 == $value['ans']){ ?>
                  class="text-success"
                  <?php
                } ?>>&nbsp;1&nbsp;&nbsp;&nbsp;&nbsp;<?= $value['ans1'] ?></td>
            </tr>
          <?php } ?>
           <?php if(isset($value['ans2'])){ ?>
            <tr>
            <td <?php if(2 == $value['ans']){ ?>
                  class="text-success"
                  <?php
                } ?>>&nbsp;2&nbsp;&nbsp;&nbsp;&nbsp;<?= $value['ans2'] ?></td>
              </tr>
                 <?php } ?>
               <?php if(isset($value['ans3'])){ ?>
              <tr>
              <td <?php if(3 == $value['ans']){ ?>
                  class="text-success font-weight-bold"
                  <?php
                } ?>>&nbsp;3&nbsp;&nbsp;&nbsp;&nbsp;<?= $value['ans3'] ?></td>
              </tr>
                 <?php } ?>
               <?php if(isset($value['ans4'])){ ?>
              <tr>
              <td <?php if(4 == $value['ans']){ ?>
                  class="text-success"
                  <?php
                } ?>>&nbsp;4&nbsp;&nbsp;&nbsp;&nbsp;<?= $value['ans4'] ?></td>
            </tr>
               <?php } ?>
              

             <?php
              $i++;
              endforeach; ?>
        </tbody>

    </table>
      
         <?php 
    endif;
  ?>  
              <div class="modal" id="deleteModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Do you want to delete</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="confirm_delete">Delete</button>
      </div>
    </div>
  </div>
</div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
        
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
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

  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.18/af-2.3.2/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.js"></script>
  <!-- Bootstrap  -->
  <!-- jquery link -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
  <!-- datatables -->
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.18/af-2.3.2/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.js"></script>
  <!-- Bootstrap  -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <script type="text/javascript">
      $(document).on("click", '.delete_data', function(){
       var delete_id  = $(this).attr('id');
       console.log(delete_id);
        $('#deleteModal').modal('show'); 
      if(delete_id ){
          //If delete button on the modal is clicked, start ajax deletion
          $('#confirm_delete').click(function(){
              $.ajax(
                {
                 url: "delete-exam.php",
                 type: "POST",
                  data:{id:delete_id},  
                 
                 success: function (data) {
                     if(data){
                         $('#deleteModal').modal('hide');
                          location.reload();
                     }else{
                         alert("Delete Failed");
                     }
                }

             });
          }); 

      };
});
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable({
        "scrollX": true,
        "paging": true,
        "ordering": true,
        "info": false,

        "lengthMenu": [
          [10, 15, 20, -1],
          [10, 15, 20, "All"]
        ],
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search..."
        }

      });



    });
  </script>

</body>

</html>