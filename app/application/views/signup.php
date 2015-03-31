<div class="container offset-top">

	<form class="well col-md-6 offset-top col-md-offset-3" method="POST" action="<?php echo base_url();?>out/signup_validation" id="login-form-auth">
      		<span class="text text-danger strong"><?php echo validation_errors(); ?></span>
	      	
	        <h3 class="col-md-offset-4">Sign up Area</h3>
	        
	        <div class="form-group">
		        <label for="first_name">First Name</label>
		        <input type="text" class="col-md-12 form-control" placeholder="Enter Firstname" name="first_name" value="<?php echo($this->input->post('first_name')) ?>" id="first_name"/>
		        <br><br><br><br>
	     		 </div>

	     		 <div class="form-group">
		         <label>Surname</label>
		        <input type="text" class="col-md-12 form-control" placeholder="Enter Surname" name="surname" value="<?php echo($this->input->post('surname')) ?>"/>
		        <br><br><br><br>
		      </div>

		      <div class="form-group">
		        <label>ID Number</label>
		        <input type="text" class="col-md-12 form-control" placeholder="Enter ID number" name="id_number" value="<?php echo($this->input->post('id_number')) ?>"/>
		        <br><br><br><br>
		      </div>
	        
	        <div class="form-group">
		        <label>Email Address</label>
		        <input type="text" class="col-md-12 form-control" placeholder="Enter Email Address" name="email_address" value="<?php echo($this->input->post('email_address')) ?>"/>
		      </div>
	       
	        <br><br><br>

	        	<input type="submit" class="btn btn-lg btn-primary" value="Request Sign Up"/>
	        	&nbsp;&nbsp;&nbsp;
	        	
      </form>
</div>
