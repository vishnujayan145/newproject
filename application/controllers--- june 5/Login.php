<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public $data=array();
	function __construct() {
	parent::__construct();
	admin_session_check();
	$this->data['page_id']="admin";
	$this->data['page_title']="";
	$this->load->library('pagination');
	date_default_timezone_set('Asia/Kolkata');
	$this->load->helper('string');
	$this->load->helper('text');
	}
	public function index()
	{
		if(isset($this->session->userdata['adminloginel'])){
			redirect(base_url().'dashboard');
		}
		else{
			redirect(base_url().'auth');
		}
	}

}//end Class