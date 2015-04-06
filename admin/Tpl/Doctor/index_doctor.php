<include file="public/head" />


<form method="post">
	<div class="panel admin-panel">
		<div class="panel-head">
			<strong>全部医师信息</strong>
		</div>
		<div class="padding border-bottom">
			<input type="button" class="button button-small checkall"
				name="checkall" checkfor="id" value="全选" /> <a
				href="<?php echo U('Doctor/add_doctor');?>" type="button"
				class="button button-small border-green">添加医师</a> <input
				type="button" class="button button-small border-yellow" value="批量删除" />
		</div>
		<table class="table table-hover">
			<tr>
				<th width="45">选择</th>
				<th width="45">排序</th>
				<th width="120">头像</th>
				<th width="80">姓名</th>
				<th width="80">医师类别</th>
				<th width="45">性别</th>
				<th width="60">职称</th>
				<th width="100">电话</th>
				<th width="100">邮箱</th>
				<th width="*">微信</th>
				<th width="150">更新时间</th>
				<th width="100">操作</th>
			</tr>
			<volist name="list" id="vo">
				<tr>
					<td><input type="checkbox" name="id" value="1" /></td>
					<td>{$vo.age}</td>
					<td><img alt="{$vo.name}" src="{$vo.image}" width="100px" /></td>
					<td><strong><a target="_blank" href="__ROOT__/index.php/doctor-doctor_detail.html?id={$vo.id}">{$vo.name}</a></strong></td>
					<td>{$vo.child}</td>
					<td>{$vo.sex}</td>
					<td>{$vo.title}</td>
					<td>{$vo.tel}</td>
					<td>{$vo.mail}</td>
					<td>{$vo.weixin_id}</td>
					<td>{$vo.updatetime}</td>
					<td>
						<a class="button border-blue button-little" href="<?php echo U('Doctor/edit_doctor')?>?id={$vo.id}">修改</a>
						<a class="button border-yellow button-little" href="<?php echo U('Doctor/delete_doctor')?>?id={$vo.id}"	onclick="{if(confirm('确认删除?')){return true;}return false;}">删除</a>
						<a class="button bg-sub button-little" href="<?php echo U('doctor/init_secret')?>?id={$vo.id}">设置初始密码</a>
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