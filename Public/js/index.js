/*author fanghaojie 20140911*/
$(function(){
	isHOVER = null;
	isDIVHOVER = false;

    $("#div_li").find("div").mousemove(function(e){
   	     $(this).find("i").css("color",'white');   
         isHOVER = $(this).attr("id").replace("h_","");
    	 $(this).css("background","RGB(149,149,147)");
    	 $(this).find('font').css("color",'white');
    	 $("#"+isHOVER).css("display",'block');
    }).mouseout(function(e){   	  
    	 var me = this;
    	 var isHOVER = $(this).attr("id").replace("h_","");
    	 $(this).css("background","white");
    	 $(this).find("i").css("color",'RGB(149,149,147)');   
    	 $(this).find('font').css("color",'RGB(149,149,147)');
    	 $("#"+isHOVER).unbind();
    	 $("#"+isHOVER).mousemove(function(e){
    		$("#"+isHOVER).css("display",'block');
    	    $("#h_"+isHOVER).css("background","RGB(149,149,147)");
    	    $("#h_"+isHOVER).find("font").css("color",'white');
    	    $("#h_"+isHOVER).find("i").css("color",'white');   	
    	 }).mouseout(function(e){
    		 $("#"+isHOVER).css("display",'none') ;
        	 $(me).css("background","white");
        	 $(me).find('font').css("color",'RGB(149,149,147)');
        	 $("#h_"+isHOVER).find("i").css("color",'RGB(149,149,147)'); 
    	 }); 	    	 
    	 $("#"+isHOVER).css("display",'none');
    });
    
});