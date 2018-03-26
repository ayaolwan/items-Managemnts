<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

/**
 * @property Users_model $Users_model
 * @property EmpMaster_model $EmpMaster_model
 */
class MY_Controller extends REST_Controller
{

    protected $auto_check_login = true;
    protected $user;

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('pagination');
        $this->load->library('table');
        $this->load->helper("url");
        $this->load->helper("language");

        if ($this->auto_check_login) {
            $this->check_user_login();
        }
    }

    protected function check_user_login()
    {
        $token = $this->post('token');
        if (!$token) {
            $token = $this->get('token');
        }
        if (!$token) {
            $token = $this->put('token');
        }
        if (!$token) {
            $token = $this->delete('token');
        }
//         $token = "30d5a8eaf9ddc6fa714f0f1c1a534699";
//        $this->user = $this->Users_model->getByToken($token);
    }

    /* public function put($key = NULL, $default = null)
     {
         $value = parent::post($key);

         return ($value) ? $value : $default;
     }*/

    public function post($key = NULL, $default = null)
    {
        $value = parent::post($key);

        return ($value) ? $value : $default;
    }

    public function error($message = 'Failed', $errors = null)
    {
        $response = [
            'status' => FALSE,
            'message' => $message,
        ];
        if ($errors) {
            $response['Data'] = $errors;
        }
        $this->response($response, MY_Controller::HTTP_OK);
    }

    protected function forceResponse()
    {
        header("Content-type:application/json");
        $CI =& get_instance();
        echo $CI->output->get_output();
        exit;
    }

    public function validate()
    {
        if ($this->form_validation->run()) {
            return;
        } else {
            $this->error('Failed', $this->form_validation->error_array());
            $this->forceResponse();
        }
    }

    public function successWithData($data = null, $message = 'Successfully')
    {
        $response = [
            'status' => TRUE,
            'message' => $message,
        ];
        if ($data) {
            $response['Data'] = $data;
        }
        $this->response($response, MY_Controller::HTTP_OK);
    }

    public function successWithDataPagination($data = null, $count = null, $message = 'Successfully')
    {
        $response = [
            'status' => TRUE,
            'message' => $message,
        ];
        if ($data) {
            $response['total'] = $count;
            $response['Data'] = $data;
        }
        $this->response($response, MY_Controller::HTTP_OK);
    }

    public function success($message = 'Successfully')
    {
        $response = [
            'status' => TRUE,
            'message' => $message,
        ];
        $this->response($response, MY_Controller::HTTP_OK);
    }

    public function successWithDataAdd($data = null, $message = 'Successfully')
    {
        $response = [
            'status' => TRUE,
            'message' => $message,
        ];
        if ($data) {
            $response['last_id'] = $data;
        }
        $this->response($response, MY_Controller::HTTP_OK);
    }

    public function errorWithDataAdd($data = null)
    {
        $response = [
            'status' => FALSE,
            'message' => $data,
        ];
        $this->response($response, MY_Controller::HTTP_OK);
    }

    /**
     * @return array
     */
    protected function paginationData()
    {
        $pagination = [
            'page' => $this->post('page'),
            'count' => $this->post('count')
        ];
        return $pagination;
    }
}