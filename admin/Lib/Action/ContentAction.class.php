<?php

class ContentAction extends Action
{

	public function index($page = 1)
	{
		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}
		$this->assign ( 'catelog', aop_get_catelog_father_list () );
		
		$key=$_REQUEST['key'];
		if ($key==null) {
			$obj = M ( 'page_catelog' );
			import ( 'ORG.Util.Page' ); // 导入分页类
			$count = $obj->where ( "is_delt=0 and father not in ('口腔视频','优雅环境','医师团队','领先设备')" )->count (); // 查询满足要求的总记录数
			$Page = new Page ( $count, mc_option ( 'page_num' ) ); // 实例化分页类 传入总记录数和每页显示的记录数
			$Page->setConfig ( 'theme', mc_page());
			$show = $Page->show (); // 分页显示输出, 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			$list = $obj->where ( "is_delt=0 and father not in ('口腔视频','优雅环境','医师团队','领先设备')" )->order ( 'updatetime desc' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
			$this->assign ( 'list', $list ); // 赋值数据集
			$this->assign ( 'page_now', $show ); // 赋值分页输出
			$this->assign ( 'count', $count );
			$this->display (); // 输出模板
		}else {
			$obj = M ( 'page_catelog' );
			import ( 'ORG.Util.Page' ); // 导入分页类
			$count = $obj->where ( "is_delt=0 and father not in ('口腔视频','优雅环境','医师团队','领先设备') and father='".$key."'" )->count (); // 查询满足要求的总记录数
			$Page = new Page ( $count, mc_option ( 'page_num' ) ); // 实例化分页类 传入总记录数和每页显示的记录数
			$Page->setConfig ( 'theme', mc_page());
			$show = $Page->show (); // 分页显示输出, 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			$list = $obj->where ( "is_delt=0 and father not in ('口腔视频','优雅环境','医师团队','领先设备') and father='".$key."'")->order ( 'updatetime desc' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
			$this->assign ( 'list', $list ); // 赋值数据集
			$this->assign ( 'page_now', $show ); // 赋值分页输出
			$this->assign ( 'count', $count );
			$this->display (); // 输出模板
		}

		
	}

	
	public function rublish()
	{
		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}
		$obj = M ( 'page_catelog' );
		import ( 'ORG.Util.Page' ); // 导入分页类
		$count = $obj->where ( "is_delt=1  and father not in ('口腔视频','优雅环境','医师团队','领先设备')" )->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, mc_option ( 'page_num' ) ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig ( 'theme', mc_page());
		$show = $Page->show (); // 分页显示输出, 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $obj->where ( "is_delt=1  and father not in ('口腔视频','优雅环境','医师团队','领先设备')" )->order ( 'updatetime desc' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page_now', $show ); // 赋值分页输出
		$this->assign ( 'count', $count );
		$this->display (); // 输出模板
	}
	
	
	public function add()
	{
		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}

		$tag = $_REQUEST ['tag'];
		if ($tag)
		{
			$data ['catelog_id'] = I ( 'param.catelog_id' ) / 1;
			$data ['title'] = I ( 'param.title' );
			$data ['content'] = I ( 'param.content' );
			$data ['author'] = I ( 'param.author' );
			$data ['createtime'] = get_current_time ();
			$data ['read_num'] = 1;
			$data ['updatetime'] = get_current_time ();
			$data ['is_delt'] = 0;
			// dump($data);
			$ok = insertRow ( 'page', $data );
			if ($ok)
			{
				$this->success ( "添加成功" );
			} else
			{
				$this->error ( "添加失败" );
			}
		} else
		{
			$this->assign ( 'catelog', aop_get_catelog_father_list () );
			$this->display ();
		}
	
	}
	

	public function edit()
	{
		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}
		
		$tag=$_REQUEST['tag'];
		if ($tag) {
			$id=I('param.id');
			$data['catelog_id']=I('param.catelog_id');
			$data['author']=I('param.author');
			$data['title']=I('param.title');
			$data['content']=I('param.content');
			$data['updatetime']=get_current_time();
			$ok= updateRow('page', $id, $data);
			if ($ok) {
				$this->success("更新成功");
			}else {
				$this->error("更新失败");
			}
		}else
		{
			$id=I("param.id");
			$info = selectRow('page_catelog', $id);
			$this->assign('info',$info);
			$this->catelog=aop_get_catelog_father_list();
			$this->display ();
		}
	}

	public function delete()
	{
		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}
		
		$id=I("param.id");
		$ok = updateField('page', 'id='.$id, 'is_delt', 1);
		if ($ok)
		{
			$this->success ( "删除成功" );
		} else
		{
			$this->error ( "删除失败" );
		}	
	}
	
	public function reget()
	{
		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}
		$id=I("param.id");
		$ok = updateField('page', 'id='.$id, 'is_delt', 0);
		if ($ok)
		{
			$this->success ( "恢复成功" );
		} else
		{
			$this->error ( "恢复失败" );
		}
	}
	
	public function remove()
	{
		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}
		$id=I("param.id");
		$ok=deleteRow('page', $id);
		if ($ok)
		{
			$this->success ( "彻底删除成功" );
		} else
		{
			$this->error ( "彻底删除失败" );
		}
	}
	
	

}