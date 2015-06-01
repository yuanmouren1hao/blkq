<?php

class IndexAction extends Action
{

	public function index()
	{

		$news_list = M ( "page_catelog" )->where ( 'father="医院动态" and is_delt=0' )->order ( 'updatetime desc' )->limit ( 9 )->select ();
		$this->assign ( 'news_list', $news_list );

		$huanjing_list = M ( 'huanjing' )->where ( "type='huanjing' " )->order ( "updatetime desc" )->limit ( 5 )->select ();
		$this->assign ( 'huanjing_list', $huanjing_list );
		$this->display ();

	}

	public function jianjie()
	{

		$info = mc_option ( 'yiyuan_jianjie' );
		$content = stripslashes ( $info );
		$content = html_entity_decode ( $content );
		$this->assign ( 'content', $content );
		$this->display ();

	}

	public function flash()
	{

		$video_list = M ( "page_catelog" )->where ( 'father="口腔视频" and is_delt=0' )->order ( 'updatetime desc' )->limit ( 5 )->select ();
		$this->assign ( 'video_list', $video_list );
		// 		dump($video_list);
		$this->display ();

	}

	public function map()
	{

		$info = mc_option ( 'map' );
		$content = stripslashes ( $info );
		$content = html_entity_decode ( $content );
		$this->assign ( 'info', $content );
		$this->display ();

	}

	public function zixun()
	{

		$info = mc_option ( 'zaixian_zixun' );
		$content = stripslashes ( $info );
		$content = html_entity_decode ( $content );
		$this->assign ( 'info', $content );
		$this->display ();

	}

	public function news()
	{
		$obj = M ( 'page_catelog' );
		import ( 'ORG.Util.Page' ); // 导入分页类
		$count = $obj->where ( 'father="医院动态" and is_delt=0' )->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, mc_option ( 'page_num' ) ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig ( 'theme', mc_page () );
		$show = $Page->show (); // 分页显示输出, 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $obj->where ( 'father="医院动态" and is_delt=0' )->order ( 'updatetime desc' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page_now', $show ); // 赋值分页输出
		$this->assign ( 'count', $count );
		$this->display (); // 输出模板
	}

	public function news_detail()
	{

		$id = $_REQUEST ['id'];
		if ($id)
		{
			setInc ( 'page', $id, 'read_num', 1 );

			$info = selectRow ( 'page_catelog', $id );
			if ($info ['father'] == '医院动态' or $info ['father'] == '口腔视频')
			{
				$content = stripslashes ( $info ['content'] );
				$info ['content'] = html_entity_decode ( $content );
				$this->assign ( 'info', $info );
				$this->display ();
			} else
			{
				$this->error ( "呃，不可浏览其他类别哦~~" );
			}
		} else
		{
			$this->error ( "呃，发生了点小错误哦~~" );
		}

	}

public function statistics(){
		$tag = $_REQUEST['tag'];
		
		
		if($tag == 'export'){
		
			$sdt = $_REQUEST ['sdt'];
			$edt = $_REQUEST ['edt'];
			$obj = new Model();
			$sql = "select a.id,b.cust_name,a.order_time,a.doctor_id,yuyue_type,answer_id,answer_time,edit_id,edit_time,iscome,comefrom from blkq_order as a,blkq_cust as b where a.cust_id = b.cust_id and order_time>='".$sdt."' and order_time <= '".$edt."' order by id";
			$list = $obj->query($sql);
			$member = $obj->query("select tbid,name from tb_member ");
			for($i = 0;$i<count($list);$i++){			
				foreach( $member as $mem ){		
					if($list[$i]["doctor_id"] == $mem["tbid"] ){
						$list[$i]["doctor_id"] = $mem["name"];
					}
					if($list[$i]["answer_id"] == $mem["tbid"]){
						$list[$i]["answer_id"] = $mem["name"];
					}
					if($list[$i]["edit_id"] == $mem["tbid"]){
						$list[$i]["edit_id"] = $mem["name"];
					}
				}
			}
			
			
			$title = array('预约号','病人姓名','预约时间','医生','预约类型','创建/处理人员','创建/处理时间','编辑人员','编辑时间','是否就诊','类型');
			$filename = get_current_time();
			exportexcel($data=$list, $title, $filename);
			
		}else{
			$this->display ();
		}
		
	}
	public function order_tongji(){
		$sdt = $_REQUEST ['sdt'];
		$edt = $_REQUEST ['edt'];
		$obj = new Model();
		$sql = "select a.*,b.cust_name,a.id as idd from blkq_order as a,blkq_cust as b where a.cust_id = b.cust_id and order_time>='".$sdt."' and order_time <= '".$edt."' order by a.id";
		$list = $obj->query($sql);
		$member = $obj->query("select tbid,name from tb_member ");
		for($i = 0;$i<count($list);$i++){			
			foreach( $member as $mem ){		
				if($list[$i]["doctor_id"] == $mem["tbid"] ){
					$list[$i]["doctor_name"] = $mem["name"];
				}
				if($list[$i]["answer_id"] == $mem["tbid"]){
					$list[$i]["answer_name"] = $mem["name"];
				}
				if($list[$i]["edit_id"] == $mem["tbid"]){
					$list[$i]["edit_name"] = $mem["name"];
				}
			}
		}
		
		
		
		$this->ajaxReturn($list);	
		
	}


	public function video()
	{

		$obj = M ( 'page_catelog' );
		import ( 'ORG.Util.Page' ); // 导入分页类
		$count = $obj->where ( 'father="口腔视频" and is_delt=0' )->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, mc_option ( 'page_num' ) ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig ( 'theme', mc_page () );
		$show = $Page->show (); // 分页显示输出, 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $obj->where ( 'father="口腔视频" and is_delt=0' )->order ( 'updatetime desc' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page_now', $show ); // 赋值分页输出
		$this->assign ( 'count', $count );
		$this->display (); // 输出模板
	}

	public function liuyan()
	{

		$tag = $_REQUEST ['tag'];
		if ($tag)
		{
			$data ['ask_message'] = I ( 'param.desc' );
			$data ['ask_ip'] = get_current_ip ();
			$data ['ask_time'] = get_current_time ();
			$data ['updatetime'] = get_current_time ();
			$data ['is_reply'] = 0;
			$ok = M ( "message" )->add ( $data );
			if ($ok)
			{
				// success
				$this->success ( '留言成功~~~',U('index/liuyan_list'));
				$content="有人在系统上留言，留言的时间是：".$data ['ask_time']."，  留言IP是：".$data ['ask_ip'].";     留言内容是:".$data ['ask_message'];
				send_email(mc_option('hos_mail'), '有人留言', $content);
				$weixin_content="【网站有人留言】\n\n留言时间：".$data ['ask_time']."\n留言IP是：".$data ['ask_ip']."\n留言内容是：".$data ['ask_message']."\n\n请您尽快处理";
				send_weixin(mc_option('admin_weixin_id'), urlencode($weixin_content));
			} else
			{
				$this->error ( "留言失败~~" );
			}
		} else
		{
			$this->display ();
		}

	}

	public function liuyan_list()
	{

		$obj = M ( 'message' );
		import ( 'ORG.Util.Page' ); // 导入分页类
		$count = $obj->where ( 'is_reply=1' )->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, mc_option ( 'page_num' ) ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig ( 'theme', mc_page () );
		$show = $Page->show (); // 分页显示输出, 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $obj->where ( 'is_reply=1' )->order ( 'updatetime desc' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page_now', $show ); // 赋值分页输出
		$this->assign ( 'count', $count );
		$this->display (); // 输出模板
	}

	public function yuyue()
	{

		$tag = $_REQUEST ['tag'];
		if ($tag)
		{
			$data ['tel'] = I ( 'param.tel' );
			$data ['name'] = I ( 'param.name' );
			$data ['age'] = I ( 'param.age' );
			$data ['sex'] = I ( 'param.sex' );
			
			//根据id获取用户信息
			$sql = "select * from blkq_cust where cust_tel = " . $data ['tel'];
			$list = M ( "Cust" )->query($sql);
			if(count($list)>0){
				//已经存在
				$data['cust_id'] = $list[0]['cust_id'];
			}else{
				//需要插入,新增这条数据
				$insert = "insert into blkq_cust (cust_name,age,cust_tel,cust_sex) values ('".$data ['name']."','".$data ['age']."','".$data ['tel']."','".$data ['sex']."')";			
				$mod = new Model() ;
				$mod->query($insert);
				
				$query = "select cust_id from blkq_cust where cust_tel =" . $data ['tel'];
				$ll = $mod->query($query);
				$data['cust_id'] = $ll[0]['cust_id'];
				
			}
			
			
			
			
			$data ['order_time'] = I ( 'param.order_time' );

			/* alter time2 */
			$time2 = I ( 'param.order_time2' );
			if ($time2==1){
				$data ['order_time2'] = '8:00-12:00';
				/* add dottime*/
				$data['dottime'] = '0,16';
			}
			else if ($time2==2)
			{
				$data ['order_time2'] = '12:00-17:00';
				/* add dottime*/
				$data['dottime'] = '16,39';
			}


			$data ['desc'] = I ( 'param.desc' );
			$data ['ip'] = get_current_ip ();
			$data ['createtime'] = get_current_time ();
			$data['yuyue_type'] = I('param.yuyue_type');
			$data['doctor_id'] = I('param.doctor_id');
			$data['doctor_name'] = I('param.doctor_name');
			$data['comefrom'] = "w";
			// dump($data);
			$ok = M ( "Order" )->add ( $data );
			//dump($ok);
			if ($ok)
			{
				// success
				$this->success ( "您的预约号是：" . $ok .'    ,我们将会尽快安排助手联系您。'   ,'index');
				$content=$data ['name']."-".$data ['sex'].'在网站上进行了预约。预约时间是：  '.$data ['order_time'].' '.$data ['order_time2'].'。  预约号：'.$ok.'   预约的联系方式是：'.$data ['tel'].'   症状描述是：'.$data ['desc'];
				

				/* do send weixin to admin */
				$weixin_content="【网站有人预约】\n\n预约号：".$ok."\n患者姓名：".$data['name']."\n预约时间：".$data ['order_time']."-".$data ['order_time2']."\n联系方式：".$data ['tel']."\n症状描述：".$data ['desc']."\n\n";
				
				//给所有助手发送消息
				$sql = "select weixin_id,mail,tbid from tb_member where permission_id =2 ";
				$list = M("tb_member")->query($sql);				
				foreach($list as $map){
					//send_weixin($map['weixin_id'], urlencode($weixin_content."<a href='http://www.blkqyy.com/admin.php/message/weixin_yuyue.html?sid=".$map["tbid"]."&id=".$ok."'>点击处理 </a>"));							
					//send_weixin($map['weixin_id'], urlencode($weixin_content." http://www.blkqyy.com/admin.php/message/weixin_yuyue.html?sid=".$map["tbid"]."&id=".$ok));							
					$url = "http://www.blkqyy.com/admin.php/message/weixin_yuyue.html?sid=".$map["tbid"]."&id=".$ok;
					sendWechatTempMsg($map['weixin_id'], urlencode($url), urlencode(date ( "Y-m-d_H:i:s" )), urlencode($data['yuyue_type']));
					
					/*send mail*/
					send_email($map['mail'], '有人预约', $content);
					//send_email("342834599@qq.com", '有人预约', $content);
				}	
					
			} else
			{
				$this->error ( "预约失败~~" );
			}
		} else
		{
			/*展示预约的页面*/
			$id = $_REQUEST['id'];
			//$info = selectRow('doctor', $id);
			$obj = new Model();
			$list = $obj->query("select * from tb_member where tbid = ".$id);
			$info = $list[0];
			if (isset($_REQUEST['id']) && null == $info)
			{
				$this->error("查无此医师，请确认是否正确");
			}
			else {
				$this->assign('info',$info);
				$this->display ();
			}

		}

	}

	public function dafu()
	{
		$id = $_REQUEST ['id'];
		$weixin_id = $_REQUEST['weixin_id'];

		if (null == $id || null == $weixin_id)
		{
			$this->show("参数错误.");
		}

		//查询预约数据库
		$info = selectRow('order', $id);
		if (0 == $info['answer_id'] || null == $info['answer_id'])
		{
			//no one dafu already
			$data['answer_time'] = get_current_time();
			$data['answer_id'] = $weixin_id;
			if ($weixin_id == mc_option('admin_weixin_id'))
			{
				$data['answer_name'] = mc_option('weixin_name');
			}
			else if($weixin_id == mc_option('admin_weixin_id1'))
			{
				$data['answer_name'] = mc_option('weixin_name1');
			}
			else if($weixin_id == mc_option('admin_weixin_id2'))
			{
				$data['answer_name'] = mc_option('weixin_name2');
			}
			else {
				$this->show("weixin wrong");
			}
			/* update the order*/
			$ok = updateRow('order', $id, $data);
		}
		/* already dafu by others */
		/* 取出更新人员的id */
		$info = selectRow('order', $id);
		$msg = "处理人员：".$info['answer_name']."\n处理时间：".$info['answer_time'];
		$this->assign('info',$msg);
		$this->display ();
	}

	public function liucheng()
	{

		$info = mc_option ( 'liucheng' );
		$content = stripslashes ( $info );
		$content = html_entity_decode ( $content );
		$this->assign ( 'info', $content );
		$this->display ();

	}

	/**
	 * 全站搜索功能
	 * @param unknown $keyword
	 */
	public function search($keyword)
	{
		$obj = M ( 'page_catelog' );
		$sql = "select * from blkq_page_catelog where is_delt=0 and ( title like '%".$keyword."%' or content like '%".$keyword."%')  order by updatetime desc limit 10";
		$list = $obj->query($sql);
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->display();
	}


	/**
	 * 留言部分的搜索
	 * @param unknown $keyword
	 */
	public function search_liuyan($keyword)
	{
		$obj = M ( 'message' );
		$sql = "select * from blkq_message where is_reply=1 and ( ask_message like '%".$keyword."%' or reply_message like '%".$keyword."%') order by updatetime desc limit 10";
		$list = $obj->query($sql);
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->display (); // 输出模板
	}


	public function appoint()
	{
		$info = selectList($tname='doctor_catelog');
		$this->assign('info',$info);
		$this->display();
	}
	
	public function get_zbap_data(){
		$year = $_REQUEST ['year'];
		$month = $_REQUEST['month'];
		$obj = M ( 'zbap' );
		$sql = "select name,tbid from tb_member where  permission_id = 1";					
		$list = $obj->query($sql);
		$day = ($month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31));
		$time1 = strtotime($year."-".$month."-01");
		$time2 = strtotime("2015-01-01");
		$days = ceil(($time1-$time2)/86400) - 1;	
		for($i=0; $i< count($list);$i++){
			//获取每个医生的值班信息
			$sql1 = "select * from blkq_duty where mem_id = ".$list[$i]['tbid'] ." and days >= ".$days ." and days <" . ($days+$day);
			$list1 = $obj->query($sql1);
			if($list1 != null){				
				foreach ($list1 as $two){
					$add = 	$two['days'];				
					$list[$i][$add] = $two["moring"];
				}
			}			
		}			
		$this->ajaxReturn($list);	
	}
	//执行更新或者插入操作
	public function updata_zbap_data(){
		if($_REQUEST ['sid'] != mc_option("zbap_edit")){
			return;
		}
		$id = $_REQUEST ['id'];
		$name = $_REQUEST['name'];
		$duty = $_REQUEST['isDuty'];
		$obj = M ( 'duty' );
		$sql = "select * from blkq_duty where  days = ".$id." and mem_id = ".$name;
		$list = $obj->query($sql);

		if($list == null){
			//执行插
			$insert = "insert into blkq_duty (days,mem_id,moring,afternoon) values (".$id.",".$name.",".$duty.",".$duty.")";
			$obj->query($insert);
			
		}else{
			$update = "update blkq_duty set moring = ". $duty .", afternoon = ". $duty ." where days = ".$id." and mem_id = ".$name;
			$obj->query($update);
		}		
	}
	public function get_one_zbap(){
		$stid = $_REQUEST ['stid'];
		$start = $_REQUEST['start'];
		$end = $_REQUEST['end'];
		$obj = M ( 'zbap' );
		$sql = "select * from blkq_duty where mem_id = ".$stid . " and days>= ".$start . " and days< " . $end;					
		$list = $obj->query($sql);		
		$this->ajaxReturn($list);
	}
	public function updata_one_zbap(){
		if($_REQUEST ['sid'] != mc_option("zbap_edit")){
			return;
		}
		$days = $_REQUEST ['days'];
		$type = $_REQUEST['type'];
		$isDuty = $_REQUEST['isDuty'];
		$stid = $_REQUEST['stid'];
		$obj = M ( 'zbap' );
		$selcet = "select * from blkq_duty where days = " .$days . " and mem_id = " . $stid;
		$list = $obj->query($selcet);	
		if($list == null){
			//插入
			$insert = "insert into blkq_duty (days,mem_id,".$type.") values (".$days.",".$stid.",1)";
			$obj->query($insert);
		}else{
			//更新
			$update = "update blkq_duty set " . $type . " = ". $isDuty . " where days = " .$days . " and mem_id = " . $stid;
			$obj->query($update);
		}
	}
}