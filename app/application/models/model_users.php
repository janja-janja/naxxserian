<?php
 /*
__ @author -> Denis Karanja
__ School of Computing and Informatics - UoN
*/
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


 }/*end of model_users model*/