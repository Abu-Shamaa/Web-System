<?php
if(isset($_POST['submit_password']))
{
  include 'conn.php';
  $email=$_POST['email'];
  $password=$_POST['password'];
  $sql="update users set password='$password' where email='$email'";
  mysqli_query($conn,$sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Main css -->
    <link rel="stylesheet" href="css/custom.css">
</head>
<!-- Navbar-->
<header class="header">
    <nav class="navbar navbar-expand-lg navbar-light py-3" style="box-shadow: inset 1px 1px 0 rgba(0,0,0,.1), inset 0 -1px 0 rgba(0,0,0,.07); ">
        <div class="container">
            <!-- Navbar Brand -->
            <a href="index.php" class="navbar-brand" style="padding: 0;">
                <img src="images/logo.png" alt="logo" width="50px" height="50px">
                <h3 class="display-4" style="line-height: 5px;font-size: 18px; font-style: italic; ">Daily Agri Farm</h3>
            </a>
        </div>
    </nav>
</header>


<body>
<section class="container">
	<br>
	<br>
	<div class="row justify-content-center">
		<h4 class="header_h4">Your Passworword has been reset. <br><br><a href="index.php">Go Back and Login</a></h4><br>
	</div>
	
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>