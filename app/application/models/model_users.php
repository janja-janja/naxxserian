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

 	public function can_log_in()
 	{
 		$this->db->where('id_number', $this->input->post('id_number'));
 		$this->db->where('password', sha1($this->input->post('password')));

 		$query = $this->db->get('members');

 		if($query->num_rows() == 1){
 			return true;
 		}
 		else
 		{
 			return false;
 		}
 	}

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
		$this->db->update('members', $data) ? return true : return false;
 	}
 	


 	public function days_till_event()
 	{

		/*$datetime1 = new DateTime('2015-03-02 10:00:00');
		$datetime2 = new DateTime('2015-03-04 10:00:00');
		$interval = $datetime1->diff($datetime2);
		return $interval->format('%R%a days');
*/
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

 	public function date_difference () {
 		$current_date = date("Y-m-dTH:i:s");
 		$date1 = new DateTime($current_date);
		$date2 = new DateTime('2015-03-04T10:00:00');

		// The diff-methods returns a new DateInterval-object...
		$diff = $date2->diff($date1);

		// Call the format method on the DateInterval-object
		//echo $diff->format('%a Day and %h hours %d minutes');
		$hours = $diff->h;
		$mins = $diff->i;
		$hours = $hours + ($diff->days*24);

		$hrs_suffix = ($hours > 1) ? 's' : '';
		$min_suffix = ($mins > 1) ? 's' : '';

		$hours = $hours." hour".$hrs_suffix." ".$mins." minute".$min_suffix;

		return $hours;
	}
 }