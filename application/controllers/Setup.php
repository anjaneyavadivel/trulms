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
            $upt = $this->Commonsql_model->updateTable('tbldept', $whereData, $updateData);
            //echo $this->db->last_query();exit;
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
        $data['pageTitle'] = "Add Form";
        $data['table'] = "Add Form";
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

    function edit_form_master($pageID='') {
        if (!$this->session->userdata('SESS_userId') || $pageID=='') {
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
            if ($query > 0 || $query1 >0) {
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
            $whereData = array('deptID' => $this->uri->segment(3));
            $updateData = array('active' => $this->uri->segment(4));
            $upt = $this->Commonsql_model->updateTable('tbldept', $whereData, $updateData);
            //echo $this->db->last_query();exit;
            if ($upt) {
                $this->session->set_userdata('suc', 'Employee Role Status Successfully Changed...!');
                redirect('employee-role');
            } else {
                $this->session->set_userdata('err', 'Error Please try again..!');
                redirect('employee-role');
            }
        }

        $data['pageTitle'] = "Eployee Role";
        $data['table'] = "Eployee Role";
        $this->load->view('admin/employee_role/employee_role', $data);
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
