<?php
include('dbconnection.php');
session_start();
if(isset($_SESSION['isLogin'])){
    
}
else{
    echo "<script>location.href='login.php'</script>";
}
$sql="SELECT * FROM userregistration_tb where rEmail='".$_SESSION['rEmail']."'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
?>
<?php
if(isset($_REQUEST['iUpdate']))
{
    if(empty($_FILES['rImage']))
    {
        echo "<script>window.alert('Upload the image')</script>";
    }
    else
    {
    $rImage=$_FILES['rImage'];
    // echo "$rName<br>";
    // echo "$rEmail<br>";
    // print_r($rImage)."<br>";
    $iName=$_FILES['rImage']['name'];
    $iName=uniqid().$iName;
    $i_tmp_Name=$_FILES['rImage']['tmp_name'];
    $del_img=$row['rImage'];
    $b=explode('.',$iName);
    $ext=array('jpg','png','jpeg');
    if(in_array($b[1],$ext))
{
    if($iSize<400000)
    {
    $sql="UPDATE userregistration_tb SET rImage='$iName' WHERE rEmail='".$_SESSION['rEmail']."'";

    if(mysqli_query($conn,$sql))
    {
     move_uploaded_file($i_tmp_Name,"images/".$iName);
     unlink("images/".$del_img);
     echo '<script>window.alert("Updation succesfull")</script>';
     echo "<script>location.href='image_update.php'</script>";
    }
}
    else
    {
        echo'<script>window.alert("image size is larger")</script>';
    }
    }
    else{
        echo'<script>window.alert("Image extension not valid")</script>';
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
<style>
img {
  border-radius: 50%;
  margin-top: 24px;
  height: 150px;
  object-fit: cover;
}
</style>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="profile.php"><span class="text-danger">R</span>esult</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="profile.php">Profile<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="result.php">Result<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="image_update.php">ProfileImage<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="password_change.php">Change Password</a>
      </li>

    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
        <a class="nav-link" href="#">Welcome <?php
        echo $row['rName'];
        ?></a>
      </li>
      <li class="nav-item active">
      <button class="mt-1 btn btn-warning btn-sm"><a href="logout.php">Logout</a></button>
      </li>
    </ul>
  </div>
</nav>
<div class="text-center">
<?php
echo '<img src="images/'.$row["rImage"].'">';
?>
</div>
<div>
<div class="container mt-5" style="margin-bottom:30px" >
        <div class="row">
            <div class="col-sm-4 offset-sm-4">
<form  method="post" action="" class="shadow-lg p-5" enctype="multipart/form-data">
    <div class="form-group">
    <label for="Image">Image</label>
    <input type="file" class="form-control" name="rImage">
</div>
<input type="submit" value="Update" class="btn btn-success btn-block" name="iUpdate"><br>
</div>
</div>
</div>
</form>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</html>