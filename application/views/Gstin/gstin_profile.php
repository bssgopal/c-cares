<div class="container">
  <div class="row">
    <?php
    /* show error message*/
    if($this->session->flashdata('message')){ ?>
    <div class="row">
      <div class="col-md-6 col-md-offset-3 alert alert-danger">
        <?php echo $this->session->flashdata('message'); ?>
      </div>
    </div>
    <?php }     
    /* show error message*/
    ?>
    <!-- edit profile information -->
    <div id="edit_gstinprofile_information">
      <h1> Gstin Profile</h1>
      <hr>
      <div class="row">
        <!-- left column -->
      <!--<div class="col-md-3">
        <div class="text-center">
           <img src="//placehold.it/100" class="avatar img-circle" alt="avatar">
          <h6>Upload a different photo...</h6> 
          
          <input class="form-control" type="file">
        </div>
      </div>
    -->
    <!-- edit form column -->
    <div class="col-md-12 personal-info">
        <!-- <div class="alert alert-info alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a> 
          <i class="fa fa-coffee"></i>
          This is an <strong>.alert</strong>. Use this to show important messages to the user.
        </div> -->
        <?php
        $gstind_id = (!empty($gstin_data['id'])) ? md5($gstin_data['id']) : "";
        $trade_name = (!empty($gstin_data['trade_name'])) ? $gstin_data['trade_name'] : "";
        $location = (!empty($gstin_data['location'])) ? $gstin_data['location'] : "";
        $gst_no = (!empty($gstin_data['gst_no'])) ? $gstin_data['gst_no'] : "";
        $fl_no = (!empty($gstin_data['fertilizer_license'])) ? $gstin_data['fertilizer_license'] : "";
        $si_no = (!empty($gstin_data['seed_license'])) ? $gstin_data['seed_license'] : "";
        $pi_no = (!empty($gstin_data['pesticide_license'])) ? $gstin_data['pesticide_license'] : "";
        /*taxes*/        
        $fertilizer_cgst = (!empty($gstin_data['fertilizers_cgst'])) ? $gstin_data['fertilizers_cgst'] : "";
        $fertilizer_sgst = (!empty($gstin_data['fertilizers_sgst'])) ? $gstin_data['fertilizers_sgst'] : "";
        $seeds_cgst = (!empty($gstin_data['seeds_cgst'])) ? $gstin_data['seeds_cgst'] : "";
        $seeds_sgst = (!empty($gstin_data['seeds_sgst'])) ? $gstin_data['seeds_sgst'] : "";
        $pesticides_cgst = (!empty($gstin_data['pesticides_cgst'])) ? $gstin_data['pesticides_cgst'] : "";
        $pesticides_sgst = (!empty($gstin_data['pesticides_sgst'])) ? $gstin_data['pesticides_sgst'] : "";
        $cement_cgst = (!empty($gstin_data['cement_cgst'])) ? $gstin_data['cement_cgst'] : "";
        $cement_sgst = (!empty($gstin_data['cement_sgst'])) ? $gstin_data['cement_sgst'] : ""; 
        $bank_details = (!empty($gstin_data['bank_details'])) ? $gstin_data['bank_details'] : "";        
        ?>

        <form class="form-horizontal" role="form" id="gstinProfile" action="<?php echo base_url() ?>Gstin/saveGstinProfile" method="POST">
          <div class="form-group">
            <label class="col-lg-3 control-label">Trade Name:</label>
            <div class="col-lg-5">
              <input class="form-control" value="<?php echo $trade_name ?>" type="text" name="trade_name">
              <input class="form-control" value="<?php echo $gstind_id ?>" type="hidden" name="gstind_id">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Gst No:</label>
            <div class="col-lg-5">
              <input class="form-control" value="<?php echo $gst_no; ?>" name="gst_no" type="text">
            </div>
          </div>          

          <div class="form-group">
            <label class="col-lg-3 control-label">FL No:</label>
            <div class="col-lg-5">
              <input class="form-control" value="<?php echo $fl_no; ?>" type="text" name="fertilizer_license">
            </div </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">SI No:</label>
            <div class="col-lg-5">
              <input class="form-control" value="<?php echo $si_no; ?>" type="text" name="seed_license">
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">PI No:</label>
            <div class="col-lg-5">
              <input class="form-control" value="<?php echo $pi_no; ?>" type="text" name="pesticide_license">
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Fertilizer cgst:</label>
            <div class="col-lg-5">
              <input class="form-control" value="<?php echo $fertilizer_cgst; ?>" type="text" name="fertilizers_cgst">
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Fertilizer sgst:</label>
            <div class="col-lg-5">
              <input class="form-control" value="<?php echo $fertilizer_sgst; ?>" type="text" name="fertilizers_sgst">
            </div>
          </div>


          <div class="form-group">
            <label class="col-lg-3 control-label">Seeds cgst:</label>
            <div class="col-lg-5">
              <input class="form-control" value="<?php echo $seeds_cgst; ?>" type="text" name="seeds_cgst">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Seeds sgst:</label>
            <div class="col-lg-5">
              <input class="form-control" value="<?php echo $seeds_sgst; ?>" type="text" name="seeds_sgst">
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Pesticides cgst:</label>
            <div class="col-lg-5">
              <input class="form-control" value="<?php echo $pesticides_cgst; ?>" type="text" name="pesticides_cgst">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Pesticides sgst:</label>
            <div class="col-lg-5">
              <input class="form-control" value="<?php echo $pesticides_sgst; ?>" type="text" name="pesticides_sgst">
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Cement cgst:</label>
            <div class="col-lg-5">
              <input class="form-control" value="<?php echo $cement_cgst; ?>" type="text" name="cement_cgst">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Cement sgst:</label>
            <div class="col-lg-5">
              <input class="form-control" value="<?php echo $cement_sgst; ?>" type="text" name="cement_sgst">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Bank Details:</label>
            <div class="col-lg-5">
              <textarea class="form-control"  name="bank_details"><?php echo $bank_details; ?></textarea>
            </div>
          </div>          


          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <?php 
              if($this->session->userdata['trade_user_data']['gstin_id'] < 3){
                ?>
                <input class="btn btn-primary" value="Save Changes" type="submit" id="save_profile">
                <span></span>
                <?php } ?>
                <a href="<?php echo base_url() ?>Dashboard"><input class="btn btn-default" value="Cancel" type="button" id="cancel_edit"></a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- eof edit profile information -->
  </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

    /* jquery validations*/
    
    $("#save_profile").click(function(){
    	var x =  $('#gstinProfile').validate({ // initialize the plugin
        rules: {
          trade_name: {
            required: true
          },
          gst_no: {
            required: true 
          },
          fertilizer_license: {
            required: true 
          },
          seed_license: {
            required: true
          },
          pesticide_license: {
            required: true
          },

          fertilizers_sgst: {
            required: true,
            number: true
          },          
          fertilizers_cgst: {
            required: true,
            number: true
          },
          seeds_sgst: {
            required: true,
            number: true
          },
          seeds_cgst: {
            required: true,
            number: true
          },
          pesticides_sgst: {
            required: true,
            number: true
          },
          pesticides_cgst: {
            required: true,
            number: true
          },
          cement_sgst: {
            required: true,
            number: true
          },
          cement_cgst: {
            required: true,
            number: true
          }
        }, submitHandler: function () {
          $('#save_profile').attr('disabled','disabled');
          form.submit();
        }
      });

      console.log(x);

    });

  });
</script>