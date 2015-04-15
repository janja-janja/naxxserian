<?php 
	
	/*guarantor details*/
	$guarantor_id = $this->session->all_userdata()["id_number"];

	$g_firstname = $this->model_users->get_details('first_name', $guarantor_id);
  $g_middlename = $this->model_users->get_details('middle_name', $guarantor_id);
  $g_surname = $this->model_users->get_details('surname', $guarantor_id);
  $g_phone_number = $this->model_users->get_details('phone_number', $guarantor_id);

  $g_fullname = ucfirst($g_firstname).' '.ucfirst($g_middlename).' '.ucfirst($g_surname);

	/*loanee_details*/
  $loan_object = $this->loans_model->get_loan_details("guarantor");

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

	<div class="container offset-top">

	<!-- loan.fill.in.form -->
		<form method="POST" action="<?php echo base_url(); ?>auth/verify_loan" class="well col-md-10 col-md-offset-1">

			<h4 class="alert alert-danger">You are <strong><?php echo $l_fullname; ?>'s</strong> loan guarantor and therefore do not qualify for a loan at the moment.</h4>

			<h4 class="text text-warning">Loanee Details</h4>
			<hr class="hrDividerBetween">
			<label for="loaneeName">Name</label>
			<input type="text" class="col-lg-12 form-control" disabled value="<?php echo $l_fullname; ?>"/>
			<input type="hidden" class="col-lg-12 form-control" value="<?php echo $l_fullname; ?>" name="loanee_fullname"/>
			<br><br><br><br>
			
			<label for="loaneeID">ID Number</label>
			<input type="text" class="col-lg-12 form-control" disabled value="<?php echo $loanee_id; ?>"/>
			<input type="hidden" class="col-lg-12 form-control" value="<?php echo $loanee_id; ?>" name="loanee_id_number"/>

			<br><br><br><br>
			<label for="loaneeID">Phone Number</label>
			<input type="text" class="col-lg-12 form-control" disabled value="<?php echo $l_phone_number; ?>"/>
			
			
			<hr class="hrDividerDotted">
			<br><br>
			
			<h4 class="text text-warning">Guarantor Details(My Details)</h4>
			<hr class="hrDividerBetween">
			<label for="guarantor_name">Name</label>
			<input type="text" class="col-lg-12 form-control" disabled value="<?php echo $g_fullname; ?>"/>
			</br></br></br></br>

			<label for="guarantorID">ID Number</label>
			<input type="text" class="col-lg-12 form-control" disabled value="<?php echo $guarantor_id; ?>"/>
			</br></br></br></br>

			<h4 class="text text-warning">Loan Details</h4>
			<hr class="hrDividerBetween">
			
			<label for="loanAmount" id="loanAmountHint">Loan Amount Applied</label>
			<input type="text" class="col-lg-12 form-control" disabled value="<?php echo $amount; ?>"/>
			<br><br><br><br>

			<label for="repayment_period">Repayment Period</label>
			<input type="text" disabled class="col-lg-12 form-control" value="<?php echo $repayment_period; ?>"/>
			

</div>