<?php 
  session_start(); 

  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['email']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
	<h2>Home Page</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['email'])) : ?>
		
    	<p>Welcome <strong><?php echo $_SESSION['email']; ?></strong></p>
		<a style="color: red;" href="logout.php">Log out</a>

	<?php else: ?>

        <p>Hello visitor</p>        
        <p><a href="login.php">Log in</a> or <a href="register.php">sign up</a></p>

    <?php endif ?>
</div>
		
</body>
</html>