<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Items extends CI_Controller {


    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Items_m');
        $this->load->helper(array('form', 'html', 'file'));
        $this->load->library('form_validation');
        header('Content-Type: text/html; charset=UTF-8');

    }

    public  function  get_all_items()
    {
        $CategoryDataDisplay =$this->Items_m->GetAllItems();
        echo json_encode($CategoryDataDisplay);
    }

    public function getItemsUniqueCode($length)
    {
        $code = md5(uniqid(rand(), true));
        if ($length != "")
            return 'Items_' . substr($code, 0, $length);
        else
            return 'Items_' . $code;
    }

    public  function items_add()
    {
        $name = $this->input->post("name");
        $descrption = $this->input->post("descrption");
        $tags = $this->input->post("tags");
        $picture = $this->input->post("picture");
        $files = $this->input->post("files");

        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('descrption', 'descrption', 'trim|required');
        $this->form_validation->set_rules('tags', 'tags', 'trim|required');


        if ($this->form_validation->run() == FALSE)
        {
            $data = array('msg' => validation_errors(), 'result' => false);
            echo json_encode($data);
        } else
        {

              if (!empty($_FILES))
              {
                  $year = date('Y');
                  $month = date('m');
                  $day = date('d');

                  /**** crate the bath to upload file  ***/

                  $uploadedBath ='uploadsPictures' . DIRECTORY_SEPARATOR . $year;

                  if (!is_dir($uploadedBath))
                  {
                      mkdir($uploadedBath, 0777, true);
                  }
                  $uploadedBath .= DIRECTORY_SEPARATOR . $month;
                  if (!is_dir($uploadedBath)) {
                      mkdir($uploadedBath, 0777, true);
                  }
                  $uploadedBath .= DIRECTORY_SEPARATOR . $day;
                  if (!is_dir($uploadedBath)) {
                      mkdir($uploadedBath, 0777, true);
                  }

                  $filesTmp = $_FILES['picture']['tmp_name'];

                  if (!is_dir($uploadedBath))
                  {
                      $data = array('msg' => 'There are error in upload bath', 'is_done' => false);
                      echo json_encode($data);
                  } else {

                      $tmp_file = $_FILES['picture']['tmp_name'];// $file['lfDataUrl'];
                      $file_extension = pathinfo( $_FILES['picture']['name'], PATHINFO_EXTENSION);
                      if (true)
                      {
                          $new_name = $this->getItemsUniqueCode(30) . "." . $file_extension;

                          $saveFile=$uploadedBath .'/' . $new_name;

                          if (true)
                          {
                              if (move_uploaded_file($tmp_file, $uploadedBath . '/' . $new_name))
                              {
                                  $insertedDate = array('name' => trim($name), 'descrption' => $descrption,'picture' => $saveFile,
                                      'tags' => $tags);

                                  $addedRes= $this->Items_m->items_add($insertedDate);
                                  if ($addedRes)
                                  {
                                      $data = array('msg' => 'Added Successfully', 'result' => true,'file'=>$saveFile);
                                      echo json_encode($data);
                                  } else
                                  {
                                      $data = array('msg' => 'Add Faild..!', 'result' => false);
                                      echo json_encode($data);

                                  }


                              } else {
                                  $data = array('msg' => 'can not upload the image please try again :(', 'is_done' => false);
                                  echo json_encode($data);
                              }
                          } else {
                              $data = array('msg' => 'size file large than 4M', 'is_done' => false);
                              echo json_encode($data);
                          }

                      } else {
                          $data = array('msg' => 'this extiotion is not allowed', 'is_done' => false);
                          echo json_encode($data);
                      }


                  }
              } else {
                  echo 'No files';
              }

        }
    }

	public function index()
	{
		$this->load->database();

		if(!empty($this->input->get("search"))){
			$this->db->like('title', $this->input->get("search"));
			$this->db->or_like('description', $this->input->get("search"));
		}

		$this->db->limit(5, ($this->input->get("page",1) - 1) * 5);
		$query = $this->db->get("items");

		$data['data'] = $query->result();
		$data['total'] = $this->db->count_all("items");

		echo json_encode($data);
	}
///////////////////////// api Code
///


    public function get_all_items_by_api()
    {

        $data = array('token' =>'ayaolwan');//'type' => 'fees_category');
        $data_string = json_encode($data);
        $curl = curl_init(base_url() . 'webServices/Itemapi');

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $result = json_decode(curl_exec($curl), true);
        curl_close($curl);

        if ($result['status'])
        {
            echo json_encode($result['itemsList']);
        }


    }



}
