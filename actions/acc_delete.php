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

if ($_POST) {
   $id = $_POST['id'];

   $sql = "DELETE FROM users WHERE id = {$id}";
    if($conn->query($sql) === TRUE) {
       echo "<p>Successfully deleted!!</p>" ;
       echo "<a href='../superadmin.php'><button type='button'>Back</button></a>";
   } else {
       echo "Error updating record : " . $conn->error;
   }

   $conn->close();
}

?>