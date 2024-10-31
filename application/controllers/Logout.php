<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

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
 
		$user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
		$this->session->sess_destroy();
		redirect(base_url().'auth');

	 
	}

}//end Class