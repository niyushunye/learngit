<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class c_department extends CI_Controller
{
    //路面防控管理部门排行

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        define('ROOT_PATHS', $this->config->item('root_path'));
        $this->load->model('admin/m_department');
        if (session_login()) {
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }
    }

    //统计结果
    public function index()
    {

        //接受参数
        $startime = $data['startTime'] = '';  //开始时间
        $endtime = $data['endTime'] = '';  //结束时间

        //查询出所有的部门
//        $data['data'] = $this -> m_department -> select_org($startime,$endtime);
//        array_multisort(array_column($data['data'],'score'),SORT_DESC,$data['data']);
        $this->load->view('public/header');
        $this->load->view('road/V_department', $data);
    }

    //条件检索
    public function search()
    {
        $startime = $data['startTime'] = strtotime($this->input->post('startTime'));  //开始时间
        $endtime = $data['endTime'] = strtotime($this->input->post('endTime'));  //结束时间
        $data['data'] = $this->m_department->select_org($startime, $endtime);
        array_multisort(array_column($data['data'], 'score'), SORT_DESC, $data['data']);
        $this -> load -> view('public/header');
        $this -> load -> view('road/V_department',$data);
        $result_json = json_encode($data, TRUE);
        echo $result_json;
    }

    //导出xlsx表
    public function export()
    {
        $startime = strtotime($this->input->get('startTime', TRUE));  //开始时间
        $endtime = strtotime($this->input->get('endTime', TRUE));  //结束时间
        $fileName = "路面防控部门得分排名.xlsx";
        $fileNames = iconv('UTF-8', 'GBK', $fileName);
        include ROOT_PATHS . 'classes/PHPExcel.php';
        include ROOT_PATHS . 'classes/PHPExcel/Writer/Excel2007.php';

        $objPHPExcel = new PHPExcel();

        //设置excel的属性：
        //创建人
        $objPHPExcel->getProperties()->setCreator("admin");
        //最后修改人
        $objPHPExcel->getProperties()->setLastModifiedBy("admin");
        //标题
        $objPHPExcel->getProperties()->setTitle("路面防控部门得分排名");
        //题目
        $objPHPExcel->getProperties()->setSubject("路面防控部门得分排名");
        //描述
        $objPHPExcel->getProperties()->setDescription("路面防控部门得分排名");
        //关键字
        $objPHPExcel->getProperties()->setKeywords("路面防控部门得分排名");
        //种类
        $objPHPExcel->getProperties()->setCategory("路面防控部门得分排名");

        //设置当前的sheet
        $objPHPExcel->setActiveSheetIndex(0);
        //设置sheet的name
        $objPHPExcel->getActiveSheet()->setTitle('路面防控部门得分排名');

        //所有表格居中
        $objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(25);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:A3');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', "部门名称");
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(35);
        $objPHPExcel->getActiveSheet()->mergeCells('B1:B3');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', '部门代码');
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->mergeCells('C1:C3');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', '纠违合计');

        $objPHPExcel->getActiveSheet()->mergeCells('D1:E1');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', '非现场执法');
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);

        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $objPHPExcel->getActiveSheet()->setCellValue('F1', '现场执法');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', '强制措施');

        $objPHPExcel->getActiveSheet()->mergeCells('H1:H3');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', '得分');
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);

        $objPHPExcel->getActiveSheet()->mergeCells('I1:I3');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', '排名');

        $objPHPExcel->getActiveSheet()->mergeCells('D2:D3');
        $objPHPExcel->getActiveSheet()->setCellValue('D2', '纠违总数');
        $objPHPExcel->getActiveSheet()->mergeCells('E2:E3');
        $objPHPExcel->getActiveSheet()->setCellValue('E2', '违停数量');

        $objPHPExcel->getActiveSheet()->setCellValue('F2', '简易程序');
        $objPHPExcel->getActiveSheet()->setCellValue('F3', '总量');

        $objPHPExcel->getActiveSheet()->mergeCells('G2:G3');
        $objPHPExcel->getActiveSheet()->setCellValue('G2', '总量');

        $objPHPExcel->getActiveSheet()->getStyle('A1:I3')->applyFromArray(
            array(
                'font' => array(
                    'bold' => true,
                    'size' => 14
                )
            )
        );
        $result_array = $this->m_department->select_org($startime, $endtime);

        array_multisort(array_column($result_array, 'score'), SORT_DESC, $result_array);


        for ($i = 0; $i < count($result_array); $i++) {
            $num = $i + 4;
            $num1 = $i + 1;
            //行政区划名称
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $num, $result_array[$i]['orgname']);
            //乡镇村数量
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $num, $result_array[$i]['orgnum']);
            //两轮摩托车
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $num, $result_array[$i]['combined']);
            //其它
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $num, $result_array[$i]['enforcement']);
            //黄牌货车
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $num, $result_array[$i]['stop_number']);
            //蓝牌货车
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $num, $result_array[$i]['total_enforcement']);
            //三轮货车
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $num, $result_array[$i]['measures']);
            //小客车（轿车）
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $num, $result_array[$i]['score']);

            //面包车
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $num, $num1);
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        //或者$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); 非2007格式
        $objWriter->save(ROOT_PATHS . "assets/uploads/excel/" . $fileNames);


        //下载
        $excelPath = ROOT_PATHS . 'assets/uploads/excel/' . $fileNames;
        header("Content-Disposition:  attachment;  filename=" . $fileNames); //告诉浏览器通过附件形式来处理文件
        header('Content-Length: ' . filesize($excelPath)); //下载文件大小
        readfile($excelPath);  //读取文件内容
    }
}