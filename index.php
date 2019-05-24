<!doctype html>
<html>

	<head>
		<meta charset="utf-8">
		<title>朋友圈</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="style/reset.css">
		<link rel="stylesheet" href="style/yiqi.css">
		<link rel="stylesheet" href="style/main.css">
		<link href="style/kuangjia/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="style/kuangjia/zzsc-demo.css">
		<link type="text/css" rel="stylesheet" href="style/kuangjia/jquery.galpop.css" media="screen" />
	</head>
	<script type="text/javascript" src="js/jQuery.min.js"></script>
	<script type="text/javascript" src="js/yiqi.js"></script>

	<body id='Body'>
		<div id='box'>
			<div id='dingwei'>
				<div class="pengyou-head" onclick="tccebianlan()">
					<div class="pengyou-head-left"><img src="images/icon/caidan2.png" onClick="tccebianlan()"></div>
					<div class="pengyou-head-right"><img src="images/icon/mp4.png" style="right: 50px;" onClick="Dqopen('shiping.php')"></div>
					<div class="pengyou-head-right"><img src="images/icon/photo.png" onClick="Dqopen('shuoshuo.html')"></div>
				</div>
				<div class="pengyou-headimg">
					<div class="pengyou-touxiang">
						<div class="pengyou-touxiang-name" align="center" >
							<p>crush</p>
						</div>
						<div class="pengyou-touxiang-img" >
							<img src="images/touxiang/moren.jpeg" id="mytouxiang">
						</div>
					</div>
				</div>
				<div id="pengyou-content">
					
					
				</div>
			</div>
			<div id="zhezhao" style="display: none;"></div>
			<form action="pic.php" method="post"
enctype="multipart/form-data" id="touxiang-upload-form" style="display: none;">
				
			<div class='pengyou-upload-k-touxiang'>
				<div class="pengyou-upload-k-head">
					<span>更换头像</span>
				</div>
				<div class="penyou-upload-k-input" id="penyou-upload-k-input" style="webkit-box-sizing:content-box;;-moz-box-sizing: content-box;;box-sizing: content-box;;">上传头像</div>
				<div class="pengyou-upload-k-yulan">
					<img src="images/icon/pengyouquan.jpg" id="pengyou-upload-img">;

				</div>
				<div class="pengyou-upload-k-bottom" align="center">
					<input class="vip-bg-blu2" type="submit" value="确定" style="line-height:30px;">
					<input class="vip-bg-red" type="button" value="取消" onclick="qxupload()" style="line-height:30px;">
					<input type="file" name="file" id="file" style="display: none"/> 
				</div>
			</div>
			</form>
			<div id='pengyou-cebianlandingwei'>
				<div id="pengyou-cebianlan">
					<div class="pengyou-cbl-span"><img src="images/icon/left3.png" onClick="tccebianlan();"></div>
					<div class="pengyou-cebianlan-touxiang" align="center">
						<img src="http://q2.qlogo.cn/headimg_dl?dst_uin=330729121&spec=5" id="touxiang">
						<p>欢迎你游客</p>
					</div>
					<div align="left" class="pengyou-cebianlan-left">
						<ul>
							<li onClick="iFrame('daohang.php')"><img src="images/icon/zy.png">
								<a href="#">首页</a>
							</li>
							<li onClick="Dqopen('./login.php')"><img src="images/icon/chat.png">
								<a href="#">登录</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
			
		</div>

	</body>
<script type="text/javascript" src="js/jquery.galpop.min.js"></script>
<script type="text/javascript" src="js/pengyou.js"></script>
<script type="text/javascript">
	var qxupload = function(){
			$('#zhezhao').hide();
			$('#touxiang-upload-form').hide();
		}
		var uploadtouxiang = function(){
			$('#zhezhao').show();
			$('#touxiang-upload-form').show();
		}
	$(document).ready(function() {

		$('.galpop-multiple').galpop();



		var callback = function() {
			var wrapper = $('#galpop-wrapper');
			var info    = $('#galpop-info');
			var count   = wrapper.data('count');
			var index   = wrapper.data('index');
			var current = index + 1;
			var string  = 'Image '+ current +' of '+ count;

			info.append('<p>'+ string +'</p>').fadeIn();

		};
		$('.galpop-callback').galpop({
			callback: callback
		});

		$('.manual-open').change(function(e) {
			var image = $(this).val();
			if (image) {
				var settings = {};
				$.fn.galpop('openBox',settings,image);
			}
		});
		$('.click-open-iframe').galpop({
			contentType: 'iframe',
		});

		$('.click-open-ajax').galpop({
			contentType: 'AJAX',
		});
		var uploadtouxiang = function(){
			$('#zhezhao').show();
			$('#touxiang-upload-form').show();
		}
		function imgerrorfun(){ 
				 var img=event.srcElement; 
				 img.src="images/touxiang/morentouxiang.png"; 
				 img.onerror=null;
				} 
		$('#penyou-upload-k-input').click(function(){
			$('#file').click();
		});
					$("#file").change(function (e) {
				//获取目标文件
				var file = e.target.files || e.dataTransfer.files;
				//如果目标文件存在
				if (file) {
				//定义一个文件阅读器
				var reader = new FileReader();
				//文件装载后将其显示在图片预览里
				reader.onload = function () {

				$("#pengyou-upload-img").attr("src", this.result);
				}

				//装载文件
				reader.readAsDataURL(file[0]);
				}
			});
		$('#mytouxiang').on('click',function(){
			uploadtouxiang();
		})
	});
</script>
</html>