<body class="bg-white">
<div class="tab" style="">
    <input type="hidden" value="<?php echo base_url();?>" id="url">
    <div class="tab-body" style="width: 95%;">
        <br>
        <div class="tab-panel active" id="tab-set" style="">
            <form id="fileForm" style="display: none;">
                <input type="file"  id="uphoto" style="display: none;" name="car_image[]" multiple>
            </form>
            <form method="post" class="form-x" method="post" target="_parent">
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">号牌号码：</label>
                    </div>
                    <div class="field">
                        <input type="hidden" value="<?php echo $datas[0]['id'];?>" id="h_id">
                        <input type="text" class="input" disabled  value="<?php echo $datas[0]['hphm'];?>" id="hphm">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">号码种类：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" disabled   value="<?php echo $datas[0]['hpzl'];?>" id="hpzl">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">业务类型：</label>
                    </div>
                    <div class="field">
                        <select class="input" id="ywlx" disabled>
                            <option value="0">---请选择---</option>
                            <?php foreach ($data1 as $row){ if($row != ""){?>
                                <option value="<?php echo $row['id'];?>" <?php if($row['id'] == $datas[0]['ywlx']){ echo 'selected';}?>><?php echo $row['task_name'];?></option>
                            <?php }?>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">是否查处：</label>
                    </div>
                    <div class="field">
                        <select class="input" id="sfch">
                            <option value="0">---请选择---</option>
                            <option value="1" <?php if($datas[0]['sfch']== '1'){ echo "selected";}?>>是</option>
                            <option value="2" <?php if($datas[0]['sfch']== '2'){ echo "selected";}?>>否</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" style="display: none;" id="wfcyy_div">
                    <div class="label">
                        <label for="rolename">未查处原因：</label>
                    </div>
                    <div class="field">
                        <textarea class="input" id="wfcyy" style="height: 100px;width:90%;min-width: 90%;max-width: 90%;min-height: 100px;"><?php echo $datas[0]['wfcyy'];?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">部门代码：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"  disabled value="<?php echo $datas[0]['bmdm'];?>" id="orgnum">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">部门名称：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"  disabled value="<?php echo $datas[0]['bmmc'];?>" id="orgname">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">当事人：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="<?php echo $datas[0]['dsr'];?>" id="dsr">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">身份证号：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="<?php echo $datas[0]['sfzmhm'];?>" id="sfzh">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">处置民警：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" disabled   value="<?php echo $datas[0]['czr'];?>" id="sfzh">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">警员编号：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" disabled   value="<?php echo $datas[0]['jybh'];?>" id="sfzh">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">处置时间：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="czsj" name="czsj"  value="<?php echo $datas[0]['czsj'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">处置结果：</label>
                    </div>
                    <div class="field">
                        <textarea id="czjg" class="input" style="height: 100px;width:90%;min-width: 90%;max-width: 90%;min-height: 100px;"><?php echo $datas[0]['czjg'];?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">是否有效：</label>
                    </div>
                    <div class="field">
                        <select class="input" id="sfyx">
                            <option value="0">---请选择---</option>
                            <option value="1" <?php if($datas[0]['sfyx'] == '1'){ echo "selected";}?>>是</option>
                            <option value="2" <?php if($datas[0]['sfyx'] == '2'){ echo "selected";}?>>否</option>
                        </select> 
                    </div>
                </div>
                <input type="hidden" id="h_file">
                <input type="hidden" id="h_file1"> 
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">查处照片：</label>
                    </div>
                    <div class="field">
                        <div style="height: 100px;width:90%;border: 1px solid #e1e2ef;" id="img_div">

                            <?php 
                                $pic_str = $datas[0]['pic'];
                                $pic_arr = explode('+',$pic_str);
                            ?>

                            <?php if($pic_arr[0]):?>
                                <?php foreach($pic_arr as $value):?>
                                    <div style='width: 98px;float:left;height: 98px;'>
                                        <img class='img_class' id="<?php echo $value;?>"   style='width: 80px;margin-top:5%;margin-left:5%;float:left;height: 80px;' src="<?php echo base_url().$value;?>">
                                        <div class='delte_img'   style='width:12px;cursor:pointer;float:right;border:1px solid white;height:12px;text-align:center;line-height:10px;color:white;background-color:red;font-weight:400;z-index: 100;border-radius: 50%;'>x️</div>
                                    </div>
                                <?php endforeach;?>
                            <?php endif;?>

                        </div>

                        <button id="file_btn" class="button button-small bg-main operate_sub" type="button">上传</button>
                    </div>
                </div>
              <!--  <div class="form-group">
                    <div class="label">
                        <label for="rolename">处置民警：</label>
                    </div>
                    <div class="field">
                        <table class="table table-bordered table-hover" style="width: 90%;">
                            <thead>
                            <tr>
                                <th nowrap="nowrap" width="7%"></th>
                                <th nowrap="nowrap">警员编号</th>
                                <th nowrap="nowrap">真实姓名</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php /*foreach ($data as $value): */?>
                                <tr class="tr_class">
                                    <td><input class="assign_checkbox" <?php /*if($value['accounts'] == $datas[0]['jybh']){ echo "checked";}*/?>  name="dldm[]" type="radio" value="<?php /*echo $value['accounts'].'::'.$value['realname'];*/?>"></td>
                                    <td><?php /*echo $value['accounts'];*/?></td>
                                    <td><?php /*echo $value['realname'];*/?></td>
                                </tr>
                            <?php /*endforeach; */?>
                            </tbody>
                        </table>
                    </div>
                </div>-->

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
<script>
    var czsj = {
        elem: '#czsj',
        format: 'YYYY-MM-DD hh:mm:ss',
        min: '2010-01-01', //最小日期
        max: '2099-12-31 23:59:59', //最大日期
        start: '2016-06-01',    //开始日期
        istime: true,
        istoday: true,
        fixed: false, //是否固定在可视区域
        zIndex: 99999999, //css z-index
        choose: function(datas){
            end.min = datas; //开始日选好后，重置结束日的最小日期
            end.start = datas //将结束日的初始值设定为开始日
        }
    };
    var end = {
        elem: '#endTime',
        format: 'YYYY-MM-DD hh:mm:ss',
        min: '2010-01-01', //最小日期
        max: '2099-12-31 23:59:59', //最大日期
        istime: true,
        istoday: true,
        fixed: false, //是否固定在可视区域
        zIndex: 99999999, //css z-index
        choose: function(datas){
            start.max = datas; //结束日选好后，重置开始日的最大日期
        }
    };
    laydate(czsj);
    //laydate(end);
</script>
<script type="text/javascript">
    var URL =$("#url").val();
    //如果是未查处,让未查处的文本域显示
    $("#sfch").change(function(){
        var value = $(this).val();
        if(value =='2')
        {
            $("#wfcyy_div").css('display','block');
        }else
        {
            $("#wfcyy_div").css('display','none');
        }
    });
    $("#sfzh").blur(function(){
        var vals = $(this).val();
        var result = verifyCode(vals);
        //alert(result);
        if(result == false)
        {
            layer.msg("请填写正确的身份证号码！");
            $("#sfzh").focus();
            return false;
        }
    });
    //删除图片
    $(".delte_img").click(function(){
        $(this).parent().css('display','none');
        $(this).siblings().css('display','none');
        $(this).css('display','none');
    });
    $("#sub").click(function () {
        // 车辆图片
        var strs = "";
        $(".img_class").each(function(){
            if($(this).css("display")=="block")
            {
                strs = $(this).attr('id')+'+'+strs;
            }
        });
        //提交保存
        var id = $("#h_id").val();
        var hphm = $("#hphm").val();           //号牌号码
        var hpzl = $("#hpzl").val();           //号码种类
        var ywlx = $("#ywlx").val();           //业务类型
        var sfch = $("#sfch").val();           //是否查处
        var wfcyy = $("#wfcyy").val();        //未查处原因
        var dsr = $("#dsr").val();             //当事人
        var sfzh = $("#sfzh").val();           //身份证号
        var czsj = $("#czsj").val();           //处置时间
        var czjg = $("#czjg").val();          //处置结果
        var sfyx = $("#sfyx").val();           //是否有效
        var orgnum = $("#orgnum").val();       //部门编码
        var orgname = $("#orgname").val();     //部门名称
        var image_name = strs;                 //车辆图片
        //验证
        if(hphm == "")
        {
            layer.msg("请填写号牌号码！");
            $("#hphm").focus();
            return false;
        }
        if(hpzl == "")
        {
            layer.msg("请填写号牌种类！");
            $("#hpzl").focus();
            return false;
        }
        if(ywlx == "0")
        {
            layer.msg("请选择业务类型！");
            return false;
        }
        if(sfch == "0")
        {
            layer.msg("请选择是否查处！");
            return false;
        }
        if(sfch == "2")
        {
            if(wfcyy == "")
            {
                layer.msg("请填写未查处原因！");
                $("#wfcyy").focus();
                return false;
            }
        }
        if(dsr == "")
        {
            layer.msg("请填写当事人！");
            $("#dsr").focus();
            return false;
        }
        if(sfzh == "")
        {
            layer.msg("请填写身份证号码！");
            $("#sfzh").focus();
            return false;
        }
        if(sfzh.length != 18){
            layer.msg("请填写18位身份证号码！");
            $("#sfzh").focus();
            return false;
        }
        if(czsj == "")
        {
            layer.msg("请填写处置时间！");
            $("#czsj").focus();
            return false;
        }
        if(czjg == "")
        {
            layer.msg("请填写处置结果！");
            $("#czjg").focus();
            return false;
        }
        if(sfyx == '0')
        {
            layer.msg('请选择是否有效！');
            return false;
        }
        if(image_name == "")
        {
            layer.msg("请上传查处图片！");
            return false;
        }

       /* var str = "";
        $(".assign_checkbox:radio").each(function()
        {
            if ($(this).is(":checked")==true)
            {
                str = $(this).val();
            }
        });
        //获取选中的警员编号
        if(str == "")
        {
            layer.msg("请选择要分配的警员！");
            return false;
        }*/
        $.ajax({
            url:URL+'admin/c_task_assessment/assessment_edit_pro',
            type:'post',
            data:{
                'id'  : id,
                'hphm': hphm,
                'hpzl': hpzl,
                'ywlx': ywlx,
                'sfch':sfch,
                'wfcyy':wfcyy,
                'dsr':dsr,
                'sfzh':sfzh,
                'czsj':czsj,
                'czjg':czjg,
                'sfyx':sfyx,
                'bmdm':orgnum,
                'bmmc':orgname,
                'imgge_name':image_name
               // 'str':str
            },
            success:function(data)
            {

                if(data == '1')
                {
                    layer.msg("修改成功！",{
                        time:1000
                    },function(){
                        layer.closeAll();
                        parent.window.location.reload();
                    });
                }else
                {
                    layer.msg("修改失败,请重试！");
                }
            }
        });

    });

    //上传图片
    $("#file_btn").click(function(){
        $("#uphoto").click();
        $("#uphoto").unbind('change').bind('change',function (){
            //$('#uphoto').on('change',function() {
            var fileData = new FormData(document.getElementById("fileForm"));
            $.ajax({
                url:URL+'admin/c_task_assessment/imageupload',
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
                                $("#img_div").html($("#img_div").html()+"<div style='width: 98px;float:left;height: 98px;'><img class='img_class' id='"+'assets/uploads/task_assessment_image/'+arr1[i] +"'"  +"  style='width: 80px;margin-top:5%;margin-left:5%;float:left;height: 80px;' src='"+URL+'assets/uploads/task_assessment_image/'+arr1[i]+"'><div class='delte_img' style='width:12px;cursor:pointer;float:right;border:1px solid white;height:12px;text-align:center;line-height:10px;color:white;background-color:red;font-weight:400;z-index: 100;border-radius: 50%;'>x️</div></div>");
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
    //验证身份证准确性的方法
    function verifyCode(code)
    {
        var arr = [7,9,10,5,8,4,2,1,6,3,7,9,10,5,8,4,2];    //算法需要用到的数组
        var sum = 0;
        for(var i = 0;i<arr.length;i++)
        {
            sum += parseInt(code.charAt(i)) * arr[i];
        }
        //用加起来的和除以11 求的余数
        var c = sum%11;
        var ch = ['1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'];
        var last_code = ch[c];     //通过计算出来的最后一位
        //所填值的最后一位
        var last = code.charAt(17);
        last = last=='x' ? 'X': last;
        return last == last_code;        //是否相等

    }
</script>

</body>
</html>
