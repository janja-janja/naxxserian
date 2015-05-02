<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="adminor" content="">
    <link rel="icon" href="<?php echo base_url();?>favicon.ico">

    <title><?php echo $title; ?></title>
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
     <link href="<?php echo base_url();?>assets/css/naxxserian.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php 
        if($this->session->userdata("admin_is_logged_in"))
        {
          ?>
      <a class="navbar-brand nax-header" href="<?php echo base_url();?>admin/">Naxxserian Investment</a>
      <?php 
        }
        else
        {
      ?>
      <a class="navbar-brand nax-header" href="<?php echo base_url();?>admin/">Naxxserian Investment</a>
      <?php } ?>

    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
       
        <?php 
          /*load member(s) only tabs*/
          $this->load->model("model_users");
          if($this->session->userdata("admin_is_logged_in"))
          {/*members only area*/
            $username = $this->session->userdata("username");
            ?>

            <li><a href="<?php echo base_url();?>admin_add_content/add_user">Add Member</a></li>
            <li><a href="<?php echo base_url();?>admin_add_content/contributions">Add Contributions</a></li>
            <li><a href="<?php echo base_url();?>admin/">Financials</a></li>
            <li><a href="<?php echo base_url();?>admin/">Members</a></li>
            <li><a href="<?php echo base_url();?>admin/">Downloads</a></li>
          
            
          <?php
          }
          else
          {/*public area*/
            ?>

            <li><a href="<?php echo base_url();?>out/login">Members Area</a></li>
            <li><a href="#">Naxxserian Foundation</a></li>

          </li>
          <?php
          }
         ?>

        
      </ul>

      
      <?php 

        if(!$this->session->userdata('admin_is_logged_in'))
          $login = "<a style='color:white;' class='white'href=".base_url()."admin/login><strong>Login</strong>&nbsp;<i class='fa fa-lock'></i></a>";
        else
          $login = "<a style='color:white;'class='white'href=".base_url()."admin/logout><strong>Logout</strong>&nbsp;<i class='fa fa-sign-admin'></i></a>";
       ?>

      <ul class="nav navbar-nav navbar-right">
        <li class="highlighter"><?php echo $login; ?></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</div>