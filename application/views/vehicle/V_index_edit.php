<body class="bg-white">
<div class="tab" style="">
    <input type="hidden" value="<?php echo base_url();?>" id="url">
    <div class="tab-body" style="width: 95%;">
        <br>
        <div class="tab-panel active" id="tab-set" style="">

            <form method="post" class="form-x" method="post" target="_parent">
                <input type="hidden" id="id" value="<?php echo $id?>">
                <input type="hidden" id="number" value="<?php echo $number?>">
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">行政区划：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" readonly value="<?php echo $xzqh_name['name']?>" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">警员名称：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" readonly value="<?php echo $jymc['name']?>" >
                    </div>
                </div>
                <!--                <div class="form-group">-->
                <!--                    <div class="label">-->
                <!--                        <label for="rolename">排查时间：</label>-->
                <!--                    </div>-->
                <!--                    <div class="field">-->
                <!--                        <input type="text" class="input" autocomplete="off" value="--><?php //echo $pcsj?><!--" id="inbound_time" name="entry_time">-->
                <!--                    </div>-->
                <!--                </div>-->
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">检验有效期止：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" autocomplete="off" value="<?php echo $jyyxqz?>" id="jyyxqz">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">强制报废期止：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" autocomplete="off" value="<?php echo $qzbfqz?>" id="qzbfqz">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">车辆所有人：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"  value="<?php echo $clsyr?>" id="clsyr">
                    </div>
                </div>

                <div class="form-group"  id="bh_type">
                    <div class="label">
                        <label for="rolename">手机号码：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" name="bh"  value="<?php echo $sjhm?>" id="sjhm">
                    </div>
                </div>

                <div class="form-group" >
                    <div class="label">
                        <label for="rolename">身份证号：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" name="bh"  value="<?php echo $sfzh?>" id="sfzh">
                    </div>
                </div>

                <div class="form-group" >
                    <div class="label">
                        <label for="rolename">联系住址：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" name="bh"  value="<?php echo $lxzz?>" id="lxzz">
                    </div>
                </div>
                <div class="form-group" >
                    <div class="label">
                        <label for="rolename">邮政编码：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" name="bh"  value="<?php echo $yzbm?>" id="yzbm">
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
    $('.operate_sub').click(function(){
        var id = $('#id').val();
        var number = $('#number').val();
        var jyyxqz = $('#jyyxqz').val();    //辖区道路名称
        var qzbfqz = $('#qzbfqz').val();    //隐患路段
        var clsyr = $('#clsyr').val();     //隐患现状
        var sjhm = $('#sjhm').val();
        var sfzh = $('#sfzh').val();
        var lxzz = $('#lxzz').val();
        var yzbm = $('#yzbm').val();
        if(sjhm.length != 11){
            layer.msg('请输入正确的手机号',{time:1000});
            return false;
        }else{
            $.ajax({
                url:'<?php echo base_url();?>admin/c_vehicle/edit_up',
                type:'post',
                data:{
                    'id':id,
                    'number':number,
                    'jyyxqz': jyyxqz,
                    'qzbfqz': qzbfqz,
                    'clsyr': clsyr,
                    'sjhm': sjhm,
                    'sfzh':sfzh,
                    'lxzz':lxzz,
                    'yzbm':yzbm
                },
                success:function(data)
                {
//                    console.log(data);

                    if(data == '1')
                    {
                        layer.msg("编辑成功！",{
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
    });
</script>
<script>
    var inbound_time = {
        elem: '#jyyxqz',
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


    var inbound_time = {
        elem: '#qzbfqz',
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
</body>
</html>
