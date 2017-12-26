<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12" id="profile_information">
            <div class="well well-sm">
                <div class="row">
                    
                 

                        
                       
                        <div class="col-sm-4 col-md-4 col-lg-4"></div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                        <h4><?php echo strtoupper($gstin_data['trade_name']); ?></h4>    
                        </div>
                       

                            <div class="col-sm-4 col-md-4 col-lg-4"></div>
                             <div class="col-sm-8 col-md-8 col-lg-8">
                             <div class="form-group form-inline centered-form">
                                 
                                <label class="col-lg-4 col-md-4" for="gst_no">Gst No</label>
                                
                                   <div class="col-lg-8 col-md-8"> <label for="gst_no_col"> : </label> <?php echo $gstin_data['gst_no']; ?>
                                        </div></div>

                            <div class="form-group form-inline">          
                                <label class="col-lg-4 col-md-4" for="gst_no">Fertilizer License No.</label>
                                
                               <div class="col-lg-8 col-md-8"><label for="fl_no_col"> : </label> <?php echo $gstin_data['fertilizer_license']; ?>
                                </div>
                            </div>
                            <div class="form-group form-inline">          
                                <label class="col-lg-4 col-md-4"for="gst_no">Seed License No.</label>
                                
                                <div class="col-lg-8 col-md-8">
                                    <label for="si_no_col"> : </label> <?php echo $gstin_data['seed_license']; ?></div>
                            </div>
                            <div class="form-group form-inline">          
                                <label class="col-lg-4 col-md-4" for="gst_no">Pesticide license No.</label>
                               
                                <div class="col-lg-8 col-md-8">
                                     <label for="pi_no_col"> : </label> <?php echo $gstin_data['pesticide_license']; ?>
                                </div>
                            </div>                                                        
                        
                             
                            
                        </div>
                   
                </div>
            </div>
        </div>
        <!-- edit profile information -->
         <?php  if(isset($all_gstins_data) && !empty($all_gstins_data)){ ?>
<div class="col-md-12" id="gst_list">
<h4 align="center">All Trades</h4>
    <table  class="table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>S.no</th>
                <th>Trade Name</th>
                <th>Gst No</th>
                <th>FL</th>
                <th>SL</th>
                <th>PL</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(isset($all_gstins_data) && !empty($all_gstins_data)){
            $sum_total_price =0;
            foreach ($all_gstins_data as $key => $all_gstins_data_value) {
                $sno = $key+1;
                    echo "<tr>";
                    echo "<td>".$sno."</td>";
                    echo "<td>".$all_gstins_data_value['trade_name']."</td>";
                    echo "<td>".$all_gstins_data_value['gst_no']."</td>";
                    echo "<td>".$all_gstins_data_value['fertilizer_license']."</td>";
                    echo "<td>".$all_gstins_data_value['seed_license']."</td>";
                    echo "<td>".$all_gstins_data_value['pesticide_license']."</td>";
                    echo "<td>".$all_gstins_data_value['location']."</td>";
                    echo "</tr>";
            }
        }

         ?>
        </tbody>
    </table>
</div>
<?php } ?>

<?php  if(isset($user_company_data) && !empty($user_company_data)){ ?>
<div class="col-md-12" id="gst_list">
<h4 align="center">Trade Admins</h4>
    <table  class="table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>S.no</th>
                <th>Trade Name</th>
                <th>Trade Admin</th>
                <th>Phone</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(isset($user_company_data) && !empty($user_company_data)){
            $sum_total_price =0;
            foreach ($user_company_data as $key => $user_company_data_value) {
                $sno = $key+1;
                    echo "<tr>";
                    echo "<td>".$sno."</td>";
                    echo "<td>".$user_company_data_value['trade_name']."</td>";
                    echo "<td>".$user_company_data_value['first_name']."&nbsp;".$user_company_data_value['last_name']."</td>";
                    echo "<td>".$user_company_data_value['phone']."</td>";
                    echo "<td>".$user_company_data_value['email_id']."</td>";
                    echo "</tr>";
            }
        }

         ?>
        </tbody>
    </table>
</div>
<?php } ?>
        <!-- eof edit profile information -->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){

    });
</script>