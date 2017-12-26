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
        <?php 
        if($selected_left_menu == "whole_sale"){
            $gstin_number = $gstin_data['gst_no'];
            $bill_number= $bill_no;
            $fl_no = $gstin_data['fertilizer_license'];
$user_phone = (!empty($sale_retail_data[0]['phone'])) ? $sale_retail_data[0]['phone'] : $user_data['phone'];
$party_name = ((!empty($wholesale_data[0]['party_name'])) && !empty($wholesale_data[0]['party_name'])) ? $wholesale_data[0]['party_name'] : "";
 $location = ((!empty($wholesale_data[0]['location'])) && !empty($wholesale_data[0]['location'])) ? $wholesale_data[0]['location'] : "";
 $vehicle_no = ((!empty($wholesale_data[0]['vehicle_no'])) && !empty($wholesale_data[0]['vehicle_no'])) ? $wholesale_data[0]['vehicle_no'] : "";
$bill_date = ((!empty($wholesale_data[0]['bill_date'])) && !empty($wholesale_data[0]['bill_date'])) ? date('d-m-Y',strtotime($wholesale_data[0]['bill_date'])) : "";            
$customer_gst_no = ((!empty($wholesale_data[0]['customer_gst_no'])) && !empty($wholesale_data[0]['customer_gst_no'])) ? $wholesale_data[0]['customer_gst_no'] : "";
$wholesale_sgst = ((!empty($wholesale_data[0]['sgst'])) && !empty($wholesale_data[0]['sgst'])) ? $wholesale_data[0]['sgst'] : "";
$wholesale_cgst = ((!empty($wholesale_data[0]['cgst'])) && !empty($wholesale_data[0]['cgst'])) ? $wholesale_data[0]['cgst'] : "";            
$wholesale_id =((!empty($wholesale_data[0]['wholesale_id'])) && !empty($wholesale_data[0]['wholesale_id'])) ? ($wholesale_data[0]['wholesale_id']) : 0;
$rtgs_cash =((!empty($wholesale_data[0]['payment_type'])) && !empty($wholesale_data[0]['payment_type'])) ? ($wholesale_data[0]['payment_type']) : 2;
          ?>
          <a class="btn btn-primary" href="<?php echo base_url().ucfirst($module) ?>/wholesale_report"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;View Wholesale bill</a></div>
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
                         <div class="col-xs-3">
                            <input type="text" class="form-control" id="bill_number" name="bill_number" value="<?php echo $bill_number; ?>" readonly="readonly">
                            <input type="hidden" class="form-control" id="wholesale_id" name="wholesale_id" value="<?php echo $wholesale_id; ?>" >
                            </div>
                            <a href="javascript:void(0)" id="edit_saleretail_billnno">
                            <span style="cursor: pointer;" class="glyphicon glyphicon-pencil" ></span>
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                    <label for="bill_date" class="col-sm-3 control-label">Cash/Credit</label>
                      <div class="col-sm-9">
                        <select name="rtgs_cash" id="rtgs_cash" class="form-control">
                          <option value="1" <?php echo ($rtgs_cash=="1") ? "selected" : ""; ?> >Credit</option>
                          <option value="2" <?php echo ($rtgs_cash=="2") ? "selected" : ""; ?>>Cash</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="bill_date" class="col-sm-3 control-label">Date</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="bill_date" name="bill_date" value="<?php echo $bill_date; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-3 control-label">Cell </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $user_phone; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="party_name" class="col-sm-3 control-label">Party's Name </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="party_name" name="party_name" value="<?php echo $party_name; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="location" class="col-sm-3 control-label">Location </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="location" name="location" value="<?php echo $location; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="vehicle_no" class="col-sm-3 control-label">Vehicle No </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="vehicle_no" name="vehicle_no" value="<?php echo $vehicle_no; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="customer_gst_no" class="col-sm-3 control-label">GST </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="customer_gst_no" name="customer_gst_no" value="<?php echo $customer_gst_no; ?>">
                        </div>
                    </div>                                       

                    <div class="form-group">
                      <table width="100%" align="center" border="2px solid #ccc" style="border-collapse: collapse" class="wholesale_billing_items">
                        <thead>
                          <th style="width:1%;">S.No</th>
                          <th>Company Name</th>
                          <th>Variety</th>
                          <th style="width:6%;">HSN code</th>
                          <th style="width:6%;">Batch</th>
                          <th>Mfg Date</th>
                          <th>Exp Date</th>
                          <th style="width:6%;">Units<p class="help-block">50kgs Bag</p></th>
                          <!-- <th style="width:9%;">Quantity</th> -->
                          <th style="width:6%;">Price</th>
                          <th style="width:8%;">Amount</th>
                          <th>Action</th>
                        </thead>
                        <tbody>
                        <?php 
                        $wholesale_total_price= 0;
                        if(isset($wholesale_data) && !empty($wholesale_data)){
                          foreach ($wholesale_data as $wholesalekey => $wholesale_data_value) {
                            $current_key = $wholesalekey+1;
                           echo   "<tr>";
                           echo  "<td><label class='sno_label'>".$current_key."</label><input class='form-control' type='hidden' name='s_no[]' value='".$current_key."' readonly='readonly'></td>";
                            echo "<td><input class='form-control' type='text' name='company_name[".$current_key."]' value='".$wholesale_data_value['company_name']."' autocomplete='off'></td>";
                            echo "<td><input class='form-control kind_variety' type='text' name='variety[".$current_key."]' value='".$wholesale_data_value['variety']."' autocomplete='off'></td>";
                            echo "<td><input class='form-control' type='text' name='hsn_code[".$current_key."]' value='".$wholesale_data_value['hsn_code']."' autocomplete='off'></td>";
                            echo "<td><input class='form-control' type='text' name='batch[".$current_key."]' value='".$wholesale_data_value['batch']."' autocomplete='off'></td>";
                            $mfg_date = (!empty($wholesale_data_value['mfg_date'])) ? date('d-m-Y',strtotime($wholesale_data_value['mfg_date'])) :"";
                            $exp_date = (!empty($wholesale_data_value['exp_date'])) ? date('d-m-Y',strtotime($wholesale_data_value['exp_date'])) : "";                            
                            echo "<td><input class='form-control cls_date' type='text' name='mfg_date[".$current_key."]' value='".$mfg_date."' autocomplete='off'></td>";
                            echo "<td><input class='form-control cls_date' type='text' name='exp_date[".$current_key."]' value='".$exp_date."' autocomplete='off'></td>";
                            echo "<td><input class='form-control wholesale_item_qty' type='text' name='quantity[".$current_key."]' value='".$wholesale_data_value['quantity']."' autocomplete='off'></td>";

 /*$liquid_qty_none= $liquid_qty_ml =$liquid_qty_l =$liquid_qty_g = $liquid_qty_kg =$liquid_qty_tn = "";

                            if($wholesale_data_value['liquid_qty']=='none'){
                              $liquid_qty_none = "selected='selected'";
                            }elseif ($wholesale_data_value['liquid_qty']=='ml') {
                              $liquid_qty_ml = "selected='selected'";
                            }elseif ($wholesale_data_value['liquid_qty']=='L') {
                              $liquid_qty_kg = "selected='selected'";
                            }elseif ($wholesale_data_value['liquid_qty']=='g') {
                              $liquid_qty_g = "selected='selected'";
                            }elseif ($wholesale_data_value['liquid_qty']=='kg') {
                              $liquid_qty_kg = "selected='selected'";
                            }elseif ($wholesale_data_value['liquid_qty']=='tn') {
                              $liquid_qty_tn = "selected='selected'";
                            }
                            echo "<td><input class='unit_quantity' type='text' name='unit_quantity[".$current_key."]' value='".$wholesale_data_value['unit_quantity']."' autocomplete='off' style='width:38px;float:left' />
<span style='float:left'><select name='liquid_qty[".$current_key."]' class='liquid_qty' style='float:right;width:41px;'><option value='none' ".$liquid_qty_none."></option><option value='ml' ".$liquid_qty_ml.">ml</option><option value='L' ".$liquid_qty_l.">L</option><option value='g' ".$liquid_qty_g.">Gr</option><option value='kg' ".$liquid_qty_kg.">kg</option><option value='tn' ".$liquid_qty_tn.">tn</option></select></span></td>";*/

                            echo "<td><input class='form-control wholesale_item_price' type='text' name='rate[".$current_key."]' value='".$wholesale_data_value['price']."' autocomplete='off'></td>";
                            echo "<td><input class='form-control wholesale_item_price_total' type='text' name='amount[".$current_key."]' value='".$wholesale_data_value['amount']."' autocomplete='off'></td>";                            
                            echo "<td><span class='glyphicon glyphicon-plus add_wholesale_row'></span> &nbsp; <span class='glyphicon glyphicon-minus remove_current_wholesale_row'></span></td>";
                          echo "</tr>";
                          $wholesale_total_price = $wholesale_total_price+$wholesale_data_value['amount']; 
                          }
                        }else{ ?>
                          <tr>
                            <td><label class='sno_label'>1</label><input class="form-control" type="hidden" name="s_no[]" value="1" readonly="readonly"></td>
                            <td><input class="form-control" type="text" name="company_name[1]" autocomplete="off"></td>
                            <td><input class="form-control kind_variety" type="text" name="variety[1]" autocomplete="off"></td>
                            <td><input class="form-control" type="text" name="hsn_code[1]" autocomplete="off"></td>
                            <td><input class="form-control" type="text" name="batch[1]" autocomplete="off"></td>
                            <td><input class="form-control cls_date" type="text" name="mfg_date[1]" autocomplete="off"></td>
                            <td><input class="form-control cls_date" type="text" name="exp_date[1]" autocomplete="off"></td>
                            <td><input class="form-control wholesale_item_qty" type="text" name="quantity[1]" autocomplete="off"></td>
                            <!-- <td ><input class="unit_quantity" type="text" name="unit_quantity[1]" autocomplete="off"   style="width:38px;float:left" />
<span style="float:left"><select name="liquid_qty[1]" class="liquid_qty" style="float:right;width:41px;"><option value="none"></option><option value="ml">ml</option><option value="L">L</option><option value='g'>Gr</option><option value='kg'>kg</option><option value='tn'>tn</option></select></span>
</td> -->
                            <td><input class="form-control wholesale_item_price" type="text" name="rate[1]" autocomplete="off"></td>
                            <td><input class="form-control wholesale_item_price_total" type="text" name="amount[1]" autocomplete="off"></td>                            
                            <td><span class="glyphicon glyphicon-plus add_wholesale_row"></span> &nbsp; <span class="glyphicon glyphicon-minus remove_current_wholesale_row"></span></td>
                          </tr>
                      <?php  }
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
                        $wholesale_total_price = $wholesale_total_price+$wholesale_cgst+$wholesale_sgst; 
                        ?>
                        <strong>   Total : <span id="wholesale_total_billamount"><?php echo $wholesale_total_price; ?></span> </strong>
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
            <?php } ?>      
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
$('#edit_saleretail_billnno').click(function(){
    $("#bill_number").attr("readonly", false);
});

var page_type = "<?php echo $selected_left_menu; ?>";
if(page_type == "whole_sale"){
$('#bill_date').datetimepicker({
  format:'DD-MM-YYYY',
  pickTime: false
});
}

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
        $("#error_msg").html('Please fill all fields');
        $('#error_div').show();
    }
});


//add whole sale tr
$(document).on('click', '.add_wholesale_row', function(){
  var current_tr_data = $(this).closest('tr').html();
  if(typeof($('.wholesale_billing_items tr:last').find('input[name="s_no[]"]').val()) !='undefined'){

    var current_sno = $('.wholesale_billing_items tr:last').find('input[name="s_no[]"]').val();
    var next_sno = parseInt(current_sno)+1;
    
 }
 
 var append_data = "<tr><td><label class='sno_label'>"+next_sno+"</label><input class='form-control' type='hidden' name='s_no[]' value='"+next_sno+"' readonly='readonly'></td><td><input class='form-control' type='text' name='company_name["+next_sno+"]' autocomplete='off'></td><td><input class='form-control kind_variety' type='text' name='variety["+next_sno+"]' autocomplete='off'></td><td><input class='form-control' type='text' name='hsn_code["+next_sno+"]' autocomplete='off'></td><td><input class='form-control' type='text' name='batch["+next_sno+"]' autocomplete='off'></td><td><input class='form-control cls_date' type='text' name='mfg_date["+next_sno+"]' autocomplete='off'></td><td><input class='form-control cls_date' type='text' name='exp_date["+next_sno+"]' autocomplete='off'></td><td><input class='form-control wholesale_item_qty' type='text' name='quantity["+next_sno+"]' autocomplete='off' /></td><td><input class='form-control wholesale_item_price' type='text' name='rate["+next_sno+"]' autocomplete='off'></td><td><input class='form-control wholesale_item_price_total' type='text' name='amount["+next_sno+"]' autocomplete='off'></td><td><!-- <span class='glyphicon glyphicon-plus add_wholesale_row'></span> &nbsp; --><span class='glyphicon glyphicon-minus remove_current_wholesale_row'></span></td></tr>";

 /*<td ><input class='unit_quantity' type='text' name='unit_quantity["+next_sno+"]' autocomplete='off'   style='width:38px;float:left' /><span style='float:left'><select name='liquid_qty["+next_sno+"]' class='liquid_qty' style='float:right;width:41px;'><option value='none'></option><option value='ml'>ml</option><option value='L'>L</option><option value='g'>Gr</option><option value='kg'>kg</option><option value='tn'>tn</option></select></span></td>*/

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


$(document).on('click',".cls_date", function() {
console.log(".");
  $(this).datetimepicker({
  format:'DD-MM-YYYY',
  pickTime: false
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


</script>