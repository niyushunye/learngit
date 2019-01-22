<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_inbound_management extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('pagination');
        $this->load->model('admin/m_task_devide');
        $this->load->model('admin/m_task_assignment');
        $this->load->model('admin/m_inbound_management');
        $this -> load -> model('admin/m_parking');
        if (session_login()) {
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }

         //获取文件根目录路径 
        define('ROOT_PATHS', $this->config->item('root_path')); 
    }

    //主页显示
    public function index()
    {

        //参数传递
        $data['startTime']= ''; //开始时间
        $data['endTime']= '';   //结束时间
        $data['czrs']= '';      //处置民警
        $data['hphms']= '';     //号牌号码
        $data['hpzls']= '';     //号牌种类
        $data['sfzmhms']= '';   //身份证号码
        $data['bmdms']= '';     //部门代码

        $data['type'] = 1;

        //分页配置
        $config['uri_segment'] = 4;
        $offect =$this->uri->segment(4);
        // var_dump($offect);
        $config['per_page'] = 15;
        $config['base_url'] = base_url().'/admin/c_inbound_management/index/';
        //查询总条数
        $arr = $this->m_inbound_management->select_numbers_model();
        $data['total'] = $arr[0]['total'];
        //var_dump($data);exit;
        $config['total_rows'] = $data['total'];
        $data['data'] = $this->m_inbound_management->select_all_inbound( $config['per_page'],$offect);

        if(!$data['data']){
            $data['data'] = $this->m_inbound_management->select_all_inbound();

        }
        foreach ($data['data'] as &$value)
        {
            //号牌种类
            $value['hpzl_fanyi_result'] = $this->haopaizhonglei($value['hpzl']);

        }
        //查询大队下的所有中队
        $orgnum = $_SESSION['orgnum'];
        //部门名称
        $data['bmdm'] = $this->m_inbound_management->select_orgnum_model($orgnum);
        //查询当前系统下所有的车牌号码种类
        $data['hpzl'] = $this->m_inbound_management->select_frm_class();

        //print_r($data);

        $this->pagination->initialize($config);
        $this->load->view('public/header');
        $this->load->view('inbound_management/Index',$data);
    }

    //详情
    public function inbound_view($xh)
    {
        $orgnum = $_SESSION['orgnum'];
        $data['data'] = $res['data'] = $this->m_task_devide->select_member_info($orgnum);
        $data['datas'] = $this->m_inbound_management->select_single_inbound($xh);
        $this->load->view('public/header');
        $this->load->view('inbound_management/inbound_view',$data);
    }

    //新增
    public function inbound_add()
    {
        $orgnum = $_SESSION['orgnum'];    //组织机构编码
        $orgname = $_SESSION['orgname'];  //组织机构名称
        $res['data2'] = array(
            'orgnum'  => $orgnum,
            'orgname' => $orgname
        );
        //当前中队下的所有警员
        $res['data'] = $this->m_task_devide->select_member_info($orgnum);
        //查询当前系统下所有的车牌号码种类
        $res['data1'] = $this->m_task_assignment->select_frm_class();
        //查询停车场的信息详情
        $res['parking'] = $this -> m_parking -> select_mc();
        $this->load->view('public/header');
        $this->load->view('inbound_management/inbound_add',$res);
    }

    //验证号牌号码是否已近入库
    public function check_hphm(){
        $hphm = $this->input->post('hphm');
        $data = $this->db->select('hphm')->get_where('parking_record_in',array('hphm'=>$hphm))->row_array();
        if($data){
            echo 1; //号牌已经入库
        }
    }




    //保存
    public function inbound_save()
    {

            $data['xh'] = $this->getGuid();
            $data['hphm'] = $this->input->post('hphm');        //号牌号码
            $data['hpzl'] = $this->input->post('hmzl');        //号牌种类
            $data['dsr']  = $this->input->post('dsr');         //当事人
            $data['sfzmhm'] = $this->input->post('sfzmhm');      //身份证号
            $data['czsj'] = strtotime($this->input->post('czsj'));        //处置时间
            $data['czjg'] = $this->input->post('czjg');        //处置结果
            $data['tccmc'] = $this->input->post('tccmc');      //停车场名称
            $data['tccdz'] = $this->input->post('tccdz');      //停车场地址
            $data['pic'] = rtrim($this->input->post('strs'),'+');     //查处图片

            $str = $this->input->post('str');                  //处置人
            $arrs = explode('::',$str);
            $data['czr'] = $arrs[1];
            $data['jybh'] = $arrs[0];

            $data['bmdm'] = $this->input->post('orgnum');        //部门代码
            $data['bmmc'] = $this->input->post('orgname');       //部门名称
            $data['sfyj'] = 0;                                   //是否预警
            $data['dateline'] = time();                          //插入时间

            $res = $this->m_inbound_management->save_model($data);
            
            if($res){
                echo '1';
            }else{
                echo '0';
            }
    }
    //上传查处车辆图片
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

                        //$str = time().$file_name[$i]."+".$str;
                        move_uploaded_file($file_tmp_name[$i], './assets/uploads/inbound_car_image/' . iconv('UTF-8', 'UTF-8', $new_name));
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

    //生成不重复的序号
   public  function getGuid()
   {
        $uuid = time().mt_rand(100000,999999).mt_rand(100000,999999);
        return $uuid;
   }
   //编辑(打开的编辑页面)
    public function inbound_edit($xh)
    {
        $orgnum = $_SESSION['orgnum'];
        $data['data'] = $res['data'] = $this->m_task_devide->select_member_info($orgnum);
        $data['datas'] = $this->m_inbound_management->select_single_inbound($xh);
        //查询当前系统下所有的车牌号码种类
        $data['data1'] = $this->m_task_assignment->select_frm_class();
        $data['parking'] = $this -> m_parking -> select_mc();
        $data['parking_dz'] = $this -> m_parking -> parking_select_dizhi($data['datas'][0]['tccmc']);
        $this->load->view('public/header');
        $this->load->view('inbound_management/inbound_edit',$data);
    }
    //编辑(处理)
    public function inbound_edit_pro()
    {

            $xh = $this->input->post('xh');
            $data['hphm'] = $this->input->post('hphm');          //号牌号码
            $data['hpzl'] = $this->input->post('hmzl');          //号牌种类
            $data['dsr']  = $this->input->post('dsr');           //当事人
            $data['sfzmhm'] = $this->input->post('sfzmhm');      //身份证号
            $data['czsj'] = strtotime($this->input->post('czsj'));  //处置时间
            $data['czjg'] = $this->input->post('czjg');          //处置结果
            $data['tccmc'] = $this->input->post('tccmc');        //停车场名称
            $data['tccdz'] = $this->input->post('tccdz');        //停车场地址
            $data['pic'] = rtrim($this->input->post('strs'),'+'); //查处图片

            $str = $this->input->post('str');                  //处置人
            $arrs = explode('::',$str);
            $data['czr'] = $arrs[1];
            $data['jybh'] = $arrs[0];
            $data['bmdm'] = $this->input->post('orgnum');        //部门代码
            $data['bmmc'] = $this->input->post('orgname');       //部门名称

            $res = $this->m_inbound_management->update_model($data,$xh);
            if($res){
                echo '1';
            }else{
                echo '0';
            }
    }
   //删除
    public function delete()
    {
        $xh = $this->input->post('did');

        //获取开始时间
        $startTime = strtotime($this->input->post('startTime'));
        //获取结束时间
        $endTime = strtotime($this->input->post('endTime'));
        //获取号牌号码
        $hphm = $this->input->post('hphm');
        //获取处置民警
        $czr = $this->input->post('czr');
        //获取号牌种类
        $hpzl = $this->input->post('hpzl');
        //获取身份证
        $sfzmhm = $this->input->post('sfzmhm');
        //获取部门名称(其实是部门代码)
        $bmdm = $this->input->post('bmdm');


        //查看当前数据是否存在
        $res = $this->m_inbound_management->select_single_inbound($xh);
        if($res){

            if($res[0]['pic']){
                //获取图片
                $pic_str = $res[0]['pic'];
                $pic_arr = explode('+',$pic_str);

                for($i=0; $i < count($pic_arr); $i++) { 
                    @unlink(ROOT_PATHS.$pic_arr[$i]);
                }
            }

            $this->m_inbound_management->delete_inbound($xh);

            //总条数
            $arr = $this->m_inbound_management->select_search_data($startTime,$endTime,$hphm,$czr,$hpzl,$sfzmhm,$bmdm);

            echo count($arr);
            

        }else{
            echo '0';
        }


    }
    //对于入库超过3个月的车辆进行预警
    public function warning()
    {
        $res = $this->m_inbound_managemant->select_rksj_model();
    }


    //列表查询操作
    public function search()
    {   

        //获取开始时间
        $data['startTime'] = strtotime($this->input->post('startTime'));
        //获取结束时间
        $data['endTime'] = strtotime($this->input->post('endTime'));
        //获取号牌号码
        $data['hphms'] = $this->input->post('hphm');
        //获取处置民警
        $data['czrs'] = $this->input->post('czr');
        //获取号牌种类
        $data['hpzls'] = $this->input->post('hpzl');
        //获取身份证号码
        $data['sfzmhms'] = $this->input->post('sfzmhm');
        //获取部门名称(其实是部门代码)
        $data['bmdms'] = $this->input->post('bmdm');



        //查询总条数
        $arr = $this->m_inbound_management->select_search_data($data['startTime'],$data['endTime'],$data['hphms'],$data['czrs'],$data['hpzls'],$data['sfzmhms'],$data['bmdms']);

        $data['total'] = count($arr);

        $data['data'] = $arr;



        $data['type'] = 0;
        foreach ($data['data'] as &$value)
        {
            //号牌种类
            $value['hpzl_fanyi_result'] = $this->haopaizhonglei($value['hpzl']);

        }
        //查询大队下的所有中队
        $orgnum = $_SESSION['orgnum'];
        //部门名称
        $data['bmdm'] = $this->m_inbound_management->select_orgnum_model($orgnum);
        //查询当前系统下所有的车牌号码种类
        $data['hpzl'] = $this->m_inbound_management->select_frm_class();


        $this->load->view('public/header');
        $this->load->view('inbound_management/Index',$data);

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


}