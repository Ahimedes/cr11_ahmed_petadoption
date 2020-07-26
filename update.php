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
$res=mysqli_query($conn, "SELECT * FROM users WHERE id=".$_SESSION['admin']);
$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);


if ($_GET['id']) {
   $id = $_GET['id'];

   $sql = "SELECT * FROM animals WHERE id = {$id}" ;
   $result = $conn->query($sql);

   $data = $result->fetch_assoc();

   $conn->close();

?>

<!DOCTYPE html>
<html>
<head>
   <title>Edit Entry</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

   <style type= "text/css">
       fieldset {
           margin : auto;
           margin-top: 100px;
            width: 50%;
       }

       table  tr th {
           padding-top: 20px;
       }
   </style>

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
    </ul>
  </div>
  <span class="my-2">
    <a class="">Hi <?php echo $userRow['userName'] ; ?><a href="logout.php?logout"> Sign Out</a></a>
  </span>
</nav>

<fieldset>
   <legend>Update Entry</legend>

   <form action="actions/a_update.php"  method="post">
       <table  cellspacing="0" cellpadding= "0">
           <tr>
               <th>Name</th>
               <td><input type="text"  name="animal_name" placeholder ="Name" value="<?php echo $data['animal_name'] ?>" /></td>
           </tr>    
           <tr>
               <th>Age</th>
               <td><input type= "text" name="age"  placeholder="Age" value ="<?php echo $data['age'] ?>" /></td>
           </tr>
           <tr>
               <th>Status</th>
               <td><input type ="text" name= "animal_status" placeholder= "Status" value= "<?php echo $data['animal_status'] ?>" /></td>
           </tr>
           <tr>
               <th>Description</th>
               <td><input type ="text" name= "animal_description" placeholder= "A short description" value= "<?php echo $data['animal_description'] ?>" /></td>
           </tr>
           <tr>
               <th>Hobbies</th>
               <td><input type ="text" name= "hobbies" placeholder= "Hobbies" value= "<?php echo $data['hobbies'] ?>" /></td>
           </tr>
           <tr>
               <input type= "hidden" name= "id" value= "<?php echo $data['id']?>"/>
               <td><button class="btn btn-outline-secondary" type= "submit">Save Changes</button></td>
               <td><a href= "admin.php"><button class="btn btn-outline-secondary" type="button">Back</button></a></td>
           </tr>
       </table>
   </form>

</fieldset>

</body>
</html>

<?php
}
?>