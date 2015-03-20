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
			$model = M ( "doctor" );
			$doctor = $model->where ( "tel = '" . $name . "' and weixin_id= '" . $password . "' " )->limit ( 1 )->find ();
				
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
		$list = $obj->where('doctor_id='.$id)->order ( 'createtime desc' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page_now', $show ); // 赋值分页输出
		$this->assign ( 'count', $count );
		$this->display (); // 输出模板
	}


	public function index_doctor()
	{

		if (! is_login ())
		{
			$this->error ( "还没有登陆哦~~", U ( "index/login" ) );
		}
		$obj = M ( 'doctor_catelog' );
		import ( 'ORG.Util.Page' ); // 导入分页类
		$count = $obj->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, mc_option ( 'page_num' ) ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig ( 'theme', mc_page () );
		$show = $Page->show (); // 分页显示输出, 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $obj->order ( 'age' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page_now', $show ); // 赋值分页输出
		$this->assign ( 'count', $count );
		$this->display (); // 输出模板
	}

	public function add_doctor()
	{

		if (! is_login ())
		{
			$this->error ( "还没有登陆哦~~", U ( "index/login" ) );
		}
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
			$ok = insertRow ( 'doctor', $data );
			// dump($data);
			if ($ok)
			{
				$this->success ( "添加医师成功" );
			} else
			{
				$this->error ( "添加医师失败" );
			}
		} else
		{
			$cate_list = aop_get_catelog_child_list ( '医师团队' );
			$this->assign ( 'cate_list', $cate_list );
			$this->display ();
		}
	
	}

	public function edit_doctor($id)
	{

		if (! is_login ())
		{
			$this->error ( "还没有登陆哦~~", U ( "index/login" ) );
		}
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

			$ok = updateRow ( 'doctor', $id, $data );
			if ($ok)
			{
				$this->success ( "更新成功", U ( "doctor/index_doctor" ) );
			} else
			{
				$this->error ( "更新失败" );
			}
		} else
		{
			$id = I ( "param.id" );
			$info = selectRow ( 'doctor_catelog', $id );
			$cate_list = aop_get_catelog_child_list ( '医师团队' );
			$this->assign ( 'cate_list', $cate_list );
			$this->assign ( 'info', $info );
			$this->display ();
		}
	
	}

	public function delete_doctor($id)
	{

		if (! is_login ())
		{
			$this->error ( "还没有登陆哦~~", U ( "index/login" ) );
		}
		$id = I ( "param.id" );
		$ok = deleteRow ( 'doctor', $id );
		if ($ok)
		{
			$this->success ( "删除医师成功" );
		} else
		{
			$this->error ( "删除医师失败" );
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