<?php
return array(
	//'配置项'=>'配置值'
	'URL_CASE_INSENSITIVE'  => true,   // 默认false 表示URL区分大小写 true则表示不区分大小写
	'TMPL_TEMPLATE_SUFFIX' => '.php', //更改模板文件后缀

	'URL_MODEL'          => '1', //URL模式
	'SESSION_AUTO_START' => true, //是否开启session
	'URL_PATHINFO_DEPR'=>'-', //更改PATHINFO参数分隔符
	
	'TMPL_ACTION_ERROR' => 'Public:error',//默认错误跳转对应的模板文件
	'TMPL_ACTION_SUCCESS' => 'Public:success',//默认成功跳转对应的模板文件
		
		
	//'配置项'=>'配置值'
	'DB_TYPE'=>'mysql',
	'DB_HOST'=>'localhost',
		
	'DB_NAME'=>'yuanmourmy',
	'DB_USER'=>'yuanmourmy',
	'DB_PWD'=>'1CE8507',
		
	'DB_PROT'=>'3306',
	'DB_PREFIX'=>'blkq_',
		
	'TOKEN_ON'=>true,
	'TOKEN_NAME'=>'AOP'
		
);
?>