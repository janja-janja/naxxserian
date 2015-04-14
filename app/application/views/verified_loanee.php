<?php 
  /*
__ @author -> Denis Karanja
__ School of Computing and Informatics - UoN
*/
 /*guarantor details*/ 
  $guarantor_id = $this->loans_model->get_guarantor_id();

  $g_firstname = $this->model_users->get_details('first_name', $guarantor_id);
  $g_middlename = $this->model_users->get_details('middle_name', $guarantor_id);
  $g_surname = $this->model_users->get_details('surname', $guarantor_id);
  $g_phone_number = $this->model_users->get_details('phone_number', $guarantor_id);

  $g_fullname = ucfirst($g_firstname).' '.ucfirst($g_middlename).' '.ucfirst($g_surname);

  /*loan details*/
  $loan_object = $this->loans_model->get_loan_details("loanee");
  foreach($loan_object->result() as $key)
  {
    $loan_amount = $key->amount;
    $application_date = $key->application_date;
    $balance = $key->balance;
  }


  /*repayment period*/
  $repayment_array = $this->loans_model->get_repayment_period($loan_amount, $application_date);

  $amount_payable = $repayment_array[0];
  $rate = $repayment_array[1];
  $repayment_period = $repayment_array[2];

  $suffix = $repayment_period > 1 ? 's' : '';



?>

<div class="container offset-top">

  <?php  ?>
	<h3 class="col-lg-offset-4 text text-success">Verified Loan Details</h3>

	<!-- loan.fill.in.form -->
		<form method="POST" class="well col-md-10 col-md-offset-1">
      <h4 class="text text-success bold"><?php echo ($g_fullname); ?> confirmed your loan request as your guarantor.</h4>
      <h5 class="text text-danger bold">Current balance: <?php echo $balance; ?> Kshs.</h5>
      <hr class="hrDividerBetween">

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
      <br><br><br><br>

       <label for="amountPayable">Amount Payable<h5 class="text text-success">System calculated value with respect to application date.</h5></label>
       <input type="text" class="col-lg-12 form-control" value="<?php echo $amount_payable .'  i.e '.$rate.'%'; ?> Interest of <?php echo $loan_amount; ?>" disabled/>

       <br><br><br><br>

       <label for="balanceDue">Balance Due</label>
       <input type="text" class="col-lg-12 form-control" value="<?php echo $balance; ?>" disabled/>
       <hr class="hrDividerDotted">
       <br>
		
			
		</div>
		<hr class="hrDividerBetween">
		
	</form><!-- end.loan.fill.in.form -->

</div>