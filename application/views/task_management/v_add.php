<body class="bg-white">
<div class="tab" style="">
    <input type="hidden" value="<?php echo base_url();?>" id="url">
    <div class="tab-body" style="width: 95%;">
        <br>
        <div class="tab-panel active" id="tab-set" style="">
            <form method="post" class="form-x" method="post" target="_parent">
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">任务名称：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="taskname" name="taskname">
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
        var taskname = $("#taskname").val();
        if(taskname == "")
        {
            layer.msg("请输入任务名称！");
            $("#taskname").focus();
            return false;
        }else
            {
                $.ajax({
                    url:URL+'admin/c_task_management/save',
                    type:'post',
                    data:{'taskname':taskname},
                    success:function(data)
                    {
                        //alert(data);
                        if(data == '1')
                        {
                            layer.msg('添加成功！',{
                                time:1.5*1000
                            },function(){
                                layer.closeAll();
                                parent.window.location.reload();
                            });
                        }else
                            {
                                layer.msg("添加失败！");
                            }
                    }
                });
            }
    });
</script>
</body>