
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
         
         <?php 
         if(isset($instock_report) && isset($saled_data) && isset($wholesale)){
     
            $view_report = "stock_report";
          ?>
<h4 align="center"><?php echo $module; ?>&nbsp;Stock Report</h4>
             <table id="instock_report" class="table table-striped table-bordered" width="100%" cellspacing="0">
         
        <thead>
            <tr>
                <th width="5%">S.no</th>
                <th>Variety</th>
                <th>stock</th>
                <th>Sold Stock</th>
                <th>Remaining Stock</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($instock_report)){
            //echo "<PRE>";print_r($instock_report);print_r($saled_data);print_r($wholesale);
            foreach ($instock_report as $key => $instock_values) {
                $sno = $key+1;
                $sold_stock=$saled_variety=$saled_wholesale =0;
                    echo "<tr>";
                    echo "<td>".$sno."</td>";
                    echo "<td>".$instock_values['material_type']."</td>";
                    echo "<td>".$instock_values['total_quantity']."</td>";
                    $total_quantity = $instock_values['total_quantity'];
                    $variety = $instock_values['material_type'];

if(array_search($variety, array_column($saled_data, 'variety')) >-1){
    $saled_total_key = array_search($variety, array_column($saled_data, 'variety'));
    $saled_variety =  $saled_data[$saled_total_key]['sold'];
}

if(array_search($variety, array_column($wholesale, 'variety'))>-1){
    $wholesale_total_key = array_search($variety, array_column($wholesale, 'variety'));
    $saled_wholesale =   $wholesale[$wholesale_total_key]['sold']; 
}
                      
                    
                    
                    
                    $remaining_quantity = $total_quantity - ($saled_variety+$saled_wholesale); 
                    $sold_stock = $saled_variety+$saled_wholesale;
                    echo "<td>".$sold_stock."</td>";
                    echo "<td>".$remaining_quantity."</td>";
                    echo "</tr>";
            }
        }

         ?>
        </tbody>
    </table>
        <?php }elseif(isset($stockreport)){
            $view_report = "purchase_report";
           ?>
           <div class="col-sm-12 pull-right">
        <a class="btn btn-primary" href="<?php echo base_url().ucfirst($module) ?>/purchase"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Purchase
        </a></div>
         <h4 align="center"><?php echo $module; ?>&nbsp;Purchase Report</h4>
             <table id="purchase_report" class="table table-striped table-bordered" width="100%" cellspacing="0">
         
        <thead>
            <tr>
                <th>S.no</th>
                <th>Invoice</th>
                <th>Company</th>
                <th>Kind & variety</th>
                <th>Quantity</th>
                <th>Value</th>
                <th>Lorry frieght</th>
                <th>Actions</th>
            </tr>
        </thead>
        <!-- <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot> -->
        <tbody>
        <?php
        if(!empty($stockreport)){
            foreach ($stockreport as $key => $stockvalue) {
                $sno = $key+1;
                    echo "<tr>";
                    echo "<td>".$sno."</td>";
                    echo "<td>".$stockvalue['invoice']."</td>";
                    echo "<td>".$stockvalue['company_name']."</td>";
                    echo "<td>".$stockvalue['material_type']."</td>";
                    echo "<td>".$stockvalue['quantity']."</td>";
                    echo "<td>".$stockvalue['value']."</td>";
                    echo "<td>".$stockvalue['lorry_frieght']."</td>";
                    echo "<td> <a href='".base_url().ucfirst($module)."/purchase/".md5($stockvalue['id'])."' ><span class='glyphicon glyphicon-pencil'></span></a></td>";
                    echo "</tr>";
            }
        }

         ?>
        </tbody>
    </table>
         <?php }else if(isset($payments_report)){ 
$view_report = "payments_report";
            ?>
            <div class="col-sm-12 pull-right">
        <a class="btn btn-primary" href="<?php echo base_url().ucfirst($module) ?>/payments"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Payment
        </a></div>
         <h4 align="center"><?php echo $module; ?>&nbsp;Payment Report</h4>
             <table id="payments_report" class="table table-striped table-bordered" width="100%" cellspacing="0">
         
         <thead>
            <tr>
                <th>S.no</th>
                <th>Company Name</th>
                <th>Transaction Mode</th>
                <th>Rtgs Number</th>
                <th>Amount</th>
                <th>Payment Date</th>
                <th>Created On</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($payments_report)){
            foreach ($payments_report as $key => $paymentvalue) {
                $sno = $key+1;
                    echo "<tr>";
                    echo "<td>".$sno."</td>";
                    echo "<td>".$paymentvalue['company_name']."</td>";
                    echo "<td>".ucfirst($paymentvalue['rtgs_cash'])."</td>";
                    echo "<td>".$paymentvalue['rtgs_number']."</td>";
                    echo "<td>".$paymentvalue['amount']."</td>";
                    echo "<td>".date("d-m-Y",strtotime($paymentvalue['payment_date']))."</td>";
                    echo "<td>".date("d-m-Y",strtotime($paymentvalue['created']))."</td>";
                    echo "<td><a href='".base_url().ucfirst($module)."/payments/".md5($paymentvalue['id'])."' ><span class='glyphicon glyphicon-pencil'></span></a></td>";
                    echo "</tr>";
            }
        }

         ?>
        </tbody>
    </table>
         <?php }else if(isset($saleretail_report)){ 
$view_report = "saleretail_report";
            ?>
         <div class="col-sm-12 pull-right">
        <a class="btn btn-primary" href="<?php echo base_url().ucfirst($module) ?>/sale_retail"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Sale retail
        </a></div>
                <h4 align="center" ><?php echo $module; ?>&nbsp;SaleRetail Report</h4>
             <table id="saleretail_report" class="table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>S.no</th>
                <th>Bill No</th>
                <th>Bill Date</th>
                <th>Phone</th>
                <th>Farmer Name</th>
                <th>Village</th>
                <th>Created On</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($saleretail_report)){
            foreach ($saleretail_report as $key => $saleretail_value) {
                $sno = $key+1;
                    echo "<tr>";
                    echo "<td>".$sno."</td>";
                    echo "<td>".$saleretail_value['bill_no']."</td>";
                    echo "<td>".date("d-m-Y",strtotime($saleretail_value['bill_date']))."</td>";
                    echo "<td>".$saleretail_value['phone']."</td>";
                    echo "<td>".$saleretail_value['farmer_name']."</td>";
                    echo "<td>".$saleretail_value['village']."</td>";
                    echo "<td>".date("d-m-Y",strtotime($saleretail_value['created']))."</td>";
                    echo "<td><a href='".base_url().ucfirst($module)."/view_bill/".md5($saleretail_value['id'])."'><span class='glyphicon glyphicon-eye-open'></span></a>&nbsp;<a href='".base_url().ucfirst($module)."/sale_retail/".md5($saleretail_value['id'])."'><span class='glyphicon glyphicon-pencil'></span></a></td>";
                    echo "</tr>";
            }
        }

         ?>
        </tbody>
    </table>
        <?php  }else if(isset($wholesale_report)){ 
$view_report = "wholesale_report";
            ?>
        <div class="col-sm-12 pull-right">
        <a class="btn btn-primary" href="<?php echo base_url().ucfirst($module) ?>/whole_sale"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Wholesale
        </a></div>
                <h4 align="center"><?php echo $module; ?>&nbsp;Whole Sale Report</h4>
             <table id="wholesale_report" class="table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>S.no</th>
                <th>Bill No</th>
                <th>Bill Date</th>
                <th>Party Name</th>
                <th>Location</th>
                <th>Vehicle No</th>
                <th>Gst</th>
                <th>Sgst</th>
                <th>Cgst</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($wholesale_report)){
            foreach ($wholesale_report as $key => $wholesale_value) {
                $sno = $key+1;
                    echo "<tr>";
                    echo "<td>".$sno."</td>";
                    echo "<td>".$wholesale_value['bill_no']."</td>";
                    echo "<td>".date("d-m-Y",strtotime($wholesale_value['bill_date']))."</td>";
                    echo "<td>".$wholesale_value['party_name']."</td>";
                    echo "<td>".$wholesale_value['location']."</td>";
                    echo "<td>".$wholesale_value['vehicle_no']."</td>";
                    echo "<td>".$wholesale_value['customer_gst_no']."</td>";
                    echo "<td>".$wholesale_value['cgst']."</td>";
                    echo "<td>".$wholesale_value['sgst']."</td>";
                    
                    echo "<td><a href='".base_url().ucfirst($module)."/view_whole_bill/".md5($wholesale_value['id'])."'><span class='glyphicon glyphicon-eye-open'></span></a>&nbsp;<a href='".base_url().ucfirst($module)."/whole_sale/".md5($wholesale_value['id'])."' ><span class='glyphicon glyphicon-pencil'></span></a></td>";
                    echo "</tr>";
            }
        }

         ?>
        </tbody>
    </table>
        <?php  } ?>
         </div>
     </div>    
      </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        var module_view = '<?php echo $view_report; ?>';
        if(module_view == "purchase_report"){
             $('#purchase_report').DataTable({  
                     "bFilter": true
             });
        }else if(module_view == "payments_report"){
            $('#payments_report').DataTable({  
                     "bFilter": true,
             });
        }else if(module_view == "stock_report"){
            $('#instock_report').DataTable({  
                     "bFilter": true
             });
        }else if(module_view == "saleretail_report"){
            $('#saleretail_report').DataTable({  
                     "bFilter": true
             });
        }else if(module_view == "wholesale_report"){
            $('#wholesale_report').DataTable({  
                     "bFilter": true
             });
        }
    });
</script>