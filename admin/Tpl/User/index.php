<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>职员管理</title>
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
				href="{:U('user/add')}"><i class="icon-white icon-plus"></i>
				添加新用户(User)</a>
		</div>
	</div>
	<div class="listbox">
		<div class="middle">
			<div class="list-search">
				<div class="input-label">
					<div class="input-prepend fl" style="margin-left: 10px">
						<span class="add-on">用户名</span><input type="text" name="search_1"
							id="search_1">
					</div>
					<div class="input-prepend fl" style="margin-left: 10px">
						<span class="add-on">用户类型</span><select name="search_2"
							id="search_2">
							<option value="">全部</option>
							<option value="0">普通会员</option>
							<option value="1">管理员</option>
						</select>
					</div>
					<a class="btn fr" menu="search" href="javascript:;"
						style="margin-right: 10px"><i class="icon-search"></i> 搜索</a>
				</div>
			</div>

			<ul class="list-title">
				<li><span class="level">&nbsp;</span> <span class="name">用户名</span>
					<span class="do">操作</span> <span class="type">权限组别</span>
				</li>
			</ul>
			<ul class="list-con">
				<volist name="info" id="vo">
				<li><span class="level" style="width: 20px">&nbsp;</span> <span
					class="name">{$vo.name}</span> <span class="do">
						<div class="input-prepend">
							<a class="btn btn-mini btn-info" href="{:U('user/edit')}?memberid={$vo.tbid}">
								<i class="icon-edit"></i> 编辑</a>
								<a class="list_del btn btn-mini" href="javascript:;" memberid="{$vo.tbid}"><i class="icon-remove"></i> 删除</a>
						</div> </span> <span class="type">{$vo.groupname}</span></li>

				</volist>
			</ul>

			<div id="pagination" class="pagination"></div>
			<input id="pagination_setting" type="hidden" maxrn="{$membercount}"
				prn="15" pid="0" />
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
		var memberid = $(this).attr('memberid');
		//var name = $(this).parent().prev().text();
		var name = $(this).parent().parent().prev().text();
		//art.dialog({content:name});
		//alert(name);
		
		art.dialog({
			id : 'ajaxedit',
			content : '确定要删除 “' + name + '” 该用户么？',
			ok : function(){
				$.ajax({
					type : 'POST',
					url : '{:U("user/delete")}',
					data : 'memberid=' + memberid,
					success : function(msg){
						art.dialog({content:msg});
						history.go(0);
						//pageselectCallback($('#pagination_setting').attr('pid'));
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
	pageselectCallback();
});


function initPagination(cpn){
	$('#pagination').pagination(parseInt($('#pagination_setting').attr('maxrn')), {
		current_page : cpn,
		items_per_page : parseInt($('#pagination_setting').attr('prn')),
		num_display_entries : 4,
		callback : pageselectCallback,
		prev_text : '上一页',
		next_text : '下一页'
	});
}
function pageselectCallback(page_index, reset){
	art.dialog({
		lock : true,
		id : 'page',
		esc : false,
		content : '数据加载中...'
	});
	page_index = (page_index == undefined || isNaN(page_index)) ? 0 : page_index;
	if(page_index == -1){
		page_index = 0;
		reset = 1;
	}
	var from = page_index * parseInt($('#pagination_setting').attr('prn')), to = parseInt($('#pagination_setting').attr('prn')); 
	$.ajax({
		type : 'POST', 
		url : 'index.php', 
		data : 'ac=ajaxGetList&reset=' + reset + '&from=' + from + '&to=' + to + '&search_1=' + $('#search_1').val() + '&search_2=' + $('#search_2').val(),
		success : function(msg){
			var arr = msg.split('<{|*|}>');
			if(parseInt(arr[0], 10) != -1){
				$('#pagination_setting').attr('maxrn', arr[0]);
				initPagination(page_index);
			}
			$('.list-con').html(arr[1]);
			art.dialog.list['page'].close();
		}
	}); 
}
</script>
</body>
</html>
