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
			<a href="<?php echo U('Content/rublish');?>" type="button"
				class="button button-small border-blue">回收站</a>

			<div class="float-right x1 margin-left" id="key">
				<a href="" type="button" class="button button-small border-blue">过滤</a>
			</div>
			<div class="float-right x1">
				<select class="input" name="father" id="father"
					onchange="javascript:get_child_catelog(this.value);">
					<option>#####</option>
					<volist name='catelog' id='vo'>
					<option value='{$vo.father}'>{$vo.father}</option>
					</volist>
				</select>
			</div>

			<div class="clearfix"></div>
		</div>
		<table class="table table-hover">
			<tr>
				<th width="45">选择</th>
				<th width="120">一级分类</th>
				<th width="120">二级分类</th>
				<th width="*">标题</th>
				<th width="150">时间</th>
				<th width="100">操作</th>
			</tr>
			<volist name="list" id="vo">
			<tr>
				<td><input type="checkbox" name="id" value="1" /></td>
				<td><strong>{$vo.father}</strong></td>
				<td><small>{$vo.child}</small></td>
				<td><?php if($vo['father']=='医院动态'):?><a target="_blank" href="__ROOT__/index.php/index-news_detail.html?id={$vo.id}"><?php else :?><a
						target="_blank"
						href="__ROOT__/index.php/page-page_detail.html?father={$vo.father}&child={$vo.child}"><?php endif;?>{$vo.title}</a></td>
				<td>{$vo.updatetime}</td>
				<td><a class="button border-blue button-little"
					href="<?php echo U('Content/edit')?>?id={$vo.id}">修改</a> <a
					class="button border-yellow button-little"
					href="<?php echo U('Content/delete')?>?id={$vo.id}"
					onclick="{if(confirm('确认删除?')){return true;}return false;}">删除</a></td>
			</tr>
			</volist>

		</table>

		<div class="pages">
			<?php echo $page_now?>
		</div>


	</div>
</form>
<script type="text/javascript">
	function get_child_catelog(value)
	{
		$("div#key a").attr('href','<?php echo U("content/index");?>?key='+value);
	}

</script>
<include file='public/foot' />