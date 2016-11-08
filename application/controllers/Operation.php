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
		$data['pageTitle']	=	"Booking";
	    $this->load->view('admin/operation/add_booking',$data);
    }
	 function create_trip_sheet() 
	{
		$data['pageTitle']	=	"Booking";
	    $this->load->view('admin/operation/create_trip_sheet',$data);
    }
	function delivery_closure()
	{
		$data['pageTitle']	=	"Delivery Closure";
	    $this->load->view('admin/operation/delivery_closure',$data);
	}
	function trip_payment_update()
	{
		$data['pageTitle']	=	"Trip Payment Update";
	    $this->load->view('admin/operation/trip_payment_update',$data);
	}
  
}
