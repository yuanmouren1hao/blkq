<?php
class HuanjingAction extends Action
{

	public function index()
	{
		$this->display();
	}

	
	public function flash()
	{
		$child=$_REQUEST['child'];
		if ($child==null) {
			$type='独立诊室';
		}
		$father="优雅环境";
		$list=selectList('huanjing_catelog','father="'.$father.'" and child="'.$child.'" and type="huanjing"','updatetime desc','');
		$this->assign('list',$list);
		$this->display();
	}
	
	
	public function detail(){
		$id=$_REQUEST['id'];
		if($id){
			$info = selectRow('huanjing_catelog', $id);
			$content=stripslashes($info['content']);
			$info['content']=html_entity_decode($content);
			$this->assign('info',$info);
			$this->assign('type',$info['child']);
			$this->display();
		}else{
			$this->error('呃，发生了一点小错误了~~');
		}
	}
	

}