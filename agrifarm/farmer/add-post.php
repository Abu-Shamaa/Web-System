<?php
  include '../session.php';
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
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="all-order.php">Products</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Farming Guide
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="seasons.php">Seasons</a>
          <a class="dropdown-item" href="farming-vegetable.php">Vegetable Farmings</a>
          <a class="dropdown-item" href="farming-fruits.php">Fruit Farmings</a>
          <a class="dropdown-item" href="farming-grain.php">Grain Farmings</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="farming-others.php">Other Farmings</a>
        </div>
      </li>

      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Promotions
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="add-post.php">Add Promotions</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="all-post.php">All Promotions</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-bell-o"></i>
          <?php
          // Select queries
          $sql = "SELECT * FROM order_item WHERE seller_id = '".$user['id']."' AND status =1 ORDER BY order_date desc";
          $query = $conn->query($sql);
          $num_notifications = mysqli_num_rows($query);

          if (!mysqli_num_rows($query)) {
            echo '';
          }
          else {
          ?>
            <sup class="badge badge-warning"><?php echo $num_notifications; ?></sup>
          <?php
            }
          ?>
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php 
          while ($row = $query->fetch_assoc())
          {
          ?>
          <a class="dropdown-item" href="approve_order.php?id=<?php echo $row['id']; ?>" style="background: #f6f6f6;">
            <strong>New Order </strong>&emsp;<span style="font-style: italic;"><?php echo $row['order_date'];?></span><br>
            <?php echo $row['qty'], " kg ", $row['product'];?>  
          </a>
          <div class="dropdown-divider"></div>
          <?php
          }
          ?>
          <a class="dropdown-item text-center" href="orders.php">See All Order</a>
        </div>
      </li>

      &nbsp;

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
      </li>
    </ul>
  </div>
</nav>
</header>

<body>
<br>
<?php
if($user['role'] == 1)
{
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

 <form action="post.php" method="POST" enctype="multipart/form-data">
  <div class="row">
      <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
      <div class="col col-md-12 form-group">
        <label for="title" class="text-muted">Post Title:</label>
        <input type="text" class="form-control text-muted" name="title" placeholder="Enter Post Title" id="title" required>
      </div>

      <div class="col col-sm-12 form-group">
        <label for="name" class="text-muted">Name of Crop:</label>
        <input type="text" name="name" class="form-control text-muted" placeholder="Enter Name of Crop" id="name" required>
      </div>


      <div class="col col-sm-6 form-group">
        <label for="name" class="text-muted">Categories:</label>
        <select name="post_category" class="form-control text-muted" id="post_category" required>
          <option value="">Select Category</option>
          <option value="Vegetables">Vegetables</option>
          <option value="Fruits">Fruits</option>
          <option value="Grains">Grains</option>
          <option value="Others">Others</option>
        </select>
      </div>

      <div class="col col-sm-6 form-group">
        <label for="amount" class="text-muted">Amount (in kg):</label>
        <input type="number" name="amount" class="form-control text-muted" placeholder="Enter amount (in kg)" id="amount" required>
      </div>

      <div class="col col-sm-6 form-group">
        <label for="price" class="text-muted">Price:</label>
        <input type="number" name="price" class="form-control text-muted" placeholder="Enter Price (৳)" id="price" required>
      </div>

      <div class="col col-sm-6 form-group">
        <label for="phone" class="text-muted">Contact No:</label>
        <input type="text" name="phone" class="form-control text-muted" placeholder="Enter Contact No." id="phone" required>
      </div>

      <div class="col col-sm-12 form-group">
        <label for="post_address" class="text-muted">Address:</label>
        <input type="text" name="post_address" class="form-control text-muted" placeholder="Enter Street Address" id="post_address" required>
      </div>

      <div class="col col-sm-4 form-group">
        <label for="post_zip" class="text-muted">Zip:</label>
        <input type="number" name="post_zip" class="form-control text-muted" placeholder="Enter ZipCode" id="post_zip" required>
      </div>

      <div class="col col-sm-4 form-group">
        <label for="post_city" class="text-muted">City:</label>
        <input type="text" name="post_city" class="form-control text-muted" placeholder="Enter City Name" id="post_city" required>
      </div>

      <div class="col col-sm-4 form-group">
        <label for="post_country" class="text-muted">Country:</label>
        <input type="text" name="post_country" class="form-control text-muted" placeholder="Enter Country" id="post_country" required>
      </div>

      <div class="col col-md-12 form-group">
        <div class="">
          <div id="msg"></div>
          <form method="post" id="image-form">
            <input type="file" name="photo" class="file" accept="image/*" style="visibility: hidden;">
            <div class="input-group my-3">
              <input type="text" class="form-control" disabled placeholder="Upload File" id="file">
              <div class="input-group-append">
                <button type="button" class="browse btn btn-primary">Browse...</button>
              </div>
            </div>
          </form>
        </div>
        <div class="">
          <img src="https://placehold.it/80x80" id="preview" class="img-thumbnail" style="max-width: 245px; max-height: 165px;"><br>
          <small>&emsp;preview</small>
        </div>
      </div>

      <div class="col col-md-12 form-group">
        <label for="description" class="text-muted">Description:</label>
        <textarea type="text" rows="5" cols="10" name="description" class="form-control text-muted" placeholder="Write Description here" id="description" required></textarea>
      </div>
      <div class="col col-md-12 form-group">
        <button type="submit" id="submitbtn" name="post" class="btn btn-primary float-right"><i class="fa fa-check"></i> POST</button>
      </div>

    </div>
  </form>
</div>
<?php
}

?>
<br>
<?php include '../footer.php'; ?>
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
        $("#submitbtn").prop('value', 'Submitting Post...');
    }
    
    $('#submitbtn').click(function() {
    //Now just reference this button and change CSS
    $(this).css('background-color','#4caf50');
});
});
</script>

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
