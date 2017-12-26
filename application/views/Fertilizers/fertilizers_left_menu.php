<nav class="navbar navbar-default sidebar" role="navigation">
    <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>      
    </div>
    <?php $module = $this->uri->segment(1);
    if(!isset($selected_left_menu) || empty($selected_left_menu)){
      $selected_left_menu = $this->uri->segment(2);
    }
     ?>
    <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php echo ($selected_left_menu == "stockreport")? "class='active'" : ""; ?> ><a href="<?php echo base_url().$module; ?>/stockreport">Stock Report<span   class="pull-right hidden-xs"></span></a></li> <!-- showopacity glyphicon glyphicon-home -->
        <li <?php echo ($selected_left_menu == "purchase" || $selected_left_menu =="purchase_report")? "class='active'" : ""; ?>><a href="<?php echo base_url().$module; ?>/purchase_report">Purchase<span  class="pull-right hidden-xs"></span></a></li> 
        <li <?php echo ($selected_left_menu == "payments" || $selected_left_menu == "payments_report")? "class='active'" : ""; ?> ><a href="<?php echo base_url().$module; ?>/payments_report">Payments<span   class="pull-right hidden-xs"></span></a></li>
        <li <?php echo ($selected_left_menu == "sale_retail" || $selected_left_menu == "saleretails_report" ) ? "class='active'" : ""; ?> ><a href="<?php echo base_url().$module; ?>/saleretails_report">Sale Retail<span   class="pull-right hidden-xs"></span></a></li>
        <li <?php echo ($selected_left_menu == "whole_sale")? "class='active'" : ""; ?> ><a href="<?php echo base_url().$module; ?>/wholesale_report">Whole Sale<span   class="pull-right hidden-xs"></span></a></li>

        <!-- <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="{{URL::to('createusuario')}}">Crear</a></li>
            <li><a href="#">Modificar</a></li>
            <li><a href="#">Reportar</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">Informes</a></li>
          </ul>
        </li> -->   
      </ul>
    </div>
  </div>
</nav>