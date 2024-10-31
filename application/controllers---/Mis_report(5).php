<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Mis_report extends CI_Controller
{


    public $data = array();

    function __construct()
    {
        parent::__construct();
        admin_session_check();
        $this->data['page_id'] = "misreport";
        $this->data['page_title'] = "Mis Reports";
        $this->load->library('pagination');
        $this->load->database();
        date_default_timezone_set('Asia/Kolkata');
        $this->load->helper('string');
        $this->load->helper('text');
    }

    
    public function index(){
        $this->data['page_id'] = "misreport";
        $this->data['page_title'] = "Mis Reports  | CargoAdmin";
        $data_cndtnxy = array('status' => 0);
        $clmn = "branch_id";
        $branch_id = $this->session->userdata['adminloginel']['id'];
        $data['shipments'] = $this->admin_model->get_shipment_name( $clmn, $branch_id);


        $data_cndtnx = array();
		$this->data['cargos_arr'] = $this->admin_model->get_cargo_name('cargo',$data_cndtnx );  
 
 
    //         echo "<pre>";
    // print_r($this->data['cargos_arr'] );
    // echo "</pre>";

    // die;
     

        $this->load->view('head/header', $this->data);
        $this->load->view('mis_report/index',$data);
        $this->load->view('head/footer');
    }
    
    
    public function export_post()
    {
        ini_set('max_execution_time', 0); 
        ini_set('memory_limit','3069M');

        $this->data['page_id']="export";
		$this->data['page_title']="Export Data  | cargoadmin";
        if(!empty($this->input->post('shipmentname') )) {           
            $data_cndtn=array('shipmentname' => $this->input->post('shipmentname'));
            $condition="`gd`.`shipmentname`  = '".$this->input->post('shipmentname')."'";
        } else {            
            $data_cndtn=array('company' => $this->input->post('cargo_company'));
            $condition="`gd`.`company`  = '".$this->input->post('cargo_company')."'";
        }
		$searchqry = array();
		
		$total_row = $this->admin_model->count_all_data_condition_ordersearch('goods_details',$data_cndtn,'id','DESC',$searchqry);
		 
		$this->data["result"] = $this->admin_model->get_mis_report($condition);	
        
        // foreach( $this->data["result"] as $key => $val) {           
        //     if(empty($val['docket'])){ 
        //         $this->data["result"][$key]['docket'] = "Own Delivery";
        //     }
        //     $this->data["result"][$key]['tracking_url_web']= "https://web.indianlivecargo.com/track/detail/".$val['tracking_no'];
        // } 
   
		$this->generate_excel($this->data["result"],['received_date','trip_no','tracking_no','url' , 'shipmentname','goods_invoice','tot_pcs','tot_weight','rewight','reciever_address','district','vendor','goods_current_status','docket','goods_status_date','estimate_arrival_date','tracking_url_web'],'mis_report');
		
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
            
            // echo "<pre>";
            //   print_r($item);
            // echo "</pre>";  
            //   die;
            if( $item->current_status_id == NULL || empty($item->current_status_id) || $item->current_status_id == ''){
 
                if( $item->is_transfer == 0) {
                    if(  $item->goods_status == NULL ||  $item->goods_status =='' ) {
                        if( $item->recieved_at_branch == '' || empty(  $item->recieved_at_branch  )) {
                            $item->goods_current_status ="Box Collected";
                            $item->goods_status_date =  date('d-m-Y', strtotime($item->recieved_at_hub)); 
                        } else {
                            $item->goods_current_status ="Received at Branch";
                            $item->goods_status_date = date('d-m-Y', strtotime($item->recieved_at_branch));  
                        } 

                    } else {

                        $item->goods_current_status =  $item->goods_status;
                        $item->goods_status_date = date('d-m-Y', strtotime($item->status_date));                 
                    }
                    
                } else {
                    $item->goods_current_status = "Transferred";
                    $item->goods_status_date = date('d-m-Y', strtotime($item->transferred_date));
                    
                }

            } else {

                $item->goods_status_date = date('d-m-Y', strtotime($item->goods_status_date));
                
            }

            if($item->estimate_arrival_date != NULL)
            $item->estimate_arrival_date = date('d-m-Y', strtotime($item->estimate_arrival_date));

            //   echo "<pre>";
            //   print_r($item);
            // echo "</pre>";  
            //   die;

            // print_r($item->goods_status);
            // echo "<br>";
            // print_r($item->docket); 
            // die;
            
            if(empty($item->docket)){ 
                    $item->docket ="Own Delivery";
                } 
            if(!empty( $item->tracking_no )){
                $item->tracking_url_web = "https://indianlivecargo.com/track/detail/".$item->tracking_no;
            }
             
			$rows[$key] = $this->makeObject(($key+1),$item,$fields); 
		}

        // die;
		// $row = (object) $row;
		// echo "<pre>";
        // print_r( $rows);
		// echo "</pre>";

        // die;
		// // var_dump($row);
		// exit;
		foreach($fields as $field)
		{
			$headers[] = strtoupper(str_replace('_',' ',$field));
		}
		

		$headers = ['RECIEVED AT BRANCH','TRIP NO','TRACKING NUMBER','URL' , 'CONSIGNMENT','INVOICE NO','PIECE','WEIGHT', 'REWEIGHT','ADDRESS','DISTRICT','VENDOR','STATUS','DOCKET','DATE', 'ESTIMATE DELIVERY DATE','TRACKING URL'];
		
        $this->createExcel($rows, $headers, "$fileName.xlsx");

    }


}//end Class