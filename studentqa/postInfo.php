
<?php
	if(!session_id()){
		session_start();
	}
	$in = false;
	if(isset($_SESSION['nickname'])){
		$username= $_SESSION['nickname'];
	}else{
		$username = '';
	}
	//判断是否登录
	if(isset($_SESSION['in'])){
		$in = $_SESSION['in'];
	}
?>

<style type="text/css">
.div_height{clear: both;width: 1000px;min-height:600px;background-color: #0000;}
</style>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>学生答疑</title>
		<link href="../style.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../css/lrtk.css" />
		<link rel="stylesheet" href="../css/postInfo.css" />
		<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
		<link href="../css/cupertino/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/jquery.imgbox.pack.js"></script>
		<script type="text/javascript" src="../js/works.js"></script>
		<script type="text/javascript" src="../js/login.js"></script>
		<script type="text/javascript" src="../js/demo.js"></script>
		<script type="text/javascript" src="../js/jquery-ui-1.8.18.custom.min.js"></script>
		<!-- 配置文件 -->
	    <script type="text/javascript" src="../ueditor/ueditor.config.js"></script>
	    <!-- 编辑器源码文件 -->
	    <script type="text/javascript" src="../ueditor/ueditor.all.js"></script>
		
		<!--script type="text/javascript">
		function insertReply(reply_id,post_id)
		{ //为用户名id值(获得是object对象)
			var contentFlag = "reply_content" + reply_id;
			//alert(contentFlag);
			var name = document.getElementById("reply_content1"); //或者,form1是<form>标签的name值，username为用户名的name值 //
			//var name = form1.username;
			if(name.value == null)
			{ alert("内容不能为空！"); 
				return false; 
			} //form1是<form>标签的name值 
			document.form1.action="replyinsert.php?title_id="+post_id+"&reply_id="+reply_id;
			alert(document.getElementById("form1").action);
			document.form1.submit();
			//form1.submit();
		}
		</scrip-->
		<style type = "text/css">     
		a{color:black;text-decoration:none;}
		a.welcome:hover{color:yellow;text-decoration: none;}
		a.logoutspan:hover{color:yellow;text-decoration: none;}
		a.loginspan:hover{color:yellow;text-decoration: none;} 
		a.register:hover{color:yellow;text-decoration: none;}
		a.forgetpwd:hover{color:yellow;text-decoration: none;}    
		</style>

	</head>
	<body>
		<div id="outside">
		    <div class="box">
		        <div class="top" id="top">
				    <div class="ueser_loginout">
						<span class="wel"><a class="welcome">Hi, 欢迎您！</a>	
						<?php 
							if($in){
								echo $username;
						?>
						</span>
						<span title="退出" class="logoutspan">退出</span> 
						<?php
						}else {
							?>
							<span title="登录" class="loginspan" >登录</span>   <a color="black">|</a>
							<a class="register" href="../register/register.php" target="_blank" title="注册">注册</a>
							<a class="forgetpwd" href="../php/forgetpassword.php" target="_blank" title="忘记密码">&nbsp;&nbsp;&nbsp;&nbsp;忘记密码</a>	
							<?php 
						}
						?>	
				    </div>
		      	</div>	
		    </div>	
		</div>	

	
	<?php
		if(!session_id()){
			session_start();
		}
		$in = false;
		if(isset($_SESSION['nickname'])){
			$username= $_SESSION['nickname'];
		}else{
			$username = '';
		}
		//判断是否登录
		if(isset($_SESSION['in'])){
			$in = $_SESSION['in'];
		}
		if(!$in)
		{
			echo "<script>alert(\"请先登录!\");history.back();</script>";
			exit;
		}
		
		//显示所有已上传的文件列表
		include "../sqlclass/sqlclass.php";
		$mysql = new mySql();
		$sql = "select * from tb_reply";
		$mysql->query($sql);
		$resInfo = $mysql->getnext();
		$posting_title_id = 0;

		if(isset($_GET['title_id']))
		{
			$posting_title_id = $_GET['title_id'];  //获取studentqa.php页面传过来的title_id
			//echo $posting_title_id;
		}
		else
		{
			$posting_title_id = "-1";
		}
	
		//如果posting_title_id不为-1
		$res_title = "";
		$sql_title = "";
		$sql_reply = "";
		$res_posting = "";

		
		$sql_title = "select title from tb_alltitle where title_id='".$posting_title_id."'";//获取tb_alltile表中满足条件的title
		$mysql->query($sql_title);
		$res_title = $mysql->getnext();
		//如果res_title为空
		if($res_title == '0')
		{
			echo $sql_title;
		}

		$sql_posting = "select nickname,content,createtime from tb_posting where title_id='".$posting_title_id."'";//获取tb_posting表中满足条件的所有内容
		$mysql->query($sql_posting);
		$res_posting = $mysql->getnext();
		//如果res_posting为空
		if($res_posting == '0')
		{
			echo $sql_posting;
		}

		$postInfo_title = $res_title->title;//获取到该页面要显示的title

		//标题部分的div
		echo "<div class=\"div-head\">";		//div-head
		echo "<p class=\"taolun\">综合讨论区：".$postInfo_title."";
		echo "<a href=\"#postText\" class=\"gentie\"><button type='button' class='btn btn-primary'>跟帖</button></a></p>";
		echo "</div>";

		//正文部分的div
		echo "<div class=\"div-form\">";
		// echo "<form class=\"form_postInfo\" name=\"form1\" id=\"form1\" method=\"post\" action=\"replyinsert.php?title_id="
		// 	.$posting_title_id."\">";
		

		$numflag = 0;
			while ($res_posting != '0') {
				$numflag++;
				$postInfo_nickname = $res_posting->nickname;//获取到要显示的昵称
				$postInfo_createtime = $res_posting->createtime;//获取到要显示的回复时间
				$posting_content = $res_posting->content;//获取到要显示的内容

				echo "<script type=\"text/javascript\">";
				echo "$(document).ready(function(){";
				echo "$(\".p-btn-reply".$numflag."\").click(function(){";
				echo "$(\".panel_reply".$numflag."\").slideToggle(\"slow\")";
				echo "});";
				echo "});";
				echo "</script>";

				echo "<style type=\"text/css\">";
				echo "div.panel_reply".$numflag;
				echo "{min-height:120px; width:850px; display:none; margin-bottom: 20px;}";
				echo ".p-btn-reply".$numflag;
				echo "{color:#2d64b3; outline:0; margin-top:0px; margin-left:720px; font-size:14px;width:100px;}";
				echo "</style>";

				echo "<div class=\"one-post\">";
				echo "<div class=\"div-left\">";
				echo "<p class=\"nichen\">昵称：".$postInfo_nickname."</p>";
				echo "<p class=\"nichen\">发布时间：".$postInfo_createtime."</p>";
				echo "</div>";

				echo "<div class=\"div-right\">";
				//echo "	<div class=\"div-discuss\">讨论内容：".$posting_content."</div>";
				echo "	<div class=\"div-discuss\">".$posting_content."</div>";
				echo "	<div class=\"div-posttime\">发布时间：".$postInfo_createtime."</div>
						<div class=\"div-btn-huifu\"><p class=\"p-btn-reply".$numflag."\">回复</p></div>";
				

				$sql_reply = "select nickname,content,createtime from tb_reply where title_id='".$posting_title_id."' and post_id='".$numflag."'";
				$mysql_reply = new mySql();
				$mysql_reply->query($sql_reply);
				$res_reply = $mysql_reply->getnext();

				echo "<div class=\"div-post\">";
				//如果res_reply为空
				while($res_reply != '0')
				{
					echo "<p class=\"post-content\">".$res_reply->nickname."：".$res_reply->content."</p>";
					echo "<p class=\"post-time\">".$res_reply->createtime."</p>";
					$res_reply = $mysql_reply->getnext();
				}	
				
				echo "<div class=\"reply-area\">";
				echo "<div class=\"panel_reply".$numflag."\">";
				echo "<form class=\"form_postInfo\" name=\"form1\" id=\"form1\" method=\"post\" action=\"replyinsert.php?title_id=".$posting_title_id."&reply_id=".$numflag."\">";
				echo "<script id=\"container".$numflag."\" name=\"reply_content\" type=\"text/plain\" class=\"reply_content\"></script>";
				echo "<script type=\"text/javascript\">var ue = UE.getEditor('container".$numflag."',{maximumWords:100,initialFrameHeight:100,initialFrameWidth:600});</script>";
				//echo "<textarea class=\"reply_content\" name=\"reply_content\" cols=133 rows=6></textarea>";
				echo "<input class=\"post-sure\" type=\"submit\" value=\"确定\">";
				echo "</form>";
				
				echo "</div>";
				echo "</div>";
				echo "</div>";
				echo "</div>";
				echo "</div>";
				echo "<div style=\"font: 0px/0px sans-serif;clear: both;display:block\"> </div>";
				$res_posting = $mysql->getnext();
			}
		echo "</div>";
		echo "</div>";
		
		echo "</div>";
		echo "</div>";
		echo "<div id='gen' class='gen'>";
		echo "<a name=\"postText\">";
		echo "<form class=\"form_postInfo\" name=\"form2\" method=\"post\" action=\"postInfoinsert.php?title_id=".$posting_title_id."\">";
		echo "<script id=\"container\" name=\"gentie_content\" type=\"text/plain\" class=\"form-control\" placeholder='输入跟帖内容'></script>";
		echo "<script type=\"text/javascript\">var gentie_ue = UE.getEditor('container',{maximumWords:100,initialFrameHeight:100,initialFrameWidth:600});</script>";
		//echo "<textarea class='form-control' rows='6' cols='82' name=\"gentie_content\"placeholder='输入跟帖内容'></textarea>";
		echo "<div>";
		echo "<button type='submit' class='btn btn-primary' id='button1'>确定</button><button type='reset' class='btn btn-primary'id='button1'>重置</button>";
		echo "</div>";
		echo"</form></a>";
		echo "</div>";

		$mysql->close();
	?>
</body>
</html>