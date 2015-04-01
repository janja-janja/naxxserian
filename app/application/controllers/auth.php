<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
/*
Authorised members function helpers only
*/
{
	private $data;

	function __construct()
	{
		parent::__construct();

		#load models on startup
		$this->load->model('model_users');
		$data = array(
				"title" => "Naxxserian Investment Enterprise"
			);

		!$this->session->userdata("is_logged_in") ? redirect("out/"): '';

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
						"auth" => "home",
						"title" => "Naxxserian &middot; Home"
					);


				$this->_load_view($data);
			}
		}
		else
		{
			$data = array(
					"out" => "login",
					"title" => "Naaxserian &middot; Home"
				);
			$this->_load_view($data);
		}
		

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


	public function members()
	/**
	*Loged in members area
	*/
	{
		if($this->session->userdata('is_logged_in'))
		{
			$data = array(
					"auth" => "members",
					"title" => "Naxxserian &middot; Members",
					"password_feedback" => ""
				);
			
			$this->_load_view($data);
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

	public function logout()
	/*
	Logout a member
	*/
	{
		$this->session->sess_destroy();
		redirect('out/');
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
								"auth" => "members",
								"title" => "Naxxserian &middot; Members",
								"password_feedback" => $success
							);

						$this->_load_view($data);

					}
					else
					{
						$success = "<h4 class='alert alert-danger scroll-to-password-field pointer'> Something went wrong. Please click here to try again.</h4>";/*echo in members when password has been succsessfuly updated*/

						$data = array(
								"auth" => "members",
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
								"auth" => "members",
								"title" => "Naxxserian &middot; Members",
								"password_feedback" => $success
							);

						$this->_load_view($data);
				}
				
			}
			else
			{
				$data = array(
						"auth" => "members",
						"title" => "Naxxserian &middot; Members",
						"password_feedback" => ""
					);
				$this->_load_view($data);
			}
		}
		else
		{
			/*public*/
			redirect("auth/members");
		}
		
	}

	public function upload()
	/*
	Upload user photo()
	*/
	{
		if($this->session->userdata("is_logged_in"))
		{
			$image_field = $this->input->post("user_image");

			$config = array(
						array(
								"field" => "user_image",
								"label" => "Image Picker",
								"rules" => "required"
							)
				);

			$this->load->library("form_validation");
			$this->form_validation->set_rules($config);

			if($this->form_validation->run())
			{
				$data = array(
						"auth" => "upload",
						"title" => "Uploading Photo..."
					);

				$this->_load_view($data);
			}
			else
			{
				$data = array(
						"auth" => "members",
						"title" => "Photo Uploader...",
						"password_feedback" => ""
					);

				$this->_load_view($data);
			}

		}
		else
		{
			redirect("out/");
		}
	}




}/*end of Class*/