<?php
session_start();
// initializing variables
$username = "";
$email    = "";
$errors = array(); 
$_SESSION['del']=1;

// connect to the database and include functions
include('includes/db_connect.php');
include('includes/functions.php');

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['user']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
    
  if (empty($username) || empty($password)) {
    if (empty($username)) { array_push($errors, "Username is required"); }
    else if(empty($password)) { array_push($errors, "Password is required");}
  }
  else {
    //$password = md5($password); 
      
    $query = "SELECT * FROM users WHERE username='$username' AND password ='$password'";
    $rq=array();
    $res1 = mysqli_query($db, $query);
    if (mysqli_num_rows($res1) == 1){
        while ($row=mysqli_fetch_assoc($res1)) {
        $_SESSION['userLogin']='true';
        $_SESSION['username']=$row['username'];
        $_SESSION['Branch']=$row['Branch'];
        $_SESSION['Batch']=$row['BATCH'];
        $_SESSION['Role'] =$row['Role']; 
        $_SESSION['Gender']=$row['GENDER'];    
      }
      header('location: welcome.php');
    }
    else{
       array_push($errors, "Authentication Failed!"); 
    }
  }
}

//Searching ID to issue outpass
if (isset($_POST['search_student'])) {
    $id = mysqli_real_escape_string($db, $_POST['box']);
    if (empty($id)) {
    array_push($errors, "ID required");
    }
    else{
         $batch1 = $_SESSION['Batch'];
    $branch=$_SESSION['Branch'];
    $Role=$_SESSION['Role'];
    $Gender= $_SESSION['Gender'];
    
        if($_SESSION['Role'] == 'WARDEN')//For Warden Login
        {
          $query ="SELECT * FROM  st_1 WHERE ID='$id' AND BATCH='$batch1' AND GENDER='$Gender'";
          fetch_data($query);   
        }
        else if($_SESSION['Role'] == 'DEAN') //For DEAN login
        {
          $query ="SELECT * FROM  st_1 WHERE ID='$id'";
          fetch_data($query);
        } 
        else if($_SESSION['Role'] == 'D_WARDEN')
        {
          $query ="SELECT * FROM  st_1 WHERE ID='$id' AND BATCH='$batch1' AND BRANCH='$branch' AND GENDER='$Gender'";
          fetch_data($query);        
        }
    }
    
   
}

//approve
if (isset($_POST['approve']) ){
          $query13="SHOW EVENTS";
          $events=mysqli_query($db,$query13);
          while ($a=mysqli_fetch_assoc($events)) {
              if($a['Name']==$_SESSION['del']){
                $_SESSION['del']=$_SESSION['del']+1;
              }
          }
          $del=$_SESSION['del'];
          $id =  $_SESSION['id'];
          $Gender= $_SESSION['Gender'];
    
          $query ="SELECT * FROM approved WHERE ID='$id'";
          $result =mysqli_query($db,$query);
          $query1="SELECT * FROM permanent WHERE ID='$id' AND INSIGN='NOT_CHECKED'";
          $result1 =mysqli_query($db,$query1);
          if(mysqli_num_rows($result)==1)
          {
              if(!isset($_POST['check'])){
                   array_push($errors, "Please tick the check box");}
              else{
                  array_push($errors, "Already issued outpass for this ID");}
          }
         if(mysqli_num_rows($result1)>=1)
          {
              if(!isset($_POST['check'])){
                    array_push($errors, "Please tick the check box");}
              else{
                    array_push($errors, "Please Insign for previous");}
          }
            
        else{  
               $guardian=mysqli_real_escape_string($db, $_POST['guardian']);
               $contact=mysqli_real_escape_string($db, $_POST['contact']);
               $aadhar=mysqli_real_escape_string($db, $_POST['aadhar']);
               $relation=mysqli_real_escape_string($db, $_POST['relation']);
               $reason= mysqli_real_escape_string($db, $_POST['reason']);
               $days=mysqli_real_escape_string($db, $_POST['days']);
               $username=$_SESSION['username'];
               date_default_timezone_set('Asia/Kolkata'); //setting time Zone and it is 24 hours format only
               $date=date('Y-m-d H:i:s');
               $date_tmrw=date('Y-m-d H:i:s',strtotime("+60 seconds"));

              //in approved warden means the person or role who approved that outpass.
                    if(isset($_POST['check'])){
                        $del=$_SESSION['del'];
                        $id =  $_SESSION['id'];
                        //insert and update data to approved table
                        $query1="INSERT INTO approved(NAME,ID,BRANCH,BATCH,GENDER) SELECT NAME,ID,BRANCH,BATCH,GENDER FROM st_1 WHERE ID ='$id'";
                        $qu12="UPDATE approved SET ISSUED_BY='$username', TIME_AND_DATE='$date' WHERE ID='$id'";
                        mysqli_query($db,$qu12);
                        mysqli_query($db,$query1);

                        //Creating event to delete record from approved after 24hrs
                        $query11="CREATE DEFINER='root'@'localhost'EVENT `$del` ON SCHEDULE AT '$date_tmrw' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM approved WHERE id='$id'";
                        mysqli_query($db,$query11);

                        //insert and update data to permanent table
                        $query4="INSERT INTO permanent(NAME,ID,BRANCH,BATCH,GENDER) SELECT NAME,ID,BRANCH,BATCH,GENDER FROM st_1 WHERE ID ='$id'";
                    
                        $qPer="UPDATE permanent SET TIME_AND_DATE='$date', REASON='$reason',
                        WARDEN='$username',DAYS='$days',GUARDIAN_NAME='$guardian',CONTACT_NUMBER='$contact',
                        RELATION='$relation',AADHAR_NUMBER='$aadhar' WHERE ID='$id' AND INSIGN='NOT_CHECKED'";
                        mysqli_query($db,$query4);
                        mysqli_query($db,$qPer);

                        header('location:approve.php');}
                    else{
                    array_push($errors, "PLEASE APPROVE AND THEN SUBMIT");}
                    }
      }

//student details page and dashboard
if (isset($_POST['search_student_details'])) {
    $id = mysqli_real_escape_string($db, $_POST['box']);
    if (empty($id)) {
        array_push($errors, "ID is required");
    }
    else{
        $Role=$_SESSION['Role'];
    $Gender=$_SESSION['Gender'];
    $_SESSION['fordetails']=$id;
    $batch = $_SESSION['Batch'];
    $branch=$_SESSION['Branch'];
    //to count no of outings
    $qu="SELECT COUNT(ID) FROM permanent WHERE ID='$id'";
    
    if($_SESSION['Role'] == 'WARDEN'){
        //fetch with correct permissions details
        $query ="SELECT * FROM  st_1 WHERE ID='$id' AND BATCH='$batch'AND GENDER='$Gender'";
        studentDetails($qu,$query);
             
    }
    else if($_SESSION['Role'] == 'D_WARDEN'){
        //fetch with correct permissions details
        $query ="SELECT * FROM  st_1 WHERE ID='$id' AND BATCH='$batch' AND BRANCH='$branch' AND GENDER='$Gender'";
        studentDetails($qu,$query);
    }
    else if($_SESSION['Role'] == 'DEAN'){
        //fetch with correct permissions details
        $query ="SELECT * FROM  st_1 WHERE ID='$id'";
        studentDetails($qu,$query);
    }
    }
    
}

//IN SIGN CHECKED IN OR NOT
    if (isset($_POST['in'])) {
       if ($_SESSION['in'] == 'NOT_CHECKED') {
            $i=$_SESSION['insignid'];
            date_default_timezone_set('Asia/Kolkata');
            $now=time();
            $datein=''.date('Y-m-d H:i:s');
            $qu="UPDATE permanent SET INSIGN='$datein' WHERE ID='$i' AND INSIGN = 'NOT_CHECKED'";
            mysqli_query($db,$qu);
            array_push($errors, "Checked in Successfully");  
            $TIME_AND_DATE="SELECT TIME_AND_DATE FROM permanent WHERE ID='$i' AND REMARKS = 'NOT'";
            $result=mysqli_query($db,$TIME_AND_DATE);
            while ($rows=mysqli_fetch_assoc($result)) {
                $out=$rows['TIME_AND_DATE'];  
            }
            $DAYS="SELECT DAYS FROM permanent WHERE ID='$i' AND REMARKS = 'NOT'";
            $re=mysqli_query($db,$DAYS);
            while ($rows=mysqli_fetch_assoc($re)) {
                $days=$rows['DAYS'];  
            }    
            $out1=strtotime($out);
            $diff=$now-$out1;
            $_SESSION['diff']=round($diff / (60 * 60 * 24));
            $diff1=$_SESSION['diff'];
            //Update Regular status based on out time period(diff1)
            $qu="UPDATE permanent SET REMARKS='REGULAR' WHERE ID='$i' AND REMARKS = 'NOT'";
            if ($diff1 == '$days') {
            mysqli_query($db,$qu);      
            }
            elseif ($diff1 < '$days') {
            mysqli_query($db,$qu);        
            }      
            else if($diff1 > '$days'){
            $qu1="UPDATE permanent SET REMARKS='IRREGULAR' WHERE ID='$i' AND REMARKS = 'NOT'";
            mysqli_query($db,$qu1);
            }            
        }
        else{
          array_push($errors, "Already checked in");
        }
    }

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $Role=mysqli_real_escape_string($db, $_POST['role']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $includes/errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($Role)) { array_push($errors, "Role must be checked"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }
  // Finally, register user if there are no includes/errors in the form
  if (count($errors) == 0) {
  	//$password = md5($password_1);//encrypt the password before saving in the database

    //Encyrpting the password for more security
    $hashFormat = "$2y$10$";
    $salt="iamtryingtomakepasswordmoresecure";//should be atleast 22 characters
    $hashF_and_salt = $hashFormat . $salt;
    $password =crypt($password_1,$hashF_and_salt );
      
  	$query = "INSERT INTO users (username, email, password, Role) 
  			  VALUES('$username', '$email', '$password','$Role')";
  	$registerQuery=mysqli_query($db, $query);
    
    if(!$registerQuery){
        die('Registration Failed');
    }
      else{
          echo "Registration Successful..!";
      }
  }
}
?>
