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
<?php
  $id = $_REQUEST['id'];
  $sql = "SELECT * FROM post WHERE id = '$id' ";
  $query = $conn->query($sql);
  $row = $query->fetch_assoc();
?>
<div class="container" style="padding: 30px;box-shadow: 0 0 10px rgb(0,0,0,0.3);">
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
  <form action="edt_post.php" method="POST" enctype="multipart/form-data">
    <div class="row">
      <input type="hidden" name="id" value="<?php echo $id; ?>">

      <div class="col col-md-12 form-group">
        <div class="">
          <img src="../images/<?php echo $row['post_photo']; ?>" alt="" id="preview" class="img-responsive" style="max-width: 245px; max-height: 165px;">
        </div>
        <div class="">
          <div id="msg"></div>
          <form method="post" id="image-form">
            <input type="file" name="photo" class="file" accept="image/*" style="visibility: hidden;">
            <div class="input-group my-3">
              <input type="text" class="form-control" disabled placeholder="Change Image" id="file">
              <div class="input-group-append">
                <button type="button" class="browse btn btn-primary">Change...</button>
              </div>
            </div>
          </form>
        </div>
        
      </div>


      <div class="col col-md-12 form-group">
        <label for="title" class="text-muted">Post Title:</label>
        <input type="text" class="form-control text-muted" name="title" placeholder="Enter Post Title" id="title" value="<?php echo $row['post_title']; ?>">
      </div>

      <div class="col col-sm-12 form-group">
        <label for="name" class="text-muted">Name of Crop:</label>
        <input type="text" name="name" class="form-control text-muted" placeholder="Enter Name of Crop" id="name" value="<?php echo $row['post_name']; ?>">
      </div>

      <div class="col col-sm-6 form-group">
        <label for="name" class="text-muted">Category:</label>
        <select name="post_category" class="form-control text-muted" id="post_category" required>
          <option value="">Select Category</option>
          <option value="Vegetables" <?php if($row['post_category'] == "Vegetables") { echo 'selected ="selected"'; } ?> >Vegetables</option>
          <option value="Fruits" <?php if($row['post_category'] == "Fruits") { echo 'selected ="selected"'; } ?> >Fruits</option>
          <option value="Grains" <?php if($row['post_category'] == "Grains") { echo 'selected ="selected"'; } ?> >Grains</option>
          <option value="Others" <?php if($row['post_category'] == "Others") { echo 'selected ="selected"'; } ?> >Others</option>
        </select>
      </div>

      <div class="col col-sm-6 form-group">
        <label for="amount" class="text-muted">Amount (in kg):</label>
        <input type="number" name="amount" class="form-control text-muted" placeholder="Enter amount (in kg)" id="amount" value="<?php echo $row['post_amount']; ?>">
      </div>

      <div class="col col-sm-6 form-group">
        <label for="price" class="text-muted">Price (Per KG):</label>
        <input type="number" name="price" class="form-control text-muted" placeholder="Enter Price (৳)" id="price" value="<?php echo $row['post_price']; ?>">
      </div>

      <div class="col col-sm-6 form-group">
        <label for="phone" class="text-muted">Contact No:</label>
        <input type="text" name="phone" class="form-control text-muted" placeholder="Enter Contact No." id="phone" value="<?php echo $row['post_phone']; ?>">
      </div>

      <div class="col col-sm-12 form-group">
        <label for="post_address" class="text-muted">Address:</label>
        <input type="text" name="post_address" class="form-control text-muted" placeholder="Enter Street Address" id="post_address" value="<?php echo $row['post_address']; ?>" required>
      </div>

      <div class="col col-sm-4 form-group">
        <label for="post_zip" class="text-muted">Zip:</label>
        <input type="number" name="post_zip" class="form-control text-muted" placeholder="Enter ZipCode" id="post_zip" value="<?php echo $row['post_zip']; ?>" required>
      </div>

      <div class="col col-sm-4 form-group">
        <label for="post_city" class="text-muted">City:</label>
        <input type="text" name="post_city" class="form-control text-muted" placeholder="Enter City Name" id="post_city" value="<?php echo $row['post_city']; ?>" required>
      </div>

      <div class="col col-sm-4 form-group">
        <label for="post_country" class="text-muted">Country:</label>
        <input type="text" name="post_country" class="form-control text-muted" placeholder="Enter Country" id="post_country" value="<?php echo $row['post_country']; ?>" required>
      </div>



      <div class="col col-md-12 form-group">
        <label for="description" class="text-muted">Description:</label>
        <textarea type="text" rows="5" cols="10" name="description" class="form-control text-muted" placeholder="Write Description here" id="description" ><?php echo $row['post_description']; ?></textarea>
      </div>

      <div class="col col-md-12 form-group">
        <button type="submit" id="submitbtn" name="edit_post" class="btn btn-primary float-right"><i class="fa fa-check"></i> SAVE CHANGES</button>
      </div>

    </div>
  </form>
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
