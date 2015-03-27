
<!-- Members intial point in the system. Their profile -->
<div class="container offset-top">
	<h3><i class="fa fa-edit"></i>Edit Profile</h3>

	<div class="well col-lg-10">
		<!-- Photo details -->
		<h4><i class="fa fa-camera"></i>Photo Details</h4>
		<img src="#" class="img img-responsive img-polaroid">
		<form method="POST" enctype="multipart/form-data">
			<input type="file" name="user_image"/>
			<h5 class='picture-msg'>Upload a picture to be your avatar.</h5>
			<h6 class='picture-msg-small'>Allowed Formats: jpg, jpeg, png</h6>
			<input type='submit' name='change_photo' value='Change picture' class='btn btn-primary'/>
		</form>
		<hr class="hrDividerBetween">

		<!-- Personal info -->
		<h4><i class="fa fa-user"></i>Personal Information</h4>
		<label for="first_name">First Name:</label> 
		<input type="text" id="first_name" class="col-lg-12 form-control">
		<br><br><br><br>

		<label for="middle_name">Middle Name:</label> 
		<input type="text" id="middle_name" class="col-lg-12 form-control">
		<br><br><br><br>

		<label for="surname">Surname:</label>  
		<input type="text" id="surname"class="col-lg-12 form-control"> 
		<br><br><br><br> 
		<hr class="hrDividerBetween">

		<!-- Change password -->
		<h4><i class="fa fa-lock"></i>Change Password</h4>
		<form method="POST" class="form-group">
			<label for="old_password">Old Password</label> 
			<input type="text" id="old_password" class="col-lg-12 form-control">
			<br><br><br><br>

			<label for="new_password">New password</label> 
			<input type="text" id="new_password" class="col-lg-12 form-control">
			<br><br><br><br>

			<label for="conf_new_password">Confirm New password</label> 
			<input type="text" id="conf_new_password" class="col-lg-12 form-control">
			<br><br><br><br>

			<input type='submit' name='change_password_btn' value='Change Password' class='btn btn-danger'/>
		</form>

	</div>

</div>

