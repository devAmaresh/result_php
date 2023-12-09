<?php
include('dbconnection.php');

if(isset($_REQUEST['rReg']))
{
    if(($_REQUEST['rName']=="")||($_REQUEST['rEmail']=="")||($_REQUEST['rPass']=="")||($_REQUEST['rCpass']=="")||empty($_FILES['rImage']))
    {
        // echo "<script>window.alert('Plz enter all the fields')</script>";
        echo "plz fill all the fields";
    }
    else{
        $rName=$_REQUEST['rName'];
        $rEmail=$_REQUEST['rEmail'];
        $rPass=$_REQUEST['rPass'];
        $rCpass=$_REQUEST['rCpass'];
        $rImage=$_FILES['rImage'];
        $iName=$_FILES['rImage']['name'];
        $iName=uniqid().$iName;
        $i_tmp_Name=$_FILES['rImage']['tmp_name'];
        $iSize=$_FILES['rImage']['size'];
        $b=explode('.',$iName);
        $ext=array('jpg','png','jpeg');
        if(in_array($b[1],$ext))
       {

        $sql1="SELECT rEmail FROM userregistration_tb WHERE rEmail='$rEmail'";
        $result=mysqli_query($conn,$sql1);
        if(mysqli_num_rows($result)==1)
        {
            echo "<script>window.alert('Email is already registered')</script>";
        }
        else{
            if($rPass==$rCpass){
                if($iSize<4000000){
                $sql="INSERT INTO userregistration_tb(rName,rEmail,rPass,rCpass,rImage)VALUES('$rName','$rEmail','$rPass','$rCpass','$iName')";
                if(mysqli_query($conn,$sql))
                {
                    move_uploaded_file($i_tmp_Name,"images/".$iName);
                    echo "<script>window.alert('Registration succesfull')</script>";
                }
            }
            else{
                echo'<script>window.alert("image size is greater than 40kb")</script>';
            }
            }
            else{
                echo "<script>window.alert('Password and confirm Password should match')</script>";
            }
        }

    }
        else
        {
            echo'<script>window.alert("Image extension not valid")</script>';
        }   
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        body {
            background-color:tomato;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #00FFFB;
            border-radius: 10px;
            border: 5px solid black;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Register</h1>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="mb-3">
            <i class="fa fa-user"></i>
                <label for="name" class="form-label">Name</label>
                
                <input type="text" name="rName" id="name" class="form-control" placeholder="Enter your name" required>
                
            </div>
            <div class="mb-3">
            <i class="fa fa-envelope"></i>
                <label for="email" class="form-label">Email</label>
                <input type="email" name="rEmail" id="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
            <i class="fa fa-lock"></i>
                <label for="password" class="form-label">Password</label>
                <input type="password" name="rPass" id="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <div class="mb-3">
            <i class="fa fa-lock"></i>
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" name="rCpass" id="cpassword" class="form-control" placeholder="Retype your password" required>
            </div>
            <div class="mb-3">
            <i class="fa fa-user"></i>
                <label for="image" class="form-label">Upload Image</label>
                <input type="file" name="rImage" id="image" class="form-control" required>
            </div>
            <div class=text-center>
            <button type="submit" class="btn btn-primary btn-block" name="rReg">Register</button>
    </div>
        </form>
        <div class=text-center>
        <a href="login.php" class="btn btn-danger btn-block mt-3">Login Page</a>
    </div>
    </div>

 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-nvAa1BCo6F5z5uukBfSopK3Y/Jw0w8YlLVpC2z3tm1z9wicUkeE1CszO5z4C5FJ8" crossorigin="anonymous"></script>
</body>
</html>

