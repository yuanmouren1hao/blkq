<include file="public/head" />



<div class="line-big">
    <blockquote class=" margin-large">
  <p>网站PV代表的是网站<span class="badge bg-green">用户的访问量</span>。此处只统计最近7天的数据</p>
   <p>由于<span class="badge bg-red">数据量大</span>，请耐心等待...</p>
</blockquote>
	<div class="x3">
		<div>
			<h2>网站UV(最近七天)</h2>
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
			<h2>最近10个来源IP</h2>
		</div>
		<table class="table table-hover">
			<tr>
				<th>来源地址</th>
				<th>来源解析</th>
			</tr>
			<volist name="info2" id="vo">
			<tr>
				<td><a href="" target="_blank">{$vo.ip}</a></td>
				<td><a href="" target="_blank"><span class="tag bg-gray">{$vo.area}  {$vo.location}</span></a></td>
			</tr>
			</volist>
		</table>


	</div>
</div>





<include file='public/foot' />