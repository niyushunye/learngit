<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_control_statistics extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/m_control_statistics');
        if (session_login()) {
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }

        date_default_timezone_set('Asia/Shanghai');
        //获取文件根目录路径 
        define('ROOT_PATHS', $this->config->item('root_path')); 
    }

    public function  index()
    {
        
        //获取数据
        $res = $this->result_data();

        $this->load->view('public/header');
        $this->load->view('control_statistics/Index',$res);
    }

    //表单导出
    public function export(){

        $fileName = "路面防控统计通报表.xlsx";
        $fileNames = iconv('UTF-8', 'GBK', $fileName);

        include ROOT_PATHS.'classes/PHPExcel.php';
        include ROOT_PATHS.'classes/PHPExcel/Writer/Excel2007.php';
        //或者include 'PHPExcel/Writer/Excel5.php'; 用于输出.xls的
        //创建一个excel
        $objPHPExcel = new PHPExcel();

        //设置excel的属性：
        //创建人
        $objPHPExcel->getProperties()->setCreator("admin");
        //最后修改人
        $objPHPExcel->getProperties()->setLastModifiedBy("admin");
        //标题
        $objPHPExcel->getProperties()->setTitle("路面防控统计通报表");
        //题目
        $objPHPExcel->getProperties()->setSubject("路面防控统计通报表");
        //描述
        $objPHPExcel->getProperties()->setDescription("路面防控统计通报表");
        //关键字
        $objPHPExcel->getProperties()->setKeywords("路面防控统计通报表");
        //种类
        $objPHPExcel->getProperties()->setCategory("统计通报表");


        //设置当前的sheet
        $objPHPExcel->setActiveSheetIndex(0);
        //设置sheet的name
        $objPHPExcel->getActiveSheet()->setTitle('路面防控统计通报表');

        //所有表格居中
        $objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        //$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(25);

        $objPHPExcel->getActiveSheet()->mergeCells('A1:B2');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', "考核任务/考核单位");

        $objPHPExcel->getActiveSheet()->mergeCells('C1:D1');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', '四类重点车');

        $objPHPExcel->getActiveSheet()->mergeCells('E1:F1');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', '三驾');

        $objPHPExcel->getActiveSheet()->mergeCells('G1:I1');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', '三乱');

        $objPHPExcel->getActiveSheet()->setCellValue('J1', '两牌');

        $objPHPExcel->getActiveSheet()->mergeCells('K1:L1');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', '两闯');

        $objPHPExcel->getActiveSheet()->mergeCells('M1:N1');
        $objPHPExcel->getActiveSheet()->setCellValue('M1', '三车');
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);

        $objPHPExcel->getActiveSheet()->setCellValue('O1', '两无');

        $objPHPExcel->getActiveSheet()->mergeCells('P1:P2');
        $objPHPExcel->getActiveSheet()->setCellValue('P1', "机动车未检验");
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);

        $objPHPExcel->getActiveSheet()->mergeCells('Q1:Q2');
        $objPHPExcel->getActiveSheet()->setCellValue('Q1', "不礼让斑马线");
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);

        $objPHPExcel->getActiveSheet()->mergeCells('R1:R2');
        $objPHPExcel->getActiveSheet()->setCellValue('R1', "非机动车行人违法");
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);

        $objPHPExcel->getActiveSheet()->mergeCells('S1:S2');
        $objPHPExcel->getActiveSheet()->setCellValue('S1', "合计");

        $objPHPExcel->getActiveSheet()->setCellValue('C2', '超载');
        $objPHPExcel->getActiveSheet()->setCellValue('D2', '超员');
        $objPHPExcel->getActiveSheet()->setCellValue('E2', '酒驾 醉驾');
        $objPHPExcel->getActiveSheet()->setCellValue('F2', '毒驾');

        $objPHPExcel->getActiveSheet()->setCellValue('G2', '乱停车');
        $objPHPExcel->getActiveSheet()->setCellValue('H2', '乱变道');
        $objPHPExcel->getActiveSheet()->setCellValue('I2', '乱用灯光');

        $objPHPExcel->getActiveSheet()->setCellValue('J2', '假牌套牌');
        $objPHPExcel->getActiveSheet()->setCellValue('K2', '闯禁令');
        $objPHPExcel->getActiveSheet()->setCellValue('L2', '闯红灯');
        $objPHPExcel->getActiveSheet()->setCellValue('M2', '电动车');
        $objPHPExcel->getActiveSheet()->setCellValue('N2', '工程运输车');
        $objPHPExcel->getActiveSheet()->setCellValue('O2', '无牌无证');
        $objPHPExcel->getActiveSheet()->setCellValue('P2', '机动车未检验');
        $objPHPExcel->getActiveSheet()->setCellValue('Q2', '不礼让斑马线');
        $objPHPExcel->getActiveSheet()->setCellValue('R2', '非机动车行人违法');
        $objPHPExcel->getActiveSheet()->setCellValue('S2', '合计');


        $objPHPExcel->getActiveSheet()->getStyle( 'A1:S2')->applyFromArray(
             array(
                   'font'    => array (
                         'bold'      => true
                   ),
                   
                   'borders' => array (
                         'top'     => array (
                               'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                   ),

                   'fill' => array (
                         'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR ,
                         'rotation'   => 90,
                         'startcolor' => array (
                               'argb' => 'FFA0A0A0'
                         ),
                         'endcolor'   => array (
                               'argb' => 'FFFFFFFF'
                         )
                  )
            )
        );




        //获取数据
        $result_data = $this->result_data();

        // echo "<pre>";
        // print_r($result_data);
        // echo "</pre>";
        // die;


        //定义超载
        //$caozai = array();
        //定义超员
        //$caoyuan = array();
        //定义酒驾、醉驾
        //$jiujia = array();


        for($j=1;$j<=count($result_data['arr2']);$j++){  
            
            
            $n = $j-1;
            /*月总量*/
            $m = 2*$j + 1;
            /*已完成数*/
            $q = 2*$j + 2;
            
            //超载
            $caozai[$m] = $result_data['arr_total'][$n][0];//总数
            $caozais[$q] = $result_data['alr_total'][$n][0]; //已完成数
            //超员
            $caoyuan[$m] = $result_data['arr_total'][$n][1];//总数
            $caoyuans[$q] = $result_data['alr_total'][$n][1]; //已完成数
            //酒驾、醉驾
            $jiujia[$m] = $result_data['arr_total'][$n][2];  //总数
            $jiujias[$q] = $result_data['alr_total'][$n][2]; //已完成数
            //毒驾
            $dujia[$m] = $result_data['arr_total'][$n][3];  //总数
            $dujias[$q] = $result_data['alr_total'][$n][3]; //已完成数

            //乱停车
            $tingche[$m] = $result_data['arr_total'][$n][4];  //总数
            $tingches[$q] = $result_data['alr_total'][$n][4]; //已完成数
            //乱变道
            $biandao[$m] = $result_data['arr_total'][$n][5];  //总数
            $biandaos[$q] = $result_data['alr_total'][$n][5]; //已完成数
            //乱用灯光
            $dingguan[$m] = $result_data['arr_total'][$n][6];  //总数
            $dingguans[$q] = $result_data['alr_total'][$n][6]; //已完成数
            //假牌套牌
            $taopai[$m] = $result_data['arr_total'][$n][7];  //总数
            $taopais[$q] = $result_data['alr_total'][$n][7]; //已完成数
            //闯禁令
            $jingling[$m] = $result_data['arr_total'][$n][8];  //总数
            $jinglings[$q] = $result_data['alr_total'][$n][8]; //已完成数
            //闯红灯
            $hongdeng[$m] = $result_data['arr_total'][$n][9];  //总数
            $hongdengs[$q] = $result_data['alr_total'][$n][9]; //已完成数
            //电动车
            $diandongche[$m] = $result_data['arr_total'][$n][10];  //总数
            $diandongches[$q] = $result_data['alr_total'][$n][10]; //已完成数
            //工程运输车
            $yunshuche[$m] = $result_data['arr_total'][$n][11];  //总数
            $yunshuches[$q] = $result_data['alr_total'][$n][11]; //已完成数
            //无牌无证
            $wuzheng[$m] = $result_data['arr_total'][$n][12];  //总数
            $wuzhengs[$q] = $result_data['alr_total'][$n][12]; //已完成数
            //机动车未检验
            $weijiangyan[$m] = $result_data['arr_total'][$n][13];  //总数
            $weijiangyans[$q] = $result_data['alr_total'][$n][13]; //已完成数
            //不礼让斑马线
            $banmaxian[$m] = $result_data['arr_total'][$n][14];  //总数
            $banmaxians[$q] = $result_data['alr_total'][$n][14]; //已完成数
            //非机动车行人违法
            $weifa[$m] = $result_data['arr_total'][$n][15];  //总数
            $weifas[$q] = $result_data['alr_total'][$n][15]; //已完成数



            //全部的总数
            $month_arr_total[$m] = $result_data['month_arr_total'][$n];
            //全部的已完成数
            $month_alr_total[$q] = $result_data['month_alr_total'][$n];
           
        }


        
        //超载
        $objPHPExcel->getActiveSheet()->setCellValue('C19', $result_data['task_arr_total'][0]);
        $objPHPExcel->getActiveSheet()->setCellValue('C20', $result_data['task_alr_total'][0]);
        //超员
        $objPHPExcel->getActiveSheet()->setCellValue('D19', $result_data['task_arr_total'][1]);
        $objPHPExcel->getActiveSheet()->setCellValue('D20', $result_data['task_alr_total'][1]);
        //酒驾
        $objPHPExcel->getActiveSheet()->setCellValue('E19', $result_data['task_arr_total'][2]);
        $objPHPExcel->getActiveSheet()->setCellValue('E20', $result_data['task_alr_total'][2]);
        //毒驾
        $objPHPExcel->getActiveSheet()->setCellValue('F19', $result_data['task_arr_total'][3]);
        $objPHPExcel->getActiveSheet()->setCellValue('F20', $result_data['task_alr_total'][3]);

        //乱停车
        $objPHPExcel->getActiveSheet()->setCellValue('G19', $result_data['task_arr_total'][4]);
        $objPHPExcel->getActiveSheet()->setCellValue('G20', $result_data['task_alr_total'][4]);
        //乱变道
        $objPHPExcel->getActiveSheet()->setCellValue('H19', $result_data['task_arr_total'][5]);
        $objPHPExcel->getActiveSheet()->setCellValue('H20', $result_data['task_alr_total'][5]);
        //乱用灯光
        $objPHPExcel->getActiveSheet()->setCellValue('I19', $result_data['task_arr_total'][6]);
        $objPHPExcel->getActiveSheet()->setCellValue('I20', $result_data['task_alr_total'][6]);
        //假牌套牌
        $objPHPExcel->getActiveSheet()->setCellValue('J19', $result_data['task_arr_total'][7]);
        $objPHPExcel->getActiveSheet()->setCellValue('J20', $result_data['task_alr_total'][7]);
        //闯禁令
        $objPHPExcel->getActiveSheet()->setCellValue('K19', $result_data['task_arr_total'][8]);
        $objPHPExcel->getActiveSheet()->setCellValue('K20', $result_data['task_alr_total'][8]);
        //闯红灯
        $objPHPExcel->getActiveSheet()->setCellValue('L19', $result_data['task_arr_total'][9]);
        $objPHPExcel->getActiveSheet()->setCellValue('L20', $result_data['task_alr_total'][9]);
        //电动车
        $objPHPExcel->getActiveSheet()->setCellValue('M19', $result_data['task_arr_total'][10]);
        $objPHPExcel->getActiveSheet()->setCellValue('M20', $result_data['task_alr_total'][10]);
        //工程运输车
        $objPHPExcel->getActiveSheet()->setCellValue('N19', $result_data['task_arr_total'][11]);
        $objPHPExcel->getActiveSheet()->setCellValue('N20', $result_data['task_alr_total'][11]);
        //无牌无证
        $objPHPExcel->getActiveSheet()->setCellValue('O19', $result_data['task_arr_total'][12]);
        $objPHPExcel->getActiveSheet()->setCellValue('O20', $result_data['task_alr_total'][12]);
        //机动车未检验
        $objPHPExcel->getActiveSheet()->setCellValue('P19', $result_data['task_arr_total'][13]);
        $objPHPExcel->getActiveSheet()->setCellValue('P20', $result_data['task_alr_total'][13]);
        //不礼让斑马线
        $objPHPExcel->getActiveSheet()->setCellValue('Q19', $result_data['task_arr_total'][14]);
        $objPHPExcel->getActiveSheet()->setCellValue('Q20', $result_data['task_alr_total'][14]);
        //非机动车行人违法
        $objPHPExcel->getActiveSheet()->setCellValue('R19', $result_data['task_arr_total'][15]);
        $objPHPExcel->getActiveSheet()->setCellValue('R20', $result_data['task_alr_total'][15]);



        $objPHPExcel->getActiveSheet()->setCellValue('S19', $result_data['total_nums']);
        $objPHPExcel->getActiveSheet()->setCellValue('S20', $result_data['atotal_nums']);


    






        

        for($i=0;$i<count($result_data['arr2'])*2;$i++){
            $total_num = $i+3;
            $complete_num = $i+4;


            
                
            if($total_num%2 == 1){

                $objPHPExcel->getActiveSheet()->setCellValue('B'.$total_num, '月总量');
                //超载
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$total_num, $caozai[$total_num][0]['total']);
                //超员
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$total_num, $caoyuan[$total_num][0]['total']);
                //酒驾
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$total_num, $jiujia[$total_num][0]['total']);
                //毒驾
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$total_num, $dujia[$total_num][0]['total']);

                //乱停车
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$total_num, $tingche[$total_num][0]['total']);
                //乱变道
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$total_num, $biandao[$total_num][0]['total']);
                //乱用灯光
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$total_num, $dingguan[$total_num][0]['total']);
                //假牌套牌
                $objPHPExcel->getActiveSheet()->setCellValue('J'.$total_num, $taopai[$total_num][0]['total']);
                //闯禁令
                $objPHPExcel->getActiveSheet()->setCellValue('K'.$total_num, $jingling[$total_num][0]['total']);
                //闯红灯
                $objPHPExcel->getActiveSheet()->setCellValue('L'.$total_num, $hongdeng[$total_num][0]['total']);
                //电动车
                $objPHPExcel->getActiveSheet()->setCellValue('M'.$total_num, $diandongche[$total_num][0]['total']);
                //工程运输车
                $objPHPExcel->getActiveSheet()->setCellValue('N'.$total_num, $yunshuche[$total_num][0]['total']);
                //无牌无证
                $objPHPExcel->getActiveSheet()->setCellValue('O'.$total_num, $wuzheng[$total_num][0]['total']);
                //机动车未检验
                $objPHPExcel->getActiveSheet()->setCellValue('P'.$total_num, $weijiangyan[$total_num][0]['total']);
                //不礼让斑马线
                $objPHPExcel->getActiveSheet()->setCellValue('Q'.$total_num, $banmaxian[$total_num][0]['total']);
                //非机动车行人违法
                $objPHPExcel->getActiveSheet()->setCellValue('R'.$total_num, $weifa[$total_num][0]['total']);


                $objPHPExcel->getActiveSheet()->setCellValue('S'.$total_num, $month_arr_total[$total_num]);
                






            }

            if($complete_num%2 == 0){
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$complete_num, '已完成量');
                //超载
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$complete_num, $caozais[$complete_num][0]['total']);
                //超员
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$complete_num, $caoyuans[$complete_num][0]['total']);
                //酒驾
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$complete_num, $jiujias[$complete_num][0]['total']);
                //毒驾
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$complete_num, $dujias[$complete_num][0]['total']);

                //乱停车
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$complete_num, $tingches[$complete_num][0]['total']);
                //乱变道
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$complete_num, $biandaos[$complete_num][0]['total']);
                //乱用灯光
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$complete_num, $dingguans[$complete_num][0]['total']);
                //假牌套牌
                $objPHPExcel->getActiveSheet()->setCellValue('J'.$complete_num, $taopais[$complete_num][0]['total']);
                //闯禁令
                $objPHPExcel->getActiveSheet()->setCellValue('K'.$complete_num, $jinglings[$complete_num][0]['total']);
                //闯红灯
                $objPHPExcel->getActiveSheet()->setCellValue('L'.$complete_num, $hongdengs[$complete_num][0]['total']);
                //电动车
                $objPHPExcel->getActiveSheet()->setCellValue('M'.$complete_num, $diandongches[$complete_num][0]['total']);
                //工程运输车
                $objPHPExcel->getActiveSheet()->setCellValue('N'.$complete_num, $yunshuches[$complete_num][0]['total']);
                //无牌无证
                $objPHPExcel->getActiveSheet()->setCellValue('O'.$complete_num, $wuzhengs[$complete_num][0]['total']);
                //机动车未检验
                $objPHPExcel->getActiveSheet()->setCellValue('P'.$complete_num, $weijiangyans[$complete_num][0]['total']);
                //不礼让斑马线
                $objPHPExcel->getActiveSheet()->setCellValue('Q'.$complete_num, $banmaxians[$complete_num][0]['total']);
                //非机动车行人违法
                $objPHPExcel->getActiveSheet()->setCellValue('R'.$complete_num, $weifas[$complete_num][0]['total']);


                $objPHPExcel->getActiveSheet()->setCellValue('S'.$complete_num, $month_alr_total[$complete_num]);


            }

            if($i==0){
                $objPHPExcel->getActiveSheet()->mergeCells('A'.$total_num.':A'.$complete_num);
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$total_num, $result_data['arr2'][$i]);
            }

            if($i%2==0){
                $a = $i+3;
                $b = $i+4;
                $ii = $i/2;
                $objPHPExcel->getActiveSheet()->mergeCells('A'.$a.':A'.$b);
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$a, $result_data['arr2'][$ii]);

                if(count($result_data['arr2'])*2-2 == $i){
                    $m = $i+5;
                    $n = $i+6;

                    $objPHPExcel->getActiveSheet()->setCellValue('B'.$m, '月总量');
                    $objPHPExcel->getActiveSheet()->setCellValue('B'.$n, '月完成量');

                    $objPHPExcel->getActiveSheet()->mergeCells('A'.$m.':A'.$n);
                    $objPHPExcel->getActiveSheet()->setCellValue('A'.$m, '合计');
                }
                
            }




        }

        
    
        //添加边框
        $objPHPExcel->getActiveSheet()->getStyle( 'A1:S20')->applyFromArray(
                  array(


                        'borders' => array(
                                'allborders' => array( //设置全部边框
                                'style' => \PHPExcel_Style_Border::BORDER_THIN //粗的是thick
                            ),

                        ),


                    )
        );

    

        //保存excel—2007格式
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        //或者$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); 非2007格式
        $objWriter->save(ROOT_PATHS."assets/uploads/excel/".$fileNames);

        
        //下载
        $excelPath = ROOT_PATHS.'assets/uploads/excel/'.$fileNames;
        header( "Content-Disposition:  attachment;  filename=".$fileNames); //告诉浏览器通过附件形式来处理文件
        header('Content-Length: ' . filesize($excelPath)); //下载文件大小
        readfile($excelPath);  //读取文件内容
        //删除服务器源word文件
        //@unlink(ROOT_PATHS.'assets/uploads/excel/'.$na);
    }


    protected function result_data(){

        //数据统计
        $arr = array(
            0 => '610902015000',         //江南中队
            1 => '610902015100',         //江北中队
            2 => '610902015300',         //张滩中队
            3 => '610902015400',         //瀛湖中队
            4 => '610902010200',         //巡逻中队
            5 => '610902015600',         //谭坝中队
            6 => '610902015500',         //大河中队
            7 => '610902015700',         //洪山中队
        );
        $res['arr2'] = array(
            0 => '江南',
            1 => '江北',
            2 => '张滩',
            3 => '瀛湖',
            4 => '巡逻',
            5 => '谭坝',
            6 => '大河',
            7 => '洪山',
        );
        $arrs = array(
            0 => '2005',        //超载
            1 => '2004',        //超员
            2 => '1003-1001',   //酒驾、醉驾
            3 => '1002',        //毒驾
            4 => '2011',        //乱停车
            5 => '2012',        //乱变道
            6 => '2013',        //乱用灯光
            7 => '2003-2002',   //假牌、套牌
            8 => '2009',        //闯禁令
            9 => '2008',        //闯红灯
            10 => '2016',       //电动车
            11 => '2014',       //工程车
            12 => '2006-2007',  //无牌、无证
            13 => '2010',       //未检验
            14 => '2017',       //不礼让斑马线
            15 => '2018-2019',  //非机动车违法、行人违法
        );

        //当月第一天
        $month_first = strtotime(date('Y-m-01 0:0:0'));
        //当月最后一天
        $month = date('Y-m-01', strtotime(date("Y-m-d")));
        $month_end =  strtotime(date('Y-m-d 23:59:59', strtotime("$month +1 month -1 day")));

        $p = -1;
        foreach($arr as $val)
        {
            $p++;
            foreach ($arrs as $v)
            {
                $arrf[$p][] = $this->m_control_statistics->select_total_data($val,$v,$month_first,$month_end);     //每个部门当月各类违法的总数
                $arra[$p][] = $this->m_control_statistics->select_already_data($val,$v,$month_first,$month_end);   //每个部门当月各类违法的完成数
            }

        }

        
        $res['arr_total'] = $arrf;
        $res['alr_total'] = $arra;

        //合计
        $arrk = array();
        for($m=0;$m<count($arrf);$m++)
        {
            $nums = 0;
            for($n=0;$n<count($arrf[$m]);$n++)
            {
                $nums += $arrf[$m][$n][0]['total'];
            }
            array_push($arrk,$nums);              //各个中队的所有考核任务月总数
        }


        $arrg = array();
        for($m=0;$m<count($arra);$m++)
        {
            $nums = 0;
            for($n=0;$n<count($arra[$m]);$n++)
            {
                $nums += $arra[$m][$n][0]['total'];
            }
            array_push($arrg,$nums);              //各个中队的所有考核任务月完成总数
        }
        $res['month_arr_total'] = $arrk;
        $res['month_alr_total'] = $arrg;


        // echo "<pre>";
        // print_r($res);
        // echo "</pre>";
        // die;

        //计算各个考核任务的月总数
        $arrv = array();
        $arrk = array();
        for($x=0;$x<count($arrf[0]);$x++)        //16
        {
            $num = 0;
            for($y=0;$y<count($arrf);$y++)       //8
            {
                 $num += $arrf[$y][$x][0]['total'];
            }
            array_push($arrv,$num);
        }

        //计算各个考核任务的月完成总数
        for($x=0;$x<count($arra[0]);$x++)
        {
            $num = 0;
            for($y=0;$y<count($arra);$y++)
            {
                $num += $arra[$y][$x][0]['total'];
            }
            array_push($arrk,$num);
        }
       
       
        $res['task_arr_total'] = $arrv;
        $res['task_alr_total'] = $arrk;
        //合计的合计
        $total_nums = 0;
        $atotal_nums = 0;
        foreach ($arrv as $val)
        {
            $total_nums = $total_nums+$val;          //月总量
        }
        foreach ($arrk as $val)
        {
            $atotal_nums = $atotal_nums+$val;        //月完成量
        }
        $res['total_nums'] = $total_nums;
        $res['atotal_nums'] = $atotal_nums;



        return $res;




    }




}