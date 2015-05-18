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
		<div class='line margin-big-top'>
			<div class='xb12 xm12'>
				<table class="table table-bordered" id="table">
				  <tr><th><p class='text-center'>一</p></th><th><p class='text-center'>二</p></th><th><p class='text-center'>三</p></th><th><p class='text-center'>四</p></th><th><p class='text-center'>五</p></th><th><p class='text-center'>六</p></th><th><p class='text-center'>日</p></th></tr>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
<style>
.panel-body {
	padding: 0px 15px;
}
</style>
<script>
(function(){
	query();
	$("#btn_query").click(function(){
		query();
	});
	function query(){
		$(".cal_tr").remove();
		var year = $("#sel_year").val();
		var month = $("#sel_month").val();
		var length = DayNumOfMonth(year,month);
		//获取初始日期
		var weekday = getWeekDay(month,1,year);	
		if(weekday == 0 ){weekday = 7}	
		var date1=new Date("2015-01-01");
        var date2=new Date(year+"-"+month+"-"+"1");
        var leng=Math.floor((date2.getTime()-date1.getTime())/(24*3600*1000));
        now = Math.floor((new Date().getTime()-date1.getTime())/(24*3600*1000));
		$.ajax({
			url:'{:U('index/get_one_zbap')}',
			dataType : "json",
			type : 'get',
			data : {
				stid : getQueryString("stid"),
				start : leng,
				end : (length*1+leng*1),
			},
			success : function(json) {
				for(var i=0; i<=5 ; i++){
					var _html = "<tr class='cal_tr'>";
					for(var j=0;j<7;j++){
						var day = i*7+j+2-weekday;
						var bak_day = (day>0 && day<=length)?day:"";
						if(bak_day!=""){
							 var di = (now > (leng+bak_day-1))?"disabled='disabled'":"";
							 var bg = (now == (leng+bak_day))?"bg-sub":"";
							_html += "<td class='tr_check' id='tr_"+(leng+bak_day-1)+"'><div class='panel border-sub '><div class='panel-head  "+bg+"'>"+bak_day+"</div><div class='panel-body'><input "+di+" days= '"+(leng+bak_day-1)+"' ap='moring' id='check_"+(leng+bak_day-1)+"_am' class='margin-left' type='checkbox'><strong class='margin-big-left'>上午</strong></br><input days= '"+(leng+bak_day-1)+"' ap='afternoon' "+di+" id='check_"+(leng+bak_day-1)+"_pm' class='margin-left' type='checkbox'><strong class='margin-big-left'>下午</strong></div></div></td>";
						}else{
							_html +="<td></td>";
						}						
					}
					_html += "</tr>";
					$("#table").append(_html);	
				}			
				$.each(json,function(i,v){
					if(v.moring == 1){
						$("#check_"+v.days+"_am")[0].checked = true;
					}
					if(v.afternoon == 1){
						$("#check_"+v.days+"_pm")[0].checked = true;
					}
				});		
				$("input[type='checkbox']").click(function(){
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
			var days = $(v).attr("days");
			var type = $(v).attr("ap");			
			$.ajax({
			url:'{:U('index/updata_one_zbap')}',
			dataType : "json",
			type : 'get',
			data : {
				days:days,
				type:type,
				isDuty:isDuty,
				stid:getQueryString("stid"),
				sid : getQueryString("sid"),
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
	   var weekDay;
	   today = new Date();
	   year = year || today.getFullYear();
	   today.setFullYear(year,month-1,day);
	   weekDay = today.getDay();
	   return weekDay;
	}
})()
</script>