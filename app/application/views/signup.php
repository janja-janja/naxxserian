
<h3>Sign up here</h3>
<div class="nax-signup">
	<?php
		echo form_open('main/signup_validation');
		echo validation_errors();

		echo"<p>ID number: ";
		echo form_input('id_number', $this->input->post('id_number'));
		echo "</p>";

		echo"<p>Password: ";
		echo form_password('password');
		echo "</p>";

		echo"<p>Confirm Password: ";
		echo form_password('conf_password');
		echo "</p>";

		echo"<p>";
		echo form_submit('signup_submit', 'Sign up');
		echo "</p>";

		echo form_close();


	?>
	<a href='<?php echo base_url()."main/login"; ?>'>Login</a>
</div>
