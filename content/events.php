<?php
require_once( './classes/Events.php' );

?>


<div class='container-fluid'>
    <div>

        <div class='card mx-auto W-100'>
            <div class='card-header  bg-primary text-white'>
                Events Table data

                <span class='float-right'> <a href="<?= get_url('addevent') ?>"><i class='fas fa-plus-square fa-2x' style='color: #F5F5F5;'></i></a></span>
            </div>
            <div class='card-body p-0'>
                <div class='border text-center mx-auto '>
                    <?php
                        $events = Events::GetEvents();
                        if ( !$events ) {
                            echo 'No Record Found';
                        } else {

                    ?>
                    <table id='mytable' class='table table-bordred table-striped'>
                        <thead>

                            <th>Sno. </th>
                            <th>Event Name</th>
                            <th>Event Date</th>
                            <th>Event Location</th>
                            <th>Event Details</th>
                            <th>Event Category</th>
                            <th>Gallery</th>
                            <th>Action</th>

                        </thead>

                        <tbody>
                            <?php
                                $count = 0;
                                foreach ( $events as $k=>$e ) {
                            ?>

                            <tr>
                                <td>
                                    <?= ++  $count ?>
                                </td>
                                <td>
                                    <?= $e['e_title'] ?>
                                </td>
                                <td>
                                    <?= $e['e_date'] ?>
                                </td>

                                <td>
                                    <?= $e['e_location'] ?>
                                </td>
                                <td>
                                   <p><?= $e['e_details'] ?></p> 
                                </td>
                                <td>
                                    <?= $e['e_category'] ?>
                                </td>
                                <td><?= $e['photos'] ?></td>
                                <td>
                                    <div class='row p-1'>
                                        
                                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                <a href="<?= get_url('addeventpictures')."&id=".$e['id']."&name=".$e['e_title'] ?>" class="btn btn-primary btn-sm border" data-toggle="tooltip" data-placement="top" title="Add event image"><i class='fas fa-images fa-lg' style='color: #fff;'></i></a>

                                                <div class="btn-group" role="group">
                                                     <a class="text-white btn btn-sm btn-primary border" data-toggle="dropdown">
                                                    <i class='fas fa-caret-down fa-lg' style='color: #fff;'></i>
                                                </a>
                                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                         <a class="dropdown-item" href="<?= get_url('editevent')."&id=".$e['id'] ?>"><i class='fas fa-edit fa-lg' style='color: #339af0;'></i> Edit Event</a>
                                                    <a class="dropdown-item" href="<?= get_url('deleteevent')."&id=".$e['id'] ?>"><i class='fas fa-trash fa-lg' style='color: #ff6b6b;'></i> Delete Event</a>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>

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
<!-- The Modal is dead -->
