<?php
ob_start();
session_start();
require_once 'dbconnect.php';

if ( isset($_SESSION['user'])!="") {
 header("Location: home.php");
 exit;
}

$error = false;

if(isset($_POST['btn-login']) ) {

 $email = trim($_POST['email']);
 $email = strip_tags($email);
 $email = htmlspecialchars($email);

 $pass = trim($_POST['pass']);
 $pass = strip_tags($pass);
 $pass = htmlspecialchars($pass);


 if(empty($email)){
  $error = true;
  $emailError = "Please enter your email address.";
 } else if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
  $error = true;
  $emailError = "Please enter valid email address.";
 }

 if (empty($pass)){
  $error = true;
  $passError = "Please enter your password.";
 }

 if (!$error) {
 
  $password = hash('sha256', $pass); 

  $res=mysqli_query($conn, "SELECT * FROM users WHERE userEmail='$email'");
  $row=mysqli_fetch_array($res, MYSQLI_ASSOC);
  $count = mysqli_num_rows($res); 
 
  if( $count == 1 && $row['userPass']==$password ) {
   if ($row["status"] == 'admin'){
       $_SESSION["admin"] = $row["id"];
       header("Location: admin.php");
    } elseif ($row["status"] == 'superadmin') {
        $_SESSION['superadmin'] = $row['id'];
        header("Location: superadmin.php");
    } else {
    $_SESSION['user'] = $row['id'];
    header("Location: home.php");
    }
   
  } else {
   $errMSG = "Incorrect Credentials, Try again..." ;
  }
 
 }

}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<div class="card">
<div class="card-body ml-auto mr-auto" style="width:30%; margin-top:10vw">
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete= "off">
 
    <h2>Sign In</h2>
    <hr/> 

    <?php
        if (isset($errMSG) ) {
        echo $errMSG; 
    ?>        
    <?php
    }
    ?>
                  
    <input  type="email" name="email" class="form-control" placeholder= "Your Email" value="<?php echo $email; ?>"  maxlength="40"/>
       
    <span class="text-danger"><?php echo $emailError; ?></span>
         
    <input type="password" name="pass" class="form-control" placeholder ="Your Password" maxlength="15"/>
       
    <span class="text-danger"><?php echo $passError; ?></span>
    <hr/>
    <button class="btn btn-outline-secondary" type="submit" name= "btn-login">Sign In</button>
         
    <hr/>
 
    <a href="register.php">Sign Up Here...</a>
       
</form>
</div>
</body>
</html>
<?php ob_end_flush(); ?>