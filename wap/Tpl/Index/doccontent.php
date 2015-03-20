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
       <div class='line margin-bottom margin-top'>
          <div class="xl4 xl4-move xs2 xs5-move">
             <button class="button button-block bg-yellow"><span class='icon  icon-user-md'></span>  我要预约</button>
          </div>
       </div>
       <div class="line margin-top padding-bottom">
          <div class='xl10 xl1-move xs8 xs2-move '>
			<div class="media media-y">
				  <a href="#">
				    <img src="{$info.image}" class="radius" alt="...">
				  </a>
				  <div class="media-body text-left margin-top">
				    <strong class='text-center margin-top'>{$info.name}</strong>
				                   拼图，是国内一款开源的专业响应式网页前端框架。
				  </div>
			</div>           
          </div>           
       </div>
    </div>
  </body>
  
  <script src="__PUBLIC__/pintuer/jquery.js"></script>
  <script src="__PUBLIC__/pintuer/pintuer.js"></script> 
    <script type="text/javascript">
  $(document).ready(function(){
	  $(".detail img").addClass("img-responsive");
	});
  </script>   
</html>