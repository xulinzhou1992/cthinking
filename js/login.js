//生成XMLHttpRequest对象，为了和服务器端进行交互
	var xmlhttp;
	if(window.XMLHttpRequest){
		xmlhttp = new XMLHttpRequest();
	}else{
		xmlhttp = new ActiveXObject("Microsoft.XMLHttp");
	}

$(document).ready(function(){
	/* $(".notRegister").click(function(){
		window.close();
	}); */
	//获取当前网址，如： http://localhost:8083/uimcardprj/share/meun.jsp
    var curWwwPath=window.document.location.href;
    //获取主机地址之后的目录，如： uimcardprj/share/meun.jsp
    var pathName=window.document.location.pathname;
    var pos=curWwwPath.indexOf(pathName);
	//获取主机地址，如： http://localhost:8083
    var localhostPaht=curWwwPath.substring(0,pos);
    //获取带"/"的项目名，如：/uimcardprj
    var projectName=pathName.substring(0,pathName.substr(1).indexOf('/')+1);

	$(".loginspan").click(function(e){
		$.jqopen(localhostPaht + "/php/login.php", {width: 400, height: 260});
	});	
	
	$(".logoutspan").click(function(){
		window.location.href=localhostPaht + '/php/logout.php';	
	});
	
	$("#loginbtn").click(function(){		
		var loginid = $('input:radio[name="loginid"]:checked').val();
		var username = $(".username").val();//获取输入的帐号值
		var password = $(".userpass").val();//获取输入的密码
		
		var url = "logincheck.php?loginid="+loginid+"&username="+username+"&password="+password;//通过URL传递参数
	
		//设置和服务器端交互的相应参数，
		xmlhttp.open('GET',url,true);//true,表示异步
		
		//注册回调方法，当服务器端返回数据后，可以执行回调方法
		xmlhttp.onreadystatechange = function(){
			//写回调方法，判断服务器端的交互是否完成，还要判断服务器端是否正确返回了数据
			if(xmlhttp.readyState ==4 && xmlhttp.status == 200){
				msg = xmlhttp.responseText;
				if(msg == '0'){
					document.getElementById('prompt').innerHTML="<span style='color:red'>用户不存在!</span>";
				}else if(msg == '2'){
					document.getElementById('prompt').innerHTML="<span style='color:red'>用户名或密码错误!</span>";
				}else if(msg == '1'){
					document.getElementById('prompt').innerHTML="<span style='color:red'></span>";
					parent.location.reload();
				}else if(msg == '3'){
					document.getElementById('prompt').innerHTML="<span style='color:red'>教师账号审核未通过!</span>";
				}else{
					document.getElementById('prompt').innerHTML="<span style='color:red'>unknown error!</span>";
				}	
			}
		}	
		//设置向服务器发送的数据，启动和服务器的交互，
		//这里使用的是GET方式，请求数据位于URL链接里面，参数直接设为NULL
		xmlhttp.send();	
	}); 
})

