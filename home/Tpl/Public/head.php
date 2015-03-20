<!DOCTYPE html>
<html lang="zh-cn">
<head>
<title><?php echo mc_option('site_name');?></title>
<meta name="keywords" content="<?php echo mc_option('keyword');?>" />
<meta name="description"
	content="<?php echo mc_option('description');?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link href="__ROOT__/icon.ico" rel="shortcut icon">


<link rel="stylesheet" href="__PUBLIC__/css/iconfont.css" type="text/css"></link>
<link rel="stylesheet" href="__PUBLIC__/css/index.css" type="text/css"></link>
<link rel="stylesheet" href="__PUBLIC__/pintuer/pintuer.css">

</head>
<body>

	<div class="container padding-left-big padding-right-big magrin-left-big magrin-right-big">


		<div class="line">
			<div class="bg-blue xb12">

				<div class="top">
					<div class="top1">
						<div class='logo'>
							<img src='__PUBLIC__/img/logo.jpg'>
						</div>
						<div class="slogan">
							市医保定点单位<br> 非营利医院机构<br> 北仑区窝沟封闭定点医院<br>
						</div>
						<div class='tel float-right'>
							<div style='height: 34px; width: 100%'>
								<div style="height: 34px; width: 43px; float: left"></div>
								<!--  <font style='margin-left:10px' class='font'>微博</font> -->
								<div
									style="height: 34px; width: 43px; float: left; margin-left: 10px">

								</div>
								<!--  <font class='font'>微信</font> -->

							</div>
							<img src="__PUBLIC__/img/tel.jpg"
								style='height: 34px; width: 100%'>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>

				<div class="navbar clearfix navbar-big padding-botom bg-inverse">

					<div class="navbar-body nav-navicon navbar-big" id="navbar-demo2">
						<ul class="nav nav-inline nav-menu nav-big">
							<li <?php if (MODULE_NAME=='Index' and ACTION_NAME=='index'): ?>
								class="active" <?php endif;?>><a
								href='<?php echo U('index/index');?>'>首页</a></li>
							<li
								<?php if (MODULE_NAME=='Index' and ACTION_NAME=='jianjie'): ?>
								class="active" <?php endif;?>><a
								href='<?php echo U('index/jianjie');?>'>医院简介</a></li>
							<li <?php if (MODULE_NAME=='Doctor'): ?> class="active"
								<?php endif;?>><a href="<?php echo U("Doctor/index");?>">医师团队<span
									class="arrow"></span></a>
								<ul class="drop-menu">
									<li><a href="<?php echo U("Doctor/zhengji");?>">正畸专家</a></li>
									<li><a href="<?php echo U("Doctor/zhongzhi");?>">种植医师</a></li>
									<li><a href="<?php echo U("Doctor/xiufu");?>">修复医师</a></li>
									<li><a href="<?php echo U("Doctor/yazhou");?>">牙周医师</a></li>
									<li><a href="<?php echo U("Doctor/zonghe");?>">综合团队</a></li>
								</ul></li>
							<li <?php if (MODULE_NAME=='Shebei'): ?> class="active"
								<?php endif;?>><a href="javacsripf:;">领先设备<span
									class="arrow"></span></a>
								<ul class="drop-menu">
									<?php $list_shebei=selectList('catelog','father="领先设备"','','');?>
									<?php foreach ($list_shebei as $val):?>
										<li><a href="<?php echo U("Shebei/index");?>?child=<?php echo $val['child']?>"><?php echo $val['child']?></a></li>
									<?php endforeach;?>
								</ul></li>
								
							<li <?php if (MODULE_NAME=='Huanjing'): ?> class="active"
								<?php endif;?>><a  href="javacsripf:;">优雅环境<span
									class="arrow"></span></a>
								<ul class="drop-menu">
									<?php $list_huanjing=selectList('catelog','father="优雅环境"','create_time asc','');?>
									<?php foreach ($list_huanjing as $val):?>
										<li><a href="<?php echo U("Huanjing/index");?>?child=<?php echo $val['child']?>"><?php echo $val['child']?></a></li>
									<?php endforeach;?>
								</ul></li>

							<li <?php if (MODULE_NAME=='Index' and ACTION_NAME=="news"): ?>
								class="active" <?php endif;?>><a
								href='<?php echo U('Index/news');?>'>新闻动态</a></li>
							<li <?php if (MODULE_NAME=='Index' and ACTION_NAME=='map'): ?>
								class="active" <?php endif;?>><a
								href='<?php echo U('index/map');?>'>来院地图</a></li>
							<li <?php if (MODULE_NAME=='Index' and ACTION_NAME=='zixun'): ?>
								class="active" <?php endif;?>><a target="_blank"
								href='http://dx.zoosnet.net/lrserver/LR/Chatpre.aspx?id=LZS32497012'>在线咨询</a></li>
						</ul>

						<form class="x2 float-right margin-right padding-top" style="padding-top: 6px" action="{:U('index/search')}" method="get">
							<div class="input-group padding-little-top">
								<input type="text" class="input " name="keyword" size="20" placeholder="关键词" />
								<span class="addbtn">
									<button type="submit" class="button bg-yellow-light">搜!</button>
								</span>
							</div>
						</form>
						<div class="clearfix"></div>

					</div>
				</div>



			</div>
		</div>