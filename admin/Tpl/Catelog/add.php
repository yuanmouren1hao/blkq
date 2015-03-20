<include file="public/head" />




<form method="post" class="form-x" action="">

	<div class="form-group">
		<div class="label">
			<label for="readme">一级分类</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="father" name="father" placeholder="一级目录" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="readme">二级分类</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="child" name="child" placeholder="二级目录" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="readme">分类简介</label>
		</div>
		<div class="field">
			<textarea class="input" id="desc" name="desc" rows="5" cols="50" placeholder="介绍一下这个分类~"></textarea>
		</div>
	</div>

	


	<div class="form-button">
		<button class="button" type="submit">添加 </button>
	</div>

	<input type="hidden" name="tag" value="tag" />
</form>



<include file='public/foot' />