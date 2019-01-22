<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>权限组管理</title>
    <meta name="keywords" content="权限组管理">
    <meta name="description" content="权限组管理">

    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo base_url();?>assets/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/plugins/codemirror/codemirror.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/plugins/codemirror/ambiance.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style.min862f.css?v=4.1.0" rel="stylesheet">

</head>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-content">
                    <form id="myform" class="form-horizontal" method="post" action="<?php echo base_url();?>admin/c_directional/gofirst" target="_parent">

                        <h4 align="center"><?php echo $delete_result?></h4>
                        <input type="hidden" class="form-control" name="orgnum" value="<?php echo $orgnum;?>">
                        <div class="form-group">
                            <div class="modal-footer" style="border-top: 0!important; margin-right: 90px;">
                                <button type="submit" id="btn" class="btn btn-primary">确定</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url();?>assets/js/jquery.min.js?v=2.1.4"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js?v=3.3.6"></script>
<script src="<?php echo base_url();?>assets/js/plugins/peity/jquery.peity.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/codemirror/codemirror.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/codemirror/mode/javascript/javascript.js"></script>
<script src="<?php echo base_url();?>assets/js/content.min.js?v=1.0.0"></script>
<script src="<?php echo base_url();?>assets/js/plugins/layer/layer.min.js"></script>
<script src="<?php echo base_url();?>assets/js/demo/layer-demo.min.js"></script>
<!--加载验证文件-->
<script src="<?php echo base_url();?>assets/js/bootstrapValidator.min.js"></script>
<script>
    $(".closeWindows").click(function(){
        parent.layer.closeAll();
    })
</script>
</body>
</html>
