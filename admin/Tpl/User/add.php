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
	<form action="{:U('user/add')}" method="post" name="form" id="form">
		<input type="hidden" name="tag" value="adduser"> 
			
		<div class="creatbox">
			<div class="middle">
				<p class="detile-title">
					<strong>添加用户</strong>
				</p>
				<div class="input-label">
					<label class="label-text">用户名：</label>
					<div class="label-box">
						<input type="text" name="val_username">
					</div>
				</div>
				<div class="input-label">
					<label class="label-text">用户密码：</label>
					<div class="label-box">
						<input type="text" name="val_password">
					</div>
				</div>
				<div class="input-label">
					<label class="label-text">用户电话：</label>
					<div class="label-box">
						<input type="text" name="val_tel">
					</div>
				</div>
				<div class="input-label">
					<label class="label-text">用户 微信：</label>
					<div class="label-box">
						<input type="text" name="val_weixinid">
					</div>
				</div>

				<div class="input-label">
					<label class="label-text">用户邮箱：</label>
					<div class="label-box">
						<input type="text" name="val_email">
					</div>
				</div>

				<div
					class="input-label input-label-permission {if $member.type == 0}disn{/if}">
					<label class="label-text">用户权限组：</label>
					<div class="label-box form-inline">
						<volist name="permissionlist" id="vo"> <label class="checkbox"
							style="margin-right: 10px"><input type="checkbox"
							name="val_permission_id" value="{$vo.tbid}">{$vo.name}</label> </volist>
						<span class="txt">[<a href="javascript:;" class="tip blue"
							title="权限最多只能选一项">?</a>]</span>
					</div>
				</div>
			</div>
		</div>
		<div class="bottom-bar">
			<div class="con">
				<a class="btn btn-large btn-primary fr" menu="submit"
					href="javascript:;"><i class="icon-white icon-ok"></i> 确定</a> <a
					class="btn btn-large" menu="back" href="{:U('user/index')}"><i
					class="icon-arrow-left"></i> 返回用户列表</a>
			</div>
		</div>
	</form>


	<script src="__ROOT__/oa/js/jquery-1.8.1.min.js"></script>
	<script src="__ROOT__/oa/js/HoorayLibs/hooraylibs.js"></script>
	<script src="__ROOT__/oa/js/artDialog4.1.6/jquery.artDialog.js?skin=default"></script>
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
	$('input[name="val_type"]').change(function(){
		if($(this).val() == 1){
			$('.input-label-permission').slideDown();
		}else{
			$('.input-label-permission').slideUp();
		}
	});
	checkboxMax();
	$('input[name="val_permission_id"]').change(function(){
		checkboxMax();
	});
	//提交
	$('a[menu=submit]').click(function(){
		$('#form').submit();
	});
});
function checkboxMax(){
	if($('input[name="val_permission_id"]').filter(':checked').length >= 1){
		$('input[name="val_permission_id"]').not(':checked').each(function(){
			$(this).attr('disabled',true);
		});
	}else{
		$('input[name="val_permission_id"]').not(':checked').each(function(){
			$(this).attr('disabled',false);
		});
	}
}
function showRequest(formData, jqForm, options){
	//alert('About to submit: \n\n' + $.param(formData));
	/*need to check param*/
	return true;
}
function showResponse(responseText, statusText, xhr, $form){
	//alert('status: ' + statusText + '\n\nresponseText: \n' + responseText + '\n\nThe output div should have already been updated with the responseText.');
	art.dialog(responseText);
	history.go(0);
}
</script>
</body>
</html>
