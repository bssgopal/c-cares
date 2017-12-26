<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fertilizers extends CI_Controller {

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

        /*public function index() {   
          redirect('Fertilizers/purchase');
      }*/

      public function purchase($id=null) {  
        $module = $this->uri->segment(1);
            //echo "<PRE>";print_r($_SESSION);exit;
        if(isset($_REQUEST['action']) && $_REQUEST['action'] =="print")
            $print_page = $_REQUEST['action'];
        else
            $print_page = FALSE;
        $module_name = strtolower($module);
        $where = "";
        if(!empty($module_name)){
            $where .= "module='".$module_name."'";
        }
        if(!empty($id)){
            $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
            $fields= "id,gstin_id,before_stock,invoice,invoice_date,company_name,material_type,quantity,value,cgst,sgst,lorry_frieght,created,batch_no";
            if(!empty($where)){
                $where .= " AND ";
            }
            $where .= "md5(id)='".$id."'";
            $table ='purchase';

            $purchase_table_data = array('fields'=>$fields,'where'=>$where,'table'=>$table);
            $purchase_report = $this->Dashboard_model->get_single_data($fields,$where,$table);
            $data['purchase_report'] = $purchase_report;
        }
        $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
        $gsting_where = "id='".$gstin_id."'";
        $table ='gstins';
        $fields= "id,trade_name,gst_no,fertilizer_license,seed_license,pesticide_license,location,fertilizers_cgst,fertilizers_sgst,pesticides_cgst,pesticides_sgst,cement_sgst,cement_cgst,seeds_cgst,seeds_sgst,bank_details";
        $gstin_data = $this->Dashboard_model->get_single_data($fields,$gsting_where,$table);  
        $data['gstin_data'] = $gstin_data;
        $data['left_menu'] = 'Fertilizers/fertilizers_left_menu';
        $data['selected_left_menu'] = "purchase";
        $data['print_page'] = $print_page;
        $data['content'] = 'Fertilizers/stock_report';
        $this->load->view('Dashboard/default',$data);
    }


         //save purchase data
    public function save_purchase(){
        $data = array();
        $this->load->library('form_validation');
        if (isset($_POST) && !empty($_POST)) {
            $this->form_validation->set_rules('company_name','Company Name','trim|required');
            $this->form_validation->set_rules('material_type', 'Varitey', 'trim|required');
            $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|numeric');
           /* $this->form_validation->set_rules('invoice','Invoice','trim|required');
            $this->form_validation->set_rules('bill_date','Bill date','trim|required');
            $this->form_validation->set_rules('value', 'Value', 'trim|required|numeric');
            $this->form_validation->set_rules('lorry_frieght', 'Lorry Frieght', 'trim|required|numeric');*/
            $module = strtolower($this->input->post("module"));
            if ($this->form_validation->run() == FALSE || $module=="") {
              $errors=validation_errors();
              $this->session->set_flashdata('message',$errors);
              redirect('Fertilizers/purchase');
          } else {
           $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
           $insert_data = array(
            'gstin_id'=>$gstin_id,
            'company_name'=> $this->input->post("company_name"),
            'module'=>$module,
            'invoice'=> $this->input->post("invoice"),
            'before_stock'=> (!empty($this->input->post("before_stock"))) ? 1 : 0 ,
            'invoice_date'=> ($this->input->post("bill_date")) ? date('Y-m-d',strtotime($this->input->post("bill_date"))) : "",
            'value'=> $this->input->post("value"),
            'quantity'=> $this->input->post("quantity"),
            'cgst' => $this->input->post("purchase_cgst"),
            'sgst' => $this->input->post("purchase_sgst"),
            'material_type'=> $this->input->post("material_type"),
            'lorry_frieght'=> $this->input->post("lorry_frieght")

            );
           $bno = $this->input->post("batch_no");
            if(isset($bno) && !empty($bno)){
                    $insert_data['batch_no'] = $bno;
            } 
           $table ="purchase";
           if($this->input->post("purchase_id")){
            $purchase_id  = $this->input->post("purchase_id");
            $update_at = array(
                'id'=>$purchase_id
                );
            $afftectedRows =  $this->Dashboard_model->updateData($table,$insert_data,$update_at);
            $message = "Purchase data updated successfully";
        }else{
            $afftectedRows =  $this->Dashboard_model->insertData($table,$insert_data);
            $purchase_id = $afftectedRows;
            $message = "Purchase data saved successfully";
        }
        
        
    }

}
$module = ucfirst($module);
$print_page = $this->input->post("print_page");
if($print_page==1){
    redirect("$module/purchase/".md5($purchase_id)."?action=print");
}
$this->session->set_flashdata('message',$message);
redirect("$module/purchase_report");
}


public function stockreport(){
           // exit("Stock Report");
    $module = $this->uri->segment(1);
    $module_name = strtolower($module);
    $where = "";
    if(!empty($module_name)){
     $where .= "module='".$module_name."'";
 }
 $data['selected_left_menu'] = "stockreport";
 $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
 $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
 $fields= "material_type,SUM(quantity) as total_quantity";
 if(!empty($where)){
     $where .= " AND ";
 }
 $where .= "gstin_id='".$gstin_id."' GROUP BY material_type";
 $table ='purchase';
 $purchase_table_data = array('fields'=>$fields,'where'=>$where,'table'=>$table);
 $stockreport = $this->Dashboard_model->get_multirows($purchase_table_data);
 if($module_name !== "pesticides"){
   /*saled data*/
   $table_data_by = array(
    'table'=> 'sale_retail',
    'fields' => 'sale_retail_bill.variety,SUM(sale_retail_bill.quantity) as sold',
    'where'=> array('sale_retail.module'=>$module_name,'sale_retail.gstin_id'=>$gstin_id),
    'join'=> array('sale_retail_bill'=>'sale_retail_bill.sale_retail_id=sale_retail.id'),
    'group_by'=> 'sale_retail_bill.variety'
    );

   /*wholesale data*/
   $wholesaletable_data_by = array(
    'table'=> 'whole_sale',
    'fields' => 'whole_sale_bill.variety,SUM(whole_sale_bill.quantity) as sold',
    'where'=> array('whole_sale.module'=>$module_name,'whole_sale.gstin_id'=>$gstin_id),
    'join'=> array('whole_sale_bill'=>'whole_sale_bill.wholesale_id=whole_sale.id'),
    'group_by'=> 'whole_sale_bill.variety'
    );
}else{
   /*saled data*/
   $table_data_by = array(
    'table'=> 'sale_retail',
    'fields' => 'pesticides_sale_retail_bill.variety,SUM(pesticides_sale_retail_bill.quantity) as sold',
    'where'=> array('sale_retail.module'=>$module_name,'sale_retail.gstin_id'=>$gstin_id),
    'join'=> array('pesticides_sale_retail_bill'=>'pesticides_sale_retail_bill.sale_retail_id=sale_retail.id'),
    'group_by'=> 'pesticides_sale_retail_bill.variety'
    );
   
   /*wholesale data*/
   $wholesaletable_data_by = array(
    'table'=> 'whole_sale',
    'fields' => 'pesticides_whole_sale_bill.variety,SUM(pesticides_whole_sale_bill.quantity) as sold',
    'where'=> array('whole_sale.module'=>$module_name,'whole_sale.gstin_id'=>$gstin_id),
    'join'=> array('pesticides_whole_sale_bill'=>'pesticides_whole_sale_bill.wholesale_id=whole_sale.id'),
    'group_by'=> 'pesticides_whole_sale_bill.variety'
    );
}



$saled_data = $this->Dashboard_model->get_multirows_with_Join($table_data_by);
$wholesale_data = $this->Dashboard_model->get_multirows_with_Join($wholesaletable_data_by);
            //echo "<PRE>";print_r($saled_data);print_r($stockreport);print_r($wholesale_data);exit;
$data['saled_data'] = $saled_data;
$data['instock_report'] = $stockreport;
$data['wholesale'] = $wholesale_data;
$data['left_menu'] = 'Fertilizers/fertilizers_left_menu';
$data['content'] = 'Fertilizers/view_stock_report';
$this->load->view('Dashboard/default',$data);

}
public function purchase_report(){
    $module = $this->uri->segment(1);
    $module_name = strtolower($module);
    $where = "";
    if(!empty($module_name)){
     $where .= "module='".$module_name."'";
 }
 $data['selected_left_menu'] = "purchase";
 $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
 $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
 $fields= "id,gstin_id,before_stock,invoice,company_name,material_type,quantity,value,lorry_frieght,created,batch_no";
 if(!empty($where)){
     $where .= " AND ";
 }
 $where .= "gstin_id='".$gstin_id."'";
 $table ='purchase';
 $additional_data_order  = array("id"=>"DESC");
 $purchase_table_data = array('fields'=>$fields,'where'=>$where,'table'=>$table,'order'=>$additional_data_order);
 $stockreport = $this->Dashboard_model->get_multirows($purchase_table_data);
 $data['stockreport'] =$stockreport;
 $data['left_menu'] = 'Fertilizers/fertilizers_left_menu';
 $data['content'] = 'Fertilizers/view_stock_report';
 $this->load->view('Dashboard/default',$data);
}

public function get_material_type(){ 
    $module = strtolower($_REQUEST['module']);
    $term = (isset($_REQUEST['term']) && !empty($_REQUEST['term'])) ? strtolower($_REQUEST['term']) : "";
    $where = "";
    if(!empty($module)){
     $where .= "module='".$module."'";
    }
    if(!empty($term)){
        $where .= " AND material_type  LIKE '%".$term."%'";
    }
 $options = array();
 $status =0;
 $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
 $fields= "material_type";
 if(!empty($where)){
     $where .= " AND ";
 }
 $where .= "gstin_id='".$gstin_id."'";
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

public function payments($id=null){
    $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
    $where = "gstin_id='".$gstin_id."'";
    $module = $this->uri->segment(1);
    $module_name = strtolower($module);
    if(isset($_REQUEST['action']) && $_REQUEST['action'] =="print")
        $print_page = $_REQUEST['action'];
    else
        $print_page = FALSE;
    $where = "";
    if(!empty($module_name)){
     $where .= "module='".$module_name."'";
 }
 if(!empty($id)){
    $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
    $fields= "id,gstin_id,company_name,module,rtgs_cash,rtgs_number,amount,payment_date,created";
    if(!empty($where)){
        $where .= " AND ";
    }
    $where .= "md5(id)='".$id."'";
    $table ='payments';
    $purchase_table_data = array('fields'=>$fields,'where'=>$where,'table'=>$table);
    $purchase_report = $this->Dashboard_model->get_single_data($fields,$where,$table);
    $data['payments_report'] = $purchase_report;
}
$gsting_where = "id='".$gstin_id."'";
$table ='gstins';
$fields= "id,trade_name,gst_no,fertilizer_license,seed_license,pesticide_license,location,fertilizers_cgst,fertilizers_sgst,pesticides_cgst,pesticides_sgst,cement_sgst,cement_cgst,seeds_cgst,seeds_sgst,bank_details";
$gstin_data = $this->Dashboard_model->get_single_data($fields,$gsting_where,$table);  
$data['gstin_data'] = $gstin_data;
$data['left_menu'] = 'Fertilizers/fertilizers_left_menu';
$data['selected_left_menu'] = "payments";
$data['print_page'] = $print_page;
$data['content'] = 'Fertilizers/stock_report';
$this->load->view('Dashboard/default',$data);
}

public function save_payment(){
    $data = array();
    $this->load->library('form_validation');
    if (isset($_POST) && !empty($_POST)) {
        $this->form_validation->set_rules('company_name','Company Name','trim|required');
        $this->form_validation->set_rules('rtgs_cash','Rtgs/Cash','trim|required');
        $this->form_validation->set_rules('rtgs_number', 'Rtgs Number', 'trim');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
        $this->form_validation->set_rules('payment_date', 'Payment Date', 'trim|required');
        $module = strtolower($this->input->post("module"));
        if ($this->form_validation->run() == FALSE || $module=="") {
          $errors=validation_errors();
          $this->session->set_flashdata('message',$errors);
          redirect('Fertilizers/payments');
      } else {
       $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
       $insert_data = array(
        'gstin_id'=>$gstin_id,
        'company_name'=> $this->input->post("company_name"),
        'module'=>$module,
        'rtgs_cash'=> $this->input->post("rtgs_cash"),
        'rtgs_number'=> $this->input->post("rtgs_number"),
        'amount'=> $this->input->post("amount"),
        'payment_date'=> date("Y-m-d",strtotime($this->input->post("payment_date")))
        ); 
       $table ="payments";
       if($this->input->post("payment_id")){
        $payment_id  = $this->input->post("payment_id");
        $update_at = array(
            'id'=>$payment_id
            );
        $afftectedRows =  $this->Dashboard_model->updateData($table,$insert_data,$update_at);
        $message = 'Payment data updated successfully';
    }else{
        $afftectedRows =  $this->Dashboard_model->insertData($table,$insert_data);
        $payment_id = $afftectedRows;
        $message = 'Purchase data saved successfully';
    }
    
    
}

}
$module = ucfirst($module);
$print_page = $this->input->post("print_page");
if($print_page==1){
    redirect("$module/payments/".md5($payment_id)."?action=print");
}
$this->session->set_flashdata('message',$message);
redirect("$module/payments_report");
}


public function sale_retail($id=null){
    $module = $this->uri->segment(1);
    if(isset($_REQUEST['action']) && $_REQUEST['action'] =="print")
        $print_page = $_REQUEST['action'];
    else
        $print_page = FALSE;            
    $where = "";
    $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
    $user_id  = $this->session->userdata['trade_user_data']['user_id'];
    $fields= "id,trade_name,gst_no,fertilizer_license,seed_license,pesticide_license,location,fertilizers_cgst,fertilizers_sgst,pesticides_cgst,pesticides_sgst,cement_sgst,cement_cgst,seeds_cgst,seeds_sgst,bank_details";
    if(!empty($where)){
     $where .= " AND ";
 }
 $where .= "id='".$gstin_id."'";
 $table ='gstins';
 $gstin_data = $this->Dashboard_model->get_single_data($fields,$where,$table);
 $logged_user_fields = "id,gstin_id,phone";
 $user_cons = "id=".$user_id;
 $user_table = "user";
 $user_data = $this->Dashboard_model->get_single_data($logged_user_fields,$user_cons,$user_table);
 $sale_retial_fields = "id,bill_no";
 $sale_retail_cons = "gstin_id=".$gstin_id." AND module='".strtolower($module)."'";
 $sale_retail = "sale_retail";
 $additional_data['limit'] = "1";
 $additional_data['order'] = array("id"=>"DESC");
 $bill_no_data = $this->Dashboard_model->get_single_data($sale_retial_fields,$sale_retail_cons,$sale_retail,$additional_data);
 $data['bill_no'] = (!empty($bill_no_data['bill_no'])) ? $bill_no_data['bill_no']+1 : 1;
 $data['user_data'] = $user_data;
 $data['gstin_data'] =$gstin_data;
 /* edit*/
 if(!empty($id)){
                //$sale_retails_fields = array("sale_retail.id,sale_retail.gstin_id,sale_retail.module,sale_retail.bill_no,sale_retail.bill_date,sale_retail.phone,sale_retail.farmer_name,sale_retail.farmer_aadhar_no,sale_retail.village,sale_retail.created,id,sale_retail_bill.id,sale_retail_bill.sale_retail_id,sale_retail_bill.variety,sale_retail_bill.quantity,sale_retail_bill.price,sale_retail_bill.total_price");
    $sale_retail_on = array('sale_retail_bill'=>'sale_retail_bill.sale_retail_id=sale_retail.id');
    
    $table_data_by = array(
        'table'=> 'sale_retail',
        'fields' => '*,sale_retail.id as saleretail_id',
        'where'=> array('md5(sale_retail.id)'=>$id),
        'join'=> $sale_retail_on
        );
    $sale_retail_data = $this->Dashboard_model->get_multirows_with_Join($table_data_by);
    $data['sale_retail_data'] =$sale_retail_data;
}

/* eof edit*/

$data['left_menu'] = 'Fertilizers/fertilizers_left_menu';
$data['selected_left_menu'] = "sale_retail";
$data['content'] = 'Fertilizers/stock_report';
$data['print_page'] = $print_page;
$this->load->view('Dashboard/default',$data);
}

        //pesticides sale retails
public function pesticides_sale_retail($id=null){
    $module = $this->uri->segment(1);
    $where = "";
    $user_id  = $this->session->userdata['trade_user_data']['user_id'];
    $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
    $fields= "id,trade_name,gst_no,fertilizer_license,seed_license,pesticide_license,location,fertilizers_cgst,fertilizers_sgst,pesticides_cgst,pesticides_sgst,cement_sgst,cement_cgst,seeds_cgst,seeds_sgst,bank_details";
    if(!empty($where)){
     $where .= " AND ";
 }
 $where .= "id='".$gstin_id."'";
 $table ='gstins';
 $gstin_data = $this->Dashboard_model->get_single_data($fields,$where,$table);
 $data['gstin_data'] =$gstin_data;
 /*bill no*/
 $saleretail_fields = "id,bill_no";
 $saleretail_cons = "gstin_id=".$gstin_id." AND module='".$module."'";
 $saleretail_table = "sale_retail";
 $additional_data['limit'] = "1";
 $additional_data['order'] = array("id"=>"DESC");
 $bill_no_data = $this->Dashboard_model->get_single_data($saleretail_fields,$saleretail_cons,$saleretail_table,$additional_data);
 $data['bill_no'] = (!empty($bill_no_data['bill_no'])) ? $bill_no_data['bill_no']+1 : 1;
 $logged_user_fields = "id,gstin_id,phone";
 $user_cons = "id=".$user_id;
 $user_table = "user";
 $user_data = $this->Dashboard_model->get_single_data($logged_user_fields,$user_cons,$user_table);
 $data['user_data'] = $user_data;
 /* edit*/
 if(!empty($id)){
                //$sale_retails_fields = array("sale_retail.id,sale_retail.gstin_id,sale_retail.module,sale_retail.bill_no,sale_retail.bill_date,sale_retail.phone,sale_retail.farmer_name,sale_retail.farmer_aadhar_no,sale_retail.village,sale_retail.created,pesticides_sale_retail_bill.id,pesticides_sale_retail_bill.sale_retail_id,pesticides_sale_retail_bill.company_name,pesticides_sale_retail_bill.packing,pesticides_sale_retail_bill.batch_no,pesticides_sale_retail_bill.mfg_date,pesticides_sale_retail_bill.exp_date,pesticides_sale_retail_bill.variety,pesticides_sale_retail_bill.quantity,pesticides_sale_retail_bill.price,pesticides_sale_retail_bill.total_price");
    $sale_retail_on = array('pesticides_sale_retail_bill'=>'pesticides_sale_retail_bill.sale_retail_id=sale_retail.id');
    
    $table_data_by = array(
        'table'=> 'sale_retail',
        'fields' => '*,sale_retail.id as saleretail_id',
        'where'=> array('md5(sale_retail.id)'=>$id),
        'join'=> $sale_retail_on
        );
    $sale_retail_data = $this->Dashboard_model->get_multirows_with_Join($table_data_by);
    $data['sale_retail_data'] =$sale_retail_data;
}

/* eof edit*/
$data['left_menu'] = 'Fertilizers/fertilizers_left_menu';
$data['selected_left_menu'] = "sale_retail";
$data['content'] = 'Fertilizers/pesticides_sale_retail';
$this->load->view('Dashboard/default',$data);   
}

public function save_sale_retail(){
   $data = array();
   $this->load->library('form_validation');
   if (isset($_POST) && !empty($_POST)) {
    $this->form_validation->set_rules('bill_date','Bill date','trim|required');
    $this->form_validation->set_rules('phone','phone','trim|required');
    $this->form_validation->set_rules('farmer_name', 'farmer name', 'trim|required');
    //$this->form_validation->set_rules('farmer_aadhar_no', 'farmer Aadhar', 'trim|required');
    $this->form_validation->set_rules('village_name', 'Villag name', 'trim|required');
    $module = strtolower($this->input->post("module"));
    if ($this->form_validation->run() == FALSE || $module=="") {
      $errors=validation_errors();
      $this->session->set_flashdata('message',$errors);
      redirect('Fertilizers/payments');
  } else {
     $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
     $insert_data = array(
        'gstin_id'=>$gstin_id,
        'module'=>$module,
        'bill_no'=> $this->input->post("bill_number"),
        'payment_type'=> $this->input->post("rtgs_cash"),
        'bill_date'=> date('Y-m-d ',strtotime($this->input->post("bill_date"))).date('H:i:s'),
        'phone'=> $this->input->post("phone"),
        'farmer_name'=> $this->input->post("farmer_name"),

        'village'=> $this->input->post("village_name"),
        'created'=>date('Y-m-d H:i:s')
        ); 
     $farmer_aadhar_no = $this->input->post("farmer_aadhar_no");
     if(isset($farmer_aadhar_no) && !empty($farmer_aadhar_no)){
        $insert_data['farmer_aadhar_no'] = $this->input->post("farmer_aadhar_no");
    }

    $table ="sale_retail";
    if($this->input->post("sale_retail_id")){
        /*Edit*/
        $sale_retail_id = $this->input->post("sale_retail_id"); 
        $update_at = array('id'=>$this->input->post("sale_retail_id"));
        $afftectedRows =  $this->Dashboard_model->updateData($table,$insert_data,$update_at);
        if($module == "pesticides"){
            $to_table = "pesticides_sale_retail_bill";
        }else{
            $to_table = "sale_retail_bill";
        }
        $delete_data = array(
            'colomn'=>'sale_retail_id',
            'delete_records'=>array($this->input->post("sale_retail_id")),
            'table'=>$to_table
            );
        $del_existing_rows =  $this->Dashboard_model->deleteData($delete_data); 
        $message = 'Sale Retail data updated successfully';
        $afftectedRows = $sale_retail_id;
    }else{
        $afftectedRows =  $this->Dashboard_model->insertData($table,$insert_data);
        $sale_retail_id = $afftectedRows;
        $message = 'Sale Retail data saved successfully';    
    }

    if($afftectedRows){
        $sale_retail_bill_data = array();
        $sno_data = $this->input->post('s_no');
        $variety = $this->input->post('variety');
                            $bags_count = $this->input->post('bags_count'); //for fertilizers,seeds,cement
                            $bag_price = $this->input->post('bag_price');
                            /*pesticides data*/
                            if($this->input->post('company')){
                                $company_name = $this->input->post('company');
                            }
                            /**/
                            if($this->input->post('batch_no')){
                                $batch_no = $this->input->post('batch_no');
                            }
                            if($this->input->post('mfg_date')){
                                $mfg_date = $this->input->post('mfg_date');
                            }
                            if($this->input->post('exp_date')){
                                $exp_date = $this->input->post('exp_date');
                            }
                            if($this->input->post('quantity')){
                                $bags_count = $this->input->post('quantity');
                            }
                            /*if($this->input->post('unit_quantity')){
                                $unit_quantity = $this->input->post('unit_quantity');
                            }
                            if($this->input->post('liquid_qty')){
                                $liquid_qty = $this->input->post('liquid_qty');
                            }
                            if($this->input->post('packing')){
                                $packing = $this->input->post('packing');
                            }*/
                            if($this->input->post('hsn_code')){
                                $hsn_code = $this->input->post('hsn_code');
                            }                            
                            
                            
                            
                            
                            /*eof pesticides data*/

                            $total_variety_price = $this->input->post('total_variety_price');

                            foreach ($sno_data as $key => $value) {
                                $sale_retail_bill_data[$key]['sale_retail_id'] = $afftectedRows;
                                $sale_retail_bill_data[$key]['variety'] = $variety[$value];
                                $sale_retail_bill_data[$key]['quantity'] = $bags_count[$value];
                                $sale_retail_bill_data[$key]['price'] = $bag_price[$value];
                                $sale_retail_bill_data[$key]['total_price'] = $total_variety_price[$value];
                                /*pesticides data*/
                                if($module == "pesticides"){
                                    $sale_retail_bill_data[$key]['company_name'] = $company_name[$value];
                                    $sale_retail_bill_data[$key]['hsn_code'] = $hsn_code[$value];
                                    $sale_retail_bill_data[$key]['batch_no'] = $batch_no[$value];
                                    $sale_retail_bill_data[$key]['mfg_date'] = date('Y-m-d H:i:s',strtotime($mfg_date[$value]));
                                    $sale_retail_bill_data[$key]['exp_date'] = date('Y-m-d H:i:s',strtotime($exp_date[$value]));
                                    /*$sale_retail_bill_data[$key]['unit_quantity'] = $unit_quantity[$value];
                                    $sale_retail_bill_data[$key]['liquid_qty'] = $liquid_qty[$value];
                                    $sale_retail_bill_data[$key]['packing'] = $packing[$value];*/
                                }else if($module == "seeds"){
                                    $sale_retail_bill_data[$key]['batch_no'] = $batch_no[$value];
                                }
                                /*eof pesticides data*/
                            }
                            
                            if(!empty($sale_retail_bill_data)){
                                if($module == "pesticides"){
                                    $insert_to_table = "pesticides_sale_retail_bill";
                                }else{
                                    $insert_to_table = "sale_retail_bill";
                                }
                                $afftectedRows =  $this->Dashboard_model->insert_batch_data($insert_to_table,$sale_retail_bill_data);
                            }
                        }
                        $module = ucfirst($module);
                        $print_page = $this->input->post("print_page");
                        if($print_page==1){
                            redirect("$module/view_bill/".md5($sale_retail_id)."?action=print");
                        }
                        $this->session->set_flashdata('message',$message);
                        redirect("$module/saleretails_report");
                        
                    }

                }
            }

            public function whole_sale($id=null){
                $module = $this->uri->segment(1);
                if(isset($_REQUEST['action']) && $_REQUEST['action'] =="print")
                    $print_page = $_REQUEST['action'];
                else
                    $print_page = FALSE;
                $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
                $fields= "id,trade_name,gst_no,fertilizer_license,seed_license,pesticide_license,location,fertilizers_cgst,fertilizers_sgst,pesticides_cgst,pesticides_sgst,cement_sgst,cement_cgst,seeds_cgst,seeds_sgst,bank_details";
                $where = "id='".$gstin_id."'";
                $table ='gstins';
                $gstin_data = $this->Dashboard_model->get_single_data($fields,$where,$table);
                $data['gstin_data'] =$gstin_data;
                $data['left_menu'] = 'Fertilizers/fertilizers_left_menu';
                $data['selected_left_menu'] = "whole_sale";
                $data['print_page'] = $print_page;
                $data['content'] = 'Fertilizers/stock_report';
                /*bill no*/
                $wholesale_fields = "id,bill_no";
                $wholesale_cons = "gstin_id=".$gstin_id." AND module='".$module."'";
                $wholesale_table = "whole_sale";
                $additional_data['limit'] = "1";
                $additional_data['order'] = array("id"=>"DESC");
                $bill_no_data = $this->Dashboard_model->get_single_data($wholesale_fields,$wholesale_cons,$wholesale_table,$additional_data);
                $data['bill_no'] = (!empty($bill_no_data['bill_no'])) ? $bill_no_data['bill_no']+1 : 1;
                /*user data*/
                $user_id  = $this->session->userdata['trade_user_data']['user_id'];
                $logged_user_fields = "id,gstin_id,phone";
                $user_cons = "id=".$user_id;
                $user_table = "user";
                $user_data = $this->Dashboard_model->get_single_data($logged_user_fields,$user_cons,$user_table);
                $data['user_data'] = $user_data;
                /* edit*/
                if(!empty($id)){
                //$sale_retails_fields = array("sale_retail.id,sale_retail.gstin_id,sale_retail.module,sale_retail.bill_no,sale_retail.bill_date,sale_retail.phone,sale_retail.farmer_name,sale_retail.farmer_aadhar_no,sale_retail.village,sale_retail.created,id,sale_retail_bill.id,sale_retail_bill.sale_retail_id,sale_retail_bill.variety,sale_retail_bill.quantity,sale_retail_bill.price,sale_retail_bill.total_price");
                    $wholesale_retail_on = array('whole_sale_bill'=>'whole_sale_bill.wholesale_id=whole_sale.id');
                    
                    $table_data_by = array(
                        'table'=> 'whole_sale',
                        'fields' => '*,whole_sale.id as wholesale_id',
                        'where'=> array('md5(whole_sale.id)'=>$id),
                        'join'=> $wholesale_retail_on
                        );
                    $wholesale_data = $this->Dashboard_model->get_multirows_with_Join($table_data_by);
                    $data['wholesale_data'] = $wholesale_data;
                }
                
                /* eof edit*/
                $this->load->view('Dashboard/default',$data);
            }

            public function pesticides_whole_sale($id=null){
                $module = $this->uri->segment(1);
                $user_id  = $this->session->userdata['trade_user_data']['user_id'];
                $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
                $fields= "id,trade_name,gst_no,fertilizer_license,seed_license,pesticide_license,location,fertilizers_cgst,fertilizers_sgst,pesticides_cgst,pesticides_sgst,cement_sgst,cement_cgst,seeds_cgst,seeds_sgst,bank_details";
                $where = "id='".$gstin_id."'";
                $table ='gstins';
                $gstin_data = $this->Dashboard_model->get_single_data($fields,$where,$table);
                $data['gstin_data'] =$gstin_data;
                $logged_user_fields = "id,gstin_id,phone";
                $user_cons = "id=".$user_id;
                $user_table = "user";
                $user_data = $this->Dashboard_model->get_single_data($logged_user_fields,$user_cons,$user_table);            
                /*bill no*/
                $wholesale_fields = "id,bill_no";
                $wholesale_cons = "gstin_id=".$gstin_id." AND module='".$module."'";
                $wholesale_table = "whole_sale";
                $additional_data['limit'] = "1";
                $additional_data['order'] = array("id"=>"DESC");
                $bill_no_data = $this->Dashboard_model->get_single_data($wholesale_fields,$wholesale_cons,$wholesale_table,$additional_data);
                $data['bill_no'] = (!empty($bill_no_data['bill_no'])) ? $bill_no_data['bill_no']+1 : 1;
                /* edit*/
                if(!empty($id)){
                    $wholesale_retail_on = array('pesticides_whole_sale_bill'=>'pesticides_whole_sale_bill.wholesale_id=whole_sale.id');
                    
                    $table_data_by = array(
                        'table'=> 'whole_sale',
                        'fields' => '*,whole_sale.id as wholesale_id',
                        'where'=> array('md5(whole_sale.id)'=>$id),
                        'join'=> $wholesale_retail_on
                        );
                    $wholesale_data = $this->Dashboard_model->get_multirows_with_Join($table_data_by);
                    $data['wholesale_data'] = $wholesale_data;
                }
                
                /* eof edit*/
                $data['user_data'] = $user_data;        
                $data['left_menu'] = 'Fertilizers/fertilizers_left_menu';
                $data['selected_left_menu'] = "whole_sale";
                $data['content'] = 'Fertilizers/pesticides_whole_sale';
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
                $this->form_validation->set_rules('customer_gst_no', 'Customer Gst No', 'trim|required');
                $this->form_validation->set_rules('sgst', 'SGST', 'trim|required');                               
                $this->form_validation->set_rules('cgst', 'CGST', 'trim|required');   
                $module = strtolower($this->input->post("module"));                                             
                if ($this->form_validation->run() == FALSE) {
                  $errors=validation_errors();
                  $this->session->set_flashdata('message',$errors);
                  redirect('Fertilizers/payments');
              } else {
               $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
               $insert_data = array(
                'gstin_id'=>$gstin_id,
                'module'=>$module,
                'bill_date'=> date('Y-m-d ',strtotime($this->input->post("bill_date"))).date('H:i:s'),
                'bill_no'=> $this->input->post("bill_number"),
                'payment_type'=> $this->input->post("rtgs_cash"),
                'phone'=> $this->input->post("phone"),
                'party_name'=> $this->input->post("party_name"),
                'location'=> $this->input->post("location"),
                'vehicle_no'=> $this->input->post("vehicle_no"),
                'customer_gst_no'=> $this->input->post("customer_gst_no"),
                'sgst'=> $this->input->post("sgst"),
                'cgst'=> $this->input->post("cgst"),
                'created'=>date('Y-m-d H:i:s')
                ); 
             
               $table ="whole_sale";
               if($this->input->post("wholesale_id")){
                /*Edit*/
                $wholesale_id =$this->input->post("wholesale_id");
                $update_at = array('id'=>$this->input->post("wholesale_id"));
                $afftectedRows =  $this->Dashboard_model->updateData($table,$insert_data,$update_at);
                if($module == "pesticides"){
                    $to_table = "pesticides_whole_sale_bill";
                }else{
                    $to_table = "whole_sale_bill";
                }
                $delete_data = array(
                    'colomn'=>'wholesale_id',
                    'delete_records'=>array($this->input->post("wholesale_id")),
                    'table'=>$to_table
                    );
                $del_existing_rows =  $this->Dashboard_model->deleteData($delete_data); 
                $message = 'Whole sale data updated successfully';
                $afftectedRows = $wholesale_id;
            }else{
                $afftectedRows =  $this->Dashboard_model->insertData($table,$insert_data);
                $wholesale_id = $afftectedRows;
                $message = 'Whole Sale data saved successfully';
            }
            
            if($afftectedRows){
                $total_wholesale_amount=0;
                $wholesale_bill_data = array();
                $sno_data = $this->input->post('s_no');
                $variety = $this->input->post('variety');
                $batch = $this->input->post('batch');
                if($module == "pesticides"){
                    $company_name = $this->input->post('company_name');
                    $mfg_date = $this->input->post('mfg_date');
                    $exp_date = $this->input->post('exp_date');
                    /*$liquid_qty= $this->input->post('liquid_qty');
                    $packing = $this->input->post('packing');
                    $unit_quantity= $this->input->post('unit_quantity');*/
                    $hsn_code = $this->input->post('hsn_code');
                }
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
                    $total_wholesale_amount = $total_wholesale_amount+$amount[$value];
                    if($module == "pesticides"){
                        $wholesale_bill_data[$key]['company_name'] = $company_name[$value];
                        $wholesale_bill_data[$key]['mfg_date'] = $mfg_date[$value];
                        $wholesale_bill_data[$key]['exp_date'] = $exp_date[$value];
                        $wholesale_bill_data[$key]['hsn_code'] = $hsn_code[$value];
                        /*$wholesale_bill_data[$key]['unit_quantity'] = $unit_quantity[$value];
                        $wholesale_bill_data[$key]['packing'] = $packing[$value];
                        $wholesale_bill_data[$key]['liquid_qty'] = $liquid_qty[$value];*/
                    }
                }
                /* add taxes and update main table*/
                $total_wholesale_amount = $total_wholesale_amount+$this->input->post("cgst")+$this->input->post("sgst");
                $update_data = array(
                    'total_amount'=> $total_wholesale_amount,
                    );
                $update_at = array('id'=>$afftectedRows
                    );
                $afftectedRows =  $this->Dashboard_model->updateData($table,$update_data,$update_at);
                /*eof add taxes and update main table*/
                if(!empty($wholesale_bill_data
                    )){
                    if($module == "pesticides")
                        $insert_to_table ="pesticides_whole_sale_bill";
                    else
                        $insert_to_table ="whole_sale_bill";
                    $afftectedRows =  $this->Dashboard_model->insert_batch_data($insert_to_table,$wholesale_bill_data);
                }
            }
            $module = ucfirst($module);
            $print_page = $this->input->post("print_page");
            if($print_page==1){
                redirect("$module/view_whole_bill/".md5($wholesale_id)."?action=print");
            }
            $this->session->set_flashdata('message',$message);
            redirect("$module/wholesale_report"); 
            
        }

    }
}


public function payments_report(){

    $module = $this->uri->segment(1);
    $module_name = strtolower($module);
    $where = "";
    if(!empty($module_name)){
     $where .= "module='".$module_name."'";
 }
 $data['selected_left_menu'] = "payments_report";
 $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
 
 $fields= "id,gstin_id,company_name,module,rtgs_cash,    rtgs_number,amount, payment_date,created";
 if(!empty($where)){
     $where .= " AND ";
 }
 $where .= "gstin_id='".$gstin_id."'";
 $table ='payments';
 $purchase_table_data = array('fields'=>$fields,'where'=>$where,'table'=>$table);
 $payments_report = $this->Dashboard_model->get_multirows($purchase_table_data);
 $data['payments_report'] =$payments_report;
 $data['left_menu'] = 'Fertilizers/fertilizers_left_menu';
 $data['content'] = 'Fertilizers/view_stock_report';
 $this->load->view('Dashboard/default',$data);
 
}

public function saleretails_report(){
    $module = $this->uri->segment(1);
    $module_name = strtolower($module);
    $where = "";
    if(!empty($module_name)){
     $where .= "module='".$module_name."'";
 }
 $data['selected_left_menu'] = "sale_retail";
 $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
 
 $fields= "sale_retail.id,sale_retail.gstin_id,sale_retail.bill_date,sale_retail.bill_no,sale_retail.phone,sale_retail.farmer_name,sale_retail.village,sale_retail.created";
 if(!empty($where)){
     $where .= " AND ";
 }
 $where .= "gstin_id='".$gstin_id."'";
 $table ='sale_retail';
 $additional_data_order = array('id'=>'DESC');
 $table_data = array('fields'=>$fields,'where'=>$where,'table'=>$table,'order'=>$additional_data_order);
 $saleretail_report = $this->Dashboard_model->get_multirows($table_data);
 $data['saleretail_report'] =$saleretail_report;
 $data['left_menu'] = 'Fertilizers/fertilizers_left_menu';
 $data['content'] = 'Fertilizers/view_stock_report';
 $this->load->view('Dashboard/default',$data);
}     

public function view_bill($bill_id){

    $module = $this->uri->segment(1);
    $module_name = strtolower($module);
    if(isset($_REQUEST['action']) && $_REQUEST['action'] =="print")
        $print_page = $_REQUEST['action'];
    else
        $print_page = FALSE;
    $where = $maintable_where = "";
    if(!empty($module_name)){
     $maintable_where .= "module='".$module_name."'";
     $maintable_fields= "*";
     
     $maintable_where .= " AND md5(id)='".$bill_id."'";
     $maintable_table ='sale_retail';
     $maintable_data = array('fields'=>$maintable_fields,'where'=>$maintable_where,'table'=>$maintable_table);
     $maintable_table_data = $this->Dashboard_model->get_single_data($maintable_fields,$maintable_where,$maintable_table);
     $data['maintable_table_data'] = $maintable_table_data;
 }
 $data['selected_left_menu'] = "saleretails_report";
 $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
 
 $fields= "sale_retail_id,variety,quantity,price,total_price";
 if(!empty($where)){
     $where .= " AND ";
 }
 $where .= "md5(sale_retail_id)='".$bill_id."'";
 $table ='sale_retail_bill';
 $table_data = array('fields'=>$fields,'where'=>$where,'table'=>$table);
 $saleretail_bill_report = $this->Dashboard_model->get_multirows($table_data);
 $data['saleretail_bill_report'] = $saleretail_bill_report;
 /* gstin data*/
 $gsting_where = "";
 $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
 $user_id  = $this->session->userdata['trade_user_data']['user_id'];
 $gstin_fields= "id,trade_name,gst_no,fertilizer_license,seed_license,pesticide_license,location,fertilizers_cgst,fertilizers_sgst,pesticides_cgst,pesticides_sgst,cement_sgst,cement_cgst,seeds_cgst,seeds_sgst,bank_details";
 if(!empty($gsting_where)){
     $gsting_where .= " AND ";
 }
 $gsting_where .= "id='".$gstin_id."'";
 $gsting_table ='gstins';
 $gstin_data = $this->Dashboard_model->get_single_data($gstin_fields,$gsting_where,$gsting_table);
 $data['gstin_data'] = $gstin_data;
 /* eof gstin data*/
 $data['left_menu'] = 'Fertilizers/fertilizers_left_menu';
 $data['content'] = 'Fertilizers/view_bill';
 $data['print_page'] = $print_page;
 $this->load->view('Dashboard/default',$data);
 
}   

public function view_whole_bill($bill_id){

    $module = $this->uri->segment(1);
    $module_name = strtolower($module);
    if(isset($_REQUEST['action']) && $_REQUEST['action'] =="print")
        $print_page = $_REQUEST['action'];
    else
        $print_page = FALSE;
    $where = $maintable_where = "";
    if(!empty($module_name)){
     $maintable_where .= "module='".$module_name."'";
     $maintable_fields= "*";
     
     $maintable_where .= " AND md5(id)='".$bill_id."'";
     $maintable_table ='whole_sale';
     $maintable_data = array('fields'=>$maintable_fields,'where'=>$maintable_where,'table'=>$maintable_table);
     $maintable_table_data = $this->Dashboard_model->get_single_data($maintable_fields,$maintable_where,$maintable_table);
     $data['maintable_table_data'] = $maintable_table_data;
 }
 $data['selected_left_menu'] = "whole_sale";
 $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
 
 $fields= "id,wholesale_id,variety,batch,quantity,price,amount";
 if(!empty($where)){
     $where .= " AND ";
 }
 $where .= "md5(wholesale_id)='".$bill_id."'";
 $table ='whole_sale_bill';
 $table_data = array('fields'=>$fields,'where'=>$where,'table'=>$table);
 $wholesale_bill_report = $this->Dashboard_model->get_multirows($table_data);
 $data['wholesale_bill_report'] = $wholesale_bill_report;
 /* gstin data*/
 $gsting_where = "";
 $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
 $user_id  = $this->session->userdata['trade_user_data']['user_id'];
 $gstin_fields= "id,trade_name,gst_no,fertilizer_license,seed_license,pesticide_license,location,fertilizers_cgst,fertilizers_sgst,pesticides_cgst,pesticides_sgst,cement_sgst,cement_cgst,seeds_cgst,seeds_sgst,bank_details";
 if(!empty($gsting_where)){
     $gsting_where .= " AND ";
 }
 $gsting_where .= "id='".$gstin_id."'";
 $gsting_table ='gstins';
 $gstin_data = $this->Dashboard_model->get_single_data($gstin_fields,$gsting_where,$gsting_table);
 $data['gstin_data'] = $gstin_data;
 /* eof gstin data*/
 $data['left_menu'] = 'Fertilizers/fertilizers_left_menu';
 $data['print_page'] = $print_page;
 $data['content'] = 'Fertilizers/view_bill';
 $this->load->view('Dashboard/default',$data);
 
}
public function pesticides_view_bill($bill_id){
    if(isset($_REQUEST['action']) && $_REQUEST['action'] =="print")
        $print_page = $_REQUEST['action'];
    else
        $print_page = FALSE;
    $module = $this->uri->segment(1);
    $module_name = strtolower($module);
    $where = $maintable_where = "";
    if(!empty($module_name)){
     $maintable_where .= "module='".$module_name."'";
     $maintable_fields= "*";
     
     $maintable_where .= " AND md5(id)='".$bill_id."'";
     $maintable_table ='sale_retail';
     $maintable_data = array('fields'=>$maintable_fields,'where'=>$maintable_where,'table'=>$maintable_table);
     $maintable_table_data = $this->Dashboard_model->get_single_data($maintable_fields,$maintable_where,$maintable_table);
     $data['maintable_table_data'] = $maintable_table_data;
 }
 $data['selected_left_menu'] = "saleretails_report";
 $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
 
 $fields= "sale_retail_id,variety,quantity,price,total_price,company_name,batch_no,packing,exp_date,mfg_date,unit_quantity,liquid_qty";
 if(!empty($where)){
     $where .= " AND ";
 }
 $where .= "md5(sale_retail_id)='".$bill_id."'";
 $table ='pesticides_sale_retail_bill';
 $table_data = array('fields'=>$fields,'where'=>$where,'table'=>$table);
 $saleretail_bill_report = $this->Dashboard_model->get_multirows($table_data);
            //echo $str = $this->db->last_query();
            //print_r($saleretail_bill_report);exit;
 /* gstin data*/
 $gsting_where = "";
 $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
 $user_id  = $this->session->userdata['trade_user_data']['user_id'];
 $gstin_fields= "id,trade_name,gst_no,fertilizer_license,seed_license,pesticide_license,location,fertilizers_cgst,fertilizers_sgst,pesticides_cgst,pesticides_sgst,cement_sgst,cement_cgst,seeds_cgst,seeds_sgst,bank_details";
 if(!empty($gsting_where)){
     $gsting_where .= " AND ";
 }
 $gsting_where .= "id='".$gstin_id."'";
 $gsting_table ='gstins';
 $gstin_data = $this->Dashboard_model->get_single_data($gstin_fields,$gsting_where,$gsting_table);
 $data['gstin_data'] = $gstin_data;
 /* eof gstin data*/            
 $data['saleretail_bill_report'] = $saleretail_bill_report;
 $data['print_page'] = $print_page;
 $data['left_menu'] = 'Fertilizers/fertilizers_left_menu';
 $data['content'] = 'Fertilizers/pesticides_view_bill';
 $this->load->view('Dashboard/default',$data);
}

public function pesticides_view_wholesale_bill($bill_id){
    if(isset($_REQUEST['action']) && $_REQUEST['action'] =="print")
        $print_page = $_REQUEST['action'];
    else
        $print_page = FALSE;
    $module = $this->uri->segment(1);
    $module_name = strtolower($module);
    $where = $maintable_where = "";
    if(!empty($module_name)){
     $maintable_where .= "module='".$module_name."'";
     $maintable_fields= "*";
     
     $maintable_where .= " AND md5(id)='".$bill_id."'";
     $maintable_table ='whole_sale';
     $maintable_data = array('fields'=>$maintable_fields,'where'=>$maintable_where,'table'=>$maintable_table);
     $maintable_table_data = $this->Dashboard_model->get_single_data($maintable_fields,$maintable_where,$maintable_table);
     $data['maintable_table_data'] = $maintable_table_data;
 }
 $data['selected_left_menu'] = "whole_sale";
 $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
 
 $fields= "*";
 if(!empty($where)){
     $where .= " AND ";
 }
 $where .= "md5(wholesale_id)='".$bill_id."'";
 $table ='pesticides_whole_sale_bill';
 $table_data = array('fields'=>$fields,'where'=>$where,'table'=>$table);
 $wholesale_bill_report = $this->Dashboard_model->get_multirows($table_data);
 $data['wholesale_bill_report'] = $wholesale_bill_report;
 $data['print_page'] = $print_page;
 /* gstin data*/
 $gsting_where = "";
 $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
 $user_id  = $this->session->userdata['trade_user_data']['user_id'];
 $gstin_fields= "id,trade_name,gst_no,fertilizer_license,seed_license,pesticide_license,location,fertilizers_cgst,fertilizers_sgst,pesticides_cgst,pesticides_sgst,cement_sgst,cement_cgst,seeds_cgst,seeds_sgst,bank_details";
 if(!empty($gsting_where)){
     $gsting_where .= " AND ";
 }
 $gsting_where .= "id='".$gstin_id."'";
 $gsting_table ='gstins';
 $gstin_data = $this->Dashboard_model->get_single_data($gstin_fields,$gsting_where,$gsting_table);
 $data['gstin_data'] = $gstin_data;
 /* eof gstin data*/            
 $data['left_menu'] = 'Fertilizers/fertilizers_left_menu';
 $data['content'] = 'Fertilizers/view_bill';
 $this->load->view('Dashboard/default',$data);
 
}


public function wholesale_report(){
    $module = $this->uri->segment(1);
    $module_name = strtolower($module);
    $where = "";
    if(!empty($module_name)){
     $where .= "module='".$module_name."'";
 }
 $data['selected_left_menu'] = "whole_sale";
 $gstin_id  = $this->session->userdata['trade_user_data']['gstin_id'];
 
 $fields= "whole_sale.id,whole_sale.gstin_id,whole_sale.module,whole_sale.bill_date,whole_sale.bill_no,whole_sale.phone,whole_sale.party_name,whole_sale.location,whole_sale.vehicle_no,whole_sale.customer_gst_no,whole_sale.sgst,whole_sale.cgst,whole_sale.total_amount,whole_sale.created";
 if(!empty($where)){
     $where .= " AND ";
 }
 $where .= "gstin_id='".$gstin_id."'";
 $table ='whole_sale';
 $additional_data_order = array('whole_sale.id'=>'DESC');
 $table_data = array('fields'=>$fields,'where'=>$where,'table'=>$table,'order'=>$additional_data_order);
 $wholesale_report = $this->Dashboard_model->get_multirows($table_data);
 $data['wholesale_report'] = $wholesale_report;
 $data['left_menu'] = 'Fertilizers/fertilizers_left_menu';
 $data['content'] = 'Fertilizers/view_stock_report';
 $this->load->view('Dashboard/default',$data);
}

public function testverion(){
    echo phpinfo();
}
}
