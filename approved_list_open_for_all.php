<?php 
  include ('includes/server.php');
  $query="SELECT * FROM approved";
  $result =mysqli_query($db,$query);  
?>

<?php include('includes/header.html'); ?>
<div class="container-fluid bg-primary text-white" style="padding:1%;">
    <div class="row">
        <div class="col-lg-6">
            <img src="resources/rgukt.png" style="float: left; height: 38px; filter: brightness(0) invert(1); margin-right:2%;">
            <h3>ONLINE-OUTPASS</h3>
        </div>
        <div class="col-lg-6" style="text-align: right;">
            <h4 id="college">IIIT ONGOLE RGUKT AP</h4>
        </div>
    </div>
</div>
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
