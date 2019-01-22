<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">

    <meta name="keywords" content="<?php echo config_item('keywords');?>">
    <meta name="description" content="<?php echo config_item('description');?>">
    <link rel="stylesheet" href="<?php echo base_url()?>public/css/pintuer.css">
    <link rel="stylesheet" href="<?php echo base_url()?>public/css/admin.css">
    <link rel="stylesheet" href="<?php echo base_url()?>public/layui/css/layui.css">
    <!-- <script src="<?php echo base_url()?>public/js/admin.js"></script> -->
    <script src="<?php echo base_url()?>public/js/jquery.min.js?V=2.1.4"></script>
    <!-- <script src="<?php echo base_url()?>public/js/pintuer.js"></script> -->
    <script src="<?php echo base_url()?>public/js/respond.js"></script>
    <script src= "<?php echo base_url()?>public/layer/layer.min.js"></script>
    <script src="<?php echo base_url();?>public/layer/laydate/laydate.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>public/layui/layui.js"></script>
    <style type="text/css">
        /*固定窗口，显示上下左右拉条*/
        /*.fixed {*/
            /*!*div 默认 block 级别, inline 会使 尺寸类属性失效 *!*/
            /*display: block;*/
            /*min-width:1430px;*/
        /*}*/
        /*.fixed_filelist_content{*/
            /*display: block;*/
            /*min-width:970px;*/
        /*}*/
        /*.fixed_more{*/
            /*display: block;*/
            /*min-width:930px;*/
        /*}*/
        /*.total{*/
            /*height: 36px;*/
            /*line-height: 36px;*/
            /*margin-left:10px;*/
        /*}*/




        .search1 span{
            font-size: 16px;
        }
        .search1 input{
            height: 34px;
        }

        .search2 input{
            height: 23px;
            position: relative;
            top: 3px;
        }

        /*!*搜索输入框*!*/
        /*.my_input{*/
            /*height: 23px;*/
            /*width: 175px;*/
        /*}*/

        /*.my_input2{*/
            /*height: 23px;*/
            /*width: 175px;*/
            /*position: relative;*/
            /*top: 5px;*/
        /*}*/

        /*.select2{*/
            /*height: 23px;padding:0; margin:0;width: 175px;*/
        /*}*/

        /*!*抬头输入框设置*!*/
        /*.search_div{*/

            /*float:left;*/
            /*width: 100%;*/
        /*}*/
        /*.search_table{*/
            /*!*border:1px solid red;*!*/
            /*width: 100%;*/
        /*}*/
        .search_table td{
            width: 20%;
            padding-top: 5px;
            /*border:1px solid black;*/
        }

        /*.td2{*/
            /*align:left;*/
            /*!*width: 12.5%;*!*/
            /*!*border:1px solid red;*!*/
        /*}*/

        /*.search_accounts{*/
            /*!*position: relative;*/
            /*top: 22px;*!*/
            /*width: 60px;*/
            /*height: 23px;*/
            /*margin-left: 70px;*/
            /*margin-right: 70px;*/
        /*}*/

        /*.search_sub{*/
            /*!*position: relative;*/
            /*top: 17px;*!*/
            /*width: 46px;*/
            /*height: 30px;*/
        /*}*/

        /*.search_sub_big{*/
            /*!*position: relative;*/
            /*top: 17px;*!*/
            /*width: 92px;*/
            /*height: 30px;*/
        /*}*/

        /*.operate_sub{*/
            /*width: 46px;*/
            /*height: 30px;*/
        /*}*/

        /*.operate_sub_big{*/
            /*width: 92px;*/
            /*height: 30px;*/
        /*}*/

        /*!*日期框插件 框向上调整，和文字对其*!*/
        /*.layer_input{*/
            /*margin-top: -5px;*/
            /*!*padding-right: 0px;*!*/
        /*}*/




        /*.form1{*/
            /*width: 80%;*/
            /*margin-top: -10px;*/
            /*float: left;*/
        /*}*/


        /*.form2{*/
            /*width: 90%;*/
            /*margin-top: -10px;*/
            /*float: left;*/
        /*}*/

        /*.form3{*/
            /*width: 100%;*/
            /*margin-top: -10px;*/
            /*float: left;*/
        /*}*/


        /*.right_button{*/
            /*width: 20%;*/
            /*margin-top: -10px;*/
            /*margin-bottom: 10px;*/
            /*left: 0%;*/
            /*float: left;*/
        /*}*/

        /*.right_button2{*/
            /*!*width: 20%;*!*/
            /*margin-top: -10px;*/
            /*margin-bottom: 10px;*/
            /*left: 0%;*/
            /*float: left;*/
        /*}*/

        .button a img{
            margin-top: 20px;
        }
        .layui-layer-lan .layui-layer-title{
            background: #09c;
        }
        /*.layui-layer-title{*/
            /*background-color: #09c;*/
        /*}*/
        .layui-layer-btn .layui-layer-btn0{
            border-color:#09c;
            background-color: #09c;
            color: #333;
        }
        /*.input{*/
            /*width: 90%;*/
        /*}*/

        /*.form-group{*/
            /*text-align: center;*/
        /*}*/

        /*.search-width{*/
            /*width: 100%;*/
        /*}*/

        /*.form-button{*/
            /*margin-top: 20px;*/
            /*text-align: right;*/
        /*}*/

        /*.label{*/
            /*float: left;*/
            /*width: 30%;*/
        /*}*/
        /*.field{*/
            /*float: left;*/
            /*width: 70%;*/
        /*}*/


        /*日期插件样式调整*/
        .laydate_body .laydate_top{
            background-color: #09c;
        }

        .laydate_body .laydate_click{
            background-color: #09c!important;
        }

        .laydate_body .laydate_ym{
            background-color: #09c;
        }
        .laydate_body .laydate_ym .laydate_yms{
            border: 1px solid #09c;
            background-color: #09c;
        }



        .table th{
            text-align: center;
        }
        .table td{
            padding: 0px;
            margin: 0px;
            text-align: center;
            height: 10px;
            line-height: 30px;
        }
    </style>
</head>

