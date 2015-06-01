<?php

class SystemAction extends Action
{

	public function index()
	{

		$this->display ();

	}

	public function setmail()
	{
		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}

		$tag = $_REQUEST ['tag'];
		if ($tag)
		{
			$ok = mc_update_option ( 'hos_mail', I ( 'param.hos_mail' ) );
			$ok = mc_update_option ( 'stmp_name', I ( 'param.stmp_name' ) );

			if ($ok)
			{
				$this->success ( "更新成功" );
			} else
			{
				$this->error ( "更新失败" );
			}
		} else
		{
			$this->display ();
		}

	}

	public function test_mail()
	{
		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}

		$mail = $_REQUEST ['mail'];
		if ($mail)
		{
			$ok = send_email ( $mail, '测试邮件', '这是一封测试邮件' );
			if ($ok)
			{
				$this->success ( "发送成功" );
			} else
			{
				$this->error ( "发送失败" );
			}
		} else
		{
			$this->error ( "发生了一点小故障~~" );
		}

	}

	public function jianjie()
	{

		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}
		$tag = $_REQUEST ['tag'];
		if ($tag)
		{
			$ok = mc_update_option ( 'yiyuan_jianjie', I ( 'param.content' ) );
			if ($ok)
			{
				$this->success ( "更新成功" );
			} else
			{
				$this->error ( "更新失败" );
			}
		} else
		{
			$content = mc_option ( 'yiyuan_jianjie' );
			$this->assign ( 'info', $content );
			$this->display ();
		}

	}

	public function map()
	{
		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}

		$tag = $_REQUEST ['tag'];
		if ($tag)
		{
			$ok = mc_update_option ( 'map', I ( 'param.content' ) );
			if ($ok)
			{
				$this->success ( "更新成功" );
			} else
			{
				$this->error ( "更新失败" );
			}
		} else
		{
			$content = mc_option ( 'map' );
			$this->assign ( 'info', $content );
			$this->display ();
		}

	}

	public function zixun()
	{
		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}

		$tag = $_REQUEST ['tag'];
		if ($tag)
		{
			$ok = mc_update_option ( 'zaixian_zixun', I ( 'param.content' ) );
			if ($ok)
			{
				$this->success ( "更新成功" );
			} else
			{
				$this->error ( "更新失败" );
			}
		} else
		{
			$content = mc_option ( 'zaixian_zixun' );
			$this->assign ( 'info', $content );
			$this->display ();
		}

	}

	public function liucheng()
	{
		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}

		$tag = $_REQUEST ['tag'];
		if ($tag)
		{
			$ok = mc_update_option ( 'liucheng', I ( 'param.content' ) );
			if ($ok)
			{
				$this->success ( "更新成功" );
			} else
			{
				$this->error ( "更新失败" );
			}
		} else
		{
			$content = mc_option ( 'liucheng' );
			$this->assign ( 'info', $content );
			$this->display ();
		}

	}

	public function shejiao()
	{
		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}

		$tag = $_REQUEST ['tag'];
		if ($tag)
		{
			$ok = mc_update_option ( 'qq', I ( 'param.qq' ) );
			$ok = mc_update_option ( 'tqq', I ( 'param.tqq' ) );
			$ok = mc_update_option ( 'weibo', I ( 'param.weibo' ) );
			$ok = mc_update_option ( 'weixin', I ( 'param.weixin' ) );
			$ok = mc_update_option ( 'tel', I ( 'param.tel' ) );
			$ok = mc_update_option ( 'weixin_code', I ( 'param.weixin_code' ) );
			if ($ok)
			{
				$this->success ( "更新成功" );
			} else
			{
				$this->error ( "更新失败" );
			}
		} else
		{
			$this->display ();
		}

	}

	public function user()
	{
		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}

		$tag = $_REQUEST ['tag'];
		if ($tag)
		{
			$ok = mc_update_option ( 'weixin_code', I ( 'param.weixin_code' ) );
			if ($ok)
			{
				$this->success ( "更新成功" );
			} else
			{
				$this->error ( "更新失败" );
			}
		} else
		{
			$this->display ();
		}

	}

	public function seo()
	{

		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}
		$tag = $_REQUEST ['tag'];
		if ($tag)
		{
			$ok = mc_update_option ( 'keyword', I ( 'param.keyword' ) );
			$ok = mc_update_option ( 'description', I ( 'param.desc' ) );
			if ($ok)
			{
				$this->success ( "更新成功" );
			} else
			{
				$this->error ( "更新失败" );
			}
		} else
		{
			$this->display ();
		}

	}


	public function all()
	{

		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}
		$tag = $_REQUEST ['tag'];
		if ($tag)
		{
			$ok = mc_update_option ( 'site_name', I ( 'param.site_name' ) );
			$ok = mc_update_option ( 'site_url', I ( 'param.site_url' ) );
			$ok = mc_update_option ( 'page_num', I ( 'param.page_num' ) );
			$ok = mc_update_option ( 'alter_time', I ( 'param.alter_time' ) );
			$ok = mc_update_option ( 'baidu_tongji', I ( 'param.baidu_tongji' ) );
			$ok = mc_update_option ( 'foot_copyright', I ( 'param.foot_copyright' ) );
			$ok = mc_update_option ( 'admin_weixin_id', I ( 'param.admin_weixin_id' ) );
			$ok = mc_update_option ( 'admin_weixin_id1', I ( 'param.admin_weixin_id1' ) );
			$ok = mc_update_option ( 'admin_weixin_id2', I ( 'param.admin_weixin_id2' ) );
			$ok = mc_update_option ( 'weixin_name', I ( 'param.weixin_name' ) );
			$ok = mc_update_option ( 'weixin_name1', I ( 'param.weixin_name1' ) );
			$ok = mc_update_option ( 'weixin_name2', I ( 'param.weixin_name2' ) );
			if ($ok)
			{
				$this->success ( "更新成功" );
			} else
			{
				$this->error ( "更新失败" );
			}
		} else
		{
			$this->display ();
		}

	}


	public function f_set()
	{

		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}
		$tag = $_REQUEST ['tag'];
		if ($tag)
		{
			$ok = mc_update_option ( 'f_img_1', I ( 'param.f_img_1' ) );
			$ok = mc_update_option ( 'f_img_2', I ( 'param.f_img_2' ) );
			$ok = mc_update_option ( 'f_img_3', I ( 'param.f_img_3' ) );
			$ok = mc_update_option ( 'f_url_1', I ( 'param.f_url_1' ) );
			$ok = mc_update_option ( 'f_url_2', I ( 'param.f_url_2' ) );
			$ok = mc_update_option ( 'f_url_3', I ( 'param.f_url_3' ) );
			if ($ok)
			{
				$this->success ( "更新成功" );
			} else
			{
				$this->error ( "更新失败" );
			}
		} else
		{
			$this->display ();
		}

	}

	public function js_set()
	{

		if (!is_login()) {
			$this->error("还没有登陆哦~~",U("index/login"));
		}
		$tag = $_REQUEST ['tag'];
		if ($tag)
		{
			$ok = mc_update_option ( 'js', I ( 'param.js' ) );
			if ($ok)
			{
				$this->success ( "更新成功" );
			} else
			{
				$this->error ( "更新失败" );
			}
		} else
		{
			$this->display ();
		}

	}


	/*行政管理*/
	public function administrator()
	{

		$tag = $_REQUEST['tag'];
		//echo $tag;

		switch ($tag) {
			case null:
				$this->display();
				break;

			case 'edit':
				mc_update_option ( 'oa_url', I ( 'param.oa_url' ) );
				mc_update_option ( 'zbap_edit', I ( 'param.zbap_edit' ) );
				//$oa_url = I ( 'param.oa_url' );
				//$zbap = I ( 'param.zbap_edit' );
				//dump($oa_url);
				//dump($zbap);
				$this->display();
				break;

			default:
				break;
		}

	}



}