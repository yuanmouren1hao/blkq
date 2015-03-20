<?php
class PublicAction extends Action
{

// 	public function index()
// 	{
// 		$this->display();
// 	}
	
	public function upload()
	{
		require_once './Public/kindeditor/php/upload_json.php';
	}
}