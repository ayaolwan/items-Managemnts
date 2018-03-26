<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all($countryId)
    {
        $query = $this->db->query("call GetAllItems()");
        $this->db->freeDBResource($this->db->conn_id);
        return $query->result_array();
    }

    public function get_by_item_id()
    {

    }

}
