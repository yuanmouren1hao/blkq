<!DOCTYPE html>
<html lang="zh-cn">
<head>
<title></title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="__PUBLIC__/pintuer/pintuer.css">
<link rel="stylesheet" href="__PUBLIC__/pintuer/admin/admin.css">

</head>
<body>
<div class="line margin-big" style='overflow-x:hidden'>


<form method="post">
	<div class="panel admin-panel">
		<div class="panel-head">
			<strong>全部预约信息</strong>
		</div>
		<div class="padding border-bottom">
			<input type="button" class="button button-small checkall"
				name="checkall" checkfor="id" value="全选"  style='display:none'/>
		</div>
		<table class="table table-hover">
			<tr>
				<th width="60">预约号</th>
				<th width="80">姓名</th>
				<th width="70">年龄段</th>
				<th width="50">性别</th>
				<th width="60">电话</th>
				<th width="130">预约时间</th>
				<th width="75">预约类型</th>
				<th width="75">预约医师</th>
				<th width="*">描述</th>
				<th width="150">状态</th>
				<th width="160">操作</th>
			</tr>
			<volist name="list" id="vo">
				<tr>
					<td><strong>{$vo.id}</strong></td>
					<td>{$vo.name}</td>
					<td>{$vo.age}</td>
					<td>{$vo.sex}</td>
					<td>{$vo.tel}</td>
					<td>{$vo.order_time}<br>{$vo.order_time2}</td>
					<td>{$vo.yuyue_type}</td>
					<td>{$vo.doctor_name}</td>
					<td>{$vo.desc}</td>
					<td>
						<?php if($vo['is_chuli']==1):?><span class="badge bg-green">已处理</span><?php endif;?><?php if($vo['is_chuli']==0):?><span class="badge bg-red">未处理</span><?php endif;?>
						<?php if($vo['is_reply']==1):?><span class="badge bg-green">已回复</span><?php endif;?><?php if($vo['is_reply']==0):?><span class="badge bg-red">未回复</span><?php endif;?>
						<?php if($vo['is_weixin']==1):?><span class="badge bg-green">已通知</span><?php endif;?><?php if($vo['is_weixin']==0):?><span class="badge bg-red">未通知</span><?php endif;?>
						<?php if($vo['is_confirm']==1):?><span class="badge bg-green">已确认</span><?php endif;?><?php if($vo['is_confirm']==0):?><span class="badge bg-red">未确认</span><?php endif;?>
					</td>
					<td>
					<?php
									
					if($_GET['sid'] != $vo['answer_id'] && $vo['is_chuli'] == 1){
						echo $vo['answer_name'];
					}else{
					?>			
					<a class="button border-yellow button-little" href="<?php echo U('Message/delete_yuyue')?>?id={$vo.id}" onclick="{if(confirm('确认删除?')){return true;}return false;}">删除</a>
                    <?php if($vo['is_chuli']==0):?><a class="button border-blue button-little" href="<?php echo U('Message/chuli_yuyue')?>?id={$vo.id}&sid={$_GET['sid']}"
						onclick="{if(confirm('确认处理?')){return true;}return false;}">处理</a><?php endif;?>
					<?php if($vo['is_chuli']==1):?><a class="button bg-sub button-little" href="<?php echo U('Message/edit_yuyue')?>?id={$vo.id}&doc_id={$vo.doctor_id}&time={$vo.order_time}&sid={$_GET['sid']}">编辑</a>
						<br><a class="button border-sub button-little" href="<?php echo U('Message/hit_reply')?>?id={$vo.id}">标记回复患者</a>
						<br><a class="button border-main button-little" href="<?php echo U('Message/hit_weixin')?>?id={$vo.id}">微信通知医师</a>
					<?php endif;?>
					<?php
					}	
					?>
                    </td>
				</tr>
			</volist>

		</table>
		<div class="pages">
			<?php echo $page_now?>
		</div>
		
	</div>
</form>


</div>
    <script src="__PUBLIC__/pintuer/jquery.js"></script>
    <script src="__PUBLIC__/pintuer/pintuer.js"></script>
    <script src="__PUBLIC__/pintuer/respond.js"></script>
    <script src="__PUBLIC__/pintuer/admin/admin.js"></script>   
</body>
</html>