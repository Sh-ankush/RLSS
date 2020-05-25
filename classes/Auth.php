<?php 

require_once('./dbconnect.php');
class Auth
{
    
    public function CheckLogin($username = NULL, $password = NULL)
    {
        
        if($username && $password)
        {
            global $conn;
            $sql = "SELECT * FROM users WHERE username='".$username."' AND password='".$password."' limit 1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
  // output data of each row
                  while($row = $result->fetch_assoc()) {
                    //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                      
                      unset($row['password']);
                      $_SESSION["user_details"] = $row;
                      
                      
  }
                return true;
             
            } else {
              return false;
            }
        
        }
        else
        {
            return "all feilds are required";
        }
        
        $conn->close();

        
    }
    
}


?>
