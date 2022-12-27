<?php 
session_start();
include 'functions.php';

if (isset($_SESSION['username'])) 
{
  header("Location: index.php");
}

if (isset($_POST['submit'])) 
{
	$email = $_POST['email'];
	$password = md5($_POST['password']); //md5 encrypt

	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);

	if ($result->num_rows > 0) // an brike dedomena
  {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['id'] = $row['id'];
		header("Location: index.php");
	} 
  else 
  {
		echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
	}
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!--Styles CSS-->
    <link rel="stylesheet" href="css/login-register.css">
  </head>
  <body>
    <div id="frmRegistration">
      <h1>Login </h1>
      <form class="form-horizontal" method="POST" action="">
        <div class="form-group">
          <label class="control-label col-sm-2" for="email">Email:</label>
          <div class="col-sm-6">
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email"  required>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="pwd">Password:</label>
          <div class="col-sm-6"> 
            <input type="password" class="form-control" name="password" id="pwd" placeholder="Enter password" required>
          </div>
        </div>
        <div class="form-group"> 
          <div class="col-sm-offset-2 col-sm-10">
            <button name="submit" class="btn btn-primary">Login</button>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>