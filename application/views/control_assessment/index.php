<body class="bg-white fixed">
<div style="margin:20px;">
    <div>
        <div>
            <div>
                <div>
                        <form method="post" action="<?php echo base_url()?>admin/c_control_assessment/search"> <!-- <?php echo base_url()?>admin/c_control_assessment/index -->
                            <div class="filed input-group">
                                <div class = "search2">
                                    <span>部门名称：</span>
                                    <select  id="bmmc"  style="height: 26px;width: 200px" name="bmmc">
                                        <option value="0">---请选择---</option>
                                        <?php foreach ($orginfo as $v){?>
                                            <option value="<?php echo $v['orgnum'];?>" <?php if($bmmc == $v['orgnum']):?> selected='' <?php endif;?> ><?php echo $v['orgname'];?></option>
                                        <?php }?>
                                    </select> &nbsp;&nbsp;                           
 
                                    <span>号牌号码：</span><input type="text" id="hphm" name="hphm"  style="width: 200px" value="<?php echo $hphm;?>"> &nbsp;&nbsp;
                                     <span>号牌种类：</span>
                                    <select  id="hpzl"  style="height: 26px;width: 200px" name="hpzl">
                                        <option value="0">---请选择---</option>
                                        <?php foreach ($frm_code as $v){?>
                                            <option value="<?php echo $v['DMZ'];?>" <?php if($hpzl == $v['DMZ']):?> selected='' <?php endif;?> ><?php echo $v['DMSM1'];?></option>
                                        <?php }?>
                                    </select> &nbsp;&nbsp;<br>

                                   &nbsp;<span>处置民警：</span><input type="text" id="czr" name="czr"  style="width: 200px" value="<?php echo $czr;?>"> &nbsp;&nbsp;

   
                                   <span>开始时间：</span><input type="text" id="startTime" name="startTime"  style="width: 200px" <?php if($startTime):?> value="<?php echo date('Y-m-d H:i',$startTime);?>" <?php endif;?> > &nbsp;&nbsp;

                                    <span>结束时间：</span><input type="text" id="endTime" name="endTime"  style="width: 200px" <?php if($endTime):?>  value="<?php echo date('Y-m-d H:i',$endTime);?>" <?php endif;?> > &nbsp;&nbsp;


                                    <button type="submit" class="button button-small border border-yellow operate_sub" id="search">搜索</button>
                                </div>
                            </div>
                        </form>

                    <div class="right_button x11-move" style="margin-top:-30px; ">
                        <a href="#" class="button button-small border border-green add">新增</a>
                    </div>
                </div>
                <form class="form-horizontal" name="" method="post" action="">
                    <div class="ibox-content">
                        <table class="table table-bordered table-hover" id="tableid">
                            <thead>
                            <tr class="bg-back">
                                <!-- <th>序号</th> -->
                                <th>部    门</th>                           
                                <th>号牌号码</th>
                                <th>号牌种类</th>
                                <th>违法类型</th>
                                <th>业务种类</th>
                                <th>违法编号</th>
                                <th>处置时间</th>
                                <th>处置结果</th>
                                <th>是否有效</th>
                                <th>处置民警</th>
                                <th>操    作</th> 
                            </tr>
                            </thead>
                            <tbody id="tbody">
                                <?php foreach ($data as $value): ?>
                                    <tr id="<?php echo $value['id'];?>">
                                        <!-- <td><?php echo $value['id'];?></td> -->
                                        <td>[<?php echo $value['bmdm'];?>]<?php echo $value['bmmc'];?></td>
                                        <td><?php echo $value['hphm'];?></td>
                                        <td><?php echo $value['hpzl_fanyi_result'];?></td>
                                        <td title="<?php echo $value['name'];?>" style="cursor: pointer">

                                            <?php
                                           if(mb_strlen($value['name'])>30){

                                               echo $value['rwlx'].'-'.mb_substr($value['name'],0,30).'......';
                                           }else{
                                                echo  $value['rwlx'].'-'.$value['name'];
                                           }
                                        ?> 


                                        </td>
                                        <td>
                                            <?php if($value['ywzl'] == '1'):?>
                                                非现场
                                            <?php elseif($value['ywzl'] == '2'):?>
                                                简易程序
                                            <?php else:?>
                                                强制措施
                                            <?php endif;?>
                                        </td>
                                        <td><?php echo $value['bh'];?></td>
                                        <td><?php echo date('Y-m-d H:i',$value['czsj']);?></td>
                                        <td><?php echo $value['czjg'];?></td>
                                        <td><?php if($value['sfyx'] == '1'){echo '是';} else{echo "否";}?></td>
                                        <td><?php echo $value['czr'];?>[<?php echo $value['jybh'];?>]</td>
                                        <td>
                                            <a href="#" hfht = "<?php echo $value['id'];?>" class="edit button button-small border border-blue operate_sub">编辑</a>
                                            <a href="#" hfht = "<?php echo $value['id'];?>" class="delete button button-small border border-gray operate_sub">删除</a>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <ul>
                           <?php if($type == 1):?> <?php echo $this->pagination->create_links(); ?> <?php endif;?> <span class="total" id='link'>共 <?php echo $total;?> 条</span>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
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

<!-- <script type="text/javascript">
   //条件检索查询
   $('#search').click(function(){

        //获取开始时间
        var startTime = $('#startTime').val();
        //获取结束时间
        var endTime = $('#endTime').val();
        //获取号牌号码
        var hphm = $('#hphm').val();
        //获取处置民警
        var czr = $('#czr').val();
        //获取号牌种类
        var hpzl = $('#hpzl').val();
        //获取部门名称(传的是部门代码)
        var bmmc = $('#bmmc').val();
        
        $.ajax({
          'url': "<?php echo base_url();?>admin/c_control_assessment/search",
          'type':"post",
          'data':{'startTime':startTime,'endTime':endTime,'hphm':hphm,'czr':czr,'hpzl':hpzl,'bmmc':bmmc}, 
           success:function(re){

                if(re=='0'){
                    window.location.reload();
                    return false;
                }

                var datas = eval('('+re+')');
                //获取查询的总数
                var total =datas.count;


                if(total==0){
                      $("#tbody").html('');
                      $("#link").html('<span class="total">共 '+total+' 条</span>');
                }else{
                     
                     var data = datas.data;
                     var str = "";

                     for(var i=0;i<data.length;i++){
                        
                        str += "<tr id='"+data[i].id+"'>";
                        str += "<td>"+data[i].id+"</td>";
                        str += "<td>"+data[i].hphm+"</td>";
                        str += "<td>"+data[i].DMSM1+"</td>";
                        str += "<td>"+data[i].name+"</td>";
                        str += "<td>";
                            if(data[i].ywzl == '1'){
                                str += "非现场";
                            }

                            if(data[i].ywzl == '2'){
                                str += "简易程序";
                            }

                            if(data[i].ywzl == '3'){
                                str += "强制措施";
                            }
                        str += "</td>";
                        str += "<td>"+data[i].bh+"</td>";
                        str += "<td>"+timestampToTime(data[i].czsj)+"</td>";
                        str += "<td>"+data[i].czjg+"</td>";
                        str += "<td>";
                            if(data[i].sfyx == '1'){
                                str += "是";
                            }

                            if(data[i].sfyx == '0'){
                                str += "否";
                            }
                        str += "</td>";

                        str += "<td>"+data[i].bmdm+"</td>";
                        str += "<td>"+data[i].bmmc+"</td>";
                        str += "<td>"+data[i].czr+"</td>";
                        str += "<td>"+data[i].jybh+"</td>";
                        str += "<td>";
                        str += "<a href='#'  hfht='"+data[i].id+"' class='edit button button-small border border-blue operate_sub'>编辑</a>" ;
                        str += " <a href='#'  hfht='"+data[i].id+"' class='delete button button-small border border-gray operate_sub'>删除</a>";
                        str += "</td>";
                        str += "</tr>";

                      }

                      $("#tbody").html(str);  
                      $("#link").html('<?php echo $this->pagination->create_links(); ?><span class="total">共 '+total+' 条</span>');

                }
           
           }
        });


   })

    function timestampToTime(timestamp) {
            var date = new Date(timestamp * 1000);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
            Y = date.getFullYear() + '-';
            M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
            D = date.getDate() + ' ';
            h = date.getHours() + ':';
            m = date.getMinutes();
            //s = date.getSeconds();
            return Y+M+D+h+m;
        }

</script> -->


<script>

    //删除
    $(".delete").click(function(){   
        var did = $(this).attr('hfht');

        //获取开始时间
        var startTime = $('#startTime').val();
        //获取结束时间
        var endTime = $('#endTime').val();
        //获取号牌号码
        var hphm = $('#hphm').val();
        //获取处置民警
        var czr = $('#czr').val();
        //获取号牌种类
        var hpzl = $('#hpzl').val();
        //获取部门名称(传的是部门代码)
        var bmmc = $('#bmmc').val();


        //获取标签的行数
        //var table_rows = $("#tableid").find("tr").length-1;

        layer.confirm('确定删除该信息？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post('<?php echo base_url();?>admin/c_control_assessment/delete/',{"did":did,"startTime":startTime,"endTime":endTime,"hphm":hphm,"czr":czr,"hpzl":hpzl,"bmmc":bmmc},function(data){
                if(data != '0'){   

                    layer.msg("删除成功！",{
                        time:1000
                    },function(){
                        $("#"+did).remove(); 
                        var num = data;
                        $("#link").html('<span class="total">共 '+num+' 条</span>');

                    });


                }else{
                    layer.msg("记录不存在,刷新！",{time:1000},function(){
                        window.location.reload();
                    });
                }
            })
        }, function(){
            layer.closeAll();
        });
    });

    //新增
    $(".add").click(function(){
        layer.open({
            type:2,
            title:'新增',
            skin:'layui-layer-lan',
            area:['60%','70%'],
            content: ['<?php echo base_url();?>admin/c_control_assessment/add/', 'yes']
        })
    });

    //编辑
    $(".edit").click(function(){
        var id = $(this).attr('hfht');
        layer.open({
            type:2,
            title:'编辑',
            skin:'layui-layer-lan',
            area:['60%','70%'],
            content: ['<?php echo base_url();?>admin/c_control_assessment/edit/'+id, 'yes']
        })
    });
</script>
</html>