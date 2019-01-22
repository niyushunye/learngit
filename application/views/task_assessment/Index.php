<body class="bg-white fixed">
<div style="margin:20px;">
    <div>
        <div>
            <div>
                <div style="width:1760px; overflow: auto;margin-bottom: 30px">
                    <form method="post" action="<?php echo base_url()?>admin/c_task_assessment/search">
                        <div class="filed input-group">
                            <div>
                                <span>部门名称：</span>
                                <select  id="bmdm"  style="height: 26px;width: 196px" name="bmdm">
                                    <option value="0">---请选择---</option>
                                    <?php foreach ($bmdm as $v){?>
                                        <option value="<?php echo $v['orgnum'];?>" <?php if($bmdms == $v['orgnum']):?> selected='' <?php endif;?> ><?php echo $v['orgname'];?></option>
                                    <?php }?>
                                </select> &nbsp;&nbsp;

                                <span>号牌号码：</span><input type="text" id="hphm" name="hphm"  style="width: 200px" value="<?php echo $hphms;?>"> &nbsp;&nbsp;

                                <span>号牌种类：</span>
                                <select  id="hpzl"  style="height: 26px;width: 196px" name="hpzl">
                                    <option value="0">---请选择---</option>
                                    <?php foreach ($hpzl as $v){?>
                                        <option value="<?php echo $v['DMZ'];?>" <?php if($hpzls == $v['DMZ']):?> selected='' <?php endif;?> ><?php echo $v['DMSM1'];?></option>
                                    <?php }?>
                                </select> &nbsp;&nbsp;

                                <span>身份证码：</span><input type="text" id="sfzmhm" name="sfzmhm"  style="width: 195px;margin-bottom: 10px;margin-left: 5px" value="<?php echo $sfzmhms;?>"> &nbsp;&nbsp;
                                <br>
                                <span>处置民警：</span><input type="text" id="czr" name="czr"  style="width: 195px;margin-left: 5px" value="<?php echo $czrs;?>"> &nbsp;&nbsp;

                                <span>开始时间：</span><input autocomplete="off" type="text" id="startTime" name="startTime"  style="width: 200px" <?php if($startTime):?> value="<?php echo date('Y-m-d H:i',$startTime);?>" <?php endif;?> > &nbsp;&nbsp;

                                <span>结束时间：</span><input autocomplete="off" type="text" id="endTime" name="endTime"  style="width: 195px;margin-left: 5px" <?php if($endTime):?>  value="<?php echo date('Y-m-d H:i',$endTime);?>" <?php endif;?> > &nbsp;&nbsp;
                                <span>业务类型：</span>
                                <select  id="hpzl"  style="height: 26px;width: 196px" name="ywlx">
                                    <option value="0">---请选择---</option>
                                    <option value="1" <?php if($ywlx == 1){echo 'selected';}else{echo '';}?>>隐患歼灭战工作考核</option>
                                    <option value="2" <?php if($ywlx == 2){echo 'selected';}else{echo '';}?>>当月应检车辆</option>
                                    <option value="3" <?php if($ywlx == 3){echo 'selected';}else{echo '';}?>>五类车检验</option>
                                </select>
                                <button type="submit" class="button button-small border border-yellow operate_sub" style="margin-left: 30px" id="search">搜索</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
                <form class="form-horizontal" name="" method="post" action="">
                    <div class="ibox-content">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr class="bg-back">
                                <th>部门名称</th>
                                <th>号牌号码</th>
                                <th>号牌种类</th>
                                <th>业务类型</th>
                                <th>是否查处</th>
                                <th>未查处原因</th>
                                <th>处置民警</th>
                                <th>当事人</th>
                                <th>身份证号</th>
                                <th>处置时间</th>
                                <th>处置结果</th>
                                <th>是否有效</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($data as $value): ?>
                                <tr>
                                    <td><?php echo $value['bmmc'];?></td>
                                    <td><?php echo $value['hphm'];?></td>
                                    <td><?php echo $value['DMSM1'];?></td>
                                    <td><?php echo $value['task_name'];?></td>
                                    <td><?php if($value['sfch'] == '1'){ echo "是";} if($value['sfch'] == '0'){ echo "否";}?></td>
                                    <td><?php echo $value['wfcyy'];?></td>
                                    <td><?php echo $value['czr'];?></td>
                                    <td><?php echo $value['dsr'];?></td>
                                    <td><?php echo $value['sfzmhm'];?></td>
                                    <td><?php echo date('Y-m-d H:i',$value['czsj']);?></td>
                                    <td><?php echo $value['czjg'];?></td>
                                    <td><?php if($value['sfyx'] == '1'){ echo "是";} if($value['sfyx'] == '2'){ echo "否";}?></td>
                                    <td>
                                        <a href="#" hfht = "<?php echo $value['id'];?>" class="edit button button-small border border-blue operate_sub">编辑</a>
                                        <!--<a href="#" hfht = "<?php /*echo $value['id'];*/?>" class="delete button button-small border border-gray operate_sub">删除</a>-->
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
    var start = {
        elem: '#startTime',
        format: 'YYYY-MM-DD hh:mm',
        min: '2010-01-01', //最小日期
        max: '2099-12-31 23:59:59', //最大日期
        start: "<?php echo date('Y-m-d',time());?>",    //开始日期
        istime: true,
        istoday: true,
        fixed: false, //是否固定在可视区域
        zIndex: 99999999, //css z-index
        choose: function(datas){
            end.min = datas; //开始日选好后，重置结束日的最小日期
            end.start = datas //将结束日的初始值设定为开始日
        }
    };
    var end = {
        elem: '#endTime',
        format: 'YYYY-MM-DD hh:mm',
        min: '2010-01-01', //最小日期
        max: '2099-12-31 23:59:59', //最大日期
        istime: true,
        istoday: true,
        fixed: false, //是否固定在可视区域
        zIndex: 99999999, //css z-index
        choose: function(datas){
            start.max = datas; //结束日选好后，重置开始日的最大日期
        }
    };
    laydate(start);
    laydate(end);
</script>

<script>
    //删除
    $(".delete") .click(function(){
        var did = $(this).attr('hfht');
        layer.confirm('确定删除该入库信息？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post('<?php echo base_url();?>admin/c_task_assessment/delete/',{"did":did},function(data){
                if(data == '1')
                {
                    layer.msg("删除成功！",{
                        time:1.5*1000
                    },function(){
                        window.location.href = '<?php echo base_url()?>admin/c_task_assessment/index/';
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
            content: ['<?php echo base_url();?>admin/c_task_assessment/assessment_add/', 'yes']
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
            content: ['<?php echo base_url();?>admin/c_task_assessment/assessment_edit/'+id, 'yes']
        })
    });
</script>
</html>