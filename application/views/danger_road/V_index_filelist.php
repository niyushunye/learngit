<body class="bg-white fixed_filelist_content">
<div class="" style="margin:20px;">
    <div class="">
        <div class="">
            <div class="">
                <div style="margin-bottom: 20px">
                    <form action="<?php echo base_url();?>admin/c_danger_road/suosou" method="post">
                         辖区道路名称：<input type="text" name="dlmc" value="<?php echo $dlmc?>" style="width: 200px;height: 25px">
                        <input type="hidden" name="xzqh" value="<?php echo $orgnum?>">

                        <input type="submit" value="搜索" class="button button-small border border-yellow operate_sub" >
                    </form>
                </div>
                <form class="form-horizontal" name="" method="post" action="">
                    <div class="ibox-content">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr class="bg-back">
                                <th nowrap="nowrap">行政区划</th>
                                <th nowrap="nowrap">排查时间</th>
                                <th nowrap="nowrap">是否隐患</th>
                                <th nowrap="nowrap">联系电话</th>
                                <th nowrap="nowrap">辖区道路名称</th>
                                <th nowrap="nowrap">采集时间</th>
                                <th nowrap="nowrap">录入警员</th>
                                <th nowrap="nowrap" width="13%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($memberinfo as $k => $v){?>
                                <tr>
                                    <td><?php echo $v['xzqh_name']['name']?></td>
                                    <td> <?php echo $v['pcsj']?></td>
                                    <td> <?php if($v['is_danger'] == 1){echo '是';}else{echo '否';}  ?></td>
                                    <td> <?php echo $v['lxdh']?></td>
                                    <td> <?php echo $v['dlmc']?></td>
                                    <td><?php date_default_timezone_set("Asia/Shanghai"); echo date('Y-m-d h:i',$v['cjsj'])?></td>
                                    <td> <?php echo $v['jymc']['name']?></td>
                                    <td>
                                        <nobr>
                                            <a href="#" hfht ="<?php echo $v['id']?>" class="details button button-small border border-blue operate_sub">详情</a>
                                            <a href="#" hfht ="<?php echo $v['id']?>" class="edit button button-small border border-blue operate_sub">编辑</a>
                                            <a href="#" hfht ="<?php echo $v['id']?>" class="delete button button-small border border-gray operate_sub">删除</a>
                                        </nobr>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                        <ul>
                            <?php echo $this->pagination->create_links(); ?><span class="total">共 <?php echo $total;?> 条</span>
                            <input type="hidden" id="this_orgnum" value="<?php echo $orgnum?>">
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    //详情
    $('.details').click(function(){
        var id = $(this).attr('hfht');
        layer.open({
            type:2,
            title:'编辑安全责任干部',
            skin:'layui-layer-lan',
            area:['70%','40%'],
            content: ['<?php echo base_url();?>admin/c_danger_road/details/?id='+id, 'yes']
        })

    });

    //编辑
    $('.edit').click(function(){
        var id = $(this).attr('hfht');
        layer.open({
            type:2,
            title:'编辑危险道路',
            skin:'layui-layer-lan',
            area:['50%','60%'],
            content: ['<?php echo base_url();?>admin/c_danger_road/edit/?id='+id, 'yes']
        })
    });

    $(".delete").click(function(){
        var orgid = $(this).attr('hfht');
        var this_orgnum = $("#this_orgnum").val();
        layer.confirm('你确定要删除该数据？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post('<?php echo base_url();?>admin/c_danger_road/delete/',{"id":orgid},function(data){
                if(data == 1){
                    layer.msg("删除成功！",{
                        time:1.5*1000
                    },function(){
                        window.location.href = '<?php echo base_url()?>admin/c_danger_road/filelist/'+ this_orgnum;
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
