<?php

class GroupAction extends Action
{
	public function index()
	{
		/*get all group*/
		$m = new Model();
		$sql = "select * from tb_permission";
		$info  = $m->query($sql);

		/*send data to view*/
		$this->assign("info", $info);

		$this->display();
	}

	public function delete(){
		$permissionsid = $_REQUEST['permissionsid'];

		$m = new Model();
		$sql = "delete from tb_permission where tbid=".$permissionsid;
		$info  = $m->query($sql);
		$this->ajaxReturn("删除成功");
	}

	public function  add(){
		$tag = $_REQUEST['tag'];

		if ($tag==null){
			$this->display();
		}
		else if($tag == "tag"){
			/*add group here*/
			$val_name = $_REQUEST['val_name'];
			$val_apps_id = $_REQUEST['val_apps_id'];

			$m = new Model();
			$sql = "insert into tb_permission (name,apps_id) values ('".$val_name."','".$val_apps_id."')";
			$info  = $m->query($sql);
			$this->ajaxReturn("添加成功");
		}
		else if ($tag == "updateApps"){
			$appsid = $_REQUEST['appsid'];

			$m = new Model();
			$sql = "select * from tb_app where tbid in (".$appsid.")";
			$appsrs  = $m->query($sql);

			//echo $sql;
			foreach($appsrs as $a){
				echo ('<div class="app" appid="'.$a['tbid'].'"><img src="../../oa/'.$a['icon'].'" alt="'.$a['name'].'" title="'.$a['icon'].'"><span class="del">删</span></div>');
			}
		}
	}

	public function alert_addapps(){
		/*get app list*/
		$m = new Model();
		$sql = "select * from tb_app";
		$info  = $m->query($sql);

		$this->assign("info", $info);
		$this->display();

	}

	public function  edit(){
		$tag = $_REQUEST['tag'];

		switch ($tag) {
			case null:
				$permissionid = $_REQUEST['permissionid'];
				$groupname = $_REQUEST['name'];
				$this->assign('permissionid', $permissionid);
				$this->assign('name', $groupname);
				
				/*get permission*/
				$m = new Model();
				$sql = "select apps_id from tb_permission where tbid=".$permissionid;
				$info  = $m->query($sql);
				
				$applist_1 = $info[0];
				$applist = $applist_1['apps_id'];
				//dump($applist);
				
				/**get app list*/
				$sql = "select * from tb_app where tbid in (".$applist.")";
				//echo $sql;
				$appinfo = $m->query($sql);
				$this->assign("appinfo", $appinfo);
				//dump($appinfo);
				$this->assign('applist', $applist);

				$this->display();
				break ;

			case 'update':

				/*add group here*/
				$permissionid = $_REQUEST['id'];
				$val_apps_id = $_REQUEST['val_apps_id'];

				$m = new Model();
				$sql = "update tb_permission set apps_id ='".$val_apps_id."' where tbid = ".$permissionid;
				$info  = $m->query($sql);
				echo  "编辑成功";
				break;
					
			case 'updateApps':
				$appsid = $_REQUEST['appsid'];

				$m = new Model();
				$sql = "select * from tb_app where tbid in (".$appsid.")";
				$appsrs  = $m->query($sql);

				//echo $sql;
				foreach($appsrs as $a){
					echo ('<div class="app" appid="'.$a['tbid'].'"><img src="../../oa/'.$a['icon'].'" alt="'.$a['name'].'" title="'.$a['icon'].'"><span class="del">删</span></div>');
				}
				break;

		}



	}



}