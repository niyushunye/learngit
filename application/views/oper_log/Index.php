<body class="bg-white fixed">
<div class="" style="margin:20px;">
    <div class="">
        <div class="">
            <div class="">
                <!--                    <div class="">-->
                <!--                    </div>-->
                <form class="form-horizontal" name="roadinfo_select_delete" method="post" action="">
                    <div class="ibox-content">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr class="bg-back">
                                <th>警员编号</th>
                                <th>警员姓名</th>
                                <th>操作时间</th>
                                <th>操作描述</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($oper_log as $k => $v): ?>

                                <tr>
                                    <td><?php echo $v['oper_accouts']; ?></td>
                                    <td><?php echo $v['oper_member']; ?></td>
                                    <td><?php echo date('Y-m-d H:i', $v['dateline']); ?></td>
                                    <td><?php echo $v['oper_module']; ?>中<?php echo $v['oper_type']; ?>
                                        了<?php echo $v['oper_ziduan'] ?>为<?php echo $v['oper_filed']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <ul>
                            <?php echo $this->pagination->create_links(); ?><span class="total">共 <?php echo $total; ?> 条</span>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .button a img {
        margin-top: 20px;
    }

    .layui-layer-lan .layui-layer-title {
        background: #09c;
    }

    .layui-layer-title {
        background-color: #09c;
    }

    .layui-layer-btn .layui-layer-btn0 {
        border-color: #09c;
        background-color: #09c;
        color: #333;
    }
</style>
<script>
    $("#allchoose").click(function () {
//            alert($(this).is(":checked"));
        if ($(this).is(":checked") == true) {
            $(":checkbox").prop("checked", "true");
        } else {
            $(":checkbox").removeAttr("checked");
        }
    });
    $(":checkbox").click(function () {
        if ($(this).is(":checked") == false) {
            $("#allchoose").removeAttr("checked");
        }
    });
</script>
<script>
    $(document).ready(function () {
        //添加数据
        $(".add").click(function () {
            //页面层
            layer.open({
                type: 2,
                title: '新增版本',
                skin: 'layui-layer-lan', //加上边框
                area: ['40%', '350px'], //宽高
                content: ['<?php echo base_url();?>admin/C_client_version/add', 'yes']
            });
        });
        //查询数据
        $(".search").click(function () {
            //页面层
            layer.open({
                type: 2,
                title: '搜索道路代码',
                skin: 'layui-layer-molv', //加上边框
                area: ['600px', '250px'], //宽高
//                    content: ['<?php echo base_url();?>admin/c_member_roadinfo/search_mysql_road_name','NO']
                content: ['v_member_roadinfo_searchRoadName.html', 'NO']
            });
        });
        //删除数据
        $(".delete").click(function () {
            var id = $(this).attr('hfht');
            var filename = $(this).attr('hfht_one');
            layer.confirm('你确定要删除该数据？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                $.post('<?php echo base_url();?>admin/C_client_version/delete/', {
                    'id': id,
                    'filename': filename
                }, function (data) {
                    // alert(data);return false;
                    if (data == 1) {
                        layer.msg('删除成功', {time: 2000}, function () {
                            window.location.href = '<?php echo base_url()?>admin/C_client_version/';
                        })
                    } else {
                        layer.msg('删除失败', {time: 2000}, function () {
                            window.location.href = '<?php echo base_url()?>admin/C_client_version/';
                        })
                    }
                })
            }, function () {
                layer.msg('取消删除', {time: 2000})
            });

        });
    });
</script>
