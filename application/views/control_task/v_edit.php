<body class="bg-white">
<div class="tab" style="">
    <input type="hidden" value="<?php echo base_url();?>" id="url">
    <div class="tab-body" style="width: 95%;">
        <br>
        <div class="tab-panel active" id="tab-set" style="">
            <input type="hidden" id="h_id" value="<?php echo $data['0']['id'];?>">
            <form method="post" class="form-x" method="post" target="_parent">
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">违法代码：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="tasknumber" name="tasknumber" value="<?php echo $data[0]['number'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">代码分值：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="score" name="score" maxlength="2" value="<?php echo $data[0]['score'];?>" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-]+/,'');}).call(this)" onblur="this.v();">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">违法内容：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="taskname" name="taskname" value="<?php echo $data[0]['name'];?>">
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
<script>
    var URL=$("#url").val();
    $("#sub").click(function(){
        var id = $("#h_id").val();
        var tasknumber = $("#tasknumber").val();       //违法代码
        var taskname = $("#taskname").val();           //任务名称
        var score = $('#score').val();          //代码分值
        if(tasknumber == "")
        {
            layer.msg("请输入任务编号！");
            $("#tasknumber").focus();
            return false;
        }

        if(score == ''){
            layer.msg('请输入代码分值');
            $('#score').focus();
            return false;
        }
        if(taskname == "")
        {
            layer.msg("请输入任务名称！");
            $("#taskname").focus();
            return false;
        }else
        {
            $.ajax({
                url:URL+'admin/c_control_task/edit_pro',
                type:'post',
                data:{'id':id,'taskname':taskname,'tasknumber':tasknumber,'score':score},
                success:function(data)
                {
                    if(data == '1')
                    {
                        layer.msg('修改成功！',{
                            time:1.5*1000
                        },function(){
                            layer.closeAll();
                            parent.window.location.reload();
                        });
                    }else
                    {
                        layer.msg("修改失败！");
                    }
                }
            });
        }
    });
</script>
</body>