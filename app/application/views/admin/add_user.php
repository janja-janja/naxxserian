<div class="container offset-top">

	<div class="col-md-offset-3">
		<h4 class="col-md-3 btn btn-success">Add New Members</h4>
		<h4 class="col-md-3 btn btn-warning">Edit Details</h4>
		<h4 class="col-md-3 btn btn-danger">Delete Member</h4>
	</div>
	<br><br><br>
	<form method="POST" class="well col-md-10 col-md-offset-1" action="<?php echo base_url(); ?>admin_add_content/submit/add_user">

      <h4 class="highlighter-text">Member details</h4>
      <hr class="hrDividerBetween">
      <label for="first_name">First Name</label>
      <input type="text" class="col-lg-12 form-control" name="first_name" placeholder="First Name"/>
      
      <br><br><br><br>
      
      <label for="middle_name">Middle Name</label>
      <input type="text" class="col-lg-12 form-control" name="middle_name" placeholder="Middle Name"/>

      <br><br><br><br>
      <label for="surname">Surname</label>
      <input type="text" class="col-lg-12 form-control" name="surname" placeholder="Surname" />

      <br><br><br><br>
      <label for="email_address">Email Address</label>
      <input type="text" class="col-lg-12 form-control" name="email_address" placeholder="Email Address" />

      <br><br><br><br>
      <label for="id_number">ID Number</label>
      <input type="text" class="col-lg-12 form-control" name="id_number" placeholder="ID Number" />
      <br><br><br>
       <hr class="hrDividerBetween">

      <input type="submit" value="Register Member" class="btn btn-success btn-lg">
      
			
		</div>
		
	</form>

</div>