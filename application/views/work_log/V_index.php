<style type="text/css">
    #gif {
        position: relative;
        float: left;
        margin-top: -33px;
        margin-left: 1100px;
    }
</style>
<body class="bg-white fixed">
<div style="margin:20px;">
    <div>
        <div>
            <div>
                <div>
                    <div style="margin-bottom: 20px; overflow: auto;float: left">
                        <form method="post" >
                            <div class="filed input-group">
                                <div>
                                    <span>部门名称：</span>
                                    <select id="bmdm" style="height: 26px;width: 195px" name="bmdm">
                                        <option value="0">---请选择---</option>
                                        <?php foreach ($orgnum as $k => $v){?>
                                            <option value="<?php echo $v['orgnum']?>"><?php echo $v['orgname']?></option>
                                        <?php }?>
                                    </select>

                                    <span>日志类型：</span>
                                    <select id="type" style="height: 26px;width: 195px" name="type">
                                        <option value="1" selected>日常</option>
                                        <option value="2">党建</option>
                                        <option value="3">法制</option>
                                        <option value="4">宣传</option>
                                        <option value="5">指挥中心</option>
                                        <option value="99">其他</option>
                                    </select>
                                    &nbsp;&nbsp;
                                    <span>民警编码：</span><input type="text" id="czmj" name="mjbm"
                                                             style="height: 26px;width: 195px;margin-left: 5px"
                                                             value=""> &nbsp;&nbsp;
                                    <span>时间：</span><input type="text" style="height: 24px" name="time" value="" id="test3" autocomplete="off">
                                    &nbsp;&nbsp;
                                    <button type="button" class="button button-small border border-yellow operate_sub"
                                             id="search">搜索
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div style="float: left;width: 60px;margin-left: 25px;margin-top: -5px;display:none" id='gif'><img src="<?php echo base_url(); ?>assets/img/a.gif"></div>

                    <div class="right_button " style="width:100px;float: left;margin-top: 0;margin-left: 20px">
                        <a href="#" class="button button-small border border-green export">导出</a>
                    </div>
                </div>
                <form class="form-horizontal" name="" method="post" action="">
                    <div class="ibox-content">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="bg-back" id="hao">
                                    <th>警员</th>
                                    <th>1号</th>
                                    <th>2号</th>
                                    <th>3号</th>
                                    <th>4号</th>
                                    <th>5号</th>
                                    <th>6号</th>
                                    <th>7号</th>
                                    <th>8号</th>
                                    <th>9号</th>
                                    <th>10号</th>
                                    <th>11号</th>
                                    <th>12号</th>
                                    <th>13号</th>
                                    <th>14号</th>
                                    <th>15号</th>
                                    <th>16号</th>
                                    <th>17号</th>
                                    <th>18号</th>
                                    <th>19号</th>
                                    <th>20号</th>
                                    <th>21号</th>
                                    <th>22号</th>
                                    <th>23号</th>
                                    <th>24号</th>
                                    <th>25号</th>
                                    <th>26号</th>
                                    <th>27号</th>
                                    <th>28号</th>
                                    <th>29号</th>
                                    <th>30号</th>
                                    <th>出勤数</th>
                                    <th>未出勤数</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                            </tbody>
                        </table>
                        <div id="error"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
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
    $('.export').click(function (){
        var time = $('#test3').val();       //时间
        var bmdm = $('#bmdm').val();       //部门代码
        var mjbm = $('#czmj').val();       //民警代码
        var type = $('#type').val();       //日志类型

        layer.confirm('是否导出该表？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            window.location.href = '<?php echo base_url();?>admin/c_work_logtj/export?time='+time+'&bmdm='+bmdm+'&mjbm='+mjbm+'&type='+type;
            layer.closeAll();
        }, function(){
            layer.closeAll();
        });
    });
</script>
<script>
    $('#search').click(function (){
        var bmdm = $('#bmdm').val();
        var mjbm = $('#czmj').val();
        var type = $('#type').val();  //开始时间
        var time = $('#test3').val();    //结束时间
        $('#gif').css('display', 'block');
        $('#gif').addClass('gif');
        $.ajax({
            url:'<?php echo base_url()?>//admin/c_work_logtj/search',
           type:'post',
           data:{
               'bmdm':bmdm,
               'mjbm':mjbm,
               'type':type,
               'time':time
           },
           success:function(data)
           {
               if(data == 1){
                   var str = "暂无数据";
                   $("#tbody").html(str);
                   $('#gif').css('display', 'none');
               }else{
                   var data1 = eval('(' + data + ')');
                   var str = "";
                   var ccc = "";
                   var bbb = "";
                   for(var a = 1; a <= data1[0]['kaoqin'].length; a++){
                       ccc += "<th>"+ a+"号" +"</th>"
                   }
                   bbb = "<th>警员</th>"+ ccc + "<th>出勤数</th><th>未出勤数</th>";
                   $("#hao").html(bbb);
                   for (var i = 0; i < data1.length; i++) {
                       str += "<tr>";
                       str += "<td>" + data1[i]['name'] + "</td>";
                       for (var k = 0; k < data1[i]['kaoqin'].length; k++){
                           if(data1[i]['kaoqin'][k][k+1] != "正常上班"){
                               str += "<td style='color:red'> " + data1[i]['kaoqin'][k][k+1] + "</td>";
                           }else{
                               str += "<td> " + data1[i]['kaoqin'][k][k+1] + "</td>";
                           }
                       }
                       str += "<td>" + data1[i]['chuqin'] + "</td>";
                       str += "<td>" + data1[i]['weiqin'] + "</td>";
                       str += "</tr>";
                   }
                   $("#tbody").html(str);
                   $('#gif').css('display', 'none');
               }
           }
        });
    });
</script>
</html>