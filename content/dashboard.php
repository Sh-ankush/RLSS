<?php

require_once('./classes/Events.php');
require_once('./classes/Programs.php');
require_once('./classes/Gallery.php');

$events =  Events::GetEventsCount();
$programs = Programs::GetProgramsCount();
$gallery = Gallery::GetGalleryCount();
?>

<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card bg-primary text-white shadow">

            <div class="card-body">
                <span class="font-weight-bold" style="font-size:44px"> <?= $programs['programs'] ?> </span>
                <div class="text-white-50 small"> Programs </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-6"><a href="<?= get_url('program') ?>"><i class='fas fa-plus-square fa-2x' style='color: #3F51B5;'></i></a></div>
                    <div class="col-6"><a href="<?= get_url('program') ?>"><i class='fas fa-arrow-right fa-2x float-right' style='color: #3F51B5;'></i></a></div>
                </div>
            </div>

        </div>
    </div>
    <div class="col-lg-4 mb-4">
        <div class="card bg-success text-white shadow">
            <div class="card-body">
                <span class="font-weight-bold" style="font-size:44px"><?= $events['events'] ?></span>
                <div class="text-white-50 small">Events</div>
            </div>
            <div class="card-footer ">
                <div class="row">
                    <div class="col-6 "><a href="<?= get_url('addevent') ?>"><i class='fas fa-plus-square fa-2x' style='color: #2E7D32;'></i></a></div>
                    <div class="col-6"><a href="<?= get_url('events') ?>"><i class='fas fa-arrow-right fa-2x float-right' style='color: #2E7D32;'></i></a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mb-4">
        <div class="card bg-info text-white shadow">
            <div class="card-body">
                <span class="font-weight-bold" style="font-size:44px"><?= $gallery['photos'] ?></span>
                <div class="text-white-50 small">Photos</div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-6"><a href="<?= get_url('addimage') ?>"><i class='fas fa-plus-square fa-2x' style='color: #009688;'></i></a></div>
                    <div class="col-6"><a href="<?= get_url('gallery') ?>"><i class='fas fa-arrow-right fa-2x float-right' style='color: #009688;'></i></a></div>
                </div>
            </div>
        </div>
    </div>

</div>
