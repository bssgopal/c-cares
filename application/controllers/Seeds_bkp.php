<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Seeds extends CI_Controller {

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
          redirect('Seeds/purchase');
        }

        public function purchase($id=null) {   
            //echo "<PRE>";print_r($_SESSION);exit;
            if(!empty($id)){
                $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
                $fields= "id,gstin_id,invoice,company_name,material_type,quantity,value,lorry_frieght,created";
                $where = "md5(id)='".$id."'";
                $table ='purchase';
                $purchase_table_data = array('fields'=>$fields,'where'=>$where,'table'=>$table);
                $purchase_report = $this->Dashboard_model->get_single_data($fields,$where,$table);
                $data['purchase_report'] = $purchase_report;
            }
            $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
            $data['left_menu'] = 'Fertilizers/fertilizers_left_menu';
            $data['selected_left_menu'] = "purchase";
            $data['content'] = 'Seeds/seeds_stock_report';
            $this->load->view('Dashboard/default',$data);
        }


         //save purchase data
        public function save_purchase(){
            $data = array();
            $this->load->library('form_validation');
            if (isset($_POST) && !empty($_POST)) {
                $this->form_validation->set_rules('company_name','Company Name','trim|required');
                $this->form_validation->set_rules('invoice','Invoice','trim|required');
                $this->form_validation->set_rules('material_type', 'Varitey', 'trim|required');
                $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|numeric');
                $this->form_validation->set_rules('value', 'Value', 'trim|required|numeric');
                $this->form_validation->set_rules('lorry_frieght', 'Lorry Frieght', 'trim|required|numeric');

                if ($this->form_validation->run() == FALSE) {
                      $errors=validation_errors();
                      $this->session->set_flashdata('message',$errors);
                        redirect('Fertilizers/purchase');
                } else {
                     $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
                    $insert_data = array(
                        'gstin_id'=>$gstin_id,
                        'company_name'=> $this->input->post("company_name"),
                        'invoice'=> $this->input->post("invoice"),
                        'value'=> $this->input->post("value"),
                        'quantity'=> $this->input->post("quantity"),
                        'material_type'=> $this->input->post("material_type"),
                        'lorry_frieght'=> $this->input->post("lorry_frieght")
                        ); 
                    $table ="purchase";
                    if($this->input->post("purchase_id")){
                        $purchase_id  = $this->input->post("purchase_id");
                        $update_at = array(
                            'id'=>$purchase_id
                            );
                        $afftectedRows =  $this->Dashboard_model->updateData($table,$insert_data,$update_at);
                        $this->session->set_flashdata('message','Purchase data updated successfully');
                    }else{
                        $afftectedRows =  $this->Dashboard_model->insertData($table,$insert_data);
                        $this->session->set_flashdata('message','Purchase data saved successfully');     
                    }
                   
                    
                }

                }
                redirect('Fertilizers/stockreport');
        }

        public function stockreport(){
            $data['selected_left_menu'] = "stockreport";
            $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
             $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
            $fields= "id,gstin_id,invoice,company_name,material_type,quantity,value,lorry_frieght,created";
            $where = "gstin_id='".$gstin_id."'";
            $table ='purchase';
            $purchase_table_data = array('fields'=>$fields,'where'=>$where,'table'=>$table);
            $stockreport = $this->Dashboard_model->get_multirows($purchase_table_data);
            $data['stockreport'] =$stockreport;
            $data['left_menu'] = 'Fertilizers/fertilizers_left_menu';
            $data['content'] = 'Fertilizers/view_stock_report';
            $this->load->view('Dashboard/default',$data);
        }

        public function get_material_type(){
            $options = array();
            $status =0;
            $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
            $fields= "material_type";
            $where = "gstin_id='".$gstin_id."'";
            $table ='purchase';
            $purchase_table_data = array('fields'=>$fields,'where'=>$where,'table'=>$table);
            $stockreport = $this->Dashboard_model->get_multirows($purchase_table_data);
            if(!empty($stockreport)){
                foreach ($stockreport as $key => $value) {
                    $options[] = $value['material_type'];
                }
                $status=1;
            }
            echo json_encode($options);exit;

        }

        public function payments(){
            $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
            $data['left_menu'] = 'Fertilizers/fertilizers_left_menu';
            $data['selected_left_menu'] = "payments";
            $data['content'] = 'Fertilizers/stock_report';
            $this->load->view('Dashboard/default',$data);
        }
        
        public function save_payment(){
            $data = array();
            $this->load->library('form_validation');
            if (isset($_POST) && !empty($_POST)) {
                $this->form_validation->set_rules('company_name','Company Name','trim|required');
                $this->form_validation->set_rules('rtgs_cash','Rtgs/Cash','trim|required');
                $this->form_validation->set_rules('rtgs_number', 'Rtgs Number', 'trim|required');
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
                $this->form_validation->set_rules('payment_date', 'Payment Date', 'trim|required');
                if ($this->form_validation->run() == FALSE) {
                      $errors=validation_errors();
                      $this->session->set_flashdata('message',$errors);
                        redirect('Fertilizers/payments');
                } else {
                     $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
                    $insert_data = array(
                        'gstin_id'=>$gstin_id,
                        'company_name'=> $this->input->post("company_name"),
                        'rtgs_cash'=> $this->input->post("rtgs_cash"),
                        'rtgs_number'=> $this->input->post("rtgs_number"),
                        'amount'=> $this->input->post("amount"),
                        'payment_date'=> $this->input->post("payment_date")
                        ); 
                    $table ="payments";
                    if($this->input->post("payment_id")){
                        $payment_id  = $this->input->post("payment_id");
                        $update_at = array(
                            'id'=>$payment_id
                            );
                        $afftectedRows =  $this->Dashboard_model->updateData($table,$insert_data,$update_at);
                        $this->session->set_flashdata('message','Payment data updated successfully');
                    }else{
                        $afftectedRows =  $this->Dashboard_model->insertData($table,$insert_data);
                        $this->session->set_flashdata('message','Purchase data saved successfully');     
                    }
                   
                    
                }

                }
                redirect('Fertilizers/stockreport');
        }


        public function sale_retail(){
            $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
            $fields= "id,trade_name,gst_no,fertilizer_license,seed_license,pesticide_license,location";
            $where = "id='".$gstin_id."'";
            $table ='gstins';
            $gstin_data = $this->Dashboard_model->get_single_data($fields,$where,$table);
            $data['gstin_data'] =$gstin_data;
            $data['left_menu'] = 'Fertilizers/fertilizers_left_menu';
            $data['selected_left_menu'] = "sale_rate";
            $data['content'] = 'Fertilizers/stock_report';
            $this->load->view('Dashboard/default',$data);
        }

        public function save_sale_retail(){
             $data = array();
            $this->load->library('form_validation');
            if (isset($_POST) && !empty($_POST)) {
                $this->form_validation->set_rules('bill_date','Bill date','trim|required');
                $this->form_validation->set_rules('phone','phone','trim|required');
                $this->form_validation->set_rules('farmer_name', 'farmer name', 'trim|required');
                $this->form_validation->set_rules('village_name', 'Villag name', 'trim|required');
                if ($this->form_validation->run() == FALSE) {
                      $errors=validation_errors();
                      $this->session->set_flashdata('message',$errors);
                        redirect('Fertilizers/payments');
                } else {
                     $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
                    $insert_data = array(
                        'gstin_id'=>$gstin_id,
                        'bill_date'=> date('Y-m-d ',strtotime($this->input->post("bill_date"))).date('H:i:s'),
                        'phone'=> $this->input->post("phone"),
                        'farmer_name'=> $this->input->post("farmer_name"),
                        'village'=> $this->input->post("village_name"),
                        'created'=>date('Y-m-d H:i:s')
                        ); 
                    $table ="sale_retail";
                    if($this->input->post("sale_retail_id")){
                        /*Edit*/
                    }else{
                        $afftectedRows =  $this->Dashboard_model->insertData($table,$insert_data);
                        if($afftectedRows){
                            $sale_retail_bill_data = array();
                            $sno_data = $this->input->post('s_no');
                            $variety = $this->input->post('variety');
                            $bags_count = $this->input->post('bags_count');
                            $bag_price = $this->input->post('bag_price');
                            $total_variety_price = $this->input->post('total_variety_price');

                            foreach ($sno_data as $key => $value) {
                                $sale_retail_bill_data[$key]['sale_retail_id'] = $afftectedRows;
                                $sale_retail_bill_data[$key]['variety'] = $variety[$value];
                                $sale_retail_bill_data[$key]['quantity'] = $bags_count[$value];
                                $sale_retail_bill_data[$key]['price'] = $bag_price[$value];
                                $sale_retail_bill_data[$key]['total_price'] = $total_variety_price[$value];
                            }
                        
                            if(!empty($sale_retail_bill_data
                                )){
                                $afftectedRows =  $this->Dashboard_model->insert_batch_data("sale_retail_bill",$sale_retail_bill_data);
                            }
                        }
                        $this->session->set_flashdata('message','Sale Retail data saved successfully');  
                        redirect('Fertilizers/stockreport');   
                    }
                   
                    
                }

                }
        }

        public function whole_sale(){
            $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
            $fields= "id,trade_name,gst_no,fertilizer_license,seed_license,pesticide_license,location";
            $where = "id='".$gstin_id."'";
            $table ='gstins';
            $gstin_data = $this->Dashboard_model->get_single_data($fields,$where,$table);
            $data['gstin_data'] =$gstin_data;
            $data['left_menu'] = 'Fertilizers/fertilizers_left_menu';
            $data['selected_left_menu'] = "whole_sale";
            $data['content'] = 'Fertilizers/stock_report';
            $this->load->view('Dashboard/default',$data);
        }


        public function save_wholesale_data(){
             $data = array();
            $this->load->library('form_validation');
            if (isset($_POST) && !empty($_POST)) {
                $this->form_validation->set_rules('bill_date','Bill date','trim|required');
                $this->form_validation->set_rules('phone','phone','trim|required');
                $this->form_validation->set_rules('party_name', 'Party name', 'trim|required');
                $this->form_validation->set_rules('location', 'Location', 'trim|required');
                $this->form_validation->set_rules('vehicle_no', 'Vehicle No', 'trim|required');                
                $this->form_validation->set_rules('sgst', 'SGST', 'trim|required');                               
                $this->form_validation->set_rules('cgst', 'CGST', 'trim|required');                                                
                if ($this->form_validation->run() == FALSE) {
                      $errors=validation_errors();
                      $this->session->set_flashdata('message',$errors);
                        redirect('Fertilizers/payments');
                } else {
                     $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
                    $insert_data = array(
                        'gstin_id'=>$gstin_id,
                        'bill_date'=> date('Y-m-d ',strtotime($this->input->post("bill_date"))).date('H:i:s'),
                        'phone'=> $this->input->post("phone"),
                        'party_name'=> $this->input->post("party_name"),
                        'location'=> $this->input->post("location"),
                        'vehicle_no'=> $this->input->post("vehicle_no"),
                        'sgst'=> $this->input->post("sgst"),
                        'cgst'=> $this->input->post("cgst"),
                        'total_amount'=> '100',//$this->input->post("total_amount"),
                        'created'=>date('Y-m-d H:i:s')
                        ); 
                    $table ="whole_sale";
                    if($this->input->post("wholesale_id")){
                        /*Edit*/
                    }else{
                        $afftectedRows =  $this->Dashboard_model->insertData($table,$insert_data);
                        if($afftectedRows){
                            $wholesale_bill_data = array();
                            $sno_data = $this->input->post('s_no');
                            $variety = $this->input->post('variety');
                            $batch = $this->input->post('batch');
                            $quantity = $this->input->post('quantity');
                            $rate = $this->input->post('rate');
                            $amount = $this->input->post('amount');

                            foreach ($sno_data as $key => $value) {
                                $wholesale_bill_data[$key]['wholesale_id'] = $afftectedRows;
                                $wholesale_bill_data[$key]['variety'] = $variety[$value];
                                $wholesale_bill_data[$key]['batch'] = $batch[$value];
                                $wholesale_bill_data[$key]['quantity'] = $quantity[$value];
                                $wholesale_bill_data[$key]['price'] = $rate[$value];
                                $wholesale_bill_data[$key]['amount'] = $amount[$value];
                            }
                        
                            if(!empty($wholesale_bill_data
                                )){
                                $afftectedRows =  $this->Dashboard_model->insert_batch_data("whole_sale_bill",$wholesale_bill_data);
                            }
                        }
                        $this->session->set_flashdata('message','Whole Sale data saved successfully');  
                        redirect('Fertilizers/stockreport');   
                    }
                   
                    
                }

                }
        }








    }
