<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>添加应用</title>
<link rel="stylesheet" href="__ROOT__/oa/img/ui/globle.css">
<link rel="stylesheet"
	href="__ROOT__/oa/img/ui/bootstrap/bootstrap.custom.by.hooray.css">
<link rel="stylesheet" href="__ROOT__/oa/js/HoorayLibs/hooraylibs.css">
<link rel="stylesheet" href="__ROOT__/oa/img/ui/sys.css">
</head>

<body>
	<div class="alert_addapps">
	<volist name="info" id="vo">
		<div class="app" title="{$vo.name}" appid="{$vo.tbid}">
			<img src="../../oa/{$vo.icon}" alt="{$vo.name}">
			<div class="name">{$vo.name}</div>
			<span class="selected"></span>
		</div>
	</volist>
	</div>
	<input type="hidden" id="value_1">

	<script src="__ROOT__/oa/js/jquery-1.8.1.min.js"></script>
	<script src="__ROOT__/oa/js/HoorayLibs/hooraylibs.js"></script>
	<script
		src="__ROOT__/oa/js/artDialog4.1.6/jquery.artDialog.js?skin=default"></script>
	<script src="__ROOT__/oa/js/artDialog4.1.6/plugins/iframeTools.js"></script>

	<script>
$(function(){
	if(art.dialog.data('appsid') != ''){
		$('#value_1').val(art.dialog.data('appsid'));
		var appsid = art.dialog.data('appsid').split(',');
		$('.app').each(function(){
			for(var i=0; i<appsid.length; i++){
				if(appsid[i] == $(this).attr('appid')){
					$(this).addClass('act');
					break;
				}
			}
		});
	}
	$('.app').click(function(){
		if($(this).hasClass('act')){
			var appsid = $('#value_1').val().split(',');
			var newappsid = [];
			for(var i=0, j=0; i<appsid.length; i++){
				if(appsid[i] != $(this).attr('appid')){
					newappsid[j] = appsid[i];
					j++;
				}
			}
			$('#value_1').val(newappsid.join(','));
			$(this).removeClass('act');
		}else{
			if($('#value_1').val() != ''){
				var appsid = $('#value_1').val().split(',');
				appsid[appsid.length] = $(this).attr('appid');
				$('#value_1').val(appsid.join(','));
			}else{
				$('#value_1').val($(this).attr('appid'));
			}
			$(this).addClass('act');
		}
		$.dialog.data('appsid', $('#value_1').val());
	});
});
</script>


</body>
</html>
