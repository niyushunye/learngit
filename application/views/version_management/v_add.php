<body class="bg-white">
<div class="tab" style="">
    <input type="hidden" value="<?php echo base_url();?>" id="url">
    <div class="tab-body" style="width: 95%;">
        <br>
        <div class="tab-panel active" id="tab-set" style="">
            <form method="post" class="form-x" method="post" target="_parent" id="fileForm">
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">版本号：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="version_name" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">更新版本号：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="update" placeholder="" maxlength="3">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">版本描述：</label>
                    </div>
                    <div class="field">
                       <textarea class="input" style="height: 100px;width:90%;max-width:90%;min-width:90%;border: 1px solid #e1e2ef;" id="version_description"></textarea>
                    </div>
                </div>
                <!-- <div class="form-group">
                    <div class="label">
                        <label for="rolename">版本地址：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="version_url" >
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

    /*//上传文件
    $("#file_btn").click(function(){
        $("#uphoto").click();
        $("#uphoto").unbind('change').bind('change',function (){
            //$('#uphoto').on('change',function() {
            var fileData = new FormData(document.getElementById("fileForm"));
            $.ajax({
                url:URL+'admin/c_control_assessment/imageupload',
                type:'post',
                data:fileData,
                contentType: false,
                processData: false,
                success:function(data)
                {
                    //console.log(data);
                    if(data =='1')
                    {
                        layer.msg('请上传jpg、png、jpeg格式的图片！',{
                            time:1.5*1000
                        });
                    }
                    else if(data == '2')
                    {
                        layer.msg('请上传小于2M的图片！',{
                            time:1.5*1000
                        });
                    }
                    else
                    {


                        $("#h_file").val($("#h_file").val()+''+data);
                        var arr=data.split("+");

                        //alert(data1);
                        var arr1 = unique(arr);
                        //alert(arr1);return;
                        for(var i=0;i<arr1.length;i++)
                        {
                            if(arr1[i] != "")
                            {
                                $("#img_div").html($("#img_div").html()+"<div style='width: 98px;float:left;height: 98px;'><img class='img_class' id='"+'assets/uploads/investigation_car_image1/'+arr1[i] +"'"  +"  style='width: 80px;margin-top:5%;margin-left:5%;float:left;height: 80px;' src='"+URL+'assets/uploads/investigation_car_image1/'+arr1[i]+"'><div class='delte_img' style='width:12px;cursor:pointer;float:right;border:1px solid white;height:12px;text-align:center;line-height:10px;color:white;background-color:red;font-weight:400;z-index: 100;border-radius: 50%;'>x️</div></div>");
                            }
                        }
                    }
                    //删除图片
                    $(".delte_img").click(function(){
                        $(this).parent().css('display','none');
                        $(this).siblings().css('display','none');
                        $(this).css('display','none');
                    });

                }

            });
        });
    });
*/

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
        var version_name = $("#version_name").val();                 //版本号
        var version_description = $("#version_description").val();   //版本描述
        //var version_url = $("#version_url").val();                   //版本地址
        var version_app = $("#app").val();                          //版本app
        var update_code = $('#update').val();                       //更新版本号
        if(version_name == "")
        {
            layer.msg("请输入版本号！");
            $("#version_name").focus();
            return false;
        }
        if(version_app == "0")
        {
            layer.msg("请输入版本APP！");
            return false;
        }else if(version_app == "1"){
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
            url:URL+'admin/c_version_management/save',
            type:'post',
            data:{
                'version_name':version_name,
                'version_description':version_description,
                //'version_url':version_url,
                'version_app':version_app,
                'update_code':update_code
            },
            success:function(data)
            {
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
    });
</script>
</body>

