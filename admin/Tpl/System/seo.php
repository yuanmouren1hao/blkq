<include file="public/head" />




<form method="post" class="form-x">

	<div class="form-group">
		<div class="label">
			<label for="username">关键词</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="title" name="keyword"
				value="<?php echo mc_option('keyword')?>" size="50"
				placeholder="关键词" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="username">描述</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="title" name="desc"
				value="<?php echo mc_option('description')?>" size="50"
				placeholder="描述~" />
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
            
            K('#pub-imgadd img').click(function() {
                editor.loadPlugin('image', function() {
                    editor.plugin.imageDialog({
                        showRemote : false,
                        clickFn : function(url, title, width, height, border, align) {
                            $("#pub-imgadd").html('');
                            $("#pub-imgadd").append("<div class='imgshow'><img src="+url+"></div>");
                            $("input#weixin_code").val(url);
                            editor.hideDialog();
                        }
                    });
                });
            });
            
        });
</script>

<include file='public/foot' />