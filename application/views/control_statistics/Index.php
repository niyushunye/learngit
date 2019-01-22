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
            document.getElementById(header).style.width = '100px';
        }
    }
    window.onload = function (){
        line('header',2,'#6e6e6e',1);
        //目标单元格，线的宽度，线的颜色，线的条数，1~3，
        //line('two',2,'black',2);
    }
    window.onresize = function(){		//当窗口改变时，也随之改变
//可以加上检测 宽度高度是否变化在执行函数
        line('header',2,'#6e6e6e',1);
    }

</script>
<div style="margin:20px;">
    <div>
        <div>
            <div>
                <div>
                    <div class="right_button x11-move" style="margin-top:-6px;margin-left:6px;float:left; ">
                        <a href="#" class="export button button-small border border-green add">导出</a> 
                    </div>
                </div>
                <form class="form-horizontal" name="" method="post" action="">
                    <div class="ibox-content">
                        <canvas id="line" style="display:none;"></canvas>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr class="bg-back">
                                <th rowspan="2" id="header" style="width: 100px;" colspan="2">
                                    <span style="float:right;margin-top: -20px;">考核任务</span><br/>
                                    <div style="float:left;">考核单位</div>
                                </th>
                                <th colspan="2">四类重点车</th>
                                <th colspan="2">三驾</th>
                                <th colspan="3">三乱</th>
                                <th >两牌</th>
                                <th colspan="2">两闯</th>
                                <th colspan="2">三车</th>
                                <th >两无</th>
                                <th rowspan="2">机动车未检验</th>
                                <th rowspan="2">不礼让斑马线</th>
                                <th rowspan="2">非机动车行人违法</th>
                                <th rowspan="2">合计</th>
                               <!-- <th rowspan="2">备注</th>-->
                            </tr>
                            <tr class="bg-back">

                                <th >超载</th>
                                <th >超员</th>

                                <th >酒驾 醉驾</th>
                                <th >毒驾</th>

                                <th >乱停车</th>
                                <th >乱变道</th>
                                <th >乱用灯光</th>

                                <th >假牌套牌</th>

                                <th >闯禁令</th>
                                <th >闯红灯</th>

                                <th >电动车</th>
                                <th >工程运输车</th>

                                <th >无牌无证</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for($i=0;$i<count($arr2);$i++){?>
                               <tr>
                                   <td  rowspan="2" style="height:60px;line-height: 60px;" ><?php echo $arr2[$i];?></td>
                                   <td>月总量</td>
                                   <?php foreach ($arr_total[$i] as $row){?>
                                        <td><?php echo $row[0]['total']?></td>
                                   <?php }?>
                                   <!-- 月总量合计!-->
                                   <td><?php echo $month_arr_total[$i];?></td>
                               </tr>
                                <tr>
                                    <td>已完成量</td>
                                    <?php foreach ($alr_total[$i] as $row){?>
                                        <td><?php echo $row[0]['total']?></td>
                                    <?php }?>
                                    <!-- 月完成量合计!-->
                                    <td><?php echo $month_alr_total[$i];?></td>
                                </tr>
                            <?php }?>
                            <tr>
                                <td rowspan="2" style="height:60px;line-height: 60px;">合计</td>
                                <td>月总量</td>
                                <?php foreach ($task_arr_total as $v){?>
                                    <td><?php echo $v;?></td>
                                <?php }?>
                                <td><?php echo $total_nums;?></td>
                            </tr>
                            <tr>
                                 <td>已完成量</td>
                                <?php foreach ($task_alr_total as $v){?>
                                    <td><?php echo $v;?></td>
                                <?php }?>
                                <td><?php echo $atotal_nums;?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>

<script>

    //导出
    $(".export").click(function(){   
        
        layer.confirm('是否导出该表？', {
            btn: ['确定','取消'] //按钮
        }, function(){

            window.location.href = '<?php echo base_url();?>admin/c_control_statistics/export';

            layer.closeAll();
            
        }, function(){
            layer.closeAll();
        });
    });
</script>
