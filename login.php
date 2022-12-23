<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('include_errors/errors.php'); ?>
  	<div class="input-group">
  		<label>Email</label>
  		<input type="text" name="email" value="<?php echo $email; ?>"  autocomplete="off">
		  <?php include('include_errors/error2.php'); ?>
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password" value="<?php echo $password; ?>" autocomplete="off">
		  <?php include('include_errors/error3.php'); ?>
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>
</body>
</html>