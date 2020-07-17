<?php
include('includes/server.php');
include('includes/login_validation.php');

$name=$_SESSION['name'];
$id=$_SESSION['id'];
$Role=$_SESSION['Role'];
?>

<?php include('includes/header.html'); ?>
<?php include('includes/nav_bar.php'); ?>

<br>
<br>
<?php  
if (count($errors) > 0){ ?>
<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong><?php include ('includes/errors.php');?></strong>
</div>
<?php } ?>

<div id="print_form" class="container">
    <form method="POST" action="print.php">
        <table class="table table-sm table-bordered table-success table-hover  w-auto">

            <tr>
                <th scope="row">NAME</th>
                <td><?php  echo $name; ?></td>
            </tr>
            <tr>
                <th scope="row">ID</th>
                <td><?php   echo $id;  ?></td>

            </tr>
            <tr>
                <th scope="row">ROLE</th>
                <td><?php   echo $Role;  ?></td>
            </tr>
            <tr>
                <th>REASON</th>
                <td><input type="text" name="reason"></td>
            </tr>
            <tr>
                <th>DAYS</th>
                <td width="1%"><input type="number" name="days"></td>
            </tr>
            <tr>
                <th>APPROVE</th>
                <td><input type="checkbox" name="check"></td>
            </tr>
            <tr>
                <th>RELATION</th>
                <td><select name="relation">
                        <option name='self'> SELF </option>
                        <option name='aunt'>AUNT</option>
                        <option name='uncle'>UNCLE</option>
                    </select>

                </td>
            </tr>
            <tr>
                <th>GUARDIAN NAME</th>
                <td><input type="text" name="guardian"></td>
            </tr>
            <tr>
                <th>CONTACT NUMBER</th>
                <td><input type="number" name="contact"></td>
            </tr>
            <tr>
                <th>AADHAR NUMBER</th>
                <td><input type="text" name="aadhar"></td>
            </tr>
        </table>
        <div class="centering">
            <button class="btn btn-success" name="approve">Approve</button>
        </div>
    </form>

</div>

<?php include('includes/footer.html'); ?>
