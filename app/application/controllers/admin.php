<?php

class Admin extends CI_Controller
/*
Class to hold admin helpers for CRUDL processes
C->reate, R->ead, U->pdate, D->elete, L->
*/
{
	function __construct()
	{
		parent::__construct();

		#default timezone
		date_default_timezone_set("Africa/Nairobi");
	}

	public function add_user()
	/*
	Allows admin to add a new user / member
	@return boolean
	*/
	{

	}
}