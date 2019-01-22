    <div id = "myform">
			<form id = "form_sub" action = "<?php echo base_url()?>admin/C_change_password/edit_success" method="post" target = "_parent">
				<div class="form-group">
                    <div class="label wenzi first">
                        <label for="sitename">原始密码：</label>
                    </div>
                    <div class="field shuru first" >
                        <input type="password" class="input" onblur = "check_password()" id="old_password" name="old_password" size="50" placeholder="情输入你的原始密码"/>
                    </div>
                     <div class="label wenzi">
                        <label for="sitename">&nbsp;新&nbsp;密&nbsp;码：</label>
                    </div>
                    <div class="field shuru">
                        <input type="password" value="" class="input" id="new_password" name="new_password" size="50" placeholder="情输入你的新密码"/>
                    </div>
                     <div class="label wenzi" >
                        <label for="sitename">确认密码：</label>
                    </div>
                    <div class="field shuru">
                        <input type="password" value="" onblur="Verification()" class="input" id="re_new_password" name="re_new_password" size="50" placeholder="情再次输入你的新密码"/>
                    </div>
                     <div class="field shuru button1">
                        <input type="button" id = "sub_btn" value="确认" class="button bg-blue"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="reset"  value="重置" class="button bg-gray"/>
                    </div>
                </div>
			</form>
		</div>

    <script type="text/javascript">

        //输入原始密码，去数据库进行验证
        function check_password(){
            var old_password = $("#old_password").val();
            $.post('<?php echo base_url();?>admin/C_change_password/edit_password/',{'old_password': old_password},function(data){
                    // alert(data);return false;
                    if(data == 1){
                        // alert(1);
                        layer.msg('密码验证通过',{time: 2000});

                    }else{
                        // alert(2);
                        layer.msg('密码错误', {time: 2000});
                        $("#old_password").focus();
                        return false;
                    }
                })
            }

        //确认密码和新密码必须一样
        function Verification(){
            var new_password = $("#new_password").val();
            var re_new_password = $("#re_new_password").val();

            if(new_password === re_new_password){
              
            }else{
                layer.msg('两次输入密码不一致',{time: 2000});
            }
        }
        

        //提交时候进行验证
        $("#sub_btn").click(function(){
            var old_password = $("#old_password").val();
            var new_password = $("#new_password").val();
            var re_new_password = $("#re_new_password").val();
            if(old_password != "" && new_password !="" && re_new_password != ""){
                if(new_password === re_new_password){
                    $("#form_sub").submit();
                }else{
                    layer.msg('两次输入密码不一致',{time: 2000});
                    $("#new_password").focus();
                    return false;
                }
            }else{
                layer.msg('所有密码不得为空',{time: 2000});
                return false;
            }

            
        });
        
    </script>
    <style type="text/css">
        .button1{
            text-align: center;
            margin-left: 50px;
            /*padding-top: 40px;*/
            padding-left: 150px!important;
        }
        .first{
            margin-top: 35px!important;
        }
        .wenzi{
            padding-left: 50px;
            width: 160px;
            float: left;
            margin-top: 20px
        }
        .shuru{
            width: 360px;
            float: left;
            margin-top: 20px
        }
    </style>