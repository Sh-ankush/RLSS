<?php
require_once( './classes/Programs.php' );

?>


<div class='container-fluid'>
    <div>

        <div class="card">

            <div class="card-header bg-primary text-white">
                Add Programs

            </div>
            <div class="card-body">
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

                    <div class="input-group mb-3">
                        <input name="program" type="text" class="form-control" placeholder="Program Name" aria-label="program" aria-describedby="button-addon2" required>
                        <div class="input-group-append">
                            <button name="submit" class="btn btn-primary" type="submit" id="button-addon2">Add</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <br>
        <div class='card mx-auto W-100'>
            <div class='card-header  bg-primary text-white'>
                Program data


            </div>
            <div class='card-body p-0'>
                <div class='border text-center mx-auto '>
                    <?php
                        $program = Programs::GetPrograms();
                        if ( !$program ) {
                            echo 'No Record Found';
                        } else {

                    ?>
                    <table id='mytable' class='table table-bordred table-striped'>
                        <thead>

                            <th>Sno. </th>
                            <th>Program Name</th>

                            <th>Edit</th>
                            <th>Delete</th>

                        </thead>

                        <tbody>
                            <?php
                                $count = 0;
                                foreach ( $program as $k=>$e ) {
                            ?>
                            <tr>
                                <td>
                                    <?= ++  $count ?>
                                </td>
                                <td>
                                        <?= $e['title'] ?>
                                     </td>
                                <td>

                                    <a class="dropdown-item" href="<?= get_url('editprogram')."&id=".$e['id']."&name=".$e['title'] ?>"><i class='fas fa-edit fa-lg' style='color: #339af0;'></i></a>

                                </td>
                                <td>
                                    <a class="dropdown-item" href="<?= get_url('deleteprogram')."&id=".$e['id'] ?>"><i class='fas fa-trash fa-lg' style='color: #ff6b6b;'></i> </a>
                                </td>
                            </tr>
                            <?php }
        ?>
                    </table>
                    <?php }
        ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Modal Starts-->

<script>

    function getProgramId(var id)
    {
        document.getElementById("edit").style.display=block;
    }

</script>


<!--Modal Ends-->


<?php
        
    if(isset($_POST['submit'])){
        
       
        
            $program = $_POST['program'];
        
             echo "<script>alert($program)</script>";
            
        $isAdded = Programs::AddPrograms($program);
        
        if($isAdded){
            echo "<script>alert('Program Added Successfully')</script>";
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
