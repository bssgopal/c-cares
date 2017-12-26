<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Dashboard extends CI_Controller {

            public function __construct() {

                parent::__construct();
                if (!isset($_SESSION)) {
                    session_start();
                }
                $this->load->helper('url');
                $this->load->model('user_model');
                $this->load->model('Dashboard_model');
                /*check login*/
                $this->load->model('LoginSecurity_model');
                 $this->LoginSecurity_model->is_logged_in();
            }

        public function index() {   
          //  echo "<PRE>";print_r($_SESSION);exit;
            $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
            $fields= "id,trade_name,gst_no,fertilizer_license,seed_license,pesticide_license,location";
            $where = "id='".$gstin_id."'";
            $table ='gstins';
            $gstin_data = $this->Dashboard_model->get_single_data($fields,$where,$table);
            $data['gstin_data'] =$gstin_data;
              //get all trades
              $table ='gstins';
              $fields = "id,trade_name";
              $where ='1=1';
            $gstin_fetch_data = array('fields'=>$fields,'where'=>$where,'table'=>$table);
            $gstins_data = $this->Dashboard_model->get_multirows($gstin_fetch_data);
            /* if admin then get all gsts list*/
            $role  = $this->session->userdata['trade_user_data']['role'];
            if($role==1){
                $all_gstins_fetch_data = array('fields'=>'*','where'=>"1=1",'table'=>$table);
                $all_gstins_data = $this->Dashboard_model->get_multirows($all_gstins_fetch_data);
             $data['all_gstins_data'] = $all_gstins_data;

              $usercompany_data_by = array(
                'table'=> 'user',
                'fields' => 'user.gstin_id,user.first_name,user.middle_name,user.last_name,user.phone,user.email_id,gstins.trade_name',
                'where'=> array('0'),
                'join'=> array('gstins'=>'user.gstin_id=gstins.id')
            );
$user_company_data = $this->Dashboard_model->get_multirows_with_Join($usercompany_data_by);
$data['user_company_data'] = $user_company_data;

            }
            $data['action_type'] = 'edit_profile';
            $data['gstins_data'] = $gstins_data;
            $data['content'] = 'Dashboard/index';
            $this->load->view('Dashboard/default',$data);
        }

         
        /* show logged user profile information*/
        public function profile(){
              $data   = array();
            $this->load->model('Dashboard_model');
            $table_data_by = array(
                'table'=> 'user',
                'fields' => 'user.id,user.gstin_id,user.user_name,user.email_id,user.company_id,user.first_name,user.middle_name,user.last_name,user.address,user.phone,user.date_of_birth,gstins.id,gstins.trade_name',
                'where'=> array('user.id'=>$this->session->userdata['trade_user_data']['user_id']),
                'join'=> array('gstins'=>'gstins.id=user.gstin_id')
            );
            $data['user_profile_data'] = $this->Dashboard_model->get_single_data_with_Join($table_data_by);
            $role  = $this->session->userdata['trade_user_data']['role'];
            if($role==1){
                $where = '1=1'; //Admin
            }else{
            $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
            $where = 'id='.$gstin_id; 
            }
              //get all trades
              $table ='gstins';
              $fields = "id,trade_name";
            $gstin_fetch_data = array('fields'=>$fields,'where'=>$where,'table'=>$table);
            $gstins_data = $this->Dashboard_model->get_multirows($gstin_fetch_data);
            $data['action_type'] = 'new_profile';
            $data['gstins_data'] = $gstins_data;
             $data['action_type'] = 'edit_profile';
            $data['content'] = 'Dashboard/profile';
            $this->load->view('Dashboard/default', $data);
        }
        
        public function addProfile(){
              $data   = array();
              //get all trades
              $table ='gstins';
              $fields = "id,trade_name";
              $where ='1=1';
            $gstin_fetch_data = array('fields'=>$fields,'where'=>$where,'table'=>$table);
            $gstins_data = $this->Dashboard_model->get_multirows($gstin_fetch_data);
            $data['action_type'] = 'new_profile';
            $data['gstins_data'] = $gstins_data;
           $data['content'] = 'Dashboard/profile';
            $this->load->view('Dashboard/default', $data);
        }        

        //save User Profile
        public function saveUserProfile(){
            $data = array();
            //$gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
        $this->load->library('form_validation');
            if (isset($_POST) && !empty($_POST)) {
                $this->form_validation->set_rules('trade_name','Trade ','trim|required');
                //$this->form_validation->set_rules('puid','puid','trim|required');
                $this->form_validation->set_rules('first_name','First Name','trim|required');
                $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
                if($this->input->post("password")){
                    $this->form_validation->set_rules('password', 'password', 'required|min_length[6]');
                }
                if ($this->form_validation->run() == FALSE) {
                      $errors=validation_errors();
                      $this->session->set_flashdata('message',$errors);
                        redirect('Dashboard/profile');
                } else {
                     $gstin_id  = $this->input->post("trade_name");
                     // $this->session->userdata['trade_user_data']['gstin_id'];
                    $update_data = array(
                        'gstin_id' => $gstin_id,
                        'first_name'=> $this->input->post("first_name"),
                        'middle_name'=> $this->input->post("middle_name"),
                        'last_name'=> $this->input->post("last_name"),
                        'user_name'=> $this->input->post("user_name"),
                        'phone'=> $this->input->post("phone"),
                        'email_id' => $this->input->post("email_id")
                        );
                    $table ="user";
                    if(!empty($this->input->post("password"))){
                        $update_data +=  array(
                            'password'=> md5($this->input->post("password"))
                            );
                    }

                    $puid = $this->input->post("puid");
                    if(isset($puid) && !empty($puid)){
                            //edit
                        $update_conditions = array(
                            'md5(id)'=> $this->input->post("puid") 
                        );
                        
                        $afftectedRows =  $this->Dashboard_model->updateData($table,$update_data,$update_conditions);
                        $this->session->set_flashdata('message','Data Updated successfully');
                    }else{
                            //insert
                        $afftectedRows =  $this->Dashboard_model->insertData($table,$update_data);
                    $this->session->set_flashdata('message','New Profile created successfully');

                    }
                    
                        redirect('Dashboard/profile');
                }

                }
                redirect('Dashboard/profile');
                 
        }















    }
