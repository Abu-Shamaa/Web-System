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
	include '../session.php';

	if(isset($_POST['checkout'])) 
	{
	    date_default_timezone_set("Asia/Kuala_Lumpur");
		$order_no = abs( crc32( uniqid() ) );
		$order_date = date('Y-m-d H:i:s');
		$product_id = $_POST['product_id'];
		$product = $_POST['product'];
		$seller_id = $_POST['seller_id'];
		$qty = $_POST['qty'];
		$priceperkg = $_POST['priceperkg'];
		$totalprice = $_POST['priceperkg'] * $_POST['qty'];
		$buyer_id = $_POST['buyer_id'];

		$card = $_POST['card'];
		$ccname = $_POST['ccname'];
		$ccnumber = $_POST['ccnumber'];
		$ccexpiration = $_POST['ccexpiration'];
		$cccvv = $_POST['cccvv'];

		$address = $_POST['address'];
		$zipcode = $_POST['zipcode'];
		$country = $_POST['country'];
		$state = $_POST['state'];

		$sql = "UPDATE users SET address='$address', zipcode='$zipcode', country='$country', state='$state' WHERE id = '$buyer_id' ";
		$conn->query($sql); 

		$sql = "SELECT * FROM post WHERE id = '$product_id' ";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();
		$tot_amount = $row['post_amount'];

		$sql = "INSERT INTO `order_item`(`product_id`, `order_no`, `order_date`, `product`, `seller_id`, `qty`, `priceperkg`, `totalprice`, `buyer_id`, `card`, `name_on_card`, `card_no`, `exp_date`, `cvv`, `status`) VALUES ('$product_id', '$order_no', '$order_date', '$product', '$seller_id', '$qty', '$priceperkg', '$totalprice', '$buyer_id', '$card', '$ccname', '$ccnumber', '$ccexpiration', '$cccvv', '1')";
		if($conn->query($sql)){ 
			$_SESSION['success'] = 'Item Ordered successfully';
			
			$rest_amount = $tot_amount - $qty;
			$sql = "UPDATE post SET post_amount='$rest_amount' WHERE id = '$product_id'  ";
			$conn->query($sql);

			echo '<script>
					    setTimeout(function() {
					        swal({
					            title: "Payment successful!",
					            text: "Item Ordered successfully!",
					            type: "success",
					            confirmButtonColor: "#5cb85c",
            					confirmButtonText: "Proceed to Print"
					        }, function() {
					            window.location = "order-receipt.php?uid='.$order_no.'";
					        });
					    }, 500);
					</script>';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
?>