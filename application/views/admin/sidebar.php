<?php $this->load->view('admin/header');?>



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
                                            <li><a href="index.html"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                                            <li>
                                                <a href="#"><i class="fa fa-envelope-o"></i> <span>Department</span> </a>
                                                <ul>
                                                    <li><a href="<?= base_url()?>department"><i class="fa fa-caret-right"></i> Manage</a></li>
                                                    <li><a href="<?= base_url()?>add_department"><i class="fa fa-caret-right"></i> Add Table</a></li>
                                                   
                                                </ul>
                                            </li>
											
											
											<li>
                                                <a href="#"><i class="fa fa-envelope-o"></i> <span>Designation</span> </a>
                                                <ul>
                                                    <li><a href="<?= base_url()?>designation"><i class="fa fa-caret-right"></i> Designation</a></li>
                                                    <li><a href="<?= base_url()?>add_designation"><i class="fa fa-caret-right"></i> Add Designation</a></li>
                                                   
                                                </ul>
                                            </li>
											
											<li>
                                                <a href="#"><i class="fa fa-envelope-o"></i> <span>Role</span> </a>
                                                <ul>
                                                    <li><a href="<?= base_url()?>role"><i class="fa fa-caret-right"></i> Role</a></li>
                                                    <li><a href="<?= base_url()?>add_role"><i class="fa fa-caret-right"></i> Add Role</a></li>
                                                   
                                                </ul>
                                            </li>
											
											<li>
                                                <a href="#"><i class="fa fa-envelope-o"></i> <span>Payment Mode</span> </a>
                                                <ul>
                                                    <li><a href="<?= base_url()?>payment_mode"><i class="fa fa-caret-right"></i> Payment Mode</a></li>
                                                    <li><a href="<?= base_url()?>add_payment_mode"><i class="fa fa-caret-right"></i> Add Payment Mode</a></li>
                                                   
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa fa-envelope-o"></i> <span>Payment Status</span> </a>
                                                <ul>
                                                    <li><a href="<?= base_url()?>payment_status"><i class="fa fa-caret-right"></i> Payment Status</a></li>
                                                    <li><a href="<?= base_url()?>add_payment_status"><i class="fa fa-caret-right"></i> Add Payment Status</a></li>
                                                   
                                                </ul>
                                            </li>
											<li>
                                                <a href="#"><i class="fa fa-envelope-o"></i> <span>Employee Types</span> </a>
                                                <ul>
                                                    <li><a href="<?= base_url()?>employee_types"><i class="fa fa-caret-right"></i> Employee Types</a></li>
                                                    <li><a href="<?= base_url()?>add_employee_types"><i class="fa fa-caret-right"></i> Add Employee Types</a></li>
                                                   
                                                </ul>
                                            </li>
                                            
                                         
                                        </ul>
                                        <!--/ NAVIGATION Content -->
                                        
                                        
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>

                    </div>


                </aside>
                <!--/ SIDEBAR Content -->
