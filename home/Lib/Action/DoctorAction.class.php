<?php
class DoctorAction extends Action
{

	public function index()
	{
		$obj = M ( 'doctor_catelog' );
		import ( 'ORG.Util.Page' ); // 导入分页类
		$count = $obj->where ( 'father="医师团队"' )->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, mc_option ( 'page_num' ) ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig ( 'theme', mc_page());
		$show = $Page->show (); // 分页显示输出, 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $obj->where ( 'father="医师团队"')->order ( 'age' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		$this->assign ( 'list_d', $list ); // 赋值数据集
		$this->assign ( 'page_now', $show ); // 赋值分页输出
		$this->assign ( 'count', $count );
		$this->display (); // 输出模板
	}
	
	public function zonghe()
	{
		$obj = M ( 'doctor_catelog' );
		import ( 'ORG.Util.Page' ); // 导入分页类
		$count = $obj->where ( 'father="医师团队" and child="综合团队"' )->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, mc_option ( 'page_num' ) ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig ( 'theme', mc_page());
		$show = $Page->show (); // 分页显示输出, 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $obj->where ( 'father="医师团队" and child="综合团队"')->order ( 'age' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		$this->assign ( 'list_d', $list ); // 赋值数据集
		$this->assign ( 'page_now', $show ); // 赋值分页输出
		$this->assign ( 'count', $count );
		$this->display (); // 输出模板
	}
	
	
	public function zhengji()
	{
		$obj = M ( 'doctor_catelog' );
		import ( 'ORG.Util.Page' ); // 导入分页类
		$count = $obj->where ( 'father="医师团队" and child="正畸专家"' )->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, mc_option ( 'page_num' ) ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig ( 'theme', mc_page());
		$show = $Page->show (); // 分页显示输出, 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $obj->where ( 'father="医师团队" and child="正畸专家"')->order ( 'age' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		$this->assign ( 'list_d', $list ); // 赋值数据集
		$this->assign ( 'page_now', $show ); // 赋值分页输出
		$this->assign ( 'count', $count );
		$this->display (); // 输出模板
	}
	
	public function zhongzhi()
	{
		$obj = M ( 'doctor_catelog' );
		import ( 'ORG.Util.Page' ); // 导入分页类
		$count = $obj->where ( 'father="医师团队" and child="种植医师"' )->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, mc_option ( 'page_num' ) ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig ( 'theme', mc_page());
		$show = $Page->show (); // 分页显示输出, 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $obj->where ( 'father="医师团队" and child="种植医师"')->order ( 'age' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		$this->assign ( 'list_d', $list ); // 赋值数据集
		$this->assign ( 'page_now', $show ); // 赋值分页输出
		$this->assign ( 'count', $count );
		$this->display (); // 输出模板
	}
	
	
	public function xiufu()
	{
		$obj = M ( 'doctor_catelog' );
		import ( 'ORG.Util.Page' ); // 导入分页类
		$count = $obj->where ( 'father="医师团队" and child="修复医师"' )->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, mc_option ( 'page_num' ) ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig ( 'theme', mc_page());
		$show = $Page->show (); // 分页显示输出, 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $obj->where ( 'father="医师团队" and child="修复医师"')->order ( 'age' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		$this->assign ( 'list_d', $list ); // 赋值数据集
		$this->assign ( 'page_now', $show ); // 赋值分页输出
		$this->assign ( 'count', $count );
		$this->display (); // 输出模板
	}
	
	public function yazhou()
	{
		$obj = M ( 'doctor_catelog' );
		import ( 'ORG.Util.Page' ); // 导入分页类
		$count = $obj->where ( 'father="医师团队" and child="牙周医师"' )->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, mc_option ( 'page_num' ) ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig ( 'theme', mc_page());
		$show = $Page->show (); // 分页显示输出, 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $obj->where ( 'father="医师团队" and child="牙周医师"')->order ( 'age' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		$this->assign ( 'list_d', $list ); // 赋值数据集
		$this->assign ( 'page_now', $show ); // 赋值分页输出
		$this->assign ( 'count', $count );
		$this->display (); // 输出模板
	}
	
	
	public function doctor_detail()
	{
		$id=$_REQUEST['id'];
		if($id){
			$info = selectRow('doctor_catelog', $id);
			$content=stripslashes($info['content']);
			$info['content']=html_entity_decode($content);
			$this->assign('info',$info);
			$this->assign('type',$info['child']);
			//dump($info);
			$this->display();
		}else{
			$this->error('呃，发生了一点小错误了~~');
		}
	}

}