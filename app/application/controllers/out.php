<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Out extends CI_Controller
/*
Public |Non-Authorised members function helpers only
*/
{

	private $data;

	function __construct()
	{
		parent::__construct();
		
		$this->load->model("model_users");
		$data = array(
				"title" => "Naxxserian Investment Enterprise"
			);
		$this->session->userdata("is_logged_in") ? redirect("auth/home"): '';
	}
	
	public function _load_view($data){
		$this->load->view("inc/template", $data);
	}

	public function index()
	/*Entry point*/
	{
		$this->about();
		
	}


	public function about()
	/*
	About the app / organisation
	*/
	{
		$data = array(
			"out" => "about",
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
			"out" => "gallery",
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
				"out" => "login",
				"title" => "Naxxserian &middot; Login"
			);

		$data_2 = array(
				"out" => "members",
				"title" => "Naxxserian &middot; Members"
			);

		!$this->session->userdata('is_logged_in') ? $this->_load_view($data): $this->_load_view($data_2);
	}

	public function signup()
	{
		$data = array(
				"out" => "signup",
				"title" => "Naxxserian &middot; Sign Up"
			);

		$data_2 = array(
				"out" => "members",
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
				$user_data = $this->model_users->user_details("first_name", $id_number);
				$username = ucfirst($this->array_to_single($user_data, "first_name"));
				
				//create session for the user
				$data = array(
						"id_number" => $id_number,
						"is_logged_in" => 1,
						"username" => $username
					);

				$this->session->set_userdata($data);
				redirect('auth/members');
			
			}
		 
			else
			{
				$data = array(
						"out" => "login",
						"title" => "Naxxserian &middot; Login"
					);

				$this->_load_view($data);
			}
		}
		else
		{
			/*not logged in*/
			$data = array(
						"out" => "members",
						"title" => "Naxxserian &middot; Members"
					);

				$this->_load_view($data);

		}
	}

	//callback function to validate usernames and passwords
	public function validate_login_credentials(){

		if ($this->model_users->can_log_in()){
			return true;
		}
		else
		{
			$this->form_validation->set_message('validate_login_credentials', 'Incorrect login credentials!');
			return false;
		}
	}


	/*Validate sign ups*/
	public function signup_validation()
	{
		$this->load->library('form_validation');

		$configs = array(
				array(
						"field" => "first_name",
						"label" => "First Name",
						"rules" => "required|trim|xss_clean"
					),

				array(
						"field" => "surname",
						"label" => "Surname",
						"rules" => "required|trim|xss_clean"
					),

				array(
						"field" => "id_number",
						"label" => "ID Number",
						"rules" => "required|trim|xss_clean|min_length[8]"
					),

				array(
						"field" => "email_address",
						"label" => "Email Address",
						"rules" => "required|trim|valid_email"
					)
			);

		$this->form_validation->set_rules($configs);

		if ($this->form_validation->run())
		{
			echo"Pass :)";
		}
		else
		{
			$data = array(
				"out" => "signup",
				"title" => "Naxxserian &middot; Sign Up"
			);

			$this->_load_view($data);
		}
	}

	public function reset_password()
	{	
		#load view
		if(!$this->session->userdata("is_logged_in"))
		{
			$data = array(
				"out" => "reset_password",
				"title" => "Naxxserian &middot; Reset Password"
			);

			$this->_load_view($data);
		}
		else
		{
			/*come back here and set page to redirect to the curent page*/
			 redirect("out/gallery");

		}


	}

	public function reset_password_validation()
	{
		if(!$this->session->userdata("is_logged_in"))
		{
			$this->load->library('form_validation');
			$configs = array(
					array(
							"field" => "email_address",
							"label" => "Email Address",
							"rules" => "required|trim|xss_clean|valid_email"
						)
				);
			$this->form_validation->set_rules($configs);

			if($this->form_validation->run())
			{
				/*check first if this email is part of existing members*/
				$email = $this->input->post("email_address");
				$email_check = array(
						array(
							"field" => "email_address",
							"label" => "Email Address",
							"rules" => "callback_validate_email"
							)
					);
				$this->form_validation->set_rules($email_check);

				if($this->form_validation->run())
					/*user exists*/
				{
					/*send email to the user here, with a reset password link*/
					$this->load->library("email");

					$this->email->from("no-reply@naxxserian.com", "Naxxserian Investment Enterprise");
					$this->email->to($email);
					$this->email->subject("Password Reset |NIE)");

					$url = base_url();
					$url = $url."out/recover_password";

					$email_body = "
					<h5>Reset Password</h5>
						<p>
							You requested for a password reset on Naxxserian Investment Enterprise. Click <a href='".$url."'><strong>this link</strong></a> to reset
						</p>
						<h6>Naxxserian Investment Enterprise(&reg;)
					";


					$this->email->message($email_body);

					if($this->email->send())
					{
						echo"Email Sent to <br>".$email;
					}
					else
					{
						echo $this->email->print_debugger();
					}
					
				}

				else
					/*User does not exist*/
				{
					$data = array(
							"out" => "reset_password",
							"title" => "Naxxserian &middot; Reset Password"
						);
					$this->_load_view($data);

				}

			}
			else
				/*Email field does not meet the rules*/
			{
				$data = array(
						"out" => "reset_password",
						"title" => "Naxxserian &middot; Reset Password"
					);
				$this->_load_view($data);
			}
		}
		else
			/*User is logged in*/
		{
			redirect("out/members");
		}
	}

	//callback function to validate email address(if it exists and set message)
	public function validate_email()
	{
		$email_address = $this->input->post("email_address");

		if($this->model_users->is_a_member($email_address))
		{
			return true;
		}
		else
		{
			$url = base_url()."out/signup";

			$this->form_validation->set_message("validate_email", "Sorry, this user does not exist. <a href='".$url."'>Register</a> with Naxxserian first.");
			return false;
		}
	}

	public function recover_password()
	/*
	Allows users to reset their passwords incase they forgot
	(link form email address sent by a valid member)
	*/
	{
		if(!$this->session->userdata("is_logged_in"))
			/*allow recovery only on non-loggeed in members*/
		{
			$data = array(
					"out" => "recover_password",
					"title" => "Naaxserian &middot; Recovery Point"
				);

			$this->_load_view($data);
		}
		else
		{
			redirect("out/members");
		}
		
	}

}