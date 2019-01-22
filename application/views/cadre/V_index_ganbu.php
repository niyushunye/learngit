<body class="bg-white fixed_filelist_content">
<div class="" style="margin:20px;">
    <div class="">
        <div class="">
            <div class="">
                <div class="">
                    <div style="float: left">
                        <form action="<?php echo base_url();?>admin/c_cadre/suosou" method="post">
                            <span>人员编号：</span><input type="text" name="rybh" id="rybh" value="<?php if($rybh == ''){echo '';}else{echo $rybh;}?>" style="width: 190px;height: 25px;padding-left: 5px">
                            <span>职务：</span>
                            <select name="type" id="type" style="width: 190px;height: 25px;padding-left: 5px">
                                <option value="0">--请选择--</option>
                                <option value="1" <?php if($type == 1){echo 'selected';}?>>安全责任干部</option>
                                <option value="2" <?php if($type == 2){echo 'selected';}?>>包村民警</option>
                                <option value="3" <?php if($type == 3){echo 'selected';}?>>信息员</option>
                            </select>
                            <input type="submit" value="搜索" class="button button-small border border-yellow">
                        </form>
                    </div>
                    <div style="margin:0 5% 10px 0;float: right">
                        <a href="#" class="button button-small border border-green add" hfht = '<?php echo $orgnum?>'">新增</a>
                    </div>
                </div>
                <form class="form-horizontal" name="" method="post" action="">
                    <div class="ibox-content">

                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr class="bg-back">
                                <th nowrap="nowrap">行政区划名称</th>
                                <th nowrap="nowrap">行政区划编码</th>
                                <th nowrap="nowrap">姓名</th>
                                <th nowrap="nowrap">性别</th>
                                <th nowrap="nowrap">职务</th>
                                <th nowrap="nowrap">入职时间</th>
                                <th nowrap="nowrap">手机号码</th>
                                <th nowrap="nowrap" width="13%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($memberinfo as $k => $v){?>
                                <tr>
                                    <td><?php echo $v['dept_name']?></td>
                                    <td> <?php echo $v['dept_number']?></td>
                                    <td> <?php echo $v['name']?></td>
                                    <td> <?php if($v['sex'] == 1){echo '男';}else{echo '妇女';}?></td>
                                    <td> <?php if($v['position'] == 1){echo '安全责任干部';}else if($v['position'] == 2){echo '包村民警';}else{echo '信息员';}?></td>
                                    <td> <?php echo $v['entry_time']?></td>
                                    <td><?php echo $v['phone_number']?></td>
                                    <td>
                                        <a href="#" hfht ="<?php echo $v['id']?>" class="edit button button-small border border-blue operate_sub">编辑</a>
                                        <a href="#" hfht ="<?php echo $v['id']?>" class="delete button button-small border border-gray operate_sub">删除</a>
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
    $('.add').click(function(){
        var number = $(this).attr('hfht');
        layer.open({
            type:2,
            title:'新增责任干部',
            skin:'layui-layer-lan',
            area:['60%','80%'],
            content: ['<?php echo base_url();?>admin/c_cadre/add/?number='+number, 'yes']
        })
    });

    //编辑
    $('.edit').click(function(){
        var id = $(this).attr('hfht');
        layer.open({
            type:2,
            title:'编辑安全责任干部',
            skin:'layui-layer-lan',
            area:['60%','70%'],
            content: ['<?php echo base_url();?>admin/c_cadre/edit/?id='+id, 'yes']
        })
    });
//
//
//
//
//
    $(".delete").click(function(){
        var orgid = $(this).attr('hfht');
        layer.confirm('你确定要删除该数据？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post('<?php echo base_url();?>admin/c_cadre/delete/',{"id":orgid},function(data){
                if(data == 1){
                    layer.msg("删除成功！",{
                        time:1.5*1000
                    },function(){
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
