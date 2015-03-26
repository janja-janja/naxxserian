<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url();?>favicon.ico">

    <title>Naxxserian Investment Enterprise</title>
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
<div class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand nax-header" href="<?php echo base_url();?>main/home">Naxxserian Investment</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
       
        <?php 
          /*load member(s) only tabs*/
          $this->load->model("model_users");
          if($this->session->userdata("is_logged_in"))
          {/*members only area*/
            ?>

            <li><a href="<?php echo base_url();?>main/members">Profile &middot; <?php echo $username; ?></a></li>'
            <li><a href="<?php echo base_url();?>main/members">Request Loan</a></li>
            <li><a href="<?php echo base_url();?>main/members">Members</a></li>
            <li><a href="<?php echo base_url();?>main/members">Downloads</a></li>
            <!-- /*committees dropdown*/ -->
            
              <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Committees<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url();?>main/Investment">Investment</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url();?>main/foundation">Foundation</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url();?>main/special_committee">Special Committee</a></li>
                
              </ul>
            </li>
            
          <?php
          }
          else
          {/*public area*/
            ?>

            <li><a href="<?php echo base_url();?>main/about">About us</a></li>
            <li><a href="<?php echo base_url();?>main/gallery">Gallery</a></li>
            <li><a href="#">Naxxserian Foundation</a></li>

            <!-- /*projects dropdown*/ -->
            
            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Projects <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="base_url();main/projects">Ongoing</a></li>
              <li class="divider"></li>
              <li><a href="base_url();main/projects">Completed</a></li>
              <li class="divider"></li>
              <li><a href="base_url();main/projects">Pending</a></li>
              
            </ul>
          </li>
          <?php
          }
         ?>

        
      </ul>
     
     <!-- Search button -->
      <!-- <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Search</button>
      </form> -->
      <!-- End of search -->

      
      <?php 

        if(!$this->session->userdata('is_logged_in'))
          $login = "<a style='color:white;' class='white'href=".base_url()."main/login><strong>Login</strong><i class='fa fa-lock'></i></a>";
        else
          $login = "<a style='color:white;'class='white'href=".base_url()."main/logout><strong>Logout</strong><i class='fa fa-sign-out'></i></a>";
       ?>

      <ul class="nav navbar-nav navbar-right">
        <li class="highlighter"><?php echo $login; ?></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</div>

