<ul class="bread float-right text-right x9">
	<li><a href="<?php echo U("index/index");?>" class="icon-home"> 首页</a></li>
	<?php if (MODULE_NAME=="Index"):?>
		<li><a href="<?php echo U("index/index");?>"><?php echo mc_option('site_name')?></a></li>
		<?php if(ACTION_NAME=="jianjie"):?>
			<li>医院简介</li><?php endif;?>
		<?php if(ACTION_NAME=="news"):?>
			<li>新闻动态</li><?php endif;?>
		<?php if(ACTION_NAME=="map"):?>
			<li>来院地图</li><?php endif;?>
		<?php if(ACTION_NAME=="zixun"):?>
			<li>在线咨询</li><?php endif;?>
		<?php if(ACTION_NAME=="video"):?>
			<li>口腔视频</li><?php endif;?>
		<?php if(ACTION_NAME=="liuyan"):?>
			<li>在线留言</li><?php endif;?>
		<?php if(ACTION_NAME=="yuyue"):?>
			<li>在线预约</li><?php endif;?>
		<?php if(ACTION_NAME=="liuyan_list"):?>
			<li>留言列表</li><?php endif;?>
		<?php if(ACTION_NAME=="liucheng"):?>
			<li>就诊流程图</li><?php endif;?>
		<?php if(ACTION_NAME=="news_detail"):?>
			<li>{$info.title}</li><?php endif;?>
		<?php if(ACTION_NAME=="search"):?>
			<li>搜索</li><?php endif;?>
	<?php endif;?>
	
	<?php if (MODULE_NAME=="Doctor"):?>
	<li><a href="<?php echo U("Doctor/zhengji");?>"> 医师团队</a></li>
		<?php if(ACTION_NAME=="zhengji"):?>
			<li><a href="<?php echo U("Doctor/zhengji");?>">正畸专家</a></li><?php endif;?>
		<?php if(ACTION_NAME=="zonghe"):?>
			<li><a href="<?php echo U("Doctor/zonghe");?>">综合团队</a></li><?php endif;?>
		<?php if(ACTION_NAME=="zhongzhi"):?>
			<li><a href="<?php echo U("Doctor/zhongzhi");?>">种植医师</a></li><?php endif;?>
		<?php if(ACTION_NAME=="xiufu"):?>
			<li><a href="<?php echo U("Doctor/xiufu");?>">修复医师</a></li><?php endif;?>
		<?php if(ACTION_NAME=="yazhou"):?>
			<li><a href="<?php echo U("Doctor/yazhou");?>">牙周医师</a></li><?php endif;?>
		<?php if(ACTION_NAME=="doctor_detail"):?>
			<li><a href="<?php echo U("Doctor/zhengji");?>">医师详情</a></li><li>{$info.name}</li><?php endif;?>
	<?php endif;?>
	
	<?php if (MODULE_NAME=="Huanjing"):?>
	<li><a href="<?php echo U("Huanjing/duli");?>"> 优雅环境</a></li>
		<?php if(ACTION_NAME=="ertong"):?>
			<li><a href="<?php echo U("Huanjing/ertong");?>">儿童专区</a></li><?php endif;?>
		<?php if(ACTION_NAME=="vip"):?>
			<li><a href="<?php echo U("Huanjing/vip");?>">VIP专区</a></li><?php endif;?>
		<?php if(ACTION_NAME=="duli"):?>
			<li><a href="<?php echo U("Huanjing/duli");?>">独立诊室</a></li><?php endif;?>
		<?php if(ACTION_NAME=="doctor_detail"):?>
			<li><a href="<?php echo U("Huanjing/doctor_detail");?>">优雅环境详情</a></li><li>{$info.name}</li><?php endif;?>
	<?php endif;?>
	
	<?php if (MODULE_NAME=="Shebei"):?>
	<li><a href="<?php echo U("Shebei/jiguang");?>"> 领先设备</a></li>
		<?php if(ACTION_NAME=="jiguang"):?>
			<li><a href="<?php echo U("Shebei/jiguang");?>">激光治疗仪</a></li><?php endif;?>
		<?php if(ACTION_NAME=="lengqi"):?>
			<li><a href="<?php echo U("Shebei/lengqi");?>">BEYOND冷气美白</a></li><?php endif;?>
		<?php if(ACTION_NAME=="xiaoqi"):?>
			<li><a href="<?php echo U("Shebei/xiaoqi");?>">笑气</a></li><?php endif;?>
		<?php if(ACTION_NAME=="shebei_detail"):?>
			<li><a href="<?php echo U("Shebei/shebei_detail");?>">领先设备详情</a></li><li>{$info.name}</li><?php endif;?>
	<?php endif;?>
	
	<?php if (MODULE_NAME=="Page"):?>
		<?php if(ACTION_NAME=="page_list"):?>
		<li><a href="<?php echo U("page/page_list").'?father='.$_REQUEST['father'].'&child='.$_REQUEST['child'];?>"> <?php echo $_REQUEST['father']?></a></li>
		<li><a href="<?php echo U("page/page_list").'?father='.$_REQUEST['father'].'&child='.$_REQUEST['child'];?>"> <?php echo $_REQUEST['child']?></a></li><?php endif;?>
		<?php if(ACTION_NAME=="page_detail"):?>
		<li><a href="<?php echo U("page/page_list").'?father='.$info['father'].'&child='.$info['child'];?>"> <?php echo $info['father']?></a></li>
		<li><a href="<?php echo U("page/page_list").'?father='.$info['father'].'&child='.$info['child'];?>"> <?php echo $info['child']?></a></li>
		<li><a href="<?php echo U("page/page_detail")?>?id={$info.id}">{$info.title}</a></li><?php endif;?>
	<?php endif;?>
</ul>

<div class="clearfix"></div>