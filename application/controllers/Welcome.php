<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

   
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
    function dashboard() {
        if (!$this->session->userdata('SESS_userId')) {
            redirect(base_url() . "login");
        }
//        $SESS_userRole = $this->session->userdata('SESS_userRole');
//        print_r($SESS_userRole);
//        $SESS_accessmap = $this->session->userdata('SESS_accessmap');
//        print_r($SESS_accessmap);
//        $finalaccessmap = checkpageaccess(1,'create');
        $headerData['pageTitle']='Dashboard';
       // $this->load->view('admin/header',$headerData);
        $this->load->view('admin/dashboard', $headerData);
        $this->load->view('admin/footer');
    }

    function login() {
        if ($this->session->userdata('SESS_userId')) {
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
                $whereData = array('username' => $username, 'password' => do_hash(do_hash(do_hash($password))), 'tlog.active' => 1, 'tlog.isUserLocked' => 0);
                $joins = array(
                    array(
                    'table' => 'tblemployee AS temp',
                    'condition' => 'temp.empID = tlog.empID',
                    'jointype' => 'LEFT'
                    ),
                );
                $columns ='temp.*,tlog.lastLoginOn,tlog.invalidPassAttemptCount';
                $user_list = get_joins('tbllogin AS tlog', $columns, $joins, $whereData);
                
                if ($user_list->num_rows() == 1) {
                    $userlist = $user_list->result_array();
                    $userview = $userlist[0];
                    //Store user Info to session
                    $this->session->set_userdata('SESS_userId', $userview['empID']);
                    $this->session->set_userdata('SESS_userCode', $userview['empCode']);
                    $this->session->set_userdata('SESS_userName', $userview['empname']);
                    $this->session->set_userdata('SESS_userBranchID', $userview['branchID']);
                    $this->session->set_userdata('SESS_userPic', $userview['photo']);
                    // Check user role for login user and set in session
                    $role=array();
                    if($userview['branchID']==0){
                        $role[]=1; // 1 - Super Admin
                    }else{
                        $whereData = array('empID' => $userview['empID'], 'dbentrystateID' => 3, 'active' => 1);
                        $showField = array('roleID');
                        // Get user record
                        $emprolemaps = selectTable('tblemprolemap', $whereData, $showField);
                        if (isset($emprolemaps) && $emprolemaps->num_rows() > 0) {
                            $emprolemaps = $emprolemaps->result();
                            foreach ($emprolemaps as $emprolemap) {
                                $role[]=$emprolemap->roleID;
                            }
                        }
                    }
                    // set role array format in session 
                    $this->session->set_userdata('SESS_userRole', $role);
                    // set session for page role access
                    $pageroleaccessmap = pageroleaccessmap($role);
                    $this->session->set_userdata('SESS_accessmap', $pageroleaccessmap);
                    
                    redirect(base_url() . "dashboard");
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
        if ($this->session->userdata('SESS_userId')) {
            redirect(base_url() . "dashboard");
        }
        
        $this->load->view('forgotPassword');
    }
    //logout
    function logout() {
        $this->session->sess_destroy();
        redirect(base_url() . "login");
    }
    
    
    ////////// page setup
    function page_master()
	{
            if (!$this->session->userdata('SESS_userId')) {
                redirect(base_url() . "login");
            }
		if($_POST)
		{
			$whereData	=	array('deptID'	=>	$this->uri->segment(3));
			$updateData	=	array('active'	=>	$this->uri->segment(4));
			$upt	=	$this->Commonsql_model->updateTable('tbldept', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','Department Status Successfully  Changed...!');
				redirect('department');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('department');
			}
		}
			
                $data['pageTitle']	=	"Page Master";
                $data['table']		=	"Page Master";
                $this->load->view('admin/page_setup/page_setup',$data);
	}

}
