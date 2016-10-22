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
        if ($this->input->post('save')) {
            $values = array('department' => $this->input->post('department'),
                'description' => $this->input->post('description'),
                'dbentrystateID' => 0,
                'createby' => $this->session->userdata('SESS_userId'),
                'active' => 1);

            $query = insertTable('tbldept', $values, 1, 'deptID');
            if ($query) {
                $this->session->set_userdata('suc', 'Department Successfully  Added...!');
                redirect('manage/add_department');
            } else {
                $this->session->set_userdata('err', 'Error Please try again..!');
                redirect('manage/add_department');
            }
        }
        $data['pageTitle'] = "Form";
        $this->load->view('admin/form_master/add_form_master', $data);
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
