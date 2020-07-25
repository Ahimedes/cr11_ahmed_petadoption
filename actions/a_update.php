<?php 

require_once '../dbconnect.php';

if ($_POST) {
   $animal_name = $_POST['animal_name'];
   $age = $_POST['age'];
   $animal_description = $_POST[ 'animal_description'];
   $hobbies = $_POST['hobbies'];

   $id = $_POST['id'];

   $sql = "UPDATE animals SET animal_name = '$animal_name', age = '$age', animal_description = '$animal_description', hobbies = '$hobbies' WHERE id = {$id}" ;
   if($conn->query($sql) === TRUE) {
       echo  "<p>Successfully Updated</p>";
       echo "<a href='../update.php?id=" .$id."'><button type='button'>Back</button></a>";
       echo  "<a href='../admin.php'><button type='button'>Home</button></a>";
   } else {
        echo "Error while updating record : ". $conn->error;
   }

   $conn->close();

}

?>