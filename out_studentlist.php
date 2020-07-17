<?php 
    include('includes/server.php');
    include('includes/login_validation.php');
    
    $Gender=$_SESSION['Gender'];
    $branch=$_SESSION['Branch'];
    $approvedby=$_SESSION['username'];
    $batch=$_SESSION['Batch'];
    $Role=$_SESSION['Role'];
    if($Role == 'WARDEN'){
              $query ="SELECT * FROM permanent WHERE BATCH='$batch' AND GENDER='$Gender' AND INSIGN ='NOT_CHECKED'";
              $result =mysqli_query($db,$query);
        }
  else if($Role=='D_WARDEN'){
              $query ="SELECT * FROM permanent WHERE BATCH='$batch' AND GENDER='$Gender' AND BRANCH='$branch' AND INSIGN='NOT_CHECKED'";
              $result =mysqli_query($db,$query);
        }
  else{
    //header('Location:login.php');
    $query="SELECT * FROM permanent WHERE INSIGN='NOT_CHECKED'";
    $result =mysqli_query($db,$query);  
  }
?>

<?php include('includes/header.html'); ?>
<?php include('includes/nav_bar.php'); ?>

<script>
    $(document).ready(function() {
        $('#outlist_table').DataTable();
    });

</script>
<br>
<br>
<br>
<div class="container">
    <table id="outlist_table" class="table table-sm table-bordered table-danger table-hover  table-responsive  w-auto">
        <thead>
            <tr>
                <th width="10%">S.NO</th>
                <th width="30%">NAME</th>
                <th width="15%">ID</th>
                <th width="20%">BRANCH</th>
                <th width="25%">APPROVED BY</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $counter=0;
            while ($row=mysqli_fetch_assoc($result))
            {

            ?>
            <tr>
                <td width="10%"><?php echo ++$counter; ?></td>
                <td width="30%"><?php echo $row['NAME'];?></td>
                <td width="15%"><span class="badge badge-danger"><?php echo $row['ID'];?></span></td>
                <td width="20%"><?php echo $row['BRANCH']; ?></td>
                <td width="25%"><?php echo $row['WARDEN']; ?></td>
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
