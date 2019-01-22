<body class="bg-white fixed">
<div style="margin:20px;">
    <div>
        <div>
            <div>
                <div>
                    <div style="width:1760px; overflow: auto;">
                    <form method="post" action="<?php echo base_url()?>admin/c_outbound_management/searchs">
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
                                <span>身份证码：</span><input type="text" id="sfzmhm" name="sfzmhm"  style="width: 200px;margin-bottom: 10px" value="<?php echo $sfzmhms;?>"> &nbsp;&nbsp;
                                <br>
                                <span>处置民警：</span><input type="text" id="czr" name="czr"  style="width: 195px;margin-left: 5px" value="<?php echo $czrs;?>"> &nbsp;&nbsp;
                                 <span>开始时间：</span><input type="text" id="startTime" name="startTime"  style="width: 200px" <?php if($startTime):?> value="<?php echo date('Y-m-d H:i',$startTime);?>" <?php endif;?> > &nbsp;&nbsp;

                                <span>结束时间：</span><input type="text" id="endTime" name="endTime"  style="width: 195px;margin-left: 5px" <?php if($endTime):?>  value="<?php echo date('Y-m-d H:i',$endTime);?>" <?php endif;?> > &nbsp;&nbsp;

                                
                                <button type="submit" class="button button-small border border-yellow operate_sub" style="margin-left: 200px" id="search">搜索</button>
                            </div>
                        </div>
                    </form>
                    </div>
                    <div class="right_button x11-move" style="margin-top:0px; ">
                        <a href="#" class="button button-small border border-green add">出库</a>
                    </div>
                </div>
                <form class="form-horizontal" name="" method="post" action="">
                    <div class="ibox-content">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr class="bg-back">
                                <th>序号</th>
                                <th>号牌号码</th>
                                <th>号牌种类</th>
                                <th>当事人</th>
                                <th>身份证号码</th>
                                <th>处置时间</th>
                                <th>部门代码</th>
                                <th>部门名称</th>
                                <th>处置人警员编号</th>
                                <th>处置人</th>
                                <th>是否强制出库</th>
                                <th width="13%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($data as $value): ?>
                                <tr id="<?php echo $value['xh'];?>">
                                    <td><?php echo $value['xh'];?></td>
                                    <td><?php echo $value['hphm'];?></td>
                                    <td><?php echo $value['hpzl_fanyi_result'];?></td>
                                    <td><?php echo $value['dsr'];?></td>
                                    <td><?php echo $value['sfzmhm'];?></td>
                                    <td><?php echo date('Y-m-d H:i',$value['czsj']);?></td>
                                    <td><?php echo $value['bmdm'];?></td>
                                    <td><?php echo $value['bmmc'];?></td>
                                    <td><?php echo $value['jybh'];?></td>
                                    <td><?php echo $value['czr'];?></td>
                                    <td><?php if($value['sfqzck']=='1'){echo '是';}else{echo "否";}?></td>
                                    <td>
                                        <!-- <a href="#" hfht = "<?php echo $value['xh'];?>" class="view button button-small border border-blue operate_sub">详情</a> -->
                                        <a href="#" hfht = "<?php echo $value['xh'];?>" class="edit button button-small border border-blue operate_sub">编辑</a>
                                        <a href="#" hfht = "<?php echo $value['xh'];?>" class="delete button button-small border border-gray operate_sub">删除</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <ul>
                            <?php if($type == 1):?> <?php echo $this->pagination->create_links(); ?> <?php endif;?> <span class="total" id='link'>共 <?php echo $total;?> 条</span>
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

        //获取开始时间
        var startTime = $('#startTime').val();
        //获取结束时间
        var endTime = $('#endTime').val();
        //获取号牌号码
        var hphm = $('#hphm').val();
        //获取处置民警
        var czr = $('#czr').val();
        //获取号牌种类
        var hpzl = $('#hpzl').val();
        //获取身份证
        var sfzmhm = $('#sfzmhm').val();
        //获取部门名称(传的是部门代码)
        var bmdm = $('#bmdm').val();
        
        layer.confirm('确定删除该出库信息？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post('<?php echo base_url();?>admin/c_outbound_management/delete/',{"did":did,"startTime":startTime,"endTime":endTime,"hphm":hphm,"czr":czr,"hpzl":hpzl,"sfzmhm":sfzmhm,"bmdm":bmdm},function(data){
                if(data != '0')
                {
                    layer.msg("删除成功！",{
                        time:1000
                    },function(){
                        $("#"+did).remove(); 
                        var num = data;
                        $("#link").html('<span class="total">共 '+num+' 条</span>');
                        //window.location.href = '<?php echo base_url()?>admin/c_inbound_management/index/';
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
            title:'新增',
            skin:'layui-layer-lan',
            area:['60%','70%'],
            content: ['<?php echo base_url();?>admin/c_outbound_management/outbound_adds/', 'yes']
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
            content: ['<?php echo base_url();?>admin/c_outbound_management/outbound_edit/'+id, 'yes']
        })
    });
</script>
</html>