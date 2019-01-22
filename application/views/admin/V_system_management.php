<!DOCTYPE html>
<html lang="zh-cn">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="renderer" content="webkit">

		<title>系统管理</title>
        <link rel="shortcut icon" href="profile_small.ico">
		<link rel="stylesheet" href="<?php echo base_url()?>public/css/pintuer.css">
		<link rel="stylesheet" href="<?php echo base_url()?>public/css/admin.css">
		<!-- <script src="<?php echo base_url()?>public/js/admin.js"></script> -->
		<script src="<?php echo base_url()?>public/js/jquery.js"></script>
        <script src="<?php echo base_url()?>public/js/pintuer.js"></script>
        <script src="<?php echo base_url()?>public/js/respond.js"></script>
        
         <style type="text/css">
			.act{ background:#09c!important; font-weight:bold;}
			.act1{ background:#09c!important; font-weight:bold;}
        </style>
        </style>
	</head>
	<body>
		<div class="lefter">
			<div class="logo">
				<a href="http://www.pintuer.com" target="_blank"><img src="<?php echo base_url()?>public/images/logo.png" alt="后台管理系统" /></a>
			</div>
		</div>
		<div class="righter nav-navicon" id="admin-nav">
			<div class="mainer">
				<div class="admin-navbar">
					<span class="float-right">
                    <span>您好，<span>admin</span>，欢迎您的光临。</span>
                    <a class="button button-little bg-yellow" href="login.html">注销登录</a>
                </span>
					<ul class="nav nav-inline admin-nav" style="padding:0px">
						<li>
							<a href="<?php echo base_url()?>admin/C_frame_admin" style="padding-left:20px;padding-right:20px;" class=""><img src="<?php echo base_url()?>public/images/jingwu.png">&nbsp;&nbsp;警务通管理</a>
							
						</li>
						<li>
							<a href="<?php echo base_url()?>admin/C_frame_admin/data_statistic" style="padding-left:20px;padding-right:20px;" class=""><img src="<?php echo base_url()?>public/images/tongji.png">&nbsp;&nbsp;数据统计</a>
						</li>
						<li class="active">
						    <a href="<?php echo base_url()?>admin/C_frame_admin/system_management" style="padding-left:20px;padding-right:20px;" class=""><img src="<?php echo base_url()?>public/images/guanli.png">&nbsp;&nbsp;系统管理</a>
						    <ul style="padding-top:0px;">
								<li><a target="myiframe" href="<?php echo base_url()?>admin/C_memberinfo" id = "first" class="get_text act1"><span class=""></span><img src="<?php echo base_url()?>public/images/tongji1.png">&nbsp;&nbsp;警员管理</a></li>
								<li><a target="myiframe" href="<?php echo base_url()?>admin/C_memberinfo" class="get_text"><span class=""></span><img src="<?php echo base_url()?>public/images/tongji2.png">&nbsp;&nbsp;部门管理</a></li>
								<li><a target="myiframe" href="<?php echo base_url()?>admin/C_memberinfo" class="get_text"><span class=""></span><img src="<?php echo base_url()?>public/images/tongji3.png">&nbsp;&nbsp;权限管理</a></li>
                                <li><a target="myiframe" href="<?php echo base_url()?>admin/C_memberinfo" class="get_text"><span class=""></span><img src="<?php echo base_url()?>public/images/tongji1.png">&nbsp;&nbsp;反馈管理</a></li>
								<li><a target="myiframe" href="<?php echo base_url()?>admin/C_memberinfo" class="get_text"><span class=""></span><img src="<?php echo base_url()?>public/images/tongji2.png">&nbsp;&nbsp;模块管理</a></li>
								<li><a target="myiframe" href="<?php echo base_url()?>admin/C_memberinfo" class="get_text"><span class=""></span><img src="<?php echo base_url()?>public/images/tongji3.png">&nbsp;&nbsp;操作日志管理</a></li>
							</ul>
				        </li>
					</ul>
				</div>
				<div class="admin-bread">
					
					<ul class="bread">
						<li><a href="" class="">首页</a></li>
						<li><a href="">系统管理</a></li>
						<li class="">警员管理</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="admin">
            <iframe id="myiframe" name="myiframe" width="100%" height="100%" scrolling="no" frameborder="0">
            
            </iframe>
			
		</div>

		<div class="hidden">
            <script src="assets/js/jquery.min.js?v=2.1.4"></script>
            <script src="assets/js/plugins/peity/jquery.peity.min.js"></script>
            <script src="assets/js/jquery.cxselect.js"></script>
			<script>
				  //点击大类时默认打开该类的第一个小类
                $('.act1')[0].click();
                //点击小类时改变颈部文本
                $('.get_text').click(function(){
                    var text = $(this).text();
                    $('.show_text').text(text);
                })

                $(function(){
			        $('.active ul li').click(function(){
			            $(this).addClass('act').siblings("li").removeClass('act');
			            $('#first').removeClass('act1');
			        })
			    })
            
			</script>
		</div>
	</body>

</html>