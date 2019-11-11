<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, OPTIONS");

    class Checknamestudent extends API_Controller{
        
        function __construct()
        {
            parent::__construct();
            $this->load->model('checknamestudent_model');

        }
        function get_all_get(){         // all_get || all_post || all_delete
            $result = $this->checknamestudent_model->get_all();
            // $this->response(['response' => $result]);
            $this->response($result); 

        }
    }
?>