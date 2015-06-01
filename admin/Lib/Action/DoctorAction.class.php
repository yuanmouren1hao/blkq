<?php

class DoctorAction extends Action
{

	// ----------------------------------doctor------------------------//
	public function login()
	{
		$tag = $_REQUEST ['tag'];
		if ($tag)
		{
			$name = $_REQUEST ['name'];
			$password = $_REQUEST ['password'];
			if ($_SESSION ['verify'] != md5 ( $_POST ['verify'] ))
			{
				$this->error ( "验证码错误！");
			}

			/* get doctor info */
			$password = md5($password);
			//dump($password);
			$model = M ( "doctor" );
			$doctor = $model->where ( "tel = '" . $name . "' and password= '" . $password . "' " )->limit ( 1 )->find ();

			if ($doctor)
			{
				$_SESSION ['DOCTOR'] = $doctor;
				$this->success ( $user ['user_name'] . "登陆成功", U ( "doctor/index" ) );
			} else
			{
				$this->error ( "登录失败~~" );
			}
		} else
		{
			$this->display ();
		}
	}



	/*
	 * doctor退出登陆操作
	 */
	public function logout()
	{

		if (session ( 'DOCTOR.name' ))
		{
			$_SESSION ['DOCTOR'] = null;
			$this->success ( "退出成功", U ( 'doctor/login' ) );
		} else
		{
			$this->error ( '额，未知错误~~', U ( 'doctor/login' ) );
		}

	}

	public function index()
	{
		$doctor_id = session ( 'DOCTOR.name' );
		if (empty ( $doctor_id )){
			$this->error("还没有登陆哦~~",U("doctor/login"));
		}
		$id = session ( 'DOCTOR.id' );

		$obj = M ( 'order' );
		import ( 'ORG.Util.Page' ); // 导入分页类
		$count = $obj->where('doctor_id='.$id)->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, mc_option ( 'page_num' ) ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig ( 'theme', mc_page () );
		$show = $Page->show (); // 分页显示输出, 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $obj->where('doctor_id='.$id)->order ( 'order_time desc ,dottime asc' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page_now', $show ); // 赋值分页输出
		$this->assign ( 'count', $count );
		$this->display (); // 输出模板
	}

	public function queryUser()
	{
		$name = $_REQUEST['name'];
		$tel = $_REQUEST['tel'];

		//echo ($name.$tel);
		if($name==null || $tel ==null)
		{
			$data['code']=0;
			$data['msg']='param set wrong';
			$this->ajaxReturn($data);
		}

		$info = selectList('order',"name ='".$name."' and tel = '".$tel."' ",'createtime',0);
		$this->ajaxReturn($info);

	}

	/* yuanzhang login page*/
	public function yuanzhang_login()
	{
		$tag = $_REQUEST ['tag'];
		if ($tag)
		{
			$name = $_REQUEST ['name'];
			$password = $_REQUEST ['password'];
			if ($_SESSION ['verify'] != md5 ( $_POST ['verify'] ))
			{
				$this->error ( "验证码错误！");
			}

			/* get doctor info */
			$password = md5($password);
			if ($name==mc_option('yuanzhang_name') && $password==mc_option("yuanzhang_password")) {
				$ok=1;
			}

			if ($ok)
			{
				$_SESSION ['BLKQ'] = mc_option("yuanzhang_name");
				$this->success ( $name . "  登陆成功", U ( "doctor/yuanzhang_index" ) );
			} else
			{
				$this->error ( "登录失败~~" );
			}
		} else
		{
			$this->display ();
		}
	}

	public function yuanzhang_logout()
	{
		if (session ( 'BLKQ' ))
		{
			$_SESSION ['BLKQ'] = null;
			$this->success ( "退出成功", U ( 'doctor/yuanzhang_login' ) );
		} else
		{
			$this->error ( '额，未知错误~~', U ( 'doctor/yuanzhang_login' ) );
		}
	}

	/* get yuanzhang index show pages */
	public function yuanzhang_index()
	{
		$tag = $_REQUEST['tag'];
		if ($tag=='tag') {
			$bengin_time = $_REQUEST['begin_time'];
			$end_time = $_REQUEST['end_time'];
			$name = $_REQUEST['name'];

			if (null == $bengin_time) {
				$bengin_time='2000-01-01';
			}
			if (null == $end_time) {
				$end_time = '3000-12-31';
			}

			/* begin time is bigger than end time */
			if ($bengin_time > $end_time) {
				$this->error("您选择的开始时间大于结束时间");
			}

			//dump($bengin_time.$end_time);

			$obj = M ( 'order' );
			import ( 'ORG.Util.Page' ); // 导入分页类
			if (null == $name) {
				$count = $obj->where("order_time>='".$bengin_time."' and order_time <= '".$end_time."'")->count (); // 查询满足要求的总记录数
			}else{
				$count = $obj->where("order_time>='".$bengin_time."' and order_time <= '".$end_time."'and doctor_name like '%".$name."%'")->count (); // 查询满足要求的总记录数
			}
			//$count = $obj->where("order_time>='".$bengin_time."' and order_time <= '".$end_time."'")->count (); // 查询满足要求的总记录数
			$Page = new Page ( $count, mc_option ( 'page_num' ) ); // 实例化分页类 传入总记录数和每页显示的记录数
			$Page->setConfig ( 'theme', mc_page () );
			$show = $Page->show (); // 分页显示输出, 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			if (null == $name) {
				$list = M('order')->where("order_time>='".$bengin_time."' and order_time <= '".$end_time."'")->order ( 'doctor_id' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
			}else{
				$list = M('order')->where("order_time>='".$bengin_time."' and order_time <= '".$end_time."' and doctor_name like '%".$name."%'")->order ( 'doctor_id' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
			}

			$this->assign ( 'list', $list ); // 赋值数据集
			$this->assign ( 'page_now', $show ); // 赋值分页输出
			$this->assign ( 'count', $count );
			$this->display (); // 输出模板


		}
		elseif ($tag=='export')
		{
			$bengin_time = $_REQUEST['begin_time'];
			$end_time = $_REQUEST['end_time'];
			$name = $_REQUEST['name'];

			if (null == $bengin_time) {
				$bengin_time='2000-01-01';
			}
			if (null == $end_time) {
				$end_time = '3000-12-31';
			}

			/* begin time is bigger than end time */
			if ($bengin_time > $end_time) {
				$this->error("您选择的开始时间大于结束时间");
			}
			//dump($end_time);

			if (null == $name) {
				$list = M('order')->where("order_time>='".$bengin_time."' and order_time <= '".$end_time."'")->field("id,doctor_name,yuyue_type,order_time,order_time2,name,sex,age,tel,is_chuli,desc")->order ( 'doctor_id' )->select ();
			}else{
				$list = M('order')->where("order_time>='".$bengin_time."' and order_time <= '".$end_time."' and doctor_name like '%".$name."%'")->field("id,doctor_name,yuyue_type,order_time,order_time2,name,sex,age,tel,is_chuli,desc")->order ( 'doctor_id' )->select ();
			}
			$title = array('预约号','医师姓名','预约类型','预约时间','预约时间段','患者姓名','患者性别','患者年龄','患者电话','处理状态','描述');
			$filename = get_current_time();
			exportexcel($data=$list, $title, $filename);
		}
		else {

			$obj = M ( 'order' );
			import ( 'ORG.Util.Page' ); // 导入分页类
			$count = $obj->count (); // 查询满足要求的总记录数
			$Page = new Page ( $count, mc_option ( 'page_num' ) ); // 实例化分页类 传入总记录数和每页显示的记录数
			$Page->setConfig ( 'theme', mc_page () );
			$show = $Page->show (); // 分页显示输出, 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			//$list = $obj->limit ( $Page->firstRow . ',' . $Page->listRows )->order ( 'doctor_id' )->field("id,doctor_name,yuyue_type,order_time,order_time2,desc,is_chuli,answer_name")->select ();
			$sql = "select * from blkq_order  ORDER BY doctor_id limit " . $Page->firstRow . ',' . $Page->listRows ;
			$this->assign ( 'list', $obj->query($sql) ); // 赋值数据集
				
				
			$this->assign ( 'page_now', $show ); // 赋值分页输出
			$this->assign ( 'count', $count );
			$this->display (); // 输出模板

		}
	}




	public function index_doctor()
	{
		$obj = new Model();
		$count_list = $obj->query("select count(*) from blkq_doctor_catelog");
		$count = $count_list[0]["count(*)"];
		//$obj = M ( 'member' );
		import ( 'ORG.Util.Page' ); // 导入分页类
		//$count = $obj->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, mc_option ( 'page_num' ) ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig ( 'theme', mc_page () );
		$show = $Page->show (); // 分页显示输出, 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		//$list = $obj->order ( 'age' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		$list = $obj->query("select * from blkq_doctor_catelog limit ".$Page->firstRow . ',' . $Page->listRows);
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page_now', $show ); // 赋值分页输出
		$this->assign ( 'count', $count );
		$this->display (); // 输出模板
	}

	public function add_doctor()
	{

		$tag = $_REQUEST ['tag'];
		// dump($tag);
		if ($tag)
		{
			$data ['name'] = I ( 'param.name' );
			$data ['sex'] = I ( 'param.sex' );
			$data ['age'] = I ( 'param.age' );
			$data ['title'] = I ( 'param.title' );
			$data ['tel'] = I ( 'param.tel' );
			$data ['mail'] = I ( 'param.mail' );
			$data ['image'] = I ( 'param.image' );
			$data ['desc'] = I ( 'param.desc' );
			$data ['content'] = I ( 'param.content' );
			$data ['createtime'] = get_current_time ();
			$data ['updatetime'] = get_current_time ();
			$data ['catelog_id'] = I ( 'param.catelog_id' );
				
			$data ['weixin_id'] = I ( 'param.weixin_id' );
			$data ['password'] = sha1('12345');
			$obj = new Model();
			$sql = "insert into tb_member (permission_id,type,username,name,sex,age,title,tel,mail,image,tb_member.desc,content,createtime,updatetime,catelog_id,weixin_id,password) values ('1','1','".I ( 'param.name' )."','".I ( 'param.name' )."'," .
					"'".I ( 'param.sex' )."','".$data ['age']."','".I ( 'param.title' )."','".I ( 'param.tel' )."','". I ( 'param.mail' )."','".I ( 'param.image' )."','".I ( 'param.desc' )."'," .
							"'".I ( 'param.content' )."','".get_current_time ()."','".get_current_time ()."','".I ( 'param.catelog_id' )."','".I ( 'param.weixin_id' )."','".sha1('12345')."')";
			$ok = $obj->query($sql);
			//$ok = insertRow ( 'doctor', $data );
			// dump($data);
			$this->success ( "添加医师成功，医师初始密码为12345，请尽快通知修改。" );
				
		} else
		{
			$cate_list = aop_get_catelog_child_list ( '医师团队' );
			$this->assign ( 'cate_list', $cate_list );
			$this->display ();
		}

	}

	public function edit_doctor($id)
	{

		$tag = $_REQUEST ['tag'];
		if ($tag)
		{
			$id = I ( 'param.id' );
			$data ['name'] = I ( 'param.name' );
			$data ['sex'] = I ( 'param.sex' );
			$data ['age'] = I ( 'param.age' );
			$data ['title'] = I ( 'param.title' );
			$data ['tel'] = I ( 'param.tel' );
			$data ['mail'] = I ( 'param.mail' );
			$data ['image'] = I ( 'param.image' );
			$data ['desc'] = I ( 'param.desc' );
			$data ['content'] = I ( 'param.content' );
			$data ['updatetime'] = get_current_time ();
			$data ['catelog_id'] = I ( 'param.catelog_id' );
			$data ['weixin_id'] = I ( 'param.weixin_id' );
				
			$obj = new Model();
			//desc='".$data ['desc']."',content='".$data ['content']."',
			$sql = "update tb_member set name = '".$data ['name']."',username='".$data ['name']."',sex='".$data ['sex']."',age='".$data ['age']."',title='".$data ['title']."',tel='".$data ['tel']."'," .
					"mail = '".$data ['mail']."',updatetime='".$data ['updatetime']."',catelog_id='".$data ['catelog_id']."'," .
					"weixin_id='".$data ['weixin_id']."',tb_member.desc='".$data ['desc']."',content='".$data ['content']."' where tbid = " .$id;
				
			$ok = $obj->query($sql);
            $this->success ( "更新成功", U ( "doctor/index_doctor" ) );

		} else
		{
			$id = I ( "param.id" );
			//$info = selectRow ( 'tb_member', $id );
			$mod = new Model();
			$info = $mod->query("select * from blkq_doctor_catelog where tbid = ".$id);
				
			$cate_list = aop_get_catelog_child_list ( '医师团队' );
			$this->assign ( 'cate_list', $cate_list );
			$this->assign ( 'info', $info[0] );
			$this->display ();
		}

	}

	public function delete_doctor($id)
	{
		$id = I ( "param.id" );
		$obj = new Model();
		$sql = "delete from tb_member where tbid = ".$id;
		$obj->query($sql);
		//$ok = deleteRow ( 'doctor', $id );
		$this->success ( "删除医师成功" );
	}

	/* set doctor init secret as 12345678*/
	public function init_secret()
	{

		/* get id */
		$id = I ( "param.id" );
		$old_secret = selectAttr('doctor', 'password', $id);
		if($old_secret == sha1('12345'))
		{
			$this->success ( "操作成功" );
		}
		else {
			$data['password'] = sha1('12345');
			$obj = new Model();
				
			var_dump("update tb_member set password = '". $data['password'] ."' where tbid = ". $id);
			return;
				
			$ok = $obj->query("update tb_member set password = '". $data['password'] ."' where tbid = ". $id);
			//$ok = updateRow('doctor', $id, $data);

			if ($ok)
			{
				$this->success ( "操作成功" );
			} else
			{
				$this->error ( "操作失败" );
			}
		}
	}

	// -----------------------------------huanjing------------------------//
	public function index_huanjing()
	{

		if (! is_login ())
		{
			$this->error ( "还没有登陆哦~~", U ( "index/login" ) );
		}
		$obj = M ( 'huanjing_catelog' );
		import ( 'ORG.Util.Page' ); // 导入分页类
		$count = $obj->where ( "type='huanjing'" )->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, mc_option ( 'page_num' ) ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig ( 'theme', mc_page () );
		$show = $Page->show (); // 分页显示输出, 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $obj->where ( "type='huanjing'" )->order ( 'updatetime desc' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page_now', $show ); // 赋值分页输出
		$this->assign ( 'count', $count );
		$this->display (); // 输出模板
	}

	public function add_huanjing()
	{

		if (! is_login ())
		{
			$this->error ( "还没有登陆哦~~", U ( "index/login" ) );
		}

		$tag = $_REQUEST ['tag'];
		// dump($tag);
		if ($tag)
		{
			$data ['image'] = I ( 'param.image' );
			$data ['desc'] = I ( 'param.desc' );
			$data ['content'] = I ( 'param.content' );
			$data ['createtime'] = get_current_time ();
			$data ['updatetime'] = get_current_time ();
			$data ['catelog_id'] = I ( 'param.catelog_id' );
			$data ['type'] = 'huanjing';
			$ok = insertRow ( 'huanjing', $data );
			// dump($data);
			if ($ok)
			{
				$this->success ( "添加成功" );
			} else
			{
				$this->error ( "添加失败" );
			}
		} else
		{
			$cate_list = aop_get_catelog_child_list ( '优雅环境' );
			$this->assign ( 'cate_list', $cate_list );
			$this->display ();
		}

	}

	public function edit_huanjing()
	{

		if (! is_login ())
		{
			$this->error ( "还没有登陆哦~~", U ( "index/login" ) );
		}
		$id = I ( "param.id" );
		if ($id == null)
		{
			$this->error ( "发生了一点小错误~~" );
		}

		$tag = $_REQUEST ['tag'];
		// dump($tag);
		if ($tag)
		{

			$data ['image'] = I ( 'param.image' );
			$data ['desc'] = I ( 'param.desc' );
			$data ['content'] = I ( 'param.content' );
			$data ['updatetime'] = get_current_time ();
			$data ['catelog_id'] = I ( 'param.catelog_id' );
			$ok = updateRow ( 'huanjing', $id, $data );
			// dump($data);
			if ($ok)
			{
				$this->success ( "修改成功" );
			} else
			{
				$this->error ( "修改失败" );
			}
		} else
		{
			$info = selectRow ( 'huanjing_catelog', $id );
			$cate_list = aop_get_catelog_child_list ( '优雅环境' );
			$this->assign ( 'cate_list', $cate_list );
			$this->assign ( 'info', $info );
			$this->display ();
		}

	}


	public function edit_shebei()
	{

		if (! is_login ())
		{
			$this->error ( "还没有登陆哦~~", U ( "index/login" ) );
		}
		$id = I ( "param.id" );
		if ($id == null)
		{
			$this->error ( "发生了一点小错误~~" );
		}

		$tag = $_REQUEST ['tag'];
		// dump($tag);
		if ($tag)
		{

			$data ['image'] = I ( 'param.image' );
			$data ['desc'] = I ( 'param.desc' );
			$data ['content'] = I ( 'param.content' );
			$data ['updatetime'] = get_current_time ();
			$data ['catelog_id'] = I ( 'param.catelog_id' );
			$ok = updateRow ( 'huanjing', $id, $data );
			// dump($data);
			if ($ok)
			{
				$this->success ( "修改成功" );
			} else
			{
				$this->error ( "修改失败" );
			}
		} else
		{
			$info = selectRow ( 'huanjing_catelog', $id );
			$cate_list = aop_get_catelog_child_list ( '领先设备' );
			$this->assign ( 'cate_list', $cate_list );
			$this->assign ( 'info', $info );
			$this->display ();
		}

	}


	public function delete_huanjing($id)
	{

		if (! is_login ())
		{
			$this->error ( "还没有登陆哦~~", U ( "index/login" ) );
		}
		$id = I ( "param.id" );
		$ok = deleteRow ( 'huanjing', $id );
		if ($ok)
		{
			$this->success ( "删除成功" );
		} else
		{
			$this->error ( "删除失败" );
		}

	}

	// -------------------------------------------shebei-------------------------//
	public function index_shebei()
	{

		if (! is_login ())
		{
			$this->error ( "还没有登陆哦~~", U ( "index/login" ) );
		}
		$obj = M ( 'huanjing_catelog' );
		import ( 'ORG.Util.Page' ); // 导入分页类
		$count = $obj->where ( 'type="shebei"' )->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, mc_option ( 'page_num' ) ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig ( 'theme', mc_page () );
		$show = $Page->show (); // 分页显示输出, 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $obj->where ( 'type="shebei"' )->order ( 'updatetime desc' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page_now', $show ); // 赋值分页输出
		$this->assign ( 'count', $count );
		$this->display (); // 输出模板
	}

	public function add_shebei()
	{

		if (! is_login ())
		{
			$this->error ( "还没有登陆哦~~", U ( "index/login" ) );
		}
		$tag = $_REQUEST ['tag'];
		// dump($tag);
		if ($tag)
		{
			$data ['image'] = I ( 'param.image' );
			$data ['desc'] = I ( 'param.desc' );
			$data ['content'] = I ( 'param.content' );
			$data ['createtime'] = get_current_time ();
			$data ['updatetime'] = get_current_time ();
			$data ['catelog_id'] = I ( 'param.catelog_id' );
			$data ['type'] = 'shebei';
			$ok = insertRow ( 'huanjing', $data );
			// dump($data);
			if ($ok)
			{
				$this->success ( "添加成功" );
			} else
			{
				$this->error ( "添加失败" );
			}
		} else
		{
			$cate_list = aop_get_catelog_child_list ( '领先设备' );
			$this->assign ( 'cate_list', $cate_list );
			$this->display ();
		}

	}

	public function delete_shebei($id)
	{

		if (! is_login ())
		{
			$this->error ( "还没有登陆哦~~", U ( "index/login" ) );
		}
		$id = I ( "param.id" );
		$ok = deleteRow ( 'huanjing', $id );
		if ($ok)
		{
			$this->success ( "删除成功" );
		} else
		{
			$this->error ( "删除失败" );
		}

	}

	// -----------------------------------------------video------------------------//
	public function index_video()
	{

		if (! is_login ())
		{
			$this->error ( "还没有登陆哦~~", U ( "index/login" ) );
		}
		$obj = M ( 'page' );
		import ( 'ORG.Util.Page' ); // 导入分页类
		$count = $obj->where ( 'catelog_id=3100000044' )->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, mc_option ( 'page_num' ) ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig ( 'theme', mc_page () );
		$show = $Page->show (); // 分页显示输出, 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $obj->where ( 'catelog_id=3100000044' )->order ( 'updatetime desc' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page_now', $show ); // 赋值分页输出
		$this->assign ( 'count', $count );
		$this->display (); // 输出模板
	}

	public function add_video()
	{

		if (! is_login ())
		{
			$this->error ( "还没有登陆哦~~", U ( "index/login" ) );
		}
		$tag = $_REQUEST ['tag'];
		// dump($tag);
		if ($tag)
		{
			$data ['title'] = I ( 'param.title' );
			$data ['content'] = I ( 'param.content' );
			$data ['createtime'] = get_current_time ();
			$data ['updatetime'] = get_current_time ();
			$data ['catelog_id'] = 3100000044;
			$data ['author'] = I ( 'param.author' );
			$data ['createtime'] = get_current_time ();
			$data ['read_num'] = 1;
			$data ['updatetime'] = get_current_time ();
			$data ['fmimg_m'] = I ( 'param.fmimg_m' );
			$data ['fmimg_s'] = I ( 'param.fmimg_s' );
			$data ['fmimg_b'] = I ( 'param.fmimg_b' );
			$data ['is_delt'] = 0;
			$ok = insertRow ( 'page', $data );
			// dump($data);
			if ($ok)
			{
				$this->success ( "添加成功" );
			} else
			{
				$this->error ( "添加失败" );
			}
		} else
		{
			$this->display ();
		}

	}

	public function delete_video($id)
	{

		if (! is_login ())
		{
			$this->error ( "还没有登陆哦~~", U ( "index/login" ) );
		}
		$id = I ( "param.id" );
		$ok = deleteRow ( 'page', $id );
		if ($ok)
		{
			$this->success ( "删除成功" );
		} else
		{
			$this->error ( "删除失败" );
		}

	}

}