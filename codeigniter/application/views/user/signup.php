<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Welcome</title>

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?php echo base_url('assets/bootstrap/css/clean-blog.min.css'); ?>" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="<?php echo base_url('assets/bootstrap/fonts/fontawesome-webfont.woff'); ?>" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>


    </head>

    <body>

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
                        <li>
                            <a href="<?php echo base_url('user/signup'); ?>">Signup</a>
                        </li>
                        <li>
                            <a href="contact.html">Contact</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <!-- Page Header -->
        <!-- Set your background image for this header on the line below. -->
        <header class="intro-header" style="background-image: url('<?php echo base_url('assets/img/home-bg.jpg'); ?>')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                        <div class="site-heading">
                            <h1>Project Name</h1>
                            <hr class="small">
                            <span class="subheading">Project Name</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="container">
            <div class="row">
                <div class="container">
                    <div class="row centered-form">
                        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Please sign up for Project Name <small>It's free!</small></h3>
                                </div>
                                <div class="panel-body">
                                    <form role="form" method="POST" action="<?php echo base_url('user/signup'); ?>" id="signupForm">
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="First Name">
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
                                        </div>
                                        <div class="form-group">
                                            <select name="user_role" id="user_role" class="selectpicker">
                                                <option value="">Select Role</option>
                                                <option value="1">Learner</option>
                                                <option value="2">Trainer</option>
                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Confirm Password">
                                                </div>
                                            </div>
                                        </div>

                                        <input type="submit" value="Register" class="btn btn-info btn-block" id="submit_button">
                                        <img src="<?php echo base_url('assets/img/ajax-loader.gif'); ?>" id="submit-loader" style="display:none"  height="20px" width="20px"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <!-- Footer -->
        <footer>
            <div class="container">
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
                        <p class="copyright text-muted">Copyright &copy; Your Website 2016</p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- jQuery -->

        <!-- jQuery -->
        <script src='<?php echo base_url('assets/bootstrap/js/jquery.min.js'); ?>'></script>
        <script src="<?php echo base_url('assets/bootstrap/js/jquery-validator.js'); ?>"></script>
        <!--<script src='<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>'></script>-->
        <script type="text/javascript">
            $(document).ready(function () {
                // validate signup form on keyup and submit
                $("#signupForm").validate({
                    rules: {
                        first_name: "required",
                        last_name: "required",
                        user_role: "required",
                        password: {
                            required: true,
                            minlength: 5
                        },
                        password_confirmation: {
                            required: true,
                            minlength: 5,
                            equalTo: "#password"
                        },
                        email: {
                            required: true,
                            email: true
                        }
                    },
                    messages: {
                        first_name: "Please enter your firstname",
                        last_name: "Please enter your lastname",
                        user_role: "Please select your role",
                        password: {
                            required: "Please provide a password",
                            minlength: "Your password must be at least 5 characters long"
                        },
                        password_confirmation: {
                            required: "Please provide a password",
                            minlength: "Your password must be at least 5 characters long",
                            equalTo: "Please enter the same password as above"
                        },
                        email: "Please enter a valid email address"
                    },
                    submitHandler: function (form) {
                        $('#submit-loader').show();
                        $('#submit_button').hide();
                        form.submit();
//                            $( "#signupForm" ).submit();
                    }
                });
            });

        </script>

    </body>

</html>
