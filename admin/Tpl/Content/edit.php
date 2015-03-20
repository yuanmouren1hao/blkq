<include file="public/head" />

<form method="post" class="form-x">

  <div class="form-group">
    <div class="label"><label for="username">文章标题</label></div>
    <div class="field">
      <input  data-validate="required:请填写~" type="text" class="input" id="title" name="title" size="50" placeholder="请在这里输入标题~" value="{$info.title}" />
    </div>
  </div>
  
  <div class="form-group">
		<div class="label">
			<label for="readme">一级分类</label>
		</div>
		<div class="field">
			<select class="input" name="father" id="father" onchange="javascript:get_child_catelog(this.value);">
				<volist name='catelog' id='vo'>
				<option value='{$vo.father}'>{$vo.father}</option>
				</volist>
				<option value='{$info.father}' selected>{$info.father}</option>
			</select>
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="readme">二级分类</label>
		</div>
		<div class="field">
			<select class="input" name="child" id="child" onchange="javascript:get_catelog_info(this.value);">
				<option>{$info.child}</option>
			</select>
		</div>
	</div>
	
    <div class="form-group">
    <div class="label"><label for="username">发布人</label></div>
    <div class="field">
        <input  data-validate="required:请填写~" type="text" class="input" name="author" id="author" value="{$info.author}" size="50" />
    </div>
  	</div>
  
  <div class="form-group">
    <div class="label"><label for="readme">文章详情</label></div>
    <div class="field">
      <textarea class="input" rows="5" cols="50" name="content"  placeholder="在这里输入文章详情~">{$info.content}</textarea>
    </div>
  </div>
  
  <input type="hidden" name="tag" value="tag" />
  <input type="hidden" name="id" id="id" value={$info.id} /> 
  <input type="hidden" name="catelog_id" id="catelog_id" value={$info.catelog_id} /> 
  <div class="form-button"><button class="button" type="submit">提交</button></div>
</form>
<script type="text/javascript">
	function get_child_catelog(value)
	{
		$.get("<?php echo U('Catelog/get_child_list')?>?father="+value+"",function(data,status){
			$('.input#child').html('');
			$('.input#child').append('<option>-----</option>');
		    for(var i=0; i<data.length; i++)  
		    {  
		       $('.input#child').append("<option>"+data[i].child+"</option>");
		    }
		});
	}

	function get_catelog_info(child){
		father = $('.input#father').val();
		$.get("<?php echo U('Catelog/get_catelog_info')?>?father="+father+"&child="+child,function(data,status){
		    $("input#catelog_id").val(data['id']);
		});
	}

</script>

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
                            $("input#fmimg_m").val(url);
                            editor.hideDialog();
                        }
                    });
                });
            });
            
        });
</script>

<include file='public/foot' />