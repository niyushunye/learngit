<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
                
              |--|        |--|
            --|  |--------|  |--|
            |        --         |
            |    ==|    |==     |
            |         |         |
            |         =         |
            |-----|        |----|
                  |        |
                  |        |     神兽代码永无BUG
                  |        |
                  |        |------------|
                  |                     |
                  |                     |--|
                  |                     |--|--|--|
                  |                     |--|
                  |----|----|----|---|--|
                        |  | |    |   |
                        |--|-|    |-|-|
                    
 */


class c_comprehensive extends CI_Controller {

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();

        //因为需要在页面上显示 echo base_url(); 所以需要加上这个
        $this->load->helper('url');

        $this->load->model('admin/m_integrated_service');

        //获取文件根目录路径 
        define('ROOT_PATHS', $this->config->item('root_path')); 

    }

    public function index(){

        //接受参数
        $score_month= $this -> input -> post('score_month',TRUE);

        //判断数据库有无当前月份
        $ins = $this ->  m_integrated_service -> select_ins();
        if(!in_array( date('Y-m'),$ins)){
            $score['score_1'] = 5;
            $score['score_2'] = 10;
            $score['score_3'] = 15;
            $score['score_4'] = 5;
            $score['score_5'] = 15;
            $score['score_6'] = 25;
            $score['score_7'] = 10;
            $score['score_8'] = 10;
            $score['score_9'] = 5;
            $score['score_10'] = 0;
            $score['score_month'] = date('Y-m');        //生成当前月份
            $score['dateline'] = time();
            $this -> m_integrated_service -> add_data($score);
        }
        //获取数据
        if($score_month){
            $res = $this->result_data($score_month);
            $res['score_month'] = $score_month;
        }else{
            $score_month = date('Y-m');
            $res = $this -> result_data($score_month);
            $res['score_month'] = $score_month;
        }

        $this->load->view('public/header');
        $this->load->view('comprehensive/Index',$res);
    }

    public function data($score,$value,$score_month){
        $score_data = $this->db->select("$score")
                            ->get_where('integrated_service',array('score_company'=>$value,'score_month'=>$score_month))
                            ->row_array();
        if($score_data){
          $data = $score_data;
        }else{
          $data = array($score=>0);
        }

        return $data;
    }

    public function sum($value,$score_month){
        $data_sum = $this->db->select("score_1,score_2,score_3,score_4,score_5,score_6,score_7,score_8,score_9,score_10")
                            ->get_where('integrated_service',array('score_company'=>$value,'score_month'=>$score_month))
                            ->row_array();
        if($data_sum){
            $num = $data_sum['score_1']+$data_sum['score_2']+$data_sum['score_3']+$data_sum['score_4']+$data_sum['score_5']+$data_sum['score_6']+$data_sum['score_7']+$data_sum['score_8']+$data_sum['score_9']+$data_sum['score_10'];
        }else{
            $num = 0;
        }

        return $num;
    }

    //获取奖金
    public function bonus($value,$score_month){
        $bonus_arr = $this->db->select("bonus")
                            ->get_where('integrated_service',array('score_company'=>$value,'score_month'=>$score_month))
                            ->row_array();
        if($bonus_arr){
            $bonus = $bonus_arr['bonus'];
        }else{
            $bonus = 0;
        }

        return $bonus;
    }

    //设置奖金
    public function set_bonus(){
        //单位编号
        $score_company = $this->input->post('score_company');
        //奖金数
        $bonus = $this->input->post('bonus');

        $this->db->update('integrated_service',array('bonus'=>$bonus),array('score_company'=>$score_company,'score_month'=>date('Y-m')));
    }

    //设置审核人员
    public function set_hz(){
        //获取汇总人员
        $hz = $this->input->post('hz');
        //获取部门负责人
        $bmfzr = $this->input->post('bmfzr');
        //获取领导审核
        $shld = $this->input->post('shld');

        $score_month = $this -> input -> post('score_month',TRUE);
        $assessor = $this->db->select("id")
                            ->get_where('assessor',array('month'=>$score_month,'type'=>2))
                            ->row_array();
        if(!$assessor){
            if($hz){
                $data = array(
                   'HZ' => $hz,
                   'type' => 2,
                   'month' => $score_month,
                );
                $this->db->insert('assessor',$data);
            }
            if($bmfzr){
                $data = array(
                   'BMFZR' => $bmfzr,
                   'type' => 2,
                   'month' => $score_month,
                );
                $this->db->insert('assessor',$data);
            }
            if($shld){
                $data = array(
                   'SHLD' => $shld,
                   'type' => 2,
                   'month' => $score_month,
                );
                $this->db->insert('assessor',$data);
            }
        }else{
            
            if($hz){
                $this->db->update('assessor',array('HZ'=>$hz),array('id'=>$assessor['id']));
            }

            if($bmfzr){
                $this->db->update('assessor',array('BMFZR'=>$bmfzr),array('id'=>$assessor['id']));


            }

            if($shld){
                $this->db->update('assessor',array('SHLD'=>$shld),array('id'=>$assessor['id']));
            }

        }

    }


     //表导出
    public function export(){
        $fileName = "月政办综合业务考核表.xlsx";
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
        $objPHPExcel->getProperties()->setTitle("月政办综合业务考核表");
        //题目
        $objPHPExcel->getProperties()->setSubject("月政办综合业务考核表");
        //描述
        $objPHPExcel->getProperties()->setDescription("月政办综合业务考核表");
        //关键字
        $objPHPExcel->getProperties()->setKeywords("月政办综合业务考核表");
        //种类
        $objPHPExcel->getProperties()->setCategory("报表汇总");
        //设置当前的sheet
        $objPHPExcel->setActiveSheetIndex(0);
        //设置sheet的name
        $objPHPExcel->getActiveSheet()->setTitle('月政办综合业务考核表');
        //所有表格居中
        $objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
         //表头信息
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(17);
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(80);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', "项目/得分/单位");
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->setCellValue('B1', "党的基层组织建设(5分)");
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->setCellValue('C1', "党风政风行风建设(10分)");
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->setCellValue('D1', "队伍素质能力建设(15分)");
        $objPHPExcel->getActiveSheet()->getStyle('D1')->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(18);
        $objPHPExcel->getActiveSheet()->setCellValue('E1', "典型培树宣传(5分)");
        $objPHPExcel->getActiveSheet()->getStyle('E1')->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->setCellValue('F1', "从优待警政策落实(15分)");
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->setCellValue('G1', "综合文秘(25分)");
        $objPHPExcel->getActiveSheet()->getStyle('G1')->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
        $objPHPExcel->getActiveSheet()->setCellValue('H1', "指挥调度(上传下达)(10分)");
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $objPHPExcel->getActiveSheet()->setCellValue('I1', "材料数据报表上报(10分)");
        $objPHPExcel->getActiveSheet()->getStyle('I1')->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
        $objPHPExcel->getActiveSheet()->setCellValue('J1', "各类创建活动(含“五城联创”任务落实)(5分)");
        $objPHPExcel->getActiveSheet()->getStyle('J1')->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
        $objPHPExcel->getActiveSheet()->setCellValue('K1', "加分项目(10分)");
        $objPHPExcel->getActiveSheet()->getStyle('K1')->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->setCellValue('L1', "总分");
        $objPHPExcel->getActiveSheet()->setCellValue('M1', "排名");
        //表头添加样式
        $objPHPExcel->getActiveSheet()->getStyle( 'A1:M1')->applyFromArray(
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
        //添加边框
        $objPHPExcel->getActiveSheet()->getStyle( 'A1:M10')->applyFromArray(
            array(
                'borders' => array(
                        'allborders' => array( //设置全部边框
                        'style' => \PHPExcel_Style_Border::BORDER_THIN //粗的是thick
                    ),
                ),
            )
        );
        $score_month = $this -> input -> get('score_month',TRUE);
        //获取数据
        $result_data = $this->result_data($score_month);
        for($i=0;$i<count($result_data['arr2']);$i++){
            $num = $i+2;
            //设置行高
            $objPHPExcel->getActiveSheet()->getRowDimension($num)->setRowHeight(30);
            //大队名称
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$num, $result_data['arr2'][$i]);
            //工作信息上传(信息简报、图片、新闻)(按月上传数、采用计算打分30分)
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$num, $result_data['score_1'][$i]['score_1']);
            //调研文章(各科室、中队每月1篇为基础.超过1篇的适当加5分)
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$num, $result_data['score_2'][$i]['score_2']);
            //“双微”平台信息推送(按每月上传数、采用数计算打10分)
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$num, $result_data['score_3'][$i]['score_3']);
            //队伍管理(无违法违纪行为发生10分)
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$num, $result_data['score_4'][$i]['score_4']);
            //开展教育培训活动开展情况(10分)
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$num, $result_data['score_5'][$i]['score_5']);
            //“两学一做”学习教育开展情况(要求有照片、文字资料5分)
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$num, $result_data['score_6'][$i]['score_6']);
            //日常工作(上传下达、信访回复等)(对政办室日常通知事项落实较好、反馈及时,确保政令畅通.10分)
            $objPHPExcel->getActiveSheet()->setCellValue('H'.$num, $result_data['score_7'][$i]['score_7']);
            //宪法宣传活动开展教育情况(5分)
            $objPHPExcel->getActiveSheet()->setCellValue('I'.$num, $result_data['score_8'][$i]['score_8']);
            //“三秦书月”书香警营活动开展情况(5分)
            $objPHPExcel->getActiveSheet()->setCellValue('J'.$num, $result_data['score_9'][$i]['score_9']);
            //开展纪律作风教育整顿活动情况(10分)
            $objPHPExcel->getActiveSheet()->setCellValue('K'.$num, $result_data['score_10'][$i]['score_10']);
            //总分
            $objPHPExcel->getActiveSheet()->setCellValue('L'.$num, $result_data['total'][$i]);
            //排名
            $objPHPExcel->getActiveSheet()->setCellValue('M'.$num, $result_data['sort'][$i]);
        }
        //最后一条
        $n = count($result_data['arr2'])+2;
        //设置行高
        $objPHPExcel->getActiveSheet()->getRowDimension($n)->setRowHeight(30);
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$n.':D'.$n);
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, "汇总: ".$result_data['assessor']['HZ']);
        $objPHPExcel->getActiveSheet()->mergeCells('E'.$n.':G'.$n);
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$n, "部门负责人: ".$result_data['assessor']['BMFZR']);
        $objPHPExcel->getActiveSheet()->mergeCells('H'.$n.':M'.$n);
        $objPHPExcel->getActiveSheet()->setCellValue('H'.$n, "审核领导: ".$result_data['assessor']['SHLD']);
        //表头添加样式
        $objPHPExcel->getActiveSheet()->getStyle( 'A'.$n.':M'.$n)->applyFromArray(
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
    protected function result_data($score_month){
        //数据统计
        $res['arr'] = array(
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
            0 => '江南中队',
            1 => '江北中队',
            2 => '张滩中队',
            3 => '瀛湖中队',
            4 => '巡逻中队',
            5 => '谭坝中队',
            6 => '大河中队',
            7 => '洪山中队',
        );
        //根据每个中队代码,获取每一类的评分
        foreach ($res['arr'] as  $value) {
            //score_1
            $res['score_1'][] = $this->data('score_1',$value,$score_month);
            //score_2
            $res['score_2'][] = $this->data('score_2',$value,$score_month);
            //score_3
            $res['score_3'][] = $this->data('score_3',$value,$score_month);
            //score_4
            $res['score_4'][] = $this->data('score_4',$value,$score_month);
            //score_5
            $res['score_5'][] = $this->data('score_5',$value,$score_month);
            //score_6
            $res['score_6'][] = $this->data('score_6',$value,$score_month);
            //score_7
            $res['score_7'][] = $this->data('score_7',$value,$score_month);
            //score_8
            $res['score_8'][] = $this->data('score_8',$value,$score_month);
            //score_9
            $res['score_9'][] = $this->data('score_9',$value,$score_month);
            //score_10
            $res['score_10'][] = $this->data('score_10',$value,$score_month);
            //评分总数
            $res['total'][] = $this->sum($value,$score_month);
        }
        arsort($res['total']);
        $a=1;
        foreach ( $res['total'] as $key=>$val ) {
            $res['sort'][$key] = $a++;
        }
         //获取审核的人
        $res['assessor'] = $this->db->select("HZ,BMFZR,SHLD")
                            ->get_where('assessor',array('month'=>$score_month,'type'=>2))
                            ->row_array();
        return $res;
    }
}
/* End of file c_main.php */
/* Location: ./application/controllers/c_main.php */