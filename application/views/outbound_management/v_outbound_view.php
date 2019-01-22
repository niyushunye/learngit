<body class="bg-white">
<div class="tab" style="">
    <div class="tab-body" style="width: 95%;">
        <br>
        <div class="tab-panel active" id="tab-set" style="">
            <form method="post" class="form-x" method="post" target="_parent">
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">号牌号码：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" disabled   value="<?php echo $data1[0]['hphm'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">号牌种类：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" disabled   value="<?php echo $data1[0]['DMSM1'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">当事人：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" disabled   value="<?php echo $data1[0]['dsr'];?>" id="dsr">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">身份证号：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" disabled   value="<?php echo $data1[0]['sfzmhm'];?>" id="sfzh">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">出库时间：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" disabled id="outbound_time" name="outbound_time"  value="<?php echo $data1[0]['cksj'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">出库原因：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" disabled   value="<?php echo $data1[0]['ckyy'];?>" id="ckyy">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">停车场名称：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" disabled   value="<?php echo $data1[0]['tccmc'];?>" id="tccmc">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">停车场地址：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" disabled   value="<?php echo $data1[0]['tccdz'];?>" id="tccdz">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">组织机构编码：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"  disabled value="<?php echo $data1[0]['bmdm'];?>" id="orgnum">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">组织机构名称：</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input"  disabled value="<?php echo $data1[0]['bmmc'];?>" id="orgname">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">是否强制出库：</label>
                    </div>
                    <div class="field">
                        <select class="input" id="sfqzck" disabled>
                            <option value="0">---请选择---</option>
                            <option value="1" <?php if($data1[0]['sfqzck'] == '1'){ echo "selected";}?>>是</option>
                            <option value="2" <?php if($data1[0]['sfqzck'] == '2'){ echo "selected";}?>>否</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="rolename">处置民警：</label>
                    </div>
                    <div class="field">
                        <table class="table table-bordered table-hover"style="width: 90%;">
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
                                    <td><input class="assign_checkbox" disabled <?php if($value['accounts'] == $data1[0]['jybh']){echo "checked";}?>  name="dldm[]" type="radio" value="<?php echo $value['accounts'].'::'.$value['realname'];?>"></td>
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
</html>
