<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {

        parent::__construct();
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->load->helper('url');
        $this->load->model('user_model');
    }

    public function index() {
$data['content'] = 'user/welcome_message';
        $this->load->view('layout/default', $data);
    }

    public function contact() {

      $data['content'] = 'user/contact';
        $this->load->view('layout/default', $data);
    }

    public function signup() {
        $this->load->helper('url');
        //post data
        if (isset($_POST) && !empty($_POST)) {
            $register_data = array(
                'password' => $this->input->post('password'),
                'firstName' => $this->input->post('first_name'),
                'lastName' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'role' => $this->input->post('user_role')
            );
            $insert_user = $this->user_model->insertUser('players', $register_data);
            redirect('User/registered');
        }

        $this->load->view('user/signup');
    }

    public function registered() {
        $this->load->view('registersuccess');
    }

    //Login
    public function signin() {
        //if submited form 
        $data = array();
        $this->load->library('form_validation');
        if (isset($_POST) && !empty($_POST)) {
            $this->form_validation->set_rules('email', 'email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'password', 'required|min_length[6]');
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $return_data = $this->user_model->loginCheck($email, $password);
                if ($return_data != 0) {
                    if ($return_data == 1) {
                        redirect('User/registered');
                    } else if (is_array($return_data)) {
                        $this->session->set_userdata($return_data);
                        redirect('Dashboard');
                    }
                } else {
                    $data['error'] = 'Please provide valid login credentials';
                }
            }
        }
        $data['content'] = 'user/signin';
        $this->load->view('layout/default', $data);
    }

     public function logout() {   
        $this->session->sess_destroy();
        redirect("/");
    }  

}
