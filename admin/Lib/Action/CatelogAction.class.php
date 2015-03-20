<?php
class CatelogAction extends Action 
{
    public function index()
    {
    	if (!is_login()) {
    		$this->error("还没有登陆哦~~",U("index/login"));
    	}
    	$this->catelog=aop_get_catelog_father_list();
    	$this->display('index');
    }
    
    
    public function edit()
    {
    	if (!is_login()) {
    		$this->error("还没有登陆哦~~",U("index/login"));
    	}
    	$tag=$_REQUEST['tag'];
    	if ($tag) {
    		$id=I('param.the_id');
    		$data['catelog_desc']=I('param.desc');
    		$data['create_time']=get_current_time();
    		$data['create_user']=session('user.user_name');
    		$data['child']=I('param.edit_catelog');
    		$ok= updateRow('catelog', $id, $data);
    		if ($ok) {
    			$this->success("更新成功");
    		}else {
    			$this->error("更新失败");
    		}
    	}else 
    	{
	    	$this->assign('catelog',aop_get_catelog_father_list());
	    	$this->display();
    	}
    }
    
    
    public function add()
    {
    	if (!is_login()) {
    		$this->error("还没有登陆哦~~",U("index/login"));
    	}
    	$tag = $_REQUEST['tag'];
    	if ($tag) {
    		$data['father']=I('param.father');
    		$data['child']=I('param.child');
    		$data['catelog_desc']=I('param.desc');
    		$data['create_time']=get_current_time();
    		$data['create_user']=session('user.user_name');
    		$ok=insertRow('catelog', $data);
    		if ($ok) {
    			$this->success("添加分类成功");
    		}else {
    			$this->error("添加分类更新失败");
    		}
    	}else{
    		$this->display();
    	}
    }
    
    
    
//-------------------ajax--------------------------//

    public function get_child_list($father){
    	$list = aop_get_catelog_child_list($father);
    	$this->ajaxReturn($list);
    }
    
    public function get_catelog_info($father,$child){
    	$list = aop_get_catelog_info($father, $child);
    	$this->ajaxReturn($list);
    }

    
//-----------------test---------------------------//
    public function  test()
    {
    	dump(aop_get_catelog_info('种植牙', '种植专家'));
    }
   
}