<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicles_admin extends CI_Controller {


	public $data=array();
	function __construct() {
	parent::__construct();
		// admin_session_check();
		super_admin_session_check();
		$this->data['page_id']="vehicles";
		$this->data['page_title']="vehicles";
		$this->load->library('pagination');
		date_default_timezone_set('Asia/Kolkata');
		$this->load->helper('string');
		$this->load->helper('text');
	}
	public function index()
	{
		$this->data['page_id']="vehicles";
		$this->data['page_title']="All vehicles Lists  | CargoAdmin";
		$config = array();
		$searchqry = array();
		
		$data_cndtn=array();
		
		if(isset($_GET['vehicle_type']) && $_GET['vehicle_type']!=null && $_GET['vehicle_type']!='all'){
			$data_cndtn['vehicle_type']=$_GET['vehicle_type'];
		}
		if(isset($_GET['status']) && $_GET['status']!=null && $_GET['status']!='all'){
			$data_cndtn['status']=$_GET['status'];
		}
		if(isset($_GET['vehicle_number']) && $_GET['vehicle_number']!=null){
			$searchqry= 'vehicle_number LIKE "%'.$_GET['vehicle_number'].'%"';
		}
		if(isset($_GET['contactnumber']) && $_GET['contactnumber']!=null){
			//$data_cndtn['storename']=$_GET['storename'];
			$searchqry= 'contactnumber  LIKE "%' . $_GET['contactnumber'] . '%"';
		}
		if(isset($_GET['driver_name']) && $_GET['driver_name']!=null){
			//$data_cndtn['storename']=$_GET['storename'];
			$searchqry= 'driver_name  LIKE "%' . $_GET['driver_name'] . '%"';
		}
		
		$config["base_url"] = base_url()."vehicles_admin/index";
		$total_row = $this->admin_model->count_all_data_condition_ordersearch('vehicles',$data_cndtn,'id','DESC',$searchqry);
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
		$this->data["result"] = $this->admin_model->get_all_data_condition_ordersearch('vehicles' ,$data_cndtn,$config["per_page"], $page,'id','DESC',$searchqry);
		$str_links = $this->pagination->create_links();
		$this->data["links"] = explode('&nbsp',$str_links );
		$this->load->view('head/admin_header',$this->data);
		$this->load->view('vehicles_admin/index');
		$this->load->view('head/admin_footer');
		//echo json_encode($data_cndtn);
	}
	public function create()
	{
		$this->data['page_id']="vehicles_create";
		$this->data['page_title']="Add new Store  | CargoAdmin";
		$this->load->view('head/admin_header',$this->data);
		$this->load->view('vehicles_admin/create');
		$this->load->view('head/admin_footer');
	}
	public function create_process()
	{
	//check image selected or not
		set_time_limit(0);
    	ini_set("upload_max_filesize",25);
        $config=array(
        'upload_path'=>'./assets/uploads/vehicles',
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

		$datax=array(
				'vehicle_number'=>$this->security->xss_clean($this->input->post('vehicle_number')),
				'vehicle_type'=>$this->security->xss_clean($this->input->post('vehicle_type')),
				'driver_name'=>$this->security->xss_clean($this->input->post('driver_name')),
				'contactnumber'=>$this->security->xss_clean($this->input->post('contactnumber')),
				'created_at'=>date('Y-m-d H:i:s'),
				'status'=>$this->security->xss_clean($this->input->post('status'))
			);
		$lstid=$this->crud_model->create_table_account('vehicles',$datax);

		$datay=array(
			'username'=>$this->security->xss_clean($this->input->post('contactnumber')),
			'password'=>$this->security->xss_clean($this->input->post('password')),
			'branch'=>0,
			'role'=> 'driver',
			'created_at'=>date('Y-m-d H:i:s'),
			'status'=>0
		);
		$lstid=$this->crud_model->create_table_account('administrator',$datay); 

		$this->session->set_flashdata('msgx',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> created successfully.</div>");
		redirect(base_url().'vehicles_admin/create');
	
	}
	
	public function update()
	{
		if($this->uri->segment(3)==null){
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        	redirect(base_url().'vehicles');
		}
		else{
			$this->data['page_id']="vehicles";
			$this->data['page_title']="Update Store  | CargoAdmin";
			$data_cndtnx=array('id'=>$this->uri->segment(3));
			$details=$this->admin_model->get_all_data('vehicles',$data_cndtnx,'id','DESC');
			if($details==false){
				$this->session->set_flashdata('ermsg',"<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        	redirect(base_url().'vehicles');
			}
			else{
				$this->data["id"] =$details[0]->id;
				$this->data["vehicle_number"] =$details[0]->vehicle_number;
				$this->data["vehicle_type"] =$details[0]->vehicle_type;
				$this->data["driver_name"] =$details[0]->driver_name;
				$this->data["contactnumber"] =$details[0]->contactnumber;
				$this->data["status"] =$details[0]->status;
				$this->load->view('head/admin_header',$this->data);
				$this->load->view('vehicles_admin/update');
				$this->load->view('head/admin_footer');
			}
		}
	}
	public function update_process()
	{
        $uiid=$this->input->post('uid'); 
		
		if (empty($_FILES['file_image']['name'])) {

			 
			if($this->input->post('password'))
			{				 
				$data_cndtnx = array('username' => $this->input->post('contactnumber'));
				$details=$this->admin_model->get_all_data('administrator',$data_cndtnx,'id','DESC');
				
				if($details==false){
					$datay=array(
						'name'=>$this->security->xss_clean($this->input->post('vehicle_number')),
						'username'=>$this->security->xss_clean($this->input->post('contactnumber')),
						'password'=>$this->security->xss_clean($this->input->post('password')) ,
						'branch'=>0,
						'role'=> 'driver',
						'created_at'=>date('Y-m-d H:i:s'),
						'status'=>0
					);
					$lstid=$this->crud_model->create_table_account('administrator',$datay); 
				}
				else {
					$datay=array( 						
						'name'=>$this->security->xss_clean($this->input->post('vehicle_number')),
						'password'=>$this->security->xss_clean($this->input->post('password')) ,
						'created_at'=>date('Y-m-d H:i:s'), 
					);
					 
					
					$lstid=$this->crud_model->edit_table_account('administrator',$datay,$details[0]->username,'username');
				}  
			} 

			$datax=array(
				'vehicle_number'=>$this->security->xss_clean($this->input->post('vehicle_number')),
				'vehicle_type'=>$this->security->xss_clean($this->input->post('vehicle_type')),
				'driver_name'=>$this->security->xss_clean($this->input->post('driver_name')),
				'contactnumber'=>$this->security->xss_clean($this->input->post('contactnumber')),
				'updated_at'=>date('Y-m-d H:i:s'),
				'status'=>$this->security->xss_clean($this->input->post('status'))
			);

			$lstid=$this->crud_model->edit_table_account('vehicles',$datax,$uiid,'id');
			$this->session->set_flashdata('msgx',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> Updated successfully.</div>");
        	redirect(base_url().'vehicles_admin/update/'.$uiid);
		}
		else{
				 
		}
    }
    public function delete_process()
	{
		if($this->uri->segment(3)==null){
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        	redirect(base_url().'vehicles');
		}
		else{
			$dat=$this->admin_model->delete_table_account('vehicles',$this->uri->segment(3),'id');
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Deleted successfully..!.</div>");
        	redirect(base_url().'vehicles');
		}
    }

	public function getVehicleDetails( ){

		$id = $this->input->post('id');

		$data_cndtnx=array('id'=>$id );
		$details=$this->admin_model->get_all_data('vehicles',$data_cndtnx,'id','DESC');

	

			$data["id"] =$details[0]->id;
			$data["vehicle_number"] =$details[0]->vehicle_number;
			$data["vehicle_type"] =$details[0]->vehicle_type;
			$data["driver_name"] =$details[0]->driver_name;
			$data["contactnumber"] =$details[0]->contactnumber;
			$data["status"] =$details[0]->status; 
			$html = "<div style='margion-top:20px;'>";
			$html .= "<p><b>Driver name :</b>".$details[0]->driver_name."</p>";
			$html .= "<p><b>Mobile Number :</b>".$details[0]->contactnumber."</p>";
			$html .= "<p><b>Vehicle Number :</b>".$details[0]->vehicle_number."</p>";
			$html .= "<p><b>Vehicle Type :</b>".$details[0]->vehicle_type."</p>";
			$data['html'] = $html;

			echo $html;
			exit;

		 
		 
		 
		

	}

}//end Class