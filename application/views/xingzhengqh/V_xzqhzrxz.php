<body class="bg-white fixed_filelist_content">
<div class="" style="margin:20px;">
    <div class="">
        <div class="">
            <div class="">
                <form class="form-horizontal" name="" method="post" action="">
                    <div class="ibox-content">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr class="bg-back">
                                <th width="20%">行政区划</th>
                                <th width="80%">安全责任干部详情</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($data as $k => $v){?>
                                <?php if(count($v['details']) != 0){?>
                                    <tr>
                                        <th style="font-weight: 400"><?php echo $v['name']?></th>
                                        <th style="text-align: left;font-weight: 400">
                                            <?php foreach ($v['details'] as $k1 => $v2){?>
                                                <?php echo $v2['name']?>|<?php if($v2['position'] == 1){echo '安全责任干部';}else if($v2['position'] == 2){echo '包村民警';}else{ echo '信息员';}?>|
                                                <?php echo $v2['phone_number']?>,
                                            <?php }?>
                                        </th>
                                    </tr>
                                <?php }?>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
