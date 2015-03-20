<?php

/**
 * 测试函数
 * @author aoplee
 */
function test()
{

	return ("just a test");

}

/**
 * 获取当前系统IP
 *
 * @author fuhao.li
 */
function get_current_ip()
{

	if ($_SERVER ['REMOTE_ADDR'])
	{
		$cip = $_SERVER ['REMOTE_ADDR'];
	} elseif (getenv ( "REMOTE_ADDR" ))
	{
		$cip = getenv ( "REMOTE_ADDR" );
	} elseif (getenv ( "HTTP_CLIENT_IP" ))
	{
		$cip  =  getenv ( "HTTP_CLIENT_IP" );
	} else
	{
		$cip = 'unknow';
	}
	return $cip;

}

/**
 * 获取当前服务器时间
 *
 * @author fuhao.li
 */
function get_current_time()
{

	return date ( "Y-m-d H:i:s" );

}

/**
 * 获取时间差
 * 如果时间差大于设置的$timeout则返回真
 * 如果时间差小于设置的$timeout则返回假
 * 单位是：秒
 *
 * @param $now_time 当前时间
 *        	$session_time session记录的时间
 *        	$timeout 时间间隔
 * @return True or False
 * @author fuhao.li
 */
function get_time_change($now_time, $session_time, $timeout)
{

	return strtotime ( $now_time ) - strtotime ( $session_time ) > $timeout ? true : false;

}

/**
 * 获取中英文混合长度函数定义
 *
 * @param $str 字符串
 *        	[$charset] 代表的是字符串和字符编码设置，如果是中英文的话设置为gb2312
 * @return integer 长度
 * @author fuhao.li
 */
function get_mixstr_length($str, $charset = 'utf-8')
{

	if ($charset == 'utf-8')
	{
		$str = iconv ( 'utf-8', 'gb2312', $str );
	}
	$num = strlen ( $str );
	$cnNum = 0;
	for($i = 0; $i < $num; $i ++)
	{
		if (ord ( substr ( $str, $i + 1, 1 ) ) > 127)
		{
			$cnNum ++;
			$i ++;
		}
	}
	$enNum = $num - ($cnNum * 2);
	$number = ($enNum / 2) + $cnNum;
	return ceil ( $number );

}

/**
 * 中英文截取
 *
 * @param $str 要截取的字符串
 *        	$length 要截取的长度(超过总长度 按总长度计算)
 *        	[$start] (可选)开始位置(第一个为0)
 *        	[$dot] 添加的后缀
 * @return string
 * @author fuhao.li
 * @copyright 3renstudio
 */
function cut_mixstr($str, $length, $start = FALSE, $dot = '...')
{

	if (! $length)
	{
		return false;
	}
	
	$strlen = strlen ( $str );
	$content = '';
	$sing = 0;
	$count = 0;
	
	if ($length > $strlen)
	{
		$length = $strlen;
	}
	if ($start >= $strlen)
	{
		return false;
	}
	
	while ( $length != ($count - $start) )
	{
		if (ord ( $str [$sing] ) > 0xa0)
		{
			if (! $start || $start <= $count)
			{
				$content .= $str [$sing] . $str [$sing + 1] . $str [$sing + 2];
			}
			$sing += 3;
			$count ++;
		} else
		{
			if (! $start || $start <= $count)
			{
				$content .= $str [$sing];
			}
			$sing ++;
			$count ++;
		}
	}
	return $content . $dot;

}

/**
 * 获取PDF的页数
 *
 * @param $path pdf文件路径        	
 * @return int 文件页数
 * @author fuhao.li
 */
function getPDFPageTotal($path)
{
	
	// echo "getPageTotal pdf";
	// 打开文件
	if (! $fp = @fopen ( $path, "r" ))
	{
		$error = "打开文件{$path}失败";
		echo $error;
		return false;
	} else
	{
		$max = 0;
		while ( ! feof ( $fp ) )
		{
			$line = fgets ( $fp, 255 );
			if (preg_match ( '/\/Count [0-9]+/', $line, $matches ))
			{
				preg_match ( '/[0-9]+/', $matches [0], $matches2 );
				if ($max < $matches2 [0])
					$max = $matches2 [0];
			}
		}
		fclose ( $fp );
		// 返回页数
		return $max;
	}

}

function is_set_param($param_array)
{

	$data ['code'] = 200;
	$data ['msg'] = 'param is set ok.';
	$capitals = $param_array;
	while ( $key = key ( $capitals ) )
	{
		$value = $capitals [$key];
		if ($value == null)
		{
			$data ['code'] = 201;
			$data ['msg'] = $key . ' is unset.';
			break;
			// echo $key.'is unset.';
		}
		next ( $capitals );
		// 每个key()调用不会推进指针。为此要使用next()函数
	}
	return $data;

}

function check_user_access($param)
{

	$model = new Model ();
	$sql = "select count(*) count from app_users where user_uid=" . $param ['uid'] . " and user_access_token='" . $param ['access_token'] . "'";
	$list = $model->query ( $sql );
	$list = $list [0];
	$count = $list ['count'];
	return $count;

}

function get_table_name($id)
{

	$code = substr ( $id, 0, 3 );
	$model = new Model ();
	$sql = 'select table_name_eng from sys_table_info where table_id=' . $code;
	$list = $model->query ( $sql );
	$arr = $list [0];
	return $arr ['table_name_eng'];

}

/**
 * 检查是否登录是否存在
 *
 * @param unknown $name        	
 * @param unknown $password        	
 * @return Ambigous <mixed, boolean, NULL, multitype:, unknown, string>
 */
function check_user($name, $password)
{

	$model = M ( "User" );
	$user = $model->where ( "user_name = '" . $name . "' and password= '" . md5($password) . "' " )->limit ( 1 )->find ();
	return $user;

}

/**
 * 检测用户是否登录
 *
 * @param        	
 *
 *
 *
 * @return integer 0-未登录，大于0-当前登录用户ID
 * @author fuhao.li
 * @copyright 3renstudio
 */
function is_login()
{

	$user = session ( 'user.user_name' );
	if (empty ( $user ))
	{
		return 0;
	} else
	{
		return 1;
	}

}

/**
 * 给指定邮箱发送邮件
 *
 * @param $to_email 发送的邮箱
 *        	$title 邮件主题
 *        	$content 邮件内容
 * @return integer 0 发送成功 ，其他发送失败
 * @author fuhao.li
 * @copyright 3renstudio
 */
function send_email($to_email, $title, $content)
{

	$from_name = mc_option ( 'stmp_name' );
	$MAIL_ADDRESS = mc_option ( 'stmp_from' );
	$MAIL_SMTP = mc_option ( 'stmp_host' );
	$MAIL_LOGINNAME = mc_option ( 'stmp_username' );
	$MAIL_PASSWORD = mc_option ( 'stmp_password' );
	
	Vendor ( 'PHPMailer.phpmailer' );
	$mail = new PHPMailer (); // 设置PHPMailer使用SMTP服务器发送Email
	$mail->IsSMTP (); // 设置邮件的字符编码，若不指定，则为'UTF-8'
	$mail->CharSet = 'UTF-8'; // 添加收件人地址，可以多次使用来添加多个收件人
	$mail->AddAddress ( $to_email ); // 设置邮件正文
	$mail->Body = $content; // 设置邮件头的From字段。
	$mail->From = $MAIL_ADDRESS; // 设置发件人地址
	$mail->FromName = $from_name; // 设置邮件标题
	$mail->Subject = $title; // 设置SMTP服务器。
	$mail->Host = $MAIL_SMTP; //
	$mail->SMTPAuth = true; // 设置用户名和密码。
	$mail->Username = $MAIL_LOGINNAME;
	$mail->Password = $MAIL_PASSWORD; // 发送邮件。
	if ($mail->Send ())
	{
		// success
		return 1;
	} else
	{
		// filed
		return 0;
	}

}

/**
 * 产生随机字串，可用来自动生成密码
 * 默认长度6位 字母和数字混合 支持中文
 *
 * @param string $len
 *        	长度
 * @param string $type
 *        	字串类型
 *        	0 字母 1 数字 其它 混合
 * @param string $addChars
 *        	额外字符
 * @return string
 * @author fuhao.li
 */
function rand_string($len = 6, $type = '', $addChars = '')
{

	$str = '';
	switch ($type)
	{
		case 0 :
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' . $addChars;
			break;
		case 1 :
			$chars = str_repeat ( '0123456789', 3 );
			break;
		case 2 :
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' . $addChars;
			break;
		case 3 :
			$chars = 'abcdefghijklmnopqrstuvwxyz' . $addChars;
			break;
		default :
			// 默认去掉了容易混淆的字符oOLl和数字01，要添加请使用addChars参数
			$chars = 'ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789' . $addChars;
			break;
	}
	if ($len > 10)
	{ // 位数过长重复字符串一定次数
		$chars = $type == 1 ? str_repeat ( $chars, $len ) : str_repeat ( $chars, 5 );
	}
	if ($type != 4)
	{
		$chars = str_shuffle ( $chars );
		$str = substr ( $chars, 0, $len );
	} else
	{
		// 中文随机字
		for($i = 0; $i < $len; $i ++)
		{
			$str .= msubstr ( $chars, floor ( mt_rand ( 0, mb_strlen ( $chars, 'utf-8' ) - 1 ) ), 1 );
		}
	}
	return $str;

}

/**
 * 动态获取数据库信息
 *
 * @param $tname 表名        	
 * @param $where 搜索条件        	
 * @param $order 排序条件
 *        	如："id desc";
 * @param $count 取前几条数据        	
 * @author fuhao.li
 */
function selectList($tname, $where = "", $order = "", $count = 0)
{

	$m = M ( $tname );
	if (! empty ( $where ))
	{
		$m->where ( $where );
	}
	if (! empty ( $order ))
	{
		$m->order ( $order );
	}
	if ($count > 0)
	{
		$m->limit ( $count );
	}
	return $m->select ();

}

/**
 * 动态获取数据库一条记录
 *
 * @param 表名 $name        	
 * @param 记录的id $id        	
 * @return Ambigous <mixed, boolean, NULL, multitype:, unknown, string>
 */
function selectRow($name, $id)
{

	$m = M ( $name );
	return $m->where ( 'id=' . $id )->find ();

}

/**
 * 动态回去一条记录的属性
 *
 * @param 表名 $name        	
 * @param 获取的属性名 $attr        	
 * @param 属性id $id        	
 * @return Ambigous <mixed, NULL, multitype:Ambigous <unknown, string> unknown , multitype:>
 */
function selectAttr($name, $attr, $id)
{

	$m = M ( $name );
	$a = $m->where ( 'id=' . $id )->getField ( $attr );
	return $a;

}

/**
 * 获取一个表的某条记录的某个属性
 *
 * @param unknown $name        	
 * @param unknown $attr        	
 * @param unknown $where        	
 * @return Ambigous <mixed, NULL, multitype:Ambigous <unknown, string> unknown , multitype:>
 */
function getAttr($name, $attr, $where)
{

	$m = M ( $name );
	$a = $m->where ( $where )->getField ( $attr );
	return $a;

}

/**
 * 更新一条记录
 *
 * @param 表名 $tname        	
 * @param id名 $id        	
 * @param 更新的数据 $data，更新的数据中必须含有主键        	
 * @return Ambigous <boolean, false, number>
 */
function updateRow($tname, $id, $data)
{

	$m = M ( $tname );
	$ok = $m->where ( 'id=' . $id )->save ( $data );
	return $ok;

}

/**
 * 更新一行数据，可以不含有主键
 *
 * @param 表名 $tname        	
 * @param 条件 $where        	
 * @param 字段名 $field        	
 * @param 字段值 $value        	
 * @return Ambigous <boolean, unknown, false, number>
 */
function updateField($tname, $where, $field, $value)
{

	$m = M ( $tname );
	$ok = $m->where ( $where )->setField ( $field, $value );
	return $ok;

}

/**
 * 字段值增长
 *
 * @param 表名 $tname        	
 * @param number $id        	
 * @param 字段名 $field        	
 * @param number $step        	
 * @return Ambigous <boolean, unknown, false, number>
 */
function setInc($tname, $id, $field, $step = 1)
{

	$m = M ( $tname );
	$ok = $m->where ( 'id=' . $id )->setInc ( $field, $step );
	return $ok;

}

/**
 * 字段值减少
 *
 * @param 表名 $tname        	
 * @param number $id        	
 * @param 字段名 $field        	
 * @param number $step        	
 * @return Ambigous <boolean, unknown, false, number>
 */
function setDec($tname, $id, $field, $step = 1)
{

	$m = M ( $tname );
	$ok = $m->where ( 'id=' . $id )->setDec ( $field, $step );
	return $ok;

}

/**
 * 添加一条记录
 *
 * @param 表名 $tname        	
 * @param 数据 $data        	
 * @return Ambigous <mixed, boolean, string, unknown, false, number>
 */
function insertRow($tname, $data)
{

	$m = M ( $tname );
	$ok = $m->add ( $data );
	return $ok;

}

/**
 * 删除多条记录
 *
 * @param 表名 $tname        	
 * @param 条件 $where        	
 * @return Ambigous <mixed, boolean, false, number>
 */
function deleteList($tname, $where)
{

	$m = M ( $tname );
	$ok = $m->where ( $where )->delete ();
	return $ok;

}

/**
 * 删除一条记录
 *
 * @param 表名 $tname        	
 * @param id值 $id        	
 * @return Ambigous <mixed, boolean, false, number>
 */
function deleteRow($tname, $id)
{

	$m = M ( $tname );
	$ok = $m->where ( 'id=' . $id )->delete ();
	return $ok;

}

/**
 * 对查询结果集进行排序
 *
 * @access public
 * @param array $list
 *        	查询结果
 * @param string $field
 *        	排序的字段名
 * @param array $sortby
 *        	排序类型
 *        	asc正向排序 desc逆向排序 nat自然排序
 * @return array
 * @author fuhao.li
 */
function list_sort_by($list, $field, $sortby = 'asc')
{

	if (is_array ( $list ))
	{
		$refer = $resultSet = array ();
		foreach ( $list as $i => $data )
			$refer [$i] = &$data [$field];
		switch ($sortby)
		{
			case 'asc' : // 正向排序
				asort ( $refer );
				break;
			case 'desc' : // 逆向排序
				arsort ( $refer );
				break;
			case 'nat' : // 自然排序
				natcasesort ( $refer );
				break;
		}
		foreach ( $refer as $key => $val )
			$resultSet [] = &$list [$key];
		return $resultSet;
	}
	return false;

}

/**
 * 时间戳格式化
 *
 * @param int $time        	
 * @return string 完整的时间显示
 * @author fuhao.li
 */
function time_format($time = NULL, $format = 'Y-m-d H:i')
{

	$time = $time === NULL ? NOW_TIME : intval ( $time );
	return date ( $format, $time );

}

function uploadImg()
{


}

function uploadFile()
{


}

// ----------------catelog---------------//
function aop_get_catelog_father_list()
{

	$model = new Model ();
	$sql = "select distinct father from blkq_catelog where father not in ('优雅环境','医师团队','口腔视频','领先设备') ";
	$list = $model->query ( $sql );
	return $list;

}

function aop_get_catelog_child_list($father = '')
{

	return M ( 'catelog' )->where ( 'father="' . $father . '"' )->Distinct ( true )->field ( 'child,id' )->select ();

}

function aop_get_catelog_info($father, $child)
{

	return M ( 'catelog' )->where ( 'father="' . $father . '" and child="' . $child . '" ' )->find ();

}

// --------------- PUBLIC ---------------//
// 调用option
function mc_option($meta_key, $type = 'public')
{

	return M ( 'option' )->where ( "meta_key='$meta_key' AND type='$type'" )->getField ( 'meta_value' );

}
;
// 新增option
function mc_add_option($meta_key, $meta_value, $type = 'public')
{

	$meta ['meta_key'] = $meta_key;
	$meta ['meta_value'] = $meta_value;
	$meta ['type'] = $type;
	M ( 'option' )->data ( $meta )->add ();

}
;
// 更新option
function mc_update_option($meta_key, $meta_value, $type = 'public')
{

	M ( 'option' )->where ( "meta_key='$meta_key' AND type = '$type'" )->delete ();
	$meta ['meta_key'] = $meta_key;
	$meta ['meta_value'] = $meta_value;
	$meta ['type'] = $type;
	$ok = M ( 'option' )->data ( $meta )->add ();
	return $ok;

}
;

// 列表页循环
function mc_page()
{

	$key = "%totalRow% %header% %nowPage%/%totalPage% 页 %upPage% %downPage% %first% %prePage% %linkPage% %nextPage% %end%";
	return $key;

}

/**
 * 获取留言和预约消息的个数
 *
 * @param string $type        	
 */
function get_xinxi($type = "liuyan")
{

	if ($type == "liuyan")
	{
		$count = M ( 'message' )->where ( 'is_reply=0 ' )->count ();
	} elseif ($type == "yuyue")
	{
		$count = M ( 'order' )->where("is_chuli=0")->count ();
	}
	return $count;

}

/**
 *
 * 发送post信息
 * @param unknown_type $url
 * @param unknown_type $post_data
 */
function send_post($url, $post_data)
{

	$postdata = http_build_query ( $post_data );
	$options = array (
			'http' => array (
					'method' => 'POST',
					'header' => 'Content-type:application/x-www-form-urlencoded',
					'content' => $postdata,
					'timeout' => 15 * 60 
			) 
	);
	$context = stream_context_create ( $options );
	$result = file_get_contents ( $url, false, $context );
	return $result;

}

/**
 *
 * 发送get的请求
 * @param unknown_type $url
 * @param unknown_type $post_data
 */
function send_get($url)
{
	$html = file_get_contents($url);  
	return  $html;
}

/**
 *
 * 使用特定的微信接口发送微信
 * @param unknown_type $weixin_id
 * @param unknown_type $content
 */
function send_weixin($weixin_id, $content)
{
	$url = 'http://1.weixinblkq.sinaapp.com/4/send_mes.php?id='.$weixin_id.'&content='.$content;
	$result = send_get($url);
	return $result;
}

