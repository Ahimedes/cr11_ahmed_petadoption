<?php
ob_start();
session_start();
if( isset($_SESSION['user'])!="" ){
 header("Location: home.php" ); 
}
include_once 'dbconnect.php';
$error = false;
if ( isset($_POST['btn-signup']) ) {
 
$name = trim($_POST['name']);

$name = strip_tags($name);

$name = htmlspecialchars($name);
$email = trim($_POST['email']);
$email = strip_tags($email);
$email = htmlspecialchars($email);

$pass = trim($_POST['pass']);
$pass = strip_tags($pass);
$pass = htmlspecialchars($pass);

 if (empty($name)) {
  $error = true ;
  $nameError = "Please enter your full name.";
 } else if (strlen($name) < 3) {
  $error = true;
  $nameError = "Name must have at least 3 characters.";
 } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
  $error = true ;
  $nameError = "Name must contain alphabets and space.";
 }

  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
  $error = true;
  $emailError = "Please enter valid email address." ;
 } else {

  $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
  $result = mysqli_query($conn, $query);
  $count = mysqli_num_rows($result);
  if($count!=0){
   $error = true;
   $emailError = "Provided Email is already in use.";
  }
 }

  if (empty($pass)){
  $error = true;
  $passError = "Please enter password.";
 } else if(strlen($pass) < 6) {
  $error = true;
  $passError = "Password must have at least 6 characters." ;
 }

$password = hash('sha256' , $pass);

 if( !$error ) {
 
  $query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";
  $res = mysqli_query($conn, $query);
 
  if ($res) {
   $errTyp = "success";
   $errMSG = "Account created!";
   unset($name);
   unset($email);
   unset($pass);
  } else  {
   $errTyp = "danger";
   $errMSG = "Something went wrong, please try again." ;
  }
 
 }


}
?>
<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  autocomplete="off" >   

    <h2>Sign Up</h2>
    <hr/>
         
    <?php
        if (isset($errMSG) ) {
   ?>
    <div class="alert alert-<?php echo $errTyp ?>">
        <?php echo $errMSG; ?>
    </div>

  <?php
  }
  ?>  
             
    <input type ="text" name="name" class ="form-control" placeholder ="Enter Name" maxlength ="50" value = "<?php echo $name ?>"/>
     
    <span class ="text-danger"> <?php echo $nameError; ?> </span>
            
    <input type = "email" name = "email" class = "form-control" placeholder = "Enter Your Email" maxlength = "40" value = "<?php echo $email ?>"/>
   
    <span class = "text-danger"> <?php echo $emailError; ?> </span>
                         
    <input type ="password" name = "pass" class = "form-control" placeholder = "Enter Password" maxlength = "15"/>
           
    <span class ="text-danger"> <?php echo  $passError; ?> </span>
     
    <hr/>
  
    <button type ="submit" class = "btn btn-block btn-primary" name = "btn-signup">Sign Up</button>
    <hr/>
         
    <a href ="index.php">Sign in Here...</a>
   
</form>
</body >
</html >
<?php  ob_end_flush(); ?>