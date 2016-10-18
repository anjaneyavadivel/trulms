<?php defined('BASEPATH') OR exit('No direct script access allowed');
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
	/***********************************************************************************************************************************/
	function department()
	{
		if($this->uri->segment(3))
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
		else
		{
			$data['pageTitle']	=	"Department";
			$data['table']		=	"Department";
			$this->load->view('admin/dept/department',$data);
		}
	}
	function department_json()
	{
		$result	=	$this->Commonsql_model->select_all('tbldept');
		$output = array();
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['deptID']			=	$value->deptID;
			$vaules['department'] 		= 	$value->department;
			$vaules['description'] 		= 	$value->description;
			if($value->active==1)
			{
				$active	=	"<a href='".base_url()."manage/department/".$value->deptID."/0'role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 active'>Active</a>";
			}
			else
			{
				$active	=	"<a href='".base_url()."manage/department/".$value->deptID."/1' role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 deactive'>De-Active</a>";
			}
			$vaules['Action'] 			=	"<a href='".base_url()."edit_department/".$value->deptID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Edit</a>".$active;
			
			$output[] =$vaules;
		}

		 echo json_encode(array('data'=>$output), true);
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
			if($query)
			{
				$this->session->set_userdata('suc','Department Successfully  Added...!');
				redirect('manage/add_department');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('manage/add_department');
			}
		}
		$data['pageTitle']	=	"Add Department";
		$this->load->view('admin/dept/add_department',$data);
	}
	function edit_department()
	{
		if($this->input->post('save'))
		{
			
			if(MOD_STATUS==1)
			{
				$values_mod=array('deptID'		=>	$this->input->post('deptID'),
							'department'		=>	$this->input->post('department'),
							'description'		=>	$this->input->post('description'),
							'dbentrystateID'	=>	0,
							'createby'			=>	$this->session->userdata('userId'),
							'active'			=>	1);
							
				$query	=	insertTable('tbldept_mod', $values_mod,0);
			}
			if(MOD_STATUS==0)
			{
				$values=array('department'			=>	$this->input->post('department'),
							'description'		=>	$this->input->post('description'),
							);
							
				$whereData	=	array('deptID'	=>	$this->input->post('deptID'));
				$query		=	$this->Commonsql_model->updateTable('tbldept', $whereData , $values);
			}
			if($query)
			{
				$this->session->set_userdata('suc','Department Successfully  Updated...!');
				redirect('edit_department/'.$this->input->post('deptID'));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('add_department/'.$this->input->post('deptID'));
			}
		}
		$data['pageTitle']	=	"Edit Department";
		$data['view']		=	$this->Commonsql_model->select('tbldept',array('deptID'=>$this->uri->segment(2)));
		$this->load->view('admin/dept/edit_department',$data);
	}
	/***********************************************************************************************************************************/
	function designation()
	{
		if($this->uri->segment(3))
		{
			$whereData	=	array('desigID'	=>	$this->uri->segment(3));
			$updateData	=	array('active'	=>	$this->uri->segment(4));
			$upt	=	$this->Commonsql_model->updateTable('tbldesignation', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','Designation Status Successfully  Changed...!');
				redirect('designation');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('designation');
			}
		}
		else
		{
			$data['pageTitle']	=	"Designation";
			$data['table']		=	"Designation";
			$this->load->view('admin/designation/designation',$data);
		}
	}
	function designation_json()
	{
		$result	=	$this->Commonsql_model->select_all('tbldesignation');
		$output = array();
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']			=	$value->desigID;
			$vaules['name'] 			= 	$value->name;
			$vaules['description'] 		= 	$value->description;
			if($value->active==1)
			{
				$active	=	"<a href='".base_url()."manage/designation/".$value->desigID."/0'role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 active'>Active</a>";
			}
			else
			{
				$active	=	"<a href='".base_url()."manage/designation/".$value->desigID."/1' role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 deactive'>De-Active</a>";
			}
			$vaules['Action'] 			=	"<a  href='".base_url()."edit_designation/".$value->desigID."' role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Edit</a>".$active;
			
			$output[] =$vaules;
		}

		 echo json_encode(array('data'=>$output), true);
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
			if($query)
			{
				$this->session->set_userdata('suc','Designation Successfully  Added...!');
				redirect('manage/add_designation');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('manage/add_designation');
			}
		}
		$data['pageTitle']	=	"Add Designation";
		$this->load->view('admin/designation/add_designation',$data);
	}
	function edit_designation()
	{
		if($this->input->post('save'))
		{
			if(MOD_STATUS==1)
			{
				$values=array('name'			=>	$this->input->post('name'),
							'desigID'			=>	$this->input->post('desigID'),
							'description'		=>	$this->input->post('description'),
							'dbentrystateID'	=>	0,
							'createby'			=>	$this->session->userdata('userId'),
							'active'			=>	1);
							
				$query	=	insertTable('tbldesignation_mod', $values_mod,0);
			}
			if(MOD_STATUS==0)
			{
				$values=array('name'				=>	$this->input->post('name'),
								'description'		=>	$this->input->post('description'),
								);
				$whereData	=	array('desigID'	=>	$this->input->post('desigID'));
				$query		=	$this->Commonsql_model->updateTable('tbldesignation', $whereData , $values);
			}
			if($query)
			{
				$this->session->set_userdata('suc','Designation Successfully  Added...!');
				redirect('edit_designation/'.$this->input->post('desigID'));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('edit_designation/'.$this->input->post('desigID'));
			}
		}
		$data['pageTitle']	=	"Edit Designation";
		$data['view']		=	$this->Commonsql_model->select('tbldesignation',array('desigID'=>$this->uri->segment(2)));
		$this->load->view('admin/designation/edit_designation',$data);
	}
	/***********************************************************************************************************************************/
	function role()
	{
		if($this->uri->segment(3))
		{
			$whereData	=	array('roleID'	=>	$this->uri->segment(3));
			$updateData	=	array('active'	=>	$this->uri->segment(4));
			$upt	=	$this->Commonsql_model->updateTable('tblrole', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','Role Status Successfully  Changed...!');
				redirect('role');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('role');
			}
		}
		else
		{
			$data['pageTitle']	=	"Role";
			$data['table']		=	"Role";
			$this->load->view('admin/role/role',$data);
		}
	}
	function role_json()
	{
		$result	=	$this->Commonsql_model->select_all('tblrole');
		$output = array();
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$value->roleID;
			$vaules['roleName'] 		= 	$value->roleName;
			$vaules['description'] 		= 	$value->description;
			if($value->active==1)
			{
				$active	=	"<a href='".base_url()."manage/role/".$value->roleID."/0'role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 active'>Active</a>";
			}
			else
			{
				$active	=	"<a href='".base_url()."manage/role/".$value->roleID."/1' role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 deactive'>De-Active</a>";
			}
			$vaules['Action'] 			=	"<a href='".base_url()."edit_role/".$value->roleID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Edit</a>".$active;
			
			$output[] =$vaules;
		}

		 echo json_encode(array('data'=>$output), true);
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
			if($query)
			{
				$this->session->set_userdata('suc','Role Successfully  Added...!');
				redirect('manage/add_role');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('manage/add_role');
			}
		}
		$data['pageTitle']	=	"Add Role";
		$this->load->view('admin/role/add_role',$data);
	}
	function edit_role()
	{
		if($this->input->post('save'))
		{
			if(MOD_STATUS==1)
			{
				$values=array('roleName'			=>	$this->input->post('roleName'),
								'description'		=>	$this->input->post('description'),
								'roleID'			=>	$this->input->post('roleID'),
								'dbentrystateID'	=>	0,
								'createby'			=>	$this->session->userdata('userId'),
								'active'			=>	1);
								
				$query	=	insertTable('tblrole_mod', $values,0);
			}
			if(MOD_STATUS==0)
			{
				$values=array('roleName'				=>	$this->input->post('roleName'),
									'description'		=>	$this->input->post('description'),
								);
								
				$whereData	=	array('roleID'	=>	$this->input->post('roleID'));
				$query		=	$this->Commonsql_model->updateTable('tblrole', $whereData , $values);
			}
			if($query)
			{
				$this->session->set_userdata('suc','Role Successfully  Updated...!');
				redirect('edit_role/'.$this->input->post('roleID'));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('edit_role'.$this->input->post('roleID'));
			}
		}
		$data['pageTitle']	=	"Edit Role";
		$data['view']		=	$this->Commonsql_model->select('tblrole',array('roleID'=>$this->uri->segment(2)));
		$this->load->view('admin/role/edit_role',$data);
	}
	/***********************************************************************************************************************************/
	function payment_mode()
	{
		if($this->uri->segment(3))
		{
			$whereData	=	array('paymentModeID'	=>	$this->uri->segment(3));
			$updateData	=	array('active'	=>	$this->uri->segment(4));
			$upt	=	$this->Commonsql_model->updateTable('tblpaymentmode', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','Payment mode Status Successfully  Changed...!');
				redirect('payment_mode');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('payment_mode');
			}
		}
		else
		{
			$data['pageTitle']	=	"Payment Mode";
			$data['table']		=	"Payment Mode";
			$this->load->view('admin/payment_mode/payment_mode',$data);
		}
	}
	function payment_mode_json()
	{
		$result	=	$this->Commonsql_model->select_all('tblpaymentmode');
		$output = array();
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$value->paymentModeID;
			$vaules['paymentMode'] 		= 	$value->paymentMode;
			$vaules['description'] 		= 	$value->description;
			if($value->active==1)
			{
				$active	=	"<a href='".base_url()."manage/payment_mode/".$value->paymentModeID."/0'role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 active'>Active</a>";
			}
			else
			{
				$active	=	"<a href='".base_url()."manage/payment_mode/".$value->paymentModeID."/1' role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 deactive'>De-Active</a>";
			}
			$vaules['Action'] 			=	"<a href='".base_url()."edit_payment_mode/".$value->paymentModeID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Edit</a>".$active;
			
			$output[] =$vaules;
		}

		 echo json_encode(array('data'=>$output), true);
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
			if($query)
			{
				$this->session->set_userdata('suc','Payment Mode Successfully  Added...!');
				redirect('manage/add_payment_mode');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('manage/add_payment_mode');
			}
		}
		$data['pageTitle']	=	"Add Payment Mode";
		$this->load->view('admin/payment_mode/add_payment_mode',$data);
	}
	function edit_payment_mode()
	{
		if($this->input->post('save'))
		{
			if(MOD_STATUS==1)
			{
				$values=array('paymentMode'				=>	$this->input->post('paymentMode'),
								'description'		=>	$this->input->post('description'),
								'paymentModeID'	=>	$this->input->post('paymentModeID'),
								'dbentrystateID'	=>	0,
								'createby'			=>	$this->session->userdata('userId'),
								'active'			=>	1);
								
				$query	=	insertTable('tblpaymentmode_mod', $values,0);
			}
			if(MOD_STATUS==0)
			{
				$values=array('paymentMode'				=>	$this->input->post('paymentMode'),
									'description'		=>	$this->input->post('description'),
								);
								
				$whereData	=	array('paymentModeID'	=>	$this->input->post('paymentModeID'));
				$query		=	$this->Commonsql_model->updateTable('tblpaymentmode', $whereData , $values);
			}
			if($query)
			{
				$this->session->set_userdata('suc','Payment Mode Successfully  Updated...!');
				redirect('edit_payment_mode/'.$this->input->post('paymentModeID'));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('edit_payment_mode/'.$this->input->post('paymentModeID'));
			}
		}
		$data['pageTitle']	=	"Edit Payment Mode";
		$data['view']		=	$this->Commonsql_model->select('tblpaymentmode',array('paymentModeID'=>$this->uri->segment(2)));
		$this->load->view('admin/payment_mode/edit_payment_mode',$data);
	}
	
	/***********************************************************************************************************************************/
	function payment_status()
	{
		if($this->uri->segment(3))
		{
			$whereData	=	array('payStatusID'	=>	$this->uri->segment(3));
			$updateData	=	array('active'	=>	$this->uri->segment(4));
			$upt	=	$this->Commonsql_model->updateTable('tblpaymentstatus', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','Payment Status Successfully  Changed...!');
				redirect('payment_status');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('payment_status');
			}
		}
		else
		{
			$data['pageTitle']	=	"Payment Status";
			$data['table']		=	"Payment Status";
			$this->load->view('admin/payment_mode/payment_status',$data);
		}
	}
	function payment_status_json()
	{
		$result	=	$this->Commonsql_model->select_all('tblpaymentstatus');
		$output = array();
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$value->payStatusID;
			$vaules['name'] 			= 	$value->payStatus;
			$vaules['description'] 		= 	$value->description;
			if($value->active==1)
			{
				$active	=	"<a href='".base_url()."manage/payment_status/".$value->payStatusID."/0'role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 active'>Active</a>";
			}
			else
			{
				$active	=	"<a href='".base_url()."manage/payment_status/".$value->payStatusID."/1' role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 deactive'>De-Active</a>";
			}
			$vaules['Action'] 			=	"<a href='".base_url()."edit_payment_status/".$value->payStatusID."' role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Edit</a>".$active;
			
			$output[] =$vaules;
		}

		 echo json_encode(array('data'=>$output), true);
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
			if($query)
			{
				$this->session->set_userdata('suc','Payment Status Successfully  Added...!');
				redirect('manage/add_payment_status');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('manage/add_payment_status');
			}
		}
		$data['pageTitle']	=	"Add Payment Status";
		$this->load->view('admin/payment_mode/add_payment_status',$data);;
	}
	function edit_payment_status()
	{
		if($this->input->post('save'))
		{
			if(MOD_STATUS==1)
			{
				$values=array('payStatus'				=>	$this->input->post('payStatus'),
								'description'		=>	$this->input->post('description'),
								'payStatusID'		=>	$this->input->post('payStatusID'),
								'dbentrystateID'	=>	0,
								'createby'			=>	$this->session->userdata('userId'),
								'active'			=>	1);
								
				$query	=	insertTable('tblpaymentstatus_mod', $values,0);
			}
			if(MOD_STATUS==0)
			{
				$values=array('payStatus'				=>	$this->input->post('payStatus'),
									'description'		=>	$this->input->post('description'),
								);
								
				$whereData	=	array('payStatusID'	=>	$this->input->post('payStatusID'));
				$query		=	$this->Commonsql_model->updateTable('tblpaymentstatus', $whereData , $values);
			}
			if($query)
			{
				$this->session->set_userdata('suc','Payment Status Successfully  Updated...!');
				redirect('edit_payment_status/'.$this->input->post('payStatusID'));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('edit_payment_status/'.$this->input->post('payStatusID'));
			}
		}
		$data['pageTitle']	=	"Edit Payment Status";
		$data['view']		=	$this->Commonsql_model->select('tblpaymentstatus',array('payStatusID'=>$this->uri->segment(2)));
		$this->load->view('admin/payment_mode/edit_payment_status',$data);;
	}
	
	/***********************************************************************************************************************************/
	function employee_types()
	{
		if($this->uri->segment(3))
		{
			$whereData	=	array('employetypeID'	=>	$this->uri->segment(3));
			$updateData	=	array('active'	=>	$this->uri->segment(4));
			$upt	=	$this->Commonsql_model->updateTable('tblemployetypes', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','Employee Types Status Successfully  Changed...!');
				redirect('employee_types');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('employee_types');
			}
		}
		else
		{
			$data['pageTitle']	=	"Emplyee Types";
			$data['table']		=	"Emplyee Types";
			$this->load->view('admin/employee_types/employee_types',$data);
		}
	}
	function employee_types_json()
	{
		$result	=	$this->Commonsql_model->select_all('tblemployetypes');
		$output = array();
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$value->employetypeID;
			$vaules['name'] 			= 	$value->typename;
			$vaules['description'] 		= 	$value->description;
			if($value->active==1)
			{
				$active	=	"<a href='".base_url()."manage/employee_types/".$value->employetypeID."/0'role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 active'>Active</a>";
			}
			else
			{
				$active	=	"<a href='".base_url()."manage/employee_types/".$value->employetypeID."/1' role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 deactive'>De-Active</a>";
			}
			$vaules['Action'] 			=	"<a  href='".base_url()."edit_employee_types/".$value->employetypeID."' role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Edit</a>".$active;
			
			$output[] =$vaules;
		}

		 echo json_encode(array('data'=>$output), true);
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
			if($query)
			{
				$this->session->set_userdata('suc','Employee Types Successfully  Added...!');
				redirect('manage/add_employee_types');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('manage/add_employee_types');
			}
		}
		$data['pageTitle']	=	"Add Emplyee Types";
		$this->load->view('admin/employee_types/add_employee_types',$data);
	}
	function edit_employee_types()
	{
		if($this->input->post('save'))
		{
			if(MOD_STATUS==1)
			{
				$values=array('typename'				=>	$this->input->post('typename'),
								'description'		=>	$this->input->post('description'),
								'employetypeID'		=>	$this->input->post('employetypeID'),
								'dbentrystateID'	=>	0,
								'createby'			=>	$this->session->userdata('userId'),
								'active'			=>	1);
								
				$query	=	insertTable('tblemployetypes_mod', $values,0);
			}
			if(MOD_STATUS==0)
			{
				$values=array('typename'				=>	$this->input->post('typename'),
									'description'		=>	$this->input->post('description'),
								);
								
				$whereData	=	array('employetypeID'	=>	$this->input->post('employetypeID'));
				$query		=	$this->Commonsql_model->updateTable('tblemployetypes', $whereData , $values);
			}
			if($query)
			{
				$this->session->set_userdata('suc','Employee Types Successfully  Updated...!');
				redirect('edit_employee_types/'.$this->input->post('employetypeID'));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('edit_employee_types/'.$this->input->post('employetypeID'));
			}
		}
		$data['pageTitle']	=	"Edit Emplyee Types";
		$data['view']		=	$this->Commonsql_model->select('tblemployetypes',array('employetypeID'=>$this->uri->segment(2)));
		$this->load->view('admin/employee_types/edit_employee_types',$data);
	}
   
   
}
