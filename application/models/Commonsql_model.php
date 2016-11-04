<?php

/**
 * User details
 * 
 * Description...
 * 
 * @package user
 * @author anjaneya <your@email.com>
 * @version 0.0.0
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Commonsql_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /*
     * Add a new user to the system
     * $tableName -> Name of the table
     * $tableData -> Array -> Table data
     */

    function insert_table($tableName, $tableData = array()) {
        // Insert the user record
        if (isset($tableData) && count($tableData) > 0) {
            $this->db->insert($tableName, $tableData);
            return $this->db->insert_id();
        }
        return false;
    }

    /* get the data to table
     * $tableName -> Name of the table
     * $whereData -> Array -> where fields
     * $showField -> Array -> what are the fields need to show
     *  */

    public function selectTable($tableName, $whereData = array(), $showField = array('*'), $orWhereData = array(),$inWhereData = array(),$notInWhereData = array(), $group = array(), $order = '', $having = '', $limit = array(), $result_way = 'all', $echo = 0) {
        //print_r($limit);echo $limit[0];exit();
        
        
        $this->db->select($showField);
        $this->db->from($tableName);
        if (!empty($whereData) > 0) {
            $this->db->where($whereData);
        }
        if (isset($orWhereData) && !empty($orWhereData)) {
            $this->db->or_where($orWhereData);
        }
        if (isset($inWhereData) && !empty($inWhereData)) {
            $this->db->where_in($inWhereData[0],$inWhereData[1]);
        }
        if (!empty($group)) {
            $this->db->group_by($group);
        }
        if ($order != '') {
            $this->db->order_by($order);
        }
        if (isset($limit[1])) {
            $this->db->limit($limit[0],$limit[1]); //example $limit[0] = "0,10" where  0 is for offset and 10 for limit
        }else if (isset($limit[0])) {
            $this->db->limit($limit[0]); //example $limit[0] = "0,10" where  0 is for offset and 10 for limit
        }
        $query = $this->db->get();
        switch ($result_way) {
            case 'row':
                $result = $query->row();
                break;
            case 'row_array':
                $result = $query->row_array();
                break;
            case 'count':
                $result = $query->num_rows();
                break;
            case 'result_array':
                $result = $query->result_array();
                break;
            default:
                $result = $query;
                break;
        }
        if ($echo == 1) {
            echo $this->db->last_query();
            exit;
        }
        return $result;
    }

    public function inselectTable($tableName, $whereData = array(), $showField = array('*'), $orWhereData = array(), $inField = '', $inWhereData = array()) {
        $this->db->select($showField);
        $this->db->from($tableName);
        if (!empty($whereData) > 0) {
            $this->db->where($whereData);
        }
        if ($inField != '') {
            $this->db->where_in($inField, $inWhereData);
        }

        $query = $this->db->get();

        return $query;
    }

    /* update the data to table
     * $tableName -> Name of the table
     * $whereData -> Array -> where fields
     * $updateData -> Array -> updated fields and data
     *  */

    public function updateTable($tableName, $whereData = array(), $updateData = array()) {
        $this->db->where($whereData);
        $this->db->update($tableName, $updateData);
        $return = $this->db->affected_rows() == 1;
        return $return;
        //$query->result_array();
        //$query->num_rows();
    }

    /* update the data to table
     * $tableName -> Name of the table
     * $whereData -> Array -> where fields
     * $updateData -> Array -> updated fields and data
     *  */

    public function deleteTableData($tableName, $whereData = array()) {
        // Insert the user record
        if (isset($whereData) && count($whereData) > 0) {
            $insert_id = $this->db->delete($tableName, $whereData);
            return true;
        }
        return false;
    }

	function select_all($table,$feild='')
	{
		$this->db->select('*');
		$this->db->from($table);
		if($feild !='')
		$this->db->order_by($feild,'desc');
		$query	=	$this->db->get();
		return $query;
	}
	function select($table,$condtion)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($condtion);
		$query	=	$this->db->get();
		return $query;
	}
	function select_desc($table,$condtion,$feild)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($condtion);
		$this->db->order_by($feild,'desc');
		$query	=	$this->db->get();
		return $query;
	}
	function select_conginor_contract($cond=array())
	{
		if(!empty($cond))
		{
			$this->db->select('*');
		}
		else
		{
			$this->db->select('a.*,b.from,b.to,b.vehicleLength,b.vehicleCapacity,b.dated,b.signedby,c.grandTotal,d.name');
		}
		$this->db->from('tblconsignor as a');
		$this->db->join('tblcontract as b','a.consignorID=b.consignorID','inner');
		$this->db->join('tblcontractversionmap as c','b.contractID=c.contractID','inner');
		$this->db->join('tblcontactdetails as d','a.contactID=d.contactID','inner');
		if(!empty($cond))
		{
			$this->db->where($cond);
		}
		$this->db->order_by('a.consignorID','desc');
		$query	=	$this->db->get();
		return $query;
	}
	function select_conginor_contract_mod($cond=array())
	{
		if(!empty($cond))
		{
			$this->db->select('*');
		}
		else
		{
			$this->db->select('a.*,b.from,b.to,b.vehicleLength,b.vehicleCapacity,b.dated,b.signedby,c.grandTotal,d.name');
		}
		$this->db->from('tblconsignor_mod as a');
		$this->db->join('tblcontract_mod as b','a.consignorID=b.consignorID','inner');
		$this->db->join('tblcontractversionmap_mod as c','b.contractID=c.contractID','inner');
		$this->db->join('tblcontactdetails_mod as d','a.contactID=d.contactID','inner');
		$this->db->where('a.consignorID',$cond);
		$this->db->order_by('a.consignor_modID','desc');
		$query	=	$this->db->get();
		return $query;
	}
	function select_exist_conginor_contract($cond=array())
	{
		$this->db->select('d.contactID,d.name');
		$this->db->from('tblconsignor as a');
		$this->db->join('tblcontactdetails as d','a.contactID=d.contactID','inner');
		$this->db->where('a.active',1);
		$this->db->order_by('a.consignorID','desc');
		$query	=	$this->db->get();
		return $query;
	}
	function select_all_employee()
	{
		$this->db->select('a.empID,a.empCode,a.empname,a.qualification,a.mobile,a.mailoffice,a.remarks,a.active,a.joiningdate,a.releavingdate,b.department,c.name');
		$this->db->from('tblemployee as a');
		$this->db->join('tbldept as b','a.deptID=b.deptID','inner');
		$this->db->join('tbldesignation as c','a.designation=c.desigID','inner');
		$this->db->order_by('empID','desc');
		$query	=	$this->db->get();
		return $query;
	}
	
	function select_all_employee_mod($id)
	{
		$this->db->select('a.emp_modID,a.empID,a.empCode,a.empname,a.qualification,a.mobile,a.mailoffice,a.remarks,a.active,a.joiningdate,a.releavingdate,b.department,c.name');
		$this->db->from('tblemployee_mod as a');
		$this->db->join('tbldept as b','a.deptID=b.deptID','inner');
		$this->db->join('tbldesignation as c','a.designation=c.desigID','inner');
		$this->db->where('a.empID',$id);
		$this->db->order_by('emp_modID','desc');
		$query	=	$this->db->get();
		return $query;
	}
	function select_all_driver()
	{
		$this->db->select('a.driverID,a.dlno,a.dlexpirydt,a.active,b.name,b.phone1,b.addressline1');
		$this->db->from('tbldriver as a');
		$this->db->join('tblcontactdetails as b','b.contactID=a.contactID','inner');
		$this->db->order_by('driverID','desc');
		$query	=	$this->db->get();
		return $query;
	}
	function select_all_driver_mod($id)
	{
		$this->db->select('a.driver_modID,a.driverID,a.dlno,a.dlexpirydt,a.active,b.name,b.phone1,b.addressline1');
		$this->db->from('tbldriver_mod as a');
		$this->db->join('tblcontactdetails as b','b.contactID=a.contactID','inner');
		$this->db->where('a.driverID',$id);
		$this->db->order_by('driver_modID','desc');
		$query	=	$this->db->get();
		return $query;
	}
	function select_all_driver_mod_where($id)
	{
		$this->db->select('*');
		$this->db->from('tbldriver_mod as a');
		$this->db->join('tblcontactdetails as b','b.contactID=a.contactID','inner');
		$this->db->where('a.driver_modID',$id);
		$this->db->order_by('a.driver_modID','desc');
		$query	=	$this->db->get();
		return $query;
	}
	function select_driver_edit($id)
	{
		$this->db->select('*');
		$this->db->from('tbldriver as a');
		$this->db->join('tblcontactdetails as b','b.contactID=a.contactID','inner');
		$this->db->where('a.driverID',$id);
		$query	=	$this->db->get();
		return $query;
	}
	function select_all_vowner()
	{
		$this->db->select('a.ownerID,a.contactPer1,a.active,b.companyName,b.phone1');
		$this->db->from('tblvehicleowner as a');
		$this->db->join('tblcontactdetails as b','b.contactID=a.contactID','inner');
		$this->db->order_by('ownerID','desc');
		$query	=	$this->db->get();
		return $query;
	}
	function select_all_vowner_edit($id)
	{
		$this->db->select('*');
		$this->db->from('tblvehicleowner as a');
		$this->db->join('tblcontactdetails as b','b.contactID=a.contactID','inner');
		$this->db->where('a.ownerID',$id);
		$this->db->order_by('ownerID','desc');
		$query	=	$this->db->get();
		return $query;
	}
	function select_all_vowner_mod($id)
	{
		$this->db->select('a.owner_modID,a.ownerID,a.contactPer1,a.active,b.name,b.companyName,b.phone1');
		$this->db->from('tblvehicleowner_mod as a');
		$this->db->join('tblcontactdetails as b','b.contactID=a.contactID','inner');
		$this->db->where('a.ownerID',$id);
		$this->db->order_by('a.owner_modID','desc');
		$query	=	$this->db->get();
		return $query;
	}

}

/* End of file user_groups.php */
/* Location: ./application/models/user_groups.php */