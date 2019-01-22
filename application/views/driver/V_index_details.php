<body class="bg-white fixed_more">
<div class="" style="margin:20px;">
    <div class="">
        <div class="">
            <div class="">
                <div class="">
                    <div class="form-group x6 form3">
                    </div>
                </div>
                <form class="form-horizontal" name="roadinfo_select_delete" method="post" action="">
                    <div class="ibox-content">

                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th nowrap="nowrap" width="7%">序号</th>
                                <td nowrap="nowrap"><?php echo $id?></td>
                                <th nowrap="nowrap" width="7%">行政区划</th>
                                <td nowrap="nowrap"><?php echo $xzqh_name['name']?></td>
                                <th nowrap="nowrap" width="7%">档案编号</th>
                                <td nowrap="nowrap"><?php echo $dabh?></td>
                            </tr>
                            <tr>

                                <th nowrap="nowrap" width="7%">身份证号</th>
                                <td nowrap="nowrap"><?php echo $sfzh?></td>
                                <th nowrap="nowrap" width="7%">姓名</th>
                                <td nowrap="nowrap"><?php echo $xm?></td>
                                <th nowrap="nowrap" width="7%">性别</th>
                                <td nowrap="nowrap"><?php if($xb == 1){echo '男';}else{echo '女';}?></td>
                            </tr>
                            <tr>
                                <th nowrap="nowrap" width="7%">手机号码</th>
                                <td nowrap="nowrap"><?php echo $sjhm?></td>
                                <th nowrap="nowrap" width="7%">农机驾驶员</th>
                                <td nowrap="nowrap"><?php if($njjsy == 1){echo '是';}else{echo '否';}?></td>
                                <th nowrap="nowrap" width="7%">联系电话</th>
                                <td nowrap="nowrap"><?php echo $lxdh?></td>
                            </tr>
                            <tr>
                                <th nowrap="nowrap" width="7%">工作单位</th>
                                <td nowrap="nowrap"><?php echo $gzdw?></td>
                                <th nowrap="nowrap" width="7%">从业资格证号</th>
                                <td nowrap="nowrap"><?php echo $cyzgzh?></td>
                                <th nowrap="nowrap" width="7%">发证日期</th>
                                <td nowrap="nowrap"><?php  echo $fzrq?></td>
                            </tr>
                            <tr>
                                <th nowrap="nowrap" width="7%">过期日期</th>
                                <td nowrap="nowrap"><?php echo $gqrq?></td>
                                <th nowrap="nowrap" width="7%">驾驶证</th>
                                <td nowrap="nowrap"><?php if($jsz == 1){echo '有驾驶证';}else{echo '无驾驶证';}?></td>
                                <th nowrap="nowrap" width="7%">户籍地</th>
                                <td nowrap="nowrap"><?php echo $hjd?></td>
                            </tr>
                            <tr>

                                <th nowrap="nowrap" width="7%">长期工作地</th>
                                <td nowrap="nowrap"><?php echo $cqgzd?></td>
                                <th nowrap="nowrap" width="7%">住所地址</th>
                                <td nowrap="nowrap"><?php echo $zsdz?></td>
                                <th nowrap="nowrap" width="7%">邮政编码</th>
                                <td nowrap="nowrap"><?php echo $yzbm?></td>
                            </tr>
                            <tr>
                                <th nowrap="nowrap" width="7%">统计时间</th>
                                <td nowrap="nowrap"><?php echo $tjsj?></td>
                                <th nowrap="nowrap" width="7%">采集时间</th>
                                <td nowrap="nowrap"><?php echo date('Y-m-d H:i',$cjsj)?></td>
                                <th nowrap="nowrap" width="7%">录入警员</th>
                                <td nowrap="nowrap"><?php echo $jymc['name']?></td>
                            </tr>


                            <?php if($jsz == 1){?>
                                <tr>
                                    <th nowrap="nowrap" width="7%">准驾车型</th>
                                    <td nowrap="nowrap"><?php  echo $zjcx?></td>
                                    <th nowrap="nowrap" width="7%">驾证期限</th>
                                    <td nowrap="nowrap"><?php  echo $jzqx?></td>
                                    <th nowrap="nowrap" width="7%">有效期始</th>
                                    <td nowrap="nowrap"><?php  echo $yxqs?></td>
                                </tr>
                                <tr>
                                    <th nowrap="nowrap" width="7%">有效期止</th>
                                    <td nowrap="nowrap"><?php  echo $yxqz?></td>
                                    <th nowrap="nowrap" width="7%">初次领证日期</th>
                                    <td nowrap="nowrap"><?php  echo $cclzrq?></td>
                                    <th nowrap="nowrap" width="7%">下一审检日期</th>
                                    <td nowrap="nowrap"><?php  echo $xysyrq?></td>
                                </tr>
                                <tr>
                                    <th nowrap="nowrap" width="7%">累计积分</th>
                                    <td nowrap="nowrap"><?php  echo $ljjf?></td>
                                    <th nowrap="nowrap" width="7%"></th>
                                    <td nowrap="nowrap"></td>
                                    <th nowrap="nowrap" width="7%"></th>
                                    <td nowrap="nowrap"></td>
                                </tr>
                            <?php }?>
                            </thead>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>