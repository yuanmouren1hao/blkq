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
       <div class='line margin-top padding-top'>
         <div class='xl12 xs8 xs2-move'>
			<div class="detail">
			   <h2 class='text-center'>{$info.title}</h2>
               <h6 class='text-center margin-top'>时间：{$info.updatetime} 作者：{$info.author}  浏览量：{$info.read_num}</h6>			   
			   <p class='margin-top'>{$info.content}</p>
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