<include file="public/head" />




<form method="post" class="form-x">

	<div class="form-group">
		<div class="label">
			<label for="username">QQ</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="title" name="qq"
				value="<?php echo mc_option('qq') ?>" size="50"
				placeholder="请在这里输入QQ信息~" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="username">微博</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="title" name="weibo"
				value="<?php echo mc_option('weibo') ?>" size="50"
				placeholder="请在这里输入微博账号~" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="username">腾讯微博</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="title" name="tqq"
				value="<?php echo mc_option('tqq') ?>" size="50"
				placeholder="请在这里输入腾讯微博账号~" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="username">电话</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="tel" name="tel"
				value="<?php echo mc_option('tel') ?>" size="50"
				placeholder="请在这里输入电话~" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="username">微信号码</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="title" name="weixin"
				value="<?php echo mc_option('weixin') ?>" size="50"
				placeholder="请在这里输入微信~" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="readme">微信二维码</label>
		</div>
		<div class="field">
			<div id="pub-imgadd">
				<div class="imgshow">
					<img src="<?php echo mc_option('weixin_code');?>">
				</div>
			</div>
			<input type="hidden" name="weixin_code" id="weixin_code"
				value="<?php echo mc_option('weixin_code');?>" />
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