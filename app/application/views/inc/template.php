<?
#load views here
/*header*/
$this->load->view("inc/header");

/*Data passed as array*/
$this->session->userdata("is_logged_in") ? $this->load->view($auth) : $this->load->view($out);

/*footer*/
$this->load->view("inc/footer");