<?php
   $db = mysqli_connect('localhost', 'root', '', 'database');  
    if(!$db) {
        die("Database connection failed") . mysqli_error($db);
    }
?>