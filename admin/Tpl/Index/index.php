<include file="public/head" />


	<div class="line-big">
    	<div class="xm3">
        	<div class="panel border-back">
            	<div class="panel-body text-center">
                	<img src="__PUBLIC__/img/face.jpg" width="120" class="radius-circle" /><br />
                    admin
                </div>
                <div class="panel-foot bg-back border-back">您好，<?php echo session('user.user_name')?>，上次登录为<?php echo getAttr("user", 'last_login_time', 'user_name="'.session('user.user_name').'"')?> ,上次登录的IP是：<?php echo getAttr("user", 'last_login_ip', 'user_name="'.session('user.user_name').'"')?>。</div>
            </div>
            <br />
        	<div class="panel">
            	<div class="panel-head"><strong>站点统计</strong></div>
                <ul class="list-group">
                    <li><span class="float-right badge bg-main">828</span><span class="icon-file"></span> 文件</li>
                    <li><span class="float-right badge bg-main">828</span><span class="icon-file-text"></span> 内容</li>
                    <li><span class="float-right badge bg-main">828</span><span class="icon-database"></span> 数据库</li>
                </ul>
            </div>
            <br />
        </div>
        <div class="xm9">
        	<div class="alert alert-yellow"><span class="close"></span><strong>注意：</strong>您有<?php echo get_xinxi('liuyan')?>条未回复的留言，<a href="<?php echo U("message/index_liuyan");?>">点击查看</a>。</div>
        	<div class="alert alert-red"><span class="close"></span><strong>注意：</strong>您有<?php echo get_xinxi('yuyue')?>条未处理预约，<a href="<?php echo U("message/index_yuyue");?>">点击查看</a>。</div>
<!--             <div class="alert"> -->
<!--                 <h4>拼图前端框架介绍</h4> -->
<!--                 <p class="text-gray padding-top">拼图是优秀的响应式前端CSS框架，国内前端框架先驱及领导者，自动适应手机、平板、电脑等设备，让前端开发像游戏般快乐、简单、灵活、便捷。</p> -->
<!--             	<a target="_blank" class="button bg-dot icon-code" href="pintuer2.zip"> 下载示例代码</a>  -->
<!--             	<a target="_blank" class="button bg-main icon-download" href="http://www.pintuer.com/pintuer.zip"> 下载拼图框架</a>  -->
<!--             	<a target="_blank" class="button border-main icon-file" href="http://www.pintuer.com/"> 拼图使用教程</a> -->
<!--             </div> -->
            <div class="panel">
            	<div class="panel-head"><strong>系统信息</strong></div>
                <table class="table">
                	<tr><th colspan="2">服务器信息</th></tr>
                    <tr><td width="110" align="right">操作系统：</td><td>Windows 2008</td></tr>
                    <tr><td align="right">Web服务器：</td><td>Apache</td></tr>
                    <tr><td align="right">程序语言：</td><td>PHP</td></tr>
                    <tr><td align="right">数据库：</td><td>MySQL</td></tr>
                </table>
            </div>
        </div>
    </div>


<include file='public/foot' />