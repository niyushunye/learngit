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
                        <input type="text" class="input" readonly value="<?php echo $lrmj['name']?>" id="hphm">
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
                        <label for="rolename">联系电话：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"  value="<?php echo $lxdh?>" id="lxdh">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">是否隐患：</label>
                    </div>
                    <div style="float: left;padding: 7px">
                        <input type="radio" class="sex" name="sex" <?php if($is_danger == 1){echo 'checked';}?> value="1">是
                        <input type="radio" class="sex" name="sex" <?php if($is_danger == 2){echo 'checked';}?> value="2">否
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">辖区道路名称：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"  value="<?php echo $dlmc?>" id="dlmc">
                    </div>
                </div>

                <div class="form-group"  id="bh_type">
                    <div class="label">
                        <label for="rolename">隐患路段：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" name="bh"  value="<?php echo $yhld?>" id="yhld">
                    </div>
                </div>

                <div class="form-group" >
                    <div class="label">
                        <label for="rolename">事故多发路段：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" name="bh"  value="<?php echo $sgdfld?>" id="sgdfld">
                    </div>
                </div>

                <div class="form-group" >
                    <div class="label">
                        <label for="rolename">隐患现状：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" name="bh"  value="<?php echo $yhxz?>" id="yhxz">
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
<!--<script>-->
<!--    var inbound_time = {-->
<!--        elem: '#inbound_time',-->
<!--        format: 'YYYY-MM-DD hh:mm:ss',-->
<!--        min: '2010-01-01', //最小日期-->
<!--        max: '2099-12-31 23:59:59', //最大日期-->
<!--        istime: true,-->
<!--        istoday: true,-->
<!--        fixed: false, //是否固定在可视区域-->
<!--        zIndex: 99999999, //css z-index-->
<!--        choose: function(datas){-->
<!--            end.min = datas; //开始日选好后，重置结束日的最小日期-->
<!--            end.start = datas //将结束日的初始值设定为开始日-->
<!--        }-->
<!--    };-->
<!--    laydate(inbound_time);-->
<!--</script>-->
<script>
    $('.operate_sub').click(function(){

        var id = $('#id').val();
        var is_danger =$('input[name="sex"]:checked').val();
        var dlmc = $('#dlmc').val();    //辖区道路名称
        var yhld = $('#yhld').val();    //隐患路段
        var sgdfld = $('#sgdfld').val();   //事故多发路段
        var yhxz = $('#yhxz').val();     //隐患现状
        var lxdh = $('#lxdh').val();
        if(lxdh.length != 11){
            layer.msg('请输入正确的手机号',{time:1000});
            return false;
        }else{
            $.ajax({
                url:'<?php echo base_url();?>admin/c_danger_road/edit_up',
                type:'post',
                data:{
                    'id':id,
                    'is_danger': is_danger,
                    'lxdh': lxdh,
                    'dlmc': dlmc,
                    'yhld': yhld,
                    'sgdfld': sgdfld,
                    'yhxz':yhxz
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
</body>
</html>
