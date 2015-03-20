<?php
class ShebeiAction extends Action
{

	public function index()
	{
		$child=$_REQUEST['child'];
		if ($child==null) {
			$this->error('呃，发生了一点小错误了~~');
		}
		$obj = M ( 'huanjing_catelog' );
		import ( 'ORG.Util.Page' ); // 导入分页类
		$count = $obj->where ( 'type="shebei" and father="领先设备" and child="'.$child.'" ' )->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, mc_option ( 'page_num' ) ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig ( 'theme', mc_page());
		$show = $Page->show (); // 分页显示输出, 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $obj->where ( 'type="shebei" and father="领先设备" and child="'.$child.'" ' )->order ( 'updatetime desc' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page_now', $show ); // 赋值分页输出
		$this->assign ( 'count', $count );
		$this->display (); // 输出模板
	}
	
	
	public function shebei_detail(){
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