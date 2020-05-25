<?php

require_once('./classes/Gallery.php');

?>
<div class="card">

    <div class="card-header bg-primary text-white">
        Add Event Images
        <span class='float-right'> <a href="content.php"><i class='fas fa-backspace fa-2x' style='color: #F5F5F5;'></i></a></span>
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
               
            $isUpdated = Gallery::AddOtherImages($upload_dir,$event_images);
            
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
                    
//                    $goto = get_url("events");
//                    echo "<script>
//                    location.href='$goto' 
//                
//                    </script>" ;
                   

                }
               
            }
            else{
                echo "<script>
                    alert('Upload Failed! please retry.' ); 

                    </script>" ;

            }
    }
?>