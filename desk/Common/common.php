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

//=====================================================================================
//转成新浪短网址
function toShortUrl($long_url){
	$apiKey = SINA_APIKEY;
	$apiUrl = 'http://api.t.sina.com.cn/short_url/shorten.json?source='.$apiKey.'&url_long='.$long_url;
	$curlObj = curl_init();
	curl_setopt($curlObj, CURLOPT_URL, $apiUrl);
	curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curlObj, CURLOPT_HEADER, 0);
	curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
	$response = curl_exec($curlObj);
	curl_close($curlObj);
	$json = json_decode($response);
	return $json[0]->url_short;
}
//还原新浪短网址
function toLongUrl($short_url){
	$apiKey = SINA_APIKEY;
	$apiUrl = 'http://api.t.sina.com.cn/short_url/expand.json?source='.$apiKey.'&url_short='.$short_url;
	$curlObj = curl_init();
	curl_setopt($curlObj, CURLOPT_URL, $apiUrl);
	curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curlObj, CURLOPT_HEADER, 0);
	curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
	$response = curl_exec($curlObj);
	curl_close($curlObj);
	$json = json_decode($response);
	return $json[0]->url_long;
}
//防sql注入
function sqlInjection($string,$force=0){
	if(!$GLOBALS['magic_quotes_gpc'] || $force){
		if(is_array($string)){
			foreach($string as $key => $val){
				$string[$key] = sqlInjection($val, $force);
			}
		}else{
			$string = addslashes($string);
		}
		$string = str_replace('\'', "''",$string);
	}
	return $string;
}
//字符串累加
function addstr($str,$add,$sign){$str=($str=='')?$add:($str.$sign.$add);return $str;}
//替换单引号和双引号
function toQuote($str){$str=str_replace("'",'&#39;',$str);$str=str_replace('"','&#34;',$str);return trim($str);}
function deQuote($str){$str=str_replace('&#39;',"'",$str);$str=str_replace('&#34;','"',$str);return trim($str);}
//常规字符串条件替换
function replaceStr($mode,$str,$from,$to){
	switch($mode){
		case "":
			$return = strtr($str,array($from => $to));
			break;
		case "empty":
			$return = (empty($str)||$str=='') ? $from : $str;
			break;
	}
	return $return;
}
//文件地址处理
function getFileInfo($str,$mode){
	if($str==""||is_null($str)) return "";
	switch($mode){
		case "path" : return dirname($str); break;
		case "name" : return basename($str,'.'.end(explode(".",$str))); break;
		case "ext" : return end(explode(".",$str)); break;
		case "simg" : return getFileInfo($str,"path")."/s_".getFileInfo($str,"name").".jpg"; break;
	}
}
//字符截断，支持中英文不乱码
function cutstr($str,$len=0,$dot='...',$encoding='utf-8'){if(!is_numeric($len)){$len=intval($len);}if(!$len || strlen($str)<= $len){return $str;}$tempstr='';$str=str_replace(array('&', '"', '<', '>'),array('&', '"', '<', '>'),$str);if($encoding=='utf-8'){$n=$tn=$noc=0;while($n < strlen($str)){$t = ord($str[$n]);if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {$tn = 1; $n++; $noc++;} elseif (194 <= $t && $t <= 223) {$tn = 2; $n += 2; $noc += 2;} elseif (224 <= $t && $t < 239) {$tn = 3; $n += 3; $noc += 2;} elseif (240 <= $t && $t <= 247) {$tn = 4; $n += 4; $noc += 2;} elseif (248 <= $t && $t <= 251) {   $tn = 5; $n += 5; $noc += 2;} elseif ($t == 252 || $t == 253) {$tn = 6; $n += 6; $noc += 2;} else {$n++;}if($noc >= $len){break;}}if($noc > $len) {$n -= $tn;}$tempstr = substr($str, 0, $n);} elseif ($encoding == 'gbk') {for ($i=0; $i<$len; $i++) {$tempstr .= ord($str{$i}) > 127 ? $str{$i}.$str{++$i} : $str{$i};}}$tempstr = str_replace(array('&', '"', '<', '>'), array('&', '"', '<', '>'), $tempstr);return $tempstr.$dot;}
//字符截断，支持html补全
function cuthtml($str,$length=0,$suffixStr="...",$clearhtml=true,$charset="utf-8",$start=0,$tags="P|DIV|H1|H2|H3|H4|H5|H6|ADDRESS|PRE|TABLE|TR|TD|TH|INPUT|SELECT|TEXTAREA|OBJECT|A|UL|OL|LI|BASE|META|LINK|HR|BR|PARAM|IMG|AREA|INPUT|SPAN",$zhfw=0.9){
	if($clearhtml||$clearhtml==1){return cutstr(strip_tags($str),$length,$suffixStr,$charset);}
	$re['utf-8']     = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
	$re['gb2312']    = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
	$re['gbk']       = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
	$re['big5']      = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
	$zhre['utf-8']   = "/[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
	$zhre['gb2312']  = "/[\xb0-\xf7][\xa0-\xfe]/";
	$zhre['gbk']     = "/[\x81-\xfe][\x40-\xfe]/";
	$zhre['big5']    = "/[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
	$tpos = array();
	preg_match_all("/<(".$tags.")([\s\S]*?)>|<\/(".$tags.")>/ism", $str, $match);
	$mpos = 0;
	for($j = 0; $j < count($match[0]); $j ++){
		$mpos = strpos($str, $match[0][$j], $mpos);
		$tpos[$mpos] = $match[0][$j];
		$mpos += strlen($match[0][$j]);
	}
	ksort($tpos);
	$sarr = array();
	$bpos = 0;
	$epos = 0;
	foreach($tpos as $k => $v){
		$temp = substr($str, $bpos, $k - $epos);
		if(!empty($temp))array_push($sarr, $temp);
		array_push($sarr, $v);
		$bpos = ($k + strlen($v));
		$epos = $k + strlen($v);
	}
	$temp = substr($str, $bpos);
	if(!empty($temp))array_push($sarr, $temp);
	$bpos = $start;
	$epos = $length;
	for($i = 0; $i < count($sarr); $i ++){
		if(preg_match("/^<([\s\S]*?)>$/i", $sarr[$i]))continue;
		preg_match_all($re[$charset], $sarr[$i], $match);
		for($j = $bpos; $j < min($epos, count($match[0])); $j ++){
			if(preg_match($zhre[$charset], $match[0][$j]))$epos -= $zhfw;
		}
		$sarr[$i] = "";
		for($j = $bpos; $j < min($epos, count($match[0])); $j ++){
			$sarr[$i] .= $match[0][$j];
		}
		$bpos -= count($match[0]);
		$bpos = max(0, $bpos);
		$epos -= count($match[0]);
		$epos = round($epos);
	}
	$slice = join("", $sarr);
	if($slice != $str)return $slice.$suffixStr;
	return $slice;
}
//根据tinyint字段判断显示内容
function showTinyintMsg($val,$str1,$str2){
	if($val==1){$out=$str1;}else{$out=$str2;}
	return $out;
}
//获取内网IP
function getIp(){
	$ip=false;
	if(!empty($_SERVER["HTTP_CLIENT_IP"])){
		$ip = $_SERVER["HTTP_CLIENT_IP"];
	}
	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
		if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
		for ($i = 0; $i < count($ips); $i++) {
			if (!eregi ("^(10|172\.16|192\.168)\.", $ips[$i])) {
				$ip = $ips[$i];
				break;
			}
		}
	}
	return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}
//生成随机字符串
function getRandStr($len = 4){
	$chars = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","0","1","2","3","4","5","6","7","8","9");
	$charsLen = count($chars) - 1;
	shuffle($chars);
	$output = "";
	for($i=0; $i<$len; $i++){
		$output .= $chars[mt_rand(0, $charsLen)];
	}
	return $output;
}
//获取指定日期所在月的第一天和最后一天
function getTheMonth($date){
	$firstday = date("Y-m-01",strtotime($date));
	$lastday = date("Y-m-d",strtotime("$firstday +1 month -1 day"));
	return array($firstday,$lastday);
}
//获取指定日期上个月的第一天和最后一天
function getPurMonth($date){
	$time=strtotime($date);
	$firstday=date('Y-m-01',strtotime(date('Y',$time).'-'.(date('m',$time)-1).'-01'));
	$lastday=date('Y-m-d',strtotime("$firstday +1 month -1 day"));
	return array($firstday,$lastday);
}
//字符串编码任意转换
function charsetConvert($source,$source_lang,$target_lang='utf-8'){
	if($source_lang != ''){
		$source_lang = str_replace(array('gbk','utf8','big-5'),array('gb2312','utf-8','big5'),strtolower($source_lang));
	}
	if($target_lang != ''){
		$target_lang = str_replace(array('gbk','utf8','big-5'),array('gb2312','utf-8','big5'),strtolower($target_lang));
	}
	if($source_lang == $target_lang||$source == ''){
		return $source;
	}
	$index = $source_lang."_".$target_lang;
	//繁简互换并不是交换字符集编码
	if(USEEXISTS&&!in_array($index,array('gb2312_big5','big5_gb2312'))){
		if(function_exists('iconv')){
			return iconv($source_lang,$target_lang,$source);
		}
		if(function_exists('mb_convert_encoding')){
			return mb_convert_encoding($source,$target_lang,$source_lang);
		}
	}
	$table = self::loadtable($index);
	if(!$table){
		return $source;
	}
	self::$string = $source;
	self::$source_lang = $source_lang;
	self::$target_lang = $target_lang;
	if($source_lang=='gb2312'||$source_lang=='big5'){
		if($target_lang=='utf-8'){
			self::$table = $table;
			return self::CHS2UTF8();
		}
		if($target_lang=='gb2312'){
			self::$table = array_flip($table);
		}else{
			self::$table = $table;
		}
		return self::BIG2GB();
	}elseif(self::$source_lang=='utf-8'){
		self::$table = array_flip($table);
		return self::UTF82CHS();
	}
	return NULL;
}
function loadtable($index){
	static $table = array();
	$tabIndex = '';
	switch ($index) {
		case 'gb2312_utf-8':
		case 'utf-8_gb2312':
		case 'gb2312escape':
		case 'unescapetogb2312':
			$tabIndex = 'gbkutf';
			break;
		case 'big5_utf-8':
		case 'utf-8_big5':
		case 'big5escape':
		case 'unescapetobig5':
			$tabIndex = 'big5utf';
			break;
		case 'gb2312_big5':
		case 'big5_gb2312':
			$tabIndex = 'gbkbig5';
			break;
		default:return NULL;
	}
	if(!isset($table[$tabIndex])){
		$table[$tabIndex] = @include(TABLE_DIR."/".$tabIndex.".php");
	}
	return $table[$tabIndex];
}
//字符转日期格式函数
function strToDt($date_time_string){
	if($date_time_string == ""){
		$date_time_string = "NULL";
	}else{
		$date_time_string = $date_time_string;
	}
	$dt_elements = explode(" " ,$date_time_string);
	$date_elements = explode("/" ,$dt_elements[0]);
	$time_elements = explode(":" ,$dt_elements[1]);
	if ($dt_elements [2]== "PM") { $time_elements[0]+=12;}
	return date("Y-m-d h:i:s",mktime($time_elements [0], $time_elements[1], $time_elements[2], $date_elements[1], $date_elements[2], $date_elements[0]));
}
//日期对比
function dtDiff($interval,$date1,$date2){
	$timedifference=formatTm($date1)-formatTm($date2);
	switch($interval){
		case "y":$retval=bcdiv($timedifference,86400*360);break;
		case "m":$retval=bcdiv($timedifference,86400*30);break;
		case "w":$retval=bcdiv($timedifference,604800);break;
		case "d":$retval=bcdiv($timedifference,86400);break;
		case "h":$retval=bcdiv($timedifference,3600);break;
		case "n":$retval=bcdiv($timedifference,60);break;
		case "s":$retval=$timedifference;break;
	}
	//$retval=($retval<=0) ? $retval=1 : $retval+1 ;
	return $retval;
}
function formatTm($timestamp = ''){
	list($date,$time)=explode(" ",$timestamp);
	list($year,$month,$day)=explode("-",$date);
	list($hour,$minute,$seconds )=explode(":",$time);
	$timestamp=gmmktime($hour,$minute,$seconds,$month,$day,$year);
	return $timestamp;
}
//日期加减
function dtAdd($interval,$number,$date){
	//$date_time_string=strftime("%Y/%m/%d %H:%M:%S",$date);
	//$date_time_string=date("%Y/%m/%d %H:%M:%S",$date);
	$date_time_string = $date;
	$dt_elements = explode(" " ,$date_time_string);
	$date_elements = explode("-" ,$dt_elements[0]);
	$time_elements = explode(":" ,$dt_elements[1]);
	if ($dt_elements [2]== "PM") { $time_elements[0]+=12;}
	$hours = $time_elements [0];
	$minutes = $time_elements [1];
	$seconds = $time_elements [2];
	$month = $date_elements[1];
	$day = $date_elements[2];
	$year = $date_elements[0];
	switch ($interval) {
		case "yyyy": $year +=$number; break;
		case "q": $month +=($number*3); break;
		case "m": $month +=$number; break;
		case "y":
		case "d":
		case "w": $day+=$number; break;
		case "ww": $day+=($number*7); break;
		case "h": $hours+=$number; break;
		case "n": $minutes+=$number; break;
		case "s": $seconds+=$number; break;
	}
	$timestamp = mktime($hours,$minutes,$seconds,$month,$day,$year);
	$timestamp = strftime("%Y-%m-%d %H:%M:%S",$timestamp);
	return $timestamp;
}
//连续创建带层级的文件夹
function recursive_mkdir($folder){
	$folder = preg_split( "/[\\\\\/]/" , $folder );
	$mkfolder = '';
	for($i=0; isset($folder[$i]); $i++){
		if(!strlen(trim($folder[$i]))){
			continue;
		}
		$mkfolder .= $folder[$i];
		if(!is_dir($mkfolder)){
			mkdir("$mkfolder",0777);
		}
		$mkfolder .= DIRECTORY_SEPARATOR;
	}
}

/*****以下方法仅限该项目*****/

//获取图片缩略图地址
function getSimgSrc($string){
	return preg_replace("#(\w*\..*)$#U", "s_\${1}", $string);
}

//获取我的应用id数组
function getMyAppListOnlyId(){
	global $db;
	$rs = $db->select(0, 1, 'tb_member', 'dock,desk1,desk2,desk3,desk4,desk5', 'and tbid='.$_SESSION['member']['id']);
	if($rs['dock'] != ''){
		$dock = explode(',', $rs['dock']);
		foreach($dock as $v){
			$tmp = explode('_', $v);
			if($tmp[0] == 'app' || $tmp[0] == 'widget'){
				$appid[] = $tmp[1];
			}
		}
	}
	for($i=1; $i<=5; $i++){
		if($rs['desk'.$i] != ''){
			$deskappid = explode(',', $rs['desk'.$i]);
			foreach($deskappid as $v){
				$tmp = explode('_', $v);
				if($tmp[0] == 'app' || $tmp[0] == 'widget'){
					$appid[] = $tmp[1];
				}
			}
		}
	}
	$rs = $db->select(0, 0, 'tb_folder', 'content', 'and content!="" and member_id='.$_SESSION['member']['id']);
	if($rs != NULL){
		foreach($rs as $v){
			$rss = explode(',', $v['content']);
			foreach($rss as $vv){
				$tmp = explode('_', $vv);
				if($tmp[0] == 'app' || $tmp[0] == 'widget'){
					$appid[] = $tmp[1];
				}
			}
		}
	}
	if($appid != NULL){
		return $appid;
	}else{
		return NULL;
	}
}
//获取我的应用id数组
function getMyAppList(){
	global $db;
	$rs = $db->select(0, 1, 'tb_member', 'dock,desk1,desk2,desk3,desk4,desk5', 'and tbid='.$_SESSION['member']['id']);
	if($rs['dock'] != ''){
		$dock = explode(',', $rs['dock']);
		foreach($dock as $v){
			$appid[] = $v;
		}
	}
	for($i=1; $i<=5; $i++){
		if($rs['desk'.$i] != ''){
			$deskappid = explode(',', $rs['desk'.$i]);
			foreach($deskappid as $v){
				$appid[] = $v;
			}
		}
	}
	$rs = $db->select(0, 0, 'tb_folder', 'content', 'and content!="" and member_id='.$_SESSION['member']['id']);
	if($rs != NULL){
		foreach($rs as $v){
			$rss = explode(',', $v['content']);
			foreach($rss as $vv){
				$appid[] = $vv;
			}
		}
	}
	if($appid != NULL){
		return $appid;
	}else{
		return NULL;
	}
}
//验证是否已安装该应用
function checkAppIsMine($id){
	$flag = false;
	$myapplist = getMyAppList();
	if(in_array($id, $myapplist)){
		$flag = true;
	}
	return $flag;
}
//强制格式化appid，如：'10,13,,17,4,6,'，格式化后：'10,13,17,4,6'
function formatAppidArray($arr){
	foreach($arr as $k => $v){
		if($v==''){
			unset($arr[$k]);
		}
	}
	return $arr;
}
//验证是否登入
function checkLogin(){
	return $_SESSION['member'] != NULL ? true : false;
}
//验证是否为管理员
function checkAdmin(){
	global $db;
	$user = $db->select(0, 1, 'tb_member', 'type', 'and tbid='.$_SESSION['member']['id']);
	return $user['type'] == 1 ? true : false;
}
//验证是否有权限
function checkPermissions($app_id){
	global $db;
	$isHavePermissions = false;
	$user = $db->select(0, 1, 'tb_member', 'permission_id', 'and tbid='.$_SESSION['member']['id']);
	if($user['permission_id'] != ''){
		$permission = $db->select(0, 1, 'tb_permission', 'apps_id', 'and tbid='.$user['permission_id']);
		if($permission['apps_id'] != ''){
			$apps = explode(',', $permission['apps_id']);
			if(in_array($app_id, $apps)){
				$isHavePermissions = true;
			}
		}
	}
	return $isHavePermissions;
}

//==========================================================

/*构造函数*/
function __construct($config){
	$this->Config = $config;
	$this->connect();
}

/*数据库连接*/
 function connect(){
	//$this->pdo = mysql_connect("","aoplee","aoplee");
	$this->pdo = new PDO($this->Config['dsn'], $this->Config['name'], $this->Config['password']);
	$this->pdo->query('set names utf8;');
	//自己写代码捕获Exception
	$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

/*数据库关闭*/
 function close(){
	$this->pdo = null;
}

 function query($sql){
	$res = $this->pdo->query($sql);
	if($res){
		$this->res = $res;
	}
}
 function exec($sql){
	$res = $this->pdo->exec($sql);
	if($res){
		$this->res = $res;
	}
}
 function fetchAll(){
	return $this->res->fetchAll();
}
 function fetch(){
	return $this->res->fetch();
}
 function fetchColumn(){
	return $this->res->fetchColumn();
}
 function lastInsertId(){
	return $this->pdo->lastInsertId();
}

/**
 * 参数说明
 * int				$debug		是否开启调试，开启则输出sql语句
 *								0	不开启
 *								1	开启
 *								2	开启并终止程序
 * int				$mode		返回类型
 *								0	返回多条记录
 *								1	返回单条记录
 *								2	返回行数
 * string/array		$table		数据库表，两种传值模式
 *								普通模式：
 *								'tb_member, tb_money'
 *								数组模式：
 *								array('tb_member', 'tb_money')
 * string/array		$fields		需要查询的数据库字段，允许为空，默认为查找全部，两种传值模式
 *								普通模式：
 *								'username, password'
 *								数组模式：
 *								array('username', 'password')
 * string/array		$sqlwhere	查询条件，允许为空，两种传值模式
 *								普通模式：
 *								'and type = 1 and username like "%os%"'
 *								数组模式：
 *								array('type = 1', 'username like "%os%"')
 * string			$orderby	排序，默认为id倒序
 */
 function select($debug, $mode, $table, $fields="*", $sqlwhere="", $orderby="tbid desc"){
	//参数处理
	if(is_array($table)){
		$table = implode(', ', $table);
	}
	if(is_array($fields)){
		$fields = implode(', ', $fields);
	}
	if(is_array($sqlwhere)){
		$sqlwhere = ' and '.implode(' and ', $sqlwhere);
	}
	//数据库操作
	if($debug === 0){
		if($mode === 2){
			$this->query("select count(1) from $table where 1=1 $sqlwhere");
			$return = $this->fetchColumn();
		}else if($mode === 1){
			$this->query("select $fields from $table where 1=1 $sqlwhere order by $orderby");
			$return = $this->fetch();
		}else{
			$this->query("select $fields from $table where 1=1 $sqlwhere order by $orderby");
			$return = $this->fetchAll();
		}
		return $return;
	}else{
		if($mode === 2){
			echo "select count(1) from $table where 1=1 $sqlwhere";
		}else if($mode === 1){
			echo "select $fields from $table where 1=1 $sqlwhere order by $orderby";
		}
		else{
			echo "select $fields from $table where 1=1 $sqlwhere order by $orderby";
		}
		if($debug === 2){
			exit;
		}
	}
}

/**
 * 参数说明
 * int				$debug		是否开启调试，开启则输出sql语句
 *								0	不开启
 *								1	开启
 *								2	开启并终止程序
 * int				$mode		返回类型
 *								0	无返回信息
 *								1	返回执行条目数
 *								2	返回最后一次插入记录的id
 * string/array		$table		数据库表，两种传值模式
 *								普通模式：
 *								'tb_member, tb_money'
 *								数组模式：
 *								array('tb_member', 'tb_money')
 * string/array		$set		需要插入的字段及内容，两种传值模式
 *								普通模式：
 *								'username = "test", type = 1, dt = now()'
 *								数组模式：
 *								array('username = "test"', 'type = 1', 'dt = now()')
 */
 function insert($debug, $mode, $table, $set){
	//参数处理
	if(is_array($table)){
		$table = implode(', ', $table);
	}
	if(is_array($set)){
		$set = implode(', ', $set);
	}
	//数据库操作
	if($debug === 0){
		if($mode === 2){
			$this->query("insert into $table set $set");
			$return = $this->lastInsertId();
		}else if($mode === 1){
			$this->exec("insert into $table set $set");
			$return = $this->res;
		}else{
			$this->query("insert into $table set $set");
			$return = NULL;
		}
		return $return;
	}else{
		echo "insert into $table set $set";
		if($debug === 2){
			exit;
		}
	}
}

/**
 * 参数说明
 * int				$debug		是否开启调试，开启则输出sql语句
 *								0	不开启
 *								1	开启
 *								2	开启并终止程序
 * int				$mode		返回类型
 *								0	无返回信息
 *								1	返回执行条目数
 * string			$table		数据库表，两种传值模式
 *								普通模式：
 *								'tb_member, tb_money'
 *								数组模式：
 *								array('tb_member', 'tb_money')
 * string/array		$set		需要更新的字段及内容，两种传值模式
 *								普通模式：
 *								'username = "test", type = 1, dt = now()'
 *								数组模式：
 *								array('username = "test"', 'type = 1', 'dt = now()')
 * string/array		$sqlwhere	修改条件，允许为空，两种传值模式
 *								普通模式：
 *								'and type = 1 and username like "%os%"'
 *								数组模式：
 *								array('type = 1', 'username like "%os%"')
 */
 function update($debug, $mode, $table, $set, $sqlwhere=""){
//参数处理
	if(is_array($table)){
		$table = implode(', ', $table);
	}
	if(is_array($set)){
		$set = implode(', ', $set);
	}
	if(is_array($sqlwhere)){
		$sqlwhere = ' and '.implode(' and ', $sqlwhere);
	}
	//数据库操作
	if($debug === 0){
		if($mode === 1){
			$this->exec("update $table set $set where 1=1 $sqlwhere");
			$return = $this->res;
		}else{
			$this->query("update $table set $set where 1=1 $sqlwhere");
			$return = NULL;
		}
		return $return;
	}else{
		echo "update $table set $set where 1=1 $sqlwhere";
		if($debug === 2){
			exit;
		}
	}
}

/**
 * 参数说明
 * int				$debug		是否开启调试，开启则输出sql语句
 *								0	不开启
 *								1	开启
 *								2	开启并终止程序
 * int				$mode		返回类型
 *								0	无返回信息
 *								1	返回执行条目数
 * string			$table		数据库表
 * string/array		$sqlwhere	删除条件，允许为空，两种传值模式
 *								普通模式：
 *								'and type = 1 and username like "%os%"'
 *								数组模式：
 *								array('type = 1', 'username like "%os%"')
 */
 function delete($debug, $mode, $table, $sqlwhere=""){
	//参数处理
	if(is_array($sqlwhere)){
		$sqlwhere = ' and '.implode(' and ', $sqlwhere);
	}
	//数据库操作
	if($debug === 0){
		if($mode === 1){
			$this->exec("delete from $table where 1=1 $sqlwhere");
			$return = $this->res;
		}else{
			$this->query("delete from $table where 1=1 $sqlwhere");
			$return = NULL;
		}
		return $return;
	}else{
		echo "delete from $table where 1=1 $sqlwhere";
		if($debug === 2){
			exit;
		}
	}
}





