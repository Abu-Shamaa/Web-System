<?php
	session_start();
    include 'conn.php';
	if(isset($_POST['register'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$phone = $_POST['countryCode'] ."". $_POST['phone'];
		$role = $_POST['role'];
		$password = $_POST['password'];
		$passwordConfirmation = $_POST['passwordConfirmation'];

		if ($password == $passwordConfirmation)
		{
			$sql = "SELECT * FROM users WHERE email = '$email'";
			$query = $conn->query($sql);
			if($query->num_rows > 0){
				$_SESSION['error'] = 'Email already exists';
			}
			else{
				$row = $query->fetch_assoc();
				$sql = "INSERT INTO `users`(`email`, `password`, `firstname`, `lastname`, `phone`, `role`) VALUES ('$email', '$password', '$firstname', '$lastname', '$phone', '$role')";
				if($conn->query($sql)){
					$_SESSION['success'] = 'You are Registered Successfully';
				}
				else{
					$_SESSION['error'] = $conn->error;
				}
			}
		}
		else {
			$_SESSION['error'] = "Password does not match..!";
		}
	}

	header('location: register.php');

?>