<?php
ob_start();
session_start();
require_once 'dbconnect.php';


if(!isset($_SESSION['user']) ) {
 header("Location: index.php");
 exit;
}
$res=mysqli_query($conn, "SELECT * FROM users WHERE id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
<title>Welcome - <?php echo $userRow['userEmail']; ?></title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" href="home.php"><img src="images/logo.png" height="60" width="60"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Junior animals</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="senior.php">Senior animals</a>
      </li>
    </ul>
  </div>
  <span class="my-2">
    <a class="">Hi <?php echo $userRow['userName'] ; ?><a href="logout.php?logout"> Sign Out</a></a>
  </span>
</nav>

<div class="container">
    <div class="card-columns">
    <?php
        $sql = "SELECT * FROM animals WHERE animal_status = 'junior'";
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo  "<div class= 'card'>
                <img class='card-img-top'style='width: 100%; height:20em' src =" .$row['animal_image'].">
                    <div class='card-body'>
                        <h5 class='card-title'>" .$row['animal_name']."</h5>
                        <p>Age: " .$row['age']."</p>
                        <p>About: " .$row['animal_description']."</p>
                        <p>Hobbies: " .$row['hobbies']."</p>
                    </div>
                </div>" ;
                }
        } else  {
            echo  "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
            }
    ?>
</div>
</div>
 
</body>
</html>
<?php ob_end_flush(); ?>