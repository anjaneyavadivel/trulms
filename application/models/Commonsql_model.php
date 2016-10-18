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

    public function selectTable($tableName, $whereData = array(), $showField = array('*'), $orWhereData = array(), $group = array(), $order = '', $having = '', $limit = array(), $result_way = 'all', $echo = 0) {
        //print_r($limit);echo $limit[0];exit();
        
        
        $this->db->select($showField);
        $this->db->from($tableName);
        if (!empty($whereData) > 0) {
            $this->db->where($whereData);
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

	function select_all($table)
	{
		$this->db->select('*');
		$this->db->from($table);
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

}

/* End of file user_groups.php */
/* Location: ./application/models/user_groups.php */