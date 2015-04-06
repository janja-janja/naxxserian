<?php 
	
	$guarantor_id_number = $this->session->all_userdata()["id_number"];

	/*loanee_details*/
  $loan_object = $this->model_users->get_loan_details("guarantor");

  foreach($loan_object->result() as $key)
  {
  	$loanee_id = $key->loanee_id_number;
  	$amount = $key->amount;
  	$repayment_period = $key->repayment_period;
  }

  $l_firstname = $this->model_users->get_details('first_name', $loanee_id);
  $l_middlename = $this->model_users->get_details('middle_name', $loanee_id);
  $l_surname = $this->model_users->get_details('surname', $loanee_id);
  $l_phone_number = $this->model_users->get_details('phone_number', $loanee_id);

  $l_fullname = ucfirst($l_firstname).' '.ucfirst($l_middlename).' '.ucfirst($l_surname);


 ?>

<div class="container offset-top">
	<h4 class="alert alert-danger"> You are <strong><?php echo $l_fullname; ?>'s</strong> loan guarantor and therefore do not qualify for a loan at the moment.</h4>

</div>