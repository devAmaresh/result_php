<?php
include('dbconnection.php');
session_start();
if(!isset($_SESSION['isLogin']))
{
if(isset($_REQUEST['rLog'])){
    if($_REQUEST['rEmail']==""||$_REQUEST['rPass']==""){
        echo "<script>window.alert('Plz enter all the fields')</script>";
    }
    else{
        $rEmail=$_REQUEST['rEmail'];
        $rPass=$_REQUEST['rPass'];
        $sql="SELECT rEmail,rPass,rLog from userregistration_tb where rEmail='$rEmail' AND rPass='$rPass'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result)==1){
            $_SESSION['rEmail']=$rEmail;
            $_SESSION['isLogin']=True;
            if(isset($_REQUEST['rRem'])){
              setcookie('rEmail',$rEmail,time()+86400*7);
              setcookie('rPass',$rPass,time()+86400*7);
            }
        $log=$row['rLog'];
            $log=$log+1;
            $sql1="UPDATE userregistration_tb SET rLog = '$log' WHERE rEmail ='$rEmail'";
            $result1=mysqli_query($conn,$sql1);
            echo "<script>location.href='profile.php'</script>";
        }
        else{
            echo "<script>window.alert('Email and Password is not valid')</script>";
        }
    }
}
}
else{
    echo "<script>location.href='profile.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
       body {
            background-color:rgb(15 23 42);
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #00FFFB;
            border-radius: 10px;
            border: 5px solid rgb(251 146 60);
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
        <h1>Login Page</h1>
        <form method="post" action="">
            <div class="mb-3">
            <i class="fa fa-envelope"></i>
                <label for="email" class="form-label">Email</label>
                <input type="email" name="rEmail" id="email" class="form-control" placeholder="Enter your email" value="<?php
                if(isset($_COOKIE['rEmail']))
                {
                    echo $_COOKIE['rEmail'];
                }
                ?>">
            </div>
            <div class="mb-3">
            <i class="fa fa-key"></i>
                <label for="password" class="form-label">Password</label>
                <input type="password" name="rPass" id="password" class="form-control" placeholder="Enter your password"value="<?php
                if(isset($_COOKIE['rPass']))
                {
                    echo $_COOKIE['rPass'];
                }
                ?>">
            </div>
            <div class=text-center>
            <button type="submit" class="btn btn-primary btn-block" name="rLog">Login</button>
    </div>
    <div class="text-center mt-2">
   
            <input type="checkbox" id="remember" name="rRem">
            <label for="remember">Remember me</label>
    </div>
        </form>
        <div class="text-center">
        <a href="registration.php" class="btn btn-warning btn-block mt-3">Back to Home</a></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-nvAa1BCo6F5z5uukBfSopK3Y/Jw0w8YlLVpC2z3tm1z9wicUkeE1CszO5z4C5FJ8" crossorigin="anonymous"></script>
</body>
</html>
