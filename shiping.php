<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>记录时刻</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="style/reset.css">
<link rel="stylesheet" href="style/yiqi.css">
<link rel="stylesheet" href="style/shuoshuo/main.css">
</head>
<script type="text/javascript" src="js/jQuery.min.js"></script>
<script type="text/javascript" src="js/yiqi.js"></script>
<body>
	<form action="./pic3.php" method="post" enctype="multipart/form-data">
	<div id='box'>
		<div id='dingwei'>
			<div class="pengyou-ss-head">
				<div class="pengyou-ss-head-left"><span onClick="Dqopen('index.php');">取消</span></div>
				<div class="pengyou-ss-head-right"><input type="submit" value="发布"></div>
			</div>
			<div class="pengyou-ss-dingwei">
				<div class="pengyou-ss-font">
					<textarea placeholder="这一刻的想法...." maxlength="1000" id ="pengyou-wz-nr" name="pengyou-wz-nr"></textarea>
				</div>
				<div class="pengyou-upload-insert">
				
						<div id="picInput">
							<div class="pengyou_upload_input" id="pengyou_upload_input" dqtj='1'>
								<video id="img_preview1" style="display: none;">
								</video>
								<img id ="yulanimg" style="" src="images/icon/insertimg.png" onclick="uploadbut()">
								</img>
							</div>
							
							<input type="file" name='upfile' class="pengyou_upload_input_but"  style="display: none;" id="tjimg1">
							
						</div>
						
				
				</div>
			</div>
		</div>
	</div>
			</form>
</body>
	<script type="text/javascript">
			var z = 1;
			var tjbutid=$("#pengyou_upload_input").attr('dqtj'),
					butid=parseInt(tjbutid)+1;
			var uploadbut = function(id){

				$("#tjimg1").click();
			}
	</script>
	<script type="text/javascript">
		$("#tjimg1").change(function (e) {
				//获取目标文件
				var file = e.target.files || e.dataTransfer.files;
				//如果目标文件存在
				if (file) {
				//定义一个文件阅读器
				var reader = new FileReader();
				//文件装载后将其显示在图片预览里
					//console.log(reader);
				reader.onload = function () {

				$("#img_preview1").attr("src", this.result);
				$("#img_preview1").attr("poster","");
				$("#img_preview1").attr("controls","controls");
				$("#img_preview1").css("width","100%");
				$("#img_preview1").css("display","block");
				$('#yulanimg').css("display","none");
				}

				//装载文件
				reader.readAsDataURL(file[0]);
				}
			});
		
	</script>
</html>