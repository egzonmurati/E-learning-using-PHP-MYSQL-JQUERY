
<html lang="en">
 <head>
<meta charset="UTF-8">
    <title>Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<link rel="stylesheet" href="fullcalendar/fullcalendar.min.css" />
<script src="fullcalendar/lib/jquery.min.js"></script>
<script src="fullcalendar/lib/moment.min.js"></script>
<script src="fullcalendar/fullcalendar.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<style>

.half-rule { 
    margin: 0 auto;
    text-align: center;
    width: 15%;
    height: 2px;
 }
#calendar {
    width: 700px;
    margin: 0 auto;
    margin-top: -20px;

    height: 500px;
    overflow: hidden;
    padding: 15px;
    background-color: rgba(255,255,255,0.75);
    box-shadow: 7px -7px 8px -9px rgba(0,0,0,0.75);

}

.fc-header-toolbar{
  text-align: center;
  position:relative;
  z-index: 100;
  padding: 10px;
}

.response {
    height: 60px;
}

.success {
    background: #cdf3cd;
    padding: 10px 60px;
    border: #c3e6c3 1px solid;
    display: inline-block;
}
</style>
</head>

  <body>

    <div class="container">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1">
            <a class="btn btn-outline-primary btn-sm" href="index.php">Home</a>
          </div>
       
          <div class="col-4 d-flex justify-content-end align-items-center">
          
            <a class="btn btn-outline-danger btn-sm" onclick="location.href='../logout.php?id=<?php echo $id=$_SESSION['admin']['id'];?>'">Log out</a>
          </div>
        </div>
      </header>
        <div class="jumbotron jumbotron-fluid" style="background:transparent !important; margin-top: -55px; margin-bottom: -20px;">
  <div class="container">
    <p class="lead text-center">Calendar of Event</p>
    <hr class="half-rule bg-primary"/>
  </div>
</div>
  
     
    </div>

    <main role="main" class="container">
      <div class="row">
        <div class="col-md-11 blog-main">
      
         <div id='calendars'></div>
        </div><!-- /.blog-main -->
      </div><!-- /.row -->
    </main><!-- /.container -->

   
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




    