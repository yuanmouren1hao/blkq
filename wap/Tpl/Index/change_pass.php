<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/mobile_module.css" media="all">
    <script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
    <script type="text/javascript" src="__PUBLIC__/js/dialog.js"></script>
	<title>修改密码</title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta content="application/xhtml+xml;charset=UTF-8" http-equiv="Content-Type">
    <meta content="no-cache,must-revalidate" http-equiv="Cache-Control">
    <meta content="no-cache" http-equiv="pragma">
    <meta content="0" http-equiv="expires">
    <meta content="telephone=no, address=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
</head>

<body>
	<div class="container body">
    	
    	<div class="p_10"> 
            <!-- 表单 -->
            <form method="post">
            <input type="hidden" name="tag" value="tag" />
            
              <!-- 基础文档模型 -->
              <div id="tab1" class="tab-pane">
                   <div class="form-item cf">
                        <label class="item-label">原密码</label>
                        <div class="controls">
                          <input type="password" class="text input-large" name="old_pass" id="old_pass">
                      	</div>
                   </div>
                   
                   <div class="form-item cf">
                        <label class="item-label">新密码</label>
                        <div class="controls">
                          <input type="password" class="text input-large" name="new_pass" id="new_pass">
                      	</div>
                   </div>
                   <div class="form-item cf">
                        <label class="item-label">确认密码</label>
                        <div class="controls">
                          <input type="password" class="text input-large" name="new_pass1" id="new_pass1">
                      	</div>
                   </div>
                                 
                   <div class="form-item cf tb pt_10">
                		<button class="home_btn submit-btn mb_10 flex_1" id="submit" type="submit" target-form="form-horizontal">提  交</button>
                  </div>
          	</div>
            </form>
        </div>
        <p class="copyright"><?php echo mc_option("copyright")?></p>
        <script type="text/javascript">
			$('.submit-btn').click(function(){
				//$.Dialog.loading();//loading等待调用  loading完成$.Dialog.close();关闭loading
				//$.Dialog.success();//成功调用 提示一秒后自动关闭
				if($('#old_pass').val()!=undefined && $('#old_pass').val()==""){
					$.Dialog.fail("请填写原密码");//成功调用 提示一秒后自动关闭
					return false;
				}
				if($('#new_pass').val()==""){
					$.Dialog.fail("请填写新密码！");//成功调用 提示一秒后自动关闭
					return false;
				}
				if($('#new_pass').val().length < 5){
					$.Dialog.fail("新密码长度需要大于5个字符！");//成功调用 提示一秒后自动关闭
					return false;
				}
				if($('#new_pass1').val()==""){
					$.Dialog.fail("请填写确认新密码！");//成功调用 提示一秒后自动关闭
					return false;
				}
				if($('#new_pass').val()!=$('#new_pass1').val()){
					$.Dialog.fail("两次输入的新密码不一致。");//成功调用 提示一秒后自动关闭
					return false;
				}

				
				})
		</script>
    </div>
</body>
</html>
