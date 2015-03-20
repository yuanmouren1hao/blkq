<include file="public/head" />



<div class="line-big">
    <blockquote class=" margin-large">
  <p>网站PV代表的是网站<span class="badge bg-green">页面的访问量</span>。此处只统计最近7天的数据</p>
   <p>由于<span class="badge bg-red">数据量大</span>，请耐心等待...</p>
</blockquote>
	<div class="x3">
		<div>
			<h2>网站PV(最近七天)</h2>
		</div>
		<table class="table table-hover">
			<tr>
				<th>时间</th>
				<th>访问量</th>
			</tr>
			<volist name="info" id="vo">
			<tr>
				<td><span class="tag bg-sub">{$vo.days}</span></td>
				<td><span class="badge bg-red">{$vo.count}</span></td>
			</tr>
			</volist>
		</table>

	</div>

	<div class="x6">
		<div>
			<h2>最近7天来源统计</h2>
		</div>
		<table class="table table-hover">
			<tr>
				<th>来源地址</th>
				<th>来源数目</th>
			</tr>
			<volist name="info2" id="vo">
			<tr>
				<td><a href="http://{$vo.from_site}" target="_blank">{$vo.from_site}</a></td>
				<td><span class="badge bg-yellow">{$vo.count}</span></td>
			</tr>
			</volist>
		</table>


	</div>
</div>





<include file='public/foot' />