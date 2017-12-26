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

        $this->load->view('welcome_message');
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
        if (isset($_POST) && !empty($_POST)) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $return_data = $this->user_model->loginCheck($email, $password);
            if ($return_data != 0) {
                if ($return_data == 1) {
                    redirect('User/registered');
                } else if (is_array($return_data)) {
                    $this->session->set_userdata($return_data);
                    if ($return_data['catid'] == 2) {
                        redirect('learner');
                    } else {
                        redirect('trainer');
                    }
                }
            } else {
                $data['error'] = 'Please provide valid login credentials';
            }
        }
        $this->load->view('user/signin', $data);
    }

    public function logout() {
        $data = array(
            'login' => false,
            'uid' => '',
            'uname' => '',
            'uemail' => '',
            'catid' => '',
            'ustatus' => ''
        );
        $this->session->unset_userdata($data);
        redirect('welcome');
    }

}
