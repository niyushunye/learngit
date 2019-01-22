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
                        <select class="input" id="hphm">
                            <option value="0">---若当前无入库序号,不选择此项---</option>
                            <?php foreach ($datas as $v){?>
                                <option value="<?php echo $v['xh'];?>"><?php echo $v['hphm'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">当事人：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="" id="dsr">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">身份证号：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="" id="sfzh">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">出库时间：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="outbound_time" name="outbound_time"  value="<?php echo date('Y-m').'-01 00:00:00';?>">
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
                        <label for="rolename">停车场名称：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="" id="tccmc">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">停车场地址：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="" id="tccdz">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">组织机构编码：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"  disabled value="<?php echo $data2['orgnum']?>" id="orgnum">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">组织机构名称：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"  disabled value="<?php echo $data2['orgname']?>" id="orgname">
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
    laydate(outbound_time);
    //laydate(end);
</script>
<script type="text/javascript">
    var URL =$("#url").val();
    //验证身份证是否正确
    $("#sfzh").blur(function(){
        var val = $(this).val();
        var result = verifyCode(val);
        if(result == false)
        {
            layer.msg("请输入正确的身份证号码！");
            $("#sfzh").focus();
            return false;
        }
    });
    $("#sub").click(function () {
        var str = "";
        $(".assign_checkbox:radio").each(function()
        {
            if ($(this).is(":checked")==true)
            {
                str = $(this).val();
            }
        });
        //alert(str);
        //提交保存
        var hphm = $("#hphm").val();      //出库序号
        var dsr = $("#dsr").val();             //当事人
        var sfzh = $("#sfzh").val();           //身份证号
        var cksj = $("#outbound_time").val();  //出库时间
        var ckyy = $("#ckyy").val();           //出库原因
        var tccmc = $("#tccmc").val();         //停车场名称
        var tccdz = $("#tccdz").val();         //停车场地址
        var orgnum = $("#orgnum").val();       //组织机构编码
        var orgname = $("#orgname").val();     //组织机构名称
        var sfqzck = $("#sfqzck").val();       //是否强制出库
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
        if(cksj == "")
        {
            layer.msg("请填写出库时间！");
            $("#cksj").focus();
            return false;
        }
        if(ckyy == "")
        {
            layer.msg("请填写出库原因！");
            $("#ckyy").focus();
            return false;
        }
        if(tccmc == "")
        {
            layer.msg("请填写停车场名称！");
            $("#tccmc").focus();
            return false;
        }
        if(tccdz == "")
        {
            layer.msg("请填写停车场地址！");
            $("#tccdz").focus();
            return false;
        }
        if(sfqzck == "")
        {
            layer.msg("请选择是否强制出库！");
            return false;
        }
        if(str == "")
        {
            layer.msg("请选择要分配的警员！");
            return false;
        }
        $.ajax({
            url:URL+'admin/c_outbound_management/outbound_save',
            type:'post',
            data:{
                'xh':hphm,
                'dsr': dsr,
                'sfzh':sfzh,
                'cksj':cksj,
                'ckyy':ckyy,
                'tccmc':tccmc,
                'tccdz':tccdz,
                'orgnum':orgnum,
                'orgname':orgname,
                'sfqzck':sfqzck,
                'str':str
            },
            success:function(data)
            {
                //alert(data);
                //console.log(data);
                //return;
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
