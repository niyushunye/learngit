<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_task_assignment extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('pagination');
        $this->load->model('admin/m_task_assignment');
        if(session_login()){
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }

        //获取文件根目录路径 
        define('ROOT_PATHS', $this->config->item('root_path')); 
    }
    

    public function index()
    {

        //参数传递
        $data['hphm']= '';
        $data['hpzls']= '';
        $data['ywlxs']= '';
        $data['bmdms']= '';

        $data['type'] = 1;



        //分页配置
        $config['uri_segment'] = 4;
        $offect =$this->uri->segment(4);
        // var_dump($offect);
        $config['per_page'] = 15;
        $config['base_url'] = base_url().'/admin/c_task_assignment/index/';
        //查询总条数
        $arr = $this->m_task_assignment->select_numbers_model();
        $data['total'] = $arr[0]['total'];
        //var_dump($data);exit;
        $config['total_rows'] = $data['total'];
        //查询当前已有的所有任务分配
        $data['data'] = $this->m_task_assignment->select_all_task($config['per_page'],$offect);

        foreach ($data['data'] as &$value)
        {
            //号牌种类
            $value['hpzl_fanyi_result'] = $this->haopaizhonglei($value['hpzl']);

        }
        //查询大队下的所有中队
        $orgnum = $_SESSION['orgnum'];
        //下发部门
        $data['bmdm'] = $this->m_task_assignment->select_orgnum_model($orgnum);
        //查询当前所有任务(业务类型)
        $data['ywlx'] = $this->m_task_assignment->search_all_task();
        //查询当前系统下所有的车牌号码种类
        $data['hpzl'] = $this->m_task_assignment->select_frm_class();

        $this->pagination->initialize($config);
        $this->load->view('public/header');
        $this->load->view('task_assignment/Index',$data);
    }


    //新增任务下发
    public function task_add()
    {
        //查询大队下的所有中队
        $orgnum = $_SESSION['orgnum'];
        //下发部门
        $data['data'] = $this->m_task_assignment->select_orgnum_model($orgnum);
        //查询当前所有任务(业务类型)
        $data['datas'] = $this->m_task_assignment->search_all_task();
        //查询当前系统下所有的车牌号码种类
        $data['data1'] = $this->m_task_assignment->select_frm_class();

        $this->load->view('public/header');
        $this->load->view('task_assignment/V_task_add',$data);
    }
    //上传图片(多文件上传)
    public function imageupload() 
    {
        header('Content-type:multipart/form-data;charset=utf-8');
        if($_FILES)
        {
            $car_files = $_FILES;
            //var_dump($car_files); exit;
            $file_size = $car_files['car_image']['size'];              //文件大小(数组)
            $file_name = $car_files['car_image']['name'];     //文件新名称
            $file_type = $car_files['car_image']['type'];              //文件的类型
            //echo $file_type;
            $file_tmp_name = $car_files['car_image']['tmp_name'];      //上传文件的临时路径
            //var_dump($file_tmp_name); exit;
            //保存图片
            $allow_file_type = array('image/jpeg', 'image/jpg', 'image/png');  //允许上传的类型
            $str = "";
            //echo $str;exit;
            //var_dump(coun);
            for($i=0;$i<count($file_size);$i++)
            {
                if($file_size[$i] < 2*1024*1024)
                {
                    if(in_array($file_type[$i], $allow_file_type))
                    {
                        $file_name_arr = explode(".",$file_name[$i]);
                        $ext = end($file_name_arr);

                        $new_name = date("Ymds").rand(10000,99999).'.'.$ext;


                        $str = $new_name."+".$str;
                        move_uploaded_file($file_tmp_name[$i], './assets/uploads/assign_car_image/' . iconv('UTF-8', 'UTF-8', $new_name));
                    }else
                    {
                        echo '1';   //上传的图片不是允许类型
                        break;      //跳出循环
                    }
                }else
                {
                    echo "2";       //上传的图片超出大小限制
                    break;          //跳出循环
                }
            }
            echo $str;
        }
    } 
    // 保存
    public function task_save()
    {

            $data['hphm'] = $this->input->post('hphm');     //号牌号码
            $data['hpzl'] = $this->input->post('hpzl');     //号牌种类
            $data['ywlx'] = $this->input->post('ywlx');     //业务类型
            $data['month'] = date('m');                     //月份
            $data['cltp'] = rtrim($this->input->post('strs'),'+');     //车辆图片
            $data['dateline'] = time();                     //生成任务的时间戳


            $str = $this->input->post('str');               //选中的部门
            $arr = explode('+',$str);
            $data['bmdm'] = $arr[0];
            $data['bmmc'] = $arr[1];
            //var_dump($data);exit;
            $res = $this->m_task_assignment->task_save_model($data);
            if($res)
            {
                echo '1';
            }else{
                echo '0';
            }

    }

    //编辑(打开编辑页面)
    public function task_edit($id)
    {
        //查询大队下的所有中队
        $orgnum = $_SESSION['orgnum'];
        //$orgnum = '610857000010';
        $data['data'] = $this->m_task_assignment->select_orgnum_model($orgnum);
        //查询当前所有任务(业务类型)
        $data['datas'] = $this->m_task_assignment->search_all_task();
        //查询当前系统下所有的车牌号码种类
        $data['data1'] = $this->m_task_assignment->select_frm_class();
        $data['data2'] = $this->m_task_assignment->select_single_task($id);


        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // die;




        $this->load->view('public/header');
        $this->load->view('task_assignment/v_task_edit',$data);
    }
    //编辑(处理)
    public function task_edit_pro()
    {

        $id = $this->input->post('id');
        $data['hphm'] = $this->input->post('hphm');     //号牌号码
        $data['hpzl'] = $this->input->post('hpzl');     //号牌种类
        $data['ywlx'] = $this->input->post('ywlx');     //业务类型
        $data['cltp'] = rtrim($this->input->post('strs'),"+");     //车辆图片

        $str = $this->input->post('str');               //选中的部门
        $arr = explode('+',$str);
        $data['bmdm'] = $arr[0];
        $data['bmmc'] = $arr[1];

        $res = $this->m_task_assignment->task_update_model($id,$data);
        if($res){
            echo '1';
        }else{
            echo '0';
        }

    }
    //删除
    public function delete()
    {    

        if(isset($_POST['tid']))
        {
            $tid = $this->input->post('tid');


            //获取号牌号码
            $hphm = $this->input->post('hphm');
            //获取号牌种类
            $hpzl = $this->input->post('hpzl');
            //获取业务类型
            $ywlx = $this->input->post('ywlx');
            //获取部门名称(其实是部门代码)
            $bmdm = $this->input->post('bmdm');


            $task= $this->m_task_assignment->select_single_task($tid);

            if($task){

                $cltp_string = $task[0]['cltp'];

                $cltp_arr = explode('+',$cltp_string);

                for($i=0; $i < count($cltp_arr); $i++) { 
                    @unlink(ROOT_PATHS.$cltp_arr[$i]);
                }

                $this->m_task_assignment->delete_model($tid);

                //总条数
               $arr = $this->m_task_assignment->select_search_conditions($hphm,$hpzl,$ywlx,$bmdm);

               echo count($arr);


            }else{
                echo '0';
            }


        }
    }


    //列表查询操作
    public function search() 
    {   

        //获取号牌号码
        $data['hphm'] = $this->input->post('hphm');
        //获取号牌种类
        $data['hpzls'] = $this->input->post('hpzl');
        //获取业务类型
        $data['ywlxs'] = $this->input->post('ywlx');
        //下发部门(其实是部门代码)
        $data['bmdms'] = $this->input->post('bmdm');

        $data['type'] = 0;


        //查询总条数
        $arr = $this->m_task_assignment->select_search_conditions($data['hphm'],$data['hpzls'],$data['ywlxs'],$data['bmdms']);

        $data['total'] = count($arr);


        $data['data'] = $this->m_task_assignment->select_search_conditions($data['hphm'],$data['hpzls'],$data['ywlxs'],$data['bmdms']);

        foreach ($data['data'] as &$value)
        {
            //号牌种类
            $value['hpzl_fanyi_result'] = $this->haopaizhonglei($value['hpzl']);

        }

        //查询大队下的所有中队
        $orgnum = $_SESSION['orgnum'];
        //下发部门
        $data['bmdm'] = $this->m_task_assignment->select_orgnum_model($orgnum);
        //查询当前所有任务(业务类型)
        $data['ywlx'] = $this->m_task_assignment->search_all_task();
        //查询当前系统下所有的车牌号码种类
        $data['hpzl'] = $this->m_task_assignment->select_frm_class();

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // die;


        //$this->pagination->initialize($config);
        $this->load->view('public/header');
        $this->load->view('task_assignment/Index',$data);

    }


    //好牌种类
    public function haopaizhonglei($code){
        $file = "haopaizhonglei.txt";
        $msg = file_get_contents($file);
        $results = unserialize($msg);
        // print_r($results);
        if($code == ""){
            $result = "";
        }else{
            $b = array_flip($results[0]);//将数组中值和键进行调换。
            // echo $b;exit();
            $result =  $results[1][$b[$code]];
        }
        return $result;
    }

    //下载部门任务分配导入模板
    public function download(){
        $this->load->helper('download');//加载插件
        $name = 'moban.xlsx';//下载文件的名字
        $data = file_get_contents(base_url().'/assets/download/moban.xlsx');//打开文件读取其中的内容
        force_download($name,$data,false);//下载
    }

    //导入部门任务分配

    /**
     * @throws PHPExcel_Exception
     * @throws PHPExcel_Reader_Exception
     */
    public function daoru(){
        $files = $_FILES['daoru'];

        $file_name = $files['name'];   //上传文件的名称

        $file_type = $files['type'];   //上传文件的类型

        $file_tmp_name = $files['tmp_name'];  //上传文件的临时路径

        $file_size = $files['size'];   //上传文件的大小

        if($file_name != ''){              //判断有无文件上传

            if($file_type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){   //只允许上传xlsx文件
                 $shangchuan = move_uploaded_file($file_tmp_name,'./assets/daoru/'.$file_name);

                if($shangchuan){
                    require_once './classes/PHPExcel.php';

                    require_once './classes/PHPExcel/IOFactory.php';

                    require_once './classes/PHPExcel/Reader/Excel5.php';
                    $objReader = PHPExcel_IOFactory::createReader('excel2007');
                    $excelpath="./assets/daoru/$file_name";
                    $objPHPExcel = $objReader->load($excelpath);

                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();           //取得总行数
                    $highestColumn = $sheet->getHighestColumn(); //取得总列数
                    $highestColumnNum = PHPExcel_Cell::columnIndexFromString($highestColumn);
                    for($i = 2;$i<= $highestRow;$i++ ){
                        $yelx[] = strlen($objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue());
                    }
                    if(in_array('1',$yelx)){
                        unlink($excelpath);      //删除文件
                        echo 5;  //业务类型数据格式不正确
                    }else{
                        for($i = 2;$i<= $highestRow;$i++ ){
                            $data['hphm'] = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();    // 好牌号码
                            $data['hpzl'] = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();    //好牌种类
                            $data['ywlx'] = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();    //业务类型
                            $data['bmmc'] = $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();    //部门名称
                            $data['bmdm'] = $objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();     //部门代码
                            $data['month'] = $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();     //任务执行月份
                            $data['dateline'] = $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();   //任务下发时间
                            $data['dateline1'] =time();             //任务分配时间
                            $data['is_complete'] = 0;                //是否代表未完成  1代表完成  0代表为完成
                            $res = $this -> m_task_assignment -> select_result_array($data);
                        }
                        unlink($excelpath);      //删除文件
                        echo 1;   //导入成功
                    }
                }else{
                    echo 2;         //上传文件失败
                }
            }else{
               echo 3;      //文件类型错误
            }
        }else{
           echo 4;    //请选择文件
        }
    }
}

