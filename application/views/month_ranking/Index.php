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
    window.onresize = function(){		//当窗口改变时，也随之改变
//可以加上检测 宽度高度是否变化在执行函数
        line('header',2,'#6e6e6e',2);
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
                                <th rowspan="2" id="header">
                                    <span style="float:right;margin-top: -20px;">项目</span><br/>
                                    <div style="float:left;">单位</div>
                                    <div style="float:right;">得分</div>
                                </th>
                                <th colspan="3">隐患歼灭战工作考核</th>
                                <th colspan="3">当月应检车辆完成情况</th>
                                <th colspan="2">五类车检验工作考核</th>
                                <th colspan="2">按本月完成中队任务数得分及排名情况</th>
                            </tr>
                            <tr class="bg-back">

                                <th >任务数</th>
                                <th >完成数</th>
                                <th >得分数</th>
                                <!-- <th >拨款数</th> -->

                                <th >任务数</th>
                                <th >完成数</th>
                                <th >得分数</th>
                               <!--  <th >拨款数</th> -->

                                <th >完成数</th>
                                <th >得分</th>
                               <!--  <th >拨款数</th> -->

                                <th >总分</th>
                                <th >排名</th>
                                <!-- <th >拨款总数</th> -->
                            </tr>
                            </thead>
                            <tbody>
                                <?php for($i=0;$i<count($arr2);$i++){?>
                                    <tr>
                                        <td><?php echo $arr2[$i];?></td>
                                        <td><?php echo $data['p'][$i][0]['nums'];?></td>
                                        <td><?php echo $data1['p'][$i][0]['anums'];?></td>
                                        <!-- <td><?php echo $datac['m'][$i][0]?></td> -->
                                        <td><?php echo $array1['m'][$i][0];?></td>
                                        <td><?php echo $data['r'][$i][0]['nums'];?></td>
                                        <td><?php echo $data1['r'][$i][0]['anums'];?></td>
                                        <td><?php echo $datac['n'][$i][0]?></td>
                                        <!-- <td><?php echo $array2['n'][$i][0];?></td> -->
                                        <td><?php echo $data1['q'][$i][0]['anums'];?></td>
                                        <td><?php echo $datac['k'][$i][0]?></td>
                                        <!-- <td><?php echo $array3['p'][$i][0];?></td> -->
                                        <td><?php echo $datag['c'][$i][0]?></td>
                                        <td><?php echo $dataj['h'][$i][0]?></td>
                                        <!-- <td><?php echo $total['t'][$i][0]?></td> -->
                                    </tr>
                                <?php }?>
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

            window.location.href = '<?php echo base_url();?>admin/c_month_ranking/export';

            layer.closeAll();
            
        }, function(){
            layer.closeAll();
        });
    });
</script>