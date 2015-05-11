<!DOCTYPE html>
<html lang="zh-cn">
<head>
<title></title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="__PUBLIC__/pintuer/pintuer.css">
<link rel="stylesheet" href="__PUBLIC__/pintuer/admin/admin.css">
<link rel="stylesheet" href="__PUBLIC__/css/mobiscroll.custom-2.5.2.min.css">

</head>
<body>
<div class="line  margin-big " style='overflow-x:hidden'>


<div class='xl12 xs12 xm7 xb7'>
<div class="alert"><span class="close rotate-hover"></span><strong>提示：</strong><span class="tag bg-black">医生未确认预约</span> <span class='tag bg-sub'>拔牙</span> 
<span class='tag bg-red'>正畸</span> <span class='tag bg-yellow'>补牙</span> <span class='tag bg-light-blue'>修复</span> <span class='tag bg-green'>洗牙</span> <span class='tag bg-main'>美白</span>
 <span class='tag bg-mix'>种植一期</span> <span class='tag bg-mix'>种植二期</span> <span class='tag yzgz'>牙周刮治</span> <span class='tag ggzl'>根管治疗</span>
  <span class='tag zjsj'>正畸设计</span> <span class='tag zzxf'>种植修复</span> <span class='tag bg-pink'>其他</span></div>
	<div class='line margin-top'>
	
			<div class="xl12  xs6 xm6 xb6 margin-top" s>
				选择时间：<input id='tm' />
			</div>
			<div class="xl12  xs6 xm6 xb6 margin-top" >
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

 <div class='xl12 xs12 xm5 xb5'>

<form method="post" class="form-x" id="form1" name="form1">
	<input type="hidden" name="tag" value="tag" /> <input type="hidden"
		name="id" value="{$info.id}" />
	<div class="form-group">
		<div class="label">
			<label for="username">预约号</label>
		</div>
		<div class="field">
			<input type="text" class="input input-auto" disabled="disabled"
				value="{$info.id}" size="20" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="username">姓名</label>
		</div>
		<div class="field">
			<input type="text" class="input input-auto" name="name"
				value="{$cust[0].cust_name}" size="20" disabled="disabled" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="username">年龄</label>
		</div>
		<div class="field">
			<input type="text" class="input input-auto" disabled="disabled"
				value="{$cust[0].age}" size="20" />
		</div>
	</div>
	<div class="form-group">
		<div class="label">
			<label for="username">性别</label>
		</div>
		<div class="field">
			<input type="text" class="input input-auto" disabled="disabled"
				value="{$cust[0].cust_sex}" size="20" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="username">电话</label>
		</div>
		<div class="field">
			<input type="text" class="input input-auto" name="tel" disabled="disabled"
				value="{$cust[0].cust_tel}" size="20" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="username">预约时间</label>
		</div>
		<div class="field">
			<input class='input input-auto' size="20" id='txtTm'
				onClick="WdatePicker({dateFmt:'yyyy-MM-dd'})" name='order_time'
				value="{$info.order_time}" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="username">预约时间段</label>
		</div>
		<div class="field">
			<select name="time11" id="time11">
			<?php for ($i=8;$i<=17;$i++){
				if ($time11 == $i)
				{
					echo "<option value='".$i."' selected>".$i."</option>";
				}
				else
				{
					echo "<option value='".$i."'>".$i."</option>";
				}
			}?>
			</select> ： <select name="time12" id="time12">
				<option value="0" <?php if($time12==0){echo "selected";}?> >00</option>
				<option value="1" <?php if($time12==15){echo "selected";}?> >15</option>
				<option value="2" <?php if($time12==30){echo "selected";}?> >30</option>
				<option value="3" <?php if($time12==45){echo "selected";}?> >45</option>
			</select>   &nbsp;  &nbsp;  &nbsp;到    &nbsp;  &nbsp;  &nbsp;
			<select name="time21" id="time21">
			<?php for ($i=8;$i<=17;$i++){
				if ($time21 == $i)
				{
					echo "<option value='".$i."' selected>".$i."</option>";
				}
				else
				{
					echo "<option value='".$i."'>".$i."</option>";
				}
			}?>
			</select> ： <select name="time22" id="time22">
				<option value="0" <?php if($time22==0){echo "selected";}?> >00</option>
				<option value="1" <?php if($time22==15){echo "selected";}?> >15</option>
				<option value="2" <?php if($time22==30){echo "selected";}?> >30</option>
				<option value="3" <?php if($time22==45){echo "selected";}?> >45</option>
			</select>

		</div>
	</div>



	<div class="form-group">
		<div class="label">
			<label for="username">描述</label>
		</div>
		<div class="field">
			<input type="text" class="input" name="desc" disabled="disabled" value="{$info.desc}" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="username">医师名称</label>
		</div>
		<div class="field">
			<select class="input" name="doctor_id" >
				<option selected value='{$info.doctor_id}'>{$info.doctor_name}</option>
				<?php
					foreach($doctor_list as $list){
						echo  "<option value='".$list['tbid']."'>".$list["name"]."</option>";
					}
				?>
				
				
			</select>
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="username">预约类型</label>
		</div>
		<div class="field">
			<select class="input" name="yuyue_type">
				<option selected value='{$info.yuyue_type}'>{$info.yuyue_type}</option>
				<option value="拔牙">拔牙</option>
				<option value="正畸">正畸</option>
				<option value="补牙">补牙</option>
				<option value="修复">修复</option>
				<option value="洗牙">洗牙</option>
				<option value="美白">美白</option>
				<option value="种植一期">种植一期</option>
				<option value="种植二期">种植二期</option>
				<option value="牙周刮治">牙周刮治</option>
				<option value="根管治疗">根管治疗</option>
				<option value="正畸设计">正畸设计</option>
				<option value="种植修复">种植修复</option>
				<option value="其他">其他</option>
			</select>
		</div>
	</div>



	<div class="form-button">
		<button class="button bg-sub"  id="submit" type='submit'>保存</button>
		<a class="button margin-big-left "  href="<?php  echo U('Message/index_yuyue') ?>?sid={$_GET['sid']}">返回</a>
	</div>
</div>

</form>
<script
	charset="utf-8" src="__PUBLIC__/kindeditor/kindeditor-min.js"></script>
<script
	charset="utf-8" src="__PUBLIC__/kindeditor/zh_CN.js"></script>
<script
	type="text/javascript"
	src="__PUBLIC__/js/My97DatePicker/WdatePicker.js"></script>
<script charset="utf-8"
	src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript">

	$('#submit').click(function(){
			time1 = ($("#time11").val()-8)*4+$("#time12").val()*1;
			time2 = ($("#time21").val()-8)*4+$("#time22").val()*1;
			if(time1>=time2)
			{
				alert("您选择的时间段有误，请检查.");
				return false;
			}
	})
	$("#fanhui").click(function(){
		
	});
</script>
<style>
.div_day {
	width: 100%;
	cursor:pointer;
}
.div_kong{
	width:100%;
	curosr:pointer;	
}
.bg-pink{
	background-color: blue;
}
.yzgz{
	background-color: brown;
}
.ggzl{
	background-color: yellowgreen;
}
.zqsj{
	background-color: yellow;
}
.zjsj{
	background-color: violet;
}
.zzxf{
	background-color: yellowgreen;
}
</style>
</div>

    <script src="__PUBLIC__/pintuer/jquery.js"></script>
    <script src="__PUBLIC__/pintuer/pintuer.js"></script>
    <script src="__PUBLIC__/pintuer/respond.js"></script>
    <script src="__PUBLIC__/pintuer/admin/admin.js"></script>   
    <script src="__PUBLIC__/js/mobiscroll.custom-2.5.2.min.js"></script>
 	<script src="__PUBLIC__/js/jsEx.js"></script>
 
    
    <script>
$(function() {
	
	var doc_id = getQueryString("doc_id");
	var time = getQueryString("time");
	
	
	
	// 初始化日期控件
	var opt = {
		preset : 'date', // 日期
		// theme: '', //皮肤样式
		display : 'modal', // 显示方式
		showNow : true,
		mode : 'clickpick', // 日期选择模式
		dateFormat : 'yy-mm-dd', // 日期格式
		setText : '确定', // 确认按钮名称
		cancelText : '取消',// 取消按钮名籍我
		dateOrder : 'yymmdd', // 面板中日期排列格式
		dayText : '日',
		monthText : '月',
		yearText : '年', // 面板中年月日文字
		hourText : "时",
		minuteText : "分",
		nowText : "现在",
		timeFormat : "HH:ii",
		timeWheels : "HH:ii",
		endYear : 2222// 结束年份
	}
	var JSON = null;
	$("#tm").mobiscroll(opt);
	if(time){
		$("#tm").val(new Date(time).format("yyyy-MM-dd"));
	}else{
		$("#tm").val(new Date().format('yyyy-MM-dd'));
	}
	if(doc_id){
		$("#sel_doc").val(doc_id);
	}else{
		
	}	
	$("#tm").change(function(){
		query();
	})
	$("#sel_doc").change(function(){
		query();
	})
	query();
	$(".div_day").css("height", $(".div_day").css("width"));
	$("#btn_query").click(function() {
		query();
	});
	function query() {
		$("#div_list").html("");
		var time = $("#tm").val();
		$.ajax({
			url:'{:U("message/get_doc_duty")}',
			dataType : "json",
			type : 'get',
			data : {
				datetime : time,
				doc_id : $("#sel_doc").val(),
			},
			success : function(json) {
				printduty(json);
				//$(".div_day").css("height",$(".div_day").css("width"));
			},
			error : function() {
				// alert("服务器错误，请与管理员联系");
			}
			});
	}
	function printduty(json){
		if(json.length == 0){
			$("#div_list").html("暂无数据")
		}else{
			$.each(json,function(i,v){
				var duty = "";
				var duty_c = "yellow";
				if(v.am == 0 && v.pm == 0){
					duty = "班";
					duty_c = "gray";
				}
				if(v.am == 1 && v.pm == 0){
					duty = "上休";
				}
				if(v.am == 0 && v.pm == 1){
					duty = "下休";
				}
				if(v.am == 1 && v.pm == 1){
					duty = "休";
				}
				var _html = "<div class='x12 border border-sub margin-top padding-top padding-bottom'><div class='x1'><span class='tag bg-"+duty_c+"'>"+duty+"</span></div><div class='x1'>"+v.name+"</div>"+
				"<div  class='x10 doc_"+v.tbid+"'><div class='x12'><div class='x1'>8</div><div class='x1'></div><div class='x1'>10</div><div class='x1'></div><div class='x1'>12</div><div class='x1'></div><div class='x1'>14</div><div class='x1'></div><div class='x1'>16</div><div class='x1'></div><div class='x1'>18</div><div class='x1'></div></div></div>"+
				"</div>";
				$("#div_list").append(_html);
			});
		}
		//加载具体预约内容
			$.ajax({
			url:'{:U("message/get_duty_message")}',
				dataType : "json",
				type : 'get',
				data : {
					datetime : $("#tm").val(),
					doc_id : $("#sel_doc").val(),
				},
				success : function(json) {
					console.log(json);
					dutyprint(json);
				},
				error : function() {
					// alert("服务器错误，请与管理员联系");
				}
			});
		
		
	}
	
	function dutyprint(json){
		//加载预约信息
		var col = 0;	
		
		//var color = ["bg-sub","bg-main","bg-mix","bg-dot","bg-gray","bg-red","bg-yellow","bg-blue"];
		var color = {"拔牙":"bg-sub","正畸":"bg-red","补牙":"bg-yellow","修复":"bg-blue","洗牙":"bg-green","美白":"bg-main","种植一期":"bg-mix","种植二期":"bg-mix","牙周刮治":"yzgz","根管治疗":"ggzl","正畸设计":"zjsj","种植修复":"zzxf","其他":"bg-pink"};
		$.each(json,function(i,v){	
			var doc_id = v.doctor_id;
			var start = v.dottime.split(",")[0];
			var end = v.dottime.split(",")[1];
			//判断是放在已有的行还是新增一行
			var lin = $(".doc_"+doc_id).find(".lin");
			var isold = false;
			var lin_num;
			if(lin.length > 0){
				//已经存在信息行
				for(var k = 0;k<lin.length;k++){
					//遍历每个预约行
					var x3 = $(lin[k]).find(".x3");
					var isIN = true;
					for(var j =start*1;j<end*1;j++){
						if($(x3[j]).find(".div_day").length == 1){
							isIN = false;
							break;
						}	
					}
					if(isIN == true){
						//新增一行
						var lin_num = k;
						isold = true;
						break;
					}
					
				}	
			}else{
				//为第一行
				isold = false;
			}	
			if(isold){
				//在lin_num 中增加   lin[lin_num]
				var x3 = $(lin[lin_num]).find(".x3");
				for(var j =start*1;j<end*1;j++){
					if(v.isconfirm == 0){
						$(x3[j]).html("<div type='"+v.yuyue_type+"' time='"+v.order_time2+"' for='"+v.id+"' class='bg-black div_day'></div>");			
					}else{
						$(x3[j]).html("<div type='"+v.yuyue_type+"' time='"+v.order_time2+"' for='"+v.id+"' class='"+color[v.yuyue_type]+" div_day'></div>");			
					}
					
				
				}	
				col = (col+1)%8;		
			}else{
				//新增一行
				var html = "<div class='lin x12 margin-top'>";
				for( var k = 0;k <=9 ; k++){			
					html += "<div class='x1  border-right border-green'>";
					for(var j=0;j<=3;j++){
						if( (4*k+j) >= start && (4*k+j) < end){
							
							if(v.isconfirm == 0){
								html += "<div class='x3'><div type='"+v.yuyue_type+"' time='"+v.order_time2+"' for='"+v.id+"' class='bg-black div_day'></div></div>";			
							}else{
								html += "<div class='x3'><div type='"+v.yuyue_type+"' time='"+v.order_time2+"' for='"+v.id+"' class='"+color[v.yuyue_type]+" div_day'></div></div>";			
							}
							
						
						
						}else{
							html += "<div class='x3'><div class='div_kong'></div></div>";
						}				
					}
					html += "</div>";
				}
				col = (col+1)%8;
				html += "</div>";
				$(".doc_"+doc_id).append(html);								
			}		
		});
		$(".div_day").css("height", $(".div_day").css("width"));
		$(".div_kong").css("height", $(".div_day").css("width"));
		$(".div_day").click(function(){
			//加载信息
			var id = $(this).attr("for");
			var time = $(this).attr("time");
			var type = $(this).attr("type");
			var html = "<table class='table table-bordered'><tr><td>预约号</td><td>"+id+"</td></tr>"+
			"<tr><td>预约时间</td><td>"+time+"</td></tr><tr><td>预约类型</td><td>"+type+"</td></tr>"+
			"</table>";
			$("#dialog-body").html(html);
			$("#dialog").trigger("click");
		});
	}
	
	function getQueryString(name) {
		var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
		var r = window.location.search.substr(1).match(reg);
		if (r != null)
		return unescape(r[2]);
		return null;
	}
	
	
	});


</script>
    
</body>
</html>