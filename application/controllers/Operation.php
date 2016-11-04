<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Operation extends CI_Controller {

   
    function __construct() 
	{
        parent::__construct();
        if (!$this->session->userdata('SESS_userId')) 
		{
            redirect(base_url() . "login");
        }
    }
    
    function index() 
	{
        $data['view']		=	$this->Commonsql_model->select_exist_conginor_contract();
		$data['pageTitle']	=	"Booking";
	    $this->load->view('admin/operation/add_booking',$data);
    }
  
}
