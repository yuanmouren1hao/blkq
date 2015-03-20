<?php

class TongjiAction extends Action
{

	public function pv()
	{

		if (! is_login ())
		{
			$this->error ( "还没有登陆哦~~", U ( "index/login" ) );
		}
		
		$model = new Model ();
		$sql = "select DATE_FORMAT(create_time,'%Y-%m-%d') days,count(*) count
				from blkq_visit
				where (to_days(now())-to_days(create_time))<7
				group by to_days(create_time)";
		$info = $model->query ( $sql );
		$this->assign ( 'info', $info );
		
		$sql2 = "select from_site,count(from_site) count
				from blkq_visit
				where (to_days(now())-to_days(create_time))<7
				group by from_site
				order by count desc";
		$info2 = $model->query ( $sql2 );
		$this->assign ( 'info2', $info2 );
		
		$this->display ();
	
	}

	public function uv()
	{

		if (! is_login ())
		{
			$this->error ( "还没有登陆哦~~", U ( "index/login" ) );
		}
		
		$model = new Model ();
		$sql = " select DATE_FORMAT(create_time,'%Y-%m-%d') days,count(distinct ip) count
				from blkq_visit
				where (to_days(now())-to_days(create_time))<7
				group by to_days(create_time)";
		$info = $model->query ( $sql );
		$this->assign ( 'info', $info );
		
		$sql2 = "select distinct ip
				from blkq_visit
				where (to_days(now())-to_days(create_time))<7
				order by create_time desc
				limit 10";
		$info2 = $model->query ( $sql2 );
// 		dump($info2);
		
		$num = count ( $info2 );
		for($i = 0; $i < $num; ++ $i)
		{
			// 使用方法
			$post_data = array (
					'key' => '05e114d755f0b162a9a430ee6df08f54',
					'ip' =>$info2 [$i]['ip']
			);
			$result = send_post ( 'http://apis.juhe.cn/ip/ip2addr', $post_data );
			$json=json_decode($result,true);
// 			dump( $json);
			$info2[$i]['area'] =$json['result']['area'];
			$info2[$i]['location']= $json['result']['location'];
		}
		$this->assign ( 'info2', $info2 );
// 		dump($info2);
		$this->display();
		
	}

	public function page()
	{

		if (! is_login ())
		{
			$this->error ( "还没有登陆哦~~", U ( "index/login" ) );
		}
		$model = new Model ();
		$sql = " select id,title,read_num
				from blkq_page
				order by read_num+0 desc limit 20";
		$info = $model->query ( $sql );
		$this->assign ( 'info', $info );
		
// 		dump($info);
		$this->display ();
	
	}
	
	
	public function del_hsitory()
	{
		$ok = M("Visit")->where("(to_days(now())-to_days(create_time))>7")->delete();
// 		dump($ok);
		$this->success("已经为您删除   ".$ok."  条数据....");
	}

}