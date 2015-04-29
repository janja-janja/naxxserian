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
		$this->load->model("admin/admins_model");
		$this->load->model("model_users");

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
		if(!$this->session->userdata("admin_is_logged_in"))
		{
				$data = array(
					"admin" => "login",
					"title" => "Naxxserian &middot; Admin Panel"
				);

			$this->__load_view($data);
		}
		else
		{
				$data = array(
					"admin" => "home",
					"title" => "Home &middot; Admin Panel"
				);

			$this->__load_view($data);
		}
	}

	public function login_validation()
	{
		
		if(!$this->session->userdata("admin_is_logged_in"))
		{
			$this->load->library('form_validation');

			$configs = array(
					array(
							"field" => "id_number",
							"label" => "ID Number",
							"rules" => "required|trim|xss_clean|callback_validate_login_credentials"
						),

					array(
							"field" => "password",
							"label" => "Password",
							"rules" => "required|sha1|trim"
						)
				);
			$this->form_validation->set_rules($configs);

			if ($this->form_validation->run())
			{
					/*get username*/
					$id_number = $this->input->post("id_number");
					$username = ucfirst($this->model_users->get_details("first_name", $id_number));
					
					//create session for the user
					$data = array(
							"id_number" => $id_number,
							"admin_is_logged_in" => 1,
							"username" => $username
						);

					$this->session->set_userdata($data);
					redirect('admin/home');
				
			
			}
		 
			else
			{
				$data = array(
						"admin" => "login",
						"title" => "Naxxserian &middot; Admin Panel"
					);

				$this->__load_view($data);
			}
		}
		else
		{
			/*logged out admins*/
			$data = array(
						"admin" => "home",
						"title" => "Naxxserian Admin &middot; Home"
					);

				$this->__load_view($data);

		}
	}

	//callback function to validate usernames and passwords
	public function validate_login_credentials()
	/*
	validate login credentials for admins 
	*/
	{

		if ($this->admins_model->can_log_in(1))
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('validate_login_credentials', 'Sorry, you have no access!');
			return false;
		}
	}

	public function home()
	/*
	Admin login helper
	*/
	{
		$data = array(
				"admin" => "home",
				"title" => "Admin &middot; Home"
			);
	}

	public function add_user()
	/*
	Allows admin to add a new user / member
	@return boolean
	*/
	{

	}
}