<?php
include('dbconnection.php');
session_start();
if(isset($_SESSION['isLogin'])){
    
}
else{
    echo "<script>location.href='login.php'</script>";
}
$sql="SELECT * FROM userregistration_tb1 where rEmail='".$_SESSION['rEmail']."'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
?>
<!-- change password php code -->
<?php
if(isset($_REQUEST['pUpdate'])){
    if($_REQUEST['rPass']==""||$_REQUEST['rcPass']==""){
        echo "<script>window.alert('Enter the password')</script>";
    }
    else{
        $rPass=$_REQUEST['rPass'];
        $rcPass=$_REQUEST['rcPass'];
        if($rPass==$rcPass)
        {
        $sql1="UPDATE userregistration_tb1 SET rPass='$rPass',rCpass='$rcPass' where rEmail='".$_SESSION['rEmail']."'";
        
        if(mysqli_query($conn,$sql1)){
            echo "<script>window.alert('Password change successfull')</script>";
            echo "<script>location.href='password_change.php'</script>";
        }
        else{
            echo "<script>window.alert('Password change unsuccessfull')</script>";
        }
    }
    else{
        echo "<script>window.alert('Passwords must be same')</script>";
    }
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=`device-width`, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Profile Page</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="profile.php"><span class="text-danger">A</span>dmin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="profile.php">Profile<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="resultadd.php">Result<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="password_change.php">Change Password</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
        <a class="nav-link" href="#"> <?php
        if(isset($row['rName'])){
        echo "Welcome ".$row['rName'];
        }
        ?></a>
      </li>
      <li class="nav-item active">
      <button class="mt-1 btn btn-warning btn-sm"><a href="logout.php">Logout</a></button>
      </li>
    </ul>
  </div>
</nav>
<div class="container mt-4">
  <div class="row">
<div class="col-md-5 offset-sm-4">
<form method="post" action="" class="shadow-lg p-5">
    <div class="form-group">
    <label for="password">Current Password</label>
    <input type="text" value=" <?php
        echo $row['rPass'];
        ?>" class="form-control" readonly>
        </div>
        <div class="form-group">
        <label for="nPass">New Password</label>
            <input type="password" placeholder="enter your new password here" class="form-control" name="rPass">
    </div>
    <div class="form-group"> 
        <label for="ncPass">Confirm Password</label>
            <input type="password" placeholder="retype your new password here" class="form-control" name="rcPass">
    </div>
    <div class="text-center">
    <input type="submit" value="Change Password" class="btn btn-danger btn-block" name="pUpdate">
      </div>
</form>
<div>
</div>
</div>
</body> 
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</html>