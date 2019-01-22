<body class="bg-white fixed_filelist_content">
    <div class="" style="margin:20px;">
        <div class="">
            <div class="">
                <div class="">
                    <div class="">
                        <div class="form-group form2">
                            <form method="post" action="<?php echo base_url()?>admin/C_memberinfo/search">
                                <div class="filed input-group">
                                    <div class = "search2">
                                        <span>警员编号：</span><input type="text" id="accounts" name="accounts" maxlength="6" style="width: 80px" value="<?php echo $accounts?>"> &nbsp;&nbsp;&nbsp;
                                        <span>真实姓名：</span><input type="text" id="realname" name="realname" maxlength="10" style="width: 100px" value="<?php echo $realname?>"> &nbsp;&nbsp;&nbsp;
                                        <input type="hidden" id="this_orgnum" name="orgnum" value="<?php echo $orgnum?>">
                                        <button type="submit" class="button button-small border border-yellow operate_sub" id="search">搜索</button>
                                    </div>
                                </span>
                                </div>
                            </form>
                        </div>

                        <div class="right_button" style="width: 10%; position: relative; left: 1.5%">
                            <a href="#" class="button button-small border border-green operate_sub add">新增</a>
                        </div>
                    </div>
                    <form class="form-horizontal" name="" method="post" action="">
                    <div class="ibox-content">
                        
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="bg-back">
                                    <!-- <th>序号</th> -->
                                    <th>真实姓名</th>
                                    <th>警员编号</th>
                                    <th>组织机构编码</th>
                                    <th>手机号码</th>
                                    <th>身份证号</th>
                                    <th>帐号状态</th>
                                    <!-- <th>添加时间</th> -->
                                    <th width="13%">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($memberinfo as $k => $v): ?>

                                <tr>
                                    <!-- <td><?php echo $v['memberid'];?></td> -->
                                    <td><?php echo $v['realname'];?></td>
                                    <td><?php echo $v['accounts'];?></td>
                                    <td><?php echo $v['orgnum'];?></td>
                                    <td><?php echo $v['mobile'];?></td>
                                    <td><?php echo $v['idcard'];?></td>
                                    <td><?php
                                            if($v['status'] == 1){
                                                echo '正常';
                                            }elseif($v['status'] == 0){
                                                echo '禁用';
                                            }
                                       ?></td>
                                    <!-- <td><?php echo date('Y-m-d H:i:s',$v['dateline']);?></td> -->
                                    <td>
                                        <a href="#" hfht = "<?php echo$v['accounts'];?>" class="edit button button-small border border-blue operate_sub"></i>编辑</a>
                                        <a href="#" hfht = "<?php echo$v['accounts'];?>" class="delete button button-small border border-gray operate_sub">删除</a>
                                        <?php if($v['serial_number']!=""){?>
                                            <a href="#" hfht = "<?php echo$v['accounts'];?>" class="relieve button button-small border border-gray">解除绑定</a>
                                        <?php }?>
                                    </td>
                                    </tr>
                            <?php endforeach; ?> 
                            <input type="hidden" id="this_orgnum" value="<?php echo $orgnum?>">
                            </tbody>
                        </table>
                            <ul>
                                <?php echo $this->pagination->create_links(); ?><span class="total">共 <?php echo $total;?> 条</span>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <script>
        $("#search").click(function(){
            var accounts = $("#accounts").val();
            var realname = $("#realname").val();
            if(accounts == "" && realname == ""){
                layer.msg("请填写查询条件");
                return false;
            }
        });
        $(".delete") .click(function(){
            var accounts = $(this).attr('hfht');
            var this_orgnum = $("#this_orgnum").val();
            layer.confirm('你确定要删除该数据？', {
            btn: ['确定','取消'] //按钮
            }, function(){
                $.post('<?php echo base_url();?>admin/c_memberinfo/delete/',{"accounts":accounts},function(data){
                    // alert(data);
                    if(data != 1){
                        window.location.href = '<?php echo base_url()?>admin/C_memberinfo/filelist/' + this_orgnum;
                        layer.msg('删除失败');
                    }else{
                        window.location.href= '<?php echo base_url()?>admin/C_memberinfo/filelist/' + this_orgnum;
                        layer.msg('删除成功');
                    }
                })
            }, function(){
                layer.closeAll();
                    // window.location.href = '<?php echo base_url()?>admin/C_member_roadinfo';
            });
        });
        $(".relieve") .click(function(){
            var accounts = $(this).attr('hfht');
            var this_orgnum = $("#this_orgnum").val();
            layer.confirm('你确定要解除绑定？', {
            btn: ['确定','取消'] //按钮
            }, function(){
                $.post('<?php echo base_url();?>admin/c_memberinfo/relieve/',{"accounts":accounts},function(data){
                    if(data != 1){
                        window.location.href = '<?php echo base_url()?>admin/C_memberinfo/filelist/' + this_orgnum;
                        layer.msg('解除失败');
                    }else{
                        window.location.href= '<?php echo base_url()?>admin/C_memberinfo/filelist/' + this_orgnum;
                        layer.msg('解除成功');
                    }
                })
            }, function(){
                layer.closeAll();
                    // window.location.href = '<?php echo base_url()?>admin/C_member_roadinfo';
            });
        });

        //新增
        $(".add").click(function(){
            var id = $(this).attr('hfht');
            layer.open({
                type:2,
                title:'新增',
                skin:'layui-layer-lan',
                area:['70%','400px'],
                content: ['<?php echo base_url();?>admin/c_memberinfo/add/<?php echo $orgnum?>', 'yes']
            })
        });

        //编辑
        $(".edit").click(function(){
            var id = $(this).attr('hfht');
            layer.open({
                type:2,
                title:'编辑',
                skin:'layui-layer-lan',
                area:['70%','400px'],
                content: ['<?php echo base_url();?>admin/c_memberinfo/edit/'+id, 'yes']
            })
        });
    </script>
</body>
</html>
