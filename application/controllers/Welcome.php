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
//        //print_r($SESS_accessmap);
//        
//        
//        
//        echo $finalaccessmap = checkpageaccess(2,'','array');
//        exit();

        $headerData['pageTitle'] = 'Dashboard';
        // $this->load->view('admin/header',$headerData);
        $this->load->view('admin/dashboard', $headerData);
        $this->load->view('admin/footer');
    }

    //forgot_password
    function checkfield() {
        if (!$this->session->userdata('SESS_userId')) {
            return FALSE;
        }
        $this->form_validation->set_rules('checkvalue', 'Check Value', 'trim|required');
        $this->form_validation->set_rules('data_tb', 'Data Tb', 'trim|required');
        $this->form_validation->set_rules('data_col', 'Data Col', 'trim|required');
        if ($this->form_validation->run($this) == FALSE) {
            return FALSE;
        }
        $checkvalue = $this->input->post('checkvalue', TRUE);
        $table_name = 'tbl' . $this->input->post('data_tb', TRUE);
        $check_column = $this->input->post('data_col', TRUE);
        $whereData = array($check_column => $checkvalue);
        // Get user record
        $result = selectTable($table_name, $whereData);
        if (isset($result) && $result->num_rows() > 0) {
            ?>
            <font color="#FF0000"><?= "Sorry! " . $checkvalue . " already registered. Try another?"; ?></font>
            <?php
        } else {
            ?>
            <font color="#0000FF"><?= "Success! " . $checkvalue . " is available."; ?></font>
            <?php
        }
    }

    function active_deactive() {
        if (!$this->session->userdata('SESS_userId')) {
            return FALSE;
        }
        $this->form_validation->set_rules('type', 'type', 'trim|required');
        $this->form_validation->set_rules('tbname', 'Data Tb', 'trim|required');
        $this->form_validation->set_rules('id', 'id', 'trim|required');
        $this->form_validation->set_rules('tbcol', 'tb col', 'trim|required');
        $this->form_validation->set_rules('formname', 'form name', 'trim|required');
        if ($this->form_validation->run($this) == FALSE) {
            return FALSE;
        }
        $status = $this->input->post('type', TRUE);
        $table_name = 'tbl' . $this->input->post('tbname', TRUE);
        $id = $this->input->post('id', TRUE);
        $check_column = $this->input->post('tbcol', TRUE);
        $formname = $this->input->post('formname', TRUE);
        $whereData = array($check_column => $id);
        $updateData = array('active' => $status);
        $upt = activeDeactiveTable($table_name, $whereData, $updateData, $isStoreMod = 1, $check_column, $id, $formname);
        if ($upt > 0) {
            if ($status) {
                $this->session->set_userdata('suc', 'Success! Activated successfully.');
                //echo "Success! Activated successfully.";
            } else {
                $this->session->set_userdata('suc', 'Success! De-Activated successfully.');
                // echo "Success! De-Activated successfully.";
            }
        } else {
            $this->session->set_userdata('err', 'Sorry! Try another!');
        }echo 1;
    }

    function login() {
        if ($this->session->userdata('SESS_userId')) {
            redirect(base_url() . "dashboard");
        }

        if ($_POST) {
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_userdata('err', 'Mandatory fields are required!');
                redirect('login');
            } else {
                $this->load->library('encrypt');
                $username = TRIM($this->input->post('username', true));
                $password = TRIM($this->input->post('password', true));

                $orwhereData = array('username' => $username,'phone_number' => $username);
                $joins = array(
                    array(
                        'table' => 'tblemployee AS temp',
                        'condition' => 'temp.empID = tlog.empID',
                        'jointype' => 'LEFT'
                    ),
                );
                $columns = 'temp.*,password,tlog.lastLoginOn,tlog.isUserLocked,tlog.invalidPassAttemptCount,tlog.active AS tlogactive';
                $user_list = get_joins('tbllogin AS tlog', $columns, $joins, $whereData=array(),$orwhereData);

                if ($user_list->num_rows() == 1) {
                    $userlist = $user_list->result_array();
                    $userview = $userlist[0];

                    if ($userview['tlogactive'] == 0) {
                        $this->session->set_userdata('err', 'Your account is inactive!');
                        redirect('login');
                    }
                    if ($userview['isUserLocked'] == 1) {
                        $this->session->set_userdata('err', 'Your account is locked!');
                        redirect('login');
                    }
                    if ($userview['password'] != do_hash(do_hash(do_hash($password)))) {
                        $updateData = array('invalidPassAttemptCount' => $userview['invalidPassAttemptCount']+1,
                        'lastLoginOn' => date('Y-m-d h:i:s'));
                        $whereData = array('empID' => $userview['empID']);
                        $result = updatesingalTables('tbllogin', $whereData, $updateData);
                        $this->session->set_userdata('err', 'Your login information is incorrect!');
                        redirect('login');
                    }
                    //Store user Info to session
                    $this->session->set_userdata('SESS_userId', $userview['empID']);
                    $this->session->set_userdata('SESS_userCode', $userview['empCode']);
                    $this->session->set_userdata('SESS_userName', $userview['empname']);
                    $this->session->set_userdata('SESS_userBranchID', $userview['branchID']);
                    $this->session->set_userdata('SESS_userReportingTo', $userview['reportingto']);
                    $this->session->set_userdata('SESS_userPic', $userview['photo']);
                    // Check user role for login user and set in session
                    $role = array();
                    if ($userview['branchID'] == 0) {
                        $role[] = 1; // 1 - Super Admin
                    } else {
                        $whereData = array('empID' => $userview['empID'], 'dbentrystateID' => 3, 'active' => 1);
                        $showField = array('roleID');
                        // Get user record
                        $emprolemaps = selectTable('tblemprolemap', $whereData, $showField);
                        if (isset($emprolemaps) && $emprolemaps->num_rows() > 0) {
                            $emprolemaps = $emprolemaps->result();
                            foreach ($emprolemaps as $emprolemap) {
                                $role[] = $emprolemap->roleID;
                            }
                        }
                    }
                    $proxyIP = '';
                    $deviceIP = '';
                    // get proxy IP
                    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                        $proxyIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
                    }
                    // get device IP
                    if (isset($_SERVER['REMOTE_ADDR'])) {
                        $deviceIP = $_SERVER['REMOTE_ADDR'];
                    }
                    //detect Device type
                    if ($this->_detectDevice() == 'Mobile') {
                        $isMobile = 1;
                    } else {
                        $isMobile = 0;
                    }

                    $values = array(
                        'empID' => $userview['empID'],
                        'deviceIP' => $deviceIP,
                        'proxyIP' => $proxyIP,
                        'deviceMAC' => '',
                        'browser' => $_SERVER['HTTP_USER_AGENT'],
                        'platform' => php_uname(),
                        'isMobile' => $isMobile,
                        'isCrawler' => '',
                        'active' => 1);
                    $loginhistoryID = insertsingalTable('tblloginhistory', $values);

                    $updateData = array(
                        'invalidPassAttemptCount' => 0,
                        'lastLoginOn' => date('Y-m-d h:i:s'));
                    $whereData = array(
                        'empID' => $userview['empID']);
                    $loginhistoryID = updatesingalTables('tbllogin', $whereData, $updateData);

                    // set role array format in session 
                    $this->session->set_userdata('SESS_userRole', $role);
                    // set session for page role access
                    $pageroleaccessmap = pageroleaccessmap($role);
                    $this->session->set_userdata('SESS_accessmap', $pageroleaccessmap);

                    redirect(base_url() . "dashboard");
                } else {
                    $this->session->set_userdata('err', 'Your login information is incorrect!');
                    redirect('login');
                }
            }
        }
        $this->load->view('admin/login');
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
    function _detectDevice() {
        $userAgent = $_SERVER["HTTP_USER_AGENT"];
        $devicesTypes = array(
            "computer" => array("msie 10", "msie 9", "msie 8", "windows.*firefox", "windows.*chrome", "x11.*chrome", "x11.*firefox", "macintosh.*chrome", "macintosh.*firefox", "opera"),
            "tablet" => array("tablet", "android", "ipad", "tablet.*firefox"),
            "mobile" => array("mobile ", "android.*mobile", "iphone", "ipod", "opera mobi", "opera mini"),
            "bot" => array("googlebot", "mediapartners-google", "adsbot-google", "duckduckbot", "msnbot", "bingbot", "ask", "facebook", "yahoo", "addthis")
        );
        foreach ($devicesTypes as $deviceType => $devices) {
            foreach ($devices as $device) {
                if (preg_match("/" . $device . "/i", $userAgent)) {
                    $deviceName = $deviceType;
                }
            }
        }
        return ucfirst($deviceName);
    }

}
