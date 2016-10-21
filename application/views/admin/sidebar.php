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
                                                    <li><a href="<?= base_url()?>company"><i class="fa fa-caret-right"></i> Company</a></li>
                                                    <li><a href="<?= base_url()?>branch"><i class="fa fa-caret-right"></i> Branch</a></li>
                                                    <li><a href="<?= base_url()?>bank"><i class="fa fa-caret-right"></i> Bank Details (later)</a></li>
                                                    <li><a href="<?= base_url()?>employee"><i class="fa fa-caret-right"></i> Employee</a></li>
                                                    <li><a href="<?= base_url()?>consignee"><i class="fa fa-caret-right"></i> Consignee(later)</a></li>
                                                    <li><a href="<?= base_url()?>contract"><i class="fa fa-caret-right"></i> Contract / Consignor</a></li>
                                                    <li><a href="<?= base_url()?>vehicleagent"><i class="fa fa-caret-right"></i> Vehicle Agent(later)</a></li>
                                                    <li><a href="<?= base_url()?>vehicleowner"><i class="fa fa-caret-right"></i> Vehicle / Owner(later)</a></li>
                                                    <li><a href="<?= base_url()?>driver"><i class="fa fa-caret-right"></i> Driver</a></li>
                                                    <li><a href="<?= base_url()?>contracttype"><i class="fa fa-caret-right"></i> Contract Type(later)</a></li>
                                                    <li><a href="<?= base_url()?>payment-mode"><i class="fa fa-caret-right"></i> Payment Mode(later)</a></li>
                                                     <li><a href="<?= base_url()?>payment-status"><i class="fa fa-caret-right"></i> Payment Status(later)</a></li>
                                                    <li><a href="<?= base_url()?>department"><i class="fa fa-caret-right"></i> Department</a></li>
                                                    <li><a href="<?= base_url()?>designation"><i class="fa fa-caret-right"></i> Designation</a></li>
                                                    <li><a href="<?= base_url()?>employee-types"><i class="fa fa-caret-right"></i> Employee Types</a></li>
                                                    <li><a href="<?= base_url()?>role"><i class="fa fa-caret-right"></i> Role</a></li>
                                                     <li><a href="<?= base_url()?>form-master"><i class="fa fa-caret-right"></i> Forms / Pages</a></li>
                                                </ul>
                                            </li>
					<li>
                                                <a href="#"><i class="fa  fa-gear"></i> <span>Setup</span> </a>
                                                <ul>
                                                    <li><a href="<?= base_url()?>employee-role"><i class="fa fa-caret-right"></i> Employee Role</a></li>
                                                    <li><a href="<?= base_url()?>form-access"><i class="fa fa-caret-right"></i> Form Access</a></li>
                                                 </ul>
                                            </li>
					<li>
                                                <a href="#"><i class="fa  fa-gear"></i> <span>Operations</span> </a>
                                                <ul>
                                                    <li><a href="<?= base_url()?>booking"><i class="fa fa-caret-right"></i> Booking</a></li>
                                                    <li><a href="<?= base_url()?>create-trip-sheet"><i class="fa fa-caret-right"></i> Create Trip Sheet</a></li>
                                                    <li><a href="<?= base_url()?>delivery-closure"><i class="fa fa-caret-right"></i> Delivery Closure</a></li>
                                                    <li><a href="<?= base_url()?>generate-invoice"><i class="fa fa-caret-right"></i> Generate Invoice</a></li>
                                                    <li><a href="<?= base_url()?>trip-payment-update"><i class="fa fa-caret-right"></i> Trip Payment Update</a></li>
                                                 </ul>
                                            </li>
					<li>
                                                <a href="#"><i class="fa  fa-gear"></i> <span>Report(later)</span> </a>
                                                <ul>
                                                    <li><a href="<?= base_url()?>report-balance-sheet"><i class="fa fa-caret-right"></i> Balance Sheet(later)</a></li>
                                                    <li><a href="<?= base_url()?>report-booking"><i class="fa fa-caret-right"></i> Booking(later)</a></li>
                                                    <li><a href="<?= base_url()?>report-trip-sheet"><i class="fa fa-caret-right"></i> Trip Sheet(later)</a></li>
                                                    <li><a href="<?= base_url()?>report-invoice"><i class="fa fa-caret-right"></i> Trip Invoice(later)</a></li>
                                                    <li><a href="<?= base_url()?>report-payment"><i class="fa fa-caret-right"></i> Trip Payment(later)</a></li>
                                                    <li><a href="<?= base_url()?>report-company"><i class="fa fa-caret-right"></i> Company / Branch(later)</a></li>
                                                    <li><a href="<?= base_url()?>report-consignee"><i class="fa fa-caret-right"></i> Consignee(later)</a></li>
                                                    <li><a href="<?= base_url()?>report-contract"><i class="fa fa-caret-right"></i> Contract / Consignor(later)</a></li>
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
