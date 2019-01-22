<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class c_driver extends CI_Controller{




//    驾驶员信息

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/m_driver');
        $this -> load -> model('admin/M_xingzheng');
        $this->load->library('pagination');
        define('ROOT_PATHS', $this->config->item('root_path'));
        if(session_login()){
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }

    }

    public function index(){

        $data['quhua'] = $this->M_xingzheng->get_qhname();

        //print_r($data['quhua']);die();
        $data['glbm'] = $this->M_xingzheng->get_spuer();
        //print_r($data['glbm']);
        // exit();
        $arr = array(
            'id' => $data['quhua'][0]['number'],
            'pId' => 0,
            'name' => $data['quhua'][0]['name'],
//                'isParent' => true
            //点击时指向读取功能
            'url' => base_url().'admin/c_driver/filelist/'.$data['quhua'][0]['number'],
            'target' => "iframe1",
            "open" =>"true"
        );
        $data['result'][] = $arr;

        foreach($data['glbm'] as $value)
        {
            $orgnum = $value['number'];
            $data['zbm'] = $this->M_xingzheng->get_super1($orgnum);
            foreach($data['zbm'] as $value1){
                $arr1 = array(
                    'id' => $value1['number'],
                    'pId' => $value['number'],
                    'name' => $value1['name'],
//                    'isParent' => true
                    //点击时指向读取功能
                    'url' => base_url().'admin/c_driver/filelist/'.$value1['number'],
                    'target' => "iframe1"
                );
                $data['result'][] = $arr1;
            }
        }
        //如果没有下属部门则读取文件夹
        if(empty($data['glbm'])){
//            echo '没有下属了';
//            echo $orgnum;
            $this->filelist(XINGZQH);
        }else{
            $this->load->view("driver/V_index_driver",$data);
        }
//        print_r($data);exit();
    }


    public function filelist($orgnum){
        $db_mysql = $this->load->database('default',TRUE);
        $data['orgnum'] = $orgnum;
        $data['sfzh'] = "";
        $data['xm'] = "";

//        echo $orgnum;
        //第一次程序运行时候，orgnum为对应的部门代码；第二次运行，orgnum输出为页码。
        if($orgnum > 1000){
            $sql_getOrgname = $db_mysql->query("SELECT * FROM `bas_xzqh` WHERE `number` = '{$orgnum}'");
            $data['orgname'] = $sql_getOrgname->result_array();
            $orgnum = $data['orgname'][0]['number'];

            $curpage = CURPAGE;
            $num = BIG_NUM;
            $config['uri_segment'] = 3;
        } else{
            $orgnum = $this->uri->segment(5);
            $curpage = $this->uri->segment(4,0);
            $num = BIG_NUM;
            $config['uri_segment'] = 4;
            $config['first_url'] =  base_url() . '/admin/c_driver/filelist/0/'."/"."$orgnum";
        }
        $orgnums = $this -> m_driver -> orgnums($orgnum);
        foreach ($orgnums as $k => $v){
            foreach ($v as $k1 => $v1){
                $orgnumss[] = $v1;
            }
        }
        $data['memberinfo'] = $this -> m_driver -> select_vehicle($orgnumss,$curpage,$num);
        $data['total'] = $this -> m_driver -> select_vehicle_count($orgnumss,$curpage,$num);

        $config['per_page'] = $num;
        $config['base_url'] = base_url().'/admin/c_driver/filelist/';
        $config['suffix'] = "/"."$orgnum" ;                                                      //给链接地址加后缀  http://localhost/ci/控制器/方法名/参数
        $config['total_rows'] = $data['total'];
        $this->pagination->initialize($config);
        $this->load->view('public/header');
        $this->load->view("driver/V_index_filelist",$data);
    }

    //查看详情
    public function details(){
        $id = $this -> input -> get('id',TRUE);
        $data = $this -> m_driver -> select_details($id);
        $this->load->view('public/header');
        $this -> load -> view('driver/V_index_details',$data);
    }

    //删除数据
    public function delete(){
        $id = $this -> input -> post('id',TRUE);
        $info = $this -> m_driver -> select_delete($id);

        if($info){
            echo 1;    //删除成功
        }else{
            echo 2;    //删除失败
        }
    }


    //编辑数据页面
    public function edit(){
        $id = $this -> input -> get('id',TRUE);
        $data = $this ->  m_driver -> select_details($id);

        $this->load->view('public/header');
        $this -> load -> view('driver/V_index_edit',$data);
    }


    //更新编辑
    public function edit_up(){
        $id = $this -> input -> post('id',TRUE);
        $data['xm'] = $this -> input -> post('xm',TRUE);
        $data['xb'] = $this -> input -> post('sex',TRUE);
        $data['sjhm'] = $this -> input -> post('sjhm',TRUE);
        $data['lxdh'] = $this -> input -> post('lxdh',TRUE);
        $data['gzdw'] = $this -> input -> post('gzdw',TRUE);
        $data['cyzgzh'] = $this -> input -> post('cyzgzh',TRUE);
        $data['fzrq'] = $this -> input -> post('fzrq',TRUE);
        $data['gqrq'] = $this -> input -> post('gqrq',TRUE);
        $data['jsz'] = $this -> input -> post('jsz',TRUE);
        $data['zjcx'] = $this -> input -> post('zjcx',TRUE);
        $data['jzqx'] = $this -> input -> post('jzqx',TRUE);
        $data['yxqs'] = $this -> input -> post('yxqs',TRUE);
        $data['yxqz'] = $this -> input -> post('yxqz',TRUE);
        $data['cclzrq'] = $this -> input -> post('cclzrq',TRUE);
        $data['xysyrq'] = $this -> input -> post('xysyrq',TRUE);
        $data['ljjf'] = $this -> input -> post('ljjf',TRUE);
        $data['hjd'] = $this -> input -> post('hjd',TRUE);
        $data['cqgzd'] = $this -> input -> post('cqgzd',TRUE);
        $data['zsdz'] = $this -> input -> post('zsdz',TRUE);

        $res = $this -> m_driver -> select_up($id,$data);
        if($res){
            echo 1;  //修改成功
        }else{
            echo 2;   //修改失败
        }
    }

    //带条件查询
    public function suosou(){
        $sfzh = $this -> input -> post('sfzh',TRUE);   //十六位的身份证号
        $xm = $this -> input -> post('xm',TRUE);        //姓名
        $xzqh = $this -> input -> post('xzqh',TRUE);             //只能在当前选中的行政区划里查找

        $data['memberinfo'] = $this -> m_driver -> where_select_suosou($sfzh,$xm,$xzqh);
        $data['total'] = $this -> m_driver -> where_select_count($sfzh,$xm,$xzqh);
        $data['sfzh'] = $sfzh;
        $data['xm'] = $xm;
        $data['orgnum'] = $xzqh;
        $this->load->view('public/header');
        $this->load->view("driver/V_index_filelist",$data);
    }

    //导出驾驶员信息统计表
    public function export(){
        $fileName = "驾驶员信息统计表.xlsx";
        $fileNames = iconv('UTF-8', 'GBK', $fileName);

        include ROOT_PATHS.'classes/PHPExcel.php';
        include ROOT_PATHS.'classes/PHPExcel/Writer/Excel2007.php';

        $objPHPExcel = new PHPExcel();


        //设置excel的属性：
        //创建人
        $objPHPExcel->getProperties()->setCreator("admin");
        //最后修改人
        $objPHPExcel->getProperties()->setLastModifiedBy("admin");
        //标题
        $objPHPExcel->getProperties()->setTitle("驾驶员信息统计表");
        //题目
        $objPHPExcel->getProperties()->setSubject("驾驶员信息统计表");
        //描述
        $objPHPExcel->getProperties()->setDescription("驾驶员信息统计表");
        //关键字
        $objPHPExcel->getProperties()->setKeywords("驾驶员信息统计表");
        //种类
        $objPHPExcel->getProperties()->setCategory("驾驶员信息报表统计");

        //设置当前的sheet
        $objPHPExcel->setActiveSheetIndex(0);
        //设置sheet的name
        $objPHPExcel->getActiveSheet()->setTitle('驾驶员信息统计');

        //所有表格居中
        $objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $objPHPExcel->getActiveSheet()->getStyle( 'A1:C1')->applyFromArray(
            array(
                'font'    => array (
                    'bold'      => true,
                    'size'     => 18
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle( 'A2:C2')->applyFromArray(
            array(
                'font'    => array (
                    'bold'      => true
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension('')->setRowHeight(35);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', '汉滨区驾驶员信息统计表');
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->setCellValue('A2', "行政区划");
        $objPHPExcel->getActiveSheet()->setCellValue('B2', "乡镇村数量");
        $objPHPExcel->getActiveSheet()->setCellValue('C2', "驾驶员信息数量");

        //获取数据
        $result_data = $this -> m_driver -> xzqh_count();

        for($i = 0; $i<count($result_data);$i++){
            $num = $i+3;

            $objPHPExcel->getActiveSheet()->setCellValue('A'.$num, $result_data[$i]['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$num, $result_data[$i]['count']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$num, $result_data[$i]['wxdl_count']);
        }
//        $objPHPExcel->getActiveSheet()->getStyle( 'A1:C7')->applyFromArray(
//            array(
//                'borders' => array(
//                    'allborders' => array( //设置全部边框
//                        'style' => \PHPExcel_Style_Border::BORDER_THIN //粗的是thick
//                    ),
//                ),
//            )
//        );

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        //或者$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); 非2007格式
        $objWriter->save(ROOT_PATHS."assets/uploads/excel/".$fileNames);
        //下载
        $excelPath = ROOT_PATHS.'assets/uploads/excel/'.$fileNames;
        header( "Content-Disposition:  attachment;  filename=".$fileNames); //告诉浏览器通过附件形式来处理文件
        header('Content-Length: ' . filesize($excelPath)); //下载文件大小
        readfile($excelPath);  //读取文件内容
    }

}