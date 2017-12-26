<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CropCares</title>
        <!-- Bootstrap Core CSS -->
        <link rel="icon" type="image/png" href="<?php echo base_url(); ?>favicon-32x32.png" sizes="32x32" />
        <link rel="icon" type="image/png" href="<?php echo base_url(); ?>favicon-16x16.png" sizes="16x16" />
        <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?php echo base_url('assets/bootstrap/css/clean-blog.min.css'); ?>" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>  
    </head>

    <body>
<!-- Set your background image for this header on the line below. -->
        <header class="intro-header" style="background-image: url(<?php echo base_url('assets/img/home-bg.jpg'); ?>)">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                        <div class="site-heading">
                            <h1>Crop Cares</h1>
                            <hr class="small">
                            <span class="subheading">Everything that your crop needs</span>
                        </div>
                    </div>
                </div>
            </div>

            <!--start of select box-->
            

            <!--End of select Box-->

        </header>
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="<?php echo base_url(); ?>">Home</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('user/signin'); ?>">Signin</a>
                        </li>
                        <!-- <li>
                            <a href="<?php //echo base_url('user/signup'); ?>">Signup</a>
                        </li> -->
                        <li>
                            <a href="<?php echo base_url('user/contact'); ?>">Contact</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
<div>
<div><!--  class="container" -->
<?php if($this->session->flashdata('message')){ ?>
<div class="row">
    <div class="col-md-6 col-md-offset-3 alert alert-danger">
            <?php echo $this->session->flashdata('message'); ?>
    </div>
</div>
<?php }     ?>
            <div class="row"><?php $this->load->view($content) ?></div>
            </div>
            </div>
<footer>
        
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">Copyright &copy; CropCares 2017</p>
                </div>
            </div>
        
    </footer>