<?php

require_once( './classes/Gallery.php' );

if(isset($_GET['id']))
{
    $pid = $_GET['id'];
    $isdeleted = Gallery::DeletePictures($pid);
    
    if($isdeleted)
    {
        echo "<script> alert('Image Deleted Successfully!')
         window.history.back();
        </script>";
        
    }
}

?>