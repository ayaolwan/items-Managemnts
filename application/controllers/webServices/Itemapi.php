
<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Itemapi  extends CI_Controller
{

    function __construct()
    {
        parent:: __construct();
        $this->load->helper('url');
        $this->load->model('Items_m');
        $this->load->helper(array('form', 'html', 'file'));
        $this->load->model('Items_m');
    }

    public function index()
    {
        $data = $this->Items_m->GetAllItems();
//        var_dump($data);
        if ($data)
        {
            return [
                'status' => TRUE,
                'message' => 'Successfully',
                'itemsList' => $data
            ];

        }
        else
        {
            return 'No data';
        }
    }

   /* public function get_by_item_id_post()
    {
        $item_id = $this->post('item_id');

        $data = $this->Items_m->get_by_item_id($item_id);
        if ($data)
        {
            return $this->response([
                'status' => TRUE,
                'message' => 'Successfully',
                'items' => $data
            ], MY_Controller::HTTP_OK);
        } else {
            $this->error('No data');
        }
    }*/

}
