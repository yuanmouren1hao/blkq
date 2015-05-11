<!DOCTYPE html>
<html lang="zh-cn">
<head>
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="__PUBLIC__/pintuer/pintuer.css">
<link rel="stylesheet"
	href="__PUBLIC__/css/mobiscroll.custom-2.5.2.min.css">

<script src="__PUBLIC__/js/jquery.js"></script>
<script src="__PUBLIC__/js/mobiscroll.custom-2.5.2.min.js"></script>
<script src="__PUBLIC__/pintuer/pintuer.js"></script>
<script src="__PUBLIC__/js/jsEx.js"></script>

<script>



</script>
<style>
.div_day {
	width: 100%;
	cursor:pointer;
}
</style>

</head>
<body>
	<div class="container">
		<div class='line margin-top'>
			<div class="xl12  xs6 xm4 xb4 margin-top" s>
				选择时间：<input id='tm' />
			</div>
			<div class="xl12  xs6 xm4 xb4 margin-top" >
				选择医生：<select id='sel_doc'>
				<option value='0'>----全部医生----</option>
					<?php
						foreach ($list as $map){
							echo "<option value='".$map['tbid']."'>".$map['name']."</option>";
						}
					?>
				</select>
			</div>
			
		</div>	
		<div id='div_list'>
		
		</div>
		<button id='dialog' style='display:none' class="button button-big bg-main dialogs" data-toggle="click" data-target="#mydialog" data-mask="1" data-width="70%"></button>
		<div id="mydialog">
		<div class="dialog">
		  <div class="dialog-head">
		    <span class="dialog-close close rotate-hover"></span>
		    <strong>详细信息</strong>
		  </div>
		  <div class="dialog-body" id='dialog-body'>
		
		  </div>
		  <div class="dialog-foot">
		    <button class="button dialog-close">关闭</button>
		  </div>
		</div>
		</div>
		
	</div>
</body>
</html>


