<body class="bg-white">
<div class="tab" style="">
    <input type="hidden" value="<?php echo base_url();?>" id="url">
    <div class="tab-body" style="width: 95%;">
        <br>
        <div class="tab-panel active" id="tab-set" style="">
            <input type="hidden" id="h_id" value="<?php echo $data[0]['id'];?>">
            <form method="post" class="form-x" method="post" target="_parent" id="fileForm">
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">版本号：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="version_name" value="<?php echo $data[0]['version_name'];?>" placeholder="版本号为整数形式(添加的新版本号要大于前一个版本号)">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">更新版本号：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="update_code" value="<?php echo $data[0]['update_code'];?>" maxlength="3">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">版本描述：</label>
                    </div>
                    <div class="field">
                        <textarea class="input" style="height: 100px;width:90%;max-width:90%;min-width:90%;border: 1px solid #e1e2ef;" id="version_description"><?php echo $data[0]['version_description'];?></textarea>
                    </div>
                </div>
                <!-- <div class="form-group">
                    <div class="label">
                        <label for="rolename">版本地址：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="version_url" value="<?php echo $data[0]['version_url'];?>" >
                    </div>
                </div> -->

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">版本文件：</label>
                    </div>
                    <div class="field">
                        <input type="file"   class="input" id="version_app" name='version_app' >
                        <input type="hidden" class="input" id="app">
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


        var fileData = new FormData(document.getElementById("fileForm"));

        $.ajax({
             url:URL+'admin/c_version_management/upload',
                type:'post',
                async:false,    
                data:fileData,
                contentType: false,
                processData: false,
                success:function(data){
                    $("#app").val(data);
                }
                
        });



        var id = $("#h_id").val();
        var version_name = $("#version_name").val();                 //版本号
        var version_description = $("#version_description").val();   //版本描述
        //var version_url = $("#version_url").val();                   //版本地址
        var version_app = $("#app").val();                          //版本app
        var update_code = $('#update_code').val();                 //更新版本号
        if(version_name == "")
        {
            layer.msg("请输入版本号！");
            $("#version_name").focus();
            return false;
        }
        /*if(version_url == "")
        {
            layer.msg("请输入版本地址！");
            $("#version_url").focus();
            return false;
        }*/
//        else{
//            var reg = /^[\d]+$/g;
//            if(!reg.test(version_name)){
//                layer.msg("类型不合法!");
//                $("#version_name").focus();
//                return false;
//            }
//        }


        if(version_app == "1"){
            layer.msg("类型有误！");
            return false;
        }else if(update_code == ''){
            layer.msg("对不起请输入更新版本号",{time:1000});
            return false;
        }else if(isNaN(update_code)){
            layer.msg("请输入1-3为阿拉伯数字！",{time:1000});
            return false;
        }
        $.ajax({
            url:URL+'admin/c_version_management/edit_pro',
            type:'post',
            data:{
                'id':id,
                'version_name':version_name,
                'version_description':version_description,
                //'version_url':version_url,
                'version_app':version_app,
                'update_code':update_code
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