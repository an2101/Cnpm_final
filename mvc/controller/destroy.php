<?php 	
	session_start();
	session_destroy();
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('Your exam is completed, you will be now logged out');
    window.location.href='../../index.php';
    </script>");

 ?>