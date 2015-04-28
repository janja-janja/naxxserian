<?php 

class Admins_model extends CI_Model
/*
Holds admins(user) helper functions to assist admin roles
*/
{
	public function can_log_in($category)
	/*
	check if a member can log in as an admin
	@params -> int(category)
	@return boolean
	*/
	{
		$condition = array(
				"id_number" => $this->input->post("id_number"),
				"password" => $this->input->post("password"),
				"category" => $category
			);

		$this->db->where($condition);

		$query = $this->db->get("members");

		if($query->num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}