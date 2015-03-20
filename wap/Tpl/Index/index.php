<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <title>宁波北仑口腔医院</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="__PUBLIC__/pintuer/pintuer.css">
    <link rel="stylesheet" href="__PUBLIC__/css/iconfont_wap.css">
    <link href="__ROOT__/icon.ico" rel="shortcut icon">
    
  </head>
  <body>
    <div class="container">
      <div class='line margin-top'>
        <div class='xl8 xs7 xs1-move bg-white margin-big-bottom'>
            <img class="img-responsive" src='__PUBLIC__/img/logo.jpg' >
        </div>
        <div class='xl12 xs3 bg-white'>
          <div class="input-group padding-little-top">
            <input type="text" class="input" name="keywords" size="30" placeholder="关键词" />
            <span class="addbtn"><button type="button" class="button bg">搜!</button></span>
          </div>       
        </div>
      </div>
      <div class='line margin-top'>
        <div class='xl12 xs10 xs1-move'>
			<div class="banner">
			  <div class="carousel">
			    <div class="item">
			       <a href="<?php echo mc_option('f_url_1')?>"><img src='<?php echo mc_option('f_img_1')?>'/></a>
			    </div> 
			  </div>
			</div>
        </div>
      </div>
      <div class='line margin-top margin-bottom'>
        <div class='xl12 xs5 xs1-move '>
           <div class='xl3 xs3'>
	          <div class="media">
				  <a href="<?php echo U("index/content");?>?father=种植牙&child=种植流程">	
				    <div class="txt txt-big radius bg-white border border-blue">
                       <i class="icon iconfont">&#xe604;</i>
                    </div>	  		    			          	
				  </a>
				  <div class="media-body">&nbsp;&nbsp;&nbsp;种植牙</div>
			  </div>
           </div>
           <div class='xl3 xs3'>
	          <div class="media">
				  <a href="<?php echo U("index/content");?>?father=牙齿矫正&child=隐形矫正">
				    <div class="txt txt-big radius bg-white border border-blue">
                       <i class="icon iconfont">&#xe600;</i>
                    </div>	
				  </a>
				  <div class="media-body">&nbsp;牙齿矫正</div>
			  </div>
           </div>
           <div class='xl3 xs3'>
	          <div class="media">
				  <a href="<?php echo U("index/content");?>?father=牙齿修复&child=全瓷牙">
				    <div class="txt txt-big radius bg-white border border-blue">
                       <i class="icon iconfont">&#xe603;</i>
                    </div>	
				  </a>
				  <div class="media-body">&nbsp;牙齿修复</div>
			  </div>
           </div>
           <div class='xl3 xs3'>
	          <div class="media">
				  <a href="<?php echo U("index/content");?>?father=牙齿美白&child=冷光美白">
				    <div class="txt txt-big radius bg-white border border-blue">
                       <i class="icon iconfont">&#xe602;</i>
                    </div>
				  </a>
				  <div class="media-body">&nbsp;牙齿美白</div>
			  </div>
           </div>           
        </div>
        <div class='xl12 xs5'>
           <div class='xl3 xs3'>
	          <div class="media">
				  <a href="<?php echo U("index/content");?>?father=牙周专科&child=牙周炎危害">
				     <div class="txt txt-big radius bg-white border border-blue">
                       <i class="icon iconfont">&#xe604;</i>
                    </div>
				  </a>
				  <div class="media-body">&nbsp;牙周专科</div>
			  </div>
           </div>
           <div class='xl3 xs3'>
	          <div class="media">
				  <a href="<?php echo U("index/content");?>?father=常规治疗&child=微创拔牙">
				    <div class="txt txt-big radius bg-white border border-blue">
                       <i class="icon iconfont">&#xe606;</i>
                    </div>
				  </a>
				  <div class="media-body">&nbsp;常规治疗</div>
			  </div>
           </div>
           <div class='xl3 xs3'>
	          <div class="media">
				  <a href="<?php echo U("index/content");?>?father=儿童齿科&child=窝沟封闭">
				     <div class="txt txt-big radius bg-white border border-blue">
                       <i class="icon iconfont">&#xe601;</i>
                    </div>
				  </a>
				  <div class="media-body">&nbsp;儿童齿科</div>
			  </div>
           </div>
           <div class='xl3 xs3'>
	          <div class="media">
				  <a href="<?php echo U("index/content");?>?father=口腔保健&child=儿童护理">
				    <div class="txt txt-big radius bg-white border border-blue">
                       <i class="icon iconfont">&#xe609;</i>
                    </div>
				  </a>
				  <div class="media-body">&nbsp;口腔保健</div>
			  </div>
           </div>           
        </div>
      </div>
      <div class='line margin-top'>
         <div class='xl12  xs10 xs1-move'>
	         <div class="panel">
				  <div class="panel-head border border-main bg-sub"><span class='icon icon-user-md'></span> 医师团队<span class='float-right'><a href="{:U('index/doclist')}">更多»</a></span></div>
				  <div class="panel-body">
                      <div class="line-middle">
                      
                      	  <volist name="list_d" id="vo">
						  <div class="xl5 xl1-move xs2">
						    <div class="media clearfix ">
						      <a href="{:U('index/doccontent')}?id={$vo.id}"><img src="{$vo.image}" width='80' height='80' class="radius img-responsive" alt="..."></a>
						      <div class="media-body">
						        <strong><span class="padding-left">{$vo.name}</span></strong>
						      </div>
						    </div>
						  </div>
						  </volist>
						  
					  </div>			    				    			      
				  </div>
			</div>
         </div>
      </div>
      
      <div class='line margin-top'>
         <div class='xl12  xs10 xs1-move'>
	         <div class="panel">
				  <div class="panel-head border border-main bg-sub"><span class='icon-file-text icon'></span> 医院动态<span class='float-right'><a href="{:U('index/newslist')}">更多»</a></span></div>
				  <div class="panel-body">
					<ul class="list-group">
						<volist name="news_list" id="vo">
							<li><span class="date">[<?php echo date('Y-m-d',strtotime($vo['updatetime']))?>]</span>
							<a href="{:U('index/newscontent')}?id={$vo.id}">{$vo.title}</a></li>
						</volist>
					</ul>				      
				  </div>
			</div>
         </div>
      </div>
        <div class='line margin-top padding-top'>
           <div class='xl3 xl2-move xs3 xl2-move'>
                <a class="button bg-dot button-big button-block" href="{:U('index/appoint')}">在线预约</a>
           </div>
           <div class='xl3 xl2-move xs3 xs2-move'>
                <a class="button bg-dot button-big button-block" href="{:U('index/liucheng')}">就诊流程</a>
           </div>
        </div>
        <div class='line margin-top padding-top margin-bottom margin-bottom'>
           <div class='xl3 xl2-move xs3 xl2-move'>
                <a class="button bg-dot button-big button-block">患者留言</a>
           </div>
           <div class='xl3 xl2-move xs3 xs2-move'>
                <a class="button bg-dot button-big button-block" href="{:U('index/map')}">来院地图</a>
           </div>
        </div>        
    </div>
  </body>
  
  <script src="__PUBLIC__/pintuer/jquery.js"></script>
  <script src="__PUBLIC__/pintuer/pintuer.js"></script>   
</html>