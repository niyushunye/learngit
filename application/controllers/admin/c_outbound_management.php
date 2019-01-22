<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_outbound_management extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('pagination');
        $this->load->model('admin/m_task_devide');
        $this->load->model('admin/m_task_assignment');
        $this->load->model('admin/m_outbound_management');
        $this -> load -> model('admin/m_parking');
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

        $config['per_page'] = 15;
        $config['base_url'] = base_url().'/admin/c_outbound_management/index/';
        //查询总条数
        $arr = $this->m_outbound_management->select_numbers_model();
        $data['total'] = $arr[0]['total'];

        $config['total_rows'] = $data['total'];

        $data['data'] = $this->m_outbound_management->select_all_outbound($config['per_page'],$offect);

        if(!$data['data']){
            $data['data'] = $this->m_outbound_management->select_all_outbound();
        }

        //查询大队下的所有中队
        $orgnum = $_SESSION['orgnum'];
        //部门名称
        $data['bmdm'] = $this->m_outbound_management->select_orgnum_model($orgnum);
        //查询当前系统下所有的车牌号码种类
        $data['hpzl'] = $this->m_outbound_management->select_frm_class();
        foreach ($data['data'] as &$value)
        {
            //号牌种类
            $value['hpzl_fanyi_result'] = $this->haopaizhonglei($value['hpzl']);

        }
        $this->pagination->initialize($config);
        $this->load->view('public/header');
        $this->load->view('outbound_management/Index',$data);
    }
    //新增
    public function outbound_adds()
    {
        $orgnum = $_SESSION['orgnum'];    //组织机构编码
        $orgname = $_SESSION['orgname'];  //组织机构名称
        $data['data2'] = array(
            'orgnum'  => $orgnum,
            'orgname' => $orgname
        );
        //当前中队下的所有警员
        $data['data'] = $this->m_task_devide->select_member_info($orgnum);
        //查询出当前系统的入库车牌号码
        $data['datas'] = $this->m_outbound_management->select_inbound_hphm();
        //查询当前系统下所有的车牌号码种类
        $data['data1'] = $this->m_task_assignment->select_frm_class();

        //查询停车场的信息详情
        $data['parking'] = $this -> m_parking -> select_mc();

        //print_r($data['parking']);

        $this->load->view('public/header');
        $this->load->view('outbound_management/v_outbound_adds',$data);
    }

    //查询停车场地址
    public function sel_rep_info(){
        $id = $this -> input -> post('id',TRUE);
        $data = $this -> m_parking -> parking_select_dizhi($id);

        $res = '';

        foreach ($data as $k => $value){
            $res.= '<option value="'.$value['id'].'">'.$value['parking_dizhi'].'</option>';
        }

        echo $res;
    }

    //新增1
    public function outbound_add()
    {
        $orgnum = $_SESSION['orgnum'];    //组织机构编码
        $orgname = $_SESSION['orgname'];  //组织机构名称
        $res['data2'] = array(
            'orgnum'  => $orgnum,
            'orgname' => $orgname
        );
        //当前中队下的所有警员
        $res['data'] = $this->m_task_devide->select_member_info($orgnum);
        //查询出当前系统的入库车牌号码
        $res['datas'] = $this->m_outbound_management->select_inbound_hphm();
        //查询当前系统下所有的车牌号码种类
        $data['data1'] = $this->m_task_assignment->select_frm_class();
        $this->load->view('public/header');
        $this->load->view('outbound_management/v_outbound_add',$res);
    }
    //详情
    public function outbound_view($xh)
    {
        $orgnum = $_SESSION['orgnum'];    //组织机构编码
        //当前中队下的所有警员
        $data['data'] = $this->m_task_devide->select_member_info($orgnum);
        //查询出当前系统的入库序号
        $data['datas'] = $this->m_outbound_management->select_inbound_hphm();
        //查询出详细信息
        $data['data1'] = $this->m_outbound_management->select_single_outbound($xh);
        $this->load->view('public/header');
        $this->load->view('outbound_management/v_outbound_view',$data);
    }
    //保存
    public function outbound_save()
    {

        //无入库信息时，出库序号由后台自动生成
        $data['xh'] = $this->getGuid();
        $data['hphm'] = $this->input->post('hphm');     //号牌号码
        $data['hpzl'] = $this->input->post('hpzl');     //号牌种类
        $data['dsr'] = $this->input->post('dsr');       //当事人
        $data['sfzmhm'] = $this->input->post('sfzmhm');   //身份证号
        $data['czsj'] = strtotime($this->input->post('czsj'));     //出库时间
        $data['ckyy'] = $this->input->post('ckyy');     //出库原因
        $data['tccmc'] = $this->input->post('tccmc');   //停车场名称
        $data['tccdz'] = $this->input->post('tccdz');   //停车场地址
        $data['bmdm']  = $this->input->post('orgnum');  //部门代码
        $data['bmmc']  = $this->input->post('orgname'); //部门名称
        $str = $this->input->post('str');   //处置民警
        $arr = explode('::',$str);
        $data['czr'] = $arr[1];
        $data['jybh'] = $arr[0];
        $data['sfqzck'] = $this->input->post('sfqzck');
        $data['dateline'] = time();
        
        //新增出库信息前看此车是否已经出过库
        $is_out = $this->db->select('hphm')->get_where('parking_record_out',array('hphm'=>$data['hphm']))->row_array();

        if($is_out){
            echo '0';
        }else{
            $this->m_outbound_management->outbound_save($data);
            echo '1';
        }

    }

    //编辑(打开编辑页面)
    public function outbound_edit($xh)
    {
        $orgnum = $_SESSION['orgnum'];    //组织机构编码
        //当前中队下的所有警员
        $data['data'] = $this->m_task_devide->select_member_info($orgnum);
        //查询出当前系统的入库序号
        //$data['datas'] = $this->m_outbound_management->select_inbound_hphm();
        //查询出详细信息
        $data['data1'] = $this->m_outbound_management->select_single_outbound($xh);
       // print_r($data['data1']);
        //查询停车场的信息详情
        $data['parking'] = $this -> m_parking -> select_mc();
        $data['parking_dz'] = $this -> m_parking -> parking_select_dizhi($data['data1'][0]['tccmc']);
        //print_r($data['parking_dz']);
        $this->load->view('public/header');
        $this->load->view('outbound_management/v_outbound_edit',$data);
    }
    //编辑(处理)
    public function outbound_edit_pro()
    {

            $xh = $this->input->post('xh');
            $data['dsr'] = $this->input->post('dsr');       //当事人
            $data['sfzmhm'] = $this->input->post('sfzmhm');   //身份证号
            $data['czsj'] = strtotime($this->input->post('czsj'));     //处置时间
            $data['ckyy'] = $this->input->post('ckyy');     //出库原因
            $data['tccmc'] = $this->input->post('tccmc');   //停车场名称
            $data['tccdz'] = $this->input->post('tccdz');   //停车场地址
            $data['bmdm']  = $this->input->post('orgnum');  //部门代码
            $data['bmmc']  = $this->input->post('orgname'); //部门名称
            $data['pic']  =  rtrim($this->input->post('strs'),'+'); //车辆图片
            $str = $this->input->post('str');   //处置民警
            $arr = explode('::',$str);
            $data['czr'] = $arr[1];
            $data['jybh'] = $arr[0];
            $data['sfqzck'] = $this->input->post('sfqzck');


            $res = $this->m_outbound_management->update_model($xh,$data);
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
        $res = $this->m_outbound_management->select_single_outbound($xh);

        if($res){

            if($res[0]['pic']){
                //获取图片
                $pic_str = $res[0]['pic'];
                $pic_arr = explode('+',$pic_str);

                for($i=0; $i < count($pic_arr); $i++) { 
                    @unlink(ROOT_PATHS.$pic_arr[$i]);
                }
            }

            $this->m_outbound_management->delete_outbound($xh);

            //总条数
            $arr = $this->m_outbound_management->select_search_data($startTime,$endTime,$hphm,$czr,$hpzl,$sfzmhm,$bmdm);

            echo count($arr);
            

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
                        move_uploaded_file($file_tmp_name[$i], './assets/uploads/outbound_car_image/' . iconv('UTF-8', 'UTF-8', $new_name));
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

    //////////////////查询
    public function search()
    {

        $data['hphm'] = $this->input->post('hphm');             //号牌号码
        $data['hpzl'] = $this->input->post('hpzl');             //号牌种类
        $data['sfzmhm'] = $this->input->post('sfzmhm');             //身份证号
        $data['start_time'] = strtotime($this->input->post('start_time')); //起始时间
        $data['end_time'] = strtotime($this->input->post('end_time'));     //截止时间

        $res['data'] = $this->m_outbound_management->search_model($data);

        //查询当前系统下所有的车牌号码种类
        //$data['data1'] = $this->m_task_assignment->select_frm_class();

        ////处置人员
        //当前中队下的所有警员
        $orgnum = $_SESSION['orgnum'];
        $res['datas'] = $this->m_task_devide->select_member_info($orgnum);

        /*$orgname = $_SESSION['orgname'];  //组织机构名称
        $res['data2'] = array(
            'orgnum'  => $orgnum,
            'orgname' => $orgname
        );
        */
        $this->load->view('public/header');
        $this->load->view('outbound_management/v_outbound_search',$res);

    }


    public function outbound_save1()
    {

            $xh = $this->input->post('xh');
            //根据序号查询详细信息
            $res = $this->m_outbound_management->search_hphm_model($xh);
            $data['xh'] = $res['xh'];
            $data['hphm'] = $res['hphm'];                //号牌号码
            $data['hpzl'] = $res['hpzl'];                //号牌种类
            $data['dsr'] = $res['dsr'];                  //当事人
            $data['sfzmhm'] = $res['sfzmhm'];            //身份证号
            $data['czsj'] = $this->input->post('czsj');  //出库时间
            $data['czjg'] = $this->input->post('czjg');  //出库时间
            $data['ckyy'] = $this->input->post('ckyy');  //出库原因
            $data['tccmc'] = $res['tccmc'];              //停车场名称
            $data['tccdz'] = $res['tccdz'];              //停车场地址
            $data['bmdm']  = $res['bmdm'];               //部门代码
            $data['bmmc']  = $res['bmmc'];               //部门名称

            $data['pic'] = rtrim($this->input->post('strs'),'+');  //处置车辆图片

            $str = $this->input->post('str');            //处置民警
            $arr = explode('::',$str);
            $data['czr'] = $arr[1];
            $data['jybh'] = $arr[0];
            $data['sfqzck'] = $this->input->post('sfqzck');
            $data['dateline'] = time();


            //新增之前，判断此车是否已经出过库
            $res1 = $this->m_outbound_management->search_outbound_hphm($xh);

            if(empty($res1))
            {   

                //添加出库信息
                $this->m_outbound_management->outbound_save($data);

                $this->db->update('parking_record_in',array('is_out'=>1),array('xh'=>$xh));
                echo '1';
            }else{
                echo '0';           //该车已出库
            }
    }

    //列表查询操作
    public function searchs()
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
        $arr = $this->m_outbound_management->select_search_data($data['startTime'],$data['endTime'],$data['hphms'],$data['czrs'],$data['hpzls'],$data['sfzmhms'],$data['bmdms']);

        $data['total'] = count($arr);

        $data['data'] = $arr;



        $data['type'] = 0;

        //查询大队下的所有中队
        $orgnum = $_SESSION['orgnum'];
        //部门名称
        $data['bmdm'] = $this->m_outbound_management->select_orgnum_model($orgnum);
        //查询当前系统下所有的车牌号码种类
        $data['hpzl'] = $this->m_outbound_management->select_frm_class();
        foreach ($data['data'] as &$value)
        {
            //号牌种类
            $value['hpzl_fanyi_result'] = $this->haopaizhonglei($value['hpzl']);

        }

        $this->load->view('public/header');
        $this->load->view('outbound_management/Index',$data);

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