<?php
	include 'session.php';

	if(isset($_POST['post'])) 
	{
		$post_category = $_POST['post_category'];
		$subcategory = $_POST['subcategory'];
		$title = $_POST['title'];
		$announcement = htmlspecialchars($_POST['announcement'], ENT_QUOTES);
        date_default_timezone_set("Asia/Kuala_Lumpur");
		$dateposted = date('Y-m-d H:i:s');

		$sql = "INSERT INTO `guide`(`post_category`, `subcategory`, `title`, `announcement`, `dateposted`) VALUES ('$post_category', '$subcategory', '$title', '$announcement', '$dateposted')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Post added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}

	else if(isset($_POST['editpost'])) 
	{
	    $id = $_POST['id'];
		$post_category = $_POST['post_category'];
		$subcategory = $_POST['subcategory'];
		$title = $_POST['title'];
		$announcement = htmlspecialchars($_POST['announcement'], ENT_QUOTES);


		$sql = "UPDATE `guide` SET `post_category` = '$post_category', `subcategory` = '$subcategory', `title` = '$title', `announcement` ='$announcement' WHERE id = '$id' ";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Post Edited successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);

?>