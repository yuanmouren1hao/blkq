

<div>
	<ul class="nav nav-main nav-navicon" id="nav-main1">
				<?php if(MODULE_NAME=="Index"):?>
					<li class="nav-head icon-hospital-o h3 padding-large">&nbsp;北仑口腔医院</li>
		<li <?php if(ACTION_NAME=="jianjie"):?> class="active" <?php endif;?>><a
			href="<?php echo U('Index/jianjie');?>">医院简介</a></li>
		<li <?php if(ACTION_NAME=="news" or ACTION_NAME=="news_detail"):?>
			class="active" <?php endif;?>><a href="<?php echo U('Index/news');?>">新闻动态</a></li>
		<li <?php if(ACTION_NAME=="map"):?> class="active" <?php endif;?>><a
			href="<?php echo U('Index/map');?>">来院地图</a></li>
		<li <?php if(ACTION_NAME=="zixun"):?> class="active" <?php endif;?>><a
			href="http://dx.zoosnet.net/lrserver/LR/Chatpre.aspx?id=LZS32497012" target="_blank">在线咨询</a></li>
		<li <?php if(ACTION_NAME=="video"):?> class="active" <?php endif;?>><a
			href="<?php echo U('Index/video');?>">口腔视频</a></li>
		<li <?php if(ACTION_NAME=="liucheng"):?> class="active" <?php endif;?>><a
			href="<?php echo U('Index/liucheng');?>">就诊流程</a></li>
				
					<?php elseif (MODULE_NAME=="Doctor"):?>
					<li class="nav-head icon-hospital-o h3 padding-large">&nbsp;医师团队</li>
		<li <?php if(ACTION_NAME=="zhengji" or  $type=="正畸专家"):?>
			class="active" <?php endif;?>><a
			href="<?php echo U('Doctor/zhengji');?>">正畸专家</a></li>
		<li <?php if(ACTION_NAME=="zhongzhi" or  $type=="种植医师"):?>
			class="active" <?php endif;?>><a
			href="<?php echo U('Doctor/zhongzhi');?>">种植医师</a></li>
		<li <?php if(ACTION_NAME=="xiufu" or  $type=="修复医师"):?> class="active"
			<?php endif;?>><a href="<?php echo U('Doctor/xiufu');?>">修复医师</a></li>
		<li <?php if(ACTION_NAME=="yazhou" or  $type=="牙周医师"):?>
			class="active" <?php endif;?>><a
			href="<?php echo U('Doctor/yazhou');?>">牙周医师</a></li>
		<li <?php if(ACTION_NAME=="zonghe" or  $type=="综合团队"):?>
			class="active" <?php endif;?>><a
			href="<?php echo U('Doctor/zonghe');?>">综合团队</a></li>
			
			
				<?php elseif (MODULE_NAME=="Shebei"):?>
					<li class="nav-head icon-hospital-o h3 padding-large">&nbsp;领先设备</li>
						<?php $list_shebei=selectList('catelog','father="领先设备"','create_time desc','');?>
						<?php foreach ($list_shebei as $val):?>
							<li <?php  if($_REQUEST['child']==$val['child']):?> class="active" <?php endif;?>><a href="<?php echo U("shebei/index");?>?child=<?php echo $val['child']?>"><?php echo $val['child']?></a></li>
						<?php endforeach;?>
			
				<?php elseif (MODULE_NAME=="Huanjing"):?>
					<li class="nav-head icon-hospital-o h3 padding-large">&nbsp;优雅环境</li>
						<?php $list_huanjing=selectList('catelog','father="优雅环境"','create_time desc','');?>
						<?php foreach ($list_huanjing as $val):?>
							<li <?php  if($_REQUEST['child']==$val['child']):?> class="active" <?php endif;?>><a href="<?php echo U("Huanjing/index");?>?child=<?php echo $val['child']?>"><?php echo $val['child']?></a></li>
						<?php endforeach;?>
				
				
				
				<?php elseif (MODULE_NAME=="Page" and ACTION_NAME=="page_detail" and $_REQUEST['father']=='儿童齿科'):?>
					<li class="nav-head icon-hospital-o h3 padding-large">&nbsp;儿童齿科</li>
					<?php $list=selectList('catelog','father="儿童齿科"','create_time desc','');?>
					<?php foreach ($list as $val):?>
						<li <?php if($_REQUEST['child']==$val['child']):?> class="active" <?php endif;?>><a href="<?php echo U("Page/page_detail");?>?father=儿童齿科&child=<?php echo $val['child']?>"><?php echo $val['child']?></a></li>
					<?php endforeach;?>
				
				<?php elseif (MODULE_NAME=="Page" and ACTION_NAME=="page_detail" and $_REQUEST['father']=='常规治疗'):?>
					<li class="nav-head icon-hospital-o h3 padding-large">&nbsp;常规治疗</li>
					<?php $list=selectList('catelog','father="常规治疗"','create_time desc','');?>
					<?php foreach ($list as $val):?>
						<li <?php if($_REQUEST['child']==$val['child']):?> class="active" <?php endif;?>><a href="<?php echo U("Page/page_detail");?>?father=常规治疗&child=<?php echo $val['child']?>"><?php echo $val['child']?></a></li>
					<?php endforeach;?>
				
				<?php elseif (MODULE_NAME=="Page" and ACTION_NAME=="page_detail" and $_REQUEST['father']=='牙齿矫正'):?>
					<li class="nav-head icon-hospital-o h3 padding-large">&nbsp;牙齿矫正</li>
					<?php $list=selectList('catelog','father="牙齿矫正"','create_time desc','');?>
					<?php foreach ($list as $val):?>
						<li <?php if($_REQUEST['child']==$val['child']):?> class="active" <?php endif;?>><a href="<?php echo U("Page/page_detail");?>?father=牙齿矫正&child=<?php echo $val['child']?>"><?php echo $val['child']?></a></li>
					<?php endforeach;?>
				
				<?php elseif (MODULE_NAME=="Page" and ACTION_NAME=="page_detail" and $_REQUEST['father']=='牙齿美白'):?>
					<li class="nav-head icon-hospital-o h3 padding-large">&nbsp;牙齿美白</li>
					<?php $list=selectList('catelog','father="牙齿美白"','create_time desc','');?>
					<?php foreach ($list as $val):?>
						<li <?php if($_REQUEST['child']==$val['child']):?> class="active" <?php endif;?>><a href="<?php echo U("Page/page_detail");?>?father=牙齿美白&child=<?php echo $val['child']?>"><?php echo $val['child']?></a></li>
					<?php endforeach;?>				
				
				<?php elseif (MODULE_NAME=="Page" and ACTION_NAME=="page_detail" and $_REQUEST['father']=='牙齿修复'):?>
					<li class="nav-head icon-hospital-o h3 padding-large">&nbsp;牙齿修复</li>
					<?php $list=selectList('catelog','father="牙齿修复"','create_time desc','');?>
					<?php foreach ($list as $val):?>
						<li <?php if($_REQUEST['child']==$val['child']):?> class="active" <?php endif;?>><a href="<?php echo U("Page/page_detail");?>?father=牙齿修复&child=<?php echo $val['child']?>"><?php echo $val['child']?></a></li>
					<?php endforeach;?>		
				
				
				<?php elseif (MODULE_NAME=="Page" and ACTION_NAME=="page_detail" and $_REQUEST['father']=='种植牙'):?>
					<li class="nav-head icon-hospital-o h3 padding-large">&nbsp;种植牙</li>
					<?php $list=selectList('catelog','father="种植牙"','create_time desc','');?>
					<?php foreach ($list as $val):?>
						<li <?php if($_REQUEST['child']==$val['child']):?> class="active" <?php endif;?>><a href="<?php echo U("Page/page_detail");?>?father=种植牙&child=<?php echo $val['child']?>"><?php echo $val['child']?></a></li>
					<?php endforeach;?>	
				
				
				<?php elseif (MODULE_NAME=="Page" and ACTION_NAME=="page_detail" and $_REQUEST['father']=='牙周专科'):?>
					<li class="nav-head icon-hospital-o h3 padding-large">&nbsp;牙周专科</li>
					<?php $list=selectList('catelog','father="牙周专科"','create_time desc','');?>
					<?php foreach ($list as $val):?>
						<li <?php if($_REQUEST['child']==$val['child']):?> class="active" <?php endif;?>><a href="<?php echo U("Page/page_detail");?>?father=牙周专科&child=<?php echo $val['child']?>"><?php echo $val['child']?></a></li>
					<?php endforeach;?>	
				
				<?php elseif (MODULE_NAME=="Page" and ACTION_NAME=="page_detail" and $_REQUEST['father']=='症状自查'):?>
					<li class="nav-head icon-hospital-o h3 padding-large">&nbsp;症状自查</li>
					<?php $list=selectList('catelog','father="症状自查"','create_time desc','');?>
					<?php foreach ($list as $val):?>
						<li <?php if($_REQUEST['child']==$val['child']):?> class="active" <?php endif;?>><a href="<?php echo U("Page/page_detail");?>?father=症状自查&child=<?php echo $val['child']?>"><?php echo $val['child']?></a></li>
					<?php endforeach;?>	
					
				<?php elseif (MODULE_NAME=="Page" and ACTION_NAME=="page_detail" and $_REQUEST['father']=='经典病例'):?>
					<li class="nav-head icon-hospital-o h3 padding-large">&nbsp;经典病例</li>
					<?php $list=selectList('catelog','father="经典病例"','create_time desc','');?>
					<?php foreach ($list as $val):?>
						<li <?php if($_REQUEST['child']==$val['child']):?> class="active" <?php endif;?>><a href="<?php echo U("Page/page_detail");?>?father=经典病例&child=<?php echo $val['child']?>"><?php echo $val['child']?></a></li>
					<?php endforeach;?>	
					
				<?php elseif (MODULE_NAME=="Page" and ACTION_NAME=="page_detail" and $_REQUEST['father']=='口腔保健'):?>
					<li class="nav-head icon-hospital-o h3 padding-large">&nbsp;口腔保健</li>
					<?php $list=selectList('catelog','father="口腔保健"','create_time desc','');?>
					<?php foreach ($list as $val):?>
						<li <?php if($_REQUEST['child']==$val['child']):?> class="active" <?php endif;?>><a href="<?php echo U("Page/page_detail");?>?father=口腔保健&child=<?php echo $val['child']?>"><?php echo $val['child']?></a></li>
					<?php endforeach;?>	
				
				<?php endif;?>
			</ul>
</div>




<div class="padding-top">
	<h4 class="padding-top padding-bottom">
		<strong>一键分享</strong>
	</h4>
	<div class="bshare-custom">
		<a title="分享到QQ空间" class="bshare-qzone"></a><a title="分享到新浪微博"
			class="bshare-sinaminiblog"></a><a title="分享到人人网"
			class="bshare-renren"></a><a title="分享到腾讯微博" class="bshare-qqmb"></a><a
			title="分享到网易微博" class="bshare-neteasemb"></a><a title="更多平台"
			class="bshare-more bshare-more-icon more-style-addthis"></a><span
			class="BSHARE_COUNT bshare-share-count">0</span>
	</div>
	<script type="text/javascript" charset="utf-8"
		src="http://static.bshare.cn/b/button.js#style=-1&amp;uuid=&amp;pophcol=2&amp;lang=zh"></script>
	<a class="bshareDiv" onclick="javascript:return false;"></a>
	<script type="text/javascript" charset="utf-8"
		src="http://static.bshare.cn/b/bshareC0.js"></script>
</div>
<hr class="bg-gray-light">

<div>
	<h4 class="padding-top">
		<strong>健康热线</strong>
	</h4>
	<h4 class="padding-bottom">
		<small><?php echo mc_option('tel');?></small>
	</h4>
</div>
<hr class="bg-gray-light">

<div>
	<h4 class="padding-top">
		<strong>E-MAIL</strong>
	</h4>
	<h4 class="padding-bottom">
		<small><?php echo mc_option('mail');?></small>
	</h4>
</div>
<hr class="bg-gray-light">

<div>
	<h4 class="padding-top padding-bottom">
		<strong>在线咨询</strong>
	</h4>
	<a target="_blank" class="txt radius-circle text-red icon-weibo text-large shake-hover" href="<?php echo mc_option('weibo');?>"></a>
	<a target="_blank" class="txt radius-circle text-green icon-weixin dialogs text-large shake-hover dialogs" href="javascript:;" data-toggle="click" data-target="#mydialog"	data-mask="1" data-width="30%"></a>
	<a target="_blank" class="txt radius-circle text-blue icon-qq text-large shake-hover" href="<?php echo mc_option('qq');?>"></a>
	<a target="_blank" class="txt radius-circle text-green icon-tencent-weibo text-large shake-hover" href="<?php echo mc_option('tqq');?>"></a>
</div>
<hr class="bg-gray-light">

<div>
	<font><a href="<?php echo U("index/liucheng");?>">就诊流程图</a></font> <font
		style='margin-left: 30px'><a href="<?php echo U("index/yuyue");?>">在线预约</a></font>
</div>


<div id="mydialog">
	<div class="dialog">
		<div class="dialog-head">
			<span class="close rotate-hover"></span> <strong>微信二维码,请用手机扫描二维码</strong>
		</div>
		<div class="dialog-body text-center">
			<img alt="" src="<?php echo mc_option('weixin_code');?>">
		</div>
		<div class="dialog-foot">
			<button class="button dialog-close">取消</button>
			<button class="button bg-green dialog-close">确认</button>
		</div>
	</div>
</div>
