<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

/////////////////Start Menu permission//////////////////////////////////
function menu_permission($menu_field_name,$role)
{
    if($role=='1')
    {
   $query=$this->db->get_where('side_bar', array('admin' => '1','field_name'=>$menu_field_name));
   if ($query->num_rows() == 1) {return '1';} else { return '0';}
    }
    else if($role=='2')
    {
   $query=$this->db->get_where('side_bar', array('user' => '1','field_name'=>$menu_field_name));
   if ($query->num_rows() == 1){return '1';} else { return '0';}
    }
  else
   {
   return '1';   
    }
}   

function all_datas($table,$id,$table_name) {
    $this->db->select('*');
    $this->db->from($table);
    $this->db->where($table_name,$id);
    $this->db->where('status','0');
    $this->db->order_by('id','DESC');
    $query = $this->db->get();
    if ($query->num_rows() == 0) 
    {      
    return 0;
    }
    else{
        return $query->result();
    }
}

function all_datas_selected_columns($table,$id,$table_name, $cols) {
    $this->db->select($cols);
    $this->db->from( $table );
    $this->db->where($table_name,$id);
    // $this->db->where('status','0');
    // $this->db->order_by('id','DESC');
    $query = $this->db->get(); 
   
    if ($query->num_rows() == 0) 
    {      
    return 0;
    }
    else{
        return $query->result();
    }
}

 function Get_side_menu_db() 
 {
$role=$this->session->userdata['logged_in']['role'];
if($role=='1'){$condition="admin='1' and menu='1'";}
    elseif($role=='2'){$condition="user='1' and menu='1'";}
    else{$condition="super_admin='1' and menu='1'";}
    
$this->db->select('*');
$this->db->from('side_bar');
$this->db->where($condition);
$this->db->order_by("order",'ASC');
$query = $this->db->get();
  
return $query->result();
}
public function count_all_data_condition($table_name,$condition){
$query = $this->db
        ->where($condition)
        ->get($table_name);
return $query->num_rows();
}
public function hotelmenulists($id){
$this->db->select('hotel_menu.price,hotel_menu.delivery_charge,food_items.item_name,food_items.image_location,food_items.image_name, ')
         ->from('hotel_menu')
         ->join('food_items', 'food_items.id = hotel_menu.fooditem_id')
         ->where('hotel_menu.hotel_id',$id);
$query = $this->db->get();
return $query->num_rows();
}
function table_details_new($table,$id,$table_name) {
    $query=$this->db->get_where($table, array($table_name => $id));
    if ($query->num_rows() == 1) 
        {
            
    return $query->result();

        } 
    else { return '0';}
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
function update_table_status($table,$id,$clmn) {
    $data=array('status'=>'1');
    $this->db->where($clmn,$id);
    $this->db->update($table,$data);
}

 function Get_side_menu_db_permission($field_name) 
 {
$condition="field_name='".$field_name."'";
$this->db->select('*');
$this->db->from('side_bar');
$this->db->where($condition);
$query = $this->db->get();
return $query->result();
}

 function permission_user() 
 {
$this->db->select('*');
$this->db->from('side_bar');
//$this->db->where('field_name',$fldnm);
$query = $this->db->get();
return $query->result();
}

/////////////////Edit Show  Users Details for id based specific users//////////////////////////////////
    function Users_Details($id) {
    $query=$this->db->get_where('login', array('login_id' => $id));
    if ($query->num_rows() == 1) 
        {
            
return $query->result();

        } 
    else { return '0';}
    }

        function check_username($username) {
    $query=$this->db->get_where('login', array('user' => $username));
    if ($query->num_rows() == 1) {return '1';} else { return '0';}
    }

    /////////////////Start User Account  Updation//////////////////////////////////
function edit_user_account($data,$id) {
$this->db->where('login_id',$id);
$this->db->update('login',$data);
    }



function create_table_account($table,$data) {
    $this->db->insert($table,$data);
    
    $insert_id = $this->db->insert_id();
 
    return  $insert_id;
}

public function count_all_data($table_name){
    return $this->db->count_all($table_name);
}

public function count_all_data_stts($table_name){
    $this->db->where('status','0');
    return $this->db->count_all($table_name);
}

public function count_all_data_stts_ctg($table_name,$ctgnm){
    $this->db->where('status','0');
    $this->db->where_in('category_id',$ctgnm);
    $query=$this->db->get($table_name);
    return $query->num_rows();
}

public function count_all_data_stts_ctg_brnd($table_name,$ctgnm){
    $this->db->where('status','0');
    $this->db->where_in('brand_id',$ctgnm);
    $query=$this->db->get($table_name);
    return $query->num_rows();
}




public function get_all_data($table_name,$limit, $start,$pk_id) {
$offset = ($start-1)*$limit;
$this->db->limit($limit, $offset);
$this->db->select('*');
$this->db->order_by($pk_id,"desc");
$query = $this->db->get($table_name);
if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}
return $data;
}
return false;
}

public function get_all_data_ctg($table_name,$limit, $start,$pk_id,$catid) {
$offset = ($start-1)*$limit;
$this->db->limit($limit, $offset);
$this->db->select('*');
$this->db->where('category_id',$catid);
$this->db->order_by($pk_id,"desc");
$query = $this->db->get($table_name);
if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}
return $data;
}
return false;
}


public function get_all_data_ctg_brnd($table_name,$limit, $start,$pk_id,$catid) {
$offset = ($start-1)*$limit;
$this->db->limit($limit, $offset);
$this->db->select('*');
$this->db->where('brand_id',$catid);
$this->db->order_by($pk_id,"desc");
$query = $this->db->get($table_name);
if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}
return $data;
}
return false;
}


public function get_all_data_stts_arry($table_name,$limit, $start,$pk_id,$arr) {
$offset = ($start-1)*$limit;
$this->db->limit($limit, $offset);
$this->db->select('*');
$this->db->where('status','0');
$this->db->where($arr);
$this->db->order_by($pk_id,"desc");
$query = $this->db->get($table_name);
if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}
return $data;
}
return false;
}
public function events_limit($table_name,$pk_id) {
$offset = (1-1)*7;
$this->db->limit(7, $offset);
$this->db->select('*');
$this->db->where('status','0');
$this->db->order_by($pk_id,"desc");
$query = $this->db->get($table_name);
if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}
return $data;
}
return false;
}
public function get_all_data_stts($table_name,$pk_id) {
$this->db->select('*');
$this->db->where('status','0');
$this->db->order_by($pk_id,"desc");
$query = $this->db->get($table_name);
if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}
return $data;
}
return false;
}
public function get_all_data_stts2($table_name,$pk_id,$ordr) {
$this->db->select('*');
$this->db->where('status','0');
$this->db->order_by($pk_id,$ordr);
$query = $this->db->get($table_name);
if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}
return $data;
}
return false;
}


public function get_all_data_stts_dfgf($table_name,$pk_id,$arr) {
$this->db->select('*');
$this->db->where('status','0');
$this->db->where($arr);
$this->db->order_by($pk_id,"desc");
$query = $this->db->get($table_name);
if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}
return $data;
}
return false;
}




public function get_all_data_stts_one($table_name,$pk_id,$clmn_nm,$clmn_vlu) {
$this->db->select('*');
$this->db->where('status','0');
$this->db->where($clmn_nm,$clmn_vlu);
$this->db->order_by($pk_id,"desc");
$this->db->limit('8');
$query = $this->db->get($table_name);
if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}
return $data;
}
return false;
}
public function get_all_data_stts_one_two($table_name,$pk_id,$pk_id_order,$limitvl) {
$this->db->select('*');
$this->db->where('status','0');
$this->db->order_by($pk_id,$pk_id_order);
$this->db->limit($limitvl);
$query = $this->db->get($table_name);
if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}
return $data;
}
return false;
}
public function get_all_data_randomly($table_name,$pk_id) {
$this->db->select('*');
$this->db->where('status','0');
$this->db->order_by($pk_id,"desc");
$this->db->limit('8');
$query = $this->db->get($table_name);
if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}
return $data;
}
return false;
}

public function get_all_data_ids($table_name,$pk_id,$clmn2,$clmn_id) {
$this->db->select('*');
$this->db->where('status','0');
$this->db->where($clmn2,$clmn_id);
$this->db->order_by($pk_id,"desc");
$query = $this->db->get($table_name);
if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}
return $data;
}
return false;
}


function delete_tbl_stts($table,$acc_uid,$status_id,$clmn_nm) {
if($status_id=='1'){
    $data=array('status'=>'1');
}
elseif ($status_id=='0') {
    $data=array('status'=>'0'); 
}
$this->db->where($clmn_nm,$acc_uid);
$this->db->update($table,$data);
    }



public function count_all_data_withwhere($table_name,$clmn,$datas){
    $this->db->where_in($clmn,$datas);
    $query=$this->db->get($table_name);
    return $query->num_rows();
}

public function count_all_data_withwhere_cat($table_name,$clmn,$datas){
    $this->db->where_in($clmn,$datas);
    $this->db->where('status','0');
    $query=$this->db->get($table_name);
    return $query->num_rows();
}
public function count_all_data_withwhere_arrty($table_name,$datas){
    $this->db->where($datas);
    $this->db->where('status','0');
    $query=$this->db->get($table_name);
    return $query->num_rows();
}


function table_details($table,$id,$clmn) {
$query=$this->db->get_where($table, array( $clmn=> $id));
if ($query->num_rows() == 1) 
    {
        
return $query->result();

    } 
else { 
    return '0';
}
}
function table_details_nov($table,$cndtn) {
    $this->db->select('*');
    $this->db->where($cndtn);
    $query = $this->db->get($table);
    if ($query->num_rows() == 1) 
        {
            
    return $query->result();

        } 
    else { return '0';}
}
function table_details_dt($table,$cndtn) {
    $this->db->select('*');
    $this->db->where($cndtn);
    $query = $this->db->get($table);
    return $query->result();
}
function table_details_dtnw($table,$cndtn,$clmn,$ascdesc) {
    $this->db->select('*');
    $this->db->where($cndtn);
        $this->db->order_by($clmn,$ascdesc);
    $query = $this->db->get($table);

    return $query->result();
}

function edit_table_account($table,$data,$id,$clmn) {
    
$this->db->where($clmn,$id);
$this->db->update($table,$data);
 
}


 
    
  function unlink_image($table,$id,$clmn) {
    $query=$this->db->get_where($table, array($clmn => $id));
           $res = $query->result_array();
        foreach ($res as $row)
         $path='./assets/images/slider_main/'.$row['image'];
        if (file_exists($path)){
          unlink($path);
      }
    }
      function unlink_image_offr_bxs($table,$id,$clmn) {
    $query=$this->db->get_where($table, array($clmn => $id));
           $res = $query->result_array();
        foreach ($res as $row)
         $path='./assets/images/offer_box/'.$row['image'];
        if (file_exists($path)){
          unlink($path);
      }
    }

  function unlink_image_brand($table,$id,$clmn) {
    $query=$this->db->get_where($table, array($clmn => $id));
           $res = $query->result_array();
        foreach ($res as $row)
         $path='./assets/images/brand/'.$row['cover_photo'];
        if (file_exists($path)){
          unlink($path);
      }
    }


  function unlink_product_images($table,$id,$clmn) {
    $query=$this->db->get_where($table, array($clmn => $id));
           $res = $query->result_array();
        foreach ($res as $row)
         $path='./assets/images/products/'.$row['cover_photo'];
        if (file_exists($path)){
          unlink($path);
      }
    }

  function unlink_product_more_images($table,$id,$clmn) {
    $query=$this->db->get_where($table, array($clmn => $id));
           $res = $query->result_array();
        foreach ($res as $row)
         $path='./assets/mes/images/products/'.$row['image_url'];
        if (file_exists($path)){
          unlink($path);
      }
    }

    function delete_slider_imgsmes($table,$id,$clmn) {
    $data=array('status'=>'1');
    $this->db->where($clmn,$id);
    $this->db->update($table,$data);
    }
    function change_status($table,$id,$clmn,$stts) {
    $data=array('status'=>$stts);
    $this->db->where($clmn,$id);
    $this->db->update($table,$data);
    }


    function unlink_brnditem_more_images($table,$id,$clmn) {
    $query=$this->db->get_where($table, array($clmn => $id));
           $res = $query->result_array();
        foreach ($res as $row)
         $path='./assets/images/brand/'.$row['image'];
        if (file_exists($path)){
          unlink($path);
      }
    }

    function unlink_gallery_images($table,$id,$clmn) {
    $query=$this->db->get_where($table, array($clmn => $id));
           $res = $query->result_array();
        foreach ($res as $row)
         $path='./assets/images/gallery/'.$row['cover_photo'];
        if (file_exists($path)){
          unlink($path);
      }
    }


          function search_item($search){
                    $this->db->select('*');
                    $this->db->where('category_id',$search);
                    $this->db->order_by('id',"desc");
                    $query=$this->db->get('brand');
            if($query->num_rows()>0)
            {
                return $query->result();
            }
            else
            {
                return null;
            }
          }
public function get_all_data_condition($table_name,$condition) {
$this->db->select('*');
$this->db->where($condition);
$this->db->order_by('id','DESC');

$query = $this->db->get($table_name);

if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}
return $data;
}
return false;
}

function list_data_category_wise($ctid){
$this->db->select('category_id,sub_id,product_name,img_location,img_name');
$this->db->where('category_id',$ctid);
$this->db->order_by('d_order','ASC');

$query = $this->db->get('juicemenu_details');

if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}
return $data;
}
return false;
}
function list_data_category_subct_wise($ctid,$subct){
$this->db->select('category_id,sub_id,product_name,img_location,img_name');
$this->db->where('category_id',$ctid);
$this->db->where('sub_id',$subct);
$this->db->order_by('d_order','ASC');

$query = $this->db->get('juicemenu_details');

if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}
return $data;
}
return false;
}











////////////////////////////////// START AUTH//////////////////////////////////////////////
 function login($data) {

$condition = "user =" . $this->db->escape($data['user']) . " AND " . "password =" .$this->db->escape($data['password'])."";

$this->db->select('*');
$this->db->from('login');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();

if ($query->num_rows() == 1) {
// return $query->result();
    return true;

} else {
return false;
}
    }

    function login_read_data($user) {
    $condition ="user =" . $this->db->escape($user);
    $this->db->select('*');
    $this->db->from('login');
    $this->db->where($condition);
    $this->db->limit(1);
    $query = $this->db->get();

    if ($query->num_rows() == 1) {
    return $query->result();


    } else {
    return false;
    }
    }

    function get_all_dat_indb($tbl_name){
        $this->db->select('*');
        $strd=array(
            'status'=>'0'
            );
        $this->db->where($strd);
        $query = $this->db->get($tbl_name);
        if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
        $data[] = $row;
        }
        return $data;
        }
        return false;
    }
    function get_all_dat_indb_new($tbl_name,$colmn,$id){
        $this->db->select('*');
        $strd=array(
            'status'=>'0',
            $colmn=>$id
            );
        $this->db->where($strd);
        $query = $this->db->get($tbl_name);
        if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
        $data[] = $row;
        }
        return $data;
        }
        return false;
    }

    function get_sel_columns($tbl_name,$selColumns, $colmn,$id){
        $this->db->select($selColumns );
        $strd=array( 
            $colmn=>$id
            );
        $this->db->where($strd);
        $query = $this->db->get($tbl_name);
        if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
        $data[] = $row;
        }
        return $data;
        }
        return false;
    }

 
    public function get_all_lrno_by_invoice($table_name,$clmn,$datas){
        $this->db->select('invoice_number,lr_no, estimate_arrival_date '); 
        $this->db->where_in($clmn,$datas);
        $query=$this->db->get($table_name);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
            $data[] = $row;
            }
            return $data;
            }
            return false;
    }
    
    public function check_already_checked($table_name, $id){

        $qry = "SELECT id  FROM `goods_details` where id = $id and sort_order is NULL";  
      
        $query = $this->db->query( $qry);
          
        if($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }

    }

    public function check_duplicate($table_name, $condition){

        $this->db->select('id');
        $this->db->where($condition); 
        
        $data = [];
        $query = $this->db->get($table_name);
        
        // echo $this->db->last_query(); die();
        
        if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
        $data[] = $row;
        }
        return $data;
        }
        return $data;

    }

   

////////////////////////////////// END AUTH//////////////////////////////////////////////
}


///