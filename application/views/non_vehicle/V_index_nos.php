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
                                <th nowrap="nowrap" width="7%">好牌号码</th>
                                <td nowrap="nowrap"><?php echo $hphm?></td>
                            </tr>
                            <tr>

                                <th nowrap="nowrap" width="7%">好牌种类</th>
                                <td nowrap="nowrap"><?php echo $hpzl_name111['DMSM1']?></td>
                                <th nowrap="nowrap" width="7%">车架号</th>
                                <td nowrap="nowrap"><?php echo $cjh?></td>
                                <th nowrap="nowrap" width="7%">车辆特征</th>
                                <td nowrap="nowrap"><?php echo $cltz?></td>
                            </tr>
                            <tr>
                                <th nowrap="nowrap" width="7%">车辆类别</th>
                                <td nowrap="nowrap"><?php echo $cllb_name['DMSM1']?></td>
                                <th nowrap="nowrap" width="7%">使用性质</th>
                                <td nowrap="nowrap"><?php echo $syxz_name['DMSM1']?></td>
                                <th nowrap="nowrap" width="7%">品牌型号</th>
                                <td nowrap="nowrap"><?php echo $ppxh?></td>
                            </tr>
                            <tr>
                                <th nowrap="nowrap" width="7%">购买时间</th>
                                <td nowrap="nowrap"><?php echo $gmsj?></td>
                                <th nowrap="nowrap" width="7%">户籍地</th>
                                <td nowrap="nowrap"><?php if($hjd == 1){echo '本地';}else{echo '外地';}?></td>
                                <th nowrap="nowrap" width="7%">车辆所有人</th>
                                <td nowrap="nowrap"><?php  echo $clsyr?></td>
                            </tr>
                            <tr>
                                <th nowrap="nowrap" width="7%">手机号码</th>
                                <td nowrap="nowrap"><?php echo $sjhm?></td>
                                <th nowrap="nowrap" width="7%">身份证号</th>
                                <td nowrap="nowrap"><?php echo $sfzh?></td>
                                <th nowrap="nowrap" width="7%">联系住址</th>
                                <td nowrap="nowrap"><?php echo $lxzz?></td>
                            </tr>
                            <tr>

                                <th nowrap="nowrap" width="7%">邮政编码</th>
                                <td nowrap="nowrap"><?php echo $yzbm?></td>
                                <th nowrap="nowrap" width="7%">摸底时间</th>
                                <td nowrap="nowrap"><?php echo $mdsj?></td>
                                <th nowrap="nowrap" width="7%">采集时间</th>
                                <td nowrap="nowrap"><?php echo date('Y-m-d H:i',$cjsj)?></td>
                            </tr>
                            <tr>
                                <th nowrap="nowrap" width="7%">警员编号</th>
                                <td nowrap="nowrap"><?php echo $jymc['name']?></td>
                                <th nowrap="nowrap" width="7%"></th>
                                <td nowrap="nowrap"></td>
                                <th nowrap="nowrap" width="7%"></th>
                                <td nowrap="nowrap"></td>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>