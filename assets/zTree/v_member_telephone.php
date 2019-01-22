<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title><?php echo config_item('webtitle');?></title>

    <meta name="keywords" content="<?php echo config_item('keywords');?>">
    <meta name="description" content="<?php echo config_item('description');?>">


    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo base_url();?>assets/css/bootstrap.min14ed.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/font-awesome.min93e3.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style.min862f.css" rel="stylesheet">

<!--    <link rel="stylesheet" href="--><?php //echo base_url();?><!--assets/zTree/css/demo.css" type="text/css">-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">

    <!--兼容IE8,主要解决在IE8下的一些问题
        1、HTML5的兼容
        2、不同屏幕高度的显示效果
    -->
    <!--[if IE 8]>
    <script src="<?php echo base_url();?>assets/js/respond.js" ></script>
    <script src="<?php echo base_url();?>assets/js/html5.js"  ></script>
    <link href="<?php echo base_url();?>assets/css/screen.css" rel="stylesheet">
    <![endif]-->
</head>
<style>
    .sidebar-collapse,ul,li{
        background-color: #f3f3f4;
    }
    .nav>li.active{border-left: 0px solid #19aa8d;}
    .pace .pace-progress {
        background: #1ab394;
        position: fixed;
        z-index: 2000;
        top: 0;
        width: 100%;
        height: 0px;
    }
    .ztree li:last-child {
         margin-bottom: 0px;
    }
</style>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation" style="width:280px; border-right: 2px solid ;">
        <div class="nav-close"><i class="fa fa-times-circle"></i>
        </div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="#">
                        <i class="fa fa fa-bar-chart-o"></i>
                        <span class="nav-label zhidui"><?php echo $orgname[0]['orgname']?></span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <ul id="treeDemo" class="ztree"></ul>
<!--                        <li>-->
<!--                            <a class="J_menuItem" href="c_directional/getsuper/--><?php //echo $value['orgnum']?><!--" target="iframe0">--><?php //echo $value['orgname']?><!--</a>-->
<!--                        </li>-->
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->
    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1" style="margin-left: 280px;">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <!--
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown hidden-xs">
                        <a class="right-sidebar-toggle" aria-expanded="false">
                            <i class="fa fa-tasks"></i> 主题
                        </a>
                    </li>
                </ul>
                -->
            </nav>
        </div>
        <div class="row J_mainContent" id="content-main">
            <iframe class="J_iframe" name="iframe0" width="100%" height="100%" frameborder="0" seamless></iframe>
        </div>
    </div>
    <!--右侧部分结束-->
</div>
<script src="<?php echo base_url();?>assets/js/jquery.min.js?v=2.1.4"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js?v=3.3.6"></script>
<script src="<?php echo base_url();?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/layer/layer.min.js"></script>
<script src="<?php echo base_url();?>assets/js/hplus.min.js?v=4.1.0"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/contabs.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/pace/pace.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/zTree/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/zTree/js/jquery.ztree.core.js"></script>

<script type="text/javascript">
    //获取支队、大队、中队个部门名称
    var zhidui = $('.zhidui').text();
//    alert(zhidui);exit();
    //树 open:true,默认打开文件夹 没有子节点显示为文件夹 isParent:true,

    var setting = {
        view: {
            dblClickExpand: true,
            showLine: false
        },
        data: {
            simpleData:{
                enable: true
            }
        },
        callback: {
//            onClick: onClick
        }
    };
//    var zNodes =[
//        {"id":"1", "pId":"0", "name":"父节点1"},
//        {"id":"2", "pId":"0", "name":"父节点11"},
//        {"id":"3", "pId":"0", "name":"子节点111"}
//    ];
    var zNodes =<?php print_r(json_encode($result,JSON_UNESCAPED_UNICODE)) ;?>;
    $(document).ready(function(){
//        zTreeInit();
        $.fn.zTree.init($("#treeDemo"), setting, zNodes);
    });

</script>

</body>
</html>
