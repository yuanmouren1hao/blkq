<include file="public/head" />




<form method="post" class="form-x">

  <div class="form-group">
    <div class="label"><label for="username">标题</label></div>
    <div class="field">
      <input type="text" class="input" id="title" name="title" size="50" placeholder="请在这里输入标题~"  data-validate="required:请填写信息" />
    </div>
  </div>
  
	<div class="form-group">
		<div class="label">
			<label for="readme">小图片</label>
		</div>
		<div class="field">
				<div id="pub-imgadd-s">
						<div class="imgshow"><img src="__PUBLIC__/img/upload.jpg"></div>
				</div>
				<input type="hidden" name="fmimg_s" id="fmimg_s" value="" />
		</div>
	</div>
	
	
	<div class="form-group">
		<div class="label">
			<label for="readme">大图片</label>
		</div>
		<div class="field">
				<div id="pub-imgadd-b">
						<div class="imgshow"><img src="__PUBLIC__/img/upload.jpg"></div>
				</div>
				<input type="hidden" name="fmimg_b" id="fmimg_b" value="" />
		</div>
	</div>
  
  
    <div class="form-group">
    <div class="label"><label for="username">发布人</label></div>
    <div class="field">
        <input type="text" class="input" disabled id="author" value="<?php echo session('user.user_name')?>" size="50" />
    	<input type="hidden" name="author" value="<?php echo session('user.user_name')?>" />
    </div>
  	</div>
  
  <div class="form-group">
    <div class="label"><label for="readme">详情</label></div>
    <div class="field">
      <textarea class="input" rows="5" cols="50" name="content"  placeholder="在这里输入文章详情~"></textarea>
    </div>
  </div>
  
  <input type="hidden" name="tag" value="tag" />
  <input type="hidden" name="catelog_id" id="catelog_id" value= /> 
  <div class="form-button"><button class="button" type="submit">提交</button></div>
</form>


<script charset="utf-8" src="__PUBLIC__/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="__PUBLIC__/kindeditor/zh_CN.js"></script>
<script>
		var editor;
		KindEditor.ready(function(K) {
			editor = K.create('textarea[name="content"]', {
				resizeType : 1,
				allowPreviewEmoticons : false,
				allowImageUpload : true,
				height : 400,
				uploadJson : '<?php echo U('Public/upload'); ?>',
				afterChange : function() {
					K(this).html(this.count('text'));
				}
			});
		});
		
        KindEditor.ready(function(K) {
            var editor = K.editor({
                uploadJson : '<?php echo U('Public/upload'); ?>',
                allowFileManager : true
            });
            
            K('#pub-imgadd-s img').click(function() {
                editor.loadPlugin('image', function() {
                    editor.plugin.imageDialog({
                        showRemote : false,
                        clickFn : function(url, title, width, height, border, align) {
                            $("#pub-imgadd-s").html('');
                            $("#pub-imgadd-s").append("<div class='imgshow'><img src="+url+"></div>");
                            $("input#fmimg_s").val(url);
                            editor.hideDialog();
                        }
                    });
                });
            });

            K('#pub-imgadd-m img').click(function() {
                editor.loadPlugin('image', function() {
                    editor.plugin.imageDialog({
                        showRemote : false,
                        clickFn : function(url, title, width, height, border, align) {
                            $("#pub-imgadd-m").html('');
                            $("#pub-imgadd-m").append("<div class='imgshow'><img src="+url+"></div>");
                            $("input#fmimg_m").val(url);
                            editor.hideDialog();
                        }
                    });
                });
            });

            K('#pub-imgadd-b img').click(function() {
                editor.loadPlugin('image', function() {
                    editor.plugin.imageDialog({
                        showRemote : false,
                        clickFn : function(url, title, width, height, border, align) {
                            $("#pub-imgadd-b").html('');
                            $("#pub-imgadd-b").append("<div class='imgshow'><img src="+url+"></div>");
                            $("input#fmimg_b").val(url);
                            editor.hideDialog();
                        }
                    });
                });
            });
            
        });
</script>

<include file='public/foot' />