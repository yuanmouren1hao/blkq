//微信水情雨情-实时雨情  creat by fanghaojie 2015-02-03
$(function(){
	//初始化日期控件    
	var opt = {        
			preset: 'date', //日期       
			//theme: '', //皮肤样式        
			display: 'modal', //显示方式        
			showNow:true,
			mode: 'clickpick', //日期选择模式       
			dateFormat: 'yy-mm-dd', // 日期格式        
			setText: '确定', //确认按钮名称        
			cancelText: '取消',//取消按钮名籍我        
			dateOrder: 'yymmdd', //面板中日期排列格式      
			dayText: '日', 
			monthText: '月', 
			yearText: '年', //面板中年月日文字       
			hourText: "时",
			minuteText: "分",
			nowText:"现在",
			timeFormat:"HH:ii",
			timeWheels:"HH:ii",
			endYear:2222 //结束年份    };        
	}
	$("#tm").mobiscroll(opt);
	$("#tm").val(new Date().format('yyyy-MM-dd'));
});



