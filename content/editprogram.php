<?php 

require_once('./classes/Programs.php');
    
    if(isset($_GET['id']) && isset($_GET['name']))
    {
        $id = $_GET['id'];
        $name = $_GET['name'];
        
    }
?>

<div class='container-fluid'>
    <div>

        <div class="card">

            <div class="card-header bg-primary text-white">
                Update Program
                 <span class='float-right'> <a href="<?= get_url('program') ?>"><i class='fas fa-backspace fa-2x' style='color: #F5F5F5;'></i></a></span>
            </div>
            <div class="card-body">
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

                    <div class="input-group mb-3">
                        <input name="program" type="text" class="form-control" value="<?= $name ?>" aria-label="program" aria-describedby="button-addon2" required>
                        <div class="input-group-append">
                            <button name="submit" class="btn btn-primary" type="submit" id="button-addon2">Save</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?php

    if(isset($_POST['submit'])){
        
            $p_title = $_POST['program'];
            
        $isAdded = Programs::UpdatePrograms($p_title,$id);
        
        if($isAdded){
            echo "<script>alert('Program Updated Successfully')</script>";
            $goto = get_url("program");
           echo "<script>
               location.href='$goto' 
                
                </script>" ;
        }
        else{
            echo "<script>
                alert('Invalid Program Details' ); 
                
                </script>" ;
            
        }
        
    }
    

?>