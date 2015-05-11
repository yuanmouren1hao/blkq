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
<link rel="stylesheet" href="__PUBLIC__/pintuer/pintuer.css">
<link rel="stylesheet" href="__PUBLIC__/pintuer/admin/admin.css">

</head>
<body>

	<div class="lefter">
		<div class="logo">
			<a href="<?php echo mc_option('site_url')?>" target="_blank"><img
				class="img-responsive" src="__PUBLIC__/img/logo.jpg" alt="后台管理系统" /></a>
		</div>
	</div>
	<div class="righter nav-navicon" id="admin-nav">
		<div class="mainer">
			<div class="admin-navbar">
				<span class="float-right"> <a class="button button-little bg-main"
					href="<?php echo mc_option('site_url')?>" target="_blank">前台首页</a>
					<a class="button button-little bg-yellow"
					href="<?php echo U("Index/logout");?>">注销登录</a>
				</span>
				<ul class="nav nav-inline admin-nav">
					<li <?php if (MODULE_NAME=='Index'): ?> class="active"
						<?php endif;?>><a href="<?php echo U('Index/index')?>"
						class="icon-home"> 开始</a>
						<ul>
							<li class="active"><a href="system.html">开始</a></li>
							<li><a href="<?php echo U('System/index')?>">系统设置</a></li>
							<li><a href="<?php echo U('catelog/index')?>">栏目管理</a></li>
							<li><a href="<?php echo U('Content/index')?>">内容管理</a></li>
							<li><a href="<?php echo U('Doctor/index_huanjing')?>">环境/设备/视频</a></li>
							<li><a href="<?php echo U('Message/index_liuyan')?>">留言</a></li>
							<li><a href="<?php echo U('Tongji/index')?>">统计管理</a></li>
						</ul></li>
					<li <?php if (MODULE_NAME=='System'): ?> class="active"
						<?php endif;?>><a href="<?php echo U('System/all')?>"
						class="icon-cog"> 系统</a>
						<ul>
							<li <?php if (MODULE_NAME=='System' and ACTION_NAME=='all'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U("system/all");?>">系统设置</a></li>
							<li <?php if (MODULE_NAME=='System' and ACTION_NAME=='seo'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U("system/seo");?>">SEO设置</a></li>
							<li
								<?php if (MODULE_NAME=='System' and ACTION_NAME=='shejiao'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U("system/shejiao");?>">社交信息设置</a></li>
							<li <?php if (MODULE_NAME=='System' and ACTION_NAME=='user'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U("system/user");?>">管理员管理</a></li>
							<li
								<?php if (MODULE_NAME=='System' and ACTION_NAME=='setmail'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U("system/setmail");?>">邮箱设置</a></li>
							<li><a href="#">foot设置</a></li>
							<li
								<?php if (MODULE_NAME=='System' and ACTION_NAME=='jianjie'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U("system/jianjie");?>">医院简介</a></li>
							<li <?php if (MODULE_NAME=='System' and ACTION_NAME=='map'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U("system/map");?>">来院地图</a></li>
							<li
								<?php if (MODULE_NAME=='System' and ACTION_NAME=='liucheng'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U("system/liucheng");?>">就诊流程图管理</a></li>
							<li
								<?php if (MODULE_NAME=='System' and ACTION_NAME=='f_set'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U("system/f_set");?>">首页幻灯片管理</a></li>
							<li
								<?php if (MODULE_NAME=='System' and ACTION_NAME=='js_set'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U("system/js_set");?>">统计代码设置</a></li>
						</ul></li>
					<li <?php if (MODULE_NAME=='Catelog'): ?> class="active"
						<?php endif;?>><a href="<?php echo U('catelog/index')?>"
						class="icon-th-list"> 栏目</a>
						<ul>
							<li <?php if (MODULE_NAME=='Catelog' and ACTION_NAME=='add'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U('Catelog/add');?>">添加分类</a></li>
							<li
								<?php if (MODULE_NAME=='Catelog' and ACTION_NAME=='index'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U('Catelog/index');?>">分类列表</a></li>
							<li <?php if (MODULE_NAME=='Catelog' and ACTION_NAME=='edit'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U('Catelog/edit');?>">编辑分类</a></li>
						</ul></li>
					<li <?php if (MODULE_NAME=='Content'): ?> class="active"
						<?php endif;?>><a href="<?php echo U('Content/index')?>"
						class="icon-file-text"> 内容</a>
						<ul>
							<li <?php if (MODULE_NAME=='Content' and ACTION_NAME=='add'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U('Content/add')?>">添加内容</a></li>
							<li
								<?php if (MODULE_NAME=='Content' and ACTION_NAME=='index'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U('Content/index')?>">内容管理</a></li>
							<li
								<?php if (MODULE_NAME=='Content' and ACTION_NAME=='rublish'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U('Content/rublish')?>">回收站</a></li>
						</ul></li>
					<li <?php if (MODULE_NAME=='Doctor'): ?> class="active"
						<?php endif;?>><a href="<?php echo U('Doctor/index_huanjing')?>"
						class="icon-user">环境/设备/视频</a>
						<ul>
							<li
								<?php if (MODULE_NAME=='Doctor' and ACTION_NAME=='add_huanjing'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U('Doctor/add_huanjing')?>">添加环境</a></li>
							<li
								<?php if (MODULE_NAME=='Doctor' and ACTION_NAME=='index_huanjing'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U('Doctor/index_huanjing')?>">所有环境</a></li>
							<hr>
							<li
								<?php if (MODULE_NAME=='Doctor' and ACTION_NAME=='add_shebei'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U('Doctor/add_shebei')?>">添加设备</a></li>
							<li
								<?php if (MODULE_NAME=='Doctor' and ACTION_NAME=='index_shebei'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U('Doctor/index_shebei')?>">所有设备</a></li>
							<hr>
							<li
								<?php if (MODULE_NAME=='Doctor' and ACTION_NAME=='add_video'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U('Doctor/add_video')?>">添加视频</a></li>
							<li
								<?php if (MODULE_NAME=='Doctor' and ACTION_NAME=='index_video'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U('Doctor/index_video')?>">所有视频</a></li>
						</ul></li>
					<li <?php if (MODULE_NAME=='Message'): ?> class="active"
						<?php endif;?>><a href="<?php echo U('Message/index_liuyan')?>"
						class="icon-comments"> 留言</a>
						<ul>
							<li
								<?php if (MODULE_NAME=='Message' and ACTION_NAME=='index_liuyan'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U('Message/index_liuyan')?>">留言列表</a></li>
						</ul></li>
					<li <?php if (MODULE_NAME=='Tongji'): ?> class="active"
						<?php endif;?>><a href="<?php echo U('Tongji/page')?>"
						class="icon-quote-left"> 统计</a>
						<ul>
							<li <?php if (MODULE_NAME=='Tongji' and ACTION_NAME=='page'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U('Tongji/page')?>">页面统计</a></li>
							<li <?php if (MODULE_NAME=='Tongji' and ACTION_NAME=='pv'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U('Tongji/pv')?>">PV统计</a></li>
							<li <?php if (MODULE_NAME=='Tongji' and ACTION_NAME=='uv'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U('Tongji/uv')?>">UV统计</a></li>
							<li <?php if (MODULE_NAME=='Tongji' and ACTION_NAME=='del_hsitory'): ?>
								class="active" <?php endif;?>><a
								href="<?php echo U('Tongji/del_hsitory')?>">删除历史来访数据</a></li>
						</ul></li>

				</ul>
			</div>
			<div class="admin-bread">
				<span>您好，<?php echo session('user.user_name')?>，欢迎您的光临。</span>
				<ul class="bread">
					<li><a href="<?php echo U("index/index");?>" class="icon-home"> 开始</a></li>
					<li <?php if(MODULE_NAME=="Index"):?>>后台首页</li>
					<?php elseif(MODULE_NAME=="System"):?><li><a href="<?php echo U("System/all");?>">系统管理</a></li>
						<?php if(ACTION_NAME=="seo"):?><li>seo设置</li><?php endif;?>
						<?php if(ACTION_NAME=="user"):?><li>用户管理</li><?php endif;?>
						<?php if(ACTION_NAME=="shejiao"):?><li>社交账号管理</li><?php endif;?>
						<?php if(ACTION_NAME=="liucheng"):?><li>流程图管理</li><?php endif;?>
						<?php if(ACTION_NAME=="zixun"):?><li>在线咨询管理</li><?php endif;?>
						<?php if(ACTION_NAME=="map"):?><li>来院地图设置</li><?php endif;?>
						<?php if(ACTION_NAME=="jianjie"):?><li>医院简介设置</li><?php endif;?>
						<?php if(ACTION_NAME=="setmail"):?><li>邮箱设置</li><?php endif;?>
						<?php if(ACTION_NAME=="f_set"):?><li>首页幻灯片管理</li><?php endif;?>
						
					<?php elseif(MODULE_NAME=="Catelog"):?><li><a href="<?php echo U("Catelog/index");?>">栏目管理</a></li>
						<?php if(ACTION_NAME=="edit"):?><li>编辑分类</li><?php endif;?>
						<?php if(ACTION_NAME=="add"):?><li>添加分类</li><?php endif;?>
					
					<?php elseif(MODULE_NAME=="Content"):?><li><a href="<?php echo U("Content/index");?>">内容管理</a></li>
						<?php if(ACTION_NAME=="index"):?><li>内容列表</li><?php endif;?>
						<?php if(ACTION_NAME=="add"):?><li>添加内容</li><?php endif;?>
						<?php if(ACTION_NAME=="edit"):?><li>编辑内容</li><?php endif;?>
						<?php if(ACTION_NAME=="rublish"):?><li>回收站</li><?php endif;?>
						
					<?php elseif(MODULE_NAME=="Doctor"):?><li><a href="<?php echo U("Doctor/index_doctor");?>">医师/环境/设备/视频</a></li>
						<?php if(ACTION_NAME=="index_doctor"):?><li>医师列表</li><?php endif;?>
						<?php if(ACTION_NAME=="add_doctor"):?><li>添加医师</li><?php endif;?>
						<?php if(ACTION_NAME=="edit_doctor"):?><li>编辑医师详情</li><?php endif;?>
						<?php if(ACTION_NAME=="index_huanjing"):?><li>环境列表</li><?php endif;?>
						<?php if(ACTION_NAME=="edit_huanjing"):?><li>编辑环境</li><?php endif;?>
						<?php if(ACTION_NAME=="add_huanjing"):?><li>添加环境</li><?php endif;?>
						<?php if(ACTION_NAME=="index_shebei"):?><li>设备列表</li><?php endif;?>
						<?php if(ACTION_NAME=="add_shebei"):?><li>添加设备</li><?php endif;?>
						<?php if(ACTION_NAME=="index_video"):?><li>口腔视频列表</li><?php endif;?>
						<?php if(ACTION_NAME=="add_video"):?><li>添加视频</li><?php endif;?>
					
					<?php elseif(MODULE_NAME=="Message"):?><li><a href="<?php echo U("Message/index_liuyan");?>">留言/预约</a></li>
						<?php if(ACTION_NAME=="index_liuyan"):?><li>留言列表</li><?php endif;?>
						<?php if(ACTION_NAME=="index_yuyue"):?><li>预约列表</li><?php endif;?>
					
					<?php elseif(MODULE_NAME=="Tongji"):?><li><a href="<?php echo U("Tongji/page");?>">统计</a></li>
						<?php if(ACTION_NAME=="page"):?><li>页面统计</li><?php endif;?>
						<?php if(ACTION_NAME=="pv"):?><li>pv统计</li><?php endif;?>
						<?php if(ACTION_NAME=="uv"):?><li>uv统计</li><?php endif;?>
					
					<?php endif;?>
				</ul>
			</div>
		</div>
	</div>

	<div class="admin">