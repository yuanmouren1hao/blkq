<include file="public/head" />


<form method="post">
	<div class="panel admin-panel">
		<div class="panel-head">
			<strong>全部预约信息</strong>
		</div>
		<div class="padding border-bottom">
			<input type="button" class="button button-small checkall"
				name="checkall" checkfor="id" value="全选" />
				 <a type="button" class="button button-small border-yellow" href="{:U('Message/add_yuyue')}">添加预约</a>
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
				<th width="60">已处理</th>
				<th width="160">操作</th>
			</tr>
			<volist name="list" id="vo">
				<tr>
					<td><strong>{$vo.id}</strong></td>
					<td>{$vo.name}</td>
					<td>{$vo.age}</td>
					<td>{$vo.sex}</td>
					<td>{$vo.tel}</td>
					<td>{$vo.order_time}-{$vo.order_time2}</td>
					<td>{$vo.yuyue_type}</td>
					<td>{$vo.doctor_name}</td>
					<td>{$vo.desc}</td>
					<td><?php if($vo['is_chuli']==1):?><span class="badge bg-green">Yes</span><?php endif;?><?php if($vo['is_chuli']==0):?><span class="badge bg-red">No</span><?php endif;?></td>
					<td>
					<a class="button border-yellow button-little" href="<?php echo U('Message/delete_yuyue')?>?id={$vo.id}"
						onclick="{if(confirm('确认删除?')){return true;}return false;}">删除</a>
                    <?php if($vo['is_chuli']==0):?><a class="button border-blue button-little" href="<?php echo U('Message/chuli_yuyue')?>?id={$vo.id}"
						onclick="{if(confirm('确认处理?')){return true;}return false;}">处理</a><?php endif;?>
					<?php if($vo['is_chuli']==1):?><a class="button bg-sub button-little" href="<?php echo U('Message/edit_yuyue')?>?id={$vo.id}">编辑</a><a class="button bg-main button-little margin-small-left" href="<?php echo U('Message/hit_weixin')?>?id={$vo.id}">微信通知</a><?php endif;?>
                    </td>
				</tr>
			</volist>

		</table>
		<div class="pages">
			<?php echo $page_now?>
		</div>
		
	</div>
</form>


<include file='public/foot' />