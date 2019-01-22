<body class="bg-white">
<div class="tab" style="">
    <input type="hidden" value="<?php echo base_url();?>" id="url">
    <div class="tab-body" style="width: 95%;">
        <br>
        <div class="tab-panel active" id="tab-set" style="">
            <!-- <form id="fileForm" style="display: none;">
                <input type="file"  id="uphoto" style="display: none;" name="car_image[]" multiple>
            </form> -->
            <form method="post" class="form-x" action="<?php echo base_url()?>/admin/c_outbound_management/search"  >
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">号牌号码：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="" id="hphm" name="hphm"> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">号牌种类：</label>
                    </div>
                    <div class="field">
                        <select class="input" id="hpzl" name="hpzl">
                            <option value="0">---请选择---</option>
                            <?php foreach ($data1 as $v){?>
                                <option value="<?php echo $v['DMZ'];?>"><?php echo $v['DMSM1'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">身份证号：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="" id="sfzmhm" name="sfzmhm">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">起始时间：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="" id="start_time" name="start_time"> <!--<?php echo date('Y-m').'-01 00:00:00';?>-->
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">截止时间：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="" id="end_time" name="end_time"> <!--<?php echo date('Y-m-d H:i:s',time());?>-->
                    </div>
                </div>
                <div class="form-button">
                    <button class="button button-small bg-main operate_sub" type="submit" id="sub">搜索</button>
                </div>
            </form>
            <p style="margin-left: 20%;color:red">注:如此前无入库信息。填写直接出库信息</p>


            <form method="post" class="form-x" method="post" target="_parent">
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">号牌号码：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="" id="hphm1">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">号牌种类：</label>
                    </div>
                    <div class="field">
                        <select class="input" id="hpzl1" name="hpzl1">
                            <option value="0">---请选择---</option>
                            <?php foreach ($data1 as $v){?>
                                <option value="<?php echo $v['DMZ'];?>"><?php echo $v['DMSM1'];?></option>
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
                        <input type="text" class="input"   value="" id="sfzmhm1">
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
                        <select class="input" id="tccmc">
                            <option value="0">---请选择---</option>
                            <?php foreach ($parking as $v){?>
                                <option value="<?php echo $v['id'];?>"><?php echo $v['task_name'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">停车场地址：</label>
                    </div>
                    <div class="field">
                        <select class="input" id="tccdz">
                            <option value="0">---请选择---</option>
                        </select>
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
                            <option value="2">---请选择---</option>
                            <option value="1">是</option>
                            <option value="0">否</option>
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
                    <button class="button button-small bg-main operate_sub" type="button" id="sub1">确定</button>
                </div>
            </form>
        </div>
    </div>
</div>
<p class="text-right text-gray"></p>
<script>
    $('#tccmc').change(function(){
        var id = $(this).val();
        $.ajax({
            url:URL+'admin/c_outbound_management/sel_rep_info',
            type:'post',
            data:{
                'id':id
            },
            success:function(data)
            {
                $('#tccdz').empty();
                $('#tccdz').append(data);
            }
        });
    })
</script>

<script>
    var start = {
        elem: '#start_time',
        format: 'YYYY-MM-DD hh:mm:ss',
        min: '2010-01-01', //最小日期
        max: '2099-12-31 23:59:59', //最大日期
        start: '<?php echo date('Y-m-d',time());?>',    //开始日期
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
        elem: '#end_time',
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
    laydate(start);
    laydate(end);


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
    laydate(outbound_time);


</script>
<script>
    var URL = $('#url').val();
    $("#sub").click(function(){
        //alert();
        //根据搜索条件进行查询
        var hphm = $("#hphm").val();
        var hpzl = $("#hpzl").val();
        var sfzmhm = $("#sfzmhm").val();
        var start_time = $("#start_time").val();
        var end_time = $("#end_time").val();

        //条件检索测试
        return true;


        if(hphm == "" && hpzl=="0" && sfzmhm == "" && start_time== "" && end_time=="")
        {
            layer.msg("请输入搜索条件后再进行查询！");
            return false;
        }

        if(start_time != "" || end_time != "")
        {
            if(start_time >= end_time)
            {
                layer.msg('截止时间必须大于起始时间！');
                return false;
            }
        }
    });
</script>
<script>
    $("#sub1").click(function(){
        
        //提交保存
        var hphm = $("#hphm1").val();          //号牌号码
        var hpzl = $("#hpzl1").val();           //号牌种类
        var dsr = $("#dsr").val();             //当事人
        var sfzmhm = $("#sfzmhm1").val();          //身份证号
        var czsj = $("#outbound_time").val();  //出库时间
        var ckyy = $("#ckyy").val();           //出库原因
        var tccmc = $("#tccmc").val();         //停车场名称
        var tccdz = $("#tccdz").val();         //停车场地址
        var orgnum = $("#orgnum").val();       //组织机构编码
        var orgname = $("#orgname").val();     //组织机构名称
        var sfqzck = $("#sfqzck").val();       //是否强制出库

        if(hphm == "")
        {
            layer.msg("请填写号牌号码！");
            $("#hphm1").focus();
            return false;
        }

        if(hpzl == 0)
        {
            layer.msg("请选择号码种类！");
            return false;
        }

        if(dsr == "")
        {
            layer.msg("请填写当事人！");
            $("#dsr").focus();
            return false;
        }

        if(sfzmhm == "")
        {
            layer.msg("请填写身份证号码！");
            $("#sfzmhm1").focus();
            return false;
        }else{
            var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;  
           if(reg.test(sfzmhm) === false)  
           {  
               layer.msg("请输入正确的身份证号码！");
                $("#sfzmhm1").focus();
                return false; 
           }  
        }

        if(czsj == "")
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

        if(sfqzck == "2")
        {
            layer.msg("请选择是否强制出库！");
            return false;
        }


        var str = "";
        $(".assign_checkbox:radio").each(function()
        {
            if ($(this).is(":checked")==true)
            {
                str = $(this).val();
            }
        });

        if(str == "")
        {
            layer.msg("请选择要分配的警员！");
            return false;
        }

        $.ajax({
            url:URL+'admin/c_outbound_management/outbound_save',
            type:'post',
            data:{
                'hphm':hphm,
                'hpzl':hpzl,
                'dsr': dsr,
                'sfzmhm':sfzmhm,
                'czsj':czsj,
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
