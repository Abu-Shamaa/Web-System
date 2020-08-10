<?php
if($_GET['key'] && $_GET['reset'])
{
  include 'conn.php';
  $email=$_GET['key'];
  $pass=$_GET['reset'];
  $select="select email,password from users where email='$email' and md5(password)='$pass'";
  $row1 = $conn->query($select);
  if($row1->num_rows==1)
  {
    $row=mysqli_fetch_array($row1);
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
  <section class="row justify-content-center">
    <form method="post" action="submit_new.php">
    <input type="hidden" name="email" value="<?php echo $email;?>">
    <h3><br>Enter New password<br></h3>
    <div class="form-group">
        <input style="font-size: 14px;" type="password" class="form-control" name="password" placeholder="Type your Password" required="required">
    </div>
    <div class="form-group">
    <br><input type="submit" name="submit_password" class="btn btn-primary btn-block btn-lg">
    </div>
    </form>
  </section>

</section>
    <?php
  }
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>