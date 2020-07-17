<?php
	if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
	    //header("Location: login.php");
	    die("You must login first, Go to http://localhost/online_outpass_portal/login.php to login");
	}
?>