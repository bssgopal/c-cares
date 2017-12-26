<div class="container">
    <div class="row">
    <?php if(isset($action_type) && $action_type == "edit_profile"){ ?>
        <div class="col-xs-12 col-sm-6 col-md-6" id="profile_information">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <!-- <img src="http://placehold.it/380x500" alt="" class="img-rounded img-responsive" /> -->
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h4>
                            <?php echo $user_profile_data['first_name']."&nbsp;".$user_profile_data['middle_name']."&nbsp;".$user_profile_data['last_name'] ?></h4>
                        <small><cite title="<?php echo $user_profile_data['address'] ?>"><?php echo $user_profile_data['address']; ?> <i class="glyphicon glyphicon-map-marker">
                        </i></cite></small>
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i>&nbsp;<?php echo $user_profile_data['email_id']; ?>
                            <br />
                            <i class="glyphicon glyphicons-cube-black"></i>&nbsp;
                            <?php echo $user_profile_data['trade_name']; ?>
                            <br />
                            <!-- <i class="glyphicon glyphicons-birthday-cake"></i>&nbsp;<?php // echo (!empty($user_profile_data['date_of_birth']) && $user_profile_data['date_of_birth'] != '0000-00-0') ?  date("d/m/y",strtotime($user_profile_data['date_of_birth'])) : "";   ?>
                             -->
                             </p>
                        <!-- Split button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" id="edit_profile">
                               Edit</button>
                             
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <!-- edit profile information -->
        <?php
if(isset($action_type) && $action_type=="new_profile"){
  $style = "";
  $profile_title = "Add Profile";
}else{
  $style = "style='display:none'";
  $profile_title = "Edit Profile";
}
         ?>
        <div id="edit_profile_information" <?php echo $style;?> >
    <h1><?php echo $profile_title; ?></h1>
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
        <h3>Personal info</h3>
        <?php
$first_name = (!empty($user_profile_data['first_name'])) ? $user_profile_data['first_name'] : "";
$last_name = (!empty($user_profile_data['last_name'])) ? $user_profile_data['last_name'] : "";
$middle_name = (!empty($user_profile_data['middle_name'])) ? $user_profile_data['middle_name'] : "";
$trade_name = (!empty($user_profile_data['trade_name'])) ? $user_profile_data['trade_name'] : "";
$email_id = (!empty($user_profile_data['email_id'])) ? $user_profile_data['email_id'] : "";
$phone = (!empty($user_profile_data['phone'])) ? $user_profile_data['phone'] : "";
$address = (!empty($user_profile_data['address'])) ? $user_profile_data['address'] : "";
$dob = (!empty($user_profile_data['date_of_birth'])) ? $user_profile_data['date_of_birth'] : "";
$user_name = (!empty($user_profile_data['user_name'])) ? $user_profile_data['user_name'] : "";
$puid = (!empty($user_profile_data['id'])) ? md5($user_profile_data['id']) : "";
       
?>

        <form class="form-horizontal" role="form" id="userProfile" action="<?php echo base_url() ?>Dashboard/saveUserProfile" method="POST">
          <div class="form-group">
            <label class="col-lg-3 control-label">First name:</label>
            <div class="col-lg-8">
              <input class="form-control" value="<?php echo $first_name ?>" type="text" name="first_name">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Middle name:</label>
            <div class="col-lg-8">
              <input class="form-control" value="<?php echo $middle_name; ?>" name="middle_name" type="text">
            </div>
          </div>          
          <div class="form-group">
            <label class="col-lg-3 control-label">Last name:</label>
            <div class="col-lg-8">
              <input class="form-control" value="<?php echo $last_name; ?>" type="text" name="last_name">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Trade Name:</label>
            <div class="col-lg-8">
            
            <select name="trade_name" class="form-control">
              <?php

              if(!empty($gstins_data)){
                foreach ($gstins_data as $trade_key => $trade_value) {
                  echo "<option value='".$trade_value['id']."'>".$trade_value['trade_name']."</option>";
                }
              }
               ?>
            </select>
              <!-- <input class="form-control" value="<?php echo $trade_name; ?>" type="text" name="trade_name" readonly="readonly"> -->
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <input class="form-control" value="<?php echo $email_id; ?>" type="text" name="email_id" >
              <input class="form-control" value="<?php echo $puid; ?>" type="hidden" name="puid" readonly="readonly">
            </div>
          </div>
           <div class="form-group">
            <label class="col-lg-3 control-label">Phone:</label>
            <div class="col-lg-8">
              <input class="form-control" value="<?php echo $phone; ?>" type="text" name="phone">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Username:</label>
            <div class="col-md-8">
              <input class="form-control" value="<?php echo $user_name; ?>" type="text" name="user_name">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Password:</label>
            <div class="col-md-8">
              <input class="form-control" value="" type="password" name="password" id="password">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Confirm password:</label>
            <div class="col-md-8">
              <input class="form-control" value="" type="password" name="confirm_password">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input class="btn btn-primary" value="Save Changes" type="submit" id="save_profile">
              <span></span>
              <input class="btn btn-default" value="Cancel" type="button" id="cancel_edit">
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
    $("#edit_profile").click(function(){
        $("#profile_information").hide();
        $("#edit_profile_information").show();
    });

    /*close edit and open profile information*/
    $("#cancel_edit").click(function(){
        $("#profile_information").show();
        $("#edit_profile_information").hide();
    });

    /* jquery validations*/
    
    $("#save_profile").click(function(){
    	var x =  $('#userProfile').validate({ // initialize the plugin
        rules: {
            first_name: {
                required: true,
                maxlength : 30
                
            },
            last_name: {
                required: true,
                maxlength: 30
            },
            email_id: {
                required: true,
                email: true
            },
            phone:{
                required:true,
                minlength:10,
                maxlength:10,
                number: true
            },
            user_name: {
                required: true,
                
            },
            password : {
            	required: function (element) {
                     if($("#password").val()){
                     	return true
                     }
                     else
                     {
                         return false;
                     }  
                  },
            	minlength : 5
            },confirm_password : {
            	required: function (element) {
                     if($("#password").val()){
                     	return true
                     }
                     else
                     {
                         return false;
                     }  
                  },
            	minlength : 5,
                    equalTo : "#password"
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