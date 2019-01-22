<body class="bg-white">
<div class="tab" style="">
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
                        <input type="text" class="input" disabled value="<?php echo $datas[0]['hphm']; ?>" id="hphm">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">号码种类：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" disabled value="<?php echo $datas[0]['DMSM1']; ?>" id="hmzl">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">当事人：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" disabled value="<?php echo $datas[0]['dsr']; ?>" id="dsr">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">身份证号：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" disabled value="<?php echo $datas[0]['sfzmhm']; ?>" id="sfzh">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">入库时间：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" disabled id="inbound_time" name="inbound_time"
                               value="<?php echo $datas[0]['czsj']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">处置结果：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" disabled value="<?php echo $datas[0]['czjg']; ?>" id="czjg">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">停车场名称：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" disabled value="<?php echo $datas[0]['tccmc']; ?>" id="tccmc">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">停车场地址：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" disabled value="<?php echo $datas[0]['tccdz']; ?>" id="tccdz">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">组织机构编码：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" disabled value="<?php echo $datas[0]['bmdm']; ?>" id="orgnum">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">组织机构名称：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" disabled value="<?php echo $datas[0]['bmmc']; ?>" id="orgname">
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
                            <?php if (isset($datas[0]['tp1']) && ($datas[0]['tp1'] != "")) { ?>
                                <div style='width: 98px;float:left;height: 98px;'>
                                    <img class='img_class' id="<?php echo base64_decode($datas[0]['tp1']); ?>"
                                         style='width: 80px;margin-top:5%;margin-left:5%;float:left;height: 80px;'
                                         src='<?php echo base_url() . base64_decode($datas[0]['tp1']) ?>'>
                                    <div class='delte_img'
                                         style='width:12px;cursor:pointer;float:right;border:1px solid white;height:12px;text-align:center;line-height:10px;color:white;background-color:red;font-weight:400;z-index: 100;border-radius: 50%;'>
                                        x️
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if (isset($datas[0]['tp2']) && ($datas[0]['tp2'] != "")) { ?>
                                <div style='width: 98px;float:left;height: 98px;'>
                                    <img class='img_class' id="<?php echo base64_decode($datas[0]['tp2']); ?>"
                                         style='width: 80px;margin-top:5%;margin-left:5%;float:left;height: 80px;'
                                         src='<?php echo base_url() . base64_decode($datas[0]['tp2']) ?>'>
                                    <div class='delte_img'
                                         style='width:12px;cursor:pointer;float:right;border:1px solid white;height:12px;text-align:center;line-height:10px;color:white;background-color:red;font-weight:400;z-index: 100;border-radius: 50%;'>
                                        x️
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if (isset($datas[0]['tp3']) && ($datas[0]['tp3'] != "")) { ?>
                                <div style='width: 98px;float:left;height: 98px;'>
                                    <img class='img_class' id="<?php echo base64_decode($datas[0]['tp3']); ?>"
                                         style='width: 80px;margin-top:5%;margin-left:5%;float:left;height: 80px;'
                                         src='<?php echo base_url() . base64_decode($datas[0]['tp3']) ?>'>
                                    <div class='delte_img'
                                         style='width:12px;cursor:pointer;float:right;border:1px solid white;height:12px;text-align:center;line-height:10px;color:white;background-color:red;font-weight:400;z-index: 100;border-radius: 50%;'>
                                        x️
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <button id="file_btn" class="button button-small bg-main operate_sub" type="button"
                                style="display:none;">上传
                        </button>
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
                                    <td><input class="assign_checkbox"
                                               disabled <?php if ($value['accounts'] == $datas[0]['jybh']) {
                                            echo "checked";
                                        } ?> name="dldm[]" type="radio"
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
</body>
</html>
