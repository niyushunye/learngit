<body class="bg-white">
<div class="tab" style="">
    <input type="hidden" value="<?php echo base_url();?>" id="url">
    <div class="tab-body" style="width: 95%;">
        <br>
        <div class="tab-panel active" id="tab-set" style="">

            <form method="post" class="form-x" method="post" target="_parent">

                <!--  隐藏的input表单  用于对停车场名称的修改              -->
                <input type="hidden" value="<?php echo $parking['id']?>" id="id">
                <!--  隐藏的input表单   用于跳转的url              -->
                <input type="hidden" value="<?php echo base_url();?>" id="id">
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">部门名称：</label>
                    </div>
                    <div class="field">
                        <select class="input" id="orgnum">
                            <option value="0">---请选择---</option>
                            <?php foreach ($orginfo as $v){?>
                                <option value="<?php echo $v['orgnum'];?>" <?php if($v['orgnum'] == $parking['orgnum']){ echo 'selected';}?>><?php echo $v['orgname'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">停车场名称：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" value="<?php echo $parking['task_name']?>" id="mc">
                    </div>
                </div>
                <div class="form-button">
                    <button class="button button-small bg-main operate_sub" type="button" id="sub">确定</button>
                </div>
            </form>
        </div>
    </div>
</div>
<p class="text-right text-gray"></p>
</div>
</body>
<script type="text/javascript">

    // 修改停车场名称
    $('#sub').click(function(){
        var id = $('#id').val();              //隐藏的id
        var orgnum =  $('#orgnum').val();    //部门代码
        var mc = $('#mc').val();              //停车场的名称
        var URL = $('#url').val();          //隐藏的url
        var orgname = $('#orgnum').find('option:selected').text();  //部门名称
        if(orgnum == '0'){
            layer.msg("请输入部门名称！");
            return false;
        }else if(mc == ''){
            layer.msg("请输入停车场名称！");
            return false;
        }else{

            $.ajax({
                url:URL+'admin/c_parking/parking_mc_upload',
                type:'post',
                data:{
                    'orgname':orgname,             //部门名称
                    'orgnum':orgnum ,             //部门代码
                    'mc':mc,                      //停车名称
                    'id':id                       //隐藏的id
                },
                success:function(data)
                {
                    if(data == '1')
                    {
                        layer.msg("修改成功！",{
                            time:1.5*1000
                        },function(){
                            layer.closeAll();
                            parent.window.location.reload();
                        });
                    }else
                    {
                        layer.msg("修改失败,请重试！");
                    }
                }
            })
        }
    })
</script>

</body>
</html>
