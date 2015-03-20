<include file="Public/head" />
<include file="Public/banner" />


<div class="line padding-top padding-big-bottom">
	<div class="x3 padding-big bg-gray-light border radius">

		<include file="Public/left" />

	</div>
	<div class="x9">
		<include file="Public/bread" />
		<div class="padding-large">
			<div class="detail">
				<h1>{$info.title}</h1>
				<p style='float: right'>
					作者：<small>{$info.author}</small>&nbsp;&nbsp;&nbsp;&nbsp;时间：<small>{$info.updatetime}</small>&nbsp;&nbsp;&nbsp;&nbsp;<small>访问量：{$info.read_num}</small>
				</p>
				<div class=clearfix></div>
				<div class="">{$info.content}</div>
			</div>
			<include file="Public/h_banner" />
		</div>
	</div>

</div>



<include file="Public/foot" />