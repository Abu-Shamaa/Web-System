<?php
  include 'session.php';
  if(isset($_POST['profilepic'])) 
  {
    $id = $_POST['id'];
    $filename = $_FILES['usrphoto']['name'];

    if(!empty($filename)){
      move_uploaded_file($_FILES['usrphoto']['tmp_name'], '../images/'.$filename);
      $sql = "UPDATE users SET `profile_pic`= '$filename' WHERE id = '$id' ";
      if($conn->query($sql)){ 
        $_SESSION['success'] = 'Profile Photo updated successfully';
      }
      else{
        $_SESSION['error'] = $conn->error;
      }
    }
  }

  else if(isset($_POST['admin_profilepic'])) 
  {
    $id = $_POST['id'];
    $filename = $_FILES['photo']['name'];

    if(!empty($filename)){
      move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);
      $sql = "UPDATE admin SET `profile_pic`= '$filename' WHERE id = '$id' ";
      if($conn->query($sql)){ 
        $_SESSION['success'] = 'Your Profile Photo updated successfully';
      }
      else{
        $_SESSION['error'] = $conn->error;
      }
    }
  }


  else if(isset($_POST['info'])) 
  {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $zipcode = $_POST['zipcode'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    
    $sql = "UPDATE users SET firstname= '$firstname', lastname= '$lastname', phone= '$phone', address= '$address', zipcode= '$zipcode', state= '$state',  country= '$country' WHERE id = '$id' ";
    if($conn->query($sql)){ 
      $_SESSION['success'] = 'Profile updated successfully';
    }
    else{
      $_SESSION['error'] = $conn->error;
    }
  }

  else if(isset($_POST['admin_info'])) 
  {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $zipcode = $_POST['zipcode'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    
    $sql = "UPDATE admin SET firstname= '$firstname', lastname= '$lastname', phone= '$phone', address= '$address', zipcode= '$zipcode', state= '$state',  country= '$country' WHERE id = '$id' ";
    if($conn->query($sql)){ 
      $_SESSION['success'] = 'Your Profile updated successfully';
    }
    else{
      $_SESSION['error'] = $conn->error;
    }
  }
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>