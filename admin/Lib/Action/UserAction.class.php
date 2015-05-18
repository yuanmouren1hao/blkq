<?php

class UserAction extends Action
{
	public function index()
	{
		/*get user list*/
		$m = new Model();
		$sql = "select m.*,p.name groupname from tb_member m,tb_permission p where m.catelog_id=0 and m.permission_id=p.tbid";
		$info  = $m->query($sql);
		$this->assign("info", $info);
		//dump($info);

		$this->display();
	}

	public function add(){
		$tag = $_REQUEST['tag'];

		switch ($tag) {
			case null:
				/*get all permission to display*/
				$m = new Model();
				$sql = "select * from tb_permission where tbid not in (1)";
				$permissionlist = $m->query($sql);
				$this->assign('permissionlist', $permissionlist);

				$this->display();
				break;
			case 'adduser':
				$username = $_REQUEST['val_username'];
				$password = $_REQUEST['val_password'];
				$tel = $_REQUEST['val_tel'];
				$weixinid = $_REQUEST['val_weixinid'];
				$email = $_REQUEST['val_email'];
				$permission_id = $_REQUEST['val_permission_id'];
				//echo $username;

				$m = new Model();
				$sql = "insert into tb_member (username,name,type,permission_id,regdt,lastlogindt,lastloginip,tel,mail,createtime,updatetime,catelog_id,weixin_id,password) values('".$username."','".$username."',1,".$permission_id.",'".get_current_time()."','".get_current_time()."','".get_current_ip()."','".$tel."','".$email."','".get_current_time()."','".get_current_time()."',0,'".$weixinid."','".sha1($password)."')";
				$info = $m->query($sql);
				echo("添加成功");

				break;
					
		}

	}


	public function  edit(){
		$tag = $_REQUEST['tag'];

		switch ($tag) {
			case null:
				/*get user info */
				$tbid = $_REQUEST['memberid'];

				$m = new Model();
				$sql = "select * from tb_member where tbid=".$tbid;
				$info  = $m->query($sql);
				$this->assign("info", $info[0]);

				/*get group info */
				$m = new Model();
				$sql = "select * from tb_permission where tbid not in (1)";
				$permissionlist = $m->query($sql);
				$this->assign('permissionlist', $permissionlist);


				//dump($info[0]);
				$this->display();
				break;

			case 'eidtuser':
				$tbid = $_REQUEST['id'];
				
				/*get new info*/
				$val_password = $_REQUEST['val_password'];
				
				$val_tel = $_REQUEST['val_tel'];
				$val_weixinid = $_REQUEST['val_weixinid'];
				$val_email = $_REQUEST['val_email'];
				$val_permission_id = $_REQUEST['val_permission_id'];
				
				$m = new Model();
				if ($val_password == null){
					$sql = "update tb_member set tel='".$val_tel."', weixin_id = '".$val_weixinid."', mail='".$val_email."', permission_id=".$val_permission_id." where tbid=".$tbid;
				}else {
					$sql = "update tb_member set tel='".$val_tel."', weixin_id = '".$val_weixinid."', mail='".$val_email."', permission_id=".$val_permission_id.",password='".sha1($val_password)."'  where tbid=".$tbid;
				}
				//echo $sql;
				$info = $m->query($sql);			
				echo "修改成功";
				
				break;
					
		}
	}


	public function delete(){
		$tbid = $_REQUEST['memberid'];

		$m = new Model();
		$sql = "delete from tb_member where tbid=".$tbid;
		$info  = $m->query($sql);
		$this->ajaxReturn("删除成功");
	}





}