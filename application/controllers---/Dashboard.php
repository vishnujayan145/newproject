<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {


	public $data=array();
	function __construct() {
	parent::__construct();
	admin_session_check();
	$this->data['page_id']="dashboard";
	$this->data['page_title']="Dashboard";
	$this->load->library('pagination');
	date_default_timezone_set('Asia/Kolkata');
	$this->load->helper('string');
	$this->load->helper('text');
	$this->load->helper(array('form', 'url','directory'));
	}
	public function index()
	{
		 
		$this->data['page_title']="Dashboard | CargoAdmin";

		$branch_id = $this->session->userdata['adminloginel']['id'];
		$data_cndtnx = array('trip_sheet_cargos.status' => 4);   //pending - 4
		$pending_invoices = $this->admin_model->get_all_invoice_by_status('trip_sheet_cargos',$data_cndtnx, $branch_id, 'trip_sheet_cargos.branch_id'); 
        $datas['pending_invoices'] = $pending_invoices;
 
		$data_cndtny = array('trip_sheet_cargos.status' => 5);   //Not delivered  - 5
		$not_delivered_invoices = $this->admin_model->get_all_invoice_by_status('trip_sheet_cargos', $data_cndtny,$branch_id, 'trip_sheet_cargos.branch_id');
        $datas['not_delivered_invoices'] = $not_delivered_invoices;


		$data_cndt1 = array('goods_status' => 'hold', 'branch_id' => $branch_id); 
		$holding_count = $this->admin_model->get_count_by_status('goods_details', $data_cndt1  );
        $datas['holding_count'] = $holding_count;

		$data_cndt2 = array('goods_status' => 'short', 'branch_id' => $branch_id); 
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
		$goods_not_delivered = $this->admin_model->get_all_not_delivered_goods('trip_sheet_cargos',$data_cndtnx, $branch_id, 'trip_sheet_cargos.branch_id', NULL, NULL); 
		 
		// print_r($goods_not_delivered  );
		// die;
		// foreach( $goods_not_delivered as $val ){
		// 	echo $val->goods_id. "--". $val->trip_sheet_cargos_estimate_arrival_date."<br>";
		// 	// print_r($val->goods_id);
		// }
		// die;
        $datas['goods_not_delivered'] =  $goods_not_delivered;



		$this->load->view('head/header',$this->data);
		$this->load->view('index', $datas);
		$this->load->view('head/footer');
	}

	public function database_backup()
	{ 

		ini_set('max_execution_time', '300');
		ini_set('memory_limit', -1);


		$this->other_db = $this->load->database();       
		$this->myutil = $this->load->dbutil($this->other_db, TRUE);
				   $prefs = array(
					   'format' => 'sql',
					   'filename' => 'file_name' . '.sql'
				   );
				   $backup = $this->myutil->backup($prefs);
				   $currentTime = date('Y-m-dH:i:s');
				   $foldername = 'backup_'.$currentTime;
				   $db_name = 'backup-on-' . date("Y-m-d-H-i-s") . '.sql';
				   $upload_path = APPPATH.'cache/dbbackup/';
				   $save =  $upload_path. $db_name;
	   
				   $this->load->helper('file');
				   write_file($save, $backup);

				   $this->load->helper('download');
				   force_download('file_name.sql', $backup);
				   echo 'Done...'; 
	 
	}



	public function restore() {

		$this->data['page_title']="Dashboard | CargoAdmin";
		$this->load->dbutil(); 
		$dbs = $this->dbutil->list_databases();
		$files = directory_map(APPPATH.'cache/dbbackup/');
		$this->data['file_path'] = APPPATH.'cache/dbbackup/';
		asort($files);
		$this->data['files'] = $files;
		$this->load->view('head/header',$this->data);
		$this->load->view('restore');
		$this->load->view('head/footer');
 
	}

	public function download() {

		$file_name  =  $this->uri->segment(3);
		$this->load->helper('download');
		force_download(APPPATH.'cache/dbbackup/'.$file_name, null);		 

	}


	public function delete() {

		$file_name  =  $this->uri->segment(3);
		$this->load->helper('download');
		@unlink(APPPATH.'cache/dbbackup/'.$file_name);
		$this->restore();

	}
	/*
	public function restore_backup() {
	 	
		ini_set('max_execution_time', '300');
		ini_set('memory_limit', -1);


		$this->data['page_title']="Dashboard | CargoAdmin";

		$path = APPPATH.'cache/dbbackup/';
		$sql_filename = $this->input->post('file');
	 
		$sql_contents = file_get_contents($path.$sql_filename);
		$sql_contents = explode(";", $sql_contents);

		// Temporary variable, used to store current query
		$templine = '';
		$lines = file($path.$sql_filename);
		foreach ($lines as $line)
			{
			// Skip it if it's a comment
			if (substr($line, 0, 2) == '--' || $line == ''|| $line == '#')
				continue;

			// Add this line to the current segment
			$templine .= $line;
			// If it has a semicolon at the end, it's the end of the query
			if (substr(trim($line), -1, 1) == ';')
			{
				// Perform the query
				// mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
				$this->db->query($templine);
				// Reset temp variable to empty
				$templine = '';
			}
			} 
		echo "success";

		$this->load->view('head/header',$this->data);
		$this->load->view('restore', $datas);
		$this->load->view('head/footer');	 
 
	}
*/
	

}//end Class