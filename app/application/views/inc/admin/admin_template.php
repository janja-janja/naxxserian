<?php

#load admin header
$this->load->view("inc/admin/admin_header");

#load data from controller
$this->load->view("admin/".$admin);

#load admin footer
$this->load->view("inc/admin/admin_footer");