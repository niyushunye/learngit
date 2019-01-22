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
</script>
<div style="margin:20px;">
    <div>
        <div>
            <div>
                <form method="post" style="float: left" action="<?php echo base_url()?>admin/c_department/search">

                    <span>开始时间：</span><input type="text" id="startTime" name="startTime"  style="width: 200px"  autocomplete="off" <?php if($startTime):?> value="<?php echo date('Y-m-d H:i',$startTime);?>" <?php endif;?>>

                    <span>结束时间：</span><input type="text" id="endTime" name="endTime"  style="width: 200px" autocomplete="off" <?php if($endTime):?>  value="<?php echo date('Y-m-d H:i',$endTime);?>" <?php endif;?>>

                    <button type="button" class="button button-small border border-yellow operate_sub" id="search">搜索</button>
                </form>
                <span style="float: left;margin-left: 20px;display: none" id='gif'><img src="<?php echo base_url();?>assets/img/a.gif"></span>
                <div class="right_button x11-move" style="margin-left:30px;margin-top:0px; float:left; ">
                    <a href="#" class="export button button-small border border-green add">导出</a>
                </div>
                <form class="form-horizontal" name="" method="post" action="">
                    <div class="ibox-content">
                        <table class="table table-bordered table-hover">
                            <thead style="background-color: #F2F9FD">
                            <tr class="bg-back">
                                <th rowspan="3" style="vertical-align:middle">
                                    部门名称
                                </th>
                                <th rowspan="3" style="vertical-align:middle">警员编号</th>
                                <th rowspan="3" style="vertical-align:middle">纠违合计</th>
                                <th colspan="2">非现场执法</th>
                                <th colspan="1" >现场执法</th>
                                <th colspan="1" >强制措施.违法处理通知书</th>
                                <th rowspan="3" style="vertical-align:middle">得分</th>
                                <th rowspan="3" style="vertical-align:middle">排名</th>
                            </tr>
                            <tr class="bg-back">

                                <th rowspan="2" style="vertical-align:middle">纠违总数</th>
                                <th rowspan="2" style="vertical-align:middle">违停数量</th>

                                <!-- <th >拨款数</th> -->
                                <th colspan="1">简易程序</th>
                                <!--  <th >拨款数</th> -->

                                <th rowspan="2" style="vertical-align:middle">总量</th>
                                <!--  <th >拨款数</th> -->
                                <!-- <th >拨款总数</th> -->
                            </tr>
                            <tr>
                                <th>总量</th>
                            </tr>
                            </thead>
                            <tbody id="neirong">

<!--                            --><?php //foreach ($data as $k => $v){?>
<!--                                <tr>-->
<!--                                    <th>--><?php //echo $v['orgname']?><!--</th>-->
<!--                                    <th>--><?php //echo $v['orgnum']?><!--</th>-->
<!--                                    <th>--><?php //echo $v['combined']?><!--</th>-->
<!--                                    <th>--><?php //echo $v['enforcement']?><!--</th>-->
<!--                                    <th>--><?php //echo $v['stop_number']?><!--</th>-->
<!--                                    <th>--><?php //echo $v['total_enforcement']?><!--</th>-->
<!--                                    <th>--><?php //echo $v['measures']?><!--</th>-->
<!--                                    <th>--><?php //if($v['score'] == ''){echo 0;}else{ echo $v['score'];}?><!--</th>-->
<!--                                    <th>--><?php //echo $k + 1 ?><!--</th>-->
<!--                                </tr>-->
<!--                            --><?php //}?>
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

        var startTime = $('#startTime').val();
        var endTime = $('#endTime').val();

        layer.confirm('是否导出该表？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            window.location.href = '<?php echo base_url();?>admin/c_department/export?startTime='+startTime+'&&endTime='+endTime;
            layer.closeAll();
        }, function(){
            layer.closeAll();
        });
    });
</script>
<script>
    var start = {
        elem: '#startTime',
        format: 'YYYY-MM-DD hh:mm',
        min: '2010-01-01', //最小日期
        max: '2099-12-31 23:59:59', //最大日期
        start: "<?php echo date('Y-m-d',time());?>",    //开始日期
        istime: true,
        istoday: true,
        fixed: false, //是否固定在可视区域
        zIndex: 99999999, //css z-index
        choose: function(datas){
            end.min = datas; //开始日选好后，重置结束日的最小日期
            end.start = datas //将结束日的初始值设定为开始日
        }
    };
    var end = {
        elem: '#endTime',
        format: 'YYYY-MM-DD hh:mm',
        min: '2010-01-01', //最小日期
        max: '2099-12-31 23:59:59', //最大日期
        istime: true,
        istoday: true,
        fixed: false, //是否固定在可视区域
        zIndex: 99999999, //css z-index
        choose: function(datas){
            start.max = datas; //结束日选好后，重置开始日的最大日期
        }
    };
    laydate(start);
    laydate(end);
</script>
<script>
    $('#search').click(function () {
        var startTime = $('#startTime').val();
        var endTime = $('#endTime').val();
        $('#gif').css('display','block');
        $.ajax({
            url: '<?php echo base_url()?>admin/c_department/search',
            type: 'post',
            data: {'startTime': startTime, 'endTime': endTime},
            success: function (data) {
                var data1 = eval('(' + data + ')');

                console.log(data1);
                var str = '';
                for (var i = 0; i < data1['data'].length; i++) {
                    var paiming = i + 1;
                    str += "<tr>";
                    str += "<th>" + data1['data'][i]['orgname'] + "</th>";
                    str += "<th>" + data1['data'][i]['orgnum'] + "</th>";
                    str += "<th>" + data1['data'][i]['combined'] + "</th>";
                    str += "<th>" + data1['data'][i]['enforcement'] + "</th>";
                    str += "<th>" + data1['data'][i]['stop_number'] + "</th>";
                    str += "<th>" + data1['data'][i]['total_enforcement'] + "</th>";
                    str += "<th>" + data1['data'][i]['measures'] + "</th>";
                    str += "<th>" + data1['data'][i]['score'] + "</th>";
                    str += "<th>" + paiming + "</th>";
                    str += "</tr>";
                }
                $("#neirong").html(str);
                $('#gif').css('display','none');
            }
        });
    });
</script>