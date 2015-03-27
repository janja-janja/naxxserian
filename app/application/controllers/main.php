<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	private $data;

	function __construct(){
		parent::__construct();

		#load views and models on startup
		#$this->load->view('inc/template');
		$this->load->model('model_users');
		$data = array(
				"title" => "Naxxserian Investment Enterprise"
			);
	}
	public function _load_view($data){
		$this->load->view("inc/template", $data);
	}

	public function index()
	/*Entry point*/
	{
		$this->home();
		
	}

	public function home()
	{
		
		if($this->session->userdata('is_logged_in'))
		{
		
			$logged_in_member = $this->session->all_userdata()['id_number'];
			$user_data = $this->model_users->user_details("first_name", $logged_in_member);
			
			if($user_data)
			{
				$first_name =  ucfirst($this->array_to_single($user_data, "first_name"));

				/*all thru page content*/
				$data = array(
						"username" => $first_name,
						"main" => "home",
						"title" => "Naxxserian &middot; Home"
					);


				$this->_load_view($data);
			}
		}
		else
		{
			$data = array(
					"main" => "login",
					"title" => "Naaxserian &middot; Home"
				);
			$this->_load_view($data);
		}
		

	}

	public function about()
	/*
	About the app / organisation
	*/
	{
		$data = array(
			"main" => "about",
			"title" => "Naaxserian &middot; About"
			);

		$this->_load_view($data);
	}

	public function gallery()
	/*
	Pictorials of activities about naxxserian
	*/
	{
		$data = array(
			"main" => "gallery",
			"title" => "Naaxserian &middot; Gallery"
			);
		
		$this->_load_view($data);
	}

	public function projects()
	/*
	Naxxserian projects:
	 Completed, ongoing and pending
	*/
	{
		/*Completed projects*/
		#load model, completed projects from db
		#load completed projects view here


		/*Ongoing projects*/
		#load model, ongoing projects from db
		#load ongoing projects view here


		/*Pending projects*/
		#load model, pending projects from db
		#load pending projects view here



	}

	private function array_to_single($array, $column)
	/*
	Array to  single value
	$params -> array(object array from db), string(column name)
	$return single value(int/string)
	*/
	{
		foreach($array->result() as $key)
		{
			$value = $key->$column;
		}
		return $value;
	}

	/*Login form*/
	public function login(){
		$data = array(
				"main" => "login",
				"title" => "Naxxserian &middot; Login"
			);

		$data_2 = array(
				"main" => "members",
				"title" => "Naxxserian &middot; Members"
			);

		!$this->session->userdata('is_logged_in') ? $this->_load_view($data): $this->_load_view($data_2);
	}

	public function signup(){
		$data = array(
				"main" => "signup",
				"title" => "Naxxserian &middot; Sign Up"
			);

		$data_2 = array(
				"main" => "members",
				"title" => "Naxxserian &middot; Members"
			);

		!$this->session->userdata('is_logged_in') ? $this->_load_view($data): $this->_load_view($data_2);
	}


	/*
	*Validate log ins
	*/
	public function login_validation()
	{
		
		if(!$this->session->userdata("is_logged_in"))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('id_number', 'ID number', 'required|trim|xss_clean|callback_validate_credentials');
			$this->form_validation->set_rules('password', 'Password', 'required|sha1|trim');

			if ($this->form_validation->run())
			{
				/*get username*/
				$id_number = $this->input->post("id_number");
				$user_data = $this->model_users->user_details("first_name", $id_number);
				$username = ucfirst($this->array_to_single($user_data, "first_name"));
				
				//create session for the user
				$data = array(
						"id_number" => $id_number,
						"is_logged_in" => 1,
						"username" => $username
					);

				$data_2 = array(
						"main" => "members",
						"title" => "Naxxserian &middot; Members"
					);

				$this->session->set_userdata($data);
				#redirect('main/members');
				$this->_load_view($data_2);
			}
		 
			else
			{
				$data = array(
						"main" => "login",
						"title" => "Naxxserian &middot; Login"
					);

				$this->_load_view($data);
			}
		}
		else
		{
			/*not logged in*/
			$data = array(
						"main" => "members",
						"title" => "Naxxserian &middot; Members"
					);

				$this->_load_view($data);

		}
	}

	/*Validate sign ups*/
	public function signup_validation()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_number', 'ID number', 'required|trim|xss_clean|is_unique[members.id_number]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('conf_password', 'Confirm password', 'required|trim|matches[password]');

		if ($this->form_validation->run())
		{
			echo"Pass :)";
		}
		else
		{
			$data = array(
				"main" => "signup",
				"title" => "Naxxserian &middot; Sign Up"
			);

			echo "<span class='alert alert-error'>Couldn't sign you up.</span>";
			$this->_load_view($data);
		}
	}

	public function reset_password()
	{	
		#load view
		$this->load->view("reset_password");
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email_address', 'Email address', 'required|trim|xss_clean|is_email');

		if($this->form_validation->run())
		{
			echo"<span class='alert alert-success'>Is a valid email</span> ";
		}


	}

	//callback function to validate usernames and passwords
	public function validate_credentials(){

		if ($this->model_users->can_log_in()){
			return true;
		}
		else
		{
			$this->form_validation->set_message('validate_credentials', 'Incorrect login credentials!');
			return false;
		}
	}

	/**
	*Loged in members area
	*/
	public function members(){
		if($this->session->userdata('is_logged_in'))
		{
			$data = array(
					"main" => "members",
					"title" => "Naxxserian &middot; members"
				);
			
			$this->_load_view($data);
		}
		else
		{
			$data = array(
					"main" => "login",
					"title" => "Naxxserian &middot; Login"
				);
			
			$this->_load_view($data);

		}
	}

	//logout member.
	public function logout(){
		$this->session->sess_destroy();
		redirect('main/home');
	}


}

