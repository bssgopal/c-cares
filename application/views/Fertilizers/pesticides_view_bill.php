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
$including_gst_onprint = $sgst_percentage+$cgst_percentage;
?>
<div class="container">
    <div class="row">
       <div class="col-md-12">
           <div class="col-md-2">
               <?php $this->load->view($left_menu); ?>
           </div>
           <div class="col-md-10 left_container">

               <?php 
               if(isset($saleretail_bill_report)){
                $view_report = "saleretail_bill_report";
                ?>
                <h4 align="center"><?php echo $module; ?>&nbsp;sale retail bill</h4>
                <div class="col-xs-12 col-sm-12 col-md-12" id="profile_information">
                    <div class="well well-sm">
                        <div class="row">
                            <?php
                            if(!empty($gstin_data['gst_no'])){ ?>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="farmer_name" class="col-sm-5 control-label">Gstin No </label>
                                    <div class="col-sm-7">
                                     <?php echo $gstin_data['gst_no']; ?>
                                 </div>
                             </div>
                         </div>
                         <!-- show respective license fertilizer/seed/pesticide -->
                         <?php 
                         if($module == "Fertilizers"){
                            $license = (!empty($gstin_data['fertilizer_license'])) ? $gstin_data['fertilizer_license'] : "";
                        }else if($module == "Seeds"){
                            $license = (!empty($gstin_data['seed_license'])) ? $gstin_data['seed_license'] : "";
                        }else{
                            $license = (!empty($gstin_data['pesticide_license'])) ? $gstin_data['pesticide_license'] : "";
                        }
                        ?>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="farmer_name" class="col-sm-5 control-label"><?php echo $module; ?> license  </label>
                                <div class="col-sm-7">
                                 <?php echo $license; ?>
                             </div>
                         </div>
                     </div>
                     <?php }  

                     if(!empty($maintable_table_data)){
                        foreach ($maintable_table_data as $key => $maintable_table_value) { 
                            if($key!="id" && $key!="gstin_id" && $key != "farmer_aadhar_no"){
                                if($key == "bill_date" || $key=="created")
                                    $maintable_table_value = date("d-m-Y",strtotime($maintable_table_value));
                                if($key == "payment_type")
                                $maintable_table_value =  ($key==1) ? "Rtgs" : "Cash";
                                if($key == "module")
                                    $key = "Type";
                                else
                                    $key = ucfirst(str_replace("_"," ",$key));
                                ?>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="farmer_name" class="col-sm-5 control-label"><?php echo $key; ?> </label>
                                        <div class="col-sm-7">
                                            <?php echo $maintable_table_value; ?>
                                        </div>
                                    </div>
                                </div>   
                                <?php   } }
                            } ?>
                        </div>
                    </div>
                </div>
                <table id="pesticides_saleretail_bill_report" class="table table-striped table-bordered" width="100%" cellspacing="0">

                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Company</th>
                            <th>Variety</th>
                            <th>Packing</th>
                            <th>Batch No</th>
                            <th>Mfg Date</th>
                            <th>Exp Date</th>
                            <th>Units</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sum_total_price=0;
                        if(!empty($saleretail_bill_report)){
                            foreach ($saleretail_bill_report as $key => $saleretail_bill_value) {
                                $sno = $key+1;
                                echo "<tr>";
                                echo "<td>".$sno."</td>";
                                echo "<td>".$saleretail_bill_value['company_name']."</td>";
                                echo "<td>".$saleretail_bill_value['variety']."</td>";
                                echo "<td>".$saleretail_bill_value['packing']."</td>";
                                echo "<td>".$saleretail_bill_value['batch_no']."</td>";
                                $mfg = (!empty($saleretail_bill_value['mfg_date'])) ? date('d-m-Y',strtotime($saleretail_bill_value['mfg_date'])) : "";
                                echo "<td>".$mfg."</td>";
                                $exp = (!empty($saleretail_bill_value['exp_date'])) ? date('d-m-Y',strtotime($saleretail_bill_value['exp_date'])) : "";                    
                                echo "<td>".$exp."</td>";
                                echo "<td>".$saleretail_bill_value['quantity']."</td>";
                                $vol = (empty($saleretail_bill_value['unit_quantity']) || $saleretail_bill_value['unit_quantity'] ==0) ? "": $saleretail_bill_value['unit_quantity'];
                                $vol .= (empty($vol) || empty($saleretail_bill_value['liquid_qty']) || $saleretail_bill_value['liquid_qty'] =="none") ? "" : $saleretail_bill_value['liquid_qty'];
                                echo "<td>".$vol."</td>";
                                echo "<td>".$saleretail_bill_value['price']."</td>";
                                $sum_total_price = $sum_total_price+$saleretail_bill_value['total_price'];
                                echo "<td>".$saleretail_bill_value['total_price']."</td>";
                                echo "</tr>";
                            }
                        }

                        ?>
                    </tbody>
                </table>
                <div class="col-md-12"><span class="pull-right"><strong><br/>Total Bill Amount : <?php echo $sum_total_price; ?></span></strong></div>
                <div class="saleretail_container_cloned" style="display: none;">
                    <div class="col-md-12" style="bottom: 0px;">
                    <?php if($module =="Pesticides")
                            {    
                                 echo "Including ".$including_gst_onprint."% Gst<br/>";
                            } ?>
                            అరువూ బిల్లు తాలుకు సొమ్ము వారం  రోజులలో చెల్లించనియడల బిల్లు తేదీ నుండి నెల 1కి 100కి రూ 2 /- చొ న వడ్డీ తో ఇవ్వబడును 
                            <br/>  
                        ఒకసారి కొనుగోలు చేయబడిన సరుకు తిరిగి తీసుకోలేము . <br/>
                        ఫై బిల్లు ప్రకారం మీ వద్ద ఖరీదు చేసిన పురుగు మందులు వ్యవసాయమునకు మాత్రమే ఉపయోగించునని , దీని జాగ్రత్తలు ఉపయోగములు నాకు తెలియునని మిమ్ములను నమ్మించి సరుకు తూకం . పేళ్లు తయారు తేదీ సరిచూచుకుని మీ వద్ద ఖరీదు చేసినను   <br/> <?php echo $gstin_data['bank_details']; ?>  </div>
                        <div class="col-md-12 saleretail_container_cloned"><div class="col-md-6 pull-left" style="margin-bottom: 5px">Authorized signature</div><div class="col-md-6 pull-right" style="margin-bottom: 5px">Customer signature</div></div>
                    </div>
                    <?php }elseif(isset($wholesale_bill_report)){ ?>
                    <h4 align="center"><?php echo $module; ?>&nbsp;Wholesale bill</h4>
                    <div class="col-xs-12 col-sm-6 col-md-6" id="wholesale_profile_information">
                        <div class="well well-sm">
                            <div class="row">
                                <?php if(!empty($maintable_table_data)){
                                    foreach ($maintable_table_data as $key => $maintable_table_value) { 
                                        if($key!="id" && $key!="gstin_id" ){
                                            if($key == "bill_date" || $key=="created")
                                                $maintable_table_value = date("d-m-Y",strtotime($maintable_table_value));
                                            if($key == "module")
                                                $key = "Type";
                                            else
                                                $key = ucfirst(str_replace("_"," ",$key));
                                            ?>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="farmer_name" class="col-sm-5 control-label"><?php echo $key; ?> </label>
                                                    <div class="col-sm-7">
                                                        <?php echo $maintable_table_value; ?>
                                                    </div>
                                                </div>
                                            </div>   
                                            <?php   } }
                                        } ?>
                                    </div>
                                </div>
                            </div>
                            <table id="wholesale_report" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
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
                                            echo "<td>".date("d-m-Y",strtotime($wholesale_value['bill_date']))."</td>";
                                            echo "<td>".$wholesale_value['party_name']."</td>";
                                            echo "<td>".$wholesale_value['location']."</td>";
                                            echo "<td>".$wholesale_value['vehicle_no']."</td>";
                                            echo "<td>".$wholesale_value['customer_gst_no']."</td>";
                                            echo "<td>".$wholesale_value['cgst']."</td>";
                                            echo "<td>".$wholesale_value['sgst']."</td>";

                                            echo "<td><a href='".base_url().ucfirst($module)."/view_whole_bill/".md5($wholesale_value['id'])."'><span class='glyphicon glyphicon-eye-open'></span></a></td>";
                                            echo "</tr>";
                                        }
                                    }else{
                                        echo "<tr><td colspan='9' align='center'>No Records Found</td></tr>";
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
                    if(module_view == "saleretail_bill_report"){
                       $('#pesticides_saleretail_bill_report').DataTable({  
                           "bFilter": true
                       });
                       var saleretail_container_cloned = $(".left_container").html();
                       var header_html = $(".navbar-static-top").html();
                       header_html = "<div class='navbar-inverse'>"+header_html+"</div>";
                       saleretail_container_cloned = header_html+saleretail_container_cloned;
                       $(".saleretail_container_cloned").html(saleretail_container_cloned);             
                   }else if(module_view == "payments_report"){
                    $('#payments_report').DataTable({  
                       "bFilter": true
                   });
                }
            });

                var print_page = "<?php echo $print_page; ?>";
                if(print_page=="print"){
                    window.print(); 
                }
                function print_page(){
                 window.print(); 
             }
         </script>