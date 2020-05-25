<?php
require_once( './classes/Events.php' );

 if(isset($_GET['id']))
    {
        $eventId = $_GET['id'];
       
        
    }
$event = Events::GetEventById($eventId);

require_once( './classes/Programs.php' );

$programs = Programs::GetPrograms();


?>

<script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
</script>
<div class="card">

    <div class="card-header bg-primary text-white">
        Edit Event Details
        <span class='float-right'> <a href="<?= get_url('events') ?>"><i class='fas fa-backspace fa-2x' style='color: #F5F5F5;'></i></a></span>
    </div>

    <div class="card-body">
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
            <div class="form-group ">
                <label for="exampleFormControlInput1">Add Event Title</label>
                <input name="eventname" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Event title" value= "<?= $event['e_title'] ?>" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Add Event Date</label>
                <div class='input-group'>
                
                <?php 
                    $date = strtotime($event['e_date']);
                     $eventdate = date('d-m-yy',$date);                   
                
                ?>
                <input name="eventdate" type="text" data-default-date="<?= $eventdate ?>" class="form-control datefield" value="<?= $eventdate ?>" required>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Add Event Location</label>
                <input name="eventlocation" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Event location" value="<?= $event['e_location'] ?>" required>
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Event Details</label>
                <textarea name="eventdetails" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Event Details" required> <?= $event['e_details'] ?></textarea>
            </div>

            <div class="form-group">
                <label for="sel1">Select Event Category (select one):</label>
                <select class="form-control" id="sel1" name="eventcategory">
                    <option selected> <?= $event['e_category'] ?></option>
                     <?php 
                        if($programs)
                        {
                             foreach ( $programs as $k=>$e ) {
                                 if(!($e['title'] == $event['e_category']))
                                 {
                                     echo "<option>".$e['title']."</option>";
                                 }
                                 
                                
                             }
                        }
                    ?> 
                
                    <option selected> <?= $event['e_category'] ?></option>
                   
                </select>
            </div>
                <button type="reset" class="btn btn-primary">Clear</button>

                <button type="submit" name="submit" class="btn btn-primary">Save</button>

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
  
        $isAdded = Events::UpdateEvents($e_title,$e_date,$e_location,$e_details,$e_category,$eventId);
        
        if($isAdded){
            echo "<script>alert('Event Edited Successfully')</script>";
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
