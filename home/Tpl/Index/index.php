
<include file="Public/head" />


<div class="doc-demoview doc-viewad0 ">
	<div class="view-body">
		<div class="banner">
			<div class="carousel">
				<div class="item">
					<div class="doc-carousel">
						<a href="<?php echo mc_option('f_url_1')?>" target="_blank"><img src='<?php echo mc_option('f_img_1')?>' /></a>
					</div>
				</div>
				<div class="item">
					<div class="doc-carousel">
						<a href="<?php echo mc_option('f_url_2')?>" target="_blank"><img src='<?php echo mc_option('f_img_2')?>' /></a>
					</div>
				</div>
				<div class="item">
					<div class="doc-carousel">
						<a href="<?php echo mc_option('f_url_3')?>" target="_blank"><img src='<?php echo mc_option('f_img_3')?>' /></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="text-center">
	<div
		style="position: relative; margin: 0 auto; padding: 0px; width: 1000px; text-align: left;">
		<ul id="div_li">
			<li><div id='h_zzy'>
					<i class="iconfont">&#xe604;</i><br> <a
						href="<?php echo U("page/page_detail");?>?father=种植牙&child=种植流程">口腔种植</a>
				</div></li>
			<li><div id='h_ycjz'>
					<i class="iconfont">&#xe600;</i><br> <a
						href="<?php echo U("page/page_detail");?>?father=牙齿矫正&child=隐形矫正">口腔正畸</a>
				</div></li>
			<li><div id='h_mrxf'>
					<i class="iconfont">&#xe603;</i><br> <a
						href="<?php echo U("page/page_detail");?>?father=牙齿修复&child=全瓷牙">口腔修复</a>
				</div></li>
			<li><div id='h_ycmb'>
					<i class="iconfont">&#xe602;</i><br> <a
						href="<?php echo U("page/page_detail");?>?father=牙齿美白&child=冷光美白">牙齿美白</a>
				</div></li>
			<li><div id='h_ytjk'>
					<i class="iconfont">&#xe604;</i><br> <a
						href="<?php echo U("page/page_detail");?>?father=牙周专科&child=牙周炎危害">牙周病</a>
				</div></li>
			<li><div id='h_cgzl'>
					<i class="iconfont">&#xe606;</i><br> <a
						href="<?php echo U("page/page_detail");?>?father=常规治疗&child=微创拔牙">常规治疗</a>
				</div></li>
			<li><div id='h_etck'>
					<i class="iconfont">&#xe601;</i><br> <a
						href="<?php echo U("page/page_detail");?>?father=儿童齿科&child=窝沟封闭">儿童口腔</a>
				</div></li>
			<li><div id='h_kqbj'>
					<i class="iconfont">&#xe609;</i><br> <a
						href="<?php echo U("page/page_detail");?>?father=口腔保健&child=儿童护理">预防口腔</a>
				</div></li>
		</ul>
	</div>
</div>
<div style='width: 100%; height: 5px; background: RGB(149, 149, 147)'></div>
<div id='zzy' class="x12 div_submenu float-left" style="padding-left: 20px;">
		<?php $list=selectList('catelog','father="种植牙"','create_time desc','');?>
		<?php foreach ($list as $val):?>
			<a
		href="<?php echo U("page/page_detail");?>?father=种植牙&child=<?php echo $val['child'];?>"><font_f><?php echo $val['child'];?></font_f></a>|
		<?php endforeach;?>
	</div>
<div id='ycjz' class="x12 div_submenu float-left" style="padding-left: 100px;">
		<?php $list=selectList('catelog','father="牙齿矫正"','create_time desc','');?>
		<?php foreach ($list as $val):?>
			<a
		href="<?php echo U("page/page_detail");?>?father=牙齿矫正&child=<?php echo $val['child'];?>"><font_f><?php echo $val['child'];?></font_f></a>|
		<?php endforeach;?>
	</div>
<div id='mrxf' class="x12 div_submenu float-left" style="padding-left: 180px;">
		<?php $list=selectList('catelog','father="牙齿修复"','create_time desc','');?>
		<?php foreach ($list as $val):?>
			<a
		href="<?php echo U("page/page_detail");?>?father=牙齿修复&child=<?php echo $val['child'];?>"><font_f><?php echo $val['child'];?></font_f></a>|
		<?php endforeach;?>
	</div>
<div id='ycmb' class="x12 div_submenu float-left" style="padding-left: 260px;">
		<?php $list=selectList('catelog','father="牙齿美白"','create_time desc','');?>
		<?php foreach ($list as $val):?>
			<a
		href="<?php echo U("page/page_detail");?>?father=牙齿美白&child=<?php echo $val['child'];?>"><font_f><?php echo $val['child'];?></font_f></a>|
		<?php endforeach;?>
	</div>
<div id='ytjk' class="x12 div_submenu float-right" style="padding-left: 340px;">
		<?php $list=selectList('catelog','father="牙周专科"','create_time desc','');?>
		<?php foreach ($list as $val):?>
			<a
		href="<?php echo U("page/page_detail");?>?father=牙周专科&child=<?php echo $val['child'];?>"><font_f><?php echo $val['child'];?></font_f></a>|
		<?php endforeach;?>
	</div>
<div id='cgzl' class="x12 div_submenu float-right" style="padding-left: 420px;">
		<?php $list=selectList('catelog','father="常规治疗"','create_time desc','');?>
		<?php foreach ($list as $val):?>
			<a
		href="<?php echo U("page/page_detail");?>?father=常规治疗&child=<?php echo $val['child'];?>"><font_f><?php echo $val['child'];?></font_f></a>|
		<?php endforeach;?>
	</div>
<div id='etck' class="x12 div_submenu float-right" style="padding-left: 500px;">
		<?php $list=selectList('catelog','father="儿童齿科"','create_time desc','');?>
		<?php foreach ($list as $val):?>
			<a
		href="<?php echo U("page/page_detail");?>?father=儿童齿科&child=<?php echo $val['child'];?>"><font_f><?php echo $val['child'];?></font_f></a>|
		<?php endforeach;?>
	</div>
<div id='kqbj' class="x12 div_submenu float-right" style="padding-left: 580px;">
		<?php $list=selectList('catelog','father="口腔保健"','create_time desc','');?>
		<?php foreach ($list as $val):?>
			<a
		href="<?php echo U("page/page_detail");?>?father=口腔保健&child=<?php echo $val['child'];?>"><font_f><?php echo $val['child'];?></font_f></a>|
		<?php endforeach;?>
	</div>



<include file="Public/index_banner" />


<div class="line-middle margin-top">

	<div class="x8">
		<div class="panel">
			<div class="panel-head icon-video-camera">
				<strong><a href="<?php echo U("index/video");?>">口腔视频</a></strong>
			</div>
			<div class="media-inline">
				<iframe border="0" frameborder="0" height="330px" width="100%"
					src="<?php echo U("Index/flash");?>"></iframe>
			</div>
		</div>
	</div>

	<div class="x4">
		<div class="panel">
			<div class="panel-head icon-comments">
				<strong><a href="<?php echo U("index/news");?>">医院动态</a></strong>
			</div>
			<div class="media-inline">
				<ul class="list-text list-underline list-striped">
					<volist name="news_list" id="vo">
					<li><span class="date"><?php echo date('Y-m-d',strtotime($vo['updatetime']))?></span><a
						href="<?php echo U("index/news_detail");?>?id={$vo.id}">{$vo.title}</a></li>
					</volist>
				</ul>
			</div>
		</div>
	</div>

</div>


<div class="line-middle margin-top">
	<div class="x8">
		<div class="panel">
			<div class="panel-head icon-stethoscope">
				<strong><a
					href="<?php echo U("page/page_list");?>?father=症状自查&child=牙齿不齐">症状自查</a></strong>
			</div>
			<div class="media-inline">

				<div style='width: 380px' class='float-left'>
					<div class="media media-y clearfix margin-left">
						<div class="media-body">
							<span class="tag bg-blue-light margin-right h5"><a
								href="<?php echo U("page/page_detail");?>?father=症状自查&child=牙齿不齐">牙齿不齐</a></span>
							<span><u><a href="<?php echo U("page/page_detail");?>?father=症状自查&child=牙齿不齐"><?php echo  cut_mixstr(getAttr('catelog', 'catelog_desc', 'father="症状自查" and child="牙齿不齐"' ),18)?></a></u></span>
						</div>
					</div>
					<div class="media media-y clearfix margin-left">
						<div class="media-body">
							<span class="tag bg-blue-light margin-right h5"><a
								href="<?php echo U("page/page_detail");?>?father=症状自查&child=牙龈出血">牙龈出血</a></span>
							<span><u><a
									href="<?php echo U("page/page_detail");?>?father=症状自查&child=牙龈出血"><?php echo  cut_mixstr(getAttr('catelog', 'catelog_desc', 'father="症状自查" and child="牙龈出血"' ),18)?></a></u></span>
						</div>
					</div>
					<div class="media media-y clearfix margin-left">
						<div class="media-body">
							<span class="tag bg-blue-light margin-right h5"><a
								href="<?php echo U("page/page_detail");?>?father=症状自查&child=牙齿缺失">牙齿缺失</a></span>
							<span><u><a
									href="<?php echo U("page/page_detail");?>?father=症状自查&child=牙齿缺失"><?php echo  cut_mixstr(getAttr('catelog', 'catelog_desc', 'father="症状自查" and child="牙齿缺失"' ),18)?></a></u></span>
						</div>
					</div>
				</div>

				<div style='width: 380px' class='float-right'>
					<div class="media media-y clearfix margin-left">
						<div class="media-body">
							<span class="tag bg-blue-light margin-right h5"><a
								href="<?php echo U("page/page_detail");?>?father=症状自查&child=牙齿变色">牙齿变色</a></span>
							<span><u><a
									href="<?php echo U("page/page_detail");?>?father=症状自查&child=牙齿变色"><?php echo  cut_mixstr(getAttr('catelog', 'catelog_desc', 'father="症状自查" and child="牙齿变色"' ),18)?></a></u></span>
						</div>
					</div>
					<div class="media media-y clearfix margin-left">
						<div class="media-body">
							<span class="tag bg-blue-light margin-right h5"><a
								href="<?php echo U("page/page_detail");?>?father=症状自查&child=口腔异常">口腔异常</a></span>
							<span><u><a
									href="<?php echo U("page/page_detail");?>?father=症状自查&child=口腔异常"><?php echo  cut_mixstr(getAttr('catelog', 'catelog_desc', 'father="症状自查" and child="口腔异常"' ),18)?></a></u></span>
						</div>
					</div>
					<div class="media media-y clearfix margin-left">
						<div class="media-body">
							<span class="tag bg-blue-light margin-right h5"><a
								href="<?php echo U("page/page_detail");?>?father=症状自查&child=牙齿酸痛">牙齿酸痛</a></span>
							<span><u><a
									href="<?php echo U("page/page_detail");?>?father=症状自查&child=牙齿酸痛"><?php echo  cut_mixstr(getAttr('catelog', 'catelog_desc', 'father="症状自查" and child="牙齿酸痛"' ),18)?></a></u></span>
						</div>
					</div>
				</div>
				<div class='clearfix'></div>
			</div>
		</div>
	</div>


	<div class="x4">
		<div class="panel">
			<div class="panel-head icon-ambulance">
				<strong><a
					href="<?php echo U("page/page_detail");?>?father=经典病例&child=口腔正畸">经典病例</a></strong>
			</div>
			<div class="media-inline">
				<div style='width: 120px' class='float-left'>
					<div class="media media-y clearfix margin-left margin-top">
						<div class="media-body">
							<a
								href="<?php echo U("page/page_detail");?>?father=经典病例&child=口腔正畸">口腔正畸</a>
						</div>
					</div>
					<div class="media media-y clearfix margin-left margin-top">
						<div class="media-body">
							<a
								href="<?php echo U("page/page_detail");?>?father=经典病例&child=美容美白">美容美白</a>
						</div>
					</div>
					<div class="media media-y clearfix margin-left margin-top">
						<div class="media-body">
							<a
								href="<?php echo U("page/page_detail");?>?father=经典病例&child=口腔种植">口腔种植</a>
						</div>
					</div>
				</div>
				<div style='width: 120px' class='float-left'>
					<div class="media media-y clearfix margin-left margin-top">
						<div class="media-body">
							<a
								href="<?php echo U("page/page_detail");?>?father=经典病例&child=口腔修复">口腔修复</a>
						</div>
					</div>
					<div class="media media-y clearfix margin-left margin-top">
						<div class="media-body">
							<a
								href="<?php echo U("page/page_detail");?>?father=经典病例&child=常规治疗">常规治疗</a>
						</div>
					</div>
					<div class="media media-y clearfix margin-left margin-top">
						<div class="media-body">
							<a
								href="<?php echo U("page/page_detail");?>?father=经典病例&child=儿童口腔">儿童口腔</a>
						</div>
					</div>
				</div>
				<div class='clearfix'></div>
			</div>
		</div>
	</div>

</div>


<div class="line margin-top margin-bottom">
	<div class="x12">
		<div class="panel">
			<div class="panel-head icon-file-text">
				<strong>医院环境</strong>
			</div>
			<div class="media-inline padding-top padding-bottom text-center">
				<volist name="huanjing_list" id="vo">
				<div class="media clearfix">
					<a href="<?php echo U("huanjing/detail");?>?id={$vo.id}"> <img
						src="{$vo.image}" class="radius img-responsive" width="200px"
						alt="{$vo.desc}">
					</a>
					<div class="media-body text-center">
						<strong>{$vo.desc}</strong>
					</div>
				</div>
				</volist>

			</div>

		</div>
	</div>
</div>



<script src="__PUBLIC__/pintuer/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/index.js"></script>
<include file="Public/foot" />