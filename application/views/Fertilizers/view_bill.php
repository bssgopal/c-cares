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
        
       <div class="col-md-2">
           <?php $this->load->view($left_menu); ?>
       </div>
       <div class="col-md-10 left_container">
           
           <?php 
           if(isset($saleretail_bill_report) && !empty($saleretail_bill_report)){
            $view_report = "saleretail_bill_report";
            ?>
            <a class="btn btn-primary none" href="<?php echo base_url().ucfirst($module) ?>/saleretails_report"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;View sale retail bill</a>
            <h4 align="center" class="report_title"><?php echo $module; ?>&nbsp;sale retail bill</h4>
            <div class="row">
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
                    $execute = true;   
                    if($module !="Fertilizers" && $key =="farmer_aadhar_no"){   
                        $execute = false;
                    }
                     
                        if($key!="id" && $key!="gstin_id" && $execute){
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
                                    <label for="<?php echo $key ?>" class="col-sm-5 control-label"><?php echo $key; ?> </label>
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
        </div> 
        <table id="saleretail_bill_report" class="table table-striped table-bordered" width="100%" cellspacing="0">
           
            <thead>
                <tr>
                    <th>S.no</th>
                    <th>Variety</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(!empty($saleretail_bill_report)){
                    $sum_total_price =0;
                    foreach ($saleretail_bill_report as $key => $saleretail_bill_value) {
                        $sno = $key+1;
                        echo "<tr>";
                        echo "<td>".$sno."</td>";
                        echo "<td>".$saleretail_bill_value['variety']."</td>";
                        echo "<td>".$saleretail_bill_value['quantity']."</td>";
                        echo "<td>".$saleretail_bill_value['price']."</td>";
                        echo "<td>".$saleretail_bill_value['total_price']."</td>";
                        $sum_total_price = $sum_total_price+$saleretail_bill_value['total_price'];
                        echo "</tr>";
                    }
                }

                ?>
            </tbody>
        </table>
        <div class="col-md-12"><span class="pull-right"><strong><br/>Total Bill Amount : <?php echo $sum_total_price; ?></span></strong></div>
        <div class="saleretail_container_cloned" style="display: none;">
            <div class="col-md-12" style="bottom: 0px;">
                <?php 
                if($module =="Fertilizers")
                { 
                    echo "Including ".$including_gst_onprint."% Gst<br/>";
                
                ?>
                ఒకసారి కొనుగోలు చేయబడిన సరుకు తిరిగి తీసుకోలేము . <br/>
                షర : ఈ తేదీ లాగయిత్తు నెల 1కి 100కి రూ 2-00 చొ||న వడ్డీ నిర్ణయం  <br/>
<?php }else if($module =="Seeds"){ ?>
ఈ బిల్లు దాఖలు విత్తనములు తూకము, సీళ్లు లాట్  నంబర్లు పరిష్కించిన తేదీ ప్యాక్ చేసిన తేదీ మరియు నాణ్యత , లక్షణములు వగైరా నిర్ధారణ చేసుకుని తదుపరి మార్త్రమే కొనుగోలు చేయడమైనది . విత్తనములు మొలక పూత దిగుబడి నాణ్యత కేవలం ప్రకృతి పరిస్థితులు మరియు యాజమాన్య పద్దతులపై ఆధారపడి యున్నది , కావున దానికి ఎట్టిపరిస్థితులలో అమ్మకదారులకు ఎటువంటి బాధ్యతలేదు , అని అంగీకరించి కొనుగోలు చేయడమైనది . డెలివరీ ఇచ్చిన సరుకు తిరిగి తీసుకొనబడదు . మార్పు ఇవ్వబడదు . రైతులు విత్తనములు కొని మొలక కట్టుకుని తృప్తిచెందిన తరువాత మాత్రమే నారు పోసుకోవలెను <br/>
<?php    } ?>
                 <?php echo $gstin_data['bank_details']; ?>  </div>
                <div class="col-md-12"><div class="col-md-6 pull-left" style="margin-bottom: 5px">Authorized signature</div><div class="col-md-6 pull-right" style="margin-bottom: 5px">Customer signature</div></div>
            </div>
            <?php }else if(isset($wholesale_bill_report)){
                $view_report = "wholesale_bill_report";
                ?>
                <a class="btn btn-primary" href="<?php echo base_url().ucfirst($module) ?>/wholesale_report"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;View wholesale bill</a>
                <h4 align="center" class="report_title"><?php echo $module; ?>&nbsp;Wholesale bill</h4>
                <div class="row">
                   <div class="col-xs-12 col-sm-12 col-md-12" id="wholesale_profile_information">
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
                            $donot_loop = array("id","gstin_id","sgst","cgst","total_amount");
                            foreach ($maintable_table_data as $key => $maintable_table_value) { 
                                if(!in_array($key,$donot_loop)){
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
                                            <label for="farmer_name" class="col-sm-6 control-label"><?php echo $key; ?> </label>
                                            <div class="col-sm-6 text-left">
                                                <?php echo $maintable_table_value; ?>
                                            </div>
                                            
                                            
                                        </div>
                                    </div>   
                                    <?php   } }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="wholesale_bill_report" class="table table-striped table-bordered" width="100%" cellspacing="0">
                   
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Variety</th>
                            <th>Batch</th>                
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(!empty($wholesale_bill_report)){
                            foreach ($wholesale_bill_report as $key => $wholesale_bill_value) {
                                $sno = $key+1;
                                echo "<tr>";
                                echo "<td>".$sno."</td>";
                                echo "<td>".$wholesale_bill_value['variety']."</td>";
                                echo "<td>".$wholesale_bill_value['batch']."</td>";
                                echo "<td>".$wholesale_bill_value['quantity']."</td>";
                                echo "<td>".$wholesale_bill_value['price']."</td>";
                                echo "<td>".$wholesale_bill_value['amount']."</td>";
                                echo "</tr>";
                            }
                        }

                        ?>
                    </tbody>
                </table>
                <?php if(!empty($maintable_table_data)){
                    $loopitems = array("sgst","cgst","total_amount");
                    echo "<table align='right' width='20%' >";
                    foreach ($maintable_table_data as $key => $maintable_table_value) {
                        if(in_array($key,$loopitems)){
                            $key = strtoupper(str_replace("_"," ",$key));
                            echo "<tr><td align='left'>".$key."</td><td align='right'>".$maintable_table_value."</td></tr>";
                        }
                    }
                    echo "</table>";
                }
                ?>
                <div class="col-md-12 saleretail_container_cloned" style="display: none;">
                  <div class="col-md-12">
                  <?php   if($module =="Pesticides")
                            {    
                                 echo "Including ".$including_gst_onprint."% Gst<br/>";
                             ?>
                            అరువూ బిల్లు తాలుకు సొమ్ము వారం  రోజులలో చెల్లించనియడల బిల్లు తేదీ నుండి నెల 1కి 100కి రూ 2 /- చొ న వడ్డీ తో ఇవ్వబడును 
                            <br/>  
                        ఒకసారి కొనుగోలు చేయబడిన సరుకు తిరిగి తీసుకోలేము . <br/>
                        ఫై బిల్లు ప్రకారం మీ వద్ద ఖరీదు చేసిన పురుగు మందులు వ్యవసాయమునకు మాత్రమే ఉపయోగించునని , దీని జాగ్రత్తలు ఉపయోగములు నాకు తెలియునని మిమ్ములను నమ్మించి సరుకు తూకం . పేళ్లు తయారు తేదీ సరిచూచుకుని మీ వద్ద ఖరీదు చేసినను 
<?php }else if($module =="Fertilizers"){ ?>
 ఒకసారి కొనుగోలు చేయబడిన సరుకు తిరిగి తీసుకోలేము . <br/>
                షర : ఈ తేదీ లాగయిత్తు నెల 1కి 100కి రూ 2-00 చొ||న వడ్డీ నిర్ణయం  <br/>
<?php }else if($module =="Seeds"){ ?>
ఈ బిల్లు దాఖలు విత్తనములు తూకము, సీళ్లు లాట్  నంబర్లు పరిష్కించిన తేదీ ప్యాక్ చేసిన తేదీ మరియు నాణ్యత , లక్షణములు వగైరా నిర్ధారణ చేసుకుని తదుపరి మార్త్రమే కొనుగోలు చేయడమైనది . విత్తనములు మొలక పూత దిగుబడి నాణ్యత కేవలం ప్రకృతి పరిస్థితులు మరియు యాజమాన్య పద్దతులపై ఆధారపడి యున్నది , కావున దానికి ఎట్టిపరిస్థితులలో అమ్మకదారులకు ఎటువంటి బాధ్యతలేదు , అని అంగీకరించి కొనుగోలు చేయడమైనది . డెలివరీ ఇచ్చిన సరుకు తిరిగి తీసుకొనబడదు . మార్పు ఇవ్వబడదు . రైతులు విత్తనములు కొని మొలక కట్టుకుని తృప్తిచెందిన తరువాత మాత్రమే నారు పోసుకోవలెను <br/>
<?php    } 
     ?>
                        </div>
                <div class="col-md-6 pull-left" style="margin-bottom: 5px">Authorized signature</div><div class="col-md-6 pull-right" style="margin-bottom: 5px">Customer signature</div></div>
                <?php } ?>
            </div>
            
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function(){
            var module_view = '<?php echo $view_report; ?>';
            if(module_view == "saleretail_bill_report"){
               $('#saleretail_bill_report').DataTable({  
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
        }else if(module_view == "wholesale_bill_report"){
            $('#wholesale_bill_report').DataTable({  
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