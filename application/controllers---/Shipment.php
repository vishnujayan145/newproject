<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Shipment extends CI_Controller {

	public $data=array();
	function __construct() {
		parent::__construct();
		admin_session_check();
		$this->data['page_id']		= "shipment_list";
		$this->data['page_title']	= "shipment_list";

		$this->load->library('pagination');
		date_default_timezone_set('Asia/Kolkata');
		$this->load->helper('string');
		$this->load->helper('text');
	}
	public function index()	{

		$this->data['page_id']		= "shipment_list";
		$this->data['page_title']	= "All Shipments  | cargoadmin";
		$branch_id 		= $this->session->userdata['adminloginel']['id'];
		$sort_column 	= "shipments.id";
		$sort_order 	= "DESC";
		$config 		= array();
		$searchqry 		= array();
		$new_checkbox	= array();
		$cndt			= array();
		$sqry			= array();
		$join			= 'cargo';
		$join_cond		= 'shipments.cargo_id = cargo.id';
		$data_cndtnx 	= array('shipments.is_transfer' =>0, 'shipments.branch_id' => $branch_id);
		$condition 		= array('shipments.is_transfer' =>0, 'shipments.branch_id' => $branch_id);
		$condition2 	= array('shipments.is_transfer' =>1, 'shipments.branch_id' => $branch_id);

	 

		$this->data['branches'] 			= $this->admin_model->get_all_active_branches();
		$this->data['current_branch_id'] 	= $branch_id;
		$this->data['shipments'] 			= $this->admin_model->get_all_data('shipments', $data_cndtnx, $sort_column, 'DESC', $new_checkbox);
		$config["base_url"] 				= base_url()."shipment/index";
		$total_row 							= $this->admin_model->count_all_data_condition_ordersearch_admin('shipments', $condition, $sort_column, 'DESC', $sqry, $join, $join_cond);

		$config["total_rows"] 				= $total_row;
		$config["per_page"] 				= 200;
		$config['use_page_numbers'] 		= TRUE;
		$config["suffix"] ='?' . http_build_query($_GET, '', "&");
		$config['num_links']				= $total_row;
		$config['cur_tag_open'] 			= '&nbsp;<a style="color: #fff;cursor: default;background-color: #337ab7;border-color: #337ab7;border-radius: 3px;">';
		$config['cur_tag_close'] 			= '</a>';
		$config['next_link'] 				= '<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>';
		$config['prev_link'] 				= '<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>';
		$this->pagination->initialize($config);

		if($this->uri->segment(3)) {
			$page = ($this->uri->segment(3)) ;
		} else {
			$page = 1;
		}
		
		$this->data["result"] 	= $this->admin_model->get_all_data_join('shipments', $condition, $config["per_page"], $page, $sort_column, 'DESC', $sqry, $join, $join_cond);	

		$this->data["transfer_shipment"] 	= $this->admin_model->get_all_data_join('shipments', $condition2, $config["per_page"], $page, $sort_column, 'DESC', $sqry, $join, $join_cond);		 		  
		$str_links 				= $this->pagination->create_links();
		$this->data["links"] 	= explode('&nbsp',$str_links );

		$this->load->view('head/header',$this->data);
		$this->load->view('shipments/index');
		$this->load->view('head/footer');

	}


	public function update() {
		$this->data['page_id']		= "shipment_list";
		$this->data['page_title']	= "All Shipments  | cargoadmin";


		if($this->uri->segment(3)==null){
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        	redirect(base_url().'shipment');
		}
		else{

			$data_cndtnx	= array();
			$this->data['cargos_arr'] = $this->admin_model->get_all_data('cargo',$data_cndtnx,'id','DESC'); 

			$data_cndtnx 	= array('id'=>$this->uri->segment(3));
			$details		= $this->admin_model->get_all_data('shipments',$data_cndtnx,'id','DESC');
			if($details==false){
				$this->session->set_flashdata('ermsg',"<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
			redirect(base_url().'shipment');
			}
			else{
				$this->data["id"] =$details[0]->id;
				$this->data["name"] =$details[0]->name;
				$this->data["cargo_id"] =$details[0]->cargo_id;
				$this->data["clearence_date"] =$details[0]->clearence_date;

				$this->load->view('head/header',$this->data);
				$this->load->view('shipments/update');
				$this->load->view('head/footer');
			}
		}
	
	}


	public function update_process() {
        $uiid=$this->input->post('uid');
			$datax=array (
				'name'=>$this->security->xss_clean($this->input->post('name')),
				'clearence_date'=>$this->security->xss_clean($this->input->post('clearence_date')),
				'cargo_id'=>$this->security->xss_clean($this->input->post('cargo_id')),
			); 
		 
			$lstid			= $this->crud_model->edit_table_account('shipments',$datax,$uiid,'id');
			$cargo_id   	= $this->security->xss_clean($this->input->post('cargo_id'));
			$data_cndtnx 	= array('id' => $cargo_id);
			$details 		= $this->admin_model->get_all_data('cargo', $data_cndtnx, 'id', 'DESC');

			$datay = array (
				'clearence_date'	=> $this->security->xss_clean($this->input->post('clearence_date')),
				'header'			=> $cargo_id
			);
			$lstid	= $this->crud_model->edit_table_account('shipment_details',$datay,$uiid,'shipment_id');

			$this->session->set_flashdata('msgx',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> Updated successfully.</div>");
        	redirect(base_url().'shipment/update/'.$uiid);
    }

	public function view() {

		$this->data['page_id']		= "shipment_list";
		$this->data['page_title']	= "All Shipments  | cargoadmin";

		$sort_column 	= "shipment_details.id";
		$sort_order 	= "DESC";
		$config 		= array();
		$searchqry 		= array();
		$new_checkbox	= array();
		$cndt			= array();
		$sqry			= array();
		$join			= '';
		$join_cond		= '';
		$data_cndtnx 	= array();
		$searchqry_in   = null;
		$condition 		= array('shipment_details.shipment_id'=>$this->uri->segment(3), 'move_to_goods' =>0 );
		$data_cndtnx 	= array('status' => 0);


		$this->data['shipment_id'] 			= $this->uri->segment(3);		
		$this->data['vehicles'] 			= $this->admin_model->get_all_data('vehicles', $data_cndtnx, 'id', 'DESC');		
		$this->data['branches'] 			= $this->admin_model->get_all_active_branches();
		$this->data['current_branch_id'] 	= $branch_id = $this->session->userdata['adminloginel']['id'];
		$config["base_url"] 				= base_url()."shipment/view/".$this->uri->segment(3);
		$total_row 							= $this->admin_model->count_all_data_condition_ordersearch_admin('shipment_details', $condition, $sort_column, 'DESC', $sqry, $join, $join_cond);
		$config["total_rows"] 				= $total_row;
		$config["per_page"] 				= 200;
		$config['use_page_numbers'] 		= TRUE;
		$config["suffix"] ='?' . http_build_query($_GET, '', "&");
		$config['num_links']				= $total_row;
		// $config['cur_tag_open'] 			= '&nbsp;<a style="color: #fff;cursor: default;background-color: #337ab7;border-color: #337ab7;border-radius: 3px;">';
		// $config['cur_tag_close'] 			= '</a>';
		// $config['next_link'] 				= '<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>';
		// $config['prev_link'] 				= '<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>';


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

		if($this->uri->segment(4)) {
			$page = ($this->uri->segment(4)) ;
		} else {
			$page = 1;
		}
		
		$this->data["result"] = $this->admin_model->get_all_data_condition_ordersearch_goods('shipment_details' ,$condition,$config["per_page"], $page, $sort_column, $sort_order ,$searchqry, $searchqry_in);

		// print_r( $this->data["result"] );
		// die;
		// $str_links 				= $this->pagination->create_links();
		// $this->data["links"] 	= explode('&nbsp',$str_links );

		$this->data["links"] = $this->pagination->create_links();

		$this->load->view('head/header',$this->data);
		$this->load->view('shipments/shipment_list');
		$this->load->view('head/footer');
			 
    }


	public function transfer_list() {

		$this->data['page_id']		= "shipment_list";
		$this->data['page_title']	= "All Shipments  | cargoadmin";

		$sort_column 	= "shipment_details.id";
		$sort_order 	= "DESC";
		$config 		= array();
		$searchqry 		= array();
		$new_checkbox	= array();
		$cndt			= array();
		$sqry			= array();
		$join			= '';
		$join_cond		= '';
		$data_cndtnx 	= array();
		$searchqry_in   = null;
		$condition 		= array('shipment_details.shipment_id'=>$this->uri->segment(3), 'move_to_goods' => 1 );
		$data_cndtnx 	= array('status' => 0);


		$this->data['shipment_id'] 			= $this->uri->segment(3);		
		$this->data['vehicles'] 			= $this->admin_model->get_all_data('vehicles', $data_cndtnx, 'id', 'DESC');		
		$this->data['branches'] 			= $this->admin_model->get_all_active_branches();
		$this->data['current_branch_id'] 	= $branch_id = $this->session->userdata['adminloginel']['id'];
		$config["base_url"] 				= base_url()."shipment/transfer_list/".$this->uri->segment(3);
		$total_row 							= $this->admin_model->count_all_data_condition_ordersearch_admin('shipment_details', $condition, $sort_column, 'DESC', $sqry, $join, $join_cond);
		$config["total_rows"] 				= $total_row;
		$config["per_page"] 				= 200;
		$config['use_page_numbers'] 		= TRUE;
		$config["suffix"] ='?' . http_build_query($_GET, '', "&");
		$config['num_links']				= $total_row;
		// $config['cur_tag_open'] 			= '&nbsp;<a style="color: #fff;cursor: default;background-color: #337ab7;border-color: #337ab7;border-radius: 3px;">';
		// $config['cur_tag_close'] 			= '</a>';
		// $config['next_link'] 				= '<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>';
		// $config['prev_link'] 				= '<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>';


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
 
		if($this->uri->segment(4)) {
			$page = ($this->uri->segment(4)) ;
		} else {
			$page = 1;
		}
	
		$this->data["result"] = $this->admin_model->get_all_data_condition_ordersearch_goods('shipment_details' ,$condition,$config["per_page"], $page, $sort_column, $sort_order ,$searchqry, $searchqry_in);

		 
		// $str_links 				= $this->pagination->create_links();
		// $this->data["links"] 	= explode('&nbsp',$str_links );

		$this->data["links"] = $this->pagination->create_links();

		$this->load->view('head/header',$this->data);
		$this->load->view('shipments/shipment_transfer');
		$this->load->view('head/footer');
			 
    }


	function transfer_to_goods_details() {

		ini_set('max_execution_time', '300');

		if( $this->input->post('sel_shipment_id') !='') {
			 
			 
			$selShipmentIds 		= explode(',',$this->security->xss_clean($this->input->post('sel_shipment_id'))); 
			// $vehicle_id 			= $this->security->xss_clean($this->input->post('vehicle_id')); 
			// $transferred_from  		= $this->security->xss_clean($this->input->post('transfer_from'));
			// $transferred_to 		= $transferred_from;  //$this->security->xss_clean($this->input->post('transfer_to'));		
			$transfer_date 			= $this->security->xss_clean($this->input->post('transfer_date'));	
			// $estimate_delivery_date	= NULL; //$this->security->xss_clean($this->input->post('estimate_delivery_date'));	
			// $transferred_from_data 	= $this->admin_model->get_branch("administrator",$transferred_from );
			// $from_branch 			= $transferred_from_data[0]->name;
			// $transferred_to_data 	= $this->admin_model->get_branch("administrator",$transferred_to );
			// $to_branch 				= $transferred_to_data[0]->name;
			
				foreach($selShipmentIds as $shipmentId) {    
			    // $data = $this->admin_model->get_data("shipment_details",$shipmentId); 
				$condition = array('shipment_id' =>$shipmentId );
			    $shipment_details_array = $this->admin_model->getSelectedData("shipment_details",'*', $condition); 
				 
					foreach( $shipment_details_array as $val ){


						$shipment_status_data = array(  
							'invoice_number'=>  $val->invoiceno,
							'trip_sheet_id' =>  null ,
							'shipment_id'	=> $shipmentId,
							'shipment_status' => 'Received at '.$this->session->userdata['adminloginel']['name'],
							'filename' => null,
							'in_transit_url' => null,
							'message' =>  null,
							'created_at' => date('Y-m-d H:i:s'),
							'tracking_no' =>  $val->tracking_no,
							'branch_id' => $this->session->userdata['adminloginel']['id'],
						);
  
						$shipment_status_id = $this->crud_model->create_table_account('shipment_status', $shipment_status_data);
						// $datay['shipment_status_id'] = $shipment_status_id;  

						$datay = array(			
									'shipment_status_id'	=> $shipment_status_id,
									'shipment_id'           => $val->shipment_id ,
									'shipment_details_id'   => $val->id ,
									'invoiceno'             => $val->invoiceno ,
									'trip_no'               => $val->trip_no ,
									'tracking_no'           => $val->tracking_no ,
									'date'                  => $val->date ,
									'district'              => $val->district ,
									'company'               => $val->company ,
									'header'                => $val->header ,
									'address'               => $val->address ,
									'phone'                 => $val->phone ,
									'weight'                => $val->weight ,
									'pcs'                   => $val->pcs ,
									'shipmentname'          => $val->shipmentname ,
									'origin'                => $val->origin ,
									'boxno'                 => $val->boxno ,
									'rewight'               => $val->rewight ,
									'received_pcs'          => $val->received_pcs ,
									'sender_address'        => $val->sender_address ,
									'reciever_address'      => $val->reciever_address ,
									'state'                 => $val->state ,
									'goods_desc'            => $val->goods_desc ,
									'recieved_at_hub'       => $val->recieved_at_hub ,
									'received_date'         => $val->received_date ,
									'connecting_date'       => $val->connecting_date ,
									'recieved_at_branch'    => $val->recieved_at_branch ,
									'vendor'                => $val->vendor ,
									'docket'                => $val->docket ,
									'url'                   => $val->url ,
									'contact_no'            => $val->contact_no ,
									'remarks'               => $val->remarks ,
									'pincode'               => $val->pincode ,
									'sendingdate'           => $val->sendingdate ,
									'recievingdate'         => $val->recievingdate ,
									'status'                => $val->status ,
									'goods_status'          => $val->goods_status ,
									'filename'              => $val->filename ,
									'in_transit_url'        => $val->in_transit_url,
									'other_state'           => $val->other_state ,
									'branch_id'             => $val->branch_id ,
									'origin_id'             => $val->origin_id ,
									'transferred_from'      => NULL ,
									'transferred_to'        => NULL ,
									'is_transfer'           => $val->is_transfer ,
									'transfer_status'       => $val->transfer_status ,
									'current_transfer_id'   => $val->current_transfer_id ,
									'trip_sheet_id'         => $val->trip_sheet_id ,
									'sort_order'            => $val->sort_order ,
									'current_status_id'     => $val->current_status_id , //$status_id ,
									'bg_color'              => $val->bg_color ,
									'clearence_date'        => $val->clearence_date , 
									'transfer_date'         => $transfer_date ,	
									'estimate_delivery_date'=> NULL,
									'customs_cleared_date'	=> $val->customs_cleared_date , 
									'created_at' =>    date('Y-m-d H:i:s'),
									'updated_at' =>    date('Y-m-d H:i:s'),
								);				
					
								 
						$lstid = $this->crud_model->create_table_account('goods_details', $datay);
					
						$datax = array(
									'transfer_date'         => $transfer_date ,								
									'move_to_goods'         => 1 ,
									'estimate_delivery_date'=> NULL ,
									// 'current_status_id'     => $status_id 							

								);	
					 
						$this->crud_model->edit_table_account('shipment_details', $datax, $val->id, 'id');

						
					}

						$dataz = array(
							'is_transfer'  => 1 	 
						);	
			
						$this->crud_model->edit_table_account('shipments', $dataz, $shipmentId, 'id'); 		
						
						
						

				 
				}
 
				$this->session->set_flashdata('msgx',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> Transferred successfully.</div>"); 
				redirect(base_url().'shipment/');
		

		} else {

				$this->session->set_flashdata('msgx',"<div class='alert alert-error' style='color:red;'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> No Goods Selected.</div>"); 
				redirect(base_url().'shipment/');
		}


	}

	function back_to_shipment() {

		 
		ini_set('max_execution_time', '300'); 
		if($this->uri->segment(3)){  		 
			$shipmentId 		=  $this->uri->segment(3);
		$condition = 'shipment_id ='.$shipmentId;
		// $shipment_details_arr	= $this->admin_model->getSelectedData("shipment_details",'invoiceno, tracking_no', $condition );   
			// foreach( $shipment_details_arr as $val ){  
			// 	   $condition2 = array( 
			// 						'tracking_no' => $val->tracking_no,
			// 						'invoice_number' => $val->invoiceno
			// 						);
			// 		$dat = $this->admin_model->delete_table_account_multiple_cdn('goods_status', $condition2 );   

			// } 

			$condition2 = array( 
							'shipment_id' => $shipmentId, 
							);
			$dat = $this->admin_model->delete_table_account_multiple_cdn('shipment_status', $condition2 );   
				$datax = array(
						'transfer_date'         	=> NULL ,								
						'move_to_goods'         	=> 0,
						'estimate_delivery_date'	=> NULL,
						'current_status_id'			=> NULL
					);	 
				$this->crud_model->edit_table_account('shipment_details', $datax , $shipmentId, 'shipment_id');
				$dataz = array(
					'is_transfer'  => 0 	 
				);				
				$this->crud_model->edit_table_account('shipments', $dataz, $shipmentId, 'id'); 	 
				$data1	= $this->admin_model->delete_table_account("goods_details",$shipmentId, 'shipment_id');   
				$this->session->set_flashdata('msgx',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> Moved to shipment list.</div>"); 
				redirect(base_url().'shipment/');
		} else {
				$this->session->set_flashdata('msgx',"<div class='alert alert-error' style='color:red;'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> No Goods Selected.</div>"); 
				redirect(base_url().'shipment/');
		}
	}

	public function delete_process() { 
 

		if($this->uri->segment(3)==null){
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        	redirect(base_url().'shipment');
		}
		else{
			$shipment_id 	= $this->uri->segment(3);
			$resp 			= $this->admin_model->delete_shipments_records( $shipment_id );

			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Deleted successfully..!.</div>");
        	redirect(base_url().'shipment');
		} 
 
    }

	public function update_customs_cleared_date() {
		$id = $this->input->post('shipment_id');
		$customs_cleared_date = $this->input->post('customs_cleared_date');
		$datax =array(
						'customs_cleared_date'	=> $customs_cleared_date
				);
		$this->crud_model->edit_table_account('shipments', $datax , $id, 'id');
		$this->crud_model->edit_table_account('shipment_details', $datax , $id, 'shipment_id');
		$this->session->set_flashdata('msgx',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> Date Updated Successfully.</div>"); 
				redirect(base_url().'shipment/');

		

	}

		   
}//end Class  