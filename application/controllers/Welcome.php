<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

   
    function __construct() {
        parent::__construct();
        $this->load->model('Commonsql_model');
    }
    
    function index() {
        if ($this->session->userdata('login_id')) {
            redirect(base_url() . "dashboard");
        } else {
            redirect(base_url() . "login");
        }
    }

    function login() {
        if ($this->session->userdata('login_id')) {
            redirect(base_url() . "dashboard");
        }

        $data['error'] = 0;
        if ($_POST) {
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['error'] = 1;
                $data['error_msg'] = '<strong>Sorry!</strong> Mandatory fields are required';
            } else {
                $this->load->library('encrypt');
                $username = TRIM($this->input->post('username', true));
                $password = TRIM($this->input->post('password', true));
                $whereData = array('username' => $username, 'password' => do_hash(do_hash($password)), 'tl.active' => 1, 'tl.isUserLocked' => 0);
                
                $joins = array(
                    array(
                    'table' => 'tblemployee AS te',
                    'condition' => 'te.empID = tl.empID',
                    'jointype' => 'LEFT'
                    ),
                );
                $columns ='lb.*';
                $user_list = get_joins('tbllogin AS tl', $columns, $joins, $whereData);
                
                if ($user_list->num_rows() == 1) {
                    $userlist = $user_list->result_array();
                    $userview = $userlist[0];
                    $this->session->set_userdata('userId', $userview['empID']);
                    $this->session->set_userdata('userCode', $userview['empCode']);
                    $this->session->set_userdata('userName', $userview['empname']);
                    $this->session->set_userdata('userBranchID', $userview['branchID']);
                    $this->session->set_userdata('userPic', $userview['photo']);
                    redirect(base_url() . "admin/dashboard");
                } else {
                    $data['error'] = 1;
                    $data['error_msg'] = '<strong>Sorry!</strong> Your login information is incorrect';
                }
            }
        }
        $this->load->view('admin/login', $data);
    }

    //forgot_password
    function forgot_password() {
        if ($this->session->userdata('login_id')) {
            redirect(base_url() . "dashboard");
        }
        
        $this->load->view('admin/forgotPassword');
    }
    //logout
    function logout() {
        $this->session->sess_destroy();
        redirect(base_url() . "admin");
    }

}
