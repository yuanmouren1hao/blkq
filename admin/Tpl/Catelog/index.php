<include file="public/head" />



<table class="table">
	<tr>
		<th>全部分类列表</th>
	</tr>
	
	<?php foreach ($catelog as $val):?>
		<tr>
			<td><span class="tag bg-main"><?php echo $val['father']?></span></td>

			<td><?php $list= aop_get_catelog_child_list($val['father']); foreach ($list as $childvar):echo "<span class='tag bg-sub'>".$childvar['child'].'</span>&nbsp;';endforeach;?>
			
			
			</td>
		</tr>
	<?php endforeach;?>
</table>



<include file='public/foot' />