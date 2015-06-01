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
<link rel="stylesheet" href="__PUBLIC__/js/jquery-ui-1.11.4.custom/jquery-ui.css">

</head>
<body>
<div class="line  margin-big " style='overflow-x:hidden'>


<div class='xl12 xs12 xm7 xb7'>
<div class="alert"><span class="close rotate-hover"></span><strong>提示：</strong><span class="tag bg-black">医生未确认预约</span> <span class='tag bg-sub'>拔牙</span> 
<span class='tag bg-red'>正畸</span> <span class='tag bg-yellow'>补牙</span> <span class='tag bg-light-blue'>修复</span> <span class='tag bg-green'>洗牙</span> <span class='tag bg-main'>美白</span>
 <span class='tag bg-mix'>种植一期</span> <span class='tag bg-mix'>种植二期</span> <span class='tag yzgz'>牙周刮治</span> <span class='tag ggzl'>根管治疗</span>
  <span class='tag zjsj'>正畸设计</span> <span class='tag zzxf'>种植修复</span> <span class='tag bg-pink'>其他</span></div>
		
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

 <div class='xl12 xs12 xm4 xm1-move xb4 xb1-move'>

<form class="form-x" >		
	
	<div class="form-group">
		<div class="label">
			<label for="id">预约号</label>
		</div>
		<div class="field">
			<input type="text" id='yuyueid' class="input input-auto" disabled="disabled" name="yuyueid" size="20" />			
		</div>
	</div>
	<div class="form-group">
		<div class="label">
			<label for="answer_id">创建人员</label>
		</div>
		<div class="field">
			<input type="text" id='answer_id' class="input input-auto" disabled="disabled" name="yuyueid" size="20" />			
		</div>
	</div>
	<div class="form-group">
		<div class="label">
			<label for="edit_id">编辑人员</label>
		</div>
		<div class="field">
			<input type="text" id='edit_id' class="input input-auto" disabled="disabled" name="yuyueid" size="20" />			
		</div>
	</div>
	<div class="form-group">
		<div class="label">
			<label for="username">电话</label>
		</div>
		<div class="field">
			<input type="text" id='input_tel' class="input input-auto" name="tel" size="20" />
			<span id='span_tel' now="0" class="icon icon-user"></span>
			<span id='cust_save' class="icon icon-save margin-left"></span>
		</div>
	</div>	

<div class="form-group">
	<div class="label">
			<label for="username">选择时间</label>
	</div>
	<div class="field">
		<input id='tm' />
	</div>
	
</div>
<div  class="form-group">
<div class="label">
			<label for="sel_doc">选择医生</label>
	</div>
	<div class="field">
			<select class='input' id='sel_doc' >
				
					<?php
						if($isdoc > 0){
							echo "<option value='".$isdoc."'>".$doc_name."</option>";
						}else{
							echo "<option value='0'>----全部医生----</option>";
							foreach ($list as $map){
								echo "<option value='".$map['tbid']."'>".$map['name']."</option>";
							}
						}
						
					?>
				</select>
	</div>
</div>
	<div class="form-group">
		<div class="label">
			<label for="username">姓名</label>
		</div>
		<div class="field">
			<input type="text" class="input input-auto" name="name" size="20" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="username">地址</label>
		</div>
		<div class="field">
			<input type="text" class="input input-auto" name='addess'  size="20" />
		</div>
	</div>
	<div class="form-group">
		<div class="label">
			<label for="username">性别</label>
		</div>
		<div class="field">
			<input type="text" class="input input-auto" name='sex' size="20" />
		</div>
	</div>



	<div class="form-group">
		<div class="label">
			<label for="username">时间段</label>
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
				if (17 == $i)
				{
					echo "<option value='".$i."' selected>".$i."</option>";
				}
				else
				{
					echo "<option value='".$i."'>".$i."</option>";
				}
			}?>
			</select> ： <select name="time22" id="time22">
				<option value="0"  >00</option>
				<option value="1"  >15</option>
				<option value="2"  >30</option>
				<option value="3" selected >45</option>
			</select>

		</div>
	</div>
	
	<div class="form-group">
		<div id="slider-range" class='margin-big'></div>
	</div>


	<div class="form-group">
		<div class="label">
			<label for="username">描述</label>
		</div>
		<div class="field">
			<input type="text" class="input" name="desc" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="username">预约类型</label>
		</div>
		<div class="field">
			<select class="input" id='yuyue_type' name="yuyue_type">
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
	<div class="form-group">
		<div class="label">
			<label>已确认</label>
		</div>
		<div class="field">
			<input type='checkbox' id='confirm' class='margin-top margin-left'>
			<label class='margin-big-left'>已就诊</label>
			<input type='checkbox' id='iscome' class='margin-top margin-left'>
		</div>
	</div>
	<div class="form-group padding-big-left">
		<span class="button bg-main"  id="btn_new" style='cursor:pointer'>新建</span>
		<span class="button bg-sub margin-big-left"  style='cursor:pointer' id="btn_save" >保存</span>
	</div>
</div>

</form>
<script
	charset="utf-8" src="__PUBLIC__/kindeditor/kindeditor-min.js"></script>
<scriptcharset="utf-8" src="__PUBLIC__/kindeditor/zh_CN.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/My97DatePicker/WdatePicker.js"></script>
<script charset="utf-8" src="__PUBLIC__/js/jquery.js"></script>
<script src="__PUBLIC__/js/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
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
	
	function getQueryString(name) {
		var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
		var r = window.location.search.substr(1).match(reg);
		if (r != null)
		return unescape(r[2]);
		return null;
	}
	
	//屏蔽回车键事件
	document.onkeydown=keyDownSearch;  
    function keyDownSearch(e) {    
        // 兼容FF和IE和Opera    
        var theEvent = e || window.event;    
        var code = theEvent.keyCode || theEvent.which || theEvent.charCode;    
        if (code == 13) {              
            return false;    
        }    
        return true;    
    } 
    
     slider1 = $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 39,
      values: [ 0, 39 ],
      slide: function( event, ui ) {
        // ui.values[ 0 ]
        var time11 = Math.floor( ui.values[ 0 ]/4) + 8;
        var time12 = ui.values[0]%4;
        var time21 = Math.floor( ui.values[ 1 ]/4) + 8;
        var time22 = ui.values[1]%4;
        $("#time11").val(time11);
        $("#time12").val(time12);
        $("#time21").val(time21);
        $("#time22").val(time22);
        
      }
    });
    

    
 
    

	
	$("#cust_save").click(function(){
		var name = $("input[name='name']").val();
		var address = $("input[name='addess']").val();
		var sex = $("input[name='sex']").val();
		var tel = $("input[name='tel']").val();
		var now = $("#span_tel").attr("now");
		if(name && address && sex && tel ){
		$.ajax({
			url:'{:U("message/update_cust_mes")}',
			dataType : "json",
			type : 'get',
			data : {
				name : name,
				address:address,
				sex:sex,
				tel:tel,
				now:now
			},
			success : function(json) {
				$("#cust_save").html("完成")
			},
			error:function(e){
				$("#cust_save").html("完成")
			}
			});
			
		}else{
			alert("请填写完整信息");
		}
		
		
	})
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
	background-color: burlywood;
}
#span_tel{
	cursor:pointer;
	font-size: 25px;
	color: blue;
}
#cust_save{
	cursor:pointer;
	font-size: 20px;
	color: green;
}
.border-b{
	border-top:black 2px solid;
	border-bottom:black 2px solid;
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
	
	   $("#btn_save").click(function(){
    	//保存按钮，判断是更新还是插入
    	var id = $("#yuyueid").val();
    	if( $("#sel_doc").val() == 0 ){
    		alert("选择一个医生");
    		return;
    	}
    	if(id>0){
    		//更新
	      	$.ajax({
				url:'{:U("message/update_yuyue")}',
				dataType : "json",
				type : 'get',
				data : {
					id : id,
					weixin_id :getQueryString("weixin_id"),
					time11 : $("#time11").val(),
					time12 : $("#time12").val(),
					time21 : $("#time21").val(),
					time22 : $("#time22").val(),
					desc : $("input[name='desc']").val(),
					type : $("#yuyue_type").val(),
					order_time : $("#tm").val(),
					doctor_id  :$("#sel_doc").val(),
					answer_id : getQueryString("sid"),
					cust_id : $("#span_tel").attr("now"),
					confirm : $("#confirm")[0].checked,
					iscome : $("#iscome")[0].checked,
				},
				success : function(json) {
					query();
				},
				
				});  		
    		
    	}else{
    		//插入
    	$.ajax({
			url:'{:U("message/add_new_yuyue")}',
			dataType : "json",
			type : 'get',
			data : {
				cust_id : $("#span_tel").attr("now"),
				weixin_id :getQueryString("weixin_id"),
				time11 : $("#time11").val(),
				time12 : $("#time12").val(),
				time21 : $("#time21").val(),
				time22 : $("#time22").val(),
				desc : $("input[name='desc']").val(),
				type : $("#yuyue_type").val(),
				order_time : $("#tm").val(),
				doctor_id  :$("#sel_doc").val(),
				answer_id : getQueryString("sid"),
				confirm : $("#confirm")[0].checked,
				iscome : $("#iscome")[0].checked,
			},
			success : function(json) {
				query();
			},
			
			}); 
    	}
    	
    })
	
		$("#span_tel").click(function(){
		var tel = $("#input_tel").val();
		$.ajax({
			url:'{:U("message/get_cust_mes")}',
			dataType : "json",
			type : 'get',
			data : {
				tel : tel,
			},
			success : function(json) {
				if(json.length>0){
					$("input[name='name']").val(json[0].cust_name);
					$("input[name='addess']").val(json[0].cust_home);
					$("input[name='sex']").val(json[0].cust_sex);
					$("#span_tel").attr("now",json[0].cust_id);
					$("#cust_save").html("更新")
				}else{
					$("input[name='name']").val("请输入姓名");
					$("input[name='addess']").val("");
					$("input[name='sex']").val("");
					$("#span_tel").attr("now","");
					$("#cust_save").html("新增")
				}
			},
			
			});
	})
	
	    $("#btn_new").click(function(){
    	//新建按钮
    	$("#yuyueid").val("");
    	$("#tm").val(new Date().format("yyyy-MM-dd"))
    	$("#input_tel").val("");
    	$("input[name='name']").val("");
    	$("input[name='addess']").val("");
    	$("input[name='sex']").val("");
    	$("input[name='desc']").val("");
    	$("#answer_id").val("");	
    	$("#edit_id").val("");	
    	$("#yuyue_type").val("");
    	$("#span_tel").removeAttr("for");	
    	slider1.slider("values",[ 0, 39 ]);
    	$("#time11").val("8");
        $("#time12").val("0");
        $("#time21").val("17");
        $("#time22").val("3");
        $("#confirm")[0].checked = false;
        $("#iscome")[0].checked = false;
        query();
    	
    })
	
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
					for(var j = start*1;j<end*1;j++){
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
						$(x3[j]).html("<div type='"+v.yuyue_type+"' time='"+v.order_time2+"' for='"+v.id+"' class='bg-black div_day for_"+v.id+"'></div>");			
					}else{
						$(x3[j]).html("<div type='"+v.yuyue_type+"' time='"+v.order_time2+"' for='"+v.id+"' class='"+color[v.yuyue_type]+" div_day for_"+v.id+"'></div>");			
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
								html += "<div class='x3'><div type='"+v.yuyue_type+"' time='"+v.order_time2+"' for='"+v.id+"' class='bg-black div_day for_"+v.id+"'></div></div>";			
							}else{
								html += "<div class='x3'><div type='"+v.yuyue_type+"' time='"+v.order_time2+"' for='"+v.id+"' class='"+color[v.yuyue_type]+" div_day for_"+v.id+"'></div></div>";			
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
			var span = $(".for_"+id);
			$(".div_day").removeClass("border-b");
			$(span).addClass("border-b");
			query_duty(id);

		});
	}
	
	function query_duty(id){
		$.ajax({
			url:'{:U("message/get_duty_id")}',
				dataType : "json",
				type : 'get',
				data : {
					id : id,
				},
				success : function(json) {
					console.log(json);
					$("#yuyueid").val(json.id);
					$("#answer_id").val(json.answer_name);
					$("#edit_id").val(json.edit_name);
					$("#input_tel").val(json.cust_tel);
					$("#span_tel").trigger("click");
					$("input[name='desc']").val(json.desc);
					$("#yuyue_type").val(json.yuyue_type);
					var arry = (json.dottime).split(",");
					slider1.slider( "values", [arry[0], arry[1]]);
					$("#sel_doc").val(json.doctor_id);
					if(json.isconfirm == 1){
						$("#confirm")[0].checked = true;
					}else{
						$("#confirm")[0].checked = false;
					}
					if(json.iscome == 1){
						$("#iscome")[0].checked = true;
					}else{
						$("#iscome")[0].checked = false;
					}
					var time11 = Math.floor(arry[0]/4) + 8;
			        var time12 = arry[0]%4;
			        var time21 = Math.floor( arry[1]/4) + 8;
			        var time22 = arry[1]%4;
			        $("#time11").val(time11);
			        $("#time12").val(time12);
			        $("#time21").val(time21);
			        $("#time22").val(time22);
				},
				error : function() {
					// alert("服务器错误，请与管理员联系");
				}
		});
	}
	
	
	});


</script>
    
</body>
</html>