<include file="public/head" />


<form method="post">
	<div class="panel admin-panel">
		<div class="panel-head">
			<strong>全部视频内容</strong>
		</div>
		<div class="padding border-bottom">
			<input type="button" class="button button-small checkall"
				name="checkall" checkfor="id" value="全选" /> <a
				href="<?php echo U('Doctor/add_video');?>" type="button"
				class="button button-small border-green">添加视频</a> <input
				type="button" class="button button-small border-yellow" value="批量删除" />
				<a
				href="<?php echo U('Content/rublish');?>" type="button"
				class="button button-small border-blue">回收站</a> 
		</div>
		<table class="table table-hover">
			<tr>
				<th width="45">选择</th>
				<th width="120">图像</th>
				<th width="*">标题</th>
				<th width="60">阅读量</th>
				<th width="150">时间</th>
				<th width="100">操作</th>
			</tr>
			<volist name="list" id="vo">
				<tr>
					<td><input type="checkbox" name="id" value="1" /></td>
					<td><strong><img alt="" src="{$vo.fmimg_s}" width="64px"></strong></td>
					<td><small>{$vo.title}</small></td>
					<td>{$vo.read_num}</td>
					<td>{$vo.updatetime}</td>
					<td><a class="button border-blue button-little" href="<?php echo U('Content/edit')?>?id={$vo.id}">修改</a> <a
						class="button border-yellow button-little" href="<?php echo U('Doctor/delete_video')?>?id={$vo.id}"
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