<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_propaganda extends CI_Controller {

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();

        //因为需要在页面上显示 echo base_url(); 所以需要加上这个
        $this->load->helper('url');

        $this->load->model('admin/m_publicize_work');

        //获取文件根目录路径 
        define('ROOT_PATHS', $this->config->item('root_path')); 
    }

    public function index(){

        //接受参数
        $score_month= $this -> input -> post('score_month',TRUE);

        //获取数据表里面的月份
        $ins = $this ->  m_publicize_work -> select_ins();
        if(!in_array( date('Y-m'),$ins)){   //如果表里的月份和当前月不相等 就更新表里的数据
            $score['score_1'] = 20;                  //默认score_1字段的值
            $score['score_2'] = 10;                   //默认score_2字段的值
            $score['score_3'] = 5;                    //默认score_3字段的值
            $score['score_4'] = 40;                     //默认score_4字段的值
            $score['score_5'] = 20;                     //默认score_5字段的值
            $score['score_6'] = 5;                     //默认score_6 字段的值
            $score['score_month'] = date('Y-m');    //默认年月为当前的年月
            $score['dateline'] = time();                //添加默认的时间戳
            $this -> m_publicize_work -> add_data($score);        //调用M层add_data方法
        }
        //获取数据

        if($score_month){           //判断页面是否有无参数传递
            $res = $this->result_data($score_month);        //如果有参数就使用传递的参数
            $res['score_month'] = $score_month;           //返回页面传递的参数
        }else{
            $score_month = date('Y-m');          //如果没有参数就使用当前日期的年月
            $res = $this->result_data($score_month);
            $res['score_month'] = $score_month;           //并且返回当前的日期的年月
        }

        $this->load->view('public/header');                //加载模板
        $this->load->view('propaganda/Index',$res);          //查出来的数据在模板上输出
    }

    //查询数据库每一条的数据  展示在模板上
    public function data($score,$value,$score_month){

        $score_data = $this->db->select("$score")
                            ->get_where('publicize_work',array('score_company'=>$value,'score_month'=>$score_month))
                            ->row_array();
        if($score_data){
          $data = $score_data;
        }else{
          $data = array($score=>0);
        }

        return $data;
    }

    //计算出总分
    public function sum($value,$score_month){
        $data_sum = $this->db->select("score_1,score_2,score_3,score_4,score_5,score_6,score_7")
                            ->get_where('publicize_work',array('score_company'=>$value,'score_month'=>$score_month))
                            ->row_array();
        if($data_sum){
            $num = $data_sum['score_1']+$data_sum['score_2']+$data_sum['score_3']+$data_sum['score_4']+$data_sum['score_5']+$data_sum['score_6']+$data_sum['score_7'];
        }else{
            $num = 0;
        }
        return $num;
    }

    //设置审核人员
    public function set_hz(){
        //获取汇总人员
        $hz = $this->input->post('hz');
        //获取部门负责人
        $bmfzr = $this->input->post('bmfzr');
        //获取领导审核
        $shld = $this->input->post('shld');
        //接受时间参数
        $score_month = $this -> input -> post('score_month',TRUE);

        $assessor = $this->db->select("id")              //先以时间和类型为条件在数据库里查询有无审核人员
                            ->get_where('assessor',array('month'=>$score_month,'type'=>1))
                            ->row_array();
        if(!$assessor){       //如果没有审核人员  就添加审核人员
            if($hz){             //设置汇总人员
                $data = array(
                   'HZ' => $hz,         //汇总
                   'type' => 1,         //类型
                   'month' => $score_month,      //传递的时间：年月
                );
                $this->db->insert('assessor',$data);    //添加数据库
            }

            if($bmfzr){  //设置部门领导
                $data = array(
                   'BMFZR' => $bmfzr, //部门领导
                   'type' => 1,  //类型
                   'month' => $score_month,       //传递的时间：年月
                );
                $this->db->insert('assessor',$data);    //添加到数据库
            }

            if($shld){      //设置审核领导
                $data = array(
                   'SHLD' => $shld,    //审核领导
                   'type' => 1,          //类型
                   'month' => $score_month,  //传递的时间
                );
                $this->db->insert('assessor',$data);   //添加到数据库
            }
        }else{        //如果查询出审核人员
            if($hz){   //修改数据库的汇总人员
                $this->db->update('assessor',array('HZ'=>$hz),array('id'=>$assessor['id']));
            }

            if($bmfzr){     //修改数据库的部门领导
                $this->db->update('assessor',array('BMFZR'=>$bmfzr),array('id'=>$assessor['id']));
            }

            if($shld){       //修改数据库的审核领导
                $this->db->update('assessor',array('SHLD'=>$shld),array('id'=>$assessor['id']));
            }
        }

    }


    //表导出
    public function export(){

        //接受条件

        $score_month = $this -> input -> get('score_month',TRUE);



        $fileName = "宣传工作月考核排名表.xlsx";
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
        $objPHPExcel->getProperties()->setTitle("宣传工作月考核排名表");
        //题目
        $objPHPExcel->getProperties()->setSubject("宣传工作月考核排名表");
        //描述
        $objPHPExcel->getProperties()->setDescription("宣传工作月考核排名表");
        //关键字
        $objPHPExcel->getProperties()->setKeywords("宣传工作月考核排名表");
        //种类
        $objPHPExcel->getProperties()->setCategory("报表汇总");

        //设置当前的sheet
        $objPHPExcel->setActiveSheetIndex(0);
        //设置sheet的name
        $objPHPExcel->getActiveSheet()->setTitle('宣传工作月考核排名表');

        //所有表格居中
        $objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        //表头信息
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(17);
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(30);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:A2');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', "项目/得分/单位");
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->mergeCells('B1:B2');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', "开展交通安全管理重点工作教育活动(20分)");
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->setWrapText(true);


        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->mergeCells('C1:C2');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', "文明交通示范评选活动(10分)");
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->mergeCells('D1:D2');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', "实施文明交通行动计划(5分)");
        $objPHPExcel->getActiveSheet()->getStyle('D1')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->mergeCells('E1:E2');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', "自媒体宣传(40)");
        $objPHPExcel->getActiveSheet()->getStyle('E1')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->mergeCells('F1:F2');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', "利用社会公共媒体宣传情况(20)");
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $objPHPExcel->getActiveSheet()->mergeCells('G1:G2');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', "典型案例及严重交通违法上报(5)");
        $objPHPExcel->getActiveSheet()->getStyle('G1')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
        $objPHPExcel->getActiveSheet()->mergeCells('H1:H2');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', "加分项目(10分)");
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->mergeCells('I1:I2');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', "总分");

        $objPHPExcel->getActiveSheet()->mergeCells('J1:J2');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', "排名");

//        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(10);
//        $objPHPExcel->getActiveSheet()->mergeCells('P1:P2');
//        $objPHPExcel->getActiveSheet()->setCellValue('P1', "奖励资金(元)");
//        $objPHPExcel->getActiveSheet()->getStyle('P1')->getAlignment()->setWrapText(true);

        //表头添加样式
        $objPHPExcel->getActiveSheet()->getStyle( 'A1:J2')->applyFromArray(
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
        $objPHPExcel->getActiveSheet()->getStyle( 'A1:J11')->applyFromArray(
                array(


                    'borders' => array(
                            'allborders' => array( //设置全部边框
                            'style' => \PHPExcel_Style_Border::BORDER_THIN //粗的是thick
                        ),

                    ),


                )
        );

        //获取数据
        $result_data = $this->result_data($score_month);

        //print_r($result_data);die();

        for($i=0;$i<count($result_data['arr2']);$i++){
            $num = $i+3;
            //大队名称
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$num, $result_data['arr2'][$i]);
            //开展交通安全管理重点工作教育活动(20分)
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$num, $result_data['score_1'][$i]['score_1']);
            //文明交通示范评选活动(10分)
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$num, $result_data['score_2'][$i]['score_2']);
            //实施文明交通行动计划(5分)
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$num, $result_data['score_3'][$i]['score_3']);
            //微博(10分)
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$num, $result_data['score_4'][$i]['score_4']);
            //微信(15分)
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$num, $result_data['score_5'][$i]['score_5']);
            //短信(6分)
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$num, $result_data['score_6'][$i]['score_6']);
            //路况播报(9分)
            $objPHPExcel->getActiveSheet()->setCellValue('H'.$num, $result_data['score_7'][$i]['score_7']);
            //总分
            $objPHPExcel->getActiveSheet()->setCellValue('I'.$num, $result_data['total'][$i]);
            //排名
            $objPHPExcel->getActiveSheet()->setCellValue('J'.$num, $result_data['sort'][$i]);
        }

        //最后一条
        $n = count($result_data['arr2'])+3;
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$n.':C'.$n);
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, "汇总: ".$result_data['assessor']['HZ']);

//        $objPHPExcel->getActiveSheet()->mergeCells('A'.$n.':C'.$n);
//        $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, "部门负责人: ".$result_data['assessor']['BMFZR']);
//
//        $objPHPExcel->getActiveSheet()->mergeCells('A'.$n.':C'.$n);
//        $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, "审核领导: ".$result_data['assessor']['SHLD']);


        $objPHPExcel->getActiveSheet()->mergeCells('D'.$n.':F'.$n);
        $objPHPExcel->getActiveSheet()->setCellValue('D'.$n, "部门负责人: ".$result_data['assessor']['BMFZR']);

        $objPHPExcel->getActiveSheet()->mergeCells('G'.$n.':J'.$n);
        $objPHPExcel->getActiveSheet()->setCellValue('G'.$n, "审核领导: ".$result_data['assessor']['SHLD']);

        //表头添加样式
        $objPHPExcel->getActiveSheet()->getStyle( 'A'.$n.':J'.$n)->applyFromArray(
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


    protected function result_data($score_month){            //数据统计

        //数据统计
        $res['arr'] = array(                                  //所有的中队部门代码值
            0 => '610902015000',         //江南中队
            1 => '610902015100',         //江北中队
            2 => '610902015300',         //张滩中队
            3 => '610902015400',         //瀛湖中队
            4 => '610902010200',         //巡逻中队
            5 => '610902015600',         //谭坝中队
            6 => '610902015500',         //大河中队
            7 => '610902015700',         //洪山中队
        );

        $res['arr2'] = array(                      //所有的部门名称
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
        foreach ($res['arr'] as  $value) {     //循环部门代码值
            //score_1
            $res['score_1'][] = $this->data('score_1',$value,$score_month);            //以部门代码为条件查询数据库数据
            //score_2
            $res['score_2'][] = $this->data('score_2',$value,$score_month);              //以部门代码为条件查询数据库数据
            //score_3
            $res['score_3'][] = $this->data('score_3',$value,$score_month);              //以部门代码为条件查询数据库数据
            //score_4
            $res['score_4'][] = $this->data('score_4',$value,$score_month);              //以部门代码为条件查询数据库数据
            //score_5
            $res['score_5'][] = $this->data('score_5',$value,$score_month);              //以部门代码为条件查询数据库数据
            //score_6
            $res['score_6'][] = $this->data('score_6',$value,$score_month);              //以部门代码为条件查询数据库数据
            //score_7
            $res['score_7'][] = $this->data('score_7',$value,$score_month);              //以部门代码为条件查询数据库数据
            //评分总数
            $res['total'][] = $this->sum($value,$score_month);                                  //计算出总分数
        }
        arsort($res['total']);             //按照查出来的数组进行键值大小进行排列
        $a=1;
        foreach ( $res['total'] as $key=>$val ) {
            $res['sort'][$key] = $a++;
        }
        //获取审核的人
        $res['assessor'] = $this->db->select("HZ,BMFZR,SHLD")                 //以时间和类型为条件在assessor表里查询出汇总人和部门领导以及审核领导
                            ->get_where('assessor',array('month'=>$score_month,'type'=>1))
                            ->row_array();
        return $res;            //输出总结果
     }
}
/* End of file c_main.php */
/* Location: ./application/controllers/c_main.php */