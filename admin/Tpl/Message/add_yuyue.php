<include file="public/head" />


<form method="post" class="form-x">
<input type="hidden" name="tag" value="tag" />

    <div class="form-group">
		<div class="label">
			<label for="username">姓名</label>
		</div>
		<div class="field">
			<input type="text" class="input input-auto" name="name"  size="20"  />
		</div>
	</div>
    
    <div class="form-group">
		<div class="label">
			<label for="username">年龄</label>
		</div>
		<div class="field">
			<input type="text" class="input input-auto" name="age" size="20"  />
		</div>
	</div>
    <div class="form-group">
		<div class="label">
			<label for="username">性别</label>
		</div>
		<div class="field">
			<input type="text" class="input input-auto" name="sex" size="20"  />
		</div>
	</div>
	
	<div class="form-group">
		<div class="label">
			<label for="username">电话</label>
		</div>
		<div class="field">
			<input type="text" class="input input-auto" name="tel" size="20"  />
		</div>
	</div>
	
	<div class="form-group">
		<div class="label">
			<label for="username">预约时间</label>
		</div>
		<div class="field">
        	<input class='input input-auto' size="20" id='txtTm' onClick="WdatePicker({dateFmt:'yyyy-MM-dd'})" name='order_time'  />
		</div>
	</div>
    
	<div class="form-group">
		<div class="label">
			<label for="username">预约时间段</label>
		</div>
		<div class="field">
			<input type="text" class="input input-auto" name="order_time2"  size="10"  />
		</div>
	</div>
    
	<div class="form-group">
		<div class="label">
			<label for="username">描述</label>
		</div>
		<div class="field">
			<input type="text" class="input" name="desc" />
		</div>
	</div>
    
	<div class="form-group">
		<div class="label">
			<label for="username">医师名称</label>
		</div>
		<div class="field">
			<select class="input" name="doctor_id" onchange="javascript:get_catelog_info(this.value);">
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
		<button class="button" type="submit">保存</button>
	</div>
</form>
<script charset="utf-8" src="__PUBLIC__/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="__PUBLIC__/kindeditor/zh_CN.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/My97DatePicker/WdatePicker.js"></script>

<include file='public/foot' />