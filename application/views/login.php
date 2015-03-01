<html>
<head>
	<title>Naxxserian Login</title>
</head>
<body>
	<h3>Please login...</h3>
	<div class="nax-login">
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

</body>
</html>