<div class="container">
    <div class="row">
              
                    <div class="centered-form">
                        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">login</h3>
                                </div>
                                <div class="panel-body">
                                    <?php echo validation_errors(); ?>
                                    <?php if(isset($error) && !empty($error)) echo '<span>'.$error.'</sapn>'; ?>
                                    <form role="form" method="POST" action="<?php echo base_url('user/signin'); ?>" id="signinForm">
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
                                        </div>
                                        
                                            <div class="form-group">
                                                <input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
                                            </div>
                                        

                                        <input type="submit" value="Login" class="btn btn-info btn-block" id="submit_button">
                                        <img src="<?php echo base_url('assets/img/ajax-loader.gif'); ?>" id="submit-loader" style="display:none"  height="20px" width="20px"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
</div>
               
     