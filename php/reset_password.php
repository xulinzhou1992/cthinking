<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
	if(isset($_GET["s"]))
	{
		$en_username = $_GET["s"];
	}
	else
	{
		exit;
	}
	$en_password = $_GET["a"];
	$loginid = $_GET["o"];
	$username = base64_decode($en_username);
	$password = base64_decode($en_password);

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
	$mysql->query($sql);
	$resInfo = $mysql->getnext();
	if($resInfo == '0')
	{
		echo "<p>验证码已失效！</p>";
		exit;
	}
	echo "<html>
	<head>
	</head>
	<body>
	<form action=\"\" method=\"post\">
	新密码<input type=\"password\" name=\"new_ps\"><br />
	确认新密码<input type=\"password\" name=\"ensure_ps\"><br />
	<input type=\"submit\" name=\"submit\" value=\"提交\">
	</form>
	</body>
	</html>";

	if(isset($_POST["new_ps"]))
	{
		$new_ps = $_POST["new_ps"];
	}
	else
	{
		$new_ps = "";
	}
	if(isset($_POST["ensure_ps"]))
	{
		$ensure_ps = $_POST["ensure_ps"];
	}
	else
	{
		$ensure_ps = "";
	}
	if($new_ps != "" && $ensure_ps != "")
	{
		if($new_ps != $ensure_ps)
		{
			echo "<script language=\"JavaScript\">\r\nalert(\"两次密码不符合，请重新输入\");\r\nwindow.location.href=\"\";\r\n</script>";
		}
		else
		{
			if(strlen($new_ps) < 6)
			{
				echo "<p>密码太短！</p>";
				exit;
			}
			if($loginid == '0')
			{
				$sql = "update tb_sinfo set password=MD5('".$new_ps."') where userId='".$username."'";
			}
			else if($loginid == '1')
			{
				$sql = "update tb_tinfo set password=MD5('".$new_ps."') where userId='".$username."'";
			}
			$mysql->update($sql);
			if($loginid == '0')
			{
				$sql = "delete from s_reset_password where userId='".$username."'";
			}
			else if($loginid == '1')
			{
				$sql = "delete from t_reset_password where userId='".$username."'";
			}
			$mysql->delete($sql);
			$mysql->close();
			echo "<script>alert(\"密码修改成功！\");window.location.href=\"../index.php\"</script>";
		}
	}
	else
	{
		echo "<p>密码栏不能为空</p>";
	}

?>