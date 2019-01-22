<body class="bg-white">
<div class="tab" style="">
    <input type="hidden" value="<?php echo base_url();?>" id="url">
    <div class="tab-body" style="width: 95%;">
        <br>
        <div class="tab-panel active" id="tab-set" style="">

            <form method="post" class="form-x" method="post" target="_parent">
                <input type="hidden" id="id" value="<?php echo $id?>">

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">行政区划：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" readonly value="<?php echo $xzqh_name['name']?>" id="hphm">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">警员名称：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" readonly value="<?php echo $jymc['name']?>" id="hphm">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">姓名：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"  value="<?php echo $xm?>" id="xm">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">性别：</label>
                    </div>
                    <div style="float: left;padding: 7px">
                        <input type="radio" class="sex" name="sex" <?php if($xb == 1){echo 'checked';}?> value="1">男
                        <input type="radio" class="sex" name="sex" <?php if($xb == 2){echo 'checked';}?> value="2">女
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">手机号码：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"  value="<?php echo $sjhm?>" id="sjhm">
                    </div>
                </div>

                <div class="form-group"  id="bh_type">
                    <div class="label">
                        <label for="rolename">联系电话：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" name="bh"  value="<?php echo $lxdh?>" id="lxdh">
                    </div>
                </div>

                <div class="form-group" >
                    <div class="label">
                        <label for="rolename">工作单位：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" name="bh"  value="<?php echo $gzdw?>" id="gzdw">
                    </div>
                </div>

                <div class="form-group" >
                    <div class="label">
                        <label for="rolename">从业资格证号：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" name="bh"  value="<?php echo $cyzgzh?>" id="cyzgzh">
                    </div>
                </div>

                <div class="form-group" >
                    <div class="label">
                        <label for="rolename">发证日期：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" autocomplete="off" value="<?php echo $fzrq?>" id="fzrq" name="entry_time">
                    </div>
                </div>

                <div class="form-group" >
                    <div class="label">
                        <label for="rolename">过期日期：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" name="bh"  value="<?php echo $gqrq?>" id="gqrq">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">驾驶证：</label>
                    </div>
                    <div style="float: left;padding: 7px">
                        <input type="radio" class="jsz" name="jsz" <?php if($jsz == 1){echo 'checked';}?> value="1">有
                        <input type="radio" class="jsz" name="jsz" <?php if($jsz == 2){echo 'checked';}?> value="2">无
                    </div>
                </div>

                <?php if($jsz == 1){?>
                    <div class="form-group" >
                        <div class="label">
                            <label for="rolename">准驾车型：</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" name="bh"  value="<?php echo $zjcx?>" id="zjcx">
                        </div>
                    </div>
                    <div class="form-group" >
                        <div class="label">
                            <label for="rolename">驾证期限：</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" name="bh"  value="<?php echo $jzqx?>" id="jzqx">
                        </div>
                    </div>
                    <div class="form-group" >
                        <div class="label">
                            <label for="rolename">有效期始：</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" name="bh" autocomplete="off" value="<?php echo $yxqs?>" id="yxqs">
                        </div>
                    </div>
                    <div class="form-group" >
                        <div class="label">
                            <label for="rolename">有效期止：</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" name="bh" autocomplete="off" value="<?php echo $yxqz?>" id="yxqz">
                        </div>
                    </div>
                    <div class="form-group" >
                        <div class="label">
                            <label for="rolename">初次领证日期：</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" name="bh" autocomplete="off" value="<?php echo $cclzrq?>" id="cclzrq">
                        </div>
                    </div>
                    <div class="form-group" >
                        <div class="label">
                            <label for="rolename">下一审检日期：</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" name="bh" autocomplete="off" value="<?php echo $xysyrq?>" id="xysyrq">
                        </div>
                    </div>
                    <div class="form-group" >
                        <div class="label">
                            <label for="rolename">累计积分：</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" name="bh"  value="<?php echo $ljjf?>" id="ljjf">
                        </div>
                    </div>
                <?php }?>


                <div class="form-group" >
                    <div class="label">
                        <label for="rolename">户籍地：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" name="bh"  value="<?php echo $hjd?>" id="hjd">
                    </div>
                </div>
                <div class="form-group" >
                    <div class="label">
                        <label for="rolename">长期工作地：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" name="bh"  value="<?php echo $cqgzd?>" id="cqgzd">
                    </div>
                </div>
                <div class="form-group" >
                    <div class="label">
                        <label for="rolename">住所地址：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" name="bh"  value="<?php echo $zsdz?>" id="zsdz">
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
        var xm = $('#xm').val();
        var sex =$('input[name="sex"]:checked').val();   //性别
        var sjhm = $('#sjhm').val();
        var lxdh = $('#lxdh').val();
        var gzdw = $('#gzdw').val();
        var cyzgzh = $('#cyzgzh').val();
        var fzrq = $('#fzrq').val();
        var gqrq = $('#gqrq').val();
        var jsz =$('input[name="jsz"]:checked').val();   //驾驶证

        var zjcx = $('#zjcx').val();  //
        var jzqx = $('#jzqx').val();  //
        var yxqs = $('#yxqs').val();   //
        var yxqz = $('#yxqz').val();   //
        var cclzrq = $('#cclzrq').val();   //
        var xysyrq = $('#xysyrq').val();  //
        var ljjf = $('#ljjf').val();   //
        var hjd = $('#hjd').val();   //
        var cqgzd = $('#cqgzd').val();  //
        var zsdz = $('#zsdz').val();   //

        if(lxdh.length != 11){
            layer.msg('请输入正确的手机号',{time:1000});
            return false;
        }else{
            $.ajax({
                url:'<?php echo base_url();?>admin/c_driver/edit_up',
                type:'post',
                data:{
                    'id':id,
                    'xm': xm,
                    'sex': sex,
                    'sjhm': sjhm,
                    'lxdh': lxdh,
                    'gzdw': gzdw,
                    'cyzgzh':cyzgzh,
                    'fzrq':fzrq,
                    'gqrq':gqrq,
                    'jsz':jsz,
                    'zjcx':zjcx,
                    'jzqx':jzqx,
                    'yxqs':yxqs,
                    'yxqz':yxqz,
                    'cclzrq':cclzrq,
                    'xysyrq':xysyrq,
                    'ljjf':ljjf,
                    'hjd':hjd,
                    'cqgzd':cqgzd,
                    'zsdz':zsdz
                },
                success:function(data)
                {
                    console.log(data);

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
        elem: '#fzrq',
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
        elem: '#gqrq',
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
        elem: '#yxqs',
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
        elem: '#yxqz',
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
        elem: '#cclzrq',
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
        elem: '#xysyrq',
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
