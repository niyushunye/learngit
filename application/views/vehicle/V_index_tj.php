<body class="bg-white fixed_filelist_content">
<div class="" style="margin:20px;">
    <div class="">
        <div class="">
            <div class="">
                <div style="width: 100%; text-align: center;font-size: 20px;margin-top: 20px">
                    汉滨区动车辆统计
                </div>
                <div style="float: right;margin:0 50px 10px 0">
                    <a href="#" class="export button button-small border border-green add">导出</a>
                </div>
                <form class="form-horizontal" name="" method="post" action="">
                    <div class="ibox-content">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr class="bg-back">

                                <th nowrap="nowrap">行政区划</th>
                                <th nowrap="nowrap">乡镇村数量</th>
                                <th nowrap="nowrap">辆轮摩托车</th>
                                <th nowrap="nowrap">其他</th>
                                <th nowrap="nowrap">黄牌货车</th>
                                <th nowrap="nowrap">蓝牌货车</th>
                                <th nowrap="nowrap">三轮货车</th>
                                <th nowrap="nowrap">小客车（轿车）</th>
                                <th nowrap="nowrap">面包车</th>
                                <th nowrap="nowrap">校车</th>
                                <th nowrap="nowrap">运营车辆</th>
                                <th nowrap="nowrap">危化品运输车</th>
                                <th nowrap="nowrap">拖拉机（农用车）</th>
                                <th nowrap="nowrap">总数</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($tj as $k => $v){?>
                                <tr>
                                    <th><?php echo $v['name']?></th>
                                    <th><?php echo $v['count']?></th>

                                    <?php foreach ($v['cllx'] as $k1 => $v2){?>
                                        <th><?php echo $v2['DMSM1']?></th>
                                    <?php }?>

                                    <th><?php echo $v['zs']?></th>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(".export").click(function(){

        layer.confirm('是否导出该表？', {
            btn: ['确定','取消'] //按钮
        }, function(){

            window.location.href = '<?php echo base_url();?>admin/c_vehicle/export';

            layer.closeAll();

        }, function(){
            layer.closeAll();
        });
    });
    //详情
    //    $('.details').click(function(){
    //        var id = $(this).attr('hfht');
    //        layer.open({
    //            type:2,
    //            title:'编辑安全责任干部',
    //            skin:'layui-layer-lan',
    //            area:['70%','40%'],
    //            content: ['<?php //echo base_url();?>//admin/c_danger_road/details/?id='+id, 'yes']
    //        })
    //    });

    //编辑
    //    $('.edit').click(function(){
    //        var id = $(this).attr('hfht');
    //        layer.open({
    //            type:2,
    //            title:'编辑危险道路',
    //            skin:'layui-layer-lan',
    //            area:['50%','60%'],
    //            content: ['<?php //echo base_url();?>//admin/c_danger_road/edit/?id='+id, 'yes']
    //        })
    //    });
    //    $(".delete").click(function(){
    //        var orgid = $(this).attr('hfht');
    //        var this_orgnum = $("#this_orgnum").val();
    //        layer.confirm('你确定要删除该数据？', {
    //            btn: ['确定','取消'] //按钮
    //        }, function(){
    //            $.post('<?php //echo base_url();?>//admin/c_danger_road/delete/',{"id":orgid},function(data){
    //                if(data == 1){
    //                    layer.msg("删除成功！",{
    //                        time:1.5*1000
    //                    },function(){
    //                        window.location.href = '<?php //echo base_url()?>//admin/c_danger_road/filelist/'+ this_orgnum;
    //                    });
    //                }else{
    //                    layer.msg("删除失败！",{time:1000});
    //                }
    //            })
    //        }, function(){
    //            layer.msg("你取消了删除！",{time:1000});
    //        });
    //    });
</script>
</body>
</html>
