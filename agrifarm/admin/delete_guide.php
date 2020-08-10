<?php
	include 'session.php';
	
	$id = $_REQUEST['id'];
	$sql = "DELETE FROM guide WHERE id = '$id'";
	if($conn->query($sql)){
		$_SESSION['success'] = 'Post deleted successfully';
	}
	else{
		$_SESSION['error'] = $conn->error;
	}
	
	header('location: all-guide.php');
	
?>