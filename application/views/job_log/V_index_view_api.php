<style>
    .title{
        width: 100%;
        height: 40px;
        text-align: center;
        font-size: 20px;
        line-height: 40px;
        font-weight: bolder;
    }
    .time{
        text-align: center;
        color: #9b9b9b;
    }
    .content{
        padding:20px 15px 20px 25px ;
        text-align: center;
    }
    .ren{
        padding: 10px 20px 0 20px;
    }
    .type{
        padding: 10px 20px 0 20px;
    }
</style>
<body class="bg-white ">
    <div class="title">
        工作日志
    </div>
    <p class="time">
        <span>警员名称:<?php echo $realname?></span>
        <span>添加时间:<?php echo date('Y-m-d H:i',$create_time)?></span>
    </p>
    <p class="type"><span>任务类型：</span>
        <?php if($log_type == 1){?>
            <?php echo '日常';?>
        <?php }else if($log_type == 2){?>
            <?php echo '党建';?>
        <?php }else if($log_type == 3){?>
            <?php echo '法制';?>
        <?php }else if($log_type == 4){?>
            <?php echo '宣传';?>
        <?php }else if($log_type == 5){?>
            <?php echo '指挥中心';?>
        <?php }else if($log_type == 99){?>
            <?php echo '其他';?>
        <?php }?>;
        <span>出勤情况：</span>
        <?php if($attendance == 0){?>
            <?php echo '正常上班';?>
        <?php }else if($attendance == 1){?>
            <?php echo '事假';?>
        <?php }else if($attendance == 2){?>
            <?php echo '病假';?>
        <?php }else if($attendance == 3){?>
            <?php echo '旷工';?>
        <?php }else if($attendance == 4){?>
            <?php echo '休假';?>
        <?php }else if($attendance == 5){?>
            <?php echo '迟到';?>
        <?php }else if($attendance == 6){?>
            <?php echo '早退';?>
        <?php }?>;
        <span>时间：</span><?php echo $log_time?>;
    </p>
    <p class="ren"><span>工作完成情况：</span>
        <p style="padding-left: 14%;padding-right: 5%"><?php echo $work_completion?></p>
    </p>
    <p class="ren"><span>工作失误情况：</span>
        <p style="padding-left: 14%;padding-right: 5%"><?php echo $work_fault?></p>
    </p>
    <p class="ren"><span>学习培训情况：</span>
        <p style="padding-left: 14%;padding-right: 5%"><?php echo $learning_progress?></p>
    </p>
    <p style="padding:10px 0 0 20px"><span>图片：</span></p>
    <div class="content">
            <?php foreach ($img as $k => $v){?>
                <p style="margin-bottom: 10px">
                    <a href="<?php echo base_url().$v?>" target="_blank">
                        <img src="<?php echo base_url().$v?>" alt="" style="width: 90%;height: 200px">
                    </a>
                </p>
            <?php }?>
    </div>
</body>
</html>