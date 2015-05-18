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
					<volist name="list_d" id="vo">
					<li class="padding-big-bottom">
						<div class="media media-x">
							<a class="float-left"
								href="<?php echo U("Doctor/doctor_detail");?>?id={$vo.tbid}"> <img
								src="{$vo.image}" width="150px" class="radius" alt="{$vo.name}">
							</a>
							
							<div class="media-body padding-left padding-right padding-top">
								<div>
									<a href="<?php echo U("Doctor/doctor_detail");?>?id={$vo.id}"><strong>{$vo.name}</strong></a>
									
								</div>
								<div>{$vo.desc}</div>
							</div>
						</div>
						<a class="badge bg-blue-light margin-large-left" href="<?php echo U("index/yuyue");?>?id={$vo.tbid}">我要预约 >></a>
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