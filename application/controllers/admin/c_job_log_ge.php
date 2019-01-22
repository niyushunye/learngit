<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class c_job_log_ge extends CI_Controller{
    //危险道路统计
    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this -> load -> model('admin/m_job_log');
        $this->load->library('pagination');
        date_default_timezone_set("Asia/Shanghai");
        if(session_login()){
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }
    }

    //展示数据
    public function index(){
        $jwry = $_SESSION['accounts'];
        $config['uri_segment'] = 4;
        $offect =$this->uri->segment(4);
        $config['per_page'] = 15;
        $config['base_url'] = base_url().'/admin/c_job_log_ge/index/';
        $arr = $this -> m_job_log -> select_numbers_model1($jwry);
        $data['total'] = $arr;
        $config['total_rows'] = $data['total'];


        $data['data'] = $this->m_job_log->select_task_assessmentinfo1($config['per_page'],$offect,$jwry);
        $this->pagination->initialize($config);

        $this -> load -> view('public/header');
        $this -> load -> view('job_log/V_index',$data);
    }

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

    //新增页面
    public function add(){
        $this -> load -> view('public/header');
        $this -> load -> view('job_log/V_index_add.php');
    }

    //新增添加
    public function task_save(){
        $data['work_completion'] = $this -> input -> post('work_completion',TRUE);
        $data['work_fault'] = $this -> input -> post('work_fault',TRUE);
        $data['learning_progress'] = $this -> input -> post('learning_progress',TRUE);
        $data['attendance'] = $this -> input -> post('attendance',TRUE);
        $data['log_type '] = $this -> input -> post('log_type',TRUE);
        $data['log_time'] = $this -> input -> post('inbound_time',TRUE);
        $data['work_pic'] = $this -> input -> post('strs',TRUE);
        $data['accounts'] = $_SESSION['accounts'];
        $data['realname'] = $_SESSION['realname'];
        $data['orginfo'] = $_SESSION['orgnum'];
        $data['create_time'] = time();
        $res = $this -> m_job_log -> add_log($data);
        if($res){
            echo 1; //添加成功
        }else{
            echo 2; //添加失败
        }
    }

    //查看详情
    public function row_view($id){
        $data = $this -> m_job_log -> select_row($id);
        $this -> load -> view('public/header');
        $this -> load -> view('job_log/V_index_view',$data);
    }

    //编辑信息
    public function log_edit($id){
        $data = $this -> m_job_log -> select_row($id);
        $this -> load -> view('public/header');
        $this -> load -> view('job_log/V_index_edit',$data);
    }

    //更新修改
    public function edit(){
        $data['work_completion'] = $this -> input -> post('work_completion',TRUE);
        $data['work_fault'] = $this -> input -> post('work_fault',TRUE);
        $data['learning_progress'] = $this -> input -> post('learning_progress',TRUE);
        $data['attendance'] = $this -> input -> post('attendance',TRUE);
        $data['log_type '] = $this -> input -> post('log_type',TRUE);
        $data['log_time'] = $this -> input -> post('inbound_time',TRUE);
        $data['work_pic'] = $this -> input -> post('strs',TRUE);
        $data['accounts'] = $_SESSION['accounts'];
        $data['realname'] = $_SESSION['realname'];
        $data['orginfo'] = $_SESSION['orgnum'];
        $id = $this -> input -> post('id',TRUE);
        $res = $this -> m_job_log -> edit_save($id,$data);

        if($res){
            echo 1; //修改成功
        }else{
            echo 2; //修改失败
        }
    }

    //删除日志
    public function delete(){
        $id = $this -> input -> post('did',TRUE);
        $res = $this -> m_job_log -> jog_delete($id);
        if($res){
            echo 1; //删除成功
        }else{
            echo 2;  //删除失败
        }
    }

}
