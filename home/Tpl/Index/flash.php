<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLIC__/css/flash/css/style.css" rel="stylesheet" />
<script type="text/javascript"
	src="__PUBLIC__/css/flash/js/startMove.js"></script>
<script type="text/javascript">
window.onload=function(){
	var aPicLi=document.getElementById('pic_list').getElementsByTagName('li');
	var aTextLi=document.getElementById('text_list').getElementsByTagName('li');
	var aIcoLi=document.getElementById('ico_list').getElementsByTagName('li');
	var oIcoUl=document.getElementById('ico_list').getElementsByTagName('ul')[0];
	var oPrev=document.getElementById('btn_prev');
	var oNext=document.getElementById('btn_next');
	var oDiv=document.getElementById('box');
	var i=0;
	var iNowUlLeft=0;
	var iNow=0;
	
	oPrev.onclick=function(){
		if(iNowUlLeft>0){
			iNowUlLeft--;
			oUlleft();
		}
		oPrev.className=iNowUlLeft==0?'btn':'btn showBtn';
		oNext.className=iNowUlLeft==(aIcoLi.length-7)?'btn':'btn showBtn';
	}
	
	oNext.onclick=function(){
		if(iNowUlLeft<aIcoLi.length-7){
			iNowUlLeft++;
			oIcoUl.style.left=-aIcoLi[0].offsetWidth*iNowUlLeft+'px';
		}
		oPrev.className=iNowUlLeft==0?'btn':'btn showBtn';
		oNext.className=iNowUlLeft==(aIcoLi.length-7)?'btn':'btn showBtn';
	}
	
	for(i=0;i<aIcoLi.length;i++){
		aIcoLi[i].index=i;
		aIcoLi[i].onclick=function(){
			if(iNow==this.index){
				return false;
			}
			iNow=this.index;
			tab();
		}
	}
	
	function tab(){
		for(i=0;i<aIcoLi.length;i++){
			aIcoLi[i].className='';
			aPicLi[i].style.filter='alpha(opacity:0)';
			aPicLi[i].style.opacity=0;
			aTextLi[i].getElementsByTagName('h2')[0].className='';
			miaovStopMove( aPicLi[i]);
		}
		aIcoLi[iNow].className='active';
		
		miaovStartMove(aPicLi[iNow],{opacity:100},MIAOV_MOVE_TYPE.BUFFER);
		aTextLi[iNow].getElementsByTagName('h2')[0].className='show';
	}
	
	function oUlleft(){
		oIcoUl.style.left=-aIcoLi[0].offsetWidth*iNowUlLeft+'px';
	}
	
	function autoplay(){
		iNow++;
		if(iNow>=aIcoLi.length){
			iNow=0;
		}
		if(iNow<iNowUlLeft){
			iNowUlLeft=iNow;
		}else if(iNow>=iNowUlLeft+7){
			iNowUlLeft=iNow-6;
		}
		oPrev.className=iNowUlLeft==0?'btn':'btn showBtn';
		oNext.className=iNowUlLeft==(aIcoLi.length-7)?'btn':'btn showBtn';
		oUlleft();
		tab();
	}
	
	var time=setInterval(autoplay,3000);
	oDiv.onmouseover=function(){
		clearInterval(time);
	}
	oDiv.onmouseout=function(){
		time=setInterval(autoplay,3000);
	}

}
</script>
</head>

<body>

	<div id="box">
		<ul id="pic_list">
			<volist name="video_list" id="vo">
			<li <?php if($i==1):?>
				style="z-index: 2; opacity: 1; fliter: alpha(opacity =   100);"
				<?php endif;?>><a
				href="<?php echo U("index/news_detail");?>?id={$vo.id}" target="_parent"> <img
					width="780" height="330" src="{$vo.fmimg_b}" alt="{$vo.title}" />
			</a></li>
			</volist>
		</ul>

		<div class="mark"></div>

		<ul id="text_list">
			<volist name="video_list" id="vo">
			<li <?php if($i==1):?> class="show" <?php endif;?>><h2>
					<a target="_parent"
						href="<?php echo U("index/news_detail");?>?id={$vo.id}">{$vo.title}</a>
				</h2></li>
			</volist>
		</ul>

		<div id="ico_list">
			<ul>
				<volist name="video_list" id="vo">
				<li <?php if($i==1):?> class="active" <?php endif;?>><a
					href="javascript:void(0)"  target="_parent"><img width="64" height="34"
						src="{$vo.fmimg_s}" alt="{$vo.title}" /></a></li>
				</volist>
			</ul>
		</div>

		<a href="javascript:void(0)" id="btn_prev" class="btn"></a> <a
			href="javascript:void(0)" id="btn_next" class="btn showBtn"></a>
	</div>
</body>
</html>
