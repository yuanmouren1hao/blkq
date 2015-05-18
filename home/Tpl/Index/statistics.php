
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-touch-fullscreen" content="yes" />
<title>统计-1</title>
	
<script src="__PUBLIC__/lib/jquery-1.8.1.min.js"type="text/javascript" ></script>
<script src="__PUBLIC__/lib/pintuer.js"></script>
<script src="__PUBLIC__/lib/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript" ></script>
<script src="__PUBLIC__/lib/jqgrid/js/grid.locale-cn.js" type="text/javascript" ></script>
<script src="__PUBLIC__/lib/My97DatePicker/WdatePicker.js" type="text/javascript"></script>
<script src="__PUBLIC__/lib/exceljs/require.min.js" type="text/javascript" ></script>
<script src="__PUBLIC__/lib/exceljs/require.min.js" type="text/javascript" ></script>
<script src="__PUBLIC__/lib/exceljs/exceljs.js" type="text/javascript" ></script>
<script type='text/javascript' src='__PUBLIC__/lib/Highcharts-3.0.5/highcharts.js'></script>
<script type='text/javascript' src='__PUBLIC__/lib/Highcharts-3.0.5/highchartheme.js'></script>
<script type='text/javascript' src='__PUBLIC__/lib/formatnumber.js'></script>
<script src="__PUBLIC__/lib/jstime.js" type="text/javascript" ></script>


<link href="__PUBLIC__/lib/jqcss/jquery-ui-1.8.16.custom.css"  rel="stylesheet" type="text/css" media="screen"/>
<link href="__PUBLIC__/lib/jqcss/jquery-ui-1.10.0.custom.css"  rel="stylesheet" type="text/css" media="screen"/>
<link href="__PUBLIC__/lib/pintuer.css" rel="stylesheet" >
<link href="__PUBLIC__/lib/jqgrid/css/ui.jqgrid.css"  rel="stylesheet" type="text/css"/>
<link href="__PUBLIC__/lib/statistics.css" rel="stylesheet" type="text/css">	


</head>

<body>

		<div class="border border-dt">
			<label class="float-left">开始时间：</label>
			<input class="WDate input float-left cust-input" id="sdt" required="" name="sdt" onclick="WdatePicker({dateFmt:&quot;yyyy-MM-dd&quot;})">
			<label class="float-left">结束时间：</label>
			<input class="WDate input float-left cust-input" id="edt" required="" name="edt" onclick="WdatePicker({dateFmt:&quot;yyyy-MM-dd&quot;})">
			<button class="button float-left" type="submit" id="query"><span class="icon-search text-blue"></span>查询</button>
			
		</div>
		
		<table id="list"></table>
		<div id="pager"></div>
<div class="tab">
  <div class="tab-head">    
    <ul class="tab-nav">
      <li class="active"><a href="#doctorCount">医生处理统计</a></li>
      <li><a href="#answerCount">预约创建统计</a></li>
      <li><a href="#typeCount">预约类型统计</a></li>
  </ul>
  </div>
  <div class="tab-body">
    <div class="tab-panel active" id="doctorCount">
		<div id="doctorChart" style="width:800px;margin-left:auto;margin-right:auto;margin-top:30px;"></div>
	</div>
    <div class="tab-panel" id="answerCount">
		<div id="answerChart" style="width:800px;margin-left:auto;margin-right:auto;margin-top:30px;"></div>
	</div>
    <div class="tab-panel" id="typeCount">
		<div id="typeChart" style="width:800px;margin-left:auto;margin-right:auto;margin-top:30px;"></div>
	</div>
  </div>
</div>
<script>

/**
*修改说明：
*46和58行注释去了，
*47和48行conf.data改成data
*/
conf={
	data:[
			{id:"20150428001",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"123",doctor_name:"张医生",yuyue_type:"拔牙",answer_id:"1",answer_name:"张助手",comefrom:"w"},
			{id:"20150428002",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"123",doctor_name:"张医生",yuyue_type:"拔牙",answer_id:"1",answer_name:"张助手",comefrom:"x"},
			{id:"20150428003",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"456",doctor_name:"李医生",yuyue_type:"种植",answer_id:"2",answer_name:"方助手",comefrom:"x"},
			{id:"20150428004",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"456",doctor_name:"李医生",yuyue_type:"种植",answer_id:"2",answer_name:"方助手",comefrom:"x"},
			{id:"20150428005",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"456",doctor_name:"李医生",yuyue_type:"种植",answer_id:"2",answer_name:"方助手",comefrom:"w"},
			{id:"20150428006",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"456",doctor_name:"李医生",yuyue_type:"种植",answer_id:"2",answer_name:"方助手",comefrom:"w"},
			{id:"20150428007",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"789",doctor_name:"王医生",yuyue_type:"种植",answer_id:"2",answer_name:"方助手",comefrom:"w"},
			{id:"20150428008",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"789",doctor_name:"王医生",yuyue_type:"种植",answer_id:"2",answer_name:"方助手",comefrom:"w"},
			{id:"20150428009",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"789",doctor_name:"王医生",yuyue_type:"种植",answer_id:"2",answer_name:"方助手",comefrom:"w"},
			{id:"20150428010",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"789",doctor_name:"王医生",yuyue_type:"洗牙",answer_id:"111",answer_name:"刘助手",comefrom:"w"},
			{id:"20150428011",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"789",doctor_name:"王医生",yuyue_type:"洗牙",answer_id:"111",answer_name:"刘助手",comefrom:"x"},
			{id:"20150428012",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"789",doctor_name:"王医生",yuyue_type:"洗牙",answer_id:"111",answer_name:"刘助手",comefrom:"w"},
			{id:"20150428013",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"789",doctor_name:"王医生",yuyue_type:"洗牙",answer_id:"111",answer_name:"刘助手",comefrom:"w"},
			{id:"20150428014",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"123",doctor_name:"张医生",yuyue_type:"洗牙",answer_id:"111",answer_name:"刘助手",comefrom:"w"},
			{id:"20150428015",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"123",doctor_name:"张医生",yuyue_type:"矫正",answer_id:"111",answer_name:"刘助手",comefrom:"x"},
			{id:"20150428016",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"123",doctor_name:"张医生",yuyue_type:"矫正",answer_id:"111",answer_name:"刘助手",comefrom:"w"},
			{id:"20150428017",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"123",doctor_name:"张医生",yuyue_type:"矫正",answer_id:"1",answer_name:"张助手",comefrom:"w"},
		]
}

/**
*程序入口
*/
$(function(){
	initilization();
	$("#query").click();
});
/**
*初始化按钮
*/
function initilization(){
	$("#sdt")[0].value = (new Date().DateAdd('m', - 1)).Format("yyyy-MM-dd");
	$("#edt")[0].value = (new Date()).Format("yyyy-MM-dd");	
	$("#export").click(function(){
		grid2excel("list","");
	});	
	$("#query").click(function(){
		var sdt = $("#sdt")[0].value ;
		var edt =  $("#edt")[0].value;	
		$.getJSON('{:U("index/order_tongji")}',{sdt:sdt,edt:edt},function(data){
			getGrid(data);               
			var r= filterChart(data);	  
			getDocChart(sdt,edt,r[0]);
			getAnswerChart(sdt,edt,r[1]);
			getTypeChart(sdt,edt,r[2]);
			$("tspan").each(function(){
				if($(this).html()=="Highcharts.com"){
					$(this).html("");
				}
			});
		});		
	});
}
/**
*统计，表格
*/
function getGrid(mydata){
	jQuery("#list").jqGrid({
		datatype: "local",
		colNames:['预约号','病人编号', '病人名字', '预约时间','病情描述','医生编号','医生名称','预约类型','创建预约的助手id',
		'创建人员名字','类型'],
		colModel:[
			{name:'id',index:'id', width:120,fixed:true},
			{name:'cust_id',index:'cust_id', width:60,hidden:true,fixed:true},
			{name:'cust_name',index:'cust_name', width:100,align:"center",fixed:true},
			{name:'order_time',index:'order_time', width:150,align:"center",fixed:true},
			{name:'desc',index:'desc',},		
			{name:'doctor_id',index:'doctor_id', width:80,hidden:true},		
			{name:'doctor_name',index:'doctor_name', width:100,fixed:true,align:"center"},
			{name:'yuyue_type',index:'yuyue_type', width:100,fixed:true,align:"center"},
			{name:'answer_id',index:'answer_id', width:80, align:"right",sorttype:"float",hidden:true},
			{name:'answer_name',index:'answer_name', width:80,align:"center",fixed:true},		
			{name:'comefrom',index:'comefrom', width:80,align:"center",fixed:true,formatter:function(a,b,c){
				if(a=="w"){
					return "网上预约";
				}else{
					return "电话预约";
				}
			}}
		],
		recordpos: 'left',
	    viewrecords: true,
		caption: "Multi Select Example",
		sortorder: "desc",
	   	rowNum:10,
		rowList:[10,20,30],
		rownumbers: true,
		pager: '#pager',
		pgbuttons: true, // 分页按钮是否显示 
		pginput: true, // 是否允许输入分页页数 
		caption: ""
	});
	jQuery("#list")[0].p.data = [];
	jQuery("#list").trigger("reloadGrid");
	for(var i=0;i<=mydata.length;i++)
		jQuery("#list").jqGrid('addRowData',i+1,mydata[i]);
	jQuery("#list").setGridParam({page:1}).trigger("reloadGrid");	
	$("#list").setGridWidth(document.body.scrollWidth-25);
	$("#list").setGridHeight(230);
}
/**
*医生统计，饼状图
*/
function getDocChart(sdt,edt,data){
    $("#doctorChart").html("");
    chart = new Highcharts.Chart({
        chart: {
            renderTo: "doctorChart",
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: sdt.substr(0,13)+" 至 "+edt.substr(0,13)+"， 医生预约次数统计"
        },
        tooltip: {
            pointFormat: "{series.name}: <b>{point.percentage}%</b>",
            percentageDecimals: 1
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: "pointer",
                dataLabels: {
                    enabled: true,
                    color: "#000000",
                    connectorColor: "#000000",
                    formatter: function() {
                        return "<b>" + this.point.name + "</b>: " + formatNumber(this.percentage, "##.#") + " %</b>:（" + this.y+"次）"
                    }
                }
            }
        },
        series: [{
            type: "pie",
            name: "",
            data: data
        }]
    })
}

/**
*助手统计，饼状图
*/
function getAnswerChart(sdt,edt,data){
    $("#answerChart").html("");
    chart = new Highcharts.Chart({
        chart: {
            renderTo: "answerChart",
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: sdt.substr(0,13)+" 至 "+edt.substr(0,13)+"， 助手预约次数统计"
        },
        tooltip: {
            pointFormat: "{series.name}: <b>{point.percentage}%</b>",
            percentageDecimals: 1
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: "pointer",
                dataLabels: {
                    enabled: true,
                    color: "#000000",
                    connectorColor: "#000000",
                    formatter: function() {
                        return "<b>" + this.point.name + "</b>: " + formatNumber(this.percentage, "##.#") + " %</b>:（" + this.y+"次）"
                    }
                }
            }
        },
        series: [{
            type: "pie",
            name: "",
            data: data
        }]
    })
}

/**
*类型统计，饼状图
*/
function getTypeChart(sdt,edt,data){
    $("#typeChart").html("");
    chart = new Highcharts.Chart({
        chart: {
            renderTo: "typeChart",
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: sdt.substr(0,13)+" 至 "+edt.substr(0,13)+"， 预约类型统计",
        },
        tooltip: {
            pointFormat: "{series.name}: <b>{point.percentage}%</b>",
            percentageDecimals: 1
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: "pointer",
                dataLabels: {
                    enabled: true,
                    color: "#000000",
                    connectorColor: "#000000",
                    formatter: function() {
                        return "<b>" + this.point.name + "</b>: " + formatNumber(this.percentage, "##.#") + " %</b>:（" + this.y+"次）"
                    }
                }
            }
        },
        series: [{
            type: "pie",
            name: "",
            data: data
        }]
    })
}
/**
* 过滤统计图数据
*/
function filterChart(data){
	var yuyue_type_Array = {
		name:[],
		count:[],
	};
	var doctor_id_Array = {
		id:[],
		name:[],
		count:[],
	};
	var answer_id_Array = {
		id:[],
		name:[],
		count:[],
	};
	$.each(data,function(i,v){
		yuyue_type_Str = "";
		doctor_id_Str = "";
		answer_id_Str = "";
		for(var j =0; j<yuyue_type_Array.name.length;j++){
			yuyue_type_Str += "<<" + yuyue_type_Array.name[j] + ">>";			
		}
		for(var j =0; j<doctor_id_Array.id.length;j++){
			doctor_id_Str += "<<" + doctor_id_Array.id[j] + ">>";			
		}
		for(var j =0; j<answer_id_Array.id.length;j++){
			answer_id_Str += "<<" + answer_id_Array.id[j] + ">>";			
		}
		
		
		if(yuyue_type_Str.indexOf("<<"+v.yuyue_type+">>")<0){
			yuyue_type_Array.name.push(v.yuyue_type);
		}
		if(doctor_id_Str.indexOf("<<"+v.doctor_id+">>")<0){
			doctor_id_Array.id.push(v.doctor_id);
			doctor_id_Array.name.push(v.doctor_name);
		}
		if(answer_id_Str.indexOf("<<"+v.answer_id+">>")<0){
			answer_id_Array.id.push(v.answer_id);
			answer_id_Array.name.push(v.answer_name);
		}
	});
	$.each(yuyue_type_Array.name,function(i,v1){
		var count = 0;
		$.each(data,function(j,v2){
			if(v1==v2.yuyue_type){
				count+=1;
			}
		});
		yuyue_type_Array.count.push(count);
	});
	$.each(doctor_id_Array.id,function(i,v1){
		var count = 0;
		$.each(data,function(j,v2){
			if(v1==v2.doctor_id){
				count+=1;
			}
		});
		doctor_id_Array.count.push(count);
	});
	$.each(answer_id_Array.id,function(i,v1){
		var count = 0;
		$.each(data,function(j,v2){
			if(v1==v2.answer_id){
				count+=1;
			}
		});
		answer_id_Array.count.push(count);
	});	
	var r1 = [];
	console.log(doctor_id_Array);
	$.each(doctor_id_Array.name,function(i,v1){
		var s = {
			"y":doctor_id_Array.count[i],
			"name":doctor_id_Array.name[i]
		};
		r1.push(s);
	});
	var r2 = [];
	$.each(answer_id_Array.name,function(i,v1){
		var s = {
			"y":answer_id_Array.count[i],
			"name":answer_id_Array.name[i]
		};
		r2.push(s);
	});
	var r3 = [];
	$.each(yuyue_type_Array.name,function(i,v1){
		var s = {
			"y":yuyue_type_Array.count[i],
			"name":yuyue_type_Array.name[i]
		};
		r3.push(s);
	});
	var r= [r1,r2,r3]
	return r;
}
</script>

</body>
</html>