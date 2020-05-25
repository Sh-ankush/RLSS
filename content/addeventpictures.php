<?php

require_once( './classes/Gallery.php' );

 if(isset($_GET['id']) && isset($_GET['name']))
    {
        $eventId = $_GET['id'];
        $eventname = $_GET['name'];
        
    }

?>
<h3><?= $eventname ?></h3>
<hr />
<div class="card">

    <div class="card-header bg-primary text-white">
        Add Event Images
        <span class='float-right'> <a href="<?= get_url('events') ?>"><i class='fas fa-backspace fa-2x' style='color: #F5F5F5;'></i></a></span>
    </div>
    <div class="card-body">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            Select images to upload:
            <input type="file" name="fileToUpload[]" id="fileToUpload" multiple>

            <input class="btn btn-primary" type="submit" value="Upload Images" name="submit">
        </form>

    </div>
</div>

<?php 

    if(isset($_POST['submit'])){
        
            $upload_dir = '/img/events/'; 
            $event_images = $_FILES['fileToUpload'];
               
            $isUpdated = Gallery::AddImages($upload_dir,$event_images,$eventId,'events');
            
            if($isUpdated){
                echo "<div id='msg'>";
                for($i=0;$i<count($isUpdated);$i++){
                     echo '<div class="alert alert-info alert-dismissible fade show my-2" role="alert">
		'.$isUpdated[$i].'
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
</div>';
                echo "</div>";
                    
                    $goto = get_url("events");
                    echo "<script>
                    location.href='$goto' 
                
                    </script>" ;
                   

                }
               
            }
            else{
                echo "<script>
                    alert('Upload Failed! please retry.' ); 

                    </script>" ;

            }
    }
?>

<br><br>
<div class="card">
    <div class="card-header bg-primary text-white">Event Gallary</div>
    <div class="card-body row bg-light">


        <?php 
        $images = Gallery::GetImagesById($eventId,'events');
       
        if(!$images)
        {
            echo"No Images";
        }
        else{
            foreach($images as $image)
            {
                 ?>
        <div class="col-12 col-md-3">
            <div class="card mb-3">
                <div class="card-body">

                    <img src="<?= $image['p_path'] ?>" class="img-thumbnail">


                </div>
                <div class="card-footer mx-auto">
                    <a class="btn btn-secondary" href="<?= get_url('deleteimage')."&id=".$image['p_id'] ?>" role="button"><i class='fas fa-trash' style='color: #fff;'></i></a>
                    <a class="btn btn-primary" data-fancybox="gallery" href="<?= $image['p_path'] ?>" role="button"><i class='fas fa-eye' style='color: #fff;'></i></a>
                </div>

            </div>
        </div>
        <?php
            }
        }
        ?>
    </div>


</div>
<script>
    //   document.addEventListener('DOMContentLoaded', (event) => {
    //  //the event occurred
    //      setTimeout(function(){
    //          document.getElementById("msg").style.display="none";
    //          
    //      },3000);
    //       
    //})

</script>
