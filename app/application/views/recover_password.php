<?php 
	/*Enable password reset from email link*/
?>
<div class="container offset-top">
      
      <form class="well form-group offset-top col-md-5" method="POST" action="<?php echo base_url();?>">
      		<span class="text text-danger"><?php echo validation_errors(); ?></span>
	      	
	        <h3 class="form-signin-heading visible-desktop"><i class="fa fa-lock"></i>Reset password</h3>
	        
	        <label for="reset_new_password">New password</label> 
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-lock"></i></span>
				<input type="password" id="reset_new_password" class="form-control" name="reset_new_password">
			</div>
			<br>

			<label for="conf_reset_new_password">Confirm New password</label> 
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-lock"></i></span>
				<input type="password" id="conf_reset_new_password" class="form-control" name="conf_reset_new_password">
			</div>
			<br>

			
	       	<input type="submit" class="btn btn-lg btn-danger btn-block" value="Reset password">
	      
	        
      </form>
      
     
 </div>	
