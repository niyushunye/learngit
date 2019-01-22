<body class="bg-white fixed">
<div style="margin:20px;">
    <div>
        <div>
            <div>
                <form action="<?php echo base_url()?>admin/c_integrated/index" method="get" style="float: left">
                    <span>时间：</span><input type="text" style="height: 24px" name="score_month" value="<?php echo $ins?>" id="test3" autocomplete="off">
                    <button type="submit" style="margin-left: 15px" class="button button-small border border-yellow operate_sub" id="search">搜索</button>
                </form>
                <div style="float: right;margin-right: 15px">
                    <a href="#" class="button button-small border border-green points">加分项目</a>
                </div>
                <div style="float: right;margin-right:15px;margin-bottom: 15px">
                    <a href="#" class="button button-small border border-green add">扣分</a>
                </div>
                <form class="form-horizontal" name="" method="post" action="">
                    <div class="ibox-content">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr class="bg-back">
                                <th>部门名称</th>
                                <th>部门代码</th>
                                <th>分值</th>
                                <th>项目</th>
                                <th>原因</th>
                                <th>月份</th>
                                <th>操作类型</th>
                                <th width="13%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($data as $value): ?>
                                <tr id="<?php echo $value['id'];?>">
                                    <td><?php echo $value['unit'];?></td>
                                    <td><?php echo $value['unit_num'];?></td>
                                    <td><?php echo $value['score'];?></td>
                                    <td>
                                        <?php if($value['project'] == 'score_1'){;?>
                                            <?php echo '党的基层组织建设';?>
                                        <?php } else if($value['project'] == 'score_2'){?>
                                            <?php echo '党风政风行风建设';?>
                                        <?php } else if($value['project'] == 'score_3'){?>
                                            <?php echo '队伍素质能力建设';?>
                                        <?php } else if($value['project'] == 'score_4'){?>
                                            <?php echo '典型培树宣传';?>
                                        <?php } else if($value['project'] == 'score_5'){?>
                                            <?php echo '从优待警政策落实';?>
                                        <?php } else if($value['project'] == 'score_6'){?>
                                            <?php echo '综合文秘'?>
                                        <?php } else if($value['project'] == 'score_7'){?>
                                            <?php echo '指挥调度(上传下达)';?>
                                        <?php } else if($value['project'] == 'score_8'){?>
                                            <?php echo '材料数据报表上报';?>
                                        <?php } else if($value['project'] == 'score_9'){?>
                                            <?php echo '各类创建活动(含“五城联创”任务落实)'?>
                                        <?php } else { ?>
                                            <?php echo '加分项目'?>
                                        <?php }?>
                                    </td>
                                    <td><?php echo $value['why'];?></td>
                                    <td><?php echo $value['ins'];?></td>
                                    <td><?php if($value['type'] == 1){echo '扣分';}else{ echo '加分';} ;?></td>
                                    <td>
<!--                                        <a href="#" hfht = "--><?php //echo $value['id'];?><!--" class="edit button button-small border border-blue operate_sub">编辑</a>-->
                                        <a href="#" hfht = "<?php echo $value['id'];?>" class="delete button button-small border border-gray operate_sub">删除</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <ul>
                             <?php echo $this->pagination->create_links(); ?> <span class="total" id='link'>共 <?php echo $total;?> 条</span>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;
        //年月选择器
        laydate.render({
            elem: '#test3'
            ,type: 'month'
        });

    });
</script>

<script> 
    //删除
    $(".delete") .click(function(){
        var did = $(this).attr('hfht');
        layer.confirm('确定删除信息？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post('<?php echo base_url();?>admin/c_integrated/delete/',{"did":did},function(data){
                if(data == 1)
                {
                    layer.msg("删除成功！",{
                        time:1000
                    },function(){
                        window.location.href = '<?php echo base_url()?>admin/c_integrated/index/';
                    });
                }else
                {
                    layer.msg("记录不存在,刷新！",{time:1000},function(){
                        window.location.reload();
                    });
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
            title:'扣分',
            skin:'layui-layer-lan',
            area:['60%','70%'],
            content: ['<?php echo base_url();?>admin/c_integrated/add/', 'yes']
        })
    });

    //加分项目
    $('.points').click(function(){
        layer.open({
            type:2,
            title:'加分项目',
            skin:'layui-layer-lan',
            area:['50%','60%'],
            content: ['<?php echo base_url();?>admin/c_integrated/points/', 'yes']
        })
    });
</script>
</html>