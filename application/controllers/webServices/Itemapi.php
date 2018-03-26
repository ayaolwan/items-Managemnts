
<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Itemapi  extends MY_Controller
{

    function __construct()
    {
        parent:: __construct();
        $this->load->helper('url');
        $this->load->model('Items_m');
        header('Content-Type: text/html; charset=UTF-8');


    }

    public function index_get()
    {
        $data = $this->Items_m->GetAllItems();

        if ($data)
        {
            $this->successWithData($data);
        } else
        {
            $this->error('No data');
        }

    }
}
