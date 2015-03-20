jQuery.bindModel = function(dom, model) {
	if (model) {
		var html = dom.innerHTML;
		for ( var p in model) {
			if (!(typeof (model[p]) == "function")) {
				eval("var re=/{" + p + "}/g;");
				html = html.replace(re, model[p]);
			}
		}
		dom.innerHTML = html;
//		$.each($("input[type=radio]"), function(a, b) {
		$.each($(dom).find("input[type=radio]"), function(a, b) {
			b.checked = b.value == b.title;
		});
//		$.each($("input[type=checkbox]"), function(a, b) {
		$.each($(dom).find("input[type=checkbox]"), function(a, b) {
			b.checked = b.title.indexOf(b.value) > -1;
		});
//		$.each($("select"), function(a, b) {			
		$.each($(dom).find("select"), function(a, b) {
			for (var i=0;i<b.options.length;i++)
			{
				if(b.options.item(i).value.indexOf(b.title) > -1 && b.options.item(i).value.length == b.title.length)
				{
					b.selectedIndex = i;break;
				}
			}
		});
		$.each($("WDate"), function(a, b) {			
			
		});
	} else {
		//$.each($("input"), function(a, b) { //mcg 2013-03-09,引起整个网页的input都变空，修改后可以只针对dom里面的input元素
		$.each($(dom, "input"), function(a, b) {
			if (b.type == "text")
				b.value = "";
			else
				b.checked = false;
		});
	}
	$.clearnull(dom);
};

jQuery.clearnull = function(dom) {
  	var html = dom.innerHTML;
//    $.each($("input"), function (a, b) {
  	$.each($(dom).find("input"), function(a, b) {
        if ((b.type == "text" || b.type == "hidden") && b.value == "null")
            b.value = "";

        if ((b.type == "text" || b.type == "hidden") && b.value.substr(b.value.length - 1, 1) == "}" && b.value.substr(0, 1) == "{")
            b.value = "";
        
        if ((b.type == "text" || b.type == "hidden") && b.value.substr(0,10) == "1900-01-01" )
            b.value = "";
    });
  	//修改页面值属性
    $(dom).find("input[value]").each(function(){
    	$(this).attr('value',$(this).val());
    });
//	$.each($(dom,"textarea"), function(a, b) {
    $.each($(dom).find("textarea"), function(a, b) {
        if (b.innerHTML.substr(b.value.length - 1, 1) == "}" && b.innerHTML.substr(0, 1) == "{")
            b.innerHTML = "";
        if (b.innerHTML=="null")
            b.innerHTML = "";
	});
};

String.prototype.format = function(args) {
	if (arguments.length > 0) {
		var result = this;
		if (arguments.length == 1 && typeof (args) == "object") {
			for ( var key in args) {
				var reg = new RegExp("({" + key + "})", "g");
				result = result.replace(reg, args[key]);
			}
		} else {
			for ( var i = 0; i < arguments.length; i++) {
				if (arguments[i] == undefined)
					arguments[i]=" ";
				if (arguments[i] == undefined) {
					return "";
				} else {
					var reg = new RegExp("({[" + i + "]})", "g");
					result = result.replace(reg, arguments[i]);
				}
			}
		}
		return result;
	} else {
		return this;
	}
};
// 对Date的扩展，将 Date 转化为指定格式的String
// 月(M)、日(d)、小时(h)、分(m)、秒(s)、季度(q) 可以用 1-2 个占位符， 
// 年(y)可以用 1-4 个占位符，毫秒(S)只能用 1 个占位符(是 1-3 位的数字) 
// 例子： 
// (new Date()).Format("yyyy-MM-dd hh:mm:ss.S") ==> 2006-07-02 08:09:04.423 
// (new Date()).Format("yyyy-M-d h:m:s.S")      ==> 2006-7-2 8:9:4.18 
Date.prototype.format = function (fmt) { //author: meizz 
    var o = {
        "M+": this.getMonth() + 1, //月份 
        "d+": this.getDate(), //日 
        "h+": this.getHours(), //小时 
        "m+": this.getMinutes(), //分 
        "s+": this.getSeconds(), //秒 
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
        "S": this.getMilliseconds() //毫秒 
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
    if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
};
Date.prototype.addDay=function(days){
	this.setDate(this.getDate() + days);
	return this;
};
Date.prototype.addHour=function(hours){
	this.setHours(this.getHours() + hours);
	return this;
};

(function($){
	$.fn.getParams = $.fn.getUrlVars = function(name){
		return (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search) || [, null])[1];
	};
})(jQuery);





