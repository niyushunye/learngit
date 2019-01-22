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
                                <th width="5%">序号</th>
                                <th width="8%">规则标题</th>
                                <th width="50%">版本内容</th>
                                <th width="15%">添加时间</th>
                                <th width="10%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($data as $value): ?>
                                <tr>
                                    <td><?php echo $value['id'];?></td>
                                    <td><?php echo $value['title'];?></td>

                                    <td title="<?php echo $value['content'];?>" style="cursor: pointer">
                                      <?php
                                           if(mb_strlen($value['content'])>60){

                                               echo mb_substr($value['content'],0,60).'......';
                                           }else{
                                                echo  $value['content'];
                                           }
                                        ?> 
                                    </td> 

                                    <!-- <td><?php echo $value['content'];?></td> -->

                                    <td><?php echo date('Y-m-d H:i:s',$value['dateline']);?></td>
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
        layer.confirm('确定删除该规则？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post('<?php echo base_url();?>admin/c_rule_management/delete/',{"id":id},function(data){
                if(data == '1')
                {
                    layer.msg("删除成功！",{
                        time:1.5*1000
                    },function(){
                        window.location.href = '<?php echo base_url()?>admin/c_rule_management/index/';
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
            area:['50%','60%'],
            content: ['<?php echo base_url();?>admin/c_rule_management/add/', 'yes']
        })
    });
    //编辑
    $(".edit").click(function(){
        var id = $(this).attr('hfht');
        layer.open({
            type:2,
            title:'编辑',
            skin:'layui-layer-lan',
            area:['50%','60%'],
            content: ['<?php echo base_url();?>admin/c_rule_management/edit/'+id, 'yes']
        })
    });
</script>
</html>