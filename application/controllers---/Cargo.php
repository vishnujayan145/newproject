<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cargo extends CI_Controller {


	public $data=array();
	function __construct() {
	parent::__construct();
	admin_session_check();
	$this->data['page_id']="cargo";
	$this->data['page_title']="cargo";
	$this->load->library('pagination');
	date_default_timezone_set('Asia/Kolkata');
	$this->load->helper('string');
	$this->load->helper('text');
	}
	public function index()
	{
		$this->data['page_id']="cargo";
		$this->data['page_title']="All cargo Lists  | CargoAdmin";
		$config = array();
		$searchqry = array();
		$branch_id = $this->session->userdata['adminloginel']['id'];
		// $data_cndtn=array('branch_id' => $branch_id);
		$data_cndtn=array();

		if(isset($_GET['status']) && $_GET['status']!=null && $_GET['status']!='all'){
			$data_cndtn['status']=$_GET['status'];
		}
		if(isset($_GET['address']) && $_GET['address']!=null){
			$searchqry= 'address  LIKE "%' . $_GET['address'] . '%"';
			
		}
		if(isset($_GET['auth_person']) && $_GET['auth_person']!=null){
			$searchqry= 'auth_person  LIKE "%' . $_GET['auth_person'] . '%"';
			
		}
		if(isset($_GET['contactnumber']) && $_GET['contactnumber']!=null){
			
			$searchqry= 'contactnumber  LIKE "%' . $_GET['contactnumber'] . '%"';
		
		}
		
		if(isset($_GET['cargo_name']) && $_GET['cargo_name']!=null){
			$searchqry= 'cargo_name LIKE "%'.$_GET['cargo_name'].'%"';
			
		}
		
		
		$config["base_url"] = base_url()."cargo/index";
		$total_row = $this->admin_model->count_all_data_condition_ordersearch('cargo',$data_cndtn,'id','DESC',$searchqry);
		$config["total_rows"] = $total_row;
		$config["per_page"] =15;
		$config['use_page_numbers'] = TRUE;
		$config["suffix"] ='?' . http_build_query($_GET, '', "&");
		$config['num_links'] = $total_row;
		$config['cur_tag_open'] = '&nbsp;<a style="color: #fff;cursor: default;background-color: #337ab7;border-color: #337ab7;border-radius: 3px;">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = '<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>';
		$config['prev_link'] = '<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>';
		$this->pagination->initialize($config);

		if($this->uri->segment(3)){
		$page = ($this->uri->segment(3)) ;
		}
		else{
		$page = 1;
		}
		$this->data["result"] = $this->admin_model->get_all_data_condition_ordersearch('cargo' ,$data_cndtn,$config["per_page"], $page,'id','DESC',$searchqry);
		$str_links = $this->pagination->create_links();
		$this->data["links"] = explode('&nbsp',$str_links );
		$this->load->view('head/admin_header',$this->data);
		$this->load->view('cargo/index');
		$this->load->view('head/admin_footer');
		echo json_encode($searchqry);
	}
	public function create()
	{
		$this->data['page_id']="cargo_create";
		$this->data['page_title']="Add new Store  | CargoAdmin";
		$this->load->view('head/admin_header',$this->data);
		$this->load->view('cargo/create');
		$this->load->view('head/admin_footer');
	}
	public function create_process()
	{
	//check image selected or not
		set_time_limit(0);
    	ini_set("upload_max_filesize",25);
        $config=array(
        'upload_path'=>'./assets/uploads/cargo',
        'allowed_types'=>'jpg|jpeg|png|JPEG|JPG|PNG',
        'max_size'=> 4096,
        'filename'=> url_title($this->input->post('file_image')),
        'encrypt_name'=>true
        );
        $this->load->library('upload', $config);
        if($this->upload->do_upload('file_image'))
        {
        $datas=array('upload_data'=> $this->upload->data());
        $imgnme=$datas['upload_data']['file_name'];
        }
        else{
          $imgnme='image_not_available.jpg';
        } 


		if( !empty($_FILES['header']['name'])  ) {
			
			$file_name =null;
			$upload_file_name = null;
			
			$config2['upload_path'] = './assets/uploads/headers';
			$config2['allowed_types'] = 'gif|jpg|png|jpeg';
			$config2['allowed_types'] = '*'; 
			$this->load->library('upload', $config2);
			$this->upload->initialize($config2);


			if ($this->upload->do_upload('header')) { 
				$file_name = $this->upload->data()['file_name'];
			}else { 
				$error = array('error' => strip_tags($this->upload->display_errors()));
				$this->data['page_id']="goods_details_create";
				$this->data['page_title']="Add Trip Sheet  | Cargoadmin";
				$this->load->view('head/header',$this->data);
				$this->load->view('trip_sheet/create', $error);
				$this->load->view('head/admin_footer');
				die( print_r($error));
				return;  
			}   
		} else {
			$file_name = '';
		}

		$datax=array(
				'cargo_name'=>$this->security->xss_clean($this->input->post('cargo_name')),
				'address'=>$this->security->xss_clean($this->input->post('address')),
				'header' =>$file_name,
				'auth_person'=>$this->security->xss_clean($this->input->post('auth_person')),
				'contactnumber'=>$this->security->xss_clean($this->input->post('contactnumber')),
				'branch_id'=>$this->security->xss_clean($this->input->post('branch_id')),
				'created_at'=>date('Y-m-d H:i:s'),
				'status'=>$this->security->xss_clean($this->input->post('status'))
			);
		$lstid=$this->crud_model->create_table_account('cargo',$datax);
		$this->session->set_flashdata('msgx',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> created successfully.</div>");
		redirect(base_url().'cargo/create');
	
	}
	
	public function update()
	{
		if($this->uri->segment(3)==null){
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        	redirect(base_url().'cargo');
		}
		else{
			$this->data['page_id']="cargo";
			$this->data['page_title']="Update Store  | CargoAdmin";
			$data_cndtnx=array('id'=>$this->uri->segment(3));
			$details=$this->admin_model->get_all_data('cargo',$data_cndtnx,'id','DESC');
			if($details==false){
				$this->session->set_flashdata('ermsg',"<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        	redirect(base_url().'cargo');
			}
			else{
				$this->data["id"] =$details[0]->id;
				$this->data["cargo_name"] =$details[0]->cargo_name;
				$this->data["address"] =$details[0]->address;
				$this->data["auth_person"] =$details[0]->auth_person;
				$this->data["contactnumber"] =$details[0]->contactnumber;
				$this->data["status"] =$details[0]->status;
				$this->data["branch_id"] =$details[0]->branch_id;
				$this->data["header"] =$details[0]->header;
				$this->load->view('head/admin_header',$this->data);
				$this->load->view('cargo/update');
				$this->load->view('head/admin_footer');
			}
		}
	}
	public function update_process()
	{
        $uiid=$this->input->post('uid');

	 
		
		if(!empty($_FILES['header']['name']) ) {
			
			$header =null;
			$upload_file_name = null;
			
			$config2['upload_path'] = './assets/uploads/headers';
			$config2['allowed_types'] = 'gif|jpg|png|jpeg';
			$config2['allowed_types'] = '*'; 
			$this->load->library('upload', $config2);
			$this->upload->initialize($config2);


			if ($this->upload->do_upload('header')) { 
				$header = $this->upload->data()['file_name'];
			}else { 
				$error = array('error' => strip_tags($this->upload->display_errors()));
				$this->data['page_id']="goods_details_create";
				$this->data['page_title']="Add Trip Sheet  | Cargoadmin";
				$this->load->view('head/admin_header',$this->data);
				$this->load->view('trip_sheet/create', $error);
				$this->load->view('head/admin_footer');
				die( print_r($error));
				return;  
			}   
		} else {
 
			$header =  $this->input->post('old_header');
		}

	 

		if (empty($_FILES['file_image']['name'])) {

			$datax=array(
				'cargo_name'=>$this->security->xss_clean($this->input->post('cargo_name')),
				'address'=>$this->security->xss_clean($this->input->post('address')),
				'header' => $header,
				'auth_person'=>$this->security->xss_clean($this->input->post('auth_person')),
				'contactnumber'=>$this->security->xss_clean($this->input->post('contactnumber')),
				'branch_id'=>$this->security->xss_clean($this->input->post('branch_id')),
				'updated_at'=>date('Y-m-d H:i:s'),
				'status'=>$this->security->xss_clean($this->input->post('status'))
			);
			$lstid=$this->crud_model->edit_table_account('cargo',$datax,$uiid,'id');
			$this->session->set_flashdata('msgx',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> Updated successfully.</div>");
        	redirect(base_url().'cargo/update/'.$uiid);
		}
		 
    }
    public function delete_process()
	{
		if($this->uri->segment(3)==null){
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        	redirect(base_url().'cargo');
		}
		else{
			$dat=$this->admin_model->delete_table_account('cargo',$this->uri->segment(3),'id');
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Deleted successfully..!.</div>");
        	redirect(base_url().'cargo');
		}
    }

}//end Class