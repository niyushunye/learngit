<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_task_devide extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('pagination');
        $this->load->model('admin/m_task_devide');
        if(session_login()){
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }

        date_default_timezone_set('Asia/Shanghai');
    }

    public function index()
    {   

        //参数传递
        $data['startTime']= '';
        $data['endTime']= '';
        $data['czrs']= '';
        $data['hphms']= '';
        $data['hpzls']= '';
        $data['ywlxs']= '';
        $data['bmdms']= '';

        $data['type'] = 1;

        //分页配置
        $config['uri_segment'] = 4;
        $offect =$this->uri->segment(4);
        // var_dump($offect);
        $config['per_page'] = 15;
        $config['base_url'] = base_url().'/admin/c_task_devide/index/';
        //查询总条数
        $arr = $this->m_task_devide->select_numbers_model();
        $data['total'] = $arr[0]['total'];
        //var_dump($data);exit;
        $config['total_rows'] = $data['total'];
        
        //查询出所有分配
        $data['data'] = $this->m_task_devide->select_devide_info($config['per_page'],$offect);

        if(!$data['data']){
            $data['data'] = $this->m_task_devide->select_devide_info();
        }

        foreach ($data['data'] as &$value)
        {
            //号牌种类
            $value['hpzl_fanyi_result'] = $this->haopaizhonglei($value['hpzl']);

        }
       //查询大队下的所有中队
        $orgnum = $_SESSION['orgnum'];
        //部门名称
        $data['bmdm'] = $this->m_task_devide->select_orgnum_model($orgnum);
        //查询当前所有任务(业务类型)
        $data['ywlx'] = $this->m_task_devide->search_all_task();
        //查询当前系统下所有的车牌号码种类
        $data['hpzl'] = $this->m_task_devide->select_frm_class();

        $this->pagination->initialize($config);
        $this->load->view('public/header');
        $this->load->view('task_devide/Index',$data);
    }
    //新增
    public function devide_add()
    {
        $this->load->view('public/header');
        //查询出当前中队下的所有警员
        $orgnum = $_SESSION['orgnum'];    //组织机构编码
        $res['data'] = $this->m_task_devide->select_member_info($orgnum);
        
        //查询出当前中队的所有任务下发
        //$orgnum = $_SESSION['orgnum'];
        $res['data1'] = $this->m_task_devide->select_all_assign();

        $this->load->view('task_devide/v_devide_add',$res);
    }
/*    //保存
    public function devide_save()
    {
        if(isset($_POST['tid'])) {
            $data['did'] = 0;
            $data['tid'] = $this->input->post('tid');
            $data['issued_member_accounts'] = $_SESSION['accounts'];
            $data['issued_member'] = $_SESSION['realname'];
            $data['devide_time'] = time();
            $str = $this->input->post('str');
            $arr = explode('+', $str);
            $arrs = array();
            $res = true;
            //查询已经分配过的警员
            $arr1 = $this->m_task_devide->select_devide_member();
            //降维
            if (!empty($arr1))
            {
                foreach ($arr1 as $row)
                {
                    array_push($arrs, $row['devide_member']);
                }
            }
            foreach ($arr as $value) {
                if ($value != "" && (in_array($value, $arrs) == false))
                {
                    //已经分配的当前任务的警员，不再进行添加
                    $data['devide_member'] = $value;     //被分配警员
                    $res = $this->m_task_devide->devide_save_model($data);
                }
            }
            if ($res)
            {
                echo '1';
            } else {
                echo '0';
            }

        }
    }*/

     //添加(保存)
    public function devide_saves()
    {
        if(isset($_POST['hphm'])) {
            $id = $this->input->post('hphm');
            $str = $this->input->post('str');
            $arr = explode('::', $str);
            $data['czr'] = $arr[1];                   //处置人
            $data['jybh'] = $arr[0];                  //处置人警员编号
            $data['dateline1'] = time();              //任务分配时间

            $res = $this->m_task_devide->save_model($id,$data);
            if ($res) {
                // //给警员的任务分配成功
                // //任务考核表中新增一条记录
                // //先根据ID查询详细信息
                // $res = $this->m_task_devide->select_single_devide($id);
                // $datas['id'] = 0;
                // $datas['hphm'] = $res['0']['hphm'];    //号牌号码
                // $datas['hpzl'] = $res['0']['hpzl'];    //号牌种类
                // $datas['ywlx'] = $res['0']['ywlx'];    //业务类型
                // $datas['czr'] = $res['0']['czr'];      //处置民警
                // $datas['jybh'] = $res['0']['jybh'];    //警员编号
                // $datas['bmmc'] = $res['0']['bmmc'];    //部门民称
                // $datas['bmdm'] = $res['0']['bmdm'];    //部门代码
                // $this->m_task_devide->add_veh_task_write($datas);
                echo '1';

            } else {
                echo '0';
            }

        }
    }
    //删除
    public function delete()
    {
            $did = $this->input->post("did");
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
             //获取业务种类
            $ywlx = $this->input->post('ywlx');
            //获取部门名称(其实是部门代码)
            $bmdm = $this->input->post('bmdm');

            //查看当前数据是否存在
            $data = $this->m_task_devide->select_single_devide($did);

            if($data){
                $this->m_task_devide->delete_model($did);
                //总条数
                $arr = $this->m_task_devide->select_search_data($startTime,$endTime,$hphm,$czr,$hpzl,$ywlx,$bmdm);

                echo count($arr);

            }else{
                echo 0;
            }


            /*$res = $this->m_task_devide->delete_model($did);
            if($res)
            {
                echo '1';
            }else
                {
                    echo '0';
                }*/
        
    }
    //编辑(打开编辑页面)
    public function devide_edit($id)
    {
        
        ///查询出当前中队下的所有警员
        $orgnum = $_SESSION['orgnum'];    //组织机构编码
        $data['data'] = $this->m_task_devide->select_member_info($orgnum);
        //查询出当前中队的所有任务下发
        $data['data1'] = $this->m_task_devide->select_all_assign1();
        //根据ID查询详细信息
        $data['datas'] = $this->m_task_devide->select_single_devide($id);


        $this->load->view('public/header');
        $this->load->view('task_devide/v_devide_edit',$data);
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
        //获取业务类型
        $data['ywlxs'] = $this->input->post('ywlx');
        //获取部门名称(其实是部门代码)
        $data['bmdms'] = $this->input->post('bmdm');


        //查询总条数
        $arr = $this->m_task_devide->select_search_data($data['startTime'],$data['endTime'],$data['hphms'],$data['czrs'],$data['hpzls'],$data['ywlxs'],$data['bmdms']);

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
        $data['bmdm'] = $this->m_task_devide->select_orgnum_model($orgnum);
        //查询当前所有任务(业务类型)
        $data['ywlx'] = $this->m_task_devide->search_all_task();
        //查询当前系统下所有的车牌号码种类
        $data['hpzl'] = $this->m_task_devide->select_frm_class();



        $this->load->view('public/header');
        $this->load->view('task_devide/Index',$data);

    }




    //编辑(处理)
   /* public function devide_edit_pro()
    {
        if(isset($_POST['id']))
        {
            $id= $this->input->post('id');
            $data['hphm'] = $this->input->post('hphm');
            $data['hpzl'] = $this->input->post('hmzl');
            $data['ywlx'] = $this->input->post('tid');
            $data['bmmc'] = $this->input->post('orgname');
            $data['bmdm'] = $this->input->post('orgnum');
            $str = $this->input->post('str');
            $arr = explode('::', $str);
            $data['czr'] = $arr[1];
            $data['jybh'] = $arr[0];
            $data['month'] = date('m');
            $img_str = $this->input->post('imgge_name');
            $data['cltp'] = base64_encode($img_str);
            $data['dateline'] = time();
            $res = $this->m_task_devide->update_model($data,$id);
            if($res)
            {
                echo '1';
            }else
                {
                    echo '0';
                }
        }
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
                        $str = time().$file_name[$i]."+".$str;
                        move_uploaded_file($file_tmp_name[$i], './assets/uploads/assign_car_image/' . iconv('UTF-8', 'UTF-8', time().$file_name[$i]));
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
    }*/



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