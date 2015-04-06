<?

 class Model_users extends CI_Model{

 	public function user_details($column, $unique_id)
 	/*
	Get a specific field of a user
	@params - > sting(table name), string(column), int(primary key)
 	*/
 	{
 		$details = $this->db->query("SELECT $column FROM members WHERE id_number = $unique_id");
 		if($details)
 		{
 			return $details;
 		}
 	}
 	/*end user_details*/


 	public function get_details($column, $unique_id)
 	/*
	Get a specific field of a user
	@params - > sting(table name), string(column), int(primary key)
 	*/
 	{
 		$details = $this->db->query("SELECT $column FROM members WHERE id_number = $unique_id");
 		if($details)
 		{
 			return $this->array_to_single($details, $column);
 		}
 	}
 	/*end get_details*/

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
	/*end array_to_single*/

 	public function can_log_in()
 	{
 		$this->db->where('id_number', $this->input->post('id_number'));
 		$this->db->where('password', sha1($this->input->post('password')));

 		$query = $this->db->get('members');

 		if($query->num_rows() == 1)
 		{
 			return true;
 		}
 		else
 		{
 			return false;
 		}
 	}
 	/*end can_log_in*/

 	public function password_is_valid()
 	/*
	Check if old password provided matches the one in db
	@params string, int
	@return boolean
 	*/
 	{
 		$this->db->where('id_number', $this->session->all_userdata()["id_number"]);
 		$this->db->where('password', sha1($this->input->post("member_old_password")));

 		$query = $this->db->get('members');

 		if($query->num_rows() == 1)
 		{
 			return true;
 		}
 		else
 		{
 			return false;
 		}
 	}
 	/*end password_is_valid*/

 	public function is_a_member($email_address)
 	/*
	Verify that one is a member
	@param string(email_address)
	@return boolean
 	*/
 	{
 		$this->db->where('email_address', $email_address);

 		$query = $this->db->get('members');

 		if($query->num_rows() == 1){
 			return true;
 		}
 		else
 		{
 			return false;
 		}
 	}
 	/*end is_a_member*/

 	public function make_changes($new_password, $unique_id)
 	/*
	Make new changes to the db to the unique id
	@params string(), int(unique id)
	@retutn boolean
 	*/
 	{

		$data = array(
	     'password' => sha1($new_password)
	  );

		$this->db->where('id_number', $unique_id);

		if($this->db->update('members', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
 	/*end make_changes*/


 	public function upload_photo($image_name)
 	/*
	Update photo column in the db
 	*/
 	{
 		$unique_id = $this->session->all_userdata()["id_number"];

 		$data = array(
 				"photo" => $image_name
 			);

 		$this->db->where("id_number", $unique_id);

 		if($this->db->update("members", $data))
 		{
 			return true;
 		}
 		else
 		{
 			return false;
 		}
 	}
 	/*end upload_photo*/


 	public function get_all_members()
 	/*
	Get all members list
	@return array
 	*/
 	{
 		$members = $this->db->get("members");
 		if($members)
 		{
 			return $members;
 		}
 	}/*end get_all_members()*/


 	public function save_loan_details($guanrator_id, $loan_amount, $repayment_period)
 	/*
	Save loan details from loanee
 	*/
 	{	
 		$loanee_id = $this->session->all_userdata()["id_number"];
 		$date = date("Y-m-d H:i:s");

 		$data = array(
 				"loanee_id_number" => $loanee_id,
 				"guarantor_id_number" => $guanrator_id,
 				"amount" => $loan_amount,
 				"balance" => $loan_amount,
 				"application_date" => $date,
 				"repayment_period" => $repayment_period

 			);

 		$saved = $this->db->insert("loans", $data);
 		if($saved)
 		{
 			return true;
 		}
 		return false;
 	}/*end save_loan_details(x, y, z)*/



 	public function check_loan_status($whose_detail)
 	/*
	check member(s) loan status
	@return int
 	*/
 	{
 		$id_number = $this->session->all_userdata()["id_number"];

 		if($whose_detail == "loanee")
 		{/*loanee logged in*/
 			$loan_data = array(
 				"loanee_id_number" => $id_number,
 				"loan_verification" => 0,
 				"loan_status" => 0
 			);

	 		$this->db->where($loan_data);

	 		$query = $this->db->get("loans");

	 		if($query->num_rows() == 1)
	 		{
	 			/*loanee not verified by guarantor. Deny loan fill in form*/
	 			return 0;
	 		}
	 		elseif($query->num_rows() == 0)
	 		{
	 			/*check if loanee has been verified by guarantor.*/
	 			$loan_data = array(
	 				"loanee_id_number" => $id_number,
	 				"loan_verification" => 1,
	 				"loan_status" => 0
	 			);

	 			$this->db->where($loan_data);

	 			$query = $this->db->get("loans");

	 			if($query->num_rows() == 1)
	 			{
	 				/*loanee has been verified by guarantor. Deny loan fill in form.*/
	 				return 1;
	 			}
	 			elseif($query->num_rows() == 0)
	 			{
	 				/*member is not a loanee. Allow loan fill in form.*/
	 				return 2;
	 			}

	 		}
 		}
 		elseif($whose_detail == "guarantor")
 		{/*guarantor logged in*/
 			/*allow guarantor to verify loanee's loan*/
 			$data = array(
 					"guarantor_id_number" => $id_number,
 					"loan_verification" => 0
 				);

 			$this->db->where($data);
 			$query = $this->db->get("loans");
 			if($query->num_rows() == 1)
 			{
 				/*unverified loan found. Deny loan fill in form*/
 				return 0;
 			}
 			elseif($query->num_rows() == 0)
 			{
 				/*no unverified loan. 
 				Check if guarantor already verified. Deny loan fill in form*/
 				$data = array(
 						"guarantor_id_number" => $id_number,
 						"loan_verification" => 1,
 						"loan_status" => 0
 					);

 				$this->db->where($data);
 				$query = $this->db->get("loans");
 				if($query->num_rows() == 1)
 				{
 					/*Is already a guarantor. Deny loan fill in form*/
 					return 1;
 				}
 				elseif($query->num_rows() == 0)
 				{
 					/*Member is not a guarantor. Allow log in form*/
 					return 2;
 				}
 			}
 		}
 		
 	}/*end check_loanee_status()*/

 	public function get_guarantor_id()
 	/*
	Get guarantor id given loanee_id
	@return int
 	*/
 	{
 		$loanee_id = $this->session->all_userdata()["id_number"];

 		$loan_data = array(
 				"loanee_id_number" => $loanee_id,
 				"loan_verification" => 0,
 				"loan_status" => 0
 			);

 		$this->db->select("guarantor_id_number");
 		$this->db->where($loan_data);
 		$query = $this->db->get("loans");

 		return $this->array_to_single($query, "guarantor_id_number");
 	}

 	
 	public function get_loan_details($whose_detail)
 	/*
	get loan amount, application_date
	@param string(loanee/guarantor)
	@return object
 	*/
 	{
 		$id_number = $this->session->all_userdata()["id_number"];

 		if($whose_detail == "loanee")
 		{/*get loanee details*/

	 		$data = array(
	 				"loanee_id_number" => $id_number,
	 				"loan_status" => 0,
	 				"loan_verification" => 0
	 			);

	 		$this->db->select("amount, application_date");
	 		$this->db->where($data);

	 		return $this->db->get("loans");

 		}
 		elseif($whose_detail == "guarantor")
 		{/*get guarantor details*/
 			$data = array(
 					"guarantor_id_number" => $id_number,
 					"loan_status" => 0,
 					"loan_verification" => 0
 				);

 			$this->db->select("loanee_id_number, amount, repayment_period");
 			$this->db->where($data);

 			$query = $this->db->get("loans");
 			if($query->num_rows == 1)
 			{
 				/*loan waiting guarantor verification found*/
 				return $query;
 			}
 			elseif($query->num_rows == 0)
 			{
 				/*loan already verified by guarantor*/
 				$data = array(
	 					"guarantor_id_number" => $id_number,
	 					"loan_status" => 0,
	 					"loan_verification" => 1
	 				);

	 			$this->db->select("loanee_id_number, amount, repayment_period");
	 			$this->db->where($data);
	 			
	 			$query = $this->db->get("loans");
	 			if($query->num_rows() == 1)
	 			{
	 				/*if guarantor has verified a loan and loanee han not completed payment*/
	 				return $query;
	 			}

 			}
 			
 		}
 		
 	}/*end get_loan_details()*/



 	public function verify_loan_details($loanee_id)
 	/*
	Allow guarantor to verify loan details for loanee
	$return boolean
 	*/
 	{
 		$guarantor_id = $this->session->all_userdata()["id_number"];

 		$update_data = array(
 				"loan_verification" => 1
 			);

 		$where_data = array(
 				"loanee_id_number" => $loanee_id,
 				"guarantor_id_number" => $guarantor_id,
 				"loan_verification" => 0,
 				"loan_status" => 0
 			);

 		$this->db->where($where_data);

 		if($this->db->update("loans", $update_data))
 		{
 			return true;
 		}
 		else
 		{
 			return false;
 		}

 	}




 	public function days_till_event()
 	{

		$date1 = date("Y-m-d H:i:s");
		$date2 = "2015-03-04 10:00:00";
		$seconds = strtotime($date2) - strtotime($date1);
		$mins = round($seconds / 60);
		$hours = round($seconds / 60 /  60);

		$hrs_suffix = ($hours > 1 ) ? 's': '';
		$mins_suffix = ($mins > 1) ? 's': '';

		$time_remaining = $hours.' hour'.$hrs_suffix;
		return $time_remaining;
 	}

 	public function date_difference ($old_date) 
 	{
 		$current_date = date("Y-m-d H:i:s");
 		$date1 = new DateTime($current_date);
		$date2 = new DateTime($old_date);

		// The diff-methods returns a new DateInterval-object...
		$diff = $date2->diff($date1);

		// Call the format method on the DateInterval-object
		//echo $diff->format('%a Day and %h hours %d minutes');
		$hours = $diff->h;
		$mins = $diff->i;
		$hours = $hours + ($diff->days*24);


		return ($hours * 60) + ($mins);
	}


 }/*end of model_users model*/