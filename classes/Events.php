<?php

require_once( './dbconnect.php' );

class Events {
    
    
    public static function GetEvents() {
        global $conn;
        $sql = "SELECT e.*,count(p.p_id) as photos from events e left join photos p on e.id = p.p_eventId where e.isActive = 1 and p.isActive = 1 GROUP BY e.id order by e.id desc";
        
        $result = $conn->query( $sql );

        if ( $result->num_rows > 0 ) {
            while( $row = $result->fetch_assoc() ) {

                $events[] = $row;

            }
            return $events;

        } else
        return false;
    }
    
    public static function GetEventById($e_id = NULL) {
        global $conn;
        $sql = "select * from events where id='$e_id'";
        
        $result = $conn->query( $sql );

        if ( $result->num_rows > 0 ) {
            while( $row = $result->fetch_assoc() ) {

                $event = $row;

            }
            return $event;

        } else
        return false;
    }

    public static function AddEvents( $e_title=NULL,$e_date=NULL,$e_location=NULL,$e_details=NULL,$e_category=NULL ) {
        global $conn;
        
        if ( $e_title && $e_date && $e_location && $e_details && $e_category) {
            
            $sql = "INSERT INTO events (e_title,e_date,e_location,e_details,e_category) VALUES ('$e_title','$e_date','$e_location','$e_details','$e_category')";
            
            if ( $conn->query( $sql ) === TRUE ) {
              
                return true;
            } else {
                return false;
            }
        } else {
            return 'false';
        }

       
    }
    
    public static function UpdateEvents( $e_title=NULL,$e_date=NULL,$e_location=NULL,$e_details=NULL,$e_category=NULL,$eventId=NULL ) {
        global $conn;
        
        if ( $e_title && $e_date && $e_location && $e_details && $e_category) {
            
            $sql = "update events set e_title = '$e_title', e_date = '$e_date', e_location = '$e_location',
                     e_details = '$e_details', e_category = '$e_category' where id = '$eventId'";
            
            if ( $conn->query( $sql ) === TRUE ) {
              
                return true;
            } else {
                return false;
            }
        } else {
            return 'false';
        }

       
    }
    
    public static function DeleteEvents($eventId=NULL ) {
        global $conn;
        
        if ( $eventId) {
            
            $sql = "update events set isActive = 0 where id = '$eventId'";
            
            if ( $conn->query( $sql ) === TRUE ) {
              
                return true;
            } else {
                return false;
            }
        } else {
            return 'false';
        }

       
    }
    
    public static function GetEventsCount() {
        global $conn;
       $sql = "SELECT count(*) as events from events where isActive = 1";
        
        $result = $conn->query( $sql );

        if ( $result->num_rows > 0 ) {
            while( $row = $result->fetch_assoc() ) {

                $programs = $row;

            }
            return $programs;

        } else
        return false;
    }
   
}
