<include file="public/head" />


<form method="post" class="form-x" id="form1" name="form1">
	<input type="hidden" name="tag" value="tag" /> <input type="hidden"
		name="id" value="{$info.id}" />


	<div class="form-group">
		<div class="label">
			<label for="username">预约号</label>
		</div>
		<div class="field">
			<input type="text" class="input input-auto" disabled="disabled"
				value="{$info.id}" size="20" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="username">姓名</label>
		</div>
		<div class="field">
			<input type="text" class="input input-auto" name="name"
				value="{$info.name}" size="20" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="username">年龄</label>
		</div>
		<div class="field">
			<input type="text" class="input input-auto" disabled="disabled"
				value="{$info.age}" size="20" />
		</div>
	</div>
	<div class="form-group">
		<div class="label">
			<label for="username">性别</label>
		</div>
		<div class="field">
			<input type="text" class="input input-auto" disabled="disabled"
				value="{$info.sex}" size="20" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="username">电话</label>
		</div>
		<div class="field">
			<input type="text" class="input input-auto" name="tel"
				value="{$info.tel}" size="20" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="username">预约时间</label>
		</div>
		<div class="field">
			<input class='input input-auto' size="20" id='txtTm'
				onClick="WdatePicker({dateFmt:'yyyy-MM-dd'})" name='order_time'
				value="{$info.order_time}" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="username">预约时间段</label>
		</div>
		<div class="field">
			<select name="time11" id="time11">
			<?php for ($i=8;$i<=17;$i++){
				if ($time11 == $i)
				{
					echo "<option value='".$i."' selected>".$i."</option>";
				}
				else
				{
					echo "<option value='".$i."'>".$i."</option>";
				}
			}?>
			</select> ： <select name="time12" id="time12">
				<option value="0" <?php if($time12==0){echo "selected";}?> >00</option>
				<option value="1" <?php if($time12==15){echo "selected";}?> >15</option>
				<option value="2" <?php if($time12==30){echo "selected";}?> >30</option>
				<option value="3" <?php if($time12==45){echo "selected";}?> >45</option>
			</select>   &nbsp;  &nbsp;  &nbsp;到    &nbsp;  &nbsp;  &nbsp;
			<select name="time21" id="time21">
			<?php for ($i=8;$i<=17;$i++){
				if ($time21 == $i)
				{
					echo "<option value='".$i."' selected>".$i."</option>";
				}
				else
				{
					echo "<option value='".$i."'>".$i."</option>";
				}
			}?>
			</select> ： <select name="time22" id="time22">
				<option value="0" <?php if($time22==0){echo "selected";}?> >00</option>
				<option value="1" <?php if($time22==15){echo "selected";}?> >15</option>
				<option value="2" <?php if($time22==30){echo "selected";}?> >30</option>
				<option value="3" <?php if($time22==45){echo "selected";}?> >45</option>
			</select>

		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="username">ip</label>
		</div>
		<div class="field">
			<input type="text" class="input input-auto" disabled="disabled"
				value="{$info.ip}" size=20 />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="username">描述</label>
		</div>
		<div class="field">
			<input type="text" class="input" name="desc" value="{$info.desc}" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="username">医师名称</label>
		</div>
		<div class="field">
			<select class="input" name="doctor_id"
				onchange="javascript:get_catelog_info(this.value);">
				<option selected value='{$info.doctor_id}'>{$info.doctor_name}</option>
				<volist name="doctor_list" id="vo">
				<option value='{$vo.id}'>{$vo.name}</option>
				</volist>
			</select>
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="username">预约类型</label>
		</div>
		<div class="field">
			<select class="input" name="yuyue_type">
				<option selected value='{$info.yuyue_type}'>{$info.yuyue_type}</option>
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
				<option value="其他">其他</option>
			</select>
		</div>
	</div>

	<div class="form-button">
		<button class="button" type="submit" id="submit">保存</button>
	</div>
</form>
<script
	charset="utf-8" src="__PUBLIC__/kindeditor/kindeditor-min.js"></script>
<script
	charset="utf-8" src="__PUBLIC__/kindeditor/zh_CN.js"></script>
<script
	type="text/javascript"
	src="__PUBLIC__/js/My97DatePicker/WdatePicker.js"></script>
<script charset="utf-8"
	src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript">
	$('#submit').click(function(){
			time1 = ($("#time11").val()-8)*4+$("#time12").val()*1;
			time2 = ($("#time21").val()-8)*4+$("#time22").val()*1;
			if(time1>=time2)
			{
				alert("您选择的时间段有误，请检查.");
				return false;
			}
		})
</script>
<include file='public/foot' />