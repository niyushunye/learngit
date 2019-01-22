<body class="bg-white fixed">
<div style="margin:20px;">
    <div>
        <div>
            <div>
                <div>
                    <div class="right_button" style="margin-top:0px;float: right; ">
                        <a href="#" class="button button-small border border-green add" ass="1">新增停车名称</a>
                        <a href="#" class="button button-small border border-green add" ass="2">新增停车场地址</a>
                    </div>
                </div>
                <form class="form-horizontal" name="" method="post" action="">
                    <div class="ibox-content">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr class="bg-back">
                                <th>停车场名称</th>
                                <th>停车场地址</th>
                                <th width="13%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($data as $key => $value): ?>
                                <tr>
                                    <td>
                                        <a href="#" class="bianji" hfht = "<?php echo $value['parking_fj']?>"><?php echo $value['mc']['task_name'];?></a>
                                    </td>
                                    <td><?php echo $value['parking_dizhi'];?></td>
                                    <td>
                                        <a href="#" hfht = "<?php echo $value['id'];?>" class="edit button button-small border border-blue operate_sub">编辑</a>
                                        <a href="#" hfht = "<?php echo $value['id'];?>" class="delete button button-small border border-gray operate_sub">删除</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <ul>
                            <?php echo $this->pagination->create_links(); ?><span class="total" id='link'>共 <?php echo $total;?> 条</span>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>

<script>
//    var start = {
//        elem: '#startTime',
//        format: 'YYYY-MM-DD hh:mm',
//        min: '2010-01-01', //最小日期
//        max: '2099-12-31 23:59:59', //最大日期
//        start: "<?php //echo date('Y-m-d',time());?>//",    //开始日期
//        istime: true,
//        istoday: true,
//        fixed: false, //是否固定在可视区域
//        zIndex: 99999999, //css z-index
//        choose: function(datas){
//            end.min = datas; //开始日选好后，重置结束日的最小日期
//            end.start = datas //将结束日的初始值设定为开始日
//        }
//    };
//    var end = {
//        elem: '#endTime',
//        format: 'YYYY-MM-DD hh:mm',
//        min: '2010-01-01', //最小日期
//        max: '2099-12-31 23:59:59', //最大日期
//        istime: true,
//        istoday: true,
//        fixed: false, //是否固定在可视区域
//        zIndex: 99999999, //css z-index
//        choose: function(datas){
//            start.max = datas; //结束日选好后，重置开始日的最大日期
//        }
//    };
//    laydate(start);
//    laydate(end);

</script>

<script>

    //编辑停车场名称
    $('.bianji').click(function(){
        var  parking =  $(this).attr('hfht');
        layer.open({
            type:2,
            title:'编辑停车名称',
            skin:'layui-layer-lan',
            area:['40%','40%'],
            content: ['<?php echo base_url();?>admin/c_parking/parking_mc_edit?id='+parking, 'yes']
        })
    });


//    //编辑停车场名称和删除停车场名称
//    $('.bianji').mousedown(function(e){
//        if(3 == e.which){
//            var  parking =  $(this).attr('hfht');
//
//            layer.confirm('确定删除该入库信息？', {
//                btn: ['确定','取消']
//            }, function(){
//                $.post('<?php //echo base_url();?>//admin/c_parking/parking_delete/',{"did":did},function(data){
//
//                    if(data != '0')
//                    {
//                        layer.msg("删除成功！",{
//                            time:1000
//                        },function(){
//                            window.location.reload();
//                        });
//                    }else
//                    {
//                        layer.msg("记录不存在,刷新！",{time:1000},function(){
//                            window.location.reload();
//                        });
//                    }
//                })
//            }, function(){
//                layer.closeAll();
//            });
//        }else if(1 == e.which){
//            var  parking =  $(this).attr('hfht');
//            layer.open({
//            type:2,
//            title:'编辑停车名称',
//            skin:'layui-layer-lan',
//            area:['40%','40%'],
//            content: ['<?php //echo base_url();?>//admin/c_parking/parking_mc_edit?id='+parking, 'yes']
//        })
//        }
//    });


    //编辑停车场名称
//    $('.bianji').click(function(){
//        var  parking =  $(this).attr('hfht');
//        layer.open({
//            type:2,
//            title:'新增',
//            skin:'layui-layer-lan',
//            area:['60%','70%'],
//            content: ['<?php //echo base_url();?>//admin/c_parking/parking_mc_edit?id='+parking, 'yes']
//        })
//    })

    //删除
    $(".delete") .click(function(){
        var did = $(this).attr('hfht');

        layer.confirm('确定删除该入库信息？', {
            btn: ['确定','取消']
        }, function(){
            $.post('<?php echo base_url();?>admin/c_parking/parking_delete/',{"did":did},function(data){

                if(data != '0')
                {
                    layer.msg("删除成功！",{
                        time:1000
                    },function(){
                        window.location.reload();
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
        var id = $(this).attr('ass');
        layer.open({
            type:2,
            title:'新增',
            skin:'layui-layer-lan',
            area:['60%','70%'],
            content: ['<?php echo base_url();?>admin/c_parking/parking_add?id='+id, 'yes']
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
            content: ['<?php echo base_url();?>admin/c_parking/parking_edit?id='+id, 'yes']
        })
    });
</script>
</html>