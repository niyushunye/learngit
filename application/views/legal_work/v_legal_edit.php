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
                        <input type="hidden"  id='legal_work_id' value="<?php echo $id;?>">
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
                        <input type="text" class="input"   value="<?php echo $score_1;?>" id="score_1" placeholder="中队每月组织执法质量考评,并及时上报考评通报-10分">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">标准2：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="<?php echo $score_2;?>" id="score_2" placeholder="执法办案质量(以每月日常案卷审核情况评分排名:当月无一般程序案件单位,抽查当月简易程序处罚决定书存根、强制措施凭证存根)-40分">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">标准3：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="<?php echo $score_3;?>" id="score_3" placeholder="按时上报执法工作信息(以网站发布内容统计得分)-5分">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">标准4：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="<?php echo $score_4;?>" id="score_4" placeholder="按时上报执法培训、一月一考情况-5分">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">标准5：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="<?php echo $score_5;?>" id="score_5" placeholder="每月典型案例点评-5分">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">标准6：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="<?php echo $score_6;?>" id="score_6" placeholder="“四个一律”办案区使用情况(是否上传图片视频资料)-5分">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">标准7：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="<?php echo $score_7;?>" id="score_7" placeholder="执法监督(无执法不规范被省;市检查组通报事件;无媒体曝光造成恶劣影响执法事件;无行政复议;诉讼案件;无涉及非正常伤亡事件;无群众投诉案件)-20分">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">标准8：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"   value="<?php echo $score_8;?>" id="score_8" placeholder="执法突出问题通报整改情况(对支队、分局、大队在执法办案方面通报的问题是否进行整改)-10分">
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

        var score_company = $("#score_company").val();
        /*if(score_company == '0')
        {
            layer.msg("请选择评分单位！");
            $("#score_company").focus();
            return false;
        }*/

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
              if(0>score_1 || score_1>10){
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
              if(0>score_2 || score_2>40){
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
              if(0>score_4 || score_4>5){
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
              if(0>score_5 || score_5>5){
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
              if(0>score_6 || score_6>5){
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
              if(0>score_7 || score_7>20){
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


      
        var legal_work_id = $('#legal_work_id').val();

        $.ajax({
            url:URL+'admin/c_legal_work/score_edit',
            type:'post',
            data:{
                'id':legal_work_id,
                'score_1':score_1,
                'score_2':score_2,
                'score_3':score_3,
                'score_4':score_4,
                'score_5':score_5,
                'score_6':score_6,
                'score_7':score_7,
                'score_8':score_8,
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
