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

    /*
     * get a chat user to the system
     */

    public function get_order_user($order_id, $user_id = "") {
        $sql = "SELECT usr.first_name, usr.id, usr.type ";
        $sql .= 'FROM `order_users` AS `cu` ';
        $sql .= 'LEFT JOIN users usr ON cu.UserID = usr.id ';
        $sql .= 'WHERE OrderID = ? AND usr.isactive=1  AND cu.status=1 ';
        if ($user_id != "") {
            $sql .= 'AND cu.UserID !=?';
        }
        if ($user_id != "") {
            $rows = $this->db->query($sql, array($order_id, $user_id))->result();
        } else {
            $rows = $this->db->query($sql, array($order_id))->result();
        }

        return $rows;
    }

    /* get a chat between users to the system
     */

    function get_loginuser_order_ids($user_a = '') {
        $sql = 'SELECT userA.OrderID ';
        $sql .= 'FROM order_users userA ';
        $sql .= 'INNER JOIN order_users userB ON userA.OrderID = userB.OrderID ';
        $sql .= 'LEFT JOIN users user ON user.id = userB.UserID ';
        if ($user_a != '') {
            $sql .= 'WHERE userA.UserID = ? ';
        }
        $sql .= 'GROUP BY userA.OrderID ORDER BY userA.Added DESC';

        if ($user_a != '') {
            $rows = $this->db->query($sql, array($user_a))->result();
        } else {
            $rows = $this->db->query($sql)->result();
        }


        $order_ids = array(0);
        foreach ($rows as $row) {
            $order_ids[] = $row->OrderID;
        }
        return $order_ids;
    }

    /*
     * get a chat history to the system
     */

    public function get_order_history($order_ids = array(), $toUserIDs = array()) {

//        $sql = 'SELECT `cm`.* FROM `order_details` AS `cm` JOIN (SELECT OrderID, MAX(OrderDetailID) OrderDetailID FROM order_details GROUP BY OrderID) cm1 ON cm.OrderDetailID = cm1.OrderDetailID ';
//        $sql .= 'AND cm.Status = 1 ';
//        $sql .= 'AND `cm`.`OrderID` IN ? ';
//        if (!empty($toUserIDs)) {
//            $sql .= 'AND `cm`.`toUserIDs` Like ? ';
//        }
//        $sql .= 'ORDER BY `cm`.OrderDetailID DESC';
//        if (!empty($toUserIDs)) {
//            $rows = $this->db->query($sql, array($order_ids, $toUserIDs))->result_array();
//        } else {
//            $rows = $this->db->query($sql, array($order_ids))->result_array();
//        }

        $sql = 'SELECT MAX(od.Posted) as Posted,MAX(od.OrderDetailID) as OrderDetailID,od.OrderID,od.UserID,od.toUserIDs,od.toIDs,od.ccIDs,od.title,od.description,od.Status,od.order_status FROM `order_details` `od` ';
        $sql .= 'LEFT JOIN `order_details` od2 ';
        $sql .= 'ON od.OrderID = od2.OrderID AND od.OrderDetailID < od2.OrderDetailID ';
        //$sql .= 'WHERE `od2`.`OrderDetailID` IS NULL ';
        if (!empty($toUserIDs) && $this->session->userdata('login_type')!=0) {
            $sql .= 'WHERE `od`.`toUserIDs` Like ? ';
        }
            $sql .= 'GROUP BY od.OrderID ORDER BY Posted DESC';
        //$sql .= 'GROUP BY `cm`.OrderID ORDER BY `cm`.OrderDetailID DESC';
        if (!empty($toUserIDs) && $this->session->userdata('login_type')!=0) {
            $rows = $this->db->query($sql, array($toUserIDs))->result_array();
        }else{
            $rows = $this->db->query($sql)->result_array();
        }

        return $rows;
    }

    /*
     * get a unread chat to the system
     */

    public function get_unread_order($order_id, $UserID) {
        $sql = "SELECT od.OrderDetailID ";
        $sql .= 'FROM `order_details` AS `od` ';
        $sql .= 'LEFT JOIN order_users AS ou ON ou.OrderID = od.OrderID ';
        $sql .= 'LEFT JOIN unread_order AS uo ON uo.OrderID = od.OrderID AND uo.UserID = ? ';
        $sql .= 'WHERE uo.OrderDetailID IS NULL AND ou.OrderID = ? Group By od.OrderDetailID';
        $rows = $this->db->query($sql, array($UserID, $order_id))->result();

        $order_ids = array();
        foreach ($rows as $row) {
            $order_ids[] = $row->OrderDetailID;
        }
        return $order_ids;
    }

    public function is_unread_order($OrderDetailID, $UserID) {
        $sql = "SELECT od.OrderDetailID ";
        $sql .= 'FROM `order_details` AS `od` ';
        $sql .= 'LEFT JOIN order_users AS ou ON ou.OrderID = od.OrderID ';
        $sql .= 'LEFT JOIN unread_order AS uo ON uo.OrderDetailID = od.OrderDetailID AND uo.UserID = ? ';
        $sql .= 'WHERE uo.OrderDetailID IS NULL AND od.OrderDetailID = ? Group By od.OrderDetailID';
        $rows = $this->db->query($sql, array($UserID, $OrderDetailID))->result();

        $order_ids = array();
        foreach ($rows as $row) {
            $order_ids[] = $row->OrderDetailID;
        }
        return $order_ids;
    }

    public function insert_unread_order($array) {
        $this->db->where($array);
        $q = $this->db->get('unread_order');
        if ($q->num_rows() > 0) {
            $this->db->where($array);
            $this->db->update('unread_order', $array);
        } else {
            $this->db->set($array);
            $this->db->insert('unread_order', $array);
        }
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