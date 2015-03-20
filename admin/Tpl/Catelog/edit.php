<include file="public/head" />




<form method="post" class="form-x" action="">

	<div class="form-group">
		<div class="label">
			<label for="readme">一级分类</label>
		</div>
		<div class="field">
			<select class="input" name="father" id="father"
				onchange="javascript:get_child_catelog(this.value);">
				<option>-----</option>
				<volist name='catelog' id='vo'>
				<option value='{$vo.father}'>{$vo.father}</option>
				</volist>
			</select>
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="readme">二级分类</label>
		</div>
		<div class="field">
			<select class="input" name="child" id="child"
				onchange="javascript:get_catelog_info(this.value);">
				<option>-----</option>
			</select>
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="username">修改后的分类</label>
		</div>
		<div class="field">
			<input type="text" class="input input-auto" id="edit_catelog" name="edit_catelog"
				data-validate="required:请填修改后的分类名称~" size="20" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="readme">分类简介</label>
		</div>
		<div class="field">
			<textarea class="input" id="desc" name="desc" rows="5" cols="50"
				placeholder="介绍一下这个分类~"></textarea>
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="readme">修改时间</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="create_time" name="create_time"
				disabled value="" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="readme">创建/修改人</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="create_user" name="create_user"
				disabled value="" />
		</div>
	</div>


	<div class="form-button">
		<button class="button" type="submit">修改</button>
	</div>

	<input type="hidden" name="the_id" id="the_id" value /> <input
		type="hidden" name="tag" value="tag" />
</form>

<script type="text/javascript">

	function get_child_catelog(value)
	{
// 		alert(value);
		$.get("<?php echo U('Catelog/get_child_list')?>?father="+value+"",function(data,status){
// 		    alert(JSON.stringify(data));
			$('.input#child').html('');
			$('.input#child').append('<option>-----</option>');
		    for(var i=0; i<data.length; i++)  
		    {  
// 		       alert(data[i].child);
		       $('.input#child').append("<option>"+data[i].child+"</option>");
		    }
		    $(".input#desc").val('');
		    $(".input#create_time").val('');
		    $(".input#create_user").val('');
		    $("input#the_id").val('');
			//$('.input#child')
// 			alert("nStatus: " + status);
		});
	}


	function get_catelog_info(child){
		father = $('.input#father').val();
		$.get("<?php echo U('Catelog/get_catelog_info')?>?father="+father+"&child="+child,function(data,status){
// 		    alert(JSON.stringify(data));
		    $(".input#desc").val(data['catelog_desc']);
		    $(".input#create_time").val(data['create_time']);
		    $(".input#create_user").val(data['create_user']);
		    $("input#the_id").val(data['id']);
		    $(".input#edit_catelog").val(data['child']);
		});
	}

</script>



<include file='public/foot' />