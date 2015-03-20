<?php
    if(C('LAYOUT_ON')) {
        echo '{__NOLAYOUT__}';
    }
?>
<?php $waitSecond=mc_option('alter_time');?>
<include file="Public/head" />
<div class="container padding-large-top margin-large-top padding-large-bottom margin-large-bottom">
	<div class="system-message well success text-center">
		<i class="glyphicon icon-times-circle-o text-large text-red"></i>
		<p class="message"><?php echo($error); ?></p>
		<p class="detail"></p>
		<p class="jump">
			页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
		</p>
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