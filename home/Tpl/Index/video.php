<include file="Public/head" />
<include file="Public/banner" />


<div class="line padding-top padding-big-bottom">
	<div class="x3 padding-big bg-gray-light border radius">
	
		<include file="Public/left" /> 
		
	</div>
	<div class="x9">
		<include file="Public/bread" />
		<div class="padding-large">
			
		<div class="line-middle">
			<volist name="list" id="vo">
				<div class="xl12 xs6 xm4 xb3">
					<div class="media padding-bottom clearfix">
						<a href="<?php echo U("index/news_detail");?>?id={$vo.id}"><img src="{$vo.fmimg_b}" class="radius img-responsive" alt="..."></a>
			      	<div class="media-body">
			        <div class="text-center"><a href="<?php echo U("index/news_detail");?>?id={$vo.id}"><strong>{$vo.title}</strong></a></div>
			      </div>
			    </div>
			  </div>
			</volist>
			 
   		</div>
			
			
		</div>
	</div>
	
</div>



<include file="Public/foot" />