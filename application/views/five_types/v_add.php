<body>
<div style="margin:20px;background-color: white;">
    <div>
        <div>
            <div>
                <form class="form-horizontal" name="" method="post" action="">
                    <div class="ibox-content">
                        <input type="hidden" id="url" value="<?php echo base_url();?>">
                        <table class="table table-bordered table-hover">
                            <tbody>
                            <tr>
                                <td>时间</td>
                                <td><input type="text" id="ftime" value="<?php echo date('Y-m',time());?>"></td>
                            </tr>
                            <tr>
                                <td>江南中队</td>
                                <td><input type="text" id="jnzd"></td>
                            </tr>
                            <tr>
                                <td>江北中队</td>
                                <td><input type="text" id="jbzd"></td>
                            </tr>
                            <tr>
                                <td>巡逻中队</td>
                                <td><input type="text" id="xlzd"></td>
                            </tr>
                            <tr>
                                <td>张滩中队</td>
                                <td><input type="text" id="ztzd"></td>
                            </tr>
                            <tr>
                                <td>瀛湖中队</td>
                                <td><input type="text" id="yhzd"></td>
                            </tr>
                            <tr>
                                <td>大河中队</td>
                                <td><input type="text" id="dhzd"></td>
                            </tr>
                            <tr>
                                <td>谭坝中队</td>
                                <td><input type="text" id="tbzd"></td>
                            </tr>
                            <tr>
                                <td>洪山中队</td>
                                <td><input type="text" id="hszd"></td>
                            </tr>
                            <tr>
                                <td>指导中队</td>
                                <td><input type="text" id="zdzd"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-button">
                        <button class="button button-small bg-main operate_sub" type="button" id="sub">确定</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var ftime = {
        elem: '#ftime',
        format: 'YYYY-MM',
        min: '2010-01', //最小日期
        max: '2099-12', //最大日期
        start: '2016-06',    //开始日期
        istime: true,
        istoday: true,
        fixed: false, //是否固定在可视区域
        zIndex: 99999999, //css z-index
        choose: function(datas){
            end.min = datas; //开始日选好后，重置结束日的最小日期
            end.start = datas //将结束日的初始值设定为开始日
        }
    };
    laydate(ftime);
</script>
<script>
    var  URL = $("#url").val();
    $("#sub").click(function(){
        var ftime = $("#ftime").val();        //时间
        var jnzd = $("#jnzd").val();          //江南中队
        var jbzd = $("#jbzd").val();          //江北中队
        var xlzd = $("#xlzd").val();          //巡逻中队
        var ztzd = $("#ztzd").val();          //张滩中队
        var yhzd = $("#yhzd").val();          //瀛湖中队
        var dhzd = $("#dhzd").val();          //大河中队
        var tbzd = $("#tbzd").val();          //谭坝中队
        var hszd = $("#hszd").val();          //洪山中队
        var zdzd = $("#zdzd").val();          //指导中队
        if(ftime == "")
        {
            layer.msg("请填写时间！");
            $("#ftime").focus();
            return false;
        }
        if(jnzd == "")
        {
            layer.msg("请填写江南中队拨款数！");
            $("#jnzd").focus();
            return false;
        }
        if(jbzd == "")
        {
            layer.msg("请填写江北中队拨款数！");
            $("#jbzd").focus();
            return false;
        }
        if(xlzd == "")
        {
            layer.msg("请填写巡逻中队拨款数！");
            $("#xlzd").focus();
            return false;
        }
        if(ztzd == "")
        {
            layer.msg("请填写张滩中队拨款数！");
            $("#ztzd").focus();
            return false;
        }
        if(yhzd == "")
        {
            layer.msg("请填写瀛湖中队拨款数！");
            $("#yhzd").focus();
            return false;
        }
        if(dhzd == "")
        {
            layer.msg("请填写大河中队拨款数！");
            $("#dhzd").focus();
            return false;
        }
        if(tbzd == "")
        {
            layer.msg("请填写谭坝中队拨款数！");
            $("#tbzd").focus();
            return false;
        }
        if(hszd == "")
        {
            layer.msg("请填写洪山中队拨款数！");
            $("#hszd").focus();
            return false;
        }
        if(zdzd == "")
        {
            layer.msg("请填写指导中队拨款数！");
            $("#zdzd").focus();
            return false;
        }
        $.ajax({
            url:URL+'admin/c_five_types/save',
            type:'post',
            data:
                {
                    'ftime':ftime,
                    'jnzd' :jnzd,
                    'jbzd' :jbzd,
                    'xlzd' :xlzd,
                    'ztzd' :ztzd,
                    'yhzd' :yhzd,
                    'dhzd' :dhzd,
                    'tbzd' :tbzd,
                    'hszd' :hszd,
                    'zdzd' :zdzd
                },
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
                    layer.msg('添加失败！');
                }
            }
        });

    });
</script>
</body>