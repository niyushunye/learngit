
    <link rel="stylesheet" href="<?php echo base_url();?>public/zTree/css/zTreeStyle/zTreeStyle.css">

    <script src="<?php echo base_url();?>public/zTree/js/jquery.ztree.core.js"></script>
    <script src="<?php echo base_url();?>public/zTree/js/jquery.ztree.excheck.js"></script>
    

    
    


    <!--兼容IE8,主要解决在IE8下的一些问题
        1、HTML5的兼容
        2、不同屏幕高度的显示效果
    -->
    <!--[if IE 8]>
    <script src="<?php echo base_url();?>assets/js/respond.js" ></script>
    <script src="<?php echo base_url();?>assets/js/html5.js"  ></script>
    <!--<link href="<?php echo base_url();?>assets/css/screen.css" rel="stylesheet">-->
    <![endif]-->
<body class="bg-white">
        <div class="tab" style="">
            <div class="tab-body" style="width: 95%;">
            <br>
                <div class="tab-panel active" id="tab-set" style="">
                    <form method="post" class="form-x" method="post" action="<?php echo base_url();?>admin/c_roleinfo/update" target="_top">
                    <?php foreach ($roleinfo as $key => $value): ?>
                        <input type="hidden" name="roleid" id="roleid" value="<?php echo $value['roleid'];?>">
                        <div class="form-group">
                            <div class="label">
                                <label for="rolefield">权限英文名称：</label>
                            </div>
                            <div class="field">
                                <input type="text" class="input" id="rolefield" name="rolefield" value="<?php echo $value['rolefield'];?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label">
                                <label for="rolename">权限中文名称：</label>
                            </div>
                            <div class="field">
                                <input type="text" class="input" id="rolename" name="rolename" onblur="check_rolename()" value="<?php echo $value['rolename'];?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label">
                                <label for="remark">权限备注说明：</label>
                            </div>
                            <div class="field">
                                <input type="text" class="input" id="remark" name="remark" value="<?php echo $value['remark'];?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label">
                                <label for="classify">选择模块：</label>
                            </div>
                            <div class="field">
                                <nav>
                                    <ul id="treeDemo" class="ztree"></ul>
                                </nav>
                                <input type="hidden" name="moduleids" id="moduleids">
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
<script type="text/javascript">
    var setting = {
        check: {
            enable: true,
            chkStyle: "checkbox",
            chkboxType: { "Y": "ps", "N": "ps" }
        },
        callback: {
            onCheck: zTreeOnCheck
        },
        view: {
            showLine: false
        },
        data: {
            simpleData:{
                enable: true
            }
        }
    };

    function zTreeOnCheck() {
        var treeObj = $.fn.zTree.getZTreeObj("treeDemo");
        var nodes = treeObj.getCheckedNodes("checked");

        var m = "";
        for (var i = 0; i < nodes.length; i++) {
            m += ","+nodes[i].id;
        }
        // document.write(msg);
        $("#moduleids").val(m);
    };


    var zNodes =<?php print_r(json_encode($result,JSON_UNESCAPED_UNICODE));?>;
    $(document).ready(function(){
        $.fn.zTree.init($("#treeDemo"), setting, zNodes);
        zTreeOnCheck();
    });

    function moduleids(){
        var treeObj = $.fn.zTree.getZTreeObj("treeDemo");
        var nodes = treeObj.getCheckedNodes("checked");
        return nodes;
    }

    $("#sub").click(function () {

        if ($("#rolename").val() == "") {
            alert("权限中文名称不能为空");
            $("#rolename").focus();
            return false;
        }

        if ($("#moduleids").val() == "") {
            layer.msg("请为该权限的保留一个功能");
            return false;
        }

    });

    function  check_rolename(){
        var str = $('#rolename').val();
        var roleid = $("#roleid").val();
        if(str.match(/[^\u4e00-\u9fa5]/g)){
            layer.msg("权限中文名称只能输入中文");
            $("#rolename").focus();
        }else{
            $.post('<?php echo base_url();?>admin/C_roleinfo/check_rolename',{"rolename":str, "roleid":roleid},function(data){
                if(data == 0){

                }else{
                    layer.msg("权限中文名已存在");
                    $("#rolename").focus();
                }
            });
        }
    }

</script>

</body>
</html>
