<body class="bg-white">
<div class="tab" style="">
    <input type="hidden" value="<?php echo base_url();?>" id="url">
    <div class="tab-body" style="width: 95%;">
        <br>
        <div class="tab-panel active" id="tab-set" style="">
            <input type="hidden" value="<?php echo $data[0]['id'];?>" id="h_id">
            <form method="post" class="form-x" method="post" target="_parent">
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">规则标题：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="title" value="<?php echo $data[0]['title'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">规则内容：</label>
                    </div>
                    <div class="field">
                        <textarea class="input" style="height: 200px;width:90%;max-width:90%;min-width:90%;miborder: 1px solid #e1e2ef;" id="content"><?php echo $data[0]['content'];?></textarea>
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
        var title = $("#title").val();            //规则标题
        var content = $("#content").val();        //规则内容
        if(title == "")
        {
            layer.msg("请输入规则标题！");
            $("#title").focus();
            return false;
        }
        if(content == "")
        {
            layer.msg("请输入规则内容！");
            $("#content").focus();
            return false;
        }

        $.ajax({
            url:URL+'admin/c_rule_management/edit_pro',
            type:'post',
            data:{
                'id':id,
                'title':title,
                'content':content
            },
            success:function(data)
            {
                //alert(data);
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
    });
</script>
</body>