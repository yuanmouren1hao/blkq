<include file="public/head" />




<form method="post" class="form-x">

	<div class="form-group">
		<div class="label">
			<label for="username">网站名称</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="title" name="site_name"
				value="<?php echo mc_option('site_name')?>" size="50"
				placeholder="关键词" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="username">网站地址</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="title" name="site_url"
				value="<?php echo mc_option('site_url')?>" size="50"
				placeholder="描述~" />
		</div>
	</div>
	
	<div class="form-group">
		<div class="label">
			<label for="username">分页显示数</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="title" name="page_num"
				value="<?php echo mc_option('page_num')?>" size="50"
				placeholder="描述~" />
		</div>
	</div>
	
	<div class="form-group">
		<div class="label">
			<label for="username">提示页面时间</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="title" name="alter_time"
				value="<?php echo mc_option('alter_time')?>" size="50"
				placeholder="描述~" />
		</div>
	</div>
	
	<div class="form-group">
		<div class="label">
			<label for="username">copyright</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="title" name="foot_copyright"
				value="<?php echo mc_option('foot_copyright')?>" size="50"
				placeholder="" />
		</div>
	</div>
	
	<div class="form-group">
		<div class="label">
			<label for="username">百度统计代码</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="title" name="baidu_tongji"
				value="<?php echo mc_option('baidu_tongji')?>" size="50"
				placeholder="" />
		</div>
	</div>
	
	<div class="form-group">
		<div class="label">
			<label for="username">助手微信id</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="admin_weixin_id" name="admin_weixin_id"
				value="<?php echo mc_option('admin_weixin_id')?>" size="50"
				placeholder="" />
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