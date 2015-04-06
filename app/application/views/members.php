
<!-- Members intial point in the system. Their profile -->
<div class="container offset-top">
	<h3 class="col-lg-offset-5"><i class="fa fa-edit"></i>Edit Profile</h3>

	<div class="well col-md-10 col-md-offset-1">
		<!-- Photo details -->
		<?php 
			
			if($this->uri->segment(2) == "change_password")
			{
				echo $password_feedback;
			}

			if($this->uri->segment(2) == "upload")
			{
				echo $photo_feedback;
			}
			

			$logged_in_member = $this->session->all_userdata()["id_number"];

			$firstname = $this->model_users->get_details('first_name', $logged_in_member);
			$middlename = $this->model_users->get_details('middle_name', $logged_in_member);
			$surname = $this->model_users->get_details('surname', $logged_in_member);
			$photoname = $this->model_users->get_details('photo', $logged_in_member);


			$fullname = ucfirst($firstname).' '.ucfirst($middlename).' '.ucfirst($surname);
		?>

		<h4><i class="fa fa-camera"></i>Photo Details</h4>
		<span class="text text-danger">
			<?php 

			if($this->uri->segment(2) == "upload")
			{
				echo validation_errors(); 
			}

			?>

		</span>
		<img src="<?php echo base_url().'images/'.$photoname ;?>" class="img img-circle img-responsive" width="150">
		<form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>auth/upload">
			<input type="file" name="user_image"/>
			<h5 class='picture-msg'>Upload a picture to be your avatar.</h5>
			<h6 class='picture-msg-small'>Allowed Formats: jpg, jpeg, png</h6>
			<input type='submit' name='change_photo' value='Change picture' class='btn btn-primary'/>
		</form>
		<hr class="hrDividerBetween">

		<!-- Personal info -->
		<h4><i class="fa fa-user"></i>Personal Information</h4>
		<label for="first_name">Full Name</label> 
		<input type="text" id="first_name" class="col-lg-12 form-control" value="<?php echo $fullname; ?>" disabled>
		<br><br><br><br>

		<hr class="hrDividerBetween">

		<!-- Change password -->
		<h4><i class="fa fa-lock"></i>Change Password</h4>
		<span class="text text-danger">
			<?php 

			if($this->uri->segment(2) == "change_password")
			{
				echo validation_errors(); 
			}

			?>

		</span>
		<form method="POST" class="form-group" action="<?php echo base_url();?>auth/change_password" id="scroll-to-password-field">
			<label for="old_password">Old Password</label> 
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-lock"></i></span>
				<input type="password" id = "member_old_password" name="member_old_password" class="col-lg-12 form-control">
			</div>
			<br>

			
			<label for="new_password">New password</label> 
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-lock"></i></span>
				<input type="password" name="member_new_password" class="col-lg-12 form-control">
			</div>
			<br>
			
			<label for="conf_new_password">Confirm New password</label> 
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-lock"></i></span>
				<input type="password" name="member_conf_new_password" class="col-lg-12 form-control">
			</div>
			<br>

			<input type='submit' name='change_password_btn' value='Change Password' class='btn btn-danger'/>
		</form>

	</div>

</div>

