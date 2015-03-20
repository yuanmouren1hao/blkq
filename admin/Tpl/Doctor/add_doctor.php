<include file="public/head" />




<form method="post" class="form-x" action="<?php echo U('Doctor/add_doctor');?>">

  <div class="form-group">
    <div class="label"><label for="username">医师姓名</label></div>
    <div class="field">
      <input type="text" class="input" id="name" name="name" size="50" placeholder="请在这里输入医师姓名~" />
    </div>
  </div>
  
  <div class="form-group">
		<div class="label">
			<label for="readme">医师类别</label>
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
    <div class="label"><label for="password">称呼</label></div>
    <div class="field">
      <div class="button-group radio">
        <label class="button active"><input name="sex" value="先生" checked="checked" type="radio"><span class="icon icon-male"></span> 先生</label>
        <label class="button"><input name="sex" value="女士" type="radio"><span class="icon icon-female"></span> 女士</label>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="label"><label for="username">职称</label></div>
    <div class="field">
      <input type="text" class="input input-auto" id="title" name="title" size="50" placeholder="请输入医师职称~"  data-validate="required:请填写信息" />
    </div>
  </div>
  
  <div class="form-group">
    <div class="label"><label for="username">显示顺序</label></div>
    <div class="field">
      <input type="text" class="input input-auto" id="age" name="age" size="20" placeholder="" value=1 data-validate="required:请填写信息" /> <span class="badge">数字越小越靠前</span>
    </div>
  </div>
  
  <div class="form-group">
    <div class="label"><label for="username">电话</label></div>
    <div class="field">
      <input type="text" class="input input-auto" id="tel" name="tel" size="50" placeholder="电话号码"  data-validate="required:请填写信息" />
    </div>
  </div>
  
  <div class="form-group">
    <div class="label"><label for="username">邮箱</label></div>
    <div class="field">
      <input type="text" class="input input-auto" id="mail" name="mail" size="50" placeholder="邮箱"  data-validate="required:请填写信息" />
    </div>
  </div>

  <div class="form-group">
    <div class="label"><label for="username">微信</label></div>
    <div class="field">
      <input type="text"  class="input input-auto" id="weixin_id" name="weixin_id" size="50" placeholder="微信id" />
    </div>
  </div>

	<div class="form-group">
		<div class="label">
			<label for="readme">头像图片</label>
		</div>
		<div class="field">
				<div id="pub-imgadd">
						<div class="imgshow"><img src="__PUBLIC__/img/upload.jpg"></div>
				</div>
				<input type="hidden" name="image" id="image" value="" />
				<p class="help-block">
					建议大小：330*330
				</p>
		</div>
	</div>

  <div class="form-group">
    <div class="label"><label for="readme">医师简介</label></div>
    <div class="field">
      <textarea class="input" rows="5" cols="50" name="desc"  placeholder="在这里输入医师简介~"  data-validate="required:请填写信息"></textarea>
    </div>
  </div>
  
  <div class="form-group">
    <div class="label"><label for="readme">详细介绍</label></div>
    <div class="field">
      <textarea class="input" rows="5" cols="50" name="content"  placeholder="在这里输入医师详情~"  data-validate="required:请填写信息"></textarea>
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