<include file="public/head" />


<form method="post">
	<div class="panel admin-panel">
		<div class="panel-head">
			<strong>全部留言信息</strong>
		</div>
		<div class="padding border-bottom">
			<input type="button" class="button button-small checkall"
				name="checkall" checkfor="id" value="全选" /> <input
				type="button" class="button button-small border-yellow" value="批量删除" />
		</div>
		<table class="table table-hover">
			<tr>
				<th width="45">选择</th>
				<th width="*">消息</th>
				<th width="150">留言时间</th>
				<th width="200">回复消息</th>
				<th width="150">回复时间</th>
				<th width="100">是否已回复</th>
				<th width="100">操作</th>
			</tr>
			<volist name="list" id="vo">
				<tr>
					<td><input type="checkbox" name="id" value="1" /></td>
					<td><strong><a href="#">{$vo.ask_message}</a></strong></td>
					<td>{$vo.ask_time}</td>
					<td>{$vo.reply_message}</td>
					<td>{$vo.reply_time}</td>
					<td><?php if($vo['is_reply']==1):?><span class="badge bg-green">已回复</span><?php endif;?><?php if($vo['is_reply']==0):?><span class="badge bg-red">未回复</span><?php endif;?></td>
					<td>
					<a class="button button-little bg-main dialogs" href="javascript:;" data-toggle="click" data-target="#mydialog" data-mask="1" data-width="50%" onclick="javascript:setid('<?php echo U('Message/reply_liuyan')?>?id={$vo.id}');">回复</a>
					<a class="button border-yellow button-little" href="<?php echo U('Message/delete_liuyan')?>?id={$vo.id}"
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
	function setid(value)
	{
		$('form#reply_dialog').attr('action',value);
	}

</script>

<div id="mydialog">
  <div class="dialog">
    <div class="dialog-head">
      <span class="close rotate-hover"></span>
      <strong>回复消息</strong>
    </div>
    
    <form id="reply_dialog" action="" method="post" >
	    <div class="dialog-body">
	   		<input type="text" class="input" id="reply_message" name="reply_message" size="50" placeholder="输入回复消息~" />	
	    </div>
	    <div class="dialog-foot">
	      <button class="button bg-green">确认</button>
	    </div>
    </form>
    
  </div>
</div>

<include file='public/foot' />