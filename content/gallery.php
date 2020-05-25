<?php

require_once("./classes/Gallery.php")

?>

<div class="card">
    <div class="card-header bg-primary text-white">Event Gallary<span class='float-right'> <a href="content.php"><i class='fas fa-backspace fa-2x' style='color: #F5F5F5;'></i></a></span></div>
    <div class="card-body row bg-light">


        <?php 
        $images = Gallery::GetImages();
       
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