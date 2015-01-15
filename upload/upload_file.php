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
//判断文件是否符合格式要求、大小要求
 if (1
//   (
// //  	($_FILES["file"]["type"] == "image/gif")
// // || ($_FILES["file"]["type"] == "image/jpeg")
// // || ($_FILES["file"]["type"] == "image/pjpeg")
//  ($_FILES["file"]["type"] == "application/octet-stream")
// // || ($_FILES["file"]["type"] == "application/kswps")
// // || ($_FILES["file"]["type"] == "application/msword")
// // || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
// || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.presentation")
// || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint")
// // || ($_FILES["file"]["type"] == "application/x-msdownload")
// || ($_FILES["file"]["type"] == "application/pdf"))
// && ($_FILES["file"]["size"]/1024 < 20480)
)
  {
    //FILES报错信息输出
  if ($_FILES["file"]["error"] > 0)
    {
    //echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
        echo "<script language=\"JavaScript\">\r\n"; 
        echo " alert(\"_FILES ERROR CODE:".$_FILES["file"]["error"]."！\");\r\n"; 
        echo " history.back();\r\n"; 
        echo "</script>"; 
        exit;
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    //获取当前时间戳
    $time=time();
    //根据时间戳设置文件名
    $new_file_path = "./".date("YmdHis",$time).".".pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
    //文件重名时更改时间戳重新命名
    /********while循环不稳定*********/
    while (file_exists($new_file_path))
      {
        $time=time();
      	$new_file_path = "./".date("YmdHis",$time).".".pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
      }
      //移动上传文件
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],$new_file_path);
      // echo "Stored in: " . $new_file_path;
      //将上传文件信息存入数据库
      include '../sqlclass/sqlclass.php';
      $mysql = new mySql();
      //存入原名、新名、上传者姓名、上传时间
      $sql = "insert into upload_file values ('".$_FILES["file"]["name"]."','".$new_file_path."','".$_SESSION["nickname"]."','".date("Y-m-d H:i:s",$time)."')";
      // echo "<br />".$sql."<br />";
      $flag = $mysql->insert($sql);
      if ($flag != 1) {
        // echo "database error!";
        echo "<script language=\"JavaScript\">\r\n"; 
        echo " alert(\"数据库错误！\");\r\n"; 
        echo " history.back();\r\n"; 
        echo "</script>"; 
      }
      else
      {
          echo "<script language=\"JavaScript\">\r\n"; 
          echo " alert(\"上传成功！\");\r\n"; 
          echo " history.back();\r\n"; 
          echo "</script>"; 
      }
      $mysql->close();
      }
    }
  }
else
  {
  //echo "Invalid file";
  echo "<script language=\"JavaScript\">\r\n"; 
  echo " alert(\"文件格式不符或过大！\");\r\n"; 
  echo " history.back();\r\n"; 
  echo "</script>"; 
  exit;
  }
?>