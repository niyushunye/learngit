<link href="<?php echo base_url();?>assets/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>assets/summ/dist/summernote-lite.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/summ/dist/summernote-bs4.css">
<style>
    .add{
        display:none;
    }
    .dianji:hover{
        cursor:pointer;
    }
</style>
<body class="bg-white">
<div class="tab" style="">
    <input type="hidden" value="<?php echo base_url();?>" id="url">
    <div class="tab-body" style="width: 95%;">
        <br>
        <div class="tab-panel active" id="tab-set" style="">
            <form method="post" class="form-x">
                <div class="form-group">
                    <div class="label" style="color:#0C0C0C">
                        <label for="rolename">任务标题：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input title"  value="" id="title ">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label" style="color:#0C0C0C">
                        <label for="rolename">任务内容：</label>
                    </div>
                    <div class="field">
                        <div id="summernote"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label" style="color:#0C0C0C">
                        <label for="rolename">下发部门：</label>
                    </div>
                    <div class="field">
                        <?php foreach ($data as $k => $v){?>
                            <span class="glyphicon glyphicon-plus ziti<?php echo $v['orgnum']?>"></span>
                            <span class="glyphicon glyphicon-minus ziti1<?php echo $v['orgnum']?>" style="display:none"></span>
                            <input type="checkbox" name="vehicle" class="fuxuan" ass="1" value="<?php echo $v['orgnum']?>"> &nbsp;<span class="dianji" srr="<?php echo $v['orgnum']?>"><?php echo $v['orgname']?></span><br>
                            <div class="jwry<?php echo $v['orgnum']?> add">
                                <?php foreach ($v['jwry'] as $k2 => $v2){?>
                                    <label style="padding-left: 20px">
                                        <input type="checkbox" class="i-checks vote<?php echo $v['orgnum']?> vote" value="<?php echo $v2['accounts']?>" name="receive_account[]">
                                        <?php echo $v2['realname']?>
                                    </label>
                                <?php }?>
                            </div>
                        <?php }?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label" style="color:#0C0C0C">
                        <label for="rolename">任务分类：</label>
                    </div>
                    <div class="field">
                        <select class="input work_type" id="work_type ">
                            <option value="0">---请选择---</option>
                            <option value="1">日常</option>
                            <option value="2">党建</option>
                            <option value="3">法制</option>
                            <option value="4">宣传</option>
                            <option value="5">指挥中心</option>
                            <option value="99">其他</option>
                        </select>
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
            height: 200,                    //编辑器高
            // minHeight: 150,                 //最小高度
            // maxHeight: 250,                 //最大高度
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
        var content = $('#summernote').summernote('code');   //任务内容
        var title =  $('.title').val();          //任务标题
        var task_orginfo = $('#task_orginfo').val();   //下发部门
        var work_type = $('.work_type').val();     //任务类型

        var vote = [];
        for (var i = 0; i < $(".vote").length; i++) {
            if ($(".vote").eq(i).prop("checked")) {
                vote.push($(".vote").eq(i).val())
            }
        }
        if(title == ''){
            layer.msg("请填写任务标题！",{time:1000});
        }else if(task_orginfo == 0){
            layer.msg("请选择部门！",{time:1000});
        }else if(work_type == 0){
            layer.msg("请选择任务类型！",{time:1000});
        }else if(content == '<p><br></p>'){
            layer.msg("请填写通告内容！",{time:1000});
        }else if(vote == ''){
            layer.msg('请选择警务人员',{time:1000});
        }else{
            $.ajax({
                url:'<?php echo base_url()?>admin/c_issued/add_save',
                type:'post',
                data:{ 'title':title,'content':content,'task_orginfo':task_orginfo,'work_type':work_type,'vote':vote},
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
<script>
    $('.dianji').click(function(){
        var a = $(this).attr('srr');
        $('.ziti'+a).toggle('ziti1'+a);
        $('.ziti1'+a).toggle('ziti'+a);
        $(".jwry" +a).toggle();
    });

    $('.fuxuan').click(function (){
        var a = $(this).val();
        var b = $(this).attr('ass');

        if(b == 1){
            $(this).attr('ass','2');
            $('.vote'+a).prop('checked','checked')
        }else{
            $(this).attr('ass','1');
            $('.vote'+a).removeAttr('checked');
        }
    });

</script>
</body>
</html>
