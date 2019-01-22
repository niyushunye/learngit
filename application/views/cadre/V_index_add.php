<body class="bg-white">
<div class="tab" style="">
    <div class="tab-body" style="width: 95%;">
        <br>
        <div class="tab-panel active" id="tab-set" style="">
            <form class="form-x" method="post" target="_parent" action="<?php echo base_url()?>admin/c_cadre/ins">

                <div class="form-group">
                    <div class="label">
                        <label for="accounts">行政区划名称：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" readonly value="<?php echo $name?>" id="dept_name" name="dept_name" maxlength="10">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="accounts">行政区划编码：</label>
                    </div>
                    <div class="field">

                        <input type="text" class="input" value="<?php echo $number?>" readonly name="dept_number" id="dept_number">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="realname">人员名称：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="name" name="name" maxlength="10">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="re_password">职务：</label>
                    </div>
                    <div class="field">
                        <select class="input" name="position" id="zhuwu">
                            <option value="0">--请选择--</option>
                            <option value ="1" >安全责任干部</option>
                            <option value ="2" >包村民警</option>
                            <option value ="3" >信息员</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="realname">人员编号：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="rybh" name="rybh" maxlength="6">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="idcard">职务描述：</label>
                    </div>
                    <div class="field">
                        <textarea type="text" style=" resize:none;" rows="3" cols="20" class="input" id="position_desc" name="position_desc" maxlength="18"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="orgnum">性别：</label>
                    </div>
                    <div>
                        <div style="float: left;padding: 7px">
                            <input type="radio" class="sex" name="sex" checked value="1">男
                            <input type="radio" class="sex" name="sex" value="2">女
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="mobile">入职时间：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" autocomplete="off" id="inbound_time" name="entry_time">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="mobile">手机号码：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="phone_number" name="phone_number" maxlength="11">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="mobile">照片：</label>
                    </div>
                    <div class="field" style="text-align: left">
                        <div class="layui-upload-list">
                            <img class="layui-upload-img" id="demo1" style="height: 100px;width: 100px">
                        </div>
                        <button type="button"  class=" button button-small" id="test">上传图片</button>
                    </div>
                </div>
                <!--隐藏的input  用来接收上传图片的路径-->
                <input type="hidden" value="" id="shangchuan" name="photo">

                <div class="form-group">
                    <div class="label">
                        <label for="mobile">联系地址：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="address" name="address" maxlength="11">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="idcard">备注：</label>
                    </div>
                    <div class="field">
                        <textarea type="text" rows="3" cols="20" class="input" style="resize:none;" id="memo" name="memo" maxlength="18"></textarea>
                    </div>
                </div>

                <div class="form-button">
                    <button class="button button-small bg-main operate_sub" type="button" style="margin-bottom: 20px" id="sub111">确定</button>
                </div>
            </form>
        </div>
    </div>
</div>
<p class="text-right text-gray"></p>
</body>
<script>
    var inbound_time = {
        elem: '#inbound_time',
        format: 'YYYY-MM-DD hh:mm:ss',
        min: '2010-01-01', //最小日期
        max: '2099-12-31 23:59:59', //最大日期
        istime: true,
        istoday: true,
        fixed: false, //是否固定在可视区域
        zIndex: 99999999, //css z-index
        choose: function(datas){
            end.min = datas; //开始日选好后，重置结束日的最小日期
            end.start = datas //将结束日的初始值设定为开始日
        }
    };
    laydate(inbound_time);
</script>

<script>
    layui.use('upload', function(){
        var $ = layui.jquery
            ,upload = layui.upload;
        //普通图片上传
        var uploadInst = upload.render({
            elem: '#test'
            ,url: '<?php echo base_url()?>admin/c_cadre/up_img'
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#demo1').attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res){
                if(res.code == 0){
                    var lj =  res.data.src;
                    $('#shangchuan').val(lj);
                    return layer.msg('上传成功');
                }
            }
            ,error: function(){
                //演示失败状态，并实现重传
                var demoText = $('#demoText');
                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function(){
                    uploadInst.upload();
                });
            }
        });
    });
</script>
<script>

</script>
<script>

//判断包村民警 人员编号 是否合法
    $('#rybh').blur(function(){
        var rybh = $(this).val();
        var zhuwu =$('#zhuwu').val();  //职务
        if(zhuwu == 2){
                $.ajax({
                    url:'<?php echo base_url();?>admin/c_cadre/rybh',
                    type:'post',
                    data:{
                        'rybh': rybh
                    },
                    success:function(data)
                    {
                        console.log(data);
                        if(data == 2)
                        {
                            layer.msg("人员编号不合法，请重新输入！");
                            return false;
                        }else if(data ==3){
                            layer.msg('人员编号重复，请重新输入');
                            return false;
                        }
                    }
                });
        }
    });
//    判断数据是否合法
    $('#sub111').click(function(){
        var dept_name = $('#dept_name').val();
        var dept_number = $('#dept_number').val();
        var sex =$('input[name="sex"]:checked').val();   //状态

        var name = $('#name').val();  //安全干部名称
        var rybh = $('#rybh').val();
        var zhuwu =$('#zhuwu').val();  //职务
        var position_desc = $('#position_desc').val();  // 职务描述

        var entry_time = $("#inbound_time").val();   //入职时间

        var phone_number = $("#phone_number ").val();   //手机号码

        var shangchuan = $('#shangchuan').val();    //安全干部照片
        var address = $('#address').val();    //联系地址
        var memo = $('#memo').val();    //备注
        if(name == ''){
            layer.msg('请输入名称',{time:1000});
            return false;
        }else if(zhuwu == '0'){
            layer.msg('请选择职务',{time:1000});
            return false;
        }else if(position_desc == ''){
            layer.msg('请填写职务描述',{time:1000});
            return false;
        }else if(entry_time == ''){
            layer.msg('请选择时间',{time:1000});
            return false;
        }else if(phone_number.length != '11'){
            layer.msg('请填写正确的手机号',{time:1000});
            return false;
        }else {
            $.ajax({
                url:'<?php echo base_url();?>admin/c_cadre/ins',
                type:'post',
                data:{
                    'rybh':rybh,
                    'dept_name': dept_name,
                    'dept_number': dept_number,
                    'sex': sex,
                    'name': name,
                    'zhuwu': zhuwu,
                    'position_desc':position_desc,
                    'entry_time':entry_time,
                    'phone_number':phone_number,
                    'shangchuan':shangchuan,
                    'address':address,
                    'memo':memo
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
                    }else if(data == 3)
                    {
                        layer.msg("人员编号重复，请重新输入",{time:2000});
                    }else{
                        layer.msg("添加失败，请重新输入",{time:2000});
                    }
                }
            });
        }
    })

</script>