<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:45:"themes/admin_simpleboot3/admin\user\edit.html";i:1570282372;s:67:"E:\www\trainlive\public\themes\admin_simpleboot3\public\header.html";i:1563605685;}*/ ?>
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
	<div class="wrap">
		<ul class="nav nav-tabs">
			<li><a href="<?php echo url('user/index'); ?>">学员列表</a></li>
			<li class="active"><a>编辑学员</a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form margin-top-20" action="<?php echo url('user/edit'); ?>">
			<div class="form-group">
				<label for="input-user_name" class="col-sm-2 control-label"><span class="form-required">*</span>姓名</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-user_name" name="user_name" value="<?php echo $info['user_name']; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-user_mobile" class="col-sm-2 control-label"><span class="form-required">*</span>手机号</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-user_mobile" name="user_mobile" value="<?php echo $info['user_mobile']; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-user_password" class="col-sm-2 control-label">密码</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-user_password" name="user_password" placeholder="不修改请留空">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="hidden" name="user_id" value="<?php echo $info['user_id']; ?>" />
					<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('SAVE'); ?></button>
					<a class="btn btn-default" href="javascript:history.back(-1);"><?php echo lang('BACK'); ?></a>
				</div>
			</div>
		</form>
	</div>
	<script src="/static/js/admin.js"></script>
</body>
</html>