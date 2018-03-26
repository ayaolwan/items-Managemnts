<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Items_m extends CI_Model
{

    public function __construct()
    {
        $this->load->database();//load the db
    }


    /****************************** View  Category Data *******************************/
    public function GetAllItems()
    {
        $query = $this->db->query("call GetAllItems()");
        $this->db->freeDBResource($this->db->conn_id);
        return $query->result_array();
    }



    public function items_add($add_data)
    {
        $items_add = 'call items_add(?,?,?,?)';
        $query = $this->db->query($items_add, $add_data);
        $query1 = $this->db->query('SELECT LAST_INSERT_ID() as out_item_id;');
        $this->db->freeDBResource($this->db->conn_id);
        $out_item_id = $query1->result_object();
        return $out_item_id;

    }


    public function get_by_item_id()
    {

    }

}

?>