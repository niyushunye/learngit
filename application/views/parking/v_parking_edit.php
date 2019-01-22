<body class="bg-white">
<div class="tab" style="">
    <input type="hidden" value="<?php echo base_url();?>" id="url">
    <div class="tab-body" style="width: 95%;">
        <br>
        <div class="tab-panel active" id="tab-set" style="">

            <form method="post" class="form-x" method="post" target="_parent">
                <input type="hidden" value="<?php echo base_url();?>" id="url">
                <input type="hidden" value="<?php echo $dz['id']?>" id="id">
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">停车场名称：</label>
                    </div>
                    <div class="field">
                        <select class="input" id="tccdz">
                            <option value="0">---请选择---</option>
                            <?php foreach ($data as $v){?>
                                <option value="<?php echo $v['id'];?>" <?php if($v['id'] == $dz['parking_fj']){ echo 'selected';}?>><?php echo $v['task_name'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">停车场地址：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" value="<?php echo $dz['parking_dizhi']?>" id="dizhi">
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
<script>
    //    var czsj = {
    //        elem: '#czsj',
    //        format: 'YYYY-MM-DD hh:mm:ss',
    //        min: '2010-01-01', //最小日期
    //        max: '2099-12-31 23:59:59', //最大日期
    //        start: '2016-06-01',    //开始日期
    //        istime: true,
    //        istoday: true,
    //        fixed: false, //是否固定在可视区域
    //        zIndex: 99999999, //css z-index
    //        choose: function(datas){
    //            end.min = datas; //开始日选好后，重置结束日的最小日期
    //            end.start = datas //将结束日的初始值设定为开始日
    //        }
    //    };
    //    var end = {
    //        elem: '#endTime',
    //        format: 'YYYY-MM-DD hh:mm:ss',
    //        min: '2010-01-01', //最小日期
    //        max: '2099-12-31 23:59:59', //最大日期
    //        istime: true,
    //        istoday: true,
    //        fixed: false, //是否固定在可视区域
    //        zIndex: 99999999, //css z-index
    //        choose: function(datas){
    //            start.max = datas; //结束日选好后，重置开始日的最大日期
    //        }
    //    };
    //    laydate(czsj);
    //    laydate(end);
</script>
<script type="text/javascript">

    //新增停车场地址
    $('#sub').click(function(){
        var mingchengid = $('#tccdz').val();
        var mingcheng = $('#tccdz').find('option:selected').text();
        var dizhi = $('#dizhi').val();
        var URL = $('#url').val();
        var id = $('#id').val();
        //alert(URL);
        if(mingchengid == '0'){
            layer.msg("请输入停车场名称！");
            return false;
        }else if(dizhi == ''){
            layer.msg("请输入停车场地址！");
            return false;
        }else{

            $.ajax({
                url:URL+'admin/c_parking/parking_add_update',
                type:'post',
                data:{
                    'mingchengid':mingchengid ,
                    'mingcheng':mingcheng,
                    'dizhi':dizhi,
                    'id':id
                },
                success:function(data)
                {
                    if(data == '1')
                    {
                        layer.msg("修改成功！",{
                            time:1.5*1000
                        },function(){
                            layer.closeAll();
                            parent.window.location.reload();
                        });
                    }else
                    {
                        layer.msg("修改失败,请重试！");
                    }
                }
            })
        }
    })
</script>

</body>
</html>
