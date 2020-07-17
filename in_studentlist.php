<?php 
    include('includes/server.php');
    include('includes/login_validation.php');

    $Gender=$_SESSION['Gender'];
    $branch=$_SESSION['Branch'];
    $approvedby=$_SESSION['username'];
    $batch=$_SESSION['Batch'];
    $Role=$_SESSION['Role'];
    if($Role == 'WARDEN'){
               $query="SELECT NAME,ID,BRANCH,WARDEN FROM st_1 WHERE BATCH='$batch' AND GENDER='$Gender' AND NAME NOT IN (SELECT NAME FROM permanent WHERE BATCH='$batch' AND GENDER='$Gender' AND INSIGN='NOT_CHECKED') ";
              $result =mysqli_query($db,$query);
        }
  else if($Role=='D_WARDEN'){
               $query="SELECT NAME,ID,BRANCH,WARDEN FROM st_1 WHERE BATCH='$batch' AND GENDER='$Gender' AND BRANCH='$branch'AND NAME NOT IN (SELECT NAME FROM permanent WHERE BATCH='$batch' AND GENDER='$Gender'AND BRANCH='$branch' AND INSIGN='NOT_CHECKED') ";
              $result =mysqli_query($db,$query);
        }
  else{
    //header('Location:login.php');
    $query="SELECT NAME,ID,BRANCH,WARDEN,D_WARDEN FROM st_1 WHERE NAME NOT IN (SELECT NAME FROM permanent WHERE  INSIGN='NOT_CHECKED') ";
    $result =mysqli_query($db,$query);  
  }
?>

<?php include('includes/header.html'); ?>
<?php include('includes/nav_bar.php'); ?>

<!--    DATATABLE-->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


<script>
    $(document).ready(function() {
        $('#inlist_table').DataTable();
    });

</script>

<br>
<br>
<br>

<div class="container">
    <table id="inlist_table" class="table table-sm table-bordered table-success table-hover  table-responsive  w-auto" >
        <thead>
            <tr>
                <th width="10%">S.NO</th>
                <th width="40%">NAME</th>
                <th width="20%">ID</th>
                <th width="30%">BRANCH</th>
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
                <td width="40%"><?php echo $row['NAME'];?></td>
                <td width="20%"><span class="badge badge-success"><?php echo $row['ID'];?></span></td>
                <td width="30%"><?php echo $row['BRANCH']; ?></td>
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
