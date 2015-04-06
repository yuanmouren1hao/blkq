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
			$data ['name'] = I ( 'param.name' );
			$data ['age'] = I ( 'param.age' );
			$data ['sex'] = I ( 'param.sex' );
			$data ['tel'] = I ( 'param.tel' );
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

			// dump($data);
			$ok = M ( "Order" )->add ( $data );
			//dump($ok);
			if ($ok)
			{
				// success
				$this->success ( "您的预约号是：" . $ok .'    ,我们将会尽快安排助手联系您。'   ,'index');
				$content=$data ['name']."-".$data ['sex'].'在网站上进行了预约。预约时间是：  '.$data ['order_time'].' '.$data ['order_time2'].'。  预约号：'.$ok.'   预约的联系方式是：'.$data ['tel'].'   症状描述是：'.$data ['desc'];
				send_email(mc_option('hos_mail'), '有人预约', $content);

				/* do send weixin to admin */
				$weixin_content="【网站有人预约】\n\n预约号：".$ok."\n患者姓名：".$data['name']."\n预约时间：".$data ['order_time']."-".$data ['order_time2']."\n联系方式：".$data ['tel']."\n症状描述：".$data ['desc']."\n\n<a href='".mc_option('site_url')."/wap.php/index-dafu.html?id=".$ok."&weixin_id=".mc_option('admin_weixin_id')."'>请点击处理</a>";
				send_weixin(mc_option('admin_weixin_id'), urlencode($weixin_content));

				if(mc_option('admin_weixin_id1')){
					$weixin_content="【网站有人预约】\n\n预约号：".$ok."\n患者姓名：".$data['name']."\n预约时间：".$data ['order_time']."-".$data ['order_time2']."\n联系方式：".$data ['tel']."\n症状描述：".$data ['desc']."\n\n <a href='".mc_option('site_url')."/wap.php/index-dafu.html?id=".$ok."&weixin_id=".mc_option('admin_weixin_id1')."'>请点击处理</a>";
					send_weixin(mc_option('admin_weixin_id1'), urlencode($weixin_content));
				}
				if(mc_option('admin_weixin_id2')){
					$weixin_content="【网站有人预约】\n\n预约号：".$ok."\n患者姓名：".$data['name']."\n预约时间：".$data ['order_time']."-".$data ['order_time2']."\n联系方式：".$data ['tel']."\n症状描述：".$data ['desc']."\n\n<a href='".mc_option('site_url')."/wap.php/index-dafu.html?id=".$ok."&weixin_id=".mc_option('admin_weixin_id1')."'>请点击处理</a>";
					send_weixin(mc_option('admin_weixin_id2'), urlencode($weixin_content));
				}
			} else
			{
				$this->error ( "预约失败~~" );
			}
		} else
		{
			/*展示预约的页面*/
			$id = $_REQUEST['id'];
			$info = selectRow('doctor', $id);
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

}