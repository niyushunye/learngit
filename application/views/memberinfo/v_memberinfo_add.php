<body class="bg-white">
        <div class="tab" style="">
            <div class="tab-body" style="width: 95%;">
            <br>
                <div class="tab-panel active" id="tab-set" style="">
                    <form method="post" class="form-x" method="post" action="<?php echo base_url();?>admin/c_memberinfo/add_save/<?php echo $orgnum?>" target="_parent">
                        <div class="form-group">
                            <div class="label">
                                <label for="realname">真实姓名：</label>
                            </div>
                            <div class="field">
                                <input type="text" class="input" id="realname" name="realname" maxlength="10">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label">
                                <label for="accounts">警员编号：</label>
                            </div>
                            <div class="field">
                                <input type="text" class="input" id="accounts" name="accounts" maxlength="6">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label">
                                <label for="password">密码：</label>
                            </div>
                            <div class="field">
                                <input type="password" class="input" id="password" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="label">
                                <label for="re_password">确认密码：</label>
                            </div>
                            <div class="field">
                                <input type="password" class="input" id="re_password" name="re_password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label">
                                <label for="orgnum">组织机构编码：</label>
                            </div>
                            <div class="field">
                                <input type="text" class="input" id="orgnum" name="orgnum" maxlength="12"  value="<?php echo $orgnum?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label">
                                <label for="mobile">手机号码：</label>
                            </div>
                            <div class="field">
                                <input type="text" class="input" id="mobile" name="mobile" maxlength="11">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label">
                                <label for="idcard">身份证号：</label>
                            </div>
                            <div class="field">
                                <input type="text" class="input" id="idcard" name="idcard" maxlength="18">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label">
                                <label for="idcard">权限：</label>
                            </div>
                            <div class="field">
                                <?php
                                foreach($roleinfo as $value)
                                {
    //                                echo "<option value=".$value['roleid'].">".$value['rolename']."</option>";
                                    echo "<input type = 'checkbox' name = 'groupCheckbox[]' class = groupCheckbox[]' value = ".$value['roleid']."> ".$value['rolename'];
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="label">
                                <label for="is_director">警员类型：</label>
                            </div>
                            <div class="field">
                                <select class="input" name="is_director" id="is_director">
                                    <option value="0" selected>正式警员</option>
                                    <option value="1">协警</option>
                                </select>
                                
                            </div>
                        </div>
                        <div class="form-group"  id="director">
                            <div class="label">
                                <label for="director">指导人：</label>
                            </div>
                            <div class="field">
                                <select class="input" name="director">
                                    <option value=''>若无指导人请选择此项</option>
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

                        <div class="form-group"  id="alarmFeedbackMember">
                            <div class="label">
                                <label for="alarmFeedbackMember">代签人：</label>
                            </div>
                            <div class="field">
                                <select class="input" name="alarmFeedbackMember">
                                    <option value=''>若无代签人请选择此项</option>
                                    <?php foreach ($org_member as $key => $value) {
                                        if($value['accounts'] == $v['alarmFeedbackMember']){
                                            echo "<option value='".$value['accounts']."' selected>".$value['realname']."</option>";
                                        }else{
                                            echo "<option value='".$value['accounts']."'>".$value['realname']."</option>";
                                        }
                                    }?>
                                </select>
                            </div>
                        </div>


                        
                        <div class="form-button">
                            <button class="button button-small bg-main operate_sub" type="submit" id="sub">确定</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <p class="text-right text-gray"></p>
</body>
<script>
    $(document).ready(function(){
        $("#director").hide();
    });

    $("#is_director").change(function(){
        var is_director = $(this).val();
        if(is_director == 0){
            $("#director").hide();
        }else if(is_director == 1){
            $("#director").show();
        }
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

        if(accounts == "" || accounts.length != 6){
            var remind = "请输入6位警员编号";
            layer.msg(remind);
            $("#accounts").focus();
            return false;
        }

        if(password == '' || password.length < 6)
        {
            var remind = "请输入密码且不能低于6位！";
            layer.msg(remind);
            $("#password").focus();
            return false;
        }

        if ( password != re_password ){
            var remind = "您输入的两次密码不对，请重新输入！";
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

    $("#re_password").blur(function(){
        var password = $("#password").val();
        var re_password = $("#re_password").val();
        if(password != re_password){
            var remind = "两次输入的密码不同";
            layer.msg(remind);
            $("#password").focus();
            return false;
        }
    });


    $("#accounts").blur(function(){
        var accounts = $(this).val();
        if(accounts == "" || accounts.length != 6){
            var remind = "请输入6位警员编号";
            layer.msg(remind);
            $("#accounts").focus();
        }else{
            $.post('<?php echo base_url();?>admin/c_memberinfo/checkaccounts',{accounts:accounts},function(data){
                if(data == ""){

                }else{
                    layer.msg(data);
                    $("#accounts").focus();
                }
            });
        }        
    });
</script>