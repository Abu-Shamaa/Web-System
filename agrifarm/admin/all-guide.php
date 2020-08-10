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
  $sql = "SELECT * FROM guide";
  $query = $conn->query($sql);
?>
<div class="container-fluid" style="min-height: 80vh;padding: 0 50px 10px 50px;">
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
      <a href="all-guide.php" class="btn btn-info">Manage Farming Guide</a>
    </div>
    <div class="card-text">
      <a href="add-guide.php" class="btn btn-default">Add Farming Guide</a>
    </div>
  </div>
</div>

<div class="col-md-10 form-group" style="padding: 20px;box-shadow: 0 0 5px rgb(0,0,0,0.3);">
<h3 class="text-muted">All Guides</h3><br>
<div class="form-group">
  <a href="add-guide.php" class="btn btn-info"><i class="fa fa-plus"></i> Add a Guide</a>
</div>
<div class="table-responsive">
  <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Title</th>
                <th>POSTED ON</th>
                <th class="text-center" width="30%">ACTION</th>
            </tr>
        </thead>
        <tbody>
        <?php
          while ($row = $query->fetch_assoc()) {
            echo '
              
                <tr>
                  <td>'.$row["post_category"].'</td>
                  <td>'.$row["subcategory"].'</td>
                  <td>'.$row["title"].'</td>
                  <td>'.$row["dateposted"].'</td>
                  <td class="text-center">
                    <a href="guide_edit.php?id='.$row["id"].'" title="Edit Post">
                      <button class="btn btn-sm btn-flat"><i class="fa fa-edit" style="color:green"></i></button>
                    </a>  

                    <a href="delete_guide.php?id='.$row["id"].'" title="Delete Post">
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
