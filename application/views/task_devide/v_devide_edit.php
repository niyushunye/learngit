<body class="bg-white">
<div class="tab" style="">
    <input type="hidden" value="<?php echo base_url();?>" id="url">
    <div class="tab-body" style="width: 95%;">
        <br>
        <div class="tab-panel active" id="tab-set" style="">
            <form method="post" class="form-x" method="post" target="_parent">
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">号牌号码：</label>
                    </div>
                    <div>
                        <select class="input" id="hphm" style="width: 63%;">
                            <option value="0">---请选择---</option>
                            <?php foreach ($data1 as $row){?>
                                <option value="<?php echo $row['id']?>" <?php if($row['id'] == $datas[0]['id']){ echo "selected";}?>><?php echo $row['hphm'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">处置民警：</label>
                    </div>
                    <div class="field">
                        <table class="table table-bordered table-hover" style="width: 90%;">
                            <thead>
                            <tr>
                                <th nowrap="nowrap" width="7%"><!--<input type="checkbox" id = "allchoose">--></th>
                                <th nowrap="nowrap">警员编号</th>
                                <th nowrap="nowrap">真实姓名</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($data as $value): ?>
                                <tr class="tr_class">
                                    <td><input class="assign_checkbox"  name="dldm[]" type="radio" <?php if($value['accounts'] == $datas[0]['jybh']){ echo "checked";}?> value="<?php echo $value['accounts'].'::'.$value['realname'];?>"></td>
                                    <td><?php echo $value['accounts'];?></td>
                                    <td><?php echo $value['realname'];?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
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
        //提交保存
        var hphm = $("#hphm").val();           //号牌号码(其实拿的是id)
        if(hphm == "0")
        {
            layer.msg("请选择要分配的车牌号码！");
            return false;
        }
        var str = "";
        $(".assign_checkbox:radio").each(function()
        {
            if ($(this).is(":checked")==true)
            {
                str = $(this).val();
            }
        });
        //获取选中的警员编号
        if(str == "")
        {
            layer.msg("请选择要分配的警员！");
            return false;
        }
        //alert(str);
        $.ajax({
            url:URL+'admin/c_task_devide/devide_saves',
            type:'post',
            data:{
                'hphm': hphm,
                'str':str
            },
            success:function(data)
            {
                //alert(data);

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
        });

    });
</script>

</body>
</html>


