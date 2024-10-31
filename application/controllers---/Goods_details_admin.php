<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Goods_details_admin extends CI_Controller {


	public $data=array();
	function __construct() { 
		parent::__construct();
		// admin_session_check();
		super_admin_session_check();
		$this->data['page_id']="goods_details_admin";
		$this->data['page_title']="goods_details_admin";
		$this->load->library('pagination');
		date_default_timezone_set('Asia/Kolkata');
		$this->load->helper('string');
		$this->load->helper('text');
	}
	public function index()
	{ 
		$this->data['page_id']="goods_details_admin";
		$this->data['page_title']="All goods details  | cargoadmin";
		$config = array();
		$searchqry = array();

		$data_cndtnz=array('type' => 'branch', 'status' => 0);
		$this->data['branches_arr'] = $this->admin_model->get_all_data('branches',$data_cndtnz,'id','DESC');  

		$branches = $this->admin_model->get_all_active_branches(); 

		$data_cndtnx = array('status' => 0);
		$this->data['vehicles'] = $this->admin_model->get_all_data('vehicles', $data_cndtnx, 'id', 'DESC');

		$data_cndtnz = array();
		// $this->data['trip_no_arr']  
		$this->data['trip_no_arr'] = $this->admin_model->get_all_trip_no('goods_details', $data_cndtnz, 'trip_no', 'ASC');  
	 
		$branch_id = $this->session->userdata['adminloginel']['id'];

		//transfer_status == null or transfer_status = confirmed  -- added condition in model
		// $data_cndtn=array('other_state'=> 0, 'branch_id' => $branch_id);
		$data_cndtn=array();

		// $data_cndtny = array('status' => 7, 'branch_id' => $branch_id);
		$data_cndtny = array('status' => 7);
		$this->data['trip_sheets'] = $this->admin_model->get_all_data('trip_sheet', $data_cndtny, 'id', 'DESC'); 
 
 
		if(isset($_GET['serachq']) && $_GET['serachq']!=null && $_GET['serachq']!='all'){
			if($_GET['serachq'] == 'transfer') {
				$searchqry  = 'goods_details.is_transfer = 1';
			}else if($_GET['serachq'] == 'goods_status') {
				 
				if(isset($_GET['inptvalue']) && $_GET['inptvalue']!=null && $_GET['inptvalue']!=''){ 

					if(empty($searchqry))
					{
						$searchqry= ' (goods_details.goods_status = "' .  $_GET['inptvalue'] .'")';
					} 
					else{
						$searchqry .= ' AND  (goods_details.goods_status = "' .  $_GET['inptvalue'] .'")';
					}
				} else if($_GET['inptvalue']=='') {
					
						if(empty($searchqry))
						{
							$searchqry= ' (goods_details.goods_status = " ")';
						} 
						else{
							$searchqry .= ' AND  (goods_details.goods_status = " ")';
						}
				}

			}else {
				$searchqry= $_GET['serachq'].' LIKE "%' . $_GET['inptvalue'] . '%"';

			}
		}

		if (isset($_GET['branch_id']) && $_GET['branch_id'] != null && $_GET['branch_id'] != 'all') {
            $data_cndtn['goods_details.branch_id'] = $_GET['branch_id'];
        }
	
		$searchqry_in = null;

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
				$searchqry= ' (goods_details.tracking_no = "' .  $_GET['tracking_no'] .'")';
			} 
			else{
				$searchqry .= ' AND  (goods_details.tracking_no = "' .  $_GET['tracking_no'] .'")';
			}
		}

		if(isset($_GET['boxno']) && $_GET['boxno']!=null && $_GET['boxno']!=''){
			if(empty($searchqry))
			{
				$searchqry= ' (goods_details.boxno = "' .  $_GET['boxno'] .'")';
			} 
			else{
				$searchqry .= ' AND  (goods_details.boxno = "' .  $_GET['boxno'] .'")';
			}
		}

		
		
		//    die( $searchqry );
 
		if(isset($_GET['date']) && $_GET['date']!=null && $_GET['date']!=''){
			if(empty($searchqry))
			{
				$searchqry= ' (goods_details.date = "' . date('Y-m-d',strtotime($_GET['date'])) . '" OR goods_details.date= "' . date('d-m-Y',strtotime($_GET['date'])) . '" OR goods_details.date = "' . date('m/d/Y',strtotime($_GET['date'])) . '" OR goods_details.date = "' . date('d/m/Y',strtotime($_GET['date'])) . '" OR goods_details.date = "' . date('d.m.Y',strtotime($_GET['date'])) . '")';
			}else{
				$searchqry .= ' AND (goods_details.date = "' . date('Y-m-d',strtotime($_GET['date'])) . '" OR goods_details.date= "' . date('d-m-Y',strtotime($_GET['date'])) . '" OR goods_details.date = "' . date('m/d/Y',strtotime($_GET['date'])) . '" OR goods_details.date = "' . date('d/m/Y',strtotime($_GET['date'])) . '" OR goods_details.date = "' . date('d.m.Y',strtotime($_GET['date'])) . '")';
			}
		}
 

		if(!empty($_GET['msg']) && $_GET['msg']==1)
		{
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Deleted successfully..!.</div>");

        	redirect(base_url().'goods_details_admin');
		}
		
		// print_r( $searchqry );
		// die;

		$join_cond = 'goods_details.branch_id = branches.id';       

		
		$config["base_url"] = base_url()."goods_details_admin/index";
		$total_row = $this->admin_model->count_all_data_condition_ordersearch_goods_details_admin('goods_details',$data_cndtn,'goods_details.sort_order','DESC',$searchqry, $searchqry_in, 'branches', $join_cond);
		$config["total_rows"] = $total_row;
		$config["per_page"] =200;
		$config['use_page_numbers'] = TRUE;
		$config["suffix"] ='?' . http_build_query($_GET, '', "&");
		$config['num_links'] = $total_row;
		$config['cur_tag_open'] = '<a style="color: #fff;cursor: default;background-color: #337ab7;border-color: #337ab7;border-radius: 3px;padding:10px; margin-left:10px; margin-right:10px;">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = '<i class="fa fa-arrow-circle-right padding:10px; " aria-hidden="true"></i>';
		$config['prev_link'] = '<i class="fa fa-arrow-circle-left padding:10px;" aria-hidden="true"></i>';

		$this->pagination->initialize($config);

		if($this->uri->segment(3)){
			$page = ($this->uri->segment(3)) ;
		}
		else{
			$page = 1;
		}
		
		$this->data["result"] = $this->admin_model->get_all_data_condition_ordersearch_goods_admin('goods_details' ,$data_cndtn,$config["per_page"], $page,'sort_order','DESC',$searchqry, $searchqry_in, 'branches', $join_cond);

		// echo "<pre>";
        // print_r( $this->data["result"]  );
        // echo "</pre>";
        // die;
		

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
			$fields=['company' ,'shipmentname' ,'origin' ,'boxno' ,'invoiceno' ,'pcs' ,'weight' ,'rewight' ,'received_pcs' ,'sender_address' ,'reciever_address','phone' ,'state' ,'district' ,'pincode' ,'goods_desc' ,'recieved_at_hub','connecting_date','recieved_at_branch','vendor','docket','contact_no','goods_status' ,'remarks' ,'sendingdate' ,'recievingdate' ,'created_at'];
			$deleteValue = $_GET['inptvalue'];
			$deleteQuery = $_GET['serachq'];
			log_message('deleted', $this->data["result"]);
			// $this->admin_model->delete_table_account('goods_details',$deleteValue,$deleteQuery);
			$this->generate_excel($this->data["result"],$fields,'DOWNLOAD_TO_IMPORT');
			
		}
		
		// $this->data['total_sel_cnt']  = $this->admin_model->get_sort_order_count('goods_details');
// echo $data['total_sel_cnt'];

// die;

		$this->data['branches'] = $branches;
		$this->data['current_branch_id'] = $branch_id;
		$str_links = $this->pagination->create_links();
		$this->data["links"] = explode('&nbsp',$str_links );	 
		$this->load->view('head/admin_header',$this->data);
		$this->load->view('goods_details_admin/index');
		$this->load->view('head/admin_footer');
		// echo json_encode($searchqry);
	}

	function createExcel(array $data, array $headers = [], $fileName = 'data.xlsx')
    {

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

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

	function makeObject($sl,$item,$fields)
	{
		$row=array();
		foreach($fields as $field)
		{
			if($field=="slno"){
				$row[$field]= $sl;
			}else{
				$row[$field] = $item->$field;
			}
		}
		return $row;
	}

	public function generate_excel($data,$fields,$fileName)
    {

		$rows = array();
		foreach($data  as $key => $item){
			$rows[$key] = $this->makeObject(($key+1),$item,$fields);
		}
		// $row = (object) $row;
		// echo "<pre>";
		// var_dump($row);
		// exit;
		foreach($fields as $field)
		{
			$headers[] = strtoupper(str_replace('_',' ',$field));
		}
        $this->createExcel($rows, $headers, "$fileName.xlsx");

    }

	public function create()
	{
		$this->data['page_id']="goods_details_create";
		$this->data['page_title']="Add goods details  | Cargoadmin";
		$this->load->view('head/admin_header',$this->data);
		$this->load->view('goods_details_admin/create');
		$this->load->view('head/admin_footer');
	}
	public function create_process()
	{ 

        //add
        $config['upload_path'] = './assets/uploads/headers';
        $config['allowed_types'] = 'gif|jpg|png';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('header')) {
            if ($this->upload->data()['file_name']){
                $error = array('error' => strip_tags($this->upload->display_errors()));
                $this->data['page_id']="goods_details_create";
                $this->data['page_title']="Add goods details  | Cargoadmin";
                $this->load->view('head/admin_header',$this->data);
                $this->load->view('goods_details_admin/create', $error);
                $this->load->view('head/adminfooter');
                return;
            }
        }else{
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
        redirect(base_url().'goods_details_admin/create');


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
        	redirect(base_url().'goods_details_admin');
		}
		else{
			$this->data['page_id']="goods_details";
			$this->data['page_title']="Update goods details  | cargoadmin";
			$data_cndtnx=array('id'=>$this->uri->segment(3));
			$details=$this->admin_model->get_all_data('goods_details',$data_cndtnx,'id','DESC');
			if($details==false){
				$this->session->set_flashdata('ermsg',"<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        	redirect(base_url().'goods_details_admin');
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

				$this->load->view('head/admin_header',$this->data);
				$this->load->view('goods_details_admin/update');
				$this->load->view('head/admin_footer');
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
        	redirect(base_url().'goods_details_admin/update/'.$uiid);
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
				'goods_status'=> $this->security->xss_clean($this->input->post('goods_status'))
			);
    
			$lstid=$this->crud_model->edit_table_account('goods_details',$datax,$uiid,'id');
			echo "Successfully updated";
			// $this->session->set_flashdata('msgx',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> Updated successfully.</div>");
        	
			// $redirectURL  = $this->security->xss_clean($this->input->post('redirectURL'));
			// redirect($redirectURL);
    }


    public function delete_process()
	{
		if($this->uri->segment(3)==null){
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        	redirect(base_url().'goods_details_admin');
		}
		else{
			$dat=$this->admin_model->delete_single_goods_records('goods_details',$this->uri->segment(3),'id');
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Deleted successfully..!.</div>");
        	redirect(base_url().'goods_details_admin');
		}
    }
    public function print()
	{
		if($this->uri->segment(3)==null){
			$this->session->set_flashdata('ermsg',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        	redirect(base_url().'goods_details_admin');
		}
		else{
			$this->data['page_id']="goods_details";
			$this->data['page_title']="Print";
			$data_cndtnx=array('id'=>$this->uri->segment(3));
			// $details=$this->admin_model->get_all_data('goods_details',$data_cndtnx,'id','DESC');
			$details=$this->admin_model->get_all_data_selected_print('goods_details',$data_cndtnx,'id','DESC');

			
			if($details==false){
				$this->session->set_flashdata('ermsg',"<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        		redirect(base_url().'goods_details_admin');
			}
			else{
				$this->data['result']=$details;
				$this->load->view('head/admin_header',$this->data);
				$this->load->view('goods_details_admin/print');
				$this->load->view('head/admin_footer');
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

		 
			// $details=$this->admin_model->get_all_data('goods_details',$data_cndtnx,'id','DESC',$new_check_box);
			$details = $this->admin_model->get_all_data_selected_print('goods_details',$data_cndtnx,'id','DESC',$new_check_box);

			// echo "<pre>";
			// echo count($details );
			//  print_r($details );
			// echo "</pre>";

			// die;

			if($details==false){
				$this->session->set_flashdata('ermsg',"<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
        		redirect(base_url().'goods_details_admin');
			}
			else{
				$this->data['result']=$details;
				$this->load->view('head/admin_header',$this->data);
				$this->load->view('goods_details_admin/print');
				$this->load->view('head/admin_footer');
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
        		redirect(base_url().'goods_details_admin');
			}
			else{
				$this->data['result']=$details;
				$this->load->view('head/admin_header',$this->data);
				$this->load->view('goods_details_admin/printnew');
				$this->load->view('head/admin_footer');
			}
	}

    public function import()
	{
		$this->data['page_id']="goods_details_import";
		$this->data['page_title']="Import goods details  | Cargoadmin";

		$data_cndtnx=array();
		$this->data['cargos_arr'] = $this->admin_model->get_all_data('cargo',$data_cndtnx,'id','DESC'); 
		
 
		$data_cndtnz=array('type' => 'branch', 'status' => 0);
		$this->data['branches_arr'] = $this->admin_model->get_all_data('branches',$data_cndtnz,'id','DESC'); 
		

		$this->load->view('head/admin_header',$this->data);
		$this->load->view('goods_details_admin/import',$this->data);
		$this->load->view('head/admin_footer');
	}

	// public function import_process(){
	// 	$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	// 	if(isset($_FILES['upload_file']['name']) && in_array($_FILES['upload_file']['type'], $file_mimes)) {

	// 		$arr_file = explode('.', $_FILES['upload_file']['name']);
	// 		$extension = end($arr_file);

	// 		if('csv' == $extension){
	// 			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
	// 		} else {
	// 			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
	// 		}

	// 		$spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
	// 		$sheetData = $spreadsheet->getActiveSheet()->toArray();

	// 		//print_r($sheetData);
	// 		foreach ($sheetData as $val){

	// 			$datax=array(
	// 				'invoiceno'=>$val['1'],
	// 				'date'=>$val['4'],
	// 				'company'=>$val['0'],
	// 				'address'=>$val['5'],
	// 				'weight'=>$val['3'],
	// 				'pcs'=>$val['2'],
	// 				'district'=>$val['6'],
	// 				'shipmentname'=>'',
	// 				'sendingdate'=>'',
	// 				'recievingdate'=>'',
	// 				'created_at'=>date('Y-m-d H:i:s'),
	// 				'status'=>0
	// 			);
	// 			$lstid = $this->crud_model->create_table_account('goods_details', $datax);
	// 		}
		
	// 		$this->session->set_flashdata('msgx',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> imported successfully.</div>");
		
	// 		redirect(base_url().'goods_details/import');
	// 	}
	// }


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


        //added
		/*
        $file_name = null;
        $config['upload_path'] = './assets/uploads/headers';
        $config['allowed_types'] = 'gif|jpg|png';
 
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('upload_header')) {
            if ($this->upload->data()['file_name']){
                echo $this->upload->display_errors();
                return;
            }
        }else{
            $file_name = $this->upload->data()['file_name'];
        }
       */

	  	$cargo_id = $this->security->xss_clean($this->input->post('cargo_id')); 

		$branch_id = $this->security->xss_clean($this->input->post('branch_id'));  
		 
		 
		$data_cndtnx = array('id' => $cargo_id);
		$details = $this->admin_model->get_all_data('cargo', $data_cndtnx, 'id', 'DESC');
		$file_name = $details[0]->header;

 


		$trip_no = $this->security->xss_clean($this->input->post('trip_no')); 

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
						'company' =>       $val['0'] ?? "",	
						//add
						'header' =>        $file_name,
						//end	
						'shipmentname' =>  $val['1'] ?? "",
						'origin' =>        $val['2'] ?? "",
						'boxno' =>         $val['3'] ?? "",
						'tracking_no' =>   $val['4'] ?? "",
						'invoiceno' =>     $val['5'] ?? "",
						'pcs' =>           $val['6'] ?? "",
						'weight' =>        $val['7'] ?? "",
						'rewight' =>       $val['8'] ?? "",
						'received_pcs' =>  $val['9'] ?? "",
						'sender_address' =>  $val['10'] ?? "",
						'reciever_address'=>$val['11'] ?? "",
						'phone' =>         $val['12'] ?? "",
						'state' =>         $val['13'] ?? "",
						'district' =>      $val['14'] ?? "",
						'pincode' =>       $val['15'] ?? "",
						'goods_desc' =>    $val['16'] ?? "",
						'recieved_at_hub'=>$val['17'] ?? "",
						'received_date'=> $val['17'] ? date('d-m-Y', strtotime( $val['17'])): "",
						'connecting_date'=>$val['18'] ?? "",
						'recieved_at_branch'=>$val['19'] ?? "",
						'vendor'=>         $val['20'] ?? "",
						'docket'=>         $val['21'] ?? "",
						'url'=>            $val['25'] ?? "",
						'contact_no'=>     $val['22'] ?? "",
						'goods_status' =>        $val['23'] ?? "",
						'remarks' =>       $val['24'] ?? "",
						'sendingdate' =>   $val['26'] ?? "",
						'recievingdate' =>   $val['27'] ?? "",
						'trip_no' =>   $trip_no,
						'created_at' =>    date('Y-m-d H:i:s'),
						'origin_id' =>    $branch_id,
						'branch_id' =>    $branch_id						
					); 



					$val['5'] = $this->security->xss_clean($val['5']); 
					$conditon = array( 'trip_no' => $trip_no, 'invoiceno' => $val['5'] );
					$res = $this->crud_model->check_duplicate('goods_details', $conditon); 
					 
					if(count($res) == 0) {
						$lstid = $this->crud_model->create_table_account('goods_details', $datax);
					}else{
						$datay=array(	
							'row_no'=>           $key+1,
							'trip_no'=>     	$trip_no,
							'invoice_no'=>        $val['5'] ,
							'created_at' =>    date('Y-m-d H:i:s'),
							'updated_at' =>    date('Y-m-d H:i:s'),
						);
						$lstid = $this->crud_model->create_table_account('goods_not_imported', $datay);
					}  
				
			}
		
			$this->session->set_flashdata('msgx',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> imported successfully.</div>");
		
		}

		redirect(base_url() . 'goods_details_admin/import');
	}


	function removeGoodsRecords()	 
	{
		if(empty($_POST['checkbox_arr']))
		{
			echo json_encode(array('status'=>0,'message'=>'Please select records'));

		}else{
			 
			$selGoodsIds = implode(',',$this->security->xss_clean($this->input->post('checkbox_arr'))); 
		
			$resp = $this->admin_model->delete_goods_records( $selGoodsIds , $this->input->post('checkbox_arr'));
			 
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

			// echo $trip;

			// print_r($_GET['trip_no']); die;
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

        	redirect(base_url().'goods_details_admin/listTransferPending');
		}
		
		$config["base_url"] = base_url()."goods_details_admin/listTransferPending";

		// print_r( $searchqry );
		// die;
		$total_row = $this->admin_model->count_all_data_condition_ordersearch('goods_details',$data_cndtn,'id','DESC',$searchqry);
		$config["total_rows"] = $total_row;
		$config["per_page"] =200;
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
			$fields=['company' ,'shipmentname' ,'origin' ,'boxno' ,'invoiceno' ,'pcs' ,'weight' ,'rewight' ,'received_pcs' ,'sender_address' ,'reciever_address','phone' ,'state' ,'district' ,'pincode' ,'goods_desc' ,'recieved_at_hub','connecting_date','recieved_at_branch','vendor','docket','contact_no','goods_status' ,'remarks' ,'sendingdate' ,'recievingdate' ,'created_at'];
			$deleteValue = $_GET['inptvalue'];
			$deleteQuery = $_GET['serachq'];
			log_message('deleted', $this->data["result"]);
			// $this->admin_model->delete_table_account('goods_details',$deleteValue,$deleteQuery);
			$this->generate_excel($this->data["result"],$fields,'DOWNLOAD_TO_IMPORT');
			
		}
		
		$this->data['branches'] = $branches;
		$this->data['current_branch_id'] = $branch_id;
		$str_links = $this->pagination->create_links();
		$this->data["links"] = explode('&nbsp',$str_links );
		$this->load->view('head/admin_header',$this->data);
		$this->load->view('goods_details_admin/transfer_pending');
		$this->load->view('head/admin_footer');


	}

	function transfer_goods() {

		if( $this->input->post('sel_goods_id') !='') {
			 
			$selGoodsIds = explode(',',$this->security->xss_clean($this->input->post('sel_goods_id'))); 
			$vehicle_id = $this->security->xss_clean($this->input->post('vehicle_id')); 
			$transferred_from  = $this->security->xss_clean($this->input->post('transfer_from'));
			$transferred_to = $this->security->xss_clean($this->input->post('transfer_to')); 
		
			$transferred_from_data = $this->admin_model->get_branch("administrator",$transferred_from );
			$from_branch = $transferred_from_data[0]->name;

			$transferred_to_data = $this->admin_model->get_branch("administrator",$transferred_to );
			$to_branch = $transferred_to_data[0]->name;
				foreach($selGoodsIds as $goodsId) {    
			    $data = $this->admin_model->get_data("goods_details",$goodsId);

			 
 				$invoice_number  = $data[0]->invoiceno;
 				$tracking_no  = $data[0]->tracking_no;
 
					$datay = array(
						'goods_id' =>  $goodsId ,
						'transferred_from' => $transferred_from,
						'transferred_to' => $transferred_to,  
						'vehicle_id' => $vehicle_id,
						'transfer_status' => "pending",
						'invoice_number' =>$invoice_number,
						'tracking_no' =>$tracking_no,
						'comment' =>  "Transferred from " .$from_branch." To ".$to_branch,
					);
				
					 
					$lstid = $this->crud_model->create_table_account('goods_transfer_details', $datay); 

				
					$datax = array(
						'branch_id' => $transferred_to,
						'transferred_from' => $transferred_from,
						'transferred_to' => $transferred_to, 
						'is_transfer' => 1, 
						'transfer_status' => "pending", 
						'current_transfer_id' => $lstid, 
						'sort_order' => NULL
					);
				
					$this->crud_model->edit_table_account('goods_details', $datax, $goodsId, 'id');				
				}

				$this->session->set_flashdata('msgx',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> Transferred successfully.</div>"); 
				redirect(base_url().'goods_details_admin/');
		

		} else {

				$this->session->set_flashdata('msgx',"<div class='alert alert-error' style='color:red;'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> No Goods Selected.</div>"); 
				redirect(base_url().'goods_details_admin/');
		}

	}


	function confirm_received_goods() {
		if( $this->input->post('sel_goods_id_received') !='') {			 
			$selGoodsIds = explode(',',$this->security->xss_clean($this->input->post('sel_goods_id_received')));		 
				foreach($selGoodsIds as $goodsId) { 				
					$datax = array( 
						'transfer_status' => 'confirmed',
						'received_date' => date("d-m-Y")
					);				 		
					$this->crud_model->edit_table_account('goods_details', $datax, $goodsId, 'id');
					$selColumns = "current_transfer_id";
					$transfer_data = $this->crud_model->get_sel_columns('goods_details', $selColumns, 'id' , $goodsId);    								 
					$current_transfer_id  = $transfer_data[0]->current_transfer_id; 			 
					$datay = array(						
						'transfer_status' => 'confirmed',
						'goods_received_date' => date("Y-m-d h:i:sa")
					);				
					$this->crud_model->edit_table_account('goods_transfer_details', $datay, $current_transfer_id, 'id');			
				}
				$this->session->set_flashdata('msgx',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> Transferred successfully.</div>"); 
				redirect(base_url().'goods_details_admin/');

		} else {
				$this->session->set_flashdata('msgx',"<div class='alert alert-error' style='color:red;'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> No Goods Selected.</div>"); 
				redirect(base_url().'goods_details_admin/');
		}

	}

	function update_checked() {
	 
		 
		//   $selGoodsIds  = explode('-',$this->security->xss_clean($this->input->post('id')));	
		//   $flag  =  $this->security->xss_clean($this->input->post('flag'));	
		  
		//   $res = $this->admin_model->get_highest_sort_order('goods_details');

		//   print_r($res );
		// 	die;

		//   if(empty($res[0]->last_sort_order)){
		// 	$sort_order = 1;
		//   }else {
		// 	$sort_order = $res[0]->last_sort_order +1;
		//   }

		//   if( $flag == 'true'){ 
		// 		$datay = array('sort_order' => $sort_order);	
		// 	} else {
		// 		$datay = array('sort_order' => null);
		// 	}

		// 	// print_r( $datay );
		// 	// die;
		// 	$this->crud_model->edit_table_account('goods_details', $datay,  $selGoodsIds[1] , 'id');	 

		// 	$total_cnt  = $this->admin_model->get_sort_order_count('goods_details');
		// 	echo $total_cnt; 

	}

	function update_checked_multipe() {
		 
		  $selGoodsIds  = $_POST['invoice'];
		  $flag  =  'true';	
		  foreach($selGoodsIds as $selId ){
			$res = $this->admin_model->get_highest_sort_order('goods_details');
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
 
		 $this->admin_model->reset_checked('goods_details', $branch_id ); 	 
    }

	function listTransferGoods() {		 

		$this->data['page_id']="list_transfer_goods";
		$this->data['page_title']="All Transfer Goods  | cargoadmin";
		$config = array();
		$searchqry = array();

		$branches = $this->admin_model->get_all_active_branches(); 

		$data_cndtnx = array('status' => 0);
		$this->data['vehicles'] = $this->admin_model->get_all_data('vehicles', $data_cndtnx, 'id', 'DESC');

		$data_cndtnz = array();
		// $this->data['trip_no_arr']  
		$this->data['trip_no_arr'] = $this->admin_model->get_all_trip_no('goods_details', $data_cndtnz, 'created_at', 'DESC'); 

		// print_r( count( $this->data['trip_no_arr'] ) );
		// die;
	 
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

		
		
		//    die( $searchqry );
 
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

        	redirect(base_url().'goods_details_admin/listTransferGoods');
		}
		
		// print_r( $searchqry );
		// die;
		
		$data_cndtn=array('other_state'=> 0, 'origin_id' => $branch_id, 'is_transfer' => 1 );

		$config["base_url"] = base_url()."goods_details_admin/listTransferGoods";
		$total_row = $this->admin_model->count_all_data_condition_ordersearch_goods_details('goods_details',$data_cndtn,'id','DESC',$searchqry, $searchqry_in);
		$config["total_rows"] = $total_row;
		$config["per_page"] =200;
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
		
		$this->data["result"] = $this->admin_model->get_all_data_condition_ordersearch_goods('goods_details' ,$data_cndtn,$config["per_page"], $page,'id','DESC',$searchqry, $searchqry_in);
 
		
 
		
		$this->data['branches'] = $branches;
		$this->data['current_branch_id'] = $branch_id;
		$str_links = $this->pagination->create_links();
		$this->data["links"] = explode('&nbsp',$str_links );
		$this->load->view('head/admin_header',$this->data);
		$this->load->view('goods_details_admin/transfer_goods');
		$this->load->view('head/admin_footer');


		 

  }


  function goodsNotInTripsheet() {
	 

	$this->data['page_id']="goods_not_in_tripsheet";
		$this->data['page_title']="Goods Not in Tripsheet  | cargoadmin";
		$config = array();
		$searchqry = array();
		// $searchqry_in = array();

		$branches = $this->admin_model->get_all_active_branches(); 

		$data_cndtnx = array('status' => 0);
		$this->data['vehicles'] = $this->admin_model->get_all_data('vehicles', $data_cndtnx, 'id', 'DESC');

		$data_cndtnz = array();
		// $this->data['trip_no_arr']  
		$this->data['trip_no_arr'] = $this->admin_model->get_all_trip_no('goods_details', $data_cndtnz, 'created_at', 'DESC'); 

		// print_r( count( $this->data['trip_no_arr'] ) );
		// die;
	 
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

		
		
		//    die( $searchqry );
 
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

        	redirect(base_url().'goods_details_admin/goodsNotInTripsheet');
		}
		
		// print_r( $searchqry );
		// die;
		
		$data_cndtn=array('other_state'=> 0, 'branch_id' => $branch_id);

		$config["base_url"] = base_url()."goods_details_admin/goodsNotInTripsheet";
 
		$total_row = $this->admin_model->count_all_data_goods_notin_tripsheet('goods_details',$data_cndtn,'id','DESC',$searchqry, $searchqry_in);

 

		$config["total_rows"] = $total_row;
		$config["per_page"] =200;
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
		
		$this->data["result"] = $this->admin_model->get_all_data_goods_notin_tripsheet('goods_details' ,$data_cndtn,$config["per_page"], $page,'id','DESC',$searchqry, $searchqry_in);
		
		if(isset($_GET['export_goods_not_in_tripsheet']))
		{ 
			$this->generate_excel($this->data["result"],['slno','transfer_status','company','shipmentname', 'origin','boxno','tracking_no','trip_no', 'invoiceno','pcs','weight','rewight','received_pcs','sender_address','reciever_address', 'phone', 'state', 'district', 'pincode','goods_desc','recieved_at_hub', 'connecting_date', 'recieved_at_branch', 'vendor', 'contact_no', 'docket', 'goods_status', 'remarks', 'sendingdate', 'recievingdate'],'goods__not_in_tripsheet');
		}
		
 
		
		$this->data['branches'] = $branches;
		$this->data['current_branch_id'] = $branch_id;
		$str_links = $this->pagination->create_links();
		$this->data["links"] = explode('&nbsp',$str_links );
		$this->load->view('head/admin_header',$this->data);
		$this->load->view('goods_details_admin/goods_not_in_tripsheet');
		$this->load->view('head/admin_footer');
	  

}

function goodsInTripsheet() {	 

	$this->data['page_id']="goods_in_tripsheet";
		$this->data['page_title']="Goods In Tripsheet  | cargoadmin";
		$config = array();
		$searchqry = array();
		// $searchqry_in = array();

		$branches = $this->admin_model->get_all_active_branches(); 

		$data_cndtnx = array('status' => 0);
		$this->data['vehicles'] = $this->admin_model->get_all_data('vehicles', $data_cndtnx, 'id', 'DESC');

		$data_cndtnz = array();
		// $this->data['trip_no_arr']  
		$this->data['trip_no_arr'] = $this->admin_model->get_all_trip_no('goods_details', $data_cndtnz, 'created_at', 'DESC'); 

		// print_r( count( $this->data['trip_no_arr'] ) );
		// die;
	 
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

		
		
		//    die( $searchqry );
 
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

        	redirect(base_url().'goods_details_admin/goodsInTripsheet');
		}
		
		// print_r( $searchqry );
		// die;
		
		$data_cndtn=array('other_state'=> 0, 'branch_id' => $branch_id);

		$config["base_url"] = base_url()."goods_details_admin/goodsInTripsheet";
 
		$total_row = $this->admin_model->count_all_data_goods_in_tripsheet('goods_details',$data_cndtn,'id','DESC',$searchqry, $searchqry_in);

 

		$config["total_rows"] = $total_row;
		$config["per_page"] =200;
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
		
		$this->data["result"] = $this->admin_model->get_all_data_goods_in_tripsheet('goods_details' ,$data_cndtn,$config["per_page"], $page,'id','DESC',$searchqry, $searchqry_in);
 
		if(isset($_GET['export_goods_in_tripsheet']))
		{ 
			$this->generate_excel($this->data["result"],['slno','transfer_status','company','shipmentname', 'origin','boxno','tracking_no','trip_no', 'invoiceno','pcs','weight','rewight','received_pcs','sender_address','reciever_address', 'phone', 'state', 'district', 'pincode','goods_desc','recieved_at_hub', 'connecting_date', 'recieved_at_branch', 'vendor', 'contact_no', 'docket', 'goods_status', 'remarks', 'sendingdate', 'recievingdate'],'goods_in_tripsheet');
		}
 
		
		$this->data['branches'] = $branches;
		$this->data['current_branch_id'] = $branch_id;
		$str_links = $this->pagination->create_links();
		$this->data["links"] = explode('&nbsp',$str_links );
		$this->load->view('head/admin_header',$this->data);
		$this->load->view('goods_details_admin/goods_in_tripsheet');
		$this->load->view('head/admin_footer');
	  

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
        		redirect(base_url().'goods_details_admin/goodsInTripsheet');
			}
			else{
				$this->data['result']=$details;
				$this->load->view('head/admin_header',$this->data);
				$this->load->view('goods_details_admin/print');
				$this->load->view('head/admin_footer');
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
		redirect(base_url().'goods_details_admin/goodsInTripsheet');
	}
	else{
		$this->data['result']=$details;
		$this->load->view('head/admin_header',$this->data);
		$this->load->view('goods_details_admin/print');
		$this->load->view('head/admin_footer');
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

}//end Class  //19914