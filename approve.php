<?php 
    include('includes/server.php');
    include('includes/login_validation.php');

    $Gender=$_SESSION['Gender'];
    $branch=$_SESSION['Branch'];
    $approvedby=$_SESSION['username'];
    $batch=$_SESSION['Batch'];
    $Role=$_SESSION['Role'];
    if($Role == 'WARDEN'){
              $query ="SELECT * FROM approved WHERE BATCH='$batch' AND GENDER='$Gender'";
              $result =mysqli_query($db,$query);
            
        }
  else if($Role=='D_WARDEN'){
              $query ="SELECT * FROM approved WHERE BATCH='$batch' AND GENDER='$Gender' AND BRANCH='$branch'";
              $result =mysqli_query($db,$query);
        }
  else{
    //header('Location:login.php');
    $query="SELECT * FROM approved";
    $result =mysqli_query($db,$query);  
  }
?>


<?php include('includes/header.html'); ?>
<?php include('includes/nav_bar.php'); ?>

<script>
    $(document).ready(function() {
        $('#approvedlist_table').DataTable();
    });

</script>
<br>
<br>
<br>

<div class="container">
    <table id="approvedlist_table" class="table table-sm table-bordered table-primary table-hover  table-responsive  w-auto">
        <thead>
            <tr>
                <th width="07%">S.NO</th>
                <th width="12%">ID</th>
                <th width="30%">NAME</th>
                <th width="30%">APPROVED BY</th>
                <th width="20%">DATE AND TIME</th>
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
                <td width="12%"><?php echo $row['ID'];?></td>
                <td width="30%"><?php echo $row['NAME'];?></td>
                <td width="30%"><?php echo $row['ISSUED_BY'] ?></td>
                <td width="20%"><?php echo $row['TIME_AND_DATE']; ?></td>
            </tr>
            <?php
		}
	?>
        </tbody>
    </table>
</div>


<?php include('includes/footer.html'); ?>
