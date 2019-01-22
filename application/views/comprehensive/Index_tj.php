<body class="bg-white fixed">
<style>

</style>
<script>

    function line(header,line_width,line_color,line_number){
        var table = document.getElementById(header);
        var xpos = table.clientWidth;
        var ypos = table.clientHeight;
        var canvas = document.getElementById('line');
        if(canvas.getContext){
            var ctx = canvas.getContext('2d');
            ctx.clearRect(0,0,xpos,ypos); //清空画布，多个表格时使用
            ctx.fill();
            ctx.lineWidth = line_width;
            ctx.strokeStyle = line_color;
            ctx.beginPath();
            switch(line_number){
                case 1:
                    ctx.moveTo(0,0);
                    ctx.lineTo(xpos,ypos);
                    break;
                case 2:
                    ctx.moveTo(0,0);
                    ctx.lineTo(xpos/2,ypos);
                    ctx.moveTo(0,0);
                    ctx.lineTo(xpos,ypos/2);
                    break;
                case 3:
                    ctx.moveTo(0,0);
                    ctx.lineTo(xpos,ypos);
                    ctx.moveTo(0,0);
                    ctx.lineTo(xpos/2,ypos);
                    ctx.moveTo(0,0);
                    ctx.lineTo(xpos,ypos/2);
                    break;
                default:
                    return 0;
            }

            ctx.stroke();
            ctx.closePath();
            document.getElementById(header).style.backgroundImage = 'url("' + ctx.canvas.toDataURL() + '")';

        }
    }
    window.onload = function (){
        line('header',2,'#6e6e6e',2);
        //目标单元格，线的宽度，线的颜色，线的条数，1~3，
        //line('two',2,'black',2);
    }
    window.onresize = function(){       //当窗口改变时，也随之改变
//可以加上检测 宽度高度是否变化在执行函数
        line('header',2,'#6e6e6e',2);
    }
</script>
<div style="margin:20px;">
    <div>
        <div>
            <div>
                <div>
                    <div style="float:left;margin: 0 20px 20px 6px">
                        <a href="#" class="export button button-small border border-green add">导出</a>
                    </div>
                </div>
                <form action="<?php echo base_url()?>admin/c_road_tj/index" method="post">
                    <span>时间：</span><input type="text" name="score_month" style="height: 25px" value="<?php echo $score_month?>" id="test3" autocomplete="off">
                    <button type="submit" style="margin-left: 15px" class="button button-small border border-yellow operate_sub" id="search">搜索</button>
                </form>
                <form class="form-horizontal" name="" method="post" action="">
                    <div class="ibox-content">
                        <canvas id="line" style="display:none;"></canvas>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr class="bg-back">
                                <th  id="header" width="8%" rowspan="2">
                                    <span style="float:right;margin-top: -60px;">项目</span><br/>
                                    <div style="float:left;">单位</div>
                                    <div style="float:right;">得分</div>
                                </th>
                                <th  style="vertical-align:middle" colspan="6" >接处警,现场勘查,安全防护措施(5分)</th>
                                <th  style="vertical-align:middle" colspan="7" >规范执法办案(10分)</th>
                                <th  style="vertical-align:middle" colspan="4" >事故分析研判(15分)</th>
                                <th  style="vertical-align:middle" colspan="4" >辖区中队配合及重大警况汇报制度(5分)</th>
                                <th  style="vertical-align:middle" colspan="3" >信访维稳(15分)</th>
                                <th  style="vertical-align:middle" rowspan="2">加分</th>
                                <th  style="vertical-align:middle" rowspan="2">总分</th>
                                <th  style="vertical-align:middle" rowspan="2">排名</th>
                            </tr>
                            <tr class="bg-back">
                                <th  style="vertical-align:middle">出警及时(1)</th>
                                <th  style="vertical-align:middle">警容严谨(1分)</th>
                                <th  style="vertical-align:middle">勘查细致(1分)</th>
                                <th  style="vertical-align:middle">出警得当(1分)</th>
                                <th  style="vertical-align:middle">及时反馈(1分)</th>
                                <th  style="vertical-align:middle">得分</th>
                                <th  style="vertical-align:middle">办案时效(10分)</th>
                                <th  style="vertical-align:middle">认定复核(10分)</th>
                                <th  style="vertical-align:middle">移交材料全面(15分)</th>
                                <th  style="vertical-align:middle">台账和录入及时(12分)</th>
                                <th  style="vertical-align:middle">违法处罚(8分)</th>
                                <th  style="vertical-align:middle">逃逸案件(5分)</th>
                                <th  style="vertical-align:middle">得分</th>
                                <th  style="vertical-align:middle">上报研判(2分)</th>
                                <th  style="vertical-align:middle">预防措施(3分)</th>
                                <th  style="vertical-align:middle">研判质量(5分)</th>
                                <th  style="vertical-align:middle">得分</th>
                                <th  style="vertical-align:middle">现场处置(5分)</th>
                                <th  style="vertical-align:middle">上报信息及时(5分)</th>
                                <th  style="vertical-align:middle">配合协查(15分)</th>
                                <th  style="vertical-align:middle">得分</th>
                                <th  style="vertical-align:middle">信访维稳回复(2分)</th>
                                <th  style="vertical-align:middle">配合处理(3分)</th>
                                <th  style="vertical-align:middle">得分</th>
                            </tr>

                            </thead>

                            <tbody>
                            <?php for($i=0;$i<count($arr2);$i++){?>
                                <tr>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $arr2[$i];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $score_1[$i]['score_1'];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $score_2[$i]['score_2'];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $score_3[$i]['score_3'];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $score_4[$i]['score_4'];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $score_5[$i]['score_5'];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $total1[$i];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $score_6[$i]['score_6'];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $score_7[$i]['score_7'];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $score_8[$i]['score_8'];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $score_9[$i]['score_9'];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $score_10[$i]['score_10'];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $score_11[$i]['score_11'];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $tota2[$i];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $score_12[$i]['score_12'];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $score_13[$i]['score_13'];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $score_14[$i]['score_14'];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $tota3[$i];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $score_15[$i]['score_15'];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $score_16[$i]['score_16'];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $score_17[$i]['score_17'];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $tota4[$i];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $score_18[$i]['score_18'];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $score_19[$i]['score_19'];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $total5[$i];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $score_20[$i]['score_20'];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $total[$i];?></td>
                                    <td style="height: 45px;line-height: 45px;"><?php echo $sort[$i];?></td>
                                </tr>
                            <?php }?>
                            </tbody>
                            <tr>
                                <td colspan="9"  style="border:none;height: 100px;vertical-align:middle">汇总:&nbsp;<input type="text" name="hz" id='hz' value="<?php echo $assessor['HZ'];?>" style="width: 85px;text-align: center;border:none;"></td>
                                <td colspan="9"  style="border:none;height: 100px;vertical-align:middle">部门负责人:&nbsp;<input type="text" name="bmfzr" id='bmfzr' value="<?php echo $assessor['BMFZR'];?>" style="width: 85px;text-align: center;border:none;"></td>
                                <td colspan="10"  style="border:none;height: 100px;vertical-align:middle">审核领导:&nbsp;<input type="text" name="shld" id='shld' value="<?php echo $assessor['SHLD'];?>" style="width: 85px;text-align: center;border:none;"></td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    $(function () {
        //找到所有名字的单元格
        var name = $(".bonus");
        //给这些单元格注册鼠标点击事件
        name.click(function () {
            //找到当前鼠标单击的td
            var tdObj = $(this);
            //保存原来的文本
            var oldText = $(this).text();
            //评分单位
            var score_company = $(this).attr('id');
            //创建一个文本框
            var inputObj = $("<input type='text' value='" + oldText + "'/>");
            //去掉文本框的边框
            inputObj.css("border-width", 0);
            inputObj.click(function () {
                return false;
            });
            //使文本框的宽度和td的宽度相同
            inputObj.width(tdObj.width());
            inputObj.height(tdObj.height());
            //去掉文本框的外边距
            inputObj.css("text-align", "center");
            inputObj.css("font-size", "12px");
            inputObj.attr("class", "form-control");
            //把文本框放到td中
            tdObj.html(inputObj);
            //文本框失去焦点的时候变为文本
            inputObj.blur(function () {
                var newText = $(this).val();
                var reg = /^[\d]+$/g;
                if(!reg.test(newText)){
                    layer.msg("类型不合法!",{
                        time:1000
                    })
                    tdObj.html(oldText);
                }else{
                    tdObj.html(newText);

                    $.post("<?php echo base_url();?>admin/c_comprehensive/set_bonus/",{"score_company":score_company,"bonus":newText},
                        function(data){
                            layer.msg("奖金设置成功!",{
                                time:1000
                            })

                        });
                }
            });
        });

    });

</script>

<script type="text/javascript">
    $('#hz,#bmfzr,#shld').blur(function(){
        var hz = $('#hz').val();
        var bmfzr = $('#bmfzr').val();
        var shld = $('#shld').val();
        var score_month = $('#test3').val();
        $.ajax({
            'url': "<?php echo base_url();?>admin/c_road_tj/set_hz",
            'type':"post",
            'data':{"hz":hz,"bmfzr":bmfzr,"shld":shld,'score_month':score_month},
            success:function(re){

                layer.msg("设置成功!",{
                    time:1000
                })
            }
        });
    })
</script>
<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;
        //年月选择器
        laydate.render({
            elem: '#test3'
            ,type: 'month'
        });

    });
</script>
<script>
    //导出
    $(".export").click(function(){

        var score_month = $('#test3').val();
        layer.confirm('是否导出该表？', {
            btn: ['确定','取消'] //按钮
        }, function(){

            window.location.href = '<?php echo base_url();?>admin/c_road_tj/export?score_month='+score_month;

            layer.closeAll();

        }, function(){
            layer.closeAll();
        });
    });
</script>