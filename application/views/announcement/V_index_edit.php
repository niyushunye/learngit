<link href="<?php echo base_url();?>assets/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>assets/summ/dist/summernote-lite.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/summ/dist/summernote-bs4.css">
<body class="bg-white">
<div class="tab" style="">
    <input type="hidden" value="<?php echo base_url();?>" id="url">
    <div class="tab-body" style="width: 95%;">
        <br>
        <div class="tab-panel active" id="tab-set" style="">
            <form method="post" class="form-x">
                <div class="form-group">
                    <div class="label" style="color:#0C0C0C">
                        <label for="rolename">通知标题：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"  value="<?php echo $subject?>" id="subject">
                    </div>
                </div>

                <input type="hidden" id="hidden" value="<?php echo $id?>">
                <div class="form-group">
                    <div class="label" style="color:#0C0C0C">
                        <label for="rolename">通知内容：</label>
                    </div>
                    <div class="field">
                        <div id="summernote"><?php echo $content?></div>
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
</body>
<script src="<?php echo base_url();?>assets/js/jquery.min.js?v=2.1.4"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js?v=3.3.6"></script>
<script src="<?php echo base_url();?>assets/summ/dist/summernote.min.js"></script>
<script src="<?php echo base_url();?>assets/summ/dist/lang/summernote-zh-CN.min.js"></script>
<script>
    $(document).ready(function() {                   //实例化编辑器
        $('#summernote').summernote({
            height: 150,                    //编辑器高
            minHeight: 100,                 //最小高度
            maxHeight: 200,                //最大高度
            lang:'zh-CN',                   //设置语言
            focus: true,
            //调用图片上传
            callbacks: {                    //图片上传方法重写
                onImageUpload: function (files) {
                    sendFile(files[0]);
                }
            }
        });
        //ajax上传图片
        function sendFile(file) {              //图片上传方法
            var formData = new FormData();
            formData.append("file", file);
            $.ajax({
                url: "<?php echo base_url();?>admin/c_announcement/upload",//路径是你控制器中上传图片的方法，
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (data){
                    if(data == 2){
                        alert('上传失败');
                    }else{
                        $('#summernote').summernote('insertImage', data, function ($image) {
                            $image.attr('src', data);
                        });
                    }
                }
            });
        }
    });
</script>
<script type="text/javascript">

    $('.operate_sub').click(function (){
        var content = $('#summernote').summernote('code');
        var subject =  $('#subject').val();
        var id = $('#hidden').val();
        if(content == '<p><br></p>'){
            layer.msg("请填写通告内容！",{time:1000});
        }else if(subject == ''){
            layer.msg('请填写标题！',{time:1000});
        }else{
            $.ajax({
                url:'<?php echo base_url()?>admin/c_announcement/edit_update',
                type:'post',
                data:{ 'subject':subject,'content':content,'id':id},
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
                    }else
                    {
                        layer.msg("添加失败,请重试！");
                    }
                }
            });
        }
    });
</script>

</body>
</html>
