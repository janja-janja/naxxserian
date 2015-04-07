<?php

class Loans_model extends CI_Model
/*
Hold helpers associated with loans
*/
{

	public function save_loan_details($guanrator_id, $loan_amount, $repayment_period)
 	/*
	Save loan details from loanee
 	*/
 	{	
 		$loanee_id = $this->session->all_userdata()["id_number"];
 		$date = date("Y-m-d H:i:s");

 		$balance_array = $this->get_repayment_period($loan_amount, $date);
 		$balance = $balance_array[0];

 		$data = array(
 				"loanee_id_number" => $loanee_id,
 				"guarantor_id_number" => $guanrator_id,
 				"amount" => $loan_amount,
 				"balance" => $balance,
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

 		if($query->num_rows() == 0)
 		{
 			/*check if guarantor has verified loanee details*/
 			$loan_data = array(
 				"loanee_id_number" => $loanee_id,
 				"loan_verification" => 1,
 				"loan_status" => 0
 			);

	 		$this->db->select("guarantor_id_number");
	 		$this->db->where($loan_data);
	 		$query = $this->db->get("loans");

	 		if($query->num_rows() == 1)
	 		{
	 			/*guarantor has verified details*/
	 			return $this->array_to_single($query, "guarantor_id_number");
	 		}
	 		else
	 		{
	 			return 0;
	 		}

 		}
 		elseif($query->num_rows() == 1)
 		{
 			/*guarantor has not verified loanee*/
 			return $this->array_to_single($query, "guarantor_id_number");
 		}

 	}


 	public function get_loan_details($whose_detail)
 	/*
	Get loan amount, application_date
	@param string(loanee/guarantor)
	@return object
 	*/
 	{
 		if($whose_detail == "loanee")
 		{
 			return $this->get_loanee_details();
 		}
 		elseif($whose_detail == "guarantor")
 		{
 			return $this->get_guarantor_details();
 		}

 	}/*end get_loan_details()*/

 	private function get_loanee_details()
 	/*
	Get loanee loan amount, application_date
	@param string(loanee/guarantor)
	@return object
 	*/
 	{
 		$id_number = $this->session->all_userdata()["id_number"];

 		$data = array(
 				"loanee_id_number" => $id_number,
 				"loan_status" => 0,
 				"loan_verification" => 0
 			);

 		$this->db->select("amount, application_date");
 		$this->db->where($data);

 		$query = $this->db->get("loans");
 		if($query->num_rows() == 1)
 		{
 			/*unverified loan found*/
 			return $query;
 		}
 		elseif($query->num_rows() == 0)
 		{
 			/*check for a verified loan found*/
 			$data = array(
 				"loanee_id_number" => $id_number,
 				"loan_status" => 0,
 				"loan_verification" => 1
 			);

	 		$this->db->select("amount, guarantor_id_number, application_date, balance");
	 		$this->db->where($data);

	 		$query = $this->db->get("loans");

	 		if($query->num_rows() == 1)
	 		{
	 			/*verified loan found*/
	 			return $query;
	 		}
	 		elseif($query->num_rows() == 0)
	 		{
	 			/*verified loan found. This loan has been settled*/
	 		}
 		}
 	}/*end get_loanee_details()*/

 	private function get_guarantor_details()
 	/*
	Get guarantor details on loanee's loan amount, application_date
	@param string(loanee/guarantor)
	@return object
 	*/
 	{
 		$id_number = $this->session->all_userdata()["id_number"];

		$data = array(
				"guarantor_id_number" => $id_number,
				"loan_status" => 0,
				"loan_verification" => 0
			);

		$this->db->select("loanee_id_number, amount, repayment_period, balance, application_date");
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

			$this->db->select("loanee_id_number, amount, repayment_period, balance, application_date");
			$this->db->where($data);
			
			$query = $this->db->get("loans");
			if($query->num_rows() == 1)
			{
				/*if guarantor has verified a loan and loanee han not completed payment*/
				return $query;
			}

		}
 	}

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


	public function get_repayment_period($loan_amount, $application_date)
 	/*
	Get repayment period, interest accrued and the interest rate used
 	*/
 	{
 		$details = [];

 		$days_with_loan = $this->date_difference($application_date);

	  /*amount payable*/
	  $passed_minutes = [44640, 89280, 133920];/*1 month, 2 months, above 3 months*/
	  $interest_rates = [0.1, 0.2, 0.3];

	  if($days_with_loan <= $passed_minutes[0])
	  {
	    $amount_payable = $loan_amount + ($interest_rates[0] * $loan_amount);
	    $rate = $interest_rates[0] * 100;
	    $repayment_period = $passed_minutes[0] / (60 * 24 * 31);

	    $details = [$amount_payable, $rate, $repayment_period];
	    return $details;
	  }
	  elseif($days_with_loan <= $passed_minutes[1])
	  {
	    $amount_payable = $loan_amount + ($interest_rates[1] * $loan_amount);
	    $rate = $interest_rates[1] * 100;
	    $repayment_period = $passed_minutes[1] / (60 * 24 * 31);

	    $details = [$amount_payable, $rate, $repayment_period];
	    return $details;
	  }
	  elseif(($days_with_loan <= $passed_minutes[2]) || ($days_with_loan >= $passed_minutes[2]))
	  {
	    $amount_payable = $loan_amount + ($interest_rates[2] * $loan_amount);
	    $rate = $interest_rates[2] * 100;
	    $repayment_period = $passed_minutes[2] / (60 * 24 * 31);

	    $details = [$amount_payable, $rate, $repayment_period];
	    return $details;
	  }
 	}


 	private function date_difference ($old_date) 
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

}/*end of Loans_model*/