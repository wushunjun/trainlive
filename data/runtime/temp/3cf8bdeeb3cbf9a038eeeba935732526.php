<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:58:"E:\www\trainlive\public/plugins/demo/view/admin_index.html";i:1516676889;s:58:"E:\www\trainlive\public\plugins\demo\view\public\head.html";i:1516676889;s:61:"E:\www\trainlive\public\plugins\demo\view\public\scripts.html";i:1516676889;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Set render engine for 360 browser -->
<meta name="renderer" content="webkit">

<!-- No Baidu Siteapp-->
<meta http-equiv="Cache-Control" content="no-siteapp"/>

<link rel="shortcut icon" href="/plugins/demo/view/public/assets/images/favicon.ico" type="image/x-icon">

<link href="/themes/admin_simpleboot3/public/assets/themes/<?php echo cmf_get_admin_style(); ?>/bootstrap.min.css" rel="stylesheet">
<link href="/themes/admin_simpleboot3/public/assets/simpleboot3/css/simplebootadmin.css" rel="stylesheet">
<link href="/static/font-awesome/css/font-awesome.min.css?page=index" rel="stylesheet" type="text/css">

<script type="text/javascript">
    //全局变量
    var GV = {
        ROOT: "/",
        WEB_ROOT: "/",
        JS_ROOT: "static/js/"
    };
</script>
    <title>ThinkCMF插件演示首页</title>
    <meta name="description" content="ThinkCMF插件演示首页">
    <meta name="keywords" content="ThinkCMF插件演示首页">
</head>
<body>
<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li class="active"><a>插件演示后台</a></li>
    </ul>
    <div class="common-form">
        <div class="well">

            <p>
                <b>当前登录管理员id:</b><?php echo (isset($admin_id) && ($admin_id !== '')?$admin_id:'管理员未登录'); ?>
            </p>
            <p>
                <b>插件根目录:</b>/plugins/demo
            </p>
            <p>
                <b>插件模板根目录:</b>/plugins/demo/view
            </p>

        </div>
        <form method="post" class="js-ajax-form" action="#">
            <div class="table_list">
                <table width="100%" class="table table-hover">
                    <thead>
                    <tr>
                        <th width="50">ID</th>
                        <th>用户名</th>
                        <th>邮箱</th>
                        <th>注册时间</th>
                        <th width="120">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($users) || $users instanceof \think\Collection || $users instanceof \think\Paginator): if( count($users)==0 ) : echo "" ;else: foreach($users as $key=>$vo): ?>
                        <tr>
                            <td><?php echo $vo['id']; ?></td>
                            <td><?php echo $vo['user_login']; ?></td>
                            <td><?php echo $vo['user_email']; ?></td>
                            <td><?php echo $vo['create_time']; ?></td>
                            <td>
                                <a href="javascript:;">修改</a>|
                                <a href="javascript:;" class="js-ajax-delete">删除</a>
                            </td>
                        </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
<script src="/static/js/jquery.js"></script>
<script src="/static/js/wind.js"></script>
<script src="/static/js/bootstrap.min.js"></script>
<script src="/static/js/admin.js"></script>
</body>
</html>