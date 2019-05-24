<?php
require_once("./conn/conn.php");
require_once("./conn/function.php");
session_start();
@$wznr=addslashes($_POST['pengyou-wz-nr']);
@$wzqq=addslashes($_POST['pengyou-wz-qq']);
@$pengyou_user=$_SESSION['pengyou_user'];
if($pengyou_user=="" || empty($pengyou_user)){
	tishi(1,"未登录账号禁止发布",1000,'index.php');
	die();
}
//header('Content-Type:application/json; charset=utf-8');
require './upload/php-sdk/autoload.php';
use Qiniu\Auth;  //使用auth类
use Qiniu\Storage\UploadManager; 
$accessKey = 'R03CDIzkJuco00YV0tD-cOYBP6ID1ij9JsV91err';
$secretKey = 'n9lenBgkOHtd-p7neW73AiphKD7Ha8itDS1e7esJ';
$auth = new Auth($accessKey, $secretKey);  //实例化
$bucket='pengyou';//存储空间
$token = $auth->uploadToken($bucket);
$uploadMgr = new UploadManager();

$filesLen=count($_FILES['upfile']['tmp_name']);	//图片个数
$images=array();
if($_FILES['upfile']['tmp_name'][0]!=""){
	
	for($i=0;$i<$filesLen;$i++){
		$filePath = $_FILES['upfile']['tmp_name'][$i];//'./php-logo.png';  //接收图片信息
		if($_FILES['upfile']['type'][$i]=='image/jpeg'){
			$key = 'video'.time().rand(1,10000).'.jpeg';  
		}elseif($_FILES['upfile']['type'][$i]=='image/jpg'){
			$key = 'audio'.time().rand(1,10000).'.jpg';  
		}elseif($_FILES['upfile']['type'][$i]=='image/png'){
			$key = 'audio'.time().rand(1,10000).'.png'; 
		}elseif($_FILES['upfile']['type'][$i]=='image/gif'){
			$key = 'audio'.time().rand(1,10000).'.gif'; 
		}else{
			tishi(1,"文件格式不符合上传条件",1000,'index.php');
			die();
		}
		list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);  
		if ($err !== null) {  
		    echo '上传失败';
		} else{
			$mp4="http://mp4.q05.cc/".$ret['key'];
			array_push($images,$mp4);
		}
	}
}
	$images=json_encode($images);
	//$mp4="http://pr0q7cizs.bkt.clouddn.com/".$ret['key'];
	$pinglunsql="insert into pengyou_content(username,content,qq,time,images) values('$pengyou_user','$wznr','$wzqq','$time','$images') ";
	$zxplsql=mysql_query($pinglunsql);
	tishi(2,"发布成功",1000,'index.php');
/*
if($_FILES['upfile']['type']=='video/mp4'){
	$key = 'video'.time().rand(1,10000).'.mp4';  
}elseif($_FILES['upfile']['type']=='audio/mp3'){
	$key = 'audio'.time().rand(1,10000).'.mp3';  
}elseif($_FILES['upfile']['type']=='video/quicktime'){
	$key = 'audio'.time().rand(1,10000).'.mov'; 
}else{
	$key = 'png'.time().rand(1,10000).'.png';  
}
list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);  
if ($err !== null) {  
    echo '上传失败';
} else{
	$mp4="http://pr0q7cizs.bkt.clouddn.com/".$ret['key'];
	$pinglunsql="insert into pengyou_content(username,content,time,mp4) values('$pengyou_user','$wznr','$time','$mp4') ";
	$zxplsql=mysql_query($pinglunsql);
	tishi(2,"发布成功",1000,'index.php');
}*/
?>