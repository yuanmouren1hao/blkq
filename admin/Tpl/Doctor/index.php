<!DOCTYPE html>
<html lang="zh-cn">
<head>
<title><?php echo mc_option('site_name');?></title>
<meta name="keywords" content="<?php echo mc_option('keyword');?>" />
<meta name="description"
	content="<?php echo mc_option('description');?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link href="__ROOT__/icon.ico" rel="shortcut icon">
<link rel="stylesheet" href="__PUBLIC__/pintuer/pintuer.css">
<link rel="stylesheet" href="__PUBLIC__/pintuer/admin/admin.css">

</head>
<body>


	<form method="post">
		<div class="panel admin-panel">
			<div class="panel-head">
				<strong><span class="badge bg-sub">{$Think.session.DOCTOR.name}</span>
					全部预约信息</strong> <span class="float-right"> <a
					class="button button-little bg-main"
					href="<?php echo mc_option('site_url')?>" target="_blank">前台首页</a>
					<a class="button button-little bg-yellow"
					href="<?php echo U("doctor/logout");?>">注销登录</a> </span>
			</div>
			<table class="table table-hover">
				<tr>
					<th width="60">预约号</th>
					<th width="80">姓名</th>
					<th width="70">年龄段</th>
					<th width="50">性别</th>
					<th width="60">电话</th>
					<th width="130">预约时间</th>
					<th width="75">预约类型</th>
					<th width="75">预约医师</th>
					<th width="*">描述</th>
					<th width="60">状态</th>
				</tr>
				<volist name="list" id="vo">
				<tr>
					<td><strong>{$vo.id}</strong></td>
					<td><a href="javascript:;"><span class="clickname badge bg-blue-light" name="{$vo.tel}">{$vo.name}</span></a></td>
					<td>{$vo.age}</td>
					<td>{$vo.sex}</td>
					<td>{$vo.tel}</td>
					<td>{$vo.order_time}-{$vo.order_time2}</td>
					<td>{$vo.yuyue_type}</td>
					<td>{$vo.doctor_name}</td>
					<td>{$vo.desc}</td>
					<td><?php if($vo['is_chuli']==1):?><span class="badge bg-green">已处理</span>
					<?php endif;?> <?php if($vo['is_chuli']==0):?><span
						class="badge bg-red">未处理</span> <?php endif;?> <?php if($vo['is_reply']==1):?><span
						class="badge bg-green">已回复</span> <?php endif;?> <?php if($vo['is_reply']==0):?><span
						class="badge bg-red">未回复</span> <?php endif;?> <?php if($vo['is_weixin']==1):?><span
						class="badge bg-green">已通知</span> <?php endif;?> <?php if($vo['is_weixin']==0):?><span
						class="badge bg-red">未通知</span> <?php endif;?>
					</td>
				</tr>
				</volist>

			</table>
			<div class="pages">
			<?php echo $page_now?>
			</div>

		</div>
	</form>

	<script src="__PUBLIC__/pintuer/jquery.js"></script>
	<script src="__PUBLIC__/pintuer/pintuer.js"></script>
	<script src="__PUBLIC__/pintuer/respond.js"></script>
	<script src="__PUBLIC__/pintuer/admin/admin.js"></script>

<button class="button button-small dialogs" style="display:none;" data-toggle="click" data-target="#mydialog" data-mask="1" data-width="80%"></button></td>

	<div id="mydialog">
		<div class="dialog">
			<div class="dialog-head">
				<span class="close rotate-hover"></span> <strong id="title">对话框标题</strong>
			</div>
			<div class="dialog-body">对话框内容</div>
			<div class="dialog-foot">
				<button class="button dialog-close">关闭</button>
			</div>
		</div>
	</div>

<script type="text/javascript">
$(document).ready(function(){
	 	$(".clickname").click(function(){
		 	var $name = $(this).html();
		 	var $tel = $(this).attr('name');
		 	//alert($tel);
		 	
		 	$('.dialog-body').html('');
		 	
		 	/*ajax*/
		 	 $.ajax({
	             type: "GET",
	             url: "{:U('doctor/queryUser')}",
	             data: {name:$name, tel:$tel},
	             dataType: "json",
	             success: function(data){
	            	var _html = "<table class='table table-hover'><tr><th>预约时间</th><th>预约类型</th><th>医师</th><th>描述</th></tr>";
					$.each(data,function(i,v){
						_html += "<tr><td>"+v.order_time+"</td><td>"+v.yuyue_type+"</td><td>"+v.doctor_name+"</td><td>"+v.desc+"</td></tr>";
					});
					_html += "</table>";
					$(".dialog-body").append(_html);

		            /*modify title*/
		            $(".dialog-head strong#title").html("");
		            $(".dialog-head strong#title").append($name+"  的预约");
		            
	            	 /*open the dialog*/
	     			$('.dialogs').trigger('click');
		             
	             },
	             error:function (e)
	             {
		             alert(e);
		         }
	         });
		 	
	 		
	 	  });
		
});
</script>
</body>
</html>
