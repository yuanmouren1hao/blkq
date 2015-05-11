<!DOCTYPE html>
<html lang="zh-cn">
<head>
<title><?php echo mc_option('site_name');?></title>
<meta name="keywords" content="<?php echo mc_option('keyword');?>" />
<meta name="description"
	content="<?php echo mc_option('description');?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link href="__ROOT__/icon.ico" rel="shortcut icon">
<link rel="stylesheet" href="__PUBLIC__/pintuer/pintuer.css">
<link rel="stylesheet" href="__PUBLIC__/pintuer/admin/admin.css">

</head>
<body>


	<div class="panel admin-panel">
		<div class="panel-head">
			<form method="get" class="form-x" name="form1">
				<input name="tag" value="tag" type="hidden" /> <label>开始时间:</label>
				<input class='input input-auto' size="20" id='txtTm'
					onClick="WdatePicker({dateFmt:'yyyy-MM-dd'})" name='begin_time'
					data-validate="required:请填写开始时间"
					value="<?php echo $_REQUEST['begin_time'];?>" /> <label>结束时间:</label>
				<input class='input input-auto' size="20" id='txtTm'
					onClick="WdatePicker({dateFmt:'yyyy-MM-dd'})" name='end_time'
					data-validate="required:请填写结束时间"
					value="<?php echo $_REQUEST['end_time'];?>" /> <label
					for="username">姓名：</label> <input type="text"
					class="input input-auto" id="name" name="name" size="20"
					placeholder="医师姓名，支持模糊查询" value="<?php echo $_REQUEST['name'];?>" />

				<input class="button bg-main" type="submit" value="查询"
					onclick="form1.tag.value='tag'" /> <input class="button bg-yellow"
					type="submit" value="导出excel" onclick="form1.tag.value='export'" />

			</form>

		</div>


		<table class="table table-hover">
			<tr>
				<th width="60">预约号</th>
				<th width="75">预约医师</th>
				<th width="75">预约类型</th>
				<th width="130">预约时间</th>
				<th width="80">姓名</th>
				<th width="70">年龄段</th>
				<th width="50">性别</th>
				<th width="60">电话</th>
				<th width="*">描述</th>
				<th width="60">状态</th>
				<th width="80">处理助手</th>
			</tr>
			<volist name="list" id="vo">
			<tr>
				<td><strong>{$vo.id}</strong></td>
				<td>{$vo.doctor_name}</td>
				<td>{$vo.yuyue_type}</td>
				<td>{$vo.order_time}-{$vo.order_time2}</td>
				<td>{$vo.name}</td>
				<td>{$vo.age}</td>
				<td>{$vo.sex}</td>
				<td>{$vo.tel}</td>
				<td>{$vo.desc}</td>
				<td><?php if($vo['is_chuli']==1):?><span class="badge bg-green">已处理</span>
				<?php endif;?> <?php if($vo['is_chuli']==0):?><span
					class="badge bg-red">未处理</span> <?php endif;?>
				</td>
				<td>{$vo.answer_name}</td>
			</tr>
			</volist>

		</table>
		<div class="pages">
		<?php echo $page_now?>
		</div>

	</div>

	<script src="__PUBLIC__/pintuer/jquery.js"></script>
	<script src="__PUBLIC__/pintuer/pintuer.js"></script>
	<script src="__PUBLIC__/pintuer/respond.js"></script>
	<script src="__PUBLIC__/pintuer/admin/admin.js"></script>
	<script type="text/javascript"
		src="__PUBLIC__/js/My97DatePicker/WdatePicker.js"></script>
</body>
</html>
