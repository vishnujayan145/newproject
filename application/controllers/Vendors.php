<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendors extends CI_Controller {


	public $data=array();
	function __construct() {
	parent::__construct();
		// admin_session_check();
		super_admin_session_check();
		$this->data['page_id']="vendors";
		$this->data['page_title']="vendors";
		$this->load->library('pagination');
		date_default_timezone_set('Asia/Kolkata');
		$this->load->helper('string');
		$this->load->helper('text');
	}
	public function index()
	{
		 
		$this->data['page_id']="vendors";
		$this->data['page_title']="All Vendors Lists  | CargoAdmin";
		$config = array();
		$searchqry = array();
		
		//$data_cndtn=array(); 
		 
		$data_cndtn=array('type'=>'vendor'); 		 
		
		$config["base_url"] = base_url()."vendors/index";
		$total_row = $this->admin_model->count_all_data_condition_ordersearch('branches',$data_cndtn,'id','DESC',$searchqry);
		$config["total_rows"] = $total_row;
		$config["per_page"] =15;
		$config['use_page_numbers'] = TRUE;
		$config["suffix"] ='?' . http_build_query($_GET, '', "&");
		$config['num_links'] = 10;
		// $config['cur_tag_open'] = '&nbsp;<a style="color: #fff;cursor: default;background-color: #337ab7;border-color: #337ab7;border-radius: 3px;">';
		// $config['cur_tag_close'] = '</a>';
		// $config['next_link'] = '<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>';
		// $config['prev_link'] = '<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>';

		$config['full_tag_open'] = '<ul class="pagination">';        
		$config['full_tag_close'] = '</ul>';        
		$config['first_link'] = 'First';        
		$config['last_link'] = 'Last';        
		$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';        
		$config['first_tag_close'] = '</span></li>';        
		$config['prev_link'] = '&laquo';        
		$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';        
		$config['prev_tag_close'] = '</span></li>';        
		$config['next_link'] = '&raquo';        
		$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';        
		$config['next_tag_close'] = '</span></li>';        
		$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';        
		$config['last_tag_close'] = '</span></li>';        
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';        
		$config['cur_tag_close'] = '</a></li>';        
		$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';        
		$config['num_tag_close'] = '</span></li>';


		$this->pagination->initialize($config);

		if($this->uri->segment(3)){
		$page = ($this->uri->segment(3)) ;
		}
		else{
		$page = 1;
		}
		$this->data["result"] = $this->admin_model->get_all_data_condition_ordersearch('branches' ,$data_cndtn,$config["per_page"], $page,'id','DESC',$searchqry);
		// $str_links = $this->pagination->create_links();
		// $this->data["links"] = explode('&nbsp',$str_links );

		$this->data["links"] = $this->pagination->create_links();
		$this->load->view('head/admin_header',$this->data);
		$this->load->view('vendors/index');
		$this->load->view('head/admin_footer');
		echo json_encode($data_cndtn);
	}
	public function create()
	{ 

		$this->data['page_id']="vendors_create";
		$this->data['page_title']="Add new Vendor  | CargoAdmin";
		$this->load->view('head/admin_header',$this->data);
		$this->load->view('vendors/create');
		$this->load->view('head/admin_footer');
	}
	public function create_process()
	{
	 

		$datax=array(
				'branch_name'=>$this->security->xss_clean($this->input->post('branch_name')),
				'username'=>$this->security->xss_clean($this->input->post('username')),
				'email'=>$this->security->xss_clean($this->input->post('email')),
				'password'=>$this->security->xss_clean($this->input->post('password')),
				'location'=>$this->security->xss_clean($this->input->post('location')),  
				'mobile'=>$this->security->xss_clean($this->input->post('mobile')),  
				'authorized_person'=>$this->security->xss_clean($this->input->post('authorized_person')),  
				'created_at'=>date('Y-m-d H:i:s'),
				'type'=>'vendor',
				'status'=>$this->security->xss_clean($this->input->post('status'))
			);
			 
		$lstid=$this->crud_model->create_table_account('branches',$datax);
	 

		$datax=array(
			'name'=>$this->security->xss_clean($this->input->post('branch_name')),
			'username'=>$this->security->xss_clean($this->input->post('username')),
			'email'=>$this->security->xss_clean($this->input->post('email')),
			'password'=>$this->security->xss_clean($this->input->post('password')),
			'role'=>'vendor',
			'branch' => $lstid,
			'created_at'=>date('Y-m-d H:i:s'),
			'status'=>$this->security->xss_clean($this->input->post('status'))
		);
	    $lstid=$this->crud_model->create_table_account('administrator',$datax);

		$this->session->set_flashdata('msgx',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> created successfully.</div>");
		redirect(base_url().'vendors/create');
	
	}
	
	public function update()
	{
		if($this->uri->segment(3)==null){
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        	redirect(base_url().'vendors');
		}
		else{
			$this->data['page_id']="vendors";
			$this->data['page_title']="Update Store  | CargoAdmin";
			$data_cndtnx=array('id'=>$this->uri->segment(3));
			$details=$this->admin_model->get_all_data('branches',$data_cndtnx,'id','DESC');
			if($details==false){
				$this->session->set_flashdata('ermsg',"<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        	redirect(base_url().'branches');
			}
			else{
				$this->data["id"] =$details[0]->id;
				$this->data["branch_name"] =$details[0]->branch_name;
				$this->data["username"] =$details[0]->username;
				$this->data["email"] =$details[0]->email;
				$this->data["location"] =$details[0]->location;
				$this->data["status"] =$details[0]->status;
				$this->data["authorized_person"] =$details[0]->authorized_person;
				$this->data["mobile"] =$details[0]->mobile;
				$this->load->view('head/admin_header',$this->data);
				$this->load->view('vendors/update');
				$this->load->view('head/admin_footer');
			}
		}
	}
	public function update_process()
	{
        $uiid=$this->input->post('uid');
		if (empty( $this->input->post('password') )) {

			$datax=array(
				'branch_name'=>$this->security->xss_clean($this->input->post('branch_name')),
				'username'=>$this->security->xss_clean($this->input->post('username')),
				'email'=>$this->security->xss_clean($this->input->post('email')),
				'location'=>$this->security->xss_clean($this->input->post('location')),
				'updated_at'=>date('Y-m-d H:i:s'),
				'mobile'=>$this->security->xss_clean($this->input->post('mobile')),  
				'authorized_person'=>$this->security->xss_clean($this->input->post('authorized_person')),
				'status'=>$this->security->xss_clean($this->input->post('status'))
			);
 
			$lstid=$this->crud_model->edit_table_account('branches',$datax,$uiid,'id'); 
	 
			$datax=array(
				'name'=>$this->security->xss_clean($this->input->post('branch_name')),
				'username'=>$this->security->xss_clean($this->input->post('username')),
				'email'=>$this->security->xss_clean($this->input->post('email')),  
				'updated_at'=>date('Y-m-d H:i:s'),
				'status'=>$this->security->xss_clean($this->input->post('status'))
			);

			 

			$lstid=$this->crud_model->edit_table_account('administrator',$datax,$uiid,'branch'); 
		
			$this->session->set_flashdata('msgx',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> Updated successfully.</div>");
        	redirect(base_url().'vendors/update/'.$uiid);
		}
		else{ 
  
			$datax=array(
				'branch_name'=>$this->security->xss_clean($this->input->post('branch_name')),
				'username'=>$this->security->xss_clean($this->input->post('username')),
				'email'=>$this->security->xss_clean($this->input->post('email')),
				'location'=>$this->security->xss_clean($this->input->post('location')),
				'updated_at'=>date('Y-m-d H:i:s'),
				'password'=>$this->security->xss_clean($this->input->post('password')),
				'status'=>$this->security->xss_clean($this->input->post('status'))
			);
		
			$lstid=$this->crud_model->edit_table_account('branches',$datax,$uiid,'id'); 
	 
			$datax=array(
				'name'=>$this->security->xss_clean($this->input->post('branch_name')),
				'username'=>$this->security->xss_clean($this->input->post('username')),
				'email'=>$this->security->xss_clean($this->input->post('email')),  
				'password'=>$this->security->xss_clean($this->input->post('password')),
				'updated_at'=>date('Y-m-d H:i:s'),
				'status'=>$this->security->xss_clean($this->input->post('status'))
			); 
			$lstid=$this->crud_model->edit_table_account('administrator',$datax,$uiid,'branch'); 
			 
			$this->session->set_flashdata('msgx',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> Updated successfully.</div>");
        	redirect(base_url().'vendors/update/'.$uiid);

		}
    }
    public function delete_process()
	{
		if($this->uri->segment(3)==null){
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        	redirect(base_url().'vendors');
		}
		else{
			$dat=$this->admin_model->delete_table_account('branches',$this->uri->segment(3),'id');
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Deleted successfully..!.</div>");
        	redirect(base_url().'vendors');
		}
    }

}//end Class