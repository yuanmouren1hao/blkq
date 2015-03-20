<include file="public/head" />


<form method="post">
	<div class="panel admin-panel">
		<div class="panel-head">
			<strong>内容列表</strong>
		</div>
		<div class="padding border-bottom">
			<input type="button" class="button button-small checkall"
				name="checkall" checkfor="id" value="全选" /> <a
				href="<?php echo U('Content/add');?>" type="button"
				class="button button-small border-green">添加文章</a> <input
				type="button" class="button button-small border-yellow" value="批量删除" />
			<input type="button" class="button button-small border-blue"
				value="回收站" />
		</div>
		<table class="table table-hover">
			<tr>
				<th width="45">选择</th>
				<th width="120">一级分类</th>
				<th width="120">二级分类</th>
				<th width="*">标题</th>
				<th width="150">时间</th>
				<th width="120">操作</th>
			</tr>
			<volist name="list" id="vo">
				<tr>
					<td><input type="checkbox" name="id" value="1" /></td>
					<td><strong>{$vo.father}</strong></td>
					<td><small>{$vo.child}</small></td>
					<td><a href="#">{$vo.title}</a></td>
					<td>{$vo.updatetime}</td>
					<td><a class="button border-blue button-little" href="<?php echo U('Content/reget');?>?id={$vo.id}">恢复</a> <a
						class="button border-yellow button-little" href="<?php echo U('Content/remove')?>?id={$vo.id}"
						onclick="{if(confirm('确认删除?')){return true;}return false;}">彻底删除</a></td>
				</tr>
			</volist>

		</table>
		<div class="pages">
			<?php echo $page_now?>
		</div>
		
	</div>
</form>

<include file='public/foot' />