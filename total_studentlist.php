<?php 
    include('includes/server.php');
    include('includes/login_validation.php');
    
    $Gender=$_SESSION['Gender'];
    $branch=$_SESSION['Branch'];
    $approvedby=$_SESSION['username'];
    $batch=$_SESSION['Batch'];
    $Role=$_SESSION['Role'];
    if($Role == 'WARDEN'){
              $query ="SELECT * FROM st_1 WHERE BATCH='$batch' AND GENDER='$Gender'";
              $result =mysqli_query($db,$query);
        }
  else if($Role == 'D_WARDEN'){
              $query ="SELECT * FROM st_1 WHERE BATCH='$batch' AND GENDER='$Gender' AND BRANCH='$branch'";
              $result =mysqli_query($db,$query);
        }
  else{
    //header('Location:login.php');
    $query="SELECT * FROM st_1";
    $result =mysqli_query($db,$query);  
  }
?>

<?php include('includes/header.html'); ?>
<?php include('includes/nav_bar.php'); ?>

<!--DataTable-->
<script>
    $(document).ready(function() {
        $('#totallist_table').DataTable();
    });

</script>

<br>
<br>
<br>
<div class="container">
    <table id="totallist_table" class="table table-sm table-bordered table-primary table-hover  table-responsive  w-auto">
        <thead>
            <tr>
                <th width="07%">S.NO</th>
                <th width="13%">ID</th>
                <th width="30%">NAME</th>
                <th width="10%">BRANCH</th>
                <?php if($_SESSION['Role'] == 'DEAN' ){ ?>
                <th width="20%">D_WARDEN</th>
                <th width="20%">WARDEN</th>
                <?php } ?>
                <?php if($_SESSION['Role'] == 'WARDEN') { ?>
                <th width="20%">D_WARDEN</th>
                <?php } ?>
            </tr>
        </thead>

        <tbody>
            <?php
      $counter=0;
      while ($row=mysqli_fetch_assoc($result)) 
      {
  
    ?>
            <tr>
                <td width="07%"><?php echo ++$counter; ?></td>
                <td width="13%" ><span class="badge badge-primary"><?php echo $row['ID'];?></span></td>
                <td width="30%" ><?php echo $row['NAME'];?></td>
                <td width="10%"><?php echo $row['BRANCH']; ?></td>
                <?php if($_SESSION['Role'] == 'DEAN' ){ ?>
                <td width="20%"><?php echo $row['D_WARDEN']; ?></td>
                <td width="20%"><?php echo $row['WARDEN']; ?></td>
                <?php }?>
                <?php if($_SESSION['Role'] == 'WARDEN' ){ ?>
                <td width="20%"><?php echo $row['D_WARDEN']; ?></td>
                <?php } ?>
            </tr>
            <?php
		}
	?>
        </tbody>
    </table>
</div>

<br>
<br>
<br>

<?php include('includes/footer.html'); ?>
