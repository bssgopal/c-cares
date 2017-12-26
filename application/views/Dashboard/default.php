<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php 
$title ='Rythu Depot';
if($this->session->userdata['trade_user_data']['trade_name']){
  $title = $this->session->userdata['trade_user_data']['trade_name'];
}
?>
<title><?php echo  $title; ?></title>
<link rel="icon" type="image/png" href="<?php echo base_url(); ?>favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="<?php echo base_url(); ?>favicon-16x16.png" sizes="16x16" />
<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.dataTables.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/cropcares.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/sidemenu.css'); ?>">
<link rel="stylesheet" media="print" href="<?php echo base_url('assets/css/print.css'); ?>">
<script src="<?php echo base_url('assets/js/jquery-1.12.4.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-static-top">
    <div class="container" > 
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar3">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
         <a class="navbar-brand" href="#">
        <?php echo strtoupper($this->session->userdata['trade_user_data']['trade_name']); ?></a>
      </div>
      <div id="navbar3" class="navbar-collapse collapse ">
        <ul class="nav navbar-nav navbar-right none">
          <li><a href="<?php echo base_url() ?>Dashboard">Home</a></li>
              
          
           <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">My Account <span class="caret"></span></a>
            <ul class="dropdown-menu " role="menu">
              <li><a href="<?php echo base_url() ?>Dashboard/profile">My Profile</a></li>
              <li><a href="<?php echo base_url() ?>Gstin">My Gstin Profile</a></li>
              <?php if($this->session->userdata['trade_user_data']['role'] ==1){ ?>
              <li class="divider"></li>
              <li class="dropdown-header">Admin Access</li>
              <li><a href="<?php echo base_url() ?>Dashboard/addProfile">Add Profile</a></li>
              <li><a href="<?php echo base_url() ?>Gstin/addGstin">Add Gstin</a></li>
              <?php } ?>
            </ul>
          </li>
          <li><a href="<?php echo base_url()."User/logout" ?>">Logout</a></li> 
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
    <!--/.container-fluid -->
  </nav>
    
    
    <div class="container-fluid">
        <div class="row">
<div class="col-md-12">
    

<!-- header -->

  


<!-- container -->
      <?php $selected_topnav_menu = $this->uri->segment(1);  ?>
<div class="container">
     <div class="row">
         <div class="col-md-12">
     <nav>
          <ul class="nav nav-justified none">
            <li <?php echo ($selected_topnav_menu == "Fertilizers") ? "class='main_nav_active'" : ""; ?> ><a href="<?php echo base_url() ?>Fertilizers/stockreport">Fertilizers</a></li>
      <li <?php echo ($selected_topnav_menu == "Seeds") ? "class='main_nav_active'" : ""; ?> ><a href="<?php echo base_url() ?>Seeds">Seeds</a></li>
      <li <?php echo ($selected_topnav_menu == "Pesticides") ? "class='main_nav_active'" : ""; ?>><a href="<?php echo base_url() ?>Pesticides">Pesticides</a></li>
      <li <?php echo ($selected_topnav_menu == "Cement") ? "class='main_nav_active'" : ""; ?>><a href="<?php echo base_url() ?>Cement">Cement</a></li>
          </ul>
        </nav>
     </div>
    </div>
</div>
<!-- eof container  -->
<div class="row setlayout">
<?php if($this->session->flashdata('message')){ ?>
<div class="row">
    <div class="col-md-6 col-md-offset-3 alert alert-info alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 
            <?php echo $this->session->flashdata('message'); ?>
    </div>
</div>
<?php }     ?>

  <?php $this->load->view($content) ?>

</div>


</div>
        </div>
        </div>
    
    
    <!-- footer -->
    <footer>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center">
            
                <p>&copy; Copyright 2017 CropCares.com</p>
           
        </div>
    </div>
</div>
         </footer>
<!-- eof footer -->
<script type="text/javascript">
  $(document).ready(function(){

  
  });

  </script>









</body>
</html>                                		