<?php
  include 'session.php';
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
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="box-shadow: inset 1px 1px 0 rgba(0,0,0,.1), inset 0 -1px 0 rgba(0,0,0,.07); ">
  <div class="container">
      <a class="navbar-brand" href="index.php" style="font-style: italic;">
        <img src="../images/logo.png" alt="logo" width="50px" height="50px">
        Daily Agri Farm
      </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="nav navbar-nav ml-auto">
      <?php
        $photo = $user["profile_pic"];
        if($photo != "")
        {
          $img = $user["profile_pic"];
        }
        else
        {
          $img = "profile.jpg";
        }
      ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="../images/<?php echo $img; ?>" alt="" class="img-circle" style="border-radius: 50%;width: 25px; height: 25px;" /> <?php echo $user['firstname'], " ", $user['lastname']; ?>
        </a>
        <div class="dropdown-menu text-center" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">
            <img src="../images/<?php echo $img; ?>" alt="" class="img-circle" style="border-radius: 50%;width: 80px; height: 80px;" />
            <p><br /><?php echo $user['firstname'], " ", $user['lastname']; ?></p>
            <div class="dropdown-divider"></div>
            <h5>Member Since<br /></h5>
            <p><?php echo date_format(date_create($user['member_since']), 'd M Y'); ?></p>
          </a>
          <div class="dropdown-divider"></div>
          <div class="dropdown-item">
            <a class="btn btn-info" href="profile.php">
              <i class="fa fa-user"></i> View Profile
            </a>
            <a class="btn btn-danger" href="../logout.php">
              <i class="fa fa-sign-out"></i> Sign Out
            </a>
          </div>
        </div>
      </li>
    </ul>
  </div>
</nav>
</header>

<body>
<br>

<div class="container-fluid" style="padding: 0 50px 10px 50px;min-height:80vh;">
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
<div class="row">
<div class="col-md-2 form-group">
  <div class="card-body"  style="padding: 10px;box-shadow: 0 0 20px rgb(0,0,0,0.3);border-radius: 15px;">
    <div class="card-header">Admin Portal</div><br>
    <div class="card-text">
      <a href="home.php" class="btn btn-default">Manage Farmers Post</a>
    </div>
    <div class="card-text">
      <a href="all-user.php" class="btn btn-default">Manage Users</a>
    </div>
    <div class="card-text">
      <a href="all-guide.php" class="btn btn-default">Manage Farming Guide</a>
    </div>
    <div class="card-text">
      <a href="add-guide.php" class="btn btn-info">Add Farming Guide</a>
    </div>
  </div>
</div>

<div class="col-md-10 form-group" style="padding: 20px;box-shadow: 0 0 5px rgb(0,0,0,0.3);">
 <form action="post.php" method="POST" enctype="multipart/form-data">
  <div class="row">
      <h3 class="col-md-12 form-group text-muted">Add Farming Guide</h3>

      <div class="col-md-6 form-group">
        <label for="name" class="text-muted">Category:</label>
        <select name="post_category" class="form-control text-muted" id="post_category" required>
          <option value="">Select Category</option>
          <option value="Season" id="Season" onclick="myFunction()">Season</option>
          <option value="Farming Vegetables">Farming Vegetables</option>
          <option value="Farming Fruits">Farming Fruits</option>
          <option value="Farming Grains">Farming Grains</option>
          <option value="Farming Others">Farming Others</option>
        </select>
      </div>

      <div class="col-md-6 form-group">
        <label for="subcategory" class="text-muted">Sub Category:</label>
        <input type="text" class="form-control text-muted" name="subcategory" placeholder="Enter Sub Category" id="subcategory" required>
      </div>

      <div class="col-md-12 form-group">
        <label for="title" class="text-muted">Post Title:</label>
        <input type="text" class="form-control text-muted" name="title" placeholder="Enter Post Title" id="title" required>
      </div>

      <div class="col-md-12 form-group">
        <textarea id="announcement" name="announcement" style="width: 100%; min-height: 200px;" placeholder="What is on your mind?" required></textarea>

        <br>

        <div class="form-group">
          <br>
          <button type="submit" class="btn btn-success btn-sm btn-flat" name="post" style="background: #0b7676;"><i class="fa fa-check"></i> POST</button>
        </div>
      </div>

      
      

    </div>
  </form>
</div>
</div>
</div>
<br>
<?php include '../footer.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'announcement' );
</script>
</body>
</html>
