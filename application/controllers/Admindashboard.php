<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admindashboard extends CI_Controller {


	public $data=array();
	function __construct() {
		parent::__construct();
		super_admin_session_check();
		$this->data['page_id']="AdminDashboard";
		$this->data['page_title']="AdminDashboard";
		$this->load->library('pagination');
		date_default_timezone_set('Asia/Kolkata');
		$this->load->helper('string');
		$this->load->helper('text');
	}
	 
	public function index(){
 
		$this->data['page_title']="AdminDashboard | CargoSuperAdmin";  

		$branch_id = $this->session->userdata['adminloginel']['id'];
		$data_cndtnx = array('trip_sheet_cargos.status' => 4);   //pending - 4
		$pending_invoices = $this->admin_model->get_all_invoice_by_status_admin('trip_sheet_cargos',$data_cndtnx ); 
        $datas['pending_invoices'] = $pending_invoices;
 
		$data_cndtny = array('trip_sheet_cargos.status' => 5);   //Not delivered  - 5
		$not_delivered_invoices = $this->admin_model->get_all_invoice_by_status_admin('trip_sheet_cargos', $data_cndtny);
        $datas['not_delivered_invoices'] = $not_delivered_invoices;


		$data_cndt1 = array('goods_status' => 'hold'); 
		$holding_count = $this->admin_model->get_count_by_status('goods_details', $data_cndt1  );
        $datas['holding_count'] = $holding_count;

		$data_cndt2 = array('goods_status' => 'short'); 
		$pending_count = $this->admin_model->get_count_by_status('goods_details', $data_cndt2  );
        $datas['pending_count'] = $pending_count;


		$data_cndt3 = array('status' => 1); 
		$trip_started = $this->admin_model->get_count_by_status('trip_sheet', $data_cndt3  );
        $datas['trip_started'] = $trip_started;

		$data_cndt4 = array('status' => 0); 
		$on_the_way = $this->admin_model->get_count_by_status('trip_sheet', $data_cndt4  );
        $datas['on_the_way'] = $on_the_way;



		$branch_id = $this->session->userdata['adminloginel']['id'];
		$data_cndtnx = array('trip_sheet_cargos.status' => 5);   //get goods not deliverd after the estimated arrival date - 4
		$goods_not_delivered = $this->admin_model->get_all_not_delivered_goods_admin('trip_sheet_cargos',$data_cndtnx,  NULL, NULL); 
		// echo $this->db->last_query();
		// die; 
		 
        $datas['goods_not_delivered'] =  $goods_not_delivered;


		$this->load->view('head/admin_header',$this->data);
		$this->load->view('index', $datas);		 
		$this->load->view('head/admin_footer');
	}
	 

	  
}//end Class