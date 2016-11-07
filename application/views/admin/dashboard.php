
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

    <div class="page page-sidebar-sm-layout">

        <div class="pageheader">

            <h2>Small Sidebar Layout <span>// You can place subtitle here</span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="index.html"><i class="fa fa-home"></i> Minovate</a>
                    </li>
                    <li>
                        <a href="#">Layouts</a>
                    </li>
                    <li>
                        <a href="layout-sidebar-sm.html">Small Sidebar Layout</a>
                    </li>
                </ul>

            </div>

        </div>

        <p class="lead">This is the small sidebar layout template.</p>
        <?php
        $SESS_userRole = $this->session->userdata('SESS_userRole');
        print_r($SESS_userRole);
        echo "<br><br>";

        $pageroleaccessmap = pageroleaccessmap($SESS_userRole);
        print_r($pageroleaccessmap);
        echo "<br><br>";
       // echo checkpageaccess($pageUrl='',$access=0,$subpage='',$format='array');
        $checkpageaccess =  checkpageaccess('employee',0);
        print_r($checkpageaccess);
        echo checkpageaccess('employee',1,'create');
        echo "<br><br>";
        //pagealterpermission($pageUrl='',$alterPermission='');
        echo pagealterpermission('employee', $alterPermission='');
        echo pagealterpermission('employee', $alterPermission='createApprove');
//        $finalaccessmap = checkpageaccess(2, '', 'array');
//        print_r($finalaccessmap);
        ?>
    </div>

</section>
<!--/ CONTENT -->


</div>
<!--/ Application Content -->
