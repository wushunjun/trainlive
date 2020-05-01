<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"themes/admin_simpleboot3/admin\user\index.html";i:1570282576;s:67:"E:\www\trainlive\public\themes\admin_simpleboot3\public\header.html";i:1563605685;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->


    <link href="/themes/admin_simpleboot3/public/assets/themes/<?php echo cmf_get_admin_style(); ?>/bootstrap.min.css" rel="stylesheet">
    <link href="/themes/admin_simpleboot3/public/assets/simpleboot3/css/simplebootadmin.css" rel="stylesheet">
    <link href="/static/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/static/js/new_noty/ns-default.css" rel="stylesheet" type="text/css">
    <link href="/static/js/new_noty/ns-style-growl.css" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        form .input-order {
            margin-bottom: 0px;
            padding: 0 2px;
            width: 42px;
            font-size: 12px;
        }

        form .input-order:focus {
            outline: none;
        }

        .table-actions {
            margin-top: 5px;
            margin-bottom: 5px;
            padding: 0px;
        }

        .table-list {
            margin-bottom: 0px;
        }

        .form-required {
            color: red;
        }
        span.yes{color:#1BBC9D;cursor: pointer;}
        span.no {
            color: #BEC3C7;
            cursor: pointer;
        }
        i.fa{
            margin-right: 4px;
            font-size: 14px;
            vertical-align: baseline;
            cursor: pointer;
        }
    </style>
    <script type="text/javascript">
        //全局变量
        var GV = {
            ROOT: "/",
            WEB_ROOT: "/",
            JS_ROOT: "static/js/",
            APP: '<?php echo \think\Request::instance()->module(); ?>'/*当前应用名*/
        };
    </script>
    <script src="/themes/admin_simpleboot3/public/assets/js/jquery-1.10.2.min.js"></script>
    <script src="/static/js/wind.js"></script>
    <link href="/static/layui/css/layui.css" rel="stylesheet" type="text/css">
    <script src="/static/layui/layui.js"></script>

    <script src="/themes/admin_simpleboot3/public/assets/js/bootstrap.min.js"></script>
    <script>
        Wind.css('artDialog');
        Wind.css('layer');
        $(function () {
            $("[data-toggle='tooltip']").tooltip();
            $("li.dropdown").hover(function () {
                $(this).addClass("open");
            }, function () {
                $(this).removeClass("open");
            });
        });
        layui.use('layer', function(layer){
            var layer = layui.layer;
        });

    </script>
    <?php if(APP_DEBUG): ?>
        <style>
            #think_page_trace_open {
                z-index: 9999;
            }
        </style>
    <?php endif; ?>
</head>
<body>
<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li class="active"><a href="<?php echo url('user/index'); ?>">学员列表</a></li>
    </ul>
    <form class="well form-inline margin-top-20" method="post" action="<?php echo url('user/index'); ?>">
        姓名:
        <input type="text" class="form-control" name="user_nickname" style="width: 160px;"
               value="<?php echo input('request.user_name/s',''); ?>" placeholder="请输入学员姓名">
        &nbsp;&nbsp;
        手机号:
        <input type="text" class="form-control" name="user_mobile" style="width: 160px;"
               value="<?php echo input('request.user_mobile/s',''); ?>" placeholder="请输入学员手机号">
        <input type="submit" class="btn btn-primary" value="搜索"/>
        <a class="btn btn-danger" href="<?php echo url('user/index'); ?>">清空</a>
        <a class="btn btn-danger" style="background-color: #1E9FFF;border-color: #1E9FFF" href="<?php echo url('user/import'); ?>">导入学员</a>
    </form>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th width="50">ID</th>
            <th>姓名</th>
            <th>手机号</th>
            <th>状态</th>
            <th>注册时间</th>
            <th width="230"><?php echo lang('ACTIONS'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php 
            $sex=[0=>'未知',1=>'男',2=>'女'];
         if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$vo): ?>
            <tr>
                <td><?php echo $vo['user_id']; ?></td>
                <td>
                    <?php echo $vo['user_name']; ?>
                </td>
                <td>
                    <?php echo $vo['user_mobile']; ?>
                </td>
                <td>
                    <?php if($vo['user_status'] == 1): ?>
                        <span class="yes" onClick="changeTableVal('user','user_id','<?php echo $vo['user_id']; ?>','user_status',this,'正常','冻结')" ><i class="fa fa-check-circle"></i>正常</span>
                        <?php else: ?>
                        <span class="no" onClick="changeTableVal('user','user_id','<?php echo $vo['user_id']; ?>','user_status',this,'正常','冻结')" ><i class="fa fa-ban"></i>冻结</span>
                    <?php endif; ?>
                </td>
                <td><?php echo date('Y-m-d H:i:s',$vo['user_add_time']); ?></td>
                <td>
                    <a href='<?php echo url("user/edit",array("user_id"=>$vo["user_id"])); ?>'><?php echo lang('EDIT'); ?></a>
                    <a class="js-ajax-delete" href="<?php echo url('user/delete',array('user_id'=>$vo['user_id'])); ?>"><?php echo lang('DELETE'); ?></a>
                </td>
            </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <div class="pagination"><?php echo $page; ?></div>
</div>
<script src="/static/js/admin.js"></script>
</body>
</html>