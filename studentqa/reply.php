<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/studentqa.css" rel="stylesheet" type="text/css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript"> 
$(document).ready(function(){
  $(".post_reply").click(function(){
    $(".panel").slideDown("slow");
  });
});
</script>
<style type="text/css"> 
tr.panel
{
height:120px;
display:none;
}
</style>
</head>
<body>
	
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
			echo $posting_title_id;
		}
		else
		{
			$posting_title_id = "-1";
		}
		//echo "<form action=\"replyinsert.php?title_id='".$posting_title_id."' method=\"post\">";
		echo "<form method=\"post\" >";
		echo "<table width=\"750px\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"1\" bordercolor=\"#FFFFFF\" bgcolor=\"#6EBEC7\" >";
		echo "<tr height=\"30px\">";
		

		//如果posting_title_id不为-1
		$res_title = "";
		$sql_title = "";
		$res_posting = "";

		
			$sql_title = "select title from tb_alltitle where title_id='".$posting_title_id."'";//获取tb_alltile表中满足条件的title
			$sql_posting = "select nickname,content,createtime from tb_posting where title_id='".$posting_title_id."'";//获取tb_posting表中满足条件的所有内容
			$mysql->query($sql_title);
			$res_title = $mysql->getnext();
		
			//如果res_title为空
			if($res_title == '0')
			{
				echo $sql_title;
			}

			$mysql->query($sql_posting);
			$res_posting = $mysql->getnext();

			//如果res_posting为空
			if($res_posting == '0')
			{
				echo $sql_posting;
			}
		
		
		
			$postInfo_title = $res_title->title;//获取到该页面要显示的title
			$postInfo_nickname = $res_posting->nickname;//获取到要显示的昵称
			$postInfo_createtime = $res_posting->createtime;//获取到要显示的回复时间
			$posting_content = $res_posting->content;//获取到要显示的内容
			
			while ($resInfo != '0') {
				echo "<td width=20% align=\"left\"><p>昵称：".$postInfo_nickname."</p>
					<p>发布时间：<br>".$postInfo_createtime."</p></td>";
				echo "<td align=\"center\">".$posting_content."<p class=\"post_reply\">回复</p></td>";
				echo "</tr><tr class=\"panel\">
					<td align=\"center\"></td>
					<td>
						<textarea name=\"reply_content\" cols=82 rows=6></textarea>
						
						<input type=\"button\" value=\"确定\" onclick=\"location='postInfoinsert.php?title_id=".
							$posting_title_id."'\">
					</td>";
				echo "</tr>";
				$resInfo = $mysql->getnext();
			}
		
		echo "</table>";
		echo "</form>";
		
		$mysql->close();
	?>
</body>
</html>