<!DOCTYPE html>
<html lang="zh-cn">
<head>

    <title><?php echo mc_option('site_name')?>-医师</title>
    <meta name="keywords" content="<?php echo mc_option('keyword');?>" />
    <meta name="description" content="<?php echo mc_option('description');?>" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="__ROOT__/icon.ico" rel="shortcut icon">
    <link rel="stylesheet" href="__PUBLIC__/pintuer/pintuer.css">
    <link rel="stylesheet" href="__PUBLIC__/pintuer/your.css">
    <script src="__PUBLIC__/pintuer/jquery.js"></script>
    <script src="__PUBLIC__/pintuer/pintuer.js"></script>
    <script src="__PUBLIC__/pintuer/respond.js"></script>
    <script src="__PUBLIC__/pintuer/your.js"></script>  
    <link rel="stylesheet" href="__PUBLIC__/pintuer/admin/admin.css">
    <script src="__PUBLIC__/pintuer/admin/admin.js"></script>
</head>

<body>
<div class="container">
    <div class="line">
        <div class="xs6 xm4 xs3-move xm4-move">
            <br /><br />
            <div class="media media-y">
                <a href="<?php echo mc_option("site_url")?>" target="_blank"><img src="<?php echo mc_option('logo');?>" class="radius" alt="后台管理系统" /></a>
            </div>
            <br /><br />
            
            
            <form action="<?php echo U('doctor/login');?>" method="post">
            <div class="panel">
                <div class="panel-head">登录 <strong> <?php echo mc_option('site_name'); ?></strong> 医师预约系统</div>
                <div class="panel-body" style="padding:30px;">
                    <div class="form-group">
                        <div class="field field-icon-right">
                            <input type="text" class="input" name="name" placeholder="登录账号" data-validate="required:请填写账号,length#>=5:账号长度不符合要求" />
                            <span class="icon icon-user"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="field field-icon-right">
                            <input type="password" class="input" name="password" placeholder="登录密码" data-validate="required:请填写密码,length#>=8:密码长度不符合要求" />
                            <span class="icon icon-key"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="field">
                            <input type="text" class="input" name="verify" placeholder="填写右侧的验证码" data-validate="required:请填写右侧的验证码" />
                            <img src="<?php echo U("index/verify");?>" width="80" height="32" class="passcode" />
                        </div>
                    </div>
                </div>
                <input type='hidden' name='tag' value='tag' />
                <div class="panel-foot text-center"><button class="button button-block bg-main text-big">立即登录后台</button></div>
            </div>
            </form>
            
            
        </div>
    </div>
</div>


</body>
</html>