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

    ////////// employee role
    function form_master() {
        if (!$this->session->userdata('SESS_userId')) {
            redirect(base_url() . "login");
        }
        if ($_POST) {
            $whereData = array('deptID' => $this->uri->segment(3));
            $updateData = array('active' => $this->uri->segment(4));
            $upt = updateTable('tbldept', $whereData, $updateData, $isStoreMod = 1, $modIdName = 'deptID', $modId = $this->uri->segment(3));
            if ($upt) {
                $this->session->set_userdata('suc', 'Forms Status Successfully Changed...!');
                redirect('employee-role');
            } else {
                $this->session->set_userdata('err', 'Error Please try again..!');
                redirect('employee-role');
            }
        }

        $data['pageTitle'] = "Form";
        $data['table'] = "Form";
        $this->load->view('admin/form_master/form_master', $data);
    }

    function add_form_master() {
        if (!$this->session->userdata('SESS_userId')) {
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
                'dbentrystateID' => 3,
                'createby' => $this->session->userdata('SESS_userId'),
                'active' => 1);

            $pageID = insertTable('tblpages', $values, 1, 'pageID');
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
            $values = array(
                'pageID' => $pageID,
                'iscreateApproveRequired' => $iscreateApproveRequired,
                'ismodifyApproveRequired' => $ismodifyApproveRequired,
                'isReportingUserApproveAllowed' => $isReportingUserApproveAllowed,
                'isSelfEditAllowed' => $isSelfEditAllowed,
                'isSelfApprovalAllowed' => $isSelfApprovalAllowed,
                'dbentrystateID' => 3,
                'createby' => $this->session->userdata('SESS_userId'),
                'active' => 1);

            $pageAlterDetailsID = insertTable('tblpagealterdetails', $values, 1, 'pageAlterDetailsID');
            if ($pageID > 0 && $pageAlterDetailsID > 0) {
                $this->session->set_userdata('suc', 'Form successfully  added...!');
                redirect('add-form-master');
            } else {
                $this->session->set_userdata('err', 'Error! Please try again..!');
                redirect('add-form-master');
            }
        }
        $data['pageTitle'] = "Form";
        //$data['table'] = "Add Form";
        $this->load->view('admin/form_master/add_form_master', $data);
    }

    function form_master_json() {
        if (!$this->session->userdata('SESS_userId')) {
            return FALSE;
        }
        $output = array();
        $whereData = array();
        // Get user record
        $pages = selectTable('tblpages', $whereData);
        if (isset($pages) && $pages->num_rows() > 0) {
            $i = 1;
            foreach ($pages->result() as $value) {
                $vaules = array();
                $vaules['pageID'] = $i++;
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

                if ($value->active == 1) {
                    $view = "<a href='" . base_url() . "view-form-master/" . $value->pageID . "'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>View</a>";
                    $APPROVE = ''; //"<a href='" . base_url() . "approve-form-master/" . $value->pageID . "'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>APPROVE</a>";
                    $active = '<a href="javascript:void(0)" data-tb="pages" data-val="0" data-id="' . $value->pageID . '"  data-col="pageID" role="button" tabindex="0" class="active-deactive-btn text-danger text-uppercase text-strong text-sm mr-10 ">De-Active</a>';
                } else {
                    $APPROVE = '';
                    $view = '';
                    $active = '<a href="javascript:void(0)" data-tb="pages" data-val="1" data-id="' . $value->pageID . '"  data-col="pageID" role="button" tabindex="0" class="active-deactive-btn text-success text-uppercase text-strong text-sm mr-10">Active</a>';
                }

                $vaules['Action'] = $view . $APPROVE . "<a href='" . base_url() . "edit-form-master/" . $value->pageID . "'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Edit</a>" . $active;

                $output[] = $vaules;
            }
        }

        echo json_encode(array('data' => $output), true);
    }

    function edit_form_master($pageID = '') {
        if (!$this->session->userdata('SESS_userId') || $pageID == '') {
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

            extract($this->input->post());

            // insert data into tblpages
            $values = array('menuCaption' => $menuCaption,
                'url' => $url,
                'icon' => $icon,
                'tooltip' => $tooltip,
                'parentID' => $parentID,
                'createby' => $this->session->userdata('SESS_userId'),
                'active' => 1);

            $whereData = array('pageID' => $pageID);

            $query = updateTable('tblpages', $whereData, $values, 1, 'pageID', $pageID);

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
            $values1 = array(
                'iscreateApproveRequired' => $iscreateApproveRequired,
                'ismodifyApproveRequired' => $ismodifyApproveRequired,
                'isReportingUserApproveAllowed' => $isReportingUserApproveAllowed,
                'isSelfEditAllowed' => $isSelfEditAllowed,
                'isSelfApprovalAllowed' => $isSelfApprovalAllowed,
                'createby' => $this->session->userdata('SESS_userId'),
                'active' => 1);

            $whereData = array('pageID' => $pageID);

            $query1 = updateTable('tblpagealterdetails', $whereData, $values1, 1, 'pageID', $pageID);
            if ($query > 0 || $query1 > 0) {
                $this->session->set_userdata('suc', 'Form Master successfully updated...!');
                redirect('edit-form-master/' . $pageID);
            } else {
                $this->session->set_userdata('err', 'Error Please try again..!');
                redirect('edit-form-master/' . $pageID);
            }
        }
        $data['pageTitle'] = "Form Master";
        $data['pageID'] = $pageID;
        $data['pages'] = $this->Commonsql_model->select('tblpages', array('pageID' => $this->uri->segment(2)));
        $data['pagealt'] = $this->Commonsql_model->select('tblpagealterdetails', array('pageID' => $this->uri->segment(2)));
        $this->load->view('admin/form_master/edit_form_master', $data);
    }

    function view_form_master() {
        if (!$this->session->userdata('SESS_userId')) {
            redirect(base_url() . "login");
        }
        $data['pageTitle'] = "View Form Master";
        $data['pages'] = $this->Commonsql_model->select('tblpages', array('pageID' => $this->uri->segment(2)));
        $data['pagealt'] = $this->Commonsql_model->select('tblpagealterdetails', array('pageID' => $this->uri->segment(2)));
        $this->load->view('admin/form_master/view_form_master', $data);
    }

    ////////// employee role
    function employee_role() {
        if (!$this->session->userdata('SESS_userId')) {
            redirect(base_url() . "login");
        }
        if ($_POST) {
            $whereData = array('empRoleMapID' => $this->uri->segment(3));
            $updateData = array('active' => $this->uri->segment(4));
            $upt = updateTable('tblemprolemap', $whereData, $updateData, $isStoreMod = 1, $modIdName = 'empRoleMapID', $modId = $this->uri->segment(3));
            if ($upt) {
                $this->session->set_userdata('suc', 'Eployee Role Setup Status Successfully Changed...!');
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
        if (!$this->session->userdata('SESS_userId')) {
            return FALSE;
        }
        $output = array();
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
            ),
            array(
                'table' => 'tblrole AS trole',
                'condition' => 'trole.roleID = temprole.roleID',
                'jointype' => 'LEFT'
            ),
        );
        $columns = 'temprole.*,temp.empCode,temp.empname,tdes.name,tdept.department,trole.roleName';
        $employeeRolw = get_joins('tblemployee AS temp', $columns, $joins, $whereData = array(), $orWhereData = array(), $group = array(), $order = 'empRoleMapID DESC');

        if (isset($employeeRolw) && $employeeRolw->num_rows() > 0) {
            $i = 1;
            foreach ($employeeRolw->result() as $value) {
                $vaules = array();
                $vaules['ID'] = $i++;
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

                if ($value->active == 1) {
                    $view = "<a href='" . base_url() . "view-employee-role/" . $value->empRoleMapID . "'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>View</a>";
                    $APPROVE = "<a href='" . base_url() . "approve-employee-role/" . $value->empRoleMapID . "'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>APPROVE</a>";
                    $active = '<a href="javascript:void(0)" data-tb="emprolemap" data-val="0" data-id="' . $value->empRoleMapID . '"  data-col="empRoleMapID" role="button" tabindex="0" class="active-deactive-btn text-danger text-uppercase text-strong text-sm mr-10 ">De-Active</a>';
                } else {
                    $APPROVE = '';
                    $view = '';
                    $active = '<a href="javascript:void(0)" data-tb="emprolemap" data-val="1" data-id="' . $value->empRoleMapID . '"  data-col="empRoleMapID" role="button" tabindex="0" class="active-deactive-btn text-success text-uppercase text-strong text-sm mr-10">Active</a>';
                }

                $vaules['Action'] = $view . $APPROVE . "<a href='" . base_url() . "edit-employee-role/" . $value->empRoleMapID . "'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Edit</a>" . $active;

                $output[] = $vaules;
            }
        }

        echo json_encode(array('data' => $output), true);
    }

    function add_employee_role() {
        if (!$this->session->userdata('SESS_userId')) {
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
                    'dbentrystateID' => 0,
                    'createby' => $this->session->userdata('SESS_userId'),
                    'active' => 1);

                $empRoleMapID = insertTable('tblemprolemap', $values, 1, 'empRoleMapID');
            }
            if ($empRoleMapID > 0) {
                $this->session->set_userdata('suc', 'Form successfully  added...!');
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
            $whereData = array('temp.dbentrystateID' => 3, 'temp.active' => 1);
        } else {
            $whereData = array('temp.branchID' => $userBranchID, 'temp.dbentrystateID' => 3, 'temp.active' => 1);
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

        $whereData = array('dbentrystateID' => 3, 'active' => 1);
        // Get user record
        $data['role'] = selectTable('tblrole', $whereData);

        $data['pageTitle'] = "Employee Role";
        //$data['table'] = "Add Form";
        $this->load->view('admin/employee_role/add_employee_role', $data);
    }

    function view_employee_role() {
        if (!$this->session->userdata('SESS_userId')) {
            redirect(base_url() . "login");
        }
        $userBranchID = $this->session->userdata('SESS_userBranchID');
        $roleID = $this->uri->segment(2);

        if ($userBranchID == 0) {
            $whereData = array('temp.dbentrystateID' => 3, 'temprole.empRoleMapID' => $roleID, 'temp.active' => 1);
        } else {
            $whereData = array('temp.branchID' => $userBranchID, 'temprole.empRoleMapID' => $roleID, 'temp.dbentrystateID' => 3, 'temp.active' => 1);
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

        $whereData = array('dbentrystateID' => 3, 'active' => 1);
        // Get user record
        $data['role'] = selectTable('tblrole', $whereData);
        $employeeRolw = $data['employeeRolw']->row();
        $whereData = array('active' => 1, 'empID' => $employeeRolw->empID, 'dbentrystateID' => 3);
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
        if (!$this->session->userdata('SESS_userId')) {
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
                            'dbentrystateID' => 0,
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
            $whereData = array('temp.dbentrystateID' => 3, 'temprole.empRoleMapID' => $empRoleMapID, 'temp.active' => 1);
        } else {
            $whereData = array('temp.branchID' => $userBranchID, 'temprole.empRoleMapID' => $empRoleMapID, 'temp.dbentrystateID' => 3, 'temp.active' => 1);
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

        $whereData = array('dbentrystateID' => 3, 'active' => 1);
        // Get user record
        $data['role'] = selectTable('tblrole', $whereData);
        $employeeRolw = $data['employeeRolw']->row();
        $whereData = array('active' => 1, 'empID' => $employeeRolw->empID, 'dbentrystateID' => 3);
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

////////// form access
    function form_access() {
        if (!$this->session->userdata('SESS_userId')) {
            redirect(base_url() . "login");
        }
        if ($_POST) {
            $whereData = array('deptID' => $this->uri->segment(3));
            $updateData = array('active' => $this->uri->segment(4));
            $upt = $this->Commonsql_model->updateTable('tbldept', $whereData, $updateData);
            //echo $this->db->last_query();exit;
            if ($upt) {
                $this->session->set_userdata('suc', 'Department Status Successfully  Changed...!');
                redirect('department');
            } else {
                $this->session->set_userdata('err', 'Error Please try again..!');
                redirect('department');
            }
        }

        $data['pageTitle'] = "Form Access";
        $data['table'] = "Form Access";
        $this->load->view('admin/form_access/form_access', $data);
    }

}
