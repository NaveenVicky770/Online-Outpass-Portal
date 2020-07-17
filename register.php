<?php include('includes/server.php') ?>
<!DOCTYPE html>
<html>
<head>
   <script type="text/javascript">
    window.history.forward();

  </script>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="css/register_style.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<?php include('includes/header.html') ?>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('includes/errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
    <div>
      <label>Role</label>
      <input type="text" name="role">
    </div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
<?php include('includes/footer.html') ?>
</html>