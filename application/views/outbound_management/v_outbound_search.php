<body class="bg-white"> 
<div class="tab" style="">
    <input type="hidden" value="<?php echo base_url();?>" id="url">
    <div class="tab-body" style="width: 95%;">
        <br>
        <div class="tab-panel active" id="tab-set" style="">
            <form id="fileForm" style="display: none;">
                <input type="file"  id="uphoto" style="display: none;" name="car_image[]" multiple>
            </form>

            <form id="fileForm" action="<?php echo base_url()?>/admin/c_outbound_management/outbound_adds">
                <button class="button button-small bg-main operate_sub" type="submit" style="float: right; margin-top: -22px;">返回</button>
            </form> 
            <br/>

            <form method="post" class="form-x" >
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">号牌号码：</label>
                    </div>
                    <div class="field">
                        <div style="height: 100px;width:90%;border: 1px solid #e1e2ef;text-align: left;" >
                            <?php if($data):?>
                                <?php foreach ($data as $row){?>
                                    <input type="radio" name="assign_class" class="assign_class" value="<?php echo $row['xh'];?>"><?php echo $row['hphm'];?>
                                <?php }?>
                            <?php else:?>
                                <span style="color:red;">入库车辆记录不存在</span>
                            <?php endif;?>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="label">
                        <label for="rolename">处置时间：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="outbound_time" name="outbound_time"  value="<?php echo date('Y-m-d H:i');?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">处置结果：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="czjg" name="czjg"  value="">
                    </div>
                </div>


                <div class="form-group">
                    <div class="label">
                        <label for="rolename">出库原因：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="" id="ckyy">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">是否强制出库：</label>
                    </div>
                    <div class="field">
                        <select class="input" id="sfqzck">
                            <option value="0">---请选择---</option>
                            <option value="1">是</option>
                            <option value="2">否</option>
                        </select>
                    </div>
                </div>
                

                <input type="hidden" id="h_file">
                <!-- <input type="hidden" id="h_file1"> -->
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
                            <?php foreach ($datas as $value): ?>
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
                <br/>
            </form>
        </div>
    </div>
</div>
<script>
    var outbound_time = {
        elem: '#outbound_time',
        format: 'YYYY-MM-DD hh:mm:ss',
        min: '2010-01-01', //最小日期
        max: '2099-12-31 23:59:59', //最大日期
        start: '2016-06-01',    //开始日期
        istime: true,
        istoday: true,
        fixed: false, //是否固定在可视区域
        zIndex: 99999999, //css z-index
        /*choose: function(datas){
            end.min = datas; //开始日选好后，重置结束日的最小日期
            end.start = datas //将结束日的初始值设定为开始日
        }*/
    };
    laydate(outbound_time);
</script>
<script>
    var URL = $("#url").val();
    $("#sub").click(function(){


        var xh = "";     //号牌号码(其实是入库信息中的xh)
        $(".assign_class:radio").each(function()
        {
            if ($(this).is(":checked")==true)
            {
                xh = $(this).val();
            }
        });

        if(xh == "")
        {
            layer.msg("请选择号牌号码！");
            return false;
        }




        
        var czsj = $("#outbound_time").val();      //处置时间
        var czjg = $("#czjg").val();               //处置结果
        var ckyy = $("#ckyy").val();               //出库原因
        var sfqzck = $("#sfqzck").val();           //是否强制出库

        if(czsj == "")
        {
            layer.msg("请选择处置时间！");
            return false;
        }

        if(czsj == "")
        {
            layer.msg("请填写处置结果！");
            return false;
        }

        if(ckyy == "")
        {
            layer.msg("请填写出库原因！");
            return false;
        }

        if(sfqzck == '0')
        {
            layer.msg("请选择是否强制出库！");
            return false;
        }


        var strs = "";    // 车辆图片
        $(".img_class").each(function(){
            if($(this).css("display")=="block")
            {
                strs = $(this).attr('id')+'+'+strs;
            }
        });

        if(strs == "")
        {
            layer.msg("请上传查处照片！");
            return false;
        }


        var str = "";   //处置人员
        $(".assign_checkbox:radio").each(function()
        {
            if ($(this).is(":checked")==true)
            {
                str= $(this).val();
            }
        });

        if(str == "")
        {
            layer.msg("请选择处置民警！");
            return false;
        }



        $.ajax({
            url:URL+'admin/c_outbound_management/outbound_save1',
            type:'post',
            data:{
                'xh':xh,
                'czsj':czsj,
                'czjg':czjg,
                'ckyy':ckyy,
                'sfqzck':sfqzck,
                'strs':strs, //查处照片
                'str':str   //处置民警
            },
            success:function(data)
            {

                if(data == '1')
                {
                    layer.msg("添加成功！",{
                        time:1000
                    },function(){
                        layer.closeAll();
                        parent.window.location.reload();
                    });
                }else
                    {
                        layer.msg('该车已出过库!');
                    }
            }
        });
    });
</script>
</body>


<script type="text/javascript">
    //上传图片
    $("#file_btn").click(function(){
        $("#uphoto").click();
        $("#uphoto").unbind('change').bind('change',function (){
            //$('#uphoto').on('change',function() {
            var fileData = new FormData(document.getElementById("fileForm"));
            $.ajax({
                url:URL+'admin/c_inbound_management/imageupload',
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
                                $("#img_div").html($("#img_div").html()+"<div style='width: 98px;float:left;height: 98px;'><img class='img_class' id='"+'assets/uploads/inbound_car_image/'+arr1[i] +"'"  +"  style='width: 80px;margin-top:5%;margin-left:5%;float:left;height: 80px;' src='"+URL+'assets/uploads/inbound_car_image/'+arr1[i]+"'><div class='delte_img' style='width:12px;cursor:pointer;float:right;border:1px solid white;height:12px;text-align:center;line-height:10px;color:white;background-color:red;font-weight:400;z-index: 100;border-radius: 50%;'>x️</div></div>");
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