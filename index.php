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
	if(isset($_SESSION['loginID']))
	{
		$loginid = $_SESSION['loginID'];
	}
	else
	{
		$loginid = 0;
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>基于计算思维的大学计算机基础课程</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<link href="css/cupertino/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<script type="text/javascript" src="js/demo.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
<style>
    .welcome:hover *{color:yellow;} /** 鼠标经过DIV时，所有子元素字段变成红色 */
	.logoutspan:hover *{color:yellow;}
	.loginspan:hover *{color:yellow;}
	.register:hover *{color:yellow;}
	.forgetpwd:hover *{color:yellow;}
</style>
</head>

<body>
 <script type="text/javascript">
	function reloadpage(){
		window.location.reload();
	}
</script>
<div id="outside">
    <div class="box">
      <div class="top" id="top">
		  <div class="ueser_loginout">
			<span class="wel"><a>Hi, 欢迎您！</a>	
			<?php 
			if($in){
				echo $username;
			?>
			</span>
			<span title="退出" class="logoutspan">退出</span> 
			<?php
			}else {
			?>
			<span title="登录" class="loginspan" >登录 </span>   <a color="black">|</a>
			<a href="register/register.php" target="_blank" title="注册">注册</a>　
			<a href="php/forgetpassword.php" target="_blank" title="忘记密码">忘记密码</a>	
			<?php 
			}
			?>	
			
		  </div>
      </div>	  	  
	  <div class="navi_bar">
    <div class="navi_left"></div>
    <div id="navi">
      <ul id="navi_menu">			    
				<li><a href="home/home.htm" target="contentFrame" id="nav1" class="same" onClick="reloadpage()">首页</a></li>
				<li class = nav0></li>
				<li><a href="syllabus/syllabus.htm" target="contentFrame" id="nav2" class="same">教学大纲</a></li>
				<li class = nav0></li>
				<li><a href="CThinking/cthinking.htm" target="contentFrame" id="nav3"class="same">计算思维</a></li>
				<li class = nav0></li>
				<li id="selected"><a href="upload/upload.php" target="contentFrame" id="nav4" class="same">课程课件	</a></li>
				<li class = nav0></li>
				<li><a href="selftest/self_test.php" target="contentFrame" id="nav5" class="same">自我测试</a></li>
				<li class = nav0></li>
				<li><a href="<?php if($loginid == 0)echo "questionaires/s_questionare.php"; else echo "questionaires/t_questionare.php";?>" target="_blank"class="same"  id="nav6">调查问卷</a></li>
				<li class = nav0></li>
				<li><a href="workshow/workshow.php" target="contentFrame" id="nav7" class="same">优秀作品展示</a></li>
				<li class = nav0></li>
				<li><a href="studentqa/studentqa.php" target="_blank" id="nav8" class="same">学生答疑</a></li>	
			</ul>	
		</div>
	<div class="navi_right"></div>
  </div>
	  
      <div class="content">
    <div class="leftpart">
	<div class="leftuper">	
	  <img src="images/frame.gif" id="frame"/>
	  <div class="left_center">
       <div>
         <div class="left_blank">
         <br><br>
          <marquee direction="up" height=80% width="235px" scrolldelay="170" scrollamount="2" onmouseover="this.stop()" onmouseout="this.start()">
 <h1>资讯一：</h1>
		  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2011年11月30日晚，在东九楼C101教室；由李芝堂教授主讲了题为“大学生之计算思维”的讲座。讲座现场座无虚席，讲座完毕后同学们将李教授围住，请教并讨论计算思维方面的问题。</p>
           <br>         
		 <div class="professor">		   
 <p><a href="images/lecture1.JPG" target="_new">讲座现场图片一</a>
		   <a href="images/lecture2.JPG" target="_new">&nbsp;图片二 </a>
		   <a href="images/lecture3.JPG" target="_new">&nbsp;图片三 </a>	</p></div>
		   </br> <br>   
		   <h1>资讯二：</h1>		  
		  <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;教育部计算机科学与技术教学指导委员会副主任、非计算机专业计算机课程教学指导分委员会主任委员、西安交通大学国家级计算机基础教学团队和国家级计算机实验教学示范中心带头人：</p>
         <p>冯博琴教授</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;11月10日上午8:30在网络与计算中心演播室为计算机基础教研室教师讲学，讲授主要内容：</p>
1、计算思维应该如何理解<br>
           2、计算思维如何和大学计算机基础课程结合<br>
           3、以计算思维的非计算机专业的课程体系应该如何构建<br>
           4、计算思维和大学计算机基础课程的未来<br>
		   <br>   
		   <p class="professor"><a href="home/fengboqin.htm" target="contentFrame" >冯博琴教授简介</a></p>
		  </marquee>
		
		</div>
         
      </div>
      </div>        
	  
	 </div> 
	 <div class="leftlower">
	 <h1>&nbsp;相关链接：</h1>
	 <br>
	 <p><a href="http://baike.baidu.com/view/3053744.htm" target="_blank">百度百科 计算思维</a></p>
     <p><a href="http://www.cs.cmu.edu/~CompThink/" target="_blank">Center for Computational Thinking</a></p>
       <p><a href="http://en.wikipedia.org/wiki/Computational_thinking" target="_blank">WIKIPEDIA:  Computational thinking</a></p>
       <p><a href="http://sites.nationalacademies.org/cstb/CurrentProjects/CSTB_043590" target="_blank">Computational Thinking for Everyone: A Workshop Series</a></p>
       <p><a href="http://www.iste.org/learn/computational-thinking.aspx" target="_blank">Computational Thinking for All </a></p>
	 </div>
	 <div class="leftvisit">
	 历史访问次数：
	 <?php 
		include 'sql_visit.php';
	 ?>
	 </div>
    </div>
    <div class="rightpart">
    <div class="right_top"></div>
	   <div class="innerframe">
          <iframe src="home/home.htm" name="contentFrame" scrolling="no" frameborder="0" class="frame" id="contentFrame" onload="this.height=
		  Math.max(this.contentWindow.document.body.scrollHeight,this.contentWindow.document.documentElement.scrollHeight)+30;"></iframe>
       </div>
	</div> 
  </div>
  <div class="shadow"><!--<hr width="800" size="4"  color="#CCCCCC" align="center"  > -->
</div>
 
<div class="bottom"><h5>版权所有  2011  计算与网络中心  保留所有权利。</h5>

<div id="divTotalizer" name="divTotalizer"></div>

</div>

    </div>
     <div class="content_shadow"></div>

  </div>
</body>
</html>

