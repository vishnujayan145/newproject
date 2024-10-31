<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {


	public $data=array();
	function __construct() {
	parent::__construct();
	admin_session_check();
	$this->data['page_id']="Profile";
	$this->data['page_title']="Profile";
	$this->load->library('pagination');
	date_default_timezone_set('Asia/Kolkata');
	$this->load->helper('string');
	$this->load->helper('text');
		if(isset($this->session->userdata['adminloginel'])){
			$this->data["admin_details"]=$this->admin_model->admin_login_read_data($this->session->userdata['adminloginel']['id']);		
		}
		else{
			$this->data["admin_details"]=null;
		}
	}
	public function index()
	{
		//echo json_encode($this->data["admin_details"]);
		$this->load->view('head/header',$this->data);
		$this->load->view('profile/index');
		$this->load->view('head/footer');
	}
	public function password_change_process()
	{
		$datax=array(
			'username'=>$this->security->xss_clean($this->input->post('uname')),
			'password'=>$this->security->xss_clean($this->input->post('password')),
		);
		$lstid=$this->crud_model->edit_table_account('administrator',$datax,1,'id');
		$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Profile Updated successfully.</div>");
    	redirect(base_url().'profile');
	}
	public function logout(){
		$this->session->unset_userdata('adminloginel');
		$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check'></i>logouted successful...</div>");
		redirect(base_url());
	}


}