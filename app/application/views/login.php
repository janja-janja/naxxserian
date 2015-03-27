

<!-- <div class="col-md well">
	<?php
/*		echo form_open('main/login_validation');

		echo"<p>ID number: ";
		echo form_input('id_number', $this->input->post('id_number'));
		echo "</p>";

		echo"<p>Password: ";
		echo form_password('password');
		echo "</p>";

		echo"<p>";
		echo form_submit('login_submit', 'Login');
		echo "</p>";

		echo form_close();

*/
	?>
	
</div> -->


<!--***SIGN-IN-FORM***-->
	 <div class="container offset-top">
	      <form class="form-signin font-family" method="POST" action="<?php echo base_url();?>main/login_validation" id="login-form-auth">
	      		<span class="text text-danger"><?php echo validation_errors(); ?></span>
		      	
		        <h3 class="form-signin-heading visible-desktop">Login area</h3>
		        Username:<input type="text" class="input-block-level" placeholder="Enter ID number" name="id_number" value="<?php echo($this->input->post('id_number')) ?>"/>
		        
		        Password:<input type="password" class="input-block-level" placeholder="Password" name="password"/>
		       
		        
		        <br><br>
		        <div>
		        	<input type="submit" class="btn btn-large btn-success" value="Login">&nbsp;&nbsp;&nbsp;
		        	 <a href="<?php echo base_url();?>main/reset_password" class="footer-text">Forgot password?</a>
		       </div>
		        
	      </form>
	      
	     
	 </div>	
	 <!--***END>SIGN-IN-FORM***-->	
