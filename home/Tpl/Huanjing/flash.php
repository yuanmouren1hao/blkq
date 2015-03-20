<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>

<style type="text/css">
*{margin:0;padding:0;list-style-type:none;}
a,img{border:0;}
body{font:12px/180% Arial, Helvetica, sans-serif,"新宋体";}
/* focus_Box */
#focus_Box{position:relative;width:710px;height:308px;margin:20px auto;}
#focus_Box ul{position:relative;width:710px;height:308px}
#focus_Box li{z-index:0;position:absolute; width:0px;background:#787878;height:0px;top:146px;cursor:pointer;left:377px;border-radius:4px;box-shadow:1px 1px 12px rgba(200, 200, 200, 1)}
#focus_Box li img{width:100%;background:url(__PUBLIC__/img/loading.gif) no-repeat center 50%;height:100%;vertical-align:top}
#focus_Box li p{position:absolute;left:0;bottom:0px;width:100%;height:40px;line-height:40px;background:url(__PUBLIC__/img/float-bg.png) repeat;text-indent:8px;color:#fff;}
#focus_Box li p span{display:inline-block;width:70%;height:40px;overflow:hidden;}
#focus_Box .prev,#focus_Box .next{display:block;z-index:100;overflow:hidden;cursor:pointer;position:absolute;width:52px;height:52px;top:131px;}
#focus_Box .prev{background:url(__PUBLIC__/img/btn.png) left bottom no-repeat;left:0px}
#focus_Box .next{background:url(__PUBLIC__/img/btn.png) right bottom no-repeat;right:0px} 
#focus_Box .prev:hover{background-position:left top;}
#focus_Box .next:hover{background-position:right top;}
#focus_Box a.imgs-scroll-btn{display:block;position:absolute;z-index:110;top:7px;right:15px;width:51px;height:23px;overflow:hidden;background:url(__PUBLIC__/img/share-btn.png) no-repeat;text-indent:-999px;}
</style>

<script src="__PUBLIC__/js/ZoomPic.js"></script>


<div id="focus_Box">
	<span class="prev">&nbsp;</span>
	<span class="next">&nbsp;</span>
	<ul>
		<volist name="list" id="vo">
		<li>
			<a href="<?php echo U("huanjing/detail");?>?id={$vo.id}" target="_parent"><img width="445" height="308" alt="desc" src="{$vo.image}" /></a>
			<p>
				<span>{$vo.desc}</span>
				<a href="<?php echo U("huanjing/detail");?>?id={$vo.id}"  target="_parent" class="imgs-scroll-btn">查看详情</a>
			</p>
		</li>
		</volist>
	</ul>
</div>


</body>
</html>