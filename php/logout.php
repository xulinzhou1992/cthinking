<?php
	session_start();	//开启session
	$_SESSION['in'] = false;
	$_SESSION['nickname'] = '';
	$_SESSION['loginID'] = "";
	header('Location:../index.php');
?>