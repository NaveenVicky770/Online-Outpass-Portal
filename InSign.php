<?php
include('includes/server.php');
include('includes/login_validation.php');
 //IN SIGN SEARCH AND FETCH DATA TO TABLE
if (isset($_POST['Insignsearch'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    if (empty($id)) {
        array_push($errors, "ID is required");}
    $branch=$_SESSION['Branch'];
    $Role=$_SESSION['Role'];
    $batch = $_SESSION['Batch'];
    $Gender=$_SESSION['Gender'];
    $_SESSION['insignid']=$id;
        if($Role=='WARDEN'){
            $query ="SELECT NAME,ID,TIME_AND_DATE,INSIGN FROM  permanent WHERE ID='$id' AND BATCH='$batch' AND GENDER='$Gender' AND INSIGN='NOT_CHECKED'";
            
            inSign($query);  
        }
        else if($Role =='D_WARDEN'){
            $query ="SELECT NAME,ID,TIME_AND_DATE,INSIGN FROM  permanent WHERE ID='$id' AND BATCH='$batch' AND GENDER='$Gender' AND BRANCH='$branch' AND INSIGN='NOT_CHECKED'";
            
            inSign($query);           
        }
}   
?>

 <!DOCTYPE html>
<html>
<head>
	<script type="text/javascript">
    window.history.forward();

  </script>
	<title>Issue Outpass</title>
	<link rel="stylesheet" type="text/css" href="css/print_table_for_issue.css">
<link rel="stylesheet" type="text/css" href="css/print_page.css">


</head>
<?php include('includes/header.html'); ?>
<?php include('includes/nav_bar.php'); ?>

<body>
 
<div class="search-container">
      <form method="post" action="InSign.php">
        
      <input type="text" placeholder="ID Number" name="id">
      <button type="submit" name="Insignsearch">Search</button>
      </form>
</div>

	<?php 
  		if (isset($_POST['Insignsearch'])) {
  			if (count($errors) == 0) {	
  	?>
	<table id="tab5">
		
    <tr>
      <th>NAME</th>
      <th>ID</th>
      <th>OUT_DATE</th>
      <th>IN_DATE</th>
    </tr>
    <?php  while ($ro=mysqli_fetch_assoc($displayResult)) {
                
         ?>
    <tr>
      <td ><?php  echo  $ro['NAME']; ?></td>
        <td ><?php   echo  $ro['ID'];  ?></td>
        <td><?php echo  $ro['TIME_AND_DATE']; ?></td>
      <td ><?php echo  $ro['INSIGN'];?></td>
      
    </tr>
<?php } ?>
  </table>
  	<form method="post" action="InSign.php">
  	<button  class="button b1" name="in" >CHECK IN</button>
    <?php } 
}?>
  	</form>
<h4 class="error"><?php include('includes/errors.php');?></h4>
</body>
<?php include('includes/footer.html'); ?>

</html>
