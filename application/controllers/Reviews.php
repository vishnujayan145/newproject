<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reviews extends CI_Controller {


	public $data=array();
	function __construct() {
	parent::__construct();
	admin_session_check();
	$this->data['page_id']="reviews";
	$this->data['page_title']="reviews";
	$this->load->library('pagination');
	date_default_timezone_set('Asia/Kolkata');
	$this->load->helper('string');
	$this->load->helper('text');
	}
	public function index()
	{
		 
		$this->data['page_id']="reviews";
		$this->data['page_title']="All reviews Lists  | CargoAdmin";
		$config = array();
		$searchqry = array();
		
		$data_cndtn=array(); 
		 
		 


		$config["base_url"] = base_url()."reviews/index";
		$total_row = $this->admin_model->count_all_data_condition_ordersearch('review',$data_cndtn,'id','DESC',$searchqry);
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



		if($this->uri->segment(3)){
		$page = ($this->uri->segment(3)) ;
		}
		else{
		$page = 1;
		}
		$this->data["result"] = $this->admin_model->get_all_data_condition_ordersearch('review' ,$data_cndtn,$config["per_page"], $page,'id','DESC',$searchqry);

		// print_r( $this->data["result"] );
		// die;
		 
		// $str_links = $this->pagination->create_links();
		// $this->data["links"] = explode('&nbsp',$str_links );
		$this->data["links"] = $this->pagination->create_links();

		$this->load->view('head/header',$this->data);
		$this->load->view('reviews/index');
		$this->load->view('head/footer');
		 
	}
	 
    public function delete_process()
	{
		if($this->uri->segment(3)==null){
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        	redirect(base_url().'reviews');
		}
		else{
			$dat=$this->admin_model->delete_table_account('review',$this->uri->segment(3),'id');
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Deleted successfully..!.</div>");
        	redirect(base_url().'reviews');
		}
    }
    
    public function test(){
        
        echo phpinfo();
    }

}//end Class