<?php
include('dbconnection.php');
session_start();
if(!isset($_SESSION['isLogin'])){
    echo "<script>location.href='login.php'</script>";
}

// Fetch the user details for the currently logged-in admin
$sql = "SELECT * FROM userregistration_tb1 WHERE rEmail='" . $_SESSION['rEmail'] . "'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Fetch all students from userregistration_tb
$sql1 = "SELECT * FROM userregistration_tb where isSubmitted=0";
$result1 = mysqli_query($conn, $sql1);
$sql2 = "SELECT * FROM userregistration_tb where isSubmitted=1";
$result2 = mysqli_query($conn, $sql2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Admin Result Add Page</title>
</head>
<style>
  body{
    background-color:turquoise;
  }
  .pSub{
    border: 5px solid black; 
    padding: 10px; 
    margin-bottom: 20px;
    background-image: linear-gradient(to right ,#84E8FF,pink);
}
.dSub{
    border:  5px solid black; 
    padding: 10px; 
    margin-bottom: 20px;
    background-image: linear-gradient(to right, #86FF84, yellow);
}
</style>
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
                <a class="nav-link" href="#">Welcome <?php echo $row['rName']; ?></a>
            </li>
            <li class="nav-item active">
                <button class="mt-1 btn btn-warning btn-sm"><a href="logout.php">Logout</a></button>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
    <h2 class="text-center">Student Details</h2>
    <div class="pSub">
    <h3>Pending Submission</h3>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row1 = mysqli_fetch_assoc($result1)) {
                echo "<tr>";
                echo "<td>" . $row1['rId'] . "</td>";
                echo "<td>" . $row1['rName'] . "</td>";
                echo "<td>" . $row1['rEmail'] . "</td>";
                echo "<td><a href='add_marks.php?student_id=" . $row1['rId'] . "' class='btn btn-primary'>Add Marks</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
        </div>
        <div class="dSub">
    <h3>Submission Done</h3>
    <table class="table table-bordered table-striped table-dark">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row2 = mysqli_fetch_assoc($result2)) {
                echo "<tr>";
                echo "<td>" . $row2['rId'] . "</td>";
                echo "<td>" . $row2['rName'] . "</td>";
                echo "<td>" . $row2['rEmail'] . "</td>";
                echo "<td><a href='edit_marks.php?student_id=" . $row2['rId'] . "' class='btn btn-danger m-2'>Edit Marks</a>";
                echo "<a href='view_marks.php?student_id=" . $row2['rId'] . "' class='btn btn-primary'>View Marks</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
        </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</html>
