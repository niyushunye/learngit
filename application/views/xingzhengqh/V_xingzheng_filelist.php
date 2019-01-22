<body class="bg-white fixed_filelist_content">
<div class="" style="margin:20px;">
    <div class="">
        <div class="">
            <div class="">
                <div class="">
                    <div class="x11-move" style="margin-bottom: 10px">
                        <?php if($shortname != "5" && $shortname != "6"){?>
                            <a href="#" class="button button-small border border-green add" hfht = '<?php echo $orgnum?>'">新增</a>
                        <?php }?>
                    </div>
                </div>
                <form class="form-horizontal" name="" method="post" action="">
                    <div class="ibox-content">

                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr class="bg-back">
                                <th nowrap="nowrap">行政区划名称</th>
                                <th nowrap="nowrap">上级行政区划名称</th>
                                <th nowrap="nowrap">行政区划编码</th>
                                <th nowrap="nowrap">状态</th>
                                <th nowrap="nowrap">创建时间</th>
                                <th nowrap="nowrap" width="13%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($orginfo as $k => $v): ?>
                                <tr>
                                    <td><?php echo $v['name'];?></td>
                                    <td><?php if($v['sj_name']['name'] == ''){echo '最高级的行政区划';}else{echo $v['sj_name']['name'];} ?></td>
                                    <td><?php echo $v['number']?></td>
                                    <td><?php if($v['status'] == '1'){echo '已开通';}else{echo '未开通';} ?></td>
                                    <td><?php echo date('Y-m-d H:i',$v['create_time'])?></td>
                                    <td>
                                        <a href="#" hfht = "<?php echo$v['id'];?>" class="edit button button-small border border-blue operate_sub">编辑</a>
                                        <a href="#" hfht = "<?php echo$v['id'];?>" class="delete button button-small border border-gray operate_sub">删除</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <input type="hidden" id="this_orgnum" value="<?php echo $orgnum?>">
                            </tbody>
                        </table>
                        <ul>
                            <?php echo $this->pagination->create_links(); ?>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>



    //编辑
    $('.edit').click(function(){
        var id = $(this).attr('hfht');
        layer.open({
            type:2,
            title:'编辑',
            skin:'layui-layer-lan',
            area:['60%','60%'],
            content: ['<?php echo base_url();?>admin/c_xingzhengqh/edit/?id='+id, 'yes']
        })
    });

    //新增
    $('.add').click(function(){
        var id = $(this).attr('hfht');
        layer.open({
            type:2,
            title:'编辑',
            skin:'layui-layer-lan',
            area:['60%','60%'],
            content: ['<?php echo base_url();?>admin/c_xingzhengqh/add/?id='+id, 'yes']
        })
    });

    $(".delete") .click(function(){
        var orgid = $(this).attr('hfht');
        layer.confirm('你确定要删除该数据？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post('<?php echo base_url();?>admin/c_xingzhengqh/delete/',{"id":orgid},function(data){
                if(data == 4){
                    layer.msg("对不起该行政区划有安全责任干部，您不能删除！",{time:2000})
                }else if(data == 3){
                    layer.msg("对不起该行政区化有下级，您不能删除！",{time:2000});
                }else if(data == 1){
                    layer.msg("删除成功！",{
                        time:1000
                    },function(){
                        layer.closeAll();
                        parent.window.location.reload();
                    });
                }else{
                    layer.msg("删除失败！",{time:1000});
                }
            })
        }, function(){
            layer.msg("你取消了删除！",{time:1000});
        });
    });
</script>
</body>
</html>
