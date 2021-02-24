<?php
require_once('../connection.php');
 if(isset($_POST["show_data"]))  
 {  
 	    $show_data = $_POST["show_data"]; 
      $query = "SELECT * FROM task WHERE id_task = '$show_data'";  
      $result = mysqli_query($con, $query);  
      while($data = mysqli_fetch_array($result)){ 
      	$task_id = $data['id_task'];
      	$name_task = $data['name_task'];
      	$content = $data['content'];
        $date_task =$data['date_task'];
      	$name_cours = $data['name_cours'];
      	$pdf_file = $data['pdf_file'];
      } 

      
 }

?>

          
<div class="form-group">
            <div class="row">
                     <div class="col-sm-6">
                       <div class="form-group">
                         <label class="bmd-label-floating">Task</label>
                         <input type="hidden" name="edit_id"  value="<?php echo $task_id; ?>">
                          <input type="text" id="titleCours" name="title" id="title" disabled="disabled" value="<?php echo $name_task; ?>" class="form-control">
                         </div>
                       </div>
                       <div class="col-sm-6">
                       <div class="form-group">
                          <label class="bmd-label-floating">Date</label>
                          <input type="date" disabled="disabled" name="startDate" class="form-control" value="<?php echo $date_task; ?>">
                        </div>
                      </div>
                   </div> 
                  </div>
                   <div class="row">
                       <div class="col-md-6">
                        <div class="form-group">
                         <label class="bmd-label-floating">Cours name</label>
                          <input type="text" id="titleCours" disabled="disabled" name="title" id="title" value="<?php echo $name_cours; ?>" class="form-control">
                         </div>
                      </div>
                      <div class="col-sm-6">
                       <div class="form-group">
                         <label class="bmd-label-floating">File name</label>
                          <input type="text" disabled="disabled" id="titleCours" name="title" id="title" value="<?php echo $pdf_file; ?>" class="form-control">
                         </div>
                       </div>

                      
                      
                    </div>
                       <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                          <label class="bmd-label-floating">Content</label>
                          <textarea class="form-control" disabled="disabled"  name="content"  rows="4"><?php echo $content; ?> </textarea>             
                        </div>
                      </div>
                    </div>
