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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
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

      <li class="nav-item dropdown active">
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
  $sql = "SELECT * FROM guide WHERE post_category = 'Farming Vegetables'";
  $query = $conn->query($sql);

  if (isset($_POST['subcategory']))
  {
    $subcategory = $_POST["subcategory"];
    $sql = "SELECT * FROM guide WHERE post_category = 'Farming Vegetables' AND subcategory LIKE '%$subcategory%' ";
    $query = $conn->query($sql);
  }
  
?>

<div class="container-fluid" style="min-height: 80vh;padding: 30px;">
<div class="row">
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
  ?>
  <div class="col-md-2" style="">
      <div class="" style="box-shadow: 0 0 2px rgb(0,0,0,0.3);">
        <div class="card-header">Vegetables Type</div>
        <div class="card-body">
          <form method="post">
          <div class="card-text">
            <a href="" class="btn btn-default">All Vegetables</a>
          </div>
          <div class="card-text">
            <input type="submit" name="subcategory" class="btn btn-default" value="Potatoe">
          </div>
          <div class="card-text">
            <input type="submit" name="subcategory" class="btn btn-default" value="Pumpkin">
          </div>
          <div class="card-text">
            <input type="submit" name="subcategory" class="btn btn-default" value="Cabbage">
          </div>
          <div class="card-text">
            <input type="submit" name="subcategory" class="btn btn-default" value="Cauliflower">
          </div>
          <div class="card-text">
            <input type="submit" name="subcategory" class="btn btn-default" value="Tomatoe">
          </div>
          <div class="card-text">
            <input type="submit" name="subcategory" class="btn btn-default" value="Cucumber">
          </div>
          <div class="card-text">
            <input type="submit" name="subcategory" class="btn btn-default" value="Lettuce">
          </div>
          <div class="card-text">
            <input type="submit" name="subcategory" class="btn btn-default" value="Onions">
          </div>
          <div class="card-text">
            <input type="submit" name="subcategory" class="btn btn-default" value="Garlic">
          </div>
          <div class="card-text">
            <input type="submit" name="subcategory" class="btn btn-default" value="Radish">
          </div>
          <div class="card-text">
            <input type="submit" name="subcategory" class="btn btn-default" value="Brinjal">
          </div>
          <div class="card-text">
            <input type="submit" name="subcategory" class="btn btn-default" value="Beans">
          </div>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-10" style="padding: 20px;box-shadow: 0 0 10px rgb(0,0,0,0.3);">
    <div class="card-header">Farming Guide For Vegetables</div>
    <div class="card-body">
      <?php 
      if (isset($subcategory)) {
      ?>
      <div class="card-text text-muted">
        Showing Result for <?php echo $subcategory;?>
      <?php 
      }
      ?>
      <?php
        while ($row = $query->fetch_assoc()) {
      ?>
        <hr>
        <div class="form-group font-weight-bold text-muted">
          <?php echo $row["title"];?>
          <a href="view-guide.php?id=<?php echo $row['id'];?>" class="float-right btn btn-info" style="color:#fff;">View Guide</a>
        </div>
        <i class="form-group text-muted">
          <span class="font-weight-bold">Category: </span><span><?php echo $row["post_category"];?>, </span>
          <span class="font-weight-bold">Sub Category: </span><span><?php echo $row["subcategory"];?></span>
        </i>
        <p class="text-muted"><span class="font-weight-bold">Posted on: </span> <?php echo date_format(date_create($row["dateposted"]), "h:i:sa, dS M Y");?></p>
        <hr>
        
      <?php
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
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
      $('#example').DataTable();
  } );
</script>
<script type="text/javascript">
  function confirmation(){
    return confirm("Are you sure you want to delete?");
  }
</script>
</body>
</html>
