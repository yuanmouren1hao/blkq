/**
*修改说明：
*46和58行注释去了，
*47和48行conf.data改成data
*/
conf={
	data:[
			{idd:"20150428001",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"123",doctor_name:"张医生",yuyue_type:"拔牙",answer_id:"1",answer_name:"张助手",comefrom:"w"},
			{idd:"20150428002",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"123",doctor_name:"张医生",yuyue_type:"拔牙",answer_id:"1",answer_name:"张助手",comefrom:"x"},
			{idd:"20150428003",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"456",doctor_name:"李医生",yuyue_type:"种植",answer_id:"2",answer_name:"方助手",comefrom:"x"},
			{idd:"20150428004",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"456",doctor_name:"李医生",yuyue_type:"种植",answer_id:"2",answer_name:"方助手",comefrom:"x"},
			{idd:"20150428005",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"456",doctor_name:"李医生",yuyue_type:"种植",answer_id:"2",answer_name:"方助手",comefrom:"w"},
			{idd:"20150428006",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"456",doctor_name:"李医生",yuyue_type:"种植",answer_id:"2",answer_name:"方助手",comefrom:"w"},
			{idd:"20150428007",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"789",doctor_name:"王医生",yuyue_type:"种植",answer_id:"2",answer_name:"方助手",comefrom:"w"},
			{idd:"20150428008",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"789",doctor_name:"王医生",yuyue_type:"种植",answer_id:"2",answer_name:"方助手",comefrom:"w"},
			{idd:"20150428009",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"789",doctor_name:"王医生",yuyue_type:"种植",answer_id:"2",answer_name:"方助手",comefrom:"w"},
			{idd:"20150428010",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"789",doctor_name:"王医生",yuyue_type:"洗牙",answer_id:"111",answer_name:"刘助手",comefrom:"w"},
			{idd:"20150428011",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"789",doctor_name:"王医生",yuyue_type:"洗牙",answer_id:"111",answer_name:"刘助手",comefrom:"x"},
			{idd:"20150428012",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"789",doctor_name:"王医生",yuyue_type:"洗牙",answer_id:"111",answer_name:"刘助手",comefrom:"w"},
			{idd:"20150428013",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"789",doctor_name:"王医生",yuyue_type:"洗牙",answer_id:"111",answer_name:"刘助手",comefrom:"w"},
			{idd:"20150428014",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"123",doctor_name:"张医生",yuyue_type:"洗牙",answer_id:"111",answer_name:"刘助手",comefrom:"w"},
			{idd:"20150428015",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"123",doctor_name:"张医生",yuyue_type:"矫正",answer_id:"111",answer_name:"刘助手",comefrom:"x"},
			{idd:"20150428016",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"123",doctor_name:"张医生",yuyue_type:"矫正",answer_id:"111",answer_name:"刘助手",comefrom:"w"},
			{idd:"20150428017",cust_id:"123",cust_name:"方浩",order_time:"2015-04-28 09:00",desc:"牙疼要拔",doctor_id:"123",doctor_name:"张医生",yuyue_type:"矫正",answer_id:"1",answer_name:"张助手",comefrom:"w"},
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
		//$.getJSON('',{sdt:sdt,edt:edt,name:name},function(data){
			getGrid(conf.data);               // conf.data--->data
			var r= filterChart(conf.data);	  // conf.data--->data
			getDocChart(sdt,edt,r[0]);
			getAnswerChart(sdt,edt,r[1]);
			getTypeChart(sdt,edt,r[2]);
			$("tspan").each(function(){
				if($(this).html()=="Highcharts.com"){
					$(this).html("");
				}
			});
		//});		
	});
}
/**
*统计，表格
*/
function getGrid(mydata){
	jQuery("#list").jqGrid({
		datatype: "local",
		colNames:['预约号','病人编号', '病人名字', '预约时间','病情描述','医生编号','医生名称','预约类型','创建预约的助手id',
		'助手名字','类型'],
		colModel:[
			{name:'idd',index:'idd', width:120,fixed:true},
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