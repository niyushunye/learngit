
<link rel="stylesheet" href="<?php echo base_url();?>public/zTree/css/zTreeStyle/zTreeStyle.css">

<script src="<?php echo base_url();?>public/zTree/js/jquery.ztree.core.js"></script>
<script src="<?php echo base_url();?>public/zTree/js/jquery.ztree.excheck.js"></script>



<!--兼容IE8,主要解决在IE8下的一些问题
    1、HTML5的兼容
    2、不同屏幕高度的显示效果
-->
<!--[if IE 8]>
    <script src="<?php echo base_url();?>assets/js/respond.js" ></script>
    <script src="<?php echo base_url();?>assets/js/html5.js"  ></script>
    <link href="<?php echo base_url();?>assets/css/screen.css" rel="stylesheet">-->

<body class="bg-white">
<div class="tab" style="">
    <input type="hidden" value="<?php echo base_url();?>" id="url">
    <div class="tab-body" style="width: 95%;">
        <form id="fileForm" style="display: none;">
            <input type="file"  id="uphoto" style="display: none;" name="car_image[]" multiple>
        </form>
        <br>
        <div class="tab-panel active" id="tab-set" style="">
            <form method="post" class="form-x" method="post" target="_parent">
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">号牌号码：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"  value="" id="hphm">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">号牌种类：</label>
                    </div>
                    <div class="field">
                        <select id="hpzl" class="input">
                            <option value="0">---请选择---</option>
                            <?php foreach ($data1 as $row1) {?>
                                <option value="<?php echo $row1['DMZ'];?>"><?php echo $row1['DMSM1'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">业务类型：</label>
                    </div>
                    <div class="field">
                        <select class="input" id="ywlx">
                            <option value="0">---请选择---</option>
                            <?php foreach ($datas as $row){?>
                                <option value="<?php echo $row['id'];?>"><?php echo $row['task_name'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>

                <input type="hidden" id="h_file">
                <input type="hidden" id="h_file1">
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">车辆图片：</label>
                    </div>
                    <div class="field">
                        <div style="height: 100px;width:90%;border: 1px solid #e1e2ef;" id="img_div">
                        </div>
                        <button id="file_btn" class="button button-small bg-main operate_sub" type="button">上传</button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="label">
                        <label for="rolename">下发部门：</label>
                    </div>
                    <div class="field">
                        <table class="table table-bordered table-hover" style="width: 90%;">
                            <thead>
                            <tr>
                                <th nowrap="nowrap" width="7%"></th>
                                <th nowrap="nowrap" width="37%">部门代码</th>
                                <th nowrap="nowrap">部门名称</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($data as $value): ?>
                            <tr class="tr_class">
                                <td><input class="assign_checkbox"  name="dldm[]" type="radio" value="<?php echo $value['orgnum'].'+'.$value['orgname'];?>"></td>
                                <td><?php echo $value['orgnum'];?></td>
                                <td><?php echo $value['orgname'];?></td>
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
<script type="text/javascript">
    var URL =$("#url").val();
    $("#sub").click(function () {

        var hphm = $("#hphm").val();          //号牌号码
        var hpzl = $("#hpzl").val();          //号牌种类
        var ywlx = $("#ywlx").val();          //业务类型

        if(hphm == "")
        {
            layer.msg('请填写号牌号码！');
            return false;
        }

        if(hpzl == "0")
        {
            layer.msg('请选择号牌种类！');
            return false;
        }

        if (ywlx == "0") {
            layer.msg("请选择业务类型！");
            $("#rolename").focus();
            return false;
        }


        var strs = "";         //上传的图片
        $(".img_class").each(function(){
            if($(this).css("display")=="block")
            {
                strs = $(this).attr('id')+'+'+strs;
            }
        });
       
        /*if(strs == "")
        {
            layer.msg("请上传车辆照片！");
            return false;
        }*/


        var str = "";          //选中的组织部门
        $(".assign_checkbox:radio").each(function()
        {
            if ($(this).is(":checked")==true)
            {
                str = str+$(this).val()+'+';
            }
        }); 

         //获取选中的部门编号
        if(str == "")
        {
            layer.msg("请选择要分配的部门！");
            return false;
        }


        //提交保存
        $.ajax({
              url:URL+'admin/c_task_assignment/task_save',
              type:'post',
              data:{'hphm':hphm,'hpzl':hpzl,'ywlx':ywlx,'str':str,'strs':strs},
              success:function(data)
              {

                  if(data == '1')
                  {
                      layer.msg("添加成功！",{
                          time:1.5*1000
                      },function(){
                          layer.closeAll();
                          parent.window.location.reload();
                      });
                  }else
                      {
                          layer.msg("添加失败,请重试！");
                      }
              }
        });

    });
</script>
<script>
    //上传图片
    $("#file_btn").click(function(){
        $("#uphoto").click();
        $("#uphoto").unbind('change').bind('change',function (){
            //$('#uphoto').on('change',function() {
            var fileData = new FormData(document.getElementById("fileForm"));
            $.ajax({
                url:URL+'admin/c_task_assignment/imageupload',
                type:'post',
                data:fileData,
                contentType: false,
                processData: false,
                success:function(data)
                {
                    //console.log(data);
                    if(data =='1')
                    {
                        layer.msg('请上传jpg、png、jpeg格式的图片！',{
                            time:1.5*1000
                        });
                    }
                    else if(data == '2')
                    {
                        layer.msg('请上传小于2M的图片！',{
                            time:1.5*1000
                        });
                    }
                    else
                    {
                        $("#h_file").val($("#h_file").val()+''+data);
                        var arr=data.split("+");
                        //alert(data1);
                        var arr1 = unique(arr);
                        //alert(arr1);return;
                        for(var i=0;i<arr1.length;i++)
                        {
                            if(arr1[i] != "")
                            {
                                $("#img_div").html($("#img_div").html()+"<div style='width: 98px;float:left;height: 98px;'><img class='img_class' id='"+'assets/uploads/assign_car_image/'+arr1[i] +"'"  +"  style='width: 80px;margin-top:5%;margin-left:5%;float:left;height: 80px;' src='"+URL+'assets/uploads/assign_car_image/'+arr1[i]+"'><div class='delte_img' style='width:12px;cursor:pointer;float:right;border:1px solid white;height:12px;text-align:center;line-height:10px;color:white;background-color:red;font-weight:400;z-index: 100;border-radius: 50%;'>x️</div></div>");
                            }
                        }
                    }
                    //删除图片
                    $(".delte_img").click(function(){
                        $(this).parent().css('display','none');
                        $(this).siblings().css('display','none');
                        $(this).css('display','none');
                    });

                }

            });
        });
    });
    //除去数组中相同的元素
    function unique(arr){
        var len = arr.length;
        var result = []
        for(var i=0;i<len;i++){
            var flag = true;
            for(var j = i;j<arr.length-1;j++){
                if(arr[i]==arr[j+1]){
                    flag = false;
                    break;
                }
            }
            if(flag){
                result.push(arr[i])
            }
        }
        return result;
    }
</script>

</body>
</html>
