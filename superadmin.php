<?php
ob_start();
session_start();
require_once 'dbconnect.php';


if(!isset($_SESSION['superadmin']) ) {
 header("Location: index.php");
 exit;
}
if( isset($_SESSION['user']) ) {
    header("Location: home.php");
    exit;
   }
if( isset($_SESSION['admin']) ) {
    header("Location: admin.php");
    exit;
   }
$res=mysqli_query($conn, "SELECT * FROM users WHERE id=".$_SESSION['superadmin']);
$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
<title>Welcome - <?php echo $userRow['userEmail']; ?></title>
<style type="text/css">
    .manageUser {
        width : 50%;
        margin: auto;
    }

    table {
        width: 100%;
        margin-top: 20px;
    }
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" href="#"><img src="images/logo.png" height="60" width="60"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="superadmin.php">Home <span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
  <span class="my-2">
    <a class="">Hi <?php echo $userRow['userName'] ; ?><a href="logout.php?logout"> Sign Out</a></a>
  </span>
</nav>

<div class ="manageUser">
   <table class="table"  cellspacing= "0" cellpadding="0">
       <thead>
           <tr>
               <th>Name</th>
               <th>E-Mail</th>
               <th>Status</th>
               <th>Action</th>
           </tr>
       </thead>
       <tbody>
       <?php
           $sql = "SELECT * FROM users";
           $result = $conn->query($sql);

            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                   echo  "<tr>
                       <td>" .$row['userName']."</td>
                       <td>" .$row['userEmail']."</td>
                       <td>" .$row['status']."</td>
                       <td>
                           <a href='actions/u_delete.php?id=" .$row['id']."'><button class='btn btn-outline-secondary' type='button'>Delete</button></a>
                       </td>
                   </tr>" ;
               }
           } else  {
               echo  "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
           }
            ?>

           
       </tbody>
   </table>
</div>
 
</body>
</html>
<?php ob_end_flush(); ?>

