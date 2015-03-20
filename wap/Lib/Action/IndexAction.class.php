<?php
class IndexAction extends Action
{

	public function index()
	{
		/*new list*/
		$news_list = M ( "page_catelog" )->where ( 'father="医院动态" and is_delt=0' )->order ( 'updatetime desc' )->limit ( 5 )->select ();
		$this->assign ( 'news_list', $news_list );
		
		/*doctor list*/
		$list = M('doctor')->order ( 'age' )->limit ( 4 )->select ();
		//dump($list);
		$this->assign ( 'list_d', $list ); // 赋值数据集
		
		$this->display();
	
	}
	
	
	public function newslist()
	{
		/*new list*/
		$news_list = M ( "page_catelog" )->where ( 'father="医院动态" and is_delt=0' )->order ( 'updatetime desc' )->limit ( 9 )->select ();
		$this->assign ( 'news_list', $news_list );
		$this->display();
	}
	
	
	public function newscontent()
	{
		/*news content*/
		$id = $_REQUEST['id'];
		$info = selectRow('page_catelog', $id);
		$c = stripslashes ( $info['content'] );
		$info['content'] = html_entity_decode ( $c );
		$this->assign('info',$info);
		//dump($info);
		$this->display();
	}
	
	
	public function doclist()
	{
		/*doctor list*/
		$list = M('doctor')->order ( 'age' )->select ();
		//dump($list);
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->display();
	}
	
	
	public function doccontent()
	{
		/*get doctor info */
		$id = $_REQUEST['id'];
		$info = selectRow('doctor', $id);
		$this->assign('info',$info);
		$this->display();
	}
	
	public function appoint()
	{
		$this->display();
	}
	
	public function content()
	{
		$child = $_REQUEST ['child'];
		$father = $_REQUEST ['father'];
		if ($child == null or $father == null)
		{
			$this->show ( "呃，发生了一点小错误了呢~~" );
		}
		
		$info = M ( "page_catelog" )->where ( "father='" . $father . "' and child='" . $child . "' and is_delt=0" )->order ( 'updatetime desc' )->limit ( 1 )->find ();
		if ($info == null)
		{
			$this->show ( "呃，该栏目下还没有文章呢，等待管理员添加哟~~" );
		}
		
		$content = stripslashes ( $info ['content'] );
		$info ['content'] = html_entity_decode ( $content );
		
		$this->assign ( 'info', $info );
		/*read num + 1*/
		setInc ( 'page', $info ['id'], 'read_num', 1 );
		/* display */
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
	
	public function liucheng()
	{
		$info = mc_option ( 'liucheng' );
		$content = stripslashes ( $info );
		$content = html_entity_decode ( $content );
		$this->assign ( 'info', $content );
		$this->display ();
	}

}