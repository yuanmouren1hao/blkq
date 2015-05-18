<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>权限管理</title>
<link rel="stylesheet" href="__ROOT__/oa/img/ui/globle.css">
<link rel="stylesheet"
	href="__ROOT__/oa/img/ui/bootstrap/bootstrap.custom.by.hooray.css">
<link rel="stylesheet" href="__ROOT__/oa/js/HoorayLibs/hooraylibs.css">
<link rel="stylesheet" href="__ROOT__/oa/img/ui/sys.css">
</head>

<body>
	<form action="{:U('group/add')}" method="post" name="form" id="form">
		<input type="hidden" name="tag" value="tag">
		
		<div class="creatbox">
			<div class="middle">
				<p class="detile-title">
					<strong>添加分组</strong>
				</p>
				<div class="input-label">
					<label class="label-text">分组名称：</label>
					<div class="label-box">
						<input type="text" name="val_name">
					</div>
				</div>
				<div class="input-label">
					<label class="label-text">专属应用：</label>
					<div class="label-box">
						<div class="permissions_apps"></div>
						<a class="btn btn-mini" href="javascript:;" menu="addapps">添加应用</a>
						<input type="hidden" name="val_apps_id" id="val_apps_id" value="">
					</div>
				</div>
			</div>
		</div>
		<div class="bottom-bar">
			<div class="con">
				<a class="btn btn-large btn-primary fr" menu="submit" href="javascript:;"><i class="icon-white icon-ok"></i> 确定</a> 
				<a class="btn btn-large" menu="back" href="index.html"><i class="icon-arrow-left"></i> 返回分组列表</a>
			</div>
		</div>
	</form>


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
	//初始化ajaxForm
	var options = {
		beforeSubmit : showRequest,
		success : showResponse,
		type : 'POST'
	};
	$('#form').ajaxForm(options);
	//提交
	$('a[menu=submit]').click(function(){
		$('#form').submit();
	});

	//添加应用
	$('a[menu=addapps]').click(function(){
		$.dialog.data('appsid', $('#val_apps_id').val());
		$.dialog.open('{:U("group/alert_addapps")}', {
			id : 'alert_addapps',
			title : '添加应用',
			resize: false,
			width : 350,
			height : 300,
			ok : function(){
				$('#val_apps_id').val($.dialog.data('appsid'));
				//alert($('#val_apps_id').val());
				updateApps($.dialog.data('appsid'));
			},
			cancel : true
		});
	});
	
	//删除应用
	$('.permissions_apps').on('click','.app .del',function(){
		var appid = $(this).parent().attr('appid');
		var appsid = $('#val_apps_id').val().split(',');
		var newappsid = [];
		for(var i=0, j=0; i<appsid.length; i++){
			if(appsid[i] != appid){
				newappsid[j] = appsid[i];
				j++;
			}
		}
		$('#val_apps_id').val(newappsid.join(','));
		$(this).parent().remove();
	});
});


function showRequest(formData, jqForm, options){
	//alert('About to submit: \n\n' + $.param(formData));
	return true;
}
function showResponse(responseText, statusText, xhr, $form){
	art.dialog({content:responseText});
	location.reload() 
	//alert('status: ' + statusText + '\n\nresponseText: \n' + responseText + '\n\nThe output div should have already been updated with the responseText.');
	/*
	if($('input[name="value_1"]').val() != ''){
		if(responseText == ''){
			art.dialog({
				id : 'ajaxedit',
				content : '修改成功',
				ok : function(){
					art.dialog.list['ajaxedit'].close();
				}
			});
		}
	}else{
		if(responseText == ''){
			art.dialog({
				id : 'ajaxedit',
				content : '添加成功',
				ok : function(){
					art.dialog.list['ajaxedit'].close();
				}
			});
		}
	}*/
}

function updateApps(appsid){
	$.ajax({
		type : 'POST',
		url : '{:U("group/add")}',
		data : 'tag=updateApps&appsid=' + appsid,
		success : function(msg){
			//alert(msg);
			$('.permissions_apps').html(msg);
		}
	});
}
</script>


</body>
</html>
