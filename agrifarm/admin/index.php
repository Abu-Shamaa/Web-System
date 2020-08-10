<?php
  session_start();
  include 'conn.php';
  if(isset($_SESSION['admin'])){
    header('location: home.php');
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
    <link rel="stylesheet" href="../css/custom.css">
</head>
<!-- Navbar-->
<header class="header">
    <nav class="navbar navbar-expand-lg navbar-light py-3" style="box-shadow: inset 1px 1px 0 rgba(0,0,0,.1), inset 0 -1px 0 rgba(0,0,0,.07); ">
        <div class="container">
            <!-- Navbar Brand -->
            <a href="" class="navbar-brand" style="padding: 0;">
                <img src="../images/logo.png" alt="logo" width="50px" height="50px">
                <h3 class="display-4" style="line-height: 5px;font-size: 18px; font-style: italic; ">Daily Agri Farm</h3>
            </a>
        </div>
    </nav>
</header>

<body>
<div class="container-fluid">
<?php
    if(isset($_SESSION['error'])){
        echo '
            <!-- Error Alert -->
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>Error!</strong> '.$_SESSION["error"].'.
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        ';
        unset($_SESSION['error']);
    }
    if(isset($_SESSION['success'])){
        echo '
            <div class="alert alert-success alert-dismissible fade show">
                <strong>Success!</strong> '.$_SESSION["success"].'.
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        ';
        unset($_SESSION['success']);
    }
?>
    <div class="row no-gutter">
        <!-- The image half -->
        <div class="col-md-5 d-none d-md-flex bg-image" style="background-image: url('../images/login-bg.jpg');"></div>


        <!-- The content half -->
        <div class="col-md-7 bg-light">
            <div class="login d-flex align-items-center py-5">

                <!-- Demo content-->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-xl-7 mx-auto">
                            <h3 class="display-4">Admin Sign in!</h3>
                            <p class="text-muted mb-4">Login to the admin account providing the details below..</p>
                            <form action="signin.php" method="POST">

                                <div class="form-group mb-3">
                                    <input id="email" name="email" type="email" placeholder="Email address" required="" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4">
                                </div>
                                <div class="form-group mb-3">
                                    <input id="password" name="password" type="password" placeholder="Password" required="" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary">
                                </div>
                                <!--<div class="custom-control custom-checkbox mb-3">
                                    <input id="customCheck1" type="checkbox" checked class="custom-control-input">
                                    <label for="customCheck1" class="custom-control-label">Remember password</label>
                                </div>-->
                                <button type="submit" name="login" id="submitbtn" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm">Sign in</button>

                                <div class="form-group">
                                    <p class="text-center" style="color: red; font-size: 13px;"><?php if(isset($_SESSION['error'])) {echo $_SESSION['error']; } ?></p>
                                </div>

                            </form>
                        </div>
                    </div>
                </div><!-- End -->

            </div>
        </div><!-- End -->

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<script>
$(document).ready(function () {
    $("form").submit(function () {
        setTimeout(function () { disableButton(); }, 0);
    });
    
    function disableButton() {
        $("#submitbtn").prop('disabled', true);
        $("#submitbtn").prop('value', 'Signing in...');
    }
    
    $('#submitbtn').click(function() {
    //Now just reference this button and change CSS
    $(this).css('background-color','#4caf50');
});
});
</script>

</body>
</html>
