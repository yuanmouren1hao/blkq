<include file="Public/head" />
<include file="Public/banner" />


<div class="line padding-top padding-big-bottom">
	<div class="x3 padding-big bg-gray-light border radius">

		<include file="Public/left" />

	</div>
	<div class="x9">
		<include file="Public/bread" />
		<div class="padding-large">

			<div class="view-body">
				<ul class="list-media">
					<volist name="list" id="vo">
					<li class="padding-big-bottom">
						<div class="media media-x">
							<a class="float-left"
								href="<?php echo U("shebei/shebei_detail");?>?id={$vo.id}"> <img
								src="{$vo.image}" width="200px" class="radius" alt="{$vo.desc}">
							</a>
							<div class="media-body padding-left padding-right padding-top">
								<div><a href="<?php echo U("shebei/shebei_detail");?>?id={$vo.id}"><strong>{$vo.desc}</strong></a></div>
							</div>
						</div>
					</li>
					</volist>

				</ul>
			</div>
			<div class="pages">
				<?php echo $page_now?>
			</div>

		</div>
	</div>

</div>



<include file="Public/foot" />