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
          $company_name = (!empty($purchase_report['company_name'])) ? $purchase_report['company_name'] : "";
          $material_type = (!empty($purchase_report['material_type'])) ? $purchase_report['material_type'] : "";
          $quantity = (!empty($purchase_report['quantity'])) ? $purchase_report['quantity'] : "";
          $value = (!empty($purchase_report['value'])) ? $purchase_report['value'] : "";
          $value = (!empty($purchase_report['value'])) ? $purchase_report['value'] : "";
          $lorry_frieght = (!empty($purchase_report['lorry_frieght'])) ? $purchase_report['lorry_frieght'] : "";
          ?>
        <h4 align="center">Purchase</h4>
<form class="form-horizontal" role="form" id="fertilizers_purchase_form" action="<?php echo base_url() ?>Fertilizers/save_purchase" method="POST">            
            <div class="panel panel-default">
                <div class="panel-body form-horizontal payment-form">
                    <div class="form-group">
                        <label for="company_name" class="col-sm-3 control-label">Company Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo $company_name; ?>">
                            <input type="hidden" class="form-control" id="purchase_id" name="purchase_id" value="<?php echo $purchase_id; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="invoice" class="col-sm-3 control-label">Innvoice</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="invoice" name="invoice" value="<?php echo $invoice; ?>">
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label for="material_type" class="col-sm-3 control-label">Kind & Variety</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="material_type" name="material_type" value="<?php echo $material_type; ?>">
                        </div>
                        <div id="suggesstion-box"></div>
                    </div> 
                    <div class="form-group">
                        <label for="quantity" class="col-sm-3 control-label">Quantity</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $quantity; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="value" class="col-sm-3 control-label">Value</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="value" name="value" value="<?php echo $value; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lorry_frieght" class="col-sm-3 control-label">Lorry frieght</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="lorry_frieght" name="lorry_frieght" value="<?php echo $lorry_frieght; ?>">
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="date" class="col-sm-3 control-label">Date</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="date" name="date">
                        </div>
                    </div> -->   
                    <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-default btn-primary" id="save_purchase">
                                 Save
                            </button>
<a href="<?php echo base_url(); ?>Fertilizers/stockreport" class="btn btn-default">Cancel</a>                        </div>
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
          $payment_date = (!empty($payments_report['created'])) ? $payments_report['created'] : "";
          ?>
<h4 align="center">Payments</h4>
<form class="form-horizontal" role="form" id="fertilizers_payments_form" action="<?php echo base_url() ?>Fertilizers/save_payment" method="POST">            
            <div class="panel panel-default">
                <div class="panel-body form-horizontal payment-form">
                    <div class="form-group">
                        <label for="company_name" class="col-sm-3 control-label">Company Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo $company_name; ?>">
                            <input type="hidden" class="form-control" id="payment_id" name="payment_id" value="<?php echo $payment_id; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="rtgs_cash" class="col-sm-3 control-label">Rtgs/Cash</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="rtgs_cash" name="rtgs_cash" value="<?php echo $rtgs_cash; ?>">
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label for="rtgs_number" class="col-sm-3 control-label">Rtgs Number</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="rtgs_number" name="rtgs_number" value="<?php echo $rtgs_number; ?>">
                        </div>
                        <div id="suggesstion-box"></div>
                    </div> 
                    <div class="form-group">
                        <label for="amount" class="col-sm-3 control-label">Amount</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="amount" name="amount" value="<?php echo $amount; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="payment_date" class="col-sm-3 control-label">Date</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="payment_date" name="payment_date" value="<?php echo $payment_date; ?>">
                        </div>
                    </div>
                     <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-default btn-primary" id="save_payment">
                                 Save
                            </button>
                            
                                 <a href="<?php echo base_url(); ?>Fertilizers/stockreport" class="btn btn-default">Cancel</a>
                            
                        </div>
                    </div>
                </div>
            </div> 
            </form>
        <?php  }else if($selected_left_menu =="sale_retail"){ 
 $gstin_number = $gstin_data['gst_no'];
 $bill_number= "1";
 $fl_no = $gstin_data['fertilizer_license'];
          ?>
              <h4 align="center">Sale Retail</h4>
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
                        <label for="gstin_number" class="col-sm-3 control-label">Gstin</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="gstin_number" name="gstin_number" value="<?php echo $gstin_number; ?>" readonly="readonly">
                        </div>
                        <div id="suggesstion-box"></div>
                    </div> 
                    <div class="form-group">
                        <label for="fl_no" class="col-sm-3 control-label">Fertilizers License</label>
                        <div class="col-sm-9">
                            <input type="fl_no" class="form-control" id="fl_no" name="fl_no" value="<?php echo $fl_no; ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bill_number" class="col-sm-3 control-label">Company Bill No.</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="bill_number" name="bill_number" value="<?php echo $bill_number; ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bill_date" class="col-sm-3 control-label">Date</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="bill_date" name="bill_date" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-3 control-label">Cell </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="phone" name="phone" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="farmer_name" class="col-sm-3 control-label">Farmer Name </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="farmer_name" name="farmer_name" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="village_name" class="col-sm-3 control-label">Village Name </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="village_name" name="village_name" value="">
                        </div>
                    </div>

                    <div class="form-group">
                      <table width="80%" align="center" border="2px solid #ccc" style="border-collapse: collapse" class="sale_retail_billing_items">
                        <thead>
                          <th style="width:5%;">S.No</th>
                          <th>Variety</th>
                          <th>No.Bags</th>
                          <th>Price/1 Bag</th>
                          <th>Price</th>
                          <th>Action</th>
                        </thead>
                        <tbody>
                          <tr>
                            <td><label class='sno_label'>1</label><input class="form-control" type="hidden" name="s_no[]" value="1" readonly="readonly"></td>
                            <td><input class="form-control kind_variety" type="text" name="variety[1]"></td>
                            <td><input class="form-control" type="text" name="bags_count[1]"></td>
                            <td><input class="form-control" type="text" name="bag_price[1]"></td>
                            <td><input class="form-control" type="text" name="total_variety_price[1]"></td>
                            <td><span class="glyphicon glyphicon-plus add_sale_retail_row"></span> &nbsp; <span class="glyphicon glyphicon-minus remove_current_sale_retail_row"></span></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    
                     <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <button type="button" class="btn btn-default btn-primary" id="save_sale_retail">
                                 Save
                            </button>
                            
                                 <a href="<?php echo base_url(); ?>Fertilizers/stockreport" class="btn btn-default">Cancel</a>
                            
                        </div>
                    </div>
                </div>
            </div> 
            </form>
        <?php  }else if($selected_left_menu == "whole_sale"){
 
 $gstin_number = $gstin_data['gst_no'];
 $bill_number= "1";
 $fl_no = $gstin_data['fertilizer_license'];
          ?>
              <h4 align="center">Whole sale Retail</h4>
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
                        <label for="gstin_number" class="col-sm-3 control-label">Gstin</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="gstin_number" name="gstin_number" value="<?php echo $gstin_number; ?>" readonly="readonly">
                        </div>
                        <div id="suggesstion-box"></div>
                    </div> 
                    <div class="form-group">
                        <label for="fl_no" class="col-sm-3 control-label">Fertilizers License</label>
                        <div class="col-sm-9">
                            <input type="fl_no" class="form-control" id="fl_no" name="fl_no" value="<?php echo $fl_no; ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bill_number" class="col-sm-3 control-label">Company Bill No.</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="bill_number" name="bill_number" value="<?php echo $bill_number; ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bill_date" class="col-sm-3 control-label">Date</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="bill_date" name="bill_date" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-3 control-label">Cell </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="phone" name="phone" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="party_name" class="col-sm-3 control-label">Party's Name </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="party_name" name="party_name" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="location" class="col-sm-3 control-label">Location </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="location" name="location" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="vehicle_no" class="col-sm-3 control-label">Vehicle No </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="vehicle_no" name="vehicle_no" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sgst" class="col-sm-3 control-label">SGST </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="sgst" name="sgst" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cgst" class="col-sm-3 control-label">CGST </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="cgst" name="cgst" value="">
                        </div>
                    </div>                                        

                    <div class="form-group">
                      <table width="80%" align="center" border="2px solid #ccc" style="border-collapse: collapse" class="wholesale_billing_items">
                        <thead>
                          <th style="width:5%;">S.No</th>
                          <th>Variety</th>
                          <th>Batch</th>
                          <th>Quantity</th>
                          <th>Price</th>
                          <th>Amount</th>
                          <th>Action</th>
                        </thead>
                        <tbody>
                          <tr>
                            <td><label class='sno_label'>1</label><input class="form-control" type="hidden" name="s_no[]" value="1" readonly="readonly"></td>
                            <td><input class="form-control kind_variety" type="text" name="variety[1]"></td>
                            <td><input class="form-control" type="text" name="batch[1]"></td>
                            <td><input class="form-control" type="text" name="quantity[1]"></td>
                            <td><input class="form-control" type="text" name="rate[1]"></td>
                            <td><input class="form-control" type="text" name="amount[1]"></td>                            
                            <td><span class="glyphicon glyphicon-plus add_wholesale_row"></span> &nbsp; <span class="glyphicon glyphicon-minus remove_current_wholesale_row"></span></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    
                     <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <button type="button" class="btn btn-default btn-primary" id="save_wholesale">
                                 Save
                            </button>
                            
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
}else if(page_type == "sale_retail" || page_type == "whole_sale"){
$('#bill_date').datetimepicker({
  format:'DD-MM-YYYY',
  pickTime: false
});
}

        /* purchase form*/
         $("#save_purchase").click(function(){
        var x =  $('#fertilizers_purchase_form').validate({ // initialize the plugin
        rules: {
            company_name: {
                required: true
            },
            invoice: {
                required: true 
            },
            material_type: {
                required: true 
            },
            quantity: {
                required: true,
                 number: true
            },
            value: {
                required: true,
                 number: true
            },
            lorry_frieght: {
                required: true,
                 number: true
            }
          }
    });
    
    console.log(x);

    });
        /* eof purchase form*/

/* purchase form*/
         $("#save_payment").click(function(){
        var x =  $('#fertilizers_payments_form').validate({ // initialize the plugin
        rules: {
            company_name: {
                required: true
            },
            rtgs_cash: {
                required: true 
            },
            rtgs_number: {
                required: true 
            },
            amount: {
                required: true,
                 number: true
            },
            payment_date: {
                required: true,
            }
          }
    });
    
    console.log(x);

    });
/* eof purchase form*/

/* sale retail form*/


$('#save_sale_retail').click(function(){
            var errors_count =0;
    $('input').each(function() {
        if($(this).val() == ""){
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
        $('#fertilizers_payments_form').submit();
    }else{
        $("#error_msg").html('Please fill all fields');
        $('#error_div').show();
    }
});

//wholesale form
$('#save_wholesale').click(function(){
            var errors_count =0;
    $('input').each(function() {
        if($(this).val() == ""){
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
        $("#error_msg").html('Please fill all .fields');
        $('#error_div').show();
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

//add sale retails tr
$(document).on('click', '.add_sale_retail_row', function(){
  var current_tr_data = $(this).closest('tr').html();
 //var append_data = "<tr>"+current_tr_data+"</tr>";
  if(typeof($('.sale_retail_billing_items tr:last').find('input[name="s_no[]"]').val()) !='undefined'){

    var current_sno = $('.sale_retail_billing_items tr:last').find('input[name="s_no[]"]').val();
    var next_sno = parseInt(current_sno)+1;
    
 }
 
 var append_data = "<tr><td><label class='sno_label'>"+next_sno+"</label><input class='form-control' type='hidden' name='s_no[]' value='"+next_sno+"' readonly='readonly'></td><td><input class='form-control kind_variety' type='text' name='variety["+next_sno+"]''></td><td><input class='form-control' type='text' name='bags_count["+next_sno+"]''></td><td><input class='form-control' type='text' name='bag_price["+next_sno+"]''></td><td><input class='form-control' type='text' name='total_variety_price["+next_sno+"]'></td><td><!-- <span class='glyphicon glyphicon-plus add_sale_retail_row'></span> &nbsp; --><span class='glyphicon glyphicon-minus remove_current_sale_retail_row'></span></td></tr>";

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
});  

//add whole sale tr
$(document).on('click', '.add_wholesale_row', function(){
  var current_tr_data = $(this).closest('tr').html();
  if(typeof($('.wholesale_billing_items tr:last').find('input[name="s_no[]"]').val()) !='undefined'){

    var current_sno = $('.wholesale_billing_items tr:last').find('input[name="s_no[]"]').val();
    var next_sno = parseInt(current_sno)+1;
    
 }
 
 var append_data = "<tr><td><label class='sno_label'>"+next_sno+"</label><input class='form-control' type='hidden' name='s_no[]' value='"+next_sno+"' readonly='readonly'></td><td><input class='form-control kind_variety' type='text' name='variety["+next_sno+"]''></td><td><input class='form-control' type='text' name='batch["+next_sno+"]''></td><td><input class='form-control' type='text' name='quantity["+next_sno+"]''></td><td><input class='form-control' type='text' name='rate["+next_sno+"]'></td><td><input class='form-control' type='text' name='amount["+next_sno+"]'></td><td><!-- <span class='glyphicon glyphicon-plus add_wholesale_row'></span> &nbsp; --><span class='glyphicon glyphicon-minus remove_current_wholesale_row'></span></td></tr>";

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
});  
  



    });

    $(document).ready(function(){
         // AJAX call for autocomplete 
        $( "#material_type" ).autocomplete({
      source: function( request, response ) {
        $.ajax( {
          url: "get_material_type",
          dataType: "json",
          data: {
            term: request.value
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
          url: "get_material_type",
          dataType: "json",
          data: {
            term: request.value
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


</script>