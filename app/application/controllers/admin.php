<?php

class Admin extends CI_Controller
/*
Class to hold admin helpers for CRUDL processes
C->reate, R->ead, U->pdate, D->elete, L->
*/
{
	private $data;

	function __construct()
	{
		parent::__construct();

		#default timezone
		date_default_timezone_set("Africa/Nairobi");

		#check if admin is logged in

		#set default models here

		#default data
		$data = array(
				"title" => "Naxxserian Admin Panel"
			);
	}

	public function __load_view($data)
	{
		$this->load->view("inc/admin/admin_template", $data);
	}

	public function index()
	/*
	Admin entry point
	*/
	{
		#load admin-login view
		$data = array(
				"admin" => "login",
				"title" => "Naxxserian &middot; Admin Panel"
			);

		$this->__load_view($data);
	}

	public function admin_login()
	/*
	Admin login helper
	*/
	{

	}

	public function add_user()
	/*
	Allows admin to add a new user / member
	@return boolean
	*/
	{

	}
}