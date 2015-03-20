<include file="Public/head" />
<include file="Public/banner" />


<div class="line padding-top padding-big-bottom">
	<div class="x3 padding-big bg-gray-light border radius">
	
		<include file="Public/left" /> 
		
	</div>
	<div class="x9">
		<include file="Public/bread" />
		<div class="padding-large">
			
			         <div class="detail">
					         <div class="text-center padding-large-bottom" ><img src='{$info.image}'></div>
							 <p class="text-center"><strong>{$info.name}</strong></p>
							 <p>{$info.content}</p>
							 </div>
					</div>
					<div class="line margin-top text-center">
						<a href="<?php echo U("index/yuyue");?>?id={$info.id}"><button class="button button-big icon-user-md bg-blue margin-right"> 在线预约 </button></a>
						<a href="<?php echo U("index/liucheng");?>"><button class="button button-big icon-ambulance bg-red margin-right"> 就诊流程 </button></a>
						<a href="<?php echo U("index/liuyan");?>"><button class="button button-big icon-comments bg-yellow margin-right"> 反馈留言 </button></a>
					</div>
		</div>
	</div>
	




<include file="Public/foot" />