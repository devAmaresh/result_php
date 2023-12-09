<?php
include('dbconnection.php');
session_start();
$sql="SELECT * FROM userregistration_tb where rEmail='".$_SESSION['rEmail']."'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
// Fetch student results for the user
$sql_results = "SELECT * FROM studentresult WHERE rEmail = '" . $_SESSION['rEmail'] . "'";
$result_results = mysqli_query($conn, $sql_results);
$row_result = mysqli_fetch_assoc($result_results);
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
body{
  background: #BACFFF;
}
img{
    width: 100px;
    height: 100px;
    object-fit: cover;
    float: right;
    border:2px solid yellow;
}
</style>
<body>
<nav class="navbar navbar-expand-lg navbar-dark table-dark">
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
<div class="d-print-block">
<!-- Display user's results -->
<div class="container text-center">
    <div class="card mt-4 mb-4">
        <div class="card-header bg-primary text-white">
            <h2>CLASS 10 RESULT</h2>
        </div>
        <div class="card-body">
        <div class="row">
  <div class="col-md-4 offset-2"><h5>Name: <?php echo $row['rName'];?></h5></div>
  <div class="col-md-2 offset-4 mb-2"> 
            <?php
            echo '<img src="images/'.$row["rImage"].'">';
            ?></div>
</div>
           
            <?php
            if (mysqli_num_rows($result_results) > 0) {
                echo '<table class="table table-bordered table-hover">';
                echo '<thead class="thead-dark">';
                echo '<tr>';
                echo '<th>Subject</th>';
                echo '<th>Score</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                echo '<tr class="table-primary">';
                echo '<td >English</td>';
                echo '<td>' . $row_result['English'] . '</td>';
                echo '</tr>';
                echo '<tr class="table-secondary">';
                echo '<td>2nd Language</td>';
                echo '<td>' . $row_result['Language2'] . '</td>';
                echo '</tr>';
                echo '<tr class="table-success">';
                echo '<td>Science</td>';
                echo '<td>' . $row_result['Science'] . '</td>';
                echo '</tr>';
                echo '<tr class="table-info">';
                echo '<td>Math</td>';
                echo '<td>' . $row_result['Math'] . '</td>';
                echo '</tr>';
                echo '<tr class="table-danger">';
                echo '<td>Social Science</td>';
                echo '<td>' . $row_result['SocialScience'] . '</td>';
                echo '</tr>';
                echo '<tr class="table-warning">';
                echo '<td>FIT</td>';
                echo '<td>' . $row_result['FIT'] . '</td>';
                echo '</tr>';
                echo '</tbody>';
                echo '</table>';
                echo "<h6>Percentage: ";
                echo round(($row_result['English'] + $row_result['SocialScience'] + $row_result['Language2'] + $row_result['Science'] + $row_result['Math']+ $row_result['FIT']) / 6,2);
                echo "%</h6>";
            } else {
                echo '<p>No results available.</p>';
            }
            ?>
        </div>
    </div>
</div>
<div class="text-center">
    <button class="btn btn-success" id="print" onclick="print()">Print</button>
</div>
</div>
</div>
<script>
function print(){
    window.print();
})
</script>
</body> 
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhtableU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</html>