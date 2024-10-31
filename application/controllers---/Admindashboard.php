<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admindashboard extends CI_Controller {


	public $data=array();
	function __construct() {
		parent::__construct();
		super_admin_session_check();
		$this->data['page_id']="AdminDashboard";
		$this->data['page_title']="AdminDashboard";
		$this->load->library('pagination');
		date_default_timezone_set('Asia/Kolkata');
		$this->load->helper('string');
		$this->load->helper('text');
	}
	 
	public function index(){
 
		$this->data['page_title']="AdminDashboard | CargoSuperAdmin"; 
	

		$this->load->view('head/admin_header',$this->data);
		$this->load->view('index');
		 
		$this->load->view('head/admin_footer');
	}
	 

	  
}//end Class