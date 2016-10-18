<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Manage extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        //$this->load->model('Commonsql_model');
    }
    
   
    function index()
	{
		$this->load->view('admin/dept/dept');
	}
	function dept_add()
	{
		$this->load->view('admin/dept/dept_add');
	}
	function add_department()
	{
		if($this->input->post('save'))
		{
			$values=array('department'			=>	$this->input->post('department'),
							'description'		=>	$this->input->post('description'),
							'dbentrystateID'	=>	0,
							'createby'			=>	$this->session->userdata('userId'),
							'active'			=>	1);
							
			$query	=	insertTable('tbldept', $values,0);
			if(query)
			{
				redirect('manage/add_department');
				
			}
			else
			{
				redirect('manage/add_department');
			}
		}
		$this->load->view('admin/dept/add_department');
	}
	function add_designation()
	{
		if($this->input->post('save'))
		{
			$values=array('name'				=>	$this->input->post('name'),
							'description'		=>	$this->input->post('description'),
							'dbentrystateID'	=>	0,
							'createby'			=>	$this->session->userdata('userId'),
							'active'			=>	1);
							
			$query	=	insertTable('tbldesignation', $values,0);
			if(query)
			{
				redirect('manage/add_designation');
				
			}
			else
			{
				redirect('manage/add_designation');
			}
		}
		$this->load->view('admin/designation/add_designation');
	}
	
	function add_role()
	{
		if($this->input->post('save'))
		{
			$values=array('roleName'				=>	$this->input->post('roleName'),
							'description'		=>	$this->input->post('description'),
							'dbentrystateID'	=>	0,
							'createby'			=>	$this->session->userdata('userId'),
							'active'			=>	1);
							
			$query	=	insertTable('tblrole', $values,0);
			if(query)
			{
				redirect('manage/add_role');
				
			}
			else
			{
				redirect('manage/add_role');
			}
		}
		$this->load->view('admin/role/add_role');
	}
	
	function add_payment_mode()
	{
		if($this->input->post('save'))
		{
			$values=array('paymentMode'				=>	$this->input->post('paymentMode'),
							'description'		=>	$this->input->post('description'),
							'dbentrystateID'	=>	0,
							'createby'			=>	$this->session->userdata('userId'),
							'active'			=>	1);
							
			$query	=	insertTable('tblpaymentmode', $values,0);
			if(query)
			{
				redirect('manage/add_payment_mode');
				
			}
			else
			{
				redirect('manage/add_payment_mode');
			}
		}
		$this->load->view('admin/payment_mode/add_payment_mode');
	}
	function add_payment_status()
	{
		if($this->input->post('save'))
		{
			$values=array('payStatus'				=>	$this->input->post('payStatus'),
							'description'		=>	$this->input->post('description'),
							'dbentrystateID'	=>	0,
							'createby'			=>	$this->session->userdata('userId'),
							'active'			=>	1);
							
			$query	=	insertTable('tblpaymentstatus', $values,0);
			if(query)
			{
				redirect('manage/add_payment_status');
				
			}
			else
			{
				redirect('manage/add_payment_status');
			}
		}
		$this->load->view('admin/payment_mode/add_payment_status');
	}
	function add_employee_types()
	{
		if($this->input->post('save'))
		{
			$values=array('typename'				=>	$this->input->post('typename'),
							'description'		=>	$this->input->post('description'),
							'dbentrystateID'	=>	0,
							'createby'			=>	$this->session->userdata('userId'),
							'active'			=>	1);
							
			$query	=	insertTable('tblemployetypes', $values,0);
			if(query)
			{
				redirect('manage/add_employee_types');
				
			}
			else
			{
				redirect('manage/add_employee_types');
			}
		}
		$this->load->view('admin/employee_types/add_employee_types');
	}
   
   
}
