<!DOCTYPE html>
<html lang="zh-cn">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="renderer" content="webkit">
		<title>汉滨大队一网考系统</title>
		<link rel="stylesheet" href="<?php echo base_url()?>public/css/pintuer.css">
		<link rel="stylesheet" href="<?php echo base_url()?>public/css/admin.css">
		<link href="<?php echo base_url();?>assets/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
		<script src="<?php echo base_url()?>public/js/jquery.min.js"></script>
		<script src="<?php echo base_url()?>public/js/respond.js"></script>
		<script src="<?php echo base_url()?>public/layer/layer.min.js"></script>
		<script src="<?php echo base_url();?>public/layer/laydate/laydate.js"></script>
    	<style type="text/css">

            html{
                height:100%;
                width:100%;
            }
            body{
                background-image: url(<?php echo base_url()?>public/images/login10.png);
                display: block;
                background-repeat: no-repeat;
                background-size: cover;

            }
            .line{
                position: absolute;
                left: 750px;
                top: 300px;
                width: 415px;
                height: 547px;
                background-image: url(<?php echo base_url()?>public/images/login6.png);
            }
            .title{
                font-size: 36px;
                line-height: 36px;
                position: absolute;
                left: 740px;
                top: 140px;
                white-space:nowrap;
            }
            .english_title{
                font-size: 24px;
            }
            .panel-head{
                width: 100%;
                height: 70px;
                background-color:transparent;
                color: #fff;
                border: 0px;
                font-size: 20px;
                letter-spacing:1px;
                line-height: 70px;
                text-align: center;
            }
            .input{
                opacity:0.3;
                border:none;
            }
            .text-center{
                background-color:transparent;
                border:none;
                margin-top: 20px;
                width: 100%;
                text-align: center;
            }
            #sub_btn{
                opacity:0.5;
                width: 90%;
                height: 40px;
                display:block;
                margin:0 auto;
                border-radius: 10px;
            }
            #accounts{
                height: 40px;
                width: 100%;
                border-radius: 10px;
                margin-bottom: 20px;
                padding-left: 50px;
               /*color: #fff;*/
            }
            #accounts:-webkit-autofill{
                -webkit-box-shadow: 0 0 0px 1000px white inset
            }
            #password{
                padding-left: 50px;
                height: 40px;
                width: 100%;
                border-radius: 10px;
            }
            .accounts{
                background-image: url(<?php echo base_url()?>public/images/login7.png);
                background-repeat: no-repeat;
                background-position:20px 10px;
            }
            .password{
                background-image: url(<?php echo base_url()?>public/images/login8.png);
                background-repeat: no-repeat;
                background-position:20px 10px;
            }

            h1{
                margin-top: 100px;
                font-size: 50px;
                color: #fff;
                text-align: center;
            }

            #sub_btn{
                border:none;
                color: #fff;
                background-color: #415696;
            }
    	</style>
	</head>

	<body>
		<div class="container">
            <h1>汉滨交警大队一网考系统</h1>
			<form action="<?php echo base_url()?>c_login/login" method="post">
				<div class="line">
					<div class="panel-head" ><strong>登录账号</strong></div>
					<div class="panel-body" style="padding:30px;">

						<div class="form-group">
							<div class="field field-icon-right accounts" >
								<input type="text" class="input"  id="accounts" name="accounts" placeholder="请输入账号" data-validate="required:请填写账号,length#>=5:账号长度不符合要求" maxlength="6" />
							</div>
						</div>
						<div class="form-group">
							<div class="field field-icon-right password">
								<input type="password" class="input" id="password" name="password" placeholder="请输入密码" data-validate="required:请填写密码,length#>=8:密码长度不符合要求" />
							</div>
						</div>
					</div>
					<div class="panel-foot text-center">
						<button class="button button-block text-big" id="sub_btn">登录</button>
					</div>
					<div align="center"><h3 style="color: red;"><span id="prompt"><?php echo  $prompt;?></span></h3></div>
				</div>
			</form>

		</div>

	<script>
		$("#sub_btn").click(function(){
			var accounts = $("#accounts").val();
			var password = $("#password").val();
			if(accounts == ""){
				layer.msg("请输入账号（即警员编号）");
				return false;
			}

			if(accounts.length != 6){
				layer.msg("请输入正确的账号（即警员编号）");
				return false;
			}

			if(password == ""){
				layer.msg("请输入密码");
				return false;
			}
		})
	</script>
</body>

</html>