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
                        <input type="hidden"  id='publicize_work_id' value="<?php echo $id;?>">
                        <select class="input" id="score_company" disabled="">
                            <option value="0">---请选择---</option>
                            <option value="610902015000" <?php if($score_company == '610902015000'):?> selected='' <?php endif;?>>江南中队</option>
                            <option value="610902015100" <?php if($score_company == '610902015100'):?> selected='' <?php endif;?>>江北中队</option>
                            <option value="610902015300" <?php if($score_company == '610902015300'):?> selected='' <?php endif;?>>张滩中队</option>
                            <option value="610902015400" <?php if($score_company == '610902015400'):?> selected='' <?php endif;?>>瀛湖中队</option>
                            <option value="610902010200" <?php if($score_company == '610902010200'):?> selected='' <?php endif;?>>巡逻中队</option>
                            <option value="610902015600" <?php if($score_company == '610902015600'):?> selected='' <?php endif;?>>谭坝中队</option>
                            <option value="610902015500" <?php if($score_company == '610902015500'):?> selected='' <?php endif;?>>大河中队</option>
                            <option value="610902015700" <?php if($score_company == '610902015700'):?> selected='' <?php endif;?>>洪山中队</option>

                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">评分月份：</label>
                    </div>
                    <div class="field">
                        <select class="input" id="score_month" disabled="">

                            <?php for($i=1;$i<=12;$i++):?>
                                <option value="<?php echo sprintf('%02d',$i);?>"  <?php if($score_month == sprintf('%02d',$i)):?> selected='' <?php endif;?> ><?php echo $i;?>月份</option>
                            <?php endfor;?>

                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <div class="label">
                        <label for="rolename">标准1：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="<?php echo $score_1;?>" id="score_1" placeholder="开展交通安全管理重点工作教育活动(20分)">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">标准2：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="<?php echo $score_2;?>" id="score_2" placeholder="文明交通示范评选活动(10分)">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">标准3：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="<?php echo $score_3;?>" id="score_3" placeholder="实施文明交通行动计划(5分)">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">标准4：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="<?php echo $score_4;?>" id="score_4" placeholder="自媒体宣传-微博(10分)">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">标准5：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="<?php echo $score_5;?>" id="score_5" placeholder="自媒体宣传-微信(15分)">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">标准6：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="<?php echo $score_6;?>" id="score_6" placeholder="自媒体宣传-短信(6分)">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">标准7：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="<?php echo $score_7;?>" id="score_7" placeholder="自媒体宣传-路况播报(9分)">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">标准8：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="<?php echo $score_8;?>" id="score_8" placeholder="利用社会公共媒体宣传情况-部省级媒体(10分)">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">标准9：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="<?php echo $score_9;?>" id="score_9" placeholder="利用社会公共媒体宣传情况-市级媒体(10分)">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">标准10：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="<?php echo $score_10;?>" id="score_10" placeholder="典型案例及严重交通违法上报-典型案例(3分)">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">标准11：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="<?php echo $score_11;?>" id="score_11" placeholder="典型案例及严重交通违法上报-严重交通违法上报(2分)">
                    </div>
                </div>

                 <div class="form-group">
                    <div class="label">
                        <label for="rolename">标准12：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="<?php echo $score_12;?>" id="score_12" placeholder="加分项目(10分)">
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

   
    var URL =$("#url").val();
   
    $("#sub").click(function () {

        alert(11);
        var score_company = $("#score_company").val();
        if(score_company == '0')
        {
            layer.msg("请选择评分单位！");
            $("#score_company").focus();
            return false;
        }

        var score_month = $('#score_month').val();

        
        var score_1 = $("#score_1").val();    //标准1
        if(score_1 == ''){
                layer.msg("请填写评分标准1！");
                $("#score_1").focus();
                return false;
        }else{
            var reg = /^[\d]+$/g;
            if(!reg.test(score_1)){
              layer.msg("请填写数字类型！");
              $("#score_1").focus();
              return false;
            }else{
              if(0>score_1 || score_1>20){
                  layer.msg("请填写正确的评分范围！");
                  $("#score_1").focus();
                  return false;
              }
            }
        }


        var score_2 = $("#score_2").val();    //标准2
        if(score_2 == ''){
                layer.msg("请填写评分标准2！");
                $("#score_2").focus();
                return false;
        }else{
            var reg = /^[\d]+$/g;
            if(!reg.test(score_2)){
              layer.msg("请填写数字类型！");
              $("#score_2").focus();
              return false;
            }else{
              if(0>score_2 || score_2>10){
                  layer.msg("请填写正确的评分范围！");
                  $("#score_2").focus();
                  return false;
              }
            }
        }


        var score_3 = $("#score_3").val();    //标准3
        if(score_3 == ''){
                layer.msg("请填写评分标准3！");
                $("#score_3").focus();
                return false;
        }else{
            var reg = /^[\d]+$/g;
            if(!reg.test(score_3)){
              layer.msg("请填写数字类型！");
              $("#score_3").focus();
              return false;
            }else{
              if(0>score_3 || score_3>5){
                  layer.msg("请填写正确的评分范围！");
                  $("#score_3").focus();
                  return false;
              }
            }
        }


        var score_4 = $("#score_4").val();    //标准4
        if(score_4 == ''){
                layer.msg("请填写评分标准4！");
                $("#score_4").focus();
                return false;
        }else{
            var reg = /^[\d]+$/g;
            if(!reg.test(score_4)){
              layer.msg("请填写数字类型！");
              $("#score_4").focus();
              return false;
            }else{
              if(0>score_4 || score_4>10){
                  layer.msg("请填写正确的评分范围！");
                  $("#score_4").focus();
                  return false;
              }
            }
        }


        var score_5 = $("#score_5").val();    //标准5
        if(score_5 == ''){
                layer.msg("请填写评分标准5！");
                $("#score_5").focus();
                return false;
        }else{
            var reg = /^[\d]+$/g;
            if(!reg.test(score_5)){
              layer.msg("请填写数字类型！");
              $("#score_5").focus();
              return false;
            }else{
              if(0>score_5 || score_5>15){
                  layer.msg("请填写正确的评分范围！");
                  $("#score_5").focus();
                  return false;
              }
            }
        }


        var score_6 = $("#score_6").val();    //标准6
        if(score_6 == ''){
                layer.msg("请填写评分标准6！");
                $("#score_6").focus();
                return false;
        }else{
            var reg = /^[\d]+$/g;
            if(!reg.test(score_6)){
              layer.msg("请填写数字类型！");
              $("#score_6").focus();
              return false;
            }else{
              if(0>score_6 || score_6>6){
                  layer.msg("请填写正确的评分范围！");
                  $("#score_6").focus();
                  return false;
              }
            }
        }


        var score_7 = $("#score_7").val();    //标准7
        if(score_7 == ''){
                layer.msg("请填写评分标准7！");
                $("#score_7").focus();
                return false;
        }else{
            var reg = /^[\d]+$/g;
            if(!reg.test(score_7)){
              layer.msg("请填写数字类型！");
              $("#score_7").focus();
              return false;
            }else{
              if(0>score_7 || score_7>9){
                  layer.msg("请填写正确的评分范围！");
                  $("#score_7").focus();
                  return false;
              }
            }
        }


        var score_8 = $("#score_8").val();    //标准8
        if(score_8 == ''){
                layer.msg("请填写评分标准8！");
                $("#score_8").focus();
                return false;
        }else{
            var reg = /^[\d]+$/g;
            if(!reg.test(score_8)){
              layer.msg("请填写数字类型！");
              $("#score_8").focus();
              return false;
            }else{
              if(0>score_8 || score_8>10){
                  layer.msg("请填写正确的评分范围！");
                  $("#score_8").focus();
                  return false;
              }
            }
        }


        var score_9 = $("#score_9").val();    //标准9
        if(score_9 == ''){
                layer.msg("请填写评分标准9！");
                $("#score_9").focus();
                return false;
        }else{
            var reg = /^[\d]+$/g;
            if(!reg.test(score_9)){
              layer.msg("请填写数字类型！");
              $("#score_9").focus();
              return false;
            }else{
              if(0>score_9 || score_9>10){
                  layer.msg("请填写正确的评分范围！");
                  $("#score_9").focus();
                  return false;
              }
            }
        }


        var score_10 = $("#score_10").val();    //标准10
        if(score_10 == ''){
                layer.msg("请填写评分标准10！");
                $("#score_10").focus();
                return false;
        }else{
            var reg = /^[\d]+$/g;
            if(!reg.test(score_10)){
              layer.msg("请填写数字类型！");
              $("#score_10").focus();
              return false;
            }else{
              if(0>score_10 || score_10>3){
                  layer.msg("请填写正确的评分范围！");
                  $("#score_10").focus();
                  return false;
              }
            }
        }

        var score_11 = $("#score_11").val();    //标准11
        if(score_11 == ''){
                layer.msg("请填写评分标准11！");
                $("#score_11").focus();
                return false;
        }else{
            var reg = /^[\d]+$/g;
            if(!reg.test(score_11)){
              layer.msg("请填写数字类型！");
              $("#score_11").focus();
              return false;
            }else{
              if(0>score_11 || score_11>2){
                  layer.msg("请填写正确的评分范围！");
                  $("#score_11").focus();
                  return false;
              }
            }
        }


        var score_12 = $("#score_12").val();    //标准12
        if(score_12 == ''){
                layer.msg("请填写评分标准12！");
                $("#score_12").focus();
                return false;
        }else{
            var reg = /^[\d]+$/g;
            if(!reg.test(score_12)){
              layer.msg("请填写数字类型！");
              $("#score_12").focus();
              return false;
            }else{
              if(0>score_12 || score_12>10){
                  layer.msg("请填写正确的评分范围！");
                  $("#score_12").focus();
                  return false;
              }
            }
        }

        var publicize_work_id = $('#publicize_work_id').val();

        $.ajax({
            url:URL+'admin/c_publicize_work/score_edit',
            type:'post',
            data:{
                'id':publicize_work_id,
                'score_1':score_1,
                'score_2':score_2,
                'score_3':score_3,
                'score_4':score_4,
                'score_5':score_5,
                'score_6':score_6,
                'score_7':score_7,
                'score_8':score_8,
                'score_9':score_9,
                'score_10':score_10,
                'score_11':score_11,
                'score_12':score_12,
                'score_company':score_company,
                'score_month':score_month
            },
            success:function(data)
            {
                // alert(data);
                // return;
                if(data == '1')
                {
                    layer.msg("编辑成功！",{
                        time:1.5*1000
                    },function(){
                        layer.closeAll();
                        parent.window.location.reload();
                    });
                }else
                {
                    layer.msg("编辑失败！");
                }
            }
        });

    });

    
 
</script>

</body>
</html>
