<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->load->model('Commonsql_model');
    }

    function index() {
        if ($this->session->userdata('SESS_userId')) {
            redirect(base_url() . "dashboard");
        } else {
            redirect(base_url() . "login");
        }
    }

    ////////// form master
    function form_master() {
        if (!$this->session->userdata('SESS_userId') || !checkpageaccess('form-master', 1, 'view')) {
            redirect(base_url() . "login");
        }
//        if ($_POST) {
//            $whereData = array('pageID' => $this->uri->segment(3));
//            $updateData = array('active' => $this->uri->segment(4));
//            $upt = updateTable('tblpages', $whereData, $updateData, $isStoreMod = 1, $modIdName = 'pageID', $modId = $this->uri->segment(3));
//            if ($upt) {
//                $this->session->set_userdata('suc', 'Forms status successfully cshanged...!');
//                redirect('form-master');
//            } else {
//                $this->session->set_userdata('err', 'Error Please try again..!');
//                redirect('form-master');
//            }
//        }

        $data['pageTitle'] = "Form/Page";
        $data['table'] = "Form";
        $this->load->view('admin/form_master/form_master', $data);
    }

    function check_form_master_url() {
        if (!$this->session->userdata('SESS_userId') || !checkpageaccess('form-master', 1, 'create')) {
            return FALSE;
        }
        if (isset($_POST['pageID']) && trim($_POST['pageID']) != '') {
            $query = $this->Commonsql_model->select('tblpages', array('url' => trim($_POST['url']), 'pageID !=' => $_POST['pageID']));
        } else {
            $query = $this->Commonsql_model->select('tblpages', array('url' => trim($_POST['url'])));
        }
        if ($query->num_rows() > 0) {
            echo "false";
        } else {
            echo "true";
        }
    }

    function add_form_master() {
        if (!$this->session->userdata('SESS_userId') || !checkpageaccess('form-master', 1, 'create')) {
            redirect(base_url() . "login");
        }
        if ($_POST) {
            $this->form_validation->set_rules('menuCaption', 'Form/Menu Name', 'trim|required');
            $this->form_validation->set_rules('parentID', 'Parent Category', 'trim|required');
            $this->form_validation->set_rules('url', 'URL', 'trim|required|is_unique[tblpages.url]');
            if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_userdata('err', validation_errors());
                redirect('add-form-master');
            }

            extract($this->input->post());

            // insert data into tblpages
            $values = array('menuCaption' => $menuCaption,
                'url' => $url,
                'icon' => $icon,
                'tooltip' => $tooltip,
                'parentID' => $parentID,
                'createby' => $this->session->userdata('SESS_userId'),
                'active' => 1);

            $pageID = insertTable('tblpages', $values, 1, 'pageID', 'form-master');
            // insert data into tblpagealterdetails
            if (!isset($iscreateApproveRequired)) {
                $iscreateApproveRequired = 0;
            }
            if (!isset($ismodifyApproveRequired)) {
                $ismodifyApproveRequired = 0;
            }
            if (!isset($isReportingUserApproveAllowed)) {
                $isReportingUserApproveAllowed = 0;
            }
            if (!isset($isSelfEditAllowed)) {
                $isSelfEditAllowed = 0;
            }
            if (!isset($isSelfApprovalAllowed)) {
                $isSelfApprovalAllowed = 0;
            }
            if (!isset($defaultApproverRoleID)) {
                $defaultApproverRoleID = 1;
            }
            $values = array(
                'pageID' => $pageID,
                'iscreateApproveRequired' => $iscreateApproveRequired,
                'ismodifyApproveRequired' => $ismodifyApproveRequired,
                'isReportingUserApproveAllowed' => $isReportingUserApproveAllowed,
                'isSelfEditAllowed' => $isSelfEditAllowed,
                'isSelfApprovalAllowed' => $isSelfApprovalAllowed,
                'defaultApproverRoleID' => $defaultApproverRoleID,
                'createby' => $this->session->userdata('SESS_userId'),
                'active' => 1);

            $pageAlterDetailsID = insertTable('tblpagealterdetails', $values, 1, 'pageAlterDetailsID');
            if ($pageID > 0 && $pageAlterDetailsID > 0) {
                $this->session->set_userdata('suc', 'Form successfully added...!');
                redirect('add-form-master');
            } else {
                $this->session->set_userdata('err', 'Error! Please try again..!');
                redirect('add-form-master');
            }
        }
        $whereData = array('dbentrystateID !=' => 3, 'active' => 1);
        $data['role'] = selectTable('tblrole', $whereData);
        $data['pageTitle'] = "Form";
        //$data['table'] = "Add Form";
        $this->load->view('admin/form_master/add_form_master', $data);
    }

    function form_master_json() {
        if (!$this->session->userdata('SESS_userId') || !checkpageaccess('form-master', 1, 'view')) {
            return FALSE;
        }
        $pagealterpermission = pagealterpermission('form-master', $alterPermission = '');
        $userBranchID = $this->session->userdata('SESS_userBranchID');
        $output = array();
        if ($userBranchID == 0) {
            $whereData = array();
        } else {
            $whereData = array('active' => 1);
        }
        // Get user record
        $pages = selectTable('tblpages', $whereData);
        if (isset($pages) && $pages->num_rows() > 0) {
            foreach ($pages->result() as $value) {
                $vaules = array();
                $vaules['pageID'] = $value->pageID;
                if ($value->parentID == 1) {
                    $vaules['parentID'] = 'Master';
                } else if ($value->parentID == 2) {
                    $vaules['parentID'] = 'Setup';
                } else if ($value->parentID == 3) {
                    $vaules['parentID'] = 'Operations';
                } else if ($value->parentID == 4) {
                    $vaules['parentID'] = 'Report';
                }
                $vaules['menuCaption'] = $value->menuCaption;
                $vaules['url'] = $value->url;
                if ($value->active == 1) {
                    $row = '<span class="label bg-greensea">Active</span>';
                } else {
                    $row = '<span class="label bg-red">De-Active</span>';
                }

                $vaules['active'] = $row;
                $view = '';
                $APPROVE = '';
                $active = '';
                $edit = '';
                if (checkpageaccess('form-master', 1, 'view')) {
                    $view = "<a href='" . base_url() . "view-form-master/" . $value->pageID . "'role='button' tabindex='0' class='edit' data-toggle='tooltip' data-placement='top' title data-original-title='Click to View'><i class='fa fa-file-text-o'></i></a>&nbsp;";
                }
                if (selfAllowed($pagealterpermission, 'selfApprovalAllowed', $value->createby) && checkpageaccess('form-master', 1, 'approve')) {
                    $APPROVE = "<a href='" . base_url() . "approve-form-master-list/" . $value->pageID . "'role='button' tabindex='0' class='edit' data-toggle='tooltip' data-placement='top' title data-original-title='Click to View History'><i class='fa fa-clock-o'></i></a>&nbsp;";
                }
                if (selfAllowed($pagealterpermission, 'selfEditAllowed', $value->createby) && checkpageaccess('form-master', 1, 'modify')) {
                    $edit = "<a href='" . base_url() . "edit-form-master/" . $value->pageID . "'role='button' tabindex='0' class='edit'  data-toggle='tooltip' data-placement='top' title data-original-title='Click to Update'><i class='fa fa-edit'></i></a>&nbsp;";
                    
                    if (checkpageaccess('form-master', 1, 'delete')) {
                        if ($value->active == 1) {
                            $active = '<a href="javascript:void(0)" data-tb="pages" data-fn="form-master" data-val="0" data-id="' . $value->pageID . '"  data-col="pageID" role="button" tabindex="0" class="active-deactive-btn text-danger" data-toggle="tooltip" data-placement="top" title data-original-title="Click to De-Active"><i class="fa fa-times-circle"></i></a>&nbsp;';
                        } else {
                            $active = '<a href="javascript:void(0)" data-tb="pages" data-fn="form-master" data-val="1" data-id="' . $value->pageID . '"  data-col="pageID" role="button" tabindex="0" class="active-deactive-btn text-success data-toggle="tooltip" data-placement="top" title data-original-title="Click to Active"><i class="fa fa-check-square"></i></a>&nbsp;';
                        }
                    }
                }
                $vaules['Action'] = $view . $edit . $APPROVE . $active;

                $output[] = $vaules;
            }
        }

        echo json_encode(array('data' => $output), true);
    }

    function edit_form_master($pageID = '') {
        if (!$this->session->userdata('SESS_userId') || $pageID == '' || !checkpageaccess('form-master', 1, 'modify')) {
            redirect(base_url() . "login");
        }
        if ($_POST) {
            $this->form_validation->set_rules('pageID', 'page ID', 'trim|required');
            $this->form_validation->set_rules('menuCaption', 'Form/Menu Name', 'trim|required');
            $this->form_validation->set_rules('parentID', 'Parent Category', 'trim|required');
            $this->form_validation->set_rules('url', 'URL', 'trim|required');
            if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_userdata('err', validation_errors());
                redirect('edit-form-master/' . $pageID);
            }
            $userBranchID = $this->session->userdata('SESS_userBranchID');

            extract($this->input->post());

            // insert data into tblpages
            $values = array('menuCaption' => $menuCaption,
                'url' => $url,
                'icon' => $icon,
                'tooltip' => $tooltip,
                'parentID' => $parentID,
                'createby' => $this->session->userdata('SESS_userId'),
                'active' => 1);

            if ($userBranchID == 0) {
                $whereData = array('pageID' => $pageID);
            } else {
                $whereData = array('active' => 1, 'pageID' => $pageID);
            }
            $query = updateTable('tblpages', $whereData, $values, 1, 'pageID', $pageID, 'form-master');

            // insert data into tblpagealterdetails
            if (!isset($iscreateApproveRequired)) {
                $iscreateApproveRequired = 0;
            }
            if (!isset($ismodifyApproveRequired)) {
                $ismodifyApproveRequired = 0;
            }
            if (!isset($isReportingUserApproveAllowed)) {
                $isReportingUserApproveAllowed = 0;
            }
            if (!isset($isSelfEditAllowed)) {
                $isSelfEditAllowed = 0;
            }
            if (!isset($isSelfApprovalAllowed)) {
                $isSelfApprovalAllowed = 0;
            }
            if (!isset($defaultApproverRoleID)) {
                $defaultApproverRoleID = 1;
            }
            $values1 = array(
                'iscreateApproveRequired' => $iscreateApproveRequired,
                'ismodifyApproveRequired' => $ismodifyApproveRequired,
                'isReportingUserApproveAllowed' => $isReportingUserApproveAllowed,
                'isSelfEditAllowed' => $isSelfEditAllowed,
                'isSelfApprovalAllowed' => $isSelfApprovalAllowed,
                'defaultApproverRoleID' => $defaultApproverRoleID,
                'createby' => $this->session->userdata('SESS_userId'),
                'active' => 1);

            $whereData = array('pageID' => $pageID);

            $query1 = updateTable('tblpagealterdetails', $whereData, $values1, 1, 'pageID', $pageID, 'form-master');
            if ($query > 0 || $query1 > 0) {
                $this->session->set_userdata('suc', 'Form Master successfully updated...!');
                redirect('edit-form-master/' . $pageID);
            } else {
                $this->session->set_userdata('err', 'Error Please try again..!');
                redirect('edit-form-master/' . $pageID);
            }
        }
        $whereData = array('dbentrystateID !=' => 0, 'active' => 1);
        $data['role'] = selectTable('tblrole', $whereData);
        $data['pageTitle'] = "Form Master";
        $data['pageID'] = $pageID;
        $data['pages'] = $this->Commonsql_model->select('tblpages', array('pageID' => $this->uri->segment(2)));
        $data['pagealt'] = $this->Commonsql_model->select('tblpagealterdetails', array('pageID' => $this->uri->segment(2)));
        $this->load->view('admin/form_master/edit_form_master', $data);
    }

    function view_form_master() {
        if (!$this->session->userdata('SESS_userId') || !checkpageaccess('form-master', 1, 'view')) {
            redirect(base_url() . "login");
        }
        $userBranchID = $this->session->userdata('SESS_userBranchID');
        $data['pageTitle'] = "View Form Master";
        if ($userBranchID == 0) {
            $data['pages'] = $this->Commonsql_model->select('tblpages', array('pageID' => $this->uri->segment(2)));
            $data['pagealt'] = $this->Commonsql_model->select('tblpagealterdetails', array('pageID' => $this->uri->segment(2)));
        } else {
            $data['pages'] = $this->Commonsql_model->select('tblpages', array('active' => 1, 'pageID' => $this->uri->segment(2)));
            $data['pagealt'] = $this->Commonsql_model->select('tblpagealterdetails', array('active' => 1, 'pageID' => $this->uri->segment(2)));
        }
        $whereData = array('dbentrystateID !=' => 0, 'active' => 1);
        $data['role'] = selectTable('tblrole', $whereData);
        $this->load->view('admin/form_master/view_form_master', $data);
    }

    function approve_form_master($pageID = '') {
        if (trim($pageID) == '' || !$this->session->userdata('SESS_userId') || !checkpageaccess('form-master', 1, 'approve')) {
            redirect(base_url() . "login");
        }

        $data['pageTitle'] = "Form";
        $data['table'] = "Form";
        $data['pageTitle1'] = "Page Alter";
        $data['table1'] = "Page Alter";
        $this->load->view('admin/form_master/approve_form_master', $data);
    }

    function approve_form_master_json($pageID = '') {
        if (trim($pageID) == '' || !$this->session->userdata('SESS_userId') || !checkpageaccess('form-master', 1, 'approve')) {
            return FALSE;
        }
        $userBranchID = $this->session->userdata('SESS_userBranchID');
        $output = array();
        if ($userBranchID == 0) {
            $whereData = array('tlpagemod.pageID' => $pageID);
        } else {
            $whereData = array('tlpagemod.pageID' => $pageID, 'tlpagemod.active' => 1);
        }
        // Get user record
        $joins = array(
            array(
                'table' => 'tblemployee AS tlemp',
                'condition' => 'tlemp.empID = tlpagemod.createby',
                'jointype' => 'LEFT'
            ),
        );
        $columns = 'tlpagemod.*,tlemp.empname';
        $pages = get_joins('tblpages_mod AS tlpagemod', $columns, $joins, $whereData, $orWhereData = array(), $group = array(), $order = 'page_modID DESC');

        if (isset($pages) && $pages->num_rows() > 0) {
            foreach ($pages->result() as $value) {
                $vaules = array();
                $vaules['page_modID'] = $value->page_modID;
                $vaules['createdon'] = date("d-m-Y", strtotime($value->createdon));
                if ($value->parentID == 1) {
                    $vaules['parentID'] = 'Master';
                } else if ($value->parentID == 2) {
                    $vaules['parentID'] = 'Setup';
                } else if ($value->parentID == 3) {
                    $vaules['parentID'] = 'Operations';
                } else if ($value->parentID == 4) {
                    $vaules['parentID'] = 'Report';
                }
                $vaules['menuCaption'] = $value->menuCaption;
                $vaules['url'] = $value->url;
                $vaules['createby'] = $value->empname;
                if ($value->active == 1) {
                    $row = '<span class="label bg-greensea">Active</span>';
                } else {
                    $row = '<span class="label bg-red">De-Active</span>';
                }

                $vaules['active'] = $row;
                $view = '';
                $APPROVE = '';
                $active = '';
                $edit = '';
                if (checkpageaccess('form-master', 1, 'approve')) {
                    $view = "<a href='" . base_url() . "view-form-master-history/" . $value->page_modID . "'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>View</a>";
                }
                $APPROVE = "";
                $active = "";
                $edit = "";
                $vaules['Action'] = $view . $edit . $APPROVE . $active;

                $output[] = $vaules;
            }
        }

        echo json_encode(array('data' => $output), true);
    }

    function view_form_master_history() {
        if (!$this->session->userdata('SESS_userId') || !checkpageaccess('form-master', 1, 'approve')) {
            redirect(base_url() . "login");
        }
        $userBranchID = $this->session->userdata('SESS_userBranchID');
        $data['pageTitle'] = "View Form Master";
        if ($userBranchID == 0) {
            $data['pages'] = $this->Commonsql_model->select('tblpages_mod', array('page_modID' => $this->uri->segment(2)));
            //$data['pagealt'] = $this->Commonsql_model->select('tblpagealterdetails_mod', array('pageAlterDetailsID' => $this->uri->segment(2)));
        } else {
            $data['pages'] = $this->Commonsql_model->select('tblpages_mod', array('active' => 1, 'page_modID' => $this->uri->segment(2)));
            //$data['pagealt'] = $this->Commonsql_model->select('tblpagealterdetails_mod', array('active' => 1, 'pageAlterDetailsID' => $this->uri->segment(2)));
        }
        $v = $data['pages']->row();
        $data['pagesID'] = $v->pageID;
        $this->load->view('admin/form_master/view_form_master_history', $data);
    }

    function approve_page_alter_json($pageID = '') {
        if (trim($pageID) == '' || !$this->session->userdata('SESS_userId') || !checkpageaccess('form-master', 1, 'approve')) {
            return FALSE;
        }
        $userBranchID = $this->session->userdata('SESS_userBranchID');
        $output = array();
        if ($userBranchID == 0) {
            $whereData = array('tlpagealtmod.pageID' => $pageID);
        } else {
            $whereData = array('tlpagealtmod.pageID' => $pageID, 'tlpagealtmod.active' => 1);
        }
        // Get user record
        $joins = array(
            array(
                'table' => 'tblemployee AS tlemp',
                'condition' => 'tlemp.empID = tlpagealtmod.createby',
                'jointype' => 'LEFT'
            ),
        );
        $columns = 'tlpagealtmod.*,tlemp.empname';
        $pages = get_joins('tblpagealterdetails_mod AS tlpagealtmod', $columns, $joins, $whereData, $orWhereData = array(), $group = array(), $order = 'pageAlterDetails_modID DESC');

        if (isset($pages) && $pages->num_rows() > 0) {
            foreach ($pages->result() as $value) {
                $vaules = array();
                $vaules['pageAlterDetails_modID'] = $value->pageAlterDetails_modID;
                $vaules['createdon'] = date("d-m-Y", strtotime($value->createdon));
                if ($value->iscreateApproveRequired == 1) {
                    $vaules['iscreateApproveRequired'] = 'Yes';
                } else {
                    $vaules['iscreateApproveRequired'] = 'No';
                }
                if ($value->ismodifyApproveRequired == 1) {
                    $vaules['ismodifyApproveRequired'] = 'Yes';
                } else {
                    $vaules['ismodifyApproveRequired'] = 'No';
                }
                if ($value->isSelfEditAllowed == 1) {
                    $vaules['isSelfEditAllowed'] = 'Yes';
                } else {
                    $vaules['isSelfEditAllowed'] = 'No';
                }
                if ($value->isSelfApprovalAllowed == 1) {
                    $vaules['isSelfApprovalAllowed'] = 'Yes';
                } else {
                    $vaules['isSelfApprovalAllowed'] = 'No';
                }
                $vaules['createby'] = $value->empname;
                if ($value->active == 1) {
                    $row = '<span class="label bg-greensea">Active</span>';
                } else {
                    $row = '<span class="label bg-red">De-Active</span>';
                }

                $vaules['active'] = $row;
                $view = '';
                $APPROVE = '';
                $active = '';
                $edit = '';
                if (checkpageaccess('form-master', 1, 'approve')) {
                    $view = "<a href='" . base_url() . "view-form-alter-history/" . $value->pageAlterDetails_modID . "'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>View</a>";
                }
                $APPROVE = "";
                $active = "";
                $edit = "";
                $vaules['Action'] = $view . $edit . $APPROVE . $active;

                $output[] = $vaules;
            }
        }

        echo json_encode(array('data' => $output), true);
    }

    ////////// employee role
    function employee_role() {
        if (!$this->session->userdata('SESS_userId') || !checkpageaccess('employee-role', 1, 'view')) {
            redirect(base_url() . "login");
        }
        if ($_POST) {
            $whereData = array('empRoleMapID' => $this->uri->segment(3));
            $updateData = array('active' => $this->uri->segment(4));
            $upt = updateTable('tblemprolemap', $whereData, $updateData, $isStoreMod = 1, $modIdName = 'empRoleMapID', $modId = $this->uri->segment(3));
            if ($upt) {
                $this->session->set_userdata('suc', 'Eployee Role Setup status successfully changed...!');
                redirect('employee-role');
            } else {
                $this->session->set_userdata('err', 'Error Please try again..!');
                redirect('employee-role');
            }
        }

        $data['pageTitle'] = "Employee Role";
        $data['table'] = "Employee Role";
        $this->load->view('admin/employee_role/employee_role', $data);
    }

    function employee_role_json() {
        if (!$this->session->userdata('SESS_userId') || !checkpageaccess('employee-role', 1, 'view')) {
            return FALSE;
        }
        $userBranchID = $this->session->userdata('SESS_userBranchID');
        $output = array();
        if ($userBranchID == 0) {
            $whereData = array();
        } else {
            $whereData = array('temprole.active' => 1);
        }
        $joins = array(
            array(
                'table' => 'tblemployee AS temp',
                'condition' => 'temprole.empID = temp.empID',
                'jointype' => 'LEFT'
            ),
            array(
                'table' => 'tbldept AS tdept',
                'condition' => 'tdept.deptID = temp.deptid',
                'jointype' => 'LEFT'
            ), array(
                'table' => 'tbldesignation AS tdes',
                'condition' => 'tdes.desigID = temp.designation',
                'jointype' => 'LEFT'
            ),
            array(
                'table' => 'tblrole AS trole',
                'condition' => 'trole.roleID = temprole.roleID',
                'jointype' => 'LEFT'
            ),
        );
        $columns = 'temprole.*,temp.empCode,temp.empname,tdes.name,tdept.department,trole.roleName';
        $employeeRolw = get_joins('tblemprolemap AS temprole', $columns, $joins, $whereData, $orWhereData = array(), $group = array(), $order = 'empRoleMapID DESC');

        $vaules = array();
        if (isset($employeeRolw) && $employeeRolw->num_rows() > 0) {
            foreach ($employeeRolw->result() as $value) {
                $vaules['ID'] = $value->empRoleMapID;
                $vaules['empCode'] = $value->empCode;
                $vaules['empname'] = $value->empname;
                $vaules['name'] = $value->name;
                $vaules['department'] = $value->department;
                $vaules['roleName'] = $value->roleName;
                if ($value->active == 1) {
                    $row = '<span class="label bg-greensea">Active</span>';
                } else {
                    $row = '<span class="label bg-red">De-Active</span>';
                }

                $vaules['active'] = $row;
                $view = '';
                $APPROVE = '';
                $active = '';
                $edit = '';
                if (checkpageaccess('employee-role', 1, 'view')) {
                    $view = "<a href='" . base_url() . "view-employee-role/" . $value->empRoleMapID . "'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>View</a>";
                }
                if (checkpageaccess('employee-role', 1, 'approve')) {
                    $APPROVE = "<a href='" . base_url() . "approve-employee-role/" . $value->empRoleMapID . "'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>History / APPROVE</a>";
                }
                if (checkpageaccess('employee-role', 1, 'delete')) {
                    if ($value->active == 1) {
                        $active = '<a href="javascript:void(0)" data-tb="emprolemap" data-val="0" data-id="' . $value->empRoleMapID . '"  data-col="empRoleMapID" role="button" tabindex="0" class="active-deactive-btn text-danger text-uppercase text-strong text-sm mr-10 ">De-Active</a>';
                    } else {
                        $active = '<a href="javascript:void(0)" data-tb="emprolemap" data-val="1" data-id="' . $value->empRoleMapID . '"  data-col="empRoleMapID" role="button" tabindex="0" class="active-deactive-btn text-success text-uppercase text-strong text-sm mr-10">Active</a>';
                    }
                }
                if (checkpageaccess('employee-role', 1, 'modify')) {
                    $edit = "<a href='" . base_url() . "edit-employee-role/" . $value->empRoleMapID . "'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Edit</a>";
                }
                $vaules['Action'] = $view . $edit . $APPROVE . $active;

                $output[] = $vaules;
            }
        }

        echo json_encode(array('data' => $output), true);
    }

    function add_employee_role() {
        if (!$this->session->userdata('SESS_userId') || !checkpageaccess('employee-role', 1, 'create')) {
            redirect(base_url() . "login");
        }
        $userBranchID = $this->session->userdata('SESS_userBranchID');
        if ($_POST) {
            $this->form_validation->set_rules('empID', 'Employee Code / Name / Department / Designation', 'trim|required');
            $this->form_validation->set_rules('accessrole[]', 'Access Role', 'trim|required');
            if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_userdata('err', validation_errors());
                redirect('add-employee-role');
            }

            extract($this->input->post());
            $empRoleMapID = 0;
            // insert data into tblpages
            foreach ($accessrole as $rolID) {
                $values = array('empID' => $empID,
                    'roleID' => $rolID,
                    'createby' => $this->session->userdata('SESS_userId'),
                    'active' => 1);

                $empRoleMapID = insertTable('tblemprolemap', $values, 1, 'empRoleMapID');
            }
            if ($empRoleMapID > 0) {
                $this->session->set_userdata('suc', 'Form successfully added...!');
            } else {
                $this->session->set_userdata('err', 'Error! Please try again..!');
            }
            redirect('add-employee-role');
        }
        $whereData = array('active' => 1);
        $notinuser = array(0);
        $emprole = selectTable('tblemprolemap', $whereData);
        if (isset($emprole) && $emprole->num_rows() > 0) {
            foreach ($emprole->result() as $value) {
                $notinuser[] = $value->empID;
            }
        }
        if ($userBranchID == 0) {
            $whereData = array('temp.dbentrystateID !=' => 3, 'temp.active' => 1);
        } else {
            $whereData = array('temp.branchID' => $userBranchID, 'temp.dbentrystateID !=' => 3, 'temp.active' => 1);
        }
        $joins = array(
            array(
                'table' => 'tbldept AS tdept',
                'condition' => 'tdept.deptID = temp.deptid',
                'jointype' => 'LEFT'
            ), array(
                'table' => 'tbldesignation AS tdes',
                'condition' => 'tdes.desigID = temp.designation',
                'jointype' => 'LEFT'
            ),
        );
        $columns = 'temp.*,tdes.name,tdept.department';
        $notInWhereData = array('temp.empID', $notinuser);
        $data['employee'] = get_joins('tblemployee AS temp', $columns, $joins, $whereData, $orWhereData = array(), $group = array(), $order = '', $having = '', $limit = array(), $result_way = 'all', $echo = 0, $inWhereData = array(), $notInWhereData);

        $whereData = array('dbentrystateID !=' => 3, 'active' => 1);
        // Get user record
        $data['role'] = selectTable('tblrole', $whereData);

        $data['pageTitle'] = "Employee Role";
        //$data['table'] = "Add Form";
        $this->load->view('admin/employee_role/add_employee_role', $data);
    }

    function view_employee_role() {
        if (!$this->session->userdata('SESS_userId') || !checkpageaccess('employee-role', 1, 'view')) {
            redirect(base_url() . "login");
        }
        $userBranchID = $this->session->userdata('SESS_userBranchID');
        $roleID = $this->uri->segment(2);

        if ($userBranchID == 0) {
            $whereData = array('temp.dbentrystateID !=' => 3, 'temprole.empRoleMapID' => $roleID, 'temp.active' => 1);
        } else {
            $whereData = array('temp.branchID' => $userBranchID, 'temprole.empRoleMapID' => $roleID, 'temprole.active' => 1, 'temp.dbentrystateID !=' => 3, 'temp.active' => 1);
        }
        $joins = array(
            array(
                'table' => 'tblemployee AS temp',
                'condition' => 'temprole.empID = temp.empID',
                'jointype' => 'LEFT'
            ), array(
                'table' => 'tbldept AS tdept',
                'condition' => 'tdept.deptID = temp.deptid',
                'jointype' => 'LEFT'
            ), array(
                'table' => 'tbldesignation AS tdes',
                'condition' => 'tdes.desigID = temp.designation',
                'jointype' => 'LEFT'
            ), array(
                'table' => 'tblrole AS trole',
                'condition' => 'trole.roleID = temprole.roleID',
                'jointype' => 'LEFT'
            ),
        );
        $columns = 'temprole.*,temp.empCode,temp.empname,tdes.name,tdept.department,trole.roleName';
        $data['employeeRolw'] = get_joins('tblemprolemap AS temprole', $columns, $joins, $whereData, $orWhereData = array(), $group = array(), $order = 'empRoleMapID DESC');

        $whereData = array('dbentrystateID !=' => 3, 'active' => 1);
        // Get user record
        $data['role'] = selectTable('tblrole', $whereData);
        $employeeRolw = $data['employeeRolw']->row();
        $whereData = array('active' => 1, 'empID' => $employeeRolw->empID, 'dbentrystateID !=' => 3);
        $emprolemap = array(0);
        $emprole = selectTable('tblemprolemap', $whereData);
        if (isset($emprole) && $emprole->num_rows() > 0) {
            foreach ($emprole->result() as $value) {
                $emprolemap[] = $value->roleID;
            }
        }
        $data['emprolemap'] = $emprolemap;
        $data['pageTitle'] = "View Eployee Role Setup";
        $this->load->view('admin/employee_role/view_employee_role', $data);
    }

    function edit_employee_role() {
        if (!$this->session->userdata('SESS_userId') || !checkpageaccess('employee-role', 1, 'modify')) {
            redirect(base_url() . "login");
        }
        $userBranchID = $this->session->userdata('SESS_userBranchID');
        $empRoleMapID = $this->uri->segment(2);
        if ($_POST) {
            $this->form_validation->set_rules('accessrole[]', 'Access Role', 'trim|required');
            if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_userdata('err', validation_errors());
                redirect('edit-employee-role/' . $empRoleMapID);
            }
            $result = 0;
            extract($this->input->post());
            $whereData = array('empRoleMapID' => $empRoleMapID);
            $updateData = array('active' => 0);
            $result = updateTable('tblemprolemap', $whereData, $updateData, $isStoreMod = 0, $modIdName = 'empRoleMapID', $modId = $empRoleMapID);

            $whereData = array('empRoleMapID' => $empRoleMapID);
            $tblemprolemap = selectTable('tblemprolemap', $whereData);
            if (isset($tblemprolemap) && $tblemprolemap->num_rows() > 0) {
                $tblemprolemap = $tblemprolemap->row();
                // insert data into tblpages
                foreach ($accessrole as $rolID) {
                    $whereData = array('empID' => $tblemprolemap->empID, 'roleID' => $rolID);
                    $emprole = selectTable('tblemprolemap', $whereData);
                    if (isset($emprole) && $emprole->num_rows() > 0) {
                        $emprole = $emprole->row();
                        $whereData = array('empID' => $tblemprolemap->empID, 'roleID' => $rolID);
                        $updateData = array('active' => 1);
                        $result = updateTable('tblemprolemap', $whereData, $updateData, $isStoreMod = 0, $modIdName = 'empRoleMapID', $modId = $empRoleMapID);
                    } else {
                        $values = array('empID' => $tblemprolemap->empID,
                            'roleID' => $rolID,
                            'createby' => $this->session->userdata('SESS_userId'),
                            'active' => 1);

                        $result = insertTable('tblemprolemap', $values, 1, 'empRoleMapID');
                    }
                }
            }
            $this->session->set_userdata('suc', 'Eployee Role Setup successfully updated...!');
            redirect('edit-employee-role/' . $empRoleMapID);
        }
        if ($userBranchID == 0) {
            $whereData = array('temp.dbentrystateID !=' => 3, 'temprole.empRoleMapID' => $empRoleMapID, 'temp.active' => 1);
        } else {
            $whereData = array('temp.branchID' => $userBranchID, 'temprole.empRoleMapID' => $empRoleMapID, 'temprole.active' => 1, 'temp.dbentrystateID !=' => 3, 'temp.active' => 1);
        }
        $joins = array(
            array(
                'table' => 'tbldept AS tdept',
                'condition' => 'tdept.deptID = temp.deptid',
                'jointype' => 'LEFT'
            ), array(
                'table' => 'tbldesignation AS tdes',
                'condition' => 'tdes.desigID = temp.designation',
                'jointype' => 'LEFT'
            ), array(
                'table' => 'tblemprolemap AS temprole',
                'condition' => 'temprole.empID = temp.empID',
                'jointype' => 'LEFT'
            ), array(
                'table' => 'tblrole AS trole',
                'condition' => 'trole.roleID = temprole.roleID',
                'jointype' => 'LEFT'
            ),
        );
        $columns = 'temprole.*,temp.empCode,temp.empname,tdes.name,tdept.department,trole.roleName';
        $data['employeeRolw'] = get_joins('tblemployee AS temp', $columns, $joins, $whereData, $orWhereData = array(), $group = array(), $order = 'empRoleMapID DESC');

        $whereData = array('dbentrystateID !=' => 3, 'active' => 1);
        // Get user record
        $data['role'] = selectTable('tblrole', $whereData);
        $employeeRolw = $data['employeeRolw']->row();
        $whereData = array('active' => 1, 'empID' => $employeeRolw->empID, 'dbentrystateID !=' => 3);
        $emprolemap = array(0);
        $emprole = selectTable('tblemprolemap', $whereData);
        if (isset($emprole) && $emprole->num_rows() > 0) {
            foreach ($emprole->result() as $value) {
                $emprolemap[] = $value->roleID;
            }
        }
        $data['emprolemap'] = $emprolemap;
        $data['empRoleMapID'] = $empRoleMapID;
        $data['pageTitle'] = "Edit Eployee Role Setup";
        $this->load->view('admin/employee_role/edit_employee_role', $data);
    }

    function approve_employee_role($employee_role_id = '') {
        if (!$this->session->userdata('SESS_userId') || !checkpageaccess('employee-role', 1, 'approve')) {
            redirect(base_url() . "login");
        }
        if ($_POST) {
            $whereData = array('empRoleMapID' => $this->uri->segment(3));
            $updateData = array('active' => $this->uri->segment(4));
            $upt = updateTable('tblemprolemap', $whereData, $updateData, $isStoreMod = 1, $modIdName = 'empRoleMapID', $modId = $this->uri->segment(3));
            if ($upt) {
                $this->session->set_userdata('suc', 'Eployee Role Setup status successfully changed...!');
                redirect('approve-employee-role/' . $employee_role_id);
            } else {
                $this->session->set_userdata('err', 'Error Please try again..!');
                redirect('approve-employee-role/' . $employee_role_id);
            }
        }

        $data['pageTitle'] = "Employee Role";
        $data['table'] = "Employee Role";
        $this->load->view('admin/employee_role/approve_employee_role', $data);
    }

    function approve_employee_role_json($employee_role_id = '') {
        if (!$this->session->userdata('SESS_userId') || !checkpageaccess('employee-role', 1, 'approve')) {
            return FALSE;
        }
        $userBranchID = $this->session->userdata('SESS_userBranchID');
        $output = array();
        if ($userBranchID == 0) {
            $whereData = array('empRoleMapID' => $employee_role_id);
        } else {
            $whereData = array('empRoleMapID' => $employee_role_id, 'temprole.active' => 1);
        }
        $joins = array(
            array(
                'table' => 'tbldept AS tdept',
                'condition' => 'tdept.deptID = temp.deptid',
                'jointype' => 'LEFT'
            ), array(
                'table' => 'tbldesignation AS tdes',
                'condition' => 'tdes.desigID = temp.designation',
                'jointype' => 'LEFT'
            ), array(
                'table' => 'tblemprolemap_mod AS temprole',
                'condition' => 'temprole.empID = temp.empID',
                'jointype' => 'LEFT'
            ),
            array(
                'table' => 'tblrole AS trole',
                'condition' => 'trole.roleID = temprole.roleID',
                'jointype' => 'LEFT'
            ),
        );
        $columns = 'temprole.*,temp.empCode,temp.empname,tdes.name,tdept.department,trole.roleName';
        $employeeRolw = get_joins('tblemployee AS temp', $columns, $joins, $whereData, $orWhereData = array(), $group = array(), $order = 'empRoleMapID DESC');

        if (isset($employeeRolw) && $employeeRolw->num_rows() > 0) {
            foreach ($employeeRolw->result() as $value) {
                $vaules = array();
                $vaules['ID'] = $value->empRoleMapID;
                $vaules['createdon'] = date("d-m-Y", strtotime($value->createdon));
                $vaules['empCode'] = $value->empCode;
                $vaules['empname'] = $value->empname;
                $vaules['name'] = $value->name;
                $vaules['department'] = $value->department;
                $vaules['roleName'] = $value->roleName;
                if ($value->active == 1) {
                    $row = '<span class="label bg-greensea">Active</span>';
                } else {
                    $row = '<span class="label bg-red">De-Active</span>';
                }

                $vaules['active'] = $row;
                $view = '';
                $APPROVE = '';
                $active = '';
                $edit = '';
                if (checkpageaccess('employee-role', 1, 'view')) {
                    $view = "<a href='" . base_url() . "view-employee-role/" . $value->empRoleMapID . "'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>View</a>";
                }
                if (checkpageaccess('employee-role', 1, 'approve')) {
                    $APPROVE = "<a href='" . base_url() . "approve-employee-role/" . $value->empRoleMapID . "'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>History / APPROVE</a>";
                }
                if (checkpageaccess('employee-role', 1, 'delete')) {
                    if ($value->active == 1) {
                        $active = '<a href="javascript:void(0)" data-tb="emprolemap" data-val="0" data-id="' . $value->empRoleMapID . '"  data-col="empRoleMapID" role="button" tabindex="0" class="active-deactive-btn text-danger text-uppercase text-strong text-sm mr-10 ">De-Active</a>';
                    } else {
                        $active = '<a href="javascript:void(0)" data-tb="emprolemap" data-val="1" data-id="' . $value->empRoleMapID . '"  data-col="empRoleMapID" role="button" tabindex="0" class="active-deactive-btn text-success text-uppercase text-strong text-sm mr-10">Active</a>';
                    }
                }
                if (checkpageaccess('employee-role', 1, 'modify')) {
                    $edit = "<a href='" . base_url() . "edit-employee-role/" . $value->empRoleMapID . "'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Edit</a>";
                }
                $vaules['Action'] = $view . $edit . $APPROVE . $active;

                $output[] = $vaules;
            }
        }

        echo json_encode(array('data' => $output), true);
    }

////////// form access
    function form_access() {
        if (!$this->session->userdata('SESS_userId') || !checkpageaccess('form-access', 1, 'view')) {
            redirect(base_url() . "login");
        }
        if ($_POST) {
            $whereData = array('pageRoleMappingID' => $this->uri->segment(3));
            $updateData = array('active' => $this->uri->segment(4));
            $upt = updateTable('tblpageroleaccessmap', $whereData, $updateData, $isStoreMod = 1, $modIdName = 'pageRoleMappingID', $modId = $this->uri->segment(3));
            if ($upt) {
                $this->session->set_userdata('suc', 'Form Access status successfully changed...!');
                redirect('form-access');
            } else {
                $this->session->set_userdata('err', 'Error Please try again..!');
                redirect('form-access');
            }
        }

        $data['pageTitle'] = "Form Access";
        $data['table'] = "Form Access";
        $this->load->view('admin/form_access/form_access', $data);
    }

    function form_access_json() {
        if (!$this->session->userdata('SESS_userId') || !checkpageaccess('form-access', 1, 'view')) {
            return FALSE;
        }
        $userBranchID = $this->session->userdata('SESS_userBranchID');
        $output = array();
        if ($userBranchID == 0) {
            $whereData = array();
        } else {
            $whereData = array('tpram.active' => 1);
        }
        $joins = array(
            array(
                'table' => 'tblpages AS tp',
                'condition' => 'tp.pageID = tpram.pageID',
                'jointype' => 'LEFT'
            ), array(
                'table' => 'tblrole AS tr',
                'condition' => 'tr.roleID = tpram.roleID',
                'jointype' => 'LEFT'
            ),
        );
        $columns = 'tpram.*,tr.roleName,tp.menuCaption';
        $employeeRolw = get_joins('tblpageroleaccessmap AS tpram', $columns, $joins, $whereData = array(), $orWhereData = array(), $group = array(), $order = 'pageRoleMappingID DESC');

        if (isset($employeeRolw) && $employeeRolw->num_rows() > 0) {
            foreach ($employeeRolw->result() as $value) {
                $vaules = array();
                $vaules['ID'] = $value->pageRoleMappingID;
                $vaules['menuCaption'] = $value->menuCaption;
                $vaules['roleName'] = $value->roleName;
                if ($value->active == 1) {
                    $row = '<span class="label bg-greensea">Active</span>';
                } else {
                    $row = '<span class="label bg-red">De-Active</span>';
                }

                $vaules['active'] = $row;
                $view = '';
                $APPROVE = '';
                $active = '';
                $edit = '';
                if (checkpageaccess('form-access', 1, 'view')) {
                    $view = "<a href='javascript:void(0);' data-val='" . $value->pageRoleMappingID . "'  data-ur='view-form-access' data-vur='view-form-access' id='editviewcallform-btn' role='button' tabindex='0'  class='editviewcallform-btn edit text-primary text-uppercase text-strong text-sm mr-10'>View</a>";
                }
                if (checkpageaccess('form-access', 1, 'approve')) {
                    $APPROVE = "<a href='javascript:void(0);' data-val='" . $value->pageRoleMappingID . "'  data-ur='approve-form-access' id='editviewcallform-btn' role='button' tabindex='0' class='editviewcallform-btn edit text-primary text-uppercase text-strong text-sm mr-10'>APPROVE</a>";
                }
                if (checkpageaccess('form-access', 1, 'delete')) {
                    if ($value->active == 1) {
                        $active = '<a href="javascript:void(0)" data-tb="pageroleaccessmap" data-val="0" data-id="' . $value->pageRoleMappingID . '"  data-col="pageRoleMappingID" role="button" tabindex="0" class="active-deactive-btn text-danger text-uppercase text-strong text-sm mr-10 ">De-Active</a>';
                    } else {
                        $active = '<a href="javascript:void(0)" data-tb="pageroleaccessmap" data-val="1" data-id="' . $value->pageRoleMappingID . '"  data-col="pageRoleMappingID" role="button" tabindex="0" class="active-deactive-btn text-success text-uppercase text-strong text-sm mr-10">Active</a>';
                    }
                }
                if (checkpageaccess('form-access', 1, 'modify')) {
                    $edit = "<a href='javascript:void(0);' data-val='" . $value->pageRoleMappingID . "'  data-ur='view-form-access' data-vur='edit-form-access' id='editviewcallform-btn' role='button' tabindex='0' class='editviewcallform-btn edit text-primary text-uppercase text-strong text-sm mr-10'>Edit</a>";
                }
                $vaules['Action'] = $view . $edit . $APPROVE . $active;


                $output[] = $vaules;
            }
        }

        echo json_encode(array('data' => $output), true);
    }

    function add_form_access() {
        if (!$this->session->userdata('SESS_userId') || !checkpageaccess('form-access', 1, 'create')) {
            return FALSE;
        }
        $userBranchID = $this->session->userdata('SESS_userBranchID');
        if ($_POST) {
            $this->form_validation->set_rules('pageID', 'Form Name', 'trim|required');
            $this->form_validation->set_rules('roleID', 'Role Name', 'trim|required');
            if ($this->form_validation->run($this) == FALSE) {
                //$this->session->set_userdata('err', validation_errors());
                echo 'Error! ' . validation_errors();
                return FALSE;
            }

            $pageRoleMappingID = 0;
            $createEnabled = 0;
            $viewEnabled = 0;
            $modifyEnabled = 0;
            $approveEnabled = 0;
            $deleteEnabled = 0;
            extract($this->input->post());
            //if(isset($createEnabled)){$createEnabled = 1;}

            $whereData = array('pageID' => $pageID, 'roleID' => $roleID);
            $pageroleaccessmap = selectTable('tblpageroleaccessmap', $whereData);
            if (isset($pageroleaccessmap) && $pageroleaccessmap->num_rows() > 0) {
                $accessmap = $pageroleaccessmap->row();
                $whereData = array('pageID' => $pageID, 'roleID' => $roleID);
                $updateData = array(
                    'createEnabled' => $createEnabled,
                    'viewEnabled' => $viewEnabled,
                    'modifyEnabled' => $modifyEnabled,
                    'approveEnabled' => $approveEnabled,
                    'deleteEnabled' => $deleteEnabled,
                    'createby' => $this->session->userdata('SESS_userId'),
                    'active' => 1);
                $pageRoleMappingID = updateTable('tblpageroleaccessmap', $whereData, $updateData, $isStoreMod = 1, $modIdName = 'pageRoleMappingID', $modId = $accessmap->pageRoleMappingID);
            } else {
                $values = array('pageID' => $pageID,
                    'roleID' => $roleID,
                    'createEnabled' => $createEnabled,
                    'viewEnabled' => $viewEnabled,
                    'modifyEnabled' => $modifyEnabled,
                    'approveEnabled' => $approveEnabled,
                    'deleteEnabled' => $deleteEnabled,
                    'createby' => $this->session->userdata('SESS_userId'),
                    'active' => 1);

                $pageRoleMappingID = insertTable('tblpageroleaccessmap', $values, 1, 'pageRoleMappingID');
            }

            if ($pageRoleMappingID > 0) {
                $this->session->set_userdata('suc', 'Form Access Setup successfully added...!');
                return TRUE;
            } else {
                //$this->session->set_userdata('err', 'Error! Please try again..!');
                echo 'Error! Please try again..!';
            }
            return FALSE;
        }
        $whereData = array('dbentrystateID !=' => 3, 'active' => 1);
        $data['pages'] = selectTable('tblpages', $whereData);

        $whereData = array('dbentrystateID !=' => 3, 'active' => 1, 'roleID !=' => 1);
        $data['role'] = selectTable('tblrole', $whereData);

        $data['pageTitle'] = "Form Access";
        //$data['table'] = "Add Form";
        $this->load->view('admin/form_access/add_form_access', $data);
    }

    function edit_form_access() {
        if (!$this->session->userdata('SESS_userId') || !checkpageaccess('form-access', 1, 'modify')) {
            return FALSE;
        }
        $userBranchID = $this->session->userdata('SESS_userBranchID');
        if ($_POST) {
            $this->form_validation->set_rules('pageID', 'Form Name', 'trim|required');
            $this->form_validation->set_rules('roleID', 'Role Name', 'trim|required');
            if ($this->form_validation->run($this) == FALSE) {
                //$this->session->set_userdata('err', validation_errors());
                echo 'Error! ' . validation_errors();
                return FALSE;
            }

            $pageRoleMappingID = 0;
            $createEnabled = 0;
            $viewEnabled = 0;
            $modifyEnabled = 0;
            $approveEnabled = 0;
            $deleteEnabled = 0;
            extract($this->input->post());
            //if(isset($createEnabled)){$createEnabled = 1;}

            $whereData = array('pageID' => $pageID, 'roleID' => $roleID);
            $pageroleaccessmap = selectTable('tblpageroleaccessmap', $whereData);
            if (isset($pageroleaccessmap) && $pageroleaccessmap->num_rows() > 0) {
                $accessmap = $pageroleaccessmap->row();
                $whereData = array('pageID' => $pageID, 'roleID' => $roleID);
                $updateData = array(
                    'createEnabled' => $createEnabled,
                    'viewEnabled' => $viewEnabled,
                    'modifyEnabled' => $modifyEnabled,
                    'approveEnabled' => $approveEnabled,
                    'deleteEnabled' => $deleteEnabled,
                    'createby' => $this->session->userdata('SESS_userId'),
                    'active' => 1);
                $pageRoleMappingID = updateTable('tblpageroleaccessmap', $whereData, $updateData, $isStoreMod = 1, $modIdName = 'pageRoleMappingID', $modId = $accessmap->pageRoleMappingID);
            }

            if ($pageRoleMappingID > 0) {
                $this->session->set_userdata('suc', 'Form Access Setup successfully updated...!');
                return TRUE;
            }
        }
        echo 'Error! Please try again..!';
        return FALSE;
    }

    function view_form_access() {
        if (!$this->session->userdata('SESS_userId') || !checkpageaccess('form-access', 1, 'view')) {
            return FALSE;
        }
        $this->form_validation->set_rules('id', 'ID', 'trim|required');
        $this->form_validation->set_rules('viewurl', 'ViewUrl', 'trim|required');
        if ($this->form_validation->run($this) == FALSE) {
            //$this->session->set_userdata('err', validation_errors());
            echo 'Error! ' . validation_errors();
            return FALSE;
        }
        extract($this->input->post());

        $whereData = array('dbentrystateID !=' => 3, 'active' => 1);
        $data['pages'] = selectTable('tblpages', $whereData);

        $whereData = array('dbentrystateID !=' => 3, 'active' => 1, 'roleID !=' => 1);
        $data['role'] = selectTable('tblrole', $whereData);

        $userBranchID = $this->session->userdata('SESS_userBranchID');
        if ($userBranchID == 0) {
            $whereData = array('pageRoleMappingID' => $id);
        } else {
            $whereData = array('pageRoleMappingID' => $id, 'active' => 1);
        }
        $data['pageroleaccessmap'] = selectTable('tblpageroleaccessmap', $whereData);

        $data['pageTitle'] = "Form Access";
        $data['pageRoleMappingID'] = $id;
        $this->load->view('admin/form_access/' . $viewurl, $data);
    }

}
