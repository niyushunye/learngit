<body class="bg-white fixed">
<div style="margin:20px;">
    <div>
        <div>
            <div>
                <div>
                    <div class="right_button x11-move">
                        <a href="#" class="button button-small border border-green add">新增</a>
                    </div>
                </div>
                <form class="form-horizontal" name="" method="post" action="">
                    <div class="ibox-content">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr class="bg-back">
                                <th>序号</th>
                                <th>任务名称</th>
                                <th>添加人</th>
                                <th>添加时间</th>
                                <th width="20%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($data as $value): ?>
                                <tr>
                                    <td><?php echo $value['id'];?></td>
                                    <td><?php echo $value['task_name'];?></td>
                                    <td><?php echo $value['realname'];?></td>
                                    <td><?php echo date('Y-m-d H:i:s',$value['add_time']);?></td>
                                    <td>
                                        <a href="#" hfht = "<?php echo $value['id'];?>" class="edit button button-small border border-blue operate_sub">编辑</a>
                                        <a href="#" hfht = "<?php echo $value['id'];?>" class="delete button button-small border border-gray operate_sub">删除</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    //删除
    $(".delete") .click(function(){
        var id = $(this).attr('hfht');
        layer.confirm('确定删除该任务？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post('<?php echo base_url();?>admin/c_task_management/delete/',{"id":id},function(data){
                if(data == '1')
                {
                    layer.msg("删除成功！",{
                        time:1.5*1000
                    },function(){
                        window.location.href = '<?php echo base_url()?>admin/c_task_management/index/';
                    });
                }else
                {
                    layer.msg("删除失败,请重试！");
                }
            })
        }, function(){
            layer.closeAll();
        });
    });

    //新增
    $(".add").click(function(){
        layer.open({
            type:2,
            title:'新增',
            skin:'layui-layer-lan',
            area:['50%','45%'],
            content: ['<?php echo base_url();?>admin/c_task_management/add/', 'yes']
        })
    });
    //编辑
    $(".edit").click(function(){
        var id = $(this).attr('hfht');
        layer.open({
            type:2,
            title:'编辑',
            skin:'layui-layer-lan',
            area:['50%','45%'],
            content: ['<?php echo base_url();?>admin/c_task_management/edit/'+id, 'yes']
        })
    });
</script>
</html>