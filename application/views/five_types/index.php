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
                                <th>时间</th>
                                <th>江南中队</th>
                                <th>江北中队</th>
                                <th>巡逻中队</th>
                                <th>张滩中队</th>
                                <th>瀛湖中队</th>
                                <th>大河中队</th>
                                <th>谭坝中队</th>
                                <th>洪山中队</th>
                                <th>指导中队</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($data as $row){?>
                                <tr>
                                    <td><?php echo $row['id'];?></td>
                                    <td><?php echo $row['ftime'];?></td>
                                    <td><?php echo $row['jnzd'];?></td>
                                    <td><?php echo $row['jbzd'];?></td>
                                    <td><?php echo $row['xlzd'];?></td>
                                    <td><?php echo $row['ztzd'];?></td>
                                    <td><?php echo $row['yhzd'];?></td>
                                    <td><?php echo $row['dhzd'];?></td>
                                    <td><?php echo $row['tbzd'];?></td>
                                    <td><?php echo $row['hszd'];?></td>
                                    <td><?php echo $row['zdzd'];?></td>
                                    <td>
                                        <a href="#" hfht = "<?php echo $row['id'];?>" class="edit button button-small border border-blue operate_sub">编辑</a>
                                        <a href="#" hfht = "<?php echo $row['id'];?>" class="delete button button-small border border-gray operate_sub">删除</a>
                                    </td>
                                </tr>
                            <?php }?>
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
<script>
    //新增
    $(".add").click(function(){
        layer.open({
            type:2,
            title:'新增',
            skin:'layui-layer-lan',
            area:['60%','70%'],
            content: ['<?php echo base_url();?>admin/c_five_types/add/', 'yes']
        })
    });
    //删除
    $(".delete") .click(function(){
        var id = $(this).attr('hfht');
        layer.confirm('确定删除该任务？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post('<?php echo base_url();?>admin/c_five_types/delete/',{"id":id},function(data){
                if(data == '1')
                {
                    layer.msg("删除成功！",{
                        time:1.5*1000
                    },function(){
                        window.location.href = '<?php echo base_url()?>admin/c_five_types/index/';
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
    //编辑
    $(".edit").click(function(){
        var id = $(this).attr('hfht');
        layer.open({
            type:2,
            title:'编辑',
            skin:'layui-layer-lan',
            area:['60%','70%'],
            content: ['<?php echo base_url();?>admin/c_five_types/edit/'+id, 'yes']
        })
    });
</script>
</body>