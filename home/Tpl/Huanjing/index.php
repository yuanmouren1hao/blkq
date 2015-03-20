<include file="Public/head" />
<include file="Public/banner" />


<div class="line padding-top padding-big-bottom">
	<div class="x3 padding-big bg-gray-light border radius">

		<include file="Public/left" />

	</div>
	<div class="x9">
		<include file="Public/bread" />
		<div class="padding-large-left padding-large-right">
			<iframe border="0" id="content"
				src="<?php echo U("Huanjing/flash");?>?child=<?php echo $_REQUEST['child']?>"
				frameborder="0" height="440px" width="100%"> </iframe>
		</div>
	</div>

</div>



<include file="Public/foot" />