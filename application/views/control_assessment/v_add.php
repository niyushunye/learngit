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
                        <input type="text" class="input"  value="" id="hphm">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">号码种类：</label>
                    </div>
                    <div class="field">
                        <select class="input" id="hmzl">
                            <option value="0">---请选择---</option>
                            <?php foreach ($data1 as $v){?>
                                <option value="<?php echo $v['DMZ'];?>"><?php echo $v['DMSM1'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <div class="label">
                        <label for="rolename">违法代码：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"  value="" id="rwlx">
                    </div>
                </div>

                <!-- <div class="form-group">
                    <div class="label">
                        <label for="rolename">违法类型：</label>
                    </div>
                    <div class="field">
                        <select class="input" id="rwlx">
                            <option value="0">---请选择---</option>
                            <?php foreach ($datas as $row){?>
                                <option value="<?php echo $row['number'];?>"><?php echo $row['name'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div> -->

                
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">业务种类：</label>
                    </div>
                    <div class="field">
                        <select class="input" id="ywzl">
                            <option value="0">---请选择----</option>
                            <option value="1">非现场</option>
                            <option value="2">简易程序</option>
                            <option value="3">强制措施</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" style="display: none;" id="bh_type">
                    <div class="label">
                        <label for="rolename">非现场编号：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" name="bh"  value="" id="bh">
                    </div>
                </div>
                <!-- <div class="form-group">
                    <div class="label">
                        <label for="rolename">强制措施编号：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="" id="pzbh">
                    </div>
                </div> -->
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">处置时间：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="<?php echo date('Y-m-d H:i:s',time());?>" id="czsj">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">处置结果：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="" id="czjg">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">是否有效：</label>
                    </div>
                    <div class="field">
                        <select class="input" id="sfyx">
                            <option value="0" selected="">否</option>
                            <option value="1">是</option>
                        </select>
                    </div> 
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">部门代码：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"  disabled value="<?php echo $data2['orgnum']?>" id="orgnum">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">部门名称：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"  disabled value="<?php echo $data2['orgname']?>" id="orgname">
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
                        </div>
                        <button id="file_btn" class="button button-small bg-main operate_sub" type="button">上传</button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">处置民警：</label>
                    </div>
                    <div class="field">
                        <table class="table table-bordered table-hover"style="width: 90%;">
                            <thead>
                            <tr>
                                <th nowrap="nowrap" width="7%"><!--<input type="checkbox" id = "allchoose">--></th>
                                <th nowrap="nowrap">警员编号</th>
                                <th nowrap="nowrap">真实姓名</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($data as $value): ?>
                                <tr class="tr_class">
                                    <td><input class="assign_checkbox"  name="dldm[]" type="radio" value="<?php echo $value['accounts'].'::'.$value['realname'];?>"></td>
                                    <td><?php echo $value['accounts'];?></td>
                                    <td><?php echo $value['realname'];?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
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
</body>
<script>
    var czsj = {
        elem: '#czsj',
        format: 'YYYY-MM-DD hh:mm:ss',
        min: '2010-01-01', //最小日期
        max: '2099-12-31 23:59:59', //最大日期
        start: "<?php echo date('Y-m-d',time());?>",    //开始日期
        istime: true,
        istoday: true,
        fixed: false, //是否固定在可视区域
        zIndex: 99999999, //css z-index
        choose: function(datas){
            end.min = datas; //开始日选好后，重置结束日的最小日期
            end.start = datas //将结束日的初始值设定为开始日
        }
    };
    /*var end = {
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
    };*/
    laydate(czsj);
    //laydate(end);
</script>
<script type="text/javascript">
    var URL =$("#url").val();
    //非现场编号
    $("#ywzl").change(function(){
        var val = $(this).val();

        if(val == '1'){
            $("#bh_type").css('display','block');
            $("#bh_type label").html('非现场编号：');
        }else if(val == '2'){
            $("#bh_type").css('display','block');
            $("#bh_type label").html('决定书编号：');
        }else if(val == '3'){
            $("#bh_type").css('display','block');
            $("#bh_type label").html('凭证编号：');
        }else{
            $("#bh_type").css('display','none');
        }
    });


    $("#sub").click(function () {

         //处置人
        var str = "";
        $(".assign_checkbox:radio").each(function()
        {
            if ($(this).is(":checked")==true)
            {
                str = $(this).val();               
            }
        });

        // 车辆图片
        var strs = "";
        $(".img_class").each(function(){
            if($(this).css("display")=="block")
            {
                strs = $(this).attr('id')+'+'+strs;
            }
        });
 

        //提交保存
        var hphm = $("#hphm").val();           //号牌号码
        var hmzl = $("#hmzl").val();           //号码种类
        var rwlx = $("#rwlx").val();           //违法代码
        var ywzl = $("#ywzl").val();           //业务类型
        var bh   = $("#bh").val();             //业务种类编号
        var czsj = $("#czsj").val();           //处置时间
        var czjg = $("#czjg").val();           //处置结果
        var sfyx = $("#sfyx").val();           //是否有效
        var bmdm = $("#orgnum").val();         //部门代码
        var bmmc = $("#orgname").val();        //部门名称
        var image_name = strs;                 //车辆图片

        if(hphm == '')
        {
            layer.msg("请填写号牌号码！");
            $("#hphm").focus();
            return false;
        }


        if(hmzl == '0')
        {
            layer.msg("请选择号牌种类！");
             $("#hmzl").focus();
             return false;
        }

        if(rwlx == '')
        {
            layer.msg("请填写违法代码！");
            $("#rwlx").focus();
            return false;
        }

        /*if(rwlx == "0")
        {
            layer.msg("请选择违法类型！");
            $("#rwlx").focus();
            return false;
        }*/

        if(ywzl == '0')
        {
            layer.msg("请选择业务种类！");
            return false;
        }

        if(bh =='')
        {
            layer.msg("请填写业务种类编号！");
            $("#bh").focus();
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

        /*if(image_name == "")
        {
            layer.msg("请上传查处照片！");
            return false;
        }*/

        if(str == "")
        {
            layer.msg("请选择要分配的警员！");
            return false;
        }

        
        $.ajax({
            url:URL+'admin/c_control_assessment/save',
            type:'post',
            data:{
                'hphm': hphm,
                'hmzl': hmzl,
                'rwlx': rwlx,
                'ywzl': ywzl,
                'bh'  : bh,
                'czsj':czsj,
                'czjg':czjg,
                'sfyx':sfyx,
                'bmdm':bmdm,
                'bmmc':bmmc,
                'imgge_name':image_name, //车辆图片
                'str':str                //处置人
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


    //上传图片
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
