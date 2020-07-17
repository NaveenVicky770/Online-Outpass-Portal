<?php
include('includes/server.php');
include('includes/login_validation.php');
?>

<?php include('includes/header.html');?>
<?php include('includes/nav_bar.php');?>

<div class="jumbotron" id="welcome">
    <h1 class="display-6">Hey, <?php echo $_SESSION['username'].'...!';?> </h1>
    <p class="lead">Welcome to Online OutPass-Portal</p>
    <hr class="my-4">
    <p>Use the below button to issue outpass now!</p>
    <a href="issue_outpass.php" class="btn btn-primary btn-lg" href="#" role="button">Issue outpass</a>
</div>


<?php include('includes/footer.html');?>
