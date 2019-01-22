<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class c_work_logtj extends CI_Controller{
    //危险道路统计
    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this -> load -> model('admin/m_work_logtj');
        $this->load->library('pagination');
        define('ROOT_PATHS', $this->config->item('root_path'));

        date_default_timezone_set("Asia/Shanghai");
        if(session_login()){
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }
    }

    public function index(){
        $data['orgnum'] = $this -> m_work_logtj -> select_orginfo();
        $this -> load -> view('public/header');
        $this -> load -> view('work_log/V_index',$data);
    }

    public function search(){
        $type = $this -> input -> post('type',TRUE);   //默认的日志类型
        $time = $this -> input -> post('time',TRUE);   //查询的时间
        $mjbm = $this -> input -> post('mjbm',TRUE);   //民警编号
        $bmdm = $this -> input -> post('bmdm',TRUE);   //部门代码
        $data = $this -> m_work_logtj -> select_type($type,$time,$mjbm,$bmdm);

        if($data){
            echo json_encode($data);
        }else{
            echo 1;
        }
    }

    //导出表格
    public function export(){

        $fileName = "考核日志工作统计表.xlsx";
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
        $objPHPExcel->getProperties()->setTitle("考核日志工作统计表");
        //题目
        $objPHPExcel->getProperties()->setSubject("考核日志工作统计表");
        //描述
        $objPHPExcel->getProperties()->setDescription("考核日志工作统计表");
        //关键字
        $objPHPExcel->getProperties()->setKeywords("考核日志工作统计表");
        //种类
        $objPHPExcel->getProperties()->setCategory("报表汇总");
        //设置当前的sheet
        $objPHPExcel->setActiveSheetIndex(0);
        //设置sheet的name
        $objPHPExcel->getActiveSheet()->setTitle('考核日志工作统计表');
        //所有表格居中
        $objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $type = $this -> input -> get('type',TRUE);   //默认的日志类型
        $time = $this -> input -> get('time',TRUE);   //查询的时间
        $mjbm = $this -> input -> get('mjbm',TRUE);   //民警编号
        $bmdm = $this -> input -> get('bmdm',TRUE);   //部门代码
        if($time == ''){
            $time = date('Y-m');
        }
        $time_str = explode('-',$time);
        $num = cal_days_in_month(CAL_GREGORIAN,$time_str[1],$time_str[0]);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', "警员");
        $Number = array(
            '1' => 'B',
            '2' => 'C',
            '3' => 'D',
            '4' => 'E',
            '5' => 'F',
            '6' => 'G',
            '7' => 'H',
            '8' => 'I',
            '9' => 'J',
            '10' => 'K',
            '11' => 'L',
            '12' => 'M',
            '13' => 'N',
            '14' => 'O',
            '15' => 'P',
            '16' => 'Q',
            '17' => 'R',
            '18' => 'S',
            '19' => 'T',
            '20' => 'U',
            '21' => 'V',
            '22' => 'W',
            '23' => 'X',
            '24' => 'Y',
            '25' => 'Z',
            '26' => 'AA',
            '27' => 'AB',
            '28' => 'AC',
            '29' => 'AD',
            '30' => 'AE',
            '31' => 'AF',
        );

        $i = 1;
        foreach ($Number as $k => $v){
            $objPHPExcel->getActiveSheet()->setCellValue( $v.'1',$k.'号');
            if($i == $num) break;
             $i++;
        }

        if($num == 28){
            $objPHPExcel->getActiveSheet()->setCellValue('AD1', "出勤数");
            $objPHPExcel->getActiveSheet()->setCellValue('AE1', "未出勤数");
            $objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(15);
            $s = 'AE';
        }else if($num == 29){
            $objPHPExcel->getActiveSheet()->setCellValue('AE1', "出勤数");
            $objPHPExcel->getActiveSheet()->setCellValue('AF1', "未出勤数");
            $objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(15);
            $s = 'AF';
        }else if($num == 30){
            $objPHPExcel->getActiveSheet()->setCellValue('AF1', "出勤数");
            $objPHPExcel->getActiveSheet()->setCellValue('AG1', "未出勤数");
            $objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(15);
            $s = 'AG';
        }else if($num == 31){
            $objPHPExcel->getActiveSheet()->setCellValue('AG1', "出勤数");
            $objPHPExcel->getActiveSheet()->setCellValue('AH1', "未出勤数");
            $objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(15);
            $s = 'AH';
        }
        //表头添加样式
        $objPHPExcel->getActiveSheet()->getStyle( 'A1:'.$s.'1')->applyFromArray(
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

        $data = $this -> m_work_logtj -> select_type($type,$time,$mjbm,$bmdm);

        for($i=0;$i<count($data);$i++){
            $num = $i+2;
            $objPHPExcel->getActiveSheet()->getRowDimension($num)->setRowHeight(30);
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$num, $data[$i]['name']);

            $mm = 1;
            foreach ($Number as $k2 => $v2){
                if($data[$i]['kaoqin'][$k2-1][$k2] == '正常上班'){
                    $objPHPExcel->getActiveSheet()->setCellValue($v2.$num, $data[$i]['kaoqin'][$k2-1][$k2]);
                }else{
                    $objPHPExcel->getActiveSheet()->getStyle($v2.$num)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                    $objPHPExcel->getActiveSheet() -> getStyle($v2.$num)-> getFont()-> getColor() -> setRGB('DC143C');
                    $objPHPExcel->getActiveSheet()->setCellValue($v2.$num, $data[$i]['kaoqin'][$k2-1][$k2]);
                }

                if($mm == count($data[$i]['kaoqin'])) break;
                $mm++;
            }

            if($mm == 28){
                $objPHPExcel->getActiveSheet()->setCellValue('AD'.$num, $data[$i]['chuqin']);
                $objPHPExcel->getActiveSheet()->setCellValue('AE'.$num, $data[$i]['weiqin']);
            }else if($mm == 29){
                $objPHPExcel->getActiveSheet()->setCellValue('AE'.$num, $data[$i]['chuqin']);
                $objPHPExcel->getActiveSheet()->setCellValue('AF'.$num, $data[$i]['weiqin']);
            }else if($mm == 30){
                $objPHPExcel->getActiveSheet()->setCellValue('AF'.$num, $data[$i]['chuqin']);
                $objPHPExcel->getActiveSheet()->setCellValue('AG'.$num, $data[$i]['weiqin']);
            }else if($mm == 31){
                $objPHPExcel->getActiveSheet()->setCellValue('AG'.$num, $data[$i]['chuqin']);
                $objPHPExcel->getActiveSheet()->setCellValue('AH'.$num, $data[$i]['weiqin']);
            }
        }
        //添加边框
        $objPHPExcel->getActiveSheet()->getStyle( 'A1:'.$s.$num)->applyFromArray(
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
//        $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
        $objWriter->save(ROOT_PATHS."assets/uploads/excel/".$fileNames);
//        ob_clean();
        //下载
        $excelPath = ROOT_PATHS.'assets/uploads/excel/'.$fileNames;
        header( "Content-Disposition:  attachment;  filename=".$fileNames); //告诉浏览器通过附件形式来处理文件
        header('Content-Length: ' . filesize($excelPath)); //下载文件大小
        readfile($excelPath);  //读取文件内容

    }

}



























































