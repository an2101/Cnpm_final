<?php 	
	session_start();
	session_destroy();
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('Your request has been submitted you will be logged out');
    window.location.href='../../index.php';
    </script>");

 ?>