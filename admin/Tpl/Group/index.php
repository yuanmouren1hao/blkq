<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>权限管理</title>
<link rel="stylesheet" href="__ROOT__/oa/img/ui/sys.css">
<link rel="stylesheet" href="__ROOT__/oa/js/HoorayLibs/hooraylibs.css">
<link rel="stylesheet"
	href="__ROOT__/oa/img/ui/bootstrap/bootstrap.custom.by.hooray.css">
<link rel="stylesheet" href="__ROOT__/oa/img/ui/globle.css">
</head>

<body>
	<div class="top-bar">
		<div class="con">
			<a class="btn btn-primary btn-large" menu="creat"
				href="{:U('group/add')}"><i class="icon-white icon-plus"></i>
				创建新分组(Group)</a>
		</div>
	</div>
	<div class="listbox">
		<div class="middle">
			<div class="list-search">
				<div class="input-label">
					<div class="input-prepend fl" style="margin-left: 10px">
						<span class="add-on">分组名称</span><input type="text" name="search_1"
							id="search_1">
					</div>
					<a class="btn fr" menu="search" href="javascript:;"
						style="margin-right: 10px"><i class="icon-search"></i> 搜索</a>
				</div>
			</div>
			<ul class="list-title">
				<li><span class="level">&nbsp;</span> <span class="name">分组名称</span>
					<span class="do">操作</span>
				</li>
			</ul>

			<ul class="list-con">
				<volist name="info" id="vo">
				<li><span class="level" style="width: 20px">&nbsp;</span> <span
					class="name">{$vo.name}</span> <span class="do"><a
						href="{:U('group/edit')}?permissionid={$vo.tbid}&name={$vo.name}">编辑</a> | <a
						href="javascript:;" class="list_del" permissionsid="{$vo.tbid}">删除</a>
				</span>
				</li>
				</volist>
			</ul>

			<div id="pagination" class="pagination"></div>

		</div>
	</div>

	<script src="__ROOT__/oa/js/jquery-1.8.1.min.js"></script>
	<script src="__ROOT__/oa/js/HoorayLibs/hooraylibs.js"></script>
	<script
		src="__ROOT__/oa/js/artDialog4.1.6/jquery.artDialog.js?skin=default"></script>
	<script src="__ROOT__/oa/js/artDialog4.1.6/plugins/iframeTools.js"></script>

	<script>
		$(function(){
			$('.tip').colorTip();
		});
	</script>

	<script>
$().ready(function(){
	//删除
	$('.list_del').live('click', function(){
		var permissionsid = $(this).attr('permissionsid');
		var name = $(this).parent().prev().text();
		//alert(permissionsid);
		art.dialog({
			id : 'ajaxedit',
			content : '确定要删除 “' + name + '” 该分组么？',
			ok : function(){
				$.ajax({
					type : 'POST',
					url : '{:U("group/delete")}',
					data : 'permissionsid=' + permissionsid,
					success : function(msg){
						art.dialog({content:msg});
						history.go(0);
					}
				});
			},
			cancel: true
		});
	});
	
	//搜索
	$('a[menu=search]').click(function(){
		pageselectCallback(-1);
	});
	pageselectCallback(0);
});

function initPagination(cpn){
	$('#pagination').pagination(parseInt($('#pagination_setting').attr('maxrn')), {
		current_page : cpn,
		items_per_page : parseInt($('#pagination_setting').attr('prn')),
		num_display_entries : 4,
		callback : pageselectCallback,
		prev_text : '上一页',
		next_text : '下一页',
		corner : '0'
	});
}
function pageselectCallback(page_id,reset){
	art.dialog({
		lock : true,
		id : 'page',
		esc : false,
		content : '数据加载中...'
	});
	page_id = (page_id == undefined || isNaN(page_id)) ? 0 : page_id;
	if(page_id == -1){
		page_id = 0;
		reset = 1;
	}
	var from = page_id * parseInt($('#pagination_setting').attr('prn')), to = parseInt($('#pagination_setting').attr('prn')); 
	$.ajax({
		type : 'POST', 
		url : 'index.php', 
		data : 'ac=ajaxGetList&reset=' + reset + '&from=' + from + '&to=' + to + '&search_1=' + $('#search_1').val(),
		success : function(msg){
			var arr = msg.split('<{|*|}>');
			if(parseInt(arr[0], 10) != -1){
				$('#pagination_setting').attr('maxrn', arr[0]);
				initPagination(page_id);
			}
			$('.list-con').html(arr[1]);
			art.dialog.list['page'].close();
		}
	}); 
}
</script>
</body>
</html>
