<?php
   $db = mysqli_connect('localhost', 'root', '', 'outpass_portal');  
    if(!$db) {
        die("Database connection failed") . mysqli_error($db);
    }
?>