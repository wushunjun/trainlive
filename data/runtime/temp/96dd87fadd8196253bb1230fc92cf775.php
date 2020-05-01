<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:48:"themes/admin_simpleboot3/admin\course\index.html";i:1570033796;s:67:"E:\www\trainlive\public\themes\admin_simpleboot3\public\header.html";i:1563605685;}*/ ?>
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
        <li class="active"><a href="<?php echo url('course/index'); ?>">课程列表</a></li>
        <li><a href="<?php echo url('course/add'); ?>">添加课程</a></li>
    </ul>
    <form class="well form-inline margin-top-20" method="post" action="<?php echo url('course/index'); ?>">
        课程名称:
        <input type="text" class="form-control" name="keyword"
               value="<?php echo input('request.keyword/s',''); ?>" placeholder="请输入课程名称">
        <input type="submit" class="btn btn-primary" value="搜索"/>
        <a class="btn btn-danger" href="<?php echo url('course/index'); ?>">清空</a>
    </form>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th width="50">ID</th>
            <th>课程名称</th>
            <th>图片</th>
            <th>培训时间</th>
            <th>培训状态</th>
            <th>添加时间</th>
            <th width="130"><?php echo lang('ACTIONS'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php 
            $status=[0=>'未开播',1=>'直播中'];/*TODO ADD MORE*/
         if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$vo): ?>
            <tr>
                <td><?php echo $vo['course_id']; ?></td>
                <td><?php echo $vo['course_name']; ?></td>
                <td>
                    <a href="javascript:parent.imagePreviewDialog('<?php echo cmf_get_image_preview_url($vo['course_img']); ?>');">
                        <i class="fa fa-photo fa-fw"></i>
                    </a>
                </td>
                <td><?php echo $vo['course_time']; ?></td>
                <td>
                    <?php echo $status[$vo['course_status']]; ?>&nbsp;
                    <?php if($vo['course_status'] == 0): ?>
                        <button onclick="change_live(<?php echo $vo['course_id']; ?>,1)" class="layui-btn layui-btn-xs">开启直播</button>
                        <?php else: ?>
                        <button onclick="change_live(<?php echo $vo['course_id']; ?>,0)" class="layui-btn layui-btn-xs" style="background: #E74C3C">关闭直播</button>
                    <?php endif; ?>
                </td>
                <td><?php echo date('Y-m-d H:i:s',$vo['course_add_time']); ?></td>
                <td>
                    <a href='<?php echo url("course/edit",array("course_id"=>$vo["course_id"])); ?>'><?php echo lang('EDIT'); ?></a>
                    <a class="js-ajax-delete" href="<?php echo url('course/delete',array('course_id'=>$vo['course_id'])); ?>"><?php echo lang('DELETE'); ?></a>
                </td>
            </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <div class="pagination"><?php echo $page; ?></div>
</div>
<script src="/static/js/admin.js"></script>
<script>
    function ajax_change_live(course_id,status){
        $.ajax({
            url:"<?php echo url('ajax_change_live'); ?>",
            data:{course_id:course_id,status:status},
            success:function(res){
                if(res.status == 1){
                    if(status == 1){
                        layer.confirm('开播成功<br/>推流地址为：' + res.data.url + ' <br/>流名称为：' + res.data.name,{
                            btn: ['确定','取消'], //按钮
                            icon:1
                        },function(){
                            location.reload();
                        },function(){
                            location.reload();
                        });
                    }else{
                        layer.msg('操作成功', {icon: 1},function(){
                            location.reload();
                        });
                    }
                }else{
                    layer.msg(res.message, {icon: 2});
                }
            },
            error:function(){
                layer.msg('网络连接失败，请联系管理员', {icon: 2});
            }
        })
    }
    function change_live(course_id,status){
        var title = status ? '开启直播' : '关闭直播';
        layer.confirm(title,{
            btn: ['确定','取消'], //按钮
            icon:3
        },function(){
            ajax_change_live(course_id,status);
        })
    }
</script>
</body>
</html>