<?php
	include 'session.php';
	$id = $_REQUEST['id'];
	$sql = "DELETE FROM users WHERE id = '$id'";
	if($conn->query($sql)){
		$_SESSION['success'] = 'User deleted successfully';
	}
	else{
		$_SESSION['error'] = $conn->error;
	}
	
	header('location: all-user.php');
	
?>