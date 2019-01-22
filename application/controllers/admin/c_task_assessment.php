<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_task_assessment extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('pagination');
        $this->load->model('admin/m_task_devide');
        $this->load->model('admin/m_task_assessment');
        $this -> load -> model('admin/m_inbound_management');
        if (session_login()) {
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }
    }

    //主页显示
    public function index()
    {

        $data['startTime']= ''; //开始时间
        $data['endTime']= '';   //结束时间
        $data['czrs']= '';      //处置民警
        $data['hphms']= '';     //号牌号码
        $data['hpzls']= '';     //号牌种类
        $data['sfzmhms']= '';   //身份证号码
        $data['bmdms']= '';     //部门代码
        $data['ywlx'] = '';     //业务类型
        $data['type'] = 1;
        //分页配置
        $config['uri_segment'] = 4;
        $offect =$this->uri->segment(4);
        // var_dump($offect);
        $config['per_page'] = 20;
        $config['base_url'] = base_url().'/admin/c_task_assessment/index/';
        //查询总条数
        $arr = $this->m_task_assessment->select_numbers_model();
        $data['total'] = $arr[0]['total'];
        //var_dump($data);exit;
        $config['total_rows'] = $data['total'];
        $data['data'] = $this->m_task_assessment->select_task_assessmentinfo($config['per_page'],$offect);

        //查询当前系统下的所有部门
        $data['bmdm'] = $this->m_task_assessment->select_orgnum_model();
        //查询当前系统下所有的车牌号码种类

        //print_r($data['bmdm']);die();
        $data['hpzl'] = $this->m_inbound_management->select_frm_class();

//        print_r($data['data']);die();
        $this->pagination->initialize($config);
        $this->load->view('public/header');
        $this->load->view('task_assessment/Index',$data);
    }

    //新增(打开新增页面)
    public function assessment_add()
    {
        $orgnum = $_SESSION['orgnum'];    //组织机构编码
        $orgname = $_SESSION['orgname'];  //组织机构名称
        $res['data2'] = array(
            'orgnum'  => $orgnum,
            'orgname' => $orgname
        );
        //当前中队下的所有警员
        $res['data'] = $this->m_task_devide->select_member_info($orgnum);
        //查询出当前系统下的任务下发
        $arr = $this->m_task_devide->select_task_devide($orgnum);
        //二维数组去重
        $res['data1'] = $this->remove_duplicate($arr);


        $this->load->view('public/header');
        $this->load->view('task_assessment/v_assessment_add',$res);
    }
    //二维数组去重方法
   public  function remove_duplicate($array)
   {
       $result=array();
       foreach ($array  as $key => $value)
       {
           $has = false;
           foreach ($result as $val)
           {
               if($val['ywlx']==$value['ywlx'])
               {
                   $has = true;
                   break;
               }
           }
           if(!$has)
           {
               $result[]=$value;
           }
       }
       return $result;
   }
    //保存
    public function assessment_save()
    {
        if(isset($_POST['hphm']))
        {
            $data['id'] = 0;
            $data['hphm'] = $this->input->post('hphm');           //号牌号码
            $data['hpzl'] = $this->input->post('hpzl');           //号牌种类
            $data['ywlx'] = $this->input->post('ywlx');           //业务类型
            $data['sfch'] = $this->input->post('sfch');           //是否查处
            $data['wfcyy'] = $this->input->post('wfcyy');         //未查处原因
            $data['dsr'] = $this->input->post('dsr');             //当事人
            $data['sfzmhm'] = $this->input->post('sfzh');         //身份证号
            $data['czsj'] = $this->input->post('czsj');           //处置时间
            $data['czjg'] = $this->input->post('czjg');           //处置结果
            $data['sfyx'] = $this->input->post('sfyx');           //是否有效
            $data['bmdm'] = $this->input->post('bmdm');           //部门代码
            $data['bmmc'] = $this->input->post('bmmc');           //部门名称
            $str = $this->input->post('str');
            $arr = explode('::',$str);
            $data['czr'] = $arr[1];                               //处置人
            $data['jybh'] = $arr[0];                              //警员编号
            $strs = $this->input->post('imgge_name');          //查处图片
            $arr = explode('+',$strs);
            for($i=0;$i<count($arr);$i++)
            {
                if($arr[$i] != "")
                {
                    $data['tp'.($i+1)] = base64_encode($arr[$i]);   //车辆图片
                }
            }
            $res = $this->m_task_assessment->save_model($data);
            if($res)
            {
                echo '1';
            }else
                {
                    echo '0';
                }


        }
    }
    //编辑(编辑页面)
    public function assessment_edit($id)
    {
        $orgnum = $_SESSION['orgnum'];    //组织机构编码
        //当前中队下的所有警员
        $res['data'] = $this->m_task_devide->select_member_info($orgnum);
        //查询出当前系统下的任务下发
        //$res['data1'] = $this->m_task_devide->select_task_devide($orgnum);
        $res['data1'] = $this->m_task_assessment->select_task_devide();
        //根据id查询单条记录的详细信息
        $res['datas'] = $this->m_task_assessment->select_task_assessmentsingle($id);

        $this->load->view('public/header');
        $this->load->view('task_assessment/v_assessment_edit',$res);
    }
    //编辑(处理)
    public function assessment_edit_pro()
    {

            $id = $this->input->post('id');
            $data['hphm'] = $this->input->post('hphm');           //号牌号码
            $data['hpzl'] = $this->input->post('hpzl');           //号牌种类
            $data['ywlx'] = $this->input->post('ywlx');           //业务类型
            $data['sfch'] = $this->input->post('sfch');           //是否查处
            $data['wfcyy'] = $this->input->post('wfcyy');         //未查处原因
            $data['dsr'] = $this->input->post('dsr');             //当事人
            $data['sfzmhm'] = $this->input->post('sfzh');         //身份证号
            $data['czsj'] = strtotime($this->input->post('czsj'));           //处置时间
            $data['czjg'] = $this->input->post('czjg');           //处置结果
            $data['sfyx'] = $this->input->post('sfyx');           //是否有效
            $data['bmdm'] = $this->input->post('bmdm');           //部门代码
            $data['bmmc'] = $this->input->post('bmmc');           //部门名称
            $data['pic'] =  rtrim($this->input->post('imgge_name'),'+') ;  //查处图片


            /*$str = $this->input->post('str');
            $arr = explode('::',$str);
            $data['czr'] = $arr[1];                               //处置人
            $data['jybh'] = $arr[0];                              //警员编号*/

            //执行修改
            $res = $this->m_task_assessment->update_model($id,$data);
            if($res){
                echo '1';
            }else{
                echo '0';
            }
    }
    //删除
    public function delete()
    {
        $id = $this->input->post('did');
        $res = $this->m_task_assessment->delete_model($id);
        if($res)
        {
            echo '1';
        }else
            {
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
                        move_uploaded_file($file_tmp_name[$i], './assets/uploads/task_assessment_image/' . iconv('UTF-8', 'UTF-8', $new_name));
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
    public function search(){
        $data['bmdms']= $bmmc = $this -> input -> post('bmdm',TRUE);    //部门名称
        $data['hphms']= $hphm = $this -> input -> post('hphm',TRUE);    //号牌号码
        $data['hpzls']= $hpzl = $this ->input -> post('hpzl',TRUE);     //号牌种类
        $data['sfzmhms']= $sfzm = $this -> input -> post('sfzmhm',TRUE);   //身份证号码
        $data['czrs']= $czmj = $this -> input -> post('czr',TRUE);          //处置民警

        $data['startTime'] = $startTime = strtotime($this->input->post('startTime'));  //开始时间

        $data['endTime'] = $endTime = strtotime($this->input->post('endTime'));    //结束时间


        $data['ywlx'] = $yelx = $this -> input -> post('ywlx',TRUE);

        //查询总条数
        $arr = $this->m_task_assessment->select_numbers_model_where($bmmc,$hphm,$hpzl,$sfzm,$czmj,$startTime,$endTime,$yelx);
        $data['total'] = $arr;

        $data['data'] = $this->m_task_assessment->select_task_assessmentinfo_where($bmmc,$hphm,$hpzl,$sfzm,$czmj,$startTime,$endTime,$yelx);
        //查询当前系统下的所有部门
        $data['bmdm'] = $this->m_task_assessment->select_orgnum_model();
        //查询当前系统下所有的车牌号码种类

        $data['hpzl'] = $this->m_inbound_management->select_frm_class();

        $this->load->view('public/header');
        $this->load->view('task_assessment/Index',$data);
    }


}
