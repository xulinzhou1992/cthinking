<?php
	include "../sqlclass/sqlclass.php";
	$mysql = new mySql();	//新建数据库类
	
	$loginid = $_GET['loginid'];	
	$username = strtoupper($_GET['username']);
	$email = $_GET['email'];	
	$reback = '0';
	$sql = "select userID,email from `tb_sinfo` where userID='".$username."'";
	
	 if($loginid=="0"){
		$sql = "select userID,email from `tb_sinfo` where userID='".$username."'";
	}else if($loginid=="1"){
		$sql = "select userID,email from `tb_tinfo` where userID='".$username."'";
	} 
	
	$mysql->query($sql);
	$result = $mysql->getnext();
	$mysql->close();
		
	if($result == '0'){
		$reback = '0';	//没有该用户
	}else if($result->email == $email){
		$reback = '1';	//邮箱正确
	}else{
		$reback = '2';	//邮箱错误
	}
	
	echo $reback;
?>