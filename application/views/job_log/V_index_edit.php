
<link rel="stylesheet" href="<?php echo base_url();?>public/zTree/css/zTreeStyle/zTreeStyle.css">

<script src="<?php echo base_url();?>public/zTree/js/jquery.ztree.core.js"></script>
<script src="<?php echo base_url();?>public/zTree/js/jquery.ztree.excheck.js"></script>

<body class="bg-white">
<div class="tab" style="">
    <input type="hidden" value="<?php echo base_url();?>" id="url">
    <div class="tab-body" style="width: 95%;">
        <form id="fileForm" style="display: none;">
            <input type="file"  id="uphoto" style="display: none;" name="car_image[]" multiple>
        </form>
        <br>
        <div class="tab-panel active" id="tab-set" style="">
            <form method="post" class="form-x" method="post" target="_parent">
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">工作完成情况：</label>
                    </div>
                    <div class="field">
                        <textarea class="input" style="height: 100px;width:90%;max-width:90%;min-width:90%;border: 1px solid #e1e2ef;" id="work_completion"><?php echo $work_completion?></textarea>
                    </div>
                </div>
                <input type="hidden" class="id" value="<?php echo $id?>">
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">工作失误情况：</label>
                    </div>
                    <div class="field">
                        <textarea class="input" style="height: 100px;width:90%;max-width:90%;min-width:90%;border: 1px solid #e1e2ef;" id="work_fault"><?php echo $work_fault?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">学习培训情况：</label>
                    </div>
                    <div class="field">
                        <textarea class="input" style="height: 100px;width:90%;max-width:90%;min-width:90%;border: 1px solid #e1e2ef;" id="learning_progress"><?php echo $learning_progress?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">出勤情况：</label>
                    </div>
                    <div class="field">
                        <select class="input" id="attendance">
                            <option value="0" <?php if($attendance == 0){echo  'selected';}?>>正常上班</option>
                            <option value="1" <?php if($attendance == 1){echo  'selected';}?>>事假</option>
                            <option value="2" <?php if($attendance == 2){echo  'selected';}?>>病假</option>
                            <option value="3" <?php if($attendance == 3){echo  'selected';}?>>旷工</option>
                            <option value="4" <?php if($attendance == 4){echo  'selected';}?>>休假</option>
                            <option value="5" <?php if($attendance == 5){echo  'selected';}?>>迟到</option>
                            <option value="6" <?php if($attendance == 6){echo  'selected';}?>>早退</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">日志类型：</label>
                    </div>
                    <div class="field">
                        <select class="input" id="log_type">
                            <option value="1" <?php if($log_type == 1){echo  'selected';}?>>日常</option>
                            <option value="2" <?php if($log_type == 2){echo  'selected';}?>>党建</option>
                            <option value="3" <?php if($log_type == 3){echo  'selected';}?>>法制</option>
                            <option value="4" <?php if($log_type == 4){echo  'selected';}?>>宣传</option>
                            <option value="5" <?php if($log_type == 5){echo  'selected';}?>>指挥中心</option>
                            <option value="99" <?php if($log_type == 99){echo  'selected';}?>>其他</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">工作日志时间：</label>
                    </div>
                    <div class="field">
                        <input type="text" autocomplete="off" class="input" id="inbound_time" name="log_time" value="<?php echo $log_time?>">
                    </div>
                </div>

                <input type="hidden" id="h_file">
                <input type="hidden" id="h_file1">
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">图片：</label>
                    </div>
                    <div class="field">
                        <div style="height: 100px;width:90%;border: 1px solid #e1e2ef;" id="img_div">
                            <?php foreach($img as $value):?>
                                <div style='width: 98px;float:left;height: 98px;'>
                                    <img class='img_class' id="<?php echo $value;?>" style='width: 80px;margin-top:5%;margin-left:5%;float:left;height: 80px;' src="<?php echo base_url().$value;?>">
                                    <div class='delte_img'   style='width:12px;cursor:pointer;float:right;border:1px solid white;height:12px;text-align:center;line-height:10px;color:white;background-color:red;font-weight:400;z-index: 100;border-radius: 50%;'>x️</div>
                                </div>
                            <?php endforeach;?>
                        </div>
                        <button id="file_btn" class="button button-small bg-main operate_sub" type="button">上传</button>
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
    var inbound_time = {
        elem: '#inbound_time',
        format: 'YYYY-MM-DD hh:mm:ss',
        min: '2010-01-01', //最小日期
        max: '2099-12-31 23:59:59', //最大日期
        start: "<?php echo date('Y-m-d H:i:s', time());?>",    //开始日期
        istime: true,
        istoday: true,
        fixed: false, //是否固定在可视区域
        zIndex: 99999999, //css z-index
    };
    laydate(inbound_time);
</script>
<script type="text/javascript">

    $(".delte_img").click(function(){
        $(this).parent().css('display','none');
        $(this).siblings().css('display','none');
        $(this).css('display','none');
    });

    $("#sub").click(function () {
        var id = $('.id').val();
        var work_completion = $("#work_completion").val();          //工作完成情况
        var work_fault = $("#work_fault").val();          //工作失误情况
        var learning_progress = $("#learning_progress").val();          //学习培训情况
        var attendance = $("#attendance").val();          //出勤情况
        var log_type = $("#log_type").val();            //日志类型
        var inbound_time = $("#inbound_time").val();        //工作日志时间
        var strs = "";                                      //上传的图片
        $(".img_class").each(function(){
            if($(this).css("display")=="block")
            {
                strs = $(this).attr('id')+'+'+strs;
            }
        });

        if (log_type == "0") {
            layer.msg("请选择日志类型！");
            return false;
        }
        if (inbound_time == "") {
            layer.msg("请填写日志时间！");
            return false;
        }


        //提交保存
        $.ajax({
            url:'<?php echo base_url()?>admin/c_job_log/edit',
            type:'post',
            data:{
                'work_completion':work_completion,
                'work_fault':work_fault,
                'learning_progress':learning_progress,
                'attendance':attendance,
                'log_type':log_type,
                'inbound_time':inbound_time,
                'strs':strs,
                'id':id
            },
            success:function(data)
            {

                console.log(data);
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
    });
</script>
<script>
    //上传图片
    $("#file_btn").click(function(){
        var URL = "<?php echo base_url()?>";

        $("#uphoto").click();
        $("#uphoto").unbind('change').bind('change',function (){
            var fileData = new FormData(document.getElementById("fileForm"));
            $.ajax({
                url:'<?php echo base_url()?>admin/c_job_log/imageupload',
                type:'post',
                data:fileData,
                contentType: false,
                processData: false,
                success:function(data)
                {
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
                        var arr1 = unique(arr);
                        for(var i=0;i<arr1.length;i++)
                        {
                            if(arr1[i] != "")
                            {
                                $("#img_div").html($("#img_div").html()+"<div style='width: 98px;float:left;height: 98px;'><img class='img_class' id='"+'assets/uploads/assign_car_image/'+arr1[i] +"'"  +"  style='width: 80px;margin-top:5%;margin-left:5%;float:left;height: 80px;' src='"+URL+'assets/uploads/assign_car_image/'+arr1[i]+"'><div class='delte_img' style='width:12px;cursor:pointer;float:right;border:1px solid white;height:12px;text-align:center;line-height:10px;color:white;background-color:red;font-weight:400;z-index: 100;border-radius: 50%;'>x️</div></div>");
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
    //除去数组中相同的元素
    function unique(arr){
        var len = arr.length;
        var result = []
        for(var i=0;i<len;i++){
            var flag = true;
            for(var j = i;j<arr.length-1;j++){
                if(arr[i]==arr[j+1]){
                    flag = false;
                    break;
                }
            }
            if(flag){
                result.push(arr[i])
            }
        }
        return result;
    }
</script>
</body>
</html>
