<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Manage extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        
    }
    
   /***********************************************************************************************************************************/
	function lock_screeen()
	{
		$this->load->view('admin/lock_screen');
	}
	function profile()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if($this->input->post('save'))
		{
			$password = TRIM($this->input->post('password', true));
			$whereData = array('password' => do_hash(do_hash(do_hash($password))),'empID'=>$this->session->userdata('SESS_userId'));
			$check	=	$this->Commonsql_model->select('tbllogin',$whereData);
			if($check->num_rows()>0)
			{
				if($this->input->post('new_pass')==$this->input->post('pass1'))
				{
					$query	=	$this->Commonsql_model->updateTable('tbllogin', array('empID'=>$this->session->userdata('SESS_userId')), array('password'=>do_hash(do_hash(do_hash($this->input->post('new_pass'))))));
					if($query)
					{
						$this->session->set_userdata('suc','Password Changed Successfully ...!');
						redirect('profile');
						
					}
					else
					{
						$this->session->set_userdata('err','Error Please try again..!');
						redirect('profile');
					}
				}
				else
				{
					$this->session->set_userdata('err','Mismatch Confirm Pasword..!');
					redirect('profile');
				}
			}
			else
			{
				$this->session->set_userdata('err','Wrongly Entered Current Password..! Please try again');
				redirect('profile');
			}
		}
		$data['pageTitle']	=	"Update profile";
		$this->load->view('admin/profile',$data);
	}
	function department()
	{
		if (!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
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
		if (!$this->session->userdata('SESS_userId') || !checkpageaccess('department', 1, 'view')) {return FALSE; }
		$pagealterpermission = pagealterpermission('department', $alterPermission = '');
		$result	=	$this->Commonsql_model->select_all_state('tbldept','deptID');
		$output = array();$i=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['deptID']			=	$value->deptID;
			$vaules['department'] 		= 	$value->department;
			$vaules['description'] 		= 	$value->description;
			if ($value->dbentrystateID == 0) 
			{
				$vaules['state'] 			= 	'<span class="label bg-danger">'.$value->name.'</span>';
			}
			elseif ($value->dbentrystateID == 1) 
			{
				$vaules['state'] 			= 	'<span class="label bg-warning">'.$value->name.'</span>';
			}
			elseif ($value->dbentrystateID == 2) 
			{
				$vaules['state'] 			= 	'<span class="label bg-info">'.$value->name.'</span>';
			}
			else
			{
				$vaules['state'] 			= 	'<span class="label bg-greensea">'.$value->name.'</span>';
			}
			if ($value->active == 1) 
			{
			   $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active'] = $row;
			
			if($value->active==1)
			{
				if(checkpageaccess('department',1,'view'))
				{
					$view			 			=	 view_html("view_department/".$value->deptID);
				}
				else
				{
					$view			 			=	'';
				}
				if(selfAllowed($pagealterpermission, 'selfApprovalAllowed', $value->createby) && checkpageaccess('department',1,'approve'))
				{
					$APPROVE			 			=	history_html("approve_department/".$value->deptID);
				}
				else
				{
					$APPROVE			 			= "";
					
				}
				if(checkpageaccess('department',1,'delete'))
				{
					$active	=	status_main_table($value->deptID,'deptID','dept','department',1);
				}
				else
				{
					$active	=	'';
				}
			}
			else
			{
				$APPROVE		=	'';
				$view			 =	'';
				if(checkpageaccess('department',1,'delete'))
				{
					$active	=	status_main_table($value->deptID,'deptID','dept','department',0);
				}
				else
				{
					$active	=	'';
				}
			}
			if(selfAllowed($pagealterpermission, 'selfEditAllowed', $value->createby) && checkpageaccess('department',1,'modify'))
			{
				$edit	=	edit_html("edit_department/".$value->deptID);
			}
			else
			{
				$edit	=	"";
			}
			$vaules['Action'] 			=	$view.$edit.$APPROVE.$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	function add_department()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('department',1,'create')){	redirect();		}
		if($_POST)
		{
			$this->form_validation->set_rules('department', 'Department Name', 'trim|required');
			if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_userdata('err', validation_errors());
                redirect('add_department');
            }
			$values=array('department'			=>	$this->input->post('department'),
							'description'		=>	$this->input->post('description'),
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$query	=	insertTable('tbldept', $values,1,'deptID','department');
			if($query)
			{
				$this->session->set_userdata('suc','Department Successfully  Added...!');
				redirect('add_department');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('add_department');
			}
		}
		$data['pageTitle']	=	"Add Department";
		$this->load->view('admin/dept/add_department',$data);
	}
	function department_vaildation()
	{
		$query=$this->Commonsql_model->select('tbldept',array('department'=>trim($_POST['department'])));
		if($query->num_rows()>0)
		{
			echo "false";
		}
		else
		{
			echo "true";
		}
	}
	function edit_department_vaildation()
	{
		$query=$this->Commonsql_model->select('tbldept',array('department'=>trim($_POST['department']),'deptID !='=>$_POST['deptID']));
		if($query->num_rows()>0)
		{
			echo "false";
		}
		else
		{
			echo "true";
		}
	}
	function edit_department()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('department',1,'modify'))
		{
			redirect();
		}
		if($_POST)
		{
			
				$this->form_validation->set_rules('department', 'Department Name', 'trim|required');
				if ($this->form_validation->run($this) == FALSE) {
					$this->session->set_userdata('err', validation_errors());
					redirect('edit_department/'.$this->input->post('deptID'));
				}
				$values_mod=array('department'		=>	$this->input->post('department'),
							'description'		=>	$this->input->post('description'),
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$whereData	=	array('deptID'	=>	$this->input->post('deptID'));
			
			$query		= updateTable('tbldept', $whereData, $values_mod , 1,'deptID', $this->input->post('deptID'),'department');
			
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
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('department',1,'view'))
		{
			redirect();
		}
		$data['pageTitle']	=	"View Department";
		$data['view']		=	$this->Commonsql_model->select('tbldept',array('deptID'=>$this->uri->segment(2)));
		$this->load->view('admin/dept/view_department',$data);
	}
	function approve_department()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('department',1,'approve'))
		{
			redirect();
		}
		if($_POST)
		{
			
			$check 	=	$this->Commonsql_model->select('tbldept',array('deptID'	=>	$this->input->post('deptID'),'department'		=>	$this->input->post('department'),
							'description'		=>	$this->input->post('description')));
			if($check->num_rows()==0)
			{
					$values_mod=array('department'		=>	$this->input->post('department'),
								'description'		=>	$this->input->post('description'),
								
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
		if (!$this->session->userdata('SESS_userId')) {return FALSE; }
		$result	=	$this->Commonsql_model->select_desc_state('tbldept_mod',array('a.deptID'=>$this->uri->segment(3)),'dept_modID');
		//echo $this->db->last_query();
		$output = array();$i=1;$j=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$value->dept_modID;
			$vaules['name'] 			= 	$value->department;
			$vaules['description'] 		= 	$value->description;
			
			if ($value->dbentrystateID == 0) 
			{
				$vaules['state'] 			= 	'<span class="label bg-danger">'.$value->name.'</span>';
			}
			elseif ($value->dbentrystateID == 1) 
			{
				$vaules['state'] 			= 	'<span class="label bg-warning">'.$value->name.'</span>';
			}
			elseif ($value->dbentrystateID == 2) 
			{
				$vaules['state'] 			= 	'<span class="label bg-info">'.$value->name.'</span>';
			}
			else
			{
				$vaules['state'] 			= 	'<span class="label bg-greensea">'.$value->name.'</span>';
			}
			if ($value->active == 1) 
			{
              
			  $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active']	= $row;
			$vaules['upt_date'] =	date('d-m-Y',strtotime($value->createdate));
			$vaules['upt_by'] 	=	$value->empname;
			if($value->active==1)
			{
				if($j++==0)
				{
					if(checkpageaccess('department',1,'approve'))
					{
						$Approve	=	approve_html("'".base_url()."manage/department_mod_approve/".$value->dept_modID."','2'");
					}
					else
					{
						$Approve	=	'';
					}
				}
				else
				{
					if(checkpageaccess('department',1,'approve'))
					{
						$Approve	=	approve_html("'".base_url()."manage/department_mod_approve/".$value->dept_modID."','2'");
					}
					else
					{
						$Approve	=	'';
					}
				}
				if(checkpageaccess('department',1,'delete'))
				{
					$active	=	disable_approve_deactive_html("'".base_url()."manage/approve_department/".$value->deptID."/".$value->dept_modID."','0'");
				}
				else
				{
					$active	=	"";
				}
			}
			else
			{
				$Approve		=	'';
				if(checkpageaccess('department',1,'delete'))
				{
					$active	=	enable_approve_deactive_html("'".base_url()."manage/approve_department/".$value->deptID."/".$value->dept_modID."','1'");
				}
				else
				{
					$active	=	"";
				}
			}
			if(checkpageaccess('department',1,'modify'))
			{
				$edit	=	edit_html("approve_department/".$value->deptID.'/'.$value->dept_modID);
			}
			else
			{
				$edit	=	"";
			}
			$vaules['Action'] 			=	$Approve.$edit.$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	function department_mod_approve()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
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
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
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
		if (!$this->session->userdata('SESS_userId')) {return FALSE; }
		$result	=	$this->Commonsql_model->select_all_state_confilct('tbldesignation','desigID');
		$output = array();$i=1;
		$pagealterpermission = pagealterpermission('designation', $alterPermission = '');
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$value->desigID;
			$vaules['name'] 			= 	$value->name;
			$vaules['description'] 		= 	$value->description;
			if ($value->dbentrystateID == 0) 
			{
				$vaules['state'] 			= 	'<span class="label bg-danger">'.$value->state_names.'</span>';
			}
			elseif ($value->dbentrystateID == 1) 
			{
				$vaules['state'] 			= 	'<span class="label bg-warning">'.$value->state_names.'</span>';
			}
			elseif ($value->dbentrystateID == 2) 
			{
				$vaules['state'] 			= 	'<span class="label bg-info">'.$value->state_names.'</span>';
			}
			else
			{
				$vaules['state'] 			= 	'<span class="label bg-greensea">'.$value->state_names.'</span>';
			}
			if ($value->active == 1) 
			{
              
			  $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active'] = $row;
			
			if($value->active==1)
			{
				
				if(checkpageaccess('designation',1,'view'))
				{
					$view			 			=	view_html("view_designation/".$value->desigID);
				}
				else
				{
					$view			 			=	'';
				}
				if(selfAllowed($pagealterpermission, 'selfApprovalAllowed', $value->createby) && checkpageaccess('designation',1,'approve'))
				{
					$APPROVE			 		=	history_html("approve_designation/".$value->desigID);
				}
				else
				{
					$APPROVE			 		= "";
					
				}
				if(checkpageaccess('designation',1,'delete'))
				{
					$active	=	status_main_table($value->desigID,'desigID','designation','designation',1);
				}
				else
				{
					$active	=	'';
				}
			}
			
			else
			{
				$APPROVE		=	'';
				$view		=	'';
				if(checkpageaccess('designation',1,'delete'))
				{
					$active	=	status_main_table($value->desigID,'desigID','designation','designation',0);
				}
				else
				{
					$active	=	'';
				}
				
			}
			if(selfAllowed($pagealterpermission, 'selfEditAllowed', $value->createby) && checkpageaccess('designation',1,'modify'))
			{
				$edit	=	edit_html("edit_designation/".$value->desigID);
			}
			else
			{
				$edit	=	"";
			}
			$vaules['Action'] 			=	$view.$edit.$APPROVE.$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	function add_designation()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('designation',1,'create'))
		{
			redirect();
		}
		if($_POST)
		{
			$this->form_validation->set_rules('name', 'Designation Name', 'trim|required');
			if ($this->form_validation->run($this) == FALSE) {
				$this->session->set_userdata('err', validation_errors());
				redirect('add_designation');
			}
			$values=array('name'				=>	$this->input->post('name'),
							'description'		=>	$this->input->post('description'),
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$query	=	insertTable('tbldesignation', $values,1,'designation');
			if($query)
			{
				$this->session->set_userdata('suc','Designation Successfully  Added...!');
				redirect('add_designation');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('add_designation');
			}
		}
		$data['pageTitle']	=	"Add Designation";
		$this->load->view('admin/designation/add_designation',$data);
	}
	function designation_vaildation()
	{
		$query=$this->Commonsql_model->select('tbldesignation',array('name'=>trim($_POST['name'])));
		if($query->num_rows()>0)
		{
			echo "false";
		}
		else
		{
			echo "true";
		}
	}
	function edit_designation_vaildation()
	{
		$query=$this->Commonsql_model->select('tbldesignation',array('name'=>trim($_POST['name']),'desigID !='=>$_POST['desigID']));
		if($query->num_rows()>0)
		{
			echo "false";
		}
		else
		{
			echo "true";
		}
	}
	function edit_designation()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('designation',1,'modify'))
		{
			redirect();
		}
		if($_POST)
		{
				$this->form_validation->set_rules('name', 'Designation Name', 'trim|required');
				if ($this->form_validation->run($this) == FALSE) {
				$this->session->set_userdata('err', validation_errors());
				redirect('edit_designation/'.$this->input->post('desigID'));
				}
				$values=array('name'			=>	$this->input->post('name'),
							'description'		=>	$this->input->post('description'),
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$whereData	=	array('desigID'	=>	$this->input->post('desigID'));
			$query		= updateTable('tbldesignation', $whereData, $values , 1,'desigID', $this->input->post('desigID'),'designation');
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
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('designation',1,'view'))
		{
			redirect();
		}
		$data['pageTitle']	=	"View Designation";
		$data['view']		=	$this->Commonsql_model->select('tbldesignation',array('desigID'=>$this->uri->segment(2)));
		$this->load->view('admin/designation/view_designation',$data);
	}
	function approve_designation()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('designation',1,'approve'))
		{
			redirect();
		}
		if($_POST)
		{
			
			$check 	=	$this->Commonsql_model->select('tbldesignation',array('desigID'	=>	$this->input->post('desigID'),'name'		=>	$this->input->post('name'),
							'description'		=>	$this->input->post('description')));
			if($check->num_rows()==0)
			{
					$values_mod=array('name'		=>	$this->input->post('name'),
								'description'		=>	$this->input->post('description'),
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
		if (!$this->session->userdata('SESS_userId')) {return FALSE; }
		$result	=	$this->Commonsql_model->select_desc_state_confilct('tbldesignation_mod',array('desigID'=>$this->uri->segment(3)),'desig_modID');
		//echo $this->db->last_query();
		$output = array();$i=1;$j=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$value->desig_modID;
			$vaules['name'] 			= 	$value->name;
			$vaules['description'] 		= 	$value->description;
			if ($value->dbentrystateID == 0) 
			{
				$vaules['state'] 			= 	'<span class="label bg-danger">'.$value->state_names.'</span>';
			}
			elseif ($value->dbentrystateID == 1) 
			{
				$vaules['state'] 			= 	'<span class="label bg-warning">'.$value->state_names.'</span>';
			}
			elseif ($value->dbentrystateID == 2) 
			{
				$vaules['state'] 			= 	'<span class="label bg-info">'.$value->state_names.'</span>';
			}
			else
			{
				$vaules['state'] 			= 	'<span class="label bg-greensea">'.$value->state_names.'</span>';
			}
			if ($value->active == 1) 
			{
              
			  $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active'] = $row;
			$vaules['upt_date'] =	date('d-m-Y',strtotime($value->createdate));
			$vaules['upt_by'] 	=	$value->empname;
			if($value->active==1)
			{
				if($j++==1)
				{
					if(checkpageaccess('designation',1,'approve'))
					{
						$Approve	=	approve_html("'".base_url()."manage/designation_mod_approve/".$value->desig_modID."','2'");
					}
					else
					{
						$Approve			 			= "";
						
					}
					
				}
				else
				{
					$Approve	=	'';
				}
				if(checkpageaccess('designation',1,'delete'))
				{
					$active	=	disable_approve_deactive_html("'".base_url()."manage/approve_designation/".$value->desigID."/".$value->desig_modID."','0'");
				}
				else
				{
					$active	=	'';
				}
				
			}
			else
			{
				$Approve		=	'';
				if(checkpageaccess('designation',1,'delete'))
				{
					$active	=	enable_approve_deactive_html("'".base_url()."manage/approve_designation/".$value->desigID."/".$value->desig_modID."','1'");
				}
				else
				{
					$active	=	'';
				}
				
			}
			if(checkpageaccess('designation',1,'modify'))
			{
				$edit	=	edit_html("approve_designation/".$value->desigID.'/'.$value->desig_modID);
			}
			else
			{
				$edit	=	"";
			}
			$vaules['Action'] 			=	$Approve.$edit.$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	function designation_mod_approve()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
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
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
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
		if (!$this->session->userdata('SESS_userId')) {return FALSE; }
		$result					=	$this->Commonsql_model->select_all_state('tblrole','roleID');
		$pagealterpermission 	= pagealterpermission('role', $alterPermission = '');
		$output = array();$i=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$value->roleID;
			$vaules['roleName'] 		= 	$value->roleName;
			$vaules['description'] 		= 	$value->description;
			if ($value->dbentrystateID == 0) 
			{
				$vaules['state'] 			= 	'<span class="label bg-danger">'.$value->name.'</span>';
			}
			elseif ($value->dbentrystateID == 1) 
			{
				$vaules['state'] 			= 	'<span class="label bg-warning">'.$value->name.'</span>';
			}
			elseif ($value->dbentrystateID == 2) 
			{
				$vaules['state'] 			= 	'<span class="label bg-info">'.$value->name.'</span>';
			}
			else
			{
				$vaules['state'] 			= 	'<span class="label bg-greensea">'.$value->name.'</span>';
			}
			if ($value->active == 1) 
			{
              
			  $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active'] = $row;
			
			if($value->active==1)
			{
				
				if(checkpageaccess('role',1,'view'))
				{
					$view			 			=	view_html("view_role/".$value->roleID);
				}
				else
				{
					$view			 			=	'';
				}
				if(selfAllowed($pagealterpermission, 'selfApprovalAllowed', $value->createby) && checkpageaccess('role',1,'approve'))
				{
					$APPROVE			 			=	history_html("approve_role/".$value->roleID);
				}
				else
				{
					$APPROVE			 			= "";
					
				}
				if(checkpageaccess('role',1,'delete'))
				{
					$active	=	status_main_table($value->roleID,'roleID','role','role',1);
				}
				else
				{
					$active	=	'';
				}
			}
			else
			{
				$view		=	'';
				$APPROVE		=	'';
				if(checkpageaccess('role',1,'delete'))
				{
					$active	=	status_main_table($value->roleID,'roleID','role','role',0);
				}
				else
				{
					$active	=	'';
				}
				
			}
			if(selfAllowed($pagealterpermission, 'selfEditAllowed', $value->createby) && checkpageaccess('role',1,'modify'))
			{
				$edit	=	edit_html("edit_role/".$value->roleID);
				
			}
			else
			{
				$edit	=	"";
			}
			$vaules['Action'] 			=	$view.$edit.$APPROVE.$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	
	function add_role()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('role',1,'create'))
		{
			redirect();
		}
		if($_POST)
		{
			$this->form_validation->set_rules('roleName', 'Role Name', 'trim|required');
			if ($this->form_validation->run($this) == FALSE) {
			$this->session->set_userdata('err', validation_errors());
			redirect('add_role');
			}
			$values=array('roleName'				=>	$this->input->post('roleName'),
							'description'		=>	$this->input->post('description'),
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$query	=	insertTable('tblrole', $values,1,'role');
			if($query)
			{
				$this->session->set_userdata('suc','Role Successfully  Added...!');
				redirect('add_role');
				
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
	function role_vaildation()
	{
		$query=$this->Commonsql_model->select('tblrole',array('roleName'=>trim($_POST['roleName'])));
		if($query->num_rows()>0)
		{
			echo "false";
		}
		else
		{
			echo "true";
		}
	}
	function edit_role_vaildation()
	{
		$query=$this->Commonsql_model->select('tblrole',array('roleName'=>trim($_POST['roleName']),'roleID !='=>$_POST['roleID']));
		if($query->num_rows()>0)
		{
			echo "false";
		}
		else
		{
			echo "true";
		}
	}
	function edit_role()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('role',1,'modify'))
		{
			redirect();
		}
		if($_POST)
		{
				$this->form_validation->set_rules('roleName', 'Role Name', 'trim|required');
				if ($this->form_validation->run($this) == FALSE) {
				$this->session->set_userdata('err', validation_errors());
				redirect('edit_role/'.$this->input->post('roleID'));
				}
				$values=array('roleName'			=>	$this->input->post('roleName'),
								'description'		=>	$this->input->post('description'),
								'createby'			=>	$this->session->userdata('SESS_userId'),
								'active'			=>	1);
			
			$whereData	=	array('roleID'	=>	$this->input->post('roleID'));
			$query		= updateTable('tblrole', $whereData, $values , 1,'roleID', $this->input->post('roleID'),'role');
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
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('role',1,'view'))
		{
			redirect();
		}
		$data['pageTitle']	=	"View Role";
		$data['view']		=	$this->Commonsql_model->select('tblrole',array('roleID'=>$this->uri->segment(2)));
		$this->load->view('admin/role/view_role',$data);
	}
	function approve_role()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('role',1,'approve'))
		{
			redirect();
		}
		if($_POST)
		{
			
			$check 	=	$this->Commonsql_model->select('tblrole',array('roleID'	=>	$this->input->post('roleID'),'roleName'		=>	$this->input->post('roleName'),
							'description'		=>	$this->input->post('description')));
			if($check->num_rows()==0)
			{
					$values_mod=array('roleName'		=>	$this->input->post('roleName'),
								'description'		=>	$this->input->post('description'),
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
		if (!$this->session->userdata('SESS_userId')) {return FALSE; }
		$result	=	$this->Commonsql_model->select_desc_state('tblrole_mod',array('roleID'=>$this->uri->segment(3)),'role_modID');
		//echo $this->db->last_query();
		$output = array();$i=1;$j=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$value->role_modID;
			$vaules['name'] 			= 	$value->roleName;
			$vaules['description'] 		= 	$value->description;
			if ($value->dbentrystateID == 0) 
			{
				$vaules['state'] 			= 	'<span class="label bg-danger">'.$value->name.'</span>';
			}
			elseif ($value->dbentrystateID == 1) 
			{
				$vaules['state'] 			= 	'<span class="label bg-warning">'.$value->name.'</span>';
			}
			elseif ($value->dbentrystateID == 2) 
			{
				$vaules['state'] 			= 	'<span class="label bg-info">'.$value->name.'</span>';
			}
			else
			{
				$vaules['state'] 			= 	'<span class="label bg-greensea">'.$value->name.'</span>';
			}
			if ($value->active == 1) 
			{
              
			  $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active'] = $row;
			$vaules['upt_date'] =	date('d-m-Y',strtotime($value->createdate));
			$vaules['upt_by'] 	=	$value->empname;
			if($value->active==1)
			{
				if($j++==1)
				{
					if(checkpageaccess('role',1,'approve'))
					{
						$Approve	=	approve_html("'".base_url()."manage/role_mod_approve/".$value->role_modID."','2'");
					}
					else
					{
						$Approve			 			= "";
						
					}
					
				}
				else
				{
					$Approve	=	'';
				}
				if(checkpageaccess('role',1,'delete'))
				{
					$active	=	disable_approve_deactive_html("'".base_url()."manage/approve_role/".$value->roleID."/".$value->role_modID."','0'");
				}
				else
				{
					$active	=	'';
				}
				
			}
			else
			{
				$Approve		=	'';
				if(checkpageaccess('role',1,'delete'))
				{
					$active	=	enable_approve_deactive_html("'".base_url()."manage/approve_role/".$value->roleID."/".$value->role_modID."','1'");
				}
				else
				{
					$active	=	'';
				}
				
			}
			if(checkpageaccess('role',1,'modify'))
			{
				$edit	=	edit_html("approve_role/".$value->roleID.'/'.$value->role_modID);
			}
			else
			{
				$edit	=	"";
			}
			$vaules['Action'] 			=	$Approve.$edit.$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	function role_mod_approve()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('role',1,'approve'))
		{
			redirect();
		}
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
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
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
		if (!$this->session->userdata('SESS_userId')) {return FALSE; }
		$result					=	$this->Commonsql_model->select_all_state('tblpaymentmode','paymentModeID');
		$pagealterpermission	= pagealterpermission('payment_mode', $alterPermission = '');
		$output = array();$i=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$value->paymentModeID;
			$vaules['paymentMode'] 		= 	$value->paymentMode;
			$vaules['description'] 		= 	$value->description;
			if ($value->dbentrystateID == 0) 
			{
				$vaules['state'] 			= 	'<span class="label bg-danger">'.$value->name.'</span>';
			}
			elseif ($value->dbentrystateID == 1) 
			{
				$vaules['state'] 			= 	'<span class="label bg-warning">'.$value->name.'</span>';
			}
			elseif ($value->dbentrystateID == 2) 
			{
				$vaules['state'] 			= 	'<span class="label bg-info">'.$value->name.'</span>';
			}
			else
			{
				$vaules['state'] 			= 	'<span class="label bg-greensea">'.$value->name.'</span>';
			}
			if ($value->active == 1) 
			{
              
			  $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active'] = $row;
			
			if($value->active==1)
			{
				if(checkpageaccess('payment_mode',1,'view'))
				{
					$view			 			=	view_html("view_payment_mode/".$value->paymentModeID);
				}
				else
				{
					$view			 			=	'';
				}
				if(selfAllowed($pagealterpermission, 'selfApprovalAllowed', $value->createby) && checkpageaccess('payment_mode',1,'approve'))
				{
					$APPROVE			 			=	history_html("approve_payment_mode/".$value->paymentModeID);
				}
				else
				{
					$APPROVE			 			= "";
					
				}
				if(checkpageaccess('payment_mode',1,'delete'))
				{
					$active	=	status_main_table($value->paymentModeID,'paymentModeID','paymentmode','payment_mode',1);
				}
				else
				{
					$active	=	'';
				}
			}
			else
			{
				$view		=	'';
				$APPROVE		=	'';
				if(checkpageaccess('payment_mode',1,'delete'))
				{
					$active	=	status_main_table($value->paymentModeID,'paymentModeID','paymentmode','payment_mode',0);
				}
				else
				{
					$active	=	'';
				}
				
			}
			if(selfAllowed($pagealterpermission, 'selfEditAllowed', $value->createby) && checkpageaccess('payment_mode',1,'modify'))
			{
				$edit	=	edit_html("edit_payment_mode/".$value->paymentModeID);
			}
			else
			{
				$edit	=	"";
			}
			$vaules['Action'] 			=	$view.$edit.$APPROVE.$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	function add_payment_mode()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('payment_mode',1,'create'))
		{
			redirect();
		}
		if($_POST)
		{
			$this->form_validation->set_rules('paymentMode', 'Payment Mode Name', 'trim|required');
			if ($this->form_validation->run($this) == FALSE) {
			$this->session->set_userdata('err', validation_errors());
			redirect('add_payment_mode');
			}
			$values=array('paymentMode'				=>	$this->input->post('paymentMode'),
							'description'		=>	$this->input->post('description'),
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$query	=	insertTable('tblpaymentmode', $values,1,'payment_mode');
			if($query)
			{
				$this->session->set_userdata('suc','Payment Mode Successfully  Added...!');
				redirect('add_payment_mode');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('add_payment_mode');
			}
		}
		$data['pageTitle']	=	"Add Payment Mode";
		$this->load->view('admin/payment_mode/add_payment_mode',$data);
	}
	function payment_mode_vaildation()
	{
		$query=$this->Commonsql_model->select('tblpaymentmode',array('paymentMode'=>trim($_POST['paymentMode'])));
		if($query->num_rows()>0)
		{
			echo "false";
		}
		else
		{
			echo "true";
		}
	}
	function edit_payment_mode_vaildation()
	{
		$query=$this->Commonsql_model->select('tblpaymentmode',array('paymentMode'=>trim($_POST['paymentMode']),'paymentModeID !='=>$_POST['paymentModeID']));
		if($query->num_rows()>0)
		{
			echo "false";
		}
		else
		{
			echo "true";
		}
	}
	function edit_payment_mode()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('payment_mode',1,'modify'))
		{
			redirect();
		}
		if($_POST)
		{
				$this->form_validation->set_rules('paymentMode', 'Payment Mode Name', 'trim|required');
				if ($this->form_validation->run($this) == FALSE) {
				$this->session->set_userdata('err', validation_errors());
				redirect('edit_payment_mode/'.$this->input->post('paymentModeID'));
				}
				$values=array('paymentMode'				=>	$this->input->post('paymentMode'),
								'description'		=>	$this->input->post('description'),
								'paymentModeID'	=>	$this->input->post('paymentModeID'),
								'createby'			=>	$this->session->userdata('SESS_userId'),
								'active'			=>	1);
								
			$whereData	=	array('paymentModeID'	=>	$this->input->post('paymentModeID'));
			$query		= updateTable('tblpaymentmode', $whereData, $values , 1,'paymentModeID', $this->input->post('paymentModeID'),'payment_mode');
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
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('payment_mode',1,'view'))
		{
			redirect();
		}
		$data['pageTitle']	=	"View Payment Mode";
		$data['view']		=	$this->Commonsql_model->select('tblpaymentmode',array('paymentModeID'=>$this->uri->segment(2)));
		$this->load->view('admin/payment_mode/view_payment_mode',$data);
	}
	function approve_payment_mode()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('payment_mode',1,'approve'))
		{
			redirect();
		}
		if($_POST)
		{
			
			$check 	=	$this->Commonsql_model->select('tblpaymentmode',array('paymentModeID'	=>	$this->input->post('paymentModeID'),'paymentMode'		=>	$this->input->post('paymentMode'),
							'description'		=>	$this->input->post('description')));
			if($check->num_rows()==0)
			{
					$values_mod=array('paymentMode'		=>	$this->input->post('paymentMode'),
								'description'		=>	$this->input->post('description'),
								
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
		if (!$this->session->userdata('SESS_userId')) {return FALSE; }
		$result	=	$this->Commonsql_model->select_desc_state('tblpaymentmode_mod',array('paymentModeID'=>$this->uri->segment(3)),'paymentMode_modID');
		//echo $this->db->last_query();
		$output = array();$i=1;$j=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$value->paymentMode_modID;
			$vaules['name'] 			= 	$value->paymentMode;
			$vaules['description'] 		= 	$value->description;
			if ($value->dbentrystateID == 0) 
			{
				$vaules['state'] 			= 	'<span class="label bg-danger">'.$value->name.'</span>';
			}
			elseif ($value->dbentrystateID == 1) 
			{
				$vaules['state'] 			= 	'<span class="label bg-warning">'.$value->name.'</span>';
			}
			elseif ($value->dbentrystateID == 2) 
			{
				$vaules['state'] 			= 	'<span class="label bg-info">'.$value->name.'</span>';
			}
			else
			{
				$vaules['state'] 			= 	'<span class="label bg-greensea">'.$value->name.'</span>';
			}
			if ($value->active == 1) 
			{
              
			  $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active'] = $row;
			$vaules['upt_date'] =	date('d-m-Y',strtotime($value->createdate));
			$vaules['upt_by'] 	=	$value->empname;
			if($value->active==1)
			{
				if($j++>0)
				{
					if(checkpageaccess('payment_mode',1,'approve'))
					{
						$Approve	=	approve_html("'".base_url()."manage/payment_mode_mod_approve/".$value->paymentMode_modID."','2'");
					}
					else
					{
						$Approve			 			= "";
						
					}
					
				}
				else
				{
					$Approve	=	'';
				}
				if(checkpageaccess('payment_mode',1,'delete'))
				{
					$active	=	disable_approve_deactive_html("'".base_url()."manage/approve_payment_mode/".$value->paymentModeID."/".$value->paymentMode_modID."','0'");
				}
				else
				{
					$active	=	'';
				}
				
			}
			else
			{
				$Approve		=	'';
				if(checkpageaccess('payment_mode',1,'delete'))
				{
					$active	=	enable_approve_deactive_html("'".base_url()."manage/approve_payment_mode/".$value->paymentModeID."/".$value->paymentMode_modID."','1'");
				}
				else
				{
					$active	=	'';
				}
				
			}
			if(checkpageaccess('payment_mode',1,'modify'))
			{
				$edit	=	edit_html("approve_payment_mode/".$value->paymentModeID.'/'.$value->paymentMode_modID);
			}
			else
			{
				$edit	=	"";
			}
			$vaules['Action'] 			=	$Approve.$edit.$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	function payment_mode_mod_approve()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('payment_mode',1,'approve'))
		{
			redirect();
		}
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
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
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
		if (!$this->session->userdata('SESS_userId')) {return FALSE; }
		$result					=	$this->Commonsql_model->select_all_state('tblpaymentstatus','payStatusID');
		$pagealterpermission 	=	pagealterpermission('payment_status', $alterPermission = '');
		$output = array();$i=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$value->payStatusID;
			$vaules['name'] 			= 	$value->payStatus;
			$vaules['description'] 		= 	$value->description;
			if ($value->dbentrystateID == 0) 
			{
				$vaules['state'] 			= 	'<span class="label bg-danger">'.$value->name.'</span>';
			}
			elseif ($value->dbentrystateID == 1) 
			{
				$vaules['state'] 			= 	'<span class="label bg-warning">'.$value->name.'</span>';
			}
			elseif ($value->dbentrystateID == 2) 
			{
				$vaules['state'] 			= 	'<span class="label bg-info">'.$value->name.'</span>';
			}
			else
			{
				$vaules['state'] 			= 	'<span class="label bg-greensea">'.$value->name.'</span>';
			}
			if ($value->active == 1) 
			{
              
			  $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active'] = $row;
			
			if($value->active==1)
			{
				
				if(checkpageaccess('payment_status',1,'view'))
				{
					$view			 			=	view_html("view_payment_status/".$value->payStatusID);
				}
				else
				{
					$view			 			=	'';
				}
				if(selfAllowed($pagealterpermission, 'selfApprovalAllowed', $value->createby) && checkpageaccess('payment_status',1,'approve'))
				{
					$APPROVE			 			=	history_html("approve_payment_status/".$value->payStatusID);
				}
				else
				{
					$APPROVE			 			= "";
					
				}
				if(checkpageaccess('payment_status',1,'delete'))
				{
					$active	=	status_main_table($value->payStatusID,'payStatusID','paymentstatus','payment_status',1);
				}
				else
				{
					$active	=	'';
				}
			}
			else
			{
				$view		=	'';
				$APPROVE		=	'';
				if(checkpageaccess('payment_status',1,'delete'))
				{
					$active	=	status_main_table($value->payStatusID,'payStatusID','paymentstatus','payment_status',0);
				}
				else
				{
					$active	=	'';
				}
				
			}
			if(selfAllowed($pagealterpermission, 'selfEditAllowed', $value->createby) && checkpageaccess('payment_status',1,'modify'))
			{
				$edit	=	edit_html("edit_payment_status/".$value->payStatusID);
			}
			else
			{
				$edit	=	"";
			}
			$vaules['Action'] 			=	$view.$edit.$APPROVE.$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	function add_payment_status()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('payment_status',1,'create'))
		{
			redirect();
		}
		if($_POST)
		{
			$this->form_validation->set_rules('payStatus', 'Payment Status Name', 'trim|required');
			if ($this->form_validation->run($this) == FALSE) {
			$this->session->set_userdata('err', validation_errors());
			redirect('add_payment_status');
			}
			$values=array('payStatus'				=>	$this->input->post('payStatus'),
							'description'		=>	$this->input->post('description'),
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$query	=	insertTable('tblpaymentstatus', $values,1,'payment_status');
			if($query)
			{
				$this->session->set_userdata('suc','Payment Status Successfully  Added...!');
				redirect('add_payment_status');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('add_payment_status');
			}
		}
		$data['pageTitle']	=	"Add Payment Status";
		$this->load->view('admin/payment_mode/add_payment_status',$data);;
	}
	function payment_status_vaildation()
	{
		$query=$this->Commonsql_model->select('tblpaymentstatus',array('payStatus'=>trim($_POST['payStatus'])));
		if($query->num_rows()>0)
		{
			echo "false";
		}
		else
		{
			echo "true";
		}
	}
	function edit_payment_status_vaildation()
	{
		$query=$this->Commonsql_model->select('tblpaymentstatus',array('payStatus'=>trim($_POST['payStatus']),'payStatusID !='=>$_POST['payStatusID']));
		if($query->num_rows()>0)
		{
			echo "false";
		}
		else
		{
			echo "true";
		}
	}
	function edit_payment_status()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('payment_status',1,'modify'))
		{
			redirect();
		}
		if($_POST)
		{
				$this->form_validation->set_rules('payStatus', 'Payment Status Name', 'trim|required');
				if ($this->form_validation->run($this) == FALSE) {
				$this->session->set_userdata('err', validation_errors());
				redirect('edit_payment_status/'.$this->input->post('payStatusID'));
				}
				$values=array('payStatus'				=>	$this->input->post('payStatus'),
								'description'		=>	$this->input->post('description'),
								
								'createby'			=>	$this->session->userdata('SESS_userId'),
								'active'			=>	1);
								
			$whereData	=	array('payStatusID'	=>	$this->input->post('payStatusID'));
			$query		= updateTable('tblpaymentstatus', $whereData, $values , 1,'payStatusID', $this->input->post('payStatusID'),'payment_status');
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
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('payment_status',1,'view'))
		{
			redirect();
		}
		$data['pageTitle']	=	"View Payment Status";
		$data['view']		=	$this->Commonsql_model->select('tblpaymentstatus',array('payStatusID'=>$this->uri->segment(2)));
		$this->load->view('admin/payment_mode/view_payment_status',$data);;
	}
	function approve_payment_status()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('payment_status',1,'approve'))
		{
			redirect();
		}
		if($_POST)
		{
			
			$check 	=	$this->Commonsql_model->select('tblpaymentstatus',array('payStatusID'	=>	$this->input->post('payStatusID'),'payStatus'		=>	$this->input->post('payStatus'),
							'description'		=>	$this->input->post('description')));
			if($check->num_rows()==0)
			{
					$values_mod=array('payStatus'		=>	$this->input->post('payStatus'),
								'description'		=>	$this->input->post('description'),
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
		if (!$this->session->userdata('SESS_userId')) {return FALSE; }
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		$result	=	$this->Commonsql_model->select_desc_state('tblpaymentstatus_mod',array('payStatusID'=>$this->uri->segment(3)),'payStatus_modID');
		//echo $this->db->last_query();
		$output = array();$i=1;$j=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$value->payStatus_modID;
			$vaules['name'] 			= 	$value->payStatus;
			$vaules['description'] 		= 	$value->description;
			if ($value->dbentrystateID == 0) 
			{
				$vaules['state'] 			= 	'<span class="label bg-danger">'.$value->name.'</span>';
			}
			elseif ($value->dbentrystateID == 1) 
			{
				$vaules['state'] 			= 	'<span class="label bg-warning">'.$value->name.'</span>';
			}
			elseif ($value->dbentrystateID == 2) 
			{
				$vaules['state'] 			= 	'<span class="label bg-info">'.$value->name.'</span>';
			}
			else
			{
				$vaules['state'] 			= 	'<span class="label bg-greensea">'.$value->name.'</span>';
			}
			if ($value->active == 1) 
			{
              
			  $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active'] = $row;
			$vaules['upt_date'] =	date('d-m-Y',strtotime($value->createdate));
			$vaules['upt_by'] 	=	$value->empname;
			if($value->active==1)
			{
				if($j++>0)
				{
					if(checkpageaccess('payment_status',1,'approve'))
					{
						$Approve	=	approve_html("'".base_url()."manage/payment_statu_mod_approve/".$value->payStatus_modID."','2'");
					}
					else
					{
						$Approve			 			= "";
						
					}
					
				}
				else
				{
					$Approve	=	'';
				}
				if(checkpageaccess('payment_status',1,'delete'))
				{
					$active	=	disable_approve_deactive_html("'".base_url()."manage/approve_payment_status/".$value->payStatusID."/".$value->payStatus_modID."','0'");
				}
				else
				{
					$active	=	'';
				}
				
			}
			else
			{
				$Approve		=	'';
				if(checkpageaccess('payment_status',1,'delete'))
				{
					$active	=	enable_approve_deactive_html("'".base_url()."manage/approve_payment_status/".$value->payStatusID."/".$value->payStatus_modID."','1'");
				}
				else
				{
					$active	=	'';
				}
				
			}
			if(checkpageaccess('payment_status',1,'modify'))
			{
				$edit	=	edit_html("approve_payment_status/".$value->payStatusID.'/'.$value->payStatus_modID);
			}
			else
			{
				$edit	=	"";
			}
			$vaules['Action'] 			=	$Approve.$edit.$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	function payment_statu_mod_approve()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('payment_status',1,'approve'))
		{
			redirect();
		}
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
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
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
		if (!$this->session->userdata('SESS_userId')) {return FALSE; }
		$result	=	$this->Commonsql_model->select_all_state('tblemployetypes','employetypeID');
		$pagealterpermission = pagealterpermission('employee_types', $alterPermission = '');
		$output = array();$i=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$value->employetypeID;
			$vaules['name'] 			= 	$value->typename;
			$vaules['description'] 		= 	$value->description;
			if ($value->dbentrystateID == 0) 
			{
				$vaules['state'] 			= 	'<span class="label bg-danger">'.$value->name.'</span>';
			}
			elseif ($value->dbentrystateID == 1) 
			{
				$vaules['state'] 			= 	'<span class="label bg-warning">'.$value->name.'</span>';
			}
			elseif ($value->dbentrystateID == 2) 
			{
				$vaules['state'] 			= 	'<span class="label bg-info">'.$value->name.'</span>';
			}
			else
			{
				$vaules['state'] 			= 	'<span class="label bg-greensea">'.$value->name.'</span>';
			}
			if ($value->active == 1) 
			{
              
			  $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active'] = $row;
			
			if($value->active==1)
			{
				
				if(checkpageaccess('employee_types',1,'view'))
				{
					$view		=	view_html("view_employee_types/".$value->employetypeID);
				}
				else
				{
					$view			 			=	'';
				}
				if(selfAllowed($pagealterpermission, 'selfApprovalAllowed', $value->createby) && checkpageaccess('employee_types',1,'approve'))
				{
					$Approve		=	history_html("approve_employee_types/".$value->employetypeID);
				}
				else
				{
					$APPROVE			 			= "";
					
				}
				if(checkpageaccess('employee_types',1,'delete'))
				{
					$active	=	status_main_table($value->employetypeID,'employetypeID','employetypes','employee_types',1);
				}
				else
				{
					$active	=	'';
				}
			}
			else
			{
				$view		=	'';
				$Approve		=	'';
				if(checkpageaccess('employee_types',1,'delete'))
				{
					$active	=	status_main_table($value->employetypeID,'employetypeID','employetypes','employee_types',0);
				}
				else
				{
					$active	=	'';
				}
				
			}
			if(selfAllowed($pagealterpermission, 'selfEditAllowed', $value->createby) && checkpageaccess('employee_types',1,'modify'))
			{
				$edit	=	edit_html("edit_employee_types/".$value->employetypeID);
			}
			else
			{
				$edit	=	"";
			}
			$vaules['Action'] 			=	$view.$edit.$Approve.$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	function add_employee_types()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('employee_types',1,'create'))
		{
			redirect();
		}
		if($_POST)
		{
			$this->form_validation->set_rules('typename', 'Employee Types Name', 'trim|required');
			if ($this->form_validation->run($this) == FALSE) {
			$this->session->set_userdata('err', validation_errors());
			redirect('add_employee_types');
			}
			$values=array('typename'				=>	$this->input->post('typename'),
							'description'		=>	$this->input->post('description'),
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$query	=	insertTable('tblemployetypes', $values,1,'employee_types');
			if($query)
			{
				$this->session->set_userdata('suc','Employee Types Successfully  Added...!');
				redirect('add_employee_types');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('add_employee_types');
			}
		}
		$data['pageTitle']	=	"Add Emplyee Types";
		$this->load->view('admin/employee_types/add_employee_types',$data);
	}
	function employee_types_vaildation()
	{
		$query=$this->Commonsql_model->select('tblemployetypes',array('typename'=>trim($_POST['typename'])));
		if($query->num_rows()>0)
		{
			echo "false";
		}
		else
		{
			echo "true";
		}
	}
	function edit_employee_types_vaildation()
	{
		$query=$this->Commonsql_model->select('tblemployetypes',array('typename'=>trim($_POST['typename']),'employetypeID !='=>$_POST['employetypeID']));
		if($query->num_rows()>0)
		{
			echo "false";
		}
		else
		{
			echo "true";
		}
	}
	function edit_employee_types()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('employee_types',1,'modify'))
		{
			redirect();
		}
		if($_POST)
		{
				$this->form_validation->set_rules('typename', 'Employee Types Name', 'trim|required');
				if ($this->form_validation->run($this) == FALSE) {
				$this->session->set_userdata('err', validation_errors());
				redirect('edit_employee_types/'.$this->input->post('employetypeID'));
				}
				$values=array('typename'				=>	$this->input->post('typename'),
								'description'		=>	$this->input->post('description'),
								'employetypeID'		=>	$this->input->post('employetypeID'),
								'createby'			=>	$this->session->userdata('SESS_userId'),
								'active'			=>	1);
								
			$whereData	=	array('employetypeID'	=>	$this->input->post('employetypeID'));
			$query		= updateTable('tblemployetypes', $whereData, $values , 1,'employetypeID', $this->input->post('employetypeID'),'employee_types');
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
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('employee_types',1,'view'))
		{
			redirect();
		}
		$data['pageTitle']	=	"View Emplyee Types";
		$data['view']		=	$this->Commonsql_model->select('tblemployetypes',array('employetypeID'=>$this->uri->segment(2)));
		$this->load->view('admin/employee_types/view_employee_types',$data);
	}
	function approve_employee_types()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('employee_types',1,'approve'))
		{
			redirect();
		}
		if($_POST)
		{
			
			$check 	=	$this->Commonsql_model->select('tblemployetypes',array('employetypeID'	=>	$this->input->post('employetypeID'),'typename'		=>	$this->input->post('typename'),
							'description'		=>	$this->input->post('description')));
			if($check->num_rows()==0)
			{
					$values_mod=array('typename'		=>	$this->input->post('typename'),
								'description'		=>	$this->input->post('description'),
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
		if (!$this->session->userdata('SESS_userId')) {return FALSE; }
		$result	=	$this->Commonsql_model->select_desc_state('tblemployetypes_mod',array('employetypeID'=>$this->uri->segment(3)),'employetype_modID');
		//echo $this->db->last_query();exit;
		$output = array();
		$i=1;$j=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$value->employetype_modID;
			$vaules['name'] 			= 	$value->typename;
			$vaules['description'] 		= 	$value->description;
			if ($value->dbentrystateID == 0) 
			{
				$vaules['state'] 			= 	'<span class="label bg-danger">'.$value->name.'</span>';
			}
			elseif ($value->dbentrystateID == 1) 
			{
				$vaules['state'] 			= 	'<span class="label bg-warning">'.$value->name.'</span>';
			}
			elseif ($value->dbentrystateID == 2) 
			{
				$vaules['state'] 			= 	'<span class="label bg-info">'.$value->name.'</span>';
			}
			else
			{
				$vaules['state'] 			= 	'<span class="label bg-greensea">'.$value->name.'</span>';
			}
			
			if ($value->active == 1) 
			{
              
			  $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active'] = $row;
			$vaules['upt_date'] =	date('d-m-Y',strtotime($value->createdon));
			$vaules['upt_by'] 	=	$value->empname;
			if($value->active==1)
			{
				if($j++>0)
				{
					if(checkpageaccess('employee_types',1,'approve'))
					{
						$Approve	=	approve_html("'".base_url()."manage/employee_types_mod_approve/".$value->employetype_modID."','2'");
					}
					else
					{
						$Approve			 			= "";
						
					}
					
				}
				else
				{
					$Approve	=	'';
				}
				if(checkpageaccess('employee_types',1,'delete'))
				{
					$active	=	disable_approve_deactive_html("'".base_url()."manage/approve_employee_types/".$value->employetypeID."/".$value->employetype_modID."','0'");
				}
				else
				{
					$active	=	'';
				}
				
			}
			else
			{
				$Approve	=	'';
				if(checkpageaccess('employee_types',1,'delete'))
				{
					$active	=	enable_approve_deactive_html("'".base_url()."manage/approve_employee_types/".$value->employetypeID."/".$value->employetype_modID."','1'");
				}
				else
				{
					$active	=	'';
				}
				
			}
			if(checkpageaccess('employee_types',1,'modify'))
			{
				$edit	=	edit_html("approve_employee_types/".$value->employetypeID.'/'.$value->employetype_modID);
			}
			else
			{
				$edit	=	"";
			}
			$vaules['Action'] 			=	$Approve.$edit.$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	function employee_types_mod_approve()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('employee_types',1,'approve'))
		{
			redirect();
		}
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
	/***********************************************************************************************************************************/
	function employee()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if($this->uri->segment(3))
		{
			$whereData	=	array('empID'	=>	$this->uri->segment(3));
			$updateData	=	array('active'	=>	$this->uri->segment(4));
			$upt	=	$this->Commonsql_model->updateTable('tblemployee', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','employee Status Successfully  Changed...!');
				redirect('employee');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('employee');
			}
		}
		else
		{
			/*print_r($this->session->userdata('SESS_userRole'));
			$SESS_userRole = $this->session->userdata('SESS_userRole');
			$pageroleaccessmap = pageroleaccessmap($SESS_userRole, 'designation');
			print_r($pageroleaccessmap);
			exit();*/
			
			$data['pageTitle']	=	"employee";
			$data['table']		=	"employee";
			$this->load->view('admin/employee/employee',$data);
		}
	}
	function employee_json()
	{
		if (!$this->session->userdata('SESS_userId')) {return FALSE; }
		$result					=	$this->Commonsql_model->select_all_employee_state();
		$pagealterpermission 	=	pagealterpermission('employee', $alterPermission = '');
		$output = array();$i=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$value->empID;
			$vaules['empCode'] 			= 	$value->empCode;
			$vaules['empname'] 			= 	$value->empname;
			$vaules['qualification'] 	= 	$value->qualification;
			
			$vaules['deptid'] 			= 	$value->department;
			$vaules['designation'] 		= 	$value->name;
			$vaules['mobile'] 			= 	$value->mobile;
			
			$vaules['mailoffice'] 		= 	$value->mailoffice;
			$vaules['remarks'] 			= 	$value->remarks;
			
			
			if('1970-01-01'==$value->joiningdate || $value->joiningdate=='')
			{
				$vaules['joiningdate'] 	= 	"-";
			}
			else
			{
				$vaules['joiningdate'] 		= 	date('m-d-Y',strtotime($value->joiningdate));
			}
			if('1970-01-01'==$value->releavingdate || $value->releavingdate=='')
			{
				$vaules['releavingdate'] 	= 	"-";
			}
			else
			{
				$vaules['releavingdate'] 	= 	date('m-d-Y',strtotime($value->releavingdate));
			}
			
			if ($value->active == 1) 
			{
              
			  $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active'] = $row;
			if ($value->dbentrystateID == 0) 
			{
				$vaules['state'] 			= 	'<span class="label bg-danger">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 1) 
			{
				$vaules['state'] 			= 	'<span class="label bg-warning">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 2) 
			{
				$vaules['state'] 			= 	'<span class="label bg-info">'.$value->sta_name.'</span>';
			}
			else
			{
				$vaules['state'] 			= 	'<span class="label bg-greensea">'.$value->sta_name.'</span>';
			}
			if($value->active==1)
			{
				
				if(checkpageaccess('employee',1,'view'))
				{
					$view			 			=	view_html("view_employee/".$value->empID);
				}
				else
				{
					$view			 			=	'';
				}
				if(selfAllowed($pagealterpermission, 'selfApprovalAllowed', $value->createby) && checkpageaccess('employee',1,'approve'))
				{
					$APPROVE			 			=	history_html("approve_employee/".$value->empID);
				}
				else
				{
					$APPROVE			 			= "";
					
				}
				if(checkpageaccess('employee',1,'delete'))
				{
					$active	=	status_main_table($value->empID,'empID','employee','employee',1);
				}
				else
				{
					$active	=	'';
				}
			}
			else
			{
				$APPROVE		=	'';
				$view			 =	'';
				if(checkpageaccess('employee',1,'delete'))
				{
					$active	=	status_main_table($value->empID,'empID','employee','employee',0);
				}
				else
				{
					$active	=	'';
				}
				
			}
			if(selfAllowed($pagealterpermission, 'selfEditAllowed', $value->createby) && checkpageaccess('employee',1,'modify'))
			{
				$edit	=	edit_html("edit_employee/".$value->empID);
			}
			else
			{
				$edit	=	"";
			}
			$vaules['Action'] 			=	$view.$edit.$APPROVE.$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	function add_employee()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('employee',1,'create'))
		{
			redirect();
		}
		if($_POST)
		{
            $this->form_validation->set_rules('empname', 'Employee Name', 'trim|required');
			$this->form_validation->set_rules('sex', 'Gender', 'trim|required');
			$this->form_validation->set_rules('fathername', 'Father name', 'trim|required');
			$this->form_validation->set_rules('deptid', 'Department', 'trim|required');
			$this->form_validation->set_rules('designation', 'Designation', 'trim|required');
			$this->form_validation->set_rules('employeetype', 'Employee type', 'trim|required');
			$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required');
			$this->form_validation->set_rules('empname', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('addressline1', 'Address 1', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'state', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
			$this->form_validation->set_rules('joiningdate', 'Joining Date', 'trim|required');
			$this->form_validation->set_rules('reportingto', 'Reporting to', 'trim|required');
            if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_userdata('err', validation_errors());
                redirect('add_employee');
            }
			$photo=$_FILES['photo']['name'];
			$proof1=$_FILES['proof1']['name'];
			$proof2=$_FILES['proof2']['name'];
			if($photo!='')
			{
				$this->up_thumb();
			}
			if($proof1!='')
			{
				$uploadpath="./uploads/proof/".$proof1;
				move_uploaded_file($_FILES['proof1']['tmp_name'], $uploadpath);
			}
			if($proof2!='')
			{
				$uploadpath="./uploads/proof/".$proof1;
				move_uploaded_file($_FILES['proof2']['tmp_name'], $uploadpath);
			}
			if($this->session->userdata('SESS_userBranchID')==0)
			$SESS_userBranchID=1;
			else
			$SESS_userBranchID=$this->session->userdata('SESS_userBranchID');
			
			$mailoffice	=	$this->input->post('mailoffice');
			
			$values=array('empCode'						=>	'',
							'empname'					=>	$this->input->post('empname'),
							'branchID'					=>	$SESS_userBranchID,
							
							'dob'						=>	date('Y-m-d',strtotime($this->input->post('dob'))),
							'sex'						=>	$this->input->post('sex'),
							'fathername'				=>	$this->input->post('fathername'),
							
							'qualification'				=>	$this->input->post('qualification'),
							'deptid'					=>	$this->input->post('deptid'),
							'designation'				=>	$this->input->post('designation'),
							
							'employeetype'				=>	$this->input->post('employeetype'),
							'mobile'					=>	$this->input->post('mobile'),
							'emergencycontactperson'	=>	$this->input->post('emergencycontactperson'),
							
							'emergencycontact'			=>	$this->input->post('emergencycontact'),
							'mailoffice'				=>	$mailoffice,
							'mailpersonal'				=>	$this->input->post('mailpersonal'),
							
							'addressline1'				=>	$this->input->post('addressline1'),
							'city'						=>	$this->input->post('city'),
							'state'						=>	$this->input->post('state'),
							
							'country'					=>	$this->input->post('country'),
							'joiningdate'				=>	date('Y-m-d',strtotime($this->input->post('joiningdate'))),
							'reportingto'				=>	$this->input->post('reportingto'),
							
							'photo'						=>	$photo,
							'proof1'					=>	$proof1,
							'proof2'					=>	$proof2,
							
							'remarks'					=>	$this->input->post('remarks'),
							'releavingdate'				=>	date('Y-m-d',strtotime($this->input->post('releavingdate'))),
							
							'createby'					=>	$this->session->userdata('SESS_userId'),
							'active'					=>	1);
							
			$empID	=	insertTable('tblemployee', $values,1,'empID','employee');
			
			$values=array(	'empID'						=>	$empID,
							'phone_number'				=>	$this->input->post('mobile'),
							'username'					=>	$mailoffice,
							'dbentrystateID'			=>	3,
							'createby'					=>	$this->session->userdata('SESS_userId'),
							'active'					=>	1);
							
			$query	=	insertTable('tbllogin', $values,0,'empID','employee');
			$pword	=	$query.rand(1001, 9999);;
			$this->load->library('encrypt');
			$upt	=	$this->Commonsql_model->updateTable('tbllogin', array('loginID'=>$query) ,  array('password'=>do_hash(do_hash(do_hash($pword)))));
			if($query)
			{
				if($mailoffice!='')
				{
					$datas['pword']	=	$pword;
					$message		=	$this->load->view('admin/mail/password',$datas,true);
					$upt			=	$this->Commonsql_model->email_sent_user($mailoffice,"TruLms Password",$message);
				}
				$this->session->set_userdata('suc','employee Successfully  Added...!');
				redirect('add_employee');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('add_employee');
			}
		}
		$data['dept']		=	$this->Commonsql_model->select('tbldept',array('dbentrystateID >'=>STATEID,'active'=>1));
		$data['desig']		=	$this->Commonsql_model->select('tbldesignation',array('dbentrystateID >'=>STATEID,'active'=>1));
		$data['etype']		=	$this->Commonsql_model->select('tblemployetypes',array('dbentrystateID >'=>STATEID,'active'=>1));
		$data['branch']		=	$this->Commonsql_model->select('tblbranch',array('dbentrystateID >'=>STATEID,'active'=>1));
		$data['role']		=	$this->Commonsql_model->select('tblrole',array('dbentrystateID >'=>STATEID,'active'=>1));
		$data['pageTitle']	=	"Add employee";
		$this->load->view('admin/employee/add_employee',$data);
	}
	function reporting_to()
	{
		$id			=	$this->input->post('id');
		$role		=	$this->Commonsql_model->select('tblemprolemap',array('dbentrystateID >'=>STATEID,'active'=>1,'roleID'=>$id));
		$emplyoee_id=	array();
		if($role->num_rows()>0)
		{
			foreach($role->result() as $rr)
			{
				$emplyoee_id[]	=	$rr->empID;
			}
		}
		if(!empty($emplyoee_id))
		{
			$emplyoee	=	$this->Commonsql_model->where_in('tblemployee', array('branchID'=>$this->session->userdata('SESS_userBranchID'),'dbentrystateID >'=>STATEID,'active'=>1),'empID,empname', 'empID', $emplyoee_id);
			
			?>
            <option value="">-- Select Employee --</option>
            <?php
			//echo $this->db->last_query();exit;
			if($emplyoee->num_rows()>0)
			{
				foreach($emplyoee->result() as $emp)
				{
					?>
                      <option value="<?=$emp->empID?>"><?=$emp->empname?></option>
                    <?php
				}
			}
		}
		else
		{
			?>
            <option value="">-- Select Employee --</option>
            <?php
		}
		
	}
	function edit_employee()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('employee',1,'modify'))
		{
			redirect();
		}
		if($_POST)
		{
			$this->form_validation->set_rules('empname', 'Employee Name', 'trim|required');
			$this->form_validation->set_rules('sex', 'Gender', 'trim|required');
			$this->form_validation->set_rules('fathername', 'Father name', 'trim|required');
			$this->form_validation->set_rules('deptid', 'Department', 'trim|required');
			$this->form_validation->set_rules('designation', 'Designation', 'trim|required');
			$this->form_validation->set_rules('employeetype', 'Employee type', 'trim|required');
			$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required');
			$this->form_validation->set_rules('empname', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('addressline1', 'Address 1', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'state', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
			$this->form_validation->set_rules('joiningdate', 'Joining Date', 'trim|required');
			$this->form_validation->set_rules('reportingto', 'Reporting to', 'trim|required');
            if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_userdata('err', validation_errors());
                redirect('edit_employee/'.$this->input->post('empID'));
            }
			$photo=$_FILES['photo']['name'];
			$proof1=$_FILES['proof1']['name'];
			$proof2=$_FILES['proof2']['name'];
			if($photo!='')
			{
				$this->up_thumb();
			}
			else
			{
				$photo	=	$this->input->post('photo1');
			}
			if($proof1!='')
			{
				$uploadpath="./uploads/proof/".$proof1;
				move_uploaded_file($_FILES['proof1']['tmp_name'], $uploadpath);
			}
			else
			{
				$proof1	=	$this->input->post('proof11');
			}
			if($proof2!='')
			{
				$uploadpath="./uploads/proof/".$proof1;
				move_uploaded_file($_FILES['proof2']['tmp_name'], $uploadpath);
			}
			else
			{
				$proof2	=	$this->input->post('proof21');
			}
				$values_mod=array('empCode'				=>	'',
							'empname'					=>	$this->input->post('empname'),
							'branchID'					=>	$this->session->userdata('SESS_userBranchID'),
							
							'dob'						=>	date('Y-m-d',strtotime($this->input->post('dob'))),
							'sex'						=>	$this->input->post('sex'),
							'fathername'				=>	$this->input->post('fathername'),
							
							'qualification'				=>	$this->input->post('qualification'),
							'deptid'					=>	$this->input->post('deptid'),
							'designation'				=>	$this->input->post('designation'),
							
							'employeetype'				=>	$this->input->post('employeetype'),
							'mobile'					=>	$this->input->post('mobile'),
							'emergencycontactperson'	=>	$this->input->post('emergencycontactperson'),
							
							'emergencycontact'			=>	$this->input->post('emergencycontact'),
							'mailoffice'				=>	$this->input->post('mailoffice'),
							'mailpersonal'				=>	$this->input->post('mailpersonal'),
							
							'addressline1'				=>	$this->input->post('addressline1'),
							'city'						=>	$this->input->post('city'),
							'state'						=>	$this->input->post('state'),
							
							'country'					=>	$this->input->post('country'),
							'joiningdate'				=>	date('Y-m-d',strtotime($this->input->post('joiningdate'))),
							'reportingto'				=>	$this->input->post('reportingto'),
							
							'photo'						=>	$photo,
							'proof1'					=>	$proof1,
							'proof2'					=>	$proof2,
							
							'remarks'					=>	$this->input->post('remarks'),
							'releavingdate'				=>	date('Y-m-d',strtotime($this->input->post('releavingdate'))),
							
							'createby'					=>	$this->session->userdata('SESS_userId'),
							'active'					=>	1);
							
			$whereData	=	array('empID'	=>	$this->input->post('empID'));
			
			$query		= updateTable('tblemployee', $whereData, $values_mod , 1,'empID', $this->input->post('empID'),'employee');
			
			if($query)
			{
				$this->session->set_userdata('suc','employee Successfully  Updated...!');
				redirect('edit_employee/'.$this->input->post('empID'));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('edit_employee/'.$this->input->post('empID'));
			}
		}
		$data['pageTitle']	=	"Edit employee";
		$data['dept']		=	$this->Commonsql_model->select('tbldept',array('dbentrystateID >'=>STATEID,'active'=>1));
		$data['desig']		=	$this->Commonsql_model->select('tbldesignation',array('dbentrystateID >'=>STATEID,'active'=>1));
		$data['etype']		=	$this->Commonsql_model->select('tblemployetypes',array('dbentrystateID >'=>STATEID,'active'=>1));
		$data['branch']		=	$this->Commonsql_model->select('tblbranch',array('dbentrystateID >'=>STATEID,'active'=>1));
		$data['view']		=	$this->Commonsql_model->select('tblemployee',array('empID'=>$this->uri->segment(2)));
		$data['role']		=	$this->Commonsql_model->select('tblrole',array('dbentrystateID >'=>STATEID,'active'=>1));
		$this->load->view('admin/employee/edit_employee',$data);
	}
	function view_employee()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('employee',1,'view'))
		{
			redirect();
		}
		$data['pageTitle']	=	"View employee";
		$data['dept']		=	$this->Commonsql_model->select('tbldept',array('dbentrystateID >'=>STATEID,'active'=>1));
		$data['desig']		=	$this->Commonsql_model->select('tbldesignation',array('dbentrystateID >'=>STATEID,'active'=>1));
		$data['etype']		=	$this->Commonsql_model->select('tblemployetypes',array('dbentrystateID >'=>STATEID,'active'=>1));
		$data['branch']		=	$this->Commonsql_model->select('tblbranch',array('dbentrystateID >'=>STATEID,'active'=>1));
		$data['view']		=	$this->Commonsql_model->select('tblemployee',array('empID'=>$this->uri->segment(2)));
		$data['role']		=	$this->Commonsql_model->select('tblrole',array('dbentrystateID >'=>STATEID,'active'=>1));
		$this->load->view('admin/employee/view_employee',$data);
	}
	function approve_employee()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('employee',1,'approve'))
		{
			redirect();
		}
		if($_POST)
		{
			$this->form_validation->set_rules('empname', 'Employee Name', 'trim|required');
			$this->form_validation->set_rules('sex', 'Gender', 'trim|required');
			$this->form_validation->set_rules('fathername', 'Father name', 'trim|required');
			$this->form_validation->set_rules('deptid', 'Department', 'trim|required');
			$this->form_validation->set_rules('designation', 'Designation', 'trim|required');
			$this->form_validation->set_rules('employeetype', 'Employee type', 'trim|required');
			$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required');
			$this->form_validation->set_rules('empname', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('addressline1', 'Address 1', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'state', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
			$this->form_validation->set_rules('joiningdate', 'Joining Date', 'trim|required');
			$this->form_validation->set_rules('reportingto', 'Reporting to', 'trim|required');
            if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_userdata('err', validation_errors());
                redirect('approve_employee/'.$this->input->post('empID'));
            }
			$photo=$_FILES['photo']['name'];
			$proof1=$_FILES['proof1']['name'];
			$proof2=$_FILES['proof2']['name'];
			if($photo!='')
			{
				$this->up_thumb();
			}
			else
			{
				$photo	=	$this->input->post('photo1');
			}
			if($proof1!='')
			{
				$uploadpath="./uploads/proof/".$proof1;
				move_uploaded_file($_FILES['proof1']['tmp_name'], $uploadpath);
			}
			else
			{
				$proof1	=	$this->input->post('proof11');
			}
			if($proof2!='')
			{
				$uploadpath="./uploads/proof/".$proof1;
				move_uploaded_file($_FILES['proof2']['tmp_name'], $uploadpath);
			}
			else
			{
				$proof2	=	$this->input->post('proof21');
			}
				$values_mod=array('empCode'				=>	'',
							'empname'					=>	$this->input->post('empname'),
							'branchID'					=>	$this->session->userdata('SESS_userBranchID'),
							
							'dob'						=>	date('Y-m-d',strtotime($this->input->post('dob'))),
							'sex'						=>	$this->input->post('sex'),
							'fathername'				=>	$this->input->post('fathername'),
							
							'qualification'				=>	$this->input->post('qualification'),
							'deptid'					=>	$this->input->post('deptid'),
							'designation'				=>	$this->input->post('designation'),
							
							'employeetype'				=>	$this->input->post('employeetype'),
							'mobile'					=>	$this->input->post('mobile'),
							'emergencycontactperson'	=>	$this->input->post('emergencycontactperson'),
							
							'emergencycontact'			=>	$this->input->post('emergencycontact'),
							'mailoffice'				=>	$this->input->post('mailoffice'),
							'mailpersonal'				=>	$this->input->post('mailpersonal'),
							
							'addressline1'				=>	$this->input->post('addressline1'),
							'city'						=>	$this->input->post('city'),
							'state'						=>	$this->input->post('state'),
							
							'country'					=>	$this->input->post('country'),
							'joiningdate'				=>	date('Y-m-d',strtotime($this->input->post('joiningdate'))),
							'reportingto'				=>	$this->input->post('reportingto'),
							
							'photo'						=>	$photo,
							'proof1'					=>	$proof1,
							'proof2'					=>	$proof2,
							
							'remarks'					=>	$this->input->post('remarks'),
							'releavingdate'				=>	date('Y-m-d',strtotime($this->input->post('releavingdate'))),
							
							'createby'					=>	$this->session->userdata('SESS_userId'),
							'active'					=>	1);
							
			$whereData	=	array('empID'	=>	$this->input->post('empID'));
			
			$query		= updateTable('tblemployee', $whereData, $values_mod , 1,'empID', $this->input->post('empID'),'employee');
			
			if($query)
			{
				$this->session->set_userdata('suc','employee Successfully  Updated...!');
				redirect('approve_employee/'.$this->input->post('empID'));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('approve_employee/'.$this->input->post('empID'));
			}
		}
		if($this->uri->segment(4))
		{
			$whereData	=	array('emp_modID'	=>	$this->uri->segment(4));
			$updateData	=	array('active'	=>	$this->uri->segment(5));
			$upt	=	$this->Commonsql_model->updateTable('tblemployee_mod', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','employee Status Successfully  Changed...!');
				redirect('approve_employee/'.$this->uri->segment(3));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('approve_employee/'.$this->uri->segment(3));
			}
		}
		else if($this->uri->segment(3))
		{
			$data['pageTitle']	=	"View employee";
			$data['table']		=	"Designation";
			$data['dept']		=	$this->Commonsql_model->select('tbldept',array('dbentrystateID >'=>STATEID,'active'=>1));
			$data['desig']		=	$this->Commonsql_model->select('tbldesignation',array('dbentrystateID >'=>STATEID,'active'=>1));
			$data['etype']		=	$this->Commonsql_model->select('tblemployetypes',array('dbentrystateID >'=>STATEID,'active'=>1));
			$data['branch']		=	$this->Commonsql_model->select('tblbranch',array('dbentrystateID >'=>STATEID,'active'=>1));
			$data['view']		=	$this->Commonsql_model->select('tblemployee_mod',array('emp_modID'=>$this->uri->segment(3)));
			$data['role']		=	$this->Commonsql_model->select('tblrole',array('dbentrystateID >'=>STATEID,'active'=>1));
			$this->load->view('admin/employee/approve_employee',$data);
		}
		else
		{
			$data['pageTitle']	=	"View employee";
			$data['table']		=	"employee";
			$data['dept']		=	$this->Commonsql_model->select('tbldept',array('dbentrystateID >'=>STATEID,'active'=>1));
			$data['desig']		=	$this->Commonsql_model->select('tbldesignation',array('dbentrystateID >'=>STATEID,'active'=>1));
			$data['etype']		=	$this->Commonsql_model->select('tblemployetypes',array('dbentrystateID >'=>STATEID,'active'=>1));
			$data['branch']		=	$this->Commonsql_model->select('tblbranch',array('dbentrystateID >'=>STATEID,'active'=>1));
			$data['view']		=	$this->Commonsql_model->select('tblemployee',array('empID'=>$this->uri->segment(2)));
			$data['role']		=	$this->Commonsql_model->select('tblrole',array('dbentrystateID >'=>STATEID,'active'=>1));
			$this->load->view('admin/employee/approve_employee',$data);
		}
	}
	function up_thumb()
	{
		$i=0;
		if(isset($_FILES['photo']) && $_FILES['photo']['tmp_name'] != '')
		{
			$sizes = array();
			$sizes['400'] = 400;
			$sizes['200'] = 200;
			
			$prefix =$_FILES['photo']['name'];
			list(,,$type) = getimagesize($_FILES['photo']['tmp_name']);
			$type = image_type_to_extension($type);
			
			move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/photo/'.$prefix.$type);
				
			$t = 'imagecreatefrom'.$type;
			$t = str_replace('.','',$t);
			$img = $t('uploads/photo/'.$prefix.$type);
			foreach($sizes as $k=>$v)
			{
				$width = imagesx( $img );
				$height = imagesy( $img );
				
				$new_width = $v;
				$new_height = floor( $height * ( $v / $width ) );
				
				$tmp_img = imagecreatetruecolor( $new_width, $new_height );
				imagealphablending( $tmp_img, false );
				imagesavealpha( $tmp_img, true );
				imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
				
				$c = 'image'.$type;
				$c = str_replace('.','',$c);
				if($k==400)
				{
					$c( $tmp_img, 'uploads/photo/medium/'.$prefix.$type );
				}
				else
				{
					$c( $tmp_img, 'uploads/photo/thumbnail/'.$prefix.$type );
				}
			
			}
			
		}
	}
	function approve_employee_json()
	{
		if (!$this->session->userdata('SESS_userId')) {return FALSE; }
		$result	=	$this->Commonsql_model->select_all_employee_mod_state($this->uri->segment(3));
		//echo $this->db->last_query();exit;
		$output = array();$i=1;$j=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$value->emp_modID;
			$vaules['empCode'] 			= 	$value->empCode;
			$vaules['empname'] 			= 	$value->empname;
			$vaules['qualification'] 	= 	$value->qualification;
			
			$vaules['deptid'] 			= 	$value->department;
			$vaules['designation'] 		= 	$value->name;
			$vaules['mobile'] 			= 	$value->mobile;
			
			$vaules['mailoffice'] 		= 	$value->mailoffice;
			$vaules['remarks'] 			= 	$value->remarks;
			
			$vaules['upt_date'] =	date('d-m-Y',strtotime($value->createdon));
			$vaules['upt_by'] 	=	$value->empname;
			
			if('1970-01-01'==$value->joiningdate || $value->joiningdate=='')
			{
				$vaules['joiningdate'] 	= 	"-";
			}
			else
			{
				$vaules['joiningdate'] 		= 	date('m-d-Y',strtotime($value->joiningdate));
			}
			if('1970-01-01'==$value->releavingdate || $value->releavingdate=='')
			{
				$vaules['releavingdate'] 	= 	"-";
			}
			else
			{
				$vaules['releavingdate'] 	= 	date('m-d-Y',strtotime($value->releavingdate));
			}
			if ($value->active == 1) 
			{
              
			  $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active'] = $row;
			
			if ($value->dbentrystateID == 0) 
			{
				$vaules['state'] 			= 	'<span class="label bg-danger">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 1) 
			{
				$vaules['state'] 			= 	'<span class="label bg-warning">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 2) 
			{
				$vaules['state'] 			= 	'<span class="label bg-info">'.$value->sta_name.'</span>';
			}
			else
			{
				$vaules['state'] 			= 	'<span class="label bg-greensea">'.$value->sta_name.'</span>';
			}
			
			if($value->active==1)
			{
				if($j++>0)
				{
					if(checkpageaccess('employee',1,'approve'))
					{
						$Approve	=	approve_html("'".base_url()."manage/employee_mod_approve/".$value->emp_modID."','2'");
					}
					else
					{
						$Approve			 			= "";
						
					}
					
				}
				else
				{
					$Approve	=	'';
				}
				if(checkpageaccess('employee',1,'delete'))
				{
					$active	=	disable_approve_deactive_html("'".base_url()."manage/approve_employee/".$value->empID."/".$value->emp_modID."','0'");
				}
				else
				{
					$active	=	'';
				}
				
			}
			else
			{
				$Approve		=	'';
				if(checkpageaccess('employee',1,'delete'))
				{
					$active	=	enable_approve_deactive_html("'".base_url()."manage/approve_employee/".$value->empID."/".$value->emp_modID."','1'");
				}
				else
				{
					$active	=	'';
				}
				
			}
			if(checkpageaccess('employee',1,'modify'))
			{
				$edit	=	edit_html("approve_employee/".$value->empID.'/'.$value->emp_modID);
			}
			else
			{
				$edit	=	"";
			}
			$vaules['Action'] 			=	$Approve.$edit.$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	function employee_mod_approve()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('employee',1,'approve'))
		{
			redirect();
		}
		$mod_id	=	$this->uri->segment(3);
		$data	=	$this->Commonsql_model->select('tblemployee_mod',array('emp_modID'=>$mod_id));
		if($data->num_rows()>0)
		{
			$val	=	$data->row();
			
				$values=array('empCode'				=>	$val->empCode,
							'empname'					=>	$val->empname,
							'branchID'					=>	$val->branchID,
							
							'dob'						=>	$val->dob,
							'sex'						=>	$val->sex,
							'fathername'				=>	$val->fathername,
							
							'qualification'				=>	$val->qualification,
							'deptid'					=>	$val->deptid,
							'designation'				=>	$val->designation,
							
							'employeetype'				=>	$val->employeetype,
							'mobile'					=>	$val->mobile,
							'emergencycontactperson'	=>	$val->emergencycontactperson,
							
							'emergencycontact'			=>	$val->emergencycontact,
							'mailoffice'				=>	$val->mailoffice,
							'mailpersonal'				=>	$val->mailpersonal,
							
							'addressline1'				=>	$val->addressline1,
							'city'						=>	$val->city,
							'state'						=>	$val->state,
							
							'country'					=>	$val->country,
							'joiningdate'				=>	$val->joiningdate,
							'reportingto'				=>	$val->reportingto,
							
							'photo'						=>	$val->photo,
							'proof1'					=>	$val->proof1,
							'proof2'					=>	$val->proof2,
							
							'remarks'					=>	$val->remarks,
							'releavingdate'				=>	$val->releavingdate,
							'dbentrystateID'			=>	3,
							'approvedby'				=>	$this->session->userdata('SESS_userId'),
							'approvedon'				=>	date('Y-m-d h:i:s'));
								
							
				$cond		=	array('empID'	=>	$val->empID);
				
				$values_mod	=	array('dbentrystateID'	=>	3,
								'approvedby'			=>	$this->session->userdata('SESS_userId'),
								'approvedon'			=>	date('Y-m-d h:i:s'));
							
				$cond_mod	=	array('emp_modID'	=>	$mod_id);
				$upt		=	$this->Commonsql_model->updateTable('tblemployee', $cond , $values);
				$upt_m		=	$this->Commonsql_model->updateTable('tblemployee_mod', $cond_mod , $values_mod);
				//echo $this->db->last_query();exit;
				if($upt)
				{
					$this->session->set_userdata('suc','Approved Successfully  Finished...!');
					redirect('approve_employee/'.$val->empID);
					
				}
				else
				{
					$this->session->set_userdata('err','Error Please try again..!');
					redirect('approve_employee/'.$val->empID);
				}
							
							
						
		}
	}
	function profile_crop()
	{
		if($_POST)
		{
				$values =json_decode($this->input->post('putData'),true);
				$this->load->helper('path');
                $source_image = realpath(APPPATH . '../uploads/photo/baby.jpg' );
				//echo $source_image.'<br>';
                //crop it
                $data['x'] = $values['x'];
                $data['y'] = $values['y'];
                $data['w'] = $values['width'];
                $data['h'] = $values['height'];
                $this->load->library('image_lib');
                $config = array();
                $config['image_library'] = 'gd2';
                $config['source_image'] = $source_image; //full path for the source image
                $config['maintain_ratio'] = FALSE;
                $config['width'] = $data['w'];
                $config['height'] = $data['h'];
                $config['x_axis'] = $data['x'];
                $config['y_axis'] = $data['y'];
                //Initialize the new config
                $this->image_lib->initialize($config);
                //Rotate the image
                if (!$this->image_lib->crop()) 
				{
                    $this->session->set_userdata('err',$this->image_lib->display_errors());
					redirect('profile_crop');
                }
				else
				{
					$this->session->set_userdata('suc','Crop Successfully  Finished...!');
					redirect('profile_crop');
				}
				
               
		}
		$data['pageTitle']	=	"Profile Crop";
		$this->load->view('admin/employee/img_crop',$data);
	}
	/***********************************************************************************************************************************/
	function driver()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if($this->uri->segment(3))
		{
			$whereData	=	array('driverID'	=>	$this->uri->segment(3));
			$updateData	=	array('active'	=>	$this->uri->segment(4));
			$upt	=	$this->Commonsql_model->updateTable('tbldriver', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','driver Status Successfully  Changed...!');
				redirect('driver');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('driver');
			}
		}
		else
		{
			/*print_r($this->session->userdata('SESS_userRole'));
			$SESS_userRole = $this->session->userdata('SESS_userRole');
			$pageroleaccessmap = pageroleaccessmap($SESS_userRole, 'designation');
			print_r($pageroleaccessmap);
			exit();*/
			
			$data['pageTitle']	=	"driver";
			$data['table']		=	"driver";
			$this->load->view('admin/driver/driver',$data);
		}
	}
	function driver_json()
	{
		if (!$this->session->userdata('SESS_userId')) {return FALSE; }
		$result					=	$this->Commonsql_model->select_all_driver_state();
		$pagealterpermission 	=	pagealterpermission('driver', $alterPermission = '');
		//echo $this->db->last_query();exit;
		$output = array();$i=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$value->driverID;
			$vaules['name'] 			= 	$value->name;
			$vaules['addressline1'] 	= 	$value->addressline1;
			$vaules['phone1'] 			= 	$value->phone1;
			
			$vaules['dlno'] 			= 	$value->dlno;
			$vaules['dlexpirydt'] 		= 	date('m-d-Y',strtotime($value->dlexpirydt));
			
			if ($value->dbentrystateID == 0) 
			{
				$vaules['state'] 			= 	'<span class="label bg-danger">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 1) 
			{
				$vaules['state'] 			= 	'<span class="label bg-warning">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 2) 
			{
				$vaules['state'] 			= 	'<span class="label bg-info">'.$value->sta_name.'</span>';
			}
			else
			{
				$vaules['state'] 			= 	'<span class="label bg-greensea">'.$value->sta_name.'</span>';
			}
			if ($value->active == 1) 
			{
              
			  $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active'] = $row;
			
			if($value->active==1)
			{
				
				if(checkpageaccess('driver',1,'view'))
				{
					$view			 			=	view_html("view_driver/".$value->driverID);
				}
				else
				{
					$view			 			=	'';
				}
				if(selfAllowed($pagealterpermission, 'selfApprovalAllowed', $value->createby) && checkpageaccess('driver',1,'approve'))
				{
					$APPROVE			 			=	history_html("approve_driver/".$value->driverID);
				}
				else
				{
					$APPROVE			 			= "";
					
				}
				if(checkpageaccess('driver',1,'delete'))
				{
					$active	=	status_main_table($value->driverID,'driverID','driver','driver',1);
				}
				else
				{
					$active	=	'';
				}
			}
			else
			{
				$APPROVE		=	'';
				$view			 =	'';
				if(checkpageaccess('driver',1,'delete'))
				{
					$active	=	status_main_table($value->driverID,'driverID','driver','driver',0);
				}
				else
				{
					$active	=	'';
				}
				
			}
			if(selfAllowed($pagealterpermission, 'selfEditAllowed', $value->createby) && checkpageaccess('driver',1,'modify'))
			{
				$edit	=	edit_html("edit_driver/".$value->driverID);
			}
			else
			{
				$edit	=	"";
			}
				
			$vaules['Action'] 			=	$view.$edit.$APPROVE.$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	function add_driver()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('driver',1,'create'))
		{
			redirect();
		}
		if($_POST)
		{
			$this->form_validation->set_rules('dlno', 'Lisense No', 'trim|required');
			$this->form_validation->set_rules('sex', 'Gender', 'trim|required');
			/*contact details*/
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('companyName', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('addressline1', 'Address 1', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'state', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
            if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_userdata('err', validation_errors());
                redirect('add_driver');
            }
			$dlImage=$_FILES['dlImage']['name'];
			if($dlImage!='')
			{
				$uploadpath="./uploads/photo/".$dlImage;
				move_uploaded_file($_FILES['dlImage']['tmp_name'], $uploadpath);
			}
			else
			{
				$dlImage='';
			}
			
			$contact_values=array('name'		=>	$this->input->post('name'),
							'companyName'		=>	$this->input->post('companyName'),
							'addressline1'		=>	$this->input->post('addressline1'),
							'addressline2'		=>	$this->input->post('addressline2'),
							'city'				=>	$this->input->post('city'),
							'state'				=>	$this->input->post('state'),
							'country'			=>	$this->input->post('country'),
							'email1'			=>	$this->input->post('email1'),
							'email2'			=>	$this->input->post('email2'),
							'phone1'			=>	$this->input->post('phone1'),
							'phone2'			=>	$this->input->post('phone2'),
							'fax'				=>	$this->input->post('fax'),
							'website'			=>	$this->input->post('website'),
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$contactID	=	insertTable('tblcontactdetails', $contact_values,1,'driver');
			
			$values=array('contactID'					=>	$contactID,
							'sex'						=>	$this->input->post('sex'),
							'dlno'						=>	$this->input->post('dlno'),
							
							'dlexpirydt'				=>	date('Y-m-d',strtotime($this->input->post('dlexpirydt'))),
							'dlImage'					=>	$dlImage,
							
							'createby'					=>	$this->session->userdata('SESS_userId'),
							'active'					=>	1);
							
			$query	=	insertTable('tbldriver', $values,1,'driverID','driver');
			if($query)
			{
				$this->session->set_userdata('suc','Driver Successfully  Added...!');
				redirect('add_driver');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('add_driver');
			}
		}
		$data['pageTitle']	=	"Add driver";
		$this->load->view('admin/driver/add_driver',$data);
	}
	function edit_driver()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('driver',1,'modify'))
		{
			redirect();
		}
		if($_POST)
		{
			$this->form_validation->set_rules('dlno', 'Lisense No', 'trim|required');
			$this->form_validation->set_rules('sex', 'Gender', 'trim|required');
			/*contact details*/
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('companyName', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('addressline1', 'Address 1', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'state', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
            if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_userdata('err', validation_errors());
                redirect('edit_driver/'.$this->input->post('driverID'));
            }
			$dlImage=$_FILES['dlImage']['name'];
			if($dlImage!='')
			{
				$uploadpath="./uploads/photo/".$dlImage;
				move_uploaded_file($_FILES['dlImage']['tmp_name'], $uploadpath);
				
			}
			else
			{
				$dlImage	=	$this->input->post('dlImage1');
			}
			
			$contact_values=array('name'		=>	$this->input->post('name'),
							'companyName'		=>	$this->input->post('companyName'),
							'addressline1'		=>	$this->input->post('addressline1'),
							'addressline2'		=>	$this->input->post('addressline2'),
							'city'				=>	$this->input->post('city'),
							'state'				=>	$this->input->post('state'),
							'country'			=>	$this->input->post('country'),
							'email1'			=>	$this->input->post('email1'),
							'email2'			=>	$this->input->post('email2'),
							'phone1'			=>	$this->input->post('phone1'),
							'phone2'			=>	$this->input->post('phone2'),
							'fax'				=>	$this->input->post('fax'),
							'website'			=>	$this->input->post('website'),
							
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$whereData1	=	array('contactID'	=>	$this->input->post('contactID'));
			
			$query1		= updateTable('tblcontactdetails', $whereData1, $contact_values , 1,'contactID', $this->input->post('contactID'),'driver');
			
			$values_mod=array('contactID'				=>	$this->input->post('contactID'),
							'sex'						=>	$this->input->post('sex'),
							'dlno'						=>	$this->input->post('dlno'),
							
							'dlexpirydt'				=>	date('Y-m-d',strtotime($this->input->post('dlexpirydt'))),
							'dlImage'					=>	$dlImage,
							
							'createby'					=>	$this->session->userdata('SESS_userId'),
							'active'					=>	1);
							
							
			$whereData	=	array('driverID'	=>	$this->input->post('driverID'));
			
			$query		= updateTable('tbldriver', $whereData, $values_mod , 1,'driverID', $this->input->post('driverID'),'driver');
			
			if($query || $query1)
			{
				$this->session->set_userdata('suc','Driver Successfully  Updated...!');
				redirect('edit_driver/'.$this->input->post('driverID'));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('edit_driver/'.$this->input->post('driverID'));
			}
		}
		$data['pageTitle']	=	"Edit driver";
		$data['view']		=	$this->Commonsql_model->select_driver_edit($this->uri->segment(2));
		$this->load->view('admin/driver/edit_driver',$data);
	}
	function view_driver()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('driver',1,'view'))
		{
			redirect();
		}
		$data['pageTitle']	=	"View driver";
		$data['view']		=	$this->Commonsql_model->select_driver_edit($this->uri->segment(2));
		$this->load->view('admin/driver/view_driver',$data);
	}
	function approve_driver()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('driver',1,'approve'))
		{
			redirect();
		}
		if($_POST)
		{
			$this->form_validation->set_rules('dlno', 'Lisense No', 'trim|required');
			$this->form_validation->set_rules('sex', 'Gender', 'trim|required');
			/*contact details*/
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('companyName', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('addressline1', 'Address 1', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'state', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
            if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_userdata('err', validation_errors());
                redirect('approve_driver/'.$this->input->post('driverID'));
            }
			$dlImage=$_FILES['dlImage']['name'];
			if($dlImage!='')
			{
				$uploadpath="./uploads/photo/".$dlImage;
				move_uploaded_file($_FILES['dlImage']['tmp_name'], $uploadpath);
			}
			else
			{
				$dlImage	=	$this->input->post('dlImage1');
			}
			
			$contact_values=array('name'		=>	$this->input->post('name'),
							'companyName'		=>	$this->input->post('companyName'),
							'addressline1'		=>	$this->input->post('addressline1'),
							'addressline2'		=>	$this->input->post('addressline2'),
							'city'				=>	$this->input->post('city'),
							'state'				=>	$this->input->post('state'),
							'country'			=>	$this->input->post('country'),
							'email1'			=>	$this->input->post('email1'),
							'email2'			=>	$this->input->post('email2'),
							'phone1'			=>	$this->input->post('phone1'),
							'phone2'			=>	$this->input->post('phone2'),
							'fax'				=>	$this->input->post('fax'),
							'website'			=>	$this->input->post('website'),
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$whereData1	=	array('contactID'	=>	$this->input->post('contactID'));
			
			$query1		= updateTable('tblcontactdetails', $whereData1, $contact_values , 1,'contactID', $this->input->post('contactID'),'driver');
			
			$values_mod=array('contactID'				=>	$this->input->post('contactID'),
							'sex'						=>	$this->input->post('sex'),
							'dlno'						=>	$this->input->post('dlno'),
							
							'dlexpirydt'				=>	date('Y-m-d',strtotime($this->input->post('dlexpirydt'))),
							'dlImage'					=>	$dlImage,
							
							'createby'					=>	$this->session->userdata('SESS_userId'),
							'active'					=>	1);
							
							
			$whereData	=	array('driverID'	=>	$this->input->post('driverID'));
			
			$query		= updateTable('tbldriver', $whereData, $values_mod , 1,'driverID', $this->input->post('driverID'),'driver');
			
			if($query || $query1)
			{
				$this->session->set_userdata('suc','driver Successfully  Updated...!');
				redirect('approve_driver/'.$this->input->post('driverID'));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('approve_driver/'.$this->input->post('driverID'));
			}
		}
		if($this->uri->segment(4))
		{
			$whereData	=	array('driver_modID'	=>	$this->uri->segment(4));
			$updateData	=	array('active'	=>	$this->uri->segment(5));
			$upt	=	$this->Commonsql_model->updateTable('tbldriver_mod', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','driver Status Successfully  Changed...!');
				redirect('approve_driver/'.$this->uri->segment(3));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('approve_driver/'.$this->uri->segment(3));
			}
		}
		else if($this->uri->segment(3))
		{
			$data['pageTitle']	=	"View driver";
			$data['table']		=	"Designation";
			$data['view']		=	$this->Commonsql_model->select_all_driver_mod_where($this->uri->segment(3));
			$this->load->view('admin/driver/approve_driver',$data);
		}
		else
		{
			$data['pageTitle']	=	"View driver";
			$data['table']		=	"driver";
			$data['view']		=	$this->Commonsql_model->select_driver_edit($this->uri->segment(2));
			$this->load->view('admin/driver/approve_driver',$data);
		}
	}
	function approve_driver_json()
	{
		if (!$this->session->userdata('SESS_userId')) {return FALSE; }
		$result	=	$this->Commonsql_model->select_all_driver_mod_state($this->uri->segment(3));
		//echo $this->db->last_query();
		$output = array();$i=1;$j=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$value->driver_modID;
			$vaules['name'] 			= 	$value->name;
			$vaules['addressline1'] 	= 	$value->addressline1;
			$vaules['phone1'] 			= 	$value->phone1;
			
			$vaules['dlno'] 			= 	$value->dlno;
			$vaules['dlexpirydt'] 		= 	date('m-d-Y',strtotime($value->dlexpirydt));
			
			$vaules['upt_date'] =	date('d-m-Y',strtotime($value->createdon));
			$vaules['upt_by'] 	=	$value->empname;
			
			if ($value->dbentrystateID == 0) 
			{
				$vaules['state'] 			= 	'<span class="label bg-danger">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 1) 
			{
				$vaules['state'] 			= 	'<span class="label bg-warning">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 2) 
			{
				$vaules['state'] 			= 	'<span class="label bg-info">'.$value->sta_name.'</span>';
			}
			else
			{
				$vaules['state'] 			= 	'<span class="label bg-greensea">'.$value->sta_name.'</span>';
			}
			if ($value->active == 1) 
			{
              
			  $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active'] = $row;
			
			if($value->active==1)
			{
				if($j>0)
				{
					if(checkpageaccess('driver',1,'approve'))
					{
						$Approve	=	approve_html("'".base_url()."manage/driver_mod_approve/".$value->driver_modID."','2'");
					}
					else
					{
						$Approve			 			= "";
						
					}
					
				}
				else
				{
					$Approve	=	'';
				}
				if(checkpageaccess('driver',1,'delete'))
				{
					$active	=	disable_approve_deactive_html("'".base_url()."manage/approve_driver/".$value->driverID."/".$value->driver_modID."','0'");
				}
				else
				{
					$active	=	'';
				}
				
			}
			else
			{
				$Approve		=	'';
				if(checkpageaccess('driver',1,'delete'))
				{
					$active	=	enable_approve_deactive_html("'".base_url()."manage/approve_driver/".$value->driverID."/".$value->driver_modID."','1'");
				}
				else
				{
					$active	=	'';
				}
				
			}
			if(checkpageaccess('driver',1,'modify'))
			{
				$edit	=	edit_html("approve_driver/".$value->driverID.'/'.$value->driver_modID);
			}
			else
			{
				$edit	=	"";
			}
			$vaules['Action'] 			=	$Approve.$edit.$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	function driver_mod_approve()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('driver',1,'approve'))
		{
			redirect();
		}
		$mod_id	=	$this->uri->segment(3);
		$data	=	$this->Commonsql_model->select('tbldriver_mod',array('driver_modID'=>$mod_id));
		if($data->num_rows()>0)
		{
			$val	=	$data->row();
			
				$values=array('empCode'				=>	$val->empCode,
							'empname'					=>	$val->empname,
							'branchID'					=>	$val->branchID,
							
							'dob'						=>	$val->dob,
							'sex'						=>	$val->sex,
							'fathername'				=>	$val->fathername,
							
							'qualification'				=>	$val->qualification,
							'deptid'					=>	$val->deptid,
							'designation'				=>	$val->designation,
							
							'employeetype'				=>	$val->employeetype,
							'mobile'					=>	$val->mobile,
							'emergencycontactperson'	=>	$val->emergencycontactperson,
							
							'emergencycontact'			=>	$val->emergencycontact,
							'mailoffice'				=>	$val->mailoffice,
							'mailpersonal'				=>	$val->mailpersonal,
							
							'addressline1'				=>	$val->addressline1,
							'city'						=>	$val->city,
							'state'						=>	$val->state,
							
							'country'					=>	$val->country,
							'joiningdate'				=>	$val->joiningdate,
							'reportingto'				=>	$val->reportingto,
							
							'photo'						=>	$val->photo,
							'proof1'					=>	$val->proof1,
							'proof2'					=>	$val->proof2,
							
							'remarks'					=>	$val->remarks,
							'releavingdate'				=>	$val->releavingdate,
							'dbentrystateID'			=>	3,
							'approvedby'				=>	$this->session->userdata('SESS_userId'),
							'approvedon'				=>	date('Y-m-d h:i:s'));
								
							
				$cond		=	array('driverID'	=>	$val->driverID);
				
				$values_mod	=	array('dbentrystateID'	=>	3,
								'approvedby'			=>	$this->session->userdata('SESS_userId'),
								'approvedon'			=>	date('Y-m-d h:i:s'));
							
				$cond_mod	=	array('driver_modID'	=>	$mod_id);
				$upt		=	$this->Commonsql_model->updateTable('tbldriver', $cond , $values);
				$upt_m		=	$this->Commonsql_model->updateTable('tbldriver_mod', $cond_mod , $values_mod);
				//echo $this->db->last_query();exit;
				if($upt)
				{
					$this->session->set_userdata('suc','Approved Successfully  Finished...!');
					redirect('approve_driver/'.$val->driverID);
					
				}
				else
				{
					$this->session->set_userdata('err','Error Please try again..!');
					redirect('approve_driver/'.$val->driverID);
				}
							
							
						
		}
	}
	/***********************************************************************************************************************************/
	function vehicleowner()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if($this->uri->segment(3))
		{
			$whereData	=	array('ownerID'	=>	$this->uri->segment(3));
			$updateData	=	array('active'	=>	$this->uri->segment(4));
			$upt	=	$this->Commonsql_model->updateTable('tblvehicleowner', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','Designation Status Successfully  Changed...!');
				redirect('vehicleowner');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('vehicleowner');
			}
		}
		else
		{
			$data['pageTitle']	=	"Designation";
			$data['table']		=	"Designation";
			$this->load->view('admin/vehicleowner/vehicleowner',$data);
		}
	}
	function vehicleowner_json()
	{
		if (!$this->session->userdata('SESS_userId')) {return FALSE; }
		$result					=	$this->Commonsql_model->select_all_vowner_state();
		$pagealterpermission	=	pagealterpermission('vehicleowner', $alterPermission = '');
		//echo $this->db->last_query();exit;
		$output = array();$i=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$value->ownerID;
			$vaules['name'] 			= 	$value->contactPer1;
			$vaules['companyName'] 		= 	$value->companyName;
			$vaules['phone1'] 			= 	$value->phone1;
			if ($value->dbentrystateID == 0) 
			{
				$vaules['state'] 			= 	'<span class="label bg-danger">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 1) 
			{
				$vaules['state'] 			= 	'<span class="label bg-warning">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 2) 
			{
				$vaules['state'] 			= 	'<span class="label bg-info">'.$value->sta_name.'</span>';
			}
			else
			{
				$vaules['state'] 			= 	'<span class="label bg-greensea">'.$value->sta_name.'</span>';
			}
			if ($value->active == 1) 
			{
              
			  $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active'] = $row;
			
			if($value->active==1)
			{
				if(checkpageaccess('vehicleowner',1,'view'))
				{
					$view			 			=	view_html("view_vehicleowner/".$value->ownerID);
				}
				else
				{
					$view			 			=	'';
				}
				if(selfAllowed($pagealterpermission, 'selfApprovalAllowed', $value->createby) && checkpageaccess('vehicleowner',1,'approve'))
				{
					$APPROVE			 			=	history_html("approve_vehicleowner/".$value->ownerID);
				}
				else
				{
					$APPROVE			 			= "";
					
				}
				if(selfAllowed($pagealterpermission, 'selfEditAllowed', $value->createby) && checkpageaccess('vehicleowner',1,'delete'))
				{
					$active	=	status_main_table($value->ownerID,'ownerID','vehicleowner','vehicleowner',1);
				}
				else
				{
					$active	=	'';
				}
			}
			else
			{
				$APPROVE		=	'';
				$view		=	'';
				if(selfAllowed($pagealterpermission, 'selfEditAllowed', $value->createby) && checkpageaccess('vehicleowner',1,'delete'))
				{
					$active	=	status_main_table($value->ownerID,'ownerID','vehicleowner','vehicleowner',0);
				}
				else
				{
					$active	=	'';
				}
				
			}
			if(checkpageaccess('vehicleowner',1,'modify'))
			{
				$edit	=	edit_html("edit_vehicleowner/".$value->ownerID);
			}
			else
			{
				$edit	=	"";
			}
				
			$vaules['Action'] 			=	$view.$edit.$APPROVE.$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	function add_vehicleowner()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('vehicleowner',1,'create'))
		{
			redirect();
		}
		if($_POST)
		{
			/*contact details*/
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('companyName', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('addressline1', 'Address 1', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'state', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
            if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_userdata('err', validation_errors());
                redirect('add_vehicleowner');
            }
			//echo "hi";exit;
			$contact_values=array('name'		=>	$this->input->post('name'),
								'companyName'		=>	$this->input->post('companyName'),
								'addressline1'		=>	$this->input->post('addressline1'),
								'addressline2'		=>	$this->input->post('addressline2'),
								'city'				=>	$this->input->post('city'),
								'state'				=>	$this->input->post('state'),
								'country'			=>	$this->input->post('country'),
								'email1'			=>	$this->input->post('email1'),
								'email2'			=>	$this->input->post('email2'),
								'phone1'			=>	$this->input->post('phone1'),
								'phone2'			=>	$this->input->post('phone2'),
								'fax'				=>	$this->input->post('fax'),
								'website'			=>	$this->input->post('website'),
								
								'createby'			=>	$this->session->userdata('SESS_userId'),
								'active'			=>	1);
								
				$contactID	=	insertTable('tblcontactdetails', $contact_values,1,'vehicleowner');
				
			$values=array('contactID'				=>	$contactID,
							'contactPer1'		=>	$this->input->post('name'),
							'contactPer2'		=>	$this->input->post('contactPer2'),
							
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$query	=	insertTable('tblvehicleowner', $values,1,'vehicleowner');
			if($query)
			{
				$this->session->set_userdata('suc','Vehicle Owner Successfully  Added...!');
				redirect('manage/add_vehicleowner');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('manage/add_vehicleowner');
			}
		}
		$data['pageTitle']	=	"Add Designation";
		$this->load->view('admin/vehicleowner/add_vehicleowner',$data);
	}
	function edit_vehicleowner()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('vehicleowner',1,'modify'))
		{
			redirect();
		}
		if($_POST)
		{
			/*contact details*/
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('companyName', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('addressline1', 'Address 1', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'state', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
            if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_userdata('err', validation_errors());
                redirect('edit_vehicleowner/'.$this->input->post('ownerID'));
            }
				$contact_values=array('name'		=>	$this->input->post('name'),
								'companyName'		=>	$this->input->post('companyName'),
								'addressline1'		=>	$this->input->post('addressline1'),
								'addressline2'		=>	$this->input->post('addressline2'),
								'city'				=>	$this->input->post('city'),
								'state'				=>	$this->input->post('state'),
								'country'			=>	$this->input->post('country'),
								'email1'			=>	$this->input->post('email1'),
								'email2'			=>	$this->input->post('email2'),
								'phone1'			=>	$this->input->post('phone1'),
								'phone2'			=>	$this->input->post('phone2'),
								'fax'				=>	$this->input->post('fax'),
								'website'			=>	$this->input->post('website'),
								
								'createby'			=>	$this->session->userdata('SESS_userId'),
								'active'			=>	1);
								
				$contactID_whereData	=	array('contactID'	=>	$this->input->post('contactID'));
			$query1		= updateTable('tblcontactdetails', $contactID_whereData, $contact_values , 1,'contactID', $this->input->post('contactID'),'vehicleowner');
				
			$values=array('contactID'			=>	$this->input->post('contactID'),
							'contactPer1'		=>	$this->input->post('name'),
							'contactPer2'		=>	$this->input->post('contactPer2'),
							
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
							
			$whereData	=	array('ownerID'	=>	$this->input->post('ownerID'));
			$query		= updateTable('tblvehicleowner', $whereData, $values , 1,'ownerID', $this->input->post('ownerID'),'vehicleowner');
			if($query || $query1)
			{
				$this->session->set_userdata('suc','Vehicle Owner Successfully  Updated...!');
				redirect('edit_vehicleowner/'.$this->input->post('ownerID'));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('edit_vehicleowner/'.$this->input->post('ownerID'));
			}
		}
		$data['pageTitle']	=	"Edit Designation";
		$data['view']		=	$this->Commonsql_model->select_all_vowner_edit($this->uri->segment(2));
		$this->load->view('admin/vehicleowner/edit_vehicleowner',$data);
	}
	function view_vehicleowner()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('vehicleowner',1,'view'))
		{
			redirect();
		}
		$data['pageTitle']	=	"View Designation";
		$data['view']		=	$this->Commonsql_model->select_all_vowner_edit($this->uri->segment(2));
		$this->load->view('admin/vehicleowner/view_vehicleowner',$data);
	}
	function approve_vehicleowner()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('vehicleowner',1,'approve'))
		{
			redirect();
		}
		if($_POST)
		{
			/*contact details*/
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('companyName', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('addressline1', 'Address 1', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'state', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
            if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_userdata('err', validation_errors());
                redirect('approve_vehicleowner/'.$this->input->post('ownerID'));
            }
			
				$contact_values=array('name'		=>	$this->input->post('name'),
								'companyName'		=>	$this->input->post('companyName'),
								'addressline1'		=>	$this->input->post('addressline1'),
								'addressline2'		=>	$this->input->post('addressline2'),
								'city'				=>	$this->input->post('city'),
								'state'				=>	$this->input->post('state'),
								'country'			=>	$this->input->post('country'),
								'email1'			=>	$this->input->post('emailss'),
								'email2'			=>	$this->input->post('email2'),
								'phone1'			=>	$this->input->post('phone1'),
								'phone2'			=>	$this->input->post('phone2'),
								'fax'				=>	$this->input->post('fax'),
								'website'			=>	$this->input->post('website'),
								
								'createby'			=>	$this->session->userdata('SESS_userId'),
								'active'			=>	1);
								
								
				$contactID_whereData	=	array('contactID'	=>	$this->input->post('contactID'));
			$query1		= updateTable('tblcontactdetails', $contactID_whereData, $contact_values , 1,'contactID', $this->input->post('contactID'),'vehicleowner');
			//echo $this->db->last_query();exit;
				
			$values=array('contactID'			=>	$this->input->post('contactID'),
							'contactPer1'		=>	$this->input->post('name'),
							'contactPer2'		=>	$this->input->post('contactPer2'),
							
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
							
				$whereData	=	array('ownerID'	=>	$this->input->post('ownerID'));
				$query		= updateTable('tblvehicleowner', $whereData, $values , 1,'ownerID', $this->input->post('ownerID'),'vehicleowner');
			
				
				if($query || $query1)
				{
					$this->session->set_userdata('suc','vehicleowner Successfully  Updated...!');
					redirect('approve_vehicleowner/'.$this->input->post('ownerID'));
					
				}
				else
				{
					$this->session->set_userdata('err','Error Please try again..!');
					redirect('approve_vehicleowner/'.$this->input->post('ownerID'));
				}
			
		}
		if($this->uri->segment(4))
		{
			$whereData	=	array('owner_modID'	=>	$this->uri->segment(4));
			$updateData	=	array('active'	=>	$this->uri->segment(5));
			$upt	=	$this->Commonsql_model->updateTable('tblvehicleowner_mod', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','Designation Status Successfully  Changed...!');
				redirect('approve_vehicleowner/'.$this->uri->segment(3));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('approve_vehicleowner/'.$this->uri->segment(3));
			}
		}
		else if($this->uri->segment(3))
		{
			$data['pageTitle']	=	"View vehicleowner";
			$data['table']		=	"Designation";
			$data['view']		=	$this->Commonsql_model->select_all_vowner_mod($this->uri->segment(3));
			$this->load->view('admin/vehicleowner/approve_vehicleowner',$data);
		}
		else
		{
			$data['pageTitle']	=	"View vehicleowner";
			$data['table']		=	"Designation";
			$data['view']		=	$this->Commonsql_model->select_all_vowner_edit($this->uri->segment(2));
			$this->load->view('admin/vehicleowner/approve_vehicleowner',$data);
		}
	}
	function approve_vehicleowner_json()
	{
		if (!$this->session->userdata('SESS_userId')) {return FALSE; }
		$result	=	$this->Commonsql_model->select_all_vowner_mod_state($this->uri->segment(3));
		//echo $this->db->last_query();exit;
		$output = array();$i=1;$j=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$value->owner_modID;
			$vaules['name'] 			= 	$value->name;
			$vaules['companyName'] 		= 	$value->companyName;
			$vaules['phone1'] 			= 	$value->phone1;
			if ($value->dbentrystateID == 0) 
			{
				$vaules['state'] 			= 	'<span class="label bg-danger">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 1) 
			{
				$vaules['state'] 			= 	'<span class="label bg-warning">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 2) 
			{
				$vaules['state'] 			= 	'<span class="label bg-info">'.$value->sta_name.'</span>';
			}
			else
			{
				$vaules['state'] 			= 	'<span class="label bg-greensea">'.$value->sta_name.'</span>';
			}
			if ($value->active == 1) 
			{
              
			  $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active'] = $row;
			
			if($value->active==1)
			{
				if($j++>0)
				{
					if(checkpageaccess('vehicleowner',1,'approve'))
					{
						$Approve	=	approve_html("'".base_url()."manage/vehicleowner_mod_approve/".$value->owner_modID."','2'");
					}
					else
					{
						$Approve			 			= "";
						
					}
					
				}
				else
				{
					$Approve	=	'';
				}
				if(checkpageaccess('vehicleowner',1,'delete'))
				{
					$active	=	disable_approve_deactive_html("'".base_url()."manage/approve_vehicleowner/".$value->ownerID."/".$value->owner_modID."','0'");
				}
				else
				{
					$active	=	'';
				}
				
			}
			else
			{
				$Approve		=	'';
				if(checkpageaccess('vehicleowner',1,'delete'))
				{
					$active	=	enable_approve_deactive_html("'".base_url()."manage/approve_vehicleowner/".$value->ownerID."/".$value->owner_modID."','1'");
				}
				else
				{
					$active	=	'';
				}
				
			}
			
			if(checkpageaccess('vehicleowner',1,'modify'))
			{
				$edit	=	edit_html("approve_vehicleowner/".$value->ownerID.'/'.$value->owner_modID);
			}
			else
			{
				$edit	=	"";
			}
				
			$vaules['Action'] 			=	$Approve.$edit.$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	function vehicleowner_mod_approve()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('vehicleowner',1,'approve'))
		{
			redirect();
		}
		$mod_id	=	$this->uri->segment(3);
		$data	=	$this->Commonsql_model->select('tblvehicleowner_mod',array('owner_modID'=>$mod_id));
		if($data->num_rows()>0)
		{
			$val	=	$data->row();
			
				
				$values=array('contactID'		=>	$val->contactID,
							'contactPer1'		=>	$val->contactPer1,
							'contactPer2'		=>	$val->contactPer2,
							
							'dbentrystateID'			=>	3,
							'approvedby'				=>	$this->session->userdata('SESS_userId'),
							'approvedon'				=>	date('Y-m-d h:i:s'));
								
							
				$cond		=	array('ownerID'	=>	$val->ownerID);
				
				$values_mod	=	array('dbentrystateID'	=>	3,
								'approvedby'			=>	$this->session->userdata('SESS_userId'),
								'approvedon'			=>	date('Y-m-d h:i:s'));
							
				$cond_mod	=	array('owner_modID'	=>	$mod_id);
				$upt		=	$this->Commonsql_model->updateTable('tblvehicleowner', $cond , $values);
				$upt_m		=	$this->Commonsql_model->updateTable('tblvehicleowner_mod', $cond_mod , $values_mod);
				//echo $this->db->last_query();exit;
				if($upt)
				{
					$this->session->set_userdata('suc','Approved Successfully  Finished...!');
					redirect('approve_vehicleowner/'.$val->ownerID);
					
				}
				else
				{
					$this->session->set_userdata('err','Error Please try again..!');
					redirect('approve_vehicleowner/'.$val->ownerID);
				}
			}
	}
	/***********************************************************************************************************************************/
	function vehicle()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if($this->uri->segment(3))
		{
			$whereData	=	array('ownerID'	=>	$this->uri->segment(3));
			$updateData	=	array('active'	=>	$this->uri->segment(4));
			$upt	=	$this->Commonsql_model->updateTable('tblvehicleowner', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','Designation Status Successfully  Changed...!');
				redirect('vehicle');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('vehicle');
			}
		}
		else
		{
			$data['pageTitle']	=	"Designation";
			$data['table']		=	"Designation";
			$this->load->view('admin/vehicle/vehicle',$data);
		}
	}
	function vehicle_json()
	{
		if (!$this->session->userdata('SESS_userId')) {return FALSE; }
		$result					=	$this->Commonsql_model->select_all_vehicle_state();
		$pagealterpermission	=	pagealterpermission('vehicle', $alterPermission = '');
		//echo $this->db->last_query();exit;
		$output = array();$i=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$value->vehicleID;
			$vaules['vehno'] 			= 	$value->vehno;
			$vaules['name'] 			= 	$value->contactPer1;
			$vaules['companyName'] 		= 	$value->companyName;
			$vaules['phone1'] 			= 	$value->phone1;
			if ($value->dbentrystateID == 0) 
			{
				$vaules['state'] 			= 	'<span class="label bg-danger">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 1) 
			{
				$vaules['state'] 			= 	'<span class="label bg-warning">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 2) 
			{
				$vaules['state'] 			= 	'<span class="label bg-info">'.$value->sta_name.'</span>';
			}
			else
			{
				$vaules['state'] 			= 	'<span class="label bg-greensea">'.$value->sta_name.'</span>';
			}
			if ($value->active == 1) 
			{
              
			  $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active'] = $row;
			
			if($value->active==1)
			{
				if(checkpageaccess('vehicleowner',1,'view'))
				{
					$view			 			=	view_html("view_vehicle/".$value->vehicleID);
				}
				else
				{
					$view			 			=	'';
				}
				if(selfAllowed($pagealterpermission, 'selfApprovalAllowed', $value->createby) && checkpageaccess('vehicle',1,'approve'))
				{
					$APPROVE			 			=	history_html("approve_vehicle/".$value->vehicleID);
				}
				else
				{
					$APPROVE			 			= "";
					
				}
				if(selfAllowed($pagealterpermission, 'selfEditAllowed', $value->createby) && checkpageaccess('vehicle',1,'delete'))
				{
					$active	=	status_main_table($value->ownerID,'ownerID','vehicleowner','vehicle',1);
				}
				else
				{
					$active	=	'';
				}
			}
			else
			{
				$APPROVE		=	'';
				$view		=	'';
				if(selfAllowed($pagealterpermission, 'selfEditAllowed', $value->createby) && checkpageaccess('vehicle',1,'delete'))
				{
					$active	=	status_main_table($value->ownerID,'ownerID','vehicleowner','vehicle',0);
				}
				else
				{
					$active	=	'';
				}
				
			}
			if(checkpageaccess('vehicle',1,'modify'))
			{
				$edit	=	edit_html("edit_vehicle/".$value->vehicleID);
			}
			else
			{
				$edit	=	"";
			}
				
			$vaules['Action'] 			=	$view.$edit.$APPROVE.$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	function add_vehicle()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('vehicle',1,'create'))
		{
			redirect();
		}
		if($_POST)
		{
			/*contact details*/
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('companyName', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('addressline1', 'Address 1', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'state', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
			$this->form_validation->set_rules('vehno', 'Vehicle number', 'trim|required');
			$this->form_validation->set_rules('vehmake', 'Vehicle make', 'trim|required');
			$this->form_validation->set_rules('roadpermitno', 'Road permit number', 'trim|required');
			$this->form_validation->set_rules('validity', 'Validity', 'trim|required');
			$this->form_validation->set_rules('insurancepolicydtls', 'Insurance policy details', 'trim|required');
            if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_userdata('err', validation_errors());
                redirect('add_vehicle');
            }
			//echo "hi";exit;
			if (is_numeric($this->input->post('name'))) 
			{
				$ownerid	=	$this->input->post('name');
			}
			else
			{
				$contact_values=array('name'		=>	$this->input->post('name'),
									'companyName'		=>	$this->input->post('companyName'),
									'addressline1'		=>	$this->input->post('addressline1'),
									'addressline2'		=>	$this->input->post('addressline2'),
									'city'				=>	$this->input->post('city'),
									'state'				=>	$this->input->post('state'),
									'country'			=>	$this->input->post('country'),
									'email1'			=>	$this->input->post('email1'),
									'email2'			=>	$this->input->post('email2'),
									'phone1'			=>	$this->input->post('phone1'),
									'phone2'			=>	$this->input->post('phone2'),
									'fax'				=>	$this->input->post('fax'),
									'website'			=>	$this->input->post('website'),
									
									'createby'			=>	$this->session->userdata('SESS_userId'),
									'active'			=>	1);
									
					$contactID	=	insertTable('tblcontactdetails', $contact_values,1,'vehicle');
					
				$values=array('contactID'				=>	$contactID,
								'contactPer1'		=>	$this->input->post('name'),
								'contactPer2'		=>	$this->input->post('contactPer2'),
								
								'createby'			=>	$this->session->userdata('SESS_userId'),
								'active'			=>	1);
								
				$ownerid	=	insertTable('tblvehicleowner', $values,1,'vehicle');
			}
			
				$vehicle_values	=	array('vehno'					=>	$this->input->post('vehno'),
											'vehmake'				=>	$this->input->post('vehmake'),
											'roadpermitno'			=>	$this->input->post('roadpermitno'),
											'validity'				=>	date('Y-m-d',strtotime($this->input->post('validity'))),
											'insurancepolicydtls'	=>	$this->input->post('insurancepolicydtls'),
											'ownerid'				=>	$ownerid,
											
											'createby'				=>	$this->session->userdata('SESS_userId'),
											'active'				=>	1
											);
				$query	=	insertTable('tblvehicle', $vehicle_values,1,'vehicle');
			if($query)
			{
				$this->session->set_userdata('suc','Vehicle  Successfully  Added...!');
				redirect('manage/add_vehicle');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('manage/add_vehicle');
			}
		}
		$data['pageTitle']	=	"Add vehicle";
		$data['view']		=	$this->Commonsql_model->select_exist_vehicle();
		$this->load->view('admin/vehicle/add_vehicle',$data);
	}
	function vehicle_details()
	{
		$data['view'] 	=	$this->Commonsql_model->select('tblcontactdetails',array('companyName'	=>	$this->input->post('name')));
		$this->load->View('admin/vehicle/vehicle_details',$data);
	}
	function edit_vehicle()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('vehicle',1,'modify'))
		{
			redirect();
		}
		if($_POST)
		{
			/*contact details*/
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('companyName', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('addressline1', 'Address 1', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'state', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
			
			$this->form_validation->set_rules('vehno', 'Vehicle number', 'trim|required');
			$this->form_validation->set_rules('vehmake', 'Vehicle make', 'trim|required');
			$this->form_validation->set_rules('roadpermitno', 'Road permit number', 'trim|required');
			$this->form_validation->set_rules('validity', 'Validity', 'trim|required');
			$this->form_validation->set_rules('insurancepolicydtls', 'Insurance policy details', 'trim|required');
            if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_userdata('err', validation_errors());
                redirect('edit_vehicle/'.$this->input->post('vehicleID'));
            }
				$contact_values=array('name'		=>	$this->input->post('name'),
								'companyName'		=>	$this->input->post('companyName'),
								'addressline1'		=>	$this->input->post('addressline1'),
								'addressline2'		=>	$this->input->post('addressline2'),
								'city'				=>	$this->input->post('city'),
								'state'				=>	$this->input->post('state'),
								'country'			=>	$this->input->post('country'),
								'email1'			=>	$this->input->post('email1'),
								'email2'			=>	$this->input->post('email2'),
								'phone1'			=>	$this->input->post('phone1'),
								'phone2'			=>	$this->input->post('phone2'),
								'fax'				=>	$this->input->post('fax'),
								'website'			=>	$this->input->post('website'),
								
								'createby'			=>	$this->session->userdata('SESS_userId'),
								'active'			=>	1);
								
				$contactID_whereData	=	array('contactID'	=>	$this->input->post('contactID'));
			$query1		= updateTable('tblcontactdetails', $contactID_whereData, $contact_values , 1,'contactID', $this->input->post('contactID'),'vehicle');
				
			$values=array('contactID'			=>	$this->input->post('contactID'),
							'contactPer1'		=>	$this->input->post('name'),
							'contactPer2'		=>	$this->input->post('contactPer2'),
							
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
							
			$whereData	=	array('ownerID'	=>	$this->input->post('ownerID'));
			$query		= updateTable('tblvehicleowner', $whereData, $values , 1,'ownerID', $this->input->post('ownerID'),'vehicle');
			
			$vehicle_values	=	array('vehno'						=>	$this->input->post('vehno'),
											'vehmake'				=>	$this->input->post('vehmake'),
											'roadpermitno'			=>	$this->input->post('roadpermitno'),
											'validity'				=>	date('Y-m-d',strtotime($this->input->post('validity'))),
											'insurancepolicydtls'	=>	$this->input->post('insurancepolicydtls'),
											'ownerid'				=>	$this->input->post('ownerID'),
											
											'createby'				=>	$this->session->userdata('SESS_userId'),
											'active'				=>	1
											);
				$whereData1	=	array('vehicleID'	=>	$this->input->post('vehicleID'));
				$query2	=	updateTable('tblvehicle',$whereData1, $vehicle_values,1,'vehicleID',$this->input->post('vehicleID'),'vehicle');
				
				
			if($query || $query1 || $query2)
			{
				$this->session->set_userdata('suc','Vehicle  Successfully  Updated...!');
				redirect('edit_vehicle/'.$this->input->post('vehicleID'));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('edit_vehicle/'.$this->input->post('vehicleID'));
			}
		}
		$data['pageTitle']	=	"Edit Designation";
		$data['view']		=	$this->Commonsql_model->select_all_vehicle_edit($this->uri->segment(2));
		$data['compa']		=	$this->Commonsql_model->select_exist_vehicle();
		$this->load->view('admin/vehicle/edit_vehicle',$data);
	}
	function view_vehicle()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('vehicle',1,'view'))
		{
			redirect();
		}
		$data['pageTitle']	=	"View Designation";
		$data['view']		=	$this->Commonsql_model->select_all_vowner_edit($this->uri->segment(2));
		$this->load->view('admin/vehicle/view_vehicle',$data);
	}
	function approve_vehicle()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('vehicle',1,'approve'))
		{
			redirect();
		}
		if($_POST)
		{
			/*contact details*/
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('companyName', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('addressline1', 'Address 1', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'state', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
			$this->form_validation->set_rules('vehno', 'Vehicle number', 'trim|required');
			$this->form_validation->set_rules('vehmake', 'Vehicle make', 'trim|required');
			$this->form_validation->set_rules('roadpermitno', 'Road permit number', 'trim|required');
			$this->form_validation->set_rules('validity', 'Validity', 'trim|required');
			$this->form_validation->set_rules('insurancepolicydtls', 'Insurance policy details', 'trim|required');
            if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_userdata('err', validation_errors());
                redirect('approve_vehicle/'.$this->input->post('ownerID'));
            }
			
				$contact_values=array('name'		=>	$this->input->post('name'),
								'companyName'		=>	$this->input->post('companyName'),
								'addressline1'		=>	$this->input->post('addressline1'),
								'addressline2'		=>	$this->input->post('addressline2'),
								'city'				=>	$this->input->post('city'),
								'state'				=>	$this->input->post('state'),
								'country'			=>	$this->input->post('country'),
								'email1'			=>	$this->input->post('emailss'),
								'email2'			=>	$this->input->post('email2'),
								'phone1'			=>	$this->input->post('phone1'),
								'phone2'			=>	$this->input->post('phone2'),
								'fax'				=>	$this->input->post('fax'),
								'website'			=>	$this->input->post('website'),
								
								'createby'			=>	$this->session->userdata('SESS_userId'),
								'active'			=>	1);
								
								
				$contactID_whereData	=	array('contactID'	=>	$this->input->post('contactID'));
			$query1		= updateTable('tblcontactdetails', $contactID_whereData, $contact_values , 1,'contactID', $this->input->post('contactID'),'vehicle');
			//echo $this->db->last_query();exit;
				
			$values=array('contactID'			=>	$this->input->post('contactID'),
							'contactPer1'		=>	$this->input->post('name'),
							'contactPer2'		=>	$this->input->post('contactPer2'),
							
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
							
				$whereData	=	array('ownerID'	=>	$this->input->post('ownerID'));
				$query		= updateTable('tblvehicleowner', $whereData, $values , 1,'ownerID', $this->input->post('ownerID'),'vehicle');
			
				
				$vehicle_values	=	array('vehno'						=>	$this->input->post('vehno'),
											'vehmake'				=>	$this->input->post('vehmake'),
											'roadpermitno'			=>	$this->input->post('roadpermitno'),
											'validity'				=>	date('Y-m-d',strtotime($this->input->post('validity'))),
											'insurancepolicydtls'	=>	$this->input->post('insurancepolicydtls'),
											'ownerid'				=>	$this->input->post('ownerID'),
											
											'createby'				=>	$this->session->userdata('SESS_userId'),
											'active'				=>	1
											);
				$whereData1	=	array('vehicleID'	=>	$this->input->post('vehicleID'));
				$query2	=	updateTable('tblvehicle',$whereData1, $vehicle_values,1,'vehicleID',$this->input->post('vehicleID'),'vehicle');
				
				
				if($query || $query1 || $query2)
				{
					$this->session->set_userdata('suc','vehicle Successfully  Updated...!');
					redirect('approve_vehicle/'.$this->input->post('ownerID'));
					
				}
				else
				{
					$this->session->set_userdata('err','Error Please try again..!');
					redirect('approve_vehicle/'.$this->input->post('ownerID'));
				}
			
		}
		if($this->uri->segment(4))
		{
			$whereData	=	array('owner_modID'	=>	$this->uri->segment(4));
			$updateData	=	array('active'	=>	$this->uri->segment(5));
			$upt	=	$this->Commonsql_model->updateTable('tblvehicleowner_mod', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','Designation Status Successfully  Changed...!');
				redirect('approve_vehicle/'.$this->uri->segment(3));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('approve_vehicle/'.$this->uri->segment(3));
			}
		}
		else if($this->uri->segment(3))
		{
			$data['pageTitle']	=	"View vehicle";
			$data['table']		=	"Designation";
			$data['view']		=	$this->Commonsql_model->select_all_vowner_mod($this->uri->segment(3));
			$this->load->view('admin/vehicle/approve_vehicle',$data);
		}
		else
		{
			$data['pageTitle']	=	"View vehicle";
			$data['table']		=	"Designation";
			$data['view']		=	$this->Commonsql_model->select_all_vehicle_edit($this->uri->segment(2));
			$this->load->view('admin/vehicle/approve_vehicle',$data);
		}
	}
	function approve_vehicle_json()
	{
		if (!$this->session->userdata('SESS_userId')) {return FALSE; }
		$result	=	$this->Commonsql_model->select_all_vehicle_mod_state($this->uri->segment(3));
		//echo $this->db->last_query();exit;
		$output = array();$i=1;$j=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$value->vehicle_modID;
			$vaules['vehno'] 			= 	$value->vehno;
			$vaules['name'] 			= 	$value->contactPer1;
			$vaules['companyName'] 		= 	$value->companyName;
			$vaules['phone1'] 			= 	$value->phone1;
			$vaules['upt_date'] =	date('d-m-Y',strtotime($value->createdon));
			$vaules['upt_by'] 	=	$value->empname;
			if ($value->dbentrystateID == 0) 
			{
				$vaules['state'] 			= 	'<span class="label bg-danger">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 1) 
			{
				$vaules['state'] 			= 	'<span class="label bg-warning">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 2) 
			{
				$vaules['state'] 			= 	'<span class="label bg-info">'.$value->sta_name.'</span>';
			}
			else
			{
				$vaules['state'] 			= 	'<span class="label bg-greensea">'.$value->sta_name.'</span>';
			}
			if ($value->active == 1) 
			{
              
			  $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active'] = $row;
			
			if($value->active==1)
			{
				if($j++>0)
				{
					if(checkpageaccess('vehicle',1,'approve'))
					{
						$Approve	=	approve_html("'".base_url()."manage/vehicle_mod_approve/".$value->vehicle_modID."','2'");
					}
					else
					{
						$Approve			 			= "";
						
					}
					
				}
				else
				{
					$Approve	=	'';
				}
				if(checkpageaccess('vehicle',1,'delete'))
				{
					$active	=	disable_approve_deactive_html("'".base_url()."manage/approve_vehicle/".$value->vehicleID."/".$value->vehicle_modID."','0'");
				}
				else
				{
					$active	=	'';
				}
				
			}
			else
			{
				$Approve		=	'';
				if(checkpageaccess('vehicle',1,'delete'))
				{
					$active	=	enable_approve_deactive_html("'".base_url()."manage/approve_vehicle/".$value->vehicleID."/".$value->vehicle_modID."','1'");
				}
				else
				{
					$active	=	'';
				}
				
			}
			
			if(checkpageaccess('vehicle',1,'modify'))
			{
				$edit	=	edit_html("approve_vehicle/".$value->vehicleID.'/'.$value->vehicle_modID);
			}
			else
			{
				$edit	=	"";
			}
				
			$vaules['Action'] 			=	$Approve.$edit.$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	function vehicle_mod_approve()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('vehicle',1,'approve'))
		{
			redirect();
		}
		$mod_id	=	$this->uri->segment(3);
		$data	=	$this->Commonsql_model->select('tblvehicleowner_mod',array('owner_modID'=>$mod_id));
		if($data->num_rows()>0)
		{
			$val	=	$data->row();
			
				
				$values=array('contactID'		=>	$val->contactID,
							'contactPer1'		=>	$val->contactPer1,
							'contactPer2'		=>	$val->contactPer2,
							
							'dbentrystateID'			=>	3,
							'approvedby'				=>	$this->session->userdata('SESS_userId'),
							'approvedon'				=>	date('Y-m-d h:i:s'));
								
							
				$cond		=	array('ownerID'	=>	$val->ownerID);
				
				$values_mod	=	array('dbentrystateID'	=>	3,
								'approvedby'			=>	$this->session->userdata('SESS_userId'),
								'approvedon'			=>	date('Y-m-d h:i:s'));
							
				$cond_mod	=	array('owner_modID'	=>	$mod_id);
				$upt		=	$this->Commonsql_model->updateTable('tblvehicleowner', $cond , $values);
				$upt_m		=	$this->Commonsql_model->updateTable('tblvehicleowner_mod', $cond_mod , $values_mod);
				//echo $this->db->last_query();exit;
				if($upt)
				{
					$this->session->set_userdata('suc','Approved Successfully  Finished...!');
					redirect('approve_vehicle/'.$val->ownerID);
					
				}
				else
				{
					$this->session->set_userdata('err','Error Please try again..!');
					redirect('approve_vehicle/'.$val->ownerID);
				}
			}
	}
	/***********************************************************************************************************************************/
	function vehicleagent()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if($this->uri->segment(3))
		{
			$whereData	=	array('agentID'	=>	$this->uri->segment(3));

			$updateData	=	array('active'	=>	$this->uri->segment(4));
			$upt	=	$this->Commonsql_model->updateTable('tblvehicleagent', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','Designation Status Successfully  Changed...!');
				redirect('vehicleagent');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('vehicleagent');
			}
		}
		else
		{
			$data['pageTitle']	=	"Vehicle Agent";
			$data['table']		=	"vehicleagent";
			$this->load->view('admin/vehicleagent/vehicleagent',$data);
		}
	}
	function vehicleagent_json()
	{
		if (!$this->session->userdata('SESS_userId')) {return FALSE; }
		$result					=	$this->Commonsql_model->select_all_vagent_state();
		$pagealterpermission 	=	pagealterpermission('vehicleagent', $alterPermission = '');
		//echo $this->db->last_query();exit;
		$output = array();$i=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$value->agentID;
			$vaules['name'] 			= 	$value->name;
			$vaules['companyName'] 		= 	$value->companyName;
			$vaules['phone1'] 			= 	$value->phone1;
			if ($value->dbentrystateID == 0) 
			{
				$vaules['state'] 			= 	'<span class="label bg-danger">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 1) 
			{
				$vaules['state'] 			= 	'<span class="label bg-warning">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 2) 
			{
				$vaules['state'] 			= 	'<span class="label bg-info">'.$value->sta_name.'</span>';
			}
			else
			{
				$vaules['state'] 			= 	'<span class="label bg-greensea">'.$value->sta_name.'</span>';
			}
			if ($value->active == 1) 
			{
              
			  $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active'] = $row;
			
			if($value->active==1)
			{
				if(checkpageaccess('vehicleagent',1,'view'))
				{
					$view			 			=	view_html("view_vehicleagent/".$value->agentID);
				}
				else
				{
					$view			 			=	'';
				}
				if(selfAllowed($pagealterpermission, 'selfApprovalAllowed', $value->createby) && checkpageaccess('vehicleagent',1,'approve'))
				{
					$APPROVE			 			=	history_html("approve_vehicleagent/".$value->agentID);
				}
				else
				{
					$APPROVE			 			= "";
					
				}
				if(checkpageaccess('vehicleagent',1,'delete'))
				{
					$active	=	status_main_table($value->agentID,'agentID','vehicleagent','vehicleagent',1);
				}
				else
				{
					$active	=	'';
				}
			}
			else
			{
				$APPROVE		=	'';
				$view		=	'';
				if(checkpageaccess('vehicleagent',1,'delete'))
				{
					$active	=	status_main_table($value->agentID,'agentID','vehicleagent','vehicleagent',0);
				}
				else
				{
					$active	=	'';
				}
				
			}
			if(selfAllowed($pagealterpermission, 'selfEditAllowed', $value->createby) && checkpageaccess('vehicleagent',1,'modify'))
			{
				$edit	=	edit_html("edit_vehicleagent/".$value->agentID);
			}
			else
			{
				$edit	=	"";
			}
				
			$vaules['Action'] 			=	$view.$edit.$APPROVE.$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	function add_vehicleagent()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('vehicleagent',1,'create'))
		{
			redirect();
		}
		if($_POST)
		{
			/*contact details*/
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('companyName', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('addressline1', 'Address 1', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'state', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
            if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_userdata('err', validation_errors());
                redirect('add_vehicleagent');
            }
			//echo "hi";exit;
			$contact_values=array('name'		=>	$this->input->post('name'),
								'companyName'		=>	$this->input->post('companyName'),
								'addressline1'		=>	$this->input->post('addressline1'),
								'addressline2'		=>	$this->input->post('addressline2'),
								'city'				=>	$this->input->post('city'),
								'state'				=>	$this->input->post('state'),
								'country'			=>	$this->input->post('country'),
								'email1'			=>	$this->input->post('email1'),
								'email2'			=>	$this->input->post('email2'),
								'phone1'			=>	$this->input->post('phone1'),
								'phone2'			=>	$this->input->post('phone2'),
								'fax'				=>	$this->input->post('fax'),
								'website'			=>	$this->input->post('website'),
								'dbentrystateID'	=>	3,
								'createby'			=>	$this->session->userdata('SESS_userId'),
								'active'			=>	1);
								
				$contactID	=	insertTable('tblcontactdetails', $contact_values,1,'vehicleagent');
				
			$values=array('contactID'				=>	$contactID,
							'loadingadvno'		=>	$this->input->post('loadingadvno'),
							
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$query	=	insertTable('tblvehicleagent', $values,1,'vehicleagent');
			if($query)
			{
				$this->session->set_userdata('suc','Vehicle Owner Successfully  Added...!');
				redirect('add_vehicleagent');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('add_vehicleagent');
			}
		}
		$data['pageTitle']	=	"Add Designation";
		$this->load->view('admin/vehicleagent/add_vehicleagent',$data);
	}
	function edit_vehicleagent()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('vehicleagent',1,'modify'))
		{
			redirect();
		}
		if($_POST)
		{
			/*contact details*/
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('companyName', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('addressline1', 'Address 1', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'state', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
            if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_userdata('err', validation_errors());
                redirect('edit_vehicleagent/'.$this->input->post('agentID'));
            }
				$contact_values=array('name'		=>	$this->input->post('name'),
								'companyName'		=>	$this->input->post('companyName'),
								'addressline1'		=>	$this->input->post('addressline1'),
								'addressline2'		=>	$this->input->post('addressline2'),
								'city'				=>	$this->input->post('city'),
								'state'				=>	$this->input->post('state'),
								'country'			=>	$this->input->post('country'),
								'email1'			=>	$this->input->post('email1'),
								'email2'			=>	$this->input->post('email2'),
								'phone1'			=>	$this->input->post('phone1'),
								'phone2'			=>	$this->input->post('phone2'),
								'fax'				=>	$this->input->post('fax'),
								'website'			=>	$this->input->post('website'),
								
								'createby'			=>	$this->session->userdata('SESS_userId'),
								'active'			=>	1);
								
				$contactID_whereData	=	array('contactID'	=>	$this->input->post('contactID'));
			$query1		= updateTable('tblcontactdetails', $contactID_whereData, $contact_values , 1,'contactID', $this->input->post('contactID'),'vehicleagent');
				
			$values=array('contactID'			=>	$this->input->post('contactID'),
							'loadingadvno'		=>	$this->input->post('loadingadvno'),
							
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
							
			$whereData	=	array('agentID'	=>	$this->input->post('agentID'));
			$query		= updateTable('tblvehicleagent', $whereData, $values , 1,'agentID', $this->input->post('agentID'));
			if($query || $query1)
			{
				$this->session->set_userdata('suc','Vehicle Owner Successfully  Updated...!');
				redirect('edit_vehicleagent/'.$this->input->post('agentID'));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('edit_vehicleagent/'.$this->input->post('agentID'));
			}
		}
		$data['pageTitle']	=	"Edit Designation";
		$data['view']		=	$this->Commonsql_model->select_all_vagent_edit($this->uri->segment(2));
		$this->load->view('admin/vehicleagent/edit_vehicleagent',$data);
	}
	function view_vehicleagent()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('vehicleagent',1,'view'))
		{
			redirect();
		}
		$data['pageTitle']	=	"View Designation";
		$data['view']		=	$this->Commonsql_model->select_all_vagent_edit($this->uri->segment(2));
		$this->load->view('admin/vehicleagent/view_vehicleagent',$data);
	}
	function approve_vehicleagent()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('vehicleagent',1,'approve'))
		{
			redirect();
		}
		if($_POST)
		{
			/*contact details*/
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('companyName', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('addressline1', 'Address 1', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'state', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
            if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_userdata('err', validation_errors());
                redirect('approve_vehicleagent/'.$this->input->post('agentID'));
            }
			
				$contact_values=array('name'		=>	$this->input->post('name'),
								'companyName'		=>	$this->input->post('companyName'),
								'addressline1'		=>	$this->input->post('addressline1'),
								'addressline2'		=>	$this->input->post('addressline2'),
								'city'				=>	$this->input->post('city'),
								'state'				=>	$this->input->post('state'),
								'country'			=>	$this->input->post('country'),
								'email1'			=>	$this->input->post('emailss'),
								'email2'			=>	$this->input->post('email2'),
								'phone1'			=>	$this->input->post('phone1'),
								'phone2'			=>	$this->input->post('phone2'),
								'fax'				=>	$this->input->post('fax'),
								'website'			=>	$this->input->post('website'),
								
								'createby'			=>	$this->session->userdata('SESS_userId'),
								'active'			=>	1);
								
								
				$contactID_whereData	=	array('contactID'	=>	$this->input->post('contactID'));
			$query1		= updateTable('tblcontactdetails', $contactID_whereData, $contact_values , 1,'contactID', $this->input->post('contactID'),'vehicleagent');
			//echo $this->db->last_query();exit;
				
			$values=array('contactID'			=>	$this->input->post('contactID'),
							'loadingadvno'		=>	$this->input->post('loadingadvno'),
							
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
							
				$whereData	=	array('agentID'	=>	$this->input->post('agentID'));
				$query		= updateTable('tblvehicleagent', $whereData, $values , 1,'agentID', $this->input->post('agentID'));
			
				
				if($query || $query1)
				{
					$this->session->set_userdata('suc','vehicleagent Successfully  Updated...!');
					redirect('approve_vehicleagent/'.$this->input->post('agentID'));
					
				}
				else
				{
					$this->session->set_userdata('err','Error Please try again..!');
					redirect('approve_vehicleagent/'.$this->input->post('agentID'));
				}
			
		}
		if($this->uri->segment(4))
		{
			$whereData	=	array('agent_modID'	=>	$this->uri->segment(4));
			$updateData	=	array('active'	=>	$this->uri->segment(5));
			$upt	=	$this->Commonsql_model->updateTable('tblvehicleagent_mod', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','Designation Status Successfully  Changed...!');
				redirect('approve_vehicleagent/'.$this->uri->segment(3));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('approve_vehicleagent/'.$this->uri->segment(3));
			}
		}
		else if($this->uri->segment(3))
		{
			$data['pageTitle']	=	"View vehicleagent";
			$data['table']		=	"Designation";
			$data['view']		=	$this->Commonsql_model->select_all_vagent_mod($this->uri->segment(3));
			$this->load->view('admin/vehicleagent/approve_vehicleagent',$data);
		}
		else
		{
			$data['pageTitle']	=	"View vehicleagent";
			$data['table']		=	"Designation";
			$data['view']		=	$this->Commonsql_model->select_all_vagent_edit($this->uri->segment(2));
			$this->load->view('admin/vehicleagent/approve_vehicleagent',$data);
		}
	}
	function approve_vehicleagent_json()
	{
		if (!$this->session->userdata('SESS_userId')) {return FALSE; }
		$result	=	$this->Commonsql_model->select_all_vagent_mod_state($this->uri->segment(3));
		//echo $this->db->last_query();exit;
		$output = array();$i=1;$j=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']				=	$value->agent_modID;
			$vaules['name'] 			= 	$value->name;
			$vaules['companyName'] 		= 	$value->companyName;
			$vaules['phone1'] 			= 	$value->phone1;
			if ($value->dbentrystateID == 0) 
			{
				$vaules['state'] 			= 	'<span class="label bg-danger">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 1) 
			{
				$vaules['state'] 			= 	'<span class="label bg-warning">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 2) 
			{
				$vaules['state'] 			= 	'<span class="label bg-info">'.$value->sta_name.'</span>';
			}
			else
			{
				$vaules['state'] 			= 	'<span class="label bg-greensea">'.$value->sta_name.'</span>';
			}
			if ($value->active == 1) 
			{
              
			  $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active'] = $row;
			
			if($value->active==1)
			{
				if($j++>0)
				{
					if(checkpageaccess('vehicleagent',1,'approve'))
					{
						$Approve	=	approve_html("'".base_url()."manage/vehicleagent_mod_approve/".$value->agent_modID."','2'");
					}
					else
					{
						$Approve			 			= "";
						
					}
					
				}
				else
				{
					$Approve	=	'';
				}
				if(checkpageaccess('vehicleagent',1,'delete'))
				{
					$active	=	disable_approve_deactive_html("'".base_url()."manage/approve_vehicleagent/".$value->agentID."/".$value->agent_modID."','0'");
				}
				else
				{
					$active	=	'';
				}
				
			}
			else
			{
				$Approve		=	'';
				if(checkpageaccess('vehicleagent',1,'delete'))
				{
					$active	=	enable_approve_deactive_html("'".base_url()."manage/approve_vehicleagent/".$value->agentID."/".$value->agent_modID."','1'");
				}
				else
				{
					$active	=	'';
				}
				
			}
			
			if(checkpageaccess('vehicleagent',1,'modify'))
			{
				$edit	=	edit_html("approve_vehicleagent/".$value->agentID.'/'.$value->agent_modID);
			}
			else
			{
				$edit	=	"";
			}
				
			$vaules['Action'] 			=	$Approve.$edit.$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	function vehicleagent_mod_approve()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('vehicleagent',1,'approve'))
		{
			redirect();
		}
		$mod_id	=	$this->uri->segment(3);
		$data	=	$this->Commonsql_model->select('tblvehicleagent_mod',array('agent_modID'=>$mod_id));
		if($data->num_rows()>0)
		{
			$val	=	$data->row();
			
				
				$values=array('contactID'				=>	$val->contactID,
							'loadingadvno'				=>	$val->loadingadvno,
							
							'dbentrystateID'			=>	3,
							'approvedby'				=>	$this->session->userdata('SESS_userId'),
							'approvedon'				=>	date('Y-m-d h:i:s'));
								
							
				$cond		=	array('agentID'	=>	$val->agentID);
				
				$values_mod	=	array('dbentrystateID'	=>	3,
								'approvedby'			=>	$this->session->userdata('SESS_userId'),
								'approvedon'			=>	date('Y-m-d h:i:s'));
							
				$cond_mod	=	array('agent_modID'	=>	$mod_id);
				$upt		=	$this->Commonsql_model->updateTable('tblvehicleagent', $cond , $values);
				$upt_m		=	$this->Commonsql_model->updateTable('tblvehicleagent_mod', $cond_mod , $values_mod);
				//echo $this->db->last_query();exit;
				if($upt)
				{
					$this->session->set_userdata('suc','Approved Successfully  Finished...!');
					redirect('approve_vehicleagent/'.$val->agentID);
					
				}
				else
				{
					$this->session->set_userdata('err','Error Please try again..!');
					redirect('approve_vehicleagent/'.$val->agentID);
				}
			}
	}
	/***********************************************************************************************************************************/
	function consignor()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if($this->uri->segment(3))
		{
			$whereData	=	array('consignorID'	=>	$this->uri->segment(3));
			$updateData	=	array('active'	=>	$this->uri->segment(4));
			$upt	=	$this->Commonsql_model->updateTable('tblconsignor', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','consignor Status Successfully  Changed...!');
				redirect('consignor');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('consignor');
			}
		}
		else
		{
			$data['pageTitle']	=	"consignor";
			$data['table']		=	"consignor";
			$this->load->view('admin/consignor/consignor',$data);
		}
	}
	function consignor_json()
	{
		if (!$this->session->userdata('SESS_userId')) {return FALSE; }
		$result					=	$this->Commonsql_model->select_conginor_state();
		$pagealterpermission 	=	pagealterpermission('contract-consignor', $alterPermission = '');
		$output = array();$i=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']			=	$value->consignorID;
			$vaules['name'] 		= 	$value->name;
			
			
			if ($value->dbentrystateID == 0) 
			{
				$vaules['state'] 			= 	'<span class="label bg-danger">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 1) 
			{
				$vaules['state'] 			= 	'<span class="label bg-warning">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 2) 
			{
				$vaules['state'] 			= 	'<span class="label bg-info">'.$value->sta_name.'</span>';
			}
			else
			{
				$vaules['state'] 			= 	'<span class="label bg-greensea">'.$value->sta_name.'</span>';
			}
			if ($value->active == 1) 
			{
              
			  $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active'] = $row;
			
			if($value->active==1)
			{
				
				if(checkpageaccess('contract-consignor',1,'view'))
				{
					$view		=	view_html("view-consignor/".$value->consignorID);
				}
				else
				{
					$view			 			=	'';
				}
				if(selfAllowed($pagealterpermission, 'selfApprovalAllowed', $value->createby) && checkpageaccess('contract-consignor',1,'approve'))
				{
					$Approve		=	history_html("approve-consignor/".$value->consignorID);
				}
				else
				{
					$APPROVE			 			= "";
					
				}
				if(checkpageaccess('contract-consignor',1,'delete'))
				{
					$active	=	status_main_table($value->consignorID,'consignorID','consignor','contract-consignor',1);
				}
				else
				{
					$active	=	'';
				}
			}
			else
			{
				$view		=	'';
				$Approve		=	'';
				if(checkpageaccess('contract-consignor',1,'delete'))
				{
					$active	=	status_main_table($value->consignorID,'consignorID','consignor','contract-consignor',0);
				}
				else
				{
					$active	=	'';
				}
				
			}
			if(selfAllowed($pagealterpermission, 'selfEditAllowed', $value->createby) && checkpageaccess('contract-consignor',1,'modify'))
			{
				$edit	=	edit_html("edit-consignor/".$value->consignorID);
			}
			else
			{
				$edit	=	"";
			}
				
			$vaules['Action'] 			=	$view.$edit.$Approve.$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	function add_consignor()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('contract-consignor',1,'create'))
		{
			redirect();
		}
		if($_POST)
		{
			/*contact details*/
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('companyName', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('addressline1', 'Address 1', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'state', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
            if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_userdata('err', validation_errors());
                redirect('add-consignor');
            }
			
				$contact_values=array('name'		=>	$this->input->post('name'),
								'companyName'		=>	$this->input->post('companyName'),
								'addressline1'		=>	$this->input->post('addressline1'),
								'addressline2'		=>	$this->input->post('addressline2'),
								'city'				=>	$this->input->post('city'),
								'state'				=>	$this->input->post('state'),
								'country'			=>	$this->input->post('country'),
								'email1'			=>	$this->input->post('email1'),
								'email2'			=>	$this->input->post('email2'),
								'phone1'			=>	$this->input->post('phone1'),
								'phone2'			=>	$this->input->post('phone2'),
								'fax'				=>	$this->input->post('fax'),
								'website'			=>	$this->input->post('website'),
								
								'createby'			=>	$this->session->userdata('SESS_userId'),
								'active'			=>	1);
								
				$contactID	=	insertTable('tblcontactdetails', $contact_values,1,'contract-consignor');
			
			
			$values_cons=array('contactID'		=>	$contactID,
							'contactPer1'		=>	$this->input->post('name'),
							'contactPer1'		=>	$this->input->post('contactPer2'),
							'csttinno'			=>	$this->input->post('csttinno'),
							
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$consignorID	=	insertTable('tblconsignor', $values_cons,1,'contract-consignor');
			
			
			
			
			
			if($consignorID)
			{
				$this->session->set_userdata('suc','Employee Types Successfully  Added...!');
				redirect('add-consignor');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('add-consignor');
			}
		}
		$data['pageTitle']	=	"Add Contract Consignor";
		$data['view']		=	$this->Commonsql_model->select_exist_conginor_contract();
		$this->load->view('admin/consignor/add_consignor',$data);
	}
	function edit_consignor()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('contract-consignor',1,'modify'))
		{
			redirect();
		}
		if($_POST)
		{
			/*contact details*/
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('companyName', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('addressline1', 'Address 1', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'state', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
            if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_userdata('err', validation_errors());
                redirect('edit-consignor/'.$this->input->post('consignorID'));
            }
			$whereData	= array('consignorID'=>$this->input->post('consignorID'));
			$contac_wh	= array('contactID'=>$this->input->post('contactID'));
			$contact_values=array('name'		=>	$this->input->post('name'),
							'companyName'		=>	$this->input->post('companyName'),
							'addressline1'		=>	$this->input->post('addressline1'),
							'addressline2'		=>	$this->input->post('addressline2'),
							'city'				=>	$this->input->post('city'),
							'state'				=>	$this->input->post('state'),
							'country'			=>	$this->input->post('country'),
							'email1'			=>	$this->input->post('email1'),
							'email2'			=>	$this->input->post('email2'),
							'phone1'			=>	$this->input->post('phone1'),
							'phone2'			=>	$this->input->post('phone2'),
							'fax'				=>	$this->input->post('fax'),
							'website'			=>	$this->input->post('website'),
							
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$query1		= updateTables('tblcontactdetails', $contac_wh, $contact_values , 1,'contactID', $this->input->post('contactID'),'contract-consignor');
			
			$values_cons=array('contactID'		=>	$this->input->post('contactID'),
							'contactPer1'		=>	$this->input->post('name'),
							'contactPer2'		=>	$this->input->post('contactPer2'),
							'csttinno'			=>	$this->input->post('csttinno'),
							
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$query2		= updateTables('tblconsignor', $whereData, $values_cons , 1,'consignorID', $this->input->post('consignorID'),'contract-consignor');
			
			if($query1 || $query2 )
			{
				$this->session->set_userdata('suc','Consioner Types Successfully  Added...!');
				redirect('edit-consignor/'.$this->input->post('consignorID'));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('edit-consignor/'.$this->input->post('consignorID'));
			}
		}
		$data['view']		=	$this->Commonsql_model->select_conginor(array('a.consignorID'=>$this->uri->segment(2)));
		$data['pageTitle']	=	"Edit consignor";
		$this->load->view('admin/consignor/edit_consignor',$data);
	}
	function view_consignor()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		$data['view']		=	$this->Commonsql_model->select_conginor(array('a.consignorID'=>$this->uri->segment(2)));
		$data['pageTitle']	=	"View consignor";
		$this->load->view('admin/consignor/view_consignor',$data);
	}
	function approve_consignor()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('consignor',1,'approve'))
		{
			redirect();
		}
		if($_POST)
		{
			/*contact details*/
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('companyName', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('addressline1', 'Address 1', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'state', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
            if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_userdata('err', validation_errors());
                redirect('approve-consignor/'.$this->input->post('consignorID'));
            }
			$whereData	= array('consignorID'=>$this->input->post('consignorID'));
			$contac_wh	= array('contactID'=>$this->input->post('contactID'));
			$contact_values=array('name'		=>	$this->input->post('name'),
							'companyName'		=>	$this->input->post('companyName'),
							'addressline1'		=>	$this->input->post('addressline1'),
							'addressline2'		=>	$this->input->post('addressline2'),
							'city'				=>	$this->input->post('city'),
							'state'				=>	$this->input->post('state'),
							'country'			=>	$this->input->post('country'),
							'email1'			=>	$this->input->post('email1'),
							'email2'			=>	$this->input->post('email2'),
							'phone1'			=>	$this->input->post('phone1'),
							'phone2'			=>	$this->input->post('phone2'),
							'fax'				=>	$this->input->post('fax'),
							'website'			=>	$this->input->post('website'),
							
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$query1		= updateTables('tblcontactdetails', $contac_wh, $contact_values , 1,'contactID', $this->input->post('contactID'));
			
			$values_cons=array('contactID'		=>	$this->input->post('contactID'),
							'contactPer1'		=>	$this->input->post('name'),
							'contactPer2'		=>	$this->input->post('contactPer2'),
							'csttinno'			=>	$this->input->post('csttinno'),
							
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$query2		= updateTables('tblconsignor', $whereData, $values_cons , 1,'consignorID', $this->input->post('consignorID'));
			
			if($query1 || $query2 )
			{
				$this->session->set_userdata('suc','Consioner Types Successfully  Added...!');
				redirect('approve-consignor/'.$this->input->post('consignorID'));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('approve-consignor/'.$this->input->post('consignorID'));
			}
		}
		if($this->uri->segment(4))
		{
			$whereData	=	array('consignor_modID'	=>	$this->uri->segment(4));
			$updateData	=	array('active'	=>	$this->uri->segment(5));
			$upt	=	$this->Commonsql_model->updateTable('tblconsignor_mod', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','Designation Status Successfully  Changed...!');
				redirect('approve-consignor/'.$this->uri->segment(3));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('approve-consignor/'.$this->uri->segment(3));
			}
		}
		else if($this->uri->segment(3))
		{
			$data['pageTitle']	=	"View vehicleowner";
			$data['table']		=	"Designation";
			$data['view']		=	$this->Commonsql_model->select_all_consigonr_mod($this->uri->segment(3));
			//echo $this->db->last_query();exit;	
			$this->load->view('admin/consignor/approve_consignor',$data);
		}
		else
		{
			$data['pageTitle']	=	"View vehicleowner";
			$data['table']		=	"Designation";
			$data['view']		=	$this->Commonsql_model->select_conginor(array('a.consignorID'=>$this->uri->segment(2)));
			$this->load->view('admin/consignor/approve_consignor',$data);
		}
	}
	function approve_consignor_json()
	{
		if (!$this->session->userdata('SESS_userId')) {return FALSE; }
		$result	=	$this->Commonsql_model->select_all_consigonr_mod_state($this->uri->segment(3));
		//echo $this->db->last_query();exit;
		$output = array();$i=1;$j=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']			=	$value->consignor_modID;
			$vaules['name'] 		= 	$value->name;
			
			$vaules['upt_date'] =	date('d-m-Y',strtotime($value->createdon));
			$vaules['upt_by'] 	=	$value->empname;
			if ($value->dbentrystateID == 0) 
			{
				$vaules['state'] 			= 	'<span class="label bg-danger">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 1) 
			{
				$vaules['state'] 			= 	'<span class="label bg-warning">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 2) 
			{
				$vaules['state'] 			= 	'<span class="label bg-info">'.$value->sta_name.'</span>';
			}
			else
			{
				$vaules['state'] 			= 	'<span class="label bg-greensea">'.$value->sta_name.'</span>';
			}
			if ($value->active == 1) 
			{
              
			  $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active'] = $row;
			
			if($value->active==1)
			{
				if($j++>0)
				{
					if(checkpageaccess('consignor',1,'approve'))
					{
						$Approve	=	approve_html("'".base_url()."manage/consignor_mod_approve/".$value->consignor_modID."','2'");
					}
					else
					{
						$Approve	=	'';
					}
				}
				else
				{
					$Approve	=	'';
				}
				if(checkpageaccess('consignor',1,'delete'))
				{
					$active	=	disable_approve_deactive_html("'".base_url()."manage/approve_consignor/".$value->consignorID."/".$value->consignor_modID."','0'");
				}
				else
				{
					$active	=	"";
				}
				
				
			}
			else
			{
				$Approve		=	'';
				if(checkpageaccess('consignor',1,'delete'))
				{
					$active	=	enable_approve_deactive_html("'".base_url()."manage/approve_consignor/".$value->consignorID."/".$value->consignor_modID."','1'");
				}
				else
				{
					$active	=	"";
				}
			}
			
			if(checkpageaccess('consignor',1,'modify'))
			{
				$edit	=	edit_html("approve-consignor/".$value->consignorID."/".$value->consignor_modID);
			}
			else
			{
				$edit	=	"";
			}
				
			$vaules['Action'] 			=	$Approve.$edit.$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	function consignor_mod_approve()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('consignor',1,'approve'))
		{
			redirect();
		}
		$mod_id	=	$this->uri->segment(3);
		$data	=	$this->Commonsql_model->select('tblconsignor_mod',array('consignor_modID'=>$mod_id));
		if($data->num_rows()>0)
		{
			$val	=	$data->row();
			
				
				$values=array('contactID'				=>	$val->contactID,
							'contactPer1'				=>	$val->name,
							'contactPer2'				=>	$val->contactPer2,
							'csttinno'					=>	$val->csttinno,
							
							'dbentrystateID'			=>	3,
							'approvedby'				=>	$this->session->userdata('SESS_userId'),
							'approvedon'				=>	date('Y-m-d h:i:s'));
								
							
				$cond		=	array('consignorID'	=>	$val->consignorID);
				
				$values_mod	=	array('dbentrystateID'	=>	3,
								'approvedby'			=>	$this->session->userdata('SESS_userId'),
								'approvedon'			=>	date('Y-m-d h:i:s'));
							
				$cond_mod	=	array('consignor_modID'	=>	$mod_id);
				$upt		=	$this->Commonsql_model->updateTable('tblconsignor', $cond , $values);
				$upt_m		=	$this->Commonsql_model->updateTable('tblconsignor_mod', $cond_mod , $values_mod);
				//echo $this->db->last_query();exit;
				if($upt)
				{
					$this->session->set_userdata('suc','Approved Successfully  Finished...!');
					redirect('approve-consignor/'.$val->consignorID);
					
				}
				else
				{
					$this->session->set_userdata('err','Error Please try again..!');
					redirect('approve-consignor/'.$val->consignorID);
				}
			}
	}
	/***********************************************************************************************************************************/
	function contract_consignor()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if($this->uri->segment(3))
		{
			$whereData	=	array('consignorID'	=>	$this->uri->segment(3));
			$updateData	=	array('active'	=>	$this->uri->segment(4));
			$upt	=	$this->Commonsql_model->updateTable('tblconsignor', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','contract consignor Status Successfully  Changed...!');
				redirect('contract-consignor');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('contract-consignor');
			}
		}
		else
		{
			$data['pageTitle']	=	"Emplyee Types";
			$data['table']		=	"Emplyee Types";
			$this->load->view('admin/contract_consignor/contract_consignor',$data);
		}
	}
	function contract_consignor_json()
	{
		if (!$this->session->userdata('SESS_userId')) {return FALSE; }
		$result	=	$this->Commonsql_model->select_conginor_contract_state();
		$output = array();$i=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']			=	$value->consignorID;
			$vaules['name'] 		= 	$value->name;
			$vaules['from'] 		= 	$value->from;
			$vaules['to'] 			= 	$value->to;
			
			$vaules['length'] 		= 	$value->vehicleLength;
			$vaules['weight'] 		= 	$value->vehicleCapacity;
			$vaules['date'] 		= 	date('d-m-Y',strtotime($value->dated));
			
			$vaules['sign'] 		= 	$value->signedby;
			$vaules['total'] 		= 	$value->grandTotal;
			
			if ($value->dbentrystateID == 0) 
			{
				$vaules['state'] 			= 	'<span class="label bg-danger">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 1) 
			{
				$vaules['state'] 			= 	'<span class="label bg-warning">'.$value->sta_name.'</span>';
			}
			elseif ($value->dbentrystateID == 2) 
			{
				$vaules['state'] 			= 	'<span class="label bg-info">'.$value->sta_name.'</span>';
			}
			else
			{
				$vaules['state'] 			= 	'<span class="label bg-greensea">'.$value->sta_name.'</span>';
			}
			if ($value->active == 1) 
			{
              
			  $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active'] = $row;
			
			if($value->active==1)
			{
				
				if(checkpageaccess('contract-consignor',1,'view'))
				{
					$view		=	view_html("view_contract_consignor/".$value->consignorID);
				}
				else
				{
					$view			 			=	'';
				}
				if(checkpageaccess('contract-consignor',1,'approve'))
				{
					$Approve		=	history_html("approve-contract-consignor/".$value->consignorID);
				}
				else
				{
					$APPROVE			 			= "";
					
				}
				if(checkpageaccess('contract-consignor',1,'delete'))
				{
					$active	=	disable_approve_deactive_html("'".base_url()."manage/contract_consignor/".$value->consignorID."','0'");
				}
				else
				{
					$active	=	'';
				}
			}
			else
			{
				$view		=	'';
				$Approve		=	'';
				if(checkpageaccess('contract-consignor',1,'delete'))
				{
					$active	=	enable_approve_deactive_html("'".base_url()."manage/contract_consignor/".$value->consignorID."','1'");
				}
				else
				{
					$active	=	'';
				}
				
			}
			if(checkpageaccess('contract-consignor',1,'modify'))
			{
				$edit	=	edit_html("edit-contract-consignor/".$value->consignorID);
			}
			else
			{
				$edit	=	"";
			}
				
			$vaules['Action'] 			=	$view.$edit.$Approve.$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	function add_contract_consignor()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('contract-consignor',1,'create'))
		{
			redirect();
		}
		if($this->input->post('save'))
		{
			if (is_numeric($this->input->post('name'))) 
			{
				$contactID	=	$this->input->post('name');
			}
			else
			{
				$contact_values=array('name'		=>	$this->input->post('name'),
								'companyName'		=>	$this->input->post('companyName'),
								'addressline1'		=>	$this->input->post('addressline1'),
								'addressline2'		=>	$this->input->post('addressline2'),
								'city'				=>	$this->input->post('city'),
								'state'				=>	$this->input->post('state'),
								'country'			=>	$this->input->post('country'),
								'email1'			=>	$this->input->post('email1'),
								'email2'			=>	$this->input->post('email2'),
								'phone1'			=>	$this->input->post('phone1'),
								'phone2'			=>	$this->input->post('phone2'),
								'fax'				=>	$this->input->post('fax'),
								'website'			=>	$this->input->post('website'),
								
								'createby'			=>	$this->session->userdata('SESS_userId'),
								'active'			=>	1);
								
				$contactID	=	insertTable('tblcontactdetails', $contact_values,1);
			}
			
			$values_cons=array('contactID'		=>	$contactID,
							'contactPer1'		=>	$this->input->post('name'),
							'contactPer1'		=>	$this->input->post('contactPer2'),
							'csttinno'			=>	$this->input->post('csttinno'),
							
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$consignorID	=	insertTable('tblconsignor', $values_cons,1);
			
			$values=array('contractCode'		=>	$this->input->post('contractCode'),
							'consignorID'		=>	$consignorID,
							'contractTypeID'	=>	1,
							'from'				=>	$this->input->post('from'),
							'to'				=>	$this->input->post('to'),
							'vehicleLength'		=>	$this->input->post('vehicleLength'),
							'vehicleType'		=>	$this->input->post('vehicleType'),
							'vehicleCapacity'	=>	$this->input->post('vehicleCapacity'),
							'roadType'			=>	$this->input->post('roadType'),
							'minKM'				=>	$this->input->post('minKM'),
							'seasonType'		=>	$this->input->post('seasonType'),
							'miscType'			=>	$this->input->post('miscType'),
							'dated'				=>	date('Y-m-d',strtotime($this->input->post('dated'))),
							'signedby'			=>	$this->input->post('signedby'),
							
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$contractID	=	insertTable('tblcontract', $values,1);
			
			$values_map=array('contractVerID'		=>	1,
							'contractID'			=>	$contractID,
							'basicfreight'			=>	$this->input->post('basicfreight'),
							'docketChgs'			=>	$this->input->post('docketChgs'),
							'handlingChgs'			=>	$this->input->post('handlingChgs'),
							'statePermitChgs'		=>	$this->input->post('statePermitChgs'),
							'pickupDeliveryChgs'	=>	$this->input->post('pickupDeliveryChgs'),
							'toPayChgs'				=>	$this->input->post('toPayChgs'),
							'checkpostExpenses'		=>	$this->input->post('checkpostExpenses'),
							'coddodChgs'			=>	$this->input->post('coddodChgs'),
							'MISCCharges'			=>	$this->input->post('MISCCharges'),
							'serivceTax'			=>	$this->input->post('serivceTax'),
							'grandTotal'			=>	$this->input->post('grandTotal'),
							
							'createby'				=>	$this->session->userdata('SESS_userId'),
							'active'				=>	1);
							
			$contractVersionMapID	=	insertTable('tblcontractversionmap', $values_map,1);
			
			if($contractID)
			{
				$this->session->set_userdata('suc','Employee Types Successfully  Added...!');
				redirect('add-contract-consignor');
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('add-contract-consignor');
			}
		}
		$data['pageTitle']	=	"Add Contract Consignor";
		$data['view']		=	$this->Commonsql_model->select_exist_conginor_contract();
		$this->load->view('admin/contract_consignor/add_contract_consignor',$data);
	}
	function contract_contact_details()
	{
		$data['view'] 	=	$this->Commonsql_model->select('tblcontactdetails',array('name'	=>	$this->input->post('name')));
		$this->load->View('admin/contract_consignor/contract_contact_details',$data);
	}
	function edit_contract_consignor()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		if(!checkpageaccess('contract-consignor',1,'modify'))
		{
			redirect();
		}
		if($this->input->post('save'))
		{
			$whereData	= array('consignorID'=>$this->input->post('consignorID'));
			$contac_wh	= array('contactID'=>$this->input->post('contactID'));
			$contract_wh	= array('contractID'=>$this->input->post('contractID'));



			$contact_values=array('name'		=>	$this->input->post('name'),
							'companyName'		=>	$this->input->post('companyName'),
							'addressline1'		=>	$this->input->post('addressline1'),
							'addressline2'		=>	$this->input->post('addressline2'),
							'city'				=>	$this->input->post('city'),
							'state'				=>	$this->input->post('state'),
							'country'			=>	$this->input->post('country'),
							'email1'			=>	$this->input->post('email1'),
							'email2'			=>	$this->input->post('email2'),
							'phone1'			=>	$this->input->post('phone1'),
							'phone2'			=>	$this->input->post('phone2'),
							'fax'				=>	$this->input->post('fax'),
							'website'			=>	$this->input->post('website'),
							
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$query1		= updateTables('tblcontactdetails', $contac_wh, $contact_values , 1,'contactID', $this->input->post('contactID'));
			
			$values_cons=array('contactID'		=>	$this->input->post('contactID'),
							'contactPer1'		=>	$this->input->post('name'),
							'contactPer2'		=>	$this->input->post('contactPer2'),
							'csttinno'			=>	$this->input->post('csttinno'),
							
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$query2		= updateTables('tblconsignor', $whereData, $values_cons , 1,'consignorID', $this->input->post('consignorID'));
			
			$values=array('contractCode'		=>	$this->input->post('contractCode'),
							'contractTypeID'	=>	1,
							'consignorID'		=>	$this->input->post('consignorID'),
							'from'				=>	$this->input->post('from'),
							'to'				=>	$this->input->post('to'),
							'vehicleLength'		=>	$this->input->post('vehicleLength'),
							'vehicleType'		=>	$this->input->post('vehicleType'),
							'vehicleCapacity'	=>	$this->input->post('vehicleCapacity'),
							'roadType'			=>	$this->input->post('roadType'),
							'minKM'				=>	$this->input->post('minKM'),
							'seasonType'		=>	$this->input->post('seasonType'),
							'miscType'			=>	$this->input->post('miscType'),
							'dated'				=>	date('Y-m-d',strtotime($this->input->post('dated'))),
							'signedby'			=>	$this->input->post('signedby'),
							
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$query3		= updateTables('tblcontract', $whereData, $values , 1,'contractID', $this->input->post('contractID'));
			
			$values_map=array('contractVerID'		=>	1,
							'contractID'			=>	$this->input->post('contractID'),
							'basicfreight'			=>	$this->input->post('basicfreight'),
							'docketChgs'			=>	$this->input->post('docketChgs'),
							'handlingChgs'			=>	$this->input->post('handlingChgs'),
							'statePermitChgs'		=>	$this->input->post('statePermitChgs'),
							'pickupDeliveryChgs'	=>	$this->input->post('pickupDeliveryChgs'),
							'toPayChgs'				=>	$this->input->post('toPayChgs'),
							'checkpostExpenses'		=>	$this->input->post('checkpostExpenses'),
							'coddodChgs'			=>	$this->input->post('coddodChgs'),
							'MISCCharges'			=>	$this->input->post('MISCCharges'),
							'serivceTax'			=>	$this->input->post('serivceTax'),
							'grandTotal'			=>	$this->input->post('grandTotal'),
							
							'createby'				=>	$this->session->userdata('SESS_userId'),
							'active'				=>	1);
							
			$query4		= updateTables('tblcontractversionmap', $contract_wh, $values_map , 1,'contractVersionMapID', $this->input->post('contractVersionMapID'));
			
			if($query1 || $query2 || $query3 || $query4)
			{
				$this->session->set_userdata('suc','Coontract Consioner Types Successfully  Added...!');
				redirect('edit-contract-consignor/'.$this->input->post('consignorID'));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('edit-contract-consignor/'.$this->input->post('consignorID'));
			}
		}
		$data['view']		=	$this->Commonsql_model->select_conginor_contract(array('a.consignorID'=>$this->uri->segment(2)));
		$data['pageTitle']	=	"Edit Emplyee Types";
		$this->load->view('admin/contract_consignor/edit_contract_consignor',$data);
	}
	function view_contract_consignor()
	{
		if(!$this->session->userdata('SESS_userId')){ redirect(base_url() . "login");}
		$data['pageTitle']	=	"View Emplyee Types";
		$data['view']		=	$this->Commonsql_model->select('tblemployetypes',array('employetypeID'=>$this->uri->segment(2)));
		$this->load->view('admin/contract_consignor/view_contract_consignor',$data);
	}
	function approve_contract_consignor()
	{
		if($this->input->post('save'))
		{
			$whereData	= array('consignorID'=>$this->input->post('consignorID'));
			$contac_wh	= array('contactID'=>$this->input->post('contactID'));
			$contract_wh	= array('contractID'=>$this->input->post('contractID'));
			$contact_values=array('name'		=>	$this->input->post('name'),
							'companyName'		=>	$this->input->post('companyName'),
							'addressline1'		=>	$this->input->post('addressline1'),
							'addressline2'		=>	$this->input->post('addressline2'),
							'city'				=>	$this->input->post('city'),
							'state'				=>	$this->input->post('state'),
							'country'			=>	$this->input->post('country'),
							'email1'			=>	$this->input->post('email1'),
							'email2'			=>	$this->input->post('email2'),
							'phone1'			=>	$this->input->post('phone1'),
							'phone2'			=>	$this->input->post('phone2'),
							'fax'				=>	$this->input->post('fax'),
							'website'			=>	$this->input->post('website'),
							
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$query1		= updateTable('tblcontactdetails', $contac_wh, $contact_values , 1,'contactID', $this->input->post('contactID'));
			
			$values_cons=array('contactID'		=>	$this->input->post('contactID'),
							'contactPer1'		=>	$this->input->post('name'),
							'contactPer2'		=>	$this->input->post('contactPer2'),
							'csttinno'			=>	$this->input->post('csttinno'),
							
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$query2		= updateTable('tblconsignor', $whereData, $values_cons , 1,'consignorID', $this->input->post('consignorID'));
			
			$values=array('contractCode'		=>	$this->input->post('contractCode'),
							'contractTypeID'	=>	1,
							'consignorID'		=>	$this->input->post('consignorID'),
							'from'				=>	$this->input->post('from'),
							'to'				=>	$this->input->post('to'),
							'vehicleLength'		=>	$this->input->post('vehicleLength'),
							'vehicleType'		=>	$this->input->post('vehicleType'),
							'vehicleCapacity'	=>	$this->input->post('vehicleCapacity'),
							'roadType'			=>	$this->input->post('roadType'),
							'minKM'				=>	$this->input->post('minKM'),
							'seasonType'		=>	$this->input->post('seasonType'),
							'miscType'			=>	$this->input->post('miscType'),
							'dated'				=>	date('Y-m-d',strtotime($this->input->post('dated'))),
							'signedby'			=>	$this->input->post('signedby'),
							
							'createby'			=>	$this->session->userdata('SESS_userId'),
							'active'			=>	1);
							
			$query3		= updateTable('tblcontract', $whereData, $values , 1,'contractID', $this->input->post('contractID'));
			
			$values_map=array('contractVerID'		=>	1,
							'contractID'			=>	$this->input->post('contractID'),
							'basicfreight'			=>	$this->input->post('basicfreight'),
							'docketChgs'			=>	$this->input->post('docketChgs'),
							'handlingChgs'			=>	$this->input->post('handlingChgs'),
							'statePermitChgs'		=>	$this->input->post('statePermitChgs'),
							'pickupDeliveryChgs'	=>	$this->input->post('pickupDeliveryChgs'),
							'toPayChgs'				=>	$this->input->post('toPayChgs'),
							'checkpostExpenses'		=>	$this->input->post('checkpostExpenses'),
							'coddodChgs'			=>	$this->input->post('coddodChgs'),
							'MISCCharges'			=>	$this->input->post('MISCCharges'),
							'serivceTax'			=>	$this->input->post('serivceTax'),
							'grandTotal'			=>	$this->input->post('grandTotal'),
							
							'createby'				=>	$this->session->userdata('SESS_userId'),
							'active'				=>	1);
							
			$query4		= updateTable('tblcontractversionmap', $contract_wh, $values_map , 1,'contractVersionMapID', $this->input->post('contractVersionMapID'));
			
			if($query1 || $query2 || $query3 || $query4)
			{
				$this->session->set_userdata('suc','Coontract Consioner Types Successfully  Added...!');
				redirect('approve-contract-consignor/'.$this->input->post('consignorID'));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('approve-contract-consignor/'.$this->input->post('consignorID'));
			}
		}
		if($this->uri->segment(4))
		{
			$whereData	=	array('consignor_modID'	=>	$this->uri->segment(4));
			$updateData	=	array('active'	=>	$this->uri->segment(5));
			$upt	=	$this->Commonsql_model->updateTable('tblconsignor_mod', $whereData , $updateData);
			//echo $this->db->last_query();exit;
			if($upt)
			{
				$this->session->set_userdata('suc','contract_consignor Status Successfully  Changed...!');
				redirect('approve-contract-consignor/'.$this->uri->segment(3));
				
			}
			else
			{
				$this->session->set_userdata('err','Error Please try again..!');
				redirect('approve-contract-consignor/'.$this->uri->segment(3));
			}
		}
		else if($this->uri->segment(3))
		{
			$data['pageTitle']	=	"View contract_consignor";
			$data['table']		=	"Designation";
			$data['view']		=	$this->Commonsql_model->select('tblconsignor_mod',array('consignor_modID'=>$this->uri->segment(3)));
			$this->load->view('admin/contract_consignor/approve_contract_consignor',$data);
		}
		else
		{
			$data['pageTitle']	=	"View contract_consignor";
			$data['table']		=	"Designation";
			$data['view']		=	$this->Commonsql_model->select_conginor_contract(array('a.consignorID'=>$this->uri->segment(2)));
			$this->load->view('admin/contract_consignor/approve_contract_consignor',$data);
		}
	}
	function approve_contract_consignor_json()
	{
		if (!$this->session->userdata('SESS_userId')) {return FALSE; }
		$result	=	$this->Commonsql_model->select_conginor_contract_mod($this->uri->segment(3));
		$output = array();$i=1;
		foreach($result->result() as  $value) {
			$vaules=array();
			$vaules['ID']			=	$i++;
			$vaules['name'] 		= 	$value->name;
			$vaules['from'] 		= 	$value->from;
			$vaules['to'] 			= 	$value->to;
			
			$vaules['length'] 		= 	$value->vehicleLength;
			$vaules['weight'] 		= 	$value->vehicleCapacity;
			$vaules['date'] 		= 	date('d-m-Y',strtotime($value->dated));
			
			$vaules['sign'] 		= 	$value->signedby;
			$vaules['total'] 		= 	$value->grandTotal;
			
			if ($value->active == 1) 
			{
              
			  $row = '<span class="label bg-greensea">Active</span>';
			}
			else
			{
				$row = '<span class="label bg-red">De-Active</span>';
			}
			$vaules['active'] = $row;
			
			if($value->active==1)
			{
				if($j++==1)
				{
					$Approve	=	"<a href='".base_url()."manage/contract_consignor_mod_approve/".$value->consignorID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Approved</a>";
				}
				else
				{
					$Approve	=	'';
				}
				$active	=	"<a href='".base_url()."manage/approve_contract_consignor/".$value->consignorID.'/'.$value->consignor_modID."/0'role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 active'>Active</a>";
			}
			else
			{
				$Approve	=	'';
				$active	=	"<a href='".base_url()."manage/approve_contract_consignor/".$value->consignorID.'/'.$value->consignor_modID."/1' role='button' tabindex='0' class='delete text-danger text-uppercase text-strong text-sm mr-10 deactive'>De-Active</a>";
			}
			
			$vaules['Action'] 			=	$Approve."<a href='".base_url()."approve_contract_consignor/".$value->consignorID.'/'.$value->employetype_modID."'role='button' tabindex='0' class='edit text-primary text-uppercase text-strong text-sm mr-10'>Edit</a>".$active;
			
			$output[] =$vaules;
		}
		 echo json_encode(array('data'=>$output), true);
	}
	function contract_consignor_mod_approve()
	{
		$mod_id	=	$this->uri->segment(3);
		$data	=	$this->Commonsql_model->select('tblconsignor_mod',array('consignor_modID'=>$mod_id));
		if($data->num_rows()>0)
		{
			$val	=	$data->row();
			
				$values		=array('typename'		=>	$val->typename,
								'description'		=>	$val->description,
								'dbentrystateID'	=>	3,
								'approvedby'			=>	$this->session->userdata('SESS_userId'),
								'approvedon'			=>	date('Y-m-d h:i:s'));
							
				$cond		=	array('consignorID'	=>	$val->consignorID);
				
				$values_mod	=	array('dbentrystateID'	=>	3,
								'approvedby'			=>	$this->session->userdata('SESS_userId'),
								'approvedon'			=>	date('Y-m-d h:i:s'));
							
				$cond_mod	=	array('consignor_modID'	=>	$mod_id);
				$upt		=	$this->Commonsql_model->updateTable('tblconsignor', $cond , $values);
				$upt_m		=	$this->Commonsql_model->updateTable('tblconsignor_mod', $cond_mod , $values_mod);
				//echo $this->db->last_query();exit;
				if($upt)
				{
					$this->session->set_userdata('suc','Approved Successfully  Finished...!');
					redirect('approve-contract-consignor/'.$val->employetypeID);
					
				}
				else
				{
					$this->session->set_userdata('err','Error Please try again..!');
					redirect('approve-contract-consignor/'.$val->employetypeID);
				}
						
		}
	}
	
   
   
}