<?php $this->load->view('admin/header'); ?>



<!-- =================================================
================= CONTROLS Content ===================
================================================== -->
<div id="controls">





    <!-- ================================================
    ================= SIDEBAR Content ===================
    ================================================= -->
    <aside id="sidebar">


        <div id="sidebar-wrap">

            <div class="panel-group slim-scroll" role="tablist">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#sidebarNav">
                                Navigation <i class="fa fa-angle-up"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="sidebarNav" class="panel-collapse collapse in" role="tabpanel">
                        <div class="panel-body">


                            <!-- ===================================================
                            ================= NAVIGATION Content ===================
                            ==================================================== -->
                            <ul id="navigation">
                                <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

                                 <?php
                                $loop = 0;
                                $whereData = array('parentID' => 1, 'dbentrystateID' => 3, 'active' => 1);
                                $master = selectTable('tblpages', $whereData);
                                if (isset($master) && $master->num_rows() > 0) {
                                    foreach ($master->result() as $value) {
                                        if (checkpageaccess($value->url, 1, 'menu')) {
                                            if ($loop == 0) {
                                                ?>
                                                <li>
                                                    <a href="#"><i class="fa fa-cubes"></i> <span>Master</span> </a>   
                                                    <ul><?php } ?> 

                                                    <li><a href="<?= base_url() . $value->url ?>" title="<?= $value->tooltip ?>"><i class="<?= $value->icon ?>"></i> <?= ucwords($value->menuCaption) ?></a></li>
                                                    <?php
                                                    $loop = 1;
                                                }
                                            }if ($loop == 1) {
                                                ?>   
                                            </ul>
                                        </li>
                                        <?php
                                    }
                                }
                                $loop = 0;
                                $whereData = array('parentID' => 2, 'dbentrystateID' => 3, 'active' => 1);
                                $master = selectTable('tblpages', $whereData);
                                if (isset($master) && $master->num_rows() > 0) {
                                    foreach ($master->result() as $value) {
                                        if (checkpageaccess($value->url, 1, 'menu')) {
                                            if ($loop == 0) {
                                                ?>
                                                <li>
                                                    <a href="#"><i class="fa  fa-gear"></i> <span>Setup</span> </a>
                                                    <ul>
                                                    <?php } ?> 
                                                    <li><a href="<?= base_url() . $value->url ?>" title="<?= $value->tooltip ?>"><i class="<?= $value->icon ?>"></i> <?= ucwords($value->menuCaption) ?></a></li>
                                                    <?php
                                                    $loop = 1;
                                                }
                                            }if ($loop == 1) {
                                                ?>   
                                            </ul>
                                        </li>
                                        <?php
                                    }
                                }
                                $loop = 0;
                                $whereData = array('parentID' => 3, 'dbentrystateID' => 3, 'active' => 1);
                                $master = selectTable('tblpages', $whereData);
                                if (isset($master) && $master->num_rows() > 0) {
                                    foreach ($master->result() as $value) {
                                        if (checkpageaccess($value->url, 1, 'menu')) {
                                            if ($loop == 0) {
                                                ?>
                                                <li>
                                                    <a href="#"><i class="fa  fa-gear"></i> <span>Operations</span> </a>
                                                    <ul>

                                                    <?php } ?> 
                                                    <li><a href="<?= base_url() . $value->url ?>" title="<?= $value->tooltip ?>"><i class="<?= $value->icon ?>"></i> <?= ucwords($value->menuCaption) ?></a></li>
                                                    <?php
                                                    $loop = 1;
                                                }
                                            }if ($loop == 1) {
                                                ?>   
                                            </ul>
                                        </li>
                                        <?php
                                    }
                                }
                                $loop = 0;
                                $whereData = array('parentID' => 4, 'dbentrystateID' => 3, 'active' => 1);
                                $master = selectTable('tblpages', $whereData);
                                if (isset($master) && $master->num_rows() > 0) {
                                    foreach ($master->result() as $value) {
                                        if (checkpageaccess($value->url, 1, 'menu')) {
                                            if ($loop == 0) {
                                                ?>
                                                <li>
                                                    <a href="#"><i class="fa  fa-gear"></i> <span>Report(later)</span> </a>
                                                    <ul>
                                                    <?php } ?>   
                                                    <li><a href="<?= base_url() . $value->url ?>" title="<?= $value->tooltip ?>"><i class="<?= $value->icon ?>"></i> <?= ucwords($value->menuCaption) ?></a></li>
                                                    <?php
                                                    $loop = 1;
                                                }
                                            }if ($loop == 1) {
                                                ?>   
                                            </ul>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>




                            </ul>
                            <!--/ NAVIGATION Content -->


                        </div>
                    </div>
                </div>


            </div>

        </div>


    </aside>
    <!--/ SIDEBAR Content -->
