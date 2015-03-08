<html>
<head>
	<title>Naxxserian Members</title>
</head>
<body>
	<h3>Members area.</h3>
	<div class="nax-login">
		<?php
		echo "<pre>";
			print_r($this->session->all_userdata());
		echo "</pre>";
		?>

		<a href='<?php echo base_url()."main/logout" ?>'>Logout</a>
	</div>

</body>
</html>