<?php
  include '../session.php';
  $uid = $_REQUEST['uid'];
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
    
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    
</head>
<?php
  $sql = "SELECT * FROM order_item WHERE order_no ='$uid' ";
  $query = $conn->query($sql);
  $row = $query->fetch_assoc();
?>
<body>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <address>
                        <strong><?php echo $user['firstname'], " ", $user['lastname']; ?></strong>
                        <br>
                        <?php echo $user['address']; ?>
                        <br>
                        Zipcode: <?php echo $user['zipcode']; ?>, <?php echo $user['state']; ?>
                        <br>
                        <?php echo $user['country']; ?>
                        <br>
                        <p>Tel: <?php echo $user['phone']; ?></p>
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        <em>Date: <?php echo $row['order_date']; ?></em>
                    </p>
                    <p>
                        <em>Receipt #: <?php echo $row['order_no']; ?></em>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="text-center">
                    <h1>Receipt</h1>
                </div>
                </span>
                <table class="table table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Product Name </th>
                            <th></th>
                            <th></th>
                            <th class="text-center">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><em><?php echo $row['product']; ?></em></h4></td>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-center"> <?php echo $row['qty']; ?> </td>   
                        </tr>
                        
                        <tr>
                            <td>   </td>
                                <td>   </td>
                            <td class="text-right">
                                <p>
                                    <strong>Subtotal: </strong>
                                </p>
                                <p>
                                    <strong>Total Qty: </strong>
                                </p>
                            </td>
                            <td class="text-center">
                                <p>
                                    <strong>৳ <?php echo $row['priceperkg']; ?></strong>
                                </p>
                                <p>
                                    <strong>x <?php echo $row['qty']; ?></strong>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right"><h4><strong>Total Price: </strong></h4></td>
                            <td class="text-center text-danger"><h4><strong>৳ <?php echo $row['totalprice']; ?></strong></h4></td>
                        </tr>
                    </tbody>
                </table>
                <a target="_blank" href="receipt.php?uid=<?php echo $row['order_no'];?>" class="btn btn-success btn-lg btn-block">
                    <span class="glyphicon glyphicon-print"></span> Print
                </a>
            </div>
        </div>
    </div
    >
    <div class="form-group text-center">
        <a href="index.php" class=""> <strong>Go Back to Product Page</strong></a>
    </div>
</body>