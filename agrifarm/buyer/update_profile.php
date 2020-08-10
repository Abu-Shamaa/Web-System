<?php
  include '../session.php';
  if(isset($_POST['profilepic'])) 
  {
    $id = $user['id'];
    $filename = $_FILES['photo']['name'];

    if(!empty($filename)){
      move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);
      $sql = "UPDATE users SET `profile_pic`= '$filename' WHERE id = '$id' ";
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
    $id = $user['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $zipcode = $_POST['zipcode'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    
    $sql = "UPDATE users SET firstname= '$firstname', lastname= '$lastname', phone= '$phone', address= '$address', zipcode= '$zipcode', state= '$state',  country= '$country' WHERE id = '$id' ";
    if($conn->query($sql)){ 
      $_SESSION['success'] = 'Your Profile updated successfully';
    }
    else{
      $_SESSION['error'] = $conn->error;
    }
  }
  header('location: profile.php');
?>