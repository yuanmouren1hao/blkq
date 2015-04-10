


<include file="Public/head" />
<include file="Public/banner" />


<div class="line padding-top padding-big-bottom">
	<div class="x3 padding-big bg-gray-light border radius">
	
		<include file="Public/left" /> 
		
	</div>
	<div class="x9">
		<include file="Public/bread" />
		<div class="padding-large-left padding-large-right">
		
				<div class="container">
					<div class="system-message well success text-center">
						<h1>
							<i class="glyphicon glyphicon-ok-circle"></i>
						</h1>
						<p class="message"><?php echo($message); ?></p>
						<p class="detail"></p>
						<p class="jump">
							页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
						</p>
					</div>
				</div>	
		
		
		</div>
	</div>
	
</div>

<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>

<include file="Public/foot" />