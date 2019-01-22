<body class="bg-white">
<div class="tab" style="">
    <input type="hidden" value="<?php echo base_url();?>" id="url">
    <div class="tab-body" style="width: 95%;">
        <br>
        <div class="tab-panel active" id="tab-set" style="">
            <?php if($type == 1){?>
                <form method="post" class="form-x" method="post" target="_parent">
                    <input type="hidden" value="<?php echo base_url();?>" id="url">
                    <div class="form-group">
                        <div class="label">
                            <label for="rolename">选择部门：</label>
                        </div>
                        <div class="field">
                            <select class="input" id="org">
                                <option value="0">---请选择---</option>
                                <?php foreach ($orginfo as $v){?>
                                    <option value="<?php echo $v['orgnum'];?>"><?php echo $v['orgname'];?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label for="rolename">停车场名称：</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input"  placeholder="请输入名称" value="" id="mingcheng">
                        </div>
                    </div>
                    <div class="form-button">
                        <button class="button button-small bg-main operate_sub" type="button" id="sub1">确定</button>
                    </div>
                </form>
            <?php }else{?>
                <form method="post" class="form-x" method="post" target="_parent">
                    <input type="hidden" value="<?php echo base_url();?>" id="url">
                    <div class="form-group">
                        <div class="label">
                            <label for="rolename">停车场名称：</label>
                        </div>
                        <div class="field">
                            <select class="input" id="tccdz">
                                <option value="0">---请选择---</option>
                                <?php foreach ($data as $v){?>
                                    <option value="<?php echo $v['id'];?>"><?php echo $v['task_name'];?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label for="rolename">停车场地址：</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" placeholder="请输入地址"  value="" id="dizhi">
                        </div>
                    </div>

                    <div class="form-button">
                        <button class="button button-small bg-main operate_sub" type="button" id="sub">确定</button>
                    </div>
                </form>
            <?php }?>
        </div>
    </div>
</div>
<p class="text-right text-gray"></p>
</div>
</body>

<script type="text/javascript">

    //新增停车场地址
    $('#sub').click(function(){
        var mingchengid = $('#tccdz').val();
        var mingcheng = $('#tccdz').find('option:selected').text();
        var dizhi = $('#dizhi').val();
        var URL = $('#url').val();
        //alert(URL);
        if(mingchengid == '0'){
            layer.msg("请选择停车场名称！");
            return false;
        }else if(dizhi == ''){
            layer.msg("请输入停车场地址！");
            return false;
        }else{

            $.ajax({
                url:URL+'admin/c_parking/parking_add_ins',
                type:'post',
                data:{
                    'mingchengid':mingchengid,
                   'mingcheng':mingcheng,
                    'dizhi':dizhi
                },
                success:function(data)
                {
                    if(data == '1')
                    {
                        layer.msg("添加成功！",{
                            time:1.5*1000
                        },function(){
                            layer.closeAll();
                            parent.window.location.reload();
                        });
                    }else if(data == '3')
                    {
                        layer.msg("停车场地址重复，请重新输入！");
                    }else{
                        layer.msg("添加失败,请重试！");
                    }
                }
            })
        }
    });

    //新增停车名称
    $('#sub1').click(function(){

        var orgnum = $('#org').val();
        var orgname = $('#org').find('option:selected').text();
        var mingcheng = $('#mingcheng').val();
        var URL = $('#url').val();
        if(mingcheng == ''){
            layer.msg("请输入停车场名称！");
            return false;
        }else if(orgnum == 0){
            layer.msg("请选择部门！");
            return false;
        }else{

            $.ajax({
                url:URL+'admin/c_parking/parking_add_ins1',
                type:'post',
                data:{
                    'mingcheng':mingcheng,
                    'orgnum': orgnum,
                    'orgname': orgname
                },
                success:function(data)
                {
                    if(data == '1')
                    {
                        layer.msg("添加成功！",{
                            time:1.5*1000
                        },function(){
                            layer.closeAll();
                            parent.window.location.reload();
                        });
                    }else if(data == '3')
                    {
                        layer.msg("停车场名称重复，请重新输入");
                    }else{
                        layer.msg("添加失败");
                    }
                }
            })
        }
    })
</script>

</body>
</html>
