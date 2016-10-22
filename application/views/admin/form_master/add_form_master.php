
<?php $this->load->view('admin/sidebar') ?>
<!-- =================================================
================= RIGHTBAR Content ===================
================================================== -->
<!--/ RIGHTBAR Content -->
</div>
<!--/ CONTROLS Content -->
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

    <div class="page page-forms-validate">

        <div class="pageheader">

            <h2>Add <?= $pageTitle ?> </h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="<?= base_url() ?>"><i class="fa fa-home"></i> HOME</a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>form-master"><?= $pageTitle ?> Master</a>
                    </li>
                    <li>
                        <a href="javascript::">Add <?= $pageTitle ?></a>
                    </li>
                </ul>

            </div>

        </div>


        <!-- row -->
        <div class="row">




   <?= form_open_multipart(base_url() . 'add-form-master', array('class' => 'form-horizontal', 'id' => 'form4', 'role' => 'form', 'data-parsley-validate' => '')); ?>

            <!-- col -->
            <div class="col-md-6 insert_forms add_forms">

                <!-- tile -->

                <!-- /tile -->
                <?php $this->load->view('admin/msg') ?>

                <!-- tile -->
                <section class="tile">

                    <!-- tile header -->
                    <div class="tile-header dvd dvd-btm bg-greensea">
                        <h1 class="custom-font"><strong>ADD</strong> <?= $pageTitle ?></h1>

                    </div>
                    <!-- /tile header -->

                    <!-- tile body -->
                    <div class="tile-body">

                     

                        <div class="form-group">
                            <label class=" control-label">Form Name <span class="required">*</span></label>

                            <input type="text" name="name" class="form-control" placeholder="Designation Name"
                                   data-parsley-trigger="change"
                                   required>

                        </div>
                        <div class="form-group">
                            <label class=" control-label">Parent Category <span class="required">*</span></label>
                            <select class="form-control mb-10">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                           

                        </div>



                        <div class="form-group">
                            <label class=" control-label">URl <span class="required">*</span></label>

                            <input type="text" name="description" class="form-control" placeholder="Designation Description"
                                   data-parsley-trigger="change"
                                   required>

                        </div>

                        <!-- tile footer -->
                        <div class="tile-footer text-right bg-tr-black lter dvd dvd-top">
                            <!-- SUBMIT BUTTON -->
                            <input type="submit" class="btn btn-greensea" id="form4Submit" value="Submit" name="save">
                        </div>
                        <!-- /tile footer -->


                    </div>
                    <!-- /tile body -->



                </section>
                <!-- /tile -->


            </div>
        

                        <?php echo form_close(); ?> 

        </div>
        <!-- /row -->




    </div>

</section>
<!--/ CONTENT -->






</div>
<!--/ Application Content -->
<?php
$this->load->view('admin/footer')?>