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


    <link rel="shortcut icon" href="profile_small.ico">
    <link rel="stylesheet" href="<?php echo base_url()?>public/css/pintuer.css">
    <link rel="stylesheet" href="<?php echo base_url()?>public/css/admin.css">
    <link rel="stylesheet" href="<?php echo base_url();?>public/zTree/css/zTreeStyle/zTreeStyle.css">

    <!-- <script src="<?php echo base_url()?>public/js/admin.js"></script> -->
    <script src="<?php echo base_url()?>public/js/jquery.js"></script>
    <script src="<?php echo base_url()?>public/js/pintuer.js"></script>
    <script src="<?php echo base_url()?>public/js/respond.js"></script>

    <script src="<?php echo base_url();?>public/zTree/js/jquery.ztree.core.js"></script>





    <!--兼容IE8,主要解决在IE8下的一些问题
        1、HTML5的兼容
        2、不同屏幕高度的显示效果
    -->
    <!--[if IE 8]>
    <script src="<?php echo base_url();?>assets/js/respond.js" ></script>
    <script src="<?php echo base_url();?>assets/js/html5.js"  ></script>
    <!--<link href="<?php echo base_url();?>assets/css/screen.css" rel="stylesheet">-->
    <![endif]-->
</head><style>
    html,body{
        width: 100%;
        height: 100%;
        margin: 0;
    }
    #content-main{
        width: 100%;
        height: 100%;
    }
</style>

<body class="bg-white">
<!--左侧导航开始-->
<div id="content-main">
    <div class="float-left" style="width:20%;height: 100%; border-right: 1px solid;">
        <nav>
            <ul id="treeDemo" class="ztree"></ul>
        </nav>
    </div>
    <!--左侧导航结束-->
    <!--右侧部分开始-->

    <div style="margin-left: 20%; height: 100%;">
        <iframe width="100%" height="100%" id="iframe1" name="iframe1"></iframe>
    </div>
    <!--右侧部分结束-->
</div>



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

    var zNodes =<?php print_r(json_encode($result,JSON_UNESCAPED_UNICODE));?>;
    $(document).ready(function(){
        $.fn.zTree.init($("#treeDemo"), setting, zNodes);
    });

</script>

</body>
</html>
