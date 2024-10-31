<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//admin_session_check
if (!function_exists('admin_session_check'))
{
    function admin_session_check()
    {
        $CI =& get_instance();
        if(isset($CI->session->userdata['adminloginel']))
        {
            
        }
        else
        {
            $CI->session->set_flashdata('login_error',"<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-times-circle'></i>Please login</div>");
            redirect(base_url().'auth');
        }
    }
}

//super_admin_session_check
if (!function_exists('super_admin_session_check'))
{
    function super_admin_session_check()
    {
        $CI =& get_instance();
        if(isset($CI->session->userdata['adminloginel']))
        {
            if( $CI->session->userdata['adminloginel']['role'] == "superadmin"){
               
            } else {               
                $CI->session->set_flashdata('login_error',"<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-times-circle'></i>Please login</div>");
                redirect(base_url().'auth');
            } 

        }
        else
        {
            $CI->session->set_flashdata('login_error',"<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=\"this.parentElement.style.display='none';\">×</span><i class='fa fa-times-circle'></i>Please login</div>");
            redirect(base_url().'auth');
        }
    }
}


//get_cargo_company_header_image
if (!function_exists('get_cargo_company_header_image'))
{
    function get_cargo_company_header_image($id)
    {
        $CI =& get_instance();
        $CI->load->model('admin_model');
        $data_cndtnx	= array('id' => $id);
        $cargo 		= $CI->admin_model->get_all_data('cargo', $data_cndtnx, 'id', 'DESC');
        if(!empty( $cargo )){
            $header_image 	= $cargo[0]->header; 
        }else {
            $header_image = null; 
        }
        return $header_image;
         
    }
}


//get_cargo_company_contact_number
if (!function_exists('get_cargo_company_contact_number'))
{
    function get_cargo_company_contact_number($id)
    {
        $CI =& get_instance();
        $CI->load->model('admin_model');
        $data_cndtnx	= array('id' => $id);
        $cargo 		= $CI->admin_model->get_all_data('cargo', $data_cndtnx, 'id', 'DESC');
        if(!empty( $cargo )){
            $contact_details 	= $cargo[0]->contactnumber; 
        }else {
            $contact_details = null; 
        }
        return $contact_details;
         
    }
}

?>
