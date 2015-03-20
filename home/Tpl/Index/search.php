<include file="Public/head" />
<include file="Public/banner" />


<div class="line padding-top padding-big-bottom">
	<div class="x3 padding-big bg-gray-light border radius">
	
		<include file="Public/left" /> 
		
	</div>
	<div class="x9">
		<include file="Public/bread" />
		<div class="padding-large">
			
		
		<p><h1><span class="tag bg-yellow">以下是按照关键词全站搜索的结果</span></h1></p>
			<ul class="list-text list-underline list-striped">
				<volist name="list" id="vo">
				  <li><span class="date">{$vo.updatetime}</span><a href="<?php echo U("index/news_detail");?>?id={$vo.id}">{$vo.title}</a></li>
			  	</volist>
			</ul>
			
			
			<div class="pages">
				<?php echo $page_now?>
			</div>
			
		
		</div>
	</div>
	<div class="clearfix"></div>
</div>



<include file="Public/foot" />