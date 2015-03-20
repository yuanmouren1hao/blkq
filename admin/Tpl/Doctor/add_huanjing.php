<include file="public/head" />




<form method="post" class="form-x" action="<?php echo U('Doctor/add_huanjing');?>">

  
  <div class="form-group">
		<div class="label">
			<label for="readme">环境类别</label>
		</div>
		<div class="field">
			<select class="input" name="catelog_id" id="catelog_id">
				<option>#####</option>
				<volist name='cate_list' id='vo'>
				<option value='{$vo.id}'>{$vo.child}</option>
				</volist>
			</select>
		</div>
	</div>
  
	<div class="form-group">
		<div class="label">
			<label for="readme">图片展示</label>
		</div>
		<div class="field">
				<div id="pub-imgadd">
						<div class="imgshow"><img src="__PUBLIC__/img/upload.jpg"></div>
				</div>
				<input type="hidden" name="image" id="image" value="" />
				<p class="help-block">
					建议大小：445 × 308
				</p>
		</div>
	</div>

  <div class="form-group">
    <div class="label"><label for="readme">环境简介</label></div>
    <div class="field">
      <textarea class="input" rows="5" cols="50" name="desc"  placeholder="在这里输入简介~"></textarea>
    </div>
  </div>
  
  <div class="form-group">
    <div class="label"><label for="readme">详细介绍</label></div>
    <div class="field">
      <textarea class="input" rows="5" cols="50" name="content"  placeholder="在这里输入详情~"></textarea>
    </div>
  </div>
  
  <input type="hidden" name="tag" value="tag" />
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
            
            K('#pub-imgadd img').click(function() {
                editor.loadPlugin('image', function() {
                    editor.plugin.imageDialog({
                        showRemote : false,
                        clickFn : function(url, title, width, height, border, align) {
                            $("#pub-imgadd").html('');
                            $("#pub-imgadd").append("<div class='imgshow'><img src="+url+"></div>");
                            $("input#image").val(url);
                            editor.hideDialog();
                        }
                    });
                });
            });
            
        });
</script>

<include file='public/foot' />