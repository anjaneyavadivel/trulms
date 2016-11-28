
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
        echo "Loging User Role: ";
        ?>
        <code>$SESS_userRole = $this->session->userdata('SESS_userRole');</code>
        <?php
        echo "<br>";
        $SESS_userRole = $this->session->userdata('SESS_userRole');
        print_r($SESS_userRole);
        echo "<br><br>";

        echo "Loging User Page Access: ";
        ?>
        <code>$pageroleaccessmap = pageroleaccessmap($SESS_userRole);</code>
        <?php
        $pageroleaccessmap = pageroleaccessmap($SESS_userRole);
        echo "<br>";
        print_r($pageroleaccessmap);
        echo "<br><br>";
       
        echo "Loging User Employee Page Access: ";
        echo "<br>";
        ?>
        <code>$checkpageaccess =  checkpageaccess('employee',0); is return all option</code>
        <?php
        echo "<br>";
        // echo checkpageaccess($pageUrl='',$access=0,$subpage='',$format='array');
        $checkpageaccess =  checkpageaccess('employee',0);
        print_r($checkpageaccess);
        echo "<br>";
        ?>
        <code>$checkpageaccess =  checkpageaccess('employee',1,'create'); is return true or false</code>
        <?php
        echo checkpageaccess('employee',1,'create');
        echo "<br>";
        ?>
        <code>$checkpageaccess =  checkpageaccess('company',1,'menu'); is return true or false if any option true from Array ( [0] => create [1] => view [2] => modify [3] => approve [4] => delete ) 
</code>
        <?php
        echo checkpageaccess('employee',1,'menu');
        echo "<br><br>";
        echo "Loging User Page Alter Permission: ";
        ?>
        <code>array(0 => 'defaultApprover',1 => 'createApproveRequired', 2 => 'modifyApproveRequired', 3 => 'selfEditAllowed', 4 => 'selfApprovalAllowed', 5=>'reportingUserApprove');
             </code>
        <?php
        echo "<br>";
         ?>
        <code>pagealterpermission('employee', $alterPermission='');</code>
        <?php
        echo "<br>";
        //pagealterpermission($pageUrl='',$alterPermission='');
        echo pagealterpermission('employee', $alterPermission='');
        echo "<br>";
        ?>
        <code>pagealterpermission('employee', $alterPermission='createApproveRequired');</code>
        <?php
        echo pagealterpermission('employee', $alterPermission='createApproveRequired');
//        $finalaccessmap = checkpageaccess(2, '', 'array');
//        print_r($finalaccessmap);
        echo "<br><br>";
        ?>
    </div>

</section>
<!--/ CONTENT -->


</div>
<!--/ Application Content -->
