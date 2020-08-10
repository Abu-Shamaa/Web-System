<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
</head>
<body>
<?php
    session_start();
    include 'conn.php';
	if(isset($_POST['login'])){
		$email = $_POST['email'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM users WHERE email = '$email'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'Cannot find account with the email';
			header('location:  login.php');
		}
		else{
			$row = $query->fetch_assoc();
			if($row['email']==$email and $row['password']==$password){
				$_SESSION['user'] = $row['id'];

				$sql = "SELECT * FROM users WHERE id = '".$_SESSION['user']."'";
				$query = $conn->query($sql);
				$user = $query->fetch_assoc();

				if($user['role'] == 1)
    			{
				echo '<script>swal("Login successful!", "Your are logged in successfully!", "success"); 
				        window.setTimeout(function(){
                            // Move to a new location or you can do something else
                            window.location.href = "farmer";
                    
                        }, 1500);
				      </script>';
				}
				else if($user['role'] == 2) {
					echo '<script>swal("Login successful!", "Your are logged in successfully!", "success"); 
				        window.setTimeout(function(){
                            // Move to a new location or you can do something else
                            window.location.href = "buyer";
                    
                        }, 1500);
				      </script>';
				}
			}
			else{
				$_SESSION['error'] = 'Incorrect password';
				header('location: login.php');
			}
		}
		
	}
	else{
		$_SESSION['error'] = 'Input credentials first';
		header('location: login.php');
	}
?>