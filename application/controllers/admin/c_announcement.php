<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class c_announcement extends CI_Controller{

    //官方给的写法,构造函数   公告通知
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this -> load -> model('admin/m_announcement');
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
        $config['base_url'] = base_url().'/admin/c_announcement/index/';
        $arr = $this -> m_announcement -> select_numbers_model();
        $data['total'] = $arr;
        $config['total_rows'] = $data['total'];
        $data['data'] = $this->m_announcement->select_task_assessmentinfo($config['per_page'],$offect);
        $this->pagination->initialize($config);
        $this->load->view('public/header');
        $this -> load -> view('announcement/V_index',$data);
    }

    public function add(){
        $this->load->view('public/header1');
        $this -> load -> view('announcement/V_index_add.php');
    }

    public function add_save(){
        $data['subject'] = $this -> input -> post('subject',TRUE);  //公告通知标题
        $data['content'] = $_POST['content'];  //公告通知内容
        $data['accounts'] = $_SESSION['accounts'];
        $data['realname'] = $_SESSION['realname'];
        $data['createTime '] = time();
        $res = $this -> m_announcement -> add_row($data);
        if($res){
            echo 1;  //添加成功
        }else{
            echo 2;  //添加失败
        }
    }

    //查看公告通知详情
    public function row_view($id){
        $res = $this -> m_announcement -> view_row($id);
        $this -> load -> view('public/header');
        $this -> load -> view('announcement/V_index_view',$res);
    }

    //编辑
    public function ann_edit($id){
        $data = $this -> m_announcement -> view_row($id);
        $this->load->view('public/header1');
        $this -> load -> view('announcement/V_index_edit',$data);
    }

    //编辑更新
    public function edit_update(){
        $id = $this ->input -> post("id",TRUE);
        $data['subject'] = $this -> input -> post('subject',TRUE);  //公告通知标题
        $data['content'] = $_POST['content'];  //公告通知内容
        $data['accounts'] = $_SESSION['accounts'];
        $data['realname'] = $_SESSION['realname'];
        $res = $this -> m_announcement -> edit_upldate($id,$data);
        if($res){
            echo 1;   //编辑成功
        }else{
            echo 2;   //编辑失败
        }
    }

    //删除
    public function delete(){
        $id = $this -> input -> post('did',TRUE);
        $res = $this ->  m_announcement -> delete($id);
        if($res){
            echo 1;//删除成功
        }else{
            echo 2;  //删除失败
        }
    }
    //上传图片
    public function upload(){
        $month = date('Ymd',time());
        $dir = "./uploads/".$month."/";
        if(!is_dir($dir))//判断目录是否存在
        {
            mkdir ($dir,0777,true);//如果目录不存在则创建目录
        };
        $res = move_uploaded_file($_FILES["file"]["tmp_name"],$dir. $_FILES["file"]["name"]);
        if($res){
            echo base_url()."uploads/".$month."/".$_FILES["file"]["name"];
        }else{
            echo 2; //上传失败
        }
    }
}