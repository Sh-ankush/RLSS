<?php

require_once( './dbconnect.php' );

class Gallery{
    
    public static function AddImages($target_dir = NULL,$file_array=NULL, $event_Id=NULL,$event_type=NULL) 
    {
        
        
        $upload_dir = './img/'.$event_type.'/'; 
        $allowed_types = array('jpg', 'png', 'jpeg', 'gif'); 
        $fileCount = count($file_array['name']);
        $isUploaded = false;
        // Define maxsize for files i.e 5MB 
        $maxsize = 5 * 1024 * 1024;  
        $message="";

        // Checks if user sent an empty form  
        if(count($file_array)) { 
            $filenames = [];
            $okflag = 0;
            $errors = [];
            // Loop through each file in files[] array 
            for ($i = 0; $i < $fileCount; $i++) { 
              
            
            $file_tmpname = $file_array['tmp_name'][$i]; 
            $file_name = $file_array['name'][$i]; 
            $file_size = $file_array['size'][$i]; 
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION); 
  
            //Set upload file path 
            $newfilename = uniqid().$file_name;
            $filepath = $upload_dir.$newfilename;
            
            // Check file type is allowed or not 
            if(in_array(strtolower($file_ext), $allowed_types)) { 
  
                // Verify file size - 5MB max  
                if ($file_size > $maxsize)
                {
                     array_push($errors,"Error: File size is larger than the allowed limit."); 
                    $okflag = 0;
                }

                    if( move_uploaded_file($file_tmpname, $filepath)) {
                        
                        $IsSaved = Gallery::SaveImages($newfilename,$filepath,$event_Id,$event_type);
                        array_push($filenames,$newfilename); 
                        $okflag = 1;
                        
                    } 
                    else {                      
                        array_push($errors,"Error uploading {$newfilename}");
                        $okflag = 0;   
                    } 
                 
            } 
            else { 
                  
                // If file extention not valid 
                 
                array_push($errors,"{$newfilename} file type is not allowed"); 
                $okflag = 0;   

            }  
        } 
            if($okflag==1 && empty($errors)){
                return $filenames;
            } else{
               return $errors; 
            }
        } else { 
            // If no files selected 
            array_push($errors, "No files selected"); 
            $okflag = 0;   
            return $errors; 
        } 
       
 
} 
    
     public static function AddOtherImages($target_dir = NULL,$file_array=NULL) 
    {
        
        
        $upload_dir = './img/others/'; 
        $allowed_types = array('jpg', 'png', 'jpeg', 'gif'); 
        $fileCount = count($file_array['name']);
        $isUploaded = false;
        // Define maxsize for files i.e 5MB 
        $maxsize = 5 * 1024 * 1024;  
        $message="";

        // Checks if user sent an empty form  
        if(count($file_array)) { 
            $filenames = [];
            $okflag = 0;
            $errors = [];
            // Loop through each file in files[] array 
            for ($i = 0; $i < $fileCount; $i++) { 
              
            
            $file_tmpname = $file_array['tmp_name'][$i]; 
            $file_name = $file_array['name'][$i]; 
            $file_size = $file_array['size'][$i]; 
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION); 
  
            //Set upload file path 
            $newfilename = uniqid().$file_name;
            $filepath = $upload_dir.$newfilename;
            
            // Check file type is allowed or not 
            if(in_array(strtolower($file_ext), $allowed_types)) { 
  
                // Verify file size - 5MB max  
                if ($file_size > $maxsize)
                {
                     array_push($errors,"Error: File size is larger than the allowed limit."); 
                    $okflag = 0;
                }

                    if( move_uploaded_file($file_tmpname, $filepath)) {
                        
                        $IsSaved = Gallery::SaveOtherImages($newfilename,$filepath,'other');
                        array_push($filenames,$newfilename); 
                        $okflag = 1;
                        
                    } 
                    else {                      
                        array_push($errors,"Error uploading {$newfilename}");
                        $okflag = 0;   
                    } 
                 
            } 
            else { 
                  
                // If file extention not valid 
                 
                array_push($errors,"{$newfilename} file type is not allowed"); 
                $okflag = 0;   

            }  
        } 
            if($okflag==1 && empty($errors)){
                return $filenames;
            } else{
               return $errors; 
            }
        } else { 
            // If no files selected 
            array_push($errors, "No files selected"); 
            $okflag = 0;   
            return $errors; 
        } 
       
 
} 
    
    public static function SaveImages( $p_name=NULL,$p_location=NULL,$p_eventId=NULL,$p_type=NULL ) {
        global $conn;
        
        if ( $p_name && $p_location && $p_eventId) {
            
            $sql = "INSERT INTO photos (p_name,p_path,p_eventId,p_type) VALUES ('$p_name','$p_location','$p_eventId','$p_type')";
            
            if ( $conn->query( $sql ) === TRUE ) {
              
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

       
    }
     
    public static function SaveOtherImages( $p_name=NULL,$p_location=NULL,$p_type=NULL ) {
        global $conn;
        
        if ( $p_name && $p_location && $p_type) {
            
            $sql = "INSERT INTO photos (p_name,p_path,p_eventId,p_type) VALUES ('$p_name','$p_location','0','$p_type')";
            
            if ( $conn->query( $sql ) === TRUE ) {
              
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

       
    }
    
    public static function GetImages() {
        global $conn;
        $sql = "SELECT * FROM photos WHERE isActive = 1 order by p_id desc";
        $result = $conn->query( $sql );

        if ( $result->num_rows > 0 ) {
            while( $row = $result->fetch_assoc() ) {

                $events[] = $row;

            }
            return $events;

        } else
        return false;
    }
    
    
    public static function GetImagesById($event_Id,$event_type) {
        global $conn;
        $sql = "SELECT * FROM photos WHERE p_eventId = '$event_Id' and p_type = '$event_type' and isActive = 1 order by p_id desc";
        $result = $conn->query( $sql );

        if ( $result->num_rows > 0 ) {
            while( $row = $result->fetch_assoc() ) {

                $events[] = $row;

            }
            return $events;

        } else
        return false;
    }
    
    
    public static function DeletePictures($pId=NULL ) {
        global $conn;
        
        if ($pId) {
            
            $sql = "update photos set isActive = 0 where p_id = '$pId'";
            
            if ( $conn->query( $sql ) === TRUE ) {
              
                return true;
            } else {
                return false;
            }
        } else {
            return 'false';
        }

       
    }
    
    
    public static function GetGalleryCount() {
        global $conn;
        $sql = "SELECT count(*) as photos from photos where isActive = 1";
        
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