<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_control_assessment extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('pagination');
        $this->load->model('admin/m_task_devide');
        $this->load->model('admin/m_control_assessment');
        date_default_timezone_set("Asia/Shanghai");
        if (session_login()) {
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }

    }
    
    //主页显示
    public function index() 
    {

        //参数传递
        $data['startTime']= '';
        $data['endTime']= '';
        $data['hphm']= '';
        $data['czr']= '';
        $data['hpzl']= '';
        $data['bmmc']= '';

        $data['type'] = 1;

        //分页配置
        $config['uri_segment'] = 4;
        $offect =$this->uri->segment(4);
        // var_dump($offect);
        $config['per_page'] = 15;
        $config['base_url'] = base_url().'/admin/c_control_assessment/index/';
        //查询总条数
        $arr = $this->m_control_assessment->select_numbers_model();

        $data['total'] = count($arr);
        //var_dump($data);exit;
        $config['total_rows'] = $data['total'];
        $data['data'] = $this->m_control_assessment->select_control_assessmentinfo($config['per_page'],$offect);

        if(!$data['data']){
            $data['data'] = $this->m_control_assessment->select_control_assessmentinfos();
        }
        foreach ($data['data'] as &$value)
        {
            //号牌种类
            $value['hpzl_fanyi_result'] = $this->haopaizhonglei($value['hpzl']);

        }

        //获取号牌种类
        $data['frm_code'] = $this->db->select('DMZ,DMSM1') -> where('XTLB','00') -> where('DMLB','1007')->get('frm_code')->result_array();
        //获取部门名称
        $data['orginfo'] =  $this->db->select('orgnum,orgname')->get('orginfo')->result_array();

        $this->pagination->initialize($config);

        $this->load->view('public/header');
        $this->load->view('control_assessment/Index',$data);
    }


    //添加(打开添加页面)
    public function add()
    {
        $orgnum = $_SESSION['orgnum'];    //组织机构编码
        $orgname = $_SESSION['orgname'];  //组织机构名称
        $res['data2'] = array(
            'orgnum'  => $orgnum,
            'orgname' => $orgname
        );

        //当前中队下的所有警员
        $res['data'] = $this->m_task_devide->select_member_info($orgnum);
        //查询所有任务
        $res['datas'] = $this->m_control_assessment->select_con_task();
        //查询所有号码种类
        $res['data1'] = $this->m_control_assessment->select_all_hpzl();

        
        $this->load->view('public/header');
        $this->load->view('control_assessment/v_add',$res);
    }
    //添加(保存)
    public function save()
    {
        
            $data['hphm'] = $this->input->post('hphm');         //号牌号码
            $data['hpzl'] = $this->input->post('hmzl');         //号牌种类
            $data['rwlx'] = $this->input->post('rwlx');         //任务类型
            $data['ywzl'] = $this->input->post('ywzl');         //业务种类
            $data['bh'] = $this->input->post('bh');             //业务种类对应的编号
            $data['czsj'] = strtotime($this->input->post('czsj'));         //处置时间
            $data['czjg'] = $this->input->post('czjg');         //处置结果
            $data['sfyx'] = $this->input->post('sfyx');         //是否有效
            $data['bmdm'] = $this->input->post('bmdm');         //部门代码
            $data['bmmc'] = $this->input->post('bmmc');         //部门名称

            $data['pic'] = rtrim($this->input->post('imgge_name'),'+');      //查处图片

            
            $str = $this->input->post('str');   
            $arrs = explode('::',$str);
            $data['czr'] = $arrs[1];            //处置人                
            $data['jybh'] = $arrs[0];           //处置人警员编号
            $data['dateline'] = time(); 

            $res = $this->m_control_assessment->save_model($data);
            if($res){
                echo '1';
            }else{
                echo '0';
            }
    }
    //编辑(打开编辑页面)
    public function edit($id)
    {
        $orgnum = $_SESSION['orgnum'];    //组织机构编码
        //当前中队下的所有警员
        $res['data'] = $this->m_task_devide->select_member_info($orgnum);
        //查询所有任务
        $res['datas'] = $this->m_control_assessment->select_con_task();
        //根据ID查询出详细信息
        $res['data1'] = $this->m_control_assessment->select_control_assessmentsingle($id);
        //查询所有号码种类
        $res['data2'] = $this->m_control_assessment->select_all_hpzl();


        $this->load->view('public/header');
        $this->load->view('control_assessment/v_edit',$res);
    }

    //编辑(处理)
    public function edit_pro()
    {

            $id = $this->input->post('id');

            $data['hphm'] = $this->input->post('hphm');         //号牌号码
            $data['hpzl'] = $this->input->post('hmzl');         //号牌种类
            $data['rwlx'] = $this->input->post('rwlx');         //任务类型
            $data['ywzl'] = $this->input->post('ywzl');         //业务种类
            $data['bh'] = $this->input->post('bh');             //业务种类对应的编号
            $data['czsj'] = strtotime($this->input->post('czsj'));         //处置时间
            $data['czjg'] = $this->input->post('czjg');         //处置结果
            $data['sfyx'] = $this->input->post('sfyx');         //是否有效
            $data['bmdm'] = $this->input->post('bmdm');         //部门代码
            $data['bmmc'] = $this->input->post('bmmc');         //部门名称
            $data['pic'] = rtrim($this->input->post('imgge_name'),'+');      //查处图片


            $str = $this->input->post('str');
            $arrs = explode('::',$str);
            $data['czr'] = $arrs[1];                              //处置人
            $data['jybh'] = $arrs[0];                             //处置人警员编号


            $res = $this->m_control_assessment->update_model($id,$data);
            if($res){
                echo '1';
            }else{
                echo '0';
            }

    }
    //删除
    public function delete()
    {
        //获取id
        $id = $this->input->post('did');
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
        //获取部门名称(其实是部门代码)
        $bmmc = $this->input->post('bmmc');
        //查看当前数据是否存在
        $data = $this->m_control_assessment->select_control_assessmentsingle($id);

        if($data){
            $this->m_control_assessment->delete_model($id);
            //总条数
            $arr = $this->m_control_assessment->select_search_num($startTime,$endTime,$hphm,$czr,$hpzl,$bmmc);

            echo $arr[0]['total'];

        }else{
            echo 0;
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
            $file_name = $car_files['car_image']['name'];              //文件新名称
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
                        move_uploaded_file($file_tmp_name[$i], './assets/uploads/investigation_car_image1/' . iconv('UTF-8', 'UTF-8', $new_name));

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


    //列表查询操作
    public function search()
    {   

        //获取开始时间
        $data['startTime'] = strtotime($this->input->post('startTime'));

       /* if($startTime){
            $data['startTime'] =   $startTime;
            $_SESSION['startTime'] = $data['startTime'];
        }else{
            $data['startTime'] = $_SESSION['startTime'];
        }*/

        //获取结束时间
        $data['endTime'] = strtotime($this->input->post('endTime'));


        /*if( $data['endTime']){
            $_SESSION['endTime'] = $data['endTime'];
        }else{
             $data['endTime'] = $_SESSION['endTime'];
        }*/

        //获取号牌号码
        $data['hphm'] = $this->input->post('hphm');

        /*if($data['hphm']){
            $_SESSION['hphm'] = $data['hphm'];
        }else{
            $data['hphm'] = $_SESSION['hphm'];
        }*/
        //获取处置民警
        $data['czr'] = $this->input->post('czr');

        /*if($data['czr']){
            $_SESSION['czr'] = $data['czr'];
        }else{
            $data['czr'] = $_SESSION['czr'];
        }*/
        //获取号牌种类
        $data['hpzl'] = $this->input->post('hpzl');

        /*if($data['hpzl']){
            $_SESSION['hpzl'] = $data['hpzl'];
        }else{
            $data['hpzl'] = $_SESSION['hpzl'];
        }*/
        //获取部门名称(其实是部门代码)
        $data['bmmc'] = $this->input->post('bmmc');

        /*if($data['bmmc']){
            $_SESSION['bmmc'] = $data['bmmc'];
        }else{
            $data['bmmc'] = $_SESSION['bmmc'];
        }*/


        /*//分页配置
        $config['uri_segment'] = 4;
        $offect =$this->uri->segment(4);
        // var_dump($offect);
        $config['per_page'] = 15;
        $config['base_url'] = base_url().'/admin/c_control_assessment/search/';
        //查询总条数
        $arr = $this->m_control_assessment->select_search_num($data['startTime'],$data['endTime'],$data['hphm'],$data['czr'],$data['hpzl'],$data['bmmc']);

        $data['total'] = $arr[0]['total'];
        //var_dump($data);exit;
        $config['total_rows'] = $data['total'];
        $data['data'] = $this->m_control_assessment->select_search_condition($data['startTime'],$data['endTime'],$data['hphm'],$data['czr'],$data['hpzl'],$data['bmmc'],$config['per_page'],$offect);

        if(!$data['data']){
            
        }*/
        //查询总条数
        $arr = $this->m_control_assessment->select_search_num($data['startTime'],$data['endTime'],$data['hphm'],$data['czr'],$data['hpzl'],$data['bmmc']);

        $data['total'] = $arr[0]['total'];

        $data['data'] = $this->m_control_assessment->select_search_conditions($data['startTime'],$data['endTime'],$data['hphm'],$data['czr'],$data['hpzl'],$data['bmmc']);
        $data['type'] = 0;
        foreach ($data['data'] as &$value)
        {
            //号牌种类
            $value['hpzl_fanyi_result'] = $this->haopaizhonglei($value['hpzl']);

        }
        //获取号牌种类
        $data['frm_code'] = $this->db->select('DMZ,DMSM1') -> where('XTLB','00') -> where('DMLB','1007')->get('frm_code')->result_array();
        //获取部门名称
        $data['orginfo'] =  $this->db->select('orgnum,orgname')->get('orginfo')->result_array();


        //$this->pagination->initialize($config);
        $this->load->view('public/header');
        $this->load->view('control_assessment/Index',$data);



        /*
        
        $data = $this->m_control_assessment->select_search_condition($startTime,$endTime,$hphm,$czr,$hpzl,$bmmc,$config['per_page'],$offect);

        $count = count($data);

        if(empty($startTime) && empty($endTime) && empty($hphm) && empty($czr) && empty($hpzl) && empty($bmmc)){
            echo '0';
        }else{
            $re = array(
               'data' => $data,
               'count' => $count,
            );
        
           echo json_encode($re);
        }*/
 
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