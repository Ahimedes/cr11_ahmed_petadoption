<?php 

require_once '../dbconnect.php';

if ($_POST) {
   $animal_image = $_POST['animal_image'];
   $animal_name = $_POST['animal_name'];
   $animal_type = $_POST['animal_type'];
   $animal_description = $_POST['animal_description'];
   $animal_location = $_POST['animal_location'];
   $age = $_POST['age'];
   $hobbies = $_POST['hobbies'];
   $status = $_POST['animal_status'];

   $sql = "INSERT INTO animals (animal_image, animal_name, animal_type, animal_description, animal_location, age, hobbies, animal_status) 
   VALUES ('$animal_image', '$animal_name', '$animal_type', '$animal_description', '$animal_location', '$age', '$hobbies', '$status')";
    if($conn->query($sql) === TRUE) {
       echo "<p>New Record Successfully Created</p>" ;
       echo "<a href='../create.php'><button type='button'>Back</button></a>";
        echo "<a href='../admin.php'><button type='button'>Home</button></a>";
   } else  {
       echo "Error " . $sql . ' ' . $conn->connect_error;
   }

   $conn->close();
}

?>