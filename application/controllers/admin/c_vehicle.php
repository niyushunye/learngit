<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class c_vehicle extends CI_Controller{




//    机动车辆

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/M_vehicle');
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
            'url' => base_url().'admin/c_vehicle/filelist/'.$data['quhua'][0]['number'],
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
                    'url' => base_url().'admin/c_vehicle/filelist/'.$value1['number'],
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
            $this->load->view("vehicle/V_index_vehicle",$data);
        }
//        print_r($data);exit();
    }

    public function filelist($orgnum){
        $db_mysql = $this->load->database('default',TRUE);
        $data['orgnum'] = $orgnum;
        $data['clsyr'] = "";
        $data['sfzh'] = "";

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
            $config['first_url'] =  base_url() . '/admin/c_vehicle/filelist/0/'."/"."$orgnum";
        }
        $orgnums = $this -> M_vehicle -> orgnums($orgnum);
        foreach ($orgnums as $k => $v){
           foreach ($v as $k1 => $v1){
               $orgnumss[] = $v1;
           }
        }
        $data['memberinfo'] = $this -> M_vehicle -> select_vehicle($orgnumss,$curpage,$num);
        $data['total'] = $this -> M_vehicle -> select_vehicle_count($orgnumss,$curpage,$num);
        $config['per_page'] = $num;
        $config['base_url'] = base_url().'/admin/c_vehicle/filelist/';
        $config['suffix'] = "/"."$orgnum" ;                                                      //给链接地址加后缀  http://localhost/ci/控制器/方法名/参数
        $config['total_rows'] = $data['total'];
        $this->pagination->initialize($config);
        $this->load->view('public/header');
        $this->load->view("vehicle/V_jdc_filelist",$data);
    }

    //查看详情
    public function details(){
        $id = $this -> input -> get('id',TRUE);

        $data = $this -> M_vehicle -> select_details($id);
        $this->load->view('public/header');
        $this -> load -> view('vehicle/V_index_details',$data);
    }



    //删除
    public function delete(){
        $id = $this -> input -> post('id',TRUE);

        $info = $this -> M_vehicle -> delete_select($id);

        if($info){
            echo 1;   //删除成功
        }else{
            echo 2;    //删除失败
        }

    }

    //编辑数据页面
    public function edit(){
        $id = $this -> input -> get('id',TRUE);
        $data = $this -> M_vehicle -> select_details($id);
        $this->load->view('public/header');
        $this -> load -> view('vehicle/V_index_edit',$data);
    }


    //编辑更新数据
    public function edit_up(){
        $id = $this -> input -> post('id',TRUE);
        $data['jyyxqz'] = $this -> input -> post('jyyxqz',TRUE);
        $data['qzbfqz'] = $this -> input -> post('qzbfqz',TRUE);
        $data['clsyr'] = $this -> input -> post('clsyr',TRUE);
        $data['sjhm'] = $this -> input -> post('sjhm',TRUE);
        $data['sfzh'] = $this -> input -> post('sfzh',TRUE);
        $data['lxzz'] = $this -> input -> post('lxzz',TRUE);
        $data['yzbm'] = $this -> input -> post('yzbm',TRUE);

        $res = $this -> M_vehicle -> select_upload($id,$data);
        if($res){
            echo 1;  //修改成功
        }else{
            echo 2;   //修改失败
        }
    }


    //带条件查询
    public function suosou(){
        $clsyr = $this -> input -> post('clsyr',TRUE);   //车辆所有人
        $sfzh = $this -> input -> post('sfzh',TRUE);                 //身份证号
        $xzqh = $this -> input -> post('xzqh',TRUE);        //行政区划
        $data['memberinfo'] = $this-> M_vehicle -> where_select_sousuo($clsyr,$sfzh,$xzqh);
        $data['total'] = $this -> M_vehicle -> where_select_count($clsyr,$sfzh,$xzqh);
        $data['sfzh'] = $sfzh;
        $data['orgnum'] = $xzqh;
        $data['clsyr'] = $clsyr;
        $this->load->view('public/header');
        $this->load->view("vehicle/v_jdc_filelist",$data);
    }

    //导出表
    public function export(){
        $fileName = "机动车成统计表.xlsx";
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
        $objPHPExcel->getProperties()->setTitle("机动车成统计表");
        //题目
        $objPHPExcel->getProperties()->setSubject("机动车成统计表");
        //描述
        $objPHPExcel->getProperties()->setDescription("机动车成统计表");
        //关键字
        $objPHPExcel->getProperties()->setKeywords("机动车成统计表");
        //种类
        $objPHPExcel->getProperties()->setCategory("报表汇总");

        //设置当前的sheet
        $objPHPExcel->setActiveSheetIndex(0);
        //设置sheet的name
        $objPHPExcel->getActiveSheet()->setTitle('月车管考核排名总表');

        //所有表格居中
        $objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $objPHPExcel->getActiveSheet()->getStyle( 'A1:N1')->applyFromArray(
            array(
                'font'    => array (
                    'bold'      => true,
                    'size' => 18
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle( 'A2:N2')->applyFromArray(
            array(
                'font'    => array (
                    'bold'      => true
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension('')->setRowHeight(35);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:N1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', '汉滨区机动车统计表');
        $objPHPExcel->getActiveSheet()->getStyle('N1')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->setCellValue('A2', "行政区划");
        $objPHPExcel->getActiveSheet()->setCellValue('B2', "乡镇数量");
        $objPHPExcel->getActiveSheet()->setCellValue('C2', "两轮摩托车");
        $objPHPExcel->getActiveSheet()->setCellValue('D2', "其他");
        $objPHPExcel->getActiveSheet()->setCellValue('E2', "黄牌货车");
        $objPHPExcel->getActiveSheet()->setCellValue('F2', "蓝牌货车");
        $objPHPExcel->getActiveSheet()->setCellValue('G2', "三轮货车");
        $objPHPExcel->getActiveSheet()->setCellValue('H2', "小客车（轿车）");
        $objPHPExcel->getActiveSheet()->setCellValue('I2', "面包车");
        $objPHPExcel->getActiveSheet()->setCellValue('J2', "校车");
        $objPHPExcel->getActiveSheet()->setCellValue('K2', "运营车辆");
        $objPHPExcel->getActiveSheet()->setCellValue('L2', "危化品运输车");
        $objPHPExcel->getActiveSheet()->setCellValue('M2', "拖拉机");
        $objPHPExcel->getActiveSheet()->setCellValue('N2', "总数");


        //获取数据
        $result_array = $this -> M_vehicle -> select_tj();

       for($i =0;$i < count($result_array);$i++ ){
           $num = $i + 3;

           //行政区划名称
           $objPHPExcel->getActiveSheet()->setCellValue('A'.$num, $result_array[$i]['name']);
           //乡镇村数量
           $objPHPExcel->getActiveSheet()->setCellValue('B'.$num, $result_array[$i]['count']);
            //两轮摩托车
           $objPHPExcel->getActiveSheet()->setCellValue('C'.$num, $result_array[$i]['cllx']['0']['DMSM1']);
            //其它
           $objPHPExcel->getActiveSheet()->setCellValue('D'.$num, $result_array[$i]['cllx']['1']['DMSM1']);
            //黄牌货车
           $objPHPExcel->getActiveSheet()->setCellValue('E'.$num, $result_array[$i]['cllx']['2']['DMSM1']);
           //蓝牌货车
           $objPHPExcel->getActiveSheet()->setCellValue('F'.$num, $result_array[$i]['cllx']['3']['DMSM1']);
           //三轮货车
           $objPHPExcel->getActiveSheet()->setCellValue('G'.$num, $result_array[$i]['cllx']['4']['DMSM1']);
           //小客车（轿车）
           $objPHPExcel->getActiveSheet()->setCellValue('H'.$num, $result_array[$i]['cllx']['5']['DMSM1']);
           //面包车
           $objPHPExcel->getActiveSheet()->setCellValue('I'.$num, $result_array[$i]['cllx']['6']['DMSM1']);
           //校车
           $objPHPExcel->getActiveSheet()->setCellValue('J'.$num, $result_array[$i]['cllx']['7']['DMSM1']);
           //运营车辆
           $objPHPExcel->getActiveSheet()->setCellValue('K'.$num, $result_array[$i]['cllx']['8']['DMSM1']);
           //危化品运输车
           $objPHPExcel->getActiveSheet()->setCellValue('L'.$num, $result_array[$i]['cllx']['9']['DMSM1']);
           //拖拉机（农用车）
           $objPHPExcel->getActiveSheet()->setCellValue('M'.$num, $result_array[$i]['cllx']['10']['DMSM1']);
           //总数（所有的综合）
           $objPHPExcel->getActiveSheet()->setCellValue('N'.$num, $result_array[$i]['zs']);
       }

        //添加边框
//        $objPHPExcel->getActiveSheet()->getStyle( 'A1:N7')->applyFromArray(
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