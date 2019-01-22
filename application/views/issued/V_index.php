
<body class="bg-white fixed">
<div style="margin:20px;">
    <div>
        <div>
            <div>
                <div class="right_button" style="float: right;text-align: center">
                    <a href="#" class="button button-small border border-green add">新增</a>
                </div>
            </div>
            <form class="form-horizontal" name="" method="post" action="">
                <div class="ibox-content">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class="bg-back">
                            <th>通知标题</th>
                            <th>任务分类</th>
                            <th>下发部门</th>
                            <th>发布人</th>
                            <th>发布日期</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data as $k => $v){?>
                            <tr>
                                <td><?php echo $v['title']?></td>
                                <td>
                                    <?php if($v['work_type'] == 1){?>
                                        <?php echo '日常';?>
                                    <?php }else if($v['work_type'] == 2){?>
                                        <?php echo '党建';?>
                                    <?php }else if($v['work_type'] == 3){?>
                                        <?php echo '法制'?>
                                    <?php } else if($v['work_type'] == 4){?>
                                        <?php echo '宣传'?>
                                    <?php } else if($v['work_type'] == 5){?>
                                        <?php echo '指挥中心'?>
                                    <?php } else if($v['work_type'] == 99){?>
                                        <?php echo '其它'?>
                                    <?php }?>
                                </td>
                                <td><?php echo $v['orgname']['orgname']?></td>
                                <td><?php echo $v['task_realname']?></td>
                                <td><?php echo date('Y-m-d H:i',$v['create_time'])?></td>
                                <td>
                                    <a href="#" hfht = "<?php echo $v['id'];?>" class="view button button-small border border-blue operate_sub">查看</a>
                                    <a href="#" hfht = "<?php echo $v['id'];?>" class="edit button button-small border border-blue operate_sub">编辑</a>
                                    <a href="#" hfht = "<?php echo $v['id'];?>" class="delete button button-small border border-gray operate_sub">删除</a>
                                </td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                    <ul>
                        <?php echo $this->pagination->create_links(); ?><span class="total">共 <?php echo $total;?> 条</span>&nbsp;
                    </ul>
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
        var did = $(this).attr('hfht');
        layer.confirm('确定删除该入库信息？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post('<?php echo base_url();?>admin/c_issued/delete/',{"did":did},function(data){
                if(data == '1')
                {
                    layer.msg("删除成功！",{
                        time:1.5*1000
                    },function(){
                        window.location.href = '<?php echo base_url()?>admin/c_issued/index/';
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
            area:['60%','70%'],
            content: ['<?php echo base_url();?>admin/c_issued/add/', 'yes']
        })
    });

    //查看
    $(".view").click(function(){
        var id = $(this).attr('hfht');
        layer.open({
            type:2,
            title:'查看',
            skin:'layui-layer-lan',
            area:['50%','60%'],
            content: ['<?php echo base_url();?>admin/c_issued/row_view/'+id, 'yes']
        })
    });

    //编辑
    $(".edit").click(function(){
        var id = $(this).attr('hfht');
        layer.open({
            type:2,
            title:'编辑',
            skin:'layui-layer-lan',
            area:['60%','70%'],
            content: ['<?php echo base_url();?>admin/c_issued/iss_edit/'+id, 'yes']
        })
    });
</script>
</html>