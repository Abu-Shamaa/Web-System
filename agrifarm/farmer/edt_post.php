<?php
	include '../session.php';

	if(isset($_POST['edit_post'])) 
	{
		$id = $_POST['id'];
		$title = $_POST['title'];
		$name = $_POST['name'];
		$post_category = $_POST['post_category'];
		$amount = $_POST['amount'];
		$price = $_POST['price'];
		$phone = $_POST['phone'];
		$post_address = $_POST['post_address'];
		$post_zip = $_POST['post_zip'];
		$post_city = $_POST['post_city'];
		$post_country = $_POST['post_country'];
		$description = $_POST['description'];
		$filename = $_FILES['photo']['name'];

		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);
			$sql = "UPDATE post SET `post_photo`= '$filename' WHERE id = '$id' ";
			$conn->query($sql);
		}
		
		$sql = "UPDATE post SET post_title= '$title', post_name= '$name', post_category= '$post_category', post_amount= '$amount', post_price= '$price', post_phone= '$phone',  post_address= '$post_address', post_zip= '$post_zip', post_city= '$post_city', post_country= '$post_country',post_description= '$description' WHERE id = '$id' ";
		if($conn->query($sql)){ 
			$_SESSION['success'] = 'Post updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}

	header('location: post_edit.php?id='.$id.'');

?>