<?php 
	/*Enable password reset from email link*/
?>
 <div class="container offset-top">
      <form class="form-signin font-family form-group" method="POST" action="<?php echo base_url();?>out/update_password" id="login-form-auth">
      		<span class="text text-danger"><?php echo validation_errors(); ?></span>
	      	
	       <h3 class="form-signin-heading visible-desktop"><i class="fa fa-lock"></i>Reset password</h3>

	        New Password:
	        <input type="text" class="input-block-level" placeholder="Enter New Password" name="new_password"/>
	        
	        Confirm New Password:
	        <input type="password" class="input-block-level" placeholder="Confirm New Password" name="conf_new_password"/>
	       
	        <br><br>
	        <div>
	        	<input type="submit" class="btn btn-large btn-success" value="Reset Password">&nbsp;&nbsp;&nbsp;
	       </div>
	        
      </form>
      
 </div>	

