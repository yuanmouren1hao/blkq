<include file="public/head" />




<form method="post" class="form-x">

	<div class="form-group">
		<div class="label">
			<label for="username">邮件账号</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="title" name="hos_mail" value="<?php echo mc_option('hos_mail') ?>" size="50"
				placeholder="请在这里输入发送邮件账号~" />
		</div>
	</div>
	
	
	<div class="form-group">
		<div class="label">
			<label for="username">发件人名称</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="title" name="stmp_name" value="<?php echo mc_option('stmp_name') ?>" size="50"
				placeholder="请在这里输入发送邮件名称~" />
		</div>
	</div>

	<input type="hidden" name="tag" value="tag" />
	<div class="form-button">
		<button class="button" type="submit">保存</button>
		<a class="button bg-blue" href="<?php echo U("system/test_mail");?>?mail=<?php echo mc_option('hos_mail')?>">发送测试邮件</a>
	</div>
</form>


<include file='public/foot' />