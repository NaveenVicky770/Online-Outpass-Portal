<?php
include('includes/server.php');
include('includes/login_validation.php');
?>
<?php include('includes/header.html');?>
<?php include('includes/nav_bar.php');?>
<br>
<br>
<br>

<?php  
if (count($errors) > 0){ ?>
<div class="alert alert-danger alert-dismissible float-right">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong><?php include ('includes/errors.php');?></strong>
</div>
<?php } ?>

<br>
<br>
<div class="container" >
    <div class="jumbotron mt-3" id="issue_page">
        <h1>Issuing outpass</h1>
        <p class="lead">Search student id here to issue outpass</p>

        <form class="form" method="post" action="issue_outpass.php">
            <div class="input-group input-group-lg">
                <div class="input-group-prepend">
                    <span  class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input id="issue" name="box" type="text" class="form-control" placeholder="ID number" aria-label="Username" aria-describedby="basic-addon1">
            </div>

            <br>
            <br>
            <button class="btn btn-outline-primary btn-lg" name="search_student" role="button">Search ID »</button>
        </form>

    </div>
</div>

<?php include('includes/footer.html');?>
