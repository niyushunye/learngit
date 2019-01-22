<body class="bg-white">
        <div class="tab" style="">
            <div class="tab-body" style="width: 95%;">
            <br>
                <div class="tab-panel active" id="tab-set" style="">
                    <form method="post" class="form-x" method="post" action="<?php echo base_url();?>admin/c_memberinfo/editover" target="_parent">
                    <?php foreach ($memberinfo as $k => $v): ?>
                        <input id="memberid" name="memberid" type="hidden" value="<?php echo $v['memberid'];?>" >
                        <div class="form-group">
                            <div class="label">
                                <label for="realname">真实姓名：</label>
                            </div>
                            <div class="field">
                                <input type="text" class="input" id="realname" name="realname" maxlength="10" value="<?php echo $v['realname'];?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label">
                                <label for="accounts">警员编号：</label>
                            </div>
                            <div class="field">
                                <input type="text" class="input" id="accounts" name="accounts" maxlength="6" value="<?php echo $v['accounts'];?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label">
                                <label for="password">密码：</label>
                            </div>
                            <div class="field">
                                <input type="password" class="input" id="password" name="password" value="<?php echo $v['password']?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="label">
                                <label for="orgnum">组织机构编码：</label>
                            </div>
                            <div class="field">
                                <input type="text" class="input" id="orgnum" name="orgnum" maxlength="12"  value="<?php echo $v['orgnum'];?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label">
                                <label for="mobile">手机号码：</label>
                            </div>
                            <div class="field">
                                <input type="text" class="input" id="mobile" name="mobile" maxlength="11"  value="<?php echo $v['mobile'];?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label">
                                <label for="idcard">身份证号：</label>
                            </div>
                            <div class="field">
                                <input type="text" class="input" id="idcard" name="idcard" maxlength="18" value="<?php echo $v['idcard'];?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label">
                                <label for="idcard">权限：</label>
                            </div>
                            <div class="field">
                                <?php
                                   if(!empty($roleids)){
                                       foreach($roleinfo as $value)
                                       {
                                           if(in_array($value['roleid'],$roleids)){
                                               echo "<input type='checkbox' name='groupCheckbox[]' class='groupCheckbox[]' value=".$value['roleid']." checked>".$value['rolename'];
                                           }else{
                                               echo "<input type='checkbox' name='groupCheckbox[]' class='groupCheckbox[]' value=".$value['roleid'].">".$value['rolename'];
                                           }
                                       }
                                   }else{
                                       foreach($roleinfo as $value)
                                       {
                                           echo "<input type='checkbox' name='groupCheckbox[]' class='groupCheckbox[]' value=".$value['roleid'].">".$value['rolename'];
                                       }
                                   }
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label">
                                <label for="idcard">账号状态：</label>
                            </div>
                            <div class="field">
                                <select class="input" name="status" id="status">
                                <?php
                                if($v['status'] == 1)
                                {
                                    echo "<option value=\"1\" selected=\"selected\">正常</option>";
                                }

                                if($v['status'] == 0)
                                {
                                    echo "<option value=\"0\" selected=\"selected\">禁用</option>";
                                }
                                ?>
                                <option value="1">正常</option>
                                <option value="0">禁用</option>
                            </select>
                            </div>
                        </div>
                    <?php if($v['isAuxiliaryPolice'] =="2"){?>
                        <div class="form-group">
                            <div class="label">
                                <label for="director">指导人：</label>
                            </div>
                            <div class="field">
                                <input type="hidden" id="is_director" name="is_director" value="1">
                                <select class="input" name="director" id="director">
                                    <option value=''>若无指导人请选择此项</option>
                                    <?php if(empty($v['director'])){
                                            echo "<option value='0' selected>请选择指导人</option>";
                                        }
                                    ?>
                                    <?php foreach ($directors as $key => $value) {
                                        if($value['accounts'] == $v['director']){
                                            echo "<option value='".$value['accounts']."' selected>".$value['realname']."</option>";
                                        }else{
                                            echo "<option value='".$value['accounts']."'>".$value['realname']."</option>";
                                        }
                                    }?>
                                </select>
                            </div>
                        </div>
                    <?php }?>
                        <div class="form-group">
                            <div class="label">
                                <label for="director">代签人：</label>
                            </div>
                            <div class="field">
                                <select class="input" name="alarmFeedbackMember" id="alarmFeedbackMember">
                                    <option value=''>若无代签人请选择此项</option>
                                    <?php foreach ($org_member as $key => $value) {
                                        if($value['accounts'] == $v['alarmFeedbackMember']){
                                            echo "<option value='".$value['accounts']."' selected>".$value['realname']."</option>";
                                        }else{
                                            if($value['accounts'] != $v['accounts']){
                                                echo "<option value='".$value['accounts']."'>".$value['realname']."</option>";
                                            }
                                            
                                        }
                                    }?>
                                </select>
                            </div>
                        </div>

                        
                        <div class="form-button">
                            <button class="button button-small border border-yellow closeWindows operate_sub">取消</button>
                            <button class="button button-small bg-main operate_sub" type="submit" id="sub">确定</button>
                        </div>
                    <?php endforeach; ?>
                    </form>
                </div>
            </div>
        </div>
        <p class="text-right text-gray"></p>
</body>
<script>
    $(".closeWindows").click(function(){
        parent.layer.closeAll();
    });

    $("#sub").click(function () {

        var password = $("#password").val();
        var re_password = $("#re_password").val();
        var realname = $("#realname").val();
        var accounts= $("#accounts").val();
        var mobile = $("#mobile").val();
        var idcard = $("#idcard").val();

        if(realname == ""){
            var remind = "请输入真实姓名";
            layer.msg(remind);
            $("#realname").focus();
            return false;
        }

        if(password == '' || password.length < 6)
        {
            var remind = "请输入密码且不能低于6位！";
            layer.msg(remind);
            $("#password").focus();
            return false;
        }

        if(mobile == "" || mobile.length  != 11  ){
            var remind = "请输入11位手机号码";
            layer.msg(remind);
            $("#mobile").focus();
            return false;
        }

        if(idcard == "" || idcard.length != 18){
            var remind = "请输入合法的身份证号";
            layer.msg(remind);
            $("#idcard").focus();
            return false;
        }
    });
</script>