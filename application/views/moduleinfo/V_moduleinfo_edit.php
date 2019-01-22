<body class="bg-white">
        <div class="tab" style="">
            <div class="tab-body" style="width: 95%;">
            <br>
                <div class="tab-panel active" id="tab-set" style="">
                    <form method="post" class="form-x" method="post" action="<?php echo base_url();?>admin/c_moduleinfo/update" target="_top">
                    <?php foreach ($moduleinfo as $k => $v): ?>
                        <input type="hidden" name="moduleid" id="moduleid" value="<?php echo $v['moduleid']?>">
                        <div class="form-group">
                            <div class="label">
                                <label for="modtitle">模块中文名称：</label>
                            </div>
                            <div class="field">
                                <input type="text" class="input" id="modtitle" name="modtitle" value = "<?php echo $v['modtitle']?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label">
                                <label for="modname">模块英文名称：</label>
                            </div>
                            <div class="field">
                                <input type="text" class="input" id="modname" name="modname" value = "<?php echo $v['modname']?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label">
                                <label for="modurl">模块URL：</label>
                            </div>
                            <div class="field">
                                <?php
                                    if($v['parentid'] == ""){
                                        echo '<input type="text" class="input" id ="modurl" name="modurl" value="'.$v['modurl'].'" readonly>';
                                    }else{
                                        echo '<input type="text" class="input" id ="modurl" name="modurl" value="'.$v['modurl'].'">';
                                    }
                                ?>
                                <!-- <input type="text" class="input" id="modurl" name="modurl" "<?php echo $v['modurl']?>"> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="label">
                                <label for="parentid">父模块名称：</label>
                            </div>
                            <div class="field">
                                <select class="input" name="parentid" id="parentid">
                                    <?php

                                    //当parentid为0时，证明它已经是根目录，则不能再出现parentid的项
                                    //当parentid不为0时，则需要显示这项。
                                    if($get_parentid['parentid'] != 0 ){
                                        echo "<option value=". $get_parentid['parentid'].">". $v['parentid']."</option>";
                                        foreach($get_parentid_modtitle as &$value)
                                        {
                                            echo "<option value=".$value['moduleid'].">".$value['modtitle']."</option>";
                                        }
                                    }else{
                                        echo "<option value='0'>已是最高模块</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label">
                                <label for="classify">模块类型：</label>
                            </div>
                            <div class="field">
                                <select class="input" name="classify" id="classify" required="true">
                                        <?php
                                        if($v['classify'] == 1)
                                        {
                                            echo "<option value=\"1\" selected=\"selected\">PC端模块</option>";
                                        }

                                        if($v['classify'] == 2)
                                        {
                                            echo "<option value=\"2\" selected=\"selected\">手机模块</option>";
                                        }
                                        ?>
                                        <option value="1">PC端模块</option>
                                        <option value="2">手机端模块</option>
                                    </select>
                            </div>
                        </div>

                        <div class="form-button">
                            <label class="bread">注：该操作会造成页面刷新。</label>
                            <button class="button button-small bg-main operate_sub" type="submit" id="sub">确定</button>
                        </div>
                    <?php endforeach; ?>
                    </form>
                </div>
            </div>
        </div>
        <p class="text-right text-gray"></p>
    </div>
</body>
<script>
    $("#sub").click(function () {

        if ($("#modtitle").val() == "") {
            layer.msg("模块中文名称不能为空");
            $("#modtitle").focus();
            return false;
        }
        if ($("#classify").val() == -1) {
            layer.msg("请选择你的模块类型");
            $("#classify").focus();
            return false;
        }

    });
</script>