
<div class='line-small padding-top'>
	<div class="container-layout  bg-inverse"
		style='background: rgb(119, 119, 119)'>
		<div class="table-responsive  hidden-l bg-gray padding-large-top"
			style='background: rgb(119, 119, 119)'>
			<div class='x3'>
				<img class='margin-big float-right padding-big'
					src='__PUBLIC__/img/bl-logo-f.jpg'>
			</div>
			<div class='x6'>
				<ul class="nav nav-sitemap li-small">
					<li>专家团队
						<ul class='margin-top'>
							<li><a href="<?php echo U("doctor/zonghe");?>">综合团队</a></li>
							<li><a href="<?php echo U("doctor/zhengji");?>">正畸专家</a></li>
							<li><a href="<?php echo U("doctor/zhongzhi");?>">种植医师</a></li>
							<li><a href="<?php echo U("doctor/xiufu");?>">修复医师</a></li>
							<li><a href="<?php echo U("doctor/yazhou");?>">牙周医师</a></li>
							<li><a href="<?php echo U("index/appoint");?>" target="_blank">预约信息</a></li>
							<li><a href="__ROOT__/admin.php/doctor-login">医师登录</a></li>
						</ul>
					</li>
					<li>诊疗服务
						<ul class='margin-top'>
							<li><a
								href="<?php echo U("page/page_detail");?>?father=种植牙&child=种植流程">种植牙</a></li>
							<li><a
								href="<?php echo U("page/page_detail");?>?father=牙齿矫正&child=隐形矫正">牙齿矫正</a></li>
							<li><a
								href="<?php echo U("page/page_detail");?>?father=牙齿修复&child=全瓷牙">牙齿修复</a></li>
							<li><a
								href="<?php echo U("page/page_detail");?>?father=牙齿美白&child=冷光美白">牙齿美白</a></li>
							<li><a
								href="<?php echo U("page/page_detail");?>?father=牙周专科&child=牙周炎危害">牙周专科</a></li>
							<li><a
								href="<?php echo U("page/page_detail");?>?father=常规治疗&child=微创拔牙">常规治疗</a></li>
							<li><a
								href="<?php echo U("page/page_detail");?>?father=儿童齿科&child=窝沟封闭">儿童专题</a></li>
						</ul>
					</li>
					<li>就诊指南
						<ul class='margin-top'>
							<li><a href="<?php echo U("index/liucheng");?>">就诊流程</a></li>
							<li><a href="<?php echo U("index/yuyue");?>">在线预约</a></li>
						</ul>
					</li>
					<li>联系我们
						<ul class='margin-top'>
							<li><a href="<?php echo U("index/yuyue");?>">在线预约</a></li>
							<li><a href="<?php echo U("index/map");?>">来院地图</a></li>
							<li><a href="<?php echo U("index/liuyan");?>">患者留言</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div class='x3'>
				<div class="media padding-big margin-big clearfix">
					<img class='margin-big-left' src="__PUBLIC__/img/weixin.jpg"
						class="radius img-responsive">
					<div class="media-body">
						<strong>北仑口腔微信公众平台</strong> <small>本站所有病例、环境、文字均由北仑口腔医院拍摄完成，未经同意，其他网站不得抄袭。</small>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="text-center bg-black bg-inverse padding-top padding-bottom"
		style='background: rgb(102, 102, 102)'>版权所有 &copy; <a href="<?php echo mc_option('site_url')?>"><?php echo mc_option('site_name')?></a> All
		Rights Reserved, <?php echo mc_option('foot_copyright')?></div>
</div>


</div>
<script src="__PUBLIC__/pintuer/jquery.js"></script>
<script src="__PUBLIC__/pintuer/pintuer.js"></script>
<script src="__PUBLIC__/pintuer/respond.js"></script>
<script type="text/javascript">
		var xmlhttp;
		xmlhttp=new XMLHttpRequest();
		xmlhttp.onreadystatechange=function()
		  {
				if(xmlhttp.readyState==4&&xmlhttp.status==200)
				{
// 					alert(xmlhttp.responseText);
				}
		  }
		var from_url=document.referrer;
		var to_url=document.URL;
// 		alert(form_url+'-->'+to_url);
		xmlhttp.open("POST","{:U('Public/source')}?t="+Math.random(),true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("to_url="+to_url+"&from_url="+from_url);
</script>
<?php
$content = stripslashes ( mc_option('js') );
echo html_entity_decode ( $content );
?>
</body>
</html>