<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {


	public $data=array();
	
	function __construct() {
		parent::__construct();
		$this->data['page_id']="auth";
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
			$this->load->view('auth/index');
		}
		
	}
	public function login()
	{
	
	}
	public function process()
	{
		$login_data = array(
			'username'=>$this->security->xss_clean($this->input->post('login-username')),
			'password'=>$this->security->xss_clean($this->input->post('login-password'))
		);
		
		if($this->admin_model->login($login_data)=='true')
		{
			$result=$this->admin_model->login_read_data($login_data['username']);
			if ($result != false) {
				$session_data = array('username' => $result[0]->username,'id' => $result[0]->id,'name' => $result[0]->name, 'role' => $result[0]->role );
				//session working
				$this->session->set_userdata('adminloginel', $session_data);

				if( $this->session->userdata['adminloginel']['role'] == "superadmin"){ 
					redirect(base_url().'admindashboard');

				} else {
					redirect(base_url().'dashboard');
				} 
				
			}
			else{
				$this->session->set_flashdata('login_error',"<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-times-circle'></i>  Invalid login information.</div>");
				redirect(base_url().'auth');
			}
		}
		else
		{
			$this->session->set_flashdata('login_error',"<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-times-circle'></i>  Invalid login information.</div>");
			redirect(base_url().'auth');
		}
	}

}//end Class