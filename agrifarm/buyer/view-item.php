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
    <style type="text/css">
      .form-control:not(select) {
          padding: 0 0.5rem;
      }
      .zoom {
        transition: transform .2s; /* Animation */
        margin: 0 auto;
      }

      .zoom:hover {
        transform: scale(1.2); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
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
if($user['role'] == 2)
{
  $id = $_REQUEST['id'];
  $sql = "SELECT * FROM post WHERE id = '$id' ";
  $query = $conn->query($sql);
  $row = $query->fetch_assoc();

  $sql1 = "SELECT * FROM users WHERE id = '".$row['user_id']."' ";
  $query1 = $conn->query($sql1);
  $row1 = $query1->fetch_assoc();
?>
<div class="container" style="min-height: 500px;padding: 30px;box-shadow: 0 0 10px rgb(0,0,0,0.3);">
  <div class="row">
      <div class="col col-md-6 form-group">
        <img src="../images/<?php echo $row['post_photo']; ?>" alt="" class="img-responsive zoom" style="width:254px;height:165px;"><br><br><br>
        <h5><strong>Name of Crop: </strong><?php echo $row['post_name']; ?><br></h5>
        <strong>Seller ID: </strong><?php echo $row['user_id']; ?><br>
        <strong>Seller Name: </strong><?php echo $row1['firstname'], " ", $row1['lastname']; ?><br>
        <strong>Seller Contact: </strong><?php echo $row['post_phone']; ?><br>
        <strong>Seller Address: </strong><?php echo $row1['address'], ", ", $row1['zipcode'], ", ", $row1['state'], ", ", $row1['country']; ?><br>
      </div>

      <div class="details col-md-6">
            <h3 class="product-title"><?php echo $row['post_title']; ?></h3>
            
            <p class="product-description"><?php echo $row['post_description']; ?></p>
            <h5 class="price">Price (per kg): <span>৳ <?php echo $row['post_price']; ?></span></h5>
            <p class="vote"><strong>In Stock..!</strong> Total Stock Left: <strong>(<?php echo $row['post_amount']; ?> kg)</strong></p>

          <form action="buy-item.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="product" value="<?php echo $row['post_name']; ?>">
            <input type="hidden" name="seller_id" value="<?php echo $row['user_id']; ?>">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="qty" onClick="multiplyBy()" >
                      <i class="fa fa-minus"></i>
                    </button>
                </span>
                <div class="col-md-3">
                  <input type="hidden" class="col-md-3 form-control" id="price" value="<?php echo $row['post_price']; ?>">
                  <input type="number" name="qty" id="qty" class="form-control input-number text-center" value="1" min="1" max="100000">
                </div>
                <span class="input-group-btn">
                  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="qty" onClick="multiplyBy()" >
                    <i class="fa fa-plus"></i>
                  </button>
                </span>
              </div>
            </div>

            <input type="hidden" name="buyer_id" value="<?php echo $user['id']; ?>">

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" style="min-width: 200px">৳&emsp;<span id = "result"></span></span>
              </div>
              <input type="hidden" id = "result" name="priceperkg" class="col-md-4 form-control" value="<?php echo $row['post_price']; ?>" readonly>
              
            </div>

            <div class="action form-group">
              <button type="submit" name="buy" class="add-to-cart btn btn-default"><i class="fa fa-shopping-cart"></i> Buy Now</button>
            </div>
          </form> 

          </div>
    </div>
</div>
<?php
  }
?>
<br>
<?php include '../footer.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
document.getElementById("result").innerHTML = <?php echo $row['post_price']; ?>;
  //plugin bootstrap minus and plus
//http://jsfiddle.net/laelitenetwork/puJ6G/
$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());

    document.getElementById("result").innerHTML = valueCurrent * <?php echo $row['post_price']; ?>;
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
</script>

</body>
</html>


