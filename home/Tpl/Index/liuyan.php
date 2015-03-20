<include file="Public/head" />
<include file="Public/banner" />


<div class="line padding-top padding-big-bottom">
	<div class="x3 padding-big bg-gray-light border radius">

		<include file="Public/left" />

	</div>
	<div class="x9">
		<include file="Public/bread" />
		<div class="padding-large">

			<div style='width: 100%;'>
				<div class="keypoint bg">
					<form STYLE='width: 500px' action="<?php echo U("index/liuyan");?>"
						method="post">
						<div class="form-group">
							<div class="label">
								<label for="readme">问题描述</label>
							</div>
							<div class="field">
								<textarea name="desc" class="input" rows="5" cols="50"
									placeholder="请在这里输入问题描述~~" data-validate="required:请填写留言信息"></textarea>
								<input name="tag" value="tag" type="hidden" />
							</div>
						</div>
						<div class="button-toolbar">
							<div class="button-group">
								<button type="button submit" class="button margin-right">
									<span class="icon-calendar-o text-blue"></span> 提交
								</button>
								<a href="<?php echo U("index/liuyan_list");?>"><button type="button" class="button">
										<span class="icon-reply text-red"></span> 查看留言
									</button></a>
							</div>
						</div>
					</form>
				</div>
			</div>


		</div>
	</div>

</div>



<include file="Public/foot" />