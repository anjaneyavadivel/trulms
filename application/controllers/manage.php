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
			/*print_r($this->session->userdata('SESS_userRole'));
			$SESS_userRole = $this->session->userdata('SESS_userRole');
			$pageroleaccessmap = pageroleaccessmap($SESS_userRole, 'designation');
			print_r($pageroleaccessmap);
			exit();*/
			
			$data['pageTitle']	=	"Department";
			$data['table']		=	"Department";
			$this->load->view('admin/dept/department',$data);
		}
	}
	function department_json()
	{
		$result	=	$this->Commonsql_model->select_all('tbldept','deptID');
		$output = array();$i=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['deptID']			=	$i++;
			$vaules['department'] 		= 	$value->department;
			$vaules['description'] 		= 	$value->description;
			if($value->active==1)
			{
				$view			 			=	"<a href='".base_url()."view_department/".$value->deptID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>View</a>";
				$APPROVE			 			=	"<a href='".base_url()."approve_department/".$value->deptID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>APPROVE</a>";
				$active	=	"<a href='".base_url()."manage/department/".$value->deptID."/0'role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 active'>Active</a>";
			}
			else
			{
				$APPROVE		=	'';
				$view			 =	'';
				$active	=	"<a href='".base_url()."manage/department/".$value->deptID."/1' role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 deactive'>De-Active</a>";
			}
			
			$vaules['Action'] 			=	$view.$APPROVE."<a href='".base_url()."edit_department/".$value->deptID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Edit</a>".$active;
			
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
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$query	=	insertTable('tbldept', $values,1,'deptID');
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
			
			
				$values_mod=array('department'		=>	$this->input->post('department'),
							'description'		=>	$this->input->post('description'),
							'dbentrystateID'	=>	0,
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$whereData	=	array('deptID'	=>	$this->input->post('deptID'));
			
			$query		= updateTable('tbldept', $whereData, $values_mod , 1,'deptID', $this->input->post('deptID'));
			
			if($query)
			{
				$this->session->set_userdata('suc','Department Successfully  Updated...!');
				redirect('edit_department/'.$this->input->post('deptID'));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('edit_department/'.$this->input->post('deptID'));
			}
		}
		$data['pageTitle']	=	"Edit Department";
		$data['view']		=	$this->Commonsql_model->select('tbldept',array('deptID'=>$this->uri->segment(2)));
		$this->load->view('admin/dept/edit_department',$data);
	}
	function view_department()
	{
		$data['pageTitle']	=	"View Department";
		$data['view']		=	$this->Commonsql_model->select('tbldept',array('deptID'=>$this->uri->segment(2)));
		$this->load->view('admin/dept/view_department',$data);
	}
	function approve_department()
	{
		if($this->input->post('save'))
		{
			
			$check 	=	$this->Commonsql_model->select('tbldept',array('deptID'	=>	$this->input->post('deptID'),'department'		=>	$this->input->post('department'),
							'description'		=>	$this->input->post('description')));
			if($check->num_rows()==0)
			{
					$values_mod=array('department'		=>	$this->input->post('department'),
								'description'		=>	$this->input->post('description'),
								'dbentrystateID'	=>	0,
								'createby'			=>	$this->session->userdata('SESS_userId'),
								'active'			=>	1);
								
				$whereData	=	array('deptID'	=>	$this->input->post('deptID'));
				
				$query		= updateTable('tbldept', $whereData, $values_mod , 1,'deptID', $this->input->post('deptID'));
				
				if($query)
				{
					$this->session->set_userdata('suc','Department Successfully  Updated...!');
					redirect('approve_department/'.$this->input->post('deptID'));
					
				}
				else
				{
					$this->session->set_userdata('err','Error Please try again..!');
					redirect('approve_department/'.$this->input->post('deptID'));
				}
			}
			else
			{
				$this->session->set_userdata('err','No Changes Found..!');
				redirect('approve_department/'.$this->input->post('deptID'));
			}
		}
		if($this->uri->segment(4))
		{
			$whereData	=	array('dept_modID'	=>	$this->uri->segment(4));
			$updateData	=	array('active'	=>	$this->uri->segment(5));
			$upt	=	$this->Commonsql_model->updateTable('tbldept_mod', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','Department Status Successfully  Changed...!');
				redirect('approve_department/'.$this->uri->segment(3));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('approve_department/'.$this->uri->segment(3));
			}
		}
		else if($this->uri->segment(3))
		{
			$data['pageTitle']	=	"View Department";
			$data['table']		=	"Designation";
			$data['view']		=	$this->Commonsql_model->select('tbldept_mod',array('dept_modID'=>$this->uri->segment(3)));
			$this->load->view('admin/dept/approve_department',$data);
		}
		else
		{
			$data['pageTitle']	=	"View Department";
			$data['table']		=	"Designation";
			$data['view']		=	$this->Commonsql_model->select('tbldept',array('deptID'=>$this->uri->segment(2)));
			$this->load->view('admin/dept/approve_department',$data);
		}
	}
	function approve_department_json()
	{
		$result	=	$this->Commonsql_model->select_desc('tbldept_mod',array('deptID'=>$this->uri->segment(3)),'dept_modID');
		//echo $this->db->last_query();
		$output = array();$i=1;$j=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$i++;
			$vaules['name'] 			= 	$value->department;
			$vaules['description'] 		= 	$value->description;
			if($value->active==1)
			{
				if($j++==1)
				{
					$Approve			 			=	"<a href='".base_url()."manage/department_mod_approve/".$value->dept_modID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Approved</a>";
				}
				else
				{
					$Approve	=	'';
				}
				
				$active	=	"<a href='".base_url()."manage/approve_department/".$value->deptID.'/'.$value->dept_modID."/0'role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 active'>Active</a>";
			}
			else
			{
				$Approve		=	'';
				$active	=	"<a href='".base_url()."manage/approve_department/".$value->deptID.'/'.$value->dept_modID."/1' role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 deactive'>De-Active</a>";
			}
			
			$vaules['Action'] 			=	$Approve."<a href='".base_url()."approve_department/".$value->deptID.'/'.$value->dept_modID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Edit</a>".$active;
			
			$output[] =$vaules;
		}

		 echo json_encode(array('data'=>$output), true);
	}
	function department_mod_approve()
	{
		$mod_id	=	$this->uri->segment(3);
		$data	=	$this->Commonsql_model->select('tbldept_mod',array('dept_modID'=>$mod_id));
		if($data->num_rows()>0)
		{
			$val	=	$data->row();
			
				$values		=array('department'		=>	$val->department,
								'description'		=>	$val->description,
								'dbentrystateID'	=>	3,
								'approvedby'			=>	$this->session->userdata('SESS_userId'),
								'approvedon'			=>	date('Y-m-d h:i:s'));
							
				$cond		=	array('deptID'	=>	$val->deptID);
				
				$values_mod	=	array('dbentrystateID'	=>	3,
								'approvedby'			=>	$this->session->userdata('SESS_userId'),
								'approvedon'			=>	date('Y-m-d h:i:s'));
							
				$cond_mod	=	array('dept_modID'	=>	$mod_id);
				$upt		=	$this->Commonsql_model->updateTable('tbldept', $cond , $values);
				$upt_m		=	$this->Commonsql_model->updateTable('tbldept_mod', $cond_mod , $values_mod);
				//echo $this->db->last_query();exit;
				if($upt)
				{
					$this->session->set_userdata('suc','Approved Successfully  Finished...!');
					redirect('approve_department/'.$val->deptID);
					
				}
				else
				{
					$this->session->set_userdata('err','Error Please try again..!');
					redirect('approve_department/'.$val->deptID);
				}
							
							
						
		}
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
		$result	=	$this->Commonsql_model->select_all('tbldesignation','desigID');
		$output = array();$i=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$i++;
			$vaules['name'] 			= 	$value->name;
			$vaules['description'] 		= 	$value->description;
			if($value->active==1)
			{
				$view			 			=	"<a href='".base_url()."view_designation/".$value->desigID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>View</a>";
				$APPROVE			 			=	"<a href='".base_url()."approve_designation/".$value->desigID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>APPROVE</a>";
				$active	=	"<a href='".base_url()."manage/designation/".$value->desigID."/0'role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 active'>Active</a>";
			}
			else
			{
				$APPROVE		=	'';
				$view		=	'';
				$active	=	"<a href='".base_url()."manage/designation/".$value->desigID."/1' role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 deactive'>De-Active</a>";
			}
			
			$vaules['Action'] 			=	$view.$APPROVE."<a  href='".base_url()."edit_designation/".$value->desigID."' role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Edit</a>".$active;
			
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
							'createby'			=>	$this->session->userdata('SESS_userId'),
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
				$values=array('name'			=>	$this->input->post('name'),
							'description'		=>	$this->input->post('description'),
							'dbentrystateID'	=>	0,
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$whereData	=	array('desigID'	=>	$this->input->post('desigID'));
			$query		= updateTable('tbldesignation', $whereData, $values , 1,'desigID', $this->input->post('desigID'));
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
	function view_designation()
	{
		$data['pageTitle']	=	"View Designation";
		$data['view']		=	$this->Commonsql_model->select('tbldesignation',array('desigID'=>$this->uri->segment(2)));
		$this->load->view('admin/designation/view_designation',$data);
	}
	function approve_designation()
	{
		if($this->input->post('save'))
		{
			
			$check 	=	$this->Commonsql_model->select('tbldesignation',array('desigID'	=>	$this->input->post('desigID'),'name'		=>	$this->input->post('name'),
							'description'		=>	$this->input->post('description')));
			if($check->num_rows()==0)
			{
					$values_mod=array('name'		=>	$this->input->post('name'),
								'description'		=>	$this->input->post('description'),
								'dbentrystateID'	=>	0,
								'createby'			=>	$this->session->userdata('SESS_userId'),
								'active'			=>	1);
								
				$whereData	=	array('desigID'	=>	$this->input->post('desigID'));
				
				$query		= updateTable('tbldesignation', $whereData, $values_mod , 1,'desigID', $this->input->post('desigID'));
				
				if($query)
				{
					$this->session->set_userdata('suc','designation Successfully  Updated...!');
					redirect('approve_designation/'.$this->input->post('desigID'));
					
				}
				else
				{
					$this->session->set_userdata('err','Error Please try again..!');
					redirect('approve_designation/'.$this->input->post('desigID'));
				}
			}
			else
			{
				$this->session->set_userdata('err','No Changes Found..!');
				redirect('approve_designation/'.$this->input->post('desigID'));
			}
		}
		if($this->uri->segment(4))
		{
			$whereData	=	array('desig_modID'	=>	$this->uri->segment(4));
			$updateData	=	array('active'	=>	$this->uri->segment(5));
			$upt	=	$this->Commonsql_model->updateTable('tbldesignation_mod', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','Designation Status Successfully  Changed...!');
				redirect('approve_designation/'.$this->uri->segment(3));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('approve_designation/'.$this->uri->segment(3));
			}
		}
		else if($this->uri->segment(3))
		{
			$data['pageTitle']	=	"View designation";
			$data['table']		=	"Designation";
			$data['view']		=	$this->Commonsql_model->select('tbldesignation_mod',array('desig_modID'=>$this->uri->segment(3)));
			$this->load->view('admin/designation/approve_designation',$data);
		}
		else
		{
			$data['pageTitle']	=	"View designation";
			$data['table']		=	"Designation";
			$data['view']		=	$this->Commonsql_model->select('tbldesignation',array('desigID'=>$this->uri->segment(2)));
			$this->load->view('admin/designation/approve_designation',$data);
		}
	}
	function approve_designation_json()
	{
		$result	=	$this->Commonsql_model->select_desc('tbldesignation_mod',array('desigID'=>$this->uri->segment(3)),'desig_modID');
		//echo $this->db->last_query();
		$output = array();$i=1;$j=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$i++;
			$vaules['name'] 			= 	$value->name;
			$vaules['description'] 		= 	$value->description;
			if($value->active==1)
			{
				if($j++==1)
				{
					$Approve			 			=	"<a href='".base_url()."manage/designation_mod_approve/".$value->desig_modID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Approved</a>";
				}
				else
				{
					$Approve	=	'';
				}
				
				$active	=	"<a href='".base_url()."manage/approve_designation/".$value->desigID.'/'.$value->desig_modID."/0'role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 active'>Active</a>";
			}
			else
			{
				$Approve		=	'';
				$active	=	"<a href='".base_url()."manage/approve_designation/".$value->desigID.'/'.$value->desig_modID."/1' role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 deactive'>De-Active</a>";
			}
			
			$vaules['Action'] 			=	$Approve."<a href='".base_url()."approve_designation/".$value->desigID.'/'.$value->desig_modID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Edit</a>".$active;
			
			$output[] =$vaules;
		}

		 echo json_encode(array('data'=>$output), true);
	}
	function designation_mod_approve()
	{
		$mod_id	=	$this->uri->segment(3);
		$data	=	$this->Commonsql_model->select('tbldesignation_mod',array('desig_modID'=>$mod_id));
		if($data->num_rows()>0)
		{
			$val	=	$data->row();
			
				$values		=array('name'		=>	$val->name,
								'description'		=>	$val->description,
								'dbentrystateID'	=>	3,
								'approvedby'			=>	$this->session->userdata('SESS_userId'),
								'approvedon'			=>	date('Y-m-d h:i:s'));
							
				$cond		=	array('desigID'	=>	$val->desigID);
				
				$values_mod	=	array('dbentrystateID'	=>	3,
								'approvedby'			=>	$this->session->userdata('SESS_userId'),
								'approvedon'			=>	date('Y-m-d h:i:s'));
							
				$cond_mod	=	array('desig_modID'	=>	$mod_id);
				$upt		=	$this->Commonsql_model->updateTable('tbldesignation', $cond , $values);
				$upt_m		=	$this->Commonsql_model->updateTable('tbldesignation_mod', $cond_mod , $values_mod);
				//echo $this->db->last_query();exit;
				if($upt)
				{
					$this->session->set_userdata('suc','Approved Successfully  Finished...!');
					redirect('approve_designation/'.$val->desigID);
					
				}
				else
				{
					$this->session->set_userdata('err','Error Please try again..!');
					redirect('approve_designation/'.$val->desigID);
				}
							
							
						
		}
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
		$result	=	$this->Commonsql_model->select_all('tblrole','roleID');
		$output = array();$i=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$i++;
			$vaules['roleName'] 		= 	$value->roleName;
			$vaules['description'] 		= 	$value->description;
			if($value->active==1)
			{
				$view			 			=	"<a href='".base_url()."view_role/".$value->roleID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>View</a>";
				$APPROVE			 			=	"<a href='".base_url()."approve_role/".$value->roleID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>APPROVE</a>";
				$active	=	"<a href='".base_url()."manage/role/".$value->roleID."/0'role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 active'>Active</a>";
			}
			else
			{
				$view		=	'';
				$APPROVE		=	'';
				$active	=	"<a href='".base_url()."manage/role/".$value->roleID."/1' role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 deactive'>De-Active</a>";
			}
			
			$vaules['Action'] 			=	$view.$APPROVE."<a href='".base_url()."edit_role/".$value->roleID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Edit</a>".$active;
			
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
							'createby'			=>	$this->session->userdata('SESS_userId'),
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
				$values=array('roleName'			=>	$this->input->post('roleName'),
								'description'		=>	$this->input->post('description'),
								'dbentrystateID'	=>	0,
								'createby'			=>	$this->session->userdata('SESS_userId'),
								'active'			=>	1);
			
			$whereData	=	array('roleID'	=>	$this->input->post('roleID'));
			$query		= updateTable('tblrole', $whereData, $values , 1,'roleID', $this->input->post('roleID'));
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
	function view_role()
	{
		$data['pageTitle']	=	"View Role";
		$data['view']		=	$this->Commonsql_model->select('tblrole',array('roleID'=>$this->uri->segment(2)));
		$this->load->view('admin/role/view_role',$data);
	}
	function approve_role()
	{
		if($this->input->post('save'))
		{
			
			$check 	=	$this->Commonsql_model->select('tblrole',array('roleID'	=>	$this->input->post('roleID'),'roleName'		=>	$this->input->post('roleName'),
							'description'		=>	$this->input->post('description')));
			if($check->num_rows()==0)
			{
					$values_mod=array('roleName'		=>	$this->input->post('roleName'),
								'description'		=>	$this->input->post('description'),
								'dbentrystateID'	=>	0,
								'createby'			=>	$this->session->userdata('SESS_userId'),
								'active'			=>	1);
								
				$whereData	=	array('roleID'	=>	$this->input->post('roleID'));
				
				$query		= updateTable('tblrole', $whereData, $values_mod , 1,'roleID', $this->input->post('roleID'));
				
				if($query)
				{
					$this->session->set_userdata('suc','role Successfully  Updated...!');
					redirect('approve_role/'.$this->input->post('roleID'));
					
				}
				else
				{
					$this->session->set_userdata('err','Error Please try again..!');
					redirect('approve_role/'.$this->input->post('roleID'));
				}
			}
			else
			{
				$this->session->set_userdata('err','No Changes Found..!');
				redirect('approve_role/'.$this->input->post('roleID'));
			}
		}
		if($this->uri->segment(4))
		{
			$whereData	=	array('role_modID'	=>	$this->uri->segment(4));
			$updateData	=	array('active'	=>	$this->uri->segment(5));
			$upt	=	$this->Commonsql_model->updateTable('tblrole_mod', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','role Status Successfully  Changed...!');
				redirect('approve_role/'.$this->uri->segment(3));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('approve_role/'.$this->uri->segment(3));
			}
		}
		else if($this->uri->segment(3))
		{
			$data['pageTitle']	=	"View role";
			$data['table']		=	"role";
			$data['view']		=	$this->Commonsql_model->select('tblrole_mod',array('role_modID'=>$this->uri->segment(3)));
			$this->load->view('admin/role/approve_role',$data);
		}
		else
		{
			$data['pageTitle']	=	"View role";
			$data['table']		=	"role";
			$data['view']		=	$this->Commonsql_model->select('tblrole',array('roleID'=>$this->uri->segment(2)));
			$this->load->view('admin/role/approve_role',$data);
		}
	}
	function approve_role_json()
	{
		$result	=	$this->Commonsql_model->select_desc('tblrole_mod',array('roleID'=>$this->uri->segment(3)),'role_modID');
		//echo $this->db->last_query();
		$output = array();$i=1;$j=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$i++;
			$vaules['name'] 			= 	$value->roleName;
			$vaules['description'] 		= 	$value->description;
			if($value->active==1)
			{
				if($j++==1)
				{
					$Approve			 			=	"<a href='".base_url()."manage/role_mod_approve/".$value->role_modID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Approved</a>";
				}
				else
				{
					$Approve	=	'';
				}
				
				$active	=	"<a href='".base_url()."manage/approve_role/".$value->roleID.'/'.$value->role_modID."/0'role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 active'>Active</a>";
			}
			else
			{
				$Approve		=	'';
				$active	=	"<a href='".base_url()."manage/approve_role/".$value->roleID.'/'.$value->role_modID."/1' role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 deactive'>De-Active</a>";
			}
			
			$vaules['Action'] 			=	$Approve."<a href='".base_url()."approve_role/".$value->roleID.'/'.$value->role_modID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Edit</a>".$active;
			
			$output[] =$vaules;
		}

		 echo json_encode(array('data'=>$output), true);
	}
	function role_mod_approve()
	{
		$mod_id	=	$this->uri->segment(3);
		$data	=	$this->Commonsql_model->select('tblrole_mod',array('role_modID'=>$mod_id));
		if($data->num_rows()>0)
		{
			$val	=	$data->row();
			
				$values		=array('roleName'		=>	$val->roleName,
								'description'		=>	$val->description,
								'dbentrystateID'	=>	3,
								'approvedby'			=>	$this->session->userdata('SESS_userId'),
								'approvedon'			=>	date('Y-m-d h:i:s'));
							
				$cond		=	array('roleID'	=>	$val->roleID);
				
				$values_mod	=	array('dbentrystateID'	=>	3,
								'approvedby'			=>	$this->session->userdata('SESS_userId'),
								'approvedon'			=>	date('Y-m-d h:i:s'));
							
				$cond_mod	=	array('role_modID'	=>	$mod_id);
				$upt		=	$this->Commonsql_model->updateTable('tblrole', $cond , $values);
				$upt_m		=	$this->Commonsql_model->updateTable('tblrole_mod', $cond_mod , $values_mod);
				//echo $this->db->last_query();exit;
				if($upt)
				{
					$this->session->set_userdata('suc','Approved Successfully  Finished...!');
					redirect('approve_role/'.$val->roleID);
					
				}
				else
				{
					$this->session->set_userdata('err','Error Please try again..!');
					redirect('approve_role/'.$val->roleID);
				}
							
							
						
		}
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
		$result	=	$this->Commonsql_model->select_all('tblpaymentmode','paymentModeID');
		$output = array();$i=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$i++;
			$vaules['paymentMode'] 		= 	$value->paymentMode;
			$vaules['description'] 		= 	$value->description;
			if($value->active==1)
			{
				$view			 			=	"<a href='".base_url()."view_payment_mode/".$value->paymentModeID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>View</a>";
				$APPROVE			 			=	"<a href='".base_url()."approve_payment_mode/".$value->paymentModeID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>APPROVE</a>";
				$active	=	"<a href='".base_url()."manage/payment_mode/".$value->paymentModeID."/0'role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 active'>Active</a>";
			}
			else
			{
				$view		=	'';
				$APPROVE		=	'';
				$active	=	"<a href='".base_url()."manage/payment_mode/".$value->paymentModeID."/1' role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 deactive'>De-Active</a>";
			}
			
			$vaules['Action'] 			=	$view.$APPROVE."<a href='".base_url()."edit_payment_mode/".$value->paymentModeID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Edit</a>".$active;
			
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
							'createby'			=>	$this->session->userdata('SESS_userId'),
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
				$values=array('paymentMode'				=>	$this->input->post('paymentMode'),
								'description'		=>	$this->input->post('description'),
								'paymentModeID'	=>	$this->input->post('paymentModeID'),
								'dbentrystateID'	=>	0,
								'createby'			=>	$this->session->userdata('SESS_userId'),
								'active'			=>	1);
								
			$whereData	=	array('paymentModeID'	=>	$this->input->post('paymentModeID'));
			$query		= updateTable('tblpaymentmode', $whereData, $values , 1,'paymentModeID', $this->input->post('paymentModeID'));
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
	function view_payment_mode()
	{
		$data['pageTitle']	=	"View Payment Mode";
		$data['view']		=	$this->Commonsql_model->select('tblpaymentmode',array('paymentModeID'=>$this->uri->segment(2)));
		$this->load->view('admin/payment_mode/view_payment_mode',$data);
	}
	function approve_payment_mode()
	{
		if($this->input->post('save'))
		{
			
			$check 	=	$this->Commonsql_model->select('tblpaymentmode',array('paymentModeID'	=>	$this->input->post('paymentModeID'),'paymentMode'		=>	$this->input->post('paymentMode'),
							'description'		=>	$this->input->post('description')));
			if($check->num_rows()==0)
			{
					$values_mod=array('paymentMode'		=>	$this->input->post('paymentMode'),
								'description'		=>	$this->input->post('description'),
								'dbentrystateID'	=>	0,
								'createby'			=>	$this->session->userdata('SESS_userId'),
								'active'			=>	1);
								
				$whereData	=	array('paymentModeID'	=>	$this->input->post('paymentModeID'));
				
				$query		= updateTable('tblpaymentmode', $whereData, $values_mod , 1,'paymentModeID', $this->input->post('paymentModeID'));
				
				if($query)
				{
					$this->session->set_userdata('suc','payment_mode Successfully  Updated...!');
					redirect('approve_payment_mode/'.$this->input->post('paymentModeID'));
					
				}
				else
				{
					$this->session->set_userdata('err','Error Please try again..!');
					redirect('approve_payment_mode/'.$this->input->post('paymentModeID'));
				}
			}
			else
			{
				$this->session->set_userdata('err','No Changes Found..!');
				redirect('approve_payment_mode/'.$this->input->post('paymentModeID'));
			}
		}
		if($this->uri->segment(4))
		{
			$whereData	=	array('paymentMode_modID'	=>	$this->uri->segment(4));
			$updateData	=	array('active'	=>	$this->uri->segment(5));
			$upt	=	$this->Commonsql_model->updateTable('tblpaymentmode_mod', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','payment mode Status Successfully  Changed...!');
				redirect('approve_payment_mode/'.$this->uri->segment(3));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('approve_payment_mode/'.$this->uri->segment(3));
			}
		}
		else if($this->uri->segment(3))
		{
			$data['pageTitle']	=	"View Payment Mode";
			$data['table']		=	"payment_mode";
			$data['view']		=	$this->Commonsql_model->select('tblpaymentmode_mod',array('paymentMode_modID'=>$this->uri->segment(3)));
			$this->load->view('admin/payment_mode/approve_payment_mode',$data);
		}
		else
		{
			$data['pageTitle']	=	"View payment_mode";
			$data['table']		=	"payment_mode";
			$data['view']		=	$this->Commonsql_model->select('tblpaymentmode',array('paymentModeID'=>$this->uri->segment(2)));
			$this->load->view('admin/payment_mode/approve_payment_mode',$data);
		}
	}
	function approve_payment_mode_json()
	{
		$result	=	$this->Commonsql_model->select_desc('tblpaymentmode_mod',array('paymentModeID'=>$this->uri->segment(3)),'paymentMode_modID');
		//echo $this->db->last_query();
		$output = array();$i=1;$j=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$i++;
			$vaules['name'] 			= 	$value->paymentMode;
			$vaules['description'] 		= 	$value->description;
			if($value->active==1)
			{
				if($j++==1)
				{
					$Approve			 			=	"<a href='".base_url()."manage/payment_mode_mod_approve/".$value->paymentMode_modID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Approved</a>";
				}
				else
				{
					$Approve	=	'';
				}
				$active	=	"<a href='".base_url()."manage/approve_payment_mode/".$value->paymentModeID.'/'.$value->paymentMode_modID."/0'role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 active'>Active</a>";
			}
			else
			{
				$Approve		=	'';
				$active	=	"<a href='".base_url()."manage/approve_payment_mode/".$value->paymentModeID.'/'.$value->paymentMode_modID."/1' role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 deactive'>De-Active</a>";
			}
			
			$vaules['Action'] 			=	$Approve."<a href='".base_url()."approve_payment_mode/".$value->paymentModeID.'/'.$value->paymentMode_modID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Edit</a>".$active;
			
			$output[] =$vaules;
		}

		 echo json_encode(array('data'=>$output), true);
	}
	function payment_mode_mod_approve()
	{
		$mod_id	=	$this->uri->segment(3);
		$data	=	$this->Commonsql_model->select('tblpaymentmode_mod',array('paymentMode_modID'=>$mod_id));
		if($data->num_rows()>0)
		{
			$val	=	$data->row();
			
				$values		=array('paymentMode'		=>	$val->paymentMode,
								'description'			=>	$val->description,
								'dbentrystateID'		=>	3,
								'approvedby'			=>	$this->session->userdata('SESS_userId'),
								'approvedon'			=>	date('Y-m-d h:i:s'));
							
				$cond		=	array('paymentModeID'	=>	$val->paymentModeID);
				
				$values_mod	=	array('dbentrystateID'	=>	3,
								'approvedby'			=>	$this->session->userdata('SESS_userId'),
								'approvedon'			=>	date('Y-m-d h:i:s'));
							
				$cond_mod	=	array('paymentMode_modID'	=>	$mod_id);
				$upt		=	$this->Commonsql_model->updateTable('tblpaymentmode', $cond , $values);
				$upt_m		=	$this->Commonsql_model->updateTable('tblpaymentmode_mod', $cond_mod , $values_mod);
				//echo $this->db->last_query();exit;
				if($upt)
				{
					$this->session->set_userdata('suc','Approved Successfully  Finished...!');
					redirect('approve_payment_mode/'.$val->paymentModeID);
					
				}
				else
				{
					$this->session->set_userdata('err','Error Please try again..!');
					redirect('approve_payment_mode/'.$val->paymentModeID);
				}
							
							
						
		}
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
		$result	=	$this->Commonsql_model->select_all('tblpaymentstatus','payStatusID');
		$output = array();$i=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$i++;
			$vaules['name'] 			= 	$value->payStatus;
			$vaules['description'] 		= 	$value->description;
			if($value->active==1)
			{
				$view			 			=	"<a href='".base_url()."view_payment_status/".$value->payStatusID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>View</a>";
				$APPROVE			 			=	"<a href='".base_url()."approve_payment_status/".$value->payStatusID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>APPROVE</a>";
				$active	=	"<a href='".base_url()."manage/payment_status/".$value->payStatusID."/0'role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 active'>Active</a>";
			}
			else
			{
				$view		=	'';
				$APPROVE		=	'';
				$active	=	"<a href='".base_url()."manage/payment_status/".$value->payStatusID."/1' role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 deactive'>De-Active</a>";
			}
			
			$vaules['Action'] 			=	$view.$APPROVE."<a href='".base_url()."edit_payment_status/".$value->payStatusID."' role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Edit</a>".$active;
			
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
							'createby'			=>	$this->session->userdata('SESS_userId'),
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
				$values=array('payStatus'				=>	$this->input->post('payStatus'),
								'description'		=>	$this->input->post('description'),
								'dbentrystateID'	=>	0,
								'createby'			=>	$this->session->userdata('SESS_userId'),
								'active'			=>	1);
								
			$whereData	=	array('payStatusID'	=>	$this->input->post('payStatusID'));
			$query		= updateTable('tblpaymentstatus', $whereData, $values , 1,'payStatusID', $this->input->post('payStatusID'));
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
	function view_payment_status()
	{
		$data['pageTitle']	=	"View Payment Status";
		$data['view']		=	$this->Commonsql_model->select('tblpaymentstatus',array('payStatusID'=>$this->uri->segment(2)));
		$this->load->view('admin/payment_mode/view_payment_status',$data);;
	}
	function approve_payment_status()
	{
		if($this->input->post('save'))
		{
			
			$check 	=	$this->Commonsql_model->select('tblpaymentstatus',array('payStatusID'	=>	$this->input->post('payStatusID'),'payStatus'		=>	$this->input->post('payStatus'),
							'description'		=>	$this->input->post('description')));
			if($check->num_rows()==0)
			{
					$values_mod=array('payStatus'		=>	$this->input->post('payStatus'),
								'description'		=>	$this->input->post('description'),
								'dbentrystateID'	=>	0,
								'createby'			=>	$this->session->userdata('SESS_userId'),
								'active'			=>	1);
								
				$whereData	=	array('payStatusID'	=>	$this->input->post('payStatusID'));
				
				$query		= updateTable('tblpaymentstatus', $whereData, $values_mod , 1,'payStatusID', $this->input->post('payStatusID'));
				
				if($query)
				{
					$this->session->set_userdata('suc','role Successfully  Updated...!');
					redirect('approve_payment_status/'.$this->input->post('payStatusID'));
					
				}
				else
				{
					$this->session->set_userdata('err','Error Please try again..!');
					redirect('approve_payment_status/'.$this->input->post('payStatusID'));
				}
			}
			else
			{
				$this->session->set_userdata('err','No Changes Found..!');
				redirect('approve_payment_status/'.$this->input->post('payStatusID'));
			}
		}
		if($this->uri->segment(4))
		{
			$whereData	=	array('payStatus_modID'	=>	$this->uri->segment(4));
			$updateData	=	array('active'	=>	$this->uri->segment(5));
			$upt	=	$this->Commonsql_model->updateTable('tblpaymentstatus_mod', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','role Status Successfully  Changed...!');
				redirect('approve_payment_status/'.$this->uri->segment(3));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('approve_payment_status/'.$this->uri->segment(3));
			}
		}
		else if($this->uri->segment(3))
		{
			$data['pageTitle']	=	"View role";
			$data['table']		=	"role";
			$data['view']		=	$this->Commonsql_model->select('tblpaymentstatus_mod',array('payStatus_modID'=>$this->uri->segment(3)));
			$this->load->view('admin/payment_mode/approve_payment_status',$data);
		}
		else
		{
			$data['pageTitle']	=	"View role";
			$data['table']		=	"role";
			$data['view']		=	$this->Commonsql_model->select('tblpaymentstatus',array('payStatusID'=>$this->uri->segment(2)));
			$this->load->view('admin/payment_mode/approve_payment_status',$data);
		}
	}
	function approve_payment_status_json()
	{
		$result	=	$this->Commonsql_model->select_desc('tblpaymentstatus_mod',array('payStatusID'=>$this->uri->segment(3)),'payStatus_modID');
		//echo $this->db->last_query();
		$output = array();$i=1;$j=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$i++;
			$vaules['name'] 			= 	$value->payStatus;
			$vaules['description'] 		= 	$value->description;
			if($value->active==1)
			{
				if($j++==1)
				{
					$Approve			 			=	"<a href='".base_url()."manage/payment_statu_mod_approve/".$value->payStatus_modID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Approved</a>";
				}
				else
				{
					$Approve	=	'';
				}
				$active	=	"<a href='".base_url()."manage/approve_payment_status/".$value->payStatusID.'/'.$value->payStatus_modID."/0'role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 active'>Active</a>";
			}
			else
			{
				$Approve		=	'';
				$active	=	"<a href='".base_url()."manage/approve_payment_status/".$value->payStatusID.'/'.$value->payStatus_modID."/1' role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 deactive'>De-Active</a>";
			}
			
			$vaules['Action'] 			=	$Approve."<a href='".base_url()."approve_payment_status/".$value->payStatusID.'/'.$value->payStatus_modID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Edit</a>".$active;
			
			$output[] =$vaules;
		}

		 echo json_encode(array('data'=>$output), true);
	}
	function payment_statu_mod_approve()
	{
		$mod_id	=	$this->uri->segment(3);
		$data	=	$this->Commonsql_model->select('tblpaymentstatus_mod',array('payStatus_modID'=>$mod_id));
		if($data->num_rows()>0)
		{
			$val	=	$data->row();
			
				$values		=array('payStatus'		=>	$val->payStatus,
								'description'		=>	$val->description,
								'dbentrystateID'	=>	3,
								'approvedby'			=>	$this->session->userdata('SESS_userId'),
								'approvedon'			=>	date('Y-m-d h:i:s'));
							
				$cond		=	array('payStatusID'	=>	$val->payStatusID);
				
				$values_mod	=	array('dbentrystateID'	=>	3,
								'approvedby'			=>	$this->session->userdata('SESS_userId'),
								'approvedon'			=>	date('Y-m-d h:i:s'));
							
				$cond_mod	=	array('payStatus_modID'	=>	$mod_id);
				$upt		=	$this->Commonsql_model->updateTable('tblpaymentstatus', $cond , $values);
				$upt_m		=	$this->Commonsql_model->updateTable('tblpaymentstatus_mod', $cond_mod , $values_mod);
				//echo $this->db->last_query();exit;
				if($upt)
				{
					$this->session->set_userdata('suc','Approved Successfully  Finished...!');
					redirect('approve_payment_status/'.$val->payStatusID);
					
				}
				else
				{
					$this->session->set_userdata('err','Error Please try again..!');
					redirect('approve_payment_status/'.$val->payStatusID);
				}
							
							
						
		}
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
		$result	=	$this->Commonsql_model->select_all('tblemployetypes','employetypeID');
		$output = array();$i=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$i++;
			$vaules['name'] 			= 	$value->typename;
			$vaules['description'] 		= 	$value->description;
			if($value->active==1)
			{
				$view		=	"<a href='".base_url()."view_employee_types/".$value->employetypeID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>View</a>";
				$Approve		=	"<a href='".base_url()."approve_employee_types/".$value->employetypeID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Approve</a>";
				$active	=	"<a href='".base_url()."manage/employee_types/".$value->employetypeID."/0'role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 active'>Active</a>";
			}
			else
			{
				$view		=	'';
				$Approve		=	'';
				$active	=	"<a href='".base_url()."manage/employee_types/".$value->employetypeID."/1' role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 deactive'>De-Active</a>";
			}
			
			$vaules['Action'] 			=	$view.$Approve."<a  href='".base_url()."edit_employee_types/".$value->employetypeID."' role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Edit</a>".$active;
			
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
							'createby'			=>	$this->session->userdata('SESS_userId'),
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
				$values=array('typename'				=>	$this->input->post('typename'),
								'description'		=>	$this->input->post('description'),
								'employetypeID'		=>	$this->input->post('employetypeID'),
								'dbentrystateID'	=>	0,
								'createby'			=>	$this->session->userdata('SESS_userId'),
								'active'			=>	1);
								
			$whereData	=	array('employetypeID'	=>	$this->input->post('employetypeID'));
			$query		= updateTable('tblemployetypes', $whereData, $values , 1,'employetypeID', $this->input->post('employetypeID'));
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
	function view_employee_types()
	{
		$data['pageTitle']	=	"View Emplyee Types";
		$data['view']		=	$this->Commonsql_model->select('tblemployetypes',array('employetypeID'=>$this->uri->segment(2)));
		$this->load->view('admin/employee_types/view_employee_types',$data);
	}
	function approve_employee_types()
	{
		if($this->input->post('save'))
		{
			
			$check 	=	$this->Commonsql_model->select('tblemployetypes',array('employetypeID'	=>	$this->input->post('employetypeID'),'typename'		=>	$this->input->post('typename'),
							'description'		=>	$this->input->post('description')));
			if($check->num_rows()==0)
			{
					$values_mod=array('typename'		=>	$this->input->post('typename'),
								'description'		=>	$this->input->post('description'),
								'dbentrystateID'	=>	0,
								'createby'			=>	$this->session->userdata('SESS_userId'),
								'active'			=>	1);
								
				$whereData	=	array('employetypeID'	=>	$this->input->post('employetypeID'));
				
				$query		= updateTable('tblemployetypes', $whereData, $values_mod , 1,'employetypeID', $this->input->post('employetypeID'));
				
				if($query)
				{
					$this->session->set_userdata('suc','employee_types Successfully  Updated...!');
					redirect('approve_employee_types/'.$this->input->post('employetypeID'));
					
				}
				else
				{
					$this->session->set_userdata('err','Error Please try again..!');
					redirect('approve_employee_types/'.$this->input->post('employetypeID'));
				}
			}
			else
			{
				$this->session->set_userdata('err','No Changes Found..!');
				redirect('approve_employee_types/'.$this->input->post('employetypeID'));
			}
		}
		if($this->uri->segment(4))
		{
			$whereData	=	array('employetype_modID'	=>	$this->uri->segment(4));
			$updateData	=	array('active'	=>	$this->uri->segment(5));
			$upt	=	$this->Commonsql_model->updateTable('tblemployetypes_mod', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','employee_types Status Successfully  Changed...!');
				redirect('approve_employee_types/'.$this->uri->segment(3));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('approve_employee_types/'.$this->uri->segment(3));
			}
		}
		else if($this->uri->segment(3))
		{
			$data['pageTitle']	=	"View employee_types";
			$data['table']		=	"Designation";
			$data['view']		=	$this->Commonsql_model->select('tblemployetypes_mod',array('employetype_modID'=>$this->uri->segment(3)));
			$this->load->view('admin/employee_types/approve_employee_types',$data);
		}
		else
		{
			$data['pageTitle']	=	"View employee_types";
			$data['table']		=	"Designation";
			$data['view']		=	$this->Commonsql_model->select('tblemployetypes',array('employetypeID'=>$this->uri->segment(2)));
			$this->load->view('admin/employee_types/approve_employee_types',$data);
		}
	}
	function approve_employee_types_json()
	{
		$result	=	$this->Commonsql_model->select_desc('tblemployetypes_mod',array('employetypeID'=>$this->uri->segment(3)),'employetype_modID');
		//echo $this->db->last_query();
		$output = array();
		$i=1;$j=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$i++;
			$vaules['name'] 			= 	$value->typename;
			$vaules['description'] 		= 	$value->description;
			
			if($value->active==1)
			{
				if($j++==1)
				{
					$Approve	=	"<a href='".base_url()."manage/employee_types_mod_approve/".$value->employetype_modID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Approved</a>";
				}
				else
				{
					$Approve	=	'';
				}
				$active	=	"<a href='".base_url()."manage/approve_employee_types/".$value->employetypeID.'/'.$value->employetype_modID."/0'role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 active'>Active</a>";
			}
			else
			{
				$Approve	=	'';
				$active	=	"<a href='".base_url()."manage/approve_employee_types/".$value->employetypeID.'/'.$value->employetype_modID."/1' role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 deactive'>De-Active</a>";
			}
			
			$vaules['Action'] 			=	$Approve."<a href='".base_url()."approve_employee_types/".$value->employetypeID.'/'.$value->employetype_modID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Edit</a>".$active;
			
			$output[] =$vaules;
		}

		 echo json_encode(array('data'=>$output), true);
	}
	function employee_types_mod_approve()
	{
		$mod_id	=	$this->uri->segment(3);
		$data	=	$this->Commonsql_model->select('tblemployetypes_mod',array('employetype_modID'=>$mod_id));
		if($data->num_rows()>0)
		{
			$val	=	$data->row();
			
				$values		=array('typename'		=>	$val->typename,
								'description'		=>	$val->description,
								'dbentrystateID'	=>	3,
								'approvedby'			=>	$this->session->userdata('SESS_userId'),
								'approvedon'			=>	date('Y-m-d h:i:s'));
							
				$cond		=	array('employetypeID'	=>	$val->employetypeID);
				
				$values_mod	=	array('dbentrystateID'	=>	3,
								'approvedby'			=>	$this->session->userdata('SESS_userId'),
								'approvedon'			=>	date('Y-m-d h:i:s'));
							
				$cond_mod	=	array('employetype_modID'	=>	$mod_id);
				$upt		=	$this->Commonsql_model->updateTable('tblemployetypes', $cond , $values);
				$upt_m		=	$this->Commonsql_model->updateTable('tblemployetypes_mod', $cond_mod , $values_mod);
				//echo $this->db->last_query();exit;
				if($upt)
				{
					$this->session->set_userdata('suc','Approved Successfully  Finished...!');
					redirect('approve_employee_types/'.$val->employetypeID);
					
				}
				else
				{
					$this->session->set_userdata('err','Error Please try again..!');
					redirect('approve_employee_types/'.$val->employetypeID);
				}
						
		}
	}
   
   
}
