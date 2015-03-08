<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {


	public function index()
	{	//if session is active, redirect to members area
		!$this->session->userdata('is_logged_in') ? $this->login() : redirect('main/members');
		$this->load->model('model_users');
		echo $this->model_users->date_difference();
	
	}

	/*Login form*/
	public function login(){
		!$this->session->userdata('is_logged_in') ? $this->load->view('login'): redirect('main/members');
	}

	public function signup(){
		!$this->session->userdata('is_logged_in') ? $this->load->view('signup'): redirect('main/members');
	}


	/*
	*Create the login logic. Login User
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
			echo "Denied bro";
			$this->load->view('signup');
		}
	}

	//callback function to validate usernames and passwords
	public function validate_credentials(){
		$this->load->model('model_users');

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
		redirect('main/login');
	}


}

