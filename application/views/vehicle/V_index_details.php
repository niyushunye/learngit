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
                                <th nowrap="nowrap" width="7%">好牌种类</th>
                                <td nowrap="nowrap"><?php echo $hpzl_name111['DMSM1']?></td>
                            </tr>
                            <tr>

                                <th nowrap="nowrap" width="7%">好牌号码</th>
                                <td nowrap="nowrap"><?php echo $hphm?></td>
                                <th nowrap="nowrap" width="7%">车辆类别</th>
                                <td nowrap="nowrap"><?php echo $cllb_name['DMSM1']?></td>
                                <th nowrap="nowrap" width="7%">使用性质</th>
                                <td nowrap="nowrap"><?php echo $syxz_name['DMSM1']?></td>
                            </tr>
                            <tr>
                                <th nowrap="nowrap" width="7%">接送学生车辆</th>
                                <td nowrap="nowrap"><?php if($jsxscl == 1){echo '是';}else{echo '否';}?></td>
                                <th nowrap="nowrap" width="7%">品牌型号</th>
                                <td nowrap="nowrap"><?php echo $ppxh?></td>
                                <th nowrap="nowrap" width="7%">初次登记日期</th>
                                <td nowrap="nowrap"><?php echo $ccdjrq?></td>
                            </tr>
                            <tr>
                                <th nowrap="nowrap" width="7%">户籍地</th>
                                <td nowrap="nowrap"><?php if($hjd == 1){echo '本地';}else{echo '外地';}?></td>
                                <th nowrap="nowrap" width="7%">长期所在地</th>
                                <td nowrap="nowrap"><?php if($cqszd == 1){echo '本地';}else{echo '外地';}?></td>
                                <th nowrap="nowrap" width="7%">检验有效期止</th>
                                <td nowrap="nowrap"><?php  echo $jyyxqz?></td>
                            </tr>
                            <tr>
                                <th nowrap="nowrap" width="7%">强制报废期止</th>
                                <td nowrap="nowrap"><?php echo $qzbfqz?></td>
                                <th nowrap="nowrap" width="7%">是否客运车辆</th>
                                <td nowrap="nowrap"><?php if($sfkycl == 1){echo '是';}else{echo '否';}?></td>
                                <th nowrap="nowrap" width="7%">车辆所有人</th>
                                <td nowrap="nowrap"><?php echo $clsyr?></td>
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
                                <th nowrap="nowrap" width="7%">录入时间</th>
                                <td nowrap="nowrap"><?php echo date('Y-m-d H:i',$cjsj)?></td>

                            </tr>

                            <?php if($sfkycl == 1){?>
                            <tr>
                                <th nowrap="nowrap" width="7%">座位数</th>
                                <td nowrap="nowrap"><?php  echo $zws?></td>
                                <th nowrap="nowrap" width="7%">公司化经营</th>
                                <td nowrap="nowrap"><?php if($gshjy == 1){echo '是';}else{echo '否';}?></td>
                                <th nowrap="nowrap" width="7%">公司名</th>
                                <td nowrap="nowrap"><?php  echo $gsm?></td>
                            </tr>
                            <tr>
                                <th nowrap="nowrap" width="7%">安装GPS监控</th>
                                <td nowrap="nowrap"><?php if($azgpsjk == 1){echo '是';}else{echo '否';}?></td>
                                <th nowrap="nowrap" width="7%">GPS监控单位</th>
                                <td nowrap="nowrap"><?php  echo $gpsjkdw?></td>
                                <th nowrap="nowrap" width="7%">配置安全带</th>
                                <td nowrap="nowrap"><?php if($pzaqd == 1){echo '是';}else{echo '否';}?></td>
                            </tr>
                            <tr>
                                <th nowrap="nowrap" width="7%">安装防护栏</th>
                                <td nowrap="nowrap"><?php if($azfhl == 1){echo '是';}else{echo '否';}?></td>
                                <th nowrap="nowrap" width="7%">路面宽3.5路基宽4.5</th>
                                <td nowrap="nowrap"><?php if($lmkd == 1){echo '是';}else{echo '否';}?></td>
                                <th nowrap="nowrap" width="7%">道路里程</th>
                                <td nowrap="nowrap"><?php echo $dllc?></td>
                            </tr>
                            <tr>
                                <th nowrap="nowrap" width="7%">途径道路</th>
                                <td nowrap="nowrap"><?php  echo $tjdl?></td>
                                <th nowrap="nowrap" width="7%">运营证号码</th>
                                <td nowrap="nowrap"><?php  echo $yyzhm?></td>
                                <th nowrap="nowrap" width="7%">运营证发证日期</th>
                                <td nowrap="nowrap"><?php  echo $yyzfzrq?></td>
                            </tr>
                            <tr>
                                <th nowrap="nowrap" width="7%">运营证过期日期</th>
                                <td nowrap="nowrap"><?php  echo $yyzgqrq?></td>
                                <th nowrap="nowrap" width="7%"></th>
                                <td nowrap="nowrap"></td>
                                <th nowrap="nowrap" width="7%"></th>
                                <td nowrap="nowrap"></td>
                            </tr>
                            <?php }?>
                            <tr>
                                <th nowrap="nowrap" width="7%">录入警员</th>
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