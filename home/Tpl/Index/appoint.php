<!DOCTYPE html>
<html lang="zh-cn">
<head>
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="__PUBLIC__/pintuer/pintuer.css">
<link rel="stylesheet" href="__PUBLIC__/css/iconfont.css">

<script src="__PUBLIC__/pintuer/jquery.js"></script>
<script src="__PUBLIC__/pintuer/pintuer.js"></script>
</head>
<body>
	<div class="container">
		<div class='line'>
			<table class="table table-bordered text-center table-hover">
				<tr>
				<?php $weekarray=array("日","一","二","三","四","五","六");?>
					<th width='100'>医师</th>
					<th width='160'><?php echo date('Y-m-d');?>(<?php echo "星期".$weekarray[date("w")];?>)</th>
					<th width='160'><?php echo date('Y-m-d',strtotime('+1 day'));?>(<?php echo "星期".$weekarray[(date("w")+1)%7];?>)</th>
					<th width='160'><?php echo date('Y-m-d',strtotime('+2 day'));?>(<?php echo "星期".$weekarray[(date("w")+2)%7];?>)</th>
					<th width='160'><?php echo date('Y-m-d',strtotime('+3 day'));?>(<?php echo "星期".$weekarray[(date("w")+3)%7];?>)</th>
					<th width='160'><?php echo date('Y-m-d',strtotime('+4 day'));?>(<?php echo "星期".$weekarray[(date("w")+4)%7];?>)</th>
					<th width='160'><?php echo date('Y-m-d',strtotime('+5 day'));?>(<?php echo "星期".$weekarray[(date("w")+5)%7];?>)</th>
					<th width='160'><?php echo date('Y-m-d',strtotime('+6 day'));?>(<?php echo "星期".$weekarray[(date("w")+6)%7];?>)</th>
				</tr>

				<volist name="info" id="vo">
				<tr>
					<!-- 1 -->
					<td>
						<div class="media-inline">
							<div class="media media-y clearfix">
								<a href="#"><img src="{$vo.image}" width='80' height='80'
									class="radius" alt="..."> </a>
								<div class="media-body">
									<strong>{$vo.name}</strong>
								</div>
							</div>
						</div>
					</td>
					
					
					<!-- 1 -->
					<td>
						<div>
							<?php $list1 = selectList('order', 'doctor_id='.$vo['id'].' and is_chuli=1 and order_time= "'.date('Y-m-d').'"', 'order_time');?>
							<?php foreach ($list1 as $list1_v) { ?>
								<span class='icon icon-male'><?php echo $list1_v['name'];?></span>
								<span class="badge bg-main"><?php echo $list1_v['order_time2'];?></span>
								<span class="badge bg-sub"><?php echo $list1_v['yuyue_type'];?></span><br>
							<?php }?>
						</div>
					</td>

					<!-- 2 -->
					<td>
						<div>
							<?php $list2 = selectList('order', 'doctor_id='.$vo['id'].' and is_chuli=1 and order_time= "'.date('Y-m-d',strtotime('+1 day')).'"', 'order_time');?>
							<?php foreach ($list2 as $list2_v) { ?>
								<span class='icon icon-male'><?php echo $list2_v['name'];?></span>
								<span class="badge bg-main"><?php echo $list2_v['order_time2'];?></span>
								<span class="badge bg-sub"><?php echo $list2_v['yuyue_type'];?></span><br>
							<?php }?>
						</div></td>
					<!-- 3 -->
					<td>
						<div>
							<?php $list3 = selectList('order', 'doctor_id='.$vo['id'].' and is_chuli=1 and order_time= "'.date('Y-m-d',strtotime('+2 day')).'"', 'order_time');?>
							<?php foreach ($list3 as $list3_v) { ?>
								<span class='icon icon-male'><?php echo $list3_v['name'];?></span>
								<span class="badge bg-main"><?php echo $list3_v['order_time2'];?></span>
								<span class="badge bg-sub"><?php echo $list3_v['yuyue_type'];?></span><br>
							<?php }?>
						</div></td>
					<!-- 4 -->
					<td>
						<div>
							<?php $list4 = selectList('order', 'doctor_id='.$vo['id'].' and is_chuli=1 and order_time= "'.date('Y-m-d',strtotime('+3 day')).'"', 'order_time');?>
							<?php foreach ($list4 as $list4_v) { ?>
								<span class='icon icon-male'><?php echo $list4_v['name'];?></span>
								<span class="badge bg-main"><?php echo $list4_v['order_time2'];?></span>
								<span class="badge bg-sub"><?php echo $list4_v['yuyue_type'];?></span><br>
							<?php }?>
						</div></td>
					<!-- 5 -->
					<td>
						<div>
							<?php $list5 = selectList('order', 'doctor_id='.$vo['id'].' and is_chuli=1 and order_time= "'.date('Y-m-d',strtotime('+4 day')).'"', 'order_time');?>
							<?php foreach ($list5 as $list5_v) { ?>
								<span class='icon icon-male'><?php echo $list5_v['name'];?></span>
								<span class="badge bg-main"><?php echo $list5_v['order_time2'];?></span>
								<span class="badge bg-sub"><?php echo $list5_v['yuyue_type'];?></span><br>
							<?php }?>
						</div></td>
					<!-- 6 -->
					<td>
						<div>
							<?php $list6 = selectList('order', 'doctor_id='.$vo['id'].' and is_chuli=1 and order_time= "'.date('Y-m-d',strtotime('+5 day')).'"', 'order_time');?>
							<?php foreach ($list6 as $list6_v) { ?>
								<span class='icon icon-male'><?php echo $list6_v['name'];?></span>
								<span class="badge bg-main"><?php echo $list6_v['order_time2'];?></span>
								<span class="badge bg-sub"><?php echo $list6_v['yuyue_type'];?></span><br>
							<?php }?>
						</div></td>
					<!-- 7 -->
					<td>
						<div>
							<?php $list7 = selectList('order', 'doctor_id='.$vo['id'].' and is_chuli=1 and order_time= "'.date('Y-m-d',strtotime('+6 day')).'"', 'order_time');?>
							<?php foreach ($list7 as $list7_v) { ?>
								<span class='icon icon-male'><?php echo $list7_v['name'];?></span>
								<span class="badge bg-main"><?php echo $list7_v['order_time2'];?></span>
								<span class="badge bg-sub"><?php echo $list7_v['yuyue_type'];?></span><br>
							<?php }?>
						</div></td>
				</tr>
				</volist>

			</table>
		</div>
	</div>
</body>
</html>
