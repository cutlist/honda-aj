<?php
session_start();
	
date_default_timezone_set("Asia/Jakarta");

$ip 	  = $_SERVER['REMOTE_ADDR'];
$hostname = strtoupper (gethostbyaddr($ip));
$updatex  = $_SESSION[user]." ".date("Y-m-d H:i:s")." ".$ip." ".$hostname;
/*
$idletime = 900;

if (time()-$_SESSION['timestamp']>$idletime)
	{
    session_destroy();
    session_unset();
	}
else{
    $_SESSION['timestamp']=time();
	}
	
$_SESSION['timestamp']=time();
*/
include "connect.php";

		
?>