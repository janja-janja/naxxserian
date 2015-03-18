<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	private $data;

	function __construct(){
		parent::__construct();

		#load views and models on startup
		$this->load->view('inc/template');
		$this->load->model('model_users');
	}

	public function index()
	{
		$this->home();
		
	}

	public function home()
	{
		$this->load->view("home");
	}

	/*Login form*/
	public function login(){
		
		!$this->session->userdata('is_logged_in') ? $this->load->view('login'): redirect('main/members');
	}

	public function signup(){
		!$this->session->userdata('is_logged_in') ? $this->load->view('signup'): redirect('main/members');
	}


	/*
	*Validate log ins
	*/
	public function login_validation(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_number', 'ID number', 'required|trim|xss_clean|callback_validate_credentials');
		$this->form_validation->set_rules('password', 'Password', 'required|md5|trim');

		if ($this->form_validation->run()){
			//create session for the user
			$data = array(
					'id_number' => $this->input->post('id_number'),
					'is_logged_in' => 1
				);
			$this->session->set_userdata($data);
			redirect('main/members');
		}
		else
		{
			$this->load->view('login');
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
			echo "<span class='alert alert-error'>Couldn't sign you up.</span>";
			$this->load->view('signup');
		}
	}

	public function reset_password()
	{	
		$this->load->view("reset_password");
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
			$this->load->view('members');
		}
		else
		{
			$this->load->view('login');
		}
	}

	//logout member.
	public function logout(){
		$this->session->sess_destroy();
		redirect('main/home');
	}


}

