<link href="__ROOT__/icon.ico" rel="shortcut icon">
<link
	rel="stylesheet" href="__PUBLIC__/pintuer/pintuer.css">
<link
	rel="stylesheet" href="__PUBLIC__/pintuer/admin/admin.css">
<form method="post" class="form-x">

	<input type="hidden" name="tag" value="edit" />
	<div class="form-group">
		<div class="label">
			<label>OA地址</label>
		</div>
		<div class="field">
			<input type="text" class="input" name="oa_url"
				value="<?php echo mc_option('oa_url')?>" size="10" placeholder="" />
		</div>
	</div>
	<div class="form-group">
		<div class="label">
			<label>值班安排</label>
		</div>
		<div class="field">
			<input type="text" class="input" name="zbap_edit"
				value="<?php echo mc_option('zbap_edit')?>" size="10" placeholder="" />
		</div>
	</div>


	<div class="form-button">
		<button class="button" type="submit">保存</button>
	</div>
	
</form>


<script
	charset="utf-8" src="__PUBLIC__/kindeditor/kindeditor-min.js"></script>
<script
	charset="utf-8" src="__PUBLIC__/kindeditor/zh_CN.js"></script>
<script
	charset="utf-8" src="__PUBLIC__/kindeditor/kindeditor-min.js"></script>
<script
	charset="utf-8" src="__PUBLIC__/kindeditor/zh_CN.js"></script>
