<include file="Public/head" />
<include file="Public/banner" />


<div class="line padding-top padding-big-bottom">
	<div class="x3 padding-big bg-gray-light border radius">

		<include file="Public/left" />

	</div>
	<div class="x9">
		<include file="Public/bread" />
		<div class="padding-large">

			<div class="line padding-bottom">
				<div class="float-right">
					<div class="button-toolbar">
						<div class="button-group">
							<a href="<?php echo U("index/liuyan");?>"><button type="button"
									class="button">
									<span class="icon-calendar-o text-blue"></span> 提问
								</button></a>
						</div>
					</div>
				</div>
				<div class="float-right margin-right">
					<div class="button-toolbar">
						<div class="button-group">
							<a href="<?php echo U("index/yuyue");?>"><button type="button"
									class="button">
									<span class="icon-calendar-o text-red"></span> 在线预约
								</button></a>
						</div>
					</div>
				</div>
				
				
				<div class="float-left x4">
					<form  action="{:U('index/search_liuyan')}" method="get">
						<div class="input-group padding-little-top">
							<input type="text" class="input border-blue" name="keyword"
								size="30" placeholder="问题关键词" /> <span class="addbtn"><button
									type="submit" class="button bg-blue">搜!</button></span>
						</div>
					</form>
				</div>
				<div class="clearfix"></div>
			</div>


			<div class="line">
				<div class="collapse">
					<volist name="list" id="vo">
					<div class="panel">
						<div class="panel-head icon-hand-o-right">
							<strong>{$vo.ask_message}</strong><span class='float-right'>{$vo.ask_time}</span>
						</div>
						<div class="panel-body text-red">
							<div class='icon-quote-left'> 回答：<small>{$vo.reply_message}</small></div>
						</div>
					</div>
					</volist>
				</div>

			</div>
			
			<div class="pages">
				<?php echo $page_now?>
			</div>



		</div>
	</div>

</div>



<include file="Public/foot" />