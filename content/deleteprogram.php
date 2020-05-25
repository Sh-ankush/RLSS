<?php

require_once( './classes/Programs.php' );

if(isset($_GET['id']))
{
    $pid = $_GET['id'];
    $isdeleted = Programs::DeletePrograms($pid);

    if($isdeleted)
    {
        echo "<script> alert('Program Deleted Successfully!')
         window.history.back();
        </script>";
        
    }
}

?>