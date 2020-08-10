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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style type="text/css">
      nav .navbar .navbar-expand-lg {
        padding: 0;
      }
       li.nav-item.active {
        border-bottom: 3px solid #20a6ff;
      }
    </style>
    
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

<div class="container-fluid" style="min-height: 80vh;padding: 0 50px 0 50px;">
  <?php
    if(isset($_SESSION['error'])){
        echo '
            <!-- Error Alert -->
            <div class="alert alert-danger alert-dismissible fade show">
              <strong>Error!</strong> '.$_SESSION["error"].'.
            </div>
        ';
        unset($_SESSION['error']);
    }
    if(isset($_SESSION['success'])){
        echo '
            <div class="alert alert-success alert-dismissible fade show">
              <strong>Success!</strong> '.$_SESSION["success"].'.
            </div>
        ';
        unset($_SESSION['success']);
    }

  $usr = $_REQUEST['id'];
  $sql = "SELECT * FROM users WHERE id = '$usr' ";
  $query = $conn->query($sql);
  $row = $query->fetch_assoc();

  $photo = $row["profile_pic"];
  if($photo != "")
  {
    $img = $row["profile_pic"];
  }
  else
  {
    $img = "profile.jpg";
  }
  ?>
  <div class="row">
    <div class="col-md-3">
      <div class="card" style="box-shadow: 0 0 2px rgb(0,0,0,0.3);">
        <div class="card-header">UserName: <?php echo $row['email']; ?></div>
        <div class="card-body">
          <div class="col col-md-12 form-group">
            <img src="../images/<?php echo $img; ?>" alt="" id="preview" class="img-circle" style="border-radius: 50%;width: 100px; height: 100px;" />&emsp;<?php echo $row['firstname'], " ", $row['lastname']; ?>
            <form action ="update_profile.php" method="post" id="image-form" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
              <center class="form-group">
                <input type="file" name="usrphoto" class="file" accept="image/*" style="visibility: hidden;" value="<?php echo $row['profile_pic']; ?>">
                <div class="input-group my-3">
                  <input type="text" class="form-control" disabled placeholder="Change Profile Photo" id="file">
                  <div class="input-group-append">
                    <button type="button" class="browse btn btn-primary">UPLOAD</button>
                  </div>
                </div>
                <br />
              </center>
              <center class="form-group">
                <button type="submit" name="profilepic" class="btn btn-info"><i class="fa fa-check"></i> Save Profile Photo</button>
              </center>
            </form>

            
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-7" style="padding: 20px;box-shadow: 0 0 10px rgb(0,0,0,0.3);">
      <form method="POST" action="update_profile.php" style="max-width: 800px;">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <div class="col col-md-12 form-group">
          <label for="firstname" class="text-muted">First Name:</label>
          <input type="text" class="form-control text-muted" name="firstname" placeholder="Enter First Name" id="firstname" value="<?php echo $row['firstname']; ?>">
        </div>
        <div class="col col-md-12 form-group">
          <label for="lastname" class="text-muted">Last Name:</label>
          <input type="text" class="form-control text-muted" name="lastname" placeholder="Enter Last Name" id="lastname" value="<?php echo $row['lastname']; ?>">
        </div>
        <div class="col col-md-12 form-group">
          <label for="phone" class="text-muted">Phone:</label>
          <input type="text" class="form-control text-muted" name="phone" placeholder="Enter Phone" id="phone" value="<?php echo $row['phone']; ?>">
        </div>
        <div class="col col-md-12 form-group">
          <label for="address" class="text-muted">Address:</label>
          <input type="text" class="form-control text-muted" name="address" placeholder="Enter Address" id="address" value="<?php echo $row['address']; ?>">
        </div>

        <div class="col col-md-12 form-group">
          <label for="zipcode" class="text-muted">Zip Code:</label>
          <input type="number" class="form-control text-muted" name="zipcode" placeholder="Enter Zip Code" id="zipcode" value="<?php echo $row['zipcode']; ?>">
        </div>
        <div class="col col-md-12 form-group">
          <label for="state" class="text-muted">State:</label>
          <input type="text" class="form-control text-muted" name="state" placeholder="Enter State" id="state" value="<?php echo $row['state']; ?>">
        </div>

        <div class="col col-md-12 form-group">
          <label for="country" class="text-muted">Country:</label>
          <input type="text" class="form-control text-muted" name="country" placeholder="Enter Country" id="country" value="<?php echo $row['country']; ?>">
        </div>

        <div class="col col-md-12 form-group">
          <button type="submit" name="info" class="btn btn-info"><i class="fa fa-check"></i> Save Info</button>
        </div>

      </form>
    </div>


    <div class="col-md-2 form-group">
      <div class="card-body"  style="padding: 10px;box-shadow: 0 0 20px rgb(0,0,0,0.3);border-radius: 15px;">
        <div class="card-header">Admin Portal</div><br>
        <div class="card-text">
          <a href="home.php" class="btn btn-info">Manage Farmers Post</a>
        </div>
        <div class="card-text">
          <a href="all-user.php" class="btn btn-default">Manage Users</a>
        </div>
        <div class="card-text">
          <a href="all-guide.php" class="btn btn-default">Manage Farming Guide</a>
        </div>
        <div class="card-text">
          <a href="add-guide.php" class="btn btn-default">Add Farming Guide</a>
        </div>
      </div>
    </div>

  </div>
</div>
<br>
<?php include '../footer.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<script type="text/javascript">
  $(document).on("click", ".browse", function() {
    var file = $(this).parents().find(".file");
    file.trigger("click");
  });
  $('input[type="file"]').change(function(e) {
    var fileName = e.target.files[0].name;
    $("#file").val(fileName);

    var reader = new FileReader();
    reader.onload = function(e) {
      // get loaded data and render thumbnail.
      document.getElementById("preview").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
  });
</script>
</body>
</html>