<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    //admin login check true or false
	function login($data) {
	$condition = "username =" . $this->db->escape($data['username']) . " AND " . "password =" .$this->db->escape($data['password'])."";

	$this->db->select('*');
	$this->db->from('administrator');
	$this->db->where($condition);
	$this->db->limit(1);
	$query = $this->db->get();

	if ($query->num_rows() == 1) {
		return true;
	} 
	else{
		return false;
	}
	}
	//admin login read all data
	function login_read_data($username) {
    $condition ="username =" . $this->db->escape($username);
    $this->db->select('*');
    $this->db->from('administrator');
    $this->db->where($condition);
    $this->db->limit(1);
    $query = $this->db->get();

    if ($query->num_rows() == 1) {
    	return $query->result();
    } 
    else {
    	return false;
    }
    }

    function user_login($data) {
    $condition = "email =" . $this->db->escape($data['email']) . " AND " . "password =" .$this->db->escape($data['password'])."";

    $this->db->select('*');
    $this->db->from('users');
    $this->db->where($condition);
    $this->db->where('status',0);
    $this->db->limit(1);
    $query = $this->db->get();

    if ($query->num_rows() == 1) {
        return true;
    } 
    else{
        return false;
    }
    }
    function user_login_read_data($email) {
    $condition ="email =" . $this->db->escape($email);
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where($condition);
    $this->db->limit(1);
    $query = $this->db->get();

    if ($query->num_rows() == 1) {
        return $query->result();
    } 
    else {
        return false;
    }
    }
    function admin_login_read_data($idx) {
    $condition ="id =" .$idx;
    $this->db->select('*');
    $this->db->from('administrator');
    $this->db->where($condition);
    $this->db->limit(1);
    $query = $this->db->get();

    if ($query->num_rows() == 1) {
        return $query->result();
    } 
    else {
        return false;
    }
    }
    function create_table_account($table,$data) {
    $this->db->insert($table,$data);
    return $this->db->insert_id();
    }
    public function count_all_data_condition_order($table_name,$condition,$clmnname,$cndt){
    $query = $this->db
            ->where($condition)
            ->order_by($clmnname,$cndt)
            ->get($table_name);
    return $query->num_rows();
    }
    public function get_all_data_condition_order($table_name,$condition,$limit, $start,$clmnname,$cndt) {
    $offset = ($start-1)*$limit;
    $this->db->limit($limit, $offset);
    $this->db->select('*');
    $this->db->where($condition);
    $this->db->order_by($clmnname,$cndt);

    $query = $this->db->get($table_name);


    if ($query->num_rows() > 0) {
    foreach ($query->result() as $row) {
    $data[] = $row;
    }
    return $data;
    }
    return false;
    }

    public function count_all_data_condition_ordersearch($table_name, $condition, $clmnname, $cndt, $sqry){
  
       
    $query = $this->db
            ->where($condition) 
             ->where($sqry) 
            ->order_by($clmnname,$cndt)
            ->get($table_name);

            // echo $this->db->last_query();
            // die;
    return $query->num_rows();
    } 

           
    public function check_tripsheet_name_exist($table_name,$condition ){
 
        $query = $this->db
                ->where($condition)
                ->get($table_name);
        return $query->num_rows();

    }


    public function create_tripsheet_name($table_name,$condition ){  
     
        $query = $this->db
                ->select('id,trip_sheet_name')
                ->where($condition)
                ->order_by('id', 'DESC')
                ->limit(1, 0)
                ->get($table_name)  ;
      
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        } else {
            return false;
        }
    }

    

    public function get_all_data_condition_ordersearch($table_name,$condition,$limit, $start,$clmnname,$cndt,$sqry) {

    
    $offset = ($start-1)*$limit;
    $this->db->limit($limit, $offset);
    $this->db->select('*');
    $this->db->where($condition);
    $this->db->where($sqry);
    $this->db->order_by($clmnname,$cndt);

    $query = $this->db->get($table_name);

    // echo $this->db->last_query(); die();


    if ($query->num_rows() > 0) {
    foreach ($query->result() as $row) {
    $data[] = $row;
    }
    return $data;
    }
    return false;
    }


    public function get_all_data_condition_ordersearch_admin($table_name,$condition,$limit, $start,$clmnname,$cndt,$sqry, $join, $join_cond) {

        $offset = ($start-1)*$limit;
        $this->db->limit($limit, $offset);
        $this->db->select('*, branches.branch_name as branch_name');
        $this->db->join( $join, $join_cond,'left');
        $this->db->where($condition);
        $this->db->where($sqry);
        $this->db->order_by($clmnname,$cndt);
    
        $query = $this->db->get($table_name);
    
        //    echo $this->db->last_query(); die();
    
    
        if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
        $data[] = $row;
        }
        return $data;
        }
        return false;
        }
    


    public function count_get_all_data_condition_ordersearch_cargos($table_name, $condition, $clmnname, $cndt, $sqry) {

        $this->db->select('*'); 
        $this->db->where($condition);
        $this->db->where('goods_id is NULL'); 
        $query = $this->db->get($table_name); 

        if ($query->num_rows() > 0) {
           
            // $offset = ($start-1)*$limit; 
            // $this->db->limit($limit, $offset);
            $this->db->select('trip_sheet_cargos.*, goods_details.state as state, trip_sheet_cargos.id as id, trip_sheet_cargos.sort_order as sort_order, trip_sheet_cargos.status as status, goods_details.tracking_no as tracking_no, goods_details.trip_no as trip_no, goods_details.boxno as boxno,  goods_details.status as goodsstatus, trip_sheet.estimate_arrival_date as trip_sheet_estimate_arrival_date ');
            $this->db->join('goods_details', ' goods_details.invoiceno = trip_sheet_cargos.invoice_number AND   goods_details.tracking_no = trip_sheet_cargos.tracking_no' ,'left');      
            $this->db->join('trip_sheet', ' trip_sheet.id = trip_sheet_cargos.trip_sheet_id' ,'left');      
            $this->db->where($condition);
            $this->db->where($sqry);
            $this->db->order_by($clmnname,$cndt);       
            $query = $this->db->get($table_name); 

        } else {
            // $offset = ($start-1)*$limit;  
            // $this->db->limit($limit, $offset);
            
            $this->db->select('trip_sheet_cargos.*, goods_details.state as state, trip_sheet_cargos.id as id, trip_sheet_cargos.sort_order as sort_order, trip_sheet_cargos.status as status, goods_details.tracking_no as tracking_no, goods_details.trip_no as trip_no, goods_details.boxno as boxno,  goods_details.status as goodsstatus, trip_sheet.estimate_arrival_date as trip_sheet_estimate_arrival_date  ');
            $this->db->join('goods_details', ' goods_details.id = trip_sheet_cargos.goods_id ' ,'left');     
            $this->db->join('trip_sheet', ' trip_sheet.id = trip_sheet_cargos.trip_sheet_id' ,'left');  
            $this->db->where($condition);
            // $this->db->where('goods_id is not NULL');
            $this->db->where($sqry);
            $this->db->order_by($clmnname,$cndt);  
            $query = $this->db->get($table_name); 

        }  
        // print_r( $query->num_rows() );
        // die;
              
        // echo $this->db->last_query();
        // die;

        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return false;   
        }
  
    } 




    public function get_all_data_condition_ordersearch_cargos($table_name,$condition,$limit, $start,$clmnname,$cndt,$sqry) {        
 
      

        $this->db->select('*'); 
        $this->db->where($condition);
        $this->db->where('goods_id is NULL'); 
        $query = $this->db->get($table_name); 

        if ($query->num_rows() > 0) {
           
            $offset = ($start-1)*$limit; 
            $this->db->limit($limit, $offset);
            $this->db->select('trip_sheet_cargos.*, goods_details.state as state, trip_sheet_cargos.id as id, trip_sheet_cargos.sort_order as sort_order, trip_sheet_cargos.status as status, goods_details.tracking_no as tracking_no, goods_details.trip_no as trip_no, goods_details.boxno as boxno,  goods_details.status as goodsstatus, trip_sheet.estimate_arrival_date as trip_sheet_estimate_arrival_date , goods_status.filename');
            $this->db->join('goods_details', ' goods_details.invoiceno = trip_sheet_cargos.invoice_number AND   goods_details.tracking_no = trip_sheet_cargos.tracking_no' ,'left');      
            $this->db->join('trip_sheet', ' trip_sheet.id = trip_sheet_cargos.trip_sheet_id' ,'left');  
            $this->db->join('goods_status', 'trip_sheet_cargos.current_status_id = goods_status.id');  
            $this->db->where($condition);
            $this->db->where($sqry);
            $this->db->order_by($clmnname,$cndt);       
            $query = $this->db->get($table_name); 

        } else {
            $offset = ($start-1)*$limit; 

            $this->db->limit($limit, $offset);
            $this->db->select('trip_sheet_cargos.*, goods_details.state as state, trip_sheet_cargos.id as id, trip_sheet_cargos.sort_order as sort_order, trip_sheet_cargos.status as status, goods_details.tracking_no as tracking_no, goods_details.trip_no as trip_no, goods_details.boxno as boxno,  goods_details.status as goodsstatus, trip_sheet.estimate_arrival_date as trip_sheet_estimate_arrival_date, goods_status.filename');
            $this->db->join('goods_details', ' goods_details.id = trip_sheet_cargos.goods_id ' ,'left');     
            $this->db->join('trip_sheet', ' trip_sheet.id = trip_sheet_cargos.trip_sheet_id' ,'left');  
            $this->db->join('goods_status', 'trip_sheet_cargos.current_status_id = goods_status.id' );  
            $this->db->where($condition);
            // $this->db->where('goods_id is not NULL');
            $this->db->where($sqry);
            $this->db->order_by($clmnname,$cndt);  
            $query = $this->db->get($table_name); 

        }  
        // print_r( $query->num_rows() );
        // die;
              
        // echo $this->db->last_query();
        // die;

        if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
        $data[] = $row;
        }

        return $data;
        }
        return false;
    } 

 

    public function get_all_data_print($table_name,$condition,$clmnname,$cndt,$new_checkbox=array()) {


        $this->db->select('*'); 
        $this->db->where($condition);
        $this->db->where('goods_id is NULL'); 
        $query = $this->db->get($table_name); 

        if ($query->num_rows() > 0) {
  
           $this->db->select('trip_sheet_cargos.id as id, trip_sheet_cargos.sort_order as sort_order,  trip_sheet_cargos.trip_sheet_id as trip_sheet_id ,  trip_sheet_cargos.invoice_number as invoice_number , trip_sheet_cargos.tracking_no as tracking_no , trip_sheet_cargos.estimate_arrival_date as estimate_arrival_date , trip_sheet_cargos.cargo_id as cargo_id , trip_sheet_cargos.cargo_name as cargo_name , trip_sheet_cargos.place as place , trip_sheet_cargos.address as address , trip_sheet_cargos.shipment_name as shipment_name , trip_sheet_cargos.lr_no as lr_no , trip_sheet_cargos.tracking_url as tracking_url ,   trip_sheet_cargos.quantity as quantity , trip_sheet_cargos.weight as weight , trip_sheet_cargos.status as status , trip_sheet_cargos.message as message , trip_sheet_cargos.branch_id as branch_id , trip_sheet_cargos.current_status_id as current_status_id , trip_sheet_cargos.created_at as created_at , trip_sheet_cargos.updated_at as updated_at , goods_details.boxno as boxno,  , goods_details.contact_no as mobilenumber , goods_details.trip_no as trip_no, trip_sheet_cargos.sort_order as sort_order,  GROUP_CONCAT(goods_details.boxno) as grp_boxno,   GROUP_CONCAT(goods_details.invoiceno) as goods_invoice, SUM(goods_details.pcs) as tot_pcs, ROUND(SUM(goods_details.weight),2) as tot_weight ,goods_details.state as state' );
            $this->db->from($table_name);
            $this->db->join('goods_details', 'trip_sheet_cargos.invoice_number = goods_details.invoiceno AND   goods_details.tracking_no = trip_sheet_cargos.tracking_no','left');
            $this->db->where($condition);
            $this->db->where('goods_details.trip_sheet_id IS NOT NULL');           
            $this->db->group_by('goods_details.tracking_no');
            $this->db->order_by($clmnname,$cndt); 
            $query = $this->db->get();


        }else { 

            $this->db->select('trip_sheet_cargos.id as id, trip_sheet_cargos.sort_order as sort_order,  trip_sheet_cargos.trip_sheet_id as trip_sheet_id ,  trip_sheet_cargos.invoice_number as invoice_number , trip_sheet_cargos.tracking_no as tracking_no , trip_sheet_cargos.estimate_arrival_date as estimate_arrival_date , trip_sheet_cargos.cargo_id as cargo_id , trip_sheet_cargos.cargo_name as cargo_name , trip_sheet_cargos.place as place , trip_sheet_cargos.address as address , trip_sheet_cargos.shipment_name as shipment_name , trip_sheet_cargos.lr_no as lr_no , trip_sheet_cargos.tracking_url as tracking_url ,   trip_sheet_cargos.quantity as quantity , trip_sheet_cargos.weight as weight , trip_sheet_cargos.status as status , trip_sheet_cargos.message as message , trip_sheet_cargos.branch_id as branch_id , trip_sheet_cargos.current_status_id as current_status_id , trip_sheet_cargos.created_at as created_at , trip_sheet_cargos.updated_at as updated_at , goods_details.boxno as boxno,  , goods_details.contact_no as mobilenumber , goods_details.trip_no as trip_no, trip_sheet_cargos.sort_order as sort_order,     GROUP_CONCAT(goods_details.boxno) as grp_boxno,  GROUP_CONCAT(goods_details.invoiceno) as goods_invoice, SUM(goods_details.pcs) as tot_pcs, ROUND(SUM(goods_details.weight),2) as tot_weight ,goods_details.state as state' );
            $this->db->from($table_name);
            $this->db->join('goods_details', ' goods_details.id = trip_sheet_cargos.goods_id ' ,'left');      
            $this->db->where($condition);
            $this->db->where('goods_details.trip_sheet_id IS NOT NULL');           
            $this->db->group_by('goods_details.tracking_no');
            $this->db->order_by($clmnname,$cndt); 
            $query = $this->db->get();



        } 
        

        // echo "<pre>";
        // print_r(  $query->result() );
        // echo "</pre>";
        // die;
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $data[] = $row;
                }
                return $data;
            }  
        return false;
    }





    
    public function count_all_data_condition_ordersearch_goods_details($table_name,$condition,$clmnname,$cndt,$sqry, $searchqry_in){ 
  
        $query = $this->db->where($sqry) 
                ->where($condition) 
                ->where('trip_sheet_id is NULL' )
                ->group_start()
                ->where('transfer_status is NULL' )
                ->or_where('transfer_status','confirmed')
                ->group_end()
                ->order_by($clmnname,$cndt)
                ->get($table_name); 
        return $query->num_rows();
    }        
    
    
    public function count_all_data_condition_ordersearch_goods_details_admin($table_name,$condition,$clmnname,$cndt,$sqry, $searchqry_in, $join, $join_cond){ 
    
        $query = $this->db->where($sqry)
                ->join($join, $join_cond, 'left' ) 
                ->where($condition) 
                ->where('trip_sheet_id is NULL' )
                ->group_start()
                ->where('transfer_status is NULL' )
                ->or_where('transfer_status','confirmed')
                ->group_end()
                ->order_by($clmnname,$cndt)
                ->get($table_name);
        return $query->num_rows();
    }        
    

    public function get_all_data_condition_ordersearch_goods($table_name,$condition,$limit, $start,$clmnname,$cndt,$sqry, $searchqry_in ) {
 
        $array_check = array(NULL, 'confirmed');
         
        $offset = ($start-1)*$limit;
        $this->db->limit($limit, $offset);
        
        $this->db->select('* ');  
        $this->db->where($condition);            
        $this->db->where($sqry);
        $this->db->where('trip_sheet_id is NULL' );
        $this->db->group_start();
        $this->db->where('transfer_status is NULL' );
        $this->db->or_where('transfer_status','confirmed');   
        $this->db->group_end(); 
        if($searchqry_in)
        $this->db->where_in('trip_no', $searchqry_in); 
        $this->db->order_by($clmnname,$cndt);
        // $this->db->group_by('id');
    
        $query = $this->db->get($table_name);
    
        // echo $this->db->last_query(); die();
        if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
        $data[] = $row;
        }
        return $data;
        }
        return false;
        }



    public function get_all_data_condition_ordersearch_goods_admin($table_name,$condition,$limit, $start,$clmnname,$cndt,$sqry, $searchqry_in, $join, $join_cond) {
 
        $array_check = array(NULL, 'confirmed');
         
        $offset = ($start-1)*$limit;
        $this->db->limit($limit, $offset);
        
        $this->db->select('*, goods_details.id as goods_id ,branches.branch_name as branch_name'); 
        $this->db->join($join, $join_cond, 'left' );
        $this->db->where($condition);            
        $this->db->where($sqry);
        $this->db->where('trip_sheet_id is NULL' );
        $this->db->group_start();
        $this->db->where('transfer_status is NULL' );
        $this->db->or_where('transfer_status','confirmed');   
        $this->db->group_end(); 
        $this->db->where_in('trip_no', $searchqry_in); 
        $this->db->order_by($clmnname,$cndt);
        // $this->db->group_by('id');
    
        $query = $this->db->get($table_name);
    
        // echo $this->db->last_query(); die();
        if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
        $data[] = $row;
        }
        return $data;
        }
        return false;
        }


        public function get_all_data_goods_notin_tripsheet($table_name,$condition,$limit, $start,$clmnname,$cndt,$sqry, $searchqry_in) {
 
            $array_check = array(NULL, 'confirmed');
             
            $offset = ($start-1)*$limit;
            $this->db->limit($limit, $offset);
            
            $this->db->select('* '); 
            $this->db->where($condition);            
            $this->db->where($sqry);
            if($searchqry_in)
            $this->db->where_in('trip_no', $searchqry_in);
    
            $this->db->where('trip_sheet_id IS NULL', null, false);
    
            $this->db->order_by($clmnname,$cndt);
            // $this->db->group_by('id');
        
            $query = $this->db->get($table_name);
        
        
            if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
            $data[] = $row;
            }
            return $data;
            }
            return false;
            }

        public function count_all_data_goods_notin_tripsheet($table_name,$condition, $clmnname,$cndt,$sqry, $searchqry_in) {

            
        
        $array_check = array(NULL, 'confirmed');
                
            // $offset = ($start-1)*$limit;
            // $this->db->limit($limit, $offset);
            
            $this->db->select('* '); 
            $this->db->where($condition);            
            $this->db->where($sqry);
            if($searchqry_in)
            $this->db->where_in('trip_no', $searchqry_in);
    
            $this->db->where('trip_sheet_id IS NULL', null, false);
    
            $this->db->order_by($clmnname,$cndt);
            // $this->db->group_by('id');
        
            $query = $this->db->get($table_name);
        
            return $query->num_rows();

                   
            }

          
            
    public function get_all_data_goods_in_tripsheet($table_name,$condition,$limit, $start,$clmnname,$cndt,$sqry, $searchqry_in) {

        $array_check = array(NULL, 'confirmed');
            
        $offset = ($start-1)*$limit;
        $this->db->limit($limit, $offset);
        
        $this->db->select('* '); 
        $this->db->where($condition);            
        $this->db->where($sqry);
        if(  $searchqry_in )
        $this->db->where_in('trip_no', $searchqry_in);

        $this->db->where('trip_sheet_id IS NOT NULL');

        $this->db->order_by($clmnname,$cndt);
        // $this->db->group_by('id');
    
        $query = $this->db->get($table_name);
    // echo $this->db->last_query();
    //     die;
    
        if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
        $data[] = $row;
        }
        return $data;
        }
        return false;
        }

    public function count_all_data_goods_in_tripsheet($table_name,$condition, $clmnname,$cndt,$sqry, $searchqry_in) {

        $array_check = array(NULL, 'confirmed');
                
            // $offset = ($start-1)*$limit;
            // $this->db->limit($limit, $offset);
            
            $this->db->select('* '); 
            $this->db->where($condition);            
            $this->db->where($sqry);
            if($searchqry_in)
            $this->db->where_in('trip_no', $searchqry_in);
    
            $this->db->where('trip_sheet_id IS NOT  NULL');    
            $this->db->order_by($clmnname,$cndt);
            // $this->db->group_by('id');
        
            $query = $this->db->get($table_name);
        
            return $query->num_rows();

                    
            } 

    public function get_all_data_for_print_goods_in_tripsheet($table_name,$condition, $clmnname,$cndt  ) { 
        
        $this->db->select('*,  GROUP_CONCAT(invoiceno) as goods_invoice, SUM(pcs) as tot_pcs, ROUND(SUM(weight),2) as tot_weight '); 
        $this->db->where($condition);
        $this->db->where('trip_sheet_id IS NOT NULL');           
        $this->db->group_by('tracking_no');
        $this->db->order_by($clmnname,$cndt);
        
        $query = $this->db->get($table_name);  
        
        // echo $this->db->last_query();
        // die;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false; 
       
    }     


    public function get_all_data_condition_ordersearch2(){    

            $this->db->select('*');
            $this->db->from('trip_sheet');
            
            $this->db->join('trip_sheet_cargos', 'trip_sheet.id = trip_sheet_cargos.trip_sheet_id','left');
            $query = $this->db->get();
            return $query->result();
    }


    public function get_mis_report_admin($condition , $offset ,$limit ){    
 
        /*
        $qry = "SELECT  `gs`.`goods_status` as `goods_current_status`,`gs`.`created_at` as `goods_status_date`, `gd`.`received_date`, `gd`.`rewight`,`gd`.`shipmentname`,`gd`.`invoiceno`,`gd`.`pcs`,`gd`.`weight`,`gd`.`reciever_address`,`gd`.`district`,`gd`.`vendor`, `gd`.`docket`,`gd`.`current_status_id` ,`gd`.`is_transfer`, `gd`.`current_transfer_id`, `gtd`.`created_at` as `transferred_date` , `gd`.`recieved_at_hub`, `gd`.`recieved_at_branch` , `tc`.`created_at`,`tc`.`invoice_number`, `tc`.`estimate_arrival_date` as `estimate_arrival_date`,  `gd`.`url` ,`gd`.`tracking_no`,`gd`.`trip_no`,   
        GROUP_CONCAT(`gd`.`invoiceno`) as `goods_invoice`, SUM(`gd`.`pcs`) as `tot_pcs`, ROUND(SUM(`gd`.`weight`),2) as `tot_weight`  FROM `goods_details` as `gd`  
       LEFT JOIN `goods_status` as `gs` ON `gs`.`id`=`gd`.`current_status_id`   
       LEFT JOIN `trip_sheet_cargos` as `tc` ON `gd`.`invoiceno`=`tc`.`invoice_number` 
       LEFT JOIN `goods_transfer_details` as `gtd` ON `gd`.`current_transfer_id`=`gtd`.`id` 
       WHERE  $condition    group by `gd`.`tracking_no`";  */


 
        $qry = "SELECT `gd`.`created_at`, `gd`.`received_date`,`gd`.`goods_status`,`gd`.`created_at` as `status_date`, `gd`.`rewight`,`gd`.`shipmentname`,`gd`.`invoiceno`,`gd`.`pcs`,`gd`.`weight`,`gd`.`reciever_address`,`gd`.`district`,`gd`.`vendor`, `gd`.`docket`,`gd`.`current_status_id` ,`gd`.`is_transfer`, `gd`.`current_transfer_id`,  `gd`.`url` ,`gd`.`tracking_no`,`gd`.`trip_no`, `gd`.`recieved_at_hub`, `gd`.`recieved_at_branch`,
         `gs`.`goods_status` as `goods_current_status`,
         `gs`.`created_at` as `goods_status_date`,  
         `gtd`.`created_at` as `transferred_date` , `tc`.`created_at`,`tc`.`invoice_number`, 
         IFNULL(`tc`.`estimate_arrival_date` , `ts`.`estimate_arrival_date` )as `estimate_arrival_date`, 
         `gd`.`invoiceno` as `goods_invoice`, `gd`.`pcs` as `tot_pcs`, ROUND(`gd`.`weight`,2) as `tot_weight`
         FROM `goods_details` as `gd` 
        LEFT JOIN `goods_status` as `gs` ON `gs`.`id`=`gd`.`current_status_id`
        LEFT JOIN `trip_sheet_cargos` as `tc` ON `gd`.`invoiceno`=`tc`.`invoice_number` 
        LEFT JOIN `goods_transfer_details` as `gtd` ON `gd`.`current_transfer_id`=`gtd`.`id`   
        LEFT JOIN `trip_sheet` as `ts` ON `gd`.`trip_sheet_id`=`ts`.`id`   
        WHERE  $condition  and  `gd`.id >= $offset
        order by `gd`.`id` ASC limit $limit";   


//    echo $qry; die;

        $query = $this->db->query( $qry);

        $this->db->from('goods_details');
        if ($query->num_rows() > 0) 
        {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }  
            return $data;
        }
        return false;
    }
    
    



    
    public function get_mis_report($condition  ){    
 
        /*
        $qry = "SELECT  `gs`.`goods_status` as `goods_current_status`,`gs`.`created_at` as `goods_status_date`, `gd`.`received_date`, `gd`.`rewight`,`gd`.`shipmentname`,`gd`.`invoiceno`,`gd`.`pcs`,`gd`.`weight`,`gd`.`reciever_address`,`gd`.`district`,`gd`.`vendor`, `gd`.`docket`,`gd`.`current_status_id` ,`gd`.`is_transfer`, `gd`.`current_transfer_id`, `gtd`.`created_at` as `transferred_date` , `gd`.`recieved_at_hub`, `gd`.`recieved_at_branch` , `tc`.`created_at`,`tc`.`invoice_number`, `tc`.`estimate_arrival_date` as `estimate_arrival_date`,  `gd`.`url` ,`gd`.`tracking_no`,`gd`.`trip_no`,   
        GROUP_CONCAT(`gd`.`invoiceno`) as `goods_invoice`, SUM(`gd`.`pcs`) as `tot_pcs`, ROUND(SUM(`gd`.`weight`),2) as `tot_weight`  FROM `goods_details` as `gd`  
       LEFT JOIN `goods_status` as `gs` ON `gs`.`id`=`gd`.`current_status_id`   
       LEFT JOIN `trip_sheet_cargos` as `tc` ON `gd`.`invoiceno`=`tc`.`invoice_number` 
       LEFT JOIN `goods_transfer_details` as `gtd` ON `gd`.`current_transfer_id`=`gtd`.`id` 
       WHERE  $condition    group by `gd`.`tracking_no`";  */


 
        $qry = "SELECT `gd`.`created_at`, `gd`.`received_date`,`gd`.`goods_status`,`gd`.`created_at` as `status_date`, `gd`.`rewight`,`gd`.`shipmentname`,`gd`.`invoiceno`,`gd`.`pcs`,`gd`.`weight`,`gd`.`reciever_address`,`gd`.`district`,`gd`.`vendor`, `gd`.`docket`,`gd`.`current_status_id` ,`gd`.`is_transfer`, `gd`.`current_transfer_id`,  `gd`.`url` ,`gd`.`tracking_no`,`gd`.`trip_no`, `gd`.`recieved_at_hub`, `gd`.`recieved_at_branch`,
         `gs`.`goods_status` as `goods_current_status`,
         `gs`.`created_at` as `goods_status_date`,  
         `gtd`.`created_at` as `transferred_date` , `tc`.`created_at`,`tc`.`invoice_number`, 
         IFNULL(`tc`.`estimate_arrival_date` , `ts`.`estimate_arrival_date` )as `estimate_arrival_date`, 
         `gd`.`invoiceno` as `goods_invoice`, `gd`.`pcs` as `tot_pcs`, ROUND(`gd`.`weight`,2) as `tot_weight`
         FROM `goods_details` as `gd` 
        LEFT JOIN `goods_status` as `gs` ON `gs`.`id`=`gd`.`current_status_id`
        LEFT JOIN `trip_sheet_cargos` as `tc` ON `gd`.`invoiceno`=`tc`.`invoice_number` 
        LEFT JOIN `goods_transfer_details` as `gtd` ON `gd`.`current_transfer_id`=`gtd`.`id`   
        LEFT JOIN `trip_sheet` as `ts` ON `gd`.`trip_sheet_id`=`ts`.`id`   
        WHERE  $condition";   


//   echo $qry; die;

        $query = $this->db->query( $qry);

        $this->db->from('goods_details');
        if ($query->num_rows() > 0) 
        {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }  
            return $data;
        }
        return false;
    }
    
    

    public function get_reports_admin($condition ,$limit, $start)
    { 
        $offset = ($start-1)*$limit;  
        $query = $this->db
                ->select('trip_sheet_cargos.*,trip_sheet.vehicle_number as vehicle_number , trip_sheet.vehicle_drivername as vehicle_drivername, branches.branch_name ')
                ->join( 'trip_sheet', 'trip_sheet_cargos.trip_sheet_id=trip_sheet.id' ,'left') 
                ->join( 'branches', 'trip_sheet_cargos.branch_id=branches.id' ,'left') 
                ->like($condition)  
                ->limit($limit, $offset)
                ->get('trip_sheet_cargos');  
       
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
            $data[] = $row;
            }
            return $data;
            }
            return false;

    }


    public function count_all_data_condition_ordersearch_admin($table_name, $condition, $clmnname, $cndt, $sqry, $join, $join_cond){ 
      
        if(!empty($join)){
            $this->db->join( $join, $join_cond,'left') ;
        }
        $this->db->where($condition);
        $this->db->like($sqry) ;
        $this->db->order_by($clmnname,$cndt) ;
        $query =  $this->db->get($table_name); 

        return $query->num_rows();
    }

    public function get_all_data_join($table_name, $condition, $limit, $start, $clmnname, $cndt, $sqry, $join, $join_cond){ 

        $offset = ($start-1)*$limit;
        $this->db->limit($limit, $offset);
        $this->db->select('shipments.*  , cargo.header');
        $this->db->join( $join, $join_cond,'left');
        $this->db->where($condition);
        $this->db->where($sqry);
        $this->db->order_by($clmnname,$cndt);
    
        $query = $this->db->get($table_name); 
    
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;

    }
 

    public function get_reports($condition ,$limit, $start )
    {
        if($condition){ 
            $offset = ($start-1)*$limit;  
            $query = $this->db  
                    ->select('trip_sheet.*  , trip_sheet_cargos.*, trip_sheet_cargos.status as cargo_status')
                     ->join( 'trip_sheet', 'trip_sheet_cargos.trip_sheet_id=trip_sheet.id' ,'left')
                    ->like($condition) 
                    ->order_by('trip_sheet_cargos.id', 'ASC') 
                    ->limit($limit, $offset)
                    ->get('trip_sheet_cargos');  
        }else{

            $offset = ($start-1)*$limit;  
            $query = $this->db  
                    ->select('trip_sheet.*  , trip_sheet_cargos.*, trip_sheet_cargos.status as cargo_status')
                     ->join( 'trip_sheet', 'trip_sheet_cargos.trip_sheet_id=trip_sheet.id' ,'left') 
                    ->limit($limit, $offset) 
                    ->order_by('trip_sheet_cargos.id', 'ASC') 
                    ->get('trip_sheet_cargos');  
        }


        // echo $this->db->last_query();
        // die;
       
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
            $data[] = $row;
            }

            // echo $this->db->last_query();
            //  die;
            return $data;
            }
            return false;

    }

    //user_myservices
    public function count_my_services($table_name,$condition,$clmnname,$cndt){
    $query = $this->db
            ->where($condition)
            ->order_by($clmnname,$cndt)
            ->get($table_name);
    return $query->num_rows();
    }

    public function get_all_data($table_name, $condition, $clmnname, $cndt, $new_checkbox=array()) {

      
        $this->db->select('*');
        $this->db->where($condition);
            if(!empty($new_checkbox)){
                $this->db->where_in('id',$new_checkbox);
            }
            $this->db->order_by($clmnname,$cndt);
            $query = $this->db->get($table_name);
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $data[] = $row;
                }
                return $data;
            }
        return false;
    }
 

    public function  get_count_goods_transfer_id($table_name, $branch_id, $clmnname, $cndt ) {

        //and transfer_status = 'pending'  group by  transfer_id
        $qry = "SELECT transfer_id, count(*) as goods_count  FROM `goods_details`  where transferred_to ='".$branch_id."'  AND transfer_status = 'pending'  group by  transfer_id";      
 
        $query = $this->db->query( $qry);
        // echo $this->db->last_query();

        // die;
     
        // $this->db->from('goods_details');
        if ($query->num_rows() > 0) 
        {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }      
            return $data;
        }
        return false;


    }


    public function get_all_data_selected_print($table_name,$condition,$clmnname,$cndt,$new_checkbox=array()) {
       
       
        $this->db->select('*,  GROUP_CONCAT(invoiceno) as goods_invoice, SUM(pcs) as tot_pcs, ROUND(SUM(weight),2) as tot_weight ');
        // $this->db->select('* ');
        $this->db->where($condition);
            if(!empty($new_checkbox)){
                $this->db->where_in('id',$new_checkbox);
            }
            $this->db->group_by('tracking_no');

            $this->db->order_by($clmnname,$cndt);

            $query = $this->db->get($table_name);

            // echo $this->db->last_query();
            // die;
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $data[] = $row;
                }
                return $data;
            }
        return false;
    }

  

    public function get_all_trip_no($table_name,$condition,$clmnname,$cndt) { 
       

        $qry = "SELECT DISTINCT `trip_no` FROM  `goods_details` order by `trip_no`";
       

        $query = $this->db->query( $qry); 
            //         echo $this->db->last_query();
            // die;

        // $this->db->from('goods_details');
        if ($query->num_rows() > 0) 
        {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }  
            return $data;
        }
        return false; 
               
    }

    public function get_selected_data($table_name,$condition) { 

        $this->db->select("transferred_from, transferred_to"); 
        $this->db->where( $condition );
         
        $query = $this->db->get($table_name); 
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $data[] = $row;
                }
                return $data;
            }
        return false;
    }

    
    public function get_branch($table_name,$id) { 

        $this->db->select("name"); 
        $this->db->where( 'id', $id );
         
        $query = $this->db->get($table_name); 
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $data[] = $row;
                }
                return $data;
            }
        return false;
    }

    

    function edit_table_account($table,$data,$id,$clmn) {
        $this->db->where($clmn,$id);
        $this->db->update($table,$data);
    }
    function delete_table_account($table,$id,$clmn) {
        $this->db->where($clmn,$id);
        $this->db->delete($table);
    }

    function delete_table_account_multiple_cdn($table,$condition) {
        $this->db->where($condition );
        $this->db->delete($table);
        
    }

 
    public function delete_single_goods_records($table, $id,$column) {
        // $qry = "INSERT into deleted_goods_details  SELECT * from $table WHERE  $column =$id";  
        // $query = $this->db->query( $qry);
        
        $this->db->where($column,$id);
        $this->db->delete($table);         
            
    }


    public function delete_goods_records($implode_values , $checkbox_arr) {

        if(empty($checkbox_arr))
        {
            return false;
        }
        else{  

            $this->db->where_in('id',$checkbox_arr);
            $this->db->delete('goods_details');
            // echo $this->db->last_query();
            // die;
            return true;
        }
    }

    public function delete_shipments_records( $shipment_id ){

        $this->db->where('id',$shipment_id);
        $this->db->delete('shipments');

        $this->db->where('shipment_id',$shipment_id);
        $this->db->delete('shipment_details');
        
        return true;
    }



    // public function remove_goods_records($checkbox_arr) {
    //     if(empty($checkbox_arr))
    //     {
    //         return false;
    //     }
    //     else{
    //         $this->db->where_in('id',$checkbox_arr);
    //         $this->db->delete('goods_details');
    //         return true;
    //     }
    // }
    
    public function get_shipment_name($clmn,$id)
    { 

        $qry = "SELECT  distinct(shipmentname)  FROM `goods_details` order by  shipmentname" ;      

        $query = $this->db->query( $qry); 
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
 
    }


    public function get_cargo_name( )
    { 

        $qry = "SELECT  distinct(company) as cargo_name  FROM `goods_details` order by  company" ;      

        $query = $this->db->query( $qry); 
        // echo $this->db->last_query();
        // die;
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
 
    }



   
    public function college_couses_lists($limit, $start,$colllege_id) {
    $offset = ($start-1)*$limit;
    $this->db->limit($limit, $offset);
    $this->db->select('college_courses.id,college_courses.admin_notes,college_courses.college_id,college_courses.d_order,college_courses.status,courses.title,courses.cover_photo_location,courses.cover_photo')
         ->from('college_courses')
         ->join('courses', 'courses.id = college_courses.course_id')
         ->where('college_courses.college_id',$colllege_id);
    $this->db->order_by('college_courses.id','DESC');

    $query = $this->db->get();
    if ($query->num_rows() > 0) {
    $dts=$query->result();
    return $dts;
    }
    return false;
    }
    public function list_college_by_course_id($limit, $start,$courseid,$countryid) {
    $offset = ($start-1)*$limit;
    $this->db->limit($limit, $offset);
    $this->db->select('colleges.id,colleges.title,colleges.summery,colleges.cover_photo_location,colleges.cover_photo,colleges.country_id')
         ->from('college_courses')
         ->join('colleges', 'colleges.id = college_courses.college_id')
         ->where('college_courses.course_id',$courseid)
         ->where('college_courses.status',0)
         
         ->where('colleges.status',0);
         if($countryid!=0){
            $this->db->where('colleges.country_id',$countryid);
         } 
    $this->db->order_by('colleges.id','DESC');

    $query = $this->db->get();
    if ($query->num_rows() > 0) {
    $dts=$query->result();
    return $dts;
    }
    return false;
    }
    public function courses_count_by_collegeid_country_id($colllege_id,$country_id,$course_sections_id){
          $this->db->from('college_courses')
         ->join('courses', 'courses.id = college_courses.course_id')
         ->join('colleges', 'colleges.id = college_courses.college_id')
         ->where('colleges.country_id',$country_id)
         ->where('college_courses.course_sections_id',$course_sections_id)
         ->where('college_courses.college_id',$colllege_id);
    $query = $this->db->get();
    return $query->num_rows();
    }


    public function courses_lists_by_collegeid_country_id($limit, $start,$colllege_id,$country_id,$course_sections_id) {
    $offset = ($start-1)*$limit;
    $this->db->limit($limit, $offset);
    $this->db->select('college_courses.id,college_courses.college_id,college_courses.d_order,college_courses.status,courses.id as courseids,courses.summery,courses.title,courses.cover_photo_location,courses.cover_photo')
         ->from('college_courses')
         ->join('courses', 'courses.id = college_courses.course_id')
          ->join('colleges', 'colleges.id = college_courses.college_id')
         ->where('colleges.country_id',$country_id)
         ->where('college_courses.course_sections_id',$course_sections_id)
         ->where('college_courses.college_id',$colllege_id);
    $this->db->order_by('college_courses.id','DESC');

    $query = $this->db->get();
    if ($query->num_rows() > 0) {
    $dts=$query->result();
    return $dts;
    }
    return false;
    }

    public function single_college_by_course_id($courseid,$countryid,$college_id) {
    $this->db->select('colleges.id,colleges.title,colleges.summery,colleges.cover_photo_location,colleges.cover_photo,colleges.country_id')
         ->from('college_courses')
         ->join('colleges', 'colleges.id = college_courses.college_id')
         ->where('college_courses.course_id',$courseid)
         ->where('college_courses.college_id',$college_id)
         ->where('college_courses.status',0)
         ->where('colleges.status',0);
         if($countryid!=0){
            $this->db->where('colleges.country_id',$countryid);
         } 
    $this->db->order_by('colleges.id','DESC');

    $query = $this->db->get();
    if ($query->num_rows() > 0) {
    $dts=$query->result();
    return $dts;
    }
    return false;
    }

    public function get_current_user() {

        $user = $this->session->userdata("adminloginel");

        $this->db->select('*')
            ->from('administrator')
            ->where('id', $user['id']);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_current_user_branch($user_id) {


        $this->db->select('*')
            ->from('administrator')
            ->where('id', $user_id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    
public function display_details($inv){ 

   $this->db->select('pcs, weight, district, phone,company, is_transfer, transfer_status, tracking_no');
   $this->db->from('goods_details');
   $this->db->where('id', $inv);
   $query = $this->db->get();
   return $query->result() ;

}

public function list_invoice_numbers(){

   $this->db->select('id, invoiceno'); 
   $this->db->from('goods_details');
   $this->db->limit(10, 10);
  
   $query = $this->db->get();
   return $query->result() ;

}

public function list_invoice_numbers_by($id,$condition){ 
    
    $this->db->like('tracking_no', $id, 'both'); 
    $this->db->where($condition);    
    $this->db->group_by('tracking_no'); 
    $this->db->from('goods_details');
    $query = $this->db->get();
    return $query->result() ;

}

    


public function get_all_active_branches(){

    $this->db->select('id, name, username, email, branch, role, status');
    $this->db->from('administrator');
    $this->db->where('status', 0);
    $this->db->where_in('role', ['branch','vendor']);
    $query = $this->db->get();
    return $query->result() ;

}

public function get_all_invoice_by_status_admin($table,$condition  ){ 
 
    $this->db->select('invoice_number, cargo_name, trip_sheet.trip_sheet_name as trip_sheet_id'); 
    $this->db->join('trip_sheet', 'trip_sheet_cargos.trip_sheet_id =trip_sheet.id');
    // $this->db->where($column, $branch_id);    
    $this->db->where($condition );    
    $this->db->from($table);

    $query = $this->db->get();
    return $query->result() ;

}


public function get_all_invoice_by_status($table,$condition , $branch_id, $column){ 
 
    $this->db->select('invoice_number, cargo_name, trip_sheet.trip_sheet_name as trip_sheet_id'); 
    $this->db->join('trip_sheet', 'trip_sheet_cargos.trip_sheet_id =trip_sheet.id');
    $this->db->where($column, $branch_id);    
    $this->db->where($condition );    
    $this->db->from($table);

    $query = $this->db->get();
    return $query->result() ;

}


public function get_invoice_number($table_name,$id) { 

    $this->db->select("invoiceno"); 
    $this->db->where( 'id', $id );
     
    $query = $this->db->get($table_name); 
    
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    return false;
}

public function get_data($table_name,$id) { 

    
    $this->db->select("*"); 
    $this->db->where( 'id', $id );
     
    $query = $this->db->get($table_name); 
    
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    return false;
}

public function get_all_goods_details($table_name,$condition) { 

    $this->db->select("*"); 
    $this->db->where(  $condition );
     
    $query = $this->db->get($table_name); 
    // echo $this->db->last_query();
    // die;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    return false;
}

public function get_count_by_status($table_name,$condition) { 

    $query = $this->db
                ->where($condition)
                ->get($table_name);

    return $query->num_rows();

}

public function get_highest_sort_order($table_name,  $branch_id){
 
    $qry = "SELECT  MAX(sort_order) as last_sort_order  FROM `goods_details`  where  branch_id = $branch_id and trip_sheet_id IS NULL";      
 
    $query = $this->db->query( $qry);
    // echo $this->db->last_query();
 
    // $this->db->from('goods_details');
    if ($query->num_rows() > 0) 
    {
        foreach ($query->result() as $row) {
            $data[] = $row;
        }      
        return $data;
    }
    return false;

}

public function get_sort_order_count($table_name, $branch_id){
   
    $qry = "SELECT id  FROM `goods_details` where sort_order is NOT NULL AND branch_id = $branch_id  and trip_sheet_id IS NULL";   

    $query = $this->db->query( $qry);
//         echo $this->db->last_query();
// die;
    return $query->num_rows();

}

public function reset_checked($table_name, $branch_id){
    
    $qry = "UPDATE `goods_details` SET sort_order = NULL where  branch_id = $branch_id and trip_sheet_id IS NULL";   

    $query = $this->db->query( $qry); 
    // echo $this->db->last_query();
    // die;
}


public function getSelectedData($table_name, $columns, $condition){

    $this->db->select($columns);
    $this->db->from( $table_name );
    $this->db->where($condition); 
    $query = $this->db->get(); 
    return $query->result() ;


}

public function get_all_not_delivered_goods_admin($table,$condition , $limit, $start){  

    if($limit != NULL ){
     $offset = ($start-1)*$limit;
     $this->db->limit($limit, $offset);
    } 
     
     $this->db->select('trip_sheet_cargos.goods_id, trip_sheet_cargos.estimate_arrival_date,trip_sheet.estimate_arrival_date, goods_details.estimate_delivery_date, IFNULL( trip_sheet_cargos.estimate_arrival_date,  IFNULL(  trip_sheet.estimate_arrival_date , goods_details.estimate_delivery_date )) AS ` trip_sheet_cargos_estimate_arrival_date` , goods_details.trip_no, goods_details.tracking_no,goods_details.invoiceno  ');
     $this->db->from('trip_sheet_cargos'); 
     $this->db->join('trip_sheet', 'trip_sheet_cargos.trip_sheet_id  = trip_sheet.id' );
     $this->db->join('goods_details', 'trip_sheet_cargos.goods_id = goods_details.id' ); 
     $this->db->where($condition);	 
 
     $query = $this->db->get();    
        
         $count = 0;
         $filter = [];
         if ($query->num_rows()) {
             $data = $query->result();
             foreach($data as $val) {
                if(  date('d-m-Y',strtotime($val->trip_sheet_cargos_estimate_arrival_date))  < date('d-m-Y') ) { 
                     $count = $count +1;
                     array_push($filter, $val);
                 }  
             }
             return $filter; 
         } else {
             return false;
         }
 }


public function get_all_not_delivered_goods($table,$condition , $branch_id, $column, $limit, $start){  

   if($limit != NULL ){
    $offset = ($start-1)*$limit;
    $this->db->limit($limit, $offset);
   } 
    
    $this->db->select('trip_sheet_cargos.goods_id, trip_sheet_cargos.estimate_arrival_date,trip_sheet.estimate_arrival_date, goods_details.estimate_delivery_date, IFNULL( trip_sheet_cargos.estimate_arrival_date,  IFNULL(  trip_sheet.estimate_arrival_date , goods_details.estimate_delivery_date )) AS ` trip_sheet_cargos_estimate_arrival_date` , goods_details.trip_no, goods_details.tracking_no,goods_details.invoiceno  ');
    $this->db->from('trip_sheet_cargos'); 
    $this->db->join('trip_sheet', 'trip_sheet_cargos.trip_sheet_id  = trip_sheet.id' );
    $this->db->join('goods_details', 'trip_sheet_cargos.goods_id = goods_details.id' ); 
    $this->db->where($condition);	 
    $this->db->where('trip_sheet_cargos.branch_id',$branch_id);	 

    $query = $this->db->get();    
       
        $count = 0;
        $filter = [];
        if ($query->num_rows()) {
            $data = $query->result();
            foreach($data as $val) {  
                if(  date('d-m-Y',strtotime($val->trip_sheet_cargos_estimate_arrival_date))  < date('d-m-Y') ) { 
                    $count = $count +1;
                    array_push($filter, $val);
                } 
                
            }
            return $filter; 
        } else {
            return false;
        }
        
}


public function getBranchName($id,$condition){

    $this->db->select('branch_name');
    $this->db->from( 'branches' );
    $this->db->where($condition); 
    $query = $this->db->get(); 
    return $query->result() ;


}



/*

public function get_all_data_condition_ordersearch_goods($table_name,$condition,$limit, $start,$clmnname,$cndt,$sqry, $searchqry_in ) {
 
    $array_check = array(NULL, 'confirmed');
     
    $offset = ($start-1)*$limit;
    $this->db->limit($limit, $offset);
    
    $this->db->select('* ');  
    $this->db->where($condition);            
    $this->db->where($sqry);
    $this->db->where('trip_sheet_id is NULL' );
    $this->db->group_start();
    $this->db->where('transfer_status is NULL' );
    $this->db->or_where('transfer_status','confirmed');   
    $this->db->group_end(); 
    $this->db->where_in('trip_no', $searchqry_in); 
    $this->db->order_by($clmnname,$cndt);
    // $this->db->group_by('id');

    $query = $this->db->get($table_name);

    // echo $this->db->last_query(); die();
    if ($query->num_rows() > 0) {
    foreach ($query->result() as $row) {
    $data[] = $row;
    }
    return $data;
    }
    return false;
    }



*/



}

///