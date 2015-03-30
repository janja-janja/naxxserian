<div class="container offset-top">

	<form class="form-signin font-family" method="POST" action="<?php echo base_url();?>out/signup_validation" id="login-form-auth">
      		<span class="text text-danger strong"><?php echo validation_errors(); ?></span>
	      	
	        <h3 class="form-signin-heading visible-desktop">Sign up Area</h3>
	        
	        <label for="first_name">First Name</label>
	        <input type="text" class="input-block-level" placeholder="Enter Firstname" name="first_name" value="<?php echo($this->input->post('first_name')) ?>" id="first_name"/>

	         <label>Surname</label>
	        <input type="text" class="input-block-level" placeholder="Enter Surname" name="surname" value="<?php echo($this->input->post('surname')) ?>"/>

	         <label>ID Number</label>
	        <input type="text" class="input-block-level" placeholder="Enter ID number" name="id_number" value="<?php echo($this->input->post('id_number')) ?>"/>
	        
	         <label>Email Address</label>
	        <input type="text" class="input-block-level" placeholder="Enter Email Address" name="email_address" value="<?php echo($this->input->post('email_address')) ?>"/>
	       
	        
	        <br><br>
	        	<input type="submit" class="btn btn-large btn-success" value="Request Sign Up"/>
	        	&nbsp;&nbsp;&nbsp;
	        	
      </form>
</div>
