<?php
	//  replace mysqllogin and mysqlpassword with your own
	$conn = mysqli_connect("127.0.0.1", "root", "", "db5");

	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}

?>
