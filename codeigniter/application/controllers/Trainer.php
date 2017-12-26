<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Trainer extends CI_Controller {

    public function __construct() {
        
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('user_model');
         if (!$this->session->userdata()) {
            redirect('welcome');
        }
    }

    
    public function index() {
//        echo '<pre>';print_r($this->session->userdata());exit;
        $this->load->view('trainer/index');
    }

    

}
