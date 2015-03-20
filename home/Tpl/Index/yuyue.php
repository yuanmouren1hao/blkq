<include file="Public/head" />
<include file="Public/banner" />

<script type="text/javascript" src="__PUBLIC__/js/My97DatePicker/WdatePicker.js"></script>
<div class="line padding-top padding-big-bottom">
	<div class="x3 padding-big bg-gray-light border radius">

		<include file="Public/left" />

	</div>
	<div class="x9">
		<include file="Public/bread" />
		<div class="padding-large">

			<div class="x1-move line padding-bottom">
				<div class="height"><span class="text-big">使用方法</span>：只花 <span class="tag bg-red">2分钟</span> ，即可完成免费预约，我院承诺您的个人隐私将被保密。</div>
				<div class="height">提交前，请核对好个人信息是否准确填写；</div>
				<div class="height">预约成功后，将显示你的预约号，并且24小时内我院将有专人与您联系，凭预约号到院就诊。</div>
				<div class="height">预约以最后助手调整为准，请及时查看<a class="badge bg-red-light" href="{:U('index/appoint')}" target="_blank">预约信息页面</a></div>
			</div>
			<div class="x4-move line padding-bottom">
				<?php if (null != $_REQUEST['id']):?>
				<div><img src="{$info.image}"   width="128" height="128" class="radius-circle" alt="..." />
                	<span class="badge bg-green-light">预约 <strong>{$info.name}</strong> 医师</span>   
                    <span>   <a href="{:U('doctor/index')}">更换 >></a></span>
                </div>
                <?php else: ?>
                <div><img src="__PUBLIC__/img/none-doctor.png"   width="128" height="128" class="radius-circle" alt="..." />
                	<span class="badge bg-green-light">您没有选择医师，助手将为您安排。</span>   
                    <span>   <a href="{:U('doctor/index')}">选择医师 >></a></span>
                </div>
                <?php endif;?>
                
			</div>
            
            
			<form action="<?php echo U("index/yuyue");?>" method="post" class="form-x">
            	<input type="hidden" name="doctor_id" value="{$info.id}" />
                <input type="hidden" name="doctor_name" value="{$info.name}" />
                                
				<div class="form-group">
					<div class="label">
						<label for="username">姓名</label>
					</div>
					<div class="field">
						<input type="text" class="input input-auto" id="name" name="name"  data-validate="required:请填写您的姓名"
							size="20" placeholder="您的姓名~" />
					</div>
				</div>
				<div class="form-group">
					<div class="label">
						<label for="age">年龄阶段</label>
					</div>
					<div class="field">
						<select class="input input-auto" name="age">
							<option value="0-18岁">0-18岁</option>
							<option value="18-30岁">18-30岁</option>
							<option value="30-50岁">30-50岁</option>
							<option value="50岁以上">50岁以上</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="label">
						<label for="password">称呼</label>
					</div>
					<div class="field">
						<div class="button-group radio">
							<label class="button active"><input name="sex" value="先生"
								checked="checked" type="radio"><span class="icon icon-male"></span>
								先生</label> <label class="button"><input name="sex"
								value="女士" type="radio"><span class="icon icon-female"></span>
								女士</label> <label class="button"><input name="sex"
								value="小朋友" type="radio"><span class="icon icon-child"></span>
								小朋友</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="label">
						<label for="username">联系电话</label>
					</div>
					<div class="field">
						<input type="text" class="input input-auto"  id="tel" name="tel" size="20"  data-validate="required:请填写联系电话" />
					</div>
				</div>
				<div class='form-group'>
					<div class="label">
						<label for="readme">预约时间</label>
					</div>
					<div class="field">
						<input class='input input-auto' size="20" id='txtTm'
							onClick="WdatePicker({dateFmt:'yyyy-MM-dd'})" name='order_time' />
					</div>
				</div>


				<div class="form-group">
					<div class="label">
						<label for="readme">时间段</label>
					</div>
					<div class="field">
						<select name="order_time2" class="input input-auto" size="">
							<option selected>上午</option>
							<option>下午</option>
						</select>
					</div>
				</div>
                
                <div class="form-group">
					<div class="label">
						<label for="readme">预约类型</label>
					</div>
					<div class="field">
						<select name="yuyue_type" class="input input-auto" size="">
							<option value="拔牙">拔牙</option>
                            <option value="正畸">正畸</option>
                            <option value="补牙">补牙</option>
                            <option value="修复">修复</option>
                            <option value="洗牙">洗牙</option>
                            <option value="美白">美白</option>
                            <option value="种植一期">种植一期</option>
                            <option value="种植二期">种植二期</option>
                            <option value="牙周刮治">牙周刮治</option>
                            <option value="根管治疗">根管治疗</option>
                            <option value="正畸设计">正畸设计</option>
                            <option value="种植修复">种植修复</option>
                            <option selected="selected" value="其他">其他</option>
						</select>
					<p class="help-block">
					<span class="badge bg-green">如不清楚类型，请选择 "其他"，助手会帮助您安排。</span>
					</p>
					</div>
                    
				</div>

				<div class="form-group">
					<div class="label">
						<label for="readme">症状描述</label>
					</div>
					<div class="field">
						<textarea class="input" rows="5" cols="50" placeholder="症状描述" name="desc"  data-validate="required:请填写右侧的症状"></textarea>
					</div>
				</div>

				<input name="tag" value="tag" type="hidden" />
				<div class="form-button"><button class="button bg-blue" type="submit">立即预约</button></div>
			</form>




		</div>
	</div>

</div>

<include file="Public/foot" />