<body class="bg-white">
<div class="tab" style="">
    <div class="tab-body" style="width: 95%;">
        <br>
        <div class="tab-panel active" id="tab-set" style="">
            <form  class="form-x" method="post" target="_parent">
                <div class="form-group">
                    <div class="label">
                        <label for="realname">名称：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="name" name="name" maxlength="10">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="accounts">上级名称：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" readonly value="<?php echo $name?>" id="parent_name" name="parent_name" maxlength="10">
                        <input type="hidden" value="<?php echo $number?>" name="parent_number" id="parent_number">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="re_password">类型：</label>
                    </div>
                    <div class="field">
                        <select class="input" name="type" id="leixing">
                            <?php if($type == 3){?>
                            <option value ="1" disabled>省级</option>
                            <option value ="2" disabled>地市级</option>
                            <option value ="3" disabled>区县级</option>
                            <option value ="4">乡镇级</option>
                            <option value ="5">行政村级</option>
                            <option value ="6">组社级</option>
                            <?php }else if($type == 4){?>
                                <option value ="1" disabled>省级</option>
                                <option value ="2" disabled>地市级</option>
                                <option value ="3" disabled>区县级</option>
                                <option value ="4" disabled>乡镇级</option>
                                <option value ="5">行政村级</option>
                                <option value ="6">组社级</option>
                            <?php }?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="orgnum">状态：</label>
                    </div>
                    <div>
                        <div style="float: left;padding: 7px">
                            <input type="radio" class="zhaung" name="status" checked value="1">已开通
                            <input type="radio" class="zhaung" name="status" value="2">未开通
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="mobile">编码：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="number" name="number" maxlength="12">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="idcard">备注：</label>
                    </div>
                    <div class="field">
                        <textarea type="text" rows="3" cols="20" class="input" id="memo" name="memo" maxlength="18"></textarea>
                    </div>
                </div>

                <div class="form-button">
                    <button class="button button-small bg-main operate_sub" type="button" id="sub" style="margin-right: 100px">确定</button>
                </div>
            </form>
        </div>
    </div>
</div>
<p class="text-right text-gray"></p>
</body>
<script>

    $('#sub').click(function(){

        var name = $('#name').val();  //名称
        var number =$('#number').val();  //编码
        var memo = $('#memo').val();  // 备注
        var parent_name = $("#parent_name").val();   //上级名称
        var parent_number = $("#parent_number ").val();   //上级编码
        var type = $('#leixing').val();   //类型
        var status =$('input[name="status"]:checked').val();   //状态

        if(name == ''){
            layer.msg('名称不能为空',{time:1000});
            return false;
        }else if(number == ''){
            layer.msg('编码不能为空',{time:1000});
            return false;
        }else if(isNaN(number)){
            layer.msg('编码只能为数字',{time:1000});
            return false;
        }else{
            $.ajax({
                url:'<?php echo base_url();?>admin/c_xingzhengqh/add_save',
                type:'post',
                data:{
                    'name': name,
                    'number': number,
                    'memo': memo,
                    'parent_name': parent_name,
                    'parent_number'  : parent_number,
                    'status':status,
                    'type':type
                },
                success:function(data)
                {

                    if(data == '1')
                    {
                        layer.msg("添加成功！",{
                            time:1.5*1000
                        },function(){
                            window.parent.parent.location.href='<?php echo base_url();?>admin/c_xingzhengqh';
                        });
                    } else if(data == 3){
                        layer.msg("编码重复请重新输入！");
                    }else
                    {
                        layer.msg("添加失败,请重试！");
                    }
                }
            });
        }
    })

</script>