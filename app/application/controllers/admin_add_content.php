<?php

class Admin_add_content extends CI_Controller
/*
Allow admin to add content to the members view page
*/
{
	function __construct()
	{
		/*
		Constructor for the class
		*/
		parent::__construct();

		#default timezone
		date_default_timezone_set("Africa/Nairobi");

		#check if admin is loggd in


		#load models

		#load view


	}

	public function __load_view($data)
	{
		$this->load->view("inc/admin/admin_template", $data);
	}
}