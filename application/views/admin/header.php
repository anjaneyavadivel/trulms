<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js" lang=""> <!--<![endif]-->
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>TruLMS - <?= $pageTitle ?></title>
        <link rel="icon" type="image/ico" href="<?= base_url(); ?>assets/images/favicon.ico" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- ============================================
        ================= Stylesheets ===================
        ============================================= -->
        <!-- vendor css files -->
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/vendor/animate.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/vendor/font-awesome.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/js/vendor/animsition/css/animsition.min.css">
        <?php
        $segment1 = $this->uri->segment(1);
        if (isset($table)) {
            ?>
            <link rel="stylesheet" href="<?= base_url() ?>assets/js/vendor/animsition/css/animsition.min.css">
            <link rel="stylesheet" href="<?= base_url() ?>assets/js/vendor/datatables/css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="<?= base_url() ?>assets/js/vendor/datatables/datatables.bootstrap.min.css">
            <link rel="stylesheet" href="<?= base_url() ?>assets/js/vendor/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css">
            <link rel="stylesheet" href="<?= base_url() ?>assets/js/vendor/datatables/extensions/Responsive/css/dataTables.responsive.css">
            <link rel="stylesheet" href="<?= base_url() ?>assets/js/vendor/datatables/extensions/ColVis/css/dataTables.colVis.min.css">
            <link rel="stylesheet" href="<?= base_url() ?>assets/js/vendor/datatables/extensions/TableTools/css/dataTables.tableTools.min.css">
            <?php }
        ?>
        <link rel="stylesheet" href="<?= base_url() ?>assets/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">

        <!-- project main css files -->
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/main.css">
        <!--/ stylesheets -->
        <?php if ($segment1 == 'add-employee-role' || $segment1=='form-access'||$segment1 == 'form-access-history'){ ?>
            <link rel="stylesheet" href="<?= base_url()?>assets/js/vendor/chosen/chosen.css">
        <?php } ?>


        <!-- ==========================================
        ================= Modernizr ===================
        =========================================== -->
        <script src="<?= base_url(); ?>assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/vendor/jquery/jquery-1.11.2.min.js"></script>
        <!--/ modernizr -->


    </head>

    <body id="minovate" class="appWrapper sidebar-sm-forced">

        <!-- ====================================================
        ================= Application Content ===================
        ===================================================== -->
        <div id="wrap" class="animsition">


            <!-- ===============================================
            ================= HEADER Content ===================
            ================================================ -->
            <section id="header" class="<?= base_url();?>">
                <header class="clearfix">

                    <!-- Branding -->
                    <div class="branding">
                        <a class="brand" href="<?= base_url(); ?>">
                            <span><strong>Tru</strong>LMS <sub>0.1</sub></span> 
                        </a>
                        <a href="#" class="offcanvas-toggle visible-xs-inline"><i class="fa fa-bars"></i></a>
                    </div>
                    <!-- Branding end -->



                    <!-- Left-side navigation -->
                    <ul class="nav-left pull-left list-unstyled list-inline">
                        <li class="sidebar-collapse divided-right">
                            <a href="#" class="collapse-sidebar">
                                <i class="fa fa-outdent"></i>
                            </a>
                        </li>
                        
                    </ul>
                    <!-- Left-side navigation end -->


                    <!-- Right-side navigation -->
                    <ul class="nav-right pull-right list-inline">
                        <li class="dropdown users">

                            <a href class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span class="badge bg-lightred">2</span>
                            </a>

                            <div class="dropdown-menu pull-right with-arrow panel panel-default animated littleFadeInUp" role="menu">

                                <div class="panel-heading">
                                    You have <strong>2</strong> requests
                                </div>

                                <ul class="list-group">

                                    <li class="list-group-item">
                                        <a href="#" class="media">
                                            <span class="pull-left media-object thumb thumb-sm">
                                                <img src="<?= base_url(); ?>assets/images/arnold-avatar.jpg" alt="" class="img-circle">
                                            </span>
                                            <div class="media-body">
                                                <span class="block">Arnold sent you a request</span>
                                                <small class="text-muted">15 minutes ago</small>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="list-group-item">
                                        <a href="#" class="media">
                                            <span class="pull-left media-object  thumb thumb-sm">
                                                <img src="<?= base_url(); ?>assets/images/george-avatar.jpg" alt="" class="img-circle">
                                            </span>
                                            <div class="media-body">
                                                <span class="block">George sent you a request</span>
                                                <small class="text-muted">5 hours ago</small>
                                            </div>
                                        </a>
                                    </li>

                                </ul>

                                <div class="panel-footer">
                                    <a href="#">Show all requests <i class="fa fa-angle-right pull-right"></i></a>
                                </div>

                            </div>

                        </li>

                        <li class="dropdown messages">

                            <a href class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="badge bg-lightred">4</span>
                            </a>

                            <div class="dropdown-menu pull-right with-arrow panel panel-default animated littleFadeInDown" role="menu">

                                <div class="panel-heading">
                                    You have <strong>4</strong> messages
                                </div>

                                <ul class="list-group">

                                    <li class="list-group-item">
                                        <a href="#" class="media">
                                            <span class="pull-left media-object thumb thumb-sm">
                                                <img src="<?= base_url(); ?>assets/images/ici-avatar.jpg" alt="" class="img-circle">
                                            </span>
                                            <div class="media-body">
                                                <span class="block">Imrich sent you a message</span>
                                                <small class="text-muted">12 minutes ago</small>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="list-group-item">
                                        <a href="#" class="media">
                                            <span class="pull-left media-object  thumb thumb-sm">
                                                <img src="<?= base_url(); ?>assets/images/peter-avatar.jpg" alt="" class="img-circle">
                                            </span>
                                            <div class="media-body">
                                                <span class="block">Peter sent you a message</span>
                                                <small class="text-muted">46 minutes ago</small>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="list-group-item">
                                        <a href="#" class="media">
                                            <span class="pull-left media-object  thumb thumb-sm">
                                                <img src="<?= base_url(); ?>assets/images/random-avatar1.jpg" alt="" class="img-circle">
                                            </span>
                                            <div class="media-body">
                                                <span class="block">Bill sent you a message</span>
                                                <small class="text-muted">1 hour ago</small>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="list-group-item">
                                        <a href="#" class="media">
                                            <span class="pull-left media-object  thumb thumb-sm">
                                                <img src="<?= base_url(); ?>assets/images/random-avatar3.jpg" alt="" class="img-circle">
                                            </span>
                                            <div class="media-body">
                                                <span class="block">Ken sent you a message</span>
                                                <small class="text-muted">3 hours ago</small>
                                            </div>
                                        </a>
                                    </li>

                                </ul>

                                <div class="panel-footer">
                                    <a href="#">Show all messages <i class="pull-right fa fa-angle-right"></i></a>
                                </div>

                            </div>

                        </li>

                        <li class="dropdown notifications">

                            <a href class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell"></i>
                                <span class="badge bg-lightred">3</span>
                            </a>

                            <div class="dropdown-menu pull-right with-arrow panel panel-default animated littleFadeInLeft">

                                <div class="panel-heading">
                                    You have <strong>3</strong> notifications
                                </div>

                                <ul class="list-group">

                                    <li class="list-group-item">
                                        <a href="#" class="media">
                                            <span class="pull-left media-object media-icon bg-danger">
                                                <i class="fa fa-ban"></i>
                                            </span>
                                            <div class="media-body">
                                                <span class="block">User Imrich cancelled account</span>
                                                <small class="text-muted">6 minutes ago</small>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="list-group-item">
                                        <a href="#" class="media">
                                            <span class="pull-left media-object media-icon bg-primary">
                                                <i class="fa fa-bolt"></i>
                                            </span>
                                            <div class="media-body">
                                                <span class="block">New user registered</span>
                                                <small class="text-muted">12 minutes ago</small>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="list-group-item">
                                        <a href="#" class="media">
                                            <span class="pull-left media-object media-icon bg-greensea">
                                                <i class="fa fa-lock"></i>
                                            </span>
                                            <div class="media-body">
                                                <span class="block">User Robert locked account</span>
                                                <small class="text-muted">18 minutes ago</small>
                                            </div>
                                        </a>
                                    </li>

                                </ul>

                                <div class="panel-footer">
                                    <a href="#">Show all notifications <i class="fa fa-angle-right pull-right"></i></a>
                                </div>

                            </div>

                        </li>

                        <li class="dropdown nav-profile">

                            <a href class="dropdown-toggle" data-toggle="dropdown">
                            <?php 
							if($this->session->userdata('SESS_userPic')!='')
							{
								$img_url=base_url()."uploads/photo/".$this->session->userdata('SESS_userPic');
								if (@getimagesize($img_url))
								{
									?>
									<img src="<?=$img_url?>"  alt="" class="img-circle size-30x30">
									 <?php
								}
								else
								{
									?>
									<img src="<?=base_url()?>uploads/photo/no_image.jpg" alt="" class="img-circle size-30x30">
									<?php 
								}
							}
							else
							{
								?>
								<img src="<?=base_url()?>uploads/photo/no_image.jpg" alt="" class="img-circle size-30x30">
								<?php 
							}
				?>
                               
                                <span><?php if($this->session->userdata('SESS_userName'))echo  $this->session->userdata('SESS_userName')?> <i class="fa fa-angle-down"></i></span>
                            </a>

                            <ul class="dropdown-menu animated littleFadeInRight" role="menu">

                                <li>
                                    <a href="<?=base_url()?>profile">
                                        
                                        <i class="fa fa-user"></i>Profile
                                    </a>
                                </li>
                               
                                <li class="divider"></li>
                                <li>
                                    <a href="<?=base_url()?>lock-screeen">
                                        <i class="fa fa-lock"></i>Lock
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>logout">
                                        <i class="fa fa-sign-out"></i>Logout
                                    </a>
                                </li>

                            </ul>

                        </li>

                        <!--                        <li class="toggle-right-sidebar">
                                                    <a href="#">
                                                        <i class="fa fa-comments"></i>
                                                    </a>
                                                </li>-->
                    </ul>
                    <!-- Right-side navigation end -->



                </header>

            </section>
            <!--/ HEADER Content  -->
