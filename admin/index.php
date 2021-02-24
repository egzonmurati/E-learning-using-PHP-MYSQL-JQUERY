<?php
session_start();
require_once('../connection.php');
if (empty($_SESSION['admin'])) {
  header('location: ../index.php');
}
if ($_SESSION['admin']['role'] == 'student') {
  header('location: ../student/dashboard.php');
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
              <a href="index.php" class="nav-link active">
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
              <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">

            <!-- ./col -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <?php
                  $stmt = $con->prepare("SELECT COUNT(title) FROM cours");
                  $stmt->execute();
                  $stmt->bind_result($title);
                  $stmt->fetch();

                  $stmt->close();
                  ?>
                  <h3><?php echo $title; ?></h3>

                  <p>Total Course</p>
                </div>
                <div class="icon">
                  <i class="fas fa-laptop-code"></i>

                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <?php
                  $sql = "select count(*) as username from register where role='student'";
                  $result = mysqli_query($con, $sql);
                  $data = mysqli_fetch_assoc($result);
                  ?>
                  <h3><?php echo $data['username']; ?></h3>

                  <p>User Registrations</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <?php
                  $stmt = $con->prepare("SELECT COUNT(online) FROM register WHERE online='1'");
                  $stmt->execute();
                  $stmt->bind_result($online);
                  $stmt->fetch();

                  $stmt->close();
                  ?>
                  <h3><?php echo $online; ?></h3>

                  <p>Online User</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-clock"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Course
                  </h3>

                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content p-0">

                    <div id="chart_div" style="width: 400px; height: 300px; margin: 0 auto;">
                      <?php
                      $sql = "SELECT poll_name, count(*) as number FROM tbl_poll GROUP BY poll_name";
                      $queryPoll = $con->query($sql);
                      ?>
                    </div>
                  </div>
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->




              <!-- /.card -->
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Gender
                  </h3>

                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content p-0">
                    <!-- Morris chart - Sales -->
                    <div class="ct-chart">
                      <div id="piechart" style="width: 300px; height: 300px; margin: 0 auto;">
                        <?php
                        $sql = "SELECT gender, count(*) as number FROM register GROUP BY gender";
                        $query = $con->query($sql);
                        ?>
                      </div>
                    </div>
                  </div>
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
              <!-- /.card -->

              <!-- solid sales graph -->

              <!-- /.card -->


            </section>
            <!-- right col -->
          </div>
          <div class="row justify-content-md-center">
            <div class="col-10">
            <div id="openweathermap-widget-11"></div>
<script src='https://openweathermap.org/themes/openweathermap/assets/vendor/owm/js/d3.min.js'></script>
<script>window.myWidgetParam ? window.myWidgetParam : window.myWidgetParam = [];  window.myWidgetParam.push({id: 11,cityid: '791122',appid: 'f3505e7c2368729d228c21cc5de3af96&t',units: 'metric',containerid: 'openweathermap-widget-11',  });  (function() {var script = document.createElement('script');script.async = true;script.charset = "utf-8";script.src = "openweathermap.org/themes/openweathermap/assets/vendor/owm/js/weather-widget-generator.js";var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(script, s);  })();</script>
<script>window.myWidgetParam ? window.myWidgetParam : window.myWidgetParam = [];  window.myWidgetParam.push({id: 1,cityid: '791122',appid: 'f3505e7c2368729d228c21cc5de3af96&t',units: 'metric',containerid: 'openweathermap-widget-1',  });  (function() {var script = document.createElement('script');script.async = true;script.charset = "utf-8";script.src = "//openweathermap.org/themes/openweathermap/assets/vendor/owm/js/weather-widget-generator.js";var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(script, s);  })();</script>
            </div>
          </div>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      

      </section>
      <!-- /.content -->
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([

        ['Gender', 'Number'],
        <?php
        while ($row = $query->fetch_assoc()) {
          echo "['" . $row["gender"] . "', " . $row["number"] . "],";
        }
        ?>
      ]);
      var options = {
        is3D: true,
        'width': 400,
        'height': 350,

        pieHole: 0.4,
        backgroundColor: 'none',
        colors: ['red', '#44bd32']
      };
      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
      chart.draw(data, options);
    }
  </script>
  <script type="text/javascript">
    google.charts.load('current', {
      packages: ['corechart', 'bar']
    });
    google.charts.setOnLoadCallback(drawMultSeries);

    function drawMultSeries() {
      var data = google.visualization.arrayToDataTable([
        ['Name', 'Cours'],
        <?php
        while ($row = $queryPoll->fetch_assoc()) {
          echo "['" . $row["poll_name"] . "', " . $row["number"] . "],";
        }
        ?>
      ]);

      var options = {
        is3D: true,
        'width': 400,
        'height': 350,

        pieHole: 0.8,
        backgroundColor: 'none',
        colors: ['red', '#44bd32', 'blue', 'green']
      };


      var chart = new google.visualization.ColumnChart(
        document.getElementById('chart_div'));

      chart.draw(data, options);
    }
  </script>
</body>

</html>