<body class="bg-white fixed"> 
<div style="margin:20px;">
    <div>
        <div>
            <div>
                <div>
                    <div style="width:1760px; overflow: auto;">
                    <form method="post" action="<?php echo base_url()?>admin/C_task_devide/search">
                            <div class="filed input-group">
                                <div class = "search2">
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
                                    <span>业务类型：</span>
                                    <select  id="ywlx"  style="height: 26px;width: 196px" name="ywlx">
                                        <option value="0">---请选择---</option>
                                        <?php foreach ($ywlx as $v){?>
                                            <option value="<?php echo $v['id'];?>" <?php if($ywlxs == $v['id']):?> selected='' <?php endif;?> ><?php echo $v['task_name'];?></option>
                                        <?php }?>
                                    </select> &nbsp;&nbsp;                                    
                                    <br>
                                    <span>处置民警：</span><input type="text" id="czr" name="czr"  style="width: 200px" value="<?php echo $czrs;?>"> &nbsp;&nbsp;

                                     <span>开始时间：</span><input type="text" id="startTime" name="startTime"  style="width: 200px" <?php if($startTime):?> value="<?php echo date('Y-m-d H:i',$startTime);?>" <?php endif;?> > &nbsp;&nbsp;

                                    <span>结束时间：</span><input type="text" id="endTime" name="endTime"  style="width: 200px" <?php if($endTime):?>  value="<?php echo date('Y-m-d H:i',$endTime);?>" <?php endif;?> > &nbsp;&nbsp;
                                     <button type="submit" class="button button-small border border-yellow operate_sub" id="search">搜索</button>
                                </div>
                            </div>
                        </form>
                        </div>

                    <div class="right_button x11-move" style="margin-top:0px; ">
                        <a href="#" class="button button-small border border-green add">新增</a>
                    </div>
                </div>
                <form class="form-horizontal" name="" method="post" action="">
                    <div class="ibox-content">
                        <table class="table table-bordered table-hover" id="tableid">
                            <thead>
                            <tr class="bg-back">
                               <!--  <th>序号</th> -->
                                <th>业务类型</th>
                                <th>号牌号码</th>
                                <th>号牌种类</th>
                                 <th>部门名称</th>
                                <th>部门代码</th>                     
                                <th>警员编号</th>
                                <th>任务执行月份</th>
                                <th>分配时间</th>
                                <th width="13%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($data as $value): ?>
                                <tr id="<?php echo $value['id'];?>">
                                   <!--  <td><?php echo $value['id'];?></td> -->
                                    <td><?php echo $value['task_name'];?></td>
                                    <td><?php echo $value['hphm'];?></td>
                                    <td><?php echo $value['hpzl_fanyi_result'];?></td>
                                    <td><?php echo $value['bmmc'];?></td>
                                    <td><?php echo $value['bmdm'];?></td>
                                    <td><?php echo $value['czr'];?>[<?php echo $value['jybh'];?>]</td>
                                    <td><?php echo $value['month'];?></td>
                                    <td><?php echo date('Y-m-d H:i',$value['dateline1']);?></td>
                                    <td>
                                        <a href="#" hfht = "<?php echo $value['id'];?>" class="edit button button-small border border-blue operate_sub">编辑</a>
                                        <a href="#" hfht = "<?php echo $value['id'];?>" class="delete button button-small border border-gray operate_sub">删除</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <ul>
                          <?php if($type == '1'):?> <?php echo $this->pagination->create_links(); ?> <?php endif;?><span class="total" id='link'>共 <?php echo $total;?> 条</span>
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
        //获取业务类型
        var ywlx = $('#ywlx').val();
        //获取部门名称(传的是部门代码)
        var bmdm = $('#bmdm').val();




        layer.confirm('确定删除该分配信息？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post('<?php echo base_url();?>admin/c_task_devide/delete/',{"did":did,"startTime":startTime,"endTime":endTime,"hphm":hphm,"czr":czr,"hpzl":hpzl,"ywlx":ywlx,"bmdm":bmdm},function(data){
                if(data != '0')
                {
                    layer.msg("删除成功！",{
                        time:1000
                    },function(){
                        $("#"+did).remove(); 
                        var num = data;
                        $("#link").html('<span class="total">共 '+num+' 条</span>');
                        //window.location.href = '<?php echo base_url()?>admin/c_task_devide/index/';
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
            content: ['<?php echo base_url();?>admin/c_task_devide/devide_add/', 'yes']
        })
    });

    //编辑
    $(".edit").click(function(){
        var id = $(this).attr('hfht');
        layer.open({
            type:2,
            title:'新增',
            skin:'layui-layer-lan',
            area:['60%','70%'],
            content: ['<?php echo base_url();?>admin/c_task_devide/devide_edit/'+id, 'yes']
        })
    });
</script>
</html>