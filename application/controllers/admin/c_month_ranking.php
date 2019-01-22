<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_month_ranking extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/m_month_ranking');
        if (session_login()) {
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }

        date_default_timezone_set('Asia/Shanghai');
        //获取文件根目录路径 
        define('ROOT_PATHS', $this->config->item('root_path')); 
    }
    //主页显示
    public function index()
    {
        
        //获取数据
        $res = $this->result_data();

        $this->load->view('public/header');
        $this->load->view('month_ranking/Index',$res);
    }


    //表导出
    public function export(){

        $fileName = "月车管考核排名总表.xlsx";
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
        $objPHPExcel->getProperties()->setTitle("月车管考核排名总表");
        //题目
        $objPHPExcel->getProperties()->setSubject("月车管考核排名总表");
        //描述
        $objPHPExcel->getProperties()->setDescription("月车管考核排名总表");
        //关键字
        $objPHPExcel->getProperties()->setKeywords("月车管考核排名总表");
        //种类
        $objPHPExcel->getProperties()->setCategory("报表汇总");




        //设置当前的sheet
        $objPHPExcel->setActiveSheetIndex(0);
        //设置sheet的name
        $objPHPExcel->getActiveSheet()->setTitle('月车管考核排名总表');


        //所有表格居中
        $objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(35);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:A2');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', "项目/得分/单位");
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);
        
        //$objPHPExcel->getActiveSheet()->getStyle('A1:A2')->getBorders()->setDiagonalDirection(\PHPExcel_Style_Borders::DIAGONAL_DOWN );
        //$objPHPExcel->getActiveSheet()->getStyle('A1:A2')->getBorders()->getDiagonal()-> setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
        //表头添加样式
        $objPHPExcel->getActiveSheet()->getStyle( 'A1:O2')->applyFromArray(
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




        $objPHPExcel->getActiveSheet()->mergeCells('B1:E1');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', '隐患歼灭战工作考核');
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->setWrapText(true);


        //加粗居中
       /* $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray(

                    array(

                        'font' => array (
                           'bold' => true
                        ),

                        'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER
                        )

                    )

        );*/

        $objPHPExcel->getActiveSheet()->mergeCells('F1:I1');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', '当月应检车辆完成情况');
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getAlignment()->setWrapText(true);

        /*//加粗居中
        $objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray(

                    array(

                        'font' => array (
                           'bold' => true
                        ),

                        'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                        )

                    )

        );*/

        $objPHPExcel->getActiveSheet()->mergeCells('J1:L1');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', '五类车检验工作考核');
        $objPHPExcel->getActiveSheet()->getStyle('J1')->getAlignment()->setWrapText(true);


        /*//加粗居中
        $objPHPExcel->getActiveSheet()->getStyle('J1')->applyFromArray(

                    array(

                        'font' => array (
                           'bold' => true
                        ),

                        'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                        )

                    )

        );*/

        $objPHPExcel->getActiveSheet()->mergeCells('M1:O1');
        $objPHPExcel->getActiveSheet()->setCellValue('M1', '按本月完成中队任务数得分及排名情况');
        $objPHPExcel->getActiveSheet()->getStyle('M1')->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);


        /*//加粗居中
        $objPHPExcel->getActiveSheet()->getStyle('M1')->applyFromArray(

                    array(

                        'font' => array (
                           'bold' => true
                        ),

                        'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                        )

                    )

        );*/

        $objPHPExcel->getActiveSheet()->setCellValue('B2', '任务数');
        $objPHPExcel->getActiveSheet()->setCellValue('C2', '完成数');
        $objPHPExcel->getActiveSheet()->setCellValue('D2', '得分数');
        $objPHPExcel->getActiveSheet()->setCellValue('E2', '拨款数');
        $objPHPExcel->getActiveSheet()->setCellValue('F2', '任务数');
        $objPHPExcel->getActiveSheet()->setCellValue('G2', '完成数');
        $objPHPExcel->getActiveSheet()->setCellValue('H2', '得分数');
        $objPHPExcel->getActiveSheet()->setCellValue('I2', '拨款数');
        $objPHPExcel->getActiveSheet()->setCellValue('J2', '完成数');
        $objPHPExcel->getActiveSheet()->setCellValue('K2', '得分数');
        $objPHPExcel->getActiveSheet()->setCellValue('L2', '拨款数');
        $objPHPExcel->getActiveSheet()->setCellValue('M2', '总分');
        $objPHPExcel->getActiveSheet()->setCellValue('N2', '排名');
        $objPHPExcel->getActiveSheet()->setCellValue('O2', '拨款总数');



        //获取数据
        $result_data = $this->result_data();


        for($i=0;$i<count($result_data['arr2']);$i++){
            $num = $i+3;
            //大队名称
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$num, $result_data['arr2'][$i]);
            //隐患歼灭战工作考核任务数
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$num, $result_data['data']['p'][$i][0]['nums']);
            //隐患歼灭战工作考核完成数
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$num, $result_data['data1']['p'][$i][0]['anums']);
            //隐患歼灭战工作考核得分数
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$num, $result_data['datac']['m'][$i][0]);
            //隐患歼灭战工作考核拨款数
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$num, $result_data['array1']['m'][$i][0]);

            //当月应检车辆完成情况任务数
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$num, $result_data['data']['r'][$i][0]['nums']);
            //当月应检车辆完成情况完成数
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$num, $result_data['data1']['r'][$i][0]['anums']);
            //当月应检车辆完成情况得分数
            $objPHPExcel->getActiveSheet()->setCellValue('H'.$num, $result_data['datac']['n'][$i][0]);
            //当月应检车辆完成情况拨款数
            $objPHPExcel->getActiveSheet()->setCellValue('I'.$num, $result_data['array2']['n'][$i][0]);

            //五类车检验工作考核完成数
            $objPHPExcel->getActiveSheet()->setCellValue('J'.$num, $result_data['data1']['q'][$i][0]['anums']);
            //五类车检验工作考核得分数
            $objPHPExcel->getActiveSheet()->setCellValue('K'.$num, $result_data['datac']['k'][$i][0]);
            //五类车检验工作考核拨款数
            $objPHPExcel->getActiveSheet()->setCellValue('L'.$num, $result_data['array3']['p'][$i][0]);

            //总分
            $objPHPExcel->getActiveSheet()->setCellValue('M'.$num, $result_data['datag']['c'][$i][0]);
            //排名
            $objPHPExcel->getActiveSheet()->setCellValue('N'.$num, $result_data['dataj']['h'][$i][0]);
            //拨款总数
            $objPHPExcel->getActiveSheet()->setCellValue('O'.$num, $result_data['total']['t'][$i][0]);

        }


        //添加边框
        $objPHPExcel->getActiveSheet()->getStyle( 'A1:O11')->applyFromArray(
                  array(


                        'borders' => array(
                                'allborders' => array( //设置全部边框
                                'style' => \PHPExcel_Style_Border::BORDER_THIN //粗的是thick
                            ),

                        ),


                    )
        );


        //保护cell
        // $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true); // Needs to be set to true in order to enable any worksheet protection!
        // $objPHPExcel->getActiveSheet()->protectCells('B1:E1', 'PHPExcel');


        //设置单元格的值
        /*$objPHPExcel->getActiveSheet()->setCellValue('A1', 'String');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 12);
        $objPHPExcel->getActiveSheet()->setCellValue('A3', true);
        $objPHPExcel->getActiveSheet()->setCellValue('C5', '=SUM(C2:C4)');
        $objPHPExcel->getActiveSheet()->setCellValue('B8', '=MIN(B2:C5)');
        //合并单元格
        $objPHPExcel->getActiveSheet()->mergeCells('A18:E22');*/
        //分离单元格
        //$objPHPExcel->getActiveSheet()->unmergeCells('A28:B28');






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
        //查询数据(查询每个中队的每项任务的总数，完成数，计算出相应的得分)
        $arr = array(
            0 => '610902015000',         //江南中队
            1 => '610902015100',         //江北中队
            2 => '610902010200',         //巡逻中队
            3 => '610902015300',         //张滩中队
            4 => '610902015400',         //瀛湖中队
            5 => '610902015500',         //大河中队
            6 => '610902015600',         //谭坝中队
            7 => '610902015700',         //洪山中队
            8 => '610902010100'          //指导中队
        );
        $arr1 = array(
            0 => 1,                      //隐患歼灭战工作考核
            1 => 2,                      //当月应检车辆 
            2 => 3                       //五类车检验
        );
        $res['arr2'] = array(
            0 => '江南中队',
            1 => '江北中队',
            2 => '巡逻中队',
            3 => '张滩中队',
            4 => '瀛湖中队',
            5 => '大河中队',
            6 => '谭坝中队',
            7 => '洪山中队',
            8 => '指导中队'
        );

        //先查询出总数
        $res['data'] = $this->m_month_ranking->select_all_numbers($arr,$arr1);

        

        //当月第一天
        $month_first = strtotime(date('Y-m-01 0:0:0'));
        //当月最后一天
        $month = date('Y-m-01', strtotime(date("Y-m-d")));
        $month_end =  strtotime(date('Y-m-d 23:59:59', strtotime("$month +1 month -1 day")));

        //查询出完成数
        $res['data1'] = $this->m_month_ranking->select_accomplish_numbers($arr,$arr1,$month_first,$month_end);
        
        $arrt =  $res['data'];        //任务总数
        $arrh = $res['data1'];        //任务完成数



        //计算各个中队 隐患歼灭战工作考核 的得分数
        for($i = 0;$i<count($arrt['p']);$i++)
        {
            if($arrt['p'][$i][0]['nums'] != 0)
            {
                $arry['m'][][] = ($arrh['p'][$i][0]['anums'])/($arrt['p'][$i][0]['nums'])*40;
            }else
                {
                    $arry['m'][][] = 0;
                }
        }


        //计算各个中队 当月应检车辆完成情况 的得分数
        for($i = 0;$i<count($arrt['r']);$i++)
        {
            if($arrt['r'][$i][0]['nums'] != 0)
            {
                $arry['n'][][] = ($arrh['r'][$i][0]['anums'])/($arrt['r'][$i][0]['nums'])*30;
            }else
                {
                    $arry['n'][][] = 0;
                }
        }
        //计算各个中队 五类车检验工作考核 的得分数
        for($i = 0;$i<count($arrt['q']);$i++)
        {
            if($arrt['q'][$i][0]['nums'] != 0)
            {
                $arry['k'][][] = ($arrh['q'][$i][0]['anums'])/($arrt['q'][$i][0]['nums'])*20;
            }else
                {
                    $arry['k'][][] = 0;
                }
        }

        $res['datac'] = $arry;
        //计算各个中队的月得分总数
        for($j=0;$j<count($arry['m']);$j++)
        {
            $arrg['c'][][] = $arry['m'][$j][0]+ $arry['n'][$j][0]+ $arry['k'][$j][0];
        }


        $res['datag'] =  $arrg;
        //根据总分数进行排名
        //降维
        $arrw = array();
        $arri = array();
        foreach ($arrg['c'] as $vals)
        {
           array_push($arrw,$vals[0]);        //排序之前
        }
        $arrl = $arrw;
        rsort($arrw);


        for ($i=0;$i<count($arrl);$i++)
        {
            for($j=0;$j<count($arrw);$j++)
            {
                if($arrl[$i] == $arrw[$j])
                {
                    $arrd = array(
                        0=>$j+1
                    );
                    array_push($arri,$arrd);
                    $arrl[$i] = -1;
                    //var_dump($j+1);
                }
            }
        }
        //var_dump($arri);
        $arrj['h'] = $arri;
        //var_dump($arrj);exit;
        $res['dataj'] = $arrj;             //排名


       

        //var_dump($arri);
        //查询系统添加的当月 各个中队 三项任务的拨款数
        //1. 各个中队隐患歼灭战的拨款
        $array1 = $this->m_month_ranking->select_hidden_danger();
        //2. 各个中队当月应检车辆的拨款
        $array2 = $this->m_month_ranking->select_the_month();
        //3. 各个中队五类车检验的拨款
        $array3 = $this->m_month_ranking->select_five_types();
        $arrays1 = array();
        $arrays2 = array();
        $arrays3 = array();

        
        if($array1){
            foreach ($array1 as $row)
            {
                foreach ($row as $v)
                {
                    $arrays1['m'][][] = $v;
                }
            }
        }else{

             for($i=0;$i<count($res['arr2']);$i++){
                $arrays1['m'][][] = 0;
             }

        }
        

        if($array2){
            foreach ($array2 as $row)
            {
                foreach ($row as $v)
                {
                    $arrays2['n'][][] = $v;
                }
            }
        }else{

            for($i=0;$i<count($res['arr2']);$i++){
                $arrays2['n'][][] = 0;
            }

        }

        if($array3){
            foreach ($array3 as $row)
            {
                foreach ($row as $v)
                {
                    $arrays3['p'][][] = $v;
                }
            }
        }else{

            for($i=0;$i<count($res['arr2']);$i++){
                $arrays3['p'][][] = 0;
            }

        }
        

        
        //var_dump($arrays1);exit;
        $res['array1'] = $arrays1;
        $res['array2'] = $arrays2;
        $res['array3'] = $arrays3;


        
        //拨款总数
        for($t=0;$t<count($arrays1['m']);$t++)
        {
            $total_arr['t'][][] = $arrays1['m'][$t][0]+$arrays2['n'][$t][0]+$arrays3['p'][$t][0];
        }
        $res['total'] =  $total_arr;


        return $res;

    }


}