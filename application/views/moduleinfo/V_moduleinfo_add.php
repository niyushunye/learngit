<body class="bg-white">
        <div class="tab" style="">
            <div class="tab-body" style="width: 95%;">
            <br>
                <div class="tab-panel active" id="tab-set" style="">
                    <form method="post" class="form-x" method="post" action="<?php echo base_url();?>admin/c_moduleinfo/save" target="_top">
                        <div class="form-group">
                            <div class="label">
                                <label for="modtitle">模块中文名称：</label>
                            </div>
                            <div class="field">
                                <input type="text" class="input" id="modtitle" name="modtitle">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label">
                                <label for="modname">模块英文名称：</label>
                            </div>
                            <div class="field">
                                <input type="text" class="input" id="modname" name="modname">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label">
                                <label for="modurl">模块URL：</label>
                            </div>
                            <div class="field">
                                <input type="text" class="input" id="modurl" name="modurl">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="label">
                                <label for="parentid">父模块名称：</label>
                            </div>
                            <div class="field">
                                <select class="input" name="parentid" id="parentid">
                                        <option value="0">-- 请选择 --（如果不选择，则默认为根栏目）</option>
                                        <?php
                                            foreach($moduleinfo as $value)
                                            {
                                                echo "<option value = ".$value['moduleid'].">".$value['modtitle']."</option>";
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
                                        <option value="-1">-- 请选择 --</option>
                                        <option value="1">PC端模块</option>
                                        <option value="2">手机端模块</option>
                                    </select>
                            </div>
                        </div>
                        <!-- <label>注：该操作会造成页面刷新。</label> -->
                        
                        <div class="form-button">
                            <label class="bread">注：该操作会造成页面刷新。</label>
                            <button class="button button-small bg-main operate_sub" type="submit" id="sub">确定</button>
                        </div>
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
