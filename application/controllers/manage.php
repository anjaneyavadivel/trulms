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

   

}
