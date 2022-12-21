<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
	  <?php include('include_errors/error1.php'); ?>
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="text" name="email" value="<?php echo $email; ?>">
	  <?php include('include_errors/error2.php'); ?>
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
	  <?php include('include_errors/error3.php'); ?>
  	</div>
  	<div class="input-group">
  	  <label>Password confirmation</label>
  	  <input type="password" name="password_2">
	  <?php include('include_errors/error4.php'); ?>
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already have an account? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>