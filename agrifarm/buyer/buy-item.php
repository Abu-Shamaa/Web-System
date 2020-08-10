<?php
  include '../session.php';
?>

<?php
  if(isset($_POST['buy'])) 
  {
    $product_id = $_POST['product_id'];
    $product = $_POST['product'];
    $seller_id = $_POST['seller_id'];
    $qty = $_POST['qty'];
    $priceperkg = $_POST['priceperkg'];
    $totalprice = $_POST['priceperkg'] * $_POST['qty'];
    $buyer_id = $_POST['buyer_id'];

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

      <li class="nav-item active">
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
  <div class="container" style="padding: 30px;box-shadow: 0 0 10px rgb(0,0,0,0.3);">
    <?php
    if($user['role'] == 2)
    {
      $sql = "SELECT * FROM post WHERE id = '$product_id' ";
      $query = $conn->query($sql);
      $row = $query->fetch_assoc();
    ?>
      <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill">1</span>
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Product name</h6>
                <small class="text-muted"></small>
              </div>
              <span class="text-muted"><?php echo $product; ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Price Per KG</h6>
                <small class="text-muted"></small>
              </div>
              <span class="text-muted">৳ <?php echo $priceperkg; ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Quantity</h6>
              </div>
              <span class="text-muted"><?php echo $qty = $qty;; ?> KG</span>
            </li>
            <li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Promo code</h6>
                <small>EXAMPLECODE</small>
              </div>
              <span class="text-success">N/A</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (USD)</span>
              <strong>৳ <?php echo $totalprice; ?></strong>
            </li>
          </ul>
        </div>




        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Billing address</h4>
          <form action="order.php" method="POST" enctype="multipart/form-data" class="needs-validation">
            <!-- Start Hidden Input -->
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <input type="hidden" name="product" value="<?php echo $product; ?>">
            <input type="hidden" name="seller_id" value="<?php echo $seller_id; ?>">
            <input type="hidden" name="qty" value="<?php echo $qty; ?>">
            <input type="hidden" name="priceperkg" value="<?php echo $priceperkg; ?>">
            <input type="hidden" name="buyer_id" value="<?php echo $buyer_id; ?>">
            <!-- End Hidden Input -->

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" id="firstName" placeholder="" value="<?php echo $user['firstname']; ?>" readonly>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $user['lastname']; ?>" readonly>
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Email <span class="text-muted">(Optional)</span></label>
              <input type="email" class="form-control" id="email" value="<?php echo $user['email']; ?>" placeholder="you@example.com" readonly>
            </div>

            <div class="mb-3">
              <label for="address">Address</label>
              <input type="text" class="form-control" id="address" name="address" value="<?php echo $user['address']; ?>" placeholder="1234 Main St" required>
            </div>

            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="number" class="form-control" id="zip" name="zipcode" value="<?php echo $user['zipcode']; ?>" placeholder="" required>
              </div>
              <div class="col-md-5 mb-3">
                <label for="country">Country</label>
                <select class="form-control d-block w-100" id="country" name="country" required>
                  <option value="">Choose...</option>
                  <option value="Bangladesh" <?php if ($user['country'] == 'Bangladesh') { echo ' selected="selected"'; } ?> >Bangladesh</option>
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label for="state">State</label>
                <select class="form-control d-block w-100" id="state" name="state" required>
                  <option value="">Choose...</option>
                  <option value="Dhaka"<?php if ($user['state'] == 'Dhaka') { echo ' selected="selected"'; } ?> >Dhaka</option>
                  <option value="Chittagong"<?php if ($user['state'] == 'Chittagong') { echo ' selected="selected"'; } ?> >Chittagong</option>
                  <option value="Sylhet"<?php if ($user['state'] == 'Sylhet') { echo ' selected="selected"'; } ?> >Sylhet</option>
                  <option value="Barisal"<?php if ($user['state'] == 'Barisal') { echo ' selected="selected"'; } ?> >Barisal</option>
                  <option value="Rajshahi"<?php if ($user['state'] == 'Rajshahi') { echo ' selected="selected"'; } ?> >Rajshahi</option>
                  <option value="Khulna"<?php if ($user['state'] == 'Khulna') { echo ' selected="selected"'; } ?> >Khulna</option>
                </select>
              </div>
              
            </div>
            <hr class="mb-4">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="same-address" checked>
              <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
            </div>
            <hr class="mb-4">

            <h4 class="mb-3">Payment</h4>

            <div class="d-block my-3">
              <div class="custom-control custom-radio">
                <input id="credit" type="radio" name="card" value="credit" class="custom-control-input" checked required>
                <label class="custom-control-label" for="credit">Credit card</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="debit" type="radio" name="card" value="debit" class="custom-control-input" required>
                <label class="custom-control-label" for="debit">Debit card</label>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="cc-name">Name on card</label>
                <input type="text" class="form-control" id="cc-name" name="ccname" placeholder="" required>
                <small class="text-muted">Full name as displayed on card</small>
              </div>
              <div class="col-md-6 mb-3">
                <label for="cc-number">Credit card number</label>
                <input type="text" class="form-control" id="cc-number" name="ccnumber" placeholder="" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">Expiration</label>
                <input type="text" class="form-control" id="cc-expiration" name="ccexpiration" placeholder="" required>
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">CVV</label>
                <input type="text" class="form-control" id="cc-cvv" name="cccvv" placeholder="" required>
              </div>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit" name="checkout">Continue to checkout</button>
          </form>
        </div>
      </div>
      <?php
        }
      }
      ?>
    </div>
<br>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</body>
</html>
