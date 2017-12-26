<link href="<?php echo base_url('assets/css/jquery-ui1.12.1.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap-datetimepicker.css'); ?>" rel="stylesheet">
<style type="text/css">
    .ui-autocomplete
{
    position:absolute;
    cursor:default;
    z-index:1001 !important
}
</style>
<?php
$selected_left_menu = $this->uri->segment(2);
$module = $this->uri->segment(1);
if($module == "Fertilizers"){
    $cgst_percentage = $gstin_data['fertilizers_cgst'];
    $sgst_percentage = $gstin_data['fertilizers_sgst'];
}else if($module == "Seeds"){
    $cgst_percentage = $gstin_data['seeds_cgst'];
    $sgst_percentage = $gstin_data['seeds_cgst'];
}else if($module == "Pesticides"){
    $cgst_percentage = $gstin_data['pesticides_cgst'];
    $sgst_percentage = $gstin_data['pesticides_cgst'];
}else if($module == "Cement"){
    $cgst_percentage = $gstin_data['cement_cgst'];
    $sgst_percentage = $gstin_data['cement_cgst'];
}
?>
<div class="container">
    <div class="row">
     <div class="col-md-12">
         <div class="col-md-2">
         <?php $this->load->view($left_menu); ?>
         </div>
         <div class="col-md-10">
             <!-- purchase panel preview -->
        <div class="col-sm-12">
        <?php if($selected_left_menu == "purchase"){
          $purchase_id = (!empty($purchase_report['id'])) ? $purchase_report['id'] : ""; 
          $invoice = (!empty($purchase_report['invoice'])) ? $purchase_report['invoice'] : "";
          $batch_no = (!empty($purchase_report['batch_no'])) ? $purchase_report['batch_no'] : "";
          
          $invoice_date = (!empty($purchase_report['invoice_date']) && $purchase_report['invoice_date']!="0000-00-00") ? date('d-m-Y',strtotime($purchase_report['invoice_date'])) : "";
          $company_name = (!empty($purchase_report['company_name'])) ? $purchase_report['company_name'] : "";
          $material_type = (!empty($purchase_report['material_type'])) ? $purchase_report['material_type'] : "";
          $quantity = (!empty($purchase_report['quantity'])) ? $purchase_report['quantity'] : "";
          $value = (!empty($purchase_report['value'])) ? $purchase_report['value'] : "";
          $purchase_sgst = (!empty($purchase_report['sgst'])) ? $purchase_report['sgst'] : "";
          $purchase_cgst = (!empty($purchase_report['cgst'])) ? $purchase_report['cgst'] : "";
          $lorry_frieght = (!empty($purchase_report['lorry_frieght'])) ? $purchase_report['lorry_frieght'] : "";
          $check_seleciton= (!empty($purchase_report['before_stock']) && !empty($purchase_report['before_stock'])) ? "checked='checked'"  : "";
          ?>
        <div class="col-sm-12 pull-right">
        <a class="btn btn-primary none" href="<?php echo base_url().ucfirst($module) ?>/purchase_report"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;View Purchase Report
        </a></div>
        <h4 align="center"><?php echo $module; ?>&nbsp;Purchase</h4>

<form class="form-horizontal" role="form" id="fertilizers_purchase_form" action="<?php echo base_url() ?>Fertilizers/save_purchase" method="POST">            
            <div class="panel panel-default">
                <div class="panel-body form-horizontal payment-form">
                <input type="checkbox" name="before_stock" id="before_stock" <?php echo $check_seleciton; ?> class="<?php echo (!empty($check_seleciton)) ? 'none':''; ?>">
                <label for="before_stock" class="control-label <?php echo (!empty($check_seleciton)) ? 'none':''; ?>">Before Stock</label>
                    <div class="form-group">
                        <label for="company_name" class="col-sm-5 control-label">Company Name</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo $company_name; ?>">
                            <input type="hidden" class="form-control" id="purchase_id" name="purchase_id" value="<?php echo $purchase_id; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="invoice" class="col-sm-5 control-label">Innvoice</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="invoice" name="invoice" value="<?php echo $invoice; ?>">
                        </div>
                    </div>
<div class="form-group">
                        <label for="bill_date" class="col-sm-5 control-label">Invoice Date</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="bill_date" name="bill_date" value="<?php echo $invoice_date; ?>" readonly="readonly">
                        </div>
                    </div>
                    <?php if($module =="Seeds"){ ?>
                    <div class="form-group">
                        <label for="bill_date" class="col-sm-5 control-label">Batch No</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="batch_no" name="batch_no" value="<?php echo $batch_no; ?>" >
                        </div>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="material_type" class="col-sm-5 control-label">Kind & Variety</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="material_type" name="material_type" value="<?php echo $material_type; ?>">
                        </div>
                        <div id="suggesstion-box"></div>
                    </div> 
                    <div class="form-group">
                        <label for="quantity" class="col-sm-5 control-label">Quantity</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $quantity; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="value" class="col-sm-5 control-label">Value</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="value" name="value" value="<?php echo $value; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="purchase_cgst" class="col-sm-5 control-label">Cgst</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="purchase_cgst" name="purchase_cgst" value="<?php echo $purchase_cgst; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sgst" class="col-sm-5 control-label">Sgst</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="purchase_sgst" name="purchase_sgst" value="<?php echo $purchase_sgst; ?>">
                        </div>
                    </div>
                                                           
                    <div class="form-group">
                        <label for="lorry_frieght" class="col-sm-5 control-label">Lorry frieght</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="lorry_frieght" name="lorry_frieght" value="<?php echo $lorry_frieght; ?>">
                        </div>
                    </div>
                    <input type="hidden"  id="module_type" name="module" value= '<?php echo $module; ?>' />   
                    <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-default btn-primary none" id="save_purchase">
                                 Save
                            </button>
                            <button type="button" class="btn btn-default btn-primary none" id="save_purchase_print">
                                 Save & Print
                            </button>
                            <input type="hidden" name="print_page" id="print_page" value="0">
<a href="<?php echo base_url(); ?>Fertilizers/stockreport" class="btn btn-default none">Cancel</a>                        </div>
                    </div>
                </div>
            </div> 
            </form>     
        <?php    }else if($selected_left_menu == "payments"){ 
          $payment_id = (!empty($payments_report['id'])) ? $payments_report['id'] : ""; 
          $rtgs_cash = (!empty($payments_report['rtgs_cash'])) ? $payments_report['rtgs_cash'] : "";
          $company_name = (!empty($payments_report['company_name'])) ? $payments_report['company_name'] : "";
          $rtgs_number = (!empty($payments_report['rtgs_number'])) ? $payments_report['rtgs_number'] : "";
          $amount = (!empty($payments_report['amount'])) ? $payments_report['amount'] : "";
          $payment_date = (!empty($payments_report['payment_date'])) ? date("d-m-Y",strtotime($payments_report['payment_date'])) : "";
          ?>
<div class="col-sm-12 pull-right">
        <a class="btn btn-primary none" href="<?php echo base_url().ucfirst($module) ?>/payments_report"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;View Payments Report</a></div>          
<h4 align="center"><?php echo $module; ?>&nbsp;Payments</h4>
<form class="form-horizontal" role="form" id="fertilizers_payments_form" action="<?php echo base_url() ?>Fertilizers/save_payment" method="POST">            
            <div class="panel panel-default">
                <div class="panel-body form-horizontal payment-form">
                    <div class="form-group">
                        <label for="company_name" class="col-sm-5 control-label">Company Name</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo $company_name; ?>">
                            <input type="hidden" class="form-control" id="payment_id" name="payment_id" value="<?php echo $payment_id; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="rtgs_cash" class="col-sm-5 control-label">Rtgs/Cash</label>
                        <div class="col-sm-7">
                            <select name="rtgs_cash" id="rtgs_cash" class="form-control">
                                <option value="rtgs" <?php echo ($rtgs_cash=="rtgs") ? "selected" : ""; ?> >Rtgs</option>
                                <option value="cash" <?php echo ($rtgs_cash=="cash") ? "selected" : ""; ?>>Cash</option>
                            </select>
                            
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label for="rtgs_number" class="col-sm-5 control-label">Rtgs Number</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="rtgs_number" name="rtgs_number" value="<?php echo $rtgs_number; ?>">
                        </div>
                        <div id="suggesstion-box"></div>
                    </div> 
                    <div class="form-group">
                        <label for="amount" class="col-sm-5 control-label">Amount</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="amount" name="amount" value="<?php echo $amount; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="payment_date" class="col-sm-5 control-label">Date</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="payment_date" name="payment_date" value="<?php echo $payment_date; ?>">
                        <input type="hidden"  id="module_type" name="module" value= '<?php echo $module; ?>' />   
                        </div>
                    </div>
                     <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-default btn-primary" id="save_payment">
                                 Save
                            </button>
                            <button type="button" class="btn btn-default btn-primary none" id="save_payment_print">
                                 Save & Print
                            </button>
                            <input type="hidden" name="print_page" id="print_page" value="0">                            
                                 <a href="<?php echo base_url(); ?>Fertilizers/stockreport" class="btn btn-default">Cancel</a>
                            
                        </div>
                    </div>
                </div>
            </div> 
            </form>
        <?php  }else if($selected_left_menu =="sale_retail"){ 
 $gstin_number = $gstin_data['gst_no'];
 $bill_number= (!empty($sale_retail_data[0]['bill_no'])) ? $sale_retail_data[0]['bill_no'] : $bill_no;
 $fl_no = $gstin_data['fertilizer_license'];
 $user_phone = (!empty($sale_retail_data[0]['phone'])) ? $sale_retail_data[0]['phone'] : $user_data['phone'];
 $farmer_name = (!empty($sale_retail_data[0]['farmer_name']))  ? $sale_retail_data[0]['farmer_name'] : "";
 $farmer_aadhar_no = (!empty($sale_retail_data[0]['farmer_aadhar_no'])) ? $sale_retail_data[0]['farmer_aadhar_no'] : "";
 $village = (!empty($sale_retail_data[0]['village'])) ? $sale_retail_data[0]['village'] : "";
$sale_retail_bill_date = (!empty($sale_retail_data[0]['bill_date'])) ? date('d-m-Y',strtotime($sale_retail_data[0]['bill_date'])) : "";

$sale_retail_id = (!empty($sale_retail_data[0]['saleretail_id'])) ? $sale_retail_data[0]['saleretail_id'] : "0";
$rtgs_cash= (!empty($sale_retail_data[0]['payment_type'])) ? $sale_retail_data[0]['payment_type'] : "2";


          ?>
          <div class="col-sm-12 pull-right">
        <a class="btn btn-primary" href="<?php echo base_url().ucfirst($module) ?>/saleretails_report"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;View Sale Retail Report</a></div>
              <h4 align="center"><?php echo $module; ?>&nbsp;Sale Retail</h4>
<form class="form-horizontal" role="form" id="fertilizers_payments_form" action="<?php echo base_url() ?>Fertilizers/save_sale_retail" method="POST">            
            <div class="panel panel-default">
                <div class="panel-body form-horizontal payment-form">
                <h4 align="center"><?php echo $this->session->userdata['trade_user_data']['trade_name']; ?></h4> 
                <div class="form-group">
                        <div class="alert alert-danger" style="display: none" id="error_div">
  <!-- <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> -->
  <strong id="error_msg"></strong>
</div>
                    </div>                   
                    <div class="form-group">
                        <label for="gstin_number" class="col-sm-5 control-label">Gstin</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="gstin_number" name="gstin_number" value="<?php echo $gstin_number; ?>" readonly="readonly">
                        </div>
                        <div id="suggesstion-box"></div>
                    </div> 
                    <div class="form-group">
                        <label for="fl_no" class="col-sm-5 control-label">Fertilizers License</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="fl_no" name="fl_no" value="<?php echo $fl_no; ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bill_number" class="col-sm-5 control-label">Company Bill No.</label>
                        <div class="col-sm-7">
                        <div class="col-xs-3">
                            <input type="text" class="form-control" id="bill_number" name="bill_number" value="<?php echo $bill_number; ?>" readonly="readonly">
                   <input type="hidden" class="form-control" id="sale_retail_id" name="sale_retail_id" value="<?php echo $sale_retail_id; ?>" >
                        </div>
                        <a href="javascript:void(0)" id="edit_saleretail_billnno">
                            <span style="cursor: pointer;" class="glyphicon glyphicon-pencil" ></span>
                            </a>
                        </div>
                    </div>
                    
<div class="form-group">
                        <label for="rtgs_cash" class="col-sm-5 control-label">Cash/Credit</label>
                        <div class="col-sm-7">
                            <select name="rtgs_cash" id="rtgs_cash" class="form-control">
                                <option value="1" <?php echo ($rtgs_cash=="1") ? "selected" : ""; ?> >Credit</option>
                                <option value="2" <?php echo ($rtgs_cash=="2") ? "selected" : ""; ?>>Cash</option>
                            </select>
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="bill_date" class="col-sm-5 control-label">Date</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="bill_date" name="bill_date" value="<?php echo $sale_retail_bill_date; ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-5 control-label">Cell </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $user_phone; ?>">
                        </div>
                    </div>
                    
                    <?php if($module=="Fertilizers"){ ?>
                      <div class="form-group">
                        <label for="farmer_aadhar_no" class="col-sm-5 control-label">Farmer Aadhar No </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="farmer_aadhar_no" name="farmer_aadhar_no" value="<?php echo $farmer_aadhar_no; ?>">
                        </div>
                    </div>
                    <?php } ?>  

                    <div class="form-group">
                        <label for="farmer_name" class="col-sm-5 control-label">Farmer Name </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="farmer_name" name="farmer_name" value="<?php echo $farmer_name ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="village_name" class="col-sm-5 control-label">Village Name </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="village_name" name="village_name" value="<?php echo $village ?>">
                        </div>
                    </div>

                    <div class="form-group">
                      <table width="80%" align="center" border="2px solid #ccc" style="border-collapse: collapse" class="sale_retail_billing_items">
                        <thead>
                          <th style="width:5%;">S.No</th>
                          <th>Variety</th>
                          <?php if($module =="Seeds"){   ?>
                          <th>Batch No</th>
                          <?php  } ?>
                          <th>No.Bags</th>
                          <th>Price/1 Bag</th>
                          <th>Price</th>
                          <th>Action</th>
                        </thead>
                        <tbody>
                        <?php 
                        $saleretail_total_price=0;
                        if(isset($sale_retail_data) && !empty($sale_retail_data)){
                            foreach ($sale_retail_data as $salekey => $saleretail_value) {
                                $current_key = $salekey+1;
                            
                            echo "<tr>";
                            echo "<td><label class='sno_label'>".$current_key."</label><input class'form-control' type='hidden' name='s_no[]' value='".$current_key."' readonly='readonly'></td>";
                            echo "<td><input class='form-control kind_variety' type='text' name='variety[".$current_key."]' value='".$saleretail_value['variety']."' autocomplete='off'></td>";
                            
                    if($module =="Seeds"){  
                        echo "<td><input class='form-control' type='text' name='batch_no[".$current_key."]' value='".$saleretail_value['batch_no']."' autocomplete='off'></td>";
                           }

                      
                            echo "<td><input class='form-control sale_retail_qty' type='text' name='bags_count[".$current_key."]' value='".$saleretail_value['quantity']."' autocomplete='off'></td>";
                            echo "<td><input class='form-control sale_retail_price' type='text' name='bag_price[".$current_key."]' value='".$saleretail_value['price']."' autocomplete='off'></td>";
                            echo "<td><input class='form-control sale_retail_qty_totalprice' type='text' name='total_variety_price[".$current_key."]' value='".$saleretail_value['total_price']."' autocomplete='off'></td>";
                            echo "<td><span class='glyphicon glyphicon-plus add_sale_retail_row'></span> &nbsp; <span class='glyphicon glyphicon-minus remove_current_sale_retail_row'></span></td>";
                          echo "</tr>";
                          $saleretail_total_price = $saleretail_total_price+$saleretail_value['total_price'];
                      }
                        }else{ ?>
                          <tr>
                            <td><label class='sno_label'>1</label><input class="form-control" type="hidden" name="s_no[]" value="1" readonly="readonly"></td>
                            <td><input class="form-control kind_variety" type="text" name="variety[1]" autocomplete="off"></td>
                           <?php if($module =="Seeds"){   ?>
                           <td><input class="form-control" type="text" name="batch_no[1]" autocomplete="off"></td>
                           <?php } ?>
                            <td><input class="form-control sale_retail_qty" type="text" name="bags_count[1]" autocomplete="off" ></td>
                            <td><input class="form-control sale_retail_price" type="text" name="bag_price[1]" autocomplete="off" ></td>
                            <td><input class="form-control sale_retail_qty_totalprice" type="text" name="total_variety_price[1]" autocomplete="off"></td>
                            <td><span class="glyphicon glyphicon-plus add_sale_retail_row"></span> &nbsp; <span class="glyphicon glyphicon-minus remove_current_sale_retail_row"></span></td>
                          </tr>
                        <?php  }
                        ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="form-group">
                        
                        <div class="col-sm-2 pull-right">
                        <strong>   Total : <span id="saleretail_total_price"><?php echo $saleretail_total_price; ?></span> </strong>
<span class="glyphicon glyphicon-refresh" onclick="calculate_total_saleretail_bill()"></span>
                    </div>
    <input type="hidden"  id="module_type" name="module" value= '<?php echo $module; ?>' />   
    </div>
                     <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <button type="button" value="Save" class="btn btn-default btn-primary" id="save_sale_retail">
                                 Save
                            </button>
                            <button type="button" class="btn btn-default btn-primary none" id="save_sale_retail_print">
                                 Save & Print
                            </button>
                            <input type="hidden" name="print_page" id="print_page" value="0">                            
                                 <a href="<?php echo base_url(); ?>Fertilizers/stockreport" class="btn btn-default">Cancel</a>
                            
                        </div>
                    </div>
                </div>
            </div> 
            </form>
        <?php  }else if($selected_left_menu == "whole_sale"){
 
 $gstin_number = $gstin_data['gst_no'];
 $bill_number= (!empty($wholesale_data[0]['bill_no'])) ? $wholesale_data[0]['bill_no'] : $bill_no;
 
 $fl_no = $gstin_data['fertilizer_license'];
 $user_phone = $user_data['phone'];

 $bill_date = ((!empty($wholesale_data[0]['bill_date'])) && !empty($wholesale_data[0]['bill_date'])) ? date('d-m-Y',strtotime($wholesale_data[0]['bill_date'])) : "";
 $party_name = ((!empty($wholesale_data[0]['party_name'])) && !empty($wholesale_data[0]['party_name'])) ? $wholesale_data[0]['party_name'] : "";
 $location = ((!empty($wholesale_data[0]['location'])) && !empty($wholesale_data[0]['location'])) ? ($wholesale_data[0]['location']) : "";
 $vehicle_no = ((!empty($wholesale_data[0]['vehicle_no'])) && !empty($wholesale_data[0]['vehicle_no'])) ? ($wholesale_data[0]['vehicle_no']) : "";
 $customer_gst_no = ((!empty($wholesale_data[0]['customer_gst_no'])) && !empty($wholesale_data[0]['customer_gst_no'])) ? ($wholesale_data[0]['customer_gst_no']) : "";
$wholesale_sgst =((!empty($wholesale_data[0]['sgst'])) && !empty($wholesale_data[0]['sgst'])) ? ($wholesale_data[0]['sgst']) : "";
$wholesale_cgst =((!empty($wholesale_data[0]['cgst'])) && !empty($wholesale_data[0]['cgst'])) ? ($wholesale_data[0]['cgst']) : "";
$wholesale_id =((!empty($wholesale_data[0]['wholesale_id'])) && !empty($wholesale_data[0]['wholesale_id'])) ? ($wholesale_data[0]['wholesale_id']) : "0";
$rtgs_cash =((!empty($wholesale_data[0]['payment_type'])) && !empty($wholesale_data[0]['payment_type'])) ? ($wholesale_data[0]['payment_type']) : "2";
          ?>
          <div class="col-sm-12 pull-right">
        <a class="btn btn-primary" href="<?php echo base_url().ucfirst($module) ?>/wholesale_report"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;View Whole sale Report
        </a></div>
              <h4 align="center"><?php echo $module; ?>&nbsp;Whole sale Retail</h4>
<form class="form-horizontal" role="form" id="wholesale_form" action="<?php echo base_url() ?>Fertilizers/save_wholesale_data" method="POST">            
            <div class="panel panel-default">
                <div class="panel-body form-horizontal payment-form">
                <h4 align="center"><?php echo $this->session->userdata['trade_user_data']['trade_name']; ?></h4> 
                <div class="form-group">
                        <div class="alert alert-danger" style="display: none" id="error_div">
  <strong id="error_msg"></strong>
</div>
                    </div>                   
                    <div class="form-group">
                        <label for="gstin_number" class="col-sm-5 control-label">Gstin</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="gstin_number" name="gstin_number" value="<?php echo $gstin_number; ?>" readonly="readonly">
                        </div>
                        <div id="suggesstion-box"></div>
                    </div> 
                    <div class="form-group">
                        <label for="fl_no" class="col-sm-5 control-label">Fertilizers License</label>
                        <div class="col-sm-7">
                            <input type="fl_no" class="form-control" id="fl_no" name="fl_no" value="<?php echo $fl_no; ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bill_number" class="col-sm-5 control-label">Company Bill No.</label>
                        <div class="col-sm-7">
<div class="col-xs-3">
                            <input type="text" class="form-control" id="bill_number" name="bill_number" value="<?php echo $bill_number; ?>" readonly="readonly">
                            <input type="hidden" class="form-control" id="wholesale_id" name="wholesale_id" value="<?php echo $wholesale_id; ?>" >
                            </div>
                        <a href="javascript:void(0)" id="edit_saleretail_billnno">
                            <span style="cursor: pointer;" class="glyphicon glyphicon-pencil" ></span>
                            </a>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="rtgs_cash" class="col-sm-5 control-label">Cash/Credit</label>
                        <div class="col-sm-7">
                            <select name="rtgs_cash" id="rtgs_cash" class="form-control">
                                <option value="1" <?php echo ($rtgs_cash=="1") ? "selected" : ""; ?> >Credit</option>
                                <option value="2" <?php echo ($rtgs_cash=="2") ? "selected" : ""; ?>>Cash</option>
                            </select>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bill_date" class="col-sm-5 control-label">Date</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="bill_date" name="bill_date" value="<?php echo $bill_date; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-5 control-label">Cell </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $user_phone; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="party_name" class="col-sm-5 control-label">Party's Name </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="party_name" name="party_name" value="<?php echo $party_name; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="location" class="col-sm-5 control-label">Location </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="location" name="location" value="<?php echo $location; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="vehicle_no" class="col-sm-5 control-label">Vehicle No </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="vehicle_no" name="vehicle_no" value="<?php echo $vehicle_no; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="customer_gst_no" class="col-sm-5 control-label">GST </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="customer_gst_no" name="customer_gst_no" value="<?php echo $customer_gst_no; ?>">
                        </div>
                    </div>                                       

                    <div class="form-group">
                      <table width="95%" align="center" border="2px solid #ccc" style="border-collapse: collapse" class="wholesale_billing_items">
                        <thead>
                          <th style="width:5%;">S.No</th>
                          <th>Variety</th>
                          <th>Batch</th>
                          <th>Quantity<p class="help-block">50kgs Bag</p></th>
                          <th>Price</th>
                          <th>Amount</th>
                          <th>Action</th>
                        </thead>
                        <tbody>
                        <?php 
                        $wholesale_total =0;
                        if(isset($wholesale_data) && !empty($wholesale_data)){
                            foreach ($wholesale_data as $wholesalekey => $wholesale_value) {
                                $current_key = $wholesalekey+1;
                               echo "<tr>";
                            echo "<td><label class='sno_label'>".$current_key."</label><input class='form-control' type='hidden' name='s_no[]' value='".$current_key."' readonly='readonly'></td>";
                            echo "<td><input class='form-control kind_variety' type='text' name='variety[".$current_key."]' value='".$wholesale_value['variety']."' autocomplete='off'></td>";
                            echo "<td><input class='form-control' type='text' name='batch[".$current_key."]' value='".$wholesale_value['batch']."' autocomplete='off'></td>";
                            echo "<td><input class='form-control wholesale_item_qty' type='text' name='quantity[".$current_key."]' value='".$wholesale_value['quantity']."' autocomplete='off'></td>";
                            echo "<td><input class='form-control wholesale_item_price' type='text' name='rate[".$current_key."]' value='".$wholesale_value['price']."' autocomplete='off'></td>";
                            echo "<td><input class='form-control wholesale_item_price_total' type='text' name='amount[".$current_key."]' value='".$wholesale_value['amount']."' autocomplete='off'></td>";                            
                            echo "<td><span class='glyphicon glyphicon-plus add_wholesale_row'></span> &nbsp; <span class='glyphicon glyphicon-minus remove_current_wholesale_row'></span></td>";
                            echo "</tr>"; 
                            $wholesale_total = $wholesale_total+$wholesale_value['amount'];
                            }
                        }else{ ?>
                            <tr>
                            <td><label class='sno_label'>1</label><input class="form-control" type="hidden" name="s_no[]" value="1" readonly="readonly"></td>
                            <td><input class="form-control kind_variety" type="text" name="variety[1]" autocomplete="off"></td>
                            <td><input class="form-control" type="text" name="batch[1]" autocomplete="off"></td>
                            <td><input class="form-control wholesale_item_qty" type="text" name="quantity[1]" autocomplete="off"></td>
                            <td><input class="form-control wholesale_item_price" type="text" name="rate[1]" autocomplete="off"></td>
                            <td><input class="form-control wholesale_item_price_total" type="text" name="amount[1]" autocomplete="off"></td>                            
                            <td><span class="glyphicon glyphicon-plus add_wholesale_row"></span> &nbsp; <span class="glyphicon glyphicon-minus remove_current_wholesale_row"></span></td>
                          </tr>
                    <?php    }
                        ?>
                          
                        </tbody>
                      </table>
                    </div>
                    
                    <div class="form-group">
                        <label for="wholesale_sgst" class="col-sm-9 control-label">SGST </label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="wholesale_sgst" name="sgst" value="<?php echo $wholesale_sgst; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="wholesale_cgst" class="col-sm-9 control-label">CGST </label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="wholesale_cgst" name="cgst" value="<?php echo $wholesale_cgst; ?>">
                        </div>
                    </div> 
                     <div class="form-group">
                        <div class="col-sm-2 pull-right">
                        <?php 
                        $wholesale_total = $wholesale_total+$wholesale_cgst+$wholesale_sgst;
                        ?>
                        <strong>   Total : <span id="wholesale_total_billamount"><?php echo $wholesale_total; ?></span> </strong>
<span class="glyphicon glyphicon-refresh" onclick="calculate_total_wholesale_bill()"></span>
                        </div>
                    </div>
                    
                    <input type="hidden"  id="module_type" name="module" value= '<?php echo $module; ?>' />                       
                     <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <button type="button" class="btn btn-default btn-primary" id="save_wholesale">
                                 Save
                            </button>
                            <button type="button" class="btn btn-default btn-primary none" id="save_wholesale_print">
                                 Save & Print
                            </button>
                            <input type="hidden" name="print_page" id="print_page" value="0">                            
                                 <a href="<?php echo base_url(); ?>Fertilizers/stockreport" class="btn btn-default">Cancel</a>
                            
                        </div>
                    </div>
                </div>
            </div> 
            </form>
        <?php  
          } ?>      
        </div> <!-- / panel preview -->
         </div>
     </div>    
      </div>
</div>

<script src="<?php echo base_url('assets/js/jquery-ui-1.12.1.js'); ?>"></script>  
<script src="<?php echo base_url('assets/js/moment-with-locales.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap-datetimepicker.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){


var page_type = "<?php echo $selected_left_menu; ?>";
if(page_type =="payments"){
$('#payment_date').datetimepicker({
  format:'DD-MM-YYYY',
  pickTime: false
});
}else if(page_type == "sale_retail" || page_type == "purchase" || page_type == "whole_sale"){
$('#bill_date').datetimepicker({
  format:'DD-MM-YYYY',
  pickTime: false
});
}

        /* purchase form*/
        $("#save_purchase_print").click(function(){
            $("#print_page").val(1);
            $("#save_purchase").trigger('click');
        });
         $("#save_purchase").click(function(){
            alert($('#before_stock').prop('checked'));
            $(this).attr('disabled','disabled');
        var x =  $('#fertilizers_purchase_form').validate({ // initialize the plugin
        rules: {
            company_name: {
                required: true
            },
            invoice: {
                required: function(element) {
                  return $('#before_stock').is(':unchecked');
              }, 
            },
            bill_date: {
              required: function(element) {
                  return $('#before_stock').is(':unchecked');
              } 
            },
            material_type: {
                required: true 
            },
            quantity: {
                required: true,
                 number: true
            },
            purchase_cgst: {
              required: function(element) {
                  return $('#before_stock').is(':unchecked');
              },
                 number: true
            },
            purchase_sgst: {
              required: function(element) {
                  return $('#before_stock').is(':unchecked');
              },
                 number: true
            },
            value: {
              required: function(element) {
                  return $('#before_stock').is(':unchecked');
              },
                 number: true
            },
            lorry_frieght: {
              required: function(element) {
                  return $('#before_stock').is(':unchecked');
              },     
                 number: true
             },
            batch_no:{
              required: function(element) {
                var module = "<?php echo $module; ?>";
                if (module=="Seeds" ) {
                  return $('#before_stock').is(':unchecked');;
              }
             }                
            }
          }, submitHandler: function () {
        $('#save_purchase').attr('disabled','disabled');
        $('#save_purchase_print').attr('disabled','disabled');
        form.submit();
    }
    });
    if(x){
        //returns validations
        $(this).removeAttr('disabled');
    }
    console.log(x);

    });
        /* eof purchase form*/

/* purchase form*/
        $("#save_payment_print").click(function(){
            $("#print_page").val(1);
            $("#save_payment").trigger('click');
        });
         $("#save_payment").click(function(){
            $(this).attr('disabled','disabled');
        var x =  $('#fertilizers_payments_form').validate({ // initialize the plugin
        rules: {
            company_name: {
                required: true
            },
            rtgs_cash: {
                required: true 
            },
            rtgs_number: {
                required: function(element){
                    if ($("#rtgs_cash").val() == "rtgs") {
                          return true;
                    }else{
                        return false;
                    }
                } 
            },
            amount: {
                required: true,
                 number: true
            },
            payment_date: {
                required: true,
            },

          }, submitHandler: function () {
        $('#save_payment').attr('disabled','disabled');
        $('#save_payment_print').attr('disabled','disabled');
        form.submit();
    }

    });
      
     if(x){
        //returns validations
        $(this).removeAttr('disabled');
        }

    });
/* eof purchase form*/

/* sale retail form*/

$("#save_sale_retail_print").click(function(){
            $("#print_page").val(1);
            $("#save_sale_retail").trigger('click');
        });
$('#save_sale_retail').click(function(){
    $(this).attr('disabled','disabled');
            var errors_count =0;
    $('input').each(function() {
        if($(this).val() == "" || $(this).val().length ==0){
           errors_count++;
           $(this).prop('required','required');
           console.log(1);
        console.log($(this).attr('name'));
        }else{
            //$(this).removeClass('error');
        }
    });
    $('#error_div').hide();
    if(errors_count==0){    
        //submits form
        $('#error_div,#save_sale_retail').hide();
        $('#fertilizers_payments_form').submit();
    }else{

        $("#error_msg").html('Please fill all fields');
        $('#error_div').show();
        $(this).removeAttr('disabled');
    }
});

/*calculat price of sale retail*/
$(document).on('keyup',".sale_retail_qty", function() {
    var sale_retail_price = $(this).closest("tr").find(".sale_retail_price").val();
    var total_variety_price = parseInt($(this).val())*sale_retail_price;
   if($(this).closest("tr").find(".sale_retail_qty_totalprice").val(total_variety_price)){
       calculate_total_saleretail_bill();
   } 
    
});

$(document).on('keyup',".sale_retail_price", function() {
    var sale_retail_qty = $(this).closest("tr").find(".sale_retail_qty").val();
    var total_variety_price = parseInt($(this).val())*sale_retail_qty;
    if($(this).closest("tr").find(".sale_retail_qty_totalprice").val(total_variety_price)){
         calculate_total_saleretail_bill();   
    }
    
    
});

function calculate_total_saleretail_bill(){
  var total_saleretails_billamount =0;
    $('.sale_retail_qty_totalprice').each(function() {
        if($(this).val() != "" && typeof($(this).val()) != "undefined"){
           total_saleretails_billamount = total_saleretails_billamount+parseInt($(this).val());
        }
    });
    $("#saleretail_total_price").html(total_saleretails_billamount);  
}
/*eof calculate price of sale retial*/


/*calculate wholesale billing*/
$(document).on('keyup',".wholesale_item_qty", function() {
    var wholesale_item_price = $(this).closest("tr").find(".wholesale_item_price").val();
    var total_variety_price = parseInt($(this).val())*wholesale_item_price;
   if($(this).closest("tr").find(".wholesale_item_price_total").val(total_variety_price)){
        calculate_total_wholesale_bill();
   } 
    
});

$(document).on('keyup',".wholesale_item_price", function() {
    var wholesale_qty = $(this).closest("tr").find(".wholesale_item_qty").val();
    var total_variety_price = parseInt($(this).val())*wholesale_qty;
    if($(this).closest("tr").find(".wholesale_item_price_total").val(total_variety_price)){
        calculate_total_wholesale_bill();
    }
    
});



function calculate_total_wholesale_bill(){
  var total_saleretails_billamount =0;
    $('.wholesale_item_price_total').each(function() {
        if($(this).val() != "" && typeof($(this).val()) != "undefined"){
           total_saleretails_billamount = total_saleretails_billamount+parseInt($(this).val());
        }
    });


    var sgst_percentage = "<?php echo $sgst_percentage ?>";
    var cgst_percentage = "<?php echo $cgst_percentage ?>";
    var wholesale_cgst = (total_saleretails_billamount*cgst_percentage)/100;//parseInt();
    var wholesale_sgst = (total_saleretails_billamount*sgst_percentage)/100;//parseInt();

    $("#wholesale_cgst").val(wholesale_cgst);
    $("#wholesale_sgst").val(wholesale_sgst)

    var wholesale_tax_sum =  wholesale_cgst+wholesale_sgst;
    total_saleretails_billamount = total_saleretails_billamount+wholesale_tax_sum;
    total_saleretails_billamount = total_saleretails_billamount.toFixed(2);
    $("#wholesale_total_billamount").html(total_saleretails_billamount);  
}
/*eof calculate wholesale billing*/


//wholesale form
$("#save_wholesale_print").click(function(){
            $("#print_page").val(1);
            $("#save_wholesale").trigger('click');
        });
$('#save_wholesale').click(function(){
    $(this).attr('disabled','disabled');
            var errors_count =0;
    $('input').each(function() {
        
        if($(this).val() == "" || $(this).val().length ==0){
           errors_count++;
           $(this).prop('required','required');
        }else{
            //$(this).removeClass('error');
        }
    });
    $('#error_div').hide();
    if(errors_count==0){    
        //submits form
        $('#error_div').hide();
        $('#wholesale_form').submit();
    }else{
        $("#error_msg").html('Please fill all fields');
        $('#error_div').show();
        $(this).removeAttr('disabled');
    }
});


     /*    $("#save_sale_retail").click(function(){
        var x =  $('#fertilizers_payments_form').validate({ // initialize the plugin
        rules: {
            gstin_number: {
                required: true
            },
            fl_no: {
                required: true 
            },
            bill_number: {
                required: true 
            },
            bill_date: {
                required: true
            },
            phone: {
                required: true,
            },
            farmer_name: {
                required: true,
            },
            village_name: {
                required: true,
            }
          }
    });
    
    console.log(x);

    });*/
/* eof sale retail form*/
$('#edit_saleretail_billnno').click(function(){
    $("#bill_number").attr("readonly", false);
});
//add sale retails tr
$(document).on('click', '.add_sale_retail_row', function(){
  var current_tr_data = $(this).closest('tr').html();
 //var append_data = "<tr>"+current_tr_data+"</tr>";
  if(typeof($('.sale_retail_billing_items tr:last').find('input[name="s_no[]"]').val()) !='undefined'){

    var current_sno = $('.sale_retail_billing_items tr:last').find('input[name="s_no[]"]').val();
    var next_sno = parseInt(current_sno)+1;
    
 }
 var module = "<?php echo $module; ?>";
 if(module =="Seeds"){
    var add_batn_no = "<td><input class='form-control' type='text' name='batch_no["+next_sno+"]' autocomplete='off'></td>"
 }else{
    var add_batn_no = "";
 }
 var append_data = "<tr><td><label class='sno_label'>"+next_sno+"</label><input class='form-control' type='hidden' name='s_no[]' value='"+next_sno+"' readonly='readonly'></td><td><input class='form-control kind_variety' type='text' name='variety["+next_sno+"]' autocomplete='off'></td>"+add_batn_no+"<td><input class='form-control sale_retail_qty' type='text' name='bags_count["+next_sno+"]' autocomplete='off'></td><td><input class='form-control sale_retail_price' type='text' name='bag_price["+next_sno+"]' autocomplete='off'></td><td><input class='form-control sale_retail_qty_totalprice' type='text' name='total_variety_price["+next_sno+"]' autocomplete='off'></td><td><!-- <span class='glyphicon glyphicon-plus add_sale_retail_row'></span> &nbsp; --><span class='glyphicon glyphicon-minus remove_current_sale_retail_row'></span></td></tr>";

 $('.sale_retail_billing_items tr:last').after(append_data);
 //$('.sale_retail_billing_items tr:last').find('.add_sale_retail_row').remove();
 $('.sale_retail_billing_items tr:last').find('input[name="s_no[]"]').val(next_sno)
});
  
$(document).on('click', '.remove_current_sale_retail_row', function(){
  $(this).closest('tr').remove();   
  var i=1;
  $("input[name='s_no[]']").each(function(){
        $(this).closest('tr').find('.sno_label').html(i);
        i++;
    });
  calculate_total_saleretail_bill();
});  

//add whole sale tr
$(document).on('click', '.add_wholesale_row', function(){
  var current_tr_data = $(this).closest('tr').html();
  if(typeof($('.wholesale_billing_items tr:last').find('input[name="s_no[]"]').val()) !='undefined'){

    var current_sno = $('.wholesale_billing_items tr:last').find('input[name="s_no[]"]').val();
    var next_sno = parseInt(current_sno)+1;
    
 }
 
 var append_data = "<tr><td><label class='sno_label'>"+next_sno+"</label><input class='form-control' type='hidden' name='s_no[]' value='"+next_sno+"' readonly='readonly'></td><td><input class='form-control kind_variety' type='text' name='variety["+next_sno+"]' autocomplete='off'></td><td><input class='form-control' type='text' name='batch["+next_sno+"]' autocomplete='off'></td><td><input class='form-control wholesale_item_qty' type='text' name='quantity["+next_sno+"]' autocomplete='off'></td><td><input class='form-control wholesale_item_price' type='text' name='rate["+next_sno+"]' autocomplete='off'></td><td><input class='form-control wholesale_item_price_total' type='text' name='amount["+next_sno+"]' autocomplete='off'></td><td><!-- <span class='glyphicon glyphicon-plus add_wholesale_row'></span> &nbsp; --><span class='glyphicon glyphicon-minus remove_current_wholesale_row'></span></td></tr>";

 $('.wholesale_billing_items tr:last').after(append_data);
 $('.wholesale_billing_items tr:last').find('input[name="s_no[]"]').val(next_sno)
});
  
$(document).on('click', '.remove_current_wholesale_row', function(){
  $(this).closest('tr').remove();   
  var i=1;
  $("input[name='s_no[]']").each(function(){
        $(this).closest('tr').find('.sno_label').html(i);
        i++;
    });
  calculate_total_wholesale_bill();
});  
  



    });

    $(document).ready(function(){
         // AJAX call for autocomplete 
        $( "#material_type" ).autocomplete({
      source: function( request, response ) {
        $.ajax( {
          url: "<?php echo base_url() ?>Fertilizers/get_material_type",
          dataType: "json",
          data: {
            term:request.term,
            module : '<?php echo $module; ?>'
          },
          success: function( data ) {
            response( data );
          }
        } );
      },
      minLength:2,
      select: function( event, ui ) {
        //console.log( "Selected: " + ui.item.value + " aka " + ui.item.id );
      }
    });
});

    // AJAX call for autocomplete 
    var kind_variety_options = {
      source: function( request, response ) {
        
        $.ajax( {
          url: "<?php echo base_url() ?>Fertilizers/get_material_type",
          dataType: "json",
          data: {
            term: request.term,
             module : '<?php echo $module; ?>'
          },
          success: function( data ) {
            response( data );
          }
        } );
      },
      minLength:2,
      select: function( event, ui ) {
        //console.log( "Selected: " + ui.item.value + " aka " + ui.item.id );
      }
    };
    var selector =".kind_variety";
    $(document).on('keydown.autocomplete',selector, function() {
        $(this).autocomplete(kind_variety_options);
    });  


var print_page = "<?php echo $print_page; ?>";
if(print_page=="print"){
    window.print(); 
}
function print_page(){
   window.print(); 
}

</script>