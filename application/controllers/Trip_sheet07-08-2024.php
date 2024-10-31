<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Trip_sheet extends CI_Controller
{


    public $data = array();

    function __construct()
    {
        parent::__construct();
        admin_session_check();
        $this->data['page_id'] = "trip_sheet";
        $this->data['page_title'] = "trip_sheet";
        $this->load->library('pagination');
        date_default_timezone_set('Asia/Kolkata');
        $this->load->helper('string');
        $this->load->helper('text');
        // $this->session->set_flashdata('msgx',""); 
      
    }

    public function index()
    { 
        $this->data['page_id'] = "trip_sheet";
        $this->data['page_title'] = "All trip sheet Lists  | CargoAdmin";
        $config = array();
        $searchqry = array();
        $data_cndtn = array();
        if (isset($_GET['status']) && $_GET['status'] != null && $_GET['status'] != 'all') {
            $data_cndtn['status'] = $_GET['status'];
        }
        if (isset($_GET['vehicle_number']) && $_GET['vehicle_number'] != null && $_GET['vehicle_number'] != 'all') {
            $data_cndtn['vehicle_id'] = $_GET['vehicle_number'];
        }
        if (isset($_GET['vendor_name']) && $_GET['vendor_name'] != null && $_GET['vendor_name'] != 'all') {
            $data_cndtn['vendor_id'] = $_GET['vendor_name'];
        }
        
        $data_cndtny = array('type' => 'vendor', 'status' => 0);
        $this->data['vendors'] = $this->admin_model->get_all_data('branches', $data_cndtny, 'id', 'DESC'); 
      
        $data_cndtn['branch_id'] = $this->session->userdata['adminloginel']['id']; 

        $config["base_url"] = base_url() . "trip_sheet/index";
        $total_row = $this->admin_model->count_all_data_condition_ordersearch('trip_sheet', $data_cndtn, 'id', 'DESC', $searchqry);

        $config["total_rows"] = $total_row;
        $config["per_page"] = 15;
        $config['use_page_numbers'] = TRUE;
        $config["suffix"] = '?' . http_build_query($_GET, '', "&");
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

        if ($this->uri->segment(3)) {
            $page = ($this->uri->segment(3));
        } else {
            $page = 1;
        }
        $this->data["result"] = $this->admin_model->get_all_data_condition_ordersearch('trip_sheet', $data_cndtn, $config["per_page"], $page, 'id', 'DESC', $searchqry);


         //$data["result2"] = $this->admin_model->get_all_data_condition_ordersearch2();var_dump($data['result2']);die();
        // $str_links = $this->pagination->create_links();
        // $this->data["links"] = explode('&nbsp', $str_links);
        $this->data["links"] = $this->pagination->create_links();
        $data_cndtnx = array('status' => 0);
        $this->data['vehicles'] = $this->admin_model->get_all_data('vehicles', $data_cndtnx, 'id', 'DESC');
        $this->load->view('head/header', $this->data);
        $this->load->view('trip_sheet/index');
        $this->load->view('head/footer');
    }

    public function create()
    {
        $this->data['page_id'] = "trip_sheet_create";
        $this->data['page_title'] = "Add new Store  | CargoAdmin";
        $data_cndtnx = array('status' => 0);
        $this->data['vehicles'] = $this->admin_model->get_all_data('vehicles', $data_cndtnx, 'id', 'DESC'); 

        $data_cndtny = array('type' => 'vendor', 'status' => 0);
        $this->data['vendor'] = $this->admin_model->get_all_data('branches', $data_cndtny, 'id', 'DESC'); 

        $searchqry = array();
        $data_cndtn = array();
		$this->data['cargos_arr'] = $this->admin_model->get_all_data('cargo',$data_cndtnx,'id','DESC');  
       
       $this->session->set_flashdata('msgx',""); 
        $this->load->view('head/header', $this->data);
        $this->load->view('trip_sheet/create');
        $this->load->view('head/footer');
    }

    public function serach_vehicle_id($id)
    {
        $condtn = array('id' => $id, 'status' => 0);
        $result = $this->crud_model->table_details_dt('vehicles', $condtn);
        echo json_encode($result);
    }

    public function serach_vendor_id($id)
    {
        $condtn = array('id' => $id, 'type' => 'vendor','status' => 0);
        $result = $this->crud_model->table_details_dt('branches', $condtn);
        echo json_encode($result);
    }

    

    public function create_process()
    {  

        $file_name =null;
        $upload_file_name = null;
       /* 
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
            $this->load->view('head/footer');
            die( print_r($error));
            return;  
        }   
 */

        
        $searchqry = array();
        $data_cndtn['branch_id'] = $this->session->userdata['adminloginel']['id'];  
        // $total_row = $this->admin_model->count_all_data_condition_ordersearch('trip_sheet', $data_cndtn, 'id', 'DESC', $searchqry);
        // $total_row;
        // $trip_sheet_name = $total_row+1;


        // $data_cnd1 = array('branch_id' => $this->session->userdata['adminloginel']['id'], 'trip_sheet_name' =>$trip_sheet_name) ;
        // $result = $this->admin_model->check_tripsheet_name_exist('trip_sheet', $data_cnd1);

        // if(  $result > 0 ){
        //      $trip_sheet_name = $total_row +2;
        // }else {
        //     $trip_sheet_name = $total_row +1;
        // }
 
        $data_cnd1 = array('branch_id' => $this->session->userdata['adminloginel']['id'] ) ;
        $result = $this->admin_model->create_tripsheet_name('trip_sheet', $data_cnd1);
        if($result){
            $trip_sheet_name =  $result[0]->trip_sheet_name +1;
        } else {
            $trip_sheet_name = 1;
        } 

	  	$cargo_id = $this->security->xss_clean($this->input->post('cargo_id'));
		 
        $data_cndtnx = array('id' => $cargo_id);
        $details = $this->admin_model->get_all_data('cargo', $data_cndtnx, 'id', 'DESC');
        $file_name  =  $cargo_id; //$details[0]->header;         
 
 
        if ($this->security->xss_clean($this->input->post('stop_km')) != null) {
            $stop_km = $this->security->xss_clean($this->input->post('stop_km'));
        } else {
            $stop_km = 0;
        }

        if ($this->security->xss_clean($this->input->post('start_km')) != null) {
            $start_km = $this->security->xss_clean($this->input->post('start_km'));
        } else {
            $start_km = 0;
        }

        if ($stop_km == 0) {
            $total_km = 0;
        } else {
            $total_km = $stop_km - $start_km;
        }

        if ($this->security->xss_clean($this->input->post('total_rent')) != null) {
            $total_rent = $this->security->xss_clean($this->input->post('total_rent'));
        } else {
            $total_rent = 0;
        }

        //exptotal
        if ($this->security->xss_clean($this->input->post('exp_diesel')) != null) {
            $exp_diesel = $this->security->xss_clean($this->input->post('exp_diesel'));
        } else {
            $exp_diesel = 0;
        }

        if ($this->security->xss_clean($this->input->post('exp_batha')) != null) {
            $exp_batha = $this->security->xss_clean($this->input->post('exp_batha'));
        } else {
            $exp_batha = 0;
        }

        if ($this->security->xss_clean($this->input->post('exp_phone')) != null) {
            $exp_phone = $this->security->xss_clean($this->input->post('exp_phone'));
        } else {
            $exp_phone = 0;
        }

        if ($this->security->xss_clean($this->input->post('exp_toll')) != null) {
            $exp_toll = $this->security->xss_clean($this->input->post('exp_toll'));
        } else {
            $exp_toll = 0;
        }

        if ($this->security->xss_clean($this->input->post('exp_food')) != null) {
            $exp_food = $this->security->xss_clean($this->input->post('exp_food'));
        } else {
            $exp_food = 0;
        }

        if ($this->security->xss_clean($this->input->post('exp_other')) != null) {
            $exp_other = $this->security->xss_clean($this->input->post('exp_other'));
        } else {
            $exp_other = 0;
        }

        $exp_total = $exp_diesel + $exp_batha + $exp_phone + $exp_toll + $exp_food + $exp_other;
        if ($this->security->xss_clean($this->input->post('exp_advance')) != null) {
            $exp_advance = $this->security->xss_clean($this->input->post('exp_advance'));
        } else {
            $exp_advance = 0;
        }

        $balance_amount = $exp_total - $exp_advance;

        $vehicles_cndtnx = array('status' => 0, 'id' => $this->security->xss_clean($this->input->post('vehicle_number')));
        $vehicles_details = $this->admin_model->get_all_data('vehicles', $vehicles_cndtnx, 'id', 'DESC');
        
        if ($vehicles_details == false) {
            $vehicle_numberx ='';
            // $this->session->set_flashdata('msgx', "<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Vehicle Number Doesnot exist..!</div>");
            // redirect(base_url() . 'trip_sheet/create');
        } else {
            $vehicle_numberx = $vehicles_details[0]->vehicle_number;
        }

        $datax = array(
            'trip_sheet_name' => $trip_sheet_name,
            'trip_date' => $this->security->xss_clean($this->input->post('trip_date')),
            'estimate_arrival_date' => $this->security->xss_clean($this->input->post('estimate_arrival_date')),
            'trip_time' => $this->security->xss_clean($this->input->post('trip_time')),
            'header'=>$file_name,
            'vehicle_id' => $this->security->xss_clean($this->input->post('vehicle_number')),
            'vehicle_number' => $vehicle_numberx,
            'vehicle_drivername' => $this->security->xss_clean($this->input->post('vehicle_drivername')),
            'vehicle_drivermobilenumber' => $this->security->xss_clean($this->input->post('vehicle_drivermob')),
            'helper_name' => $this->security->xss_clean($this->input->post('helper_name')),
            'helper_mobilenumber' => $this->security->xss_clean($this->input->post('helper_mobilenumber')),
            'destination'=>  $this->security->xss_clean($this->input->post('destination')),
            'start_km' => $start_km,
            'stop_km' => $stop_km,
            'total_km' => $total_km,
            'total_rent' => $total_rent,
            'exp_diesel' => $exp_diesel,
            'exp_batha' => $exp_batha,
            'exp_phone' => $exp_phone,
            'exp_toll' => $exp_toll,
            'exp_food' => $exp_food,
            'exp_other' => $exp_other,
            'exp_total' => $exp_total,
            'exp_advance' => $exp_advance,
            'balance_amt' => $balance_amount,
            'created_at' => date('Y-m-d H:i:s'),
            'status' => $this->security->xss_clean($this->input->post('status')),
            'upload_file_name' => $upload_file_name,
            'branch_id' => $this->security->xss_clean($this->input->post('branch_id')),
            'vendor_or_vehicle' => $this->security->xss_clean($this->input->post('vendor_or_vehicle')),
            'vendor_name' => $this->security->xss_clean($this->input->post('vendor_name')),
            'vendor_id' => $this->security->xss_clean($this->input->post('vendor_id')),
            'vendor_location' => $this->security->xss_clean($this->input->post('vendor_location')),
            'mobile' => $this->security->xss_clean($this->input->post('mobile')),
            'authorized_person' => $this->security->xss_clean($this->input->post('authorized_person')), 
        );

      
 

        if($this->input->post('status')=="1"){
            $st=5;
        }
        else if($this->input->post('status')=="0"){
            $st=6;
        }
        else if($this->input->post('status')=="2"){
            $st=7;
        }
        else{
            $st=8;
        }

       
        $lstid = $this->crud_model->create_table_account('trip_sheet', $datax);
        $last_insert_id =  $lstid;

 
        
        $this->session->set_flashdata('msgx', "<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> created successfully.</div>");

        redirect(base_url() . 'trip_sheet/create');

	}


    public function update()
    {
       
        if ($this->uri->segment(3) == null) {
            $this->session->set_flashdata('ermsg', "<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
            redirect(base_url() . 'trip_sheet');
        } else {
            $this->data['page_id'] = "trip_sheet";
            $this->data['page_title'] = "Update Store  | CargoAdmin";
            $data_cndtnx = array('status' => 0);
            $this->data['vehicles'] = $this->admin_model->get_all_data('vehicles', $data_cndtnx, 'id', 'DESC');

            
            $data_cndtny = array('type' => 'vendor', 'status' => 0);
            $this->data['vendor'] = $this->admin_model->get_all_data('branches', $data_cndtny, 'id', 'DESC'); 

            $data_cndtnx = array('id' => $this->uri->segment(3));
            $details = $this->admin_model->get_all_data('trip_sheet', $data_cndtnx, 'id', 'DESC');
            if ($details == false) {
                $this->session->set_flashdata('ermsg', "<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
                redirect(base_url() . 'trip_sheet');
            } else {
                $this->data["id"] = $details[0]->id;
                $this->data["trip_date"] = $details[0]->trip_date;
                $this->data["estimate_arrival_date"] = $details[0]->estimate_arrival_date;
                $this->data["trip_time"] = $details[0]->trip_time;                
                $this->data["vehicle_id"] = $details[0]->vehicle_id;
                $this->data["vehicle_number"] = $details[0]->vehicle_number;
                $this->data["vehicle_drivername"] = $details[0]->vehicle_drivername;
                $this->data["vehicle_drivermobilenumber"] = $details[0]->vehicle_drivermobilenumber;
                $this->data["helper_name"] = $details[0]->helper_name;
                $this->data["helper_mobilenumber"] = $details[0]->helper_mobilenumber;
                $this->data["start_km"] = $details[0]->start_km;
                $this->data["stop_km"] = $details[0]->stop_km;
                $this->data["total_km"] = $details[0]->total_km;
                $this->data["total_rent"] = $details[0]->total_rent;
                $this->data["exp_diesel"] = $details[0]->exp_diesel;
                $this->data["exp_batha"] = $details[0]->exp_batha;
                $this->data["exp_phone"] = $details[0]->exp_phone;
                $this->data["exp_toll"] = $details[0]->exp_toll;
                $this->data["exp_food"] = $details[0]->exp_food;
                $this->data["exp_other"] = $details[0]->exp_other;
                $this->data["exp_total"] = $details[0]->exp_total;
                $this->data["exp_advance"] = $details[0]->exp_advance;
                $this->data["balance_amt"] = $details[0]->balance_amt;
                $this->data["destination"] = $details[0]->destination;
                $this->data["branch_id"] = $details[0]->branch_id;
                $this->data["vendor_or_vehicle"] = $details[0]->vendor_or_vehicle;
                $this->data["vendor_name"] = $details[0]->vendor_name;
                $this->data["vendor_id"] = $details[0]->vendor_id;
                $this->data["vendor_location"] = $details[0]->vendor_location;
                $this->data["mobile"] = $details[0]->mobile;
                $this->data["authorized_person"] = $details[0]->authorized_person;
 
        //   print_r( $this->data );
        //   die; 
			

                $this->data["status"] = $details[0]->status;
                $this->load->view('head/header', $this->data);
                $this->load->view('trip_sheet/update');
                $this->load->view('head/footer');
            }
        }
    }

    public function update_process()
    {
        $uiid = $this->security->xss_clean($this->input->post('uid')); 


        if ($this->security->xss_clean($this->input->post('stop_km')) != null) {
            $stop_km = $this->security->xss_clean($this->input->post('stop_km'));
        } else {
            $stop_km = 0;
        }

        if ($this->security->xss_clean($this->input->post('start_km')) != null) {
            $start_km = $this->security->xss_clean($this->input->post('start_km'));
        } else {
            $start_km = 0;
        }
        if ($stop_km == 0) {
            $total_km = 0;
        } else {
            $total_km = $stop_km - $start_km;
        }
        if ($this->security->xss_clean($this->input->post('total_rent')) != null) {
            $total_rent = $this->security->xss_clean($this->input->post('total_rent'));
        } else {
            $total_rent = 0;
        }

        //exptotal
        if ($this->security->xss_clean($this->input->post('exp_diesel')) != null) {
            $exp_diesel = $this->security->xss_clean($this->input->post('exp_diesel'));
        } else {
            $exp_diesel = 0;
        }
        if ($this->security->xss_clean($this->input->post('exp_batha')) != null) {
            $exp_batha = $this->security->xss_clean($this->input->post('exp_batha'));
        } else {
            $exp_batha = 0;
        }
        if ($this->security->xss_clean($this->input->post('exp_phone')) != null) {
            $exp_phone = $this->security->xss_clean($this->input->post('exp_phone'));
        } else {
            $exp_phone = 0;
        }
        if ($this->security->xss_clean($this->input->post('exp_toll')) != null) {
            $exp_toll = $this->security->xss_clean($this->input->post('exp_toll'));
        } else {
            $exp_toll = 0;
        }
        if ($this->security->xss_clean($this->input->post('exp_food')) != null) {
            $exp_food = $this->security->xss_clean($this->input->post('exp_food'));
        } else {
            $exp_food = 0;
        }
        if ($this->security->xss_clean($this->input->post('exp_other')) != null) {
            $exp_other = $this->security->xss_clean($this->input->post('exp_other'));
        } else {
            $exp_other = 0;
        }
        $exp_total = $exp_diesel + $exp_batha + $exp_phone + $exp_toll + $exp_food + $exp_other;
        if ($this->security->xss_clean($this->input->post('exp_advance')) != null) {
            $exp_advance = $this->security->xss_clean($this->input->post('exp_advance'));
        } else {
            $exp_advance = 0;
        }


        if ($this->security->xss_clean($this->input->post('destination')) != null) {
            $destination = $this->security->xss_clean($this->input->post('destination'));
        } 
        
        if ($this->security->xss_clean($this->input->post('branch_id')) != null) {
            $branch_id = $this->security->xss_clean($this->input->post('branch_id'));
        } 


        


        $file_mimes = ['text/csv'];

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

			// print_r($sheetData);

			foreach ($sheetData as $val){

                preg_match('/[0-9]{10}/',  $val['6'], $phone);

				$datax=array(
					'company' =>       $val['0'],
                    'invoiceno' =>     $val['1'],
                    'pcs' =>           $val['2'],
					'weight' =>        $val['3'],
                    'district' =>      $val['4'],
					'date' =>          $val['5'],
                    'address' =>       $val['6'],
					'shipmentname' =>  $val['7'],
					'sendingdate' =>   $val['8'],
					'recievingdate' => $val['9'],
					'phone' =>         $phone[0],
					'created_at' =>    date('Y-m-d H:i:s'),
					'status' =>        0
				);
				$lstid = $this->crud_model->create_table_account('goods_details', $datax);
			}
		
			$this->session->set_flashdata('msgx',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> imported successfully.</div>");
		
		} 
        
        $balance_amount = $exp_total - $exp_advance;
        $vehicles_cndtnx = array('status' => 0, 'id' => $this->security->xss_clean($this->input->post('vehicle_number')));
        $vehicles_details = $this->admin_model->get_all_data('vehicles', $vehicles_cndtnx, 'id', 'DESC');
        if ($vehicles_details == false) {
            // $this->session->set_flashdata('msgx', "<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Vehicle Number Doesnot exist..!</div>");
            // redirect(base_url() . 'trip_sheet/update/' . $uiid);
            $vehicle_numberx = '';
        } else {
            $vehicle_numberx = $vehicles_details[0]->vehicle_number;
        }
        $datax = array(
            'trip_date' => $this->security->xss_clean($this->input->post('trip_date')),
            'estimate_arrival_date' => $this->security->xss_clean($this->input->post('estimate_arrival_date')),
            'trip_time' => $this->security->xss_clean($this->input->post('trip_time')),
            'vehicle_id' => $this->security->xss_clean($this->input->post('vehicle_number')),
            'vehicle_number' => $vehicle_numberx,
            'vehicle_drivername' => $this->security->xss_clean($this->input->post('vehicle_drivername')),
            'vehicle_drivermobilenumber' => $this->security->xss_clean($this->input->post('vehicle_drivermob')),
            'helper_name' => $this->security->xss_clean($this->input->post('helper_name')),
            'helper_mobilenumber' => $this->security->xss_clean($this->input->post('helper_mobilenumber')),
            'start_km' => $start_km,
            'stop_km' => $stop_km,
            'total_km' => $total_km,
            'total_rent' => $total_rent,
            'exp_diesel' => $exp_diesel,
            'exp_batha' => $exp_batha,
            'exp_phone' => $exp_phone,
            'exp_toll' => $exp_toll,
            'exp_food' => $exp_food,
            'exp_other' => $exp_other,
            'exp_total' => $exp_total,
            'exp_advance' => $exp_advance,
            'balance_amt' => $balance_amount,
            'destination' => $destination,
            'branch_id' => $branch_id,
            'created_at' => date('Y-m-d H:i:s'),
            'status' => $this->security->xss_clean($this->input->post('status')),
            'vendor_or_vehicle' => $this->security->xss_clean($this->input->post('vendor_or_vehicle')),
            'vendor_name' => $this->security->xss_clean($this->input->post('vendor_name')),
            'vendor_id' => $this->security->xss_clean($this->input->post('vendor_id')),
            'vendor_location' => $this->security->xss_clean($this->input->post('vendor_location')),
            'mobile' => $this->security->xss_clean($this->input->post('mobile')),
            'authorized_person' => $this->security->xss_clean($this->input->post('authorized_person')),
        );
     
       
        $lstid = $this->crud_model->edit_table_account('trip_sheet', $datax, $uiid, 'id');
        
        if($this->input->post('status') == 2 ){
            /*
          
            $this->crud_model->edit_table_account('trip_sheet_cargos', ['status' => 3, 'updated_at' => date('Y-m-d H:i:s')], $uiid, 'trip_sheet_id');
            $cols = "invoice_number,tracking_no";

            // $status = ['0'=> 'On the Way','1'=> 'Trip Started', '2'=> 'Trip Finished', '7'=>'Trip Created']; 
            $status = ['On the way', 'Out for Delivery', 'In Transit', 'Delivered','Pending','Not Delivered','Recheck']; 
            $trip_sheet_cargos_list = $this->crud_model->all_datas_selected_columns('trip_sheet_cargos',  $uiid , 'trip_sheet_id', $cols);     
 
            foreach( $trip_sheet_cargos_list as $trip_sheet_cargos) {             
                $goods_status_data = array(  
                    'invoice_number'=>$trip_sheet_cargos->invoice_number,
                    'trip_sheet_id' => $uiid,
                    'goods_status' => $status[3],
                    'filename' => null,
                    'in_transit_url' => null,
                    'message' =>  null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'tracking_no' =>$trip_sheet_cargos->tracking_no,
                    'branch_id' => $this->session->userdata['adminloginel']['id'],
                );
        
                $lstid = $this->crud_model->create_table_account('goods_status', $goods_status_data); 

                $change_goods_details = array(
                    'goods_status' => $status[3]  ,
                    'current_status_id' =>  $lstid 
                );
                $this->crud_model->edit_table_account('goods_details', $change_goods_details,  $trip_sheet_cargos->invoice_number, 'invoiceno');            
            }  */
            
        }

         
        

        $this->session->set_flashdata('msgx', "<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> Updated successfully.</div>");
        redirect(base_url() . 'trip_sheet/update/' . $uiid);
    }

    public function delete_process()
    {
        if ($this->uri->segment(3) == null) {
            $this->session->set_flashdata('ermsg', "<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
            redirect(base_url() . 'trip_sheet');
        } else {
            $dat = $this->admin_model->delete_table_account('trip_sheet', $this->uri->segment(3), 'id');
            $this->session->set_flashdata('ermsg', "<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Deleted successfully..!.</div>");
            redirect(base_url() . 'trip_sheet');
        }
    }

    public function print()
    { 
        if ($this->uri->segment(3) == null) {
            $this->session->set_flashdata('ermsg', "<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
            redirect(base_url() . 'trip_sheet');
        } else {
            $this->data['page_id'] = "trip_sheet";
            $this->data['page_title'] = "Print Trip Sheet";
 
            $data_cndtnx = array('status' => 0);
            $this->data['vehicles'] = $this->admin_model->get_all_data('vehicles', $data_cndtnx, 'id', 'DESC');
            $data_cndtnx = array('id' => $this->uri->segment(3));
            $details = $this->admin_model->get_all_data('trip_sheet', $data_cndtnx, 'id', 'DESC');

            // print_r($details);die;
            if ($details == false) {
                $this->session->set_flashdata('ermsg', "<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
                redirect(base_url() . 'trip_sheet');
            } else {
                $data_cndtnx = array('trip_sheet_cargos.trip_sheet_id' => $this->uri->segment(3));
                $this->data['trip_sheet_cargos'] = $this->admin_model->get_all_data_print('trip_sheet_cargos', $data_cndtnx, 'trip_sheet_cargos.sort_order', 'ASC');
                $this->data["id"] = $details[0]->id;
                $this->data["trip_sheet_name"] = $details[0]->trip_sheet_name;                
                $this->data["trip_date"] = $details[0]->trip_date;
                $this->data["trip_time"] = $details[0]->trip_time;
                $this->data["header"] = $details[0]->header;
                $this->data["vehicle_id"] = $details[0]->vehicle_id;
                $this->data["vehicle_number"] = $details[0]->vehicle_number;
                $this->data["vehicle_drivername"] = $details[0]->vehicle_drivername;
                $this->data["vehicle_drivermobilenumber"] = $details[0]->vehicle_drivermobilenumber;
                $this->data["helper_name"] = $details[0]->helper_name;
                $this->data["helper_mobilenumber"] = $details[0]->helper_mobilenumber;
                $this->data["start_km"] = $details[0]->start_km;
                $this->data["stop_km"] = $details[0]->stop_km;
                $this->data["total_km"] = $details[0]->total_km;
                $this->data["total_rent"] = $details[0]->total_rent;
                $this->data["exp_diesel"] = $details[0]->exp_diesel;
                $this->data["exp_batha"] = $details[0]->exp_batha;
                $this->data["exp_phone"] = $details[0]->exp_phone;
                $this->data["exp_toll"] = $details[0]->exp_toll;
                $this->data["exp_food"] = $details[0]->exp_food;
                $this->data["exp_other"] = $details[0]->exp_other;
                $this->data["exp_total"] = $details[0]->exp_total;
                $this->data["exp_advance"] = $details[0]->exp_advance;
                $this->data["balance_amt"] = $details[0]->balance_amt;

                // echo "<pre>";
                // echo  count($this->data['trip_sheet_cargos']);
                // print_r($this->data['trip_sheet_cargos']);
                // echo "</pre>";
                // die;
                $this->data["status"] = $details[0]->status;
                $this->load->view('head/header', $this->data);
                $this->load->view('trip_sheet/print');
                $this->load->view('head/footer');
            }
        }
    }


    public function cargos_other_state()
    {
        $data['details'] = $this->admin_model->list_invoice_numbers();
        $this->data['page_id'] = "trip_sheet";
        $this->data['page_title'] = "All trip sheet cargo lists  | CargoAdmin";
        $config = array();
        $searchqry = array();
        $branch_id = $this->session->userdata['adminloginel']['id'];
        $data_cndtn = array('trip_sheet_cargos.trip_sheet_id' => $this->uri->segment(3) );
        if(isset($_GET['status']) && $_GET['status']!=null && $_GET['status']!='all'){
        	$data_cndtn['trip_sheet_cargos.status']=$_GET['status'];
        }
        // if(isset($_GET['vehicle_number']) && $_GET['vehicle_number']!=null && $_GET['vehicle_number']!='all'){
        // 	$data_cndtn['vehicle_id']=$_GET['vehicle_number'];
        // }


        if(isset($_GET['serachq']) && $_GET['serachq']!=null){
			if($_GET['serachq'] == 'state') {                 
				if(isset($_GET['inptvalue']) && $_GET['inptvalue']!=null && $_GET['inptvalue']!=''){ 
					if(empty($searchqry)){
						 $searchqry= 'goods_details.state Like  "%' .  $_GET['inptvalue'] .'%"';
					} 					 
				} 
			}           
		}

        // print_r($searchqry);
        // die;

        $config["base_url"] = base_url() . "trip_sheet/cargos_other_state";
        // $total_row = $this->admin_model->count_all_data_condition_ordersearch('trip_sheet_cargos', $data_cndtn, 'id', 'DESC', $searchqry); 
        $total_row = $this->admin_model->count_get_all_data_condition_ordersearch_cargos('trip_sheet_cargos', $data_cndtn, 'trip_sheet_cargos.sort_order', 'ASC', $searchqry);
        // echo  $total_row;
        // die();

        $config["total_rows"] = $total_row;
        $config["per_page"] = 1000;
        $config['use_page_numbers'] = TRUE;
        $config["suffix"] = '?' . http_build_query($_GET, '', "&");
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
        $page = 1;
        $this->data["result"] = $this->admin_model->get_all_data_condition_ordersearch_cargos('trip_sheet_cargos', $data_cndtn, $config["per_page"], $page, 'trip_sheet_cargos.sort_order', 'ASC', $searchqry);

  
        
        // $str_links = $this->pagination->create_links();
        // $this->data["links"] = explode('&nbsp', $str_links);
        $this->data["links"] = $this->pagination->create_links();
        $data_cndtnx = array('status' => 0);
        $this->data['cargos'] = $this->admin_model->get_all_data('cargo', $data_cndtnx, 'created_at','ASC');
        
        if ($this->uri->segment(4)) {
            $data_cndtnxx = array('id' => $this->uri->segment(4));
            $trip_sheet_cargosdtls = $this->admin_model->get_all_data('trip_sheet_cargos', $data_cndtnxx, 'id', 'DESC');

         
            if ($trip_sheet_cargosdtls == false) {
                $this->session->set_flashdata('ermsg', "<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>data not found..!.</div>");
                redirect(base_url() . 'trip_sheet/cargos/' . $this->uri->segment(3));
            } else {
                $this->data['trip_sheet_cargosdtls'] = $trip_sheet_cargosdtls;
            }
        }
        $this->load->view('head/header', $this->data);
        $this->load->view('trip_sheet/trip_sheet_cargos/other_state',$data);
        $this->load->view('head/footer');
    }


    public function get_invoices(){

        $input = $this->input->post('input');
		$branch_id = $this->session->userdata['adminloginel']['id'];
 
        $condition =array('branch_id' =>$branch_id);
        $res = $this->admin_model->list_invoice_numbers_by($input, $condition);

        echo json_encode($res);

    }

    
    public function cargos()
    {
        $data['details'] = $this->admin_model->list_invoice_numbers();
        $this->data['page_id'] = "trip_sheet";
        $this->data['page_title'] = "All trip sheet cargo lists  | CargoAdmin";
        $config = array();
        $searchqry = array();
        $branch_id = $this->session->userdata['adminloginel']['id'];

        $data_cndtn = array('trip_sheet_cargos.trip_sheet_id' => $this->uri->segment(3) );
        if(isset($_GET['status']) && $_GET['status']!=null && $_GET['status']!='all'){
        	$data_cndtn['trip_sheet_cargos.status']=$_GET['status'];
        }
        // if(isset($_GET['vehicle_number']) && $_GET['vehicle_number']!=null && $_GET['vehicle_number']!='all'){
        // 	$data_cndtn['vehicle_id']=$_GET['vehicle_number'];
        // }
        $config["base_url"] = base_url() . "trip_sheet/index";
        $total_row = $this->admin_model->count_all_data_condition_ordersearch('trip_sheet_cargos', $data_cndtn, 'id', 'DESC', $searchqry);
        $config["total_rows"] = $total_row;
        $config["per_page"] = 1000;
        $config['use_page_numbers'] = TRUE;
        $config["suffix"] = '?' . http_build_query($_GET, '', "&");
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
        $page = 1;
        // $this->data["result"] = $this->admin_model->get_all_data_condition_ordersearch('trip_sheet_cargos', $data_cndtn, $config["per_page"], $page, 'created_at', 'ASC', $searchqry);
        $this->data["result"] = $this->admin_model->get_all_data_condition_ordersearch_cargos('trip_sheet_cargos', $data_cndtn, $config["per_page"], $page, 'trip_sheet_cargos.sort_order', 'ASC', $searchqry);
// echo "<pre>";
    //    print_r( $data_cndtn);
// echo "</pre>";
// echo $this->db->last_query();
    //    die;
    
    //    $str_links = $this->pagination->create_links();
    //     $this->data["links"] = explode('&nbsp', $str_links);
        $this->data["links"] = $this->pagination->create_links();
        $data_cndtnx = array('status' => 0);
        $this->data['cargos'] = $this->admin_model->get_all_data('cargo', $data_cndtnx, 'created_at','ASC');


        // echo "<pre>";
        // print_r(  $this->data['result'][0]);
        // echo "</pre>";
        // die;
        
        if ($this->uri->segment(4)) {
             
            $data_cndtnxx = array('id' => $this->uri->segment(4));
            $trip_sheet_cargosdtls = $this->admin_model->get_all_data('trip_sheet_cargos', $data_cndtnxx, 'id', 'DESC');


           
            if ($trip_sheet_cargosdtls == false) {
                $this->session->set_flashdata('ermsg', "<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>data not found..!.</div>");
                redirect(base_url() . 'trip_sheet/cargos/' . $this->uri->segment(3));
            } else {
                $this->data['trip_sheet_cargosdtls'] = $trip_sheet_cargosdtls;
            }
        } 
        $this->load->view('head/header', $this->data);
        $this->load->view('trip_sheet/trip_sheet_cargos/index',$data);
        $this->load->view('head/footer');
    }

/*
    public function cargo_create_process()
    { 

        $tracking_no = $this->security->xss_clean($this->input->post('tracking_no'));
        $uid = $this->security->xss_clean($this->input->post('trip_sheet_id'));
        $branch_id = $this->session->userdata['adminloginel']['id'];
       
       // $cargos_cndtnx = array('status' => 0, 'id' => $this->security->xss_clean($this->input->post('cargo_name')));
        $cargos_cndtnx = array('status' => 0);
        $cargos_details = $this->admin_model->get_all_data('cargo', $cargos_cndtnx, 'id', 'DESC');

        $cndtnx  = array('tracking_no' =>  $tracking_no);
        $goods_details = $this->admin_model->get_all_goods_details('goods_details', $cndtnx);
        
        //    echo "<pre>";
        //    print_r( $goods_details );
        //    echo "</pre>";
        //    die;

       foreach( $goods_details as $goods ) {

            $datax = array(
                'invoice_number' => $goods->invoiceno,
                'trip_sheet_id' => $uid,
                'cargo_id' => $goods->company,
                'mobilenumber' => $goods->phone,
                'cargo_name' =>  $goods->company,
                'place' => $goods->district,
                'quantity' =>$goods->pcs,
                'weight' =>$goods->weight,
                'created_at' => date('Y-m-d H:i:s'),
                'status' => $this->security->xss_clean($this->input->post('status')),
                'tracking_no' => $goods->tracking_no,            
                'branch_id' => $goods->branch_id
            );

            // echo "<pre>";
            // print_r(   $datax) ;
            // echo "</pre>";

             $lstid = $this->crud_model->create_table_account('trip_sheet_cargos', $datax);


 
            $status = ['On the way', 'Out for Delivery', 'In Transit', 'Delivered','Pending','Not Delivered','Recheck'];
            $change_goods_details = array(
                'goods_status' => $status[$this->security->xss_clean($this->input->post('status'))]
            );
            

            $goods_status_data = array(
                'invoice_number'=> $goods->invoiceno,
                'trip_sheet_id'=>$uid,
                'goods_status' =>  $status[$this->security->xss_clean($this->input->post('status'))],
                'tracking_no' => $tracking_no,            
                'filename' => null,
                'in_transit_url' => null,
                'branch_id' => $this->session->userdata['adminloginel']['id'],
                'created_at' => date('Y-m-d H:i:s')        );

           

            $lstid = $this->crud_model->create_table_account('goods_status', $goods_status_data); 


            $invoicenumber =  $goods->invoiceno; //$this->security->xss_clean($this->input->post('invhid'));
            $this->crud_model->edit_table_account('goods_details', $change_goods_details, $invoicenumber, 'invoiceno'); 


       } 
      
       
        $this->session->set_flashdata('msgx', "<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> Cargo added successfully.</div>");
        redirect(base_url() . 'trip_sheet/cargos/' . $uid);

    }
*/



public function add_good_cargos()
{ 
    
    $uid = $this->security->xss_clean($this->input->post('trip_sheet_id'));
    $cndtny  = array('id' =>  $uid);
    $trip_sheet = $this->admin_model->get_all_goods_details('trip_sheet', $cndtny); 

 
            
        if( $this->input->post('sel_goods_id_cargos') !='') { 
            $selGoodsId = explode(',',$this->security->xss_clean($this->input->post('sel_goods_id_cargos')));    
           
         
            foreach( $selGoodsId as $goodsId ) { 
                $uid = $this->security->xss_clean($this->input->post('trip_sheet_id'));
                $branch_id = $this->session->userdata['adminloginel']['id']; 
                $cndtnx  = array('id' =>  $goodsId);
                $goods_details = $this->admin_model->get_all_goods_details('goods_details', $cndtnx);               
              

                foreach( $goods_details as $goods ) {
 
                    $status = ['On the way', 'Out for Delivery', 'In Transit', 'Delivered','Pending','Not Delivered','Recheck'];

                    $tracking_no = $goods->tracking_no;
                    $branch_id = $goods->branch_id;

                    $goods_status_data = array(
                        'invoice_number'=> $goods->invoiceno,
                        'trip_sheet_id'=>$uid,
                        'goods_status' =>  $status[ 1 ],
                        'tracking_no' => $tracking_no,            
                        'filename' => null,
                        'in_transit_url' => null,
                        'branch_id' =>  $branch_id,
                        'created_at' => date('Y-m-d H:i:s')        
                    );
                    $current_status_id = $this->crud_model->create_table_account('goods_status', $goods_status_data);

                    $datax = array(
                        'goods_id'=>  $goods->id,
                        'trip_no'=>  $goods->trip_no,
                        'sort_order' =>  $goods->sort_order,
                        'invoice_number' => $goods->invoiceno,
                        'trip_sheet_id' => $uid,
                        'tracking_no' => $goods->tracking_no,            
                        'cargo_id' => $goods->company,
                        'cargo_name' =>  $goods->company,
                        'place' => $goods->district,
                        'address' => $goods->address,
                        'shipment_name' => $goods->shipmentname,
                        'lr_no' => $goods->docket,
                        'tracking_url' => $goods->url,
                        'mobilenumber' => $goods->phone,
                        'quantity' =>$goods->pcs,
                        'status' => 1,
                        'weight' =>$goods->weight,
                        'message' =>$goods->remarks,
                        'branch_id' => $goods->branch_id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'current_status_id' =>  $current_status_id

                    );
 
                    $lstid2 = $this->crud_model->create_table_account('trip_sheet_cargos', $datax); 
                     
                    
                    $datax = array(
                        'trip_sheet_id' => $uid ,
                        'current_status_id' =>  $current_status_id,
                        // 'goods_status' => $status[1], 
                    );
                    $lstid = $this->crud_model->edit_table_account('goods_details', $datax, $goodsId, 'id');     
                    $lstid = $this->crud_model->edit_table_account('shipment_details', $datax, $goodsId, 'id');     
                    
                    // $change_goods_details = array(                       
                    // );
                    // $invoicenumber =  $goods->invoiceno; //$this->security->xss_clean($this->input->post('invhid'));
                    // $this->crud_model->edit_table_account('goods_details', $change_goods_details, $invoicenumber, 'invoiceno');                     
                    // echo $this->db->last_query();
                    // die($lstid );
                } 
            }
         
            //REsetting the checked values 
              $this->admin_model->reset_checked('goods_details', $branch_id );
 
            $this->session->set_flashdata('msgx', "<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> Cargo added successfully.</div>");

            if( $trip_sheet[0]->destination == "other_state" ) { 
                redirect(base_url() . 'trip_sheet/cargos_other_state/' . $uid);
            } else {
                redirect(base_url() . 'trip_sheet/cargos/' . $uid);
            }

          
        } else {

          

            $this->session->set_flashdata('msgx', "<div class='alert alert-error'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>
            Please select goods.</div>");

            if( $trip_sheet[0]->destination == "other_state" ) { 
                redirect(base_url() . 'trip_sheet/cargos_other_state/' . $uid);
            } else {
                redirect(base_url() . 'trip_sheet/cargos/' . $uid);
            }
          
        }
 
}


     
    public function cargo_update_process()
    {
        $uid = $this->security->xss_clean($this->input->post('trip_sheet_id'));
        $uidcargo = $this->security->xss_clean($this->input->post('trip_sheet_cargo_id'));
        $cargos_cndtnx = array('status' => 0, 'id' => $this->security->xss_clean($this->input->post('cargo_name')));
        $cargos_details = $this->admin_model->get_all_data('cargo', $cargos_cndtnx, 'id', 'DESC');
        if ($cargos_details == false) {
            $this->session->set_flashdata('msgx', "<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Cargo name not exist..!</div>");
            redirect(base_url() . 'trip_sheet/cargos/' . $uid . '/' . $uidcargo);
        } else {
            $cargo_namex = $cargos_details[0]->cargo_name;
        }
        $datax = array(
            'invoice_number' => $this->security->xss_clean($this->input->post('invoice_number')),
            'trip_sheet_id' => $uid,
            'cargo_id' => $this->security->xss_clean($this->input->post('cargo_id')),
            'cargo_name' => $this->security->xss_clean($this->input->post('cargo_name')),
            'mobilenumber' => $this->security->xss_clean($this->input->post('mobilenumber')),
            'place' => $this->security->xss_clean($this->input->post('place')),
            'quantity' => $this->security->xss_clean($this->input->post('quantity')),
            'weight' => $this->security->xss_clean($this->input->post('weight')),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $lstid = $this->crud_model->edit_table_account('trip_sheet_cargos', $datax, $uidcargo, 'id');
        $this->session->set_flashdata('msgx', "<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> Updated successfully.</div>");
        redirect(base_url() . 'trip_sheet/cargos/' . $uid . '/' . $uidcargo);
    }

    public function cargo_change_status()
    {
       
        $uidcargo = $this->security->xss_clean($this->input->post('cargo_id'));
        $invoicenumber = $this->security->xss_clean($this->input->post('invoiceno'));
        $tripsheet_id = $this->security->xss_clean($this->input->post('tripsheet_id'));        
        $in_transit_url = $this->security->xss_clean($this->input->post('in_transit_url'));
        $deliveryDate = $this->security->xss_clean($this->input->post('deliveryDate'));      

        if(!empty($deliveryDate)){ 
           $created_date = date('Y-m-d H:i:s', strtotime($deliveryDate));  
        }else { 
            $created_date = date('Y-m-d H:i:s');
        }
        

        $filename_with_path ='';
        $filename = '';
        $file_name = '';

        if(!empty($_FILES['file']['name'])){ 

            
            $file_name = $_FILES['file']['name'];
            $Extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $ref= $this->session->userdata('userID').time ();//changes
            $fileName = $ref . '.' . $Extension;

            
            $this->load->library('image_lib');
            // Set preference 
            $config['upload_path'] = 'assets/uploads/delivery'; 
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf'; 
            $config['max_size'] = '10000'; // max_size in kb 
            $config['file_name'] = $fileName; 
   
            // Load upload library 
            $this->load->library('upload',$config); 


      
            // File upload
            $filename_with_path ='';
            if($this->upload->do_upload('file')){ 

                $image_data =   $this->upload->data();
                $configer =  array(
                  'image_library'   => 'gd2',
                  'source_image'    =>  $image_data['full_path'],
                  'maintain_ratio'  =>  TRUE,
                  'width'           =>  500,
                  'height'          =>  500,
                );
                $this->image_lib->clear();
                $this->image_lib->initialize($configer);
                $this->image_lib->resize();

                $data['response'] = 'successfully uploaded '.$fileName; 

               $filename_with_path = base_url().$config['upload_path']."/".$fileName;
            }else{ 

                $error = array('error' => $this->upload->display_errors());
                
               $data['response'] = 'failed'; 
            } 
         }  
 
        
       
        $status = ['On the way', 'Out for Delivery', 'In Transit', 'Delivered','Pending','Not Delivered','Recheck'];
       

        $goods_status_data = array(
            'invoice_number'=>$invoicenumber,
            'trip_sheet_id' => $tripsheet_id,
            'goods_status' => $status[$this->security->xss_clean($this->input->post('status'))],
            'tracking_no' => $this->security->xss_clean($this->input->post('tracking_no')),
            'filename' => $filename_with_path,
            'in_transit_url' => $in_transit_url,
            'message' =>  $this->security->xss_clean($this->input->post('comment')),
            'branch_id' => $this->session->userdata['adminloginel']['id'],
            'created_at' =>   $created_date
        );

        $lstid = $this->crud_model->create_table_account('goods_status', $goods_status_data); 

        $change_goods_details = array(
            'current_status_id' =>  $lstid
        ); 
   
        $this->crud_model->edit_table_account('goods_details', $change_goods_details, $invoicenumber, 'invoiceno');
        $this->crud_model->edit_table_account('shipment_details', $change_goods_details, $invoicenumber, 'invoiceno');


        $datax = array(
            'updated_at' => date('Y-m-d H:i:s'),
            'status' => $this->security->xss_clean($this->input->post('status')),
            'message' => $this->security->xss_clean($this->input->post('comment')),
            'current_status_id' =>  $lstid
        );        
        
        $lstid =$this->crud_model->edit_table_account('trip_sheet_cargos', $datax, $uidcargo, 'id');
      

        $this->session->set_flashdata('msgx', "<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> Status Changed successfully.</div>");
        //redirect(base_url().'trip_sheet/cargos/'.$uid.'/'.$uidcargo);
        redirect($_SERVER['HTTP_REFERER']);
    }


    public function cargo_change_status_selected()
    {
        $uidcargo = explode(',',$this->security->xss_clean($this->input->post('sel_cargo_id')));
        $tripsheet_id = $this->security->xss_clean($this->input->post('sel_tripsheet_id'));        
        $in_transit_url = $this->input->post('sel_in_transit_url') ? $this->security->xss_clean($this->input->post('sel_in_transit_url')) :null;  
        
        $filename_with_path ='';

        $filename = '';
        $file_name = '';


        if(!empty($_FILES['sel_file']['name'])){ 
    
                
            $file_name = $_FILES['sel_file']['name'];
            $Extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $ref= $this->session->userdata('userID').time ();//changes
            $fileName = $ref . '.' . $Extension;

            $this->load->library('image_lib');
            // Set preference 
            $config['upload_path'] = 'assets/uploads/delivery'; 
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf'; 
            $config['max_size'] = '10000'; // max_size in kb 
            $config['file_name'] = $fileName; 
   
            // Load upload library 
            $this->load->library('upload',$config);    
      
            // File upload
            $filename_with_path ='';
            if($this->upload->do_upload('sel_file')){ 
               // Get data about the file
            //    $uploadData = $this->upload->data();     
               
               $image_data =   $this->upload->data();
               $configer =  array(
                 'image_library'   => 'gd2',
                 'source_image'    =>  $image_data['full_path'],
                 'maintain_ratio'  =>  TRUE,
                 'width'           =>  500,
                 'height'          =>  500,
               );
               $this->image_lib->clear();
               $this->image_lib->initialize($configer);
               $this->image_lib->resize();


               $data['response'] = 'successfully uploaded '.$fileName;     
               $filename_with_path = base_url().$config['upload_path']."/".$fileName;
            }else{ 

                $error = array('error' => $this->upload->display_errors());                    
                $data['response'] = 'failed'; 
            } 
         } 

         
        foreach($uidcargo as $invoiceNo) {

        
          
             
     
             $data_cndtn=array('invoiceno'=>  $invoiceNo);
             $data = $this->admin_model->get_all_goods_details("goods_details",$data_cndtn); 
             $tracking_no = $data[0]->tracking_no;            
            
            $status = ['On the way', 'Out for Delivery', 'In Transit', 'Delivered','Pending','Not Delivered','Recheck']; 
          
            
                $goods_status_data = array(
                    'invoice_number'=>$invoiceNo,
                    'trip_sheet_id' => $tripsheet_id,
                    'goods_status' => $status[$this->security->xss_clean($this->input->post('sel_status'))],
                    'filename' => $filename_with_path,
                    'in_transit_url' => $in_transit_url,
                    'message' =>  $this->security->xss_clean($this->input->post('sel_comment')),
                    'created_at' => date('Y-m-d H:i:s'),
                    'tracking_no' =>$tracking_no,
                    'branch_id' => $this->session->userdata['adminloginel']['id'],
                ); 
        
                $lstid = $this->crud_model->create_table_account('goods_status', $goods_status_data); 
                
                $change_goods_details = array(
                    'current_status_id' =>  $lstid
                ); 
            
                $this->crud_model->edit_table_account('goods_details', $change_goods_details, $invoiceNo, 'invoiceno');
                $this->crud_model->edit_table_account('shipment_details', $change_goods_details, $invoiceNo, 'invoiceno');

                $datax = array(
                    'updated_at' => date('Y-m-d H:i:s'),
                    'status' => $this->security->xss_clean($this->input->post('sel_status')),
                    'message' => $this->security->xss_clean($this->input->post('sel_comment')),
                    'current_status_id' =>  $lstid
                );
            
                $lstid =$this->crud_model->edit_table_account('trip_sheet_cargos', $datax, $invoiceNo, 'invoice_number');
                 

        }

        $this->session->set_flashdata('msgx', "<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> Status Changed successfully.</div>");
        //redirect(base_url().'trip_sheet/cargos/'.$uid.'/'.$uidcargo);
        redirect($_SERVER['HTTP_REFERER']);       
         
    }


    public function cargos_delete_process()
    {
        if ($this->uri->segment(4) == null) {
            $this->session->set_flashdata('ermsg', "<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
            redirect(base_url() . 'trip_sheet/cargos/' . $this->uri->segment(3));
        } else {

            $data_cndtny = array('id' =>  $this->uri->segment(4)  ); 
            $trip_sheet_cargos = $this->admin_model->get_all_data('trip_sheet_cargos', $data_cndtny, 'id', 'DESC');
            $datax = array('trip_sheet_id' =>   NULL , 'current_status_id' => NULL );
            $lstid =$this->crud_model->edit_table_account('goods_details', $datax,  $trip_sheet_cargos[0]->invoice_number, 'invoiceno');  
            $lstid =$this->crud_model->edit_table_account('shipment_details', $datax,  $trip_sheet_cargos[0]->invoice_number, 'invoiceno');  

            $dat = $this->admin_model->delete_table_account('trip_sheet_cargos', $this->uri->segment(4), 'id');
            
            // delete goods_status table entries 
            // $condition = array( 
            //             'tracking_no' => $trip_sheet_cargos[0]->tracking_no,
            //             'invoice_number' => $trip_sheet_cargos[0]->invoice_number
            //             );
            // $dat = $this->admin_model->delete_table_account_multiple_cdn('goods_status', $condition );
            $this->session->set_flashdata('ermsg', "<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Deleted successfully..!.</div>");
            
            redirect(base_url() . 'trip_sheet/cargos/' . $this->uri->segment(3));
                    
        }
    }


    public function cargos_delete_process_other_state()
    {
        if ($this->uri->segment(4) == null) {
            $this->session->set_flashdata('ermsg', "<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Data not found..!</div>");
            redirect(base_url() . 'trip_sheet/cargos_other_state/' . $this->uri->segment(3));
        } else {
                       
            $data_cndtny = array('id' =>  $this->uri->segment(4)  ); 
            $trip_sheet_cargos = $this->admin_model->get_all_data('trip_sheet_cargos', $data_cndtny, 'id', 'DESC');
            $datax = array('trip_sheet_id' =>   NULL , 'current_status_id' => NULL );
            $lstid =$this->crud_model->edit_table_account('goods_details', $datax,  $trip_sheet_cargos[0]->invoice_number, 'invoiceno'); 
            $lstid =$this->crud_model->edit_table_account('shipment_details', $datax,  $trip_sheet_cargos[0]->invoice_number, 'invoiceno'); 

            $dat = $this->admin_model->delete_table_account('trip_sheet_cargos', $this->uri->segment(4), 'id');

            // $condition = array( 
            //     'tracking_no' => $trip_sheet_cargos[0]->tracking_no,
            //     'invoice_number' => $trip_sheet_cargos[0]->invoice_number
            //     );
            // $dat = $this->admin_model->delete_table_account_multiple_cdn('goods_status', $condition );

            $this->session->set_flashdata('ermsg', "<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>Deleted successfully..!.</div>");

            redirect(base_url() . 'trip_sheet/cargos_other_state/' .  $this->uri->segment(3));                    
        }
    }



    public function reports()
    {
        $this->data['page_id']      = "reports";
        $this->data['page_title']   = "Reports  | CargoAdmin";
        $branch_id                  = $this->session->userdata['adminloginel']['id'];
        $config         = array(); 
        $searchqry      = [];
        $data_cndtn     = array();

        if (isset($_GET['invoice_number']) && $_GET['invoice_number'] != null) { 
            $searchqry = array_merge($searchqry,array("shipment_details.invoiceno"=>$_GET['invoice_number'] ));
        }
        if (isset($_GET['cargo_name']) && $_GET['cargo_name'] != null && $_GET['cargo_name'] != 'all') {
            $searchqry = array_merge($searchqry,array("trip_sheet_cargos.cargo_name"=>$_GET['cargo_name'] ));
        }
        if(isset($_GET['vehicle_number']) && $_GET['vehicle_number']!=null && $_GET['vehicle_number']!='all') {        	 
            $searchqry = array_merge($searchqry,array("trip_sheet_cargos.vehicle_id"=>$_GET['vehicle_id'] ));
        }
      
        // $searchqry          = array_merge($searchqry,array("shipment_details.branch_id" => $branch_id ));

        $join_cond          = 'trip_sheet_cargos.branch_id = branches.id';
        $config["base_url"] = base_url() . "trip_sheet/reports";
        $total_row          =  $this->admin_model->get_reports_count( $searchqry );

        $config["total_rows"]       = $total_row;
        $config["per_page"]         = 100;
        $config['use_page_numbers'] = TRUE;
        $config["suffix"]           = '?' . http_build_query($_GET, '', "&");
        $config['num_links']        = 10;
        $config['num_tag_open']     = '<a style="color: #fff;border-color: #337ab7;border-radius: 3px;padding:5px;">';
        $config['num_tag_close']    = '</a>';
		$config['full_tag_open']    = '<ul class="pagination">';        
		$config['full_tag_close']   = '</ul>';        
		$config['first_link']       = 'First';        
		$config['last_link']        = 'Last';        
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';        
		$config['first_tag_close']  = '</span></li>';        
		$config['prev_link']        = '&laquo';        
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';        
		$config['prev_tag_close']   = '</span></li>';        
		$config['next_link']        = '&raquo';        
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';        
		$config['next_tag_close']   = '</span></li>';        
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';        
		$config['last_tag_close']   = '</span></li>';        
		$config['cur_tag_open']     = '<li class="page-item active"><a class="page-link" href="#">';        
		$config['cur_tag_close']    = '</a></li>';        
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';        
		$config['num_tag_close']    = '</span></li>';

        $this->pagination->initialize($config);

        if($this->uri->segment(3))  {
			$page = ($this->uri->segment(3)) ;
		} else {
			$page = 1;
		} 
        $this->data["links"]    = $this->pagination->create_links();
        $data_cndtnx            = array('status' => 0);
  
        if ($this->uri->segment(4)) {
            $data_cndtnxx           = array( 'id' => $this->uri->segment(4));
            $trip_sheet_cargosdtls  = $this->admin_model->get_all_data('trip_sheet_cargos', $data_cndtnxx, 'id', 'DESC');
            if ($trip_sheet_cargosdtls == false) {
                $this->session->set_flashdata('ermsg', "<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i>data not found..!.</div>");
                redirect(base_url() . 'trip_sheet/cargos/' . $this->uri->segment(3));
            } else {
                $this->data['trip_sheet_cargosdtls'] = $trip_sheet_cargosdtls;
            }
        }
        $data_cndtnx    = array('status' => 0);
        $data_cndtnxy   = array('status' => 0);
        $data['result'] = $this->admin_model->get_reports($searchqry ,$config["per_page"], $page);

        // echo $this->db->last_query();
        // die;
        $data['vehicles']       = $this->admin_model->get_all_data('vehicles', $data_cndtnx, 'id', 'DESC');
        $data['cargos']         = $this->admin_model->get_all_data('cargo', $data_cndtnxy, 'id', 'DESC');
        $data_cndtnx            = array('status' => 0);
        $this->data['vehicles'] = $this->admin_model->get_all_data('vehicles', $data_cndtnx, 'id', 'DESC');
        $this->data['cargos']   = $this->admin_model->get_all_data('cargo', $data_cndtnxy, 'id', 'DESC');

        $this->load->view('head/header', $this->data);
        $this->load->view('trip_sheet/reports/index',$data);
        $this->load->view('head/footer');
    }

    public function display_details(){
       
        $inv=$this->input->post('inv');
        $det = $this->admin_model->display_details($inv);
        echo json_encode($det);  
       
    }

    public function misreports(){
        $this->data['page_id'] = "misreports";
        $this->data['page_title'] = "Mis Reports  | CargoAdmin";
        $data_cndtnxy = array('status' => 0);
        $data['shipments'] = $this->admin_model->get_all_data('goods_details', $data_cndtnxy, 'id', 'DESC');
        $this->load->view('head/header', $this->data);
        $this->load->view('trip_sheet/misreports',$data);
        $this->load->view('head/footer');
    }


    public function pendingInvoice(){
        $this->data['page_id'] = "pendingInvoice";
        $this->data['page_title'] = "Pending Invoice  | CargoAdmin";
       

        $branch_id = $this->session->userdata['adminloginel']['id'];
		$data_cndtnx = array('trip_sheet_cargos.status' => 4);   //pending - 4
		$pending_invoices = $this->admin_model->get_all_invoice_by_status('trip_sheet_cargos',$data_cndtnx, $branch_id, 'trip_sheet_cargos.branch_id'); 
        $datas['pending_invoices'] = $pending_invoices;
   
 
        $this->load->view('head/header', $this->data);
        $this->load->view('trip_sheet/pending_invoice',$datas);
        $this->load->view('head/footer');
    }

    public function notDeliveredInvoice(){
        $this->data['page_id'] = "notdeliveredInvoice";
        $this->data['page_title'] = "Not Delivered Invoice  | CargoAdmin";

        $branch_id = $this->session->userdata['adminloginel']['id']; 
		$data_cndtny = array('trip_sheet_cargos.status' => 5);   //Not delivered  - 5
		$not_delivered_invoices = $this->admin_model->get_all_invoice_by_status('trip_sheet_cargos', $data_cndtny,$branch_id, 'trip_sheet_cargos.branch_id');
        $datas['not_delivered_invoices'] = $not_delivered_invoices;

        
     
        $this->load->view('head/header', $this->data);
        $this->load->view('trip_sheet/not_delivered',$datas);
        $this->load->view('head/footer');
    }

    function download_pod($current_status_id){

        $data_cndtny = array('id' => $current_status_id);
        $res = $this->admin_model->getSelectedData( 'goods_status', 'filename', $data_cndtny); 
        $file= $res[0]->filename;
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        ob_clean();
        flush();
        readfile($file);
        exit;   
    
    }

    public function ajaxLoadupdate_lrNo(){

        $trip_sheet_id = $this->input->post('trip_sheet_id'); 
        $columns = 'url';
        $condition='id='.$trip_sheet_id;
        $res = $this->admin_model->getSelectedData('trip_sheet', $columns,$condition );
        

                 
        $html='';  
        $checkValues = $this->input->post('checkValues'); 
        if(!empty( $checkValues)){  
            $invoice_nos_lrno = $this->crud_model->get_all_lrno_by_invoice('trip_sheet_cargos','invoice_number' , $checkValues);
 

                $html = '<div>
                        <table style="width:100%">
                        <tr> 
                        <td  >Show Estimate Delivery Date: <input type="checkbox" name="estimateDelDate" id="estimateDelDate" class=""> <br></td>
                        
                        </tr> 
                        <tr> 
                        <th >Url : <input type="text" required name="url" class="form-control" placeholder="Please enter url.." value="'. $res[0]->url.'"> ( eg: http://www.google.com )<br></th>
                        
                        </tr> 
                        <tr> 
                        <th >Estimate Arrival Date : <input type="date" name="common_estimate_arrival_date" class="form-control" placeholder="Please Enter Estimate Delivery date.."> </th>
                        
                        </tr> 
                        </table>
                        <table style="width:100%; margin-top:10px;">
                        <tr> 
                        <td><b>Invoice no</b></td>
                        <td><b>Lr No</b></td>
                        <td class="showEstimateDate"><b>Estimate Delivery Date</b></td>
                        </tr>';
 
                foreach( $invoice_nos_lrno as $val) {                   
                    $html .=  '<tr> 
                                <td>   <input type="text" name="invoice_no[]" value="'.$val->invoice_number.'" class="form-control" readonly> </td>
                                <td> <input type="text" name="lr_no[]" class="form-control" value="'.$val->lr_no.'" ></td>
                                <td  class="showEstimateDate">
                                     <input type="date" class="form-control" name="estimate_arrival_date[]" value="'.$val->estimate_arrival_date.'">
                                 </td>
                                </tr>'; 
                }
                 

                $html .=  '</table>
                            </div>'; 
                echo  $html;   
        }
        else {
            $html='<span style="color:red; font-size:18px;font-weight:bold;">Please select goods !!</span>';
            echo  $html; 
        }    
 
        
    }

    public function updateLrNo(){
        
        $invoice_no_arr = $this->input->post('invoice_no'); 
        $sel_tripsheet_id_lr = $this->input->post('sel_tripsheet_id_lr'); 
        $common_date = false; 
        if( $this->input->post('common_estimate_arrival_date') !='')
        {
            $common_date = true; 
            $common_estimate_arrival_date =$this->input->post('common_estimate_arrival_date');
        } else {
            $estimate_arrival_date = $this->input->post('estimate_arrival_date');  
        }
       
        $lr_no_arr = $this->input->post('lr_no');
          
        $dataz=array( 
            'url'=> $this->input->post('url')             
        );  

        
        if (strrev($this->input->post('url'))[0] === '/') {
            $finalUrl = $this->input->post('url');
            $url = substr($finalUrl ,0,-1 );
         } else {
             $url = $this->input->post('url');
         } 

        $lstid2 =$this->crud_model->edit_table_account('trip_sheet',$dataz,$sel_tripsheet_id_lr,'id');  

         foreach( $invoice_no_arr as $key => $val) {

            // $url = $this->input->post('url');   

            $invoice_no = trim($val);
            if(isset($lr_no_arr[$key])) {
                $newUrl = $url."/".$lr_no_arr[$key];
            } else {
                $newUrl ='';
            }
            
			$datax[] = array(
                'invoiceno' => $invoice_no,
				'url'       => $newUrl,
				'docket'    => $lr_no_arr[$key]??''
			);  
            
			$lstid=$this->crud_model->edit_table_account('goods_details',$datax,$invoice_no,'invoiceno'); 

            if( $common_date ){
                $datay=array( 
                    'invoice_number' => $invoice_no,
                    'tracking_url'=>$newUrl,
                    'lr_no'=>$lr_no_arr[$key],
                    'estimate_arrival_date'=>$common_estimate_arrival_date
                );
            } else {
                $datay=array( 
                    'invoice_number' => $invoice_no,
                    'tracking_url'=>$newUrl,
                    'lr_no'=>$lr_no_arr[$key]??'',
                    'estimate_arrival_date'=>$estimate_arrival_date[$key]??''
                );
            }
           

			$lstid1 =$this->crud_model->edit_table_account('trip_sheet_cargos',$datay,$invoice_no,'invoice_number');  

         }  

        //  if(!empty( $invoice_no_arr )){
        //     $lstid=$this->crud_model->bulk_update('goods_details',$datax, 'invoiceno');
        //     $lstid1 =$this->crud_model->bulk_update('trip_sheet_cargos',$datay, 'invoice_number');   

        //  }
         redirect(base_url() . 'trip_sheet/cargos_other_state/'.$sel_tripsheet_id_lr );


    }

/** bulK update database */
    public function updatestatus(){
        $cnt =0;
        $othercnt =0;
        $data_cndtnx = array();
        $data['cargos'] = $this->admin_model->get_all_data('trip_sheet_cargos', $data_cndtnx, 'id', 'DESC');
        foreach ($data['cargos'] as $goods ) {
        $data_cndtnx = array('invoice_number' =>   $goods->invoice_number, 'branch_id' =>  $goods->branch_id);
        $gs = $this->admin_model->get_all_data('goods_status', $data_cndtnx, 'created_at', 'DESC');
    
        if(count ($gs) > 1 ){
            $datax=array( 
                'current_status_id'=>$gs[0]->id 
            ); 

            $othercnt = $othercnt +1;
            $lstid=$this->crud_model->edit_table_account('goods_details',$datax,$goods->invoice_number,'invoiceno'); 
            $lstid=$this->crud_model->edit_table_account('shipment_details',$datax,$goods->invoice_number,'invoiceno'); 
            $lstid1=$this->crud_model->edit_table_account('trip_sheet_cargos',$datax,$goods->invoice_number,'invoice_number'); 
            // echo  $goods->invoice_number."---- ".count ($gs)."<br>";
        }
        else {
            // $cnt = $cnt +1;

            $datax=array( 
                'current_status_id'=>$gs[0]->id 
            );  
            $lstid=$this->crud_model->edit_table_account('goods_details',$datax,$goods->invoice_number,'invoiceno'); 
            $lstid=$this->crud_model->edit_table_account('shipment_details',$datax,$goods->invoice_number,'invoiceno'); 

            $lstid1=$this->crud_model->edit_table_account('trip_sheet_cargos',$datax,$goods->invoice_number,'invoice_number'); 
    
            // echo  $goods->invoice_number."---->=== ".count ($gs)."<br>";;

        }
    

    }
    echo $othercnt."othercnt <br>" ;
    echo $cnt."cnt <br>" ;
            // print_r( $data['cargos'] );

            die;

        }


        /** bulK update database */
    public function goodsStatusUpdate(){
        $cnt =0;
        $othercnt =0;
        $data_cndtnx = array('trip_no'=> 'BEST LCL 182');
        $data['goods_details'] = $this->admin_model->get_all_data('goods_details', $data_cndtnx, 'id', 'DESC');
        // echo count( $data['goods_details']);
        
        foreach ($data['goods_details'] as $goods ) {

        $data_cndtnx = array('invoice_number' =>   $goods->invoiceno );
        $gs = $this->admin_model->get_all_data('goods_status', $data_cndtnx, 'created_at', 'DESC');
 
        if(( $goods->current_status_id != NULL ||  $goods->current_status_id !='')) {
        echo "**************************************<br>";
        echo "goods _status ---> &nbsp;&nbsp;".$goods->id."_______".  $goods->goods_status. "<br>current_status_id&nbsp;&nbsp; <span style='color:#fff;font-size:20px; background-color:green; padding:5px;'><b>" .  $goods->current_status_id."</b></span><br><br>";
        echo "***************************************<br>";

        $flag =0;
    
            foreach( $gs as $goods_status) {
            

                $cnt = $cnt +1;
                if(   $goods_status->tracking_no == NULL) {
                    // echo  "ID&nbsp;".$goods_status->id."&nbsp;&nbsp;** invoice_number  ->".$goods_status->invoice_number. " status ".$goods_status->goods_status. " trip_sheet_id ".$goods_status->trip_sheet_id. "goods_id". $goods->id. "trip_sheet_id". $goods->trip_sheet_id."<br>";
                } else {
                    $flag = $flag +1;

                    if($flag == 1) {
                        echo      $flag. "ID&nbsp;&nbsp;<span style='color:red;'>  <b><i> ".$goods_status->id. "_____".  $goods_status->goods_status ."</i></b></span>  updtae wiht this id <br>";

                        $datax=array( 
                            'current_status_id'=> $goods_status->id,
                            'goods_status' =>$goods_status->goods_status
                        );  
                        $lstid=$this->crud_model->edit_table_account('goods_details',$datax,$goods->id,'id');  
                        $lstid=$this->crud_model->edit_table_account('shipment_details',$datax,$goods->id,'id');  
                    }
                    echo   "ID&nbsp;&nbsp;".$goods_status->id."&nbsp;&nbsp;--invoice_number  ->".$goods_status->invoice_number. " status ".$goods_status->goods_status. " trip_sheet_id ".$goods_status->trip_sheet_id. "goods_id". $goods->id."trip_sheet_id". $goods->trip_sheet_id."<br>";

                }
            
            } 
            
        }
        echo "______________________________________________________________<br><br>";
    

    }
    
        echo $cnt;    

            die;

        }



}//end Class