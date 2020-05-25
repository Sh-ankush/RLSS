<?php
require_once( './classes/Events.php' );
require_once( './classes/Programs.php' );

$programs = Programs::GetPrograms();

?>
<div class="card">

    <div class="card-header bg-primary text-white">
        Add Event Details
        <span class='float-right'> <a href="<?= get_url('events') ?>"><i class='fas fa-backspace fa-2x' style='color: #F5F5F5;'></i></a></span>
    </div>

    <div class="card-body">
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
            <div class="form-group ">
                <label for="exampleFormControlInput1">Add Event Title</label>
                <input name="eventname" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Event title" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Add Event Date</label>
                <input name="eventdate" type="date" class="form-control" id="exampleFormControlInput1" placeholder="dd-mm-yyyy" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Add Event Location</label>
                <input name="eventlocation" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Event location" required>
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Event Details</label>
                <textarea name="eventdetails" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Event Details" required></textarea>
            </div>

            <div class="form-group">
                <label for="sel1">Select Event Category (select one):</label>
                <select class="form-control" id="sel1" name="eventcategory">
                   <?php 
                        if($programs)
                        {
                             foreach ( $programs as $k=>$e ) {
                                 
                                echo "<option>".$e['title']."</option>";
                             }
                        }
                    ?> 
                
                </select>
            </div>
                <button onclick="ClearData()" id="clear" class="btn btn-primary">Clear</button>

                <button type="submit" name="submit" class="btn btn-primary">Add</button>

        </form>
    </div>
</div>

 
    
    

<?php 

    


    if(isset($_POST['submit'])){
        
            $e_title = $_POST['eventname'];
            $e_date = $_POST['eventdate'];
            $e_location = $_POST['eventlocation'];
            $e_details = $_POST['eventdetails']; 
            $e_category = $_POST['eventcategory']; 
  
        $isAdded = Events::AddEvents($e_title,$e_date,$e_location,$e_details,$e_category);
        
        if($isAdded){
            echo "<script>alert('Event Added Successfully')</script>";
            $goto = get_url("events");
           echo "<script>
               location.href='$goto' 
                
                </script>" ;
        }
        else{
            echo "<script>
                alert('Invalid Event Details' ); 
                
                </script>" ;
            
        }
        
    }
    

?>
