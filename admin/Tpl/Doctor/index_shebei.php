<include file="public/head" />


<form method="post">
	<div class="panel admin-panel">
		<div class="panel-head">
			<strong>全部设备信息</strong>
		</div>
		<div class="padding border-bottom">
			<input type="button" class="button button-small checkall"
				name="checkall" checkfor="id" value="全选" /> <a
				href="<?php echo U('Doctor/add_shebei');?>" type="button"
				class="button button-small border-green">添加设备</a> <input
				type="button" class="button button-small border-yellow" value="批量删除" />
		</div>
		<table class="table table-hover">
			<tr>
				<th width="45">选择</th>
				<th width="120">图片</th>
				<th width="100">设备类别</th>
				<th width="*">描述</th>
				<th width="150">更新时间</th>
				<th width="100">操作</th>
			</tr>
			<volist name="list" id="vo">
				<tr>
					<td><input type="checkbox" name="id" value="1" /></td>
					<td><img alt="{$vo.name}" src="{$vo.image}" width="120px" /></td>
					<td>{$vo.child}</td>
					<td>{$vo.desc}</td>
					<td>{$vo.updatetime}</td>
					<td><a class="button border-blue button-little" href="<?php echo U('Doctor/edit_shebei')?>?id={$vo.id}">修改</a> <a
						class="button border-yellow button-little" href="<?php echo U('Doctor/delete_shebei')?>?id={$vo.id}"
						onclick="{if(confirm('确认删除?')){return true;}return false;}">删除</a></td>
				</tr>
			</volist>

		</table>
		<div class="pages">
			<?php echo $page_now?>
		</div>
		
	</div>
</form>

<include file='public/foot' />