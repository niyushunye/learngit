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
        padding-top: 20px;
        text-indent:2em;
    }
</style>
<body class="bg-white ">
    <div class="title">
        <?php echo $subject?>
    </div>
    <p class="time"><span>发布人姓名:<?php echo $realname?></span>&nbsp;&nbsp;&nbsp; <span>发布时间:<?php echo date('Y-m-d H:i',$createTime)?></span></p>
    <div class="content"><?php echo $content?></div>
</body>
</html>