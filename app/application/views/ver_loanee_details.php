<?php 
	
	/*loanee details*/ 
	$loanee_id = $this->session->all_userdata()["id_number"];

  $l_firstname = $this->model_users->get_details('first_name', $loanee_id);
  $l_middlename = $this->model_users->get_details('middle_name', $loanee_id);
  $l_surname = $this->model_users->get_details('surname', $loanee_id);
  $l_phone_number = $this->model_users->get_details('phone_number', $loanee_id);

  $l_fullname = ucfirst($l_firstname).' '.ucfirst($l_middlename).' '.ucfirst($l_surname);

  /*guarantor details*/
  $loan_object = $this->model_users->get_loan_details("loanee");

  foreach($loan_object->result() as $key)
  {
  	$guarantor_id = $key->guarantor_id_number;
  	$amount = $key->amount;
  	$application_date = $key->application_date;
  }

  $g_firstname = $this->model_users->get_details('first_name', $guarantor_id);
  $g_middlename = $this->model_users->get_details('middle_name', $guarantor_id);
  $g_surname = $this->model_users->get_details('surname', $guarantor_id);
  $g_phone_number = $this->model_users->get_details('phone_number', $guarantor_id);

  $g_fullname = ucfirst($g_firstname).' '.ucfirst($g_middlename).' '.ucfirst($g_surname);

  /*repayment period*/
  $repayment_array = $this->model_users->get_repayment_period($amount, $application_date);

  $amount_payable = $repayment_array[0];
  $rate = $repayment_array[1];
  $repayment_period = $repayment_array[2];

  $suffix = $repayment_period > 1 ? 's' : '';

?>

<div class="container offset-top">
	<h3 class="col-lg-offset-4 text text-danger">Verify <?php echo $l_fullname."'s"; ?> Loan Details</h3>

	<!-- loan.fill.in.form -->
		<form method="POST" class="well col-md-10 col-md-offset-1">

			<h4 class="text text-warning">Loan Details</h4>
			<hr class="hrDividerBetween">
			
			<label for="loanAmount">Amount Borrowed</label>
      <input type="text" class="col-lg-12 form-control" value="<?php echo $amount; ?>" disabled/>
      <hr class="hrDividerDotted">
      <br>

			<label for="repayment_period">Repayment Period</label>
      <input type="text" class="col-lg-12 form-control" disabled value="<?php echo $repayment_period .' Month'.$suffix;?>" />
      <br><br><br><br>

       <label for="amountPayable">Amount Payable</label>
       <input type="text" class="col-lg-12 form-control" value="<?php echo $amount_payable .'  i.e '.$rate.'%'; ?> Interest of <?php echo $amount; ?>" disabled/>
       <hr class="hrDividerDotted">
       <br><br>

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
			
			<h4 class="text text-warning">Guarantor Details</h4>
			<hr class="hrDividerBetween">
			<label for="guarantor_name">Name</label>
			<input type="text" class="col-lg-12 form-control" disabled value="<?php echo $g_fullname; ?>"/>
			</br></br></br></br>

			<label for="guarantorID">ID Number</label>
			<input type="text" class="col-lg-12 form-control" disabled value="<?php echo $guarantor_id; ?>"/>
			</br></br></br></br>

			<label for="guarantor_phone">Phone Number</label>
			<input type="text" class="col-lg-12 form-control" disabled value="<?php echo $g_phone_number; ?>"/>
			</br>
			
			<hr class="hrDividerDotted">
			
		</div>
		<hr class="hrDividerBetween">
		
	</form><!-- end.loan.fill.in.form -->

</div>