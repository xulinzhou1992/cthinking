<style type="text/css">
*{
	text-align:center;
}
.loginForm{
	margin-top:20px;
}
.usernamediv,.loginiddiv,.lianjie,.button{
	margin-top:16px;
}
.lianjie{
	font-size: 14px;
}
.prompt{
	font-size: 14px;
	color: red;
	margin-top:10px;
}
.lianjie a:hover{
	text-decoration: underline;
	color:red;
}
.button input{
	width:50px;
	height:	30px;
}
.loginiddiv{
	margin-right:30px;
	font-size: 16px;
}
.usernamediv input,.passdiv input{
	text-align:left;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<form action="" class="loginForm" method="get">
	<div class="loginiddiv">	　
		<input type="radio"  name="loginid" value="0" checked="true"/>学生 
		<input type="radio"  name="loginid" value="1"/>教师 
		<input type="radio"  name="loginid" value="-1"/>管理员
	</div>
	<div class="usernamediv" id="ussernamediv">帐　号：<input type="text" class="username" /></div>
	<div class="passdiv" id="passdiv">密　码：<input type="password" class="userpass" /></div>	
	<div class="prompt" id="prompt">学生帐号请填写学号</div>
	<div class="lianjie">
	<a href="../register/register.php" target=_blank class="notRegister">没有注册？</a>　
	<a href="forgetpassword.php" target=_blank>忘记密码？</a>
	</div>
	<div class="button">		
		<input type="button" value="登录" id="loginbtn"/>　　　
		<input type="reset" value="重置" />
	</div>
</form>

<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/login.js"></script>
