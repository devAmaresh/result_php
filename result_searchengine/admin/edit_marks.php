<?php
include('dbconnection.php');
session_start();
if(!isset($_SESSION['isLogin'])){
    echo "<script>location.href='login.php'</script>";
}
$sql = "SELECT * FROM userregistration_tb1 WHERE rEmail='" . $_SESSION['rEmail'] . "'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$sql1 = "SELECT * FROM userregistration_tb where rId='".$_REQUEST['student_id']."'";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$sql3="SELECT * FROM studentresult where rEmail='".$row1['rEmail']."'";
$row3=mysqli_fetch_assoc(mysqli_query($conn,$sql3));
if (isset($_REQUEST['addMarks'])) {
    $student_id = $_REQUEST['student_id'];
    $english_marks = $_REQUEST['English'];
    $language2_marks = $_REQUEST['Language2'];
    $math_marks = $_REQUEST['Math'];
    $science_marks = $_REQUEST['Science'];
    $social_marks = $_REQUEST['SocialScience'];
    $fit_marks = $_REQUEST['FIT'];
    // Fetch all students from userregistration_tb
    $rEmail=$row1['rEmail'];
    // Insert the marks into the studentresult table
    $sql2 = "UPDATE studentresult SET rEmail='$rEmail', English='$english_marks', Language2='$language2_marks',Math='$math_marks',Science='$science_marks',SocialScience='$social_marks',FIT='$fit_marks' WHERE rEmail='$rEmail'";
    
    if (mysqli_query($conn, $sql2)) {
        echo "<script>window.alert('Marks updated successfully.')</script>";
        echo "<script>location.href='resultadd.php'</script>";
    } else {
        echo "<script>window.alert('error')</script>";
        echo "<script>location.href='resultadd.php'</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>Add Marks</title>
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
                <a class="nav-link" href="#">Welcome Admin</a>
            </li>
            <li class="nav-item active">
                <button class="mt-1 btn btn-warning btn-sm"><a href="logout.php">Logout</a></button>
            </li>
        </ul>
    </div>
</nav>
    <div class="container mt-4">
        <h2>Update Marks</h2>
        <form method="post" action="">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Subject</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-primary">
                        <td>English</td>
                        <td><input type="number" name="English" value="<?php echo $row3['English']; ?>" required></td>
                    </tr>
                    <tr class="table-warning">
                        <td>2nd Language</td>
                        <td><input type="number" name="Language2" value="<?php echo $row3['Language2']; ?>" required></td>
                    </tr>
                    <tr class="table-danger">
                        <td>Math</td>
                        <td><input type="number" name="Math" value="<?php echo $row3['Math']; ?>" required></td>
                    </tr>
                    <tr class="table-info">
                        <td>Social Science</td>
                        <td><input type="number" name="SocialScience" value="<?php echo $row3['SocialScience']; ?>" required></td>
                    </tr>
                    <tr class="table-success">
                        <td>Science</td>
                        <td><input type="number" name="Science" value="<?php echo $row3['Science']; ?>" required></td>
                    </tr>
                    <tr class="table-secondary">
                        <td>FIT</td>
                        <td><input type="number" name="FIT" value="<?php echo $row3['FIT']; ?>" required></td>
                    </tr>
                    <!-- Add rows for other subjects here -->
                </tbody>
            </table>
            <input type="hidden" name="student_id" value="<?php echo $_REQUEST['student_id']; ?>">
            <input type="submit" class="btn btn-primary" value="Submit" name="addMarks">
        </form>
    </div>
    <div class="text-center">
<a href="resultadd.php" class="btn btn-dark">Go Back</a>
</div>
</body>
</html>
