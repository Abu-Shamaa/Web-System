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
  $sql = "SELECT * FROM post WHERE user_id = '".$_SESSION['user']."' ";
  $query = $conn->query($sql);

  $csql1 = "SELECT * FROM post WHERE user_id = '".$_SESSION['user']."' AND post_category='Vegetables'";
  $cquery1 = $conn->query($csql1);

  $csql2 = "SELECT * FROM post WHERE user_id = '".$_SESSION['user']."' AND post_category='Fruits'";
  $cquery2 = $conn->query($csql2);

  $csql3 = "SELECT * FROM post WHERE user_id = '".$_SESSION['user']."' AND post_category='Grains'";
  $cquery3 = $conn->query($csql3);

  $csql4 = "SELECT * FROM post WHERE user_id = '".$_SESSION['user']."' AND post_category='Others'";
  $cquery4 = $conn->query($csql4);
?>
<div class="container" style="min-height: 80vh;padding: 30px;box-shadow: 0 0 10px rgb(0,0,0,0.3);">
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
<!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" href="#home" style="font-weight: bold;">Listings</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="orders.php" style="font-weight: bold;">Orders</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="sold-orders.php" style="font-weight: bold;">Sold Items</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="container tab-pane active"><br><br>

      <ul class="nav nav-pills nav-justified">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#all">All Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#vegetable">Vegetables</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#fruit">Fruits</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#grain">Grains</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#other">Others</a>
        </li>
      </ul><br><br>

      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane container active" id="all">
          <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                      <tr>
                          <th width="10%"></th>
                          <th>POST TITLE</th>
                          <th>CATEGORY</th>
                          <th>NAME OF CROP</th>
                          <th>PRICE</th>
                          <th>POSTED ON</th>
                          <th class="text-center" width="30%" width="30%">ACTION</th>
                      </tr>
                  </thead>
                  <tbody>
              <?php
                    while ($row = $query->fetch_assoc()) {
                      echo '
                        
                          <tr>
                            <td class="text-center"><img src="../images/'.$row["post_photo"].'" class="img-responsive" width="50px" height="50px"/></td>
                            <td>'.$row["post_title"].'</td>
                            <td>'.$row["post_category"].'</td>
                            <td>'.$row["post_name"].'</td>
                            <td>৳ '.$row["post_price"].'</td>
                            <td>'.$row["time_posted"].'</td>
                            <td class="text-center">
                              <a href="post_view.php?id='.$row["id"].'" title="View Post">
                                <button class="btn btn-sm btn-flat"><i class="fa fa-eye" style="color:gray"></i></button>
                              </a>

                              <a href="post_edit.php?id='.$row["id"].'" title="Edit Post">
                                <button class="btn btn-sm btn-flat"><i class="fa fa-edit" style="color:green"></i></button>
                              </a>  

                              <a href="delete_post.php?id='.$row["id"].'" title="Delete Post">
                                <button class="btn btn-sm btn-flat"><i class="fa fa-trash-o" style="color:red"></i></button>
                              </a>

                            </td>
                          </tr>
                        
                      ';
                  }
              ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="tab-pane container" id="vegetable">
          <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                      <tr>
                          <th width="10%"></th>
                          <th>POST TITLE</th>
                          <th>CATEGORY</th>
                          <th>NAME OF CROP</th>
                          <th>PRICE</th>
                          <th>POSTED ON</th>
                          <th class="text-center" width="30%">ACTION</th>
                      </tr>
                  </thead>
                  <tbody>
              <?php
                    while ($crow1 = $cquery1->fetch_assoc()) {
                      echo '
                        
                          <tr>
                            <td class="text-center"><img src="../images/'.$crow1["post_photo"].'" class="img-responsive" width="50px" height="50px"/></td>
                            <td>'.$crow1["post_title"].'</td>
                            <td>'.$crow1["post_category"].'</td>
                            <td>'.$crow1["post_name"].'</td>
                            <td>৳ '.$crow1["post_price"].'</td>
                            <td>'.$crow1["time_posted"].'</td>
                            <td class="text-center">
                              <a href="post_view.php?id='.$crow1["id"].'" title="View Post">
                                <button class="btn btn-sm btn-flat"><i class="fa fa-eye" style="color:gray"></i></button>
                              </a>

                              <a href="post_edit.php?id='.$crow1["id"].'" title="Edit Post">
                                <button class="btn btn-sm btn-flat"><i class="fa fa-edit" style="color:green"></i></button>
                              </a>  

                              <a href="delete_post.php?id='.$crow1["id"].'" title="Delete Post">
                                <button class="btn btn-sm btn-flat"><i class="fa fa-trash-o" style="color:red"></i></button>
                              </a>

                            </td>
                          </tr>
                        
                      ';
                  }
              ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="tab-pane container fade" id="fruit">
          <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                      <tr>
                          <th width="10%"></th>
                          <th>POST TITLE</th>
                          <th>CATEGORY</th>
                          <th>NAME OF CROP</th>
                          <th>PRICE</th>
                          <th>POSTED ON</th>
                          <th class="text-center" width="30%">ACTION</th>
                      </tr>
                  </thead>
                  <tbody>
              <?php
                    while ($crow2 = $cquery2->fetch_assoc()) {
                      echo '
                        
                          <tr>
                            <td class="text-center"><img src="../images/'.$crow2["post_photo"].'" class="img-responsive" width="50px" height="50px"/></td>
                            <td>'.$crow2["post_title"].'</td>
                            <td>'.$crow2["post_category"].'</td>
                            <td>'.$crow2["post_name"].'</td>
                            <td>৳ '.$crow2["post_price"].'</td>
                            <td>'.$crow2["time_posted"].'</td>
                            <td class="text-center">
                              <a href="post_view.php?id='.$crow2["id"].'" title="View Post">
                                <button class="btn btn-sm btn-flat"><i class="fa fa-eye" style="color:gray"></i></button>
                              </a>

                              <a href="post_edit.php?id='.$crow2["id"].'" title="Edit Post">
                                <button class="btn btn-sm btn-flat"><i class="fa fa-edit" style="color:green"></i></button>
                              </a>  

                              <a href="delete_post.php?id='.$crow2["id"].'" title="Delete Post">
                                <button class="btn btn-sm btn-flat"><i class="fa fa-trash-o" style="color:red"></i></button>
                              </a>

                            </td>
                          </tr>
                        
                      ';
                  }
              ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="tab-pane container fade" id="grain">
          <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                      <tr>
                          <th width="10%"></th>
                          <th>POST TITLE</th>
                          <th>CATEGORY</th>
                          <th>NAME OF CROP</th>
                          <th>PRICE</th>
                          <th>POSTED ON</th>
                          <th class="text-center" width="30%">ACTION</th>
                      </tr>
                  </thead>
                  <tbody>
              <?php
                    while ($crow3 = $cquery3->fetch_assoc()) {
                      echo '
                        
                          <tr>
                            <td class="text-center"><img src="../images/'.$crow3["post_photo"].'" class="img-responsive" width="50px" height="50px"/></td>
                            <td>'.$crow3["post_title"].'</td>
                            <td>'.$crow3["post_category"].'</td>
                            <td>'.$crow3["post_name"].'</td>
                            <td>৳ '.$crow3["post_price"].'</td>
                            <td>'.$crow3["time_posted"].'</td>
                            <td class="text-center">
                              <a href="post_view.php?id='.$crow3["id"].'" title="View Post">
                                <button class="btn btn-sm btn-flat"><i class="fa fa-eye" style="color:gray"></i></button>
                              </a>

                              <a href="post_edit.php?id='.$crow3["id"].'" title="Edit Post">
                                <button class="btn btn-sm btn-flat"><i class="fa fa-edit" style="color:green"></i></button>
                              </a>  

                              <a href="delete_post.php?id='.$crow3["id"].'" title="Delete Post">
                                <button class="btn btn-sm btn-flat"><i class="fa fa-trash-o" style="color:red"></i></button>
                              </a>

                            </td>
                          </tr>
                        
                      ';
                  }
              ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="tab-pane container fade" id="other">
          <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                      <tr>
                          <th width="10%"></th>
                          <th>POST TITLE</th>
                          <th>CATEGORY</th>
                          <th>NAME OF CROP</th>
                          <th>PRICE</th>
                          <th>POSTED ON</th>
                          <th class="text-center" width="30%">ACTION</th>
                      </tr>
                  </thead>
                  <tbody>
              <?php
                    while ($crow4 = $cquery4->fetch_assoc()) {
                      echo '
                        
                          <tr>
                            <td class="text-center"><img src="../images/'.$crow4["post_photo"].'" class="img-responsive" width="50px" height="50px"/></td>
                            <td>'.$crow4["post_title"].'</td>
                            <td>'.$crow4["post_category"].'</td>
                            <td>'.$crow4["post_name"].'</td>
                            <td>৳ '.$crow4["post_price"].'</td>
                            <td>'.$crow4["time_posted"].'</td>
                            <td class="text-center">
                              <a href="post_view.php?id='.$crow4["id"].'" title="View Post">
                                <button class="btn btn-sm btn-flat"><i class="fa fa-eye" style="color:gray"></i></button>
                              </a>

                              <a href="post_edit.php?id='.$crow4["id"].'" title="Edit Post">
                                <button class="btn btn-sm btn-flat"><i class="fa fa-edit" style="color:green"></i></button>
                              </a>  

                              <a href="delete_post.php?id='.$crow4["id"].'" title="Delete Post">
                                <button class="btn btn-sm btn-flat"><i class="fa fa-trash-o" style="color:red"></i></button>
                              </a>

                            </td>
                          </tr>
                        
                      ';
                  }
              ?>
              </tbody>
            </table>
          </div>
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
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
      $('#example').DataTable();
  } );
</script>

</body>
</html>
