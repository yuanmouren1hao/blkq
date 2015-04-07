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
$(function() {
	var weixin_id = getQueryString("weixin_id");
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
	endYear : 2222
	// 结束年份 };
	}
	var JSON = null;
	$("#tm").mobiscroll(opt);
	$("#tm").val(new Date().format('yyyy-MM-dd'));
	    query();
	$(".div_day").css("height", $(".div_day").css("width"));
	$("#btn_query").click(function() {
	query();
	});
	function query() {
	$("#div_list").html("");
	var time = $("#tm").val();
	$.ajax({
	//url : 'http://localhost/blkq/wap.php/index-get_order_info.html',
	//url : 'http://www.blkqyy.com/wap.php/index-get_order_info.html',
	url:'{:U("index/get_order_info")}',
	dataType : "json",
	type : 'get',
	data : {
	weixin_id : weixin_id,
	datetime : time,
	},
	success : function(json) {
	JSON = json.msg;
	if(JSON.msg != "no order"){
	print(json.msg);
	$(".div_day").css("height",$(".div_day").css("width"));
	}
	},
	error : function() {
	// alert("服务器错误，请与管理员联系");
	}
	});
	}
	   
	$(".div_day").css("height", $(".div_day").css("width"));
	function getQueryString(name) {
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	var r = window.location.search.substr(1).match(reg);
	if (r != null)
	return unescape(r[2]);
	return null;
	}
	function print(json) {
	var color = [ "bg-main", "bg-sub", "bg-dot", "bg-black", "bg-gray",
	"bg-red", "bg-yellow", "bg-blue", "bg-green" ];
	var _html1;
	var doc_name = "";
	var _count = 0;
	var _docname = [];
	$.each(json, function(i, v) {
	if(!v.dottime){return true;}
	var _name = v.doctor_name;
	var _margin;
	var _html1 = "";
	if (_name == doc_name) {
	_margin = "";
	_count++;
	if (count > 8) {
	_count = 0;
	}
	} else {
	count = 0;
	_margin = "margin-top";
	_docname.push(v.doctor_id);
	_html1 += "<hr class='bg-green' />";
	}
	_html1 += "<div id='doc_" + i + "'  class='line " + _margin
	+ "' class='doc_" + v.doctor_id
	+ "'><div class='xl12 xs12'><div class='xl2 xs2'>"
	+ (_name == doc_name ? "" : v.doctor_name) + "</div>";
	var k = 0;
	for (var j = 0; j < 10; j++) {
	var border = (j == 9) ? "" : "border-sub border-right";
	var _html = "<div class='xl1 xs1 " + border
	+ "'><div class='xl3 xs3' id='" + i + "_" + k
	+ "'></div><div class='xl3 xs3' id='" + i + "_"
	+ (k + 1) + "'></div>" + "<div class='xl3 xs3' id='"
	+ i + "_" + (k + 2)
	+ "'></div><div class='xl3 xs3' id='" + i + "_"
	+ (k + 3) + "'></div></div>";
	_html1 = _html1 + _html;
	k = k + 4;
	}
	_html1 = _html1 + "</div></div>";
	$("#div_list").append(_html1);
	var strs = v.dottime.split(",");
	var begin = strs[0], end = strs[1];
	// 获取全部时间信息
	var xlxs = $("#doc_" + i).find(".xl3.xs3");
	for (var l = 0; l < xlxs.length; l++) {
	if (begin <= l && l < end) {
	$($("#doc_" + i).find(".xl3.xs3")[l]).append(
	"<div class='div_day listid " + color[_count]
	+ "' listid='" + v.id + "'></div>");
	} else {
	$($("#doc_" + i).find(".xl3.xs3")[l]).append(
	"<div class='div_day'></div>");
	}
	}
	doc_name = v.doctor_name;
	});
	$(".listid").unbind();
	$(".listid").click(function(i, v) {
	// yy_id
	$(".dialog-body").html("");
	var listid = $(this).attr("listid");
	$.each(json,function(j,k){
	if(k.id == listid){
	var start = k.dottime.split(",")[0];
	var end = k.dottime.split(",")[1];
	console.log(start);
	console.log(end);
	                    var _html = "<table class='table'><tr><td>预约号</td><td>"+k.id+"</td></tr><tr><td>姓名</td><td>"+k.name+"</td></tr>" +
	                    "<tr><td>预约时间</td><td>"+k.order_time2+"</td></tr><tr><td>预约类型</td><td>"+k.yuyue_type+"</td></tr></table>";
	                    $(".dialog-body").html(_html);
	}
	});

	$("#btn_mydialog").trigger("click");
	});
	}
	});


</script>
<style>
.div_day {
	width: 100%;
}
</style>

</head>
<body>
	<div class="container">
		<div class='line margin-top'>
			<div class="xl6 xl1-move xs4 xs3-move">
				<input id='tm' />
			</div>
			<div class="xl4 xl1-move xs4">
				<button class="button bg-main button-small" id="btn_query">查询</button>
			</div>
		</div>
		<div class="line margin-top">
			<div class="xl12 xs12 ">
				<div class='xl1 xs1'></div>
				<div class='xl1 xs1'>
					<div class='xl1 xl11-move xs1 xs11-move'>8</div>
				</div>
				<div class='xl1 xl1'></div>
				<div class='xl1 xs1'>
					<div class='xl1 xl9-move xs1 xs10-move'>10</div>
				</div>
				<div class='xl1 xs1'></div>
				<div class='xl1 xs1'>
					<div class='xl1 xl9-move xs1 xs10-move'>12</div>
				</div>
				<div class='xl1 xs1'></div>
				<div class='xl1 xs1'>
					<div class='xl1 xl9-move xs1 xs10-move'>14</div>
				</div>
				<div class='xl1 xs1'></div>
				<div class='xl1 xs1'>
					<div class='xl1 xl9-move xs1 xs10-move'>16</div>
				</div>
				<div class='xl1 xs1'></div>
				<div class='xl1 xs1'></div>
			</div>
		</div>
		<div id='div_list'></div>
		<button class="button button-big bg-main dialogs" data-toggle="click"
			data-target="#mydialog" id='btn_mydialog' data-mask="1"
			data-width="80%" style='display: none'></button>
		<div id="mydialog">
			<div class="dialog">
				<div class="dialog-head">
					<span class="close rotate-hover"></span> <strong>详细信息</strong>
				</div>
				<div class="dialog-body"></div>
				<div class="dialog-foot">
					<button class="button dialog-close">确认</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>


