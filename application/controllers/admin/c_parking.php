<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_parking extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('pagination');
        $this -> load -> model('admin/m_parking');
        if (session_login()) {
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }

    }

    public function index(){

        $config['uri_segment'] = 4;
        $offect =$this->uri->segment(4);

        $config['per_page'] = 10;
        $config['base_url'] = base_url().'/admin/c_parking/index/';
        //查询总条数
        $arr = $this->m_parking->select_parking_num();

        $data['total'] = $arr;

        $config['total_rows'] = $data['total'];

        $data['data'] = $this->m_parking->select_parking($config['per_page'],$offect);
        //print_r($data['data']);die();
        $this->pagination->initialize($config);

        //print_r($data['data']);die();
        $this->load->view('public/header');
        $this -> load -> view('parking/v_index_parking',$data);
    }

    //新增停车页面
    public function parking_add(){
        $id = $this -> input -> get('id',TRUE);

        if($id == 2){
            $data['data'] = $this -> m_parking -> select_mc();
        }
        if($id == 1){
            $data['orginfo'] = $this -> m_parking -> select_orginfo();
        }
        $data['type'] = $id;
        $this->load->view('public/header');
        $this -> load -> view('parking/v_parking_add',$data);
    }

    //加入数据库
    public function parking_add_ins(){
        $data['parking_dizhi'] = $this -> input -> post('dizhi',TRUE);  //停车场地址
        $data['parking_fj'] = $this -> input -> post('mingchengid',TRUE); //停车场的上级id
        $data['add_member'] = $_SESSION['accounts'];
        $data['add_time'] = time();
        $data['type'] = 2;

        $res1 = $this -> m_parking -> select_dz_cf($data['parking_dizhi']);

        if($res1){
            echo 3;
        }else{
            $res = $this -> m_parking -> parking_add($data);
            if($res){
                echo 1;
            }else{
                echo 2;
            }
        }
    }



    //删除
    public function parking_delete (){
        $id = $this -> input -> post('did',TRUE);
        $res = $this -> m_parking -> parking_delete($id);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }


    //添加停车场名称
    public function parking_add_ins1(){
        $data['task_name'] = $this -> input -> post('mingcheng',TRUE);
        $data['add_member'] = $_SESSION['accounts'];
        $data['add_time'] = time();
        $data['type'] = 2;
        $data['orgnum'] = $this -> input -> post('orgnum',TRUE);
        $data['orgname'] = $this -> input -> post('orgname',TRUE);

        $res1 = $this -> m_parking -> select_mc_xt($data['task_name']);
        if($res1){
            echo 3;    //添加的停车场名称重复
        }else{
            $res = $this -> m_parking -> parking_add_mc($data);
            if($res){
                echo 1;
            }else{
                echo 2;
            }
        }
    }

    //编辑页面
    public function parking_edit(){
        $id = $_GET['id'];
        $data['dz'] = $this -> m_parking -> parking_edit($id);

        $data['data'] = $this -> m_parking -> select_mc();
        $this->load->view('public/header');
        $this -> load -> view('parking/v_parking_edit',$data);
    }

    //修改更新
    public function parking_add_update(){
        $id = $this -> input -> post('id',TRUE);
        $data['parking_dizhi'] = $this -> input -> post('dizhi',TRUE);  //停车场地址
        //$data['task_name'] = $this -> input -> post('mingcheng',TRUE);  // 停车场名称
        $data['parking_fj'] = $this -> input -> post('mingchengid',TRUE); //停车场的上级id

        $res = $this -> m_parking -> parking_add_update($id,$data);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }

    //修改停车场名称
    public function parking_mc_edit(){
        $id = $this -> input -> get('id');
        $data['parking'] = $this -> m_parking -> parking_mc_select($id);  //停车场名称
        $data['orginfo'] = $this -> m_parking -> select_orginfo();    //交警部门名称和部门代码
        $this -> load -> view('public/header');
        $this -> load -> view('parking/v_parking_mc_edit',$data);
    }

    //更新提交停车场名称
    public function parking_mc_upload(){

        $id = $this -> input -> post('id',TRUE);
        $data['task_name'] = $name = $this -> input -> post('mc',TRUE);
        $data['orgname'] = $this -> input -> post('orgname',TRUE);
        $data['orgnum'] = $this -> input -> post('orgnum',TRUE);

        $res = $this -> m_parking -> parking_mc_upload($id,$data);

        if($res){
            echo 1;   //修改成功
        }else{
            echo 2;   //修改失败
        }

    }


}