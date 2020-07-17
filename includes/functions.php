<?php

include('db_connect.php');

function fetch_data($query){
    global $db,$errors;
    $result =mysqli_query($db,$query);
        if (mysqli_num_rows($result) == 1)
        { 
            while ($rows=mysqli_fetch_assoc($result)) 
            {
                $_SESSION['name']=$rows['NAME'];
                $_SESSION['id']=$rows['ID'];  
                header('location:print.php');
            }
        }

        else
        {
            array_push($errors, "ID not Found");
        }
}

function studentDetails($qu,$query){
    global $db,$errors;
    //counting no of outings
    $out=mysqli_query($db,$qu);
    while($row2=mysqli_fetch_assoc($out))
    {$_SESSION['outing']=$row2['COUNT(ID)']; }
    //fetch data from database
    $result =mysqli_query($db,$query);
            if (mysqli_num_rows($result) == 1){ 
            while ($rows=mysqli_fetch_assoc($result)) {  
                $_SESSION['nam']=$rows['NAME'];
                $_SESSION['ids']=$rows['ID'];
                $_SESSION['branch2']=$rows['BRANCH'];
                $_SESSION['parentsno']=$rows['PARENTS_NO'];
                $_SESSION['address']=$rows['ADDRESS']; 
                }
            }
            else{
             array_push($errors, "ID not Found");
            }  
}

function inSign($query){
    global $db,$displayResult,$errors;
    $result = mysqli_query($db,$query);
    if(mysqli_num_rows($result)>=1){
        while ($r=mysqli_fetch_assoc($result)) {
          $_SESSION['in']=$r['INSIGN'];
        }
    }
    else{
        array_push($errors,"Outpass has not taken");
    }
    $displayResult =mysqli_query($db,$query);
}

?>