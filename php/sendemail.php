<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

require_once ('emailclass.php');

$smtpserver = "smtp.163.com";//SMTP服务器
$smtpserverport =25;//SMTP服务器端口
$smtpusermail = "cthinking@163.com";//SMTP服务器的用户邮箱，发邮件的邮箱
$smtpemailto = $_GET["email"];//发送给谁
$smtpuser = "cthinking@163.com";//SMTP服务器的用户帐号
$smtppass = "hustcthinking";//SMTP服务器的用户密码
$mailsubject = "计算思维密码重置邮件系统";//邮件主题
// $mailbody = "<h1> 单击该链接重置密码http://www.baidu.com</h1><a href=\"www.baidu.com\">点击验证</a>";
$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
$username = $_GET["username"];
$en_username = base64_encode($username);
$loginid = $_GET["loginid"];
//生成随机字符串作为验证码
$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
$password = '';

for ( $i = 0; $i < 20; $i++ ) 
{
	$password .= $chars[ mt_rand(0, strlen($chars) - 1) ];
}

include "../sqlclass/sqlclass.php";
$mysql = new mySql();
if($loginid == '0')
{
	$sql = "select * from s_reset_password where userId='".$username."'";
}
else if($loginid == '1')
{
	$sql = "select * from t_reset_password where userId='".$username."'";
}
else
{
	exit;
}
//echo $sql."<br />";
$mysql->query($sql);
$resInfo = $mysql->getnext();
if ($resInfo != '0') {
	if($loginid == '0')
	{
		$sql = "update s_reset_password set password='".$password."' where userId='".$username."'";
	}
	else if($loginid == '1')
	{
		$sql = "update t_reset_password set password='".$password."' where userId='".$username."'";
	}
}
else
{
	if($loginid == '0')
	{
		$sql = "insert into s_reset_password values('".$username."','".$password."')";
	}
	else if ($loginid == '1') {
		$sql = "insert into t_reset_password values('".$username."','".$password."')";
	}
}
//echo $sql."<br />";
$mysql->query($sql);
$mailbody = "<h1>您好，".substr($username,0,2)."***".substr($username,strlen($username)-2,2).":单击该链接重置密码http://2.cthinking.sinaapp.com/php/reset_password.php?a=".$password."&s=".$en_username."&o=".$loginid."<br />如果该链接无法跳转，请复制链接到浏览器中打开。</h1>";
$mysql->close();



$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.后面的两个参数就是用户名和密码
$smtp->debug = false;//是否显示发送的调试信息，socket通讯时返回的信息，用程序来处理
$isSend = $smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
if($isSend == TRUE)
{
	echo "<script>alert(\"发送成功\");</script>";
}
else
{
	echo "<script>alert(\"发送失败\");window.history.back();</script>";
}
$url = "../index.php";//首页地址
?>
<html>
<head>
<meta http-equiv="refresh" content="3; url=<?php echo $url; ?>">
</head>
<body>
<h2 style="text-align:center">邮件发送成功！</h2>
<p align="center">三秒后自动返回首页！</p>
</body>
</html>