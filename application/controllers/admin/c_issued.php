<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class c_issued extends CI_Controller{
    //危险道路统计
    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/m_issued');
        $this->load->library('pagination');
        date_default_timezone_set("Asia/Shanghai");
        if(session_login()){
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }
    }

    public function index(){
        $config['uri_segment'] = 4;
        $offect =$this->uri->segment(4);
        $config['per_page'] = 15;
        $config['base_url'] = base_url().'/admin/c_issued/index/';
        $arr = $this -> m_issued -> select_numbers_model();
        $data['total'] = $arr;
        $config['total_rows'] = $data['total'];
        $data['data'] = $this->m_issued->select_task_assessmentinfo($config['per_page'],$offect);
        $this->pagination->initialize($config);

//        print_r($data);die();
        $this -> load -> view('public/header');
        $this -> load -> view('issued/V_index',$data);
    }

    public function add(){
        $data['data'] = $this -> m_issued -> select_orginfo();
        $this -> load -> view('public/header1');
        $this -> load -> view('issued/V_index_add.php',$data);
    }

    //添加考核任务
    public function add_save(){
        $data['title'] = $this -> input -> post('title',TRUE);
        $data['content'] = $_POST['content'];
        $data['task_orginfo'] = $_SESSION['orgnum'];
        $data['work_type'] = $this -> input -> post('work_type',TRUE);
        $vote = $this -> input -> post('vote',TRUE);
        $data['receive_account'] = implode(',',$vote);
        $data['task_accounts '] = $_SESSION['accounts'];
        $data['task_realname '] = $_SESSION['realname'];
        $data['create_time '] = time();
        $res = $this -> m_issued -> add_save($data);
        if($res){
            echo 1; //添加成功
        }else{
            echo 2;  //添加失败
        }
    }

    //查看
    public function row_view($id){
        $data = $this -> m_issued -> select_row($id);
//        print_r($data);die();
        $this -> load -> view('public/header');
        $this -> load -> view('issued/V_index_view',$data);
    }

    //编辑
    public function iss_edit($id){
        $data['data'] = $this -> m_issued -> select_orginfo();
        $data['shuju'] = $this -> m_issued -> select_row($id);
        $data['jwry'] = explode(',',$data['shuju']['receive_account']); //字符串转数组
        $data['orginfo'] = $this -> m_issued -> select_orgnum($data['jwry']);
        $this -> load -> view('public/header1');
        $this -> load -> view('issued/V_index_edit',$data);
    }

    //编辑更新
    public function edit_save(){
        $id = $this -> input -> post('id',TRUE);
        $data['title'] = $this -> input -> post('title',TRUE);
        $data['content'] = $_POST['content'];
        $data['work_type'] = $this -> input -> post('work_type',TRUE);
        $vote = $this -> input -> post('vote',TRUE);
        $data['receive_account'] = implode(',',$vote);
        $res = $this -> m_issued -> select_update($id,$data);
        if($res){
            echo 1; //修改成功
        }else{
            echo 2; //修改失败
        }
    }


    //删除
    public function delete(){
        $id = $this -> input -> post('did',TRUE);
        $res = $this -> m_issued -> select_delete($id);
        if($res){
            echo 1;  //删除成功
        }else{
            echo 2;  //删除失败
        }
    }

}
