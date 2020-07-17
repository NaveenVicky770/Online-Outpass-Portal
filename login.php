<?php include('includes/server.php');?>

<?php include('includes/header.html');?>

<div class="container-fluid bg-primary text-white" style="padding:1%;">
    <div class="row">
        <div class="col-lg-6">
            <img src="resources/rgukt.png" style="float: left; height: 38px; filter: brightness(0) invert(1); margin-right:2%;">
            <h3>ONLINE-OUTPASS</h3>
        </div>
        <div class="col-lg-6 d-none d-lg-block" style="text-align: right;">
            <h4>IIIT ONGOLE RGUKT AP</h4>
        </div>
    </div>
</div>

<?php  
if (count($errors) > 0){ ?>
<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong><?php include ('includes/errors.php');?></strong>
</div>
<?php } ?>
<br>
<br>
<div class="form-flex">
    <form class="form-signin border border-success h-100" method="post" action="login.php">

        <i class="material-icons md-24 md-dark">
            lock
        </i>
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

        <label for="inputEmail" class="sr-only">Username</label>

        <input type="text" id="inputEmail" class="form-control" placeholder="Username" required="" autofocus="" name="user">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="" name="password">
        <div class="checkbox mb-3">
            <p>
                Not yet a member? <a href="register.php">Sign up</a>
            </p>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="login_user">Sign in</button>
    </form>
</div>

<?php include('includes/footer.html');?>
