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
                                            <li><a href="<?= base_url()?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                                            <li>
                                                <a href="#"><i class="fa fa-cubes"></i> <span>Master</span> </a>
                                                <ul>
                                                    <li><a href="<?= base_url()?>department"><i class="fa fa-caret-right"></i> Department</a></li>
                                                   <li><a href="<?= base_url()?>designation"><i class="fa fa-caret-right"></i> Designation</a></li>
                                                   <li><a href="<?= base_url()?>role"><i class="fa fa-caret-right"></i> Role</a></li>
                                                    <li><a href="<?= base_url()?>payment_mode"><i class="fa fa-caret-right"></i> Payment Mode</a></li>
                                                     <li><a href="<?= base_url()?>payment_status"><i class="fa fa-caret-right"></i> Payment Status</a></li>
                                                    <li><a href="<?= base_url()?>employee_types"><i class="fa fa-caret-right"></i> Employee Types</a></li>
                                                </ul>
                                            </li>
					<li>
                                                <a href="#"><i class="fa  fa-gear"></i> <span>Setup</span> </a>
                                                <ul>
                                                    <li><a href="<?= base_url()?>page_master"><i class="fa fa-caret-right"></i> Page</a></li>
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
