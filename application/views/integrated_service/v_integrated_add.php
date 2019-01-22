<body class="bg-white">
<div class="tab" style="">
    <input type="hidden" value="<?php echo base_url();?>" id="url">
    <div class="tab-body" style="width: 95%;">
        <br>
        <div class="tab-panel active" id="tab-set" style="">

            <form method="post" class="form-x" method="post" target="_parent">
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">评分单位：</label>
                    </div>
                    <div class="field">
                        <select class="input" id="score_company">
                            <option value="">---请选择---</option>
                            <option value="610902015000">江南中队</option>
                            <option value="610902015100">江北中队</option>
                            <option value="610902015300">张滩中队</option>
                            <option value="610902015400">瀛湖中队</option>
                            <option value="610902010200">巡逻中队</option>
                            <option value="610902015600">谭坝中队</option>
                            <option value="610902015500">大河中队</option>
                            <option value="610902015700">洪山中队</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">月份：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="<?php echo date('Y-m')?>" id="in" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">扣分项目：</label>
                    </div>
                    <div class="field">
                        <select class="input" id="score_month">
                            <option value="">---请选择---</option>
                            <option value="score_1">党的基层组织建设(5分)</option>
                            <option value="score_2">党风政风行风建设(10分)</option>
                            <option value="score_3">队伍素质能力建设(15分)</option>
                            <option value="score_4">典型培树宣传(5分)</option>
                            <option value="score_5">从优待警政策落实(15分)</option>
                            <option value="score_6">综合文秘(25分)</option>
                            <option value="score_7">指挥调度(上传下达)(10分)</option>
                            <option value="score_8">材料数据报表上报(10分)</option>
                            <option value="score_9">各类创建活动(含“五城联创”任务落实)(15分)</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">分值：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" maxlength="2"  value="" id="score" autocomplete="off" onkeyup="value=value.replace( /[^\d]/g,'')" placeholder="请填写两位数字">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">扣分原因：</label>
                    </div>
                    <div class="field">
                        <textarea class="input" readonly style="height: 100px;max-width:90%;min-width:90%;width:90%;border: 1px solid #e1e2ef;" id="content"></textarea>
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

<script type="text/javascript">

    $('#score').blur(function (){
        var URL =$("#url").val();
        var score_company = $('#score_company').val();   //扣分单位代码值
        var score_month = $('#score_month').val();  //扣分项目
        var score = $('#score').val();  //扣分分值
        if(score_company == ''){
            layer.msg("请选择扣分单位！",{time:1000});
            return false;
        }
        if(score_month == ''){
            layer.msg("请选择扣分项目！",{time:1000});
            return false;
        }
        if(score == ''){
            layer.msg("请填写扣分分值！",{time:1000});
            return false;
        }
        $.ajax({
            url:URL+'admin/c_integrated/validation',
            type:'post',
            data:{
                'score_company':score_company,   //扣分单位代码值
                'score_month':score_month,    //扣分项目
                'score':score                   //扣分分值
            },
            success:function(data)
            {
                var data1 = eval('('+data+')');
                if(data1['guo'] == 1)
                {
                    $('#content').removeAttr('readonly');
                }else
                {
                    layer.msg("请填写小于"+ data1['zhi'] +"数字！",{time:2000});
                    $('#content').attr('readonly','readonly');
                }
            }
        });
    });


    $('#sub').click(function (){
        var URL =$("#url").val();
        var ins = $('#in').val();
        var score_company = $('#score_company').val();   //扣分单位代码值
        var unit = $('#score_company').find('option:selected').text();  //扣分单位名称
        var score_month = $('#score_month').val();  //扣分项目
        var score = $('#score').val();  //扣分分值
        var why = $('#content').val();  //扣分原因
        if(score_company == ''){
            layer.msg("请选择扣分单位！",{time:1000});
            return false;
        }
        if(score_month == ''){
            layer.msg("请选择扣分项目！",{time:1000});
            return false;
        }
        if(score == ''){
            layer.msg("请填写扣分分值！",{time:1000});
            return false;
        }
        if(why == ''){
            layer.msg("请选择扣分原因！",{time:1000});
            return false;
        }
        $.ajax({
            url:URL+'admin/c_integrated/score_save',
            type:'post',
            data:{
                'score_company':score_company,
                'unit':unit,
                'score_month':score_month,
                'score':score,
                'why':why,
                'ins':ins
            },
            success:function(data)
            {
                if(data == 1)
                {
                    layer.msg('扣分成功！',{
                        time:1.5*1000
                    },function(){
                        layer.closeAll();
                        parent.window.location.reload();
                    });
                }else
                {
                    layer.msg("扣分失败！");
                }
            }
        });
    })

</script>

</body>
</html>
