<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>打印数据</title>
    <meta name="keywords" content="打印数据">
    <meta name="description" content="打印数据">

    <link rel="shortcut icon" href="favicon.ico"> <link href="<?php echo base_url();?>assets/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
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
                <div class="ibox-title">
                    <h5><?php echo $orgname[0]['orgname']?></h5>
<!--                    <div class="ibox-tools">-->
<!--                        <a href="--><?php //echo base_url();?><!--admin/c_forceinfo/historyData" class="history btn btn-primary btn-xs"> 历史数据 </a>-->
<!--                        <a href="--><?php //echo base_url();?><!--admin/c_forceinfo/abnormalData" class="abnormal btn btn-primary btn-xs"> 异常数据 </a>-->
<!--                        <a href="--><?php //echo base_url();?><!--admin/c_forceinfo/printData" class="print btn btn-primary btn-xs" disabled=""> 打印数据 </a>-->
<!--                        <a href="#" class="search btn btn-primary btn-xs"> 查询 </a>-->
<!--                    </div>-->
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" name="print_select_delete" method="post" action="<?php echo base_url();?>admin/c_questioninfo/print_select_delete">
                        <div class="form-group">
                            <table class="table table-bordered table-hover table-condensed" id="roadinfo">
                                <thead>
                                <tr>
                                    <th><input type="checkbox" id = "allchoose"></th>
                                    <th>文件</th>



                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($dirs as $value): ?>
                                    <tr>
                                        <td><input type="checkbox" name="groupCheckbox[]" id="groupCheckbox[]" hfht="<?php echo $value;?>"></td>
                                        <td><?php echo substr($value,37);?></td>
                                        <td>
                                            <a href="#" hfht = "<?php echo $value;?>" class="delete btn btn-white btn-sm"><i class="fa fa-trash"></i>删除</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <ul>
                                <?php echo $this->pagination->create_links(); ?>
                            </ul>
                            <div class="modal-footer">
                                <a href="#" class="select_delete btn btn-primary" id="select_delete" name="select_delete">选择删除</a>
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

<script>
    $("#allchoose").click(function(){

//            alert($(this).is(":checked"));
        if($(this).is(":checked")==true){
            $(":checkbox").prop("checked","true");
        }else{
            $(":checkbox").removeAttr("checked");
        }

    });
    $(":checkbox").click(function(){
        if($(this).is(":checked")==false){
            $("#allchoose").removeAttr("checked");
        }
    });
</script>

<script>
    //删除
    $(".delete").click(function(){
        var url = $(this).attr('hfht');
        orgnum = url.substring(37,49);
        filename = url.substring(50);
//        alert(orgnum);
//        alert(filename);
        layer.open({
            type:2,
            title:'删除信息',
            skin:'layui-layer-molv',
            area:['400px','220px'],
            content: ['<?php echo base_url();?>admin/c_directional/delete_print/'+orgnum+'/'+filename, 'NO']
        })
    });
    $(document).ready(function () {
        //以下是全选判断的jquery
        var have = 0;
        $(".select_delete").click(function(){
            var file = [];
            var orgnum = "";
            var filename = "";
            var filee = "";
            $("input[name^='groupCheckbox[]']").each(function(){
                var isCheck = $(this).prop("checked");
                if ('checked' == isCheck || isCheck)
                {
                    have = 1;
                    var url = $(this).attr('hfht');
                    orgnum = url.substring(37,49);
                    filename = url.substring(50);
//                        id = id+",";
                    file.push(filename);
                }
            });
            filee = file.join(":::");
            alert(filee);
            if(have == 1){
                layer.open({
                    type: 2,
                    title:'查询',
                    skin: 'layui-layer-molv', //加上边框
                    area: ['500px', '230px'], //宽高
                    content: ['<?php echo base_url();?>admin/c_directional/print_select_delete/'+ orgnum + '/' +  filee, 'no']
                });
            }

            if (have == 0)
            {
                alert('请您认真选择需要删除的数据！！');
                return false;
            }
        });


    });

</script>

</body>
</html>
