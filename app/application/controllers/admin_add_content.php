<?php

class Admin_add_content extends CI_Controller
/*
Allow admin to add content to the members view page
*/
{
	private $data;

	function __construct()
	{
		/*
		Constructor for the class
		*/
		parent::__construct();

		#default timezone
		date_default_timezone_set("Africa/Nairobi");

		#check if admin is loggd in
		!$this->session->userdata("admin_is_logged_in") ? redirect("admin/"): "";

		#load models


	}

	public function __load_view($data)
	{
		$this->load->view("inc/admin/admin_template", $data);
	}

	public function index()
	/*
	Entry point
	*/
	{
		$this->contributions();
	}

	public function contributions()
	/*
	Allow admin to add contributions for members
	*/
	{
		$data = array(
				"admin" => "add_contribution",
				"title" => "Add Contributions"
			);

		$this->__load_view($data);
	}

	public function add_user()
	/*
	Allows admin to add a new user / member
	*/
	{
		$data = array(
				"admin" => "add_user",
				"title" => "Add User"
			);

		$this->__load_view($data);
	}

	public function submit($what)
	/*
	Submit details to relevant models
	*/
	{
		if($what == "add_user")
		{
			echo "YESSSSS";
		}
	}


}