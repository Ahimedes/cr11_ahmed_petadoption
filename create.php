<?php
ob_start();
session_start();
require_once 'dbconnect.php';


if( !isset($_SESSION['admin']) ) {
 header("Location: index.php");
 exit;
}
if( isset($_SESSION['user']) ) {
    header("Location: home.php");
    exit;
   }
$res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['admin']);
$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
   <title>Add Pet</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" href="admin.php"><img src="images/logo.png" height="60" width="60"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="admin.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="create.php">Add Pet</a>
      </li>
      <span class="my-2">
        <a class="">Hi <?php echo $userRow['userName'] ; ?><a href="logout.php?logout"> Sign Out</a></a>
      </span>
    </ul>
  </div>
</nav>


<fieldset>
   <legend>Add Pet</legend>

   <form action="actions/a_create.php" method= "post">
       <table cellspacing= "0" cellpadding="0">
           <tr>
               <th>Image</th>
               <td><input type="text" name="animal_image" placeholder="Teaser" /></td>
           </tr>    
           <tr>
               <th>Name</th>
               <td><input type="text" name= "animal_name" placeholder="Name" /></td>
           </tr>
           <tr>
               <th>Type</th>
               <td><input type="text"  name="animal_type" placeholder ="small or big" /></td>
           </tr>
           <tr>
               <th>Status</th>
               <td><input type="text"  name="animal_status" placeholder ="junior or senior" /></td>
           </tr>
           <tr>
               <th>Description</th>
               <td><input type="text"  name="animal_description" placeholder ="Description" /></td>
           </tr>
           <tr>
               <th>Location</th>
               <td><input type="text"  name="animal_location" placeholder ="Location" /></td>
           </tr>
           <tr>
               <th>Age</th>
               <td><input type="text"  name="age" placeholder ="Age" /></td>
           </tr>
           <tr>
               <th>Hobbies</th>
               <td><input type="text"  name="hobbies" placeholder ="Hobbies" /></td>
           </tr>
           <tr>
               <td><button type ="submit" class="btn btn-outline-secondary">Insert Pet</button></td>
               <td><a href= "admin.php"><button type="button" class="btn btn-outline-secondary">Back</button></a></td>
           </tr >
       </table>
   </form>

</fieldset >

</body>
</html>