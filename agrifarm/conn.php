<?php
	//$conn = new mysqli('server126', 'neuoygiy_saifuddin', 'UIRI6Z4DlTg&', 'neuoygiy_farmers');
	$conn = new mysqli('localhost', 'root', '', 'farmers');
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>