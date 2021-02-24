<?php
require_once('../connection.php');
 if(isset($_POST["edit_id"]))  
 {  
 	  $edit_id = $_POST["edit_id"];
 	 
      $query = "SELECT * FROM cours WHERE id = '$edit_id'";  
      $result = mysqli_query($con, $query);  
    
      while($data = mysqli_fetch_array($result)){ 

      	$edit_id = $data['id'];
      	$title = $data['title'];
      	$description = $data['description'];
      	$startDate = $data['startDate'];
      	$finishDate = $data['finishDate'];
      	$price = $data['price'];
      	$content = $data['content'];

   
       
      } 

      
 }

?>

          
<div class="form-group">
            <div class="row">
                     <div class="col-sm-6">
                       <div class="form-group">
                         <label class="bmd-label-floating">Title</label>
                         <input type="hidden" name="edit_id"  value="<?php echo $edit_id; ?>">
                          <input type="text" id="titleCours" name="title" id="title" value="<?php echo $title; ?>" class="form-control">
                         </div>
                       </div>
                       <div class="col-sm-6">
                       <label class="bmd-label-floating">Price</label>  
                       <div class=" input-group">   
                       <input type="number"   class="form-control" name= "price"  value="<?php echo $price; ?>">
                       
                      </div>
                   </div> 
                  </div>
                   <div class="row">
                       <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Start Date</label>
                          <input type="date"  name="startDate" class="form-control" value="<?php echo $startDate; ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Finish Date</label>
                          <input type="date"  name="finishDate" class="form-control" value="<?php echo $finishDate; ?>">
                        </div>
                      </div>
                      
                    </div>
                       <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Description</label>
                           <textarea class="form-control"  name="description"  rows="4"><?php echo $description; ?> </textarea>
                        </div>
                      </div>
                       
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Content</label>
                          <textarea class="form-control"  name="content"  rows="4"><?php echo $content; ?> </textarea>
                   
                         
                        </div>
                      </div>
                    </div>
