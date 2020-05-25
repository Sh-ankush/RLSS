<?php

require_once( './classes/Events.php' );

if(isset($_GET['id']))
{
    $eventid = $_GET['id'];
    $isdeleted = Events::DeleteEvents($eventid);

    if($isdeleted)
    {
        echo "<script> alert('Event Deleted Successfully!')
         window.history.back();
        </script>";
        
    }
}

?>