<?php 
		
	if($this->session->userdata("is_logged_in"))
	{
		$id_number = $this->session->all_userdata()["id_number"];

		$firstname = $this->model_users->get_details('first_name', $id_number);
		$middlename = $this->model_users->get_details('middle_name', $id_number);
		$surname = $this->model_users->get_details('surname', $id_number);


		$fullname = ucfirst($firstname).' '.ucfirst($middlename).' '.ucfirst($surname);
	}
	
?>


<div class="container offset-top">
	<h3 class="col-lg-offset-3">Request Loan</h3>

	<!-- loan.fill.in.form -->
		<form method="POST" action="" class="well col-md-10 col-md-offset-1">
			<h4 class="text text-warning">Loaness Details</h4>
			<hr class="hrDividerBetween">
			<label for="loaneeName">Loanee name</label>
			<input type="text" class="col-lg-12 form-control" disabled="disabled" value="<?php echo $fullname; ?>" id="loaneeName"/>
			<br><br><br><br>
			
			<label for="loaneeID">Loanee ID Number</label>
			<input type="text" class="col-lg-12 form-control" disabled="disabled" value="" id="loaneeID"/>
			
			
			<hr class="hrDividerDotted">
			<br><br>
			<h4 class="text text-warning">Guarantor Details</h4>
			<hr class="hrDividerBetween">
			
			<label for="guarantorDetails">Pick your guarantor</label>
			<select id='guarantorDetails' class="col-lg-12 form-control">
				<option value="">Choose your guarantor...</option>
				<?php
					
				?>
			</select>

			<input type="text" id="guarantorNameHolder" class="col-lg-12 form-control" style="display:none;"/>
			<hr class="hrDividerDotted">
			</br></br>

			<h4 class="text text-warning">Loan Details</h4>
			<hr class="hrDividerBetween">
			
			<label for="loanType">Loan type</label>
			<select id="loanType" class="col-lg-12 form-control">
				<option value="empty">Choose loan type...</option>
				<option value="compulsoryLoan">Compulsory loan (2000 Min - 7000 Max)</option>
				<option value="optionalLoan">Optional loan (5000 Min - [Loanee savings + guarantor savings] Max)</option>
			</select>
			<br><br><br><br>
			
			<input type="hidden" id="optionalLoanLimit"/>
			
			<label for="loanAmount" id="loanAmountHint">Loan amount</label>
			<input type="text" class="col-lg-12 form-control numberInputValidation" id="loanAmmount" placeholder="Enter loan amount."/>
			<hr class="hrDividerDotted">
			
			<br><br>
			<input type="button" class="btn btn-danger" value="Cancel" id="cancelLoanBtn"/>
			<input type="button" class="btn btn-success" value="Apply loan" id="applyLoanBtn"/>
		</div>
		<hr class="hrDividerBetween">
		
	</form><!-- end.loan.fill.in.form -->

</div>