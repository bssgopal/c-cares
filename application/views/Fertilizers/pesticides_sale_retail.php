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
        <?php if($selected_left_menu =="sale_retail"){ 
 $gstin_number = $gstin_data['gst_no'];
 $bill_number= (!empty($sale_retail_data[0]['bill_no'])) ? $sale_retail_data[0]['bill_no'] : $bill_no;
 $fl_no = $gstin_data['fertilizer_license'];
 $user_phone = (!empty($sale_retail_data[0]['phone'])) ? $user_data['phone'] : $user_data['phone'];
 $farmer_name = (!empty($sale_retail_data[0]['farmer_name']))  ? $sale_retail_data[0]['farmer_name'] : "";
 $farmer_aadhar_no = (!empty($sale_retail_data[0]['farmer_aadhar_no']))  ? $sale_retail_data[0]['farmer_aadhar_no'] : "";
 $village = (!empty($sale_retail_data[0]['village'])) ? $sale_retail_data[0]['village'] : "";
$bill_date = (!empty($sale_retail_data[0]['bill_date'])) ? date('d-m-Y',strtotime($sale_retail_data[0]['bill_date'])) : "";
$sale_retail_id = (!empty($sale_retail_data[0]['saleretail_id']))  ? $sale_retail_data[0]['saleretail_id'] :0;
$rtgs_cash = (!empty($sale_retail_data[0]['payment_type']))  ? $sale_retail_data[0]['payment_type'] :2;
          ?>
          <a class="btn btn-primary" href="<?php echo base_url().ucfirst($module) ?>/saleretails_report"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;View Sale retail report
        </a></div>
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
                            <input type="hidden" class="form-control" id="sale_retail_id" name="sale_retail_id" value="<?php echo $sale_retail_id; ?>" >
                            </div>
                            <a href="javascript:void(0)" id="edit_saleretail_billnno">
                            <span style="cursor: pointer;" class="glyphicon glyphicon-pencil" ></span></a>
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
                    
                    <!-- <div class="form-group">
                        <label for="farmer_aadhar_no" class="col-sm-3 control-label">Farmer Aadhar No </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="farmer_aadhar_no" name="farmer_aadhar_no" value="<?php //echo $farmer_name; ?>">
                        </div>
                    </div> -->
<div class="form-group">
                        <label for="farmer_name" class="col-sm-3 control-label">Farmer Name </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="farmer_name" name="farmer_name" value="<?php echo $farmer_name; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="village_name" class="col-sm-3 control-label">Village Name </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="village_name" name="village_name" value="<?php echo $village; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                      <table width="100%" align="center" border="2px solid #ccc" style="border-collapse: collapse;" class="sale_retail_billing_items">
                        <thead>
                          <th style="width:1%;">S.No</th>
                          <th>Company</th>
                          <th>Variety</th>
                          <th style="width:6%;">HSN Code</th>
                          <th style="width:6%;">Batch No</th>
                          <th>MFG Date</th>
                          <th>EXP Date</th>
                          <th style="width:6%;">Units</th>
                          <!-- <th style="width:9%;">Quantity</th> -->
                          <th style="width:6%;">Price/1 Qty</th>
                          <th style="width:8%;">Price</th>
                          <th>Action</th>
                        </thead>
                        <tbody>
                        <?php
                        $liquid_qty = "<select name='liquid_qty' style='float:right;width:41px;'><option value=''></option><option value='ml'>ml</option><option value='L'>L</option></select>"; 
                        $saleretail_total_price=0;
                        if(isset($sale_retail_data) && !empty($sale_retail_data)){
                          foreach ($sale_retail_data as $salekey => $sale_retail_data_value) {
                            $current_key = $salekey+1;
                            echo "<tr>";
                            echo "<td><label class='sno_label'>".$current_key."</label><input class='form-control' type='hidden' name='s_no[]' value='".$current_key."' readonly='readonly'></td>";
                            echo "<td><input class='form-control' type='text' name='company[".$current_key."]' value='".$sale_retail_data_value['company_name']."' autocomplete='off'></td>";                           
                            echo "<td><input class='form-control kind_variety' type='text' name='variety[".$current_key."]' value='".$sale_retail_data_value['variety']."' autocomplete='off'></td>";
                            echo "<td><input class='form-control' type='text' name='hsn_code[".$current_key."]' value='".$sale_retail_data_value['hsn_code']."' autocomplete='off'></td>";
                            echo "<td><input class='form-control' type='text' name='batch_no[".$current_key."]' value='".$sale_retail_data_value['batch_no']."' autocomplete='off'></td>";
                            $sale_retail_data_mfg_date = (!empty($sale_retail_data_value['mfg_date'])) ? date('d-m-Y',strtotime($sale_retail_data_value['mfg_date'])) : "";
                            $sale_retail_data_exp_date = (!empty($sale_retail_data_value['exp_date'])) ? date('d-m-Y',strtotime($sale_retail_data_value['exp_date'])) : "";
                            echo "<td><input class='form-control cls_date' type='text' name='mfg_date[".$current_key."]' value='".$sale_retail_data_mfg_date."' autocomplete='off'></td>";
                            echo "<td><input class='form-control cls_date' type='text' name='exp_date[".$current_key."]' value='".$sale_retail_data_exp_date."' autocomplete='off'></td>";
                            echo "<td><input class='form-control pesticides_quantity' type='text' name='quantity[".$current_key."]' value='".$sale_retail_data_value['quantity']."' autocomplete='off'></td>";
                            /*$liquid_qty_none= $liquid_qty_ml =$liquid_qty_l =$liquid_qty_g = $liquid_qty_kg =$liquid_qty_tn = "";

                            if($sale_retail_data_value['liquid_qty']=='none'){
                              $liquid_qty_none = "selected='selected'";
                            }elseif ($sale_retail_data_value['liquid_qty']=='ml') {
                              $liquid_qty_ml = "selected='selected'";
                            }elseif ($sale_retail_data_value['liquid_qty']=='L') {
                              $liquid_qty_kg = "selected='selected'";
                            }elseif ($sale_retail_data_value['liquid_qty']=='g') {
                              $liquid_qty_g = "selected='selected'";
                            }elseif ($sale_retail_data_value['liquid_qty']=='kg') {
                              $liquid_qty_kg = "selected='selected'";
                            }elseif ($sale_retail_data_value['liquid_qty']=='tn') {
                              $liquid_qty_tn = "selected='selected'";
                            }
                            echo "<td><input class='unit_quantity' type='text' name='unit_quantity[".$current_key."]' value='".$sale_retail_data_value['unit_quantity']."' autocomplete='off' style='width:38px;float:left' />
<span style='float:left'><select name='liquid_qty[".$current_key."]' class='liquid_qty' style='float:right;width:41px;'><option value='none' ".$liquid_qty_none."></option><option value='ml' ".$liquid_qty_ml.">ml</option><option value='L' ".$liquid_qty_l.">L</option><option value='g' ".$liquid_qty_g.">Gr</option><option value='kg' ".$liquid_qty_kg.">kg</option><option value='tn' ".$liquid_qty_tn.">tn</option></select></span></td>";*/
                            echo "<td><input class='form-control pesticides_bag_price' type='text' name='bag_price[".$current_key."]' value='".$sale_retail_data_value['price']."' autocomplete='off'></td>";
                            echo "<td><input class='form-control totalpesticides_price_byvariety' type='text' name='total_variety_price[".$current_key."]' value='".$sale_retail_data_value['total_price']."' autocomplete='off'></td>";
                            $saleretail_total_price = $saleretail_total_price+$sale_retail_data_value['total_price'];
                            echo "<td><span class='glyphicon glyphicon-plus add_sale_retail_row'></span> &nbsp; <span class='glyphicon glyphicon-minus remove_current_sale_retail_row'></span></td>";
                        echo  "</tr>" ;
                              }
                        }else{ ?>
                        
                          <tr>
                            <td><label class='sno_label'>1</label><input class="form-control" type="hidden" name="s_no[]" value="1" readonly="readonly" ></td>
                            <td><input class="form-control" type="text" name="company[1]"></td>                            
                            <td><input class="form-control kind_variety" type="text" name="variety[1]" autocomplete="off"></td>
                            <td><input class="form-control" type="text" name="hsn_code[1]" autocomplete="off"></td>
                            <td><input class="form-control" type="text" name="batch_no[1]" autocomplete="off"></td>
                            <td><input class="form-control cls_date" type="text" name="mfg_date[1]" autocomplete="off"></td>
                            <td><input class="form-control cls_date" type="text" name="exp_date[1]" autocomplete="off"></td>
                            <td style="width:6%;"><input class="form-control pesticides_quantity" type="text" name="quantity[1]" autocomplete="off"></td>
                            
<!-- <td ><input class="unit_quantity" type="text" name="unit_quantity[1]" autocomplete="off"   style="width:38px;float:left" />
<span style="float:left"><select name="liquid_qty[1]" class="liquid_qty" style="float:right;width:41px;"><option value="none"></option><option value="ml">ml</option><option value="L">L</option><option value='g'>Gr</option><option value='kg'>kg</option><option value='tn'>tn</option></select></span>
</td> -->
                            

                            <td><input class="form-control pesticides_bag_price" type="text" name="bag_price[1]" autocomplete="off"></td>
                            <td><input class="form-control totalpesticides_price_byvariety" type="text" name="total_variety_price[1]" autocomplete="off"></td>
                            <td><span class="glyphicon glyphicon-plus add_sale_retail_row"></span> &nbsp; <span class="glyphicon glyphicon-minus remove_current_sale_retail_row"></span></td>
                          </tr>
                          <?php }
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
                            <button type="button" class="btn btn-default btn-primary" id="save_sale_retail">
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
        <?php  } ?>      
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

/* sale retail form*/
  
$(document).on('click',".cls_date", function() {
console.log(".");
  $(this).datetimepicker({
  format:'DD-MM-YYYY',
  pickTime: false
});

});

$("#save_sale_retail_print").click(function(){
            $("#print_page").val(1);
            $("#save_sale_retail").trigger('click');
        });
$('#save_sale_retail').click(function(){
            var errors_count =0;
    $('input').each(function() {
      var input_class = $(this).attr('class');
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



//add sale retails tr
$(document).on('click', '.add_sale_retail_row', function(){
  var current_tr_data = $(this).closest('tr').html();
 //var append_data = "<tr>"+current_tr_data+"</tr>";
  if(typeof($('.sale_retail_billing_items tr:last').find('input[name="s_no[]"]').val()) !='undefined'){

    var current_sno = $('.sale_retail_billing_items tr:last').find('input[name="s_no[]"]').val();
    var next_sno = parseInt(current_sno)+1;
    
 }
 
 var append_data = "<tr><td><label class='sno_label'>"+next_sno+"</label><input class='form-control' type='hidden' name='s_no[]' value='"+next_sno+"' readonly='readonly'></td><td><input class='form-control' name='company["+next_sno+"]' type='text' autocomplete='off'></td><td><input class='form-control kind_variety' name='variety["+next_sno+"]' type='text' autocomplete='off'></td><td><input class='form-control' name='hsn_code["+next_sno+"]' type='text' autocomplete='off'></td><td><input class='form-control' name='batch_no["+next_sno+"]' type='text' autocomplete='off'></td><td><input class='form-control cls_date' name='mfg_date["+next_sno+"]' type='text' autocomplete='off'></td><td><input class='form-control cls_date' name='exp_date["+next_sno+"]' type='text' autocomplete='off'></td><td><input class='form-control pesticides_quantity' name='quantity["+next_sno+"]' type='text' autocomplete='off' /></td><td><input class='form-control pesticides_bag_price' name='bag_price["+next_sno+"]' type='text' autocomplete='off'></td><td><input class='form-control totalpesticides_price_byvariety' name='total_variety_price["+next_sno+"]' type='text' autocomplete='off'></td><td><span class='glyphicon glyphicon-plus add_sale_retail_row'></span> &nbsp; <span class='glyphicon glyphicon-minus remove_current_sale_retail_row'></span></td></tr>";
 /*<td ><input  type='text' class='unit_quantity' name='unit_quantity["+next_sno+"]' autocomplete='off'   style='width:38px;float:left' /><span style='float:left'><select name='liquid_qty["+next_sno+"]' class='liquid_qty' style='float:right;width:41px;'><option value='none'></option><option value='ml'>ml</option><option value='L'>L</option><option value='g'>Gr</option><option value='kg'>kg</option><option value='tn'>tn</option></select></span></td>*/

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
  

/*calculat price of pesticides sale retail*/
$(document).on('keyup',".pesticides_quantity", function() {
    var pesticides_bag_price = $(this).closest("tr").find(".pesticides_bag_price").val();
    var totalpesticides_price_byvariety = parseInt($(this).val())*pesticides_bag_price;
   if($(this).closest("tr").find(".totalpesticides_price_byvariety").val(totalpesticides_price_byvariety)){
       calculate_total_saleretail_bill();
   } 
    
});

$(document).on('keyup',".pesticides_bag_price", function() {
    var pesticides_quantity = $(this).closest("tr").find(".pesticides_quantity").val();
    var totalpesticides_price_byvariety = parseInt($(this).val())*pesticides_quantity;
   if($(this).closest("tr").find(".totalpesticides_price_byvariety").val(totalpesticides_price_byvariety)){
       calculate_total_saleretail_bill();
   } 
    
});


//eof document ready
    });

function calculate_total_saleretail_bill(){
  var total_saleretails_billamount =0;
    $('.totalpesticides_price_byvariety').each(function() {
        if($(this).val() != "" && typeof($(this).val()) != "undefined"){
           total_saleretails_billamount = total_saleretails_billamount+parseInt($(this).val());
        }
    });
    $("#saleretail_total_price").html(total_saleretails_billamount);  
}

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