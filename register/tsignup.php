<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

include "../sqlclass/sqlclass.php";
if (!isset($_POST['t_userID'])) {
	# code...
	echo "<script>alert('信息提交失败，请重新注册！');window.location.href='register.php';</script>";
	exit;
}

$userID = strtoupper($_POST["t_userID"]);
$truename = $_POST["t_truename"];
$nickname = $_POST["t_nickname"];
$email = strtolower($_POST["t_email"]);
$password = $_POST["t_password"];

$mysql = new mySql();	//新建数据库类
mysql_query("set names 'utf8'"); //使用utf8编码;解决中文乱码问题
	
//md5()is a one-way encryption
$sql = "insert into tb_tinfo(userID,truename,nickname,email,password)".
		"values('$userID','$truename','$nickname','$email',MD5('$password'))";
		//mysql_query($sql);
$result = $mysql->insert($sql);
$mysql->close();
$url = "../index.php";
?>
<html>
<head>
<meta http-equiv="refresh" content="5; url=<?php echo $url; ?>">
</head>
<body>
<h2 style="text-align:center">信息提交成功！请等待管理员审批!</h2>
<p align="center">五秒后自动返回！</p>
</body>
</html> 
