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


	public function change_password()
	{
		if($this->session->userdata("is_logged_in"))
			/*logged in member*/
		{
			$this->load->library("form_validation");

			$config = array(
					array(
							"field" => "member_old_password",
							"label" => "<b>Old Password</b>",
							"rules" => "required|trim"
						),

					array(
							"field" => "member_new_password",
							"label" => "<b>New Password</b>",
							"rules" => "required|trim|min_length[6]"
						),

					array(
							"field" => "member_conf_new_password",
							"label" => "<b>Confirm New Password</b>",
							"rules" => "required|trim|matches[member_new_password]"
						)
				);

			$this->form_validation->set_rules($config);

			if($this->form_validation->run())
			{
				/*code here to update pass*/
				$new_password = $this->input->post("member_new_password");
				$old_password = $this->input->post("member_old_password");
				$unique_id = $this->session->all_userdata()["id_number"];

				/*check if old password is correct*/
				if($this->model_users->password_is_valid())
				{
					/*update password*/
					if ($this->update_password($new_password))
					{
						$success = "<h4 class='alert alert-success'> Password has been updated successfuly. </h4>";/*echo in members when password has been succsessfuly updated*/

						$data = array(
								"main" => "members",
								"title" => "Naxxserian &middot; Members",
								"password_feedback" => $success
							);

						$this->_load_view($data);

					}
					else
					{
						$success = "<h4 class='alert alert-danger scroll-to-password-field pointer'> Something went wrong. Please click here to try again.</h4>";/*echo in members when password has been succsessfuly updated*/

						$data = array(
								"main" => "members",
								"title" => "Naxxserian &middot; Members",
								"password_feedback" => $success
							);

						$this->_load_view($data);
					}
				}
				else
				{
					/*old password incorrect*/
					$success = "<h4 class='alert alert-danger scroll-to-password-field pointer'>Wrong old password :( Click here to edit again</h4>";
						/*echo in members when password has been succsessfuly updated*/

						$data = array(
								"main" => "members",
								"title" => "Naxxserian &middot; Members",
								"password_feedback" => $success
							);

						$this->_load_view($data);
				}
				
			}
			else
			{
				$data = array(
						"main" => "members",
						"title" => "Naxxserian &middot; Members",
						"password_feedback" => ""
					);
				$this->_load_view($data);
			}
		}
		else
		{
			/*public*/
			redirect("main/members");
		}
		
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

			$configs = array(
					array(
							"field" => "id_number",
							"label" => "ID Number",
							"rules" => "required|trim|xss_clean|callback_validate_credentials"
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
				redirect('main/members');
			
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


	/*Validate sign ups*/
	public function signup_validation()
	{
		$this->load->library('form_validation');

		$configs = array(
				array(
						"field" => "id_number",
						"label" => "ID Number",
						"rules" => "required|trim|xss_clean|is_unique[members.id_number]"
					),

				array(
						"field" => "password",
						"label" => "Password",
						"rules" => "required|trim|"
					),

				array(
						"field" => "conf_password",
						"label" => "Confirm Password",
						"rules" => "required|trim|matches[password]"
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
		if(!$this->session->userdata("is_logged_in"))
		{
			$data = array(
				"main" => "reset_password",
				"title" => "Naxxserian &middot; Reset Password"
			);

			$this->_load_view($data);
		}
		else
		{
			/*come back here and set page to redirect to the curent page*/
			 redirect("main/home");

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
					$url = $url."main/recover_password";

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
							"main" => "reset_password",
							"title" => "Naxxserian &middot; Reset Password"
						);
					$this->_load_view($data);

				}

			}
			else
				/*Email field does not meet the rules*/
			{
				$data = array(
						"main" => "reset_password",
						"title" => "Naxxserian &middot; Reset Password"
					);
				$this->_load_view($data);
			}
		}
		else
			/*User is logged in*/
		{
			redirect("main/members");
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
			$url = base_url()."main/signup";

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
					"main" => "recover_password",
					"title" => "Naaxserian &middot; Recovery Point"
				);

			$this->_load_view($data);
		}
		else
		{
			redirect("main/members");
		}
		
	}

	public function update_password($password)
	/*
	Update new user password to the database
	*/
	{
		if($this->session->userdata("is_logged_in"))
		{
			/*logged in members password reset. Use session vars*/
			$unique_id = $this->session->all_userdata()["id_number"];

			if($this->model_users->make_changes($password, $unique_id))
			{
				return true;
			}
			else return false;
		}
		else
		{
			/*non-logged in member. Use email address*/
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
					"title" => "Naxxserian &middot; Members",
					"password_feedback" => ""
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

