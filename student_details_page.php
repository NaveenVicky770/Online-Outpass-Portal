<?php 
include ('includes/server.php'); 
include('includes/login_validation.php'); 
      
//total students for dashboard
    $Gender=$_SESSION['Gender'];
    $branch=$_SESSION['Branch'];
    $approvedby=$_SESSION['username'];
    $batch=$_SESSION['Batch'];
    $Role=$_SESSION['Role'];
    if($Role == 'WARDEN'){
              $total="SELECT COUNT(*) FROM st_1  WHERE BATCH='$batch' AND GENDER='$Gender'";
              $total_n=mysqli_query($db,$total);
              $query ="SELECT COUNT(*) FROM permanent WHERE BATCH='$batch' AND GENDER='$Gender' AND  INSIGN='NOT_CHECKED'";
              $result =mysqli_query($db,$query);
        }
  else if($Role=='D_WARDEN'){
          $total="SELECT COUNT(*) FROM st_1  WHERE BATCH='$batch' AND GENDER='$Gender' AND BRANCH='$branch'";
          $total_n=mysqli_query($db,$total);
          $query ="SELECT COUNT(*) FROM permanent WHERE BATCH='$batch' AND GENDER='$Gender' AND BRANCH='$branch' AND  INSIGN='NOT_CHECKED'";
          $result =mysqli_query($db,$query);
        }
   else if($Role=='DEAN'){
          $total="SELECT COUNT(*) FROM st_1";
          $total_n=mysqli_query($db,$total);
          $query ="SELECT COUNT(*) FROM permanent ";
          $result =mysqli_query($db,$query);
        }
       
  /*else{
      //header('Location:login.php');
      $query="SELECT COUNT(*) FROM permanent";
      $result =mysqli_query($db,$query);  
  }*/
    //$out="SELECT COUNT(*) FROM permanent WHERE INSIGN='NOT_CHECKED'";
    //$out_n=mysqli_query($db,$out);
    while ($rows=mysqli_fetch_assoc($result)) {
        $out=$rows['COUNT(*)'];  
    }
    while ($row=mysqli_fetch_assoc($total_n)) {
        $total=$row['COUNT(*)'];  
    }
    $in=$total-$out;


// OUTPASS PREVIOUS DETAILS OF STUDENTS

    if (isset($_POST['DETAILS'])) {
      if ($_SESSION['outing'] == 0) {
        array_push($errors, 'NO DETAILS FOUND');
      }
      else{
        $id=$_SESSION['fordetails'];
        $Role=$_SESSION['Role'];
        $Gender=$_SESSION['Gender'];
        $batch=$_SESSION['Batch'];
        $branch=$_SESSION['Branch'];
      if($Role == 'WARDEN'){
            $query ="SELECT NAME,ID,TIME_AND_DATE,INSIGN,DAYS,REASON,REMARKS FROM  permanent WHERE ID='$id' AND BATCH='$batch' AND GENDER='$Gender'";
            $re=mysqli_query($db,$query);
      }
      else if($Role=='D_WARDEN'){
          $query ="SELECT NAME,ID,TIME_AND_DATE,INSIGN,REASON,DAYS,REMARKS FROM  permanent WHERE ID='$id' AND BRANCH='$branch' AND BATCH='$batch' AND GENDER='$Gender'";
          $re=mysqli_query($db,$query);}
      else if($_SESSION['Role'] == 'DEAN'){
            $query ="SELECT NAME,ID,TIME_AND_DATE,INSIGN,REASON,DAYS,REMARKS FROM  permanent WHERE ID='$id'";
            $re=mysqli_query($db,$query);
      }     
   }
 }
?>

<?php include('includes/header.html'); ?>
<?php include('includes/nav_bar.php'); ?>

<br>
<br>
<br>

<?php  
if (count($errors) > 0){ ?>
<div class="container">
    <div class="alert alert-danger alert-dismissible " style="text-align:center;">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong><?php include ('includes/errors.php');?></strong>
    </div>
</div>

<?php } ?>

<div>
    <form id="student_det" method="post" action="student_details_page.php">
        <div class="input-group ">
            <input name="box" type="text" class="form-control" placeholder="Search ID number">
            <div class="input-group-append">
                <button name="search_student_details" class="btn btn-outline-success " type="submit">Button</button>
            </div>
        </div>
    </form>
</div>

<br>
<br>
<br>

<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <table class="table table-lg table-success">
                <tr>
                    <th>TOTAL</th>
                    <td><span class="badge badge-primary"><?php echo $total;  ?></span></td>
                </tr>
                <tr>
                    <th>OUT</th>
                    <td><span class="badge badge-danger"><?php echo $out;  ?></span></td>
                </tr>
                <tr>
                    <th>IN CAMPUS</th>
                    <td><span class="badge badge-success"><?php echo $in;  ?></span></td>
                </tr>
            </table>
        </div>
        <div class="col-lg-9">
            <form method="post" action="student_details_page.php">
                <?php 
      if (isset($_POST['search_student_details'])) {
         if (count($errors) == 0){
      
    ?>
                <table class="table table-primary">
                    <tr>
                        <th>NAME</th>
                        <td><span class="badge badge-success"><?php echo $_SESSION['nam']; ?></span></td>
                        <th colspan="2">PERSONAL DETAILS</th>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <td><span class="badge badge-success"><?php echo $_SESSION['ids']; ?></span></td>
                        <th>PARENTS PHONE NO:</th>
                        <td><?php echo $_SESSION['parentsno']; ?></td>
                    </tr>
                    <tr>
                        <th>BRANCH</th>
                        <td><?php echo $_SESSION['branch2']; ?></td>
                        <th>ADDRESS</th>
                        <td><?php echo $_SESSION['address']; ?></td>
                    </tr>
                    <tr>
                        <th>NO OF OUTINGS:</th>
                        <td><span class="badge badge-primary"><?php echo $_SESSION['outing']; ?></td>
                        <th>PREVIOUS OUTPASS DETAILS</th>
                        <td><button class='btn btn-danger btn-sm' name="DETAILS">DETAILS</button></td>
                    </tr>
                </table>
                <?php  } }?>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#student_prev_outpass_details_table').DataTable();
        responsive: true
    });

</script>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php 
      if (isset($_POST['DETAILS'])) {
         if (count($errors) == 0){
    ?>
            <table id="student_prev_outpass_details_table" class="table  table-bordered table-danger table-hover table-responsive-sm table-responsive-md  w-auto">
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>ID</th>
                        <th>OUT_DATE</th>
                        <th>IN_DATE</th>
                        <th>REASON</th>
                        <th>DAYS</th>
                        <th>REMARKS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r=mysqli_fetch_assoc($re)) {
          ?>
                    <tr>
                        <td><span class="badge badge-primary"><?php  echo $r['NAME']; ?></span></td>
                        <td><?php   echo $r['ID'];  ?></td>
                        <td><span class="badge badge-danger"><?php echo $r['TIME_AND_DATE']; ?></span></td>
                        <td><span class="badge badge-success"><?php echo $r['INSIGN']; ?></span></td>
                        <td><?php echo $r['REASON']; ?></td>
                        <td><?php echo $r['DAYS']; ?></td>
                        <td><span class="badge badge-danger"><?php echo $r['REMARKS'];?></span></td>
                    </tr>
                    <?php  }}} ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<br>
<br>
<br>

<?php include('includes/footer.html'); ?>
