<?php
  include '../session.php';
  $id = $_REQUEST['id'];
  if (isset($_POST['save'])) {

    $status = $_POST['status'];

    $sql = "UPDATE order_item SET status= '$status' WHERE id = '$id' ";
    if($conn->query($sql)){ 
      $_SESSION['success'] = 'Order Info updated successfully';
    }
    else{
      $_SESSION['error'] = $conn->error;
    }
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
    <style type="text/css">
      .form-control:disabled, .form-control[readonly] {
        background: transparent;
        border: 0;
        border-bottom: 1px dotted Gray;
        border-radius: 0;
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
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>

      <li class="nav-item active">
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

      <li class="nav-item dropdown">
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
        </div>
      </li>
    </ul>
  </div>
</nav>
</header>

<body>
<br>
<?php
  $sql = "SELECT * FROM order_item WHERE id = '$id' ";
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
  <div class="row">
      <div class="col col-md-12 form-group">
        <a href="orders.php" class="btn btn-info btn-small float-left" style="color: white;"><i class="fa fa-arrow-left"></i> Back</a>

        <a href="all-order.php" class="btn btn-success btn-small float-right" style="color: white;" data-toggle="modal" data-target="#myModal"><i class="fa fa-check"></i> Process Order</a>

      </div>

      <div class="col col-md-12 form-group">
        <label for="title" class="text-muted">Product Name:</label>
        <input type="text" class="form-control text-muted" id="title" value="<?php echo $row['product']; ?>" readonly>
      </div>

      <div class="col col-sm-12 form-group">
        <label for="name" class="text-muted">Quantity (in KG):</label>
        <input type="text" class="form-control text-muted" id="name" value="<?php echo $row['qty']; ?>" readonly>
      </div>

      <div class="col col-sm-6 form-group">
        <label for="name" class="text-muted">Price (Per KG):</label>
        <input type="text" class="form-control text-muted" id="post_category" value="<?php echo '৳ ',$row['priceperkg']; ?>" readonly>
      </div>

      <div class="col col-sm-6 form-group">
        <label for="amount" class="text-muted">Total Price:</label>
        <input type="text" class="form-control text-muted" id="amount" value="<?php echo '৳ ',$row['totalprice']; ?>" readonly>
      </div>

      <?php 
      $s1 = "SELECT * FROM users WHERE id = '".$row["buyer_id"]."' ";
      $q1 = $conn->query($s1);
      $r1 =  $q1->fetch_assoc();
      ?>

      <div class="col col-sm-6 form-group">
        <label for="" class="text-muted">Ordered By:</label>
        <input type="text" class="form-control text-muted" id="" value="<?php echo $r1['firstname'], ' ', $r1['lastname']; ?>" readonly>
      </div>

      <div class="col col-sm-6 form-group">
        <label for="" class="text-muted">Ordered Date:</label>
        <input type="text" class="form-control text-muted" id="" value="<?php echo $row['order_date']; ?>" readonly>
      </div>

      <div class="col col-sm-6 form-group">
        <label for="" class="text-muted">Email:</label>
        <input type="text" class="form-control text-muted" id="" value="<?php echo $r1['email']; ?>" readonly>
      </div>

      <div class="col col-sm-6 form-group">
        <label for="phone" class="text-muted">Contact No:</label>
        <input type="text" class="form-control text-muted" id="phone" value="<?php echo $r1['phone']; ?>" readonly>
      </div>

      <div class="col col-sm-12 form-group">
        <label for="post_address" class="text-muted">Address:</label>
        <input type="text" class="form-control text-muted" id="post_address" value="<?php echo $r1['address']; ?>" readonly>
      </div>

      <div class="col col-sm-4 form-group">
        <label for="post_zip" class="text-muted">Zip:</label>
        <input type="number" class="form-control text-muted" id="post_zip" value="<?php echo $r1['zipcode']; ?>" readonly>
      </div>

      <div class="col col-sm-4 form-group">
        <label for="post_city" class="text-muted">City:</label>
        <input type="text" class="form-control text-muted" id="post_city" value="<?php echo $r1['state']; ?>" readonly>
      </div>

      <div class="col col-sm-4 form-group">
        <label for="post_country" class="text-muted">Country:</label>
        <input type="text" class="form-control text-muted" id="post_country" value="<?php echo $r1['country']; ?>" readonly>
      </div>

    </div>
</div>
<br>
<?php include '../footer.php'; ?>
<!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Confirm Status</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="col col-sm-12 form-group">
            <form action="" method="post">
            <label for="status" class="text-muted">Select Status:</label>
            <select name="status" class="form-control text-muted" id="status" required>
              <option value=""> - Select - </option>
              <option value="2">Delivered</option>
            </select>
          </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="save" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
          </form>
        </div>
        
      </div>
    </div>
  </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


</body>
</html>
