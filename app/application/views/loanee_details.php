<?php 
 
 /*guarantor details*/ 
  $guarantor_id = $this->model_users->get_guarantor_id();

  $g_firstname = $this->model_users->get_details('first_name', $guarantor_id);
  $g_middlename = $this->model_users->get_details('middle_name', $guarantor_id);
  $g_surname = $this->model_users->get_details('surname', $guarantor_id);
  $g_phone_number = $this->model_users->get_details('phone_number', $guarantor_id);

  $g_fullname = ucfirst($g_firstname).' '.ucfirst($g_middlename).' '.ucfirst($g_surname);

  /*loan details*/
  $loan_object = $this->model_users->get_loan_details("loanee");
  foreach($loan_object->result() as $key)
  {
    $loan_amount = $key->amount;
    $repayment_period = $key->repayment_period;
  }

  /*amount payable*/
  $interest_rates = [0.1, 0.2, 0.3];

  if($repayment_period == 1)
  {
    $amount_payable = $loan_amount + ($interest_rates[0] * $loan_amount);
    $rate = $interest_rates[0] * 100;

  }
  elseif($repayment_period == 2)
  {
    $amount_payable = $loan_amount + ($interest_rates[1] * $loan_amount);
    $rate = $interest_rates[1] * 100;

  }
  elseif($repayment_period == 3)
  {
    $amount_payable = $loan_amount + ($interest_rates[2] * $loan_amount);
    $rate = $interest_rates[2] * 100;

  }

  $suffix = $repayment_period > 1 ? 's' : '';
  $repayment_period == 3 ? $repayment_period = "3 to 6": '';

?>

<div class="container offset-top">
	<h3 class="col-lg-offset-4 text text-danger">Requested Loan Details</h3>

	<!-- loan.fill.in.form -->
		<form method="POST" class="well col-md-10 col-md-offset-1">
      <h4 class="text text-danger"><?php echo ($g_fullname); ?> has not confirmed your loan. Call them on <?php echo $g_phone_number; ?> to inform them.</h4>

			<br>

			<h4 class="text text-warning">Guarantor Details</h4>
			<hr class="hrDividerBetween">
			
      <label for="guarantoName">Name</label>
      <input type="text" class="col-lg-12 form-control" disabled value="<?php echo $g_fullname; ?>" />
      <br><br><br><br>

      <label for="guarantorPhoneNumber">Phone Number</label>
      <input type="text" class="col-lg-12 form-control" disabled value="<?php echo $g_phone_number; ?>" />
			</br></br><br><br>

			<h4 class="text text-warning">Loan Details</h4>
			<hr class="hrDividerBetween">
			
      <label for="loanAmount">Amount Borrowed</label>
      <input type="text" class="col-lg-12 form-control" value="<?php echo $loan_amount; ?>" disabled/>
      <hr class="hrDividerDotted">
      <br>

			<label for="repayment_period">Repayment Period</label>
      <input type="text" class="col-lg-12 form-control" disabled value="<?php echo $repayment_period .' Month'.$suffix;?>" />
      <br>

       <label for="amountPayable">Amount Payable</label>
       <input type="text" class="col-lg-12 form-control" value="<?php echo $amount_payable .'  i.e '.$rate.'%'; ?> Interest of <?php echo $loan_amount; ?>" disabled/>
       <hr class="hrDividerDotted">
       <br>
		
			
		</div>
		<hr class="hrDividerBetween">
		
	</form><!-- end.loan.fill.in.form -->

</div>