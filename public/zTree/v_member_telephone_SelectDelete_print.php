<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>历史数据</title>
    <meta name="keywords" content="历史数据">
    <meta name="description" content="历史数据">

    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo base_url();?>assets/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/plugins/codemirror/codemirror.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/plugins/codemirror/ambiance.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style.min862f.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-content">
                    <form class="form-horizontal" method="post" action="<?php echo base_url();?>admin/c_directional/finish_print_selectDelete" target="_parent">
                        <div class="form-group">
                            <input type="hidden" name="select_delete_orgnum" id="select_delete_orgnum" value="<?php echo $select_delete_orgnum;?>">
                            <input type="hidden" name="select_delete_filee" id="select_delete_filee" value="<?php print_r($select_delete_filee);?>">
                            <label>请再次确认您需要删除的数据，一旦删除，将无法恢复！请谨慎选择！！</label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="closeWindows btn btn-danger" onclick="javascript:history.back(-1);">返回</button>
                            <button type="submit" class="sumbit_delete btn btn-primary" id="sumbit_delete" name="sumbit_delete">确认删除</button>
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

</body>
</html>
