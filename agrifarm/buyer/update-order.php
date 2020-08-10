<?php
include '../session.php';
$id = $_REQUEST["cid"];

$sql = "UPDATE order_item SET status = 3 WHERE id = '$id'";
$conn->query($sql); 
header('location: view-order.php?id='.$id);
?>