

<div class="jumbotron">

	<i class="fa fa-gavel fa-5x nax-header"></i>
	<h2 class="nax-header">
		Naxxserian Investment members validation point.
	</h2>

</div>
<div class="col-md well">
	<?php
		echo form_open('main/login_validation');
		echo validation_errors();

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


	?>
	<a href='<?php echo base_url()."main/signup"; ?>'>Sign up</a>
</div>
