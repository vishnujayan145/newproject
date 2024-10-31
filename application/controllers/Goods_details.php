<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Goods_details extends CI_Controller {


	public $data=array();
	function __construct() {
		parent::__construct();
		admin_session_check();
		$this->data['page_id']		= "goods_details";
		$this->data['page_title']	= "goods_details";

		$this->load->library('pagination');
		date_default_timezone_set('Asia/Kolkata');
		$this->load->helper('string');
		$this->load->helper('text');
	}
	public function index()
	{
		$this->data['page_id']		= "goods_details";
		$this->data['page_title']	= "All goods details  | cargoadmin";

		$sort_column 	= "sort_order";
		$sort_order 	= "DESC";
		$config 		= array();
		$searchqry 		= array();
		$data_cndtnz 	= array();
		$branch_id 		= $this->session->userdata['adminloginel']['id'];
		$searchqry_in 	= null;

		$branches 					= $this->admin_model->get_all_active_branches();
		$data_cndtnx 				= array('status' => 0);
		$this->data['vehicles'] 	= $this->admin_model->get_all_data('vehicles', $data_cndtnx, 'id', 'DESC');		
		$this->data['trip_no_arr'] 	= $this->admin_model->get_all_trip_no('goods_details', $data_cndtnz, 'trip_no', 'ASC');

		//transfer_status == null or transfer_status = confirmed  -- added condition in model
		$data_cndtn					= array('other_state'=> 0, 'branch_id' => $branch_id);
		$data_cndtny 				= array('status' => 7, 'branch_id' => $branch_id);
		$this->data['trip_sheets'] 	= $this->admin_model->get_all_data('trip_sheet', $data_cndtny, 'id', 'DESC'); 
 
 
		if(isset($_GET['serachq']) && $_GET['serachq']!=null && $_GET['serachq']!='all'){
			if($_GET['serachq'] == 'transfer') {
				$searchqry  = 'is_transfer = 1';
			} else if($_GET['serachq'] == 'gt_reweight') { 
				$searchqry  = 'bg_color = "yellow"'; 
			} else if($_GET['serachq'] == 'goods_status') {				 
				if(isset($_GET['inptvalue']) && $_GET['inptvalue']!=null && $_GET['inptvalue']!=''){ 
					if(empty($searchqry)) {
						$searchqry= ' (goods_status = "' .  $_GET['inptvalue'] .'")';
					} else {
						$searchqry .= ' AND  (goods_status = "' .  $_GET['inptvalue'] .'")';
					}
				} else if($_GET['inptvalue']=='') {					
					if(empty($searchqry)) {
						$searchqry= ' (goods_status = " ")';
					} else{
						$searchqry .= ' AND  (goods_status = " ")';
					}
				}
			}else { 
				 if(  $_GET['serachq'] == "boxno") {
					$sort_column = "boxno";
					$sort_order = "ASC";
				 }
				$searchqry= $_GET['serachq'].' LIKE "%' . $_GET['inptvalue'] . '%"';
			}
		}

		if(isset($_GET['trip_no']) && $_GET['trip_no']!=null && $_GET['trip_no']!=''){
			if( count($_GET['trip_no'] ) > 0 ){
			$searchqry_in =  $_GET['trip_no'];
			} else { 
			$searchqry_in =   $_GET['trip_no'];
			}			 
		}

		if(isset($_GET['tracking_no']) && $_GET['tracking_no']!=null && $_GET['tracking_no']!=''){
			if(empty($searchqry)) {
				$searchqry= ' (tracking_no = "' .  $_GET['tracking_no'] .'")';
			} else{
				$searchqry .= ' AND  (tracking_no = "' .  $_GET['tracking_no'] .'")';
			}
		}

		if(isset($_GET['boxno']) && $_GET['boxno']!=null && $_GET['boxno']!=''){			
			if(empty($searchqry)) {
				$searchqry= ' (boxno = "' .  $_GET['boxno'] .'")';
			} else{
				$searchqry .= ' AND  (boxno = "' .  $_GET['boxno'] .'")';
			}
		}

		if(isset($_GET['date']) && $_GET['date']!=null && $_GET['date']!=''){
			if(empty($searchqry)) {
				$searchqry= ' (date = "' . date('Y-m-d',strtotime($_GET['date'])) . '" OR date= "' . date('d-m-Y',strtotime($_GET['date'])) . '" OR date = "' . date('m/d/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d/m/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d.m.Y',strtotime($_GET['date'])) . '")';
			}else {
				$searchqry .= ' AND (date = "' . date('Y-m-d',strtotime($_GET['date'])) . '" OR date= "' . date('d-m-Y',strtotime($_GET['date'])) . '" OR date = "' . date('m/d/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d/m/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d.m.Y',strtotime($_GET['date'])) . '")';
			}
		}

		if(!empty($_GET['msg']) && $_GET['msg']==1) {
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Deleted successfully..!.</div>");
        	redirect(base_url().'goods_details');
		} 

		$config["base_url"] 		= base_url()."goods_details/index";
		$total_row 					= $this->admin_model->count_all_data_condition_ordersearch_goods_details('goods_details',$data_cndtn, $sort_column, $sort_order ,$searchqry, $searchqry_in);	 
		$config["total_rows"]		= $total_row;
		$config["per_page"] 		= 100;
		$config['use_page_numbers'] = TRUE;
		$config["suffix"] 			='?' . http_build_query($_GET, '', "&");
		$config['num_links'] 		= 10;
		// $config['cur_tag_open'] 	= '&nbsp;<a style="color: #fff;cursor: default;background-color: #337ab7;border-color: #337ab7;border-radius: 3px;">';
		// $config['cur_tag_close'] 	= '</a>';
		// $config['next_link'] 		= '<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>';
		// $config['prev_link'] 		= '<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>';


		
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
		} else {
			$page = 1;
		}		
		
		$this->data["result"] = $this->admin_model->get_all_data_condition_ordersearch_goods('goods_details' ,$data_cndtn,$config["per_page"], $page, $sort_column, $sort_order ,$searchqry, $searchqry_in);
	
		if(isset($_GET['download_ogm'])) {
			$this->generate_excel($this->data["result"],['slno','vendor','boxno','invoiceno','pcs','weight','reciever_address','sender_address','pincode','state','goods_desc'],'OGM');
		}
		if(isset($_GET['download_sorting'])) {
			$this->generate_excel($this->data["result"],['slno','boxno','invoiceno','pcs','weight','rewight','district','remarks'],'SORTING LIST');
		}
		if(isset($_GET['download_loading'])) {
			$this->generate_excel($this->data["result"],['slno','boxno','invoiceno','pcs','weight','rewight','state','vendor','connecting_date'],'LOADING LIST');
		}
		if(isset($_GET['download_to_import'])) {
		$fields			=['company' ,'shipmentname', 'agencyname' ,'origin' ,'boxno' ,'invoiceno' ,'pcs' ,'weight' ,'rewight' ,'received_pcs' ,'sender_address' ,'reciever_address','phone' ,'state' ,'district' ,'pincode' ,'goods_desc' ,'recieved_at_hub','connecting_date','recieved_at_branch','vendor','docket','contact_no','goods_status' ,'remarks' ,'sendingdate' ,'recievingdate' ,'created_at'];
			$deleteValue = $_GET['inptvalue'];
			$deleteQuery = $_GET['serachq'];
			log_message('deleted', $this->data["result"]);
			// $this->admin_model->delete_table_account('goods_details',$deleteValue,$deleteQuery);
			$this->generate_excel($this->data["result"],$fields,'DOWNLOAD_TO_IMPORT');
		}
		
		$this->data['total_sel_cnt']  		= $this->admin_model->get_sort_order_count('goods_details', $branch_id);
		$this->data['branches'] 			= $branches;
		$this->data['current_branch_id']	= $branch_id;
		// $str_links 							= $this->pagination->create_links();
		// $this->data["links"] 				= explode('&nbsp',$str_links );

		$this->data["links"] = $this->pagination->create_links();

		$this->load->view('head/header',$this->data);
		$this->load->view('goods_details/index');
		$this->load->view('head/footer');

	}

	function createExcel(array $data, array $headers = [], $fileName = 'data.xlsx') {
        $spreadsheet 	= new Spreadsheet();
        $sheet 			= $spreadsheet->getActiveSheet();

        for ($i = 0, $l = sizeof($headers); $i < $l; $i++) {			
            $sheet->setCellValueByColumnAndRow($i + 1, 1, $headers[$i]);
        }

        for ($i = 0, $l = sizeof($data); $i < $l; $i++) { // row $i
            $j = 0;			
            foreach ($data[$i] as $k => $v) { // column $j
                $sheet->setCellValueByColumnAndRow($j + 1, ($i + 1 + 1), $v);
                $j++;
            }
        }
		
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output');
		ob_start();
		//$writer->save("php://output");
		$content = ob_get_contents();
		//ob_end_clean();
		die($content);
    }

	function makeObject($sl,$item,$fields) {
		$row=array();
		foreach($fields as $field) {
			if($field=="slno") {
				$row[$field]= $sl;
			} else {
				$row[$field] = $item->$field;
			}
		}
		return $row;
	}

	public function generate_excel($data,$fields,$fileName) {
		$rows = array();
		foreach($data  as $key => $item){
			$rows[$key] = $this->makeObject(($key+1),$item,$fields);
		}
		foreach($fields as $field) {
			$headers[] = strtoupper(str_replace('_',' ',$field));
		}
        $this->createExcel($rows, $headers, "$fileName.xlsx");
    }

	public function create() {
		$this->data['page_id']		= "goods_details_create";
		$this->data['page_title']   =" Add goods details  | Cargoadmin";
		$this->load->view('head/header',$this->data);
		$this->load->view('goods_details/create');
		$this->load->view('head/footer');
	}


	public function create_process() { 
        //add
        $config['upload_path'] 		= './assets/uploads/headers';
        $config['allowed_types'] 	= 'gif|jpg|png';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('header')) {
            if ($this->upload->data()['file_name']){
                $error 						= array('error' => strip_tags($this->upload->display_errors()));
                $this->data['page_id']		= "goods_details_create";
                $this->data['page_title']	= "Add goods details  | Cargoadmin";
                $this->load->view('head/header',$this->data);
                $this->load->view('goods_details/create', $error);
                $this->load->view('head/footer');
                return;
            }
        } else {
            $file_name = $this->upload->data()['file_name'];
        }
		//end

        $datax=array(
            'invoiceno'=>$this->security->xss_clean($this->input->post('invoiceno')),
            'date'=>$this->security->xss_clean($this->input->post('datex')),
            'district'=>$this->security->xss_clean($this->input->post('district')),
            'company'=>$this->security->xss_clean($this->input->post('company')),

            //add
            'header'=>$file_name,
            //end

            'address'=>$this->security->xss_clean($this->input->post('address')),
            'weight'=>$this->security->xss_clean($this->input->post('weight')),
            'pcs'=>$this->security->xss_clean($this->input->post('pcs')),
            'shipmentname'=>$this->security->xss_clean($this->input->post('shipmentname')),
            'sendingdate'=>$this->security->xss_clean($this->input->post('sendingdate')),
            'recievingdate'=>$this->security->xss_clean($this->input->post('recievingdate')),
            'created_at'=>date('Y-m-d H:i:s'),
			'branch_id'=>$this->security->xss_clean($this->input->post('branch_id')),
			'origin_id'=>$this->security->xss_clean($this->input->post('branch_id')),
			
            'status'=>0
        );

	 
        $lstid=$this->crud_model->create_table_account('goods_details',$datax);
        $this->session->set_flashdata('msgx',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> created successfully.</div>");
        redirect(base_url().'goods_details/create');


	}

    public function store() {
        $config['upload_path'] = './images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('profile_image')) {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('files/upload_form', $error);
        } else {
            $data = array('image_metadata' => $this->upload->data());

            $this->load->view('files/upload_result', $data);
        }
    }


    public function update()
	{
		if($this->uri->segment(3)==null){
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        	redirect(base_url().'goods_details');
		}
		else{
			$this->data['page_id']="goods_details";
			$this->data['page_title']="Update goods details  | cargoadmin";
			$data_cndtnx=array('id'=>$this->uri->segment(3));
			$details=$this->admin_model->get_all_data('goods_details',$data_cndtnx,'id','DESC');
			if($details==false){
				$this->session->set_flashdata('ermsg',"<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        	redirect(base_url().'goods_details');
			}
			else{
				$this->data["id"] =$details[0]->id;
				$this->data["invoiceno"] =$details[0]->invoiceno;
				$this->data["date"] =$details[0]->date;
				$this->data["district"] =$details[0]->district;
				$this->data["company"] =$details[0]->company;
				$this->data["address"] =$details[0]->address;
				$this->data["weight"] =$details[0]->weight;
				$this->data["pcs"] =$details[0]->pcs;
				$this->data["shipmentname"] =$details[0]->shipmentname;
				$this->data["agencyname"] =$details[0]->agencyname;
				$this->data["sendingdate"] =$details[0]->sendingdate;
				$this->data["recievingdate"] =$details[0]->recievingdate;
				$this->data["branch_id"] =$details[0]->branch_id;

				$this->data['goods_status'] = $details[0]->goods_status;
				$this->data['goods_desc'] = $details[0]->goods_desc;
				$this->data['remarks'] = $details[0]->remarks;
				$this->data['goods_status'] = $details[0]->goods_status;
				$this->data['contact_no'] = $details[0]->contact_no;
				$this->data['phone'] = $details[0]->phone;
				$this->data['pincode'] = $details[0]->pincode;
				$this->data['state'] = $details[0]->state;
				$this->data['reciever_address'] = $details[0]->reciever_address;
				$this->data['sender_address'] = $details[0]->sender_address;
				$this->data['recieved_at_branch'] = $details[0]->recieved_at_branch;
				$this->data['connecting_date'] = $details[0]->connecting_date;
				$this->data['recieved_at_hub'] = $details[0]->recieved_at_hub;
				$this->data['rewight'] = $details[0]->rewight;
				$this->data['boxno'] = $details[0]->boxno;
				$this->data['received_pcs'] = $details[0]->received_pcs;
				$this->data['docket'] = $details[0]->docket;
				$this->data['vendor'] = $details[0]->vendor;
				$this->data['tracking_no'] = $details[0]->tracking_no;
				$this->data['trip_no'] = $details[0]->trip_no;


				$this->load->view('head/header',$this->data);
				$this->load->view('goods_details/update');
				$this->load->view('head/footer');
			}
		}
	}

	
	public function update_process()
	{
        $uiid=$this->input->post('uid');
			$datax=array(
				'invoiceno'=>$this->security->xss_clean($this->input->post('invoiceno')),
				'date'=>$this->security->xss_clean($this->input->post('datex')),
				'district'=>$this->security->xss_clean($this->input->post('district')),
				'company'=>$this->security->xss_clean($this->input->post('company')),
				'address'=>$this->security->xss_clean($this->input->post('address')),
				'weight'=>$this->security->xss_clean($this->input->post('weight')),
				'pcs'=>$this->security->xss_clean($this->input->post('pcs')),
				'shipmentname'=>$this->security->xss_clean($this->input->post('shipmentname')),
				'agencyname'=>$this->security->xss_clean($this->input->post('agencyname')),
				'sendingdate'=>$this->security->xss_clean($this->input->post('sendingdate')),
				'recievingdate'=>$this->security->xss_clean($this->input->post('recievingdate')),
				'branch_id'=>$this->security->xss_clean($this->input->post('branch_id')),
				'created_at'=>date('Y-m-d H:i:s'),
				'status'=>0,
				'goods_desc' => $this->security->xss_clean($this->input->post('goods_desc')),
				'remarks' => $this->security->xss_clean($this->input->post('remarks')),
				'goods_status' => $this->security->xss_clean($this->input->post('goods_status')),
				'contact_no' => $this->security->xss_clean($this->input->post('contact_no')),
				'phone' => $this->security->xss_clean($this->input->post('phone')),
				'pincode' => $this->security->xss_clean($this->input->post('pincode')),
				'state' => $this->security->xss_clean($this->input->post('state')),
				'reciever_address' => $this->security->xss_clean($this->input->post('reciever_address')),
				'sender_address' => $this->security->xss_clean($this->input->post('sender_address')),
				'recieved_at_branch' => $this->security->xss_clean($this->input->post('recieved_at_branch')),
				'connecting_date' => $this->security->xss_clean($this->input->post('connecting_date')),
				'recieved_at_hub' => $this->security->xss_clean($this->input->post('recieved_at_hub')),
				'rewight' => $this->security->xss_clean($this->input->post('rewight')),
				'boxno' => $this->security->xss_clean($this->input->post('boxno')),
				'received_pcs' => $this->security->xss_clean($this->input->post('received_pcs')),
				'docket' => $this->security->xss_clean($this->input->post('docket')),
				'vendor' => $this->security->xss_clean($this->input->post('vendor')),
				'tracking_no' => $this->security->xss_clean($this->input->post('tracking_no')),
				'trip_no' => $this->security->xss_clean($this->input->post('trip_no')),
			);

			$lstid=$this->crud_model->edit_table_account('goods_details',$datax,$uiid,'id');
			$this->session->set_flashdata('msgx',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> Updated successfully.</div>");
        	redirect(base_url().'goods_details/update/'.$uiid);
    }

	public function update_info()
	{
        $uiid=$this->input->post('id');
			$datax=array(
				'rewight'=>$this->security->xss_clean($this->input->post('rewight')),
				'recieved_at_hub'=>$this->security->xss_clean($this->input->post('recieved_at_hub')),
				'vendor'=>$this->security->xss_clean($this->input->post('vendor')),
				'docket'=>$this->security->xss_clean($this->input->post('docket')),
				'received_pcs'=>$this->security->xss_clean($this->input->post('recieved_pcs')),
				'connecting_date'=>$this->security->xss_clean($this->input->post('connecting_date')),
				'remarks'=>$this->security->xss_clean($this->input->post('remarks')),
				'goods_status'=> $this->security->xss_clean($this->input->post('goods_status')),
				'bg_color'=> NULL,
			);
    
			$lstid=$this->crud_model->edit_table_account('goods_details',$datax,$uiid,'id');
			echo "Successfully updated";

    }


    public function delete_process()
	{
		if($this->uri->segment(3)==null){
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        	redirect(base_url().'goods_details');
		}
		else{

			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Deleted successfully..!.</div>");
        	redirect(base_url().'goods_details');
		}
    }
    public function print()
	{
		if($this->uri->segment(3)==null){
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        	redirect(base_url().'goods_details');
		}
		else{
			$this->data['page_id']="goods_details";
			$this->data['page_title']="Print";
			$data_cndtnx=array('id'=>$this->uri->segment(3));
			$goods_details 	= $this->admin_model->getSelectedData('goods_details', 'tracking_no',$data_cndtnx);
			$tracking_no = $goods_details[0]->tracking_no;

			$data_cndtny=array('tracking_no'=>$tracking_no, 'transfer_status' => 'pending');
			$goods_same_tracking_no 	= $this->admin_model->getSelectedData('goods_details', 'tracking_no, transfer_status',$data_cndtny);
			if ( count( $goods_same_tracking_no  )  > 0 ) {
				 
				$this->session->set_flashdata('ermsg',"<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Not able to print. Goods in pending list!</div>");
        		redirect(base_url().'goods_details');
			}

		 

			$data_cndtnx=array('id'=>$this->uri->segment(3));
			$details=$this->admin_model->get_all_data_selected_print('goods_details',$data_cndtnx,'id','DESC'); 			 
			
			if($details==false){
				$this->session->set_flashdata('ermsg',"<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        		redirect(base_url().'goods_details');
			}
			else{
				$this->data['result']=$details;
				$this->load->view('head/header',$this->data);
				$this->load->view('goods_details/print');
				$this->load->view('head/footer');
			}
		}
	}
	
	public function print_pod()
	{
		if($this->uri->segment(3)==null){
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        	redirect(base_url().'goods_details');
		}
		else{
			$this->data['page_id']="goods_details";
			$this->data['page_title']="Print";
			$data_cndtnx=array('id'=>$this->uri->segment(3));
			$details=$this->admin_model->get_all_data_selected_print('goods_details',$data_cndtnx,'id','DESC'); 

			$goods_details 	= $this->admin_model->getSelectedData('goods_details', 'tracking_no',$data_cndtnx);
			$tracking_no = $goods_details[0]->tracking_no;

			$data_cndtny=array('tracking_no'=>$tracking_no, 'transfer_status' => 'pending');
			$goods_same_tracking_no 	= $this->admin_model->getSelectedData('goods_details', 'tracking_no, transfer_status',$data_cndtny);
			if ( count( $goods_same_tracking_no  )  > 0 ) {
				 
				$this->session->set_flashdata('ermsg',"<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Not able to print. Goods in pending list!</div>");
        		redirect(base_url().'goods_details');
			}
						 
			
			if($details==false){
				$this->session->set_flashdata('ermsg',"<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        		redirect(base_url().'goods_details');
			}
			else{ 
				$this->data['result']=$details;
				$this->load->view('head/header',$this->data);
				$this->load->view('goods_details/print_pod');
				$this->load->view('head/footer');
			}
		}
	}

	public function printall()
	{

			$this->data['page_id']="goods_details";
			$this->data['page_title']="Print";
			$data_cndtnx=array();
			$new_check_box = array();
			if(isset($_GET['ids']) && !empty($_GET['ids']))
			{
				$new_check_box = explode('_', $_GET['ids']);
			}

			$details = $this->admin_model->get_all_data_selected_print('goods_details',$data_cndtnx,'id','DESC',$new_check_box);			 

			if($details==false){
				$this->session->set_flashdata('ermsg',"<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        		redirect(base_url().'goods_details');
			}
			else{
				$this->data['result']=$details;
				$this->load->view('head/header',$this->data);
				$this->load->view('goods_details/print');
				$this->load->view('head/footer');
			}
	}

	public function printall_pod()
	{

			$this->data['page_id']="goods_details";
			$this->data['page_title']="Print";
			$data_cndtnx=array();
			$new_check_box = array();
			if(isset($_GET['ids']) && !empty($_GET['ids']))
			{
				$new_check_box = explode('_', $_GET['ids']);
			}

			$details = $this->admin_model->get_all_data_selected_print('goods_details',$data_cndtnx,'id','DESC',$new_check_box);			 

			if($details==false){
				$this->session->set_flashdata('ermsg',"<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        		redirect(base_url().'goods_details');
			}
			else{
				$this->data['result']=$details;
				$this->load->view('head/header',$this->data);
				$this->load->view('goods_details/print_pod');
				$this->load->view('head/footer');
			}
	}

	public function printall_blank_pod()
	{

			$this->data['page_id']="goods_details";
			$this->data['page_title']="Print";
			$data_cndtnx=array();
			$new_check_box = array();
			if(isset($_GET['ids']) && !empty($_GET['ids']))
			{
				$new_check_box = explode('_', $_GET['ids']);
			}

			$details = $this->admin_model->get_all_data_selected_print('goods_details',$data_cndtnx,'id','DESC',$new_check_box);			 

			if($details==false){
				$this->session->set_flashdata('ermsg',"<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        		redirect(base_url().'goods_details');
			}
			else{
				$this->data['result']=$details;
				$this->load->view('head/header',$this->data);
				$this->load->view('goods_details/print_blank_pod');
				$this->load->view('head/footer');
			}
	}

	public function printnew()
	{
			$this->data['page_id']="goods_details";
			$this->data['page_title']="Print";
			$data_cndtnx=array();
			$details=$this->admin_model->get_all_data('goods_details',$data_cndtnx,'id','DESC');
			if($details==false){
				$this->session->set_flashdata('ermsg',"<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        		redirect(base_url().'goods_details');
			}
			else{
				$this->data['result']=$details;
				$this->load->view('head/header',$this->data);
				$this->load->view('goods_details/printnew');
				$this->load->view('head/footer');
			}
	}

    public function import()
	{
		$this->data['page_id']="goods_details_import";
		$this->data['page_title']="Import goods details  | Cargoadmin";

		$data_cndtnx=array();
		$this->data['cargos_arr'] = $this->admin_model->get_all_data('cargo',$data_cndtnx,'id','DESC'); 

		$this->load->view('head/header',$this->data);
		$this->load->view('goods_details/import',$this->data);
		$this->load->view('head/footer');
	}

	public function import_process()
	{
 
		ini_set('max_execution_time', '300');

		$file_mimes = array(
            'text/csv',
            'text/plain',
            'text/x-csv',
            'application/csv',
            'application/x-csv',
            'application/excel',
            'application/vnd.msexcel',
            'application/vnd.ms-excel',
            'application/octet-stream', 
            'text/comma-separated-values',
            'text/x-comma-separated-values',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
 

	  	$cargo_id = $this->security->xss_clean($this->input->post('cargo_id')); 
		$trip_no = $this->security->xss_clean($this->input->post('trip_no')); 
	  	$clearence_date = $this->security->xss_clean($this->input->post('clearence_date'));  

		  $branch_id = $this->session->userdata['adminloginel']['id'];

		  $data_shipments=array(
								'name'				=>  $trip_no,
								'clearence_date'	=>  $clearence_date,
								'branch_id' 		=>  $branch_id,
								'cargo_id' 			=>  $cargo_id,
								'is_transfer' 		=>  0,
							);
		$shipment = $this->crud_model->create_table_account('shipments', $data_shipments); 
	    $shipment_id = $this->db->insert_id();

		 
		$data_cndtnx = array('id' => $cargo_id);
		$details = $this->admin_model->get_all_data('cargo', $data_cndtnx, 'id', 'DESC');
		$file_name = $details[0]->id;


		if(isset($_FILES['upload_file']['name']) && in_array($_FILES['upload_file']['type'], $file_mimes)) {

			$arr_file = explode('.', $_FILES['upload_file']['name']);
			$extension = end($arr_file);

			if('csv' == $extension){
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} else {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}

			$spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
			$sheetData = $spreadsheet->getActiveSheet()->toArray();


			foreach ($sheetData as $key => $val){
				$data_import=array(
								'trip_no'=>$trip_no,
								'data' =>      json_encode($val));
				$lstid1 = $this->crud_model->create_table_account('import_data', $data_import); 
				 

					$datax=array(
						'company' =>       isset($val['0']) ? trim($val['0']): "",
						//add
						'header' =>        $file_name,
						//end
						'shipment_id'  => 	$shipment_id,
						'shipmentname' =>  	isset($val['1']) ? trim($val['1']): "",
						'agencyname' =>  	isset($val['2']) ? trim($val['2']): "",
						'origin' =>        	isset($val['3']) ? trim($val['3']): "",
						'boxno' =>         	isset($val['4']) ? trim($val['4']): "",
						'tracking_no' =>   	isset($val['5']) ? trim($val['5']): "",
						'invoiceno' =>     	isset($val['6']) ? trim($val['6']): "",
						'pcs' =>           	isset($val['7']) ? trim($val['7']): "",
						'weight' =>        	isset($val['8']) ? trim($val['8']): "",
						'rewight' =>       	isset($val['9']) ? trim($val['9']): "",
						'received_pcs' =>  	isset($val['10']) ? trim($val['10']): "",
						'sender_address' => isset($val['11']) ? trim($val['11']): "",
						'reciever_address'=>isset($val['12']) ? trim($val['12']): "",
						'phone' =>         	isset($val['13']) ? trim($val['13']): "",
						'state' =>         	isset($val['14']) ? trim($val['14']): "",
						'district' =>      	isset($val['15']) ? trim($val['15']): "",
						'pincode' =>       	isset($val['16']) ? trim($val['16']): "",
						'goods_desc' =>    	isset($val['17']) ? trim($val['17']): "",
						'recieved_at_hub'=>	isset($val['18']) ? trim($val['18']): "",
						'received_date'=>  	isset($val['18']) ? date('d-m-Y', strtotime( trim($val['18']) ) ):"" ,
						'connecting_date'=>	isset($val['19']) ? trim($val['19']): "",
						'recieved_at_branch'=>isset($val['20']) ? trim($val['20']): "",
						'vendor'=>         	isset($val['21']) ? trim($val['21']): "",
						'docket'=>         	isset($val['22']) ? trim($val['22']): "",
						'url'=>            	isset($val['26']) ? trim($val['26']): "",
						'contact_no'=>     	isset($val['23']) ? trim($val['23']): "",
						'goods_status' =>   isset($val['24']) ? trim($val['24']): "",
						'remarks' =>       	isset($val['25']) ? trim($val['25']): "",
						'sendingdate' =>   	isset($val['26']) ? trim($val['26']): "",
						'recievingdate' =>  isset($val['28']) ? trim($val['28']): "",
						'trip_no' =>   $trip_no,
						'created_at' =>    date('Y-m-d H:i:s'),
						'clearence_date' => date('d-m-Y', strtotime( $clearence_date )),
						'origin_id' =>    $this->session->userdata['adminloginel']['id'],
						'branch_id' =>    $this->session->userdata['adminloginel']['id']						
					); 

					$val['5'] = $this->security->xss_clean($val['5']); 
					$conditon = array( 'trip_no' => $trip_no, 'invoiceno' => $val['5'] );
					$res = $this->crud_model->check_duplicate('shipment_details', $conditon); 
					
					if(count($res) == 0) {
						$lstid = $this->crud_model->create_table_account('shipment_details', $datax);


						// $goods_status_data = array(  
						// 	'invoice_number'=> trim($val['5']),
						// 	'trip_sheet_id' =>  null ,
						// 	'goods_status' => 'Waiting for Customs clearence',
						// 	'filename' => null,
						// 	'in_transit_url' => null,
						// 	'message' =>  null,
						// 	'created_at' => date('Y-m-d H:i:s'),
						// 	'tracking_no' => trim($val['4']),
						// 	'branch_id' => $this->session->userdata['adminloginel']['id'],
						// );
				
						// $lstid = $this->crud_model->create_table_account('goods_status', $goods_status_data); 

					}else{
						$datay=array(	
							'row_no'=>           $key+1,
							'trip_no'=>     	$trip_no,
							'invoice_no'=>        trim($val['5']) ,
							'created_at' =>    date('Y-m-d H:i:s'),
							'updated_at' =>    date('Y-m-d H:i:s'),
						);
						$lstid = $this->crud_model->create_table_account('goods_not_imported', $datay);
					}  
				
			}
		
			$this->session->set_flashdata('msgx',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> imported successfully.</div>");
		
		}

		redirect(base_url() . 'goods_details/import');
	}


	function removeGoodsRecords()
	{
		if(empty($_POST['checkbox_arr']))
		{
			echo json_encode(array('status'=>0,'message'=>'Please select records'));

		}else{
			$resp = $details=$this->admin_model->remove_goods_records($_POST['checkbox_arr']);
			if($resp)
			{
				echo json_encode(array('status'=>1,'message'=>'Selected records have been removed successfully.'));
			}else{
				echo json_encode(array('status'=>0,'message'=>'Something went wrong.Please try later.'));
			}
		}
	}


	function listTransferPending() {


		$this->data['page_id']="list_transfer_pending";
		$this->data['page_title']="All Transfer Pending Goods  | cargoadmin";
		$config = array();
		$searchqry = array();

		$branches = $this->admin_model->get_all_active_branches();

		$data_cndtnx = array('status' => 0);
		$this->data['vehicles'] = $this->admin_model->get_all_data('vehicles', $data_cndtnx, 'id', 'DESC');

		$branch_id = $this->session->userdata['adminloginel']['id'];
		$data_cndtn=array('is_transfer'=> 1, 'transfer_status' => 'pending', 'transferred_to' => $branch_id);

 
		$data_cndtnz = array();
		// $this->data['trip_no_arr']  
		$this->data['trip_no_arr'] = $this->admin_model->get_all_trip_no('goods_details', $data_cndtnz, 'id', 'DESC'); 

		if(isset($_GET['serachq']) && $_GET['serachq']!=null && $_GET['serachq']!='all'){

		 
			if($_GET['serachq'] == 'transfer') {
				$searchqry  = 'is_transfer = 1';
			}else if($_GET['serachq'] == 'goods_status') {
				 
				if(isset($_GET['inptvalue']) && $_GET['inptvalue']!=null && $_GET['inptvalue']!=''){ 

					if(empty($searchqry))
					{
						$searchqry= ' (goods_status = "' .  $_GET['inptvalue'] .'")';
					} 
					else{
						$searchqry .= ' AND  (goods_status = "' .  $_GET['inptvalue'] .'")';
					}
				} else if($_GET['inptvalue']=='') {
					
						if(empty($searchqry))
						{
							$searchqry= ' (goods_status = " ")';
						} 
						else{
							$searchqry .= ' AND  (goods_status = " ")';
						}
				}

			}else {
				$searchqry= $_GET['serachq'].' LIKE "%' . $_GET['inptvalue'] . '%"';

			} 
		}
 
		if(isset($_GET['date']) && $_GET['date']!=null && $_GET['date']!=''){
			if(empty($searchqry))
			{
				$searchqry= ' (date = "' . date('Y-m-d',strtotime($_GET['date'])) . '" OR date= "' . date('d-m-Y',strtotime($_GET['date'])) . '" OR date = "' . date('m/d/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d/m/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d.m.Y',strtotime($_GET['date'])) . '")';
			}else{
				$searchqry .= ' AND (date = "' . date('Y-m-d',strtotime($_GET['date'])) . '" OR date= "' . date('d-m-Y',strtotime($_GET['date'])) . '" OR date = "' . date('m/d/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d/m/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d.m.Y',strtotime($_GET['date'])) . '")';
			}
		}

		if(isset($_GET['trip_no']) && $_GET['trip_no']!=null && $_GET['trip_no']!=''){
		  

			$trip = "'" . implode ( "', '",  $_GET['trip_no'] ) . "'";

			if(empty($searchqry))
			{
				$searchqry= ' (trip_no in ('.$trip.'))';
			}else{
				$searchqry .= ' AND (trip_no in ( '.$trip.'))';
			}
			
	   }
		 

		if(!empty($_GET['msg']) && $_GET['msg']==1)
		{
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Deleted successfully..!.</div>");

        	redirect(base_url().'goods_details/listTransferPending');
		}
		
		$config["base_url"] = base_url()."goods_details/listTransferPending";

		$total_row = $this->admin_model->count_all_data_condition_ordersearch('goods_details',$data_cndtn,'id','DESC',$searchqry);
		$config["total_rows"] = $total_row;
		$config["per_page"] =200;
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
		
		$this->data["result"] = $this->admin_model->get_all_data_condition_ordersearch('goods_details' ,$data_cndtn,$config["per_page"], $page,'id','DESC',$searchqry);

		if(isset($_GET['download_ogm']))
		{
			$this->generate_excel($this->data["result"],['slno','vendor','boxno','invoiceno','pcs','weight','reciever_address','sender_address','pincode','state','goods_desc'],'OGM');
		}
		if(isset($_GET['download_sorting']))
		{
			$this->generate_excel($this->data["result"],['slno','boxno','invoiceno','pcs','weight','rewight','district','remarks'],'SORTING LIST');
		}
		if(isset($_GET['download_loading']))
		{
			$this->generate_excel($this->data["result"],['slno','boxno','invoiceno','pcs','weight','rewight','state','vendor','connecting_date'],'LOADING LIST');
		}
		if(isset($_GET['download_to_import']))
		{
			$fields=['company' ,'shipmentname', 'agencyname','origin' ,'boxno' ,'invoiceno' ,'pcs' ,'weight' ,'rewight' ,'received_pcs' ,'sender_address' ,'reciever_address','phone' ,'state' ,'district' ,'pincode' ,'goods_desc' ,'recieved_at_hub','connecting_date','recieved_at_branch','vendor','docket','contact_no','goods_status' ,'remarks' ,'sendingdate' ,'recievingdate' ,'created_at'];
			$deleteValue = $_GET['inptvalue'];
			$deleteQuery = $_GET['serachq'];
			log_message('deleted', $this->data["result"]);
			// $this->admin_model->delete_table_account('goods_details',$deleteValue,$deleteQuery);
			$this->generate_excel($this->data["result"],$fields,'DOWNLOAD_TO_IMPORT');
			
		}
		
		$this->data['branches'] = $branches;
		$this->data['current_branch_id'] = $branch_id;
		// $str_links = $this->pagination->create_links();
		// $this->data["links"] = explode('&nbsp',$str_links );
		$this->data["links"] = $this->pagination->create_links();
		$this->load->view('head/header',$this->data);
		$this->load->view('goods_details/transfer_pending');
		$this->load->view('head/footer');


	}

	function change_status_multiple() { 

		  if( $this->input->post('cargo_id_sel') !='') {
			$selGoodsIds 			= explode(',',$this->security->xss_clean($this->input->post('cargo_id_sel')));  
			$remarks = $this->security->xss_clean($this->input->post('remarks'));		

			foreach($selGoodsIds as $key => $goodsId) {   
				
				$datax = array(
					'remarks' 			=> $remarks, 
					'sort_order' 		=> NULL,
					'goods_status'		=> $this->security->xss_clean($this->input->post('goods_status')),  
				);				
				$this->crud_model->edit_table_account('goods_details', $datax, $goodsId, 'id');	
			}
			echo "Successfully updated";
		} else {
			echo "Please select goods";
		}




	}
// 	function transfer_goods() {

// 		if( $this->input->post('sel_goods_id') !='') {
// 			$selGoodsIds 			= explode(',',$this->security->xss_clean($this->input->post('sel_goods_id'))); 
// 			$vehicle_id 			= $this->security->xss_clean($this->input->post('vehicle_id')); 
// 			$transferred_from 		= $this->security->xss_clean($this->input->post('transfer_from'));
// 			$transferred_to 		= $this->security->xss_clean($this->input->post('transfer_to')); 
// 			$estimate_delivery_date = $this->security->xss_clean($this->input->post('estimate_delivery_date'));		
// 			$transferred_from_data 	= $this->admin_model->get_branch("administrator",$transferred_from );
// 			$from_branch 			= $transferred_from_data[0]->name;
// 			$transferred_to_data 	= $this->admin_model->get_branch("administrator",$transferred_to );
// 			$to_branch 				= $transferred_to_data[0]->name;

// 			foreach($selGoodsIds as $key => $goodsId) {    
// 			    $data 			= $this->admin_model->get_data("goods_details",$goodsId);			 
//  				$invoice_number = $data[0]->invoiceno;
//  				$tracking_no  	= $data[0]->tracking_no;
//  				$rewight  		= $data[0]->rewight;
//  				$shipmentname  	= $data[0]->shipmentname;				 

// 				if( $key == 0 ){
// 					$data_tr = array(
// 						'shipment_name' 	=> $shipmentname ,
// 						'transferred_from' 	=> $transferred_from,
// 						'transferred_to' 	=> $transferred_to,						
// 						'status' 			=> "pending",						
// 					);					 
// 					$lstid_tr = $this->crud_model->create_table_account('goods_transfer_list', $data_tr); 
// 				}

// 				if($rewight == '') {
// 					$bgcolor = NULL;
// 				} else {
// 					$bgcolor = 'yellow';
// 				} 
// 					$datay = array(
// 						'goods_id' 			=> $goodsId ,
// 						'transferred_from' 	=> $transferred_from,
// 						'transferred_to' 	=> $transferred_to,  
// 						'vehicle_id' 		=> $vehicle_id,
// 						'transfer_status' 	=> "pending",
// 						'invoice_number' 	=> $invoice_number,
// 						'tracking_no' 		=> $tracking_no,
// 						'comment' 			=> "Transferred from " .$from_branch." To ".$to_branch,
// 						'transfer_id'		=> $lstid_tr
// 					);					 
// 					$lstid = $this->crud_model->create_table_account('goods_transfer_details', $datay);

// 					$shipment_status_data = array(  
// 						'invoice_number'	=>  $data[0]->invoiceno,
// 						'trip_sheet_id' 	=>  null ,
// 						'shipment_id'		=> $data[0]->shipment_id,
// 						'shipment_status'	=> 'Transferred to '.$to_branch,
// 						'filename' 			=> null,
// 						'in_transit_url' 	=> null,
// 						'message' 			=>  null,
// 						'created_at' 		=> date('Y-m-d H:i:s'),
// 						'tracking_no' 		=>  $data[0]->tracking_no,
// 						'branch_id' 		=> $this->session->userdata['adminloginel']['id'],
// 					);
// 					$shipment_status_id = $this->crud_model->create_table_account('shipment_status', $shipment_status_data);

// 					$datax = array(
// 						'branch_id' 			=> $transferred_to,
// 						'transferred_from' 		=> $transferred_from,
// 						'transferred_to' 		=> $transferred_to, 
// 						'is_transfer' 			=> 1, 
// 						'transfer_status' 		=> "pending", 
// 						'current_transfer_id' 	=> $lstid, 
// 						'sort_order' 			=> NULL,
// 						'bg_color' 				=> $bgcolor,
// 						'estimate_delivery_date'=> $estimate_delivery_date,
// 						'transfer_id'			=> $lstid_tr,
// 						'shipment_status_id'	=> $shipment_status_id
// 					);				
// 					$this->crud_model->edit_table_account('goods_details', $datax, $goodsId, 'id');				
// 					$this->crud_model->edit_table_account('shipment_details', $datax, $goodsId, 'id');		
// 					// echo $this->db->last_query();
// 					// die("sasa");

// 				}

// 				$this->session->set_flashdata('msgx',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> Transferred successfully.</div>"); 
// 				redirect(base_url().'goods_details/');		

// 		} else {

// 				$this->session->set_flashdata('msgx',"<div class='alert alert-error' style='color:red;'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> No Goods Selected.</div>"); 
// 				redirect(base_url().'goods_details/');
// 		}

// 	}



function transfer_goods() {

		if ($this->input->post('sel_goods_id') != '') {
			$selGoodsIds = explode(',', $this->security->xss_clean($this->input->post('sel_goods_id')));
			$vehicle_id = $this->security->xss_clean($this->input->post('vehicle_id'));
			$transferred_from = $this->security->xss_clean($this->input->post('transfer_from'));
			$transferred_to = $this->security->xss_clean($this->input->post('transfer_to'));
			$estimate_delivery_date = $this->security->xss_clean($this->input->post('estimate_delivery_date'));
			$transferring_date = $this->security->xss_clean($this->input->post('transferring_date')); // Added transferring_date
	
			$transferred_from_data = $this->admin_model->get_branch("administrator", $transferred_from);
			$from_branch = $transferred_from_data[0]->name;
			$transferred_to_data = $this->admin_model->get_branch("administrator", $transferred_to);
			$to_branch = $transferred_to_data[0]->name;
	
			foreach ($selGoodsIds as $key => $goodsId) {
				$data = $this->admin_model->get_data("goods_details", $goodsId);
				$invoice_number = $data[0]->invoiceno;
				$tracking_no = $data[0]->tracking_no;
				$rewight = $data[0]->rewight;
				$shipmentname = $data[0]->shipmentname;
	
				if ($key == 0) {
					$data_tr = array(
						'shipment_name' => $shipmentname,
						'transferred_from' => $transferred_from,
						'transferred_to' => $transferred_to,
						'status' => "pending",
					);
					$lstid_tr = $this->crud_model->create_table_account('goods_transfer_list', $data_tr);
				}
	
				$bgcolor = ($rewight == '') ? NULL : 'yellow';
	
				$datay = array(
					'goods_id' => $goodsId,
					'transferred_from' => $transferred_from,
					'transferred_to' => $transferred_to,
					'vehicle_id' => $vehicle_id,
					'transfer_status' => "pending",
					'invoice_number' => $invoice_number,
					'tracking_no' => $tracking_no,
					'comment' => "Transferred from " . $from_branch . " To " . $to_branch,
					'transfer_id' => $lstid_tr,
					'transferring_date' => $transferring_date // Added transferring_date
				);
	
				$lstid = $this->crud_model->create_table_account('goods_transfer_details', $datay);
	
				$shipment_status_data = array(
					'invoice_number' => $data[0]->invoiceno,
					'trip_sheet_id' => null,
					'shipment_id' => $data[0]->shipment_id,
					'shipment_status' => 'Transferred to ' . $to_branch,
					'filename' => null,
					'in_transit_url' => null,
					'message' => null,
					'created_at' => date('Y-m-d H:i:s'),
					'tracking_no' => $data[0]->tracking_no,
					'branch_id' => $this->session->userdata['adminloginel']['id'],
				);
				$shipment_status_id = $this->crud_model->create_table_account('shipment_status', $shipment_status_data);
	
				$datax = array(
					'branch_id' => $transferred_to,
					'transferred_from' => $transferred_from,
					'transferred_to' => $transferred_to,
					'is_transfer' => 1,
					'transfer_status' => "pending",
					'current_transfer_id' => $lstid,
					'sort_order' => NULL,
					'bg_color' => $bgcolor,
					'estimate_delivery_date' => $estimate_delivery_date,
					'transfer_id' => $lstid_tr,
					'shipment_status_id' => $shipment_status_id,
					'transferring_date' => $transferring_date // Added transferring_date
				);
	
				$this->crud_model->edit_table_account('goods_details', $datax, $goodsId, 'id');
				$this->crud_model->edit_table_account('shipment_details', $datax, $goodsId, 'id');
			}
	
			$this->session->set_flashdata('msgx', "<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> Transferred successfully.</div>");
			redirect(base_url() . 'goods_details/');
		} else {
			$this->session->set_flashdata('msgx', "<div class='alert alert-error' style='color:red;'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> No Goods Selected.</div>");
			redirect(base_url() . 'goods_details/');
		}
	}


	function confirm_received_goods() {
		if( $this->input->post('sel_goods_id_received') !='') {			 
			$selGoodsIds 	= explode(',',$this->security->xss_clean($this->input->post('sel_goods_id_received')));		 
				foreach($selGoodsIds as $goodsId) { 	
					
					$selColumns 			= "current_transfer_id, transferred_to, invoiceno, tracking_no, shipment_id";
					$transfer_data 			= $this->crud_model->get_sel_columns('goods_details', $selColumns, 'id' , $goodsId);  
					
					$transferred_to_data 	= $this->admin_model->get_branch("administrator",$transfer_data[0]->transferred_to );
					$to_branch 				= $transferred_to_data[0]->name;


					$shipment_status_data = array(  
						'invoice_number'	=> $transfer_data[0]->invoiceno,
						'trip_sheet_id' 	=> null ,
						'shipment_id'		=> $transfer_data[0]->shipment_id,
						'shipment_status'	=> 'Received at '.$to_branch,
						'filename' 			=> null,
						'in_transit_url' 	=> null,
						'message' 			=> null,
						'created_at' 		=> date('Y-m-d H:i:s'),
						'tracking_no' 		=> $transfer_data[0]->tracking_no,
						'branch_id' 		=> $this->session->userdata['adminloginel']['id'],
					);
					$shipment_status_id = $this->crud_model->create_table_account('shipment_status', $shipment_status_data);



					$current_transfer_id  	= $transfer_data[0]->current_transfer_id; 			 
					$datay 					= array(						
												'transfer_status' => 'confirmed',
												'goods_received_date' => date("Y-m-d h:i:sa")
											);				
					$this->crud_model->edit_table_account('goods_transfer_details', $datay, $current_transfer_id, 'id');	


					$datax = array( 
						'transfer_status' 		=> 'confirmed',
						'shipment_status_id'	=> $shipment_status_id,
						'received_date' 		=> date("d-m-Y")
					);				 		
					$this->crud_model->edit_table_account('goods_details', $datax, $goodsId, 'id');

					$this->crud_model->edit_table_account('shipment_details', $datax, $goodsId, 'id');				

							
				}
				$this->session->set_flashdata('msgx',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> Transferred successfully.</div>"); 
				redirect(base_url().'goods_details/');

		} else {
				$this->session->set_flashdata('msgx',"<div class='alert alert-error' style='color:red;'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> No Goods Selected.</div>"); 
				redirect(base_url().'goods_details/');
		}

	}
	
	
	public function confirm_shipmentpending_goods() {
		if ($this->input->post('sel_goods_id_pending') != '') {
			$selGoodsIds = explode(',', $this->security->xss_clean($this->input->post('sel_goods_id_pending')));
	
			foreach($selGoodsIds as $goodsId) {
				$selColumns = "current_transfer_id, transferred_to, invoiceno, tracking_no, shipment_id";
				$transfer_data = $this->crud_model->get_sel_columns('goods_details', $selColumns, 'id', $goodsId);
	
				$shipment_status_data = array(
					'invoice_number' => $transfer_data[0]->invoiceno,
					'trip_sheet_id'  => null,
					'shipment_id'    => $transfer_data[0]->shipment_id,
					'shipment_status'=> 'Pending',
					'filename'       => null,
					'in_transit_url' => null,
					'message'        => null,
					'created_at'     => date('Y-m-d H:i:s'),
					'tracking_no'    => $transfer_data[0]->tracking_no,
					'branch_id'      => $this->session->userdata['adminloginel']['id'],
				);
				$shipment_status_id = $this->crud_model->create_table_account('shipment_status', $shipment_status_data);
	
				$current_transfer_id = $transfer_data[0]->current_transfer_id;
				$datay = array(
					'transfer_status' => 'pending',
					'goods_received_date' => null
				);
				$this->crud_model->edit_table_account('goods_transfer_details', $datay, $current_transfer_id, 'id');
	
				$datax = array(
					'transfer_status'      => 'pending',
					'shipment_status_id'   => $shipment_status_id,
					'received_date'        => null
				);
				$this->crud_model->edit_table_account('goods_details', $datax, $goodsId, 'id');
	
	
				$this->crud_model->edit_table_account('shipment_details', $datax, $goodsId, 'id');
			}
	
			$this->session->set_flashdata('msgx', "<div class='alert alert-warning'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> Returned to pending status successfully.</div>");
	
			// Redirect to the Shipment Pending List
			redirect(base_url().'goods_details/shipmentPendingList');
		} else {
			$this->session->set_flashdata('msgx', "<div class='alert alert-error' style='color:red;'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> No Goods Selected.</div>");
			redirect(base_url().'goods_details/');
		}
	}
	
	

	function update_checked() {
		
		$selGoodsIds  = explode('-',   $this->security->xss_clean($this->input->post('id')) ); 
		$flag  =  $this->security->xss_clean($this->input->post('flag'));	 
		$branch_id = $this->session->userdata['adminloginel']['id'];
		$res = $this->admin_model->get_highest_sort_order('goods_details',  $branch_id); 
		 

		  if(empty($res[0]->last_sort_order) ||  $res[0]->last_sort_order == NULL){
			$sort_order = 1; 
		  }else { 
			$sort_order = $res[0]->last_sort_order +1;
		  }

		  if( $flag == 'true'){ 
				$datay = array('sort_order' => $sort_order);	
			} else {
				$datay = array('sort_order' => null);
			}
  
			$this->crud_model->edit_table_account('goods_details', $datay,  $selGoodsIds[1] , 'id');	 

			$total_cnt  = $this->admin_model->get_sort_order_count('goods_details',  $branch_id);
			echo $total_cnt; 

	}

	function update_checked_multipe() {
		 
		  $selGoodsIds  = $_POST['invoice'];
		  $branch_id = $this->session->userdata['adminloginel']['id'];
		  $flag  =  'true';	
		  foreach($selGoodsIds as $selId ){
			$res = $this->admin_model->get_highest_sort_order('goods_details',  $branch_id);
			if(empty($res[0]->last_sort_order)){
				$sort_order = 1;
			}else {
				$sort_order = $res[0]->last_sort_order +1;
			}

			if( $flag == 'true'){ 
					$datay = array('sort_order' => $sort_order);	
				} else {
					$datay = array('sort_order' => null);
				}

				$res = $this->crud_model->check_already_checked('goods_details', $selId );	 
				if( $res){
					$this->crud_model->edit_table_account('goods_details', $datay,  $selId , 'id');	 

				}
		}
			$total_cnt  = $this->admin_model->get_sort_order_count('goods_details');

			echo $total_cnt; 

	}


	function reset_checked() {  
		
		$branch_id = $this->session->userdata['adminloginel']['id'];  
		$this->admin_model->reset_checked('goods_details', $branch_id);	 
    }

	function listTransferGoods() {		 

		$this->data['page_id']		="list_transfer_goods";
		$this->data['page_title']	="All Transfer Goods  | cargoadmin";
		$config 		= array();
		$searchqry 		= array();
		$searchqry_in 	= '';
		$branches 		= $this->admin_model->get_all_active_branches();
		$data_cndtnx 	= array('status' => 0);
		$this->data['vehicles'] 	= $this->admin_model->get_all_data('vehicles', $data_cndtnx, 'id', 'DESC');
		$data_cndtnz				= array();
		$this->data['trip_no_arr'] 	= $this->admin_model->get_all_trip_no('goods_details', $data_cndtnz, 'created_at', 'DESC'); 	 
		$branch_id 					= $this->session->userdata['adminloginel']['id'];
	
		$data_cndtny = array('status' => 7, 'branch_id' => $branch_id);
		$this->data['trip_sheets'] = $this->admin_model->get_all_data('trip_sheet', $data_cndtny, 'id', 'DESC'); 
 
 
		if(isset($_GET['serachq']) && $_GET['serachq']!=null && $_GET['serachq']!='all'){
			if($_GET['serachq'] == 'transfer') {
				$searchqry  = 'is_transfer = 1';
			}else if($_GET['serachq'] == 'goods_status') {
				 
				if(isset($_GET['inptvalue']) && $_GET['inptvalue']!=null && $_GET['inptvalue']!=''){ 

					if(empty($searchqry))
					{
						$searchqry= ' (goods_status = "' .  $_GET['inptvalue'] .'")';
					} 
					else{
						$searchqry .= ' AND  (goods_status = "' .  $_GET['inptvalue'] .'")';
					}
				} else if($_GET['inptvalue']=='') {
					
						if(empty($searchqry))
						{
							$searchqry= ' (goods_status = " ")';
						} 
						else{
							$searchqry .= ' AND  (goods_status = " ")';
						}
				}

			}else {
				$searchqry= $_GET['serachq'].' LIKE "%' . $_GET['inptvalue'] . '%"';

			}
		}
	

		if(isset($_GET['trip_no']) && $_GET['trip_no']!=null && $_GET['trip_no']!=''){
			 if( count($_GET['trip_no'] ) > 0 ){
				$searchqry_in =  $_GET['trip_no'];
			 } else { 
				$searchqry_in =   $_GET['trip_no'];
			 }
			 
		} 

		if(isset($_GET['tracking_no']) && $_GET['tracking_no']!=null && $_GET['tracking_no']!=''){
			if(empty($searchqry))
			{
				$searchqry= ' (tracking_no = "' .  $_GET['tracking_no'] .'")';
			} 
			else{
				$searchqry .= ' AND  (tracking_no = "' .  $_GET['tracking_no'] .'")';
			}
		}

		if(isset($_GET['boxno']) && $_GET['boxno']!=null && $_GET['boxno']!=''){
			if(empty($searchqry))
			{
				$searchqry= ' (boxno = "' .  $_GET['boxno'] .'")';
			} 
			else{
				$searchqry .= ' AND  (boxno = "' .  $_GET['boxno'] .'")';
			}
		}

		
		
 
		if(isset($_GET['date']) && $_GET['date']!=null && $_GET['date']!=''){
			if(empty($searchqry))
			{
				$searchqry= ' (date = "' . date('Y-m-d',strtotime($_GET['date'])) . '" OR date= "' . date('d-m-Y',strtotime($_GET['date'])) . '" OR date = "' . date('m/d/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d/m/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d.m.Y',strtotime($_GET['date'])) . '")';
			}else{
				$searchqry .= ' AND (date = "' . date('Y-m-d',strtotime($_GET['date'])) . '" OR date= "' . date('d-m-Y',strtotime($_GET['date'])) . '" OR date = "' . date('m/d/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d/m/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d.m.Y',strtotime($_GET['date'])) . '")';
			}
		}
 

		if(!empty($_GET['msg']) && $_GET['msg']==1)
		{
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Deleted successfully..!.</div>");

        	redirect(base_url().'goods_details/listTransferGoods');
		}
		
		
		$data_cndtn=array('other_state'=> 0, 'origin_id' => $branch_id, 'is_transfer' => 1 );

		$config["base_url"] = base_url()."goods_details/listTransferGoods";
		$total_row = $this->admin_model->count_all_data_condition_ordersearch_goods_details('goods_details',$data_cndtn,'id','DESC',$searchqry, $searchqry_in);

		 
		
		$config["total_rows"] = $total_row;
		$config["per_page"] =200;
		$config['use_page_numbers'] = TRUE;
		$config["suffix"] ='?' . http_build_query($_GET, '', "&");
		$config['num_links'] = 10;
	 

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
		
		$this->data["result"] = $this->admin_model->get_all_data_condition_ordersearch_goods('goods_details' ,$data_cndtn,$config["per_page"], $page,'id','DESC',$searchqry, $searchqry_in);
 
		
 
		$this->data['branches'] = $branches;
		$this->data['current_branch_id'] = $branch_id;
		 

		$this->data["links"] = $this->pagination->create_links();

		$this->load->view('head/header',$this->data);
		$this->load->view('goods_details/transfer_goods');
		$this->load->view('head/footer');
		 

  }

function listTransferGoodsById() {
    $this->data['page_id'] = "list_transfer_goods";
    $this->data['page_title'] = "All Transfer Goods | cargoadmin";
    $config = array();
    $searchqry = array();
    $searchqry_in = '';
    $branches = $this->admin_model->get_all_active_branches();
    $data_cndtnx = array('status' => 0);

    if ($this->uri->segment(3)) {
        $transfer_id = $this->uri->segment(3);
    }
     
    $this->data['transfer_id'] = $transfer_id;
    $this->data['vehicles'] = $this->admin_model->get_all_data('vehicles', $data_cndtnx, 'id', 'DESC');
    $data_cndtnz = array();
    $this->data['trip_no_arr'] = $this->admin_model->get_all_trip_no('goods_details', $data_cndtnz, 'created_at', 'DESC');     
    $branch_id = $this->session->userdata['adminloginel']['id'];
    $data_cndtny = array('status' => 7, 'branch_id' => $branch_id);
    $this->data['trip_sheets'] = $this->admin_model->get_all_data('trip_sheet', $data_cndtny, 'id', 'DESC'); 

    if (isset($_GET['serachq']) && $_GET['serachq'] != null && $_GET['serachq'] != 'all') {
        if ($_GET['serachq'] == 'tracking_no') {
            if (isset($_GET['inptvalue']) && $_GET['inptvalue'] != '') {
                if (empty($searchqry)) {
                    $searchqry = 'tracking_no LIKE "%' . $_GET['inptvalue'] . '%"';
                } else {
                    $searchqry .= ' AND tracking_no LIKE "%' . $_GET['inptvalue'] . '%"';
                }
            }
        } else {
            $searchqry = $_GET['serachq'] . ' LIKE "%' . $_GET['inptvalue'] . '%"';
        }
    }

    if (isset($_GET['trip_no']) && $_GET['trip_no'] != null && $_GET['trip_no'] != '') {
        if (count($_GET['trip_no']) > 0) {
            $searchqry_in = $_GET['trip_no'];
        } else { 
            $searchqry_in = $_GET['trip_no'];
        }
    }

    if (isset($_GET['boxno']) && $_GET['boxno'] != null && $_GET['boxno'] != '') {
        if (empty($searchqry)) {
            $searchqry = 'boxno = "' . $_GET['boxno'] . '"';
        } else {
            $searchqry .= ' AND boxno = "' . $_GET['boxno'] . '"';
        }
    }

    if (isset($_GET['date']) && $_GET['date'] != null && $_GET['date'] != '') {
        if (empty($searchqry)) {
            $searchqry = ' (date = "' . date('Y-m-d', strtotime($_GET['date'])) . '" OR date= "' . date('d-m-Y', strtotime($_GET['date'])) . '" OR date = "' . date('m/d/Y', strtotime($_GET['date'])) . '" OR date = "' . date('d/m/Y', strtotime($_GET['date'])) . '" OR date = "' . date('d.m.Y', strtotime($_GET['date'])) . '")';
        } else {
            $searchqry .= ' AND (date = "' . date('Y-m-d', strtotime($_GET['date'])) . '" OR date= "' . date('d-m-Y', strtotime($_GET['date'])) . '" OR date = "' . date('m/d/Y', strtotime($_GET['date'])) . '" OR date = "' . date('d/m/Y', strtotime($_GET['date'])) . '" OR date = "' . date('d.m.Y', strtotime($_GET['date'])) . '")';
        }
    }

    $data_cndtn = array('transfer_id' => $transfer_id, 'transfer_status' => 'pending');
    $config["base_url"] = base_url() . "goods_details/listTransferGoodsById/" . $transfer_id;
    $total_row = $this->admin_model->count_all_data_condition_ordersearch('goods_details', $data_cndtn, 'id', 'DESC', $searchqry); 

    $config["total_rows"] = $total_row;
    $config["per_page"] = 200;
    $config['use_page_numbers'] = TRUE;
    $config["suffix"] = '?' . http_build_query($_GET, '', "&");
    $config['num_links'] = 10;

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

    if ($this->uri->segment(4)) {
        $page = $this->uri->segment(4);
    } else {
        $page = 1;
    }

    $this->data["result"] = $this->admin_model->get_all_data_condition_ordersearch('goods_details', $data_cndtn, $config["per_page"], $page, 'id', 'DESC', $searchqry);

    $this->data['branches'] = $branches;
    $this->data['current_branch_id'] = $branch_id;
    $this->data["links"] = $this->pagination->create_links();

    $this->load->view('head/header', $this->data);
    $this->load->view('goods_details/shipment_pending_lists');
    $this->load->view('head/footer');
}


//   function listTransferGoodsById() {

// 		$this->data['page_id']		="list_transfer_goods";
// 		$this->data['page_title']	="All Transfer Goods  | cargoadmin";
// 		$config 		= array();
// 		$searchqry 		= array();
// 		$searchqry_in 	= '';
// 		$branches 		= $this->admin_model->get_all_active_branches();
// 		$data_cndtnx 	= array('status' => 0);

// 		if($this->uri->segment(3)){
// 			$transfer_id = ($this->uri->segment(3)) ;
// 		}
		 
// 		$this->data['transfer_id']	= $transfer_id;

// 		$this->data['vehicles'] 	= $this->admin_model->get_all_data('vehicles', $data_cndtnx, 'id', 'DESC');
// 		$data_cndtnz				= array();
// 		$this->data['trip_no_arr'] 	= $this->admin_model->get_all_trip_no('goods_details', $data_cndtnz, 'created_at', 'DESC'); 	 
// 		$branch_id 					= $this->session->userdata['adminloginel']['id'];

// 		$data_cndtny = array('status' => 7, 'branch_id' => $branch_id);
// 		$this->data['trip_sheets'] = $this->admin_model->get_all_data('trip_sheet', $data_cndtny, 'id', 'DESC'); 


// 		if(isset($_GET['serachq']) && $_GET['serachq']!=null && $_GET['serachq']!='all'){
// 			if($_GET['serachq'] == 'transfer') {
// 				$searchqry  = 'is_transfer = 1';
// 			}else if($_GET['serachq'] == 'goods_status') {
				
// 				if(isset($_GET['inptvalue']) && $_GET['inptvalue']!=null && $_GET['inptvalue']!=''){ 

// 					if(empty($searchqry))
// 					{
// 						$searchqry= ' (goods_status = "' .  $_GET['inptvalue'] .'")';
// 					} 
// 					else{
// 						$searchqry .= ' AND  (goods_status = "' .  $_GET['inptvalue'] .'")';
// 					}
// 				} else if($_GET['inptvalue']=='') {
					
// 						if(empty($searchqry))
// 						{
// 							$searchqry= ' (goods_status = " ")';
// 						} 
// 						else{
// 							$searchqry .= ' AND  (goods_status = " ")';
// 						}
// 				}

// 			}else {
// 				$searchqry= $_GET['serachq'].' LIKE "%' . $_GET['inptvalue'] . '%"';

// 			}
// 		}


// 		if(isset($_GET['trip_no']) && $_GET['trip_no']!=null && $_GET['trip_no']!=''){
// 			if( count($_GET['trip_no'] ) > 0 ){
// 				$searchqry_in =  $_GET['trip_no'];
// 			} else { 
// 				$searchqry_in =   $_GET['trip_no'];
// 			}
			
// 		} 

// 		if(isset($_GET['tracking_no']) && $_GET['tracking_no']!=null && $_GET['tracking_no']!=''){
// 			if(empty($searchqry))
// 			{
// 				$searchqry= ' (tracking_no = "' .  $_GET['tracking_no'] .'")';
// 			} 
// 			else{
// 				$searchqry .= ' AND  (tracking_no = "' .  $_GET['tracking_no'] .'")';
// 			}
// 		}

// 		if(isset($_GET['boxno']) && $_GET['boxno']!=null && $_GET['boxno']!=''){
// 			if(empty($searchqry))
// 			{
// 				$searchqry= ' (boxno = "' .  $_GET['boxno'] .'")';
// 			} 
// 			else{
// 				$searchqry .= ' AND  (boxno = "' .  $_GET['boxno'] .'")';
// 			}
// 		}

		
		

// 		if(isset($_GET['date']) && $_GET['date']!=null && $_GET['date']!=''){
// 			if(empty($searchqry))
// 			{
// 				$searchqry= ' (date = "' . date('Y-m-d',strtotime($_GET['date'])) . '" OR date= "' . date('d-m-Y',strtotime($_GET['date'])) . '" OR date = "' . date('m/d/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d/m/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d.m.Y',strtotime($_GET['date'])) . '")';
// 			}else{
// 				$searchqry .= ' AND (date = "' . date('Y-m-d',strtotime($_GET['date'])) . '" OR date= "' . date('d-m-Y',strtotime($_GET['date'])) . '" OR date = "' . date('m/d/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d/m/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d.m.Y',strtotime($_GET['date'])) . '")';
// 			}
// 		}

 
		
		
// 		$data_cndtn=array('transfer_id' =>$transfer_id , 'transfer_status' => 'pending');

// 		$config["base_url"] = base_url()."goods_details/listTransferGoodsById/".$transfer_id;
// 		$total_row = $this->admin_model->count_all_data_condition_ordersearch('goods_details',$data_cndtn,'id','DESC',$searchqry); 
		
		
// 		$config["total_rows"] = $total_row;
// 		$config["per_page"] =200;
// 		$config['use_page_numbers'] = TRUE;
// 		$config["suffix"] ='?' . http_build_query($_GET, '', "&");
// 		$config['num_links'] = 10;
// 		// $config['cur_tag_open'] = '&nbsp;<a style="color: #fff;cursor: default;background-color: #337ab7;border-color: #337ab7;border-radius: 3px;">';
// 		// $config['cur_tag_close'] = '</a>';
// 		// $config['next_link'] = '<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>';
// 		// $config['prev_link'] = '<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>';



			
// 		$config['full_tag_open'] = '<ul class="pagination">';        
// 		$config['full_tag_close'] = '</ul>';        
// 		$config['first_link'] = 'First';        
// 		$config['last_link'] = 'Last';        
// 		$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';        
// 		$config['first_tag_close'] = '</span></li>';        
// 		$config['prev_link'] = '&laquo';        
// 		$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';        
// 		$config['prev_tag_close'] = '</span></li>';        
// 		$config['next_link'] = '&raquo';        
// 		$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';        
// 		$config['next_tag_close'] = '</span></li>';        
// 		$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';        
// 		$config['last_tag_close'] = '</span></li>';        
// 		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';        
// 		$config['cur_tag_close'] = '</a></li>';        
// 		$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';        
// 		$config['num_tag_close'] = '</span></li>';


// 		$this->pagination->initialize($config);

// 		if($this->uri->segment(4)){
// 			$page = ($this->uri->segment(4)) ;
// 		}
// 		else{
// 			$page = 1;
// 		}
		
// 		$this->data["result"] = $this->admin_model->get_all_data_condition_ordersearch('goods_details' ,$data_cndtn,$config["per_page"], $page,'id','DESC',$searchqry );

  
// 		// echo $this->db->last_query();
// 		// die;

// 		$this->data['branches'] = $branches;
// 		$this->data['current_branch_id'] = $branch_id;
// 		// $str_links = $this->pagination->create_links();
// 		// $this->data["links"] = explode('&nbsp',$str_links );

// 		$this->data["links"] = $this->pagination->create_links();

// 		$this->load->view('head/header',$this->data);
// 		$this->load->view('goods_details/shipment_pending_lists');

// 		// $this->load->view('goods_details/transfer_goods');
// 		$this->load->view('head/footer');
		

//   }



  function confirm_back_to_goods(){

	$branch_id 			= $this->session->userdata['adminloginel']['id'];	
	$transfer_id 		= $this->input->post('transfer_id');	
	$data_cndtnx 		= array('id' => $transfer_id );
	$transfer_details	= $this->admin_model->get_all_data('goods_transfer_list', $data_cndtnx, 'id', 'DESC'); 
	$transferred_from 	= $transfer_details[0]->transferred_from;
 
	  if( $this->input->post('transfer_id') !='') {	

			$condition = 'transfer_id ='.$transfer_id;
			$shipment_details_arr	= $this->admin_model->getSelectedData("goods_details",'id, invoiceno, tracking_no, shipment_status_id', $condition );   
			 

			foreach( $shipment_details_arr as $val ){
				//DELETE THE ENTRIES IN SHIPMENT STATUS TABLE 
				$this->admin_model->delete_table_account('shipment_status', $val->shipment_status_id, 'id');

				//FETCH THE PREVIOUS SHIPMENT STATUS AND ASSIGN TO THE PREVIOUS STATUS
				$data_cndtnx = array( 
							'tracking_no' => $val->tracking_no,
							'invoice_number' => $val->invoiceno
							);

				$shipment_status 				= $this->admin_model->get_all_data('shipment_status', $data_cndtnx, 'id', 'DESC');
				$previous_shipment_status_id 	= $shipment_status[0]->id;

				$datax = array(
					'branch_id'         	=> $transferred_from ,								
					'transferred_from'     	=> NULL,
					'transferred_to'		=> NULL,
					'is_transfer'			=> 0,
					'transfer_status'		=> NULL,
					'current_transfer_id'	=> NULL,
					'transfer_id'			=> NULL,
					'shipment_status_id'	=> $previous_shipment_status_id
				);	 

				//update goods detials table
				$this->crud_model->edit_table_account('goods_details', $datax , $val->id , 'id');
				// $this->crud_model->edit_table_account('shipment_details', $datax , $val->id , 'id');
			} 

				//DELETE THE ENTRIES IN GOODS TRANSFER DETAILS 
				$this->admin_model->delete_table_account('goods_transfer_details', $transfer_id, 'transfer_id'); 

				//DELETE THE ENTRIES IN GOODS TRANSFER LIST
				$this->admin_model->delete_table_account('goods_transfer_list', $transfer_id, 'id');
			 
			$this->session->set_flashdata('msgx',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Move Back To Goods successfully.</div>"); 
			redirect(base_url().'goods_details/listTransferGoodsById/'.$transfer_id);

	} else {
			$this->session->set_flashdata('msgx',"<div class='alert alert-error' style='color:red;'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> No Goods Selected.</div>"); 
			redirect(base_url().'goods_details/listTransferGoodsById/'.$transfer_id);
	}


  }
  function goodsNotInTripsheet() {
	 

	$this->data['page_id']="goods_not_in_tripsheet";
		$this->data['page_title']="Goods Not in Tripsheet  | cargoadmin";
		$config = array();
		$searchqry = array();
		$searchqry_in = '';

		$branches = $this->admin_model->get_all_active_branches(); 

		$data_cndtnx = array('status' => 0);
		$this->data['vehicles'] = $this->admin_model->get_all_data('vehicles', $data_cndtnx, 'id', 'DESC');

		$data_cndtnz = array();
		$this->data['trip_no_arr'] = $this->admin_model->get_all_trip_no('goods_details', $data_cndtnz, 'created_at', 'DESC'); 
	 
		$branch_id = $this->session->userdata['adminloginel']['id'];
	
		$data_cndtny = array('status' => 7, 'branch_id' => $branch_id);
		$this->data['trip_sheets'] = $this->admin_model->get_all_data('trip_sheet', $data_cndtny, 'id', 'DESC'); 
 
 
		if(isset($_GET['serachq']) && $_GET['serachq']!=null && $_GET['serachq']!='all'){
			if($_GET['serachq'] == 'transfer') {
				$searchqry  = 'is_transfer = 1';
			}else if($_GET['serachq'] == 'goods_status') {
				 
				if(isset($_GET['inptvalue']) && $_GET['inptvalue']!=null && $_GET['inptvalue']!=''){ 

					if(empty($searchqry))
					{
						$searchqry= ' (goods_status = "' .  $_GET['inptvalue'] .'")';
					} 
					else{
						$searchqry .= ' AND  (goods_status = "' .  $_GET['inptvalue'] .'")';
					}
				} else if($_GET['inptvalue']=='') {
					
						if(empty($searchqry))
						{
							$searchqry= ' (goods_status = " ")';
						} 
						else{
							$searchqry .= ' AND  (goods_status = " ")';
						}
				}

			}else {
				$searchqry= $_GET['serachq'].' LIKE "%' . $_GET['inptvalue'] . '%"';

			}
		}

	

		if(isset($_GET['trip_no']) && $_GET['trip_no']!=null && $_GET['trip_no']!=''){
			 if( count($_GET['trip_no'] ) > 0 ){
				$searchqry_in =  $_GET['trip_no'];
			 } else { 
				$searchqry_in =   $_GET['trip_no'];
			 }
			 
		} 

		if(isset($_GET['tracking_no']) && $_GET['tracking_no']!=null && $_GET['tracking_no']!=''){
			if(empty($searchqry))
			{
				$searchqry= ' (tracking_no = "' .  $_GET['tracking_no'] .'")';
			} 
			else{
				$searchqry .= ' AND  (tracking_no = "' .  $_GET['tracking_no'] .'")';
			}
		}

		if(isset($_GET['boxno']) && $_GET['boxno']!=null && $_GET['boxno']!=''){
			if(empty($searchqry))
			{
				$searchqry= ' (boxno = "' .  $_GET['boxno'] .'")';
			} 
			else{
				$searchqry .= ' AND  (boxno = "' .  $_GET['boxno'] .'")';
			}
		}

		
		 
		if(isset($_GET['date']) && $_GET['date']!=null && $_GET['date']!=''){
			if(empty($searchqry))
			{
				$searchqry= ' (date = "' . date('Y-m-d',strtotime($_GET['date'])) . '" OR date= "' . date('d-m-Y',strtotime($_GET['date'])) . '" OR date = "' . date('m/d/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d/m/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d.m.Y',strtotime($_GET['date'])) . '")';
			}else{
				$searchqry .= ' AND (date = "' . date('Y-m-d',strtotime($_GET['date'])) . '" OR date= "' . date('d-m-Y',strtotime($_GET['date'])) . '" OR date = "' . date('m/d/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d/m/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d.m.Y',strtotime($_GET['date'])) . '")';
			}
		}
 

		if(!empty($_GET['msg']) && $_GET['msg']==1)
		{
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Deleted successfully..!.</div>");

        	redirect(base_url().'goods_details/goodsNotInTripsheet');
		}
				
		$data_cndtn=array('other_state'=> 0, 'branch_id' => $branch_id);
		// $data_cndtn=array(  'branch_id' => $branch_id);

		$config["base_url"] = base_url()."goods_details/goodsNotInTripsheet";
 
		$total_row = $this->admin_model->count_all_data_goods_notin_tripsheet('goods_details',$data_cndtn,'id','DESC',$searchqry, $searchqry_in);

 

		$config["total_rows"] = $total_row;
		$config["per_page"] =200;
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
		
		$this->data["result"] = $this->admin_model->get_all_data_goods_notin_tripsheet('goods_details' ,$data_cndtn,$config["per_page"], $page,'id','DESC',$searchqry, $searchqry_in);
		
		
		if(isset($_GET['export_goods_not_in_tripsheet']))
		{ 
			$this->generate_excel($this->data["result"],['slno','transfer_status','company','shipmentname', 'agencyname',  'origin','boxno','tracking_no','trip_no', 'invoiceno','pcs','weight','rewight','received_pcs','sender_address','reciever_address', 'phone', 'state', 'district', 'pincode','goods_desc','recieved_at_hub', 'connecting_date', 'recieved_at_branch', 'vendor', 'contact_no', 'docket', 'goods_status', 'remarks', 'sendingdate', 'recievingdate'],'goods__not_in_tripsheet');
		}
		
 
		
		$this->data['branches'] = $branches;
		$this->data['current_branch_id'] = $branch_id;
		// $str_links = $this->pagination->create_links();
		// $this->data["links"] = explode('&nbsp',$str_links );

		$this->data["links"] = $this->pagination->create_links();
		$this->load->view('head/header',$this->data);
		$this->load->view('goods_details/goods_not_in_tripsheet');
		$this->load->view('head/footer');
	  

}

function goodsInTripsheet() {	 

	$this->data['page_id']="goods_in_tripsheet";
		$this->data['page_title']="Goods In Tripsheet  | cargoadmin";
		$config = array();
		$searchqry = array();
		$searchqry_in = '';

		$branches = $this->admin_model->get_all_active_branches(); 

		$data_cndtnx = array('status' => 0);
		$this->data['vehicles'] = $this->admin_model->get_all_data('vehicles', $data_cndtnx, 'id', 'DESC');

		$data_cndtnz = array(); 
		$this->data['trip_no_arr'] = $this->admin_model->get_all_trip_no('goods_details', $data_cndtnz, 'created_at', 'DESC'); 

	 
		$branch_id = $this->session->userdata['adminloginel']['id'];
	
		$data_cndtny = array('status' => 7, 'branch_id' => $branch_id);
		$this->data['trip_sheets'] = $this->admin_model->get_all_data('trip_sheet', $data_cndtny, 'id', 'DESC'); 
 
 
		if(isset($_GET['serachq']) && $_GET['serachq']!=null && $_GET['serachq']!='all'){
			if($_GET['serachq'] == 'transfer') {
				$searchqry  = 'is_transfer = 1';
			}else if($_GET['serachq'] == 'goods_status') {
				 
				if(isset($_GET['inptvalue']) && $_GET['inptvalue']!=null && $_GET['inptvalue']!=''){ 

					if(empty($searchqry))
					{
						$searchqry= ' (goods_status = "' .  $_GET['inptvalue'] .'")';
					} 
					else{
						$searchqry .= ' AND  (goods_status = "' .  $_GET['inptvalue'] .'")';
					}
				} else if($_GET['inptvalue']=='') {
					
						if(empty($searchqry))
						{
							$searchqry= ' (goods_status = " ")';
						} 
						else{
							$searchqry .= ' AND  (goods_status = " ")';
						}
				}

			}else {
				$searchqry= $_GET['serachq'].' LIKE "%' . $_GET['inptvalue'] . '%"';

			}
		}

	

		if(isset($_GET['trip_no']) && $_GET['trip_no']!=null && $_GET['trip_no']!=''){
			 if( count($_GET['trip_no'] ) > 0 ){
				$searchqry_in =  $_GET['trip_no'];
			 } else { 
				$searchqry_in =   $_GET['trip_no'];
			 }
			 
		} 

		if(isset($_GET['tracking_no']) && $_GET['tracking_no']!=null && $_GET['tracking_no']!=''){
			if(empty($searchqry))
			{
				$searchqry= ' (tracking_no = "' .  $_GET['tracking_no'] .'")';
			} 
			else{
				$searchqry .= ' AND  (tracking_no = "' .  $_GET['tracking_no'] .'")';
			}
		}

		if(isset($_GET['boxno']) && $_GET['boxno']!=null && $_GET['boxno']!=''){
			if(empty($searchqry))
			{
				$searchqry= ' (boxno = "' .  $_GET['boxno'] .'")';
			} 
			else{
				$searchqry .= ' AND  (boxno = "' .  $_GET['boxno'] .'")';
			}
		}

		
		if(isset($_GET['date']) && $_GET['date']!=null && $_GET['date']!=''){
			if(empty($searchqry))
			{
				$searchqry= ' (date = "' . date('Y-m-d',strtotime($_GET['date'])) . '" OR date= "' . date('d-m-Y',strtotime($_GET['date'])) . '" OR date = "' . date('m/d/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d/m/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d.m.Y',strtotime($_GET['date'])) . '")';
			}else{
				$searchqry .= ' AND (date = "' . date('Y-m-d',strtotime($_GET['date'])) . '" OR date= "' . date('d-m-Y',strtotime($_GET['date'])) . '" OR date = "' . date('m/d/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d/m/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d.m.Y',strtotime($_GET['date'])) . '")';
			}
		}
 

		if(!empty($_GET['msg']) && $_GET['msg']==1)
		{
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Deleted successfully..!.</div>");

        	redirect(base_url().'goods_details/goodsInTripsheet');
		}
				
		$data_cndtn=array('other_state'=> 0, 'branch_id' => $branch_id);

		$config["base_url"] = base_url()."goods_details/goodsInTripsheet";
 
		$total_row = $this->admin_model->count_all_data_goods_in_tripsheet('goods_details',$data_cndtn,'id','DESC',$searchqry, $searchqry_in);

 

		$config["total_rows"] = $total_row;
		$config["per_page"] =200;
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
		
		$this->data["result"] = $this->admin_model->get_all_data_goods_in_tripsheet('goods_details' ,$data_cndtn,$config["per_page"], $page,'id','DESC',$searchqry, $searchqry_in);
		// echo $this->db->last_query();
		// die;
		if(isset($_GET['export_goods_in_tripsheet']))
		{ 
			$this->generate_excel($this->data["result"],['slno','transfer_status','company','shipmentname', 'origin','boxno','tracking_no','trip_no', 'invoiceno','pcs','weight','rewight','received_pcs','sender_address','reciever_address', 'phone', 'state', 'district', 'pincode','goods_desc','recieved_at_hub', 'connecting_date', 'recieved_at_branch', 'vendor', 'contact_no', 'docket', 'goods_status', 'remarks', 'sendingdate', 'recievingdate'],'goods_in_tripsheet');
		}
 
		
		$this->data['branches'] = $branches;
		$this->data['current_branch_id'] = $branch_id;
		// $str_links = $this->pagination->create_links();
		// $this->data["links"] = explode('&nbsp',$str_links );

		$this->data["links"] = $this->pagination->create_links();
		$this->load->view('head/header',$this->data);
		$this->load->view('goods_details/goods_in_tripsheet');
		$this->load->view('head/footer');
	  

}


public function printall_goodsInTripsheet(){ 

			$this->data['page_id']="goods_in_tripsheet";
			$this->data['page_title']="Print";
			$data_cndtnx=array();
			$new_check_box = array();
			$branch_id = $this->session->userdata['adminloginel']['id'];
 
			$data_cndtn=array('other_state'=> 0, 'branch_id' => $branch_id);
			$details = $this->admin_model->get_all_data_for_print_goods_in_tripsheet('goods_details' ,$data_cndtn, 'id','DESC' ); 

		 	if($details==false){
				$this->session->set_flashdata('ermsg',"<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        		redirect(base_url().'goods_details/goodsInTripsheet');
			}
			else{
				$this->data['result']=$details;
				$this->load->view('head/header',$this->data);
				$this->load->view('goods_details/print');
				$this->load->view('head/footer');
			}
	 
}

public function goodsNotImported(){ 

	$this->data['page_id']="goods_not_imported";
	$this->data['page_title']="Print";
	$data_cndtnx=array();
	$new_check_box = array();
	$branch_id = $this->session->userdata['adminloginel']['id'];

	$data_cndtn=array('other_state'=> 0, 'branch_id' => $branch_id);
	$details = $this->admin_model->get_all_data_for_print_goods_in_tripsheet('goods_details' ,$data_cndtn, 'id','DESC' ); 

 

	if($details==false){
		$this->session->set_flashdata('ermsg',"<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
		redirect(base_url().'goods_details/goodsInTripsheet');
	}
	else{
		$this->data['result']=$details;
		$this->load->view('head/header',$this->data);
		$this->load->view('goods_details/print');
		$this->load->view('head/footer');
	}

}


/** bulK update database */

public function update_received_date(){ 
	$data_cndtnx = array();
	$data['goods'] = $this->admin_model->get_all_data('goods_details', $data_cndtnx, 'id', 'DESC');
	foreach ($data['goods'] as $goods ) {  
		$new_fmr = date('d-m-Y', strtotime(  $goods->recieved_at_hub)); 
		$datax = array('received_date' =>   $new_fmr );   
		$lstid=$this->crud_model->edit_table_account('goods_details',$datax,$goods->invoiceno,'invoiceno');   
	}
	die("done"); 
}


/** bulK update database */
	public function update_transfer_received_date(){
 	$cnt = 0;
		$data_cndtnx = array('is_transfer' => 1);
		$data['goods'] = $this->admin_model->get_all_data('goods_details', $data_cndtnx, 'id', 'DESC');
		foreach ($data['goods'] as $goods ) {
		
				$data_cndtnx = array('transfer_status' => 'confirmed','goods_id' =>  $goods->id); 
			    $data['goods_tr'] = $this->admin_model->get_all_data('goods_transfer_details', $data_cndtnx, 'id', 'DESC');
				if( !empty( $data['goods_tr']) ){
					$cnt = $cnt +1;
					$old_date = $data['goods_tr'][0]->goods_received_date;
					$new_fmr = date('d-m-Y', strtotime( $data['goods_tr'][0]->goods_received_date )); 
					$datax1 = array('received_date' =>   $new_fmr ); 
					$lstid=$this->crud_model->edit_table_account('goods_details',$datax1, $goods->id,'id');  
				}
		}
		echo $cnt;
		die("done");
		}



	/** bulK update database */
/*
	public function get_goods(){
		$cnt = 0;
		$cnt1 = 0;
		
		   $data_cndtnx = array('trip_no' => 'BESTINDSEA08');
		   $data['goods'] = $this->admin_model->get_all_data('goods_details_new', $data_cndtnx, 'id', 'DESC');

		//    echo count( $data['goods'] ); die;
		   foreach ($data['goods'] as $goods ) {
		   
				   $data_cndtnx = array('id' =>  $goods->id); 
				 
				   $data['goods_tr'] = $this->admin_model->get_all_data('goods_details', $data_cndtnx, 'id', 'DESC');
				 if( !empty( $data['goods_tr'])) {
				   if( count( $data['goods_tr']) > 0 ){
					$cnt = $cnt +1;
					//    echo  $data['goods_tr'][0]->id."<br>";
				   }
				} else {
					echo $goods->id.", ";
					$cnt1 = $cnt1 +1;
					// echo "else";
				   }
		   }
		   echo  "cnt:".$cnt;
		   echo "cnt1  : ".$cnt1;
		   die("done");
		   }

	*/	   


	public function  get_missing_data(){
	
		$cnt = 0;
		$cnt1 = 0;
		   $data_cndtnx = array( );
		   $data['goods_actual'] = $this->admin_model->get_all_data('goods_details_actual', $data_cndtnx, 'id', 'DESC');
		//    echo count( $data['goods_actual'] );
		//    die;
		   foreach ($data['goods_actual'] as $goods ) {
		   
				   $data_cndtnx = array('invoiceno' =>$goods->invoiceno,'tracking_no' =>  $goods->tracking_no); 
				   $data['goods_tr'] = $this->admin_model->get_all_data('goods_details', $data_cndtnx, 'id', 'DESC');
				   if( !empty( $data['goods_tr']) ){
					   $cnt = $cnt +1;					   
				   } else {
					$cnt1 = $cnt1 +1;	
					echo $goods->id.", ";
				   }
		   }
		   echo "<br>";
		   echo $cnt;
		   echo "<br>";

		   echo $cnt1;
		   die("done");
	}


	public function confirm_back_to_shipment() {

		if( $this->input->post('sel_goods_id_to_shipment') !='') {			 
			$selGoodsIds = explode(',',$this->security->xss_clean($this->input->post('sel_goods_id_to_shipment')));		 
				foreach($selGoodsIds as $goodsId) { 				
							
					$condition 				= array('id' => $goodsId );
					$goods_array 			= $this->admin_model->getSelectedData('goods_details', 'shipment_details_id', $condition);
					$shipment_details_id  	= $goods_array[0]->shipment_details_id;
					 
					$this->admin_model->delete_table_account('goods_details', $goodsId, 'id');

					$datax = array( 
									'transfer_date' => NULL,
									'move_to_goods' => 0
								);				 		
					$this->admin_model->edit_table_account('shipment_details', $datax, $shipment_details_id, 'id');

					 
				}
				$this->session->set_flashdata('msgx',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> Transferred Back to Shipment successfully.</div>"); 
				redirect(base_url().'goods_details/');

		} else {
				$this->session->set_flashdata('msgx',"<div class='alert alert-error' style='color:red;'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> No Goods Selected.</div>"); 
				redirect(base_url().'goods_details/');
		}


	}

	public function shipmentPendingList() {

		$this->data['page_id']		="shipment_pending_list";
		$this->data['page_title']	="Shipment Pending List | cargoadmin";

		$sort_column 	= "sort_order";
		$sort_order 	= "DESC"; 
		$branch_id 		= $this->session->userdata['adminloginel']['id'];
		$data_cndtnx 	= array( 'transferred_to' => $branch_id );
		$this->data['goods_transfer_list'] = $this->admin_model->get_all_data('goods_transfer_list', $data_cndtnx, 'id', 'DESC');	
 
		$temp = $this->admin_model->get_count_goods_transfer_id('goods_transfer_list', $branch_id, 'id', 'DESC');
		if(!empty($temp)) {
			foreach( $temp as $val){
				$cnt_arr[$val->transfer_id] = $val->goods_count;
			}
			$this->data['goods_transfer_list_cnt'] = $cnt_arr;
		} else {
			$this->data['goods_transfer_list_cnt'] = [];
		}

		

		
		 
		 
			$this->load->view('head/header',$this->data);
			$this->load->view('shipments/shipment_pending_list');
			$this->load->view('head/footer');

	}


	function notDelivered() {

		$this->data['page_id']		="";
		$this->data['page_title']	="All Goods Not Delivered  | cargoadmin";
		$config 		= array();
		$searchqry 		= array();
		$searchqry_in 	= '';
		$branches 		= $this->admin_model->get_all_active_branches();
		$data_cndtnx 	= array('status' => 0);

		 
		$this->data['vehicles'] 	= $this->admin_model->get_all_data('vehicles', $data_cndtnx, 'id', 'DESC');
		$data_cndtnz				= array();
		$this->data['trip_no_arr'] 	= $this->admin_model->get_all_trip_no('goods_details', $data_cndtnz, 'created_at', 'DESC'); 	 
		$branch_id 					= $this->session->userdata['adminloginel']['id'];
		$data_cndtny = array('status' => 7, 'branch_id' => $branch_id);
		$this->data['trip_sheets'] = $this->admin_model->get_all_data('trip_sheet', $data_cndtny, 'id', 'DESC'); 

		if(isset($_GET['serachq']) && $_GET['serachq']!=null && $_GET['serachq']!='all'){
			if($_GET['serachq'] == 'transfer') {
				$searchqry  = 'is_transfer = 1';
			}else if($_GET['serachq'] == 'goods_status') {				
				if(isset($_GET['inptvalue']) && $_GET['inptvalue']!=null && $_GET['inptvalue']!=''){ 
					if(empty($searchqry))					{
						$searchqry= ' (goods_status = "' .  $_GET['inptvalue'] .'")';
					} else {
						$searchqry .= ' AND  (goods_status = "' .  $_GET['inptvalue'] .'")';
					}
				} else if($_GET['inptvalue']=='') {					
					if(empty($searchqry)) {
						$searchqry= ' (goods_status = " ")';
					} else {
						$searchqry .= ' AND  (goods_status = " ")';
					}
				}
			} else {
				$searchqry= $_GET['serachq'].' LIKE "%' . $_GET['inptvalue'] . '%"';
			}
		}

		if(isset($_GET['trip_no']) && $_GET['trip_no']!=null && $_GET['trip_no']!=''){
			if( count($_GET['trip_no'] ) > 0 ){
				$searchqry_in =  $_GET['trip_no'];
			} else { 
				$searchqry_in =   $_GET['trip_no'];
			}			
		} 
		if(isset($_GET['tracking_no']) && $_GET['tracking_no']!=null && $_GET['tracking_no']!=''){
			if(empty($searchqry))
			{
				$searchqry= ' (tracking_no = "' .  $_GET['tracking_no'] .'")';
			} 
			else{
				$searchqry .= ' AND  (tracking_no = "' .  $_GET['tracking_no'] .'")';
			}
		}
		if(isset($_GET['boxno']) && $_GET['boxno']!=null && $_GET['boxno']!=''){
			if(empty($searchqry)) {
				$searchqry= ' (boxno = "' .  $_GET['boxno'] .'")';
			} else{
				$searchqry .= ' AND  (boxno = "' .  $_GET['boxno'] .'")';
			}
		}
		if(isset($_GET['date']) && $_GET['date']!=null && $_GET['date']!=''){
			if(empty($searchqry)) {
				$searchqry= ' (date = "' . date('Y-m-d',strtotime($_GET['date'])) . '" OR date= "' . date('d-m-Y',strtotime($_GET['date'])) . '" OR date = "' . date('m/d/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d/m/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d.m.Y',strtotime($_GET['date'])) . '")';
			} else {
				$searchqry .= ' AND (date = "' . date('Y-m-d',strtotime($_GET['date'])) . '" OR date= "' . date('d-m-Y',strtotime($_GET['date'])) . '" OR date = "' . date('m/d/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d/m/Y',strtotime($_GET['date'])) . '" OR date = "' . date('d.m.Y',strtotime($_GET['date'])) . '")';
			}
		}
 
		$data_cndtnx = array('trip_sheet_cargos.status' => 5); 
		$config["base_url"] = base_url()."goods_details/notDelivered/";
		$res =  $this->admin_model->get_all_not_delivered_goods('trip_sheet_cargos',$data_cndtnx, $branch_id, 'trip_sheet_cargos.branch_id', NULL, NULL);
		 
		$total_row  = count($res);
		$config["total_rows"] = $total_row;
		$config["per_page"] =200;
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
		} else {
			$page = 1;
		}		
		$this->data["result"] =  $this->admin_model->get_all_not_delivered_goods('trip_sheet_cargos',$data_cndtnx, $branch_id, 'trip_sheet_cargos.branch_id', $config["per_page"], $page); 

		 	
		$this->data['branches'] = $branches;
		$this->data['current_branch_id'] = $branch_id;
		// $str_links = $this->pagination->create_links();
		// $this->data["links"] = explode('&nbsp',$str_links );

		$this->data["links"] = $this->pagination->create_links();
		$this->load->view('head/header',$this->data);
		$this->load->view('goods_details/goods_not_delivered');
		$this->load->view('head/footer');
  	}


function set_barcode($code)
{
   $this->load->library('zend');
   $this->zend->load('Zend/Barcode');
//    $file = Zend_Barcode::draw('code128', 'image', array('text' => $code), array());
   $barcode = Zend_Barcode::factory('code128', 'image', array('text' => $code, 'barHeight'=>30, 'factor'=>2), array('imageType' => 'png'));

//    $code = time().$code;
//    $store_image = imagepng($file,"../barcode/{$code}.png");
   die("Sasa");
   return $code.'.png';




    // Set up and execute the curl process
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, 'http://localhost/site/index.php/example_api');
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_handle, CURLOPT_POST, 1);
    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, array(
        'name' => 'name',
        'email' => 'example@example.com'
    ));

    // Optional, delete this line if your API is open
    curl_setopt($curl_handle, CURLOPT_USERPWD, $username . ':' . $password);

    $buffer = curl_exec($curl_handle);
    curl_close($curl_handle);

    $result = json_decode($buffer);

    if(isset($result->status) && $result->status == 'success')
    {
        echo 'Record inserted successfully...';
    }

    else
    {
        echo 'Something has gone wrong';
    }
}



function mark_ready() {
		 
	$id  =  $this->security->xss_clean($this->input->post('id'));	
	$val  =  $this->security->xss_clean($this->input->post('val'));	 

  		$datay = array('mark_as_ready' => $val); 
		$this->crud_model->edit_table_account('goods_details', $datay,  $id, 'id');	 
 
	 echo "Success";

}

		   
}//end Class  //19914