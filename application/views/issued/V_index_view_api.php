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
        width: 100%;
        padding-top: 20px;
        padding-right: 20px;
        text-indent:2em;
    }
    .content p{
        padding-left: 17px;
        padding-bottom: 10px;
    }
    .ren{
        padding: 10px 20px 0 20px;
    }
    .type{
        padding: 10px 20px 0 47px;
    }
</style>
<body class="bg-white ">
<div class="title">
    <?php echo $title?>
</div>
<p class="time">
    <span>发布人姓名:<?php echo $task_realname?></span>&nbsp;&nbsp;&nbsp;
    <span>发布时间:<?php echo date('Y-m-d H:i',$create_time)?></span>&nbsp;&nbsp;&nbsp;
    <span>下发部门:<?php echo $orgname['orgname']?></span>
</p>
<p class="type"><span>任务类型：</span>
    <?php if($work_type == 1){?>
        <?php echo '日常';?>
    <?php }else if($work_type == 2){?>
        <?php echo '党建';?>
    <?php }else if($work_type == 3){?>
        <?php echo '法制';?>
    <?php }else if($work_type == 4){?>
        <?php echo '宣传';?>
    <?php }else if($work_type == 5){?>
        <?php echo '指挥中心';?>
    <?php }else if($work_type == 99){?>
        <?php echo '其他';?>
    <?php }?>
</p>
<div class="content"><p><span>任务内容：</span></p>
    <div id="contents"><?php echo $content?></div>
</div>
</body>
</html>

