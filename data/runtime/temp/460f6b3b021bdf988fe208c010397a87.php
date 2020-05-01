<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:42:"themes/admin_simpleboot3/admin\\login.html";i:1570003474;}*/ ?>

<!DOCTYPE html>
<html lang="en" class="no-js">

<head>

    <meta charset="utf-8">
    <title>微信直播后台管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->
    <!-- CSS -->
    <link rel="stylesheet" href="/static/admin-login/css/reset.css">
    <link rel="stylesheet" href="/static/admin-login/css/supersized.css">
    <link rel="stylesheet" href="/static/admin-login/css/style.css">
    <link href="/static/js/new_noty/ns-default.css" rel="stylesheet" type="text/css">
    <link href="/static/js/new_noty/ns-style-growl.css" rel="stylesheet" type="text/css">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>

    <![endif]-->

</head>

<body oncontextmenu="return false">

<div class="page-container">
    <h1>Login</h1>
    <form class="js-ajax-form" action="<?php echo url('public/doLogin'); ?>" method="post">

        <div>
            <input type="text" name="username" class="username"placeholder="<?php echo lang('USERNAME_OR_EMAIL'); ?>" title="<?php echo lang('USERNAME_OR_EMAIL'); ?>"
                   value="" data-rule-required="true"/>
        </div>
        <div>
            <input type="password" id="input_password" class="form-control" name="password"
                   placeholder="<?php echo lang('PASSWORD'); ?>" title="<?php echo lang('PASSWORD'); ?>" data-rule-required="true"
                   data-msg-required="" value=""/>
        </div>
        <button id="submit" class="btn btn-primary btn-block js-ajax-submit" type="submit" data-loadingmsg="<?php echo lang('LOADING'); ?>">登 录</button>
        <!--<input id="submit" type="submit" value="登 录">-->
    </form>
    <div class="connect">
        <!--<p>If we can only encounter each other rather than stay with each other,then I wish we had never encountered.</p>-->
        <p style="margin-top:20px;left: 0">微信直播后台管理系统</p>
    </div>
</div>
<div class="alert" style="display:none">
    <h2>消息</h2>
    <div class="alert_con">
        <p id="ts"></p>
        <p style="line-height:70px"><a class="btn">确定</a></p>
    </div>
</div>
<script type="text/javascript">
    //全局变量
    var GV = {
        ROOT: "/",
        WEB_ROOT: "/",
        JS_ROOT: "static/js/",
        APP: ''/*当前应用名*/
    };
</script>
<!-- Javascript -->
<script src="http://apps.bdimg.com/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
<script src="/static/admin-login/js/supersized.3.2.7.min.js"></script>
<script src="/static/admin-login/js/supersized-init.js"></script>
<script src="/themes/admin_simpleboot3/public/assets/js/jquery-1.10.2.min.js"></script>
<script src="/static/js/wind.js"></script>
<script src="/static/js/new_noty/modernizr.custom.js"></script>
<script src="/static/js/new_noty/classie.js"></script>
<script src="/static/js/new_noty/notificationFx.js"></script>
<script src="/static/js/admin.js"></script>
<script>
    (function () {
        document.getElementById('input_username').focus();
    })();
</script>
<script>
    $(".btn").click(function(){
        is_hide();
    })
    var u = $("input[name=username]");
    var p = $("input[name=password]");
    $("#submit").live('click',function(){
        if(u.val() == '' || p.val() =='')
        {
            $("#ts").html("用户名或密码不能为空~");
            is_show();
            return false;
        }
        else{
            var reg = /^[0-9A-Za-z]+$/;
            if(!reg.exec(u.val()))
            {
                $("#ts").html("用户名错误");
                is_show();
                return false;
            }
        }
        $('#theForm').submit();
    });
    window.onload = function()
    {
        $(".connect p").eq(0).animate({"left":"0%"}, 600);
        $(".connect p").eq(1).animate({"left":"0%"}, 400);
    }
    function is_hide(){ $(".alert").animate({"top":"-40%"}, 300) }
    function is_show(){ $(".alert").show().animate({"top":"45%"}, 300) }
</script>
</body>

</html>

