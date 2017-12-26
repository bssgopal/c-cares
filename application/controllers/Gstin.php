<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Gstin extends CI_Controller {

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
            //echo "<PRE>";print_r($_SESSION);exit;
            $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
            $fields= "id,trade_name,gst_no,fertilizer_license,seed_license,pesticide_license,location,fertilizers_cgst,fertilizers_sgst,seeds_cgst,seeds_sgst,pesticides_cgst,pesticides_sgst,cement_cgst,cement_sgst,bank_details";
            $where = "id='".$gstin_id."'";
            $table ='gstins';
            $gstin_data = $this->Dashboard_model->get_single_data($fields,$where,$table);
            $data['gstin_data'] =$gstin_data;
            $data['content'] = 'Gstin/gstin_profile';
            $this->load->view('Dashboard/default',$data);
        }

        public function addGstin() {   
            $data['content'] = 'Gstin/gstin_profile';
            $this->load->view('Dashboard/default',$data);
        }
        
        

        //save User Profile
        public function saveGstinProfile(){
            $data = array();
            $this->load->library('form_validation');
            if (isset($_POST) && !empty($_POST)) {
                //$this->form_validation->set_rules('gstind_id','Gstin','trim|required');
                $this->form_validation->set_rules('trade_name','Trade name','trim|required');
                $this->form_validation->set_rules('gst_no', 'Gst No', 'trim|required');
                $this->form_validation->set_rules('fertilizer_license', 'Fertilizer license No.', 'trim|required');
                $this->form_validation->set_rules('seed_license', 'Seed license No.', 'trim|required');
                $this->form_validation->set_rules('pesticide_license', 'Pesticide license No.', 'trim|required');

                if ($this->form_validation->run() == FALSE) {
                      $errors=validation_errors();
                      $this->session->set_flashdata('message',$errors);
                        redirect('Dashboard/index');
                } else {
                     
                    $update_data = array(
                        'trade_name'=> $this->input->post("trade_name"),
                        'gst_no'=> $this->input->post("gst_no"),
                        'fertilizer_license'=> $this->input->post("fertilizer_license"),
                        'seed_license'=> $this->input->post("seed_license"),
                        'pesticide_license'=> $this->input->post("pesticide_license"),
                        'fertilizers_sgst'=> $this->input->post("fertilizers_sgst"),
                        'fertilizers_cgst'=> $this->input->post("fertilizers_cgst"),
                        'seeds_sgst'=> $this->input->post("seeds_sgst"),
                        'seeds_cgst'=> $this->input->post("seeds_cgst"),
                        'pesticides_cgst'=> $this->input->post("pesticides_cgst"),
                        'pesticides_sgst'=> $this->input->post("pesticides_sgst"),
                        'cement_sgst'=> $this->input->post("cement_sgst"),
                        'cement_cgst'=> $this->input->post("cement_cgst"),
                        'bank_details'=> $this->input->post("bank_details"),
                        );
                    $table ="gstins";
                    $gstind_id = $this->input->post("gstind_id");
                    if(isset($gstind_id) && !empty($gstind_id)){
                        //update gstind
                        $update_conditions = array(
                        'md5(id)'=> $this->input->post("gstind_id") 
                       );
                        $afftectedRows =  $this->Dashboard_model->updateData($table,$update_data,$update_conditions);
                    $this->session->set_flashdata('message','Data Updated successfully');
                    }else{
$afftectedRows =  $this->Dashboard_model->insertData($table,$update_data);
                    $this->session->set_flashdata('message','New Gst created successfully');
                    }
                   
                }

                }
                redirect('Dashboard/index');
                 
        }















    }
