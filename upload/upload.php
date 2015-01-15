<?php
session_start();
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
.file-box{ position:relative;width:340px} 
.txt{ height:22px; border:1px solid #cdcdcd; width:180px;} 
.btn{ background-color:#FFF; border:1px solid #CDCDCD;height:24px; width:70px;} 
.file{ position:absolute; top:0; right:80px; height:24px; filter:alpha(opacity:0);opacity: 0;width:260px }
a:link {color:blue; text-decoration:underline;}
a:visited {color:red; text-decoration:underline;}
a:hover {color: yellow; text-decoration:underline;}
.innerframe{margin-left: 0px;}
.uploadinfo{width: 600px;}
.uploadtable{margin-left: -5px;}
.kejian,.uploader,.uploadtime{font-size: 15px;}
.rows{height: 25px;}



</style>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>上传课件</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/lrtk.css" />
<link href="../css/cupertino/jquery-ui-1.8.18.custom.css" rel="stylesheet" />

<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.imgbox.pack.js"></script>
<script type="text/javascript" src="../js/works.js"></script>
<script type="text/javascript" src="../js/login.js"></script>
<script type="text/javascript" src="../js/demo.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="../js/login_chceck.js"></script>
</head>
<body>

<div class="rightpart">
		<div class="innerframe">
		<br />
		<br />
		<br />
		<?php
		//如果已登录，显示上传界面
			if($in){
				echo "<p class=\"\" align=\"center\">上传文件仅限于.ppt、.pptx、.pdf，且文件大小不超过20M</p>";
				echo "<div class=\"file-box\" align=\"center\">
				<form action=\"upload_file.php\" method=\"post\" enctype=\"multipart/form-data\">
				<input type=\"text\" name=\"textfield\" id=\"textfield\" class=\"txt\" />
				<input type=\"button\" class=\"btn\" value=\"浏览\" />
				<input type=\"file\" name=\"file\" class=\"file\" id=\"file\" size=\"28\" onchange=\"document.getElementById('textfield').value=this.value\" />
				<input type=\"submit\" name=\"submit\" class=\"btn\" value=\"上传\" />
				</form></div>";
			}
			else
			{
				echo "<p align=\"center\">请先登录，方可上传文件</p>";
			}				
		?>
		<br />
		<br />
		<br />
		<?php
		//显示所有已上传的文件列表
			include "../sqlclass/sqlclass.php";
			$mysql = new mySql();
			$sql = "select * from upload_file";
			$mysql->query($sql);
			$resInfo = $mysql->getnext();

			echo "<table class=\"uploadtable\" border=\"0\" cellspacing=\"10\" width=\"600\">";
			echo "<tr>
			<th class=\"kejian\" align=\"center\" width=\"300\">课件名</th>
			<th class=\"uploader\" align=\"left\" width=\"70\">上传者</th>
			<th class=\"uploadtime\" align=\"left\" width=\"100\">上传时间</th>
			<th align=\"left\" width=\"50\">管理</th>
			</tr>";

			while ($resInfo != '0') {
				echo "<tr class=\"rows\">";
				echo "<td align=\"center\"><a href=".$resInfo->new_name.">".$resInfo->old_name."</a></td>";
				echo "<td>".$resInfo->user_name."</td><td>".$resInfo->date."</td>";
				echo "<td>";
				if($resInfo->user_name == $username)
				{
					echo "<a href=manage_file.php?id=".$resInfo->new_name.">删除</a>";
				}
				else
				{
					echo "&nbsp;";
				}
				echo "</td>";
				echo "</tr>";
				$resInfo = $mysql->getnext();
			}
			echo "</table>";
			$mysql->close();
		?>
		</div>
	</div>    
</div>
</body>
</html>