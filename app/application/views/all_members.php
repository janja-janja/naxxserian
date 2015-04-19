<?php 
  
	/*
	Display all members belonging to Naxxserian Chama
	@__author = Denis Karanja
	@__date = 19th April, 2015 12:12 pm
	*/

	#get all members
	$all_members = $this->model_users->get_all_members();	 


?>

<div class="container offset-top">
	<h4>All Members</h4>

	<table class="table table-responsive table-hover table-stripped well">
		<thead>
			<td class="bold">Name</td>
			<td class="bold">Phone Number</td>
		</thead>

	<?php
		foreach($all_members->result() as $key)
		{
			$f_name = $key->first_name;
			$surname = $key->surname;
			$m_name = $key->middle_name;
			$id_number = $key->id_number;
			$phone = $key->phone_number;

			$fullname = ucfirst($f_name).' '.ucfirst($m_name).' '.ucfirst($surname);

			echo"
				<tr id='".$id_number."' class='pointer'>
					<td>".$fullname."</td>
					<td>".$phone."</td>
				</tr>
			";

		}

	 ?>

	</table>
</div>