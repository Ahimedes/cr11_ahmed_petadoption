<?php 
ob_start();
session_start();
require_once '../dbconnect.php';

if( !isset($_SESSION['superadmin']) ) {
 header("Location: index.php");
 exit;
}
if( isset($_SESSION['user']) ) {
    header("Location: home.php");
    exit;
   }
$res=mysqli_query($conn, "SELECT * FROM users WHERE id=".$_SESSION['superadmin']);
$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);


if ($_GET['id']) {
   $id = $_GET['id'];

   $sql = "SELECT * FROM users WHERE id = {$id}" ;
   $result = $conn->query($sql);

   $data = $result->fetch_assoc();

   $conn->close();

?>

<!DOCTYPE html>
<html>
<head>
   <title>Delete Entry</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>

<h3>Do you really want to delete this entry?</h3>
<form action ="acc_delete.php" method="post">

   <input type="hidden" name= "id" value="<?php echo $data['id'] ?>"/>
   <button class="btn btn-outline-secondary" type="submit">Yes, delete it!</button>
   <a href="../superadmin.php"><button class="btn btn-outline-secondary" type="button">No!</button></a>
</form>

</body>
</html>

<?php
}
?>