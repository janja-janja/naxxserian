<?php 
  
  $guarantor_id = $this->model_users->get_guarantor_id();

  $g_firstname = $this->model_users->get_details('first_name', $guarantor_id);
  $g_middlename = $this->model_users->get_details('middle_name', $guarantor_id);
  $g_surname = $this->model_users->get_details('surname', $guarantor_id);
  $g_phone_number = $this->model_users->get_details('phone_number', $guarantor_id);

  $g_fullname = ucfirst($g_firstname).' '.ucfirst($g_middlename).' '.ucfirst($g_surname);


?>

<div class="container offset-top">
	<h3 class="col-lg-offset-4 text text-danger">Request For A Loan</h3>

	<!-- loan.fill.in.form -->
		<form method="POST" class="well col-md-10 col-md-offset-1">
      <h4 class="text text-danger"><?php echo strtoupper($g_fullname); ?> has not confirmed your loan. Call them on <?php echo $g_phone_number; ?> to inform them.</h4>

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
      <input type="text" class="col-lg-12 form-control" value="" disabled/>
      <hr class="hrDividerDotted">
      <br>

			<label for="repayment_period">Repayment Period</label>
      <input type="text" class="col-lg-12 form-control" disabled value="" />
		
			
		</div>
		<hr class="hrDividerBetween">
		
	</form><!-- end.loan.fill.in.form -->

</div>