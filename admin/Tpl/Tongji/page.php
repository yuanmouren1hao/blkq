<include file="public/head" />

<div>
	<h2>网站文章访问量</h2>
</div>
<table class="table table-hover">
	<tr>
		<th>文章标题</th>
		<th>访问量</th>
	</tr>
	<volist name="info" id="vo">
	<tr>
		<td><a href="javacsript:;">{$vo.title}</a></td>
		<td><span class="tag bg-blue">{$vo.read_num}</span></td>
	</tr>
	</volist>
</table>

<include file='public/foot' />