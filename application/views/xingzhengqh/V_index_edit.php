<body class="bg-white">
<div class="tab" style="">
    <input type="hidden" value="<?php echo base_url();?>" id="url">
    <div class="tab-body" style="width: 95%;">
        <br>
        <div class="tab-panel active" id="tab-set" style="">

            <form method="post" class="form-x" method="post" target="_parent">

                <!--   隐藏的id 用于修改行政区划信息 -->
                <input type="hidden" value="<?php echo $id?>" id="id">
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">行政区划名称：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="<?php echo $name?>" id="name" placeholder="开展交通安全管理重点工作教育活动(20分)">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">上级名称：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" readonly  value="<?php echo $parent_name?>" id="parent_name" placeholder="文明交通示范评选活动(10分)">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">类型</label>
                    </div>
                    <div class="field">
                        <select class="input" name="type" id="leixing">
                                <option value ="1" <?php if($type != 1){echo 'disabled';}?>>省级</option>
                                <option value ="2" <?php if($type != 2){echo 'disabled';}?>>地市级</option>
                                <option value ="3" >区县级</option>
                                <option value ="4" >乡镇级</option>
                                <option value ="5" >行政村级</option>
                                <option value ="6" >组社级</option>

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="orgnum">状态：</label>
                    </div>
                    <div>
                        <div style="float: left;padding: 7px">
                            <input type="radio" class="zhaung" <?php if($status == 1){ echo 'checked';}?> name="status" value="1">已开通
                            <input type="radio" class="zhaung" <?php if($status == 2){ echo 'checked';}?> name="status" value="2">未开通
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">编码：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" <?php if($number == XINGZQH){ echo 'disabled ';}?> value="<?php echo $number?>" id="number" placeholder="自媒体宣传-微信(15分)" maxlength="12">
                    </div>
                </div>

                <input type="hidden" value="<?php echo $number?>" id ="number1">

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">备注：</label>
                    </div>
                    <div class="field">
                        <textarea type="text" rows="3" cols="20" class="input" id="memo" name="memo"><?php echo $memo?></textarea>
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

    $('#sub').click(function(){
        var name = $('#name').val();   //行政区划名称
        var status =$('input[name="status"]:checked').val();   //状态
        var memo = $('#memo').val();
        var id = $('#id').val();
        var number = $('#number').val();
        var number1 = $('#number1').val();
        if(name == ''){
            layer.msg('名称不能为空',{time:1000});
            return false;
        }else if(memo == ''){
            layer.msg('备注不能空',{time:1000});
            return false;
        }
        else{
            $.ajax({
                url:'<?php echo base_url()?>admin/C_xingzhengqh/upload',
                type:'post',
                data:{
                    'number1':number1,
                    'name':name,
                    'status':status,
                    'memo':memo,
                    'id':id,
                    'number':number
                },
                success:function(data)
                {

                    if(data == '1')
                    {
                        layer.msg("编辑成功！",{
                            time:1.5*1000
                        },function(){
                            layer.closeAll();
                            parent.window.location.reload();
                        });
                    }else
                    {
                        layer.msg("编辑失败！");
                    }
                }
            });
        }
    });

</script>
</body>
</html>
