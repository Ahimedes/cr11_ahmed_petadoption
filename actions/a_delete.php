<?php 

require_once '../dbconnect.php';

if ($_POST) {
   $id = $_POST['id'];

   $sql = "DELETE FROM animals WHERE id = {$id}";
    if($conn->query($sql) === TRUE) {
       echo "<p>Successfully deleted!!</p>" ;
       echo "<a href='../admin.php'><button type='button'>Back</button></a>";
   } else {
       echo "Error updating record : " . $conn->error;
   }

   $conn->close();
}

?>