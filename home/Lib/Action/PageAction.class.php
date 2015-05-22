<?php

class PageAction extends Action
{

	public function index()
	{

		$this->display ();

	}

	public function page_list()
	{

		$child = $_REQUEST ['child'];
		$father = $_REQUEST ['father'];
		if ($child == null or $father == null)
		{
			$this->error ( "呃，发生了一点小错误了呢~~" );
		}

		$obj = M ( 'page_catelog' );
		import ( 'ORG.Util.Page' ); // 导入分页类
		$count = $obj->where ( 'father="' . $father . '" and child="' . $child . '" and is_delt=0 ' )->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, mc_option ( 'page_num' ) ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig ( 'theme', mc_page () );
		$show = $Page->show (); // 分页显示输出, 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $obj->where ( 'father="' . $father . '" and child="' . $child . '" and is_delt=0 ' )->order ( 'updatetime desc' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page_now', $show ); // 赋值分页输出
		$this->assign ( 'count', $count );
		$this->display (); // 输出模板
	}

	public function page_detail()
	{

		$child = $_REQUEST ['child'];
		$father = $_REQUEST ['father'];
		$id = $_REQUEST['id'];

		//dump($id);
		if (($child == null || $father == null) && $id == null)
		{
			$this->error ( "呃，发生了一点小错误了呢~~" );
		}

		// get page info
		if ($id == null){
			$info = M ( "page_catelog" )->where ( "father='" . $father . "' and child='" . $child . "' and is_delt=0" )->order ( 'updatetime desc' )->limit ( 1 )->find ();
		}else {
			$info = M('page_catelog')->where('id = '.$id)->find();
		}

		//check info exist
		if ($info == null)
		{
			$this->error ( "呃，该栏目下还没有文章呢，等待管理员添加哟~~" );
		}

		$content = stripslashes ( $info ['content'] );
		$info ['content'] = html_entity_decode ( $content );
		$this->assign ( 'info', $info );
		setInc ( 'page', $info ['id'], 'read_num', 1 );
		$this->display ();

	}

}