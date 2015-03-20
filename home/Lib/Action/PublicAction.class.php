<?php

class PublicAction extends Action
{

	public function upload()
	{

		require_once './Public/kindeditor/php/upload_json.php';
	
	}
	
	/*
	 * 统计来源
	 */
	public function source()
	{
		/*
		 * 第一次进入网站的时候，和时间超过n秒的时候记录, 时间可以由自己设置
		 */
		if ($_SESSION ['ip'] == null || get_time_change ( get_current_time (), $_SESSION ['timee'], 0.01 ))
		{
			// 在初次进入网站的时候
			// 记录session
			$_SESSION ['ip'] = get_current_ip ();
			$_SESSION ['timee'] = get_current_time ();
			
			import ( "ORG.Net.IpLocation" );
			$countin = new Model ( 'Visit' );
			$vo = $countin->create ();
			// 创建模型成功之后添加数据，并进行跳转
			$data ['ip'] = get_current_ip ();
			$data ['from_url'] = $_REQUEST ['from_url'];
			if ($data ['from_url'] == null)
			{
				$data ['from_url'] = '直接访问';
				$data ['from_site'] = '直接访问';
			} else
			{
				$temp = parse_url ( $data ['from_url'] );
				$data ['from_site'] = $temp ['host'];
			}
			$data ['create_time'] = get_current_time ();
			$data ['to_url'] = $_REQUEST ['to_url'];
			$ok = $countin->add ( $data );
			// echo $ok;
		}
	
	}
	
	/*
	 * 获取最后(n)20个来源的访问情况
	 */
	public function show()
	{
		// 创建模板
		$list_countin = M ( 'Visit' )->limit ( 20 )->order ( 'create_time desc' )->select ();
		$this->assign ( 'countin', $list_countin );
		// dump($list_countin);
		$this->display ();
	
	}
	
	public function  h_banner()
	{
		$this->display();
	}

}