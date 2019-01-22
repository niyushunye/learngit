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
                                    <th>模块ID</th>
                                    <th>模块的中文名称</th>
                                    <th>模块的英文名称</th>
                                    <th>父模块名称</th>
                                    <th>模块类型（1、PC端模块；2、手机端模块）</th>
                                    <th>操作时间</th>
                                    <th width="13%">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                             <?php foreach ($moduleinfo as $value): ?>
                                <tr>
                                    <td><?php echo $value['moduleid'];?></td>
                                    <td><?php echo $value['modtitle'];?></td>
                                    <td><?php echo $value['modname'];?></td>
                                    <td><?php echo $value['parentid_title'];?></td>
                                    <td><?php
                                        if($value['classify'] == 1)
                                        {
                                            echo 'PC端模块';
                                        }
                                        if($value['classify'] == 2)
                                        {
                                            echo '手机端模块';
                                        }
                                        ?></td>
                                    <td><?php echo date('Y-m-d H:i:s',$value['dateline']);?></td>
                                    <td>
                                        <a href="#" hfht = "<?php echo $value['moduleid'];?>" class="edit button button-small border border-blue operate_sub">编辑</a>
                                        <a href="#" hfht = "<?php echo $value['moduleid'];?>" class="delete button button-small border border-gray operate_sub">删除</a>
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
            var moduleid = $(this).attr('hfht');
            layer.confirm('你确定要删除该模块(该操作会造成页面刷新)？', {
            btn: ['确定','取消'] //按钮
            }, function(){
                $.post('<?php echo base_url();?>admin/C_moduleinfo/delete/',{"moduleid":moduleid},function(data){
                    top.location.reload();
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
                content: ['<?php echo base_url();?>admin/C_moduleinfo/add/', 'yes']
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
                content: ['<?php echo base_url();?>admin/C_moduleinfo/edit/'+id, 'yes']
            })
        });
    </script>

</html>
