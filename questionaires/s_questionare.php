<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
	if($in == false)
	{
		echo "<script>alert(\"请登录后再访问！\");window.close();</script>";
		exit;
	}
	include '../sqlclass/sqlclass.php';
	$mysql = new mySql();
	$sql = "select * from tb_sinfo where nickname='".$username."'";
	$mysql->query($sql);
	$res = $mysql->getnext();
	if($res == '0')
	{
		$mysql->close();
		echo "<script>alert(\"请登录后再访问！\");window.close();</script>";
	}
	else
	{
		$sql = "select * from s_questionare_tb where sno='".$res->userID."'";
		$mysql->query($sql);
		$res = $mysql->getnext();
		if ($res != '0') {
			# code...
			$mysql->close();
			echo "<script>alert(\"您已填写过问卷！\");window.location.href=\"s_questionare_result.php\";</script>";
		}
		$mysql->close();
	}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>问卷调查</title>

		<link href="questionare/style.css" rel="stylesheet" type="text/css">
		<script src="questionare/common.js"></script>
		<style type="text/css">
			.STYLE1 {
				color: #000000
			}

			#votePagingDiv {
				width: 200px;
				margin: auto;
				line-height: 40px;
				CLEAR: both
			}

			#votePagingDiv a {
				border: #eee 1px solid;
				padding: 3px 5px;
				TEXT-DECORATION: none
			}

			li {
				margin: 0px;
				padding: 0px;
				list-style-type: none
			}

			ul {
				margin: 0px;
				padding: 0px;
			}
		</style>		
	</head>
	<body>
		<link rel="stylesheet" href="questionare/main.css" type="text/css">

		<br>
		<table width="950" border="0" align="center" cellpadding="0"
			cellspacing="0" style="border: 1px solid #BDD9E6;">
			<tbody>
				<tr>
					<td width="10" valign="top">
						<img src="images/left.jpg" width="10" height="228" border="0">
					</td>
					<td width="925" valign="top">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tbody>
								<tr>
									<td height="30"></td>
								</tr>
								<tr>
									<td height="60" align="center" class="blue_title">
										大学计算机基础问卷调查
									</td>
								</tr>
							</tbody>
						</table>
						<div id="public-nav" class="clear_fix">
							<ul class="n1" id="ulHeader">
								<li class="hover"><a href=# hidefocus="true" title="学生用户" onclick="sdnClick(12224)">学生问卷</a><span></span></li>
								<li><a >教师问卷</a><span></span></li>
							</ul>

						</div>
						<br>
						
						<div class="voteintro STYLE1">
							感谢您登录此平台进行学习。请告知您对计算机基础课程的相关意见，以便我们能够及时更正和改进。非常感谢您提供反馈。
						</div>

						<form name="form_81" method="post"
							onsubmit="return checkForm1(this);" action="sqSubmit.php">


							<div id="voteLst">

								<div id="paging_1" style="display: ">
									<div class="voteitem" style="display: block" id="item_719">
										<span class="votetitle STYLE1">Q1:您的性别？</span>
										<br>

										<input type="hidden" name="isdisplay_719"
										id="isdisplay_719" value="block">
										<input type="radio" name="vote719" vote="vote719" value="A"
										title="您的性别？"
										onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
										A.男 <span class="STYLE1">&nbsp;&nbsp;&nbsp;</span> <input
										type="radio" name="vote719" vote="vote719" value="B" title="您的性别？"
										onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
										B.女 <span class="STYLE1">&nbsp;&nbsp;&nbsp;</span>
									</div>
									<div class="voteitem" style="display: block" id="item_720">
										<span class="votetitle STYLE1">Q2:您的专业属于或倾向？</span>
										<br>

										<input type="hidden" name="isdisplay_720"
										id="isdisplay_720" value="block">
										<input type="radio" name="vote720" vote="vote720" value="A"
										title="您的专业属于或倾向？"
										onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
										A.文科 <span class="STYLE1">&nbsp;&nbsp;&nbsp;</span> <input
										type="radio" name="vote720" vote="vote720" value="B"
										title="您的专业属于或倾向？"
										onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
										B.理工科 <span class="STYLE1">&nbsp;&nbsp;&nbsp;</span>
									</div>
																	
     
									<div class="voteitem" style="display: block;" id="item_721">
										<span class="votetitle STYLE1">Q3:根据您上大学前的计算机知识掌握情况,以下描述哪些描述符合您的情况？【可多选】</span>
										<br>

										<input type="hidden" name="isdisplay_721"
										id="isdisplay_721" value="block">
										<input type="checkbox" name="vote721e[]" value="A"
										title="根据您上大学前的计算机知识掌握情况,以下描述哪些描述符合您的情况？"
										onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
										A.可每分钟录入30个以上汉字或英文词汇 <span class="STYLE1"><br>
											<br>
										</span> <input type="checkbox" name="vote721e[]" value="B"
										title="根据您上大学前的计算机知识掌握情况,以下描述哪些描述符合您的情况？"
										onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
										B.掌握微型计算机原理的基础知识（微机的组装与简单硬件故障分析）<span class="STYLE1"><br>
											<br>
										</span> <input type="checkbox" name="vote721e[]" value="C"
										title="根据您上大学前的计算机知识掌握情况,以下描述哪些描述符合您的情况？"
										onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
										C.能熟练使用Windows操作系统（Windows下管理文件和文件夹及设置控制面板） <span
											class="STYLE1"><br>
											<br>
										</span> <input type="checkbox" name="vote721e[]" value="D"
										title="根据您上大学前的计算机知识掌握情况,以下描述哪些描述符合您的情况？"
										onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
										D.能熟练使用Word文字处理系统（Word文字、段落、页面格式、图片和表格） <span
											class="STYLE1"><br>
											<br>
										</span> <input type="checkbox" name="vote721e[]" value="E"
										title="根据您上大学前的计算机知识掌握情况,以下描述哪些描述符合您的情况？"
										onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
										E.能熟练使用Excel电子表格处理软件（Excel表格编辑、公式计算、图表表示） <span
											class="STYLE1"><br>
											<br>
										</span> <input type="checkbox" name="vote721e[]" value="F"
										title="根据您上大学前的计算机知识掌握情况,以下描述哪些描述符合您的情况？"
										onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
										F.能熟练使用PowerPoint幻灯片(演示文稿)
										制作软件（PowerPoint幻灯片演示文稿的编辑与放映） <span class="STYLE1"><br>
											<br>
										</span> <input type="checkbox" name="vote721e[]" value="G"
										title="根据您上大学前的计算机知识掌握情况,以下描述哪些描述符合您的情况？"
										onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
										G.网页制作（FrontPage或DreamWeaver制作带有文本、图片、表格、链接和表单的网页）
										<span class="STYLE1"><br>
											<br>
										</span> <input type="checkbox" name="vote721e[]" value="H"
										title="根据您上大学前的计算机知识掌握情况,以下描述哪些描述符合您的情况？"
										onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
										H.多媒体应用（PhotoShop、Flash等多媒体处理软件中的某一种对图、声、动画或视频简单处理）
										<span class="STYLE1"><br>
											<br>
										</span> <input type="checkbox" name="vote721e[]" 
										value="I"
										title="根据您上大学前的计算机知识掌握情况,以下描述哪些描述符合您的情况？"
										onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
										I.数据库应用（能使用FoxPro、Access等数据库管理软件中的某一种添加、修改、删除、查询数据）
										<span class="STYLE1"><br>
											<br>
										</span> <input type="checkbox" name="vote721e[]" 
										value="J"
										title="根据您上大学前的计算机知识掌握情况,以下描述哪些描述符合您的情况？"
										onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
										J.程序设计（能使用QB、C、VB、VC、JAVA等程序设计语言中的某一种语言编写简单程序） <span
											class="STYLE1"><br>
											<br>
										</span> <input type="checkbox" name="vote721e[]" 
										value="K"
										title="根据您上大学前的计算机知识掌握情况,以下描述哪些描述符合您的情况？"
										onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
										K.已获得全国计算机等级考试证书（任一级别） <span class="STYLE1"><br>
											<br>
										</span> <input type="checkbox" name="vote721e[]" 
										value="L"
										title="根据您上大学前的计算机知识掌握情况,以下描述哪些描述符合您的情况？"
										onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
										L.参加过计算机竞赛 <span class="STYLE1"><br>
											<br>
										</span> <input type="checkbox" name="vote721e[]" 
										value="M"
										title="根据您上大学前的计算机知识掌握情况,以下描述哪些描述符合您的情况？"
										onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
										M.几乎没有接触过计算机 <span class="STYLE1"><br>
											<br>
										</span>
									</div>
									<div class="voteitem" style="display: block;" id="item_722">
										<span class="votetitle STYLE1">Q4:您觉得本课程中哪部分内容收获最大？【可多选】</span>
										<br>

										<input type="hidden" name="isdisplay_722"
										id="isdisplay_722" value="block">
										<input type="checkbox" name="vote722e[]" value="A"
										title="您觉得本课程中哪部分内容收获最大？"
										onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
										A.对计算及计算思维的理解 <span class="STYLE1"><br>
											<br>
										</span> <input type="checkbox" name="vote722e[]" value="B"
										title="您觉得本课程中哪部分内容收获最大？"
										onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
										B.计算机基础知识<span class="STYLE1"><br>
											<br>
										</span> <input type="checkbox" name="vote722e[]" value="C"
										title="您觉得本课程中哪部分内容收获最大？"
										onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
										C.熟练使用Word文字处理软件 <span class="STYLE1"><br>
											<br>
										</span> <input type="checkbox" name="vote722e[]" value="D"
										title="您觉得本课程中哪部分内容收获最大？"
										onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
										D.熟练使用PowerPoint幻灯片制作软件 <span class="STYLE1"><br>
											<br>
										</span> <input type="checkbox" name="vote722e[]" value="E"
										title="您觉得本课程中哪部分内容收获最大？"
										onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
										E.熟练使用Excel电子表格处理软件 <span class="STYLE1"><br>
											<br>
										</span> <input type="checkbox" name="vote722e[]" value="F"
										title="您觉得本课程中哪部分内容收获最大？"
										onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
										F.计算机网络 <span class="STYLE1"><br>
											<br>
										</span> <input type="checkbox" name="vote722e[]" value="G"
										title="您觉得本课程中哪部分内容收获最大？"
										onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
										G.数据库技术原理 <span class="STYLE1"><br>
											<br>
										</span> <input type="checkbox" name="vote722e[]" value="H"
										title="您觉得本课程中哪部分内容收获最大？"
										onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
										H.多媒体技术原理 <span class="STYLE1"><br>
											<br>
										</span>
									</div>
									<div class="voteitem" style="display: block" id="item_723">
									<span class="votetitle STYLE1">Q5:您认为本课程授课内容的难易程度？</span>
									<br>

									<input type="hidden" name="isdisplay_723"
									id="isdisplay_723" value="block">
									<input type="radio" name="vote723" value="A"
									title="您认为本课程授课内容的难易程度？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									A.很难 <span class="STYLE1">&nbsp;&nbsp;&nbsp;</span> <input
									type="radio" name="vote723" value="B"
									title="您认为本课程授课内容的难易程度？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									B. 较难<span class="STYLE1">&nbsp;&nbsp;&nbsp;</span><input
									type="radio" name="vote723" value="C"
									title="您认为本课程授课内容的难易程度？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									C.难易适度 <span class="STYLE1">&nbsp;&nbsp;&nbsp;</span><input
									type="radio" name="vote723" value="D"
									title="您认为本课程授课内容的难易程度？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									D.容易 <span class="STYLE1">&nbsp;&nbsp;&nbsp;</span>
									</div>

									<div class="voteitem" style="display: block" id="item_724">
									<span class="votetitle STYLE1">Q6:您认为本课程所选的教材内容？</span>
									<br>

									<input type="hidden" name="isdisplay_724"
									id="isdisplay_724" value="block">
									<input type="radio" name="vote724" value="A"
									title="您认为本课程所选的教材内容？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									A.新颖 <span class="STYLE1">&nbsp;&nbsp;&nbsp;</span> <input
									type="radio" name="vote724" value="B"
									title="您认为本课程所选的教材内容？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									B. 陈旧<span class="STYLE1">&nbsp;&nbsp;&nbsp;</span><input
									type="radio" name="vote724" value="C"
									title="您认为本课程所选的教材内容？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									C.一般 <span class="STYLE1">&nbsp;&nbsp;&nbsp;</span>
									</div>
									<div class="voteitem" style="display: block;" id="item_725">
									<span class="votetitle STYLE1">Q7:假如对非计算机专业开设以下选修课程，您会选择学习哪几门？【可多选】</span>
									<br>

									<input type="hidden" name="isdisplay_725"
									id="isdisplay_725" value="block">
									<input type="checkbox" name="vote725e[]" value="A"
									title="假如对非计算机专业开设以下选修课程，您会选择学习哪几门？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									A.微机组装与维护 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote725e[]" value="B"
									title="假如对非计算机专业开设以下选修课程，您会选择学习哪几门？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									B.计算机网络技术及应用<span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote725e[]" value="C"
									title="假如对非计算机专业开设以下选修课程，您会选择学习哪几门？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									C.网页设计 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote725e[]" value="D"
									title="假如对非计算机专业开设以下选修课程，您会选择学习哪几门？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									D.电子商务 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote725e[]" value="E"
									title="假如对非计算机专业开设以下选修课程，您会选择学习哪几门？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									E.信息安全 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote725e[]" value="F"
									title="假如对非计算机专业开设以下选修课程，您会选择学习哪几门？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									F.多媒体技术 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote725e[]" value="G"
									title="假如对非计算机专业开设以下选修课程，您会选择学习哪几门？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									G.数据库基础及其应用 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote725e[]" value="H"
									title="假如对非计算机专业开设以下选修课程，您会选择学习哪几门？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									H.数据结构和算法设计 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote725e[]" 
									value="I" title="假如对非计算机专业开设以下选修课程，您会选择学习哪几门？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									I.三维建模与动画设计 <span class="STYLE1"><br>
									<br>
									</span>
									</div>

									<div class="voteitem" style="display: block" id="item_726">
									<span class="votetitle STYLE1">Q8:您认为学习计算机类课程的最主要目的是什么？</span>
									<br>

									<input type="hidden" name="isdisplay_726"
									id="isdisplay_726" value="block">
									<input type="radio" name="vote726" value="A"
									title="您认为学习计算机类课程的最主要目的是什么？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									A.掌握常用工具软件的使用<span class="STYLE1">&nbsp;&nbsp;</span> <input
									type="radio" name="vote726" value="B"
									title="您认为学习计算机类课程的最主要目的是什么？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									B. 培养计算思维的能力<span class="STYLE1">&nbsp;&nbsp;</span><input
									type="radio" name="vote726" value="C"
									title="您认为学习计算机类课程的最主要目的是什么？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									C.掌握计算机基础知识<span class="STYLE1">&nbsp;&nbsp;</span><input
									type="radio" name="vote726" value="D"
									title="您认为学习计算机类课程的最主要目的是什么？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									D. 提高就业技能<span class="STYLE1">&nbsp;&nbsp;</span><input
									type="radio" name="vote726" value="E"
									title="您认为学习计算机类课程的最主要目的是什么？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									E. 获取计算机相关等级证书<span class="STYLE1">&nbsp;&nbsp;</span><input
									type="radio" name="vote726" value="F"
									title="您认为学习计算机类课程的最主要目的是什么？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									F. 对付考试<span class="STYLE1">&nbsp;&nbsp;</span>
									</div>
									<div class="voteitem" style="display: block;" id="item_727">
									<span class="votetitle STYLE1">Q9:您最愿意与老师交流的方式是什么？【可多选】</span>
									<br>

									<input type="hidden" name="isdisplay_727"
									id="isdisplay_727" value="block">
									<input type="checkbox" name="vote727e[]" value="A"
									title="您最愿意与老师交流的方式是什么？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									A.课堂提问 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote727e[]" value="B"
									title="您最愿意与老师交流的方式是什么？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									B.课间提问<span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote727e[]" value="C"
									title="您最愿意与老师交流的方式是什么？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									C.实验课提问 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote727e[]" value="D"
									title="您最愿意与老师交流的方式是什么？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									D.课外电话交流 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote727e[]" value="E"
									title="您最愿意与老师交流的方式是什么？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									E.课外到办公室交流 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote727e[]" value="F"
									title="您最愿意与老师交流的方式是什么？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									F.课外email交流 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote727e[]" value="G"
									title="您最愿意与老师交流的方式是什么？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									G.课外即时通讯工具（QQ）交流 <span class="STYLE1"><br>
									<br>
									</span>
									</div>
									<div class="voteitem" style="display: block" id="item_728">
									<span class="votetitle STYLE1">Q10:是否希望学校开设计算机等级考试培训课程？</span>
									<br>

									<input type="hidden" name="isdisplay_728"
									id="isdisplay_728" value="block">
									<input type="radio" name="vote728" value="A"
									title="是否希望学校开设计算机等级考试培训课程？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									A.是 <span class="STYLE1">&nbsp;&nbsp;&nbsp;</span> <input
									type="radio" name="vote728" value="B"
									title="是否希望学校开设计算机等级考试培训课程？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									B.否 <span class="STYLE1">&nbsp;&nbsp;&nbsp;</span>
									</div>
									<div class="voteitem" style="display: block" id="item_729">
									<span class="votetitle STYLE1">Q11:如果参加计算机二级考试，您会首先选择？</span>
									<br>

									<input type="hidden" name="isdisplay_729"
									id="isdisplay_729" value="block">
									<input type="radio" name="vote729" value="A"
									title="如果参加计算机二级考试，您会首先选择？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									A.C/C++语言程序设计<span class="STYLE1">&nbsp;&nbsp;&nbsp;</span>
									<input type="radio" name="vote729" value="B"
									title="如果参加计算机二级考试，您会首先选择？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									B.Visual Basic程序设计 <span class="STYLE1">&nbsp;&nbsp;&nbsp;</span><input
									type="radio" name="vote729" value="C"
									title="如果参加计算机二级考试，您会首先选择？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									C.Java程序设计 <span class="STYLE1">&nbsp;&nbsp;&nbsp;</span><input
									type="radio" name="vote729" value="D"
									title="如果参加计算机二级考试，您会首先选择？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									D.Access数据库 <span class="STYLE1">&nbsp;&nbsp;&nbsp;</span>
									</div>
									<div class="voteitem" style="display: block" id="item_730">
									<span class="votetitle STYLE1">Q12:对于“计算思维”，您是？</span>
									<br>

									<input type="hidden" name="isdisplay_730"
									id="isdisplay_730" value="block">
									<input type="radio" name="vote730" value="A"
									title="对于“计算思维”，您是？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									A.第一次听说<span class="STYLE1">&nbsp;&nbsp;&nbsp;</span> <input
									type="radio" name="vote730" value="B"
									title="对于“计算思维”，您是？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									B.这种理念在大学之前的课程学习中就有所应用，只是没明确提出这个概念而已 <span
									class="STYLE1">&nbsp;&nbsp;&nbsp;</span><input
									type="radio" name="vote730" value="C"
									title="对于“计算思维”，您是？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									C.之前就有所了解 <span class="STYLE1">&nbsp;&nbsp;&nbsp;</span>
									</div>
									<div class="voteitem" style="display: block" id="item_731">
									<span class="votetitle STYLE1">Q13:您如何看待“计算思维”？</span>
									<br>

									<input type="hidden" name="isdisplay_731"
									id="isdisplay_731" value="block">
									<input type="radio" name="vote731" value="A"
									title="您如何看待“计算思维”？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									A.“计算思维”是对计算机科学主要思想和方法论的总结，意义重大<span class="STYLE1"><br>
									<br>
									</span> <input type="radio" name="vote731" value="B"
									title="您如何看待“计算思维”？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									B.“计算思维”有一定的意义，但目前范畴仍不明确 <span class="STYLE1"><br>
									<br>
									</span> <input type="radio" name="vote731" value="C"
									title="您如何看待“计算思维”？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									C.“计算思维”只是一个概念上的炒作，没有实际意义 <span class="STYLE1"><br>
									<br>
									</span> <input type="radio" name="vote731" value=""
									title="您如何看待“计算思维”？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									D.其他，请具体说明&nbsp;&nbsp;<input type="text" size="35"
									name="text731">

									<span class="STYLE1"><br>
									<br>
									</span>
									</div>
									<div class="voteitem" style="display: block;" id="item_732">
									<span class="votetitle STYLE1">Q14:本课程主要缺陷是什么？【可多选】</span>
									<br>

									<input type="hidden" name="isdisplay_732"
									id="isdisplay_732" value="block">
									<input type="checkbox" name="vote732e[]" value="A"
									title="本课程主要缺陷是什么？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									A.概念多 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote732e[]" value="B"
									title="本课程主要缺陷是什么？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									B.太科普<span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote732e[]" value="C"
									title="本课程主要缺陷是什么？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									C.授课时间少 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote732e[]" value="D"
									title="本课程主要缺陷是什么？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									D.实验难 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote732e[]" value="E"
									title="本课程主要缺陷是什么？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									E.实验课时少 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote732e[]" value="F"
									title="本课程主要缺陷是什么？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									F.内容太多 <span class="STYLE1"><br>
									<br>
									</span>
									</div>

									<div class="voteitem" style="display: block;" id="item_733">
									<span class="votetitle STYLE1">Q15:您喜欢实验中的哪些内容？【可多选】</span>
									<br>

									<input type="hidden" name="isdisplay_733"
									id="isdisplay_733" value="block">
									<input type="checkbox" name="vote733e[]" value="A"
									title="您喜欢实验中的哪些内容？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									A.了解和使用计算机 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote733e[]" value="B"
									title="您喜欢实验中的哪些内容？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									B.互联网操作<span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote733e[]" value="C"
									title="您喜欢实验中的哪些内容？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									C.文字处理工具 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote733e[]" value="D"
									title="您喜欢实验中的哪些内容？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									D.电子幻灯片 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote733e[]" value="E"
									title="您喜欢实验中的哪些内容？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									E.电子表格 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote733e[]" value="F"
									title="您喜欢实验中的哪些内容？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									F.数据库操作 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote733e[]" value="G"
									title="您喜欢实验中的哪些内容？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									G.多媒体技术应用 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote733e[]" value="H"
									title="您喜欢实验中的哪些内容？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									H.Word综合实验 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote733e[]" 
									value="I" title="您喜欢实验中的哪些内容？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									I.Excel综合实验 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote733e[]" 
									value="J" title="您喜欢实验中的哪些内容？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									J.ISAS大作业 <span class="STYLE1"><br>
									<br>
									</span>
									</div>

									<div class="voteitem" style="display: block" id="item_734">
									<span class="votetitle STYLE1">Q16:您最不喜欢哪些实验内容？【可多选】</span>
									<br>

									<input type="hidden" name="isdisplay_734"
									id="isdisplay_734" value="block">
									<input type="checkbox" name="vote734e[]" value="A"
									title="您最不喜欢哪些实验内容？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									A.了解和使用计算机 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote734e[]" value="B"
									title="您最不喜欢哪些实验内容？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									B.互联网操作<span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote734e[]" value="C"
									title="您最不喜欢哪些实验内容？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									C.文字处理工具 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote734e[]" value="D"
									title="您最不喜欢哪些实验内容？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									D.电子幻灯片 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote734e[]" value="E"
									title="您最不喜欢哪些实验内容？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									E.电子表格 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote734e[]" value="F"
									title="您最不喜欢哪些实验内容？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									F.数据库操作 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote734e[]" value="G"
									title="您最不喜欢哪些实验内容？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									G.多媒体技术应用 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote734e[]" value="H"
									title="您最不喜欢哪些实验内容？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									H.Word综合实验 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote734e[]" 
									value="I" title="您最不喜欢哪些实验内容？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									I.Excel综合实验 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote734e[]" 
									value="J" title="您最不喜欢哪些实验内容？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									J.ISAS大作业 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote734e[]" value=""
									title="您最不喜欢哪些实验内容？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									K.都不喜欢，理由是&nbsp;&nbsp;<input type="text"
									size="35" name="text734">

									<span class="STYLE1"><br>
									<br>
									</span>
									</div>
									<div class="voteitem" style="display: block;" id="item_735">
									<span class="votetitle STYLE1">Q17:授课中那些章节内容很难理解？【可多选】</span>
									<br>

									<input type="hidden" name="isdisplay_735"
									id="isdisplay_735" value="block">
									<input type="checkbox" name="vote735e[]" value="A"
									title="授课中那些章节内容很难理解？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									A.对计算及计算思维的理解 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote735e[]" value="B"
									title="授课中那些章节内容很难理解？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									B.计算机基础知识<span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote735e[]" value="C"
									title="授课中那些章节内容很难理解？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									C.熟练使用Word文字处理软件 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote735e[]" value="D"
									title="授课中那些章节内容很难理解？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									D.熟练使用Excel电子表格处理软件 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote735e[]" value="E"
									title="授课中那些章节内容很难理解？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									E.计算机网络 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote735e[]" value="F"
									title="授课中那些章节内容很难理解？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									F.数据库技术原理 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote735e[]" value="G"
									title="授课中那些章节内容很难理解？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									G.多媒体技术原理 <span class="STYLE1"><br>
									<br>
									</span>
									</div>
									<div class="voteitem" style="display: block" id="item_736">
									<span class="votetitle STYLE1">Q18：您对教学进度有什么意见？</span>
									<br>

									<input type="hidden" name="isdisplay_736"
									id="isdisplay_736" value="block">
									<input type="radio" name="vote736" value="A"
									title="您对教学进度有什么意见？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									A.适中 <span class="STYLE1">&nbsp;&nbsp;&nbsp;</span> <input
									type="radio" name="vote736" value="B"
									title="您对教学进度有什么意见？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									B.太快 <span class="STYLE1">&nbsp;&nbsp;&nbsp;</span> <input
									type="radio" name="vote736" value="C"
									title="您对教学进度有什么意见？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0&#39;,&#39;0&#39;);">
									C.太慢 <span class="STYLE1">&nbsp;&nbsp;&nbsp;</span>
									</div>
									<div class="voteitem" style="display: block;" id="item_737">
									<span class="votetitle STYLE1">Q19:您对课程有那些希望或需求？【可多选】</span>
									<br>

									<input type="hidden" name="isdisplay_737"
									id="isdisplay_737" value="block">
									<input type="checkbox" name="vote737e[]" value="A"
									title="您对课程有那些希望或需求？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									A.增加授课时间 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote737e[]" value="B"
									title="您对课程有那些希望或需求？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									B.增加实验时间<span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote737e[]" value="C"
									title="您对课程有那些希望或需求？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									C.加强辅导 <span class="STYLE1"><br>
									<br>
									</span> <input type="checkbox" name="vote737e[]" value="D"
									title="您对课程有那些希望或需求？"
									onclick="progress();ShowNextVote(&#39;0|0|0|0|0|0|0&#39;,&#39;0&#39;);">
									D.增加练习 <span class="STYLE1"><br>
									<br>
									</span>
									</div>

									<div class="voteitem" style="display: block" id="item_726">
									<span class="votetitle STYLE1">Q20：您对本课程相关的意见和建议还有哪些，请写在下面:</span>
									<br>
									<input type="text" size="80" name="text726" class="text737" >
									<span class="STYLE1"><br>
									<br>
									</span>
									</div>
									<div class="voteitem" style="display: block" id="item_727">
									<span class="votetitle STYLE1">Q21：举一个与你学习、生活或专业相关的计算思维应用的例子，请写在下面:</span>
									<br>
									<input type="text" size="80" name="text727" class="text727">
									<span class="STYLE1"><br>
									<br>
									</span>
									</div>
									</div>

									<input type="hidden" name="version" value="6227">
									<input type="hidden" name="channelID" value="1141">
								</div>
								<input type="hidden" id="txtUseTime" name="txtUseTime"
								value="51">
								<div style="margin: 35px 0 20px; text-align: center;">
									<input type="hidden" name="SurveyID" value="81">
									<input id="btnSubmit" type="submit" value="提 交" name = "submit"
									style="width: 80px; display: ">
									&nbsp;&nbsp;
								</div>
							</form>
						</td>
						<td width="13" valign="top">
							<img src="images/right.jpg" width="10" height="228" border="0">
						</td>
					</tr>
				</tbody>
			</table>
			<script>				
				function go(vote715) {
					window.location.href = vote715;
				}
			</script>
		</body>
	</html>