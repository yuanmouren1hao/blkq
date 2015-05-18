<!DOCTYPE html>
<html lang="zh-cn">
<head>
<title>值班安排</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="__PUBLIC__/pintuer/pintuer.css">
<link rel="stylesheet" href="__PUBLIC__/css/iconfont.css">

<script src="__PUBLIC__/js/jquery.js"></script>
<script src="__PUBLIC__/pintuer/jquery.js"></script>
<script src="__PUBLIC__/pintuer/pintuer.js"></script>
</head>
<body>
	<div class="container">
		<div class='line margin-big-top'>
		   <div class='xb12 xm12'>
            	<div class="alert alert-blue"><span class="close rotate-hover"></span><strong>提示：</strong><span class='icon-check-square-o'></span> 表示该天<span class='text-red'> 休息</span>，
            	<span class='icon-square-o'></span> 表示该天<span class='text-red'> 上班</span>。</div>
           </div>
		</div>
		<div class='line margin-top'>
            <div class='xb12 xm12'>
            	<div class='xb4 xm4'>
            	   <select id='sel_year' class='margin-right'>
            	   <?php
            	      for($i = 2015;$i<=2020;$i++){
            	      	echo "<option value='".$i."'>".$i."</option>";
            	      }
            	   ?>
            	   </select>年
            	   <select id='sel_month' class='margin-left margin-right'>
            	   <?php
            	      
            	   	  for($i = 1;$i<=12;$i++){
            	   	  	if(date('m') == $i){
            	   	  		echo "<option selected value='".$i."'>".$i."</option>";
            	   	  	}else{
            	   	  		echo "<option value='".$i."'>".$i."</option>";
            	   	  	}   	  	
            	   	  }
            	   	  
            	   ?>
            	   </select>月
            	   <button class="button button-small bg-sub margin-big-left" id="btn_query"><span class='icon-search'></span> 查询</button>            	   
            	</div>           	
            </div>

		</div>
		<div class='line margin-top' style='margin-left:0px;margin-right:0px'>
			<table class="table table-condensed table-bordered text-center" id='table_zb'>
							
			</table>
		</div>
	</div>
</body>
</html>
<script>
(function(){
	query();
	$("#btn_query").click(function(){
		query();
	});
	function query(){
		$("#table_zb").html("<caption align='top'><strong style='font-size: 20px'>医生值班表</strong></caption>");
		//加载日期，星期
		var year = $("#sel_year").val();
		var month = $("#sel_month").val();
		var length = DayNumOfMonth(year,month);
		var html1 = "<tr><td></td>";
		var html2 = "<tr><td></td>";
		for(var i=1;i<=length;i++){
			html1 += "<td>"+i+"</td>";
			html2 += "<td>"+getWeekDay(month,i,year)+"</td>";
		}        
		$("#table_zb").append(html1+"</tr>"+html2+"</tr>");

		$.ajax({
			url:'{:U("index/get_zbap_data")}',
			dataType : "json",
			type : 'get',
			data : {
				year : year,
				month : month,
			},
			success : function(json) {
                //加载表格
                var date1=new Date("2015-01-01");
                var date2=new Date(year+"-"+month+"-"+"1");
                var days=Math.floor((date2.getTime()-date1.getTime())/(24*3600*1000));
             	var now = Math.floor((new Date().getTime()-date2.getTime())/(24*3600*1000));
                $.each(json,function(i,v){
                	var _html = "<tr><td><a href='{:U("index/zbap_detail")}?stid="+v.tbid+"&sid="+getQueryString("sid")+"'>"+v.name+"</a></td>";
                	for(var j=0;j<length;j++){
                	 var di = (now >= j)?"disabled='disabled'":"";
                		if(v[(days+j)]){
                		    var ch = v[(days+j)]==1?"checked":"";
                			_html += "<td><label><input "+di+" class='check_duty' days='"+(days+j)+"' name='"+v.tbid+"' type='checkbox' "+ch+"></label></td>";
                		}else{
                			_html += "<td><label><input "+di+" class='check_duty' days='"+(days+j)+"' name='"+v.tbid+"' type='checkbox'></label></td>";
                		}
                		
                	
                	}
                	$("#table_zb").append(_html+"</tr>");               		
                });
                $(".check_duty").click(function(){
                	save(this);
                });
			},
			error : function() {
				
			}
		});
	
		
	}
	function save(v){
			var isDuty = v.checked;
			//将数据保存至数据库
			var id = $(v).attr("days");
			var name = $(v).attr("name");			
			$.ajax({
			url:'{:U('index/updata_zbap_data')}',
			dataType : "json",
			type : 'get',
			data : {
				id:id,
				name:name,
				isDuty:isDuty,
				sid:getQueryString("sid"),
			},
			success : function(json) {},
			error : function() {
				
			}
		});
	}
	function getQueryString(name) {
	    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	    var r = window.location.search.substr(1).match(reg);
	    if (r != null) return unescape(r[2]); return null;
    }
	function DayNumOfMonth(Year,Month){
      return 32-new Date(Year,Month-1,32).getDate();
    }
    function getWeekDay(month,day,year){
	   var arr = ["日","一","二","三","四","五","六"],weekDay;
	   today = new Date();
	   year = year || today.getFullYear();
	   today.setFullYear(year,month-1,day);
	   weekDay = today.getDay();
	   return arr[weekDay];
	}
})()
</script>