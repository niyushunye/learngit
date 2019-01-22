<body class="bg-white">
<div class="tab" style="">
    <input type="hidden" value="<?php echo base_url(); ?>" id="url">
    <div class="tab-body" style="width: 95%;">
        <br>
        <div class="tab-panel active" id="tab-set" style="">
            <form id="fileForm" style="display: none;">
                <input type="file" id="uphoto" style="display: none;" name="car_image[]" multiple>
            </form>
            <form method="post" class="form-x" method="post" target="_parent">
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">号牌号码：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" value="" id="hphm">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">号码种类：</label>
                    </div>
                    <div class="field">
                        <select class="input" id="hpzl">
                            <option value="0">---请选择---</option>
                            <?php foreach ($data1 as $v) { ?>
                                <option value="<?php echo $v['DMZ']; ?>"><?php echo $v['DMSM1']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">当事人：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" value="" id="dsr">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">身份证号：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" value="" id="sfzmhm">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">处置时间：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="inbound_time" name="inbound_time"
                               value="<?php echo date('Y-m-d H:i'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">处置结果：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" value="" id="czjg">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">停车场名称：</label>
                    </div>
                    <div class="field">
                        <select class="input" id="tccmc">
                            <option value="0">---请选择---</option>
                            <?php foreach ($parking as $v) { ?>
                                <option value="<?php echo $v['id']; ?>"><?php echo $v['task_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">停车场地址：</label>
                    </div>
                    <div class="field">
                        <select class="input" id="tccdz">
                            <option value="0">---请选择---</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">组织机构编码：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" disabled value="<?php echo $data2['orgnum'] ?>" id="orgnum">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">组织机构名称：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" disabled value="<?php echo $data2['orgname'] ?>" id="orgname">
                    </div>
                </div>
                <input type="hidden" id="h_file">
                <input type="hidden" id="h_file1">
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">查处照片：</label>
                    </div>
                    <div class="field">
                        <div style="height: 100px;width:90%;border: 1px solid #e1e2ef;" id="img_div">
                        </div>
                        <button id="file_btn" class="button button-small bg-main operate_sub" type="button">上传</button>
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
                                    <td><input class="assign_checkbox" name="dldm[]" type="radio"
                                               value="<?php echo $value['accounts'] . '::' . $value['realname']; ?>">
                                    </td>
                                    <td><?php echo $value['accounts']; ?></td>
                                    <td><?php echo $value['realname']; ?></td>
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

<script>
    $('#tccmc').change(function () {
        var id = $(this).val();
        $.ajax({
            url: URL + 'admin/c_outbound_management/sel_rep_info',
            type: 'post',
            data: {
                'id': id
            },
            success: function (data) {
                $('#tccdz').empty();
                $('#tccdz').append(data);
            }
        });
    })
</script>

<script>
    var inbound_time = {
        elem: '#inbound_time',
        format: 'YYYY-MM-DD hh:mm:ss',
        min: '2010-01-01', //最小日期
        max: '2099-12-31 23:59:59', //最大日期
        start: '2016-06-01',    //开始日期
        istime: true,
        istoday: true,
        fixed: false, //是否固定在可视区域
        zIndex: 99999999, //css z-index
        choose: function (datas) {
            end.min = datas; //开始日选好后，重置结束日的最小日期
            end.start = datas //将结束日的初始值设定为开始日
        }
    };
    /*var end = {
        elem: '#endTime',
        format: 'YYYY-MM-DD hh:mm:ss',
        min: '2010-01-01', //最小日期
        max: '2099-12-31 23:59:59', //最大日期
        istime: true,
        istoday: true,
        fixed: false, //是否固定在可视区域
        zIndex: 99999999, //css z-index
        choose: function(datas){
            start.max = datas; //结束日选好后，重置开始日的最大日期
        }
    };*/
    laydate(inbound_time);
    //laydate(end);
</script>
<script type="text/javascript">
    var URL = $("#url").val();
    //验证当前车牌号是否已近入过库
    $("#hphm").blur(function () {
        var hphm = $(this).val();
        $.ajax({
            'url': URL + 'admin/c_inbound_management/check_hphm',
            'type': "post",
            'data': {'hphm': hphm},
            success: function (re) {
                if (re == 1) {
                    layer.msg("号牌已入库！");
                    $("#hphm").focus();
                    return false;
                }

            }
        });
    });


    $("#sub").click(function () {

        //提交保存
        var hphm = $("#hphm").val();           //号牌号码
        var hmzl = $("#hpzl").val();           //号码种类
        var dsr = $("#dsr").val();             //当事人
        var sfzmhm = $("#sfzmhm").val();       //身份证号
        var czsj = $("#inbound_time").val();   //处置时间
        var czjg = $("#czjg").val();           //处置结果
        var tccmc = $("#tccmc").val();         //停车场名称
        var tccdz = $("#tccdz").val();         //停车场地址
        var orgnum = $("#orgnum").val();       //组织机构编码
        var orgname = $("#orgname").val();     //组织机构名称

        if (hphm == "") {
            layer.msg("请填写号牌！");
            $("#hmzl").focus();
            return false;
        }

        if (hmzl == '0') {
            layer.msg("请选择号牌种类！");
            $("#hmzl").focus();
            return false;
        }

        if (dsr == "") {
            layer.msg("请填写当事人！");
            $("#dsr").focus();
            return false;
        }

        if (sfzmhm == "") {
            layer.msg("请填写身份证号码！");
            $("#sfzmhm").focus();
            return false;
        } else {

            var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
            if (reg.test(sfzmhm) === false) {
                layer.msg("请输入正确的身份证号码！");
                $("#sfzmhm").focus();
                return false;
            }

        }

        if (czsj == "") {
            layer.msg("请填写处置时间！");
            $("#czsj").focus();
            return false;
        }

        if (czjg == "") {
            layer.msg("请填写处置结果！");
            $("#czjg").focus();
            return false;
        }

        if (tccmc == "") {
            layer.msg("请填写停车场名称！");
            $("#tccmc").focus();
            return false;
        }

        if (tccdz == "") {
            layer.msg("请填写停车场地址！");
            $("#tccdz").focus();
            return false;
        }

        var strs = "";    // 车辆图片
        $(".img_class").each(function () {
            if ($(this).css("display") == "block") {
                strs = $(this).attr('id') + '+' + strs;
            }
        });


        if (strs == "") {
            layer.msg("请上传查处照片！");
            return false;
        }


        var str = "";    //处置人
        $(".assign_checkbox:radio").each(function () {
            if ($(this).is(":checked") == true) {
                str = $(this).val();
            }
        });

        if (str == "") {
            layer.msg("请选择要分配的警员！");
            return false;
        }


        $.ajax({
            url: URL + 'admin/c_inbound_management/inbound_save',
            type: 'post',
            data: {
                'hphm': hphm,
                'hmzl': hmzl,
                'dsr': dsr,
                'sfzmhm': sfzmhm,
                'czsj': czsj,
                'czjg': czjg,
                'tccmc': tccmc,
                'tccdz': tccdz,
                'orgnum': orgnum,
                'orgname': orgname,
                'strs': strs,
                'str': str
            },

            success: function (data) {
                //console.log(data);
                //return;
                if (data == '1') {
                    layer.msg("添加成功！", {
                        time: 1.5 * 1000
                    }, function () {
                        layer.closeAll();
                        parent.window.location.reload();
                    });
                } else {
                    layer.msg("添加失败,请重试！");
                }
            }
        });

    });
    //上传图片
    $("#file_btn").click(function () {
        $("#uphoto").click();
        $("#uphoto").unbind('change').bind('change', function () {
            //$('#uphoto').on('change',function() {
            var fileData = new FormData(document.getElementById("fileForm"));
            $.ajax({
                url: URL + 'admin/c_inbound_management/imageupload',
                type: 'post',
                data: fileData,
                contentType: false,
                processData: false,
                success: function (data) {
                    //console.log(data);
                    if (data == '1') {
                        layer.msg('请上传jpg、png、jpeg格式的图片！', {
                            time: 1.5 * 1000
                        });
                    } else if (data == '2') {
                        layer.msg('请上传小于2M的图片！', {
                            time: 1.5 * 1000
                        });
                    } else {
                        $("#h_file").val($("#h_file").val() + '' + data);
                        var arr = data.split("+");
                        //alert(data1);
                        var arr1 = unique(arr);
                        //alert(arr1);return;
                        for (var i = 0; i < arr1.length; i++) {
                            if (arr1[i] != "") {
                                $("#img_div").html($("#img_div").html() + "<div style='width: 98px;float:left;height: 98px;'><img class='img_class' id='" + 'assets/uploads/inbound_car_image/' + arr1[i] + "'" + "  style='width: 80px;margin-top:5%;margin-left:5%;float:left;height: 80px;' src='" + URL + 'assets/uploads/inbound_car_image/' + arr1[i] + "'><div class='delte_img' style='width:12px;cursor:pointer;float:right;border:1px solid white;height:12px;text-align:center;line-height:10px;color:white;background-color:red;font-weight:400;z-index: 100;border-radius: 50%;'>x️</div></div>");
                            }
                        }
                    }
                    //删除图片
                    $(".delte_img").click(function () {
                        $(this).parent().css('display', 'none');
                        $(this).siblings().css('display', 'none');
                        $(this).css('display', 'none');
                    });

                }

            });
        });
    });

    //除去数组中相同的元素
    function unique(arr) {
        var len = arr.length;
        var result = []
        for (var i = 0; i < len; i++) {
            var flag = true;
            for (var j = i; j < arr.length - 1; j++) {
                if (arr[i] == arr[j + 1]) {
                    flag = false;
                    break;
                }
            }
            if (flag) {
                result.push(arr[i])
            }
        }
        return result;
    }

    //验证身份证准确性的方法
    function verifyCode(code) {
        var arr = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];    //算法需要用到的数组
        var sum = 0;
        for (var i = 0; i < arr.length; i++) {
            sum += parseInt(code.charAt(i)) * arr[i];
        }
        //用加起来的和除以11 求的余数
        var c = sum % 11;
        var ch = ['1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'];
        var last_code = ch[c];     //通过计算出来的最后一位
        //所填值的最后一位
        var last = code.charAt(17);
        last = last == 'x' ? 'X' : last;
        return last == last_code;        //是否相等

    }
</script>

</body>
</html>
