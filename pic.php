<?php
require_once("./conn/conn.php");
require_once("./conn/function.php");
session_start();
@$wznr=addslashes($_POST['pengyou-wz-nr']);
@$pengyou_user=$_SESSION['pengyou_user'];
if($pengyou_user=="" || empty($pengyou_user)){
	tishi(1,"未登录账号禁止发布视频动态",1000,'index.php');
	die();
}
?>
<?php
require './upload/php-sdk/autoload.php';
use Qiniu\Auth;  //使用auth类
use Qiniu\Storage\UploadManager; 
$accessKey = 'R03CDIzkJuco00YV0tD-cOYBP6ID1ij9JsV91err';
$secretKey = 'n9lenBgkOHtd-p7neW73AiphKD7Ha8itDS1e7esJ';
$auth = new Auth($accessKey, $secretKey);  //实例化
$bucket='pengyou';//存储空间
$token = $auth->uploadToken($bucket);
$uploadMgr = new UploadManager();
$filePath = $_FILES['file']['tmp_name'];//'./php-logo.png';  //接收图片信息

if($_FILES['file']['type']=='image/jpeg'){
			$key = $pengyou_user.time().rand(1,10000).'.jpeg';  
		}elseif($_FILES['file']['type']=='image/jpg'){
			$key = $pengyou_user.time().rand(1,10000).'.jpg';  
		}elseif($_FILES['file']['type']=='image/png'){
			$key = $pengyou_user.time().rand(1,10000).'.png'; 
		}elseif($_FILES['file']['type']=='image/gif'){
			$key = $pengyou_user.time().rand(1,10000).'.gif'; 
		}else{
			tishi(1,"文件格式不符合上传条件",1000,'index.php');
			die();
		}
list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);  
if ($err !== null) {  
    echo '上传失败';
} else{
	$touxiang="http://mp4.q05.cc/".$ret['key'];
	$sql="update pengyou_user set touxiang ='$touxiang' where username ='$pengyou_user'";
	$zxplsql=mysql_query($sql);
	tishi(2,"发布成功",1000,'index.php');
}
