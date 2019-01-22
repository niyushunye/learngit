<body class="bg-white fixed"> 
<div style="margin:20px;">
    <div>
        <div>
            <div>
                <form method="post" action="<?php echo base_url()?>admin/c_task_assignment/search">
                    <div class="filed input-group">
                        <div class = "search2">
                            <span>下发部门：</span>
                            <select  id="bmdm"  style="height: 26px;width: 196px" name="bmdm">
                                <option value="0">---请选择---</option>
                                <?php foreach ($bmdm as $v){?>
                                    <option value="<?php echo $v['orgnum'];?>" <?php if($bmdms == $v['orgnum']):?> selected='' <?php endif;?> ><?php echo $v['orgname'];?></option>
                                <?php }?>
                            </select> &nbsp;&nbsp;
                            <span>号牌号码：</span><input type="text" id="hphm" name="hphm"  style="width: 200px" value="<?php echo $hphm;?>"> &nbsp;&nbsp;
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
                            <button type="submit" class="button button-small border border-yellow operate_sub" id="search">搜索</button>
                        </div>
                    </div>
                </form>
            </div>
            <div style="margin: 20px 0 20px 75px;display: inline-block">
                <div style="float: left">
                    <form enctype="multipart/form-data" method="post" id="content">
                        <input type="file"   id="version_app" name='daoru' style="float: left">
                        <button class="button button-small border border-green import" style="float: left;margin-left: 15px">导入</button>
                    </form>
                </div>
                <div style="float: left;margin-left: 40px" >
                    <a href="<?php echo base_url()?>admin/c_task_assignment/download" class="button button-small border border-green">下载模板</a>
                    <a href="#" class="button button-small border border-green add">新增</a>
                </div>
            </div>
            <form class="form-horizontal" name="" method="post" action="">
                <div class="ibox-content">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class="bg-back">
                            <th>任务类型</th>
                            <th>号牌号码</th>
                            <th>号牌种类</th>
                            <th>下发部门</th>
                            <th>部门代码</th>
                            <th width="13%">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $value): ?>
                            <tr id="<?php echo $value['id'];?>">
                                <!-- <td><?php echo $value['id'];?></td> -->
                                <td><?php echo $value['task_name'];?></td>
                                <td><?php echo $value['hphm'];?></td>
                                <td><?php echo $value['hpzl_fanyi_result']?></td>
                                <td><?php echo $value['bmmc'];?></td>
                                <td><?php echo $value['bmdm'];?></td>
                                <td>
                                    <a href="#" hfht = "<?php echo $value['id'];?>" class="edit button button-small border border-blue operate_sub">编辑</a>
                                    <a href="#" hfht = "<?php echo $value['id'];?>" class="delete button button-small border border-gray operate_sub">删除</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <ul>
                        <?php if($type == 1): ?> <?php echo $this->pagination->create_links(); ?><?php endif;?><span class="total" id='link'>共 <?php echo $total;?> 条</span>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</div> 
</body>
<script>
    //删除
    $(".delete") .click(function(){
        var tid = $(this).attr('hfht');
        //获取号牌号码
        var hphm = $('#hphm').val();
        //获取号牌种类
        var hpzl = $('#hpzl').val();
        //获取业务类型
        var ywlx = $('#ywlx').val();
        //获取部门名称(传的是部门代码)
        var bmdm = $('#bmdm').val();

        layer.confirm('确定删除该分配信息？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post('<?php echo base_url();?>admin/c_task_assignment/delete/',{"tid":tid,"hphm":hphm,"hpzl":hpzl,"ywlx":ywlx,"bmdm":bmdm},function(data){
                //alert(data);
               if(data != '0')
               {
                   layer.msg("删除成功！",{
                       time:1000
                   },function(){
                        $("#"+tid).remove(); 
                        var num = data;
                        $("#link").html('<span class="total">共 '+num+' 条</span>');
                       //window.location.href = '<?php echo base_url()?>admin/c_task_assignment/index/';
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
            content: ['<?php echo base_url();?>admin/c_task_assignment/task_add/', 'yes']
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
            content: ['<?php echo base_url();?>admin/c_task_assignment/task_edit/'+id, 'yes']
        })
    });
</script>
<script>
    $('.import').click(function (){
        var fileData = new FormData(document.getElementById("content"));

        $.ajax({
            url:'<?php echo base_url()?>admin/c_task_assignment/daoru',
            type:'post',
            async:false,
            data:fileData,
            contentType: false,
            processData: false,
            success:function(data){
               if(data == 1){
                   parent.layer.msg("导入成功",{time:2000},function(){
                       window.location.href = '<?php echo base_url()?>admin/c_task_assignment/index';
                   });
               }else if(data == 2){
                   parent.layer.msg("导入失败",{time:2000});
               }else if(data == 3){
                   parent.layer.msg("您选择的文件类型有误，请重新选择",{time:2000});
               }else if(data == 4){
                   parent.layer.msg("请选择文件",{time:1000});
               }else if(data == 5){
                   parent.layer.msg('您表中的业务类型数据格式不正确',{time:2000});
               }
            }
        });
    })
</script>
</html>
