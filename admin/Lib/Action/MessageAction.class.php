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
		$obj = M ( 'order' );
		import ( 'ORG.Util.Page' ); // 导入分页类
		$count = $obj->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, mc_option ( 'page_num' ) ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig ( 'theme', mc_page () );
		$show = $Page->show (); // 分页显示输出, 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $obj->where (" comefrom = 'w' ")->order ( 'createtime desc' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
			
		//增加处理人员
		$model = new Model();
		$sql = "select tbid,name from tb_member where permission_id = 2";
		$list_mem = $model ->query($sql);
		
		$sql1="select * from blkq_cust";
		$list_cust = $model -> query($sql1);
		
		
		for($i = 0;$i<count($list);$i++){
			foreach($list_mem as $map_m){			
				if($map_m['tbid'] == $list[$i]['answer_id']){
					$list[$i]["answer_name"] = $map_m['name'];
				}				
			}
			foreach($list_cust as $cust){
				if($list[$i]['cust_id'] == $cust['cust_id']){
					$list[$i]["tel"] = $cust['cust_tel'];
					$list[$i]["age"] = $cust['age'];
					$list[$i]["sex"] = $cust['cust_sex'];
					$list[$i]["name"] = $cust['cust_name'];
				}
			}
		}
	
		//增加cust信息

		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page_now', $show ); // 赋值分页输出
		$this->assign ( 'count', $count );
		$this->display (); // 输出模板
	}

	public function weixin_yuyue()
	{				
		
		$id = I ( "param.id" );		
		$model = new Model();
		$sql = "select tbid,name from tb_member where permission_id = 2";
		$list_mem = $model ->query($sql);
		
		$sql1="select * from blkq_cust";
		$list_cust = $model -> query($sql1);
		
		$list = $model->query("select * from blkq_order where id = " . $id);
		
		
		
		for($i = 0;$i<count($list);$i++){
			foreach($list_mem as $map_m){			
				if($map_m['tbid'] == $list[$i]['answer_id']){
					$list[$i]["answer_name"] = $map_m['name'];
				}				
			}
			foreach($list_cust as $cust){
				if($list[$i]['cust_id'] == $cust['cust_id']){
					$list[$i]["tel"] = $cust['cust_tel'];
					$list[$i]["age"] = $cust['age'];
					$list[$i]["sex"] = $cust['cust_sex'];
					$list[$i]["name"] = $cust['cust_name'];
				}
			}
		}
		
		
		
		$this->assign ( 'vo', $list[0] ); // 赋值数据集
		$this->display (); // 输出模板
	}

	public function delete_yuyue()
	{

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

		$id = I ( "param.id" );
		//该条的answer_id 是否为""
		$model = new Model();
		$sql = 'select answer_id from blkq_order where id = ' . $id;
		$answer = $model->query($sql);
		if($answer[0]['answer_id'] == ""){
			$data['is_chuli']=1;
			$data['answer_id']=I ( "param.sid" );
			$data['answer_time']=date("Y-m-d H:i:s");
			$data['edit_id']=I ( "param.sid" );
			$ok = updateRow('order', $id, $data) ;
			if ($ok)
			{
				$this->success("处理成功。");
			} else
			{
				//$this->index_yuyue();
			}
		}else{
			$this -> success("该条预约信息已被其他人处理。");
		}	
	}

	public function edit_yuyue()
	{

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
			$sql = 'select tbid,name from tb_member where permission_id =1';
			$doctor_list = $model->query($sql);
			//dump($doctor_list);
			$this->assign('doctor_list',$doctor_list);
			$this->assign('list',$doctor_list);
			
			
			$query = "select a.* from blkq_cust as a,blkq_order as b where b.cust_id = a.cust_id and b.id = " . $id;
			$cust = $model->query($query);
			$this->assign('cust',$cust);


			$this->display();
		}
		else
		{
			
			$data['id']=I('param.id');
			$data['name']=I('param.name');
			$data['tel']=I('param.tel');
			$data['order_time']=I('param.order_time');
			$stid = I('param.stid');
			
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
			
			$data['edit_time'] = get_current_time ();
			$data['edit_id']=I('param.sid');
			
			//dump($time22);
			$data['order_time2']=$time11.":".$time12."-".$time21.":".$time22;
			$data['dottime'] = (($time11-8)*4 + $time12/15).','. (($time21-8)*4 + $time22/15);

			$data['desc']=I('param.desc');
			$data['doctor_id']=I('param.doctor_id');
			$data['yuyue_type']=I('param.yuyue_type');
			/*get doctor name by doctor id*/
			
			//$data['doctor_name']=selectAttr('tb_member', 'name', I('param.doctor_id'));
			$model = new Model();
			$sql = "select name from tb_member where tbid = " .I('param.doctor_id');
			$doc_name = $model -> query($sql);
			$data['doctor_name'] = $doc_name[0]["name"];
			
			//dump($data);
			$ok = updateRow('order', $data['id'], $data) ;

			if ($ok)
			{
				//$this->success ( "编辑成功","");
				$this->success("编辑成功",U(Message/edit_yuyue)."?id=".$data['id']."&time=".$data['order_time']."&doc_id=".$data['doctor_id']."&sid=".$_REQUEST ['sid']);
			} else
			{
				//$this->error ( "编辑失败" );
				$this->error("编辑失败",U(Message/edit_yuyue)."?id=".$data['id']."&time=".$data['order_time']."&doc_id=".$data['doctor_id']."&sid=".$_REQUEST ['sid']);
			}
		}
	}


	public function get_doc_duty( $datetime=null,$doc_id = null)
	{
			$time1 = strtotime($datetime);
			$time2 = strtotime("2015-01-01");
			$days = ceil(($time1-$time2)/86400) - 1;
			
			$model = new Model();
			if($doc_id){
				//指定了某个医生
				$sql = "select name,tbid from tb_member where tbid = " . $doc_id;
			}else{
				$sql = "select name,tbid from tb_member where permission_id = 1";
			}
			$list = $model->query($sql);
			$sql1 = "SELECT * FROM `blkq_duty` where days = " . $days;
			$duty = $model->query($sql1);	
			for($i=0;$i<count($list);$i++){
				$list[$i]['am'] = "";
				$list[$i]['pm'] = "";
			}		
			for($i=0;$i<count($list);$i++){
				foreach($duty as $dt){
					if($list[$i]['tbid'] == $dt['mem_id']){
						$list[$i]['am'] = $dt["moring"];
						$list[$i]['pm'] = $dt["afternoon"];
					}
				}
			}
			
			$this->ajaxReturn($list);
	}
	
	public function get_duty_message( $datetime=null,$doc_id = null)
	{
		if($doc_id){
			$sql = "select * from blkq_order where order_time = '". $datetime ."' and doctor_id = '" . $doc_id ."' ";
		}else{
			$sql = "select * from blkq_order where order_time = '". $datetime ."'  ";
		}
		$model = new Model();
		$list = $model->query($sql);
		$this->ajaxReturn($list);
	}

	/* send weixin to doctor */
	public function hit_weixin()
	{
		
		/* get order id first */
		$id = I ( "param.id" );

		/*发送微信*/
		$thedata = selectRow('order', $id);
		if (null != $thedata['doctor_name']) {
			/* updaye is_reply to order*/
			$data['is_weixin']=1;
			$ok = updateRow('order', $id, $data) ;

			/*给对应的weixin_id发送微信*/
			$obj = new Model();
			$list = $obj->query("select * from tb_member where tbid = ".$thedata['doctor_id']);
			$weixin_id = $list[0]["weixin_id"];			
			$content =urlencode("【网站预约消息】\n\n预约号:".$thedata['id']."\n预约时间:".$thedata['order_time']."-".$thedata['order_time2']."\n预约类别:".$thedata['yuyue_type']."\n描述:".$thedata['desc']."\n\n<a href='http://www.blkqyy.com/admin.php/message/add_yuyue.html?weixin_id=".$weixin_id."&time=".$thedata['order_time']."'>点击查看 </a>");
			
			$id = $weixin_id;
			//send_weixin($id, $content);
			$url = "http://www.blkqyy.com/admin.php/message/add_yuyue.html?weixin_id=".$weixin_id."&time=".$thedata['order_time'];
			sendWechatTempMsg($id, urlencode($url), urlencode(date ( "Y-m-d_H:i:s" )), urlencode($thedata['yuyue_type']));
			
			
			$this->success("send weixin success");
		}else {
			$this->error("没有指定医师哦，请编辑指定医师~~");
		}

	}

	/* mark reply replyed to the order */
	public function hit_reply()
	{
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
			$sid = $_REQUEST ['sid'];
			$weixin_id = $_REQUEST ['weixin_id'];
			/*get all doctor info*/
			$model = new Model();
			$sql = 'select tbid, name, weixin_id from tb_member where permission_id = 1';
			$doctor_list = $model->query($sql);
			//dump($doctor_list);
			$this->assign ( 'list', $doctor_list ); // 赋值数据集	
			$isdoc = 0;
			$doc_name = "";
			foreach($doctor_list as $doc){
					if($doc["tbid"] == $sid || ($doc["weixin_id"] == $weixin_id && $weixin_id>0 )){
						$isdoc = $doc["tbid"];
						$doc_name = $doc["name"];
					}
			}
			$this->assign ( 'isdoc', $isdoc ); 
			$this->assign ( 'doc_name', $doc_name ); 
			$this->display();
	}
	public function get_cust_mes(){
		//病患信息
		$model = new Model();
		$tel = $_REQUEST ['tel'];
		$sql = 'select * from blkq_cust where cust_tel = ' . $tel;
		$cust_list = $model->query($sql);
		//dump($doctor_list);
		$this->ajaxReturn($cust_list);
	}
	public function update_cust_mes(){
		$name = $_REQUEST ['name'];
		$address = $_REQUEST ['address'];
		$sex = $_REQUEST ['sex'];
		$tel = $_REQUEST ['tel'];
		$now = $_REQUEST ['now'];
		$model =  M ( 'cust' );
		if($now > 0 ){
			//更新
			$sql = "update blkq_cust set cust_name = '" . $name . "',cust_tel = '". $tel ."',cust_home='" . $address ."',cust_sex = '". $sex  . "' where cust_id =" .$now ;
			$model->query($sql);
		}else{
			//插入
			
			$sql = "insert into blkq_cust (cust_name,cust_tel,cust_home,cust_sex) values ('".$name."','".$tel."','".$address."','".$sex."')";
			$model->query($sql);
		}	
		
	}
	public function add_new_yuyue(){
			
			$weixin_id = $_REQUEST ['weixin_id'];	
			$obj = new Model();
			if(strlen($weixin_id) > 5){
				$wei =$obj->query("select tbid from tb_member where weixin_id = " . $weixin_id);
				$tbid = $wei[0]["tbid"];
			}	
			$time11 = $_REQUEST ['time11'];
			$time12 = $_REQUEST ['time12'];
			$time21 = $_REQUEST ['time21'];
			$time22 = $_REQUEST ['time22'];
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
			$data['order_time2']=$time11.":".$time12."-".$time21.":".$time22;
			$data['dottime'] = (($time11-8)*4 + $time12/15).','. (($time21-8)*4 + $time22/15);
			$data['order_time'] = $_REQUEST ['order_time'];
			$data['cust_id'] = $_REQUEST ['cust_id'];
			$data['doctor_id'] = $_REQUEST ['doctor_id'];
			$data['desc'] = $_REQUEST ['desc'];
			
			$data['is_chuli'] = "1";
			$data['comefrom'] = "x";
			$data['isconfirm'] = "1";
			$data['yuyue_type'] = $_REQUEST ['type'];
			if($weixin_id > 10){
				$data['edit_id'] = $tbid;
				$data['answer_id'] = $tbid;
			}else{
				$data['answer_id'] = $_REQUEST ['answer_id'];
				$data['edit_id'] = $_REQUEST ['answer_id'];
			}
			$data['answer_time'] = date("Y-m-d H:i:s");
			$data['createtime'] = date("Y-m-d H:i:s");
			$data['edit_time'] = date("Y-m-d H:i:s");
			
			$isconfirm = $_REQUEST ['confirm'];
			if($isconfirm == "true"){
				$data['isconfirm'] = 1;		
			}else{
				$data['isconfirm'] = 0;
			}
			
				
			$ok = M("order")->add($data);			
			$this->ajaxReturn($ok);			
	}
	
	public function update_yuyue(){
			$id = $_REQUEST ['id'];			
			$weixin_id = $_REQUEST ['weixin_id'];	
			//根据weixin_id获取tbid；
			$obj = new Model();
			if(strlen($weixin_id) > 5){
				$wei =$obj->query("select tbid from tb_member where weixin_id = " . $weixin_id);
				$tbid = $wei[0]["tbid"];
			}					
			$time11 = $_REQUEST ['time11'];
			$time12 = $_REQUEST ['time12'];
			$time21 = $_REQUEST ['time21'];
			$time22 = $_REQUEST ['time22'];
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
			
			$data['order_time2']=$time11.":".$time12."-".$time21.":".$time22;
			$data['dottime'] = (($time11-8)*4 + $time12/15).','. (($time21-8)*4 + $time22/15);
			$data['cust_id'] = $_REQUEST ['cust_id'];
			$data['order_time'] = $_REQUEST ['order_time'];
			$data['doctor_id'] = $_REQUEST ['doctor_id'];
			$data['desc'] = $_REQUEST ['desc'];
			if($weixin_id > 10){
				$data['edit_id'] = $tbid;				
			}else{
				$data['edit_id'] = $_REQUEST ['answer_id'];
			}
			
			$data['is_chuli'] = "1";
			$data['yuyue_type'] = $_REQUEST ['type'];
			$data['edit_time'] = date("Y-m-d H:i:s");
			$isconfirm = $_REQUEST ['confirm'];
			if($isconfirm == "true"){
				$data['isconfirm'] = 1;		
			}else{
				$data['isconfirm'] = 0;
			}
			$iscome = $_REQUEST ['iscome'];
			if($iscome == "true"){
				$data['iscome'] = 1;		
			}else{
				$data['iscome'] = 0;
			}
			$ok = updateRow ( 'order', $id, $data );
			$this->ajaxReturn($ok);		
	}
	
	public function get_duty_id(){
			$id = $_REQUEST ['id'];
			$sql = "select a.*,b.cust_tel from blkq_order as a,blkq_cust as b where a.cust_id = b.cust_id and a.id  =" . $id;
			$mod = new Model();
			$list = $mod->query($sql);
			//助手列表
			$sql2 = 'select tbid, name from tb_member where permission_id = 2';
			$zs_list = $mod->query($sql2);
			foreach($zs_list as $zs){
				if($zs["tbid"] == $list[0]["answer_id"]){
					$list[0]["answer_name"] = $zs['name'];
				}
				if($zs["tbid"] == $list[0]["edit_id"]){
					$list[0]["edit_name"] = $zs['name'];
				}
			}
			$this->ajaxReturn($list[0]);		
		
	}
}