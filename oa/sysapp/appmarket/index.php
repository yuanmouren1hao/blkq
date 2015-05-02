<?php
	require_once('../../global.php');
	require_once('inc/setting.inc.php');
	require_once('inc/smarty.php');
	
	$ac = $_REQUEST['ac'];
	
	switch($ac){
		case 'ajaxGetList':
			$mytype = $db->select(0, 1, 'tb_member', 'type', 'and tbid='.$_SESSION['member']['id']);
			$myapplist = getMyAppListOnlyId();
			if($search_1 == -1){
				$sqlwhere[] = 'tbid in('.implode(',', $myapplist).')';
			}else if($search_1 != 0){
				if($search_1 == 1 && $mytype['type'] == 1){
					/* 当查询系统的时候 看自己的permission是否有这个id */
					/* select the permission */
					$permission_user = $db->select(0, 1, 'tb_member', 'permission_id', 'and tbid='.$_SESSION['member']['id']);
					$permission = $db->select(0, 1, 'tb_permission', 'apps_id', 'and tbid='.$permission_user[0]);
					/* use new where*/
					$sqlwhere[] = 'tbid in ('.$permission[0].') and kindid = '.$search_1;
				}else{
					$sqlwhere[] = 'kindid = '.$search_1;
				}
			}else if($search_1 == 0 && $mytype['type'] == 0){
				$sqlwhere[] = 'kindid != 1';
			}else if($search_1 == 0 && $mytype['type'] == 1){
				/* show all apps here */
				$permission_user = $db->select(0, 1, 'tb_member', 'permission_id', 'and tbid='.$_SESSION['member']['id']);
					$permission = $db->select(0, 1, 'tb_permission', 'apps_id', 'and tbid='.$permission_user[0]);
				$sqlwhere[] = 'kindid != 1 or tbid in ('.$permission[0].')';
			}
			if($search_3 != ''){
				$sqlwhere[] = 'name like "%'.$search_3.'%"';
			}
			
			switch($search_2){
				case '1':
					$orderby = 'dt desc';
					break;
				case '2':
					$orderby = 'usecount desc';
					break;
				case '3':	//未做
					$orderby = 'dt desc';
					break;
			}
			$orderby .= ' limit '.$from.','.$to;
			$rs = $db->select(0, 0, 'tb_app', '*', $sqlwhere, $orderby);
			if($rs == NULL){
				$c = $db->select(0, 2, 'tb_app', 'tbid', $sqlwhere);
				echo $c.'<{|*|}>';
			}else{
				if($reset){
					$c = $db->select(0, 2, 'tb_app', 'tbid', $sqlwhere);
					echo $c.'<{|*|}>';
				}else{
					echo '-1<{|*|}>';
				}
				foreach($rs as $v){
					echo '<li><a href="javascript:;"><img src="../../'.$v['icon'].'"></a><a href="javascript:;"><span class="app-name">'.$v['name'].'</span></a><span class="app-desc">'.$v['remark'].'</span><a href="javascript:;" app_id="'.$v['tbid'].'" app_type="'.$v['type'].'" class="';
					if($myapplist != ''){
						if(in_array($v['tbid'], $myapplist)){
							if($search_1 == -1){
								echo 'btn-run-s" style="right:35px">打开应用</a>';
								echo '<a href="javascript:;" app_id="'.$v['tbid'].'" app_type="'.$v['type'].'" class="btn-remove-s" style="right:10px">删除应用</a>';
							}else{
								echo 'btn-run-s">打开应用</a>';
							}
						}else{
							echo 'btn-add-s">添加应用</a>';
						}
					}else{
						echo 'btn-add-s">添加应用</a>';
					}
					echo '</li>';
				}
			}
			break;
		default:
			$mytype = $db->select(0, 1, 'tb_member', 'type', 'and tbid='.$_SESSION['member']['id']);
			$smarty->assign('membertype', $mytype['type']);
			$smarty->assign('apptype', $apptype);
			$appcount = $db->select(0, 2, 'tb_app', 'tbid');
			$smarty->assign('appcount', $appcount);
			$smarty->display('sysapp/appmarket/index.tpl');
	}
?>