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
                                    <th>权限ID</th>
                                    <th>权限的英文名称</th>
                                    <th>权限的中文名称</th>
                                    <th>权限的备注说明</th>
                                    <th>分配时间</th>
                                    <th width="13%">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($roleinfo as $value): ?>
                                <tr>
                                    <td><?php echo $value['roleid'];?></td>
                                    <td><?php echo $value['rolefield'];?></td>
                                    <td><?php echo $value['rolename'];?></td>
                                    <td><?php echo $value['remark'];?></td>
                                    <td><?php echo date('Y-m-d H:i:s',$value['dateline']);?></td>
                                    <td>
                                        <a href="#" hfht = "<?php echo $value['roleid'];?>" class="edit button button-small border border-blue operate_sub">编辑</a>
                                        <a href="#" hfht = "<?php echo $value['roleid'];?>" class="delete button button-small border border-gray operate_sub">删除</a>
                                    </td>
                                </tr>
                             <?php endforeach; ?> 
                            </tbody>
                        </table>
                            <ul>
                                <?php echo $this->pagination->create_links(); ?><span class="total">共 <?php echo $total;?> 条</span>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
    <script>
        $(".delete") .click(function(){
            var roleid = $(this).attr('hfht');
            layer.confirm('你确定要删除该模块？', {
            btn: ['确定','取消'] //按钮
            }, function(){
                $.post('<?php echo base_url();?>admin/C_roleinfo/delete/',{"roleid":roleid},function(data){
                    window.location.href = '<?php echo base_url()?>admin/C_roleinfo/index/';
                    layer.msg(data);
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
                area:['600px','400px'],
                content: ['<?php echo base_url();?>admin/C_roleinfo/add/', 'yes']
            })
        });

        //编辑
        $(".edit").click(function(){
            var id = $(this).attr('hfht');
            layer.open({
                type:2,
                title:'编辑',
                skin:'layui-layer-lan',
                area:['600px','400px'],
                content: ['<?php echo base_url();?>admin/C_roleinfo/edit/'+id, 'yes']
            })
        });
    </script>
</html>