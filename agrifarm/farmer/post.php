<?php
	include '../session.php';

	if(isset($_POST['post'])) 
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
		
		date_default_timezone_set("Asia/Kuala_Lumpur");
		$time_posted = date('Y-m-d H:i:s');

		if(!empty($filename)) {
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}
		
		$sql = "INSERT INTO `post`(`user_id`, `time_posted`, `post_title`, `post_name`, `post_category`, `post_amount`, `post_price`, `post_phone`, `post_address`, `post_zip`, `post_city`, `post_country`, `post_description`, `post_photo`) VALUES ('$id', '$time_posted', '$title', '$name', '$post_category', '$amount', '$price', '$phone', '$post_address', '$post_zip', '$post_city', '$post_country', '$description', '$filename')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Post added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}

	header('location: all-post.php');

?>