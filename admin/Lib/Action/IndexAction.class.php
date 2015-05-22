<?php

class IndexAction extends Action
{

	/**
	 * 发送邮件的设置
	 */
	public function index11()
	{

		echo (is_login ());
		$_SESSION ['user_blkq'] = 'admin';
		echo (is_login ());
		
		echo '<br>';
		// 将用户信息发送到用户的邮箱
		$title = '水瓶网重置密码';
		$email = "342834599@qq.com";
		$url = "this is a test mail";
		$content = '这是一个系统发出的邮件，请不要直接回复。' . $url . "  <br>--by 水瓶网";
		$ok = send_email ( $email, $title, $content );
		echo $ok;
	
	}

	public function index()
	{

		if (! is_login ())
		{
			$this->error ( "还没有登陆哦~~", U ( "index/login" ) );
		} else
		{
			
			$this->display ();
		}
		
		/*
		 * $list = selectList('Tables','table_id=11','id desc',0); dump($list); $row = selectRow('Tables', 1100000001); dump($row); $field = selectAttr('Tables', 'table_name_eng', 1100000002); dump($field); $data['table_name_e0ng']='test'; $data['table_3id']=100; $ok = insertRow('Tables', $data); dump($ok); $ok = deleteList('Tables', 'table_id=100'); dump($ok); $ok = deleteRow('Tables', 1100000019); dump($ok);
		 */
	}
	
	/*
	 * 登陆操作
	 */
	public function login()
	{

		if ($_SESSION ['user'])
		{
			$this->error ( '呃，您已经登陆过了哦~~', U ( 'index/index' ) );
		}
		$tag = $_REQUEST ['tag'];
		if ($tag)
		{
			$name = $_REQUEST ['name'];
			$password = $_REQUEST ['password'];
			if ($_SESSION ['verify'] != md5 ( $_POST ['verify'] ))
			{
				$this->error ( "验证码错误！");
			}
			
			$user = check_user ( $name, $password );
			if ($user)
			{
				$_SESSION ['user'] = $user;
				
				$data ['id'] = $user ['id'];
				$data ['last_login_time'] = get_current_time ();
				$data ['last_login_ip'] = get_current_ip ();
				M ( 'user' )->save ( $data );
				$this->success ( $user ['user_name'] . "登陆成功", U ( "index/index" ) );
			} else
			{
				$this->error ( "登录失败~~" );
			}
		} else
		{
			$this->display ();
		}
	
	}
	
	/*
	 * 退出登陆操作
	 */
	public function logout()
	{

		if (session ( 'user.user_name' ))
		{
			$_SESSION ['user'] = null;
			$this->success ( "退出成功", U ( 'index/login' ) );
		} else
		{
			$this->error ( '额，未知错误~~', U ( 'index/login' ) );
		}
	
	}

	public function system()
	{

		if (! is_login ())
		{
			$this->error ( "还没有登陆哦~~", U ( "index/login" ) );
		}
		$this->display ();
	
	}

	public function content()
	{

		if (! is_login ())
		{
			$this->error ( "还没有登陆哦~~", U ( "index/login" ) );
		}
		$this->display ();
	
	}

	public function test()
	{
		send_weixin('o8V87t4IbUJh-wpwnT-kK4Tbbeks', "hello world");
		//$this->display ();
	
	}

	Public function verify()
	{

		import ( 'ORG.Util.Image' );
		Image::buildImageVerify ( $length = 6, $mode = 1, $type = 'png', $width = 80, $height = 32, $verifyName = 'verify' );
	
	}

	public function index1()
	{

		$this->display ();
	
	}
	
	// ---------------------------content---------------------------------------
	public function catelog()
	{

		if (! is_login ())
		{
			$this->error ( "还没有登陆哦~~", U ( "index/login" ) );
		}
		$this->display ();
	
	}
	
	

}