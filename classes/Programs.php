<?php

require_once( './dbconnect.php' );

class Programs {
    
    
    public static function GetPrograms() {
        global $conn;
        $sql = "SELECT * from programs where isActive = 1 order by id desc";
        
        $result = $conn->query( $sql );

        if ( $result->num_rows > 0 ) {
            while( $row = $result->fetch_assoc() ) {

                $programs[] = $row;

            }
            return $programs;

        } else
        return false;
    }
    
    public static function GetProgramById($p_id = NULL) {
        global $conn;
        $sql = "select * from programs where id='$p_id'";
        
        $result = $conn->query( $sql );

        if ( $result->num_rows > 0 ) {
            while( $row = $result->fetch_assoc() ) {

                $event = $row;

            }
            return $event;

        } else
        return false;
    }

    public static function AddPrograms($title=NULL) {
        global $conn;
        
        if ( $title) {
            
            $sql = "INSERT INTO programs (title) VALUES ('$title')";
            
            if ( $conn->query( $sql ) === TRUE ) {
              
                return true;
            } else {
                return false;
            }
        } else {
            return 'false';
        }

       
    }
    
    public static function UpdatePrograms( $title=NULL, $p_id=NULL ) {
        global $conn;
        
        if ( $title && $p_id) {
            
            $sql = "update programs set title = '$title' where id = '$p_id'";
            
            if ( $conn->query( $sql ) === TRUE ) {
              
                return true;
            } else {
                return false;
            }
        } else {
            return 'false';
        }

       
    }
    
    public static function DeletePrograms($pId=NULL ) {
        global $conn;
        
        if ($pId) {
            
            $sql = "update programs set isActive = 0 where id = '$pId'";
            
            if ( $conn->query( $sql ) === TRUE ) {
              
                return true;
            } else {
                return false;
            }
        } else {
            return 'false';
        }

       
    }
    
     public static function GetProgramsCount() {
        global $conn;
        $sql = "SELECT count(*) as programs from programs where isActive = 1";
        
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
?>
    