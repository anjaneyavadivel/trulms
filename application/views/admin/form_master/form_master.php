
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

    <div class="page page-tables-datatables">

        <div class="pageheader">

            <h2><?= $pageTitle ?> Master</h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="<?= base_url() ?>"><i class="fa fa-home"></i> Home</a>
                    </li>
                    <li>
                        <a href="#"><?= $pageTitle ?> Master</a>
                    </li>

                </ul>

            </div>

        </div>

        <!-- row -->
        <div class="row">
            <!-- col -->
            <div class="col-md-12">

                <?php $this->load->view('admin/msg') ?>
                <!-- tile -->
                <section class="tile">

                    <!-- tile header -->
                    <div class="tile-header dvd dvd-btm">
                        <h1 class="custom-font"><strong><?= $pageTitle ?></strong> Master</h1>

                        <ul class="controls">

                            <li><a href="<?= base_url() ?>add-form-master" title="Add <?= $pageTitle ?>" role="button" tabindex="0" class="tile-close">Add New  <i class="fa fa-plus"></i></a></li>
                        </ul>
                    </div>
                    <!-- /tile header -->

                    <!-- tile body -->
                    <div class="tile-body">
                        <div class="table-responsive">
                            <table class="table table-custom" id="basic-usage">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Menu Name</th>
                                        <th>Form Name</th>
                                        <th>Url</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                    <!-- /tile body -->

                </section>
                <!-- /tile -->


            </div>
            <!-- /col -->
        </div>
        <!-- /row -->

    </div>

</section>
<!--/ CONTENT -->

</div>
<!--/ Application Content -->
<!-- Splash Modal -->
<span  id="activedeactiveid" data-toggle="modal" data-target="#active-deactive" data-options="splash-2 splash-ef-11"></span>
<div class="modal splash fade" id="active-deactive" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font">Confirmation!</h3>
            </div>
            <div class="modal-body">
                <p id="confirmation-msg"></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default btn-border activedeactiveconf-btn">Submit</button>
                <button class="btn btn-default btn-border activedeactiveconf-close" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('admin/footer') ?>


