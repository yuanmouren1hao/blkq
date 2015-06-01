<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
	public function index(){
		$m = new Model();
		$sql = "select meta_value from blkq_option where meta_key='oa_url'";
		$info = $m->query($sql);
		$info1 = $info[0];
		$oa_url = $info1['meta_value'];
		$this->assign('oa_url', $oa_url);
		$this->display();
	}
}