// JavaScript Document
			var zthight = byId('dingwei').scrollHeight,
				zwidth = byId('dingwei').scrollWidth,
				kheight = byId('dingwei').offsetHeight;
	function tcdzpl(id){
		var Zid='#pengyou-lm'+id;
		if ($(Zid).css('right')=='-150px'){
			$(Zid).css('right','0');
		}else{
			$(Zid).css('right','-150px');
		}
	};
	var tccebianlan = function(){
		var cebianlan=$('#pengyou-cebianlan'),
			xscbl=$('#pengyou-cebianlandingwei');	
		if(cebianlan.css('left')=='-300px'){
				xscbl.css('z-index','0');
		   		cebianlan.css('left','0px');
		   }else{
			   cebianlan.css('left','-300px');
			   setTimeout(function(){xscbl.css('z-index','-1');},500);
		   }
	};
	$('.pengyou-cebianlan-touxiang').click(function(){
		tccebianlan();
	});
	$('.pengyou-head-left').click(function(){
		tccebianlan();
	});
	var tcpinglunk = function(id,px){
		if($('#pinglun-pinglun').css('display')=='none'){
			tcdzpl(px);
			$('#pinglunk').attr('plid',id);
			$('#pinglunk').attr('plpx',px);
			$('#pinglun-pinglun').css('display','block');
		}else{
			tcdzpl(px);
			$('#pinglun-pinglun').css('display','none');
		}
	};
	//新打开认证
	var Newopenvip = function(id,vip,color,Text){
		$("#name-vip"+id).css('background-color',color);
		$("#name-vip"+id).children('span').text(Text);
		$("#name-vip"+id).toggle();
		
	};
	$('#pinglunk').keyup(function(event){
		var anxia = event.keyCode;
		if(anxia==13){
			var content = $('#pinglunk').val(),
				toId = $('#pinglunk').attr('plid'),
				paixu = $('#pinglunk').attr('plpx');
				$.post("pinglun.php", { 
					"content":content,
					"biaoshi":toId
				},
				   function(data){
					if(data.success){
					 tishi(2,data.msg,1500); // John
					 var pl = $('#sspinglun'+paixu),
						 pl1=document.createElement("div");
						pl1.className='pengyou-shuoshuo-right-pinglun-wz';
						pl1.innerHTML='<div class="pengyou-shuoshuo-right-pinglun-wz-left"><span onclick="Dqopenuser('+data.Id+')">'+data.name+'</span></div><div class="pengyou-shuoshuo-right-pinglun-wz-right"><span>'+data.content+'</span></div>';
					pl.append(pl1);
					$('#pinglunk').val('');
					$('#pinglun-pinglun').css("display",'none');
					}else{
						 tishi(1,data.msg,1500,'zx.php');
						$('#pinglun-pinglun').css("display",'none');
					}
				   }, "json");
		   }
		
	});
	var dianzan = function(id,px){
		 $.get("dianzan.php", {
			 Id:id
		 },
		  function(data){
			tcdzpl(px);
			var zanlie = $('#zanlie'+px);
			if(data.success==true){
					var pl1=document.createElement("span");
					pl1.innerText=data.name;
					zanlie.append(pl1);
					if(zanlie.css("display")=='none'){
						zanlie.css("display","block")
					   }
					$('#pengyou-lm'+px).children('.pengyou-shuoshuo-right-time-lm-nr-left').children('span').text('取消');
			}else if(data.success==false){
				tishi(1,data.msg,1500,'login.php');
			}else if(data.success=="qx"){
				zanlie.children('span').remove();
				var z=0;
				for(var i in data.name){
					var pl1=document.createElement("span");
					pl1.innerText=data.name[i];
					zanlie.append(pl1);
					z++;
				}
				if(z==0){
					$('#zanlie'+px).css("display",'none');
				}
				$('#pengyou-lm'+px).children('.pengyou-shuoshuo-right-time-lm-nr-left').children('span').text('赞');
			}
		  },"json");
	};
		
			var fdimg = function(Id){
			var hqzhezhao = byId('zhezhao2');
			if(hqzhezhao){
				$('#zhezhao2').remove();
				$('#pengyou-fdimg').remove();
			}else{
				var zhezhao = document.createElement('div'),
				fdimg = document.createElement('div');
				zhezhao.id='zhezhao2';
				$('#dingwei').append(zhezhao);
				fdimg.id='pengyou-fdimg';
				var imgsrc =byId('fdimg'+Id).src;
				fdimg.innerHTML='<img onclick="fdimg('+Id+')" src="'+imgsrc+'" style="width:'+zwidth+'px;" id="pyimg-'+Id+'">'
				$('#dingwei').append(fdimg);
				var pyimghight =byId('pyimg'+Id);
			}
			
		};
		var openvip=function(id,vip){
			
			$("#name-vip"+id).toggle();
			 
			
		};
$(document).ready(function(){
		var pege=1;
            $('#dingwei').scroll(function(){
				var dwzHeight = document.getElementById('dingwei').scrollHeight,
					dwSoroll= $('#dingwei').scrollTop(),
					dwHeight=parseInt($('#dingwei').css('height'));
              if(dwSoroll>=dwzHeight-dwHeight){
                var div1tem = $('#container').height()
                var str =''
				pege++;
                $.ajax({
					//请求方式
						type:'get',
						//发送请求的地址
						url:'./contentApi.php?page='+pege,
						//服务器返回的数据类型
						dataType:'json',
						//发送到服务器的数据，对象必须为key/value的格式，jquery会自动转换为字符串格式
						data:{},
						success:function(data){
							xrIndex(data);
						},
						error:function(jqXHR){
							//请求失败函数内容
						}
					});
              }
            });


	

});

	var userxgxingbie = function(){
		var xingbie = $('#pengyou_usergl_xingbie').val();
		 $.get("usergl_xg.php", {
			 "xingbie":xingbie
		 },
		  function(data){
			if(data.success){
				 	tishi(2,data.msg,1000,'userzl.php');
					
			}else{
				tishi(1,data.msg,1500,'userzl.php');
			}
		  },"json");
	};
	
	//用户删除自己发布的说说
	var rmvcentent = function(id,wz){
		var xingbie = $('#pengyou_usergl_xingbie').val();
		
		 $.get("rmvcontent.php", {
			 "id":id
		 },
		  function(data){
			if(data.success){
				 	tishi(2,data.msg,1000);
					$('#pengyou-content').children('.pengyou-shuoshuo')[wz].remove();
			}else{
				tishi(1,data.msg,1500);
			}
		  },"json");
	};
	var userxgqx = function(){
		if($('#yiqi-xgpass')){
			$('#yiqi-xgpass').remove();
			$('#zhezhao').remove();
			$('#zhezhao').remove();
		}
	}
var plSc = function(id){
		 $.get("scpl.php", {
			 "zjid":id
		 },
		  function(data){
			if(data.success){
					$('#plcaidan'+id).remove();
					$('#zhezhao').remove();
					userxgqx();
					
			}else{
				tishi(1,data.msg,1500);
			}
		  },"json");

}
var plshanchu = function(id){
		if(isNaN(id)){ 
			tishi(1,"小伙子 非法传参数，我要记录你ip",3000);
				   }else{
			   var Id=parseInt(id);
					cjzhezhao();
				
				   	var hello = document.createElement('div');
					   	hello.id='yiqi-xgpass';
					   	hello.setAttribute('align','center');
					   	hello.innerHTML="<div class=\"yiqi-xgpass-head\">\
			<p>评论管理</p>\
		</div>\
		<div class=\"yiqi-xgpass-dingwei\">\
			<p>你确定要删除这条评论吗</p>\
		</div>\
		<div class=\"yiqi-xgpass-bottom\">\
			<div class=\"yiqi-xgpass-bottom-left\" onClick=\"userxgqx()\"><p>取消</p></div>\
			<div class=\"yiqi-xgpass-bottom-right\" onClick=\"plSc("+id+")\"><p>确定</p></div>\
		</div>";
					   $('body').append(hello);
					    var DHeight= hello.offsetHeight;
					   var DWidth = hello.offsetWidth;
						hello.style.left=(Zwidth-DWidth)/2+"px";
	
				   }
}
var plcaidan = function(id){
	$('#plcaidan'+id).children('.pengyou-shuoshuo-pl-caidan').toggle();
}


var timeout = undefined;
 
$("#mydiv").bind("mousedown", function() {
    timeout = setTimeout(function() {
        alert(1);
    }, 3000);
});
$("#mydiv").bind("mouseup", function() {
    clearTimeout(timeout);
});
function jieshouIndex(touxiang,name,showqq,content,data,time,Id){
	 var moban = '<div class="pengyou-shuoshuo">\
						<div class="pengyou-shuoshuo-left" align="center">\
							<img src="'+touxiang+'">\
						</div>\
						<div class="pengyou-shuoshuo-right">\
							<div class="pengyou-shuoshuo-right-name">\
								<p title="" style="margin:0 0;">'+name+'</p>\
								<div class="pengyou-shuoshuo-right-name-vip">\
									'+showqq+'\
								</div>\
								<div class="pengyou-shuoshuo-caidan" onclick="rmvcentent('+Id+')">\
								</div>\
							</div>\
							<div class="pengyou-shuoshuo-right-wz">\
								<span>'+content+'</span>\
								<div class="pengyou-photo">\
								'+data+'\
								</div>\
							</div>\
							<div class="pengyou-shuoshuo-right-time">\
								<span>'+time+'</span>\
							</div>\
						</div>\
						<div class="clear"></div>\
					</div>';
	$('#pengyou-content').append(moban);
}

function xrIndex(data){
	var len= data.length;
    console.log(data);
	//touxiang,name,showqq,data,time
	for(var i=0;i<len;i++){
		var ydsimg="";
		var content=data[i].content,
			showqq="",
			more="";
		if(data[i].qq!=null){
			showqq='<a href="http://wpa.qq.com/msgrd?v=3&uin='+data[i].qq+'&site=qq&menu=yes">\
										<div class="lianxifangshi">联系我</div>\
									</a>';
		}
		if(data[i].images!=null){
		   if(data[i].images.length>0){
		   	var imgstyle="";
		   	var imgBig="";
		   	if(data[i].images.length==1){
		   		imgstyle="width:100%;height:auto";
		   		imgBig="?imageView2/1/w/500/h/500/format/jpg/q/75|imageslim";
		   	}else if(data[i].images.length==2){
		   		imgstyle="width:50%;height:auto";
		   		imgBig="?imageView2/1/w/250/h/250/format/jpg/q/75|imageslim";
		   	}else if(data[i].images.length==3){
		   		imgstyle="width:33%;height:auto";
		   		imgBig="?imageView2/1/w/200/h/200/format/jpg/q/75|imageslim";
		   	}else{
		   		imgBig="?imageView2/1/w/200/h/200/format/jpg/q/75|imageslim";
		   	}
			   for(var j=0;j<data[i].images.length;j++){
				   var xhimg ='<a class="galpop-multiple" data-galpop-group="multiple" href="'+ data[i].images[j]+'"><img src="'+data[i].images[j]+''+imgBig+'" style="'+imgstyle+'" class="img-thumbnail" alt="The scene from Alice in Wonderland where she meets the caterpillar." /></a>';
				   ydsimg=ydsimg+xhimg;
			   }
			   
			   more='<div class="gallery-wrapper">\
					'+ydsimg+'\
					</div>';
		   }
		}else if(data[i].mp4!=null){
			more='<div class="pengyou-photo-one">\
						<video controls="controls" style="max-height:300px" poster="'+data[i].mp4+'?vframe/jpg/offset/2" src="'+data[i].mp4+'" type="video/mp4"></video>\
				</div>';
		}
		
	   jieshouIndex(data[i].touxiang+'?imageMogr2/thumbnail/!100x100r',data[i].name,showqq,content,more,data[i].time,data[i].Id);
	}
		$('.galpop-multiple').galpop();			
}



	$.ajax({
    //请求方式
	    type:'get',
	    //发送请求的地址
	    url:'./contentApi.php?page=1',
	    //服务器返回的数据类型
	    dataType:'json',
	    //发送到服务器的数据，对象必须为key/value的格式，jquery会自动转换为字符串格式
	    data:{},
	    success:function(data){
	        xrIndex(data);
	    },
	    error:function(jqXHR){
	        //请求失败函数内容
	    }
	});

