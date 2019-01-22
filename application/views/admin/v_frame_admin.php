<!doctype html>
<html lang="zh-cn">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="renderer" content="webkit">

		<title>网考系统管理</title>
        <link rel="shortcut icon" href="profile_small.ico">
		<link rel="stylesheet" href="<?php echo base_url()?>public/css/pintuer.css">
		<link rel="stylesheet" href="<?php echo base_url()?>public/css/admin.css">
		<!-- <script src="<?php echo base_url()?>public/js/admin.js"></script> -->
		<script src="<?php echo base_url()?>public/js/jquery.min.js"></script>
        <script src="<?php echo base_url()?>public/js/pintuer.js"></script>
        <script src="<?php echo base_url()?>public/js/respond.js"></script>
        <script src="<?php echo base_url()?>public/layer/layer.min.js"></script>
        <style type="text/css">
			.act{ background:#09c!important; font-weight:bold;}
			.act1{ background:#09c!important; font-weight:bold;}
			.big{ padding-left:20px;padding-right:20px;}
        </style>
        <style>
            .layui-layer-lan .layui-layer-title{
                background: #09c;
            }
            .layui-layer-title{
                background-color: #09c;
            }
            .layui-layer-btn .layui-layer-btn0{
                border-color:#09c;
                background-color: #09c;
                color: #333;
            }
        </style>
	</head>
	<body>
		<div class="lefter">
			<div class="logo" style = "margin-top:-20px">
				<a href="http://www.pintuer.com" target="_blank"><img src="<?php echo base_url()?>public/images/logo2.png" alt="后台管理系统" /></a>
			</div>
		</div>
		<div class="righter nav-navicon" id="admin-nav">
			<div class="mainer">
				<div class="admin-navbar">
					<span class="float-right">
                    <span>您好，<span><?php echo $_SESSION['realname']?>(<?php echo $_SESSION['accounts']?>)</span>，欢迎您的光临。</span>
                    <a class="button button-small bg-yellow change_pwd" href="#">修改密码</a>
                    <a class="button button-small bg-yellow" href="<?php echo base_url()?>C_login/logout">注销登录</a>
                </span>
					<ul class="nav nav-inline admin-nav" style="padding:0px">
						<?php
							foreach ($module as $key => $value) {
								if($value['classify'] == "1"){
									if($value['parentid'] == "0"){
										echo "<li>";
										echo "<a href='#' class='big' moduleid='".$value['moduleid']."'>".$value['modtitle']."</a>";
										echo "<ul>";
										foreach($module as $val){
		                                    if($val['classify'] == "1"){
		                                        if($val['parentid'] == $value['moduleid']){
		                                        	// echo $val['modtitle'];
		                                            echo "<li>";
		                                            echo "<a target='myiframe' href='".$val['modurl']."' class='get_text ".$val['parentid']."'>".$val['modtitle']."</a>";
		                                            echo "</li>";
		                                        }
		                                    }
		                                }
		                                echo "</ul>";
										echo "</li>";
									}
								}
							}

						?> 
					</ul>
				</div>
				<div class="admin-bread">
					
					<ul class="bread">
						<li><a href="<?php echo base_url()?>admin/C_frame_admin">首页</a></li>
						<li class="show_big"></li>
						<li class="show_little"></li>
					</ul>
				</div>
			</div>
		</div>


		<!-- 修改密码程序 -->
			<script type="text/javascript">
			  //修改密码
			        $(".change_pwd").click(function(){
			            layer.open({
					                type: 2,
					                title:'修改密码',
					                skin: 'layui-layer-lan', //加上边框
					                area: ['600px', '350px'], //宽高
					                content: ['<?php echo base_url()?>admin/C_change_password','no']
					            });
			        });
			</script>
		<!-- 修改密码程序 -->


		<div class="admin">
            <iframe id="myiframe" name="myiframe" width="100%" height="100%" scrolling="yes" frameborder="0">
            </iframe>
			
		</div>

		<div class="hidden">
			<script>
			    $(function(){
			    	$(".big")[0].click();
			    });			    

			    $('.get_text').click(function(){
                	var parent = $(this).parent();
                    var text = $(this).text();
                    parent.addClass('act');
			    	parent.siblings("li").removeClass('act');
                    $('.show_little').text(text);
                });

			    $(".big").click(function(){
			    	var modtitle = $(this).text();
			    	var moduleid = $(this).attr("moduleid");
			    	var parent = $(this).parent();
			    	parent.addClass('active');
			    	parent.siblings("li").removeClass('active');

			    	$('.'+moduleid+'')[0].click();

			    	$('.show_big').text(modtitle);
			    });
            

			</script>
		</div>
	</body>
</html>