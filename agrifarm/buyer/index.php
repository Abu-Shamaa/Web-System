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
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="all-order.php">Your Orders</a>
      </li>


      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-bell-o"></i>
          <?php
          // Select queries
          $sql = "SELECT * FROM order_item WHERE buyer_id = '".$user['id']."' AND status =2 AND notify = 0 ORDER BY order_date desc";
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
          <a class="dropdown-item" href="view-order.php?id=<?php echo $row['id'];?>" style="background: #f6f6f6;">
            <strong>Your Order is accepted for delivery </strong>&emsp;<span style="font-style: italic;"><?php echo $row['qty'], " kg ", $row['product'];?> <br> 
          </a>
          <div class="dropdown-divider"></div>
          <?php
          }
          ?>
          <a class="dropdown-item text-center" href="all-order.php">See All Order</a>
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
  $where = '';
  $btn = "btn btn-info";
  $btn1 = "btn btn-default";
  $btn2 = "btn btn-default";
  $btn3 = "btn btn-default";
  $btn4 = "btn btn-default";

  if (isset($_POST['Vegetables']))
  {
    $btn = "btn btn-default";
    $btn1 = "btn btn-info";
    $where = 'WHERE post_category = "Vegetables" ';
  }
  else if (isset($_POST['Fruits']))
  {
    $btn = "btn btn-default";
    $btn2 = "btn btn-info";
    $where = 'WHERE post_category = "Fruits" ';
  }
  else if (isset($_POST['Grains']))
  {
    $btn = "btn btn-default";
    $btn3 = "btn btn-info";
    $where = 'WHERE post_category = "Grains" ';
  }
  else if (isset($_POST['Others']))
  {
    $btn = "btn btn-default";
    $btn4 = "btn btn-info";
    $where = 'WHERE post_category = "Others" ';
  }

  $sql = "SELECT * FROM post $where";
  $query = $conn->query($sql);

  if (isset($_POST['search']))
  {
    $inputitem = $_POST['inputitem'];
    $sql = "SELECT * FROM post WHERE post_name LIKE '%$inputitem%' ";
    $query = $conn->query($sql);
  }
  
?>

<div class="container-fluid" style="min-height: 80vh;padding: 0 50px 0 50px;">
  <div class="row">
    <div class="col-md-12 form-group">
      <form class="col-md-4 float-right" method="post">
        <div class="input-group">
          <input type="text" name="inputitem" class="form-control" placeholder="Search by Item Name" value="<?php if (isset($_POST['search'])) {echo $inputitem;} ?>">
          <div class="input-group-append">
            <button class="btn btn-info" type="submit" name="search">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-2">
      <div class="card" style="box-shadow: 0 0 2px rgb(0,0,0,0.3);">
        <div class="card-header">Listings by category</div>
        <div class="card-body">
          <form method="post">
          <div class="card-text">
            <a href="" class="<?php echo $btn; ?>">All Products</a>
          </div>
          <div class="card-text">
            <button type="submit" name="Vegetables" class="<?php echo $btn1; ?>">Vegetables</button>
          </div>
          <div class="card-text">
            <button type="submit" name="Fruits" class="<?php echo $btn2; ?>">Fruits</button>
          </div>
          <div class="card-text">
            <button type="submit" name="Grains" class="<?php echo $btn3; ?>">Grains</button>
          </div>
          <div class="card-text">
            <button type="submit" name="Others" class="<?php echo $btn4; ?>">Others</button>
          </div>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-10" style="padding: 20px;box-shadow: 0 0 10px rgb(0,0,0,0.3);">
      <div class="row form-group">
      <?php
      if($user['role'] == 2)
      {
        if (!mysqli_num_rows($query)) {
          echo '
            <div class="col-md-12">
              <div class="badge badge-danger">No records found</div>
            </div>
          ';
        } else {

          while ($row = $query->fetch_assoc()) {
            echo '
            <div class="col-md-3 form-group">
            <div class="card">
              <img class="card-img-top" src="../images/'.$row["post_photo"].'" alt="Card image cap" style="height: 141px;">
              <div class="card-body">
                <h5 class="card-title text-center">'.$row["post_title"].'</h5>
                <p class="card-text text-center">৳ '.$row["post_price"].'</p>
                <div class="text-center"><a href="view-item.php?id='.$row["id"].'" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Buy Item</a></div>
              </div>
            </div>
            </div>

            ';
          }
        }
      }
      ?>
      </div>
  </div>
  </div>
</div>
<br>
<?php include '../footer.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</body>
</html>
