<include file="public/head" />




<form method="post" class="form-x">

	<div class="form-group">
		<div class="label">
			<label for="readme">第一张幻灯片</label>
		</div>
		<div class="field">
			<div id="pub-imgadd1">
				<div class="imgshow">
					<img width="700px"  src="<?php echo mc_option('f_img_1');?>">
					
				</div>
			</div>
			<input type="text" class="input input-auto" id="f_url_1" name="f_url_1"
							value="<?php echo mc_option('f_url_1')?>" size="90"
							placeholder="url" />
			<input type="hidden" name="f_img_1" id="f_img_1"
				value="<?php echo mc_option('f_img_1');?>" />
		</div>
	</div>
	
	
	<div class="form-group">
		<div class="label">
			<label for="readme">第二张幻灯片</label>
		</div>
		<div class="field">
			<div id="pub-imgadd2">
				<div class="imgshow">
					<img width="700px"  src="<?php echo mc_option('f_img_2');?>">
					
				</div>
			</div>
			<input type="text" class="input input-auto" id="f_url_2" name="f_url_2"
							value="<?php echo mc_option('f_url_2')?>" size="90"
							placeholder="url" />
			<input type="hidden" name="f_img_2" id="f_img_2"
				value="<?php echo mc_option('f_img_2');?>" />
		</div>
	</div>
	
	
	
	<div class="form-group">
		<div class="label">
			<label for="readme">第三张幻灯片</label>
		</div>
		<div class="field">
			<div id="pub-imgadd3">
				<div class="imgshow">
					<img width="700px"  src="<?php echo mc_option('f_img_3');?>">
					
				</div>
			</div>
			<input type="text" class="input input-auto" id="f_url_3" name="f_url_3"
							value="<?php echo mc_option('f_url_3')?>" size="90"
							placeholder="url" />
			<input type="hidden" name="f_img_3" id="f_img_3"
				value="<?php echo mc_option('f_img_3');?>" />
		</div>
	</div>
	

	<input type="hidden" name="tag" value="tag" />
	<div class="form-button">
		<button class="button" type="submit">保存</button>
	</div>
</form>
<script charset="utf-8" src="__PUBLIC__/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="__PUBLIC__/kindeditor/zh_CN.js"></script>
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
            
            K('#pub-imgadd1 img').click(function() {
                editor.loadPlugin('image', function() {
                    editor.plugin.imageDialog({
                        showRemote : false,
                        clickFn : function(url, title, width, height, border, align) {
                            $("#pub-imgadd1").html('');
                            $("#pub-imgadd1").append("<div class='imgshow'><img src="+url+"></div>");
                            $("input#f_img_1").val(url);
                            editor.hideDialog();
                        }
                    });
                });
            });


            K('#pub-imgadd2 img').click(function() {
                editor.loadPlugin('image', function() {
                    editor.plugin.imageDialog({
                        showRemote : false,
                        clickFn : function(url, title, width, height, border, align) {
                            $("#pub-imgadd2").html('');
                            $("#pub-imgadd2").append("<div class='imgshow'><img src="+url+"></div>");
                            $("input#f_img_2").val(url);
                            editor.hideDialog();
                        }
                    });
                });
            });


            K('#pub-imgadd3 img').click(function() {
                editor.loadPlugin('image', function() {
                    editor.plugin.imageDialog({
                        showRemote : false,
                        clickFn : function(url, title, width, height, border, align) {
                            $("#pub-imgadd3").html('');
                            $("#pub-imgadd3").append("<div class='imgshow'><img src="+url+"></div>");
                            $("input#f_img_3").val(url);
                            editor.hideDialog();
                        }
                    });
                });
            });
            
        });
</script>

<include file='public/foot' />