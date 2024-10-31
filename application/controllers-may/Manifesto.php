<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



class Manifesto extends CI_Controller
{

    public $data = array();

    function __construct()
    {
        parent::__construct();
        admin_session_check();
        $this->data['page_id'] = "manifesto";
        $this->data['page_title'] = "manifesto";
        $this->load->library('pagination');
        date_default_timezone_set('Asia/Kolkata');
        $this->load->helper('string');
        $this->load->helper('text');
        $this->load->model('manifesto_model');
    }

    public function index()
    {
        $this->data['page_id'] = "manifesto";
        $this->data['page_title'] = "Manifesto  | CargoAdmin";

        $config = array();
        $searchqry = array();

        $current_user = $this->admin_model->get_current_user();
        $current_user_branch = $this->admin_model->get_current_user_branch($current_user[0]->id);

        $this->data["result"] = $this->manifesto_model->get_manifestos($current_user[0]->branch);
        $this->load->view('head/header', $this->data);
        $this->load->view('manifesto/index');
        $this->load->view('head/footer');
    }

    public function create()
    {
        $this->data['page_id'] = "manifesto_create";
        $this->data['page_title'] = "Upload Manifesto  | CargoAdmin";
        $this->load->view('head/header', $this->data);
        $this->load->view('manifesto/create');
        $this->load->view('head/footer');
    }


    public function create_process()
    {

        if ($this->security->xss_clean($this->input->post('total_rent')) != null) {
            $total_rent = $this->security->xss_clean($this->input->post('total_rent'));
        } else {
            $total_rent = 0;
        }

        $vehicles_cndtnx = array('status' => 0, 'id' => $this->security->xss_clean($this->input->post('vehicle_number')));
        $vehicles_details = $this->admin_model->get_all_data('vehicles', $vehicles_cndtnx, 'id', 'DESC');

        $current_user = $this->admin_model->get_current_user();

        $datax = array(
            'send_branch' =>  $current_user[0]->branch,
            'recieve_branch' => $this->security->xss_clean($this->input->post('branch')),
            'send_date' => $this->security->xss_clean($this->input->post('send_date')),
            'created_at' => date('Y-m-d H:i:s'),
            'status' => 0
        );

        $manifesto_id = $this->crud_model->create_table_account('manifesto', $datax);

        $this->session->set_flashdata('msgx', "<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> created successfully.</div>");

        // file upload starts here

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

			foreach ($sheetData as $val){

				$datax=array(
					'box_no' =>                 $val['0'],
                    'invoice_no' =>             $val['1'],
                    'psc' =>                    $val['2'],
					'kg' =>                     $val['3'],
                    'consignee_address' =>      $val['4'],
					'pincode' =>                $val['5'],
                    'state' =>                  $val['6'],
					'description' =>            $val['7'],
					'consigner_address' =>      $val['8'],
					'parent' =>                 $manifesto_id,

				);

                // print_r($datax);

				$lstid = $this->crud_model->create_table_account('manifesto_data', $datax);
			}
		
			$this->session->set_flashdata('msgx',"<div class='alert alert-success'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-check-square'></i> imported successfully.</div>");
		
		}

        redirect(base_url() . 'manifesto/create');

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
    }

    public function generate_ogm($manifesto_id=NULL)
    {
        $headers = [
            'VENDOR',
            'BOX No',
            'INVOICE NO', 
            'QTY',
            'KGS',
            'RECEIVER ADDRESS',
            'PINCODE',
            'STATE',
            'DESCRIPTION OF GOODS',
        ];

        $data = $this->manifesto_model->get_ogm($manifesto_id);

        $this->createExcel($data, $headers, 'OGM.xlsx');

    }

    public function generate_loading_list($manifesto_id=NULL)
    {
        $headers = [
            'BOX No',
            'INVOICE NO', 
            'QTY',
            'KGS',
            'STATE',
            'VENDOR',
        ];

        $data = $this->manifesto_model->get_loading_list($manifesto_id);

        $this->createExcel($data, $headers, 'LOADING_LIST.xlsx');

    }

    public function generate_sorting_list($manifesto_id=NULL)
    {
        $headers = [
            'BOX No',
            'INVOICE NO', 
            'QTY',
            'KGS',
            'STATE',
            'VENDOR',
        ];

        $data = $this->manifesto_model->get_sorting_list($manifesto_id);

        $this->createExcel($data, $headers, 'SORTING_LIST.xlsx');

    }

}