<!DOCTYPE html>
<html lang="zh-cn">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="renderer" content="webkit">

		<title>数据统计</title>
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
						<li class="active">
							<a href="<?php echo base_url()?>admin/C_frame_admin/data_statistic" style="padding-left:20px;padding-right:20px;" class=""><img src="<?php echo base_url()?>public/images/tongji.png">&nbsp;&nbsp;数据统计</a>
							<ul style="padding-top:0px;">
								<li><a target="myiframe" href="<?php echo base_url()?>admin/C_departmentStatistic" id = "first" class="get_text act1"><span class=""></span><img src="<?php echo base_url()?>public/images/tongji1.png">&nbsp;&nbsp;部门业务统计</a></li>
								<li><a target="myiframe" href="<?php echo base_url()?>admin/C_surveilinfo" class="get_text"><span class=""></span><img src="<?php echo base_url()?>public/images/tongji2.png">&nbsp;&nbsp;电子监控数据统计</a></li>
								<li><a target="myiframe" href="<?php echo base_url()?>admin/C_forceinfo" class="get_text"><span class=""></span><img src="<?php echo base_url()?>public/images/tongji3.png">&nbsp;&nbsp;强制措施数据统计</a></li>
								<li><a target="myiframe" href="<?php echo base_url()?>admin/C_violation" class="get_text"><span class=""></span><img src="<?php echo base_url()?>public/images/tongji3.png">&nbsp;&nbsp;违法处理数据统计</a></li>
                                <li><a target="myiframe" href="<?php echo base_url()?>admin/C_posinfo" class="get_text"><span class=""></span><img src="<?php echo base_url()?>public/images/tongji1.png">&nbsp;&nbsp;pos交款数据统计</a></li>
								<li><a target="myiframe" href="<?php echo base_url()?>admin/C_simpleinfo" class="get_text"><span class=""></span><img src="<?php echo base_url()?>public/images/tongji2.png">&nbsp;&nbsp;简易程序数据统计</a></li>
								<li><a target="myiframe" href="<?php echo base_url()?>admin/C_memberinfo" class="get_text"><span class=""></span><img src="<?php echo base_url()?>public/images/tongji3.png">&nbsp;&nbsp;银行分账数据统计</a></li>
                                <li><a target="myiframe" href="<?php echo base_url()?>admin/C_alarm_feedback" class="get_text"><span class=""></span><img src="<?php echo base_url()?>public/images/tongji1.png">&nbsp;&nbsp;预警反馈数据统计</a></li>
								<li><a target="myiframe" href="<?php echo base_url()?>admin/C_finance_input" class="get_text"><span class=""></span><img src="<?php echo base_url()?>public/images/tongji2.png">&nbsp;&nbsp;台账录入数据统计</a></li>
								<li><a target="myiframe" href="<?php echo base_url()?>admin/C_memberinfo" class="get_text"><span class=""></span><img src="<?php echo base_url()?>public/images/tongji3.png">&nbsp;&nbsp;银行收费数据统计</a></li>
							</ul>
						</li>
						<li>
						    <a href="<?php echo base_url()?>admin/C_frame_admin/system_management" style="padding-left:20px;padding-right:20px;" class=""><img src="<?php echo base_url()?>public/images/guanli.png">&nbsp;&nbsp;系统管理</a>
				        </li>
					</ul>
				</div>
				<div class="admin-bread">
					
					<ul class="bread">
						<li><a href="" class="">首页</a></li>
						<li><a href="">数据统计</a></li>
						<li class="show_text">部门业务统计</li>
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