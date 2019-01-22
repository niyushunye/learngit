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
                                    <th nowrap="nowrap" width="7%">排查时间</th>
                                    <td nowrap="nowrap"><?php echo $pcsj?></td>
                                </tr>
                                <tr>

                                    <th nowrap="nowrap" width="7%">是否隐患</th>
                                    <td nowrap="nowrap"><?php if($is_danger == 1){echo '是';}else{echo '否';}?></td>
                                    <th nowrap="nowrap" width="7%">联系电话</th>
                                    <td nowrap="nowrap"><?php echo $lxdh?></td>
                                    <th nowrap="nowrap" width="7%">道路辖区名称</th>
                                    <td nowrap="nowrap"><?php echo $dlmc?></td>
                                </tr>
                                <tr>

                                    <th nowrap="nowrap" width="7%">隐患路段</th>
                                    <td nowrap="nowrap"><?php echo $yhld?></td>
                                    <th nowrap="nowrap" width="7%">事故多发路段</th>
                                    <td nowrap="nowrap"><?php echo $sgdfld?></td>
                                    <th nowrap="nowrap" width="7%">隐患现状</th>
                                    <td nowrap="nowrap"><?php echo $yhxz?></td>
                                </tr>
                                <tr>

                                    <th nowrap="nowrap" width="7%">采集时间</th>
                                    <td nowrap="nowrap"><?php  echo date('Y-m-d H:s',$cjsj)?></td>
                                    <th nowrap="nowrap" width="7%">更新时间</th>
                                    <td nowrap="nowrap"><?php  echo date('Y-m-d H:s',$cjsj)?></td>
                                    <th nowrap="nowrap" width="7%">录入警员</th>
                                    <td nowrap="nowrap"><?php  echo $lrmj['name']?></td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>