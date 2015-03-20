<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="__PUBLIC__/pintuer/pintuer.css">
    <link rel="stylesheet" href="__PUBLIC__/css/iconfont.css">
    <link href="__ROOT__/icon.ico" rel="shortcut icon">
    
  </head>
  <body>
    <div class="container">
      <div class='line margin-top padding-top margin-bottom'>
        <div class='xl12  xs6 xs3-move'>
           <ul class="list-inline" style='padding-left:0px'>
			  <li><a class='text-sub' href="{:U('index/doclist')}">正畸专家</a></li>| 
			  <li><a class='text-main' href="{:U('index/doclist')}">种植医师</a></li>| 
			  <li><a class='text-main' href="{:U('index/doclist')}">修复医师</a></li>| 
			  <li><a class='text-main' href="{:U('index/doclist')}">牙周医师</a></li>| 
			  <li><a class='text-main' href="{:U('index/doclist')}">综合团队</a></li> 
		   </ul>
        </div>     
      </div>
      <div class='line-middle margin-top padding-top'>
         <div class='xl12 xs8 xs2-move'>
         
         <volist name="list" id="vo">
		    <div class="media clearfix">
		      <a class='float-left' href="{:U('index/doccontent')}?id={$vo.id}"><img width='90' height='90' src="{$vo.image}" class="radius img-responsive" ></a>
		      <div class="media-body padding-left" >
		        <strong>{$vo.name}</strong>
		        <p>{$vo.desc}</p>
		      </div>
		    </div>
	        <hr class="bg-space padding-small-top" />   
	      </volist>
	      
	      
         </div>
       </div>
        <div class='line margin-top padding-top'>
           <div class='xl3 xl2-move xs3 xl2-move'>
                <button class="button bg-dot button-big button-block">在线预约</button>
           </div>
           <div class='xl3 xl2-move xs3 xs2-move'>
                <button class="button bg-dot button-big button-block">就诊流程</button>
           </div>
        </div>
        <div class='line margin-top padding-top margin-bottom margin-bottom'>
           <div class='xl3 xl2-move xs3 xl2-move'>
                <button class="button bg-dot button-big button-block">患者留言</button>
           </div>
           <div class='xl3 xl2-move xs3 xs2-move'>
                <button class="button bg-dot button-big button-block">来源地图</button>
           </div>
        </div>        
    </div>
  </body>
  
  <script src="__PUBLIC__/pintuer/jquery.js"></script>
  <script src="__PUBLIC__/pintuer/pintuer.js"></script>   
</html>