<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manifesto_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

	function get_manifestos($branch_id) {
        $condition ="recieve_branch =" . $this->db->escape($branch_id);

        $this->db->select('*');
        $this->db->from('manifesto');
        $this->db->where($condition);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }
        
        return false;
    }

    function get_ogm($parent) {
        $condition ="parent =" . $this->db->escape($parent);

        $this->db->select('consigner_address, box_no, invoice_no, psc, kg, consignee_address, pincode, state, description');
        $this->db->from('manifesto_data');
        $this->db->where($condition);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }
        
        return false;
    }

    function get_loading_list($parent) {
        $condition ="parent =" . $this->db->escape($parent);

        $this->db->select('box_no, invoice_no, psc, kg, state, consigner_address');
        $this->db->from('manifesto_data');
        $this->db->where($condition);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }
        
        return false;
    }

    function get_sorting_list($parent) {
        $condition ="parent =" . $this->db->escape($parent);

        $this->db->select('box_no, invoice_no, psc, kg, state, consigner_address');
        $this->db->from('manifesto_data');
        $this->db->where($condition);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }
        
        return false;
    }
}
