<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apiitem extends MY_Controller {


    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Items_m');
        header('Content-Type: text/html; charset=UTF-8');

    }
    public function index_post()
    {
        $data = $this->Items_m->GetAllItems();
        if ($data)
        {
            return $this->response([
                'status' => TRUE,
                'message' => 'Successfully',
                'itemsList' => $data
            ], MY_Controller::HTTP_OK);
        } else
        {
            $this->error('No data');
        }
    }


}
