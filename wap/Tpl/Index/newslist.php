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
	           <ul class="list-text list-underline list-striped">
	           	  <volist name="news_list" id="vo">
	           	  <li><span class="date float-left">[{$vo.updatetime}]</span><a href="{:U('index/newscontent')}?id={$vo.id}">{$vo.title}</a></li>
	           	  </volist>
				</ul>
          </div>
        </div>
        <div class='line margin-top padding-top'>
	      <div class='xl7 xl3-move xs4 xs4-move'>
			<ul class="pagination pagination-group">
			  <li class="disabled"><a href="#">«</a></li>
			  <li><a href="#">1</a></li>
			  <li class="active"><a href="#">2</a></li>
			  <li><a href="#">3</a></li>
			  <li><a href="#">4</a></li>
			  <li><a href="#">»</a></li>
		    </ul>          
	      </div>          
        </div>   
        <div class='line margin-top padding-top'>
           <div class='xl3 xl2-move xs3 xl2-move'>
                <button class="button bg-dot button-big button-block">...</button>
           </div>
           <div class='xl3 xl2-move xs3 xs2-move'>
                <button class="button bg-dot button-big button-block">...</button>
           </div>
        </div>
        <div class='line margin-top padding-top'>
           <div class='xl3 xl2-move xs3 xl2-move'>
                <button class="button bg-dot button-big button-block">...</button>
           </div>
           <div class='xl3 xl2-move xs3 xs2-move'>
                <button class="button bg-dot button-big button-block">...</button>
           </div>
        </div>      
    </div>
  </body>
  
  <script src="__PUBLIC__/pintuer/jquery.js"></script>
  <script src="__PUBLIC__/pintuer/pintuer.js"></script>   
</html>