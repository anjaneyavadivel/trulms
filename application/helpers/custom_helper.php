<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


if (!function_exists('pageroleaccessmap')) {
    /*
     * This function will return all page permission of a user. 
     * $role_arr - array() role id for login user
     * $final_accessmap  - return  page role access following format array(0=>'create',1=>'view',2=>'modify',3=>'approve',4=>'delete');
     */

    function pageroleaccessmap($role_arr=array()) {
        $CI = & get_instance();
        $finalaccessmap = array();
        // check vaild input
        if(empty($role_arr)){return $final_accessmap;}
        // check super admin role 
        
        $whereData = array('dbentrystateID' => 3, 'active' => 1);
        $showField = array('pageID','url','menuCaption');
        // Get user record
        $tblpages = selectTable('tblpages', $whereData, $showField);

        if ($tblpages->num_rows() >0) {
            $pageslists = $tblpages->result();
             foreach ($pageslists as $pageslist) {
                $final_accessmap = array();
                if(in_array(1, $role_arr)){
                    $final_accessmap = array(0=>'create',1=>'view',2=>'modify',3=>'approve',4=>'delete');
                }else{
                    $whereData = array('pageID' => $pageslist->pageID,'dbentrystateID' => 3, 'active' => 1);
                    $showField = array('*');
                    $inWhereData = array('roleID',$role_arr);
                    // Get user record
                    $pageroleaccessmaps = selectTable('tblpageroleaccessmap', $whereData, $showField, $orWhereData = array(),$inWhereData);
                    if (isset($pageroleaccessmaps) && $pageroleaccessmaps->num_rows() > 0) {
                        $pageroleaccessmaps = $pageroleaccessmaps->result();
                        foreach ($pageroleaccessmaps as $pageroleaccessmap) {
                            if($pageroleaccessmap->createEnabled){$final_accessmap[]='create';}
                            if($pageroleaccessmap->viewEnabled){$final_accessmap[]='view';}
                            if($pageroleaccessmap->modifyEnabled){$final_accessmap[]='modify';}
                            if($pageroleaccessmap->approveEnabled){$final_accessmap[]='approve';}
                            if($pageroleaccessmap->deleteEnabled){$final_accessmap[]='delete';}
                        }
                    }
                    $final_accessmap = array_unique($final_accessmap);
                }
                $finalaccessmap[$pageslist->url]=$final_accessmap;
            }

        }
        return $roleaccessmap = json_encode($finalaccessmap, true);
        //return $final_accessmap;
    }

}

if (!function_exists('checkpageaccess')) {
    /*
     * This function will return all parents of a user. 
     * $pageID -  which page need to access for login user
     * $access -  0 - all, 1 -module leavel  check page access permission for login user (like : create,view,modify,approve,delete)
     * $subpage - menu - default for menu acces OR screen name (create,view,modify,approve,delete) , Note: need to set $access=1
     * $format - json , array
     * $final_accessmap  - return  page role access following format array(0=>'create',1=>'view',2=>'modify',3=>'approve',4=>'delete');
     */

    function checkpageaccess($pageUrl='',$access=0,$subpage='',$format='array') {
        $CI = & get_instance();
        $finalaccessmap = array();
        // check vaild input
        if($pageUrl==''){return FALSE;}
        $SESS_userRole = $CI->session->userdata('SESS_userRole');
        if(in_array(1, $SESS_userRole)){
             return TRUE;
        }
        $SESS_accessmap = $CI->session->userdata('SESS_accessmap');
        $json = json_decode($SESS_accessmap, true);
       // print_r($SESS_accessmap);
        // check particular page acess
        if($access==0){
            if(isset($json[$pageUrl])){
                if($format=='json'){
                    return $finalaccessmap = json_encode($json[$pageUrl], true);
                }else{
                    return $json[$pageUrl];
                }
            }
            return FALSE;
        }else if($access==1){
            if($subpage=='menu'){
                if(isset($json[$pageUrl]) && !empty($json[$pageUrl])){
                    return TRUE;
                }
            }else if($subpage!=''){
                if(isset($json[$pageUrl]) && in_array($subpage, $json[$pageUrl])){
                    return TRUE;
                }
            }
            return FALSE;
        }
         return FALSE;
    }

}

//
//if (!function_exists('pageroleaccessmap')) {
//    /*
//     * This function will return all parents of a user. 
//     * This includes children and input level users.
//     * @src_arr  total user_groups table
//     * @currentid  id of the user whose parent are to be found
//     *  
//     */
//
//    function pageroleaccessmap($role_arr=array(), $pageID='') {
//        $CI = & get_instance();
//        $final_accessmap = array(0);
//        $childs1 = array();
//        $childs2 = array();
//        
//        //Stage-1
//        $toal_users1 = 0;
//        $CI->db->select('parent_id')->from('users_groups')->where('user_id', $user_id)->where_in('status', $status);
//        $users_list1 = $CI->db->get();
//        $toal_users1 = $users_list1->num_rows();
//        if ($toal_users1 > 0) {
//            foreach ($users_list1->result() as $row1) {
//                $childs1[] = $row1->parent_id;
//            }
//            $final_users = $childs1;
//            $childs2 = $childs1;
//        }
//
//        //Stage-2
//        while (count($childs2) > 0) {
//            $toal_users2 = 0;
//            $CI->db->select('parent_id')->from('users_groups')->where_in('user_id', $childs2)->where_in('status', $status);
//            $users_list2 = $CI->db->get();
//            $toal_users2 = $users_list2->num_rows();
//            if ($toal_users2 > 0) {
//                $childs2 = array();
//                foreach ($users_list2->result() as $row2) {
//                    $childs2[] = $row2->parent_id;
//                }
//                $final_users = array_merge($final_users, $childs2);
//            } else {
//                $childs2 = array();
//            }
//        }
//
//        //Stage-3 IF Parent Found
//        if ($parentfound == TRUE) {
//            $parent[] = $user_id;
//            $final_users = array_merge($final_users, $parent);
//        }
//
//        $CI->db->select()->from('users_groups')->where_in('user_id', $final_users)->where_in('status', $status);
//        if ($group_id > 0) {
//            $CI->db->where('group_id', $group_id);
//        }
//        $res = $CI->db->get();
//        return $res->result_array();
//    }
//
//}
/**
 * token dynamic value generator
 *
 * @return dynamic value
 * @author anch
 * */
if (!function_exists('token')) {

    function token() {
        $CI = & get_instance();
        $token = md5(uniqid(rand(), true));
        return $token;
    }

}
/**
 * token dynamic value generator for head
 *
 * @return dynamic value
 * @author anch
 * */
if (!function_exists('tokenhead')) {

    function tokenhead() {
        $CI = & get_instance();
        $token = md5(uniqid(rand(), true));
        $CI->session->set_userdata('tokenhead', $token);
        return $token;
    }

}

if (!function_exists('replaceduplicatesstring')) {

    function replaceduplicatesstring($string, $stringreplaced = '') {
        $string = preg_replace('/' . $stringreplaced . '+/', '^', $string);
        $string = preg_replace('/[\^]+/', '^', $string);
        return $string = preg_replace('/[\^]/', $stringreplaced, $string);
    }

}


if (!function_exists('set_option')) {

    function set_option($current_value, $actual_value) {
        if ($current_value === $actual_value) {
            return "selected='selected'";
        }
        return "";
    }

}

/* Delete file from given path 
 * @path  is file path for which file we want to delete
 * @filename  is file name for which file we want to delete
 */
if (!function_exists('delete_file')) {

    function delete_file($filename = '', $path = './uploads/') {
        //$filename='1377177919free-beautiful-landscape.jpg';
        if (is_file($path . $filename))
            unlink($path . $filename);
    }

}

/* resize image 
 * @source_imagename - This is source file name
 * @new_imagename - This is new file file name for thumb(after resize)
 * @width - This is width size to resize
 * @height - This is height size to resize
 * @source_image_path - This is orginal file path
 * @new_image_path - This is new file path for after resize file save
 */
if (!function_exists('resize_image')) {

    function resize_image($source_imagename = '', $new_imagename = '', $width = 500, $height = 500, $source_image_path = './uploads/', $new_image_path = './uploads/') {

        // resize image		
        $CI = & get_instance();
        $CI->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source_image_path . $source_imagename; //'./uploads/gaga.jpg';
        $config['new_image'] = $new_image_path . $new_imagename; //'./uploads/new_gaga.jpg';
        // find size
        $data = getimagesize($source_image_path . $source_imagename);
        $width_org = $data[0];
        $height_org = $data[1];

        $config['width'] = $width;
        $config['height'] = $height;
        if ($width_org > $width || $height_org > $height) {
            $CI->image_lib->initialize($config);
            $CI->image_lib->resize();
        }
    }

}

/* Image file upload 
 * @imagename - This is source file name
 * @image_path - This is upload path
 */
if (!function_exists('do_upload_image')) {

    function do_upload_image($imagename = 'name', $image_path = './uploads/') {

        // resize image		
        $CI = & get_instance();
        $config['upload_path'] = $image_path;
        $config['allowed_types'] = 'png|jpeg|jpg|gif|doc|docx|xlsx|xls|pdf';
        $config['max_size'] = '5120';
        $config['remove_spaces'] = true;
        $config['overwrite'] = false;
        $config['encrypt_name'] = false;
        $config['max_width'] = '';
        $config['max_height'] = '';
        $CI->load->library('upload', $config);
        $CI->upload->initialize($config);
        if (!$CI->upload->do_upload($imagename)) {
            echo $data['errors'] = $CI->upload->display_errors(); // this isn't working
            return false;
        } else {
            $finfo1 = $CI->upload->data();
            $file_name1 = $finfo1['file_name'];
            // resize image
            //resize_image($file_name1,$file_name1,$width=500,$height=500,$image_path,$image_path);
            return $finfo = $CI->upload->data();
        }
    }

}
if (!function_exists('evaluate_string')) {

    function evaluate_string($string, $replacement = "Unknown") {
        if (trim($string) == "") {
            return $replacement;
        }
        return $string;
    }

}

if (!function_exists('timeAgo')) {

    function timeAgo($time) {
        $periods = array("sec", "min", "hour", "day", "week", "month", "year", "decade");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");
        $now = time();
        $difference = $now - $time;
        $tense = "";

        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);
        if ($difference <= 0) {
            return 'Just Now';
        }
        if ($difference != 1) {
            $periods[$j].= "s";
        }
        $return = "$difference $periods[$j] $tense";

        return $return;
    }

}


/*
 * @array -> source array
 * @key   -> key value to be considered
 * @values -> the value array that is used to remove the element of array
 */
if (!function_exists('removeElementWithValue')) {

    function removeElementWithValue($array, $key, $values) {
        foreach ($array as $subKey => $subArray) {
            foreach ($values as $value) {
                if ($subArray[$key] == $value) {
                    unset($array[$subKey]);
                }
            }
        }
        return $array;
    }

}

/*
 * @array -> source array
 * @key   -> key value to be considered
 */
if (!function_exists('arraypicker')) {

    function arraypicker($array, $key) {
        return $array[$key];
    }

}

if (!function_exists('formatarray')) {
    /*
     * This function will returns an formatted array
     * $array  array to be formatted
     *  
     */

    function formatarray($array) {
        $results = array();

        if (is_array($array)) {
            $arrkeys = array_keys($array);
            foreach ($arrkeys as $key) {
                foreach ($array as $subarray) {
                    $results[$key][] = $subarray[$key];
                }
            }
        }

        return $results;
    }

}
if (!function_exists('formatarrayvalue')) {
    /*
     * This function will returns an formatted array
     * $array  array to be formatted
     *  
     */

    function formatarrayvalue($array) {
        $results = array();

        if (is_array($array)) {
            foreach ($array as $value) {
                    $results[] = $value;
            }
        }

        return $results;
    }

}

if (!function_exists('formatdate')) {
    /*
     * This function will returns an formatted array
     * $array  array to be formatted
     *  
     */

    function formatdate($date, $format = 'd-m-Y', $placeholder = "") {
        //echo $date;
        if (trim($date) != "0000-00-00 00:00:00" && trim($date) != "1970-01-01 00:00:00" && trim($date) != "") {
            return date($format, strtotime($date));
        } else if ($placeholder != "") {
            return $placeholder;
        }
        return date($format);
    }

}

if (!function_exists('searcharray')) {
    /*
     * This function will return array containing searched value in the key. 
     * @src_arr  array to be searched
     * @key      key to be searched
     * @value    value on the key to be searched
     *  
     */

    function searcharray($array, $key, $value) {
        $results = array();

        if (is_array($array)) {
            if (isset($array[$key]) && $array[$key] == $value)
                $results[] = $array;

            foreach ($array as $subarray)
                $results = array_merge($results, searcharray($subarray, $key, $value));
        }

        return $results;
    }

}

if (!function_exists('objectToArray')) {

    function objectToArray($d) {
        if (is_object($d)) {
            // Gets the properties of the given object
            // with get_object_vars function
            $d = get_object_vars($d);
        }

        if (is_array($d)) {
            /*
             * Return array converted to object
             * Using __FUNCTION__ (Magic constant)
             * for recursive call
             */
            return array_map(__FUNCTION__, $d);
        } else {
            // Return array
            return $d;
        }
    }

}

if (!function_exists('profile_pic')) {

    function profile_pic($image) {
        if (trim($image) != "" && file_exists("./uploads/profile/$image")) {
            return base_url() . "uploads/profile/$image";
        } else {
            return base_url() . "uploads/profile/thumbnail/noprofile.png";
        }
    }

}
if (!function_exists('cover_pic')) {

    function cover_pic($image) {
        if (trim($image) != "" && file_exists("./uploads/cover_photo/$image")) {
            return base_url() . "/uploads/cover_photo/$image";
        } else {
            return base_url() . "assets-v2/img/cover2.png";
        }
    }

}

if (!function_exists('setstringlength')) {

    function setstringlength($string, $wordlength = 2) {
        if (trim($string) != "") {
            $pieceslength = 0;
            $output = preg_replace('!\s+!', ' ', $string);
            $pieces = explode(" ", $output);
            $pieceslength = count($pieces);
            $first_part = implode(" ", array_splice($pieces, 0, $wordlength));
            if ($pieceslength > $wordlength) {
                return $first_part . "..";
            } else {
                return $first_part;
            }
            //$other_part = implode(" ", array_splice($pieces, $wordlength));
        }
    }

}

if (!function_exists('cURL')) {

    function cURL($url, $header = NULL, $cookie = NULL, $p = NULL) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, $header);
        curl_setopt($ch, CURLOPT_NOBODY, $header);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_COOKIE, $cookie);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        if ($p) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $p);
        }
        $result = curl_exec($ch);

        if ($result) {
            return $result;
        } else {
            return curl_error($ch);
        }
        curl_close($ch);
    }

}

// send E- Mail to personal mail id
/*
 * $fromemail = array('frommailid@mail.com','from_user_name_or_title');
 * $toemail = array('tomailid_1@mail.com','tomailid_2@mail.com','tomailid_3@mail.com');
 * $replyto = array('frommailid@mail.com','replay_user_name_or_title');
 * $subject = 'Title of mail';
 * $message = 'Content of mail';
 */

if (!function_exists('sendemail')) {

    function sendemail($fromemail = array(), $toemail = array(), $replyto = array(), $subject, $message) {
        //$this->load->helper('string');
        //echo $password= random_string('alnum', 10);
        // message
//        $content = "<html>
//<head>
//  <title>Youth System</title>
//</head>
//<body>
//  <p></p>
//  <table width=\"100%\">
//    <tr>
//      <td style=\"background-color:#000\"><img src=\"" . base_url() . "/assets/img/logo.png\" alt=\"YouthHub\"></td>
//    </tr>
//    <tr>
//      <td><br><br>" . nl2br($message) . "</td>
//    </tr>
//    <tr>
//      <td><br><br>
//		<br>
//		Thank you for using YouthHub.
//		<br>
//		<br>
//		<br>
//		Cheers,<br>
//		YouthHub team.</td>
//    </tr>
//  </table>
//</body>
//</html>";
        $content = '<div style="width:100%!important;min-width:100%;font-size:15px;margin:0;padding:0;font-family:arial,sans-serif;color:#42464d">
                        <table style="border-spacing:0;border-collapse:collapse;width:100%;vertical-align:top;margin:0;padding:0;color:#42464d">
                          <tbody><tr>
                            <td>
                              <table style="border-spacing:0;border-collapse:collapse;width:100%;vertical-align:top;max-width:640px;color:#fff;margin:0 auto;padding:0;background-color: #002550;">
                                <tbody><tr>
                                  <td>
                                    <table style="border-spacing:0;border-collapse:collapse;width:100%;vertical-align:top;margin:0;padding:0">
                                      <tbody><tr>
                                        <td>
                                            <img alt="" src="' . base_url() . 'assets/img/logo.png" style="width:120px;margin:10px" class="CToWUd">
                                        </td>
                                      </tr>
                                    </tbody></table>
                                  </td>
                                </tr>
                              </tbody></table>

                              <div style="background:#f9f9f9;padding:40px 0;margin:10px 0;border-bottom:1px solid #efefef">
                                <table style="border-spacing:0;border-collapse:collapse;width:100%;vertical-align:top;max-width:640px;margin:0 auto;padding:0;font-size:15px">
                                  <tbody><tr>
                                    <td>

                    <h1><span style="display:inline-block;width:10px;background:#0fa2e2;min-height:32px;margin-right:15px;vertical-align:top"></span>' . $subject . '</h1>

                      <table style="border-spacing:0;border-collapse:collapse;width:100%;vertical-align:top;text-align:center;margin:20px 0;padding:0">
                        <tbody><tr>
                          <td>' . nl2br($message) . '
                              <br>

                    <a style="color:#fff;text-decoration:none;display:inline-block;color:#fff;border-radius:2px;border-bottom-width:2px;border-bottom-color:#00a462;border-bottom-style:solid;background:#00cb6f;padding:15px 40px;margin:10px auto;font-size:18px" href="' . base_url() . '" target="_blank">
                      Click here to login
                    </a>
                            <div align="center" style="color:#aaa;font-size:14px">
                              Discover - Collaborate - Empower
                            </div>
                          </td>
                        </tr>
                      </tbody></table>
                                    </td>
                                  </tr>
                                </tbody></table>
                              </div>

                              <table style="border-spacing:0;border-collapse:collapse;width:100%;vertical-align:top;text-align:center;margin:0 auto;padding:0">
                                <tbody><tr>
                                  <td align="center">


                                        <table style="border-spacing:0;border-collapse:collapse;width:100%;vertical-align:top;max-width:580px;margin:10px auto;padding:0;font-size:12px">
                        </table>
                                    <table style="max-width:640px;text-align:center;border-spacing:0;border-collapse:collapse;width:100%;vertical-align:top;margin:0 auto;padding:0">
                                      <tbody><tr>
                                        <td align="center">
                                          <p style="font-size:12px">
                                            Made with love by <a href="" style="color:#00a1e9" target="_blank"><span class="il">YouthHub</span></a>
                                          </p>
                                        </td>
                                      </tr>
                                    </tbody></table>

                                  </td>
                                </tr>
                              </tbody></table>
                            </td>
                          </tr>
                        </tbody></table>

                    </div></div>';
        //$to = 'anjaneyavadivel@gmail.com';
        $toemail_separated = implode(",", $toemail);
        //$subject = 'Website Change Reqest';
        //	if(count($fromemail)<=0){
        //		$fromemail = array('manager.tradezap@gmail.com','YouthHub');
        //	}
        //	if(count($replyto)<=0){
        //		$replyto = array('frommailid@mail.com','YouthHub');
        //	}


        $headers = "From: " . $fromemail[1] . " <" . $fromemail[0] . "> \r\n";
        $headers .= "Reply-To: " . $replyto[1] . " <" . $replyto[0] . "> \r\n";
        //$headers .= "CC: susan@example.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers .= "Bcc: manager.tradezap@gmail.com\r\n";


        // Mail it
        //mail('manager.tradezap@gmail.com', $subject, $content, $headers);
        return mail($toemail_separated, $subject, $content, $headers);
    }

}

if (!function_exists('group_dh_time_ago')) {

    function group_dh_time_ago($val, $format, $sep) {
        //$val="2015-10-04 14:01:00"; $format=0; $sep=1;
        //date_default_timezone_set("Asia/Calcutta");
        $val1 = strtotime($val);
        $cur_time = time();
        $time_elapsed = $cur_time - $val1;
        $seconds = $time_elapsed;
        $minutes = round($time_elapsed / 60);
        $hours = round($time_elapsed / 3600);
        $days = round($time_elapsed / 86400);
        $weeks = round($time_elapsed / 604800);
        $months = round($time_elapsed / 2600640);
        $years = round($time_elapsed / 31207680);

        $df1 = array('Y F d', 'd M Y', 'Y M d',);
        $df2 = array('F d', 'd M', 'M d');
        $tf = array('h:ia', 'h:i A', 'h:ia');
        $seperator = array('', ' at ');

        //Seconds
        if ($seconds <= 60) {
            return "just now";
        }
        //Minutes
        else if ($minutes <= 60) {
            if ($minutes == 1) {
                return "a minute ago";
            } else {
                return "$minutes minutes";
            }
        }
        //Hours
        else if ($hours <= 24) {
            if ($hours == 1) {
                return "an hour ago";
            } else {
                return "$hours hrs";
            }
        }
        //Days
        else if ($days <= 7) {
            if ($days == 1) {
                return "Yesterday" . $seperator[$sep] . date($tf[$format], $val1);
            } else {
                return "$days days ago";
            }
        }
        //Past Year
        else if (date('Y', $val1) < date('Y', $cur_time)) {
            return date($df1[$format], $val1) . $seperator[$sep] . date($tf[$format], $val1);
        }
        //Current Year
        else {
            return date($df2[$format], $val1) . $seperator[$sep] . date($tf[$format], $val1);
        }
    }

}

if (!function_exists('enable_disable_approve_deactive_html')) {

    function disable_approve_deactive_html($onclick_values)
	{
		return '<a href="javascript::" data-toggle="modal" data-target="#active-deactive1" data-options="splash-2 splash-ef-11" role="button" tabindex="0" class=" text-danger text-uppercase text-strong text-sm mr-10 " onclick="active_deactive_class('.$onclick_values.')">De-Active</a>';
	}

}
if (!function_exists('enable_approve_deactive_html')) {

    function enable_approve_deactive_html($onclick_values)
	{
		return '<a href="javascript::" data-toggle="modal" data-target="#active-deactive1" data-options="splash-2 splash-ef-11" role="button" tabindex="0" class="text-success text-uppercase text-strong text-sm mr-10" onclick="active_deactive_class('.$onclick_values.')">Active</a>';
	}

}
if (!function_exists('approve_html')) {

    function approve_html($onclick_values)
	{
		return '<a href="javascript::" data-toggle="modal" data-target="#active-deactive1" data-options="splash-2 splash-ef-11" role="button" tabindex="0" class="text-primary text-uppercase text-strong text-sm mr-10" onclick="active_deactive_class('.$onclick_values.')">Approved</a>';
	}

}

/* End of file custom_helper.php */
?>