<?php

class MessageAction extends Action
{
	// -------------------------------liuyan--------------------//
	public function index_liuyan()
	{
		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}

		$obj = M ( 'message' );
		import ( 'ORG.Util.Page' ); // 导入分页类
		$count = $obj->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, mc_option ( 'page_num' ) ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig ( 'theme', mc_page () );
		$show = $Page->show (); // 分页显示输出, 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $obj->order ( 'updatetime desc' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page_now', $show ); // 赋值分页输出
		$this->assign ( 'count', $count );
		$this->display (); // 输出模板
	}

	public function delete_liuyan($id)
	{

		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}
		$id = I ( "param.id" );
		$ok = deleteRow ( 'message', $id );
		if ($ok)
		{
			$this->success ( "删除留言成功" );
		} else
		{
			$this->error ( "删除留言失败" );
		}

	}

	public function reply_liuyan()
	{
		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}

		$id = $_REQUEST ['id'];
		$data ['reply_message'] = I ( 'param.reply_message' );
		$data ['reply_ip'] = get_current_ip ();
		$data ['reply_user'] = session ( 'user.user_name' );
		$data ['reply_time'] = get_current_time ();
		$data ['updatetime'] = get_current_time ();
		$data ['is_reply'] = 1;

		// dump($id);
		$ok = updateRow ( 'message', $id, $data );
		if ($ok)
		{
			$this->success ( "回复成功" );
		} else
		{
			$this->error ( "回复失败" );
		}

	}

	// ---------------------------------yuyue--------------------//
	public function index_yuyue()
	{
		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}

		$obj = M ( 'order' );
		import ( 'ORG.Util.Page' ); // 导入分页类
		$count = $obj->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, mc_option ( 'page_num' ) ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig ( 'theme', mc_page () );
		$show = $Page->show (); // 分页显示输出, 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $obj->order ( 'createtime desc' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page_now', $show ); // 赋值分页输出
		$this->assign ( 'count', $count );
		$this->display (); // 输出模板
	}

	public function delete_yuyue()
	{
		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}

		$id = I ( "param.id" );
		$ok = deleteRow ( 'order', $id );
		if ($ok)
		{
			$this->success ( "删除成功" );
		} else
		{
			$this->error ( "删除失败" );
		}

	}

	public function chuli_yuyue()
	{
		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}
		$id = I ( "param.id" );
		$data['is_chuli']=1;
		$ok = updateRow('order', $id, $data) ;

		if ($ok)
		{
			$this->success ( "处理成功" );
		} else
		{
			$this->error ( "处理失败" );
		}

	}

	public function edit_yuyue()
	{
		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}
		if (null == $_REQUEST['tag'])
		{
			$id = I ( "param.id" );
			$info = selectRow('order', $id);
			//dump($info);
			$dottime = $info['dottime'];
			$arr = explode(',',$dottime);
			//dump($arr);
			$time11 = floor($arr[0]/4)+8;
			$time12 = ($arr[0]%4)*15;
			$time21 = floor($arr[1]/4)+8;
			$time22 = ($arr[1]%4)*15;
			$this->assign('time11',$time11);
			$this->assign('time12',$time12);
			$this->assign('time21',$time21);
			$this->assign('time22',$time22);
			//dump($time12.'-'.$time22);
			$this->assign('info',$info);

			/*get all doctor info*/
			$model = new Model();
			$sql = 'select id, name from blkq_doctor_catelog';
			$doctor_list = $model->query($sql);
			//dump($doctor_list);
			$this->assign('doctor_list',$doctor_list);

			$this->display();
		}
		else
		{
			$data['id']=I('param.id');
			$data['name']=I('param.name');
			$data['tel']=I('param.tel');
			$data['order_time']=I('param.order_time');

			/* order time 2 is alter */
			$time11 = I('param.time11');
			$time12 = I('param.time12');
			$time21 = I('param.time21');
			$time22 = I('param.time22');
			if ($time12*15==0)
			{
				$time12='00';
			}else
			{
				$time12=$time12*15;
			}
			//dump($time22*15);
			if ($time22*15==0)
			{
				$time22='00';
			}else {
				$time22=$time22*15;
			}
			//dump($time22);
			$data['order_time2']=$time11.":".$time12."-".$time21.":".$time22;
			$data['dottime'] = (($time11-8)*4 + $time12).','. (($time21-8)*4 + $time22);

			$data['desc']=I('param.desc');
			$data['doctor_id']=I('param.doctor_id');
			$data['yuyue_type']=I('param.yuyue_type');
			/*get doctor name by doctor id*/
			$data['doctor_name']=selectAttr('doctor', 'name', I('param.doctor_id'));
			//dump($data);
			$ok = updateRow('order', $data['id'], $data) ;

			if ($ok)
			{
				$this->success ( "编辑成功" );
			} else
			{
				$this->error ( "编辑失败" );
			}
		}
	}

	/* send weixin to doctor */
	public function hit_weixin()
	{
		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}

		/* get order id first */
		$id = I ( "param.id" );



		/*发送微信*/
		$thedata = selectRow('order', $id);
		if (null != $thedata['doctor_name']) {
			/* updaye is_reply to order*/
			$data['is_weixin']=1;
			$ok = updateRow('order', $id, $data) ;

			/*给对应的weixin_id发送微信*/
			$weixin_id = selectAttr('doctor', 'weixin_id', $thedata['doctor_id']);
			$content =urlencode("【网站预约消息】\n\n预约号:".$thedata['id']."\n患者姓名:".$thedata['name']."\n年龄段:".$thedata['age']."\n性别:".$thedata['sex']."\n电话:".$thedata['tel']."\n预约时间:".$thedata['order_time']."-".$thedata['order_time2']."\n预约类别:".$thedata['yuyue_type']."\n描述:".$thedata['desc']."\n\n请您注意");
			$id = $weixin_id;
			send_weixin($id, $content);
			$this->success("send weixin success");
		}else {
			$this->error("没有指定医师哦，请编辑指定医师~~");
		}

	}

	/* mark reply replyed to the order */
	public function hit_reply()
	{
		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}

		/* get order id first */
		$id = I ( "param.id" );

		/* updaye is_reply to order*/
		$data['is_reply']=1;
		$ok = updateRow('order', $id, $data) ;
		if ($ok)
		{
			$this->success ( "处理成功" );
		} else
		{
			$this->error ( "处理失败" );
		}
	}

	/* to add yuyue by admin */
	public function add_yuyue()
	{
		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}
		if (null == $_REQUEST['tag'])
		{
			/*get all doctor info*/
			$model = new Model();
			$sql = 'select id, name from blkq_doctor_catelog';
			$doctor_list = $model->query($sql);
			//dump($doctor_list);
			$this->assign('doctor_list',$doctor_list);

			$this->display();
		}
		else
		{
			$data['name']=I('param.name');
			$data['sex']=I('param.sex');
			$data['age']=I('param.age');
			$data['tel']=I('param.tel');
			$data['order_time']=I('param.order_time');
			//$data['order_time2']=I('param.order_time2');

			/* order time 2 is alter */
			$time11 = I('param.time11');
			$time12 = I('param.time12');
			$time21 = I('param.time21');
			$time22 = I('param.time22');
			if ($time12*15==0)
			{
				$time12='00';
			}else
			{
				$time12=$time12*15;
			}
			//dump($time22*15);
			if ($time22*15==0)
			{
				$time22='00';
			}else {
				$time22=$time22*15;
			}
			//dump($time22);
			$data['order_time2']=$time11.":".$time12."-".$time21.":".$time22;
			$data['dottime'] = (($time11-8)*4 + $time12).','. (($time21-8)*4 + $time22);

			$data['desc']=I('param.desc');
			$data['doctor_id']=I('param.doctor_id');
			$data['yuyue_type']=I('param.yuyue_type');
			$data ['createtime'] = get_current_time ();
			$data['ip']=get_current_ip();
			/*get doctor name by doctor id*/
			$data['doctor_name']=selectAttr('doctor', 'name', I('param.doctor_id'));
			//dump($data);
			$ok = insertRow('order', $data);

			if ($ok)
			{
				$this->success ( "添加成功",U('Message/index_yuyue') );
			} else
			{
				$this->error ( "添加失败",U('Message/index_yuyue') );
			}
		}
	}
}